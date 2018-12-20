<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class ManufacturerTranslation extends Model {

    public $timestamps = false;
    protected $table = "manufacturer_translations";
    protected $fillable = ['name', 'body', 'slug'];

}