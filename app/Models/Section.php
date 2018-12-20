<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Section extends Model {
	use Translatable;
    protected $table = 'sections';
    public $translationModel = 'App\Models\SectionTranslation';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name'];
    public function products() {
    	return $this->belongsToMany('App\Models\Product', 'product_section');
    }
}
