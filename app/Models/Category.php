<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Category extends Model {
	use Translatable;
    protected $table = 'categories';
    public $translationModel = 'App\Models\CategoryTranslation';
    public $translatedAttributes = ['name', 'slug','description'];
    protected $fillable = ['name', 'slug','description'];
    

}
