<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Store extends Model {
    
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use Translatable;
    protected $table = 'stores';
    public $translationModel = 'App\Models\StoreTranslation';
    public $translatedAttributes = ['name', 'short_description','address' , 'body','slug'];
    protected $fillable = ['name','city_id','short_description','address','body','phone','email','url', 'longitude', 'latitude', 'logo', 'image', 'is_show', 'slug'];
    public static function lists($column, $key = null){
        return Store::leftJoin('store_translations', 'stores.id', '=', 'store_translations.store_id')
            ->where('locale', '=', 'ru')->lists($column,'store_translations.store_id');
    }
    public function image2Path() {
        return "images/stores/".$this->image;
    }
    public function imagePath() {
        return "images/stores/".$this->logo;
    }
    public function delete2Image(){
        $file = "/images/stores/".$this->image;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
    public function deleteImage(){
        $file = "/images/stores/".$this->logo;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
    public function cities() {
        return $this->belongsToMany('App\Models\City','store_city')->withPivot('id','address_en', 'address_ru');
    }
    public function products(){
        return $this->belongsToMany('App\Models\Product','store_product');
    }
    public function categories() {
        $products = $this->products()->distinct('pcategory_id')->lists('pcategory_id');
        return Pcategory::whereIn('id', $products);
    }
    public function brands() {
        $products = $this->products()->distinct('manufacturer_id')->lists('manufacturer_id');
        return Manufacturer::whereIn('id', $products);
    }
}
