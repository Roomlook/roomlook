<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class PageTranslation extends Model {

    public $timestamps = false;
    protected $table = "page_translations";
    protected $fillable = ['name', 'body','seo_keywords','seo_description','slug'];

}