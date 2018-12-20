<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (!Session::has('no-resp'))
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @endif
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title', 'RoomLook')</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/elegant-fonts.css" rel="stylesheet">
    <link href="/css/flaticon.css?v=1" rel="stylesheet">
    <meta charset="utf-8" name="keywords" content="@yield('seo_keyword', 'RoomLook, Фотографии, Интерьер, Фасад, дизайн дома')">
    <meta charset="utf-8" name="description" content="@yield('seo_description', 'RoomLook - самый лучший сайт для дизайнеров и не только')">
   
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
    <link href="/css/style.css?v=2.178" rel="stylesheet">
    <link href="/css/style.media.css?v=1.23" rel="stylesheet">
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
    <link rel="icon" type="image/png" href="/images/fa.png" />
    <meta name="google-site-verification" content="k1be0-dNHy9LeL-pNuekkdDGcJrIQUQlj5j6yi_eack" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="@yield('onload')" @if (Session::has('no-resp')) class="no-resp" @endif style="background-image: url('/images/authbg.jpg'); background-attachment: fixed;">
    <header style="  position: fixed; top: 0;z-index: 970;width: 100%;background-color: white;padding: 5px 0;">
            <div class="container-fluid">
                <div class="row">


                <div class="col-xs-2 visible-xs" style="padding-right: 0px;">
                    <button id="menu-toggle">
                        <i class="glyphicon glyphicon-menu-hamburger"></i>
                    </button>
                </div>
                <div class="col-sm-2 col-md-offset-0 col-md-3  col-xs-3 logo-holder" style="padding-left: 0px;">
                    <a href="/?pass=RoomLook2016">
                        <img src="/images/logo-small.png" alt="" class="logo logo-nonfix img-responsive">
                        <img src="/images/logo-small.png" alt="" class="logo logo-fix img-responsive">
                    </a>
                </div>
                <div class="col-sm-8 col-md-6 col-xs-1">

                    <div class="row local-setting-links">


                        <div class="col-sm-12 hidden-xs search text-right inner-addon left-addon"/>
                            <div>
                                <i class="glyphicon glyphicon-search"></i>
                                <form action="/search" method="get"><input type="text" class="form-control" name="q" required="required" />
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
                            <li class="dropdown {{ strpos(\Request::path(), 'f/room') != false ? 'active' : '' }}">
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>
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
                        </nav>
                    </div>
                </div>
                <div class="col-sm-2 text-center col-md-3  header-btns col-xs-7">
                    <div class="headerTopContainer">
                        <div class="col-md-3 col-md-offset-3 col-xs-4 visible-xs signInDrop xs-nopadding">
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
                        <div class="col-md-3 col-md-offset-3 col-xs-4 hidden-xs signInDrop xs-nopadding">
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
                                    <img src="/images/location.png" width="30" />
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
                                            <a href="/changecity/{{ $city->id }}" style="{{ ( null != session('city_id') && session('city_id') == $city->id) ? 'font-weight:bold' : '' }}"  data-city-id="{{ $city->id }}">{{ $city->name }}</a>
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
                            <li class="dropdown">
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>
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
                                {{--<a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>--}}
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
                             <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/p/o-proekte">{{ trans('frontend.common.about') }}</a></li>
                                <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/p/kontakty">{{ trans('frontend.common.contact') }}</a></li>
                                <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/p/faq">FAQ</a></li>
                                <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/p/pravila-bezopasnosti">{{ trans('frontend.common.rules') }}</a></li>
                                <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/p/avtorskie-prava">{{ trans('frontend.common.rights') }}</a></li>
                                {{--<li>
                                    <a href="tel:+78003003300"><i class="flaticon-circle"></i>
                                        <span class="footer-phone-number">8 (800) 300 33 33</span></a></li>--}}
                                <li>
                                    <a href="#"><img src="/images/pinterest.png"></a>
                                </li>
                                 <li>
                                    <a href="#"><img src="/images/telegram.png"></a>
                                </li>
                                 <li>
                                    <a href="#"><img src="/images/vk.png"></a>
                                </li>
                                 <li>
                                    <a href="#"><img src="/images/insta.png"></a>
                                </li>
                                 <li>
                                    <a href="#"><img src="/images/fb.png"></a>
                                </li>
                        </ul>
                    </div>
                </div>
        </footer>


<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
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
    $("button.close").on('click', function() {
        console.log("asd");
    });
</script>
    <script src="/js/menu.js"></script>
    <script src="/js/script.js?v=11"></script>
    <script src="/js/mason_app.js"></script>
    <script src="/js/mason.js"></script><!-- Core CSS file -->

    <!-- Core JS file -->
    <script src="/js/photoswipe.js?v=59"></script>

    <!-- UI JS file -->
    <script src="/js/photoswipe-ui-default.js?v=5"></script>
    <script src="/js/lazysizes.min.js"></script>
    <script>var initPhotoSwipeFromDOM;</script>
    <script src="/js/frontend.js?v=3.7"></script>

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
<noscript><div><img src="https://mc.yandex.ru/watch/49405165" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</body>
</html>
