<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRoom extends Model {

    protected $table = 'product_room';
	
    public $translatedAttributes = ['product_id','room_id'];
    protected $fillable = ['product_id','room_id'];

	/*
    public function store() {
		return $this->belongsTo('App\Models\Store'); 
    }

    public function city() {
    	return $this->belongsTo('App\Models\City');
    }
    */ 

}
