<?php namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Style;
use App\Models\City;
class AuthorController extends Controller {
	
	
	public function getIndex(Request $request){

		$cityId = session('city_id');
		// if ($request->has('city_id') && $request->city_id != 0) {
		// 	$city = City::find($request->city_id);
		// 	$cityName = trim($city->name);
		// 	$authors = Author::join('author_translations', 'author_translations.author_id', '=', 'authors.id')->where('authors.is_show', 1)->where('authors.type', 0)->where('author_translations.city', 'LIKE', '%'.$cityName.'%')->latest('authors.id')->paginate(20);
		// 	$cityId = $request->city_id;
		// } else if ($cityId != null) {
		// 	$city = City::find($cityId);
		// 	$cityName = trim($city->name);
		// 	$authors = Author::join('author_translations', 'author_translations.author_id', '=', 'authors.id')->where('authors.is_show', 1)->where('authors.type', 0)->where('author_translations.city', 'LIKE', '%'.$cityName.'%')->latest('authors.id')->paginate(20);

		// } else {
		// 	$authors = Author::where('is_show', 1)->where('type', 0)->latest('id')->paginate(20);
		// }
		$authors = Author::where('is_show', 1)->where('type', 0)->latest('id')->paginate(20);

		$styles = Style::all();
		if ($authors->first()) {
	        $LastModified = $authors->first()->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view('frontend.author.list',compact('authors', 'cityId', 'request','styles'))->header('Last-Modified', $LastModified);
		}
		return response()->view('frontend.author.list',compact('authors', 'cityId', 'request','styles'));
		
	}

    public function makeSlug()
    {
      $authors = Author::all();
      foreach ($authors as $author) {
        $author->slug = str_slug($author->user->name, '_');
        $author->save();
      }
    }

    public function getS($id)
    {
		$slug = Author::find($id)->slug;
    	return redirect('/author/'.$slug);
    }

	public function redirectAuthor($slug){
		$author = Author::where('slug', $slug)->first();
        if ($author) {
	        $LastModified = $author->updated_at->format('D, d M Y H:i:s \G\M\T');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $LastModified) 
                return response( 'Not Modified', 304);
			return response()->view('frontend.author.index',compact('author'))->header('Last-Modified', $LastModified);
        }
		return response()->view('frontend.author.index',compact('author'));
	}
	
	
}
