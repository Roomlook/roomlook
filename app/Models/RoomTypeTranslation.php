<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RoomTypeTranslation extends Model {

    public $timestamps = false;
    protected $table = "room_type_translations";
    protected $fillable = ['name', 'seo_keywords', 'seo_description', 'slug'];

    public function roomType()
    {
    	return $this->belongsTo('App\Models\RoomType');
    }
}