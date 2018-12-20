<?php namespace App\Http\Controllers\Ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Author;

use App\Models\RoomPicture;
use App\Models\Room;
use App\Models\Product;
use App\Models\Roompicturetag;
use App\Models\Like;
use App\Models\Project;
use App\Models\OwnRoom;
use App\Models\Save;
use App\Models\UploadedFile;
use App\Models\City;
use Image;
use Auth;
use Cookie;
class CommonController extends Controller {
	
	public function getLike(Request $request){
		try {
			$modelId = $request->input('model_id');
			$modelName = $request->input('model_name');
			if (!Auth::check()) {
				return response()->json(['status' => 'unauthorized']);
			}
			$like = Like::where('model_id', $modelId)
						->where('user_id',  Auth::id())
						->where('model_name', $modelName)->first();
			if (!isset($like))
				$like = Like::create(['model_id' => $modelId,
								  'user_id' => Auth::id(), 
								  'model_name' => $modelName]);
			$likeCount = likeCountFormat(Like::where('model_id', $modelId)
						->where('model_name', $modelName)->get()->count());
		} catch (Exception $e) {
			return response()->json(
				[
					'status' => 'error', 
					'message' => trans('ajax.response.error.try-later')
				]);
		}
		return response()->json(
				[
					'status' => 'success', 
					'message' => trans('ajax.response.success.ok'),
					'recount' => $likeCount
				]);
	}
	public function getAllPicture() {
		
	}
	public function getSave(Request $request){
		try {
			$data = $request->all();
	 		$ownRoom = "";
	 		if ($request->input('room-id') == 0) {
	 			$ownRooms = OwnRoom::where('name', $data['room-name'])->where('user_id', Auth::id())->get();
	 			if ($ownRooms->count() == 0)
	 				$ownRoom = OwnRoom::create(['name' => $data['room-name'], 'user_id' => Auth::id()]);
	 		} else {
	 			$ownRoom = OwnRoom::find($data['room-id']);
	 		}

			$modelId = $request->input('model_id');
			$modelName = $request->input('model_name');
			if (!Auth::check()) {
				return response()->json(['status' => 'unauthorized']);
			}
			$like = Save::where('model_id', $modelId)
						->where('user_id',  Auth::id())
						// ->where('own_room_id',  OwnRoom::where('user_id', Auth::id())->orderBy('id','desc')->first()->id)
						->where('own_room_id', $data['room-id'])
						->where('model_name', $modelName)->first();
			if (!isset($like))
				$like = Save::create(['model_id' => $modelId,
								  'user_id' => Auth::id(), 
								  // 'own_room_id' => OwnRoom::where('user_id', Auth::id())->orderBy('id','desc')->first()->id,
								  'own_room_id' => $data['room-id'],
								  'comment' => $request->comment,
								  'model_name' => $modelName]);
		} catch (Exception $e) {
			return response()->json(
				[
					'status' => 'error', 
					'message' => trans('ajax.response.error.try-later')
				]);
		}
		return response()->json(
				[
					'status' => 'success',
					'own_room_id' => $data['room-id'], 
					'message' => trans('ajax.response.success.ok')
				]);
	}
	public function getLoadRooms(Request $request)
	{
		$projects = Project::orderBy('id','DESC')->paginate(5);
		$view = 1;
		return view('welcome', compact('projects','view'));

	}
	public function getUnlike(Request $request){
		try {
			$modelId = $request->input('model_id');
			$modelName = $request->input('model_name');
			if (!Auth::check()) {
				return response()->json(['status' => 'unauthorized']);
			}
			$like = Like::where('model_id', $modelId)
						->where('user_id',  Auth::id())
						->where('model_name', $modelName)->first();
			if (!isset($like)) throw new Exception("Нет лайка!");
		} catch (Exception $e) {
			return response()->json(
				[
					'status' => 'error', 
					'message' => trans('ajax.response.error.try-later')
				]);
		}
		$like->delete();
		$likeCount = likeCountFormat(Like::where('model_id', $modelId)
						->where('model_name', $modelName)->get()->count());
			
		return response()->json(
				[
					'status' => 'success', 
					'message' => trans('ajax.response.success.ok'),
					'recount' => $likeCount
				]);
	}
	public function getUnsave(Request $request){
		try {
			$modelId = $request->input('model_id');
			$modelName = $request->input('model_name');
			if (!Auth::check()) {
				return response()->json(['status' => 'unauthorized']);
			}
			$like = Save::where('model_id', $modelId)
						->where('user_id',  Auth::id())
						->where('model_name', $modelName)->first();
			if (!isset($like)) throw new Exception("Не сохранен!");
		} catch (Exception $e) {
			return response()->json(
				[
					'status' => 'error', 
					'message' => trans('ajax.response.error.try-later')
				]);
		}
		$like->delete();
		return response()->json(
				[
					'status' => 'success', 
					'message' => trans('ajax.response.success.ok')
				]);
	}
	public function getPopup(Request $request) {
		$type = $request->input('type');
		if ($type == 'room') {

			$pictureId = $request->input('picture_id');
			$picture = RoomPicture::find($pictureId);
			if ($picture == NULL)
				return 'Ошибка';
			$room = $picture->room;
			return view('partials.popup-room', compact('picture','room'));
		} else if ($type == 'pictures') {
			$pictureId = $request->input('picture_id');
			$picture = RoomPicture::find($pictureId);
			$project = $picture->room->project;
			if ($picture == NULL)
				return 'Ошибка';
			$room = $picture->room;
			return view('partials.popup-picture', compact('picture','project','room'));
		} else  {
			$pictureId = $request->input('picture_id');
			$picture = RoomPicture::find($pictureId);
			if ($picture == NULL)
				return 'Ошибка';
			$project = $picture->room->project;
			$room = $picture->room;
			return view('partials.popup-project', compact('picture','project', 'room'));
		}
	}
	public function getPopupproduct(Request $request) {
		$type = $request->input('type');
		if ($type == 'product') {
			$productId = $request->input('product_id');
			$product = Product::find($productId);
			return view('partials.popup-product', compact('product'));
		}
	}
	public function getSavePosition(Request $request) {
		$url = $request->url;
		$top = $request->top;
		$divider = "?";
		if (strpos($url, "?") > 0) {
			$divider = "&";
		}
		$url = $url.$divider."top=".$top;
		return response()->json(['status' => 'success', 'url' => $url])->withCookie(cookie()->forever('room_save_position', $url));
	}
	public function getRemovePosition(Request $request) {
		return response()->json(['status' => 'success'])->withCookie(cookie()->forget('room_save_position'));
	}
	public function getRp(Request $request, $width) {
		$image = Image::make(public_path().'/'.$request->image_path);

		$image->resize($width, null, function ($constraint) {
		    $constraint->aspectRatio();
		});
		return $image->response();
	}
	// public function getResizePictures() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','>',333)->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }

	// public function getResizePictures2() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','>',333)->orderBy('id','DESC')->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }
	// public function getResizePictures3() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','>',1000)->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }
	// public function getResizePictures4() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','<=',1000)->orderBy('id','DESC')->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }
	// public function getResizePictures5() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','>',750)->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	
	// 	return "success";
	// }
	// public function getResizePictures6() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','<=',500)->orderBy('id','DESC')->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }
	// public function getResizePictures7() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','>',500)->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }
	// public function getResizePictures8() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','>',1200)->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	
	// 	return "success";
	// }
	// public function getResizePictures9() {
	// 	ini_set('max_execution_time', 1000000000);
 //        ini_set('memory_limit', '-1');
	// 	$pictures = RoomPicture::where('id','<=',1200)->orderBy('id','DESC')->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// 	return "success";
	// }
	// public function getResizePictures10() {
	// 	$pictures = RoomPicture::where('id','<=',1200)->orderBy('id','DESC')->get();
	// 	foreach ($pictures as $picture) {
	// 		echo $picture->imagePath();
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
			
	// 		$image->resize(1600, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/lg/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(800, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/md/'.$picture->image));
	// 		$image = Image::make(public_path().'/'.$picture->imagePath());
	// 		$image->resize(200, null, function ($constraint) {
	// 		    $constraint->aspectRatio();
	// 		});
	// 		$image->save(public_path('images/rooms/sm/'.$picture->image));

	// 	}
	// }
	public function getDefinePicture() {
		$pictures = RoomPicture::all();
		foreach ($pictures as $picture) {
			
			try {
				$file_handle = @getimagesize($picture->imagePath());
				if (!$file_handle) {
			         throw new \Exception('Failed to open uploaded file');
			    }
			    list($width, $height) = $file_handle;
				if ($width - $height >= 0) {
					$picture->is_landscape = 1;
					$picture->save();
				}
			} catch (\Exception $e) {
				continue;
			}
			

		}
	}
	function getDoesntLoad() {
        $roompictures = RoomPicture::all();
        $imgs = "";
        $imgs2 = "";
        $imgs3 = "";
        foreach ($roompictures as $picture) {
	        if (file_exists($picture->imagePath())) {
	            $imgs .= $picture->id.": ".public_path($picture->imagePath())."<br/>";
	        } else {
	        	try {
	        		// if ('/var/www/roomlook.com/public/images/rooms/original/773bfc8cac746962d44838db3b80868bfac3a48d.jpg' == public_path($picture->imagePath("")) && '/var/www/roomlook.com/public/images/rooms/original/8e2775d9c32a22559474ec6464e4cd6a21fd146e.jpg' == public_path($picture->imagePath()))
	        		// 	continue;
	        		// if (\File::copy($picture->imagePath("md/"), $picture->imagePath("") )) {
	          //   		$imgs3 .= $picture->id.": ".public_path($picture->imagePath(""))."<br/>";
		         //    }
		            $imgs2 .= $picture->id.": ".$picture->imagePath()."<br/>";
	        	} catch (Exception $e) {
	        		continue;
	        	}
	        	

	        }

        }
        return $imgs;
    }
    public function getProductInfo(Request $request, $id) {
    	$ctag = Roompicturetag::find($request->tag_id);
    	$product = Product::find($id);
    	$products = [];
    	if ($product->relative)
    		$products = $product->relative->products;
    	return response()->json(['html' => view('partials.product-info', compact('product', 'ctag', 'products'))->render(), 'p_id' => $id]);
    }
 	public function getDesignersPicture() {
 		$authors = Author::all();
 		$checker = false;
 		foreach ($authors as $author) {
 			$checker = false;
 			foreach ($author->projects as $project) {
 				if ($checker)
 					break;
 				foreach ($project->rooms as $room) {
 					if ($checker)
 						break;
 					foreach($room->pictures as $picture) {
 						if ($checker)
 							break;
 						if ($picture->is_landscape == 1) {
 							$author->main_image = $picture->image;
 							$author->save();
 							$checker = true;
 						}
 					}
 				}
 			}
 		}
 		return "OK";
 	}
 	public function getSessionD(){
 		return dd(session('city_id'));
 	}
 	public function getEditComment(Request $request) {
 		try {
 			$save = Save::find($request->save_id);
	 		$save->comment = $request->comment;
	 		$save->save();
 		} catch (Exception $e) {
 			return "fail";
 			
 		}
 		return "save";
 	}
 	public function getEditCommentUploaded(Request $request) {
 		try {
 			$save = UploadedFile::find($request->uploaded_id);
	 		$save->comment = $request->comment;
	 		$save->save();
 		} catch (Exception $e) {
 			return "fail";
 			
 		}
 		return "save";
 	}
}
