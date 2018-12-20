<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <link rel="alternate" href="{{ str_replace('/en/', '/ru/', Request::url()) }}" hreflang="ru-kz">  
    <link rel="alternate" href="{{ str_replace('/ru/', '/en/', Request::url()) }}" hreflang="en-kz">  
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120814524-1"></script>
    <meta http-equiv="imagetoolbar" content="no" />
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-120814524-1');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="AuYBhKpcPGAevSkJoxi8FKeSvOXRLWyk2Xsfg1JGtK8" />
    @if (!Session::has('no-resp'))
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="d6522bea1a144e74" />
    @endif
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title', 'RoomLook')</title>
    <meta charset="utf-8" name="keywords" content="@yield('seo_keyword', 'RoomLook, Фотографии, Интерьер, Фасад, дизайн дома')">
    <meta charset="utf-8" name="description" content="@yield('seo_description', 'RoomLook - самый лучший сайт для дизайнеров и не только')">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/elegant-fonts.css" rel="stylesheet">
    <link href="/css/flaticon.css?v=1" rel="stylesheet">
    <link href="/css/flaticon2.css?v=1" rel="stylesheet">
    <link href="/css/fblike.css" rel="stylesheet">
    <link href="/css/lightbox.min.css" rel="stylesheet">

    <link href="/owl-carousel/owl.carousel.css" rel="stylesheet">
    <!-- <link href="/owl-carousel/owl.theme.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/css/photoswipe.css?v=3">
    <!-- <style>
        @media (max-width: 1750px) and (min-width: 768px){
            #main-menu {
                display: inline-block !important;
            }
        }
    </style> -->
    <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite,
     - preloader.gif (for browsers that do not support CSS animations) -->
    <link rel="stylesheet" href="/css/default-skin/default-skin.css?v=1">
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/style.css?v=12" rel="stylesheet">
    <link href="/css/style.media.css?v=5.11" rel="stylesheet">
    @if (Session::has('no-resp'))
    <link rel="stylesheet" type="text/css" href="/css/noresponsive.css?v=1">
    @endif
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="{{ asset('/images/fa.png') }}" />
    <!-- <link rel="icon" type="image/png" href="/images/favicon.png" /> -->
    <meta name="google-site-verification" content="k1be0-dNHy9LeL-pNuekkdDGcJrIQUQlj5j6yi_eack" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        img {
          opacity: 1;
          transition: opacity 0.3s;
        }

        img[data-src] {
          opacity: 0;
        }
        .hint.tag {
            opacity: 1;
        }
        @media (max-width: 1024px) and (min-width: 768px){
            #main-menu {
                display: inline-block !important;
                text-align: center;
            }
        }
        @media (min-width: 1025px) and (max-width: 1440px){
            header #main-menu > li > a {
                padding: 10px 37px;
            }
        }
        @media (max-width: 720px) {
            .logo-holder {
                padding-top: 0px;
            }
        }
    </style>
</head>
<body onload="@yield('onload')" @if (Session::has('no-resp')) class="@yield('body-class') no-resp" @else class="@yield('body-class')" @endif>
        <!-- <div class="hover-header"></div> -->
 
        <header style="
                    /*position: fixed; */
                    top: 0;
                    z-index: 970;
                    width: 100%;
                    background-color: white;
                    padding: 5px 0;
                ">
            <div class="container-fluid">
                <div class="row">


                <div class="col-xs-2 visible-xs" style="padding-right: 0px;">
                    <button id="menu-toggle">
                        <i class="glyphicon glyphicon-menu-hamburger"></i>
                    </button>
                </div>
                <div class="col-sm-2 col-md-offset-0 col-md-2  col-xs-3 logo-holder" style="padding-left: 0px;">
                    <!--<a href="/?pass=RoomLook2016">-->
                    <a href="/">
                        <img src="/images/logo-small.png" alt="" class="logo logo-nonfix img-responsive">
                        <img src="/images/logo-small.png" alt="" class="logo logo-fix img-responsive">
                    </a>
                </div>
                <div class="col-sm-8 col-md-8 col-xs-1">
                <!-- <div class="col-sm-8 col-md-8 col-xs-1 col-lg-offset-1 col-lg-7"> -->

                    <div class="row local-setting-links">


                        <div class="col-sm-12 hidden-xs hidden-lg search text-right inner-addon left-addon"/>
                            <div>
                                <i class="glyphicon glyphicon-search"></i>
                                <form action="/search" method="get"><input type="text" class="form-control" name="q" required />
                                </form>
                            </div>
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
                            <img src="/images/signin.png" width="20" />
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
                        <nav id="main-menu" class="list-inline hidden-xs">
                                <li class=" {{ strpos(\Request::path(), 'f/projects') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{trans('frontend.common.projects') }}</a>
                                </li>
                                <li class="dropdown {{ strpos(\Request::path(), 'f/room') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            @foreach(App\Models\RoomType::all() as $roomType)
                                                <a href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}" >{{ $roomType->name }}</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                    {{--<a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>--}}
                                </li>
                                <li class="dropdown {{ strpos(\Request::path(), 'f/catalog') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>
                                    <ul class="dropdown-menu">
                                        <li >
                                            @foreach(App\Models\Pcategory::parents() as $pcategory)
                                                <a href="{{route('frontend.catalog.index',['category_id'=>$pcategory->id])}}" >{{ $pcategory->name }}</a>


                                            @endforeach
                                        </li>
                                    </ul>
                                    {{--<a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>--}}
                                </li>
                               {{--< <li>
                                    @if (Auth::check())
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom">{{ trans('frontend.common.myrooms') }}</a>
                                    @else
                                    <a href="/auth/login">{{ trans('frontend.common.myrooms') }}</a>
                                    @endif
                                </li>--}}


                                <li class=" {{ strpos(\Request::path(), 'f/author') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author?city_id=@if(session('city_id')){{ session('city_id') }} @endif">{{ trans('frontend.common.designers') }}</a>
                                </li>
                                <!--<li>
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/manufacturers">{{--- trans('frontend.common.manufacturers') ---}}</a>
                                </li> -->
								<li class=" {{ strpos(\Request::path(), 'f/stores') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores">{{trans('frontend.common.stores') }}</a>
                                </li>
                                 <!-- <li>

                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/brands">{{-- trans('frontend.common.brands') --}}</a>
                                </li> -->  
                                <li class=" {{ strpos(\Request::path(), 'f/ideas') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas">{{trans('frontend.common.posts') }}</a>
                                </li>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-2 text-center col-md-2  header-btns col-xs-7">
                    <div class="headerTopContainer">
                        <div class="col-md-3 col-xs-4 hidden-xs hidden-md hidden-sm xs-nopadding" style="position: relative;">
                            <a id="search-btns" href="#">
                                <img src="{{ asset('/search.png') }}" alt="">
                            </a>
                            <div class="search-form">
                                <form action="/search" method="get">
                                    <input type="text" class="form-control" name="q" required placeholder="{{ trans('frontend.common.search') }}" />
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-4 visible-xs signInDrop xs-nopadding">
                            @if (Auth::check())
                                <a id="nameLetter" href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom">
                                    {{ substr(Auth::user()->name, 0, 1)}}
                                </a>
                                <div id="signOut">
                                    <a href="/auth/logout">Выйти</a>
                                </div>
                            @else
                                <a id="signIn" href="/auth/login">
                                    <img src="/images/signin.png" width="30" />
                                </a>
                                <div id="signOut">
                                    <a href="/auth/login">Войти</a>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-3 col-xs-4 hidden-xs signInDrop xs-nopadding">
                            @if (Auth::check())
                                <a id="nameLetter" href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom">
                                    {{ substr(Auth::user()->name, 0, 1)}}
                                </a>
                                <div id="signOut">
                                    <a href="/auth/logout">Выйти</a>
                                </div>
                            @else
                                <a id="signIn" href="/auth/login">
                                    <img src="/images/signin.png" width="30" />
                                    
                                </a>
                                <div id="signOut">
                                    <a href="/auth/login">Войти</a>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-3 col-xs-4 xs-nopadding">
                            <div class="dropdown">
                                <button class="dropdown-toggle c_clear_btn locale-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    {{ LaravelLocalization::getCurrentLocale() }}
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
                        </div>
                        <div class="col-md-3 col-xs-4 xs-nopadding">
                            <div class="dropdown location-dropdown">
                            <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <div class="dv-location">
                                        <img src="{{ asset('/images/placeholder.svg') }}" alt="" style="width: 20px;">
                                    </div>
                                </button>
                                <ul class="dropdown-menu" style="margin-left: -110px;" aria-labelledby="dropdownMenu1">
                                    
                                    <li class="search-city-holder">
                                        <input type="text" class="search-city" placeholder="{{ trans('frontend.common.search') }}" name="search-city">
                                    </li>
                                    <?php $i = 0;
                                    $n =  App\Models\Country::all()->count() - 1;?>
                                    @foreach(App\Models\Country::all() as $country)
                                    <li class="dropdown-header">
                                        <a href="#" tabIndex="-1" data-country-id="{{ $country->id }}">{{ $country->name }}</a>
                                    </li>
                                        @if ($country->cities)
                                        @foreach($country->cities as $city)
                                        <li>
                                            <a href="/changecity/{{ $city->id }}" class="custom-ajax-button" style="{{ ( null != session('city_id') && session('city_id') == $city->id) ? 'font-weight:bold' : '' }}"  data-city-id="{{ $city->id }}">{{ $city->name }}</a>
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
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 margin-top-10 margin-bottom-10 mob-search text-right inner-addon left-addon">
                    <i class="glyphicon glyphicon-search hidden-xs"></i>
                    <form action="/search" method="get"><input type="text" class="form-control" name="q" placeholder="{{trans('frontend.common.search')}}"/>

                            </form>
                </div>

                    <div id="mob-menu" class=" main-menu-wrapper hidden-lg hidden-md">
                        <nav class="list-inline col-xs-12 col-sm-12">
                            <li>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{trans('frontend.common.projects') }}</a>
                            </li>
                            <li class="dropdown">
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @foreach(App\Models\RoomType::all() as $roomType)
                                            <a href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}" >{{ $roomType->name }}</a>
                                        @endforeach
                                    </li>
                                </ul>
                                {{--<a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>--}}
                            </li>
                            <li>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas">{{trans('frontend.common.posts') }}</a>
                            </li>
                            <li class="dropdown">
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>
                                <ul class="dropdown-menu">
                                    <li >
                                        @foreach(App\Models\Pcategory::parents() as $pcategory)
                                            <a href="{{route('frontend.catalog.index',['category_id'=>$pcategory->id])}}" >{{ $pcategory->name }}</a>


                                        @endforeach
                                    </li>
                                </ul>
                                {{--<a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>--}}
                            </li>
                           {{--< <li>
                                @if (Auth::check())
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom">{{ trans('frontend.common.myrooms') }}</a>
                                @else
                                <a href="/auth/login">{{ trans('frontend.common.myrooms') }}</a>
                                @endif
                            </li>--}}


                            <li>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author?city_id=@if(session('city_id')){{ session('city_id') }} @endif">{{ trans('frontend.common.designers') }}</a>
                            </li>
                            <!--<li>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/manufacturers">{{--- trans('frontend.common.manufacturers') ---}}</a>
                            </li> -->
                           <li>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores">{{trans('frontend.common.stores') }}</a>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-search hidden-xs"></i>
                                <form action="/search" method="get"><input type="text" class="form-control" name="q" placeholder="{{trans('frontend.common.search')}}"/>

                            </form>
                            </li>
                             <!-- <li>

                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/brands">{{-- trans('frontend.common.brands') --}}</a>
                            </li> -->
                        </nav>
                    </div>
                <div class="col-xs-2 margin-top-10" id="mob-home-link">
                    @if (Auth::check())
                    <a href="/home"><img src="/images/signin.png" class="img-responsive" /></a>
                    @else
                    <a href="/auth/login"><img src="/images/signin.png" class="img-responsive" /></a>
                    @endif
                </div>
                @yield('header-menu')
                </div>
            </div>
        </header>

            @yield('content')
        <div id="footer-mob" >
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 footer-btn">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects"><div class="icon-tag"></div>{{ trans('frontend.common.projects') }}</a>
                    </div>
                    <div class="col-xs-4 footer-btn">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room"><div class="icon-room"></div>{{ trans('frontend.common.rooms') }}</a>
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
        <footer>

                <div class="container-fluid">

                    <div class="fixed-menu">
                        <ul class="list-inline">
                             <li><a href="/">{{ trans('frontend.common.home') }}</a></li>
                             <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a></li>
                             <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a></li>
                             <li><a href="/p/o-proekte">{{ trans('frontend.common.about') }}</a></li>
                                <li style="margin-bottom: 0;"><a href="/p/kontakty">{{ trans('frontend.common.contact') }}</a></li>
                                <li><a href="/p/faq">FAQ</a></li>
                                <li><a href="/p/pravila-bezopasnosti">{{ trans('frontend.common.rules') }}</a></li>
                                <!-- <li><a href="/p/avtorskie-prava">{{ trans('frontend.common.rights') }}</a></li> -->
                                {{--<li>
                                    <a href="tel:+78003003300"><i class="flaticon-circle"></i>
                                        <span class="footer-phone-number">8 (800) 300 33 33</span></a></li>--}}
                        </ul>
                        <p class="footer-p">2018 Roomlook.com - идеи дизайна мебели для стильного интерьера. <br> Копирование материалов сайта без разрешения редакции запрещено.</p>
                        <p class="footer-p">Связаться с нами: <a href="mailto:info@roomlook.com">info@roomlook.com</a></p>
                        <small>Мы в социальных сетях</small> <br>
                        <ul class="list-inline" style="display: inline-flex;">
                                <li>
                                    <a href=""><img src="/images/pinterest.png"></a>
                                </li>
                                 <li>
                                    <a href=""><img src="/images/telegram.png"></a>
                                </li>
                                 <li>
                                    <a href=""><img src="/images/vk.png"></a>
                                </li>
                                 <li>
                                    <a href=""><img src="/images/insta.png"></a>
                                </li>
                                 <li>
                                    <a href=""><img src="/images/fb.png"></a>
                                </li>
                        </ul>
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
<script src="/js/all.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->



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
    $("button.close").on('click', function() {
        console.log("asd");
    });
</script>
@if (Auth::check())
<div class="modal fade directory-modal" id="dirModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <h3 class="text-center">ВЫБОР АЛЬБОМА</h3>
        <div class="alert alert-danger modal-error response-message hide">

                </div>
                    <div class="albom-buttons">
                        <ul>
                            @foreach(Auth::user()->ownrooms as $ownRoom)
                            <li><button type="button" class="room-btn" value="{{ $ownRoom->id }}">{{ $ownRoom->name }}</button></li>
                            @endforeach
                        </ul>
                    </div>

        <div class="row bottom-line">
            <button class="create-room" data-toggle="modal"  data-dismiss="modal" data-target="#createDirModal">Создать альбом</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade directory-modal" id="createDirModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <div class="alert alert-danger modal-error response-message hide">

        </div>
        <div class="new-albom-wrapper">
            <form role="form" class="" id="createRoomModal"  action="/ajax/common/create-room" method="post">
                <div class="form-group room-name-holder">
                    <label for="room-name" class="text-uppercase">{{ trans('frontend.common.create-myroom') }}</label>
                    <input type="text" name="room-name" class="form-control" id="room-name" placeholder="{{ trans('frontend.form.room-name') }}">
                </div>
            </form>
        </div>

        <div class="row bottom-line">
            <div class="col-md-6 text-left">
                <button type="button"  data-dismiss="modal" aria-label="Close">Отмена</button>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="{{ isset($noajax) ? 'noajax' : '' }} create-albom"  form-id="createRoomModal">Создать</button>
            </div>
        </div>
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

<div class="modal fade city-modal" id="cityModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      <div class="modal-body">
        <h3 class="text-center">ВЫБЕРИТЕ ВАШ ГОРОД</h3>
        <br>
        <div class="dropdown location-dropdown text-center">

                            <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Все

                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php $i = 0;
                            $n =  App\Models\Country::all()->count() - 1;?>
                            @foreach(App\Models\Country::all() as $country)
                            <li class="dropdown-header">
                                <a href="#" tabIndex="-1"  style="{{ ( null !== session('city_id')  && session('city_id') == $city->id ) ? 'font-weight: bold' : '' }}"  data-city-id="{{ $city->id }}" data-country-id="{{ $country->id }}">{{ $country->name }}</a>
                            </li>
                                @if ($country->cities)
                                @foreach($country->cities as $city)
                                <li>
                                    <a href="/changecity/{{ $city->id }}" style="{{ ( null !== session('city_id')  && session('city_id') == $city->id ) ? 'font-weight: bold' : '' }}"  data-city-id="{{ $city->id }}">{{ $city->name }}</a>
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
                    <li class="action-btns">
                             <a href="#" tabIndex="-1" id="popup-save-btn"  class="c_btn_transparent_green c_btn_small save-btn" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="+"   data-model-name="RoomPicture" data-model-id="">
                                  +
                            </a>

                    </li>
                    <li>
                        <div class="has-popup-block  related-posts">
                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/" target="_blank" tabIndex="-1" class="c_btn_green project-btn c_btn_small ">{{  trans('frontend.common.view-all-project') }}
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

<!-- <div class="hover-footer"></div> -->
<script src="{{ asset('/js/photoswipe2.js') }}"></script>
    <script>var initPhotoSwipeFromDOM;</script>

@yield('script')
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter49405165 = new Ya.Metrika2({
                    id:49405165,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<script>
    document.getElementsByTagName('img').ondragstart = function() { return false; }
    var img = document.getElementsByTagName('img');

    for(var i in img)
    {
        img[i].oncontextmenu = function()
        {
            return false;
        }
    }
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/49405165" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.item.pg-items').each(function () {
                let $el = $(this);
                $el.find('.hint.tag').each(function () {
                    $(this).css('opacity', 0);
                });
            });
        }, 5000);
    });
    $('.item.pg-items').mouseover(function () {
        let $el = $(this);
        $el.find('.hint.tag').each(function () {
            $(this).css('opacity', 1);
        });
    });
    $('.item.pg-items').mouseout(function () {
        let $el = $(this);
        $el.find('.hint.tag').each(function () {
            $(this).css('opacity', 0);
        });
    });
    $('.hint.tag').mouseover(function () {
        let $el = $(this);
        $el.find('.ringring2').css('display', 'block');
    });
    $('.hint.tag').mouseout(function () {
        let $el = $(this);
        $el.find('.ringring2').css('display', 'none');
    });
</script>
<script>
    $('#search-btns').mouseover(function (e) {
        e.preventDefault();
        $('.search-form').css('opacity', '1');
        // setTimeout(function () {
            $('.search-form').css('transform', 'translateX(-100%)');
            $('.search-form').css('width', '200%');
        // }, 500);
    });
    $('#main').mouseover(function (e) {
        e.preventDefault();
        $('.search-form').css('transform', 'translateX(-85%)');
        $('.search-form').css('width', '0%');
        $('.search-form').css('opacity', '0');
    });

</script>
<script>
    [].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
      img.setAttribute('src', img.getAttribute('data-src'));
      img.onload = function() {
        img.removeAttribute('data-src');
      };
    });



    $(function () {



        $(".custom-ajax-button").on("click", function(e) {

            e.preventDefault();
            
            let url = $(this).attr("href");


            $.ajax({
                url,
                dataType: 'json',
                type: 'get',
                success: function(res) {
                    if (res.status == 'success') {

                        window.location.reload();

                    }
                }
            });


        });



    });
</script>
</body>
</html>