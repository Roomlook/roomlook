<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Requests\Admin\Cities\CreateCityRequest;
use App\Http\Requests\Admin\Cities\UpdateCityRequest;

class CitiesController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cities = City::latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $cities = City::where('id','>',0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $cities = $cities->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $cities->whereHas('country', function ($query) use ($name) {
                    $query->whereHas('translations', function($q) use ($name) {
                             $q->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
                });
            }
            
            $cities = $cities->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        $no = $cities->firstItem();
        
        return view('admin.cities.index', compact('cities', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = CountryTranslation::where('locale', 'ru')->orderBy('name')->lists('name','country_id');
        return view('admin.cities.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $data = $request->all();
        if (!$request->has('is_capital'))
            $data['is_capital'] = 0;
        $city = City::create($data);
        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);

        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        $countries = CountryTranslation::where('locale', 'ru')->orderBy('name')->lists('name','country_id');
        return view('admin.cities.edit', compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        $city = City::findOrFail($id);
        $data = $request->all();
        if (!$request->has('is_capital'))
            $data['is_capital'] = 0;
        $city->update($data);

        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        
        $city->delete();
    
        return redirect()->route('admin.cities.index');
    }

}
