<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller {

	public function getIndex(){
		$authors = Author::latest('20')->paginate();
		return view('authors.index',compact('authors.index'));
	}

}
