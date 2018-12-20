<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnRoom extends Model {
    protected $table = "own_rooms";
    protected $fillable = ['name', 'user_id'];
   
    public function roomPictures() {
		return $this->roomPics()->get();
    }
    public function productPictures() {
        $pics = $this->productPics();
        // if ($pics != null)
            return $pics->get();

        return ;
    }
    public function roomPics() {
        $roomPictureIds = Save::where('own_room_id', $this->id)->where('model_name', 'RoomPicture')->lists('model_id');
        $roomPictures = RoomPicture::whereIn('id',$roomPictureIds);
        return $roomPictures;
    }
    public function productPics() {
        $productIds = Save::where('own_room_id', $this->id)->where('model_name', 'Product')->lists('model_id');

        $products = Product::whereIn('id',$productIds);
        return $products;
    }
    // public function commentRoom() {
    //     // return Save::where('own_room_id', $this->id)->where('model_name', 'ProductPicture')->comment;
        
    // }
    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function uploadedFiles() {
        return $this->hasMany('App\Models\UploadedFile');
    }
}
