<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\RoomPicture;
use App\Models\Store;
use App\Models\StoreCity;
use App\Models\StoreTranslation;
use App\Http\Requests\Admin\Stores\CreateStoreRequest;
use App\Http\Requests\Admin\Stores\UpdateStoreRequest;
use Pingpong\Admin\Uploader\ImageUploader;
use Validator;
use App\Models\Pcategory;
use Maatwebsite\Excel\Facades\Excel;
class StoresController extends Controller
{
    public function __construct(ImageUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function removeCity(Request $request)
    {
        if ($request->en == '')
            $request->en = null;
        if ($request->ru == '')
            $request->ru = null;
        
        StoreCity::where('store_id', $request->store_id)->where('city_id', $request->city_id)->where('address_ru', $request->ru)->where('address_en', $request->en)->limit(1)->delete();

        return ['msg' => 'deleted'];
    }


    public function index(Request $request)
    {
        $stores = Store::latest()->paginate(20);
        $name = '';
        $cityId = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('city_id'))
          $cityId = $request->city_id;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $stores = Store::where('id','>',0);
        // $onpage = 20;

        // dd(count($filters) == 0);
        // if ($request->has('onpage'))
        //     $onpage = $request->onpage;
        // if($name == '' && count($filters) == 0){
        //     $stores = $stores->latest()->paginate($onpage);
        // } else {
        //     if ($name != '') {
        //         $stores->whereHas('translations', function ($query) use ($name) {
        //                      $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
        //                 });
        //     }
        //     if ($cityId != '') {
        //         $stores->whereHas('cities',function($query) use ($cityId) {
        //             $query->where('cities.id', $cityId);
        //         });
        //     }
        //     $stores = $stores->latest()->paginate($onpage)->appends($request->all());
        //     // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
        //     // dd($products);
        // }
        
        if ($name != '') {
            $stores->whereHas('translations', function ($query) use ($name) {
                 $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
            });
        }
        if ($cityId != '') {
            $stores->whereHas('cities',function($query) use ($cityId) {
                $query->where('cities.id', $cityId);
            });
        }
        $stores = $stores->latest()->paginate($request->onpage)->appends($request->all());
        // dd($name, $cityId, $stores);
        $no = $stores->firstItem();

        return view('admin.stores.index', compact('stores', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::lists('name','id');
        return view('admin.stores.create', compact('cities'));
    }
    public function importExcel()
    {
        // $manufacturer = Manufacturer::findOrFail($id);

        return view('admin.stores.import-excel');
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
            return redirect('/admin/stores/import-excel')->withErrors($validator);
        }
        else 
        {
            try {
                $readerArr = array();
                Excel::load(\Input::file('file'), function ($reader) {
                    $readerArr = $reader->toArray();
                    $data = array();
                    foreach ($readerArr as $row) {
                        $store = "";
                        if (StoreTranslation::where('name', $row['name_ru'])->get()->count() > 0) {
                            $storeTranslation = StoreTranslation::where('name', $row['name_ru'])->first();
                            $store = Store::find($storeTranslation->store_id)->first();
                        }
                        // if (Store::whereHas('translations', function ($query) use ($row) {
                        //      $query->whereRaw('UPPER(name) LIKE "%'.mb_strtoupper($row['nazvanie']).'%"');
                        // })->get()->count() > 0) {
                        //     $store = Store::whereHas('translations', function ($query) use ($row) {
                        //         $query->whereRaw('UPPER(name) LIKE "%'.mb_strtoupper($row['nazvanie']).'%"');
                        //     })->first();
                        // }
                        $data['ru']['name'] = $row['name_ru'];
                        $data['en']['name'] = $row['name_en'];
                        $data['en']['body'] = $row['body_en'];
                        $data['ru']['body'] = $row['body_ru'];
                        $data['en']['address'] = $row['address_ru'];
                        $data['ru']['address'] = $row['address_en'];
                        $data['phone'] = $row['phone'];
                        $data['logo'] = $row['logo'];
                        $data['image'] = $row['image'];
                        $data['en']['short_description'] = $row['short_description_ru'];
                        $data['ru']['short_description'] = $row['short_description_en'];
                        $data['url'] = $row['url'];
                        $data['email'] = $row['email'];
                        $city = City::whereHas('translations', function ($query) use ($row) {
                            $query->whereIn('name', explode(',', $row['city']));
                             // $query->whereRaw('UPPER(name) LIKE "%'.mb_strtoupper($row['city']).'%"');
                        })->lists('id');
                        
                        
                        if ($store instanceof Store) {
                            $store->update($data);
                        }
                        else {
                            $store = Store::create($data);
                        }

                        if ($city instanceof City) {
                            $store->cities()->attach([1]);
                        } else {
                            $store->cities()->attach($city);
                        }
                        $store->save();
                        
                    }
                });
                \Session::flash('success', 'Users uploaded successfully.');
                return redirect('/admin/stores');
            } catch (\Exception $e) {
                \Session::flash('error', $e->getMessage());
                return redirect('/admin/stores');
            }
        } 
        return redirect('/admin/stores/');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateStoreRequest $request)
    {
        $data = $request->all();
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
        unset($data['logo']);
        if($request->hasFile('logo')){
            $this->uploader->upload('logo')->save('images/stores');
            $data['logo'] = $this->uploader->getFilename();
        }
        unset($data['image']);
        if($request->hasFile('image')){
            $this->uploader->upload('image')->save('images/stores');
            $data['image'] = $this->uploader->getFilename();
        }
        $store = Store::create($data);
        if ($request->has('cities')) {
            $cities = [];
            foreach ($request->cities as $i => $city) {
                // dd($request->all());
                $cities[$data['cities'][$i]] = [
                    'address_ru' => $data['address_ru'][$i], 
                    'address_en' => $data['address_en'][$i]
                ];

            }
            $store->cities()->attach($cities);
        }
        return redirect()->route('admin.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $store = Store::findOrFail($id);
        $cities = City::lists('name','id');
        $store_city = $store->cities->lists('id');
        return view('admin.stores.edit', compact('store','cities','store_city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateStoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);
        try{
            $store = Store::findOrFail($id);
            $data = $request->all();
            $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
            unset($data['logo']);
            if($request->hasFile('logo')){
                $store->deleteImage();
                $this->uploader->upload('logo')->save('images/stores');
                $data['logo'] = $this->uploader->getFileName();
            }
            unset($data['image']);
            unset($data['city_id']);
            unset($data['store_id']);
            if($request->hasFile('image')){
                $store->deleteImage();
                $this->uploader->upload('image')->save('images/stores');
                $data['image'] = $this->uploader->getFileName();
            }

            $store->update($data);
            if ($request->has('cities')) {
                $cities = [];
                foreach ($request->cities as $i => $city) {
                    $cities[$data['cities'][$i]] = [
                        'address_ru' => $data['address_ru'][$i], 
                        'address_en' => $data['address_en'][$i]
                    ];
                }
                $store->cities()->sync($cities);
            }
        }catch (Exception $e){
            return $this->redirectNotFound();
        }

        return redirect()->route('admin.stores.index', [
            'city_id' => $request->city_id_page, 
            'pName' => $request->pName_page, 
            'page' => $request->page_page]);
    }
    protected function redirectNotFound()
    {
        return $this->redirect(isOnPages() ? 'pages.index' : 'manufactures.index')
            ->withFlashMessage('Manufacturer not found!')
            ->withFlashType('danger');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        
        $store->delete();
    
        return redirect()->route('admin.stores.index');
    }

}
