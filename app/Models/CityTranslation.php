<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class CityTranslation extends Model {

    public $timestamps = false;
    protected $table = "city_translations";
    protected $fillable = ['name'];

}