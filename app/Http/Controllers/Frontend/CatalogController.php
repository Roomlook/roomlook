<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Pcategory;
use App\Models\PcategoryTranslation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Product; 
use App\Models\ProductTranslation;
use App\Models\RoomType;
use App\Models\ProductPicture;
use App\Models\Style;
use App\Models\Section;
use App\Models\Store;
use App\Models\StoreTranslation;
use App\Models\Manufacturer;
use App\Models\ManufacturerTranslation;
class CatalogController extends Controller {
	 
	public function makeSlug()
	{
		$categories = PcategoryTranslation::all();
		foreach ($categories as $category) {
			$category->slug = str_slug($category->name);
			$category->save(); 
		}

		$manufacturers = ManufacturerTranslation::all();
		foreach ($manufacturers as $manufacturer) {
			$manufacturer->slug = str_slug($manufacturer->name);
			$manufacturer->save();
		}
		return 0;
	}

	public function getIndex(Request $request)
	{ 
		$products = Product::where('id','>','0');
		$view = "frontend.catalog.index";
		$category = '';
		$pcategories = Pcategory::parents();
		$path = '/catalog';

		if (!$request->has('section') && !$request->has('manufacturer') && !$request->has('category_id')) {
			//$view = "frontend.catalog.pcategories";
			$view = "frontend.catalog.index2";
		}
		
		if ($request->has('category_id')) {
			$category = Pcategory::find($request->category_id);
			$slug = PcategoryTranslation::where('pcategory_id', $request->category_id)->first()->slug;
			if ($category->parent_id == null) {
				$path .= '/'.$slug;
			}
			else {
				$subslug = PcategoryTranslation::where('pcategory_id', $category->parent_id)->first()->slug;
				$path .= '/'.$subslug.'/'.$slug;
			}
			if ($request->has('manufacturer_id')) {
				$mn = Manufacturer::find($request->manufacturer_id);
				$slug = ManufacturerTranslation::where('manufacturer_id', $request->manufacturer_id)->first()->slug;
				$path .= '/'.$slug;
			}
		}
		
		if ($request->has('category_id')) {
			return redirect($path);
		}
		
		$sections = Section::all();
		$manufacturers = ManufacturerTranslation::join('manufacturers', 'manufacturers.id', '=', 'manufacturer_translations.manufacturer_id')->where('manufacturers.deleted_at', NULL)->where('manufacturer_translations.locale', \App::getLocale())->orderBy('name', 'ASC')->get();
		
		$catalogs = Pcategory::parents();
		$ccatalogs = Pcategory::all();

		$products = $products->orderBy('id','DESC')->paginate(30);
		
		/*теги для фильтров*/
		$tags_group = \DB::table('tag_group_translations') 
							->where('locale', 'ru') 
							->get(array( 
								'tag_group_translations.tag_group_id',
								'tag_group_translations.title'
							));
		foreach($tags_group as $tg) { 
		$tags[] = \DB::table('tag_translations') 
							->where('tag_group_id', $tg->tag_group_id) 
							->where('locale', 'ru') 
							->get(array( 
								'tag_translations.tag_id',
								'tag_translations.title'
							));
		}
		/**/
		
		if ($products->first()) {
	        $LastModified = $products->first()->updated_at->format('D, d M Y H:i:s \G\M\T'); 
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view($view,compact('products','catalogs','tags','ccatalogs','pcategories','category','request','manufacturers','sections'))->header('Last-Modified', $LastModified);
		}
	        $LastModified = $pcategories->first()->updated_at->format('D, d M Y H:i:s \G\M\T'); 
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
		return response()->view($view,compact('products','catalogs','tags','ccatalogs','pcategories','category','request','manufacturers','sections'))->header('Last-Modified', $LastModified);
	}


	public function redirectCatalog(Request $request, $category_slug = null, $subcategory = null, $manufacturer_slug = null) {
		
		$products = Product::where('id','>','0');
		
		$view = "frontend.catalog.index";
		$category = '';
		$pcategories = Pcategory::parents();
		$id = PcategoryTranslation::where('slug', $category_slug)->first()->pcategory_id;
		if (isset($subcategory)) 
			$id = PcategoryTranslation::where('slug', $subcategory)->first()->pcategory_id;

		if (!$request->has('section') && !$request->has('manufacturer') && !isset($category_slug)) {
			//$view = "frontend.catalog.pcategories";
			$view = "frontend.catalog.index";
		}

		if ($request->has('section_id')) {
			$products = $products->whereHas('sections', function($q) use ($request) {
                $q->where('id',$request->section_id);
            });
		}
		if (isset($manufacturer_slug)) {
			$man_id = ManufacturerTranslation::where('slug', $manufacturer_slug)->first()->manufacturer_id;
			$products = $products->whereHas('manufacturer', function($q) use ($man_id) {
                $q->where('id', $man_id);
            });
		}
		if (isset($category_slug)) {
			
			$category = Pcategory::find($id);
			// return $category;
			if ($category->children->count() > 0) {
				$pcategories = $category->children;
				// dd($pcategories);
				// return $pcategories;
				//$view = "frontend.catalog.pcategories";
				$view = "frontend.catalog.index";
			}
			$products = $products->where('pcategory_id', $id);
		}
		$sections = Section::all();
		$manufacturers = ManufacturerTranslation::join('manufacturers', 'manufacturers.id', '=', 'manufacturer_translations.manufacturer_id')->where('manufacturers.deleted_at', NULL)->where('manufacturer_translations.locale', \App::getLocale())->orderBy('name', 'ASC')->get();
		
		$products = $products->orderBy('id','DESC')->paginate(30);
				
		foreach($products as $prod) {
		
			$img = \DB::table('product_pictures')->where('product_id', $prod['id'])->first();
			$prod['image'] = $img->image;
					
			$products2[] = $prod;
		
		}
				
		if ($products->first()) {
	        $LastModified = $products->first()->updated_at->format('D, d M Y H:i:s \G\M\T'); 
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view($view,compact('products','products2','pcategories','category','request','manufacturers','sections'))->header('Last-Modified', $LastModified);
		}
	        $LastModified = $pcategories->first()->updated_at->format('D, d M Y H:i:s \G\M\T'); 
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
		return response()->view($view,compact('products','products2','pcategories','category','request','manufacturers','sections'))->header('Last-Modified', $LastModified);

	}
	public function getAttachImage() {
		foreach (Product::all() as $product) {
			$picture = ProductPicture::create(['product_id' => $product->id, 'image' => $product->image]);
		}
	}

	
	/* карточка товара */
	
	public function redirectProduct(Request $request, $category_slug, $subcategory = null, $product_slug)
	{ 
	
		$product_id = ProductTranslation::where('slug', $product_slug)->first()->product_id;
		$product = Product::find($product_id);
		$products = [];
		$products2 = [];
		  
			$img = \DB::table('product_pictures')->where('product_id', $product['id'])->first();
			$product['image'] = $img->image;
				  
		if ($product->relative)
			$products = $product->relative->products;
		
		//if ($product->relative)
			//$products2= $product->oneTags;
		
		$harac = \DB::table('product_tags')
							->where('product_id', $product_id)
							->leftJoin('tag_translations', 'product_tags.tags_products_id', '=', 'tag_translations.tag_id')
							->leftJoin('tag_group_translations', 'tag_group_translations.tag_group_id', '=', 'tag_translations.tag_group_id')
							->where('tag_translations.locale', 'ru')
							->where('tag_group_translations.locale', 'ru')
							->orderby('tag_group_id')
							->get(array(
								'tag_translations.tag_id',
								'tag_translations.tag_group_id',
								'tag_translations.slug',
								'tag_translations.title as name',
								'tag_group_translations.title'
							));
		
		$html = '<div class="params">';
		
		foreach($harac as $t) {  
		
		if(isset($tid) && $tid == $t->tag_group_id) { $h = true; }else{ $h = false; $html .= '</p>'; }
		$tid = $t->tag_group_id;
		
		$group = \DB::table('tag_group_translations')
							->where('tag_group_translations.locale', 'ru')
							->where('tag_group_translations.tag_group_id', $tid)
							->first(); 
		 
		if($group) { $gtitle = $group->title; }else{ $gtitle = ''; } 
		
		if($h == false) {
			$html .= '<p class="param-item"><b>'.$gtitle.': </b>';
			$html .= $t->name.', '; 
		}else{
			$html .= $t->name.', ';
		}  
		} 
		
		$html .= '</div>';
		 
		/*		
		$relat = \DB::table('product_translations')
							->leftJoin('product_tags', 'product_tags.tags_products_id', '=', 'product_translations.product_id')
							->leftJoin('tag_translations', 'product_tags.tags_products_id', '=', 'tag_translations.tag_id')
							->leftJoin('tag_group_translations', 'tag_group_translations.tag_group_id', '=', 'tag_translations.tag_group_id')
							->where('tag_translations.locale', 'ru')
							->where('tag_group_translations.locale', 'ru')
							->where('product_translations.locale', 'ru')
							->get(array(
								'tag_translations.slug',
								'tag_translations.title as name',
								'tag_group_translations.title'
							));
		
		$relat = \DB::table('product_translations')
							->leftJoin('product_tags', 'product_tags.product_id', '=', 'product_translations.product_id')
							->where('product_translations.product_id', '=', 132)  
							->avg('product_tags.tags_products_id')
							->get();
							//->get(array('product_translations.*', 'product_tags.*', 'product_translations.product_id as id'));
		*/
		 
		$products = \DB::table('product_tags');  
        $products->select(\DB::raw('count(*) as count, product_id'));   
			
		foreach($harac as $h) {
			 	
			$products->orWhere('tags_products_id', $h->tag_id); 
			  
		}	
        $products->groupBy('product_id');
        $products->havingRaw('count > 4');
		$result = $products->get();
			  
		if($product->pcategory_id != 99) {  
			  
		foreach($result as $r) {	  
		
		$product_relative[] = Product::where('id', $r->product_id)
									->where('pcategory_id', $product->pcategory_id)
									->first();
			 
		}
		
		}else{
				  
		foreach($result as $r) {	  
		
		$product_relative[] = Product::where('id', $r->product_id)
									->where('pcategory_id', $product->pcategory_id)
									->orWhere('pcategory_id', 27)
									->first();
			 
		}
			
		}
		
		$store = \DB::table('store_product')
					->leftJoin('store_translations', 'store_translations.store_id', '=', 'store_product.store_id')
					->leftJoin('stores', 'stores.id', '=', 'store_product.store_id')
					->where('product_id', $product->id)
					->first();   
		  
		if ($product) {
	        $LastModified = $product->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view('frontend.catalog.product', compact('product', 'products', 'html', 'product_relative', 'store', 'harac'))->header('Last-Modified', $LastModified);
		}
		
		return response()->view('frontend.catalog.product', compact('product', 'products', 'html', 'product_relative', 'store', 'harac'));
	
	}

	public function getProduct($id) 
	{
	 
		$product = Product::find($id);
		$pcategory = Pcategory::find($product->pcategory_id);
		$pcategory_slug = PcategoryTranslation::where('pcategory_id', $product->pcategory_id)->first()->slug;
		 
		if ($pcategory->parent_id != null) {
			$subcategory_slug = PcategoryTranslation::where('pcategory_id', $pcategory->parent_id)->first()->slug;
			return redirect('/product/'.$pcategory_slug.'/'.$subcategory_slug.'/'.$product->slug);
		}
		
		return redirect('/product/'.$pcategory_slug.'/'.$product->slug);
		
	}
}