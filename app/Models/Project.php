<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Dimsav\Translatable\Translatable;
class Project extends Model
{   
    
    use Translatable;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "projects";
    public $translationModel = 'App\Models\ProjectTranslation';
    public $translatedAttributes = ['name', 'cropimage', 'is_active', 'description', 'short_desc', 'seo_keywords', 'slug']; 
    protected $fillable = ['name', 'cropimage', 'is_active', 'author_id','slug', 'description', 'square', 'designer_id','photograph_id', 'short_desc', 'is_home_slider', 'seo_keywords', 'seo_description', 'is_new', 'order', 'project_relations_id', 'order_in_main'];

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function designer()
    {
        return $this->belongsTo('App\Models\Author', 'designer_id');
    }
    public function productRelations() {
        return $this->hasMany('App\Models\ProductRelationship', 'project_id');
    }
    public function projectRelations() {
        return $this->belongsTo('App\Models\ProjectRelation', 'project_relations_id');
    }
    public function photograph()
    {
        return $this->belongsTo('App\Models\Author', 'photograph_id');
    }

    public static function lists($column,$key = null, $type = null)
    {
        return Project::leftJoin('project_translations', 'projects.id', '=', 'project_translations.project_id')
            ->where('locale', '=', 'ru')->lists($column,'project_translations.project_id');
    }
    public function pictures($c = 0, $columns = [], $isMain = false)
    {
        $listRoom = $this->rooms()->lists('id');

        $pictures = RoomPicture::whereIn('room_id', $listRoom);

        if ($isMain)
            $pictures->where('is_home_slider', 1);

 
        if (count($columns) == 0)
            return $c != 0 ? $pictures->take($c)->get() : $pictures->get();
        else
            return $c != 0 ? $pictures->take($c)->select($columns)->get() : $pictures->select($columns)->get();
    }

    public function getFLImage()
    {

        foreach ($this->pictures() as $picture) {
            if ($picture->is_landscape == 1)
                return $picture;
        }
        return null;
    }

    public function products()
    { 
        $products = [];
        foreach ($this->rooms as $room) {
            foreach ($room->pictures as $picture) {
                foreach ($picture->tags as $tag) {
                    $products[] = $tag->product;
                }
            }
        }
        return collect($products);
    }
	
	/*
    public function nearProducts()
    {
        $products = [];
        foreach ($this->rooms as $room) {
            foreach ($room->pictures as $picture) {
                foreach ($picture->tags as $tag) {
                    $products[] = $tag->product;
                }
            }
        }
        return collect($products);
    }
	*/
	
    public function relativeProjects() {
        return $this->projectRelations->projects()->where('id', '!=', $this->id);
    }

}
