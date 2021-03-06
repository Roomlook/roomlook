<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomTranslation;
use App\Models\StyleTranslation;
use App\Models\RoomTypeTranslation;
use App\Models\Style;
use App\Models\RoomType;
class RoomController extends Controller {
	
	public function getIndex(Request $request)
    {
    	$rooms = Room::where('id','>','0');
		$roomTypes = RoomType::all();
		$styles = Style::all();
		$appends = array();
      	if (!$request->has('room_style_id') && !$request->has('room_type_id')) {
			if ($roomTypes->first()) {
				$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
	            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
	                return response( 'Not Modified', 304);

				return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'))->header('Last-Modified', $LastModified);
			}
			return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'));
			
		}
		if ($request->has('room_type_id')) {
			$appends['room_type_id'] = $request->room_type_id;
			$type = RoomTypeTranslation::find($request->room_type_id)->slug;
		}
		else {
			$type = 0;
		}
		if ($request->has('room_style_id')) {
			$appends['room_style_id'] = $request->room_style_id;
			$style = StyleTranslation::where('style_id', $request->room_style_id)->first()->slug;
			return redirect('/room/'.$type.'/'.$style);
		}
		return redirect('/room/'.$type);
    }

    public function makeSlug()
    {
      $rts = RoomTranslation::all();
      foreach ($rts as $rt) {
        $rt->slug = str_slug($rt->title, '_');
        $rt->save();
      }
      $stls = StyleTranslation::all();
      foreach ($stls as $stl) {
        $stl->slug = str_slug($stl->name, '_');
        $stl->save();
      }
      $tps = RoomTypeTranslation::all();
      foreach ($tps as $tp) {
        $tp->slug = str_slug($tp->name, '_');
        $tp->save();
      }
      return 0;
    }

	public function redirectRoom(Request $request, $type, $style = null) {
		
		$rooms = Room::where('id','>','0');
		$roomTypes = RoomType::all();
		$styles = Style::all();
		$appends = array();
		
		if ($request->has('view'))
			$appends['view'] = $request->view;
		
		// if (!$request->has('room_style_id') && !$request->has('room_type_id')) {
		// if ($roomTypes->first()) {
		// 		$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
		//      // if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
		//      //     return response( 'Not Modified', 304);

		// 		return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'))->header('Last-Modified', $LastModified);
		// }
		// return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'));
			
		// }
		  
		if (isset($style)) {
			$ids = StyleTranslation::where('slug', $style)->first()->style_id;
			$rooms = $rooms->whereHas('styles', function($q) use ($ids) {
                $q->where('id', $ids);
            });
			$appends['style'] = $style;
			$appends['room_style_id'] = $ids;
		}
		
		if($request->input('room_type_id')) {
			
			$id = RoomTypeTranslation::where('room_type_id', $request->input('room_type_id'))->first()->room_type_id;
			$rooms = $rooms->where('room_type_id', $request->input('room_type_id'));
			$appends['type'] = $type;
			$appends['room_type_id'] = $id;
			
			
		}else if (isset($type) and $type == 0) {
			
			$id = RoomTypeTranslation::where('slug', $type)->first()->room_type_id;
			$rooms = $rooms->where('room_type_id', $id);
			$appends['type'] = $type;
			$appends['room_type_id'] = $id;
			
		} 	
		
			 
		$paginate = 10;
		if ($request->has('onpage')) {
			$paginate = $request->onpage;
			$appends['onpage'] = $request->onpage;
		}
		if ($request->page == '' || $request->page == 0 || $request->page == null) $request->page = 1;
       	$roomsAfter = $rooms->orderBy('id','DESC')->get()->slice(($request->page - 1) * 10);
       	$roomsBefore = $rooms->orderBy('id','DESC')->get()->slice(0, ($request->page - 1) * 10);

       	$roomsAll = $roomsAfter->merge($roomsBefore);
       	// dd($roomsAll);
		

		$rooms = $rooms->orderBy('id','DESC')->paginate(10);
		
		if($request->input('room_type_id')) {
		$type = RoomTypeTranslation::where('room_type_id', $request->input('room_type_id'))->first();
		}else{
		$type = RoomTypeTranslation::where('slug', $type)->first()->roomType;
		}
		
		if ($style != null)
			$style = StyleTranslation::where('slug', $style)->first()->style;
		if (count($appends) > 0)
        	$rooms->appends($appends);
 
		if($request->input('room_type_id')) {
		
		$i = 0;		
        $room1 = [];
        $room2 = [];
        foreach ($rooms as $room) {
        	if ($i%2 == 0) {
        		$room1[] = $room;
        	} else {
        		$room2[] = $room;
        	}
        	$i++;
        }
		
			return response()->view('frontend.rooms.room-moz',compact('rooms','room1','room2','type','roomTypes','request','styles', 'roomsAll', 'style')); 
		}
		
        if ($rooms->first()) {

			$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            	return response( 'Not Modified', 304);

			return response()->view('frontend.rooms.index',compact('rooms','type','roomTypes','request','styles', 'roomsAll', 'style'))->header('Last-Modified', $LastModified);
        }
		return response()->view('frontend.rooms.index',compact('rooms','type','roomTypes','request','styles','style', 'roomsAll'));
	}
	
	public function getMoz(Request $request) {

		$rooms = Room::where('id','>','0');
		$roomTypes = RoomType::all();
		$styles = Style::all();
		$appends = array();
		if ($request->has('view'))
			$appends['view'] = $request->view;
		if (!$request->has('room_style_id') && !$request->has('room_type_id')) {
			if ($roomTypes->first())
				return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'))->header('Last-Modified', $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T'));
			return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'));
		}
		if ($request->has('room_style_id')) {

			$rooms = $rooms->whereHas('styles', function($q) use ($request)
                {
                    $q->where('id',$request->room_style_id);

                });
			$appends['room_style_id'] = $request->room_style_id;
		}
		if ($request->has('room_type_id')) {
			if ($request->room_type_id != 0) 
				$rooms = $rooms->where('room_type_id', $request->room_type_id);

			$appends['room_type_id'] = $request->room_type_id;
		}
		$paginate = 10;
		if ($request->has('onpage')) {
			$paginate = $request->onpage;
			$appends['onpage'] = $request->onpage;
		}
       
		$rooms = $rooms->orderBy('id','DESC')->paginate(10);
		if (count($appends) > 0)
        	$rooms->appends($appends);
        $i = 0;
        $room1 = [];
        $room2 = [];
        foreach ($rooms as $room) {
        	if ($i%2 == 0) {
        		$room1[] = $room;
        	} else {
        		$room2[] = $room;
        	}
        	$i++;
        }
		$type = RoomType::find($request->room_type_id);
		if ($rooms->first()) {
			$LastModified = $rooms->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            	return response( 'Not Modified', 304);
			return response()->view('frontend.rooms.room-moz',compact('rooms','room1','type','room2','roomTypes','request','styles'))->header('Last-Modified', $LastModified);
		}
		return response()->view('frontend.rooms.room-moz',compact('rooms','room1','type','room2','roomTypes','request','styles'));
	}
	public function getMozAjax(Request $request) {

		$rooms = Room::where('id','>','0');
		$roomTypes = RoomType::all();
		$styles = Style::all();
		$appends = array();
		if ($request->has('view'))
			$appends['view'] = $request->view;
		if (!$request->has('room_style_id') && !$request->has('room_type_id')) {
			if ($roomTypes->first()) {
				$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
				if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            		return response( 'Not Modified', 304);
				return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'))->header('Last-Modified', $LastModified);
			}
			return response()->view('frontend.rooms.roomtype',compact('roomTypes', 'request','styles'));
		}
		if ($request->has('room_style_id')) {

			$rooms = $rooms->whereHas('styles', function($q) use ($request)
                {
                    $q->where('id',$request->room_style_id);

                });
			$appends['room_style_id'] = $request->room_style_id;
		}
		if ($request->has('room_type_id')) {
			if ($request->room_type_id != 0) 
				$rooms = $rooms->where('room_type_id', $request->room_type_id);

			$appends['room_type_id'] = $request->room_type_id;
		}
		$paginate = 1;
		if ($request->has('onpage')) {
			$paginate = $request->onpage;
			$appends['onpage'] = $request->onpage;
		}
       
		$rooms = $rooms->orderBy('id','DESC')->paginate(10);
		if (count($appends) > 0)
        	$rooms->appends($appends);
        if ($rooms->first()) {
			$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) {
				return response( 'Not Modified', 304);
			} 
			return response()->view('frontend.rooms.room-moz',compact('rooms','roomTypes','request','styles'))->header('Last-Modified', $LastModified);
        }
		return response()->view('frontend.rooms.room-moz',compact('rooms','roomTypes','request','styles'));
	}
	public function getS($id){
		$room = Room::find($id);
		// return Room::popular();
		if ($room)
			return response()->view('frontend.rooms.single',compact('room'))->header('Last-Modified', $room->updated_at->format('D, d M Y H:i:s \G\M\T'));
		return response()->view('frontend.rooms.single',compact('room'));
	}
	
	
}
