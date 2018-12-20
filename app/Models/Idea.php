<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model {

	protected $fillable = [
		'title',
		'body',
		'main_image',
		'category',
		'short_desc',
		'link_text',
		'position',
		'size',
		'in_main',
		'styles',
		'classes'
	];

}
