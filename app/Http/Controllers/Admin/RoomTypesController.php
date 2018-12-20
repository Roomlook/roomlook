<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Http\Requests\Admin\RoomTypes\CreateRoomTypeRequest;
use App\Http\Requests\Admin\RoomTypes\UpdateRoomTypeRequest;
use Pingpong\Admin\Uploader\ImageUploader;

use Image;

class RoomTypesController extends Controller
{
     var $uploader;
    public function __construct(ImageUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   public function index(Request $request)
    {
        $roomtypes = RoomType::latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $roomtypes = RoomType::where('id','>',0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $roomtypes = $roomtypes->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $roomtypes->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
            }
            
            $roomtypes = $roomtypes->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        
        $no = $roomtypes->firstItem();

        return view('admin.roomtypes.index', compact('roomtypes', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.roomtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRoomTypeRequest $request)
    {
        $data = $request->all();
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
        unset($data['image']);
        if($request->hasFile('image')){
            $this->uploader->upload('image')->save('images/roomtypes');
            $data['image'] = $this->uploader->getFilename();
        }
        $roomtype = RoomType::create($data);
        
        return redirect()->route('admin.roomtypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $roomtype = RoomType::findOrFail($id);

        return view('admin.roomtypes.show', compact('roomtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $roomtype = RoomType::findOrFail($id);
    
        return view('admin.roomtypes.edit', compact('roomtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRoomTypeRequest $request, $id)
    {       
        $roomtype = RoomType::findOrFail($id);
        try {
			
            $data = $request->all();
	 
            $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
            $data['en']['slug'] = str_slug($data['en']['name'], '_');
            $data['ru']['seo_description'] = $data['ru']['description'];
            $data['en']['seo_description'] = $data['en']['description'];
			 
            unset($data['image']);
			
            if($request->hasFile('image')){
			
			/*для меню*/
            $file = $request->file('image');			 
            $picture = '';
            $destinationPath = public_path() . '/images/roomtypes/menu/'; 
            $destinationPath2 = public_path() . '/images/roomtypes/';
            $destinationPath3 = public_path() . '/images/roomtypes/md/';
			
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
			 
            $picture = date('His').'-'.trim($filename);
			 
			$img = Image::make($file); 
			$img->save($destinationPath2.$picture, 100); 
			
			$img->resize(360, null, function ($constraint) {
				$constraint->aspectRatio();
			}); 
			 
			$img->save($destinationPath3.$picture, 100); 
			
			$img->resize(300, null, function ($constraint) {
				$constraint->aspectRatio();
			}); 
 
			$img->save($destinationPath.$picture, 80); 
			
			chmod($destinationPath3.$picture, 0777); 
			chmod($destinationPath2.$picture, 0777); 
			chmod($destinationPath.$picture, 0777); 
			/**/
			 
                $roomtype->deleteImage();
				
                //$this->uploader->upload('image')->save('images/roomtypes'); 
                //$data['image'] = $this->uploader->getFileName();
				
                $data['image'] = $picture;
				$data['formenu'] = $picture;
				
            }
        
            $roomtype->update($data);
			
        } catch (Exception $e) {
            
        }

        return redirect()->route('admin.roomtypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $roomtype = RoomType::findOrFail($id);
        
        $roomtype->delete();
    
        return redirect()->route('admin.roomtypes.index');
    }

}
