<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Paper;
use App\Models\PaperCategories; 
use App\Http\Requests\Admin\Papers\CreatePaperRequest;
use App\Http\Requests\Admin\Papers\UpdatePaperRequest;
 
use Image;

class PapersController extends Controller
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
		 
		$projects = Paper::withTrashed()->where('id','>',0);
		
        $projects = $projects->orderBy('id', 'DESC')->get();
        
        return view('admin.papers.index', compact('projects'));
    }
 
    public function create()
    {
		 
		$categories = \DB::table('paper_categories')
							->leftJoin('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id')
							->where('locale', 'ru')
							->get();
							
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->where('locale', 'ru')
							->get();
							 
        return view('admin.papers.create', compact('categories', 'tags'));
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
		
		/*
        if (!isset($data['is_home_slider']))
            $data['is_home_slider'] = 0;
        if (!isset($data['is_new']))
            $data['is_new'] = 0;
		*/
		 
		$categories = (isset($data['categories']))?$data['categories']:array();
		
		$data['categories'] = implode(";", $categories); 
		
		$tags = (isset($data['tags']))?$data['tags']:array();
		 
		$data['tags'] = implode(";", $tags); 
		
        if ($request->hasFile('cropimage')) {
            $file = $request->file('cropimage');
            $picture = '';
			
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/papers/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file); 
			$img->crop($data['width'], $data['height'], $data['x'], $data['y']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['images'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        } 
		
        if ($request->hasFile('cropimage2')) {
            $file2 = $request->file('cropimage2');
            $picture = '';
			
            $filename = $file2->getClientOriginalName();
            $extension = $file2->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/papers/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file2); 
			$img->crop($data['width2'], $data['height2'], $data['x2'], $data['y2']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['images'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        } 
		 
        $paper = Paper::create($data);
		
        return redirect()->route('admin.papers.index');
    }
	
    public function add_image(Request $request)
    { 
	 
        if ($request->hasFile('files')) {
            $file = $request->file('files');			 
            $picture = '';
            $destinationPath = public_path() . '/images/papers/articles/';
			
			
            $filename = $file[0]->getClientOriginalName();
            $extension = $file[0]->getClientOriginalExtension();
			 
            $picture = date('His').'-'.trim($filename);
			 
			$img = Image::make($file[0]); 
			$img->save($destinationPath.$picture, 100); 
			
			chmod($destinationPath.$picture, 0777); 
			
			/*
		$count = count($file); 
		$data = array();
		$i = 0;
		
		foreach($file as $f) {
            $filename = $f->getClientOriginalName();
            $extension = $f->getClientOriginalExtension();
			
            $picture = date('His').'-'.trim($filename);
			 
			$img = Image::make($file[1]); 
			$img->save($destinationPath.$picture, 100); 
			
			chmod($destinationPath.$picture, 0777); 
			
			$data[] = array( 
				'filename' => $picture,
				'url' => $destinationPath.$picture
				); 
		$i++;	
		}
				
		return array(
			'error' => false,
			'count' => '1',
			'data' => $data
			);
			
		die(); 
			 */
		 
		if(isset($file[2])) {	
		
            $filename3 = $file[2]->getClientOriginalName();
            $extension3 = $file[2]->getClientOriginalExtension();
			
            $picture3 = date('His').'-'.trim($filename3);
			 
			$img3 = Image::make($file[2]); 
			$img3->save($destinationPath.$picture3, 100); 
			
			chmod($destinationPath.$picture3, 0777); 
			
            $filename2 = $file[1]->getClientOriginalName();
            $extension2 = $file[1]->getClientOriginalExtension();
			
            $picture2 = date('His').'-'.trim($filename2);
			 
			$img2 = Image::make($file[1]); 
			$img2->save($destinationPath.$picture2, 100); 
			
			chmod($destinationPath.$picture2, 0777); 
		
		return array(
			'error' => false,
			'count' => '3',
			'filename' => $picture,
			'filename2' => $picture2,
			'filename3' => $picture3,
			'url' => $destinationPath.$picture
			);
		}elseif($file[1]) {	
		
            $filename2 = $file[1]->getClientOriginalName();
            $extension2 = $file[1]->getClientOriginalExtension();
			
            $picture2 = date('His').'-'.trim($filename2);
			 
			$img2 = Image::make($file[1]); 
			$img2->save($destinationPath.$picture2, 100); 
			
			chmod($destinationPath.$picture2, 0777); 
			
		return array(
			'error' => false,
			'count' => '2',
			'filename' => $picture,
			'filename2' => $picture2,
			'url' => $destinationPath.$picture
			);
		}else{		
		return array(
			'error' => false,
			'count' => '1',
			'filename' => $picture,
			'url' => $destinationPath.$picture
			);
		}
			
		}else{
			
		return array(
			'error' => true 
			);
		
		}
		
        if ($request->hasFile('cropimage')) {
            $file = $request->file('cropimage');
            $picture = '';
			
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/papers/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file); 
			$img->crop($data['width'], $data['height'], $data['x'], $data['y']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['images'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        } 

        if ($request->hasFile('cropimage2')) {
            $file2 = $request->file('cropimage2');
            $picture = '';
			
            $filename = $file2->getClientOriginalName();
            $extension = $file2->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/papers/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file2); 
			$img->crop($data['width2'], $data['height2'], $data['x2'], $data['y2']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['images2'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        }		
		
	}
 
    public function show($id)
    {
        $paper = Paper::withTrashed()->where('id',$id)->first();

        return view('admin.papers.show', compact('paper'));
    }
 
    public function edit($id)
    {
        $paper = Paper::withTrashed()->where('id',$id)->first();
		
		$categories = \DB::table('paper_categories')
							->leftJoin('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id')
							->where('locale', 'ru')
							->get();
							
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->where('locale', 'ru')
							->get();
	 
        return view('admin.papers.edit', compact('paper', 'categories', 'tags'));
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
		 
		$categories = (isset($data['categories']))?$data['categories']:array();
		
		$data['categories'] = implode(";", $categories); 
		
		$tags = (isset($data['tags']))?$data['tags']:array();
		 
		$data['tags'] = implode(";", $tags); 
		 		
        if ($request->hasFile('cropimage')) {
            $file = $request->file('cropimage');
            $picture = '';
			
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/papers/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file); 
			$img->crop($data['width'], $data['height'], $data['x'], $data['y']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['images'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        } 
		
        if ($request->hasFile('cropimage2')) {
            $file2 = $request->file('cropimage2');
            $picture = '';
			
            $filename = $file2->getClientOriginalName();
            $extension = $file2->getClientOriginalExtension();
			
            $picture = date('His').'-'.$filename;
            $destinationPath = public_path() . '/images/papers/';
            
			//Image::make($file)->save( $destinationPath.$picture);
            // $file->move($destinationPath, $picture);
			 
			$img = Image::make($file2); 
			$img->crop($data['width2'], $data['height2'], $data['x2'], $data['y2']);
			$img->save($destinationPath.$picture, 100);
			 
            //Image::make($file)->save( $destinationPath.$picture);
            //$img->move($destinationPath, $picture);
						
            $data['images2'] = $picture; 
			//$data['cropimage'] = $picture; 
			
        }
		
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
        return redirect()->route('admin.papers.index');
    }
    public function destroy($id)
    {
        $project = Paper::withTrashed()->where('id',$id)->first();
        
        $project->forceDelete();
    
        return redirect()->route('admin.papers.index');
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
