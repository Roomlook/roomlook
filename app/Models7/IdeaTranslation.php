<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model {

    public $timestamps = false;
    protected $table = "ideas";
    protected $fillable = ['title',
        'slug',
        'body', 'seo_keywords', 'seo_description'];

}