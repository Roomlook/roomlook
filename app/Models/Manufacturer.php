<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Manufacturer extends Model {
	
	use Translatable;
	use \Illuminate\Database\Eloquent\SoftDeletes;
    public $translationModel = 'App\Models\ManufacturerTranslation';
	protected $table = 'manufacturers';
    public $translatedAttributes = ['name', 'body', 'slug'];
	protected $fillable = ['name', 'url', 'created_at', 'logo', 'body', 'slug'];
	
	public function imagePath() {
    	return 'images/manufacturers/'.$this->logo;
    }
	 
    public function deleteImage(){
		$file = "/images/manufacturers/".$this->logo;
		if(file_exists($file)){
			@unlink($file);
			return true;
		}
		return false;
	}
}
