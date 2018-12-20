<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\ManufacturerTranslation;
use App\Models\Store;
use App\Models\StoreTranslation;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\ProductTranslation;
use App\Models\City;
use App\Models\StoreCity;
use App\Models\Idea;
use App\Models\ProductRelationship;
use App\Models\Pcategory;
use App\Models\PcategoryTranslation;
use App\Http\Requests\Admin\Products\CreateProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use Pingpong\Admin\Uploader\ImageUploader;
use Carbon\Carbon;
use App\Models\RoomPicture;
use Response;
use Validator;
use Image;
use Maatwebsite\Excel\Facades\Excel;

class IdeasController extends Controller
{

    private $uploader;
    public function __construct(ImageUploader $imageUploader)
    {
        $this->middleware('auth');
        $this->uploader = $imageUploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function removeStore(Request $request)
    {
        \DB::table('store_city_product')->where('store_city_id', $request->store_city_id)->where('product_id', $request->product_id)->delete();
        return ['msg' => 'deleted'];
    }

    public function index(Request $request)
    {
        $name = '';
        $filters = array();
        if ($request->has('filters'))
		  $filters = $request->filters;
        if ($request->has('pName'))
		  $name = mb_strtoupper($request->pName);
        
        $ideas = Idea::paginate(20);
		
        return view('admin.ideas.index', compact('ideas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // $manufacturers = ManufacturerTranslation::where('locale', 'ru')->orderBy('name')->lists('name','manufacturer_id');
        // $relatives = ProductRelationship::orderBy('name')->lists('name','id');
        // $pcategories = PcategoryTranslation::where('locale', 'ru')->orderBy('name')->lists('name','pcategory_id');
        // $cities = City::lists('name','id');
        // $stores = StoreTranslation::where('locale', 'ru')->orderBy('name')->lists('name','store_id');
        // $storesWithCity = StoreCity::with('city', 'store')->orderBy('store_id', 'ASC')->get();
        $positions = Idea::where('in_main', 1)->orderBy('position', 'ASC')->get();
        return view('admin.ideas.create', compact('positions'));
    }
    public function duplicate($id) {
        $model = Idea::find($id);
        $newModel = $model->replicate();
        $newModel->push();
        return back();
    }

    public function getImage($id){
         $image = RoomPicture::find($id);
         if(!empty($image)){
            return response()->json(['path' => $image->image]);
         } else {
             return response()->json(['path' => null]);
         }

//        $image = RoomPicture::find($id);
//        return $image->image;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $picture = '';
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/ideas/';
            Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
            $data['main_image'] = $picture;
        }
        
        $idea = Idea::create($data);
        
        return redirect()->route('admin.ideas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $idea = Idea::withTrashed()->where('id',$id)->first();

        return view('admin.ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // $product = Product::withTrashed()->where('id',$id)->first();
        // $manufacturers = ManufacturerTranslation::where('locale', 'ru')->lists('name','manufacturer_id');
        // $pcategories = Pcategory::lists('name','id');
        // $stores = Store::lists('name','id');
        // $relatives = ProductRelationship::lists('name','id');
        // $product_stores = $product->stores->lists('id');
        // $store_city = $product->cities->lists('id');
        // $cities = City::lists('name','id');
        // $storesWithCity = StoreCity::with('city', 'store')->orderBy('store_id', 'ASC')->get();
        // return view('admin.products.edit', compact('product','cities', 'manufacturers','stores','pcategories','relatives','product_stores', 'store_city', 'storesWithCity'));
        $idea = Idea::where('id', $id)->first();
        $positions = Idea::where('in_main', 1)->orderBy('position', 'ASC')->get();

        return view('admin.ideas.edit', compact('idea', 'positions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        unset($data['_method']);
        unset($data['_token']);
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $picture = '';
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/ideas/';
            Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
            $data['main_image'] = $picture;
        }
        
        $idea = Idea::where('id', $id)->update($data);
        
        return redirect()->route('admin.ideas.index');
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
        $ideas = Idea::whereIn('id', $ids)->get();
        foreach($ideas as $idea) {
            $idea->forceDelete();
        }
        return "removed";
        
    }
    public function removePicture($id) {
        
        $picture = ProductPicture::withTrashed()->where('id',$id)->first();
        if ($picture)
            $picture->forceDelete();
        return back();
        
    }
    public function enable($id)
    {
        $product = Product::withTrashed()->where('id',$id)->first();
        if ($product->trashed()){
            $product->restore();
            foreach ($product->tags()->withTrashed()->get() as $tag) {
                $tag->restore();
            }
        }
        else {
            $product->delete();
            foreach ($product->tags as $tag) {
                $tag->delete();
            }
        }
        return redirect()->route('admin.products.index');
    }
    public function destroy($id)
    {
        $idea = Idea::where('id',$id)->first();
        if ($idea)
        $idea->forceDelete();
    
        return redirect()->route('admin.products.index');
    }
    public function importExcel()
    {
        // $manufacturer = Manufacturer::findOrFail($id);
        // return phpinfo();
        return view('admin.products.import-excel');
    }
    public function postImportExcel()
    {
        $rules = array(
            'file' => 'required',
        );

        $validator = Validator::make(\Input::all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return redirect('/admin/products/import-excel')->withErrors($validator);
        }
        else 
        {
            try {
                $readerArr = array();
                Excel::load(\Input::file('file'), function ($reader) {
                    $readerArr = $reader->toArray();
                    $data = array();
                    foreach ($readerArr as $row) {
                        
    // public $translatedAttributes = ['name', 'short_body','slug'];
    // protected $fillable = ['name', 'short_body','slug', 'manufacturer_id','image','pcategory_id', 'relative_id'];
                        $product = '';
                        if (ProductTranslation::where('name', $row['name_ru'])->get()->count() > 0) {
                            $manufacturerTranslation = ProductTranslation::where('name', $row['name_ru'])->first();
                            $product = Product::find($manufacturerTranslation->product_id)->first();
                        }
                        $data['ru']['name'] = $row['name_ru'];
                        $data['en']['name'] = $row['name_en'];
                        $data['ru']['slug'] = $row['slug_ru'];
                        $data['en']['slug'] = $row['slug_en'];
                        $data['is_wide'] = $row['is_wide'];
                        $data['url'] = $row['url'];
                        $data['en']['short_body'] = $row['short_body_en'];
                        $data['ru']['short_body'] = $row['short_body_ru'];
                        $data['image'] = $row['image'];
                        $manufacturer = Manufacturer::whereHas('translations', function ($query) use ($row) {
                            $query->where('name', $row['manufacturer']);
                             // $query->whereRaw('UPPER(name) LIKE "%'.mb_strtoupper($row['city']).'%"');
                        })->first();
                        if ($manufacturer instanceof Manufacturer) {
                            $data['manufacturer_id'] = $manufacturer->id;
                        } else {
                            $data['manufacturer_id'] = Manufacturer::first()->id;
                        }

                        $relative = ProductRelationship::where('name', $row['relative'])->first();
                        if ($relative instanceof ProductRelationship) {
                            $data['relative_id'] = $relative->id;
                        }
                       
                        if ($product instanceof Product) {
                            $product->update($data);
                        }
                        else {
                            $product = Product::create($data);
                        }

                        $store = Store::whereHas('translations', function ($query) use ($row) {
                            $query->whereIn('name', explode(',',$row['stores']));
                        })->lists('id');
                        if ($store) {
                            $product->stores()->attach($store);
                        } else {
                            $product->stores()->attach(Store::first()->id);
                        }
                            $product->save();
                    }
                });
                \Session::flash('success', 'Products uploaded successfully.');
                return redirect('/admin/products');
            } catch (\Exception $e) {
                \Session::flash('error', $e->getMessage());
                return redirect('/admin/products');
            }
        } 
        return redirect('/admin/products/');
    }

}
