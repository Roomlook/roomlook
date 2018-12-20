<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model {

    protected $table = 'saves';
    protected $fillable = ['user_id','model_id','model_name','comment','own_room_id'];

}
