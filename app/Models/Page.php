<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Dimsav\Translatable\Translatable;
class Page extends Model {
	use Translatable;
    protected $table = 'pages';
    public $translationModel = 'App\Models\PageTranslation';
    public $translatedAttributes = ['name', 'body','seo_keywords','seo_description','slug'];
    protected $fillable = ['name','body','on_main_menu', 'on_footer_menu','seo_keywords', 'seo_description', 'slug'];

}
