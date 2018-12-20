<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $table = 'reviews';
    protected $fillable = ['user_id','author_id','text'];
    public function user() {
    	return $this->belongsTo('App\User');
    }

}
