<?php namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\RequestToAuthor;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;
use Pingpong\Admin\Uploader\ImageUploader;
use Validator;
use App\Helpers\Image as ImageHelper;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getSettings(Request $request){
		$user = $request->user();
		return view('home.settings',compact('user'));
	}
	public function putSettings(Request $request){
		$request->user()->update($request->all());
		return redirect(url('/home'));
	}
	public function getProjects(Request $request){
		$projects = Project::all();
		dd($projects);
		return view('home.projects',compact('projects'));
	}
	public function getRequestToAuthors(Request $request){
		$requestToAuthors = new RequestToAuthor();
		$requestToAuthors->user_id = $request->user()->id;
		$requestToAuthors->status = 'waiting';
		$requestToAuthors->save();
		return response()->json('success');
	}

	public function getChangePassword(Request $request){
		return view('home.change-password');
	}
	public function postChangePassword(Request $request){
		dd($request->all());
	}
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		return redirect('/f/myroom');
		$user = $request->user();
		return view('home',compact('user'));
	}

	public function getMyRooms(Request $request){
		$author = $request->user()->author;
		$rooms = $author->rooms();
		return view('personal.my-rooms',['author'=>$author,'rooms'=>$rooms]);
	}

	public function getAddRoom(){
		return view('personal.add-room');
	}
	public function postAddRoom(Request $request){
		$room = new Room();
		$room->title = $request->title;
		$room->description = $request->description;
		$room->author_id = $request->user()->author->id;

		$rules = [
			'title' => 'required',
			'images' => 'required'
		];
		$validator = Validator::make($request->all(), $rules);
		if($validator->fails()){
			$this->throwValidationException(
				$request, $validator
			);
		}
		$request_images = $request->files->get('images');
		$room->save();
		foreach ($request_images as $file) {
			$originalName = $file->getClientOriginalName();
			$originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - 4);
			$filename = ImageHelper::sanitize($originalNameWithoutExt);
			$allowed_filename = ImageHelper::createUniqueFilename( $filename );
			$filenameExt = $allowed_filename .'.jpg';
			$imgModel = new Image();
			$imgModel->original_name = $originalName;
			$imgModel->filename = $filenameExt;
			$imgModel->room_id = $room->id;
			$imgModel->save();
		}
		dd($request->all());
	}

	public function getFavours(Request $request){
		$favours = collect();
		return view('home.favours',compact('favours'));
	}
	public function getSaves(Request $request){
		$saves = collect();
		return view('home.saves',compact('saves'));
	}
	public function postChangeAvatar(ImageUploader $imageUploader,Request $request){
		if($request->hasFile('avatar')){
			$path = '/images/avatars/';
			$imageUploader->upload('avatar')->save($path);
			$request->user()->avatar = $path.$imageUploader->getFilename();
			$request->user()->save();
			return response($request->user()->avatar,200);
		}else{
			return response('not found image',420);
		}
	}
	public function postChangeCover(Request $request){
		$request->user()->cover = $request->cover;
		return response('ok',200);
	}
}
