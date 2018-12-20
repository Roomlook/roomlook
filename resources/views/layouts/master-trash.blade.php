<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (!Session::has('no-resp'))
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @endif
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/elegant-fonts.css" rel="stylesheet">
    <link href="/css/flaticon.css?v=1" rel="stylesheet">
    <link href="/css/flaticon2.css?v=1" rel="stylesheet">
    <link href="/css/fblike.css" rel="stylesheet">
    <link href="/owl-carousel/owl.carousel.css" rel="stylesheet">
    <!-- <link href="/owl-carousel/owl.theme.css" rel="stylesheet"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/css/photoswipe.css?v=2"> 

    <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
    <link rel="stylesheet" href="/css/default-skin/default-skin.css?v=1"> 
<!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<![endif]-->
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/style.css?v=1.177" rel="stylesheet">
    <link href="/css/style.media.css?v=1.22" rel="stylesheet">
    @if (Session::has('no-resp'))
    <link rel="stylesheet" type="text/css" href="/css/noresponsive.css">
    <style> 
        .no-resp .hidden-xs,
        .no-resp .hidden-sm {
            display:block !important;
        } 
        .no-resp .container {
          /* Margin/padding copied from Bootstrap */
          margin-left: auto;
          margin-right: auto;
          padding-left: 15px;
          padding-right: 15px;

          /* Set width to your desired site width */
          width: 1170px !important;
        }
        section,html {
            width: 100%;
            min-width: 1170px;
        }
    </style>
    @endif
    <style>
        .my-gallery {
  width: 100%;
  float: left;
}
.my-gallery img {
  width: 100%;
  height: auto;
}
.my-gallery figure {
  display: block;
  float: left;
  margin: 0 5px 5px 0;
  width: 150px;
}
.my-gallery figcaption {
  display: none;
}
    </style>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <meta name="google-site-verification" content="k1be0-dNHy9LeL-pNuekkdDGcJrIQUQlj5j6yi_eack" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="@yield('onload')" @if (Session::has('no-resp')) class="no-resp" @endif>

        <div id="loc-lang">
             <ul class="localization list-inline pull-left list-unstyled">
                <li class="">
                    <div class="dropdown">
                        <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <h1>he</h1>
                            @if (LaravelLocalization::getCurrentLocale() == "ru")
                                        <img src="/images/ru.png" width="30" />
                                        @else
                                        <img src="/images/en.png" width="30" />

                                        @endif 
                         <i class="glyphicon glyphicon-triangle-bottom"></i>

                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php $i=0; $n = count(LaravelLocalization::getSupportedLanguagesKeys())-1; ?>
                            @foreach (LaravelLocalization::getSupportedLocales() as $key => $local)
                            <li><a href="{{ LaravelLocalization::getLocalizedURL($key) }}">{{ $local['native'] }}</a></li>
                            @if ($i < $n)
                            <li role="separator" class="divider"></li>
                            @endif
                            <? $i++ ;?>
                            @endforeach
                            
                        </ul>
                    </div>
                </li>
                <li class="">
                    <div class="dropdown location-dropdown">
                        <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span>{{ App\Models\City::getCurrent() }}</span> <i class="glyphicon glyphicon-triangle-bottom"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php $i = 0; 
                            $n =  App\Models\Country::all()->count() - 1;?>
                            @foreach(App\Models\Country::all() as $country)
                            <li class="dropdown-header">
                                <a href="#" tabIndex="-1" data-country-id="{{ $country->id }}">{{ $country->name }}</a>
                            </li>
                                @if ($country->cities)
                                @foreach($country->cities as $city)
                                <li>
                                    <a href="/changecity/{{ $city->id }}"  data-city-id="{{ $city->id }}">{{ $city->name }}</a>
                                </li>
                                @endforeach
                                @endif
                                @if ($i < $n)
                                <li role="separator" class="divider"></li>
                                @endif
                            <? $i++; ?>
                            
                            @endforeach
                           
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <header>
            <div class="container-fluid">
                <div class="row">
                    
                
                <div class="col-sm-2 col-md-offset-0 col-md-3  col-xs-3 logo-holder">
                    <a href="/?pass=RoomLook2016">
                        <img src="/images/logo-small.png" alt="" class="logo logo-nonfix img-responsive">
                        <img src="/images/logo-xsmall.png" alt="" class="logo logo-fix img-responsive">
                    </a>
                </div>
                <div class="col-sm-8 col-md-6 col-xs-9">
                    
                    <div class="row local-setting-links">
                        
                        <? /* ul class="localization list-inline pull-left list-unstyled">
                            <li class="">
                                <div class="dropdown">
                                    <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    @if (LaravelLocalization::getCurrentLocale() == "ru")
                                        <img src="/images/ru.png" width="30" />
                                        @else
                                        <img src="/images/en.png" width="30" />

                                        @endif <i class="glyphicon glyphicon-triangle-bottom"></i>

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <?php $i=0; $n = count(LaravelLocalization::getSupportedLanguagesKeys())-1;?>
                                        @foreach (LaravelLocalization::getSupportedLocales() as $key => $local)
                                        <li><a href="{{ LaravelLocalization::getLocalizedURL($key) }}">{{ $local['native'] }}</a></li>
                                        @if ($i < $n)
                                        <li role="separator" class="divider"></li>
                                        @endif
                                        <? $i++ ;?>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="">
                                <div class="dropdown location-dropdown">
                                    <button class="dropdown-toggle c_clear_btn" type="button" id="cityDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span>{{ App\Models\City::getCurrent() }}</span> <i class="glyphicon glyphicon-triangle-bottom"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="cityDropDown">
                                        <?php $i = 0; 
                                        $n =  App\Models\Country::all()->count() - 1;?>
                                        @foreach(App\Models\Country::all() as $country)
                                        <li class="dropdown-header">
                                            <a href="#" tabIndex="-1" data-country-id="{{ $country->id }}">{{ $country->name }}</a>
                                        </li>
                                            @if ($country->cities)
                                            @foreach($country->cities as $city)
                                            <li>
                                                <a href="/changecity/{{ $city->id }}" data-city-id="{{ $city->id }}">{{ $city->name }}</a>
                                            </li>
                                            @endforeach
                                            @endif
                                            @if ($i < $n)
                                            <li role="separator" class="divider"></li>
                                            @endif
                                        <? $i++; ?>
                                        
                                        @endforeach
                                       
                                    </ul>
                                </div>
                            </li>
                        </ul> */?>
                        <div class="col-sm-7 hidden-xs search text-right inner-addon left-addon">
                            <i class="glyphicon glyphicon-search"></i>
                            <form action="/search" method="get"><input type="text" class="form-control" name="q" placeholder="{{trans('frontend.common.search')}}"/>
                            </form>
                        </div>
                        {{--
                        <ul class="social-icons list-inline">
                             <li><a href="https://www.facebook.com/rooml00k/" target="_blank"><i class="social_facebook_circle"></i></a></li>
                                <li><a href="https://www.instagram.com/rooml00k/" target="_blank"><i class="social_instagram_circle"></i></a></li>
                                <li><a href="https://vk.com/rooml00k" target="_blank"><img src="/images/vk.png" alt="vk" style='width: 24px; margin-top: -12px;'></a></li>
                        
                        </ul> 
                        --}}
                        {{--
                        <div class="auth text-right hidden-xs">
                            <img src="/images/user.png" width="20" />
                            @if (Auth::check())
                            <a href="/home">{{ trans('frontend.common.profile') }}</a>
                            <a href="/auth/logout">{{ trans('frontend.common.logout') }}</a>
                            @else
                            <a href="/auth/login">{{ trans('frontend.common.signin') }}</a>
                            @endif
                        </div>
                        --}}
                    </div>
                    <div class="row main-menu-wrapper">
                        <nav id="main-menu" class="list-inline hidden-xs hidden-sm">
                            <li>
                                <a href="/f/projects" >{{ trans('frontend.common.projects') }}</a>
                                        
                            </li>
                            <li class="dropdown">
                                <a href="/f/room">{{ trans('frontend.common.rooms') }}</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @foreach(App\Models\RoomType::all() as $roomType)
						                    <?php
						                    	$href = route('frontend.room.index',['room_type_id'=>$roomType->id]);
						                    	$href = preg_replace ('/\?room_type_id=11$/i', '/garderob', $href);
						                    	$href = preg_replace ('/\?room_type_id=12$/i', '/stolovaya', $href);
						                    	$href = preg_replace ('/\?room_type_id=1$/i', '/kitchen', $href);
						                    	$href = preg_replace ('/\?room_type_id=2$/i', '/vannaya', $href);
						                    	$href = preg_replace ('/\?room_type_id=3$/i', '/spalnya', $href);
						                    	$href = preg_replace ('/\?room_type_id=4$/i', '/gostinaya', $href);
						                    	$href = preg_replace ('/\?room_type_id=5$/i', '/kabinet', $href);
						                    	$href = preg_replace ('/\?room_type_id=6$/i', '/detskaya', $href);
						                    	$href = preg_replace ('/\?room_type_id=9$/i', '/lestnitsa', $href);
						                    ?>
                                            <a href="{{$href}}" >{{ $roomType->name }}</a>
                                        @endforeach
                                    </li>
                                </ul>
                                {{--<a href="/f/room">{{ trans('frontend.common.rooms') }}</a>--}}
                            </li>
                            <li class="dropdown">
                                <a href="/f/catalog">{{ trans('frontend.common.catalog') }}</a>
                                <ul class="dropdown-menu">
                                    <li >
                                        @foreach(App\Models\Pcategory::parents() as $pcategory)
                                            <a href="{{route('frontend.catalog.index',['category_id'=>$pcategory->id])}}" >{{ $pcategory->name }}</a>
                                           
                                           
                                        @endforeach
                                    </li>
                                </ul>
                                {{--<a href="/f/catalog">{{ trans('frontend.common.catalog') }}</a>--}}
                            </li>
                            <li>
                                @if (Auth::check())
                                <a href="/f/myroom">{{ trans('frontend.common.myrooms') }}</a>
                                @else
                                <a href="/auth/login"><img src="/images/user.png" width="25" />&nbsp;{{ trans('frontend.common.myrooms') }}</a>
                                @endif
                            </li>
                            
                            
                            <li>
                                <a href="/f/author?city_id=@if(session('city_id')){{ session('city_id') }} @endif">{{ trans('frontend.common.designers') }}</a>
                            </li>
                            <!--<li>
                                <a href="/f/manufacturers">{{--- trans('frontend.common.manufacturers') ---}}</a>
                            </li> -->
                           <li>
                                <a href="/f/stores">{{trans('frontend.common.stores') }}</a>
                            </li>
                             <!-- <li>
                                
                                <a href="/f/brands">{{-- trans('frontend.common.brands') --}}</a>
                            </li> -->
                        </nav>
                    </div>
                </div>

                <div class="col-xs-10 margin-top-10 margin-bottom-10 visible-xs search text-right inner-addon left-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <form action="/search" method="get"><input type="text" class="form-control" name="q" placeholder="{{trans('frontend.common.search')}}"/>
                           
                            </form>
                </div>
                <div class="col-xs-2 visible-xs margin-top-10" id="mob-home-link">
                    @if (Auth::check())
                    <a href="/home"><img src="/images/user.png" class="img-responsive" /></a>
                    @else
                    <a href="/auth/login"><img src="/images/user.png" class="img-responsive" /></a>
                    @endif
                </div>
                @yield('header-menu')
                </div>
            </div>
        </header>

            @yield('content')
        <div id="footer-mob" class="visible-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 footer-btn">
                        <a href="/f/projects"><div class="icon-tag"></div>{{ trans('frontend.common.projects') }}</a>
                    </div>
                    <div class="col-xs-4 footer-btn">
                        <a href="/f/room"><div class="icon-room"></div>{{ trans('frontend.common.rooms') }}</a>
                    </div>
                    <div class="col-xs-4 footer-btn">
                        <a href="/home"><div class="icon-my-room"></div>{{ trans('frontend.common.myrooms') }}</a>
                    </div>
                </div>
                {{--<div class="row text-center">
                    <a href="/desktop-version">{{ trans('frontend.common.see-desktop') }}</a>
                </div>--}}

            </div>
        </div>
        <footer class="container-fluid ">
            <div class="row">
                <div class="container">
                    <div class="nonfixed-menu">
                        <div class="col-md-2 col-md-offset-0 col-xs-offset-3 col-xs-6">
                            <img src="/images/logo-small.png" alt="" class="center img-responsive">
                        </div>
                        <div class="col-md-3 col-xs-6">
                            <ul class="list-unstyled">
                                <li><a href="#">{{ trans('frontend.common.about') }}</a></li>
                                <li><a href="#">{{ trans('frontend.common.contact') }}</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <ul class="list-unstyled">
                                <li><a href="#">{{ trans('frontend.common.rules') }}</a></li>
                                <li><a href="#">{{ trans('frontend.common.rights') }}</a></li>
                                
                            </ul>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="footer-social row">
                                <div class="col-xs-12">
                                    <a href="tel:+78003003300"><i class="flaticon-circle"></i>
                                        <span class="footer-phone-number">8 (800) 300 33 33</span></a>
                                </div>
                                <div class="col-xs-12">
                                    <a href=""><i class="social_facebook_circle"></i></a>
                                    <a href=""><i class="social_instagram_circle"></i></a>
                                    <a href=""><i class=" social_googleplus_circle"></i></a>
                                </div>
                            </div>
                        </div>
                        @if (Session::has('no-resp'))
                        <div class="row text-center">
                            <a href="/cancel-desktop-version">Мобильная версия</a>
                        </div>
                        @endif
                    </div>
                    <div class="fixed-menu">
                        <ul class="list-inline">
                             <li><a href="#">{{ trans('frontend.common.about') }}</a></li>
                                <li><a href="#">{{ trans('frontend.common.contact') }}</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">{{ trans('frontend.common.rules') }}</a></li>
                                <li><a href="#">{{ trans('frontend.common.rights') }}</a></li>
                                <li>
                                    <a href="tel:+78003003300"><i class="flaticon-circle"></i>
                                        <span class="footer-phone-number">8 (800) 300 33 33</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<!-- LOGIN MODAL -->

<!-- Modal -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog modal-md" >

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">{{ trans('frontend.common.signin') }}</h2>
                <p class="text-center">{{ trans('frontend.common.write-user-inf') }}</p>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger modal-error response-message hide">

                </div>
                <form role="form" class="" method="post" id="loginModal2" data-form-id="loginModal" action="/auth/login">

                    
                    <div class="form-group">
                        <label for="email">{{ trans('frontend.form.email') }}</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="{{ trans('frontend.form.type') }} {{ trans('frontend.form.email') }}">
                    </div>
                    <div class="form-group">
                        <label for="psw">{{ trans('frontend.form.password') }}</label>
                        <input type="password" name="password" class="form-control" id="psw" placeholder="{{ trans('frontend.form.type') }} {{ trans('frontend.form.password') }}">
                        <a href="#ForgetPWD" class="forgot-pwd text-right">{{ trans('frontend.form.forgot') }}</a>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <button type="submit" class="center-block clearfix c_btn_medium c_btn_green btn btn-lg">{{ trans('frontend.common.signin') }}</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               <!--  <div class="row social-signs text-center">
                    <a href=""><i class="social_facebook_circle"></i></a>
                    <a href=""><i class="social_instagram_circle"></i></a>
                    <a href=""><i class="social_twitter_circle"></i></a>
                </div> -->
                <p class="text-center reg-href"><a href="">{{ trans('frontend.common.signup') }}</a></p>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN MODAL -->
<!-- SIGN UP MODAL -->
<div class="modal fade" id="signUpModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">{{ trans('frontend.common.signup') }}</h2>
                <p class="text-center">{{ trans('frontend.common.write-user-inf') }}</p>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger modal-error response-message hide">

                </div>
                <form role="form" class="" id="registerModal" data-form-id="registerModal" action="/auth/register" method="post">
                    <div class="form-group">
                        <label for="name">{{ trans('frontend.form.name') }}</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="{{ trans('frontend.form.type') }} {{ trans('frontend.form.name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('frontend.form.email') }} </label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="{{ trans('frontend.form.type') }} {{ trans('frontend.form.email') }}">
                    </div>
                    <div class="form-group">
                        <label for="psw">{{ trans('frontend.form.password') }} </label>
                        <input type="password" name="password" class="form-control" id="psw" placeholder="{{ trans('frontend.form.type') }} {{ trans('frontend.form.password') }} ">
                    </div>
                    <div class="form-group">
                        <label for="conf_psw">{{ trans('frontend.form.repassword') }} </label>
                        <input type="password" name="password_confirmation" class="form-control" id="conf_psw" placeholder="{{ trans('frontend.form.repassword') }} ">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="agreement" required> {{ trans('frontend.form.agreement') }} 
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <button type="submit" class="center-block c_btn_green c_btn_medium c_btn">{{ trans('frontend.common.signup') }}</button>
                    </div>

                </form>
            </div>
            <!-- <div class="modal-footer">
                <div class="row social-signs text-center">
                    <a href=""><i class="social_facebook_circle"></i></a>
                    <a href=""><i class="social_instagram_circle"></i></a>
                    <a href=""><i class="social_twitter_circle"></i></a>
                </div> 
            </div> -->
        </div>
</div></div>
@yield('modals')
<!-- END SIGN UP MODAL -->
<script src="/js/jquery-1.12.2.min.js"></script>
<script src="/js/easing.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/owl-carousel/owl.carousel.js"></script>

<script>
    $(".main-slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
            addClassActive: true,
        paginationSpeed : 400,
        singleItem:true
    });
    $(".list-of-elements-slider").owlCarousel({
        navigation : true,
        slideSpeed : 300,
            addClassActive: true,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
    $(".similar-projects-slider").owlCarousel({
        navigation : true,
        slideSpeed : 300,
            addClassActive: true,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });


    $(".related-posts-slider").owlCarousel({
        navigation : true,
        slideSpeed : 300,
            addClassActive: true,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
    $(".slides").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
            addClassActive: true,
        paginationSpeed : 400,
        pagination : false,
        singleItem:true
    });
</script>
@if (Auth::check())
<div class="modal fade directory-modal" id="dirModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="text-center no-margin-bottom">{{ trans('frontend.common.save') }}</h2>
      <div class="modal-body">
        <div class="alert alert-danger modal-error response-message hide">

                </div>
                <form role="form" class="" id="createRoomModal"  action="/ajax/common/create-room" method="post">
                    <div class="form-group">
                        <label for="choose-room">{{ trans('frontend.common.choose-room') }}</label>
                        <select class="form-control" name="room-id" id="choose-room">
                            @foreach(Auth::user()->ownrooms as $ownRoom)
                            <option value="{{ $ownRoom->id }}">{{ $ownRoom->name }}</option>
                            @endforeach
                            <option value="0">+ {{ trans('frontend.common.create-room') }}</option>
                        </select>
                    </div>
                    <div class="form-group hidden room-name-holder">
                        <label for="room-name">{{ trans('frontend.form.room-name') }} </label>
                        <input type="text" name="room-name" class="form-control" id="room-name" placeholder="{{ trans('frontend.form.room-name') }}">
                    </div>
                   
                    <div class="form-group">
                        <label for="conf_psw">{{ trans('frontend.form.comment') }} </label>
                       <textarea class="form-control" name="comment" id="" cols="30" rows="3" placeholder="{{ trans('frontend.form.comment') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <button type="button" data-form-id="createRoomModal"  class="submit-button center-block c_btn_green c_btn_medium c_btn">{{ trans('frontend.common.save') }}</button>
                    </div>

                </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif
<div class="modal fade roomlook-modal" id="alertModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      <div class="modal-body">
        
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


        <div id="popup-product">
            <div class="bg"></div>
            <div class="popup-close">
                    <button><i class="icon_close"></i></button>
                </div>
            <div class="popup-content">
            
            </div>
        </div>
        <div id="popupRoom">
            <div class="bg"></div>
            <div class="popup-close">
                    <button><i class="icon_close"></i></button>
                </div>
            <div class="popup-content">
                <h2 class="text-center" style="padding-top: 100px;">{{ trans('frontend.common.loading') }}</h2>
            </div>
        </div>
        <div class="product-info fade" data-product-id="0">
            
        </div>
        <!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="bottom-buttons text-center">
            
            <div class="text-center">
                <ul class="list-inline ">
                    <li>
                             <a href="" tabIndex="-1" id="popup-save-btn" class="c_btn_green c_btn_small save-btn " data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="" data-model-name="RoomPicture">
                                        {{ trans('frontend.common.save') }}
                            </a>
                            
                    </li>
                    <li>
                        <div class="has-popup-block  related-posts hidden-xs">
                            <a href="/f/project/s/" target="_blank" tabIndex="-1" class="c_btn_green project-btn c_btn_small ">{{  trans('frontend.common.view-all-project') }}
                            </a>
                            <div class="related-posts-slider popup-block" id="popup-related-posts">
                                <div class="inner-popup-block" id="inner-popup-block">
                                    
                                </div>
                                <div class="clear"></div>
                            </div>
                            </a>
                        </div>
                    </li>
                    <li id="hint-amount"><div class="hint-amount " data-picture-id=""></div></li>
                </ul>
            </div>
            </div>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
    <script src="/js/menu.js"></script>
    <script src="/js/script.js?v=5"></script>
    <script src="/js/mason_app.js"></script>
    <script src="/js/mason.js"></script><!-- Core CSS file -->
    
    <!-- Core JS file -->
    <script src="/js/photoswipe.js?v=58"></script> 

    <!-- UI JS file -->
    <script src="/js/photoswipe-ui-default.js?v=5"></script> 
    <script src="/js/lazysizes.min.js"></script>
    <script>var initPhotoSwipeFromDOM;</script>
    <script src="/js/frontend.js?v=0.993"></script>
   
@yield('script')
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d9d910e0f67eae"></script> 
</body>
</html>
