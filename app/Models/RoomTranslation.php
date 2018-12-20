<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; 
class RoomTranslation extends Model {

    public $timestamps = false;
    protected $table = "room_translations";
    protected $fillable = ['title', 'body', 'slug']; 

}