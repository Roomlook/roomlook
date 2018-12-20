<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProductTranslation extends Model {

    public $timestamps = false;
    protected $table = "product_translations";
    protected $fillable =  ['name', 'short_description','slug'];

}