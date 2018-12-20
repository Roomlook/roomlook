<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomPicture;
use App\Http\Requests\Admin\Roompictures\CreateRoompictureRequest;
use App\Http\Requests\Admin\Roompictures\UpdateRoompictureRequest;
use Pingpong\Admin\Uploader\ImageUploader;

use Image;
class RoompicturesController extends Controller
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
        $roompictures = Roompicture::where('id','>', 0);
        $roomId = '';
         // App\Models\Product::leftJoin('product_translations', 'products.id', '=', 'product_translations.product_id')
         //    ->where('locale', '=', 'ru')->whereIn('products.relative_id', App\Models\ProductRelationship::where('project_id', $room->project_id)->lists('id'))->lists('product_translations.name','product_translations.product_id');
        if ($request->has('room_id')) {
            // return $request->room_id;
            $roompictures->where('room_id','=', $request->room_id);
            $roomId = $request->room_id;
        }
        
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $roompictures = $roompictures->latest()->paginate($onpage)->appends($request->all());
        } else {
            if ($name != '') {
                $roompictures->whereHas('room', function ($query) use ($name) {
                             $query->whereRaw('UPPER(title) LIKE "%'.$name.'%"');
                        });
            }
            
            $roompictures = $roompictures->latest()->paginate($onpage)->appends($request->all());
            
           
        }

        $no = $roompictures->firstItem();

        return view('admin.roompictures.index', compact('roompictures', 'no','roomId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.roompictures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRoompictureRequest $request)
    {
        $data = $request->all();
        unset($data['image']);
        
        if (!isset($data['is_home_slider']))
            $data['is_home_slider'] = 0;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = Image::make($file->getRealPath());
            $filename  = time() . '.' . $file->getClientOriginalExtension();
            // $image->save(public_path('images/rooms/original/'.$filename ));
            $data['original_image'] = $filename;
            
            // $image->resize(2080, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $image->save(public_path('images/rooms/original/'.$filename ));

            $image->resize(1600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('images/rooms/lg/'.$filename ));
            $image->resize(1170, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('images/rooms/md/'.$filename ));

            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('images/rooms/md3/'.$filename ));
            $data['md_image'] = $filename;
            $image->save(public_path('images/rooms/sm/'.$filename));
            // $this->uploader->upload('image')->save('images/rooms');
            $data['image'] = $filename;
        }
        $data['is_landscape'] = 0;
             try {
                 $file_handle = @getimagesize('/images/rooms/md/'.$filename);
                 if (!$file_handle) {
                      throw new \Exception('Failed to open uploaded file');
                 }
                 list($width, $height) = $file_handle;
                 if ($width - $height >= 0) {
                    $data['is_landscape'] = 1;
                 }
             } catch (\Exception $e) {
                
             }
        $store = Roompicture::create($data);
        if (!($store instanceof Roompicture)) {
            return response()->json(['success' => false, 'errors' => 'Не загрузилось']);
            
        } 
        return response()->json(['success' => true, 'picture_id' => $store->id, 'file' => $store->imagePath()]);
        return redirect()->route('admin.roompictures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $roompicture = Roompicture::findOrFail($id);

        return view('admin.roompictures.show', compact('roompicture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $roompicture = Roompicture::findOrFail($id);
		 
        return view('admin.roompictures.edit', compact('roompicture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRoompictureRequest $request, $id)
    {       
        $roompicture = Roompicture::findOrFail($id);
        try{
            $data = $request->all();
            if (!isset($data['is_home_slider']))
                $data['is_home_slider'] = 0;
            unset($data['image']);
            if($request->hasFile('image')){
                $file = $request->file('image');
                $image = Image::make($file->getRealPath());
                $filename  = time() . '.' . $file->getClientOriginalExtension();
                $data['original_image'] = $filename;
                // $image->resize(2080, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                $image->save(public_path('images/rooms/original/'.$filename ));
                $image->resize(1600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path('images/rooms/lg/'.$filename ));
                $image->resize(1170, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path('images/rooms/md/'.$filename ));

                $image->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path('images/rooms/md3/'.$filename ));
                $data['md_image'] = $filename;
                $image->save(public_path('images/rooms/sm/'.$filename));
                // $this->uploader->upload('image')->save('images/rooms');
                $data['image'] = $filename;
            
            $data['is_landscape'] = 0;
             $file_handle = @getimagesize('/images/rooms/md/'.$filename);
             if (!$file_handle) {
                  throw new \Exception('Failed to open uploaded file');
             }
             list($width, $height) = $file_handle;
             if ($width - $height >= 0) {
                $data['is_landscape'] = 1;
             }
            }
            $roompicture->update($data);
        }catch (Exception $e){
        return response()->json(['success' => false]);
        }
        return response()->json(['success' => true, 'picture_id' => $roompicture->id, 'file' => $roompicture->imagePath()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove(Request $request) {
        $ids = $request->ids;
        if (count($ids) == 0) {
            return "nothing to remove";
        }
        $projects = Roompicture::withTrashed()->whereIn('id',$ids)->get();
        foreach($projects as $project) {
            $project->forceDelete();
        }
        return "removed";
        
    }
    public function destroy($id)
    {
        $roompicture = Roompicture::findOrFail($id);
        
        $roompicture->delete();
    
        return back();
    }


    // public function fitorg() {
    //     foreach (Roompicture::skip(176)->take(10)->get() as $roomPicture) {
    //         $image = Image::make(public_path('images/rooms/original/'.$roomPicture->original_image));
    //         $image->resize(2080, null, function ($constraint) {
    //             $constraint->aspectRatio();
    //         });
    //         $image->save(public_path('images/rooms/original/'.$roomPicture->original_image ));
    //         echo $roomPicture->id."\n";
    //     }
    //     echo "ended";
    // }

}
