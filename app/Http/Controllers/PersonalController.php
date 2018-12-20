<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PersonalController extends Controller {
	
	public function getSettings(Request $request){
		$user = $request->user();
		return view('personal.settings')->with('user',$user);
	}
	public function postSettings(Request $request){

	}
	public function postChangePassword(Request $request){

	}
	public function postAuthorData(Request $request){

	}
}
