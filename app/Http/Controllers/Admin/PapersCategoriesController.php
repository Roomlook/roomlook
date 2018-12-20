<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaperCategories;
use App\Http\Requests\Admin\Papers\CreatePaperRequest;
use App\Http\Requests\Admin\Papers\UpdatePaperRequest;
 
class PapersCategoriesController extends Controller
{
    public function __construct()
    {
        //
    }
 
    public function index(Request $request)
    { 
        $name = '';
        $filters = array();
		
		/*
        if ($request->has('filters'))
          $filters = $request->filters;
	  
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
	  
        $projects = Paper::withTrashed()->where('id','>',0);
		
        if ($name != '') {
                $projects = $projects->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
                        
            }
        $projects = $projects->orderBy('order', 'DESC')->get();
		*/
		 
		$projects = PaperCategories::withTrashed()->where('id','>',0);
		
        $projects = $projects->orderBy('id', 'DESC')->get();
        
        return view('admin.papers_categories.index', compact('projects'));
    }
 
    public function create()
    {
        return view('admin.papers_categories.create');
    }
 
    public function duplicate($id) {
        $model = Project::withTrashed()->where('id',$id)->first();
        $newModel = $model->replicate();
        $newModel->push();
        return back();
    }
    public function store(CreatePaperRequest $request)
    {
        $data = $request->all();
		
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
		
		/*
        if (!isset($data['is_home_slider']))
            $data['is_home_slider'] = 0;
        if (!isset($data['is_new']))
            $data['is_new'] = 0;

        $project = Paper::create($data);
		*/ 
		
        $paper = Paper::create($data);
		
        return redirect()->route('admin.papers_categories.index');
    }
 
    public function show($id)
    {
        $paper = Paper::withTrashed()->where('id',$id)->first();

        return view('admin.papers_categories.show', compact('paper'));
    }
 
    public function edit($id)
    {
        $paper = Paper::withTrashed()->where('id',$id)->first();
    
        return view('admin.papers_categories.edit', compact('paper'));
    }
 
    public function update(UpdatePaperRequest $request, $id)
    {   
        $data = $request->all();
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
        
		/*
        if (!isset($data['is_home_slider']))
            $data['is_home_slider'] = 0;
        if (!isset($data['is_new']))
            $data['is_new'] = 0;
		*/
		
        $paper = Paper::withTrashed()->where('id',$id)->first();
        $paper->update($data);

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
        $projects = Paper::withTrashed()->whereIn('id',$ids)->get();
        foreach($projects as $project) {
            $project->forceDelete();
        }
        return "removed";
        
    }
    public function enable($id)
    {
        $project = Paper::withTrashed()->where('id',$id)->first();
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
        return redirect()->route('admin.papers_categories.index');
    }
    public function destroy($id)
    {
        $project = Paper::withTrashed()->where('id',$id)->first();
        
        $project->forceDelete();
    
        return redirect()->route('admin.papers_categories.index');
    }

    public function changeOrder(Request $request)
    {   
        foreach ($request->indexes as $index => $project_id) {
            Paper::where('id', $project_id)->update([
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
