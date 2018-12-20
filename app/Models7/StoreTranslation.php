<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StoreTranslation extends Model {

    public $timestamps = false;
    protected $table = "store_translations";
    protected $fillable = ['name', 'short_description','address', 'body', 'slug'];

}