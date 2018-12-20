<?php namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Idea;
use App\Models\Product; 
use App\Models\Paper;
use App\Models\PaperCategories;
  
class ArticlesController extends Controller {

    public function __construct()
    {

    }
	
    public function index(Request $request)
    {
		
	}
	
    public function articles()
    {  
		$tags_articles = \DB::select('select tags from paper_translations t order by length(tags) desc limit 1');
		$parts2 = explode(';', $tags_articles[0]->tags); 
	 
		//данные
		$articles_all = array();
	 
		$tags = \DB::table('tags')
						->join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id') 
						->where('locale', 'ru') 
						->get();
						
		foreach($tags as $t) {				 
			$parts[] = array(
						'id' => $t->tag_id, 
						'title' => $t->title, 
						'slug' => $t->slug, 
						);
		} 
		 
		$categories = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id') 
						->where('locale', 'ru') 
						->get();
						
        $articles = \DB::table('papers')
						->join('paper_translations', 'papers.id', '=', 'paper_translations.paper_id')
						->where('paper_translations.locale', 'ru') 
						->limit(3)
						->orderBy('views', 'desc')
						->get(array('papers.*', 'paper_translations.*'));  
		
		$articles2 = \DB::table('papers')
						->join('paper_translations', 'papers.id', '=', 'paper_translations.paper_id')
						->join('paper_categories', 'papers.category_id', '=', 'paper_categories.id')
						->join('paper_categories_translations', 'papers.category_id', '=', 'paper_categories_translations.paper_categories_id')
						->where('paper_translations.locale', 'ru') 
						->limit(3)
						->get(array('papers.*', 'paper_translations.*', 'paper_categories_translations.name as cname', 'paper_categories_translations.id as cid'));  
		 
		$podborka = \DB::table('papers')
						->join('paper_translations', 'papers.id', '=', 'paper_translations.paper_id')
						->join('paper_categories', 'papers.category_id', '=', 'paper_categories.id')
						->join('paper_categories_translations', 'papers.category_id', '=', 'paper_categories_translations.paper_categories_id')
						->where('paper_translations.categories', 'LIKE', '%3%') 
						->where('paper_translations.locale', 'ru') 
						->limit(3)
						->get(array('papers.*', 'paper_translations.*', 'paper_categories_translations.name as cname', 'paper_categories_translations.id as cid'));  
          
		//статьи
		$papers = Paper::papers()->get(
			array(
			'papers.id as id', 
			'paper_translations.name',
			'paper_translations.images',
			'paper_translations.categories',
			'paper_translations.anons'
			));
			
			 
		foreach($papers as $p) {
			
			$parts = explode(';', $p->categories);
			
			$c = \DB::table('paper_categories')
						->leftJoin('paper_categories_translations', 'paper_categories.id', '=', 'paper_categories_translations.paper_categories_id')
						->where('paper_categories.id', $parts[0])
						->where('locale', 'ru')
						->first(array('name', 'slug'));
						 
			if(!empty($parts[0])) {			 
			$articles_all[$parts[0]][] = (object) array(
							'id' => $p->id,
							'name' => $p->name,
							'images' => $p->images,
							'slug' => $p->slug,
							'cname' => ($c)?$c->name:'',
							'cslug' => ($c)?$c->slug:'',
							'anons' => $p->anons 
							);
			}
		}
		 
		$category2 = (object) array('slug' => 'all');
		 
        return response()->view('articles/list', 
			compact(
			'articles', 
			'articles_all', 
			'parts', 
			'parts2', 
			'podborka', 
			'tags', 
			'category2', 
			'categories'));
		
	}
	
    public function tag($tag)
    {   
		$tags_articles = \DB::select('select tags from paper_translations t order by length(tags) desc limit 1');
		$parts2 = explode(';', $tags_articles[0]->tags); 
		  
		$tags2 = \DB::table('tags')
						->join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id') 
						->where('locale', 'ru') 
						->get();
						
		$categories = array();
		
		$categories3 = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id') 
						->where('locale', 'ru') 
						->get();
						
		/*
		$categories = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id')
						->where('paper_categories_translations.slug', $category) 
						->first();
		*/
		 
		$tags2 = \DB::table('tags')
						->join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
						->where('tag_translations.slug', $tag) 
						->first();
						
		$tags = \DB::table('tags')
						->join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id') 
						->where('locale', 'ru') 
						->get(); 
						
			$parts[] = array(
						'id' => $tags2->tag_id, 
						'title' => $tags2->title, 
						'slug' => $tags2->slug, 
						);  
		  				 
		$articles = \DB::table('papers')
						->join('paper_translations', 'papers.id', '=', 'paper_translations.paper_id') 
						->where('paper_translations.tags', 'LIKE', '%'.$tags2->id.'%') 
						->where('paper_translations.locale', 'ru')  
						->distinct()
						->get(array('papers.*', 'paper_translations.*'));  
          
        return response()->view('articles/list-tags', compact('articles', 'parts', 'parts2', 'tags', 'tags2', 'tags2', 'categories', 'categories3'));
		
	}
	
    public function list_articles($category)
    { 
		$tags_articles = \DB::select('select tags from paper_translations t order by length(tags) desc limit 1');
		$parts2 = explode(';', $tags_articles[0]->tags); 
	 
		$tags = \DB::table('tags')
						->join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id') 
						->where('locale', 'ru') 
						->get();
						
		foreach($tags as $t) {				 
			$parts[] = array(
						'id' => $t->tag_id, 
						'title' => $t->title, 
						'slug' => $t->slug, 
						);
		} 
		
		$categories = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id') 
						->where('locale', 'ru') 
						->get();
						
		$category2 = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id')
						->where('paper_categories_translations.slug', $category) 
						->first();
						 
		$articles = \DB::table('papers')
						->join('paper_translations', 'papers.id', '=', 'paper_translations.paper_id') 
						->where('paper_translations.categories', 'LIKE', '%'.$category2->paper_categories_id.'%') 
						->where('paper_translations.locale', 'ru')  
						->distinct()
						->get(array('papers.*', 'paper_translations.*'));  
          
        return response()->view('articles/list0', compact('articles', 'parts', 'parts2', 'category2', 'categories', 'tags'));
		
	}
	
    public function show_article($category, $slug)
    {   
		$tags_articles = \DB::select('select tags from paper_translations t order by length(tags) desc limit 1');
		$parts2 = explode(';', $tags_articles[0]->tags); 
	  
		$tags = \DB::table('tags')
						->join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id') 
						->where('locale', 'ru') 
						->get();
	

	
		$categories = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id') 
						->where('locale', 'ru') 
						->get();
						
		$article = \DB::table('papers')
						->join('paper_translations', 'paper_translations.paper_id', '=', 'papers.id')
						->where('paper_translations.slug', $slug) 
						->where('paper_translations.locale', 'ru') 
						->first();
		
		$article_near = \DB::table('papers')
						->join('paper_translations', 'paper_translations.paper_id', '=', 'papers.id')
						->where('paper_translations.slug', $slug) 
						->where('paper_translations.locale', 'ru') 
						->first();
  
		$category2 = \DB::table('paper_categories')
						->join('paper_categories_translations', 'paper_categories_translations.paper_categories_id', '=', 'paper_categories.id') 
						->where('paper_categories_translations.slug', $category) 
						->where('locale', 'ru') 
						->first(); 
		  
		$parts = explode(';', $article->tags); 
		 
		//похожие товары 
		$products = \DB::table('product_tags');  
        $products->select(\DB::raw('count(*) as count, product_id'));   
			
		foreach($parts as $h) { 
			 	
			$products->orWhere('tags_products_id', $h); 
			  
		}	
        $products->groupBy('product_id');
        $products->havingRaw('count > 2');
		$result = $products->get();
			  
		foreach($result as $r) {	
		
		$product_relative[] = Product::where('id', $r->product_id)->first();
			 
		}
		
		//похожие статьи
		foreach($parts as $h) {  
		
		$papers = \DB::table('paper_translations')->groupBy('paper_id')->where('tags', 'LIKE', '%'.$h.'%')->get();
		
		foreach($papers as $pp) {
		$papers2[$pp->paper_id][] = array(
						'id' => $pp->paper_id,
						'name' => $pp->name,
						'images' => $pp->images,
						'slug' => $pp->slug,
						'count' => 1,
						'tags' => $pp->tags 
						);		
				
		}
		}
		
		$i = 0;
		foreach($papers2 as $r) {  
		     
			$result2[$r[0]['id']] = $r[0];
			$result2[$r[0]['id']]['count'] = count($r);
		   
		$i++;   
		}
   
        return response()->view('articles/show', compact('article', 'tags', 'category2', 'parts', 'result2', 'parts2', 'product_relative', 'categories'));
		
	}
	
	
}