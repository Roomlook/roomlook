<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Paper extends Model
{   
    
    use Translatable;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "papers";
    public $translationModel = 'App\Models\PaperTranslation';
	
    public $translatedAttributes = ['name','anons','content','home','views','images','images2','tags','category_id','categories','slug'];
    protected $fillable = ['name','anons','content','views','images','images2','tags','category_id','categories','slug']; 
  
    public static function categories()
    {
        return Paper::leftJoin('paper_translations', 'papers.id', '=', 'paper_translations.paper_id')
            ->where('locale', '=', 'ru')
			->lists($column,'paper_translations.name','paper_translations.paper_id');
    }
	
    public static function papers()
    {
        return Paper::leftJoin('paper_translations', 'papers.id', '=', 'paper_translations.paper_id')
			->leftJoin('paper_categories', 'papers.id', '=', 'paper_categories.id')
            ->where('locale', '=', 'ru');
    }
	
    public static function lists($column,$key = null)
    {
        return Paper::leftJoin('paper_translations', 'papers.id', '=', 'paper_translations.paper_id')
            ->where('locale', '=', 'ru')
			->lists($column,'paper_translations.name','paper_translations.paper_id');
    }
	 
}
