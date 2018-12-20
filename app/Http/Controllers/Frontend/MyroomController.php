<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Myroom;
use App\Models\Like;
use App\Models\RoomPicture;
use App\Models\OwnRoom;
use App\Models\UploadedFile;
use App\Models\Product;
use Auth;
use Image;
class MyroomController extends Controller {
	
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getIndex(){
		$user = Auth::user();
		// dd($user);
		if ($user) {
			$LastModified = $user->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view('frontend.myroom.index',compact('user'))->header('Last-Modified', $LastModified);
		}
		return response()->view('frontend.myroom.index',compact('user'));
	}
	public function getVisualization(Request $request) {
		$ownRoom = OwnRoom::find($request->myroom);
		if ($ownRoom) {
			$LastModified = $ownRoom->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view('frontend.myroom.visualization', compact('ownRoom'))->header('Last-Modified', $LastModified);
		}
		return response()->view('frontend.myroom.visualization', compact('ownRoom'));
	}
	public function getCreateRoom(Request $request) {
		$data['name'] = $request->name;
		$data['user_id'] = Auth::id();
		if (OwnRoom::where('name', $data['name'])->get()->count() > 0) {
			return back();
		}
		$ownRoom = OwnRoom::create($data);
		return back();
	}
	public function getRoom($id) {
		$ownRoom = OwnRoom::find($id);
		return view('frontend.myroom.single', compact('ownRoom'));
	}
	public function postChangeAvatar(Request $request) {
		$file = $request->file('avatar');
		$image = Image::make($file->getRealPath());
        $filename  = time() . '.' . $file->getClientOriginalExtension();
        $image->save(public_path('images/rooms/'.$filename ));
        $user = Auth::user();
        $user->image = $filename;
        $user->save();
        return back();
	}
	public function postFrompc(Request $request) {
		$data = $request->all();
        unset($data['image']);
        $filename = "";
        // dd($request);
        // dd($request->hasFile('image'));
        if($request->hasFile('image')){
            $file = $request->file('image');
            // return dd($file);
            $image = Image::make($file->getRealPath());
            $filename  = time() . '.' . $file->getClientOriginalExtension();
            $image->save(public_path('images/rooms/'.$filename ));
           
        }
        if ($filename == "") return back();
        $uploadedFile = new UploadedFile;
        $uploadedFile->path = $filename;
        $uploadedFile->own_room_id = $request->own_room_id;
        $uploadedFile->save();
		return back();
	}
	public function deleteRoom(Request $request, $id) {
		$ownRoom = OwnRoom::find($id);
		if ($ownRoom) {
			if ($ownRoom->user_id != $request->user()->id) {
				return redirect('/');
			}
			$ownRoom->delete();
		}
		return back()->header("Cache-Control", "no-store,no-cache, must-revalidate, post-check=0, pre-check=0");
	} 
	public function postFromlink(Request $request) {
		$data = $request->all();
        unset($data['image']);
        $filename = "";
        // dd($request);
        // dd($request->hasFile('image'));
        $image = Image::make($request->link);
        $path_parts = pathinfo($request->link);
        $filename  = time() . '.' . $path_parts['extension'];
        $image->save(public_path('images/rooms/'.$filename ));       
        if ($filename == "") return back();
        $uploadedFile = new UploadedFile;
        $uploadedFile->path = $filename;
        $uploadedFile->own_room_id = $request->own_room_id;
        $uploadedFile->save();
		return back();
	}
	
	
	// public function postUploadFromLink(Request $request) {
	// 	$data = $request->all();
 //        unset($data['image']);
 //        if($request->hasFile('image')){
 //            $file = $request->file('image');
 //            $image = Image::make($request->link);
 //            $filename  = time() . '.' . $file->getClientOriginalExtension();
 //            $image->save(public_path('images/uploads/'.$filename ));
           
 //        }
 //        $uploadedFile = new UploadedFile;
 //        $uploadedFile->path = $filename;
 //        $uploadedFile->own_room_id = $request->own_room_id;
 //        $uploadedFile->save();
	// 	return back();
	// }
	
}
