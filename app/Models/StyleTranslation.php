<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StyleTranslation extends Model {

    public $timestamps = false;
    protected $table = "styles_translations";
    protected $fillable = ['name', 'slug'];

    public function style()
    {
    	return $this->belongsTo('App\Models\Style');
    }
}