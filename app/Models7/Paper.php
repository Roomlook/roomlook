<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Paper extends Model
{   
    
    use Translatable;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = "papers";
    public $translationModel = 'App\Models\PaperTranslation';
	
    public $translatedAttributes = ['name','content','picture','slug'];
    protected $fillable = ['name','content','picture','slug'];
 

}
