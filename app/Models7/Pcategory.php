<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Pcategory extends Model {
	use Translatable;
    protected $table = 'pcategories';
    public $translationModel = 'App\Models\PcategoryTranslation';
    public $translatedAttributes = ['name', 'seo_description', 'seo_keywords', 'slug'];
    protected $fillable = ['name','geo','parent_id','image', 'seo_description', 'seo_keywords', 'slug'];
    public function imagePath() {
        return 'images/pcategories/'.$this->image;
    }
	public static function lists($column,$key = null)
    {
        return Pcategory::leftJoin('pcategory_translation', 'pcategories.id', '=', 'pcategory_translation.pcategory_id')
            ->where('locale', '=', 'ru')->lists($column,'pcategory_translation.pcategory_id');
    }
    public function products() {
        return $this->hasMany('App\Models\Product');
    }
    public static function parents(){
        return self::where('parent_id','=','0')->get();
    }
    public function children() {
        return $this->hasMany('App\Models\Pcategory','parent_id');
    }
    public function deleteImage(){
        $file = "/images/pcategories/".$this->image;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
    public function hasChild($id) {
        return $this->children->count() > 0;
    }
    public function reparents() {
        if ($this->parent_id == 0)
            return "";
        else return $this->parent->id.",".$this->parent->reparents();
    }
    public function getParents() {
        $ids =  $this->reparents();
        $ids = $ids.$this->id;
        $ids = trim($ids, ",");
        $idArray = explode(",", $ids);
        $categories = Pcategory::whereIn('id', $idArray);
        return $categories;
    }

    public function parent() {
        return $this->belongsTo('App\Models\Pcategory', 'parent_id');
    }
    public function getChildrenHtml($category, $url = 'catalog') {
        if ($category == "" || $this->children()->count() == 0)
            return "";

        $current = $category;
        $sParent = $this;
        return view('partials.children', compact('sParent','current', 'url'));
    }
}
