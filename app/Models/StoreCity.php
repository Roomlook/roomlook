<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreCity extends Model {

    protected $table = 'store_city';
    public $translatedAttributes = ['store_id', 'city_id','address_ru' , 'address_en'];
    protected $fillable = ['store_id', 'city_id'];

    public function store() {
		return $this->belongsTo('App\Models\Store'); 
    }

    public function city() {
    	return $this->belongsTo('App\Models\City');
    }
    

}
