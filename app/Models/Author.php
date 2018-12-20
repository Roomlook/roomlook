<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Author extends Model {
    
    use Translatable;

    public $translationModel = 'App\Models\AuthorTranslation';
    
    public $translatedAttributes = ['about', 'anons', 'city', 'seo_keywords', 'seo_description'];
    
	protected $fillable = ['user_id', 'about', 'anons','city','is_show', 'image','main_image', 'phone_number', 'seo_keywords', 'seo_description', 'type', 'website', 'slug'];
    
    public function projects(){
        return $this->hasMany('App\Models\Project');
    }
    public function imagePath() {
    	return 'images/authors/'.$this->image;
    }
    public function imagePathMain() {
        return 'images/rooms/md/'.$this->main_image;
    }
    public function user() {
    	return $this->belongsTo('App\User');
    }
    // public function city() {
    //     return $this->belongsTo('App\Models\City');
    // }
    public function reviews() {
        return $this->hasMany('App\Models\Review');
    }
    public static function lists($column,$key = null, $type = null)
    {
        $lists = array();
        $authors = Author::where('id', '>', 0);
        if ($type != null) {
            $authors->where('type', $type);
        }

        foreach ($authors->get() as $author) {
            $lists[$author->id] = $author->user->name;
        }
        asort($lists);
        return $lists;
    }
    public function deleteImage()
    {
        $file = $this->imagePath();

        if (file_exists($file)) {
            @unlink($file);

            return true;
        }

        return false;
    }
}
