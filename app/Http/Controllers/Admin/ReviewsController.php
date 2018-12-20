<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\Admin\Reviews\CreateReviewRequest;
use App\Http\Requests\Admin\Reviews\UpdateReviewRequest;

class ReviewsController extends Controller
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
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $reviews = Review::where('id','>',0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $reviews = $reviews->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $reviews->whereHas('user', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
            }
            
            $reviews = $reviews->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        
        $no = $reviews->firstItem();

        return view('admin.reviews.index', compact('reviews', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateReviewRequest $request)
    {
        $review = Review::create($request->all());

        return redirect()->route('admin.reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $review = Review::findOrFail($id);

        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
    
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateReviewRequest $request, $id)
    {       
        $review = Review::findOrFail($id);

        $review->update($request->all());

        return redirect()->route('admin.reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        $review->delete();
    
        return redirect()->route('admin.reviews.index');
    }

}
