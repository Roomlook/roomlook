<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CategoryTranslation extends Model {

    public $timestamps = false;
    protected $table = "category_translations";
    protected $fillable = ['name', 'slug','description'];

}