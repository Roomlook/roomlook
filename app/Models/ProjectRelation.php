<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Save;
use App\Models\Like;
use Auth;
class ProjectRelation extends Model {

    protected $table = "project_relations";
    protected $fillable = ['name'];

    public function projects() {
        return $this->hasMany('App\Models\Project', 'project_relations_id');
    }

}
