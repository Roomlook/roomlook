<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Myroom;
use App\Models\Like;
use App\Models\RoomPicture;
use App\Models\OwnRoom;
use App\Models\UploadedFile;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Image;
class OrderController extends Controller {
	
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getIndex(){
		$user = Auth::user();
		// dd($user);
		return view('frontend.order.index',compact('user'));
	}
	
	
	public function getCheckout(Request $request){
		$own = OwnRoom::find($request->own_room_id);

		return view('frontend.order.checkout', compact('own'));
	}
	
	public function postCheckout(Request $request){
		$user = Auth::user();
		$data = $request->all();
		if (!$user->charge(2000,  [
			'source' => $request->stripeToken,
    		'receipt_email' => $user->email]))
		{
		    return redirect()->back()->with('data', ['some kind of data']);
		}
		$order = new Order;
		$order->name  = $request->name;
		$order->phone = $request->phone;
		$order->email = $request->email;
		$order->square  = $request->square;
		$order->height  = $request->height;
		$order->user_id  = $request->user()->id;
		$order->own_room_id  = $request->own_room_id;
		unset($data['schema']);
        if($request->hasFile('schema')){
            $file = $request->file('schema');
            $image = Image::make($file->getRealPath());
            $filename  = time() . '.' . $file->getClientOriginalExtension();
            $image->save(public_path('images/order/'.$filename ));
        }
		$order->schema  = $filename;
		$order->save();
		
		return redirect()->to('/myroom');
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
