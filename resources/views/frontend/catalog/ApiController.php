<?php namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Roompicturetag;
use App\Models\Product;
  
class ApiController extends Controller {

    public function __construct()
    {

    }
	
    public function index(Request $request)
    {
		 
	}
	
    public function catalog(Request $request)
    {
		 
$count = rand(1, 10);	 
		 
for($i=0;$i<$count;$i++) {	

$arr0 = array(
        "name" => "Столик Helvetia",
        "image" => "/images/products/082743-Eichholtz_helvetia.jpg",
        "url" => "/ru/product/639",
        "price" => "1000"
    );
	 
$arr[] = $arr0;
 
}

echo json_encode($arr);
	}
	
    public function tag(Request $request, $id)
    {
		/*
		$product = Product::find($id);
		
    	if ($product->relative)
    		$products2 = $product->relative->products;
		
		print_r($product);
		
		die();
		*/
		//$request->tag_id
		
    	$ctag = Roompicturetag::find($request->tag_id);
    	$product = Product::find($id);
    	$products = [];
    	$products2 = [];
		
    	if ($product->relative)
    		$products = $product->relative->products;
		  
    	if ($product->relative)
    		$products2 = $product->relative->products;
		 
		
    	return response()->json([
			'html' => view('partials.product-tag-new', compact('product', 'ctag', 'products', 'products2'))->render(), 
			'html2' => view('partials.product-tag-new2', compact('product', 'ctag', 'products', 'products2'))->render(), 
			'p_id' => $id]);

		die();
	}
	
}