<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roompicturetag extends Model {

    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "room_picture_tag";
    protected $fillable = ['room_picture_id', 'percent_top', 'percent_left', 'product_id', 'is_relative'];
    
    public function product() {
    	return $this->belongsTo('App\Models\Product');
    }
    public function picture() {
    	return $this->belongsTo('App\Models\RoomPicture','room_picture_id');
    }

}
