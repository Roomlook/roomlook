<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperTranslation extends Model {

    public $timestamps = false;
    protected $table = "paper_translations";
    protected $fillable = ['name','content','picture','slug'];

}