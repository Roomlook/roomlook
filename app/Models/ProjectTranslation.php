<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProjectTranslation extends Model {

    public $timestamps = false;
    protected $table = "project_translations";
    protected $fillable = ['name', 'cropimage', 'is_active', 'description', 'short_desc', 'seo_keywords', 'slug']; 

    public function project()
    {
    	return $this->belongsTo('App\Models\Project');
    }
} 