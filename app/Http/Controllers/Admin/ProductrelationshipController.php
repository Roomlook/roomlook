<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRelationship;
use App\Http\Requests\Admin\Countries\CreateCountryRequest;
use App\Http\Requests\Admin\Countries\UpdateCountryRequest;

class ProductrelationshipController extends Controller
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
        $countries = ProductRelationship::latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $countries = ProductRelationship::where('id','>',0);
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

        return view('admin.productrelationship.index', compact('countries', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.productrelationship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $country = ProductRelationship::create($request->all());
        return redirect()->route('admin.productrelationship.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $country = ProductRelationship::findOrFail($id);

        return view('admin.productrelationship.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $country = ProductRelationship::findOrFail($id);
    
		$groupt = \DB::table('tag_group')
							->leftJoin('tag_group_translations', 'tag_group_translations.tag_group_id', '=', 'tag_group.id')
							->where('locale', 'ru')
							->get();
							
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->where('locale', 'ru')
							->get();
			 
		$products2 = \DB::table('product_tags_relationship')
							->leftJoin('products777', 'product_tags_relationship.product_tags_relationship_id', '=', 'products777.id') 
							->leftJoin('product_pictures', 'product_pictures.product_id', '=', 'products777.id') 
							->leftJoin('product_translations', 'product_translations.product_id', '=', 'products777.id') 
							->where('product_translations.locale', 'ru')
							->where('product_tags_relationship.product_relationship_id', $id)
							->get(array('products777.id', 'product_pictures.image', 'product_translations.name'));
				
		foreach($products2 as $p) {
 
		
			$prod[] = array(
				'id' => $p->id, 
				'name' => $p->name, 
				'image' => $p->image, 
			);
		
		}		
				 
        return view('admin.productrelationship.edit', compact('country','groupt','tags','products2'));
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
		
        $country = ProductRelationship::findOrFail($id);

		/*
		if(isset($data['test2'])) { die();
			$country->tags()->sync($data['test2']); }
        */
		
		if(isset($data['tags'])) {  
			$country->tags()->sync($data['tags']); }
							
		if(isset($data['product_check'])) {  
			$country->tags_products()->sync($data['product_check']); }
			 
        $country->update($data);

        return redirect()->route('admin.productrelationship.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $country = ProductRelationship::findOrFail($id);
        
        $country->delete();
    
        return redirect()->route('admin.productrelationship.index');
    }

}
