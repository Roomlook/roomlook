<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model {

    protected $table = 'order_model';
    protected $fillable = ['order_id','model_id','model_name'];
    

}
