<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TagTranslation extends Model {

    public $timestamps = false;
    protected $table = "tag_translations";
    protected $fillable = ['title', 'body', 'tag_group_id'];

    public function tags() { 
        //return $this->hasMany('App\Models\Tag', 'relative_id');
    } 
	
}