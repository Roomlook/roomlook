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

}
