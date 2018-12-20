<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\ManufacturerTranslation;
use App\Models\Store;
use App\Models\StoreTranslation;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\ProductTranslation;
use App\Models\City;
use App\Models\StoreCity;
use App\Models\Idea;
use App\Models\ProductRelationship;
use App\Models\Pcategory;
use App\Models\PcategoryTranslation;
use App\Http\Requests\Admin\Products\CreateProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use Pingpong\Admin\Uploader\ImageUploader;
use Carbon\Carbon;
use App\Models\RoomPicture;
use Response;
use Validator;
use Image;
use Maatwebsite\Excel\Facades\Excel;
/**
 * 
 */
class IdeasController extends Controller
{
	public function getIdeas()
    {
        $ideas = Idea::paginate(20);
        
        return view('frontend.ideas.index', compact('ideas'));
    }
}