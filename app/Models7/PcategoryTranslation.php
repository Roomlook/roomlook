<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PcategoryTranslation extends Model {

    public $timestamps = false;
    protected $table = "pcategory_translation";
    protected $fillable = ['name', 'seo_keywords', 'seo_description', 'slug'];

}