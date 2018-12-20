<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roompicturetag;
use App\Http\Requests\Admin\Roompicturetags\CreateRoompicturetagRequest;
use App\Http\Requests\Admin\Roompicturetags\UpdateRoompicturetagRequest;
use App\Models\Product;
class RoompicturetagsController extends Controller
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
    public function index()
    {
        $roompicturetags = Roompicturetag::latest()->paginate(20);

        $no = $roompicturetags->firstItem();

        return view('admin.roompicturetags.index', compact('roompicturetags', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $products =  Product::lists('name','id');
        return view('admin.roompicturetags.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $check = Roompicturetag::where('room_picture_id', $request->room_picture_id)
            ->where('product_id', $request->product_id)
            ->where('percent_top', number_format((float)$request->percent_top, 2, '.', ''))
            ->where('percent_left', number_format((float)$request->percent_left, 2, '.', ''))
            ->get();
        $roompicturetag = null;
        if ($check->count() == 0) {
            $roompicturetag = Roompicturetag::create($request->all());

        }
        // dd($roompicturetag instanceof Roompicturetag);
        if (!($roompicturetag instanceof Roompicturetag)) {
            return response()->json(['success' => true, 'tagId' => Roompicturetag::orderBy('id', 'desc')->first()->id]);
        } 

        return response()->json(['success' => true, 'tagId' => $roompicturetag->id]);
        // return redirect()->route('admin.roompicturetags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $roompicturetag = Roompicturetag::findOrFail($id);

        return view('admin.roompicturetags.show', compact('roompicturetag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $products =  Product::lists('name','id');
        $roompicturetag = Roompicturetag::findOrFail($id);
		  
		$connects = \DB::table('product_relationship')
						->get();  
		  
		$connect = \DB::table('product_tags_relationship')
						->leftJoin('product_relationship', 'product_relationship.id', '=', 'product_tags_relationship.product_relationship_id') 
						->where('product_tags_relationship.product_relationship_id', $id)   
						->get();  
						 
        return view('admin.roompicturetags.edit', compact('roompicturetag','connects','connect','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {       
        $roompicturetag = Roompicturetag::findOrFail($id);
        $data = $request->all();
        $data['product_id'] = $roompicturetag->product_id;
        $data['room_picture_id'] = $roompicturetag->room_picture_id;
        if ($request->has('is_relative'))
            $data['is_relative'] = $data['is_relative'];
        $roompicturetag->update($data);
        return response()->json(['success' => true]);

        return redirect()->route('admin.roompicturetags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $roompicturetag = Roompicturetag::find($id);
        // dd($roompicturetag);
        if ($roompicturetag)
            $roompicturetag->delete();
        return response()->json(['success' => true]);
    
        return redirect()->route('admin.roompicturetags.index');
    }

}
