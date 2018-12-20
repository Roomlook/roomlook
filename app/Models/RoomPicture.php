<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Save;
use App\Models\Like;
use Auth;
class RoomPicture extends Model {
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = "room_pictures";
    protected $fillable = ['room_id', 'image', 'original_image', 'is_landscape', 'is_home_slider'];
	
    public function imagePath($size = "md/") {  
        if ($size == "")
            return 'images/rooms/original/'.$this->original_image;
        return 'images/rooms/'.$size.$this->image;
    }
	
    public function room() {
        return $this->belongsTo('App\Models\Room');
    }
    public function tags() {
       
        return $this->hasMany('App\Models\Roompicturetag','room_picture_id')->whereHas('product',function($q) {
            /*$q->whereHas('store_cities', function($qq) {
                $qq->whereHas('city', function($qqq) {
                    $qqq->where('id', session('city_id'));

                });
            }); */
        });
    }
    public function allTags() {
        return $this->hasMany('App\Models\Roompicturetag','room_picture_id');
    }
    public function saveModel() {
        return Save::where('model_name', 'RoomPicture')->where('user_id', Auth::id())->where('model_id', $this->id)->first();
    }
    public function deleteImage(){
        $file = "/images/rooms/".$this->image;
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return false;
    }
    public function isLiked() {
        if (!Auth::check()) return false;
        try {
            $save = Like::where('model_name', 'RoomPicture')->where('model_id',$this->id)->where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            return false;
        }
        return isset($save);
    }
    public function isSaved() {
        if (!Auth::check()) return false;
        try {
            $save = Save::where('model_name', 'RoomPicture')->where('model_id',$this->id)->where('user_id', Auth::id())->first();
        } catch (Exception $e) {
            return false;
        }
        return isset($save);
    }
    public function countLikes() {
        $likes = Like::where('model_name', 'RoomPicture')->where('model_id',$this->id)->where('user_id', Auth::id())->get()->count();
        return likeCountFormat($likes);
    }
    public function getWidth($h = 0, $size = 'md/') {
        try {
             $file_handle = @getimagesize($this->imagePath($size));
             if (!$file_handle) {
                  throw new \Exception('Failed to open uploaded file');
             }
             list($width, $height) = $file_handle;
             
            if ($h == 0)
                return  $width;
            $prop = $h/$height;
            return $width*$prop;
         } catch (\Exception $e) {
             return 0;
         }
    }
    public function getThumbHeight() {
        if ($this->is_landscape == 1) {
            return $this->getHeight(1118);
        }
        return 570;
    }
    public function getThumbWidth() {
        if ($this->is_landscape == 1) {
            return 1118;
        }
        return $this->getWidth(570);
    }
    public function getHeight($w = 0, $size = 'md/') {
        try {
             $file_handle = @getimagesize($this->imagePath($size));
             if (!$file_handle) {
                  throw new \Exception('Failed to open uploaded file');
             }
             list($width, $height) = $file_handle;
             
            if ($w == 0)
                return  $height;
            $prop = $w/$width;
            return $height*$prop;
         } catch (\Exception $e) {
             return 0;
         }
    }
}
