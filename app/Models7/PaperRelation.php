<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Save;
use App\Models\Like;
use Auth;

class PaperRelation extends Model {

    protected $table = "paper_relations";
    protected $fillable = ['name','content','picture','slug'];
 
}
