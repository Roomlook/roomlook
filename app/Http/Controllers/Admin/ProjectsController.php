<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\Admin\Projects\CreateProjectRequest;
use App\Http\Requests\Admin\Projects\UpdateProjectRequest;
 
use Image;


class ProjectsController extends Controller
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
        $projects = Project::withTrashed()->where('id','>',0);
        if ($name != '') {
                $projects = $projects->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
                        
            }
        $projects = $projects->orderBy('order', 'DESC')->get();
        
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function duplicate($id) {
        $model = Project::withTrashed()->where('id',$id)->first();
        $newModel = $model->replicate();
        $newModel->push();
        return back();
    }
    public function store(CreateProjectRequest $request)
    {
        $data = $request->all();
		
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
		
        if (!isset($data['is_home_slider']))
            $data['is_home_slider'] = 0;
        if (!isset($data['is_new']))
            $data['is_new'] = 0;
		 
        if (!isset($data['is_active'])) {
		$data['is_active'] = 0; }else{
		$data['is_active'] = 1;				
		} 
		
        if ($request->hasFile('cropimage')) {
            $file = $request->file('cropimage');
            $picture = '';
			
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/projects/';
			 
			$img = Image::make($file); 
			$img->crop($data['width'], $data['height'], $data['x'], $data['y']);
			$img->save($destinationPath.$picture, 100);
			
            //Image::make($file)->save( $destinationPath.$picture);
            $img->move($destinationPath, $picture);
			
            $data['cropimage'] = $picture; 
            //$data['en']['cropimage'] = $picture; 
			//$data['ru']['cropimage'] = $picture; 
			
        }
		  
        $project = Project::create($data);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project = Project::withTrashed()->where('id',$id)->first();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $project = Project::withTrashed()->where('id',$id)->first();
    
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {   
        $data = $request->all();
		
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
        
        if (!isset($data['is_home_slider']))
            $data['is_home_slider'] = 0;
        if (!isset($data['is_new']))
            $data['is_new'] = 0;
        $project = Project::withTrashed()->where('id',$id)->first();
        
        if (!isset($data['is_active'])) {
		$data['is_active'] = 0; }else{
		$data['is_active'] = 1;				
		} 
		
        if ($request->hasFile('cropimage')) {
            $file = $request->file('cropimage');
            $picture = '';
			
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/projects/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file); 
			$img->crop($data['width'], $data['height'], $data['x'], $data['y']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['cropimage'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        } 
		 
		$project->update($data);
		 
        //return redirect()->route('admin.projects.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function remove(Request $request) {
        $ids = $request->ids;
        if (count($ids) == 0) {
            return "nothing to remove";
        }
        $projects = Project::withTrashed()->whereIn('id',$ids)->get();
        foreach($projects as $project) {
            $project->forceDelete();
        }
        return "removed";
        
    }
    public function enable($id)
    {
        $project = Project::withTrashed()->where('id',$id)->first();
        if ($project->trashed()){
            $project->restore();
            foreach ($project->rooms()->withTrashed()->get() as $room) {
                $room->restore();
            }
        }
        else {
            $project->delete();
            foreach ($project->rooms as $room) {
                $room->delete();
            }
        }
        return redirect()->route('admin.projects.index');
    }
    public function destroy($id)
    {
        $project = Project::withTrashed()->where('id',$id)->first();
        
        $project->forceDelete();
    
        return redirect()->route('admin.projects.index');
    }

    public function changeOrder(Request $request)
    {   
        foreach ($request->indexes as $index => $project_id) {
            Project::where('id', $project_id)->update([
                'order' => 1000 - $index
            ]);
        }
        // $projects = Project::withTrashed()->where('id','>',0)->orderBy('order', 'desc')->get();
        // $project = $projects[$request->old_index];
        // $projectOld = $projects[$request->new_index];
        // $project->order = $projectOld->order + 1;
        // $project->save();
        return ['status' => 'succes'];
    }

}
