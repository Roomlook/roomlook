<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\RequestToAuthor;
use App\Http\Requests\Admin\Requesttoauthors\CreateRequesttoauthorRequest;
use App\Http\Requests\Admin\Requesttoauthors\UpdateRequesttoauthorRequest;
use Pingpong\Trusty\Role;

class RequesttoauthorsController extends Controller
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
        $requesttoauthors = RequestToAuthor::latest()->orderBy('status')->paginate(20);
        
        $no = $requesttoauthors->firstItem();

        return view('admin.requesttoauthors.index', compact('requesttoauthors', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.requesttoauthors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequesttoauthorRequest $request)
    {
        $requesttoauthor = RequestToAuthor::create($request->all());

        return redirect()->route('admin.requesttoauthors.index');
    }
    /*asd6789*/
    public function approve(){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $requesttoauthor = RequestToAuthor::findOrFail($id);

        return view('admin.requesttoauthors.show', compact('requesttoauthor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $requesttoauthor = RequestToAuthor::findOrFail($id);
    
        return view('admin.requesttoauthors.edit', compact('requesttoauthor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRequesttoauthorRequest $request, $id)
    {       
        $requesttoauthor = RequestToAuthor::findOrFail($id);
        $requesttoauthor->update($request->all());
        if($request->status == 'approved'){
            $author = new Author();
            $author->user_id = $requesttoauthor->user->id;
            $author->save();
            $author_role = Role::where('name','=','author')->first();
            $requesttoauthor->user->roles()->attach($author_role);
        }
        return redirect()->route('admin.requesttoauthors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $requesttoauthor = RequestToAuthor::findOrFail($id);
        
        $requesttoauthor->delete();
    
        return redirect()->route('admin.requesttoauthors.index');
    }

}
