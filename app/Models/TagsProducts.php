<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsProducts extends Model {

    protected $table = 'product_tags';
	
    public $translatedAttributes = ['product_id','tag_id'];
    protected $fillable = ['product_id','tag_id'];

	/*
    public function store() {
		return $this->belongsTo('App\Models\Store'); 
    }

    public function city() {
    	return $this->belongsTo('App\Models\City');
    }
    */ 

}
