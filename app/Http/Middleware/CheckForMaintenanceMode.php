<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\CityTranslation;
class CheckForMaintenanceMode implements Middleware {
    
    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // If this was a GET request...
        if ($request->isMethod('get')) {
            // Generate Etag
            $etag = md5($response->getContent());
            $requestEtag = str_replace('"', '', $request->getETags());
            // Check to see if Etag has changed
            if($requestEtag && $requestEtag[0] == $etag) {
                $response->setNotModified();
            }
            // Set Etag
            $response->setEtag($etag);
        }
        // dd(session('access_website')); 
        // return dd(($request->has('pass') && $request->pass == "Aibek2016")) ;
//        if ( ($request->has('pass') && $request->pass == "Aybek2017")  || $request->cookie('access_website'))
//        {
//            // Cookie::make('name', $id, 360);
//            // session(['access_website'=>1]);
//            // dd();
//            return $next($request)->withCookie(cookie()->forever('access_website', 1));
//        }
        // if ( ($request->has('pass') && $request->pass == "topclass")  || $request->cookie('top'))
        // {
            // Cookie::make('name', $id, 360);
            // session(['access_website'=>1]);
            // dd();
        if (!session('city_id')) {
            $ip = $request->ip();
            $city = geoip($ip)->city;
            $cityModel = CityTranslation::where('name', $city)->first();
            if ($cityModel instanceof CityTranslation) {
                session(['city_id' => $cityModel->city_id]);
            }
        }
        return $response;
        // }
        // return response(view('coming'));

    }

}