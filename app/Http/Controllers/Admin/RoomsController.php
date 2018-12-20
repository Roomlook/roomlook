<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Style;
use App\Http\Requests\Admin\Rooms\CreateRoomRequest;
use App\Http\Requests\Admin\Rooms\UpdateRoomRequest;

class RoomsController extends Controller
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
        $rooms = Room::withTrashed();
        $projectId = '';
        if ($request->has('project_id')) {
            $rooms->where('project_id','=', $request->project_id);
            $projectId = $request->project_id;
        }
        $name = '';
        $roomtypes = array();
        if ($request->has('roomtypes'))
          $roomtypes = $request->roomtypes;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $onpage = 100;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($roomtypes) == 0){
            $rooms = $rooms->orderBy('position', 'ASC')->paginate($onpage)->appends($request->all());
        } else {
            if ($name != '') {
                
                $rooms = $rooms->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(title) LIKE "%'.$name.'%"');
                        });      
            }
            if (count($roomtypes) > 0) {
                $rooms->whereIn('room_type_id',$roomtypes);
            }
            
            $rooms = $rooms->orderBy('position', 'ASC')->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        // $rooms = $rooms->latest()->paginate(20);

        $no = $rooms->firstItem();

        return view('admin.rooms.index', compact('rooms', 'no','projectId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function duplicate($id) {
        $model = Room::find($id);
        $newModel = $model->replicate();
        $newModel->push();
        return back();
    }
    public function create()
    {
        $styles = Style::lists('name','id');
        
        return view('admin.rooms.create',compact('styles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRoomRequest $request)
    {
        $data = $request->all();
        
        $data['ru']['slug'] = str_slug($data['ru']['title'], '_');
        $data['en']['slug'] = str_slug($data['en']['title'], '_');
        $room = Room::create($data);
        if ($request->has('styles'))
            $room->styles()->attach($data['styles']);
        return redirect()->route('admin.rooms.index',['project_id'=>$room->project_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove(Request $request) {
        $ids = $request->ids;
        if (count($ids) == 0) {
            return "nothing to remove";
        }
        $models = Room::withTrashed()->whereIn('id',$ids)->get();
        foreach($models as $model) {
            $model->forceDelete();
        }
        return "removed";
        
    }
    public function enable($id)
    {
        $model = Room::withTrashed()->where('id',$id)->first();
        if ($model->trashed()){
            $model->restore();
            foreach ($model->pictures()->withTrashed()->get() as $rel) {
                $rel->restore();
            }
        }
        else {
            $model->delete();
            foreach ($model->pictures()->withTrashed()->get() as $rel) {
                $rel->delete();
            }
        }
        return redirect()->route('admin.rooms.index', ['project_id' => $model->project_id]);
    }
    public function show($id)
    {
        $room = Room::withTrashed()->where('id',$id)->first();

        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $room = Room::withTrashed()->where('id',$id)->first();
        $styles = Style::lists('name','id');
        $room_style = $room->styles->lists('id');
        
        return view('admin.rooms.edit', compact('room', 'styles','room_style'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRoomRequest $request, $id)
    {       
        $room = Room::withTrashed()->where('id',$id)->first();
        $data = $request->all();
        $data['ru']['slug'] = str_slug($data['ru']['title'], '_');
        $data['en']['slug'] = str_slug($data['en']['title'], '_');
        $room->update($data);
        if (isset($data['styles'])) {
            $room->styles()->attach($data['styles']);
    
        }
        
        return redirect()->route('admin.rooms.index', ['project_id' => $room->project_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $room = Room::withTrashed()->where('id',$id)->first();
        $projectId = $room->project_id;
        $room->forceDelete();
    
        return redirect()->route('admin.rooms.index', ['project_id' => $projectId]);
    }

}
