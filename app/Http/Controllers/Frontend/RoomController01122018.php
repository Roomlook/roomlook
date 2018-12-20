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
use App\Models\RoomPicture;

class RoomController extends Controller {
	
	public function getIndex(Request $request)
    { 
    
		$redir2 = [
			1 => 'kitchen',
//			10 => '', //балкон
			11 => 'garderob',
			12 => 'stolovaya',
			2 => 'vannaya',
			3 => 'spalnya',
			4 => 'gostinaya',
			5 => 'kabinet',
			6 => 'detskaya',
//			7 => '', // коридор
//			8 => '', // прихожая
			9 => 'lestnitsa',
		];
		if ($request->input('room_type_id') && isset($redir2[$request->input('room_type_id')])) {
			return redirect ('/room/'.$redir2[$request->input('room_type_id')]);
		}

    	$rooms = Room::where('id','>','0');
		$roomTypes = RoomType::all();
		$styles = Style::all();
		$appends = array();
		
      	if (!$request->has('room_style_id') && !$request->has('room_type_id')) {
			if ($roomTypes->first()) {
				$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
	            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
	                return response( 'Not Modified', 304);

				return response()->view('frontend.rooms.roomindex',compact('roomTypes', 'request','styles'))->header('Last-Modified', $LastModified);
			}
			return response()->view('frontend.rooms.roomindex',compact('roomTypes', 'request','styles'));
			
		}
		
		if ($request->has('room_type_id')) {
			$appends['room_type_id'] = $request->room_type_id;

			//$type = RoomTypeTranslation::find($request->room_type_id)->slug;
			
			$type2 = RoomTypeTranslation::where('room_type_id', $request->room_type_id)->first();
			$type = $type2->slug;
		
		}else{ $type = 0; }  
		
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
		$redir1 = [
			'dining_room'=>'stolovaya',
//			'kitchen'=>'',
			'bathroom'=>'vannaya',
			'bedroom'=>'spalnya',
			'living_room'=>'gostinaya',
			'parlor'=>'kabinet',
			'playroom'=>'detskaya',
			'staircase'=>'lestnitsa',
			'wardrobe'=>'garderob',
//			'swimming_pool'=>'',
		];
		if (isset ($redir1[$type])) {
			return redirect ('/room/'.$redir1[$type]);
		}
		  
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
   
		$part = explode('/', $request->url()); 
		 
		if($request->input('room_type_id') && isset($part[5]) && $part[5]=='moz') {
	 
		$i = 0;		
        $room1 = [];
        $room2 = []; 
		  
        foreach ($rooms as $room) {
			 
			//
			$picture = $room->pictures()->first();  
			
			if ($picture != NULL) {  
			 
$fix_size = 580;
 
$width = $picture->getWidth(0, ''); 
$height = $picture->getHeight(0, '');

if( $height > $width )
 { 
     $k = $fix_size / $height;
     $new_w = round( $width * $k );
     $new_h = $fix_size;
 }
elseif( $width > $height )
 { 
     $k = $fix_size / $width;
     $new_w = $fix_size;
     $new_h = round( $height * $k );
 } 

 $room['height2'] = (isset($new_h))?$new_h:'500';
			 
			//print_r($picture);
			
			if(isset($h) && $h<(int)$picture->getHeight(0, '') && isset($_GET['page']) && $_GET['page']>1) { 
			
				//echo $h.'<br />'; 
				//echo $picture->getHeight(0, ''); 
				
				$room['height'] = $picture->getThumbHeight();
				
			}else{
				
				unset($h);
				
			}
			
			$h = (int)$picture->getHeight(0, '');  
			$w = (int)$picture->getWidth(0, '');  
			
			}else{
				
				 
				
			}
			//
			
        	if ($i%2 == 0) {
        		$room1[] = $room;
        	} else {
        		$room2[] = $room;
        	}
        	$i++;
        }
		
			return response()->view('frontend.rooms.room-moz',compact('rooms','room1','room2','type','roomTypes','request','styles', 'roomsAll', 'style')); 
		 
		}  
		
		
        foreach ($rooms as $room) { 
		 
			$picture = $room->pictures()->first(); 
			
			if ($picture != NULL) { 
			 
$fix_size = 1200;  
 
$width = $picture->getWidth(0, ''); 
$height = $picture->getHeight(0, '');
$new_h = $picture->getHeight(0, '');

if( $height > $width )
 { 
     $k = $fix_size / $height;
     $new_w = round( $width * $k );
     $new_h = $fix_size;
 }
elseif( $width > $height )
 { 
     $k = $fix_size / $width;
     $new_w = $fix_size;
     $new_h = round( $height * $k );
 } 

 $room['height2'] = $new_h;
 
			}
		}
		  
        if ($rooms->first()) {

			$LastModified = $roomTypes->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            	return response( 'Not Modified', 304);
  
			return response()->view('frontend.rooms.index',compact('rooms','type','roomTypes','request','styles', 'roomsAll', 'style'))->header('Last-Modified', $LastModified);
        }
		return response()->view('frontend.rooms.index',compact('rooms','type','roomTypes','request','styles','style', 'roomsAll'));
	}
	
	public function apigetRoom($id) {
		
		$rooms = RoomPicture::where('id',$id);
	 
		$rooms = $rooms->orderBy('id','DESC')->paginate(1);
		
        foreach ($rooms as $room) {
		
			$picture = $room; 
			
		}

		print_r($picture->room_id);		
		//return response()->json($rooms);
		die();
	}
	
	public function apigetMoz($id) {
				
		$rooms = Room::where('id',$id);
		$roomTypes = RoomType::all();  
		$styles = Style::all();
		$appends = array();
		
		$rooms = $rooms->orderBy('id','DESC')->paginate(1);
		
		header('Content-Type: application/json');
		
		//echo '[{"id":3555,"image":"1540874148.jpg"}{"id":3556,"image":"1540874161.jpg"}{"id":3557,"image":"1540874176.jpg"}{"id":3558,"image":"1540874198.jpg"}{"id":3559,"image":"1540874215.jpg"}{"id":3560,"image":"1540874230.jpg"}{"id":3561,"image":"1540874244.jpg"}{"id":3562,"image":"1540874257.jpg"}{"id":3563,"image":"1540874269.jpg"}{"id":3564,"image":"1540874281.jpg"}{"id":3565,"image":"1540874297.jpg"}{"id":3566,"image":"1540874311.jpg"}{"id":3567,"image":"1540874326.jpg"}{"id":3568,"image":"1540874340.jpg"}]';
		//die();
		
        foreach ($rooms as $room) {
		
			$picture = $room->pictures()->first(); 
			 
			foreach($picture->room->project->pictures(0, ['id', 'image']) as $pic) {
				
			$array[] = $pic;
				
			}
			
		}
		
		return response()->json($array);
				
		//echo json_encode($array);
		 
		die();
		
		
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
		
		print_r($rooms);
		
		die();
		
		if ($rooms->first()) {
			$LastModified = $rooms->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            	return response( 'Not Modified', 304);
			return response()->view('frontend.rooms.room-moz',compact('rooms','room1','type','room2','roomTypes','request','styles'))->header('Last-Modified', $LastModified);
		}
		return response()->view('frontend.rooms.room-moz',compact('rooms','room1','type','room2','roomTypes','request','styles'));
				
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
