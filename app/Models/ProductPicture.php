<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Save;
use App\Models\Like;
use Auth;
class ProductPicture extends Model {
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "product_pictures";
    protected $fillable = ['product_id', 'image'];
	
    public function imagePath() {
    	return 'images/products/'.$this->image;
    }
	
    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
    
    public function saveModel() {
        return Save::where('model_name', 'ProductPicture')->where('user_id', Auth::id())->where('model_id', $this->id)->first();
    }
    public function deleteImage(){
        $file = "/images/products/".$this->image;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
    public function isLiked() {
        if (!Auth::check()) return false;
        try {
            $save = Like::where('model_name', 'ProductPicture')->where('model_id',$this->id)->where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            return false;
        }
        return isset($save);
    }
    public function isSaved() {
        if (!Auth::check()) return false;
        try {
            $save = Save::where('model_name', 'ProductPicture')->where('model_id',$this->id)->where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            return false;
        }
        return isset($save);
    }
    public function countLikes() {
        $likes = Like::where('model_name', 'ProductPicture')->where('model_id',$this->id)->where('user_id', Auth::id())->get()->count();
        return likeCountFormat($likes);
    }
}
