<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';
    protected $fillable = ['user_id','schema','own_room_id','status','name','email','phone','square','height'];
    public function user() {
    	return $this->belongsTo('App\User');
    }
    public function own() {
    	return $this->belongsTo('App\Models\OwnRoom', 'own_room_id');
    }

}
