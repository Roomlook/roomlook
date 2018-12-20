<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\User;
use Excel;
use App\Http\Requests\Admin\Authors\CreateAuthorRequest;
use App\Http\Requests\Admin\Authors\UpdateAuthorRequest;
use Pingpong\Admin\Uploader\ImageUploader;

class AuthorsController extends Controller
{
    protected $uploader;
    public function __construct(ImageUploader $uploader)
    {
        //
        $this->uploader = $uploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $authors = Author::where('type', 0)->latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $authors = Author::where('type', 0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $authors = $authors->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $authors->whereHas('user', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
            }
            
            $authors = $authors->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        $no = $authors->firstItem();
        
        return view('admin.authors.index', compact('authors', 'no'));
    }
    public function photograph(Request $request)
    {

        $authors = Author::where('type', 1)->latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $authors = Author::where('type', 1);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $authors = $authors->latest()->paginate($onpage);
        } else {
            if ($name != '') {
                $authors->whereHas('user', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
            }
            
            $authors = $authors->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        $no = $authors->firstItem();
        $isPhoto = true;
        return view('admin.authors.index', compact('authors', 'no', 'isPhoto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }
    public function duplicate($id) {
        $model = Room::find($id);
        $newModel = $model->replicate();
        $newModel->push();
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateAuthorRequest $request)
    {
        
        $data = $request->all();
        $data['slug'] = str_slug($data['name_en'], '_');

        unset($data['image']);
        unset($data['name']);
        unset($data['user']);
        unset($data['name_en']);
        // unset($data['email']);
        $user = $request->only('name', 'email', 'name_en');
        $data['is_show'] = (int)$data['is_show'];
        // $user['email'] = str_replace(' ', '_', strtolower($user['name'])).'@mail.com';
        $user['password'] = '123456';
        $user['role'] = 2;

        $userModel = User::create($user);
        $data['user_id'] = $userModel->id;

        if (\Input::hasFile('image')) {
            
            $this->uploader->upload('image')->save('images/authors');

            $data['image'] = $this->uploader->getFilename();
        }

        
        unset($data['main_image']);

        if (\Input::hasFile('main_image')) {
            
            $this->uploader->upload('main_image')->save('images/rooms/md');

            $data['main_image'] = $this->uploader->getFilename();
        }

        $author = Author::create($data);
        $redirect = 'admin.authors.index';
        if ($data['type'] == 1)
          $redirect = 'admin.authors.photograph';
        return redirect()->route($redirect);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);

        return view('admin.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);
    
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateAuthorRequest $request, $id)
    {       
         try {
            $author = Author::findOrFail($id);
            $data = $request->all();

            $author->user->name = $data['name'];
            $author->user->name_en = $data['name_en'];
            $author->user->email = $data['email'];
            $author->user->save();
            $data['slug'] = str_slug($data['name_en'], '_');
            unset($data['image']);
            unset($data['name']);
            unset($data['name_en']);
            unset($data['email']);
            $data['is_show'] = (int)$data['is_show'];
            if (\Input::hasFile('image')) {
                $author->deleteImage();

                $this->uploader->upload('image')->save('images/authors');

                $data['image'] = $this->uploader->getFilename();
            }

            unset($data['main_image']);

            if (\Input::hasFile('main_image')) {
                $author->deleteImage();

                $this->uploader->upload('main_image')->save('images/rooms/md');

                $data['main_image'] = $this->uploader->getFilename();
            }
            $author->update($data);

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
        $redirect = 'admin.authors.index';
        if ($data['type'] === 1)
          $redirect = 'admin.authors.photograph';
        return redirect()->route($redirect);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        
        $author->delete();
    
        return redirect()->route('admin.authors.index');
    }

    public function userExport() {
        $users = User::all();
        return Excel::create('users', function($excel) use($users) {
            $excel->sheet('Sheet 1', function($sheet) use($users) {
                $sheet->fromArray($users);
            });
        })->export('xls');
    }

}
