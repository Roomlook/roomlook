<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PcategoriesProducts extends Model {

    protected $table = 'pcategories_products';
	
    public $translatedAttributes = ['pcategories_id','product_id'];
    protected $fillable = ['pcategories_id','product_id'];

	/*
    public function store() {
		return $this->belongsTo('App\Models\Store'); 
    }

    public function city() {
    	return $this->belongsTo('App\Models\City');
    } 
    */

}
