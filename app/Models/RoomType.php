<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class RoomType extends Model {
	use Translatable;
    protected $table = 'room_type';
    public $translationModel = 'App\Models\RoomTypeTranslation';
    public $translatedAttributes = ['name',  'seo_keywords', 'seo_description'];
    protected $fillable = ['name', 'image', 'formenu', 'seo_keywords', 'seo_description'];
	
	public function imagePath($size = "md/") {
		
        if ($size == "")
            return 'images/roomtypes/'.$this->image;
        return 'images/roomtypes/'.$size.$this->image;
		 
    }
	
	public static function lists($column,$key = null)
    {
        return RoomType::leftJoin('room_type_translations', 'room_type.id', '=', 'room_type_translations.room_type_id')
            ->where('locale', '=', 'ru')->lists($column,'room_type_translations.room_type_id');
    }
    public function rooms() {
        return $this->hasMany('App\Models\Room');
    }
    public function products() {
        return $this->hasMany('App\Models\Product');
    }
    public function deleteImage(){
        $file = "/images/roomtypes/".$this->image;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
}
