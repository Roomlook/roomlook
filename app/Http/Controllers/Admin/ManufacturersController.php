<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\ManufacturerTranslation;
use App\Http\Requests\Admin\Manufacturers\CreateManufacturerRequest;
use App\Http\Requests\Admin\Manufacturers\UpdateManufacturerRequest;
use Pingpong\Admin\Uploader\ImageUploader;
use Validator;
use App\Models\Pcategory;
use Maatwebsite\Excel\Facades\Excel;
class ManufacturersController extends Controller
{
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
        $manufacturers = Manufacturer::latest()->paginate(20);
        $name = '';
        $filters = array();
        if ($request->has('filters'))
          $filters = $request->filters;
        if ($request->has('pName'))
          $name = mb_strtoupper($request->pName);
        $manufacturers = Manufacturer::where('id','>',0);
        $onpage = 20;
        if ($request->has('onpage'))
            $onpage = $request->onpage;
        if($name == '' && count($filters) == 0){
            $manufacturers = $manufacturers->latest()->paginate($onpage);
        } else {
            if ($name != '') {

                $manufacturers->whereHas('translations', function ($query) use ($name) {
                             $query->whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        });
                // whereRaw('UPPER(name) LIKE "%'.$name.'%"');
                        
            }
            
            $manufacturers = $manufacturers->latest()->paginate($onpage)->appends($request->all());
            
            // $products = Product::whereTranslation('name','like',$name)->latest()->paginate(20);
            // dd($products);
        }
        
        $no = $manufacturers->firstItem();

        return view('admin.manufacturers.index', compact('manufacturers', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateManufacturerRequest $request)
    {
        $data = $request->all();
        $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
        $data['en']['slug'] = str_slug($data['en']['name'], '_');
        unset($data['logo']);
        if($request->hasFile('logo')){
            $this->uploader->upload('logo')->save('images/manufacturers');
            $data['logo'] = $this->uploader->getFilename();
        }
        $manufacturer = Manufacturer::create($data);

        return redirect()->route('admin.manufacturers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        return view('admin.manufacturers.show', compact('manufacturer'));
    }

    public function importExcel()
    {
        // $manufacturer = Manufacturer::findOrFail($id);
        // return phpinfo();
        return view('admin.manufacturers.import-excel');
    }
    public function postImportExcel()
    {
        $rules = array(
            'file' => 'required',
        );

        $validator = Validator::make(\Input::all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return redirect('/admin/manufacturers/import-excel')->withErrors($validator);
        }
        else 
        {
            try {
                $readerArr = array();
                Excel::load(\Input::file('file'), function ($reader) {
                    $readerArr = $reader->toArray();
                    $data = array();
                    foreach ($readerArr as $row) {
                        $manufacturer = '';
                        if (ManufacturerTranslation::where('name', $row['name_ru'])->get()->count() > 0) {
                            $manufacturerTranslation = ManufacturerTranslation::where('name', $row['name_ru'])->first();
                            $manufacturer = Manufacturer::find($manufacturerTranslation->manufacturer_id)->first();
                        }
                        $data['ru']['name'] = $row['name_ru'];
                        $data['en']['name'] = $row['name_en'];
                        $data['url'] = $row['url'];
                        $data['en']['body'] = $row['description_en'];
                        $data['ru']['body'] = $row['description_ru'];
                        $data['logo'] = $row['logo'];
                        if ($manufacturer instanceof Manufacturer) {
                            $manufacturer->update($data);
                        }
                        else {
                            $manufacturer = Manufacturer::create($data);
                        }
                    }
                });
                \Session::flash('success', 'Manufacturers uploaded successfully.');
                return redirect('/admin/manufacturers');
            } catch (\Exception $e) {
                \Session::flash('error', $e->getMessage());
                return redirect('/admin/manufacturers');
            }
        } 
        return redirect('/admin/manufacturers/');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
    
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateManufacturerRequest $request, $id)
    {
        try{
            $manufacturer = Manufacturer::findOrFail($id);
            $data = $request->all();
            $data['ru']['slug'] = str_slug($data['ru']['name'], '_');
            $data['en']['slug'] = str_slug($data['en']['name'], '_');
            unset($data['logo']);
            if($request->hasFile('logo')){
				
                $manufacturer->deleteImage();
                $this->uploader->upload('logo')->save('images/manufacturers');
                $data['logo'] = $this->uploader->getFileName();
				 
            }
            $manufacturer->update($data);
        }catch (Exception $e){
            return $this->redirectNotFound();
        }
        return redirect()->route('admin.manufacturers.index', [
            'pName' => $request->pName_page, 
            'onpage' => $request->page_onpage]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        
        $manufacturer->delete();
    
        return redirect()->route('admin.manufacturers.index');
    }

}
