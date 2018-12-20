<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectRelation;
use App\Http\Requests\Admin\Countries\CreateCountryRequest;
use App\Http\Requests\Admin\Countries\UpdateCountryRequest;

class ProjectRelationController extends Controller
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
        $countries = ProjectRelation::latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $countries = ProjectRelation::where('id','>',0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $countries = $countries->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $countries->whereHas('UPPER(name) LIKE "%'.$name.'%"');
                       
            }
            
            $countries = $countries->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        
        $no = $countries->firstItem();

        return view('admin.projectrelationship.index', compact('countries', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.projectrelationship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $country = ProjectRelation::create($request->all());
        return redirect()->route('admin.projectrelation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $country = ProjectRelation::findOrFail($id);

        return view('admin.projectrelationship.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $country = ProjectRelation::findOrFail($id);
    
        return view('admin.projectrelationship.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {       
        $country = ProjectRelation::findOrFail($id);

        $country->update($request->all());

        return redirect()->route('admin.projectrelation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $country = ProjectRelation::findOrFail($id);
        
        $country->delete();
    
        return redirect()->route('admin.projectrelation.index');
    }

}
