<?php
namespace App\Models; 

//use App\Models\PaperCategories;
//use App\Models\PaperCategoriesTranslations;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class PaperCategoriesTranslation extends Model {
 
    protected $table = "paper_categories_translations";
	
    public $timestamps = false; 
	
    public $translatedAttributes = ['id','name','slug'];
    protected $fillable = ['id','name', 'slug'];

}