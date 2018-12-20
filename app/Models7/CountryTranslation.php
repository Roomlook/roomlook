<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CountryTranslation extends Model {

    public $timestamps = false;
    protected $table = "country_translations";
    protected $fillable = ['name'];

    public static function getCountryTranslations($country_id){
        return CountryTranslation::where('country_id','=',$country_id)->get();
    }
}