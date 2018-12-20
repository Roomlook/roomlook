<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pcategory;
use App\Models\Paper;
use App\Models\PaperCategories; 
use App\Http\Requests\Admin\Pcategories\CreatePcategoryRequest;
use App\Http\Requests\Admin\Pcategories\UpdatePcategoryRequest;
use Pingpong\Admin\Uploader\ImageUploader;

class PcategoriesController extends Controller
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
        $pcategories = Pcategory::latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $pcategories = Pcategory::where('id','>',0);
        $onpage = 20;

        if ($request->has('parent_id')) {
            $pcategories->where('parent_id', $request->parent_id);
        } else {
            $pcategories->where('parent_id', 0);
        }
        $pcategories->orderBy('id', 'ASC');
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $pcategories = $pcategories->latest()->paginate($onpage)->appends($request->all());
        } else {
            if ($name != '') {
                $pcategories->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
            }
            
            $pcategories = $pcategories->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        
        $no = $pcategories->firstItem();

        return view('admin.pcategories.index', compact('pcategories', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePcategoryRequest $request)
    {
        $data = $request->all();
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
        unset($data['image']);
        if($request->hasFile('image')){
            $this->uploader->upload('image')->save('images/pcategories');
            $data['image'] = $this->uploader->getFilename();
        }
        $pcategory = Pcategory::create($data);
        return redirect()->route('admin.pcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $pcategory = Pcategory::findOrFail($id);

        return view('admin.pcategories.show', compact('pcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $pcategory = Pcategory::findOrFail($id);
    
        return view('admin.pcategories.edit', compact('pcategory'));
    }
	
    public function all()
    {
		
		die();
		
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePcategoryRequest $request, $id)
    {       
        $pcategory = Pcategory::findOrFail($id);
        try {
            $data = $request->all();
            $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
            $data['en']['slug'] = str_slug($data['en']['name'], '_');
            unset($data['image']);
            if($request->hasFile('image')){
                $pcategory->deleteImage();
                $this->uploader->upload('image')->save('images/pcategories');
                $data['image'] = $this->uploader->getFileName();

            }
        } catch (Exception $e) {
            
        }
        $pcategory->update($data);

        return redirect()->route('admin.pcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $pcategory = Pcategory::findOrFail($id);
        
        $pcategory->delete();
    
        return redirect()->route('admin.pcategories.index');
    }

}
