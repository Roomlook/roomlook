<?php namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class TagsProductRelationship extends Model {

    protected $table = 'product_relationship_tags';
	
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
