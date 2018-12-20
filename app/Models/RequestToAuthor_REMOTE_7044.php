<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestToAuthor extends Model {

	//
    protected $fillable = ['status'];
    public function user(){
        return $this->belongsTo('App\User');
    }

}
