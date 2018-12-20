<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/elegant-fonts.css" rel="stylesheet">
    <link href="/css/flaticon.css" rel="stylesheet">
    <link href="/css/flaticon2.css" rel="stylesheet">
    <link href="/css/fblike.css" rel="stylesheet">
    <link href="/owl-carousel/owl.carousel.css" rel="stylesheet">
    <!-- <link href="/owl-carousel/owl.theme.css" rel="stylesheet"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style.media.css" rel="stylesheet">
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
<body onload="@yield('onload')">
<div id="wrapper">
    <div class="overlay"></div>

    <!-- Sidebar -->
    <nav class="navbar visible-xs visible-sm navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="/?pass=RoomLook2016">
                    RoomLook
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('frontend.common.rooms') }}</a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        @foreach(App\Models\RoomType::all() as $roomType)
                            <a href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}" >{{ $roomType->name }}</a>
                        @endforeach
                    </li>
                </ul>
            </li>
            <li>
                <a href="/f/catalog">{{ trans('frontend.common.catalog') }}</a>
            </li>
            <li>
                @if (Auth::check())
                    <a href="/f/myroom">{{ trans('frontend.common.myrooms') }}</a>
                @else
                    <a  href="/auth/login">{{ trans('frontend.common.myrooms') }}</a>
                @endif
            </li>
            
            <li>
                <a href="/f/author">{{ trans('frontend.common.designers') }}</a>
            </li>
            <li>
                <a href="/f/brands">{{ trans('frontend.common.brands') }}</a>
            </li>
            <li>
                <a href="/f/stores">{{ trans('frontend.common.stores') }}</a>
            </li>
            @if (Auth::check())
            <li>
                <a href="/home">{{ trans('frontend.common.profile') }}</a>
            </li>
            <li>
                <a href="/auth/logout">{{ trans('frontend.common.logout') }}</a>
            </li>
            @else
            <li>
                <a  href="/auth/login">{{ trans('frontend.common.signin') }}</a>
            </li>
            <li>
                <a  data-toggle="modal" href="#signUpModal">{{ trans('frontend.common.signup') }}</a>
            </li>
            @endif
           

        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!--Fixed navbar-->


    <!--End fixed navbar-->


    <!-- Page Content -->
    <div id="page-content-wrapper">
        <button type="button" class=" visible-xs visible-sm hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <div id="loc-lang">
             <ul class="localization list-inline pull-left list-unstyled">
                <li class="">
                    <div class="dropdown">
                        <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
            </ul>
        </div>
        <header>
            <div class="container">
                <div class="col-sm-2 col-md-offset-0 col-xs-offset-1 col-xs-6 logo-holder">
                    <a href="/?pass=RoomLook2016">
                        <img src="/images/logo-small.png" alt="" class="logo img-responsive">
                    </a>
                </div>
                <div class="col-sm-8 col-md-10 col-xs-5">
                    <div class="row local-setting-links">
                    <ul class="localization list-inline pull-left list-unstyled">
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
                        </ul>
                        <div class="col-sm-7 hidden-xs search text-right inner-addon left-addon">
                            <i class="glyphicon glyphicon-search"></i>
                            <input type="text" class="form-control" placeholder="{{trans('frontend.common.search')}}"/>
                        </div>
                        <ul class="social-icons list-inline">
                             <li><a href=""><i class="social_facebook_circle"></i></a></li>
                                <li><a href=""><i class="social_instagram_circle"></i></a></li>
                                <li><a href=""><i class=" social_googleplus_circle"></i></a></li>
                        
                        </ul> 
                        <div class="auth text-right hidden-xs">
                            <img src="/images/user.png" width="20" />
                            @if (Auth::check())
                            <a href="/home">{{ trans('frontend.common.profile') }}</a>
                            <a href="/auth/logout">{{ trans('frontend.common.logout') }}</a>
                            @else
                            <a href="/auth/login">{{ trans('frontend.common.signin') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="row main-menu-wrapper">
                        <nav id="main-menu" class="list-inline hidden-xs hidden-sm">
                            <li class="dropdown">
                                <a href="/f/room">{{ trans('frontend.common.rooms') }}</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @foreach(App\Models\RoomType::all() as $roomType)
                                            <a href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}" >{{ $roomType->name }}</a>
                                        @endforeach
                                    </li>
                                </ul>
                                {{--<a href="/f/room">{{ trans('frontend.common.rooms') }}</a>--}}
                            </li>
                            <li class="dropdown">
                                <a href="/f/catalog">{{ trans('frontend.common.catalog') }}</a>
                                <ul class="dropdown-menu">
                                    <li >
                                        @foreach(App\Models\Pcategory::all() as $pcategory)
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
                                <a href="/f/author">{{ trans('frontend.common.designers') }}</a>
                            </li>
                            <!-- <li>
                                <a href="/f/manufacturers">{{--- trans('frontend.common.manufacturers') ---}}</a>
                            </li> -->
                            <li>
                                <a href="/f/stores">&nbsp;{{ trans('frontend.common.stores') }}</a>
                            </li>
                            <li>
                                
                                <a href="/f/brands">{{ trans('frontend.common.brands') }}</a>
                            </li>
                        </nav>
                    </div>
                </div>

                <div class="col-xs-12 margin-top-10 margin-bottom-10 visible-xs search text-right inner-addon left-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" class="form-control" placeholder="{{trans('frontend.common.search')}}"/>
                </div>
            </div>
        </header>

            @yield('content')
        <footer class="container-fluid">
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
    </div>
    <!-- /#page-content-wrapper -->

</div>

    
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
    </div>
</div>

@yield('modals')
<!-- END SIGN UP MODAL -->
<script src="/js/jquery-1.12.2.min.js"></script>
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
            
            </div>
        </div>
<script src="/js/menu.js"></script>
<script src="/js/script.js"></script>
<script src="/js/frontend.js"></script>
@yield('script')

</body>
</html>