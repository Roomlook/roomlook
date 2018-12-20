<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Dimsav\Translatable\Translatable;

class Test extends Model {
	
	use Translatable;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'products';
    public $translationModel = 'App\Models\ProductTranslation';
	
    public $translatedAttributes = ['name', 'slug'];
    protected $fillable = ['name', 'slug'];
  
}
