<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ArticleTranslation extends Model {

    public $timestamps = false;
    protected $table = "article_translations";
    protected $fillable = ['title',
        'slug',
        'body', 'seo_keywords', 'seo_description'];

}