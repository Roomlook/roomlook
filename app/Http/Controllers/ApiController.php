<?php namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use DB;  
use App\Models\Roompicturetag; 
use App\Models\Product; 
use App\Models\ProductTranslation;
use App\Models\Pcategory;
use App\Models\PcategoryTranslation;
use App\Models\Room;
use App\Models\RoomTranslation;
use App\Models\Tags; 
use App\Models\TagTranslation;
  
class ApiController extends Controller {

    public function __construct()
    {

    }
	
    public function index(Request $request)
    {
		 
	}
		
    public function group_products(Request $request)
    {    
		$attr = $request->input('group');   
	  
		$array = explode(",", $attr);
		
		if(count($array)<3) die();
	  
		$tags = DB::table('product_tags'); 
		
		foreach($array as $a) {
		$tags->orWhere('product_tags.tags_products_id', $a); 
		}
		
		$tags->distinct();		
		$res = $tags->get(array('product_tags.product_id', 'product_tags.tags_products_id'));
	 			  
		$html = '<div>';
		 
		foreach($res as $t) {
			
			$product = Product::find($t->product_id);
			  
			$html .= '<div class="item product col-md-1">
					<div>
					
					<input type="checkbox" name="product_check[]" value="'.$product->id.'" />
					
						<a href="/ru/product/'.$product->id.'" tabindex="-1" data-product-id="'.$product->id.'" class="popup-product-open">
						<div><img src="/'.$product->imagePath().'" class="center img-responsive" alt=""></div>
						<div><p style="font-size:12px;line-height:13px;height:40px;" class="title">'.$product->name.'</p></div>
						</a>
					</div>
					</div>';
			
		}
		
		$html .= '</div>';
				
		echo json_encode($html);
		die();		
	}
	
    public function groupt($id)
    {    
		$tags = \DB::table('tags')
					->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
					->where('tag_translations.tag_group_id', $id)
					->where('locale', 'ru')
					->get(array('tags.id', 'tag_translations.title as text'));
					
		echo json_encode($tags);			
	}
	
    public function catalog_tree(Request $request)
    {  
		$room_id = $request->input('room_id'); 
		
    	$pr = \DB::table('product_room')->where('product_room_id', $room_id)->get();
		
		$categories2 = array();
		
		foreach($pr as $p) {
			
			$pt = \DB::table('products777')->where('id', $p->product_id)->first();
			
			$ct = \DB::table('pcategories')->where('id', $pt->pcategory_id)->first();
			 
			if($ct->parent_id!=0) $categories2[] = $ct->parent_id;
			$categories2[] = $ct->id;
			
			//$categories2[] = 
			
		} 

		$pcategories = Pcategory::parents();
		$categories = Pcategory::all();
		
		$html = '<h2>Раздел</h2><ul>';
		 
		//LaravelLocalization::getCurrentLocale()
		
		foreach($pcategories as $sParent) {
			
			//if ($category->getParents()->get()->contains($sParent->id))
			//$html .= '<li class="active"><li class="">';
		  
		if($sParent->parent_id == 0) {
			
			if (!in_array($sParent->id, $categories2) && $room_id!=0) {
				continue;
			}
		
			$html .= ($request->input('category_id')==$sParent->id)?'<li class="active">':'<li class="">';
			
			$html .= '<a class="category" data-category="'.$sParent->id.'" href="/ru/catalog?category_id='.$sParent->id.'">'.$sParent->name.'</a>';
			
			$html .= '<ul> ';
			foreach($categories as $sChild) {
				
			if (!in_array($sChild->id, $categories2) && $room_id!=0) {
				continue;
			}
				
				if($sChild->parent_id == $sParent->id) {
					$html .= ($request->input('category_id')==$sChild->id)?'<li class="active">':'<li class="">';
					$html .= '<a class="category" data-category="'.$sChild->id.'" href="/ru/catalog?category_id='.$sChild->id.'">'.$sChild->name.'</a></li> '; }
				
			}
			$html .= '</ul> ';
			
			$html .= '</li> ';
			
		}	
			  
        }
		 
		$html .= '<li><a class="" data-room-id="0" href="/ru/catalog">Все разделы</a></li>';
		$html .= '</ul>';
		
		echo json_encode($html); 
	}
	
    public function catalogtest(Request $request)
    {  
		$tag_id = $request->input('tag_id');
		$group_id = $request->input('group_id');
		$sort = $request->input('sort');
		$price_min = $request->input('price_min');
		$price_max = $request->input('price_max');
		$category_id = $request->input('category_id');
		$bread_category = '';
		   
		/*	 
		$products = DB::table('products') 
							->join('product_translations', 'product_translations.product_id', '=', 'products.id')
							->join('product_pictures', 'product_pictures.product_id', '=', 'products.id')
							->join('tag_product', function ($join) {
								
								$join->on('tag_product.product_id', '=', 'products.id');  
								
								$join->where('tag_product.tag_id', '=', 1);	 
								$join->orWhere('tag_product.tag_id', '=', 2);	 
								  
							})  
							->where('locale', 'ru')
							->get(); 
		*/
		 
		$products = DB::table('products777');   
		$products->join('product_translations', 'product_translations.product_id', '=', 'products777.id');
		$products->join('product_pictures', 'product_pictures.product_id', '=', 'products777.id');
		$products->where('locale', 'ru');  
		
		if($tag_id) {  
			
		$products->join('product_tags', 'product_tags.product_id', '=', 'products777.id'); 
		$products->join('tags', 'tags.id', '=', 'product_tags.tags_products_id'); 
			
				$products->where(function ($query) {
                $query->where('product_tags.tags_products_id', 1)
                      ->orWhere('product_tags.tags_products_id', 23);
				}); 
				
			foreach($tag_id as $t){
				/*
			foreach($group_id as $g){
				$products->where('product_tags.tags_products_id', $t); 
				$products->where('tags.tag_group_id', $g);
				$products->where('locale', 'ru'); 
			}   */
			}   
		
		}
		$products->selectRaw('products777.id , count(product_tags.product_id) as total');
		$products->groupBy('product_tags.product_id');
		$products->havingRaw('total > 1');
		
		$result = $products->get(array('product_tags.*', 'tags.*', 'products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
		
		print_r($result);
		die();
		
		
		
		/*
		if($price_min && $price_max)
			$products->whereBetween('products777.price', [$price_min, $price_max]); 
		*/
		
		if($category_id) {
			
			//для хлебных крошек
			$cname = DB::table('pcategory_translation')
									->leftJoin('pcategories', 'pcategory_translation.pcategory_id', '=', 'pcategories.id')
									->where('pcategory_translation.pcategory_id', $category_id)
									->where('pcategory_translation.locale', 'ru')
									->first(); 
									
			$cname2 = DB::table('pcategory_translation')
									->leftJoin('pcategories', 'pcategory_translation.pcategory_id', '=', 'pcategories.id')
									->where('pcategories.parent_id', 0) 
									->where('pcategory_translation.pcategory_id', $cname->parent_id)
									->where('pcategory_translation.locale', 'ru')
									->first(); 
									
			if($cname2)$bread_category .= ' > <a href="#">'.$cname2->name.'</a>';
			$bread_category .= ' > <a href="#">'.$cname->name.'</a>';
			//
			
			$products->where('products777.pcategory_id', $category_id);
			$products->where('locale', 'ru'); 
			  
		$pcategories = DB::table('pcategories')->where('parent_id', $category_id)->get();  
		foreach($pcategories as $pc) {  	
		 
			$products->orWhere('products777.pcategory_id', $pc->id);
			$products->where('locale', 'ru'); 
			
		}
		}
		
		$products->join('product_translations', 'product_translations.product_id', '=', 'products777.id');
		$products->join('product_pictures', 'product_pictures.product_id', '=', 'products777.id');
		$products->where('locale', 'ru'); 
		
		/*
		if($category_id) {
			
			$products->where('products777.pcategory_id', $category_id);
			$products->where('locale', 'ru'); 
			  
		$pcategories = DB::table('pcategories')->where('parent_id', $category_id)->get();  
		foreach($pcategories as $pc) {  	
			
			$products->orWhere('products777.pcategory_id', $pc->id);
			$products->where('locale', 'ru'); 
			
		}
		}
		*/
		
		if($tag_id) {
			
		$products->join('product_tags', 'product_tags.product_id', '=', 'products777.id'); 
		$products->join('tags', 'tags.id', '=', 'product_tags.tags_products_id'); 
			
			foreach($tag_id as $t){
			foreach($group_id as $g){
				$products->orWhere('product_tags.tags_products_id', $t); 
				$products->where('tags.tag_group_id', $g);
				$products->where('locale', 'ru'); 
			}   
			}   
		
		}
 
		if($category_id) {
			
			$products->where('products777.pcategory_id', $category_id);
			$products->where('locale', 'ru'); 
			  
		$pcategories = DB::table('pcategories')->where('parent_id', $category_id)->get();  
		foreach($pcategories as $pc) {  	
			
			$products->orWhere('products777.pcategory_id', $pc->id);
			$products->where('locale', 'ru'); 
			
		}
		} 
		  
/*
				$products->orWhere('tag_product.tag_id', 3); 
				$products->where('tags.tag_group_id', 2);
				$products->where('locale', 'ru'); 
				
				$products->orWhere('tag_product.tag_id', 1); 
				$products->where('tags.tag_group_id', 1);
				$products->where('locale', 'ru'); 
				
				$products->orWhere('tag_product.tag_id', 2); 
				$products->where('tags.tag_group_id', 1);
				$products->where('locale', 'ru'); 
*/ 
 
		if($sort)
			$products->orderBy('price', $sort);
		 
		$page = $request->input('page'); 
		$cpage = $page*12; 
		
		$products->selectRaw('products777.id , count(product_tags.product_id) as total');
		$products->groupBy('product_tags.product_id');
		$products->havingRaw('total > 1');
		
		$count = $products->get(array('products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
				
		$products->offset($cpage);
		$products->limit(12);
		
		$result = $products->get(array('products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
		//$result = $products->paginate(12, array('products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
		//$result = $products->get();
	    
		$html = '';
		 
		foreach($result as $p) { 
		 
		$store = DB::table('store_product');  
			 $store->where('store_product.product_id', $p->id);
			 $store->join('stores', 'store_product.product_id', '=', 'stores.id'); 
			 $store->join('store_translations', 'store_translations.store_id', '=', 'stores.id'); 
		$s = $store->first();
		
		if($s) { $simg = $s->logo; $sslug = $s->slug; }else{ $simg = ''; $sslug = ''; }
		
		//$store->join('store_translations', 'store_translations.store_id', '=', 'stores.id')
		
		$html .= '<div class="item product col-md-3">
					<div>
						<a href="/ru/product/'.$p->id.'" tabindex="-1" data-product-id="'.$p->id.'" class="popup-product-open">
						<div style="height:170px;"><img src="/images/products/'.$p->image.'" class="center img-responsive" alt=""></div>
						<div><h4 class="title">'.$p->name.'</h4></div>
						</a>
						<div class="info">
						<div class="col-md-6">';
		if($p->price < 50) {				
		$html .= '
							<a class="product btn" href="#">Уточняйте цену</a>
							';
		}else{			
		$html .= '
							<strong>'.$p->price.'тг</strong>
							';
		}
							
		$html .= '					
						</div>
						<div class="col-md-6">
						<a href="/store/'.$sslug.'" target="_blank">
							<p>Магазин:</p>
							<div class="store-logo" style="background:url(/images/stores/'.$simg.') center center no-repeat;"></div>
						</a>
						</div>
						
						<div class="clear"></div>
						</div>
					</div>
					</div>';
		
		}
		
		$html .= '<div class="text-center" style="clear:both;">
		<ul class="pagination">';
		 
		$kcount = ceil(count($count)/12); 
		

		
if ($page != 1) $html .= '<li><a data-page="0" href="#"><<</a></li>';
//if ($page != 1) $html .= '<li><a data-page="0" href="#">1</a></li>';
	 
if($page - 2 > 0) $html .= '<li><a data-page="'.($page - 2).'" href="#">'.($page - 2).'</a></li>'; 
if($page - 1 > 0) $html .= '<li><a data-page="'.($page - 1).'" href="#">'.($page - 1).'</a></li>'; 
if($page + 1 <= $kcount) $html .= '<li><a data-page="'.($page + 1).'" href="#">'.($page + 1).'</a></li>'; 
if($page + 2 <= $kcount) $html .= '<li><a data-page="'.($page + 2).'" href="#">'.($page + 2).'</a></li>'; 
  	
//if ($page != $kcount) $html .= '<li><a data-page="'.($page + 1).'" href="#">></a></li>';
if ($page != $kcount) $html .= '<li><a data-page="'.($kcount - 1).'" href="#">'.($kcount - 1).'</a></li>';
if ($page != $kcount) $html .= '<li><a data-page="'.($kcount - 1).'" href="#">>></a></li>';

	
/*
if ($page != 1) $pervpage = '<a href= ./page?page=1><<</a> 
                               <a href= ./page?page='. ($page - 1) .'><</a> '; 


if ($page != $kcount) $nextpage = ' <a href= ./page?page='. ($page + 1) .'>></a> 
                                   <a href= ./page?page=' .$kcount. '>>></a>'; 
*/
								   
/*
// Находим две ближайшие станицы с обоих краев, если они есть 
if($page - 2 > 0) $page2left = ' <a href= ./page?page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
if($page - 1 > 0) $page1left = '<a href= ./page?page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
if($page + 2 <= $kcount) $page2right = ' | <a href= ./page?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
if($page + 1 <= $kcount) $page1right = ' | <a href= ./page?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню 
$html .= $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; 
*/		
		$html .= '</ul></div>';
		
		/*
		for($i=1;$i<ceil($kcount);$i++) {
			 
				$html .= '<li><a data-page="'.$i.'" href="#">'.$i.'</a></li>';
			
		}
		
		
		$html .= '<div class="text-center" style="clear:both;">
		<ul class="pagination"> 
		<li class="disabled"><span>«</span></li> 
		<li class="active"><span>1</span></li>
		<li><a data-page="2" href="#">2</a></li> 
		<li class="disabled"><span>...</span></li><li> 
		<li><a data-page="18" href="#">18</a></li> 
		<li><a data-page="next" href="#" rel="next">»</a></li>
		</ul></div>';
		*/
		
	$bread = '<a href="/ru">Главная</a> > <a href="/ru/catalog">Каталог</a>'.$bread_category;
		
	echo json_encode(array('bread' => $bread, 'data' => $html));
	}
	
    public function catalog(Request $request)
    {  
		$tag_id = ($request->input('tag_id'))?$request->input('tag_id'):'';
		$group_id = $request->input('group_id');
		$sort = $request->input('sort');
		$price_min = $request->input('price_min');
		$price_max = $request->input('price_max');
		$category_id = $request->input('category_id');
		$bread_category = '';
		 
		$products = DB::table('products777');  
		if($price_min && $price_max)
			$products->whereBetween('products777.price', [$price_min, $price_max]); 
		 
		if($category_id) {
			
			//для хлебных крошек
			$cname = DB::table('pcategory_translation')
									->leftJoin('pcategories', 'pcategory_translation.pcategory_id', '=', 'pcategories.id')
									->where('pcategory_translation.pcategory_id', $category_id)
									->where('pcategory_translation.locale', 'ru')
									->first(); 
									
			$cname2 = DB::table('pcategory_translation')
									->leftJoin('pcategories', 'pcategory_translation.pcategory_id', '=', 'pcategories.id')
									->where('pcategories.parent_id', 0) 
									->where('pcategory_translation.pcategory_id', $cname->parent_id)
									->where('pcategory_translation.locale', 'ru')
									->first(); 
									
			if($cname2)$bread_category .= ' > <a href="#">'.$cname2->name.'</a>';
			$bread_category .= ' > <a href="#">'.$cname->name.'</a>';
			//
			
			$products->where('products777.pcategory_id', $category_id);
			$products->where('locale', 'ru'); 
			  
		$pcategories = DB::table('pcategories')->where('parent_id', $category_id)->get();  
		foreach($pcategories as $pc) {  	
		 
			$products->orWhere('products777.pcategory_id', $pc->id);
			$products->where('locale', 'ru'); 
			
		}
		}
		
		$products->join('product_translations', 'product_translations.product_id', '=', 'products777.id');
		$products->join('product_pictures', 'product_pictures.product_id', '=', 'products777.id');
		$products->where('locale', 'ru'); 
		 
		if($tag_id != '') {  
			
		$products->join('product_tags', 'product_tags.product_id', '=', 'products777.id'); 
		$products->join('tags', 'tags.id', '=', 'product_tags.tags_products_id'); 
			
				$products->where(function ($query) use ($tag_id) {
					
				$i=0;
				foreach($tag_id as $t){ 
                if($i==0)$query->where('product_tags.tags_products_id', $t);
                if($i!=0)$query->orWhere('product_tags.tags_products_id', $t);
				$i++;
				}
				
				}); 
				
				/*
			foreach($tag_id as $t){
				foreach($group_id as $g){
				$products->where('product_tags.tags_products_id', $t); 
				$products->where('tags.tag_group_id', $g);
				$products->where('locale', 'ru'); 
			}   
			}   */
		
		}
		 
		if($category_id) {
			
			$products->where('products777.pcategory_id', $category_id);
			$products->where('locale', 'ru'); 
			  
		$pcategories = DB::table('pcategories')->where('parent_id', $category_id)->get();  
		foreach($pcategories as $pc) {  	
			
			$products->orWhere('products777.pcategory_id', $pc->id);
			$products->where('locale', 'ru'); 
			
		}
		} 
		  
/*
				$products->orWhere('tag_product.tag_id', 3); 
				$products->where('tags.tag_group_id', 2);
				$products->where('locale', 'ru'); 
				
				$products->orWhere('tag_product.tag_id', 1); 
				$products->where('tags.tag_group_id', 1);
				$products->where('locale', 'ru'); 
				
				$products->orWhere('tag_product.tag_id', 2); 
				$products->where('tags.tag_group_id', 1);
				$products->where('locale', 'ru'); 
*/ 
 
		if($sort)
			$products->orderBy('price', $sort);
		 
		$page = $request->input('page'); 
		$cpage = $page*12; 
				   		  
		if($tag_id != '') {  
		$products->selectRaw('products777.id, product_pictures.image, products777.price, product_translations.name, product_translations.slug, count(product_tags.product_id) as total');
		$products->groupBy('product_tags.product_id');
		
		if((int)count($tag_id)==1)$products->havingRaw('total = 1');  
		if((int)count($tag_id)==2)$products->havingRaw('total = 2');  
		if((int)count($tag_id)==3)$products->havingRaw('total = 3');  
		if((int)count($tag_id)==4)$products->havingRaw('total = 4');  
		if((int)count($tag_id)==5)$products->havingRaw('total = 5');   
		}
		
		$count = $products->get(array('products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
				
		$products->offset($cpage);
		$products->limit(12);
		
		$result = $products->get(array('products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
		
		//$result = $products->paginate(12, array('products777.id', 'products777.price', 'products777.pcategory_id', 'product_translations.name', 'product_pictures.image', 'product_translations.slug'));
		//$result = $products->get();
	        
		$html = '';
		 
		foreach($result as $p) { 
		 
		$store = DB::table('store_product');  
			 $store->where('store_product.product_id', $p->id);
			 $store->join('stores', 'store_product.product_id', '=', 'stores.id'); 
			 $store->join('store_translations', 'store_translations.store_id', '=', 'stores.id'); 
		$s = $store->first();
		
		if($s) { $simg = $s->logo; $sslug = $s->slug; }else{ $simg = ''; $sslug = ''; }
		
		//$store->join('store_translations', 'store_translations.store_id', '=', 'stores.id')
		
		$html .= '<div class="item product col-md-3">
					<div>
						<a href="/ru/product/'.$p->id.'" tabindex="-1" data-product-id="'.$p->id.'" class="popup-product-open">
						<div style="height:170px;"><img src="https://roomlook.com/images/products/'.$p->image.'" class="center img-responsive" alt=""></div>
						<div><h4 class="title">'.$p->name.'</h4></div>
						</a>
						<div class="info">
						<div class="col-md-6">';
		if($p->price < 50) {				
		$html .= '
							<a class="product btn" href="#">Уточняйте цену</a>
							';
		}else{			
		$html .= '
							<strong>'.$p->price.'тг</strong>
							';
		}
							
		$html .= '					
						</div>
						<div class="col-md-6">
						<a href="/store/'.$sslug.'" target="_blank">
							<p>Магазин:</p>
							<div class="store-logo" style="background:url(https://roomlook.com/images/stores/'.$simg.') center center no-repeat;"></div>
						</a>
						</div>
						
						<div class="clear"></div>
						</div>
					</div>
					</div>';
		
		}
		
		$html .= '<div class="text-center" style="clear:both;">
		<ul class="pagination">';
		 
//количество страниц		 
$kcount = ceil(count($count)/12); 
if ($page != 0) $html .= '<li><a data-page="0" href="#"><<</a></li>';
 
if($page - 2 > 0) $html .= '<li><a data-page="'.($page - 2).'" href="#">'.($page - 2).'</a></li>'; 
if($page - 1 > 0) $html .= '<li><a data-page="'.($page - 1).'" href="#">'.($page - 1).'</a></li>'; 

if($page + 1 <= $kcount) $html .= '<li><a data-page="'.($page).'" href="#">'.($page + 1).'</a></li>'; 
if($page + 2 <= $kcount) $html .= '<li><a data-page="'.($page + 1).'" href="#">'.($page + 2).'</a></li>'; 
   
//if ($page != $kcount) $html .= '<li><a data-page="'.($page + 1).'" href="#">></a></li>';

if ((($page + 1) != $kcount) && (($page + 2) != $kcount) && $page != $kcount) $html .= '<li><a data-page="'.($kcount - 1).'" href="#">'.($kcount).'</a></li>';
if ($page != $kcount) $html .= '<li><a data-page="'.($kcount - 1).'" href="#">>></a></li>';

	
/*
if ($page != 1) $pervpage = '<a href= ./page?page=1><<</a> 
                               <a href= ./page?page='. ($page - 1) .'><</a> '; 


if ($page != $kcount) $nextpage = ' <a href= ./page?page='. ($page + 1) .'>></a> 
                                   <a href= ./page?page=' .$kcount. '>>></a>'; 
*/
								   
/*
// Находим две ближайшие станицы с обоих краев, если они есть 
if($page - 2 > 0) $page2left = ' <a href= ./page?page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
if($page - 1 > 0) $page1left = '<a href= ./page?page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
if($page + 2 <= $kcount) $page2right = ' | <a href= ./page?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
if($page + 1 <= $kcount) $page1right = ' | <a href= ./page?page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню 
$html .= $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; 
*/		
		$html .= '</ul></div>';
		
		/*
		for($i=1;$i<ceil($kcount);$i++) {
			 
				$html .= '<li><a data-page="'.$i.'" href="#">'.$i.'</a></li>';
			
		}
		
		
		$html .= '<div class="text-center" style="clear:both;">
		<ul class="pagination"> 
		<li class="disabled"><span>«</span></li> 
		<li class="active"><span>1</span></li>
		<li><a data-page="2" href="#">2</a></li> 
		<li class="disabled"><span>...</span></li><li> 
		<li><a data-page="18" href="#">18</a></li> 
		<li><a data-page="next" href="#" rel="next">»</a></li>
		</ul></div>';
		*/
		
	$bread = '<a href="/ru">Главная</a> > <a href="/ru/catalog">Каталог</a>'.$bread_category;
		
	echo json_encode(array('bread' => $bread, 'data' => $html, 'count' => count($count)));
	}
	
    public function tag(Request $request, $id)
    {
		//поиск id товаров по связи 
		/*
		$prodtag = DB::table('room_picture_tag')
								->join('product_tags_relationship', 'product_tags_relationship.product_relationship_id', '=', 'room_picture_tag.connect') 
								->where('room_picture_tag.id', $id)
								->get(array('product_tags_relationship.product_tags_relationship_id')); 
		*/
		$prodtag = DB::table('room_picture_tag')
								->where('room_picture_tag.product_id', $id)
								->first()->connect;  
			
		//print_r($prodtag);
		//die();
			
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
		  
		foreach($products as $p) {
			
			$img = $p->imagePath();  
			$city = $p->store_cities()->where('city_id', 16)->first(); 
			 
			if(empty($city)) {
				
				$city['id'] = 0;
				$city = (object)$city;
			} 
			
			$store = DB::table('stores')
						->join('store_translations', 'store_translations.store_id', '=', 'stores.id') 
						->where('store_translations.store_id', $city->id)
						->where('locale', 'ru')
						->first();  
	 	
		$h = false;
		$tid = 0;
		$html = '';
		 
		//характеристика	
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->leftJoin('product_tags', 'product_tags.tags_products_id', '=', 'tags.id')
							->where('locale', 'ru')
							->where('product_tags.product_id', $p->id)
							->get(); 
						
		foreach($tags as $t) {   
		
		if($tid == $t->tag_group_id) { $h = true; }else{ $h = false; $html .= '</p>'; }
		$tid = $t->tag_group_id;
		
		$group = \DB::table('tag_group_translations')
							->where('tag_group_translations.locale', 'ru')
							->where('tag_group_translations.tag_group_id', $tid)
							->first(); 
		 
		if($group) { $gtitle = $group->title; }else{ $gtitle = ''; } 
		
		if($h == false) {
			$html .= '<p class="hitem"><b>'.$gtitle.': </b>';
			$html .= $t->title.', '; 
		}else{
			$html .= $t->title.', ';
		}  
		}
		//end
		   
			$array[] = array(
				'id' => $p->id,
				'name' => $p->name,
				'price' => $p->price,
				'image' => $img,
				'html' => $html,
				'store_id' => (!$store)?'':$store->id,
				'store_name' => (!$store)?'':$store->name,
				'store_logo' => (!$store)?'':$store->logo,
				'store_adress' => (!$store)?'':$city->address_ru,
			); 
			 
			/* 
			$attr = DB::table('product_tags')
								->where('product_id', $p->id)
								->get();			
  
			if($attr) {
			
			$count = 0;
			 			  			
			foreach($attr as $a) {		  
				
				$sql = '';
				
				$array2[] = $a->product_id;
		
			$count++;
			} 	 
			*/
			
			//echo $count.'<br />'; 
			//echo round($count * 0.45).'<br />';
   
			//}
		} 
   
/*
$prod = DB::select('select * from `product_tags`
							where product_tags.tags_products_id = 2 or product_tags.tags_products_id = 5');
						
print_r($array2);
echo '<br />';				
echo '<br />';	

 
$cnt = array_count_values($array2);
*/

$array3 = array();

if($prodtag)  {
 
$ptag = DB::table('product_tags_relationship')
								->where('product_relationship_id', $prodtag)
								->get(array('product_tags_relationship_id')); 
 
 foreach($ptag as $pt) {
    	$pro[] = Product::find($pt->product_tags_relationship_id);  
 }
  
		foreach($pro as $p) {
			 
			$city_id = (session('city_id'))?session('city_id'):16;
			 
			$img = $p->imagePath();  
			$city = $p->store_cities()->where('city_id', $city_id)->first(); 
			
			$store = DB::table('stores')
						->join('store_translations', 'store_translations.store_id', '=', 'stores.id') 
						->where('store_translations.store_id', $city->id)
						->where('locale', 'ru')
						->first();

		$h = false;
		$tid = 0;
		$html = '';
		
		//характеристика	
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->leftJoin('product_tags', 'product_tags.tags_products_id', '=', 'tags.id')
							->where('locale', 'ru')
							->where('product_tags.product_id', $p->id)
							->get(); 
		
		foreach($tags as $t) {  
		
		if($tid == $t->tag_group_id) { $h = true; }else{ $h = false; $html .= '</p>'; }
		$tid = $t->tag_group_id;
		
		$group = \DB::table('tag_group_translations')
							->where('tag_group_translations.locale', 'ru')
							->where('tag_group_translations.tag_group_id', $tid)
							->first(); 
		  
		if($group) { $gtitle = $group->title; }else{ $gtitle = ''; } 
		 
		if($h == false) { 
			$html .= '<p class="hitem"><b>'.$gtitle.': </b>';
			$html .= $t->title.', '; 
		}else{
			$html .= $t->title.', ';
		} 
		
		}
		//end
		
			$array3[] = array(
				'id' => $p->id,
				'name' => $p->name,
				'price' => $p->price,
				'image' => $img,
				'html' => $html,
				'store_id' => (!$store)?'':$store->id,
				'store_name' => (!$store)?'':$store->name,
				'store_logo' => (!$store)?'':$store->logo,
				'store_adress' => $city->address_ru,
			); 
		 
		}  
		}  
		
		//if(!$array3) $array3 = $array;
 
		$array3 = array_merge($array, $array3); 
 
    	return response()->json([
			'html' => view('partials.product-tag-new', compact('array', 'product', 'ctag', 'products', 'products2'))->render(), 
			'html2' => view('partials.product-tag-new3', compact('array', 'array3', 'pro', 'product', 'ctag', 'products', 'products2'))->render(), 
			'p_id' => $id]);

		die();
	}
	
    public function mbtag(Request $request, $id)
    { 
	
		//поиск id товаров по связи 
		$prodtag = DB::table('room_picture_tag')
								->join('product_tags_relationship', 'product_tags_relationship.product_relationship_id', '=', 'room_picture_tag.connect') 
								->where('room_picture_tag.id', $id)
								->get(array('product_tags_relationship.product_tags_relationship_id'));  
		
		foreach ($prodtag as $k) {   
			$pro[] = Product::find($k->product_tags_relationship_id);
		}	
		//pro список товаров из связи
		
		if(isset($pro)) {
		foreach($pro as $p) {
			
			$city_id = (session('city_id'))?session('city_id'):16;
			 
			$img = $p->imagePath();  
			$city = $p->store_cities()->where('city_id', $city_id)->first(); 
			
			if($city) {
			$store = DB::table('stores')
						->join('store_translations', 'store_translations.store_id', '=', 'stores.id') 
						->where('store_translations.store_id', $city->id)
						->where('locale', 'ru')
						->first();
			}
			
			$array[] = array(
				'id' => $p->id,
				'name' => $p->name,
				'price' => $p->price,
				'image' => $img,
				'store_id' => (!$store)?'':$store->id,
				'store_name' => (!$store)?'':$store->name,
				'store_logo' => (!$store)?'':$store->logo,
				'store_adress' => $city->address_ru,
			); 
			
			$array3[] = array(
				'id' => $p->id,
				'name' => $p->name,
				'price' => $p->price,
				'image' => $img,
				'store_id' => (!$store)?'':$store->id,
				'store_name' => (!$store)?'':$store->name,
				'store_logo' => (!$store)?'':$store->logo,
				'store_adress' => $city->address_ru,
			); 
			
		}
		}else{ 
		  
		
    	$ctag = Roompicturetag::find($request->tag_id);
    	$product = Product::find($id);
    	$products = [];
    	$products2 = [];
		
    	if ($product->relative)
    		$products = $product->relative->products;
   
    	if ($product->relative)
    		$products2 = $product->relative->products;
		  
		foreach($products as $p) {
			 
			$city_id = (session('city_id'))?session('city_id'):16;
			 
			$img = $p->imagePath();  
			$city = $p->store_cities()->where('city_id', $city_id)->first(); 

			if($city) {
			$store = DB::table('stores')
						->join('store_translations', 'store_translations.store_id', '=', 'stores.id') 
						->where('store_translations.store_id', $city->id)
						->where('locale', 'ru')
						->first();
			}
			
		//характеристика	
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->leftJoin('product_tags', 'product_tags.tags_products_id', '=', 'tags.id')
							->where('locale', 'ru')
							->where('product_tags.product_id', $p->id)
							->get(); 
							
		foreach($tags as $t) {  
		$group = \DB::table('tag_group_translations')
							->where('locale', 'ru')
							->where('tag_group_translations.tag_group_id', $t->tag_group_id)
							->first(); 
							
		}
		//end 
	
			$array[] = array(
				'id' => $p->id,
				'name' => $p->name,
				'price' => $p->price,
				'image' => $img,
				'store_id' => (!isset($store))?'':$store->id,
				'store_name' => (!isset($store))?'':$store->name,
				'store_logo' => (!isset($store))?'':$store->logo,
				'store_adress' => ($city)?$city->address_ru:'',
			); 
			
			$array3[] = array(
				'id' => $p->id,
				'name' => $p->name,
				'price' => $p->price,
				'image' => $img,
				'store_id' => (!isset($store))?'':$store->id,
				'store_name' => (!isset($store))?'':$store->name,
				'store_logo' => (!isset($store))?'':$store->logo,
				'store_adress' => ($city)?$city->address_ru:'',
			); 
		
		} 
		} 
		 
    	return response()->json([
			'html' => view('parts.mb-product-tag', compact('array', 'array3', 'product', 'ctag', 'products', 'products2'))->render(), 
			'html2' => view('parts.mb-product-tag2', compact('array', 'array3', 'product', 'ctag', 'products', 'products2'))->render(), 
			'p_id' => $id]);

		die();
	}
	
	
	
    public function search(Request $request)
    { 
		$data = $request->all();
	 
		/*
    	return response()->json([
			'html' => view('partials.product-tag-new', compact('array', 'product', 'ctag', 'products', 'products2'))->render(), 
			'html2' => view('partials.product-tag-new3', compact('array', 'array3', 'pro', 'product', 'ctag', 'products', 'products2'))->render(), 
			'p_id' => $id]);
		*/
		
		//whereHas
		
		$product = Product::leftJoin('product_translations', 'products777.id', '=', 'product_translations.product_id')
					->where('locale', 'ru')
					->where('name', 'LIKE', '%'.$data['search'].'%') 
					->limit(20)
					->get(
						array(
							'products777.id',
							'product_translations.slug', 
							'product_translations.name'  
						)
					);
		
		foreach($product as $p) {
			
			$img = $p->imagePath(); 
			
			$array[] = array('id' => $p->id, 'image' => '/'.$img, 'url' => $p->slug, 'name' => $p->name);
		}
		
		//return json_encode($array);
		 
		$array3 = $array; 
		
		$html = '';
		 
		foreach($product as $p) { 
		
		/*
		$store = DB::table('store_product');  
			 $store->where('store_product.product_id', $p->id);
			 $store->join('stores', 'store_product.product_id', '=', 'stores.id'); 
			 $store->join('store_translations', 'store_translations.store_id', '=', 'stores.id'); 
		$s = $store->first();
		
		if($s) { $simg = $s->logo; $sslug = $s->slug; }else{ $simg = ''; $sslug = ''; }
		
		//$store->join('store_translations', 'store_translations.store_id', '=', 'stores.id')
		*/
		
		$img = $p->imagePath(); 
			
		$html .= '<div class="item product col-md-3">
					<div>
						<a href="/ru/product/'.$p->id.'" tabindex="-1" data-product-id="'.$p->id.'" class="popup-product-open">
						<div style="height:170px;"><img src="/'.$img.'" class="center img-responsive" alt=""></div>
						<div><h4 class="title">'.$p->name.'</h4></div>
						</a>
						<div class="info">
						<div class="col-md-6">';
		if($p->price < 50) {				
		$html .= '
							<a class="product btn" href="#">Уточняйте цену</a>
							';
		}else{			
		$html .= '
							<strong>'.$p->price.'тг</strong>
							';
		}
							
		$html .= '					
						</div>
						<div class="col-md-6">
						<a href="/store/" target="_blank">
							<p>Магазин:</p>
							<div class="store-logo" style="background:url(/images/stores/) center center no-repeat;"></div>
						</a>
						</div>
						
						<div class="clear"></div>
						</div>
					</div>
					</div>'; 	
		
		}
	
/*	
		$html2 = '';
		$html2 .= '<div class="text-center" style="clear:both;">
		<ul class="pagination">';
		
//количество страниц		 
$kcount = ceil(count($product)/20); 
if ($page != 0) $html2 .= '<li><a data-page="0" href="#"><<</a></li>';
 
if($page - 2 > 0) $html2 .= '<li><a data-page="'.($page - 2).'" href="#">'.($page - 2).'</a></li>'; 
if($page - 1 > 0) $html2 .= '<li><a data-page="'.($page - 1).'" href="#">'.($page - 1).'</a></li>'; 

if($page + 1 <= $kcount) $html2 .= '<li><a data-page="'.($page).'" href="#">'.($page + 1).'</a></li>'; 
if($page + 2 <= $kcount) $html2 .= '<li><a data-page="'.($page + 1).'" href="#">'.($page + 2).'</a></li>'; 
  
if ((($page + 1) != $kcount) && (($page + 2) != $kcount) && $page != $kcount) $html2 .= '<li><a data-page="'.($kcount - 1).'" href="#">'.($kcount).'</a></li>';
if ($page != $kcount) $html2 .= '<li><a data-page="'.($kcount - 1).'" href="#">>></a></li>';
$html2 .= '</ul></div>';
*/

		//$bread = '<a href="/ru">Главная</a> > <a href="/ru/catalog">Каталог</a>'.$bread_category;
		$bread = '<a href="/ru">Главная</a> > <a href="/ru/catalog">Каталог</a>';
		
		echo json_encode(array('bread' => $bread, 'data' => $html));
 
		die();
		
    	return response()->json([
			'html' => view('partials.product-tag-new', compact('array', 'product', 'ctag', 'products', 'products2'))->render(), 
			'html2' => view('partials.product-tag-new3', compact('array', 'array3', 'pro', 'product', 'ctag', 'products', 'products2'))->render(), 
			'p_id' => $id]);

		die();
	}
}