<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Dimsav\Translatable\Translatable;
class Product extends Model {
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
	use Translatable;
    protected $table = 'products';
    public $translationModel = 'App\Models\ProductTranslation';
    public $translatedAttributes = ['name', 'short_body','slug'];
    protected $fillable = ['name', 'short_body','slug','is_wide', 'manufacturer_id','image','pcategory_id', 'relative_id'];
    public function imagePath() {
        if ($this->pictures->count() > 0)
            return $this->pictures()->first()->imagePath();
        return "";
    }
    public function store_cities() {
        return $this->belongsToMany('App\Models\StoreCity','store_city_product');
    }
    public function stores(){
        return $this->belongsToMany('App\Models\Store','store_product');
    }
    public function sections(){
        return $this->belongsToMany('App\Models\Section','section_product');
    }
    
    public function relative() {
        return $this->belongsTo('App\Models\ProductRelationship');        
    }
    public function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer');
    }
    public function deleteImage(){
        $file = "/images/products/".$this->image;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
    public function tags() {
        return $this->hasMany('App\Models\Roompicturetag');
    }
    public function cities() {
        return $this->belongsToMany('App\Models\City','product_city');
    }
    public function isLiked() {
        if (!Auth::check()) return false;
        try {
            $save = Like::where('model_name', 'Product')->where('model_id',$this->id)->where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            return false;
        }
        return isset($save);
    }
    public function isSaved() {
        if (!Auth::check()) return false;
        try {
            $save = Save::where('model_name', 'Product')->where('model_id',$this->id)->where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            return false;
        }
        return isset($save);
    }
    public function pictures() {
        return $this->hasMany('App\Models\ProductPicture');
    }
    public static function lists($column,$key = null)
    {
        return Product::leftJoin('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->where('locale', '=', 'ru')->lists($column,'product_translations.product_id');
    }
    public function pcategory() {
        return $this->belongsTo('App\Models\Pcategory');
    }
    public function countLikes() {
        $likes = Like::where('model_name', 'Product')->where('model_id',$this->id)->where('user_id', Auth::id())->get()->count();
        return likeCountFormat($likes);
    }
    public function saveModel() {
        return Save::where('model_name', 'Product')->where('user_id', Auth::id())->where('model_id', $this->id)->first();
    }
  
}
