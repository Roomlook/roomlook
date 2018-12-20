<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Dimsav\Translatable\Translatable;

class Tag extends Model {
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use Translatable;
	 
	protected $table = "tags";
    public $translationModel = 'App\Models\TagTranslation';
	
    public $translatedAttributes = ['title', 'body', 'tag_group_id'];
    protected $fillable = ['title', 'body', 'tag_group_id'];
     
}
