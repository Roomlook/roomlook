<?php namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Room;
use App\Models\RoomTranslation;
use App\Models\Product;
use App\Models\Paper;
use App\Models\PaperTranslation;
use App\Models\Article;
use App\Models\RoomType;
use App\Models\Style;
use App\Models\Author;
use App\Models\Country;
use App\Models\Idea;
use App\User;
use App\Models\ProductTranslation;
use App\Models\ProjectTranslation;
use App\Models\RoomPicture;
use App\Models\Pcategory;
use App\Models\StoreCity;
use Location;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    /* 
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */

    

    public function index(Request $request)
    {
        $paginate = 10;
        if ($request->has('paginate')) {
            $paginate = $request->paginate;
        }
        $view = 1;
        // $sliderPicture = RoomPicture::where('is_home_slider', 1)->first();
        // dd($sliderPicture->imagePath());
        // $slider = $sliderPicture->room->project;
        $projects = Project::orderBy('order', 'DESC')->orderBy('id', 'DESC')->paginate($paginate);

        if ($request->has('view')) {
            $view = $request->view;
            $projects->appends(['view' => $request->view]);
        }
        $project = Project::orderBy('updated_at', 'DESC')->first();
        if ($project) {
            $LastModified = $project->updated_at->format('D, d M Y H:i:s \G\M\T');
            // dd($_SERVER);
            if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']) && $_ENV['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && \Carbon\Carbon::parse($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= \Carbon\Carbon::parse($LastModified))
                return response('Not Modified', 304);
            return response()->view('welcome', compact('projects', 'view'))
                            ->header('Last-Modified', $LastModified);
        }
        return response()->view('welcome', compact('projects', 'view'));
    }

	public function getip($ip) {
		
		$url = 'http://www.geoplugin.net/json.gp?ip='.$ip;
		
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_URL,$url); 
		$result=curl_exec($ch); 
		curl_close($ch);
		
		$c = json_decode($result, true);
				 
		$city = array("Almaty" => "Алматы"); 
		 
		if($c['geoplugin_city']=='Moscow') {
			return str_replace("Moscow", "Москва", $c['geoplugin_city']);
		}else{
			return str_replace("Almaty", "Алматы", $c['geoplugin_city']);
		} 
		 
		//return $c['geoplugin_city'];
		
	}
	
    public function test(Request $request)
    {
		 
      $paginate = 10;
      if ($request->has('paginate')) {
          $paginate = $request->paginate;
      }
	  	   
		//echo $request->ip();    
		//print_r($this->getip($request->ip())); 
		
      $projects = Project::orderBy('order_in_main', 'DESC')->limit(4)->get();
      $roomTypes = RoomType::limit(5)->get();
      foreach ($roomTypes as $key => $roomType) {
          if ($key == 1 or $key == 2) {
            $roomType->styles = 'height: 230px;';
            $roomType->classes = 'col-md-2';
          }
          else if ($key == 3) {
            $roomType->styles = 'height: 462px;';
            $roomType->classes = 'col-md-2';
          }
          else {
            $roomType->styles = 'height: 462px;';
            $roomType->classes = 'col-md-4';
          }
      }
      $catalogs = Pcategory::limit(7)->get();
      foreach ($catalogs as $key => $catalog) {
          if ($key == 2 or $key == 4) {
            $catalog->styles = 'height: 230px;';
            $catalog->classes = 'col-md-12';
          }
          else if ($key == 3) {
            $catalog->styles = 'height: 460px;';
            $catalog->classes = 'col-md-12';
          }
          else {
            $catalog->styles = 'height: 230px;';
            $catalog->classes = 'col-md-6';
          }
      }
      $ideas = Idea::where('in_main', 1)->limit(9)->orderBy('position', 'ASC')->get();

      $room = Room::where('in_main', 1)->first();
      // $room = Room::where('id', 1566)->first();
      // $rooms = Room::where('id','>','0');
      // if ($request->page == '' || $request->page == 0 || $request->page == null) $request->page = 1;
      // $roomsAfter = $rooms->orderBy('id','DESC')->get()->slice(($request->page - 1) * 10);
      // $roomsBefore = $rooms->orderBy('id','DESC')->get()->slice(0, ($request->page - 1) * 10);
      $roomsAll = Room::where('id', $room->id)->get();

	  $city = $this->getip($request->ip());
	  
      return view('test', compact('projects', 'roomTypes', 'ideas', 'room', 'roomsAll', 'catalogs', 'city'));
    }
	
    public function test2(Request $request)
    {
      $paginate = 10;
      if ($request->has('paginate')) {
          $paginate = $request->paginate;
      }
      $projects = Project::orderBy('order_in_main', 'DESC')->limit(4)->get();
      $roomTypes = RoomType::limit(5)->get();
      foreach ($roomTypes as $key => $roomType) {
          if ($key == 1 or $key == 2) {
            $roomType->styles = 'height: 230px;';
            $roomType->classes = 'col-md-2';
          }
          else if ($key == 3) {
            $roomType->styles = 'height: 462px;';
            $roomType->classes = 'col-md-2';
          }
          else {
            $roomType->styles = 'height: 462px;';
            $roomType->classes = 'col-md-4';
          }
      }
      $catalogs = Pcategory::limit(7)->get();
      foreach ($catalogs as $key => $catalog) {
          if ($key == 2 or $key == 4) {
            $catalog->styles = 'height: 230px;';
            $catalog->classes = 'col-md-12';
          }
          else if ($key == 3) {
            $catalog->styles = 'height: 460px;';
            $catalog->classes = 'col-md-12';
          }
          else {
            $catalog->styles = 'height: 230px;';
            $catalog->classes = 'col-md-6';
          }
      }
      $ideas = Idea::where('in_main', 1)->limit(9)->orderBy('position', 'ASC')->get();

      $room = Room::where('in_main', 1)->first();
      // $room = Room::where('id', 1566)->first();
      // $rooms = Room::where('id','>','0');
      // if ($request->page == '' || $request->page == 0 || $request->page == null) $request->page = 1;
      // $roomsAfter = $rooms->orderBy('id','DESC')->get()->slice(($request->page - 1) * 10);
      // $roomsBefore = $rooms->orderBy('id','DESC')->get()->slice(0, ($request->page - 1) * 10);
      $roomsAll = Room::where('id', $room->id)->get();

      return view('test0', compact('projects', 'roomTypes', 'ideas', 'room', 'roomsAll', 'catalogs'));
    }
	
    public function test3(Request $request)
    {
		
      $paginate = 10;
	  
      if ($request->has('paginate')) {
          $paginate = $request->paginate;
      }
	   
	//echo session('city_id');
	   
      $projects = Project::orderBy('id', 'DESC')->limit(1)->get();
      $projects2 = Project::orderBy('id', 'DESC')->limit(3)->get();
	    
      $roomTypes = RoomType::limit(5)->get();
      foreach ($roomTypes as $key => $roomType) {
          if ($key == 1 or $key == 2) {
            $roomType->styles = 'height: 230px;';
            $roomType->classes = 'col-md-2';
          }
          else if ($key == 3) {
            $roomType->styles = 'height: 462px;';
            $roomType->classes = 'col-md-2';
          }
          else {
            $roomType->styles = 'height: 462px;';
            $roomType->classes = 'col-md-4';
          }
      }
      
	  $catalogs = Pcategory::limit(7)->get();
	  
      foreach ($catalogs as $key => $catalog) {
          if ($key == 2 or $key == 4) {
            $catalog->styles = 'height: 230px;';
            $catalog->classes = 'col-md-12';
          }
          else if ($key == 3) {
            $catalog->styles = 'height: 460px;';
            $catalog->classes = 'col-md-12';
          }
          else {
            $catalog->styles = 'height: 230px;';
            $catalog->classes = 'col-md-6';
          }
      }
	  
      //$ideas = Idea::where('in_main', 1)->limit(9)->orderBy('position', 'ASC')->get();
      
	  $papers = Paper::leftJoin('paper_categories_translations', function($join) {
						$join->on('papers.category_id', '=', 'paper_categories_translations.paper_categories_id');
					})
					->where('home', 1)
					->where('paper_categories_translations.locale', 'ru')
					->limit(2)
					->orderBy('position', 'DESC')
					->get(array('papers.*', 'paper_categories_translations.name as cname', 'paper_categories_translations.slug as cslug')); 
   
      $room = Room::where('in_main', 1)->first();
	   
      $roomsAll = Room::where('id', $room->id)->get();
	  
		$articles2 = \DB::table('papers')
						->leftJoin('paper_translations', 'papers.id', '=', 'paper_translations.paper_id') 
						->Leftjoin('paper_categories_translations', 'papers.category_id', '=', 'paper_categories_translations.paper_categories_id') 
						->where('paper_translations.locale', 'ru')  
						->where('paper_categories_translations.locale', 'ru')  
						->limit(2)
						->orderBy('papers.position', 'DESC')
						->get(array(
							'papers.*', 
							'paper_translations.*', 
							'paper_translations.images2 as images', 
							'paper_categories_translations.name as cname'
						));  
							 	
	  foreach($projects2 as $p2) {
		  
		    /*
			$img = $p->pictures(1, [], true);
		   
		    $file_handle = @getimagesize('./images/rooms/original/'.$img[0]->image);
			 
            if (!$file_handle) {
                throw new \Exception('Failed to open uploaded file');
            }
            list($width, $height) = $file_handle;
            			   
			$h_o = $width/(1200/600);
			*/
  
			if($p2->cropimage) {
			
			$image=imagecreatefromjpeg('/var/www/roomlook.com/public/images/projects/'.$p2->cropimage);
			$thumb=imagecreatetruecolor(1,1); 
			
			imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
			 
			$rgb = strtoupper(dechex(imagecolorat($thumb,0,0)));
			
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
		
			$p2['color'] = 'rgba('.$r.', '.$b.', '.$g.', 0.6)';
			$p2['image_size0'] = ''; //$img[0]->image;
		    			
			$projects_new2[] = $p2; 
			
			}else{ 
				
			$p2['color'] = 'rgba(171, 171, 171, 0.6)';
			$p2['image_size0'] = '';
				
			}
  		     
	  }
	  
	  foreach($projects as $p) {
		  
		    /*
			$img = $p->pictures(1, [], true);
		   
		    $file_handle = @getimagesize('./images/rooms/original/'.$img[0]->image);
			 
            if (!$file_handle) {
                throw new \Exception('Failed to open uploaded file');
            }
            list($width, $height) = $file_handle;
            			   
			$h_o = $width/(1200/600);
			*/
  
			if($p->cropimage) {
				
			$image=imagecreatefromjpeg('/var/www/roomlook.com/public/images/projects/'.$p->cropimage);
			$thumb=imagecreatetruecolor(1,1); 
			
			imagecopyresampled($thumb,$image,0,0,0,0,1,1,imagesx($image),imagesy($image));
			 
			$rgb = strtoupper(dechex(imagecolorat($thumb,0,0)));
			
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
		
			$p['color'] = 'rgba('.$r.', '.$b.', '.$g.', 0.6)'; 
			$p['image_size0'] = ''; //$img[0]->image;
		    			
			$projects_new[] = $p; 
		     
			}else{
				
			$p['color'] = 'rgba(171, 171, 171, 0.6)';
			$p['image_size0'] = '';
				
			}
			
	  } 
		
      return view('test3', compact('projects', 'projects2', 'city', 'roomTypes', 'ideas', 'papers', 'articles2', 'room', 'roomsAll', 'catalogs'));
    }

    public function getProjects(Request $request)
    {
        $paginate = 10;
        if ($request->has('paginate')) {
            $paginate = $request->paginate;
        }
        $view = 1;

        $projects = Project::orderBy('id', 'DESC');
        if ($request->has('room_style_id')) {

            $rooms = Room::whereHas('styles', function($q) use ($request)
                {
                    $q->where('id',$request->room_style_id);

                })->lists('project_id');

            $projects = $projects->whereIn('id', $rooms);
        }
        $projects = $projects->paginate($paginate);
        $styles = Style::all();
        $project = Project::orderBy('updated_at', 'DESC')->first();
        if ($project) {
            $LastModified = $project->updated_at->format('D, d M Y H:i:s \G\M\T'); 
            // if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            //     return response( 'Not Modified', 304);
            return response()->view('projects', compact('projects', 'view', 'styles', 'request'))->header('Last-Modified', $LastModified);
        }
        return response()->view('projects', compact('projects', 'view', 'styles', 'request'));


    }
    public function getProjectSingleFind($id, Request $request) {
      $roomPicture = RoomPicture::find($id);
      // dd($roomPicture->room-);
      return redirect()->to('/project/s/' . $roomPicture->room->project_id . '?picture_id=' . $id);

    }

    public function redirectProjectSingle($id, Request $request)
    { 
      $slug = Project::find($id)->slug;
      $author = Project::find($id)->author->slug;
      return redirect('/project/'.$slug.'-'.$author);
    }

    public function makeSlug()
    {
      $projects = ProjectTranslation::all();
      foreach ($projects as $project) {
        $project->slug = str_slug($project->name, '_');
        $project->save();
      }
    }

    public function getProjectSingle($slug, Request $request, $picture_id = null)
    { 
        $project = ProjectTranslation::where('slug', $slug)->first()->project;
        
        $showPicture = null;
        if ($request->has('picture_id'))
            $showPicture = RoomPicture::find($request->picture_id);
        $relativeProjects = [];
		
		
        if ($project->project_relations_id != 0 && $project->project_relations_id != null)
            $relativeProjects = $project->relativeProjects()->get()->take(2);
		
		
        if ($project) {
            $LastModified = $project->updated_at->format('D, d M Y H:i:s \G\M\T'); 
            // if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            //     return response( 'Not Modified', 304);
            return response()->view('frontend.projects.single', compact('project', 'relativeProjects', 'showPicture', 'articles'))->header('Last-Modified', $LastModified);
        }
        return response()->view('frontend.projects.single', compact('project', 'relativeProjects', 'showPicture', 'articles'));
    }

    public function getChangecity($id)
    {		
        session(['city_id' => $id]);
		
		//return redirect()->back();
		
        return ["status" => "success"];
    }
    
    public function thanks() {
        return view('auth.thank');
    }
	
    public function getSearch(Request $request)
    {
        $projects = Project::whereHas('translations', function ($q) use ($request) {
            $q->whereRaw('UPPER(name) LIKE "%' . mb_strtoupper($request->q) . '%"');
            // ->orWhereRaw('UPPER(body) LIKE "%'.mb_strtoupper($request->q).'%"');
        })->paginate(20);

        $designers = User::where('name', 'LIKE', '%'.$request->q.'%')->paginate(10);

        $rooms = Room::whereHas('translations', function ($q) use ($request) {
            $q->whereRaw('UPPER(title) LIKE "%' . mb_strtoupper($request->q) . '%"');
            // ->orWhereRaw('UPPER(body) LIKE "%'.mb_strtoupper($request->q).'%"');
        });
        $products = Product::whereHas('translations', function ($q) use ($request) {
            $q->whereRaw('UPPER(name) LIKE "%' . mb_strtoupper($request->q) . '%"');
            // ->orWhereRaw('UPPER(body) LIKE "%'.mb_strtoupper($request->q).'%"');
        })->paginate(10);
        $keyword = '';

        $roomsAll = $rooms->get();
        $rooms = $rooms->paginate(10);
        if ($request->has('q'))
            $keyword = $request->q;

        return view('search', compact('products', 'rooms', 'keyword', 'roomsAll', 'projects', 'designers'));
    }

    public function getDesktopVersion(Request $request)
    {
        session(['no-resp' => 'true']);
        return back();
    }
    public function page($slug) {
        $article = Article::where('slug', '=', $slug)->first();
        if ($article) {
            $LastModified = $article->updated_at->format('D, d M Y H:i:s \G\M\T');
            // if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
            //     return response( 'Not Modified', 304);
            return response()->view('page', compact('article'))->header('Last-Modified', $LastModified);
        }
        return response()->view('page', compact('article'));
        
    }
    public function getCancelVersion(Request $request)
    {
        session()->forget('no-resp');
        return back();
    }
	
    public function sitemap()
    {
		$article = Article::all();
		$project = Project::all();
		$product = Product::all();
		
		$room = \DB::table('rooms')
				->leftJoin('room_translations', 'rooms.id', '=', 'room_translations.room_id')
				->get(); 
				
		//$paper = Paper::all(); 
		
		return view('sitemap', compact('article', 'project', 'room', 'product')); 
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
	
}
