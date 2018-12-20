<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Dimsav\Translatable\Translatable;

class City extends Model {
	use Translatable;
    protected $table = 'cities';
    public $translationModel = 'App\Models\CityTranslation';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'country_id','is_capital'];

    public static function lists($column,$key = null)
    {
        return City::leftJoin('city_translations', 'cities.id', '=', 'city_translations.city_id')
            ->where('locale', '=', 'ru')->lists($column,'city_translations.city_id');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function stores() {
        return $this->belongsToMany('App\Models\Store', 'store_city')->withPivot('address_en', 'address_ru');
    }
    public static function getCurrent() {
        if (session('city_id')) {
            $city = City::find(session('city_id'));
            return $city->name;
        }
        return City::first()->name;
    }

}
