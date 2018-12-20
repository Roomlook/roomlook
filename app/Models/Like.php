<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $table = 'likes';
    protected $fillable = ['user_id','model_id','model_name'];
    

}
