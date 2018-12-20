<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Product;
use App\Models\RoomType;
use App\Models\Style;
use App\Models\Section;
use App\Models\Manufacturer;
class ManufacturerController extends Controller {
    
    public function getIndex(Request $request) {

        $manufacturers = Manufacturer::all();
        if ($manufacturers->first()) {
	        $LastModified = $manufacturers->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
	        return response()->view('frontend.manufacturers.index', compact('manufacturers'))->header('Last-Modified', $LastModified);
	    }
	    return response()->view('frontend.manufacturers.index', compact('manufacturers'));
    }
    public function getS($id) {

        $manufacturer = Manufacturer::find($id);
        $products = Product::where('manufacturer_id',$id)->paginate(21);
        
        if ($manufacturer) {
        	$LastModified = $manufacturer->updated_at->format('D, d M Y H:i:s \G\M\T');
            
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
        	return response()->view('frontend.manufacturers.single',compact('manufacturer','products'))->header('Last-Modified', $LastModified);
        }
    	return response()->view('frontend.manufacturers.single',compact('manufacturer','products'));
    }
    
}
