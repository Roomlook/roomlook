<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AuthorTranslation extends Model {

    public $timestamps = false;
    protected $table = "author_translations";
    protected $fillable = ['about', 'anons', 'city', 'seo_keywords', 'seo_description'];

}