<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class PaperCategories extends Model
{   
    
    use Translatable;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "paper_categories";
    public $translationModel = 'App\Models\PaperCategoriesTranslation';
	
    public $translatedAttributes = ['id'];
    protected $fillable = ['id'];
	
	/*
    public static function category()
    {
        return PaperCategories::leftJoin('paper_categories_translations', 'paper_categories.id', '=', 'paper_categories_translations.paper_categories_id')
			->where('locale', '=', 'ru');
    }
	*/

}
