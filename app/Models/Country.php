<?php namespace App\Models;
use App\User;
use App\CountryTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Dimsav\Translatable\Translatable;
class Country extends Model {
    use Translatable;
    protected $table = 'countries';
    public $translationModel = 'App\Models\CountryTranslation';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'iso_code'];

   
    public static function lists($column,$key = null)
    {
        return Country::leftJoin('country_translations', 'countries.id', '=', 'country_translations.country_id')
            ->where('locale', '=', 'ru')->lists($column,'country_translations.country_id');
    }
    public function cities() {
        return $this->hasMany('App\Models\City')->orderBy('is_capital','DESC')->whereHas('translations', function($q) {
            $q->orderBy('name');
        });
    }
}
