<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Save;
use App\Models\Like;
use Auth;
class ProductRelationship extends Model {

    protected $table = "product_relationship";
    protected $fillable = ['name', 'project_id'];

    public function products() { 
        return $this->hasMany('App\Models\Product', 'relative_id');
    } 
	
    public function tags() { 
        return $this->belongsToMany('App\Models\TagsProductRelationship', 'product_relationship_tags');
    } 
	
    public function tags_products() { 
        return $this->belongsToMany('App\Models\ProductTagsRelationship', 'product_tags_relationship');
    } 

}
