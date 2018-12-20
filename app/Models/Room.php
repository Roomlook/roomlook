<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\RoomPicture;
use Dimsav\Translatable\Translatable;
class Room extends Model {
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use Translatable; 
	protected $table = "rooms";
    public $translationModel = 'App\Models\RoomTranslation';
    public $translatedAttributes = ['title', 'body'];
    protected $fillable = ['title', 'in_main', 'body', 'status_id', 'project_id', 'slug', 'room_type_id', 'position'];
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    public function likes() {
    	return Like::where('model_name','Room')->where('model_id',$this->id);
    }
    public function countLikes() {
    	return count($this->likes()->get());
    }
    public function pictures() {
        return $this->hasMany('App\Models\RoomPicture');
    }
    public function roomType() {
        return $this->belongsTo('App\Models\RoomType');
    }
    
    public static function popular() {
        $roomIds = Like::where('model_name','Room')->groupBy('model_id')->having('model_id','>',1)->lists('id');
        return Room::whereIn('id', $roomIds)->take(5);
    }
    public function styles(){
        return $this->belongsToMany('App\Models\Style','style_room');
    }
}
