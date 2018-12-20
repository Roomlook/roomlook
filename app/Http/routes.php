<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/test', 'WelcomeController@test');
Route::get('/test2', 'WelcomeController@test2');
Route::get('/test3', 'WelcomeController@test3');

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'WelcomeController@test3'); 


Route::get('/search', 'WelcomeController@getSearch');
// Route::get('/test','WelcomeController@index');
Route::get('/sc','TestController@test');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'personal'	=> 'PersonalController',
	'images'=>'ImageController'

]);
Route::get('changecity/{id}', 'WelcomeController@getChangecity');

 
Route::get('desktop-version', 'WelcomeController@getDesktopVersion');
Route::get('/p/{slug}', 'WelcomeController@page');
Route::get('/thanks', 'WelcomeController@thanks');
Route::get('cancel-desktop-version', 'WelcomeController@getCancelVersion');
Route::post('/myroom/frompc', 'Frontend\MyroomController@postFrompc');
Route::post('/myroom/fromlink', 'Frontend\MyroomController@postFromlink');
Route::post('/myroom/change-avatar', 'Frontend\MyroomController@postChangeAvatar');
Route::post('/order/checkout' , 'Frontend\OrderController@postCheckout');
Route::group( [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ], function()
{
	Route::get('/f/myroom', function() {
	return redirect()->to('/myroom');
});
Route::get('/myroom/delete/{id}', 'Frontend\MyroomController@deleteRoom');

    //Route::get('/' , 'WelcomeController@index');
    Route::get('/' , 'WelcomeController@test3');
	
    Route::get('/projects' ,  ['as' => 'frontend.projects.index', 'uses' => 'WelcomeController@getProjects']);
    Route::get('/ideas' ,  ['as' => 'frontend.ideas.index', 'uses' => 'Frontend\IdeasController@getIdeas']);

	
	
	Route::get('/api/roomforroom/{id}', 'WelcomeController@apigetRoom');
	Route::get('/api/picturesforroom/{id}', 'WelcomeController@apigetMoz');
	 
	Route::get('/api/groupt/{id}', 'ApiController@groupt');
	Route::get('/api/tag/{id}', 'ApiController@tag');
	Route::get('/api/mbtag/{id}', 'ApiController@mbtag');

	Route::any('/api/group_products/', 'ApiController@group_products');
	Route::any('/api/catalog/', 'ApiController@catalog');
	Route::any('/api/catalogtest/', 'ApiController@catalogtest');
	Route::any('/api/catalog_tree/', 'ApiController@catalog_tree');
	Route::any('/api/catalog/search', 'ApiController@search');
	
	
	//19.10.2018 (articles)
	Route::get('/articles' , 'ArticlesController@articles');
	Route::get('/articles/tags/{tag}' , 'ArticlesController@tag');
	Route::get('/articles/{category}' , 'ArticlesController@list_articles');
	Route::get('/articles/{category}/{slug}' , 'ArticlesController@show_article');
	
	//24.10.2018
	Route::get('/sitemap' , 'WelcomeController@sitemap');
	//Route::get('/sitemap.xml' , 'WelcomeController@sitemap');
	
	
    // Route::get('/projects/slug', 'WelcomeController@makeSlug');
    Route::get('/project/s/{id}' , 'WelcomeController@redirectProjectSingle');
    Route::get('/project/{slug}-{picture_id?}' , 'WelcomeController@getProjectSingle');
    
    // Route::get('/project/find/{id}' , 'WelcomeController@getProjectSingleFind');
    Route::get('/product/{id}', 'Frontend\CatalogController@getProduct');
    
	//25.10.2018
	Route::get('/product/{categoty}/{slud}', 'Frontend\CatalogController@redirectProduct');
	Route::get('/product/{categoty}/{subcategoty}/{slud}', 'Frontend\CatalogController@redirectProduct');

    // Route::get('/authors/slug', 'Frontend\AuthorController@makeSlug');
    Route::get('/author/{slug}', 'Frontend\AuthorController@redirectAuthor');
    Route::controller('/author', 'Frontend\AuthorController');

    Route::controller('/home', 'HomeController');

	
    // Route::get('/rooms/slug', 'Frontend\RoomController@makeSlug');
	
    Route::get('/room/{type}/{style?}', 'Frontend\RoomController@redirectRoom');
    Route::controller('/room', 'Frontend\RoomController', [
		'getIndex' => 'frontend.room.index'
	]);
	 
	
    Route::controller('/order', 'Frontend\OrderController');
    Route::controller('/myroom', 'Frontend\MyroomController');
	Route::controller('/ajax/common', 'Ajax\CommonController');

	// Route::get('/catalogs/slug', 'Frontend\CatalogController@makeSlug');
    Route::get('/catalog/{category}/{subsubcategory?}/{manufacturer?}', 'Frontend\CatalogController@redirectCatalog');
    Route::controller('/catalog', 'Frontend\CatalogController',[
		'getIndex' => 'frontend.catalog.index'
	]);


    Route::controller('/brands', 'Frontend\ManufacturerController');
    Route::controller('/manufacturer', 'Frontend\ManufacturerController');

    // Route::get('/stores/slug', 'Frontend\StoreController@makeSlug');
    Route::get('/store/{manufacturer}/{category?}/{subcategory?}', 'Frontend\StoreController@redirectStores');
    Route::controller('/stores', 'Frontend\StoreController');
	Route::group(['prefix' => config('admin.prefix', 'admin'), 'namespace' => 'Admin'], function () {
		Route::group(['before' => config('admin.filter.auth')], function () {

			//Route::resource('manufactures', 'ManufacturesController');
			//Route::resource('shops','ShopsController');
			//Route::resource('products','ProductsController');
		});
	});
});

Route::post('admin/store/remove', 'Admin\ProductsController@removeStore');
Route::post('admin/city/remove', 'Admin\StoresController@removeCity');

Route::get('admin/photo/image/{id}', 'Admin\ProductsController@getImage');
Route::get('admin/user/export', 'Admin\AuthorsController@userExport');
Route::get('admin/authors/duplicate/{id}', 'Admin\AuthorsController@duplicate');
Route::get('admin/products/duplicate/{id}', 'Admin\ProductsController@duplicate');
Route::get('admin/projects/duplicate/{id}', 'Admin\ProjectsController@duplicate');
Route::get('admin/projects/remove', 'Admin\ProjectsController@remove');
Route::get('admin/projects/changeOrder', 'Admin\ProjectsController@changeOrder');
Route::get('admin/rooms/remove', 'Admin\RoomsController@remove');
Route::get('admin/products/remove', 'Admin\ProductsController@remove');
Route::get('admin/products/remove-picture/{id}', 'Admin\ProductsController@removePicture');
Route::get('admin/roompictures/remove', 'Admin\RoompicturesController@remove');
Route::get('admin/rooms/enable/{id}', 'Admin\RoomsController@enable');
// Route::get('admin/roompictures/fitorg', 'Admin\RoompicturesController@fitorg');
Route::get('admin/products/enable/{id}', 'Admin\ProductsController@enable');
Route::get('admin/projects/enable/{id}', 'Admin\ProjectsController@enable');
Route::resource('admin/cpages', 'Admin\PagesController');
Route::resource('admin/projects', 'Admin\ProjectsController');
Route::get('/admin/manufacturers/import-excel',  ['uses' => 'Admin\ManufacturersController@importExcel', 'as' => 'admin.manufacturers.import-excel']);
Route::post('/admin/manufacturers/import-excel', ['uses' => 'Admin\ManufacturersController@postImportExcel', 'as' => 'admin.manufacturers.import-excel']);
Route::post('/admin/products/import-excel', ['uses' => 'Admin\ProductsController@postImportExcel', 'as' => 'admin.products.import-excel']);
Route::get('/admin/products/import-excel',  ['uses' => 'Admin\ProductsController@importExcel', 'as' => 'admin.products.import-excel']);
Route::get('/admin/stores/import-excel',  ['uses' => 'Admin\StoresController@importExcel', 'as' => 'admin.stores.import-excel']);
Route::get('admin/authors/photograph',  ['uses' => 'Admin\AuthorsController@photograph', 'as' => 'admin.authors.photograph']);
Route::post('/admin/stores/import-excel', ['uses' => 'Admin\StoresController@postImportExcel', 'as' => 'admin.stores.import-excel']);

	//22.10.2018
	Route::resource('admin/papers', 'Admin\PapersController');
	Route::resource('admin/add_image', 'Admin\PapersController@add_image');
	Route::resource('admin/papers_categories', 'Admin\PapersCategoriesController');
	//16.11.2018
	Route::resource('admin/tags', 'Admin\TagsController');
	Route::resource('admin/tags_group', 'Admin\TagsGroupController');

Route::resource('admin/manufacturers', 'Admin\ManufacturersController');
Route::resource('admin/products', 'Admin\ProductsController');
Route::resource('admin/countries', 'Admin\CountriesController');
Route::resource('admin/cities', 'Admin\CitiesController');
Route::resource('productrelationship', 'Admin\ProductrelationshipController', ['as' => 'admin']);
Route::resource('projectrelation', 'Admin\ProjectRelationController', ['as' => 'admin']);
Route::resource('admin/stores', 'Admin\StoresController');
Route::resource('admin/sections', 'Admin\SectionsController');
Route::get('admin/rooms/duplicate/{id}', 'Admin\RoomsController@duplicate');
Route::resource('admin/rooms', 'Admin\RoomsController');
Route::resource('admin/ideas', 'Admin\IdeasController');
Route::resource('admin/roompictures', 'Admin\RoompicturesController');
Route::resource('admin/roompicturetags', 'Admin\RoompicturetagsController');
Route::resource('admin/roomtypes', 'Admin\RoomTypesController');
Route::resource('admin/orders', 'Admin\OrdersController');
Route::resource('admin/reviews', 'Admin\ReviewsController');
Route::resource('admin/authors', 'Admin\AuthorsController');
Route::resource('admin/styles', 'Admin\StylesController');
Route::resource('admin/pcategories', 'Admin\PcategoriesController');
Route::resource('admin/requesttoauthors', 'Admin\RequesttoauthorsController');

Route::get('mail/me', function() {
	Mail::send('emails.example', ["tpe"=>"asd"], function($message)
	{
	    $message->from('no-reply@roomlook.com', 'Room Look');

	    $message->to('dsanjar@rocketmail.com');

	});
});
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

