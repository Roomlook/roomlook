<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
class TestController extends Controller {

	public function test(Request $request){
		dd($request->user());
	}

}
