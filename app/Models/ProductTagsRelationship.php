<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTagsRelationship extends Model {

    protected $table = 'product_tags_relationship';
	
    public $translatedAttributes = ['product_relationship_id','tags_products_id'];
    protected $fillable = ['product_relationship_id','tags_products_id'];

	/*
    public function store() {
		return $this->belongsTo('App\Models\Store'); 
    }

    public function city() {
    	return $this->belongsTo('App\Models\City');
    }
    */

}
