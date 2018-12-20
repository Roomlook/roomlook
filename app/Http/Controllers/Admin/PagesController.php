<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\Admin\Pages\CreatePageRequest;
use App\Http\Requests\Admin\Pages\UpdatePageRequest;

class PagesController extends Controller
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
        $pages = Page::latest()->paginate(20);

        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $pages = Page::where('id','>',0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $pages = $pages->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $pages->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
            }
            
            $pages = $pages->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        
        $no = $pages->firstItem();

        return view('admin.pages.index', compact('pages', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        $page = Page::create($request->all());

        return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePageRequest $request, $id)
    {       
        $page = Page::findOrFail($id);

        $page->update($request->all());

        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
    
        return redirect()->route('admin.pages.index');
    }

}
