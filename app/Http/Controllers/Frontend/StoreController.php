<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Store;
use App\Models\StoreTranslation;
use App\Models\RoomType;
use App\Models\Pcategory;
use App\Models\PcategoryTranslation;
use App\Models\City;
use Lang;
class StoreController extends Controller {

	public function makeSlug()
	{
		$stores = StoreTranslation::all();
		foreach ($stores as $store) {
			$store->slug = str_slug($store->name, '_');
			$store->save();
		}
	}

	
	public function getIndex(Request $request) {
		$cityId = 1;
		// $stores = Store::where('id','>',0);
		// $translationTable = str_plural(snake_case(class_basename($stores->getTranslationModelName())));
		$storeIds = 0;
    	if ($request->has('city_id') && $request->city_id != 0) {
    		$storeIds = City::find($request->city_id)->stores()->lists('id');
    		$cityId = $request->city_id;
    		// return $storeIds;
			// if ($request->city_id != 0)
				// $stores = Store::join("store_translations as t", 'stores.id', '=','t.store_id')->where('t.locale',\App::getLocale())->where('stores.city_id',$request->city_id)->orderBy('t.name')->select('stores.id')->get();

		// dd($stores);
		
				// $stores->where('stores.city_id','=', $request->city_id);
		} else if (session('city_id')) {
			$cityId = session('city_id');
    		$storeIds = City::find($cityId)->stores()->select('stores.id')->lists('stores.id');
		}
		$st = Store::join("store_translations as t", 'stores.id', '=','t.store_id')->where('stores.is_show', 1)->where('t.locale',\App::getLocale());
		if ($storeIds != 0)  {
			// dd($storeIds);
			$st = $st->whereIn('stores.id', $storeIds);
		}
    	
		$st = $st->orderBy('t.name')->select(['stores.id', 'stores.logo', 'stores.image'])->paginate(20);
		
		$category = null;
		$stores = $st;
		if ($request->has('category_id')) {
			$stores = null;
			$category = Pcategory::find($request->category_id);

			foreach ($st as  $value) {

				if (in_array($category->id, $value->categories()->lists('id') )) {

					$stores[] = $value->id;
				
				}
			}
			$stores = Store::whereIn('id', $stores)->paginate(20);
		}
		// $stores = $stores->;
		// if ($request->has('category_id')) {
		// 	$stores = Store::where('category_id','=', $request->category_id);
		// }
		// $stores = $stores->load(['translations' => function($query)
		// {
		//     $query->orderBy('name', 'asc');
		// }])->get(); 
		// $stores = $stores->where('locale', 'ru')
		//     ->orderBy('t.name', 'ASC')
		//     ->get();
		// dd($stores);
		$pcategories = Pcategory::parents();
		if ($stores->first() && $stores->first()->updated_at) {
			$LastModified = $stores->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) {
				return response( 'Not Modified', 304);
			}
			return response()->view('frontend.stores.index', compact('stores','pcategories','category','request', 'cityId'))->header('Last-Modified', $LastModified);
		}
		return response()->view('frontend.stores.index', compact('stores','pcategories','category','request', 'cityId'));
	}

	public function getS($id, Request $request)
	{
		$slug = StoreTranslation::where('store_id', $id)->first()->slug;
		if ($request->has('category_id')){
			$category = PcategoryTranslation::where('pcategory_id', $request->category_id)->first()->slug;
			$subcategory = Pcategory::find($request->category_id)->parent_id;
			if ($subcategory != null) {
				$subcategory = PcategoryTranslation::where('pcategory_id', $subcategory)->first()->slug;
				return redirect('/store/'.$slug.'/'.$subcategory.'/'.$category);
			}
			return redirect('/store/'.$slug.'/'.$category);
		}
		return redirect('/store/'.$slug);
	}

	public function redirectStores($manufacturer_id, $category = null, $subcategory = null) {
		if ($subcategory != null) {
			$category = $subcategory;
		}
		$cityId = 1;
		$store_id = StoreTranslation::where('slug', $manufacturer_id)->first()->store_id;
		$store = Store::find($store_id);
		$products = $store->products()->paginate(21);
		if ($category != null) {
			$category_id = PcategoryTranslation::where('slug', $category)->first()->pcategory_id;
			$products = $store->products()->where('pcategory_id', $category_id)->paginate(21);
		}
		if ($store) {
			$LastModified = $store->updated_at->format('D, d M Y H:i:s \G\M\T');
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) {
				return response( 'Not Modified', 304);
			}
			return response()->view('frontend.stores.single', compact('store','products' ,'cityId'))->header('Last-Modified', $store->updated_at->format('D, d M Y H:i:s \G\M\T'));
		}
		return response()->view('frontend.stores.single', compact('store','products' ,'cityId'));
	}

	
	
}
