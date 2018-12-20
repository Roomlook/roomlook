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
   
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/css/photoswipe.css?v=3"> 
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
  
    <meta name="google-site-verification" content="k1be0-dNHy9LeL-pNuekkdDGcJrIQUQlj5j6yi_eack" />
 
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    <link rel="stylesheet" href="/css/new/style.css">
	<link href="/css/styles.css" rel="stylesheet">
	<link href="/new/articles.css" rel="stylesheet">
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
	
    <link href="/new/adaptiv.css" rel="stylesheet">
	
	
<script>
$(document).ready(function () {   
$(".thumb").hover(
  function() {
    
	var img = $(this).attr("data-img");  
	$("#thumb").css("background-image", "url(" + img + ")"); 
	 
  }, function() {
     
  }
);
});
</script>
	
	<!-- Style Sheet-->
    <link rel="stylesheet" href="/css/new/tooltipster.css">
    <link href="/css/new/ie.css" rel="stylesheet" media="all"> 
	<link rel="stylesheet" href="/css/new/responsive.css">
    <link rel="stylesheet" href="/css/new/prettyPhoto.css">
	
	
	
	
					 
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
   
   

$(document).on('click', '.fitem', function(e) {   
	//e.preventDefault();
	
	$(this).toggleClass('open');
	
});


   
$(document).on('click', '.pagination a', function(e) {  
	e.preventDefault();
	
	$(".ajax-catalog").children('#page').remove();
	
	var page = $(this).attr('data-page');
	
	if(page) {
		$("<input type='hidden' id='page' name='page' value='" + page + "' />").appendTo(".ajax-catalog");
	}
	
		var data = $(".ajax-catalog").serialize();
	     		 
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
	 
                }
            });  
	
	
});
   
$(document).on('click', '.ajax-rooms', function(e) {
		e.preventDefault();
	
		var room_id = $(this).attr('data-room-id'),
			data = $(".ajax-catalog").serialize();
			
		$('.ajax-catalog').children('#room_id').val(room_id);  
	      
		setTimeout(function() {
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog_tree', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res);  
				
				$('.sidebar').html(obj);
	 
                }
            }); 
			
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj); 
	 
                }
            }); 
		}, 600);   
			
}); 

$(document).on('click', '.category', function(e) {  
		e.preventDefault();
	
		var category = $(this).attr('data-category');
	 
		$('.ajax-catalog').children('#category_id').val(category);
	
		var data = $(".ajax-catalog").serialize();
	     
			
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog_tree', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res);  
				
				$('.sidebar').html(obj);
	 
                }
            }); 
			
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
	 
                }
            }); 
			
			
}); 



  $( function() { 
			
  
 
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 50000,
      values: [ 75, 20000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		
		$(".ajax-catalog").children('#price_min').val(ui.values[ 0 ]);
		$(".ajax-catalog").children('#price_max').val(ui.values[ 1 ]);
		
      },
		stop: function(event, ui) { 
	      
		var data = $(".ajax-catalog").serialize(); 
		
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
	 
                }
            }); 
		
		}
    });
	
    $( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
   
   
   
   
		var data = $(".ajax-catalog").serialize();
	     
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
	 
                }
            }); 
			
			
			
  } );
 
  
$(document).on('click', '#slider-range', function(e) {
	e.preventDefault();
	 
	
});

$(document).on('submit', '.ajax-catalog', function(e) {
	e.preventDefault();
	
	var html = '';
	
	$('.gridview').html(html);
	$('.pagination').html('');
	
});

$(document).on('click', '.sort-item', function() {
	
		var sort = $(this).attr('data-order'),
			sort2 = $(".ajax-catalog").children('#sort').attr('data-order');
	
		$(this).parent().toggleClass('on');
	
		if(!sort2) {
			$("<input type='hidden' id='sort' name='sort' value='" + sort + "' />").appendTo(".ajax-catalog");
		}
		 
		if(sort2 == 'desc') {
			$(".ajax-catalog").children('#sort').attr('data-order', 'asc');
			$(".ajax-catalog").children('#sort').attr('value', 'asc');
			$(this).attr('value', 'asc');
			$(this).attr('data-order', 'asc');
		}else{
			$(".ajax-catalog").children('#sort').attr('data-order', 'desc');
			$(".ajax-catalog").children('#sort').attr('value', 'desc');
			$(this).attr('value', 'desc');
			$(this).attr('data-order', 'desc');
		}
	
		var data = $(".ajax-catalog").serialize();
	     
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
	 
                }
            }); 
	
	
});
  
$(document).on('click', '.filter-tags .css-label', function() {
	
	$(this).remove();
	
});

$(document).on('change', '.fcheckbox', function() {
    
	$('.gridview').addClass('loading');
	$('.gridview').append('<p style="text-align:center;width:100px;height:100px;top:50%;margin-top:-50px;margin-left:-50px;left:50%;position: absolute;"> <img src="https://www.in-room.ru/img/loader.gif" alt=""> <br>Загрузка ...</p>');
	 
	if(this.checked) {
       
		var group = $(this).attr('data-group'),
			label = $(this).attr('id'); 
	   
		$("<input type='hidden' name='group_id[]' value='" + group + "' />").appendTo(".ajax-catalog");
		
		$(this).clone().appendTo(".ajax-catalog");
		
		$('#' + label + ' + label').clone().appendTo(".filter-tags");
		
		var data = $(".ajax-catalog").serialize();
	   
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
				$('.gridview').removeClass('loading');
	
				/*
				var obj = JSON.parse(res); 
				
				$('.count-catalog').html(obj.length);
				
                    if (res.status == 'success') {

                        window.location.reload();

                    }
				*/
                }
            }); 
	 
    }else{
		
		var id = $(this).attr('id');  
		
		$(".ajax-catalog").children('#' + id).remove();
		
		var data = $(".ajax-catalog").serialize();  
		
            $.ajax({
                url: 'https://roomlook.com/ru/api/catalog', 
				data: data,
                type: 'post',
                success: function(res) {  
				
				var obj = JSON.parse(res); 
				
				$('.gridview').html(obj);
				$('.gridview').removeClass('loading');
	 
                }
            }); 
		 
	}
});
  
  </script>
  
  
	
<style>	 

.menu-rooms ul li div {position:relative;}
.menu-rooms ul li div:after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, .5);
    transition: .3s;
}
.menu-rooms ul li div:hover:after {background:rgba(0, 0, 0, .1);transition:.3s;}

.search_conteiner { position: relative; height: 30px; z-index: 99; } 
.search_conteiner .search {
    position: absolute;
    margin: auto;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 30px; 
    border-radius: 50%;
    transition: all 1s;
    z-index: 4; 
	background: #fff;
	border: none;
	border: 2px solid #8404dd;
}
.search_conteiner .search:hover { cursor: pointer; }
.search_conteiner .search::before {
      content: "";
      position: absolute;
      margin: auto;
    top: 10px;
    right: 0;
    bottom: 0;
    left: 8px;
    width: 6px;
      height: 2px;
      background: #8404dd;
      transform: rotate(45deg);
      transition: all .5s;
}
.search_conteiner .search::after {
      content: "";
      position: absolute;
      margin: auto;
      top: -5px;
      right: 0;
      bottom: 0;
      left: -3px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      border: 2px solid #8404dd;
      transition: all .5s;
}
.search_conteiner input { 
    position: absolute;
    margin: auto;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 0px;
    height: 30px;
    outline: none;
    border: none;
    // border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    background: #fff;
    color: #000; 
    padding: 0 0 0 20px;
    border-radius: 30px;
    box-shadow: 0 0 25px 0 #fff,
                0 20px 25px 0 rgba(0, 0, 0, 0.2);
    // box-shadow: inset 0 0 25px 0 rgba(0, 0, 0, 0.5);
    transition: all 1s;
    opacity: 0;
    z-index: 5;
    font-weight: bolder;
    letter-spacing: 0.1em;
    border: 1px solid #dcc7ec;
}
.search_conteiner input:hover { cursor: pointer; }
.search_conteiner input:focus {
      width: 300px;
	  left:-270px;
      opacity: 1;
      cursor: text;
    }
.search_conteiner input:focus ~ .search {
      right: -0px;
      background: #151515;
      z-index: 6;
}
.search_conteiner  input::before {
        top: 0;
        left: 0;
        width: 25px;
      }
.search_conteiner input::after {
        top: 0;
        left: 0;
        width: 25px;
        height: 2px;
        border: none;
        background: white;
        border-radius: 0%;
        transform: rotate(-45deg);
      }
.search_conteiner input::placeholder {
      color: white;
      opacity: 0.5;
      font-weight: bolder;
}
   
@media (max-width: 1200px) {
  .main__section1 {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }
  .main__section1__block1{
	  min-width: 100% !important;
	  max-width: 100% !important;
   }		
  .main__section1__block1 img {
    width: 100%; }
  .main__section1__block2 {
    margin-left: 0;
    margin-top: 30px; }
  .main__section3 {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-align: center;
    -webkit-align-items: center;
        -ms-flex-align: center;
            align-items: center; }
  .main__section3-block2 {
    margin-top: 30px; } 
  .main__section3-block1{
    margin-right: 0; }
  .main__section3-block2 img {
	margin-right: 0; }
  }

@media (max-width: 1050px) {
  .black-blue-blocks {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }
  .block__black__row {
    padding: 40px 40px;
    width: 400px;
    margin: 0 auto; }
  .block__blue__row {
    width: 700px;
    margin: 0 auto; } }

@media (max-width: 712px) {
.feedback2 p { display:none; height: 0px!important; }
.feedback2 h2 { 
font-size: 20px; }
  .block__blue__row {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column;
    padding: 30px 15px;
    width: 100%; }
  .block__blue__row ul {
    text-align: center; }
  .ul-border {
    text-align: center;
    border-right: 0;
    border-left: 0;
    padding: 30px 0;
    border-top: 1px solid white;
    border-bottom: 1px solid white;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-bottom: 30px !important;
    margin-top: 30px !important; } }

@media (max-width: 470px) {
  .block__black {
    min-width: 100%; }
  .block__black__row {
    width: 100%;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }
  .block__black__row ul {
    margin-left: 0 !important;
    text-align: center; } }

</style> 
</head>
<body style="background:#ececec;" onload="@yield('onload')" @if (Session::has('no-resp')) class="@yield('body-class') no-resp" @else class="@yield('body-class')" @endif>

        <header class="mobile">
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-2 col-md-2 col-xs-3 logo-holder">
                    <a href="/">
                        <img src="/images/mb-logo.jpg" alt="" class="logo"> 
                    </a>
                </div>
                <div class="col-sm-8 col-md-8 col-xs-4"> 
                </div> 
                <div class="col-sm-8 col-md-8 col-xs-5"> 
					<div class="mb-settings">
						<div><div class="mb-search"></div></div>
						<div><div class="mb-profil"><a href="/auth/login"></a></div></div>
						<div><div class="mb-language"></div></div>
						<div><div class="mb-location"></div></div>
						<div><div class="mb-menu">
						
						<content class="mob-view"> 
  <input id="hamburger" class="hamburger is-closed" type="checkbox">
  <label class="hamburger is-closed" for="hamburger" style="left:0;margin-left:0px;">
    <i style="left:20%;"></i>
    <text style="display:none;">
      <close>закрыть</close>
      <open>меню</open>
    </text>
  </label>
  <section class="drawer-list" style="width:100%;">
        <ul>
        <li><a data-id="1" href="https://roomlook.com/ru/projects">Проекты</a></li>
		<li> <a data-id="1" href="https://roomlook.com/ru/room">Комнаты</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/articles">Статьи</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/catalog">Каталог</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/author?city_id=16">Дизайнеры</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/stores">Магазины</a></li>
		</ul>
      </section>
</content>
						 
						</div></div>
					</div>
                </div> 
				</div>
			</div>
		</header>
		

        <header class="desktop">
            <div class="container-fluid">
                <div class="row">
 
                <div class="col-xs-2 visible-xs" style="padding-right: 0px;">
                    <button id="menu-toggle">
                        <i class="glyphicon glyphicon-menu-hamburger"></i>
                    </button>
<!--
<content class="mob-view"> 
  <input id="hamburger" class="hamburger" type="checkbox">
  <label class="hamburger" for="hamburger">
    <i></i>
    <text style="display:none;">
      <close>закрыть</close>
      <open>меню</open>
    </text>
  </label>
  <section class="drawer-list">
        <ul><li> 
		<a data-id="1" href="index.html">Главная</a></li><li> 
		<a data-id="2" href="about.html">О нас</a></li><li class="dropdown"><label for="dropdown"> 
		<a data-id="3">Наши услуги</a> 
		</label><input type="checkbox" id="dropdown">
		<ul>
		<li><a href="internetmagazin.html">Интернет магазин</a></li>
		<li><a href="landingpage.html">Лендинг пейдж</a></li>
        <li><a href="korporativniysite.html">Корпоративный сайт</a></li>
        <li><a href="razrabotkabrandbook.html">Фирменный стиль</a></li>
        <li><a href="videoinfografika.html">Видеоинфографика</a></li>
		</ul><div></div></li><li> 
		<a data-id="4" href="portfolio.html">Наши работы</a></li><li> 
		<a data-id="5" href="otzyvy.html">Отзывы</a></li><li> 
		<a data-id="6" href="contacts.html">Контакты</a></li>
		<li style="padding:20px;"><a style="font-size:18px;border-color:#fff;" class="btn-hollow order-btn" href="#">заказать услугу</a></li>	  
      </ul>
      </section>
</content>
-->
                </div>
				 
                <div class="col-sm-2 col-md-offset-0 col-md-2  col-xs-3 logo-holder" style="padding-left: 0px;">
                    <a href="/">
                        <img src="/images/logo-small.png" alt="" class="logo logo-nonfix img-responsive">
                        <img src="/images/logo-small.png" alt="" class="logo logo-fix img-responsive">
                    </a>
                </div>
                <div class="col-sm-8 col-md-8 col-xs-1">
				
                <!-- <div class="col-sm-12 col-md-12 col-xs-1">
                <div class="col-sm-8 col-md-8 col-xs-1 col-lg-offset-1 col-lg-7"> -->

                    <div class="row local-setting-links">


                        <div class="col-sm-12 hidden-xs hidden-lg search text-right inner-addon left-addon">
                            <div>
                                <i class="glyphicon glyphicon-search"></i>
                                <form action="/search" method="get" autocomplete="off"><input type="text" class="form-control" name="q" required autocomplete="off" />
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
                        <nav id="main-menu" class="list-inline hidden-xs" style="padding:0;">
					<?php /*
                        <nav id="main-menu" class="container list-inline hidden-xs" style="padding:0;">
					<a href="/" style="position:absolute;left:-150px;">
                        <img src="/images/logo-small.png" alt="" class="logo logo-nonfix img-responsive">
                        <img src="/images/logo-small.png" alt="" class="logo logo-fix img-responsive">
                    </a>*/ ?>
						
                                <li class="dropdown {{ strpos(\Request::path(), 'f/projects') != false ? 'active' : '' }}">
                                    <a class="dropdown2" href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{trans('frontend.common.projects') }}</a>
									
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 206px;"></div>
	
								<div class="menu-dropdown">
								 
                                   <div class="col-md-12">
                                   <div class="col-md-4">
								   <div id="thumb" style="background:url(https://roomlook.com/images/rooms/md/1536220673.jpg) center center no-repeat;width:100%;"> 
								   </div>
								   </div>
								   
                                <div class="col-md-4">
                                <h4 class="gray">Стили</h4>
                                <ul>
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1536220673.jpg" href="/ru/projects">Все проекты</a></li>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1536220673.jpg" href="/ru/projects?room_style_id=1">Классический</a></li>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1539675908.jpg" href="/ru/projects?room_style_id=2">Современный</a></li>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1536220673.jpg" href="/ru/projects?room_style_id=3">Фьюжн/Эклектика</a></li>
                                </ul>
                                <ul>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1528356680.jpg" href="/ru/projects?room_style_id=5">Лофт</a></li>
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1537856806.jpg" href="/ru/projects?room_style_id=8">Скандинавский</a></li>
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1537420141.jpg" href="/ru/projects?room_style_id=12">Минимализм</a></li> 
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1539675908.jpg" href="/ru/projects?room_style_id=15">Ар Деко</a></li> 
                                </div>
                                <div class="col-md-4">
                                <h4 class="gray">Поиск</h4>
								<form action="/search" method="get" autocomplete="off">
									<input style="width:70%;" type="search" name="q" autocomplete="off" />
									<input type="hidden" name="projects" value="true" />
									<p style="font-size:12px;margin-top:-15px;font-style:italic;">Название проекта, дизайнер и т.д.<p>
								</form>
								</div>
								
								</div> 
								</div>
								</li>
                                <li class="dropdown {{ strpos(\Request::path(), 'f/room') != false ? 'active' : '' }}">
                                    <a class="dropdown2" href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>
								
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 167px;"></div>
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 412px;"></div>
								
								<div class="menu-dropdown menu-rooms">
                                <div class="col-md-12" style="display:flex;">  
								<ul style="width:calc(100% + 10px);margin:0 -5px;">
                                @foreach(App\Models\RoomType::all() as $roomType)
                                    <li class="col-md-20" style="float:left;padding:5px 5px 0;">
										<div style="height:100px;background-image: url(/{{ $roomType->imagePath() }});background-size:cover;">
										<a 
										style="
										width: 100%;
										display: block;
										height: 100px;
										text-align: center;
										color: #fff;
										line-height: 100px;
										font-weight: 400;
										position: relative;
										z-index: 1;
										font-size: 18px;"
										href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}">{{ $roomType->name }}</a> 
										</div>
									</li>
								@endforeach  
                                </ul>   
								</div> 
								</div>
								
								</li>
                                <li class=" {{ strpos(\Request::path(), 'f/ideas') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles">{{trans('frontend.common.posts') }}</a>
                                </li>
                                <li class="dropdown {{ strpos(\Request::path(), 'f/catalog') != false ? 'active' : '' }}">
                                    <a class="dropdown2" href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>
                        		
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 206px;"></div>
								 
								<div class="menu-dropdown">
                                <div class="col-md-12" style="display:flex;"> 
								<ul style="width:25%;"></ul>
								<ul style="width:25%;"></ul>
                                @foreach(App\Models\Pcategory::parents() as $pcategory)
								<ul style="width:25%;    
	background: url(http://roomlook/images/pcategories/{{ $pcategory->image }}) top left no-repeat;
	background: url(http://roomlook/images/pcategories/20aaed852c37d9411e67232fc288139fba4d5774.png) -30px 0px no-repeat;
    background-size: 100%;
    padding-top: 70px;">
                                <li><a href="{{route('frontend.catalog.index',['category_id'=>$pcategory->id])}}">{{ $pcategory->name }}</a>
									<ul>
									@foreach(App\Models\Pcategory::where('parent_id', $pcategory->id)->get() as $pcategory2) 
										<li><a>{{ $pcategory2->name }}</a></li>
									@endforeach
									</ul>
								</li>
								</ul> 
								@endforeach
								</div> 
								</div>
								
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
				 
                <div class="col-sm-2 text-center col-md-2  header-btns col-xs-6">
                    <div class="headerTopContainer">
                        <div style="display:none;" class="col-md-3 col-xs-4 hidden-xs hidden-md hidden-sm xs-nopadding" style="position: relative;">
                           
						   <!--
						   <a id="search-btns" href="#">
                                <img src="{{ asset('/search.png') }}" alt="">
                            </a>
							--> 
						   
<form action="/search" method="get" class="search_conteiner" autocomplete="off">
  <input type="text" name="q" placeholder="Search..." autocomplete="off" />
  <div class="search"></div>
</form> 


<!--
                            <div class="search-form">
                                <form action="/search" method="get">
                                    <input type="text" class="form-control" name="q" required placeholder="{{ trans('frontend.common.search') }}" />
                                </form>
                            </div>
-->
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
						<!--
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
						-->
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
                            <div class="dropdown location-dropdown" style="position:relative;">
							
                            <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <div class="dv-location">
                                        <img src="{{ asset('/images/placeholder.svg') }}" alt="" style="width: 20px;">
                                    </div>
                                </button>
								
                                <ul class="dropdown-menu" style="left:50%;margin-left:-50px;" aria-labelledby="dropdownMenu1">
                                     
                                    <?php $i = 0;
                                    $n =  App\Models\Country::all()->count() - 1;?>
                                    @foreach(App\Models\Country::all() as $country)
                                    <li class="dropdown-header">
                                        <a href="#" tabIndex="-1" data-country-id="{{ $country->id }}">{{ $country->name }}</a>
                                    </li>
                                        @if ($country->cities)
                                        @foreach($country->cities as $city)
                                        <li>
                                            <a href="/changecity/{{ $city->id }}" class="custom-ajax-button" style="{{ ( null != session('city_id') && session('city_id') == $city->id) ? 'color:#8404dd;font-weight:bold' : '' }}"  data-city-id="{{ $city->id }}">{{ $city->name }}</a>
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
						
                        <div class="col-md-3 col-xs-4 xs-nopadding city">
							<span style="text-decoration:underline;
    position: absolute;
    left: -10px;
    top: 0;
    line-height: 28px;
">
@foreach(App\Models\Country::all() as $country)
	@if ($country->cities)
    @foreach($country->cities as $city)
    
	{{ ( null != session('city_id') && session('city_id') == $city->id) ? $city->name : '' }}
	
	@endforeach
    @endif
@endforeach
</span>
                        </div> 
						
                    </div>
                </div>
				
				<style>
				.city span {position:relative}
				.city span:after {
    font: normal normal normal 14px/1 FontAwesome;
    position: absolute;
    right: -12px;
    top: 50%;
	margin-top: -7px;
    content: "\f107";}
				</style>
				
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
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles">{{trans('frontend.common.posts') }}</a>
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
		
		

                <!-- FOOTER -->  
                <div class="footer-wrap">
                    <div class="container">
                        <div class="row">

                            <div class="footer clearfix">

                                <div class="span3 col-md-3">
                                    <div class="widget">
                                        <h3>О нас</h3>
                                        <ul> 
										<!--
                                            <li><a href="/p/o-proekte">{{ trans('frontend.common.about') }}</a></li>
                                            <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a></li> 
                                            <li><a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a></li> 
                                            <li><a href="/p/faq">FAQ</a></li> 
                                            <li><a href="/p/pravila-bezopasnosti">{{ trans('frontend.common.rules') }}</a></li> 
                                            <li><a href="/p/kontakty">{{ trans('frontend.common.contact') }}</a></li> 
                                        -->
                                            <li><a href="#">Что такое RoomLook?</a></li>
                                            <li><a href="#">Как разместить проект на сайте</a></li>
                                            <li><a href="#">Вопросы ответы</a></li>
                                            <li><a href="#">Правила безопасности</a></li> 
										</ul>
                                    </div>
                                </div>

                                <div class="span3 col-md-3">
                                    <div class="widget">
                                        <h3>Карта сайта</h3>
                                        <ul> 
                                            <li><a href="#">Проекты</a></li>
                                            <li><a href="#">Комнаты</a></li>
                                            <li><a href="#">Каталог</a></li>
                                            <li><a href="#">Дизайнеры</a></li>
                                            <li><a href="#">Магазины</a></li>
                                            <li><a href="#">Статьи</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="span3 col-md-3">
                                    <div class="widget">
                                        <h3>Мой RoomLook</h3>
                                        <ul>
                                            <li><a href="#">Мой аккаунт</a></li>
                                            <li><a href="#">Как зарегистрироваться?</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="span3 col-md-3">
                                    <div class="widget">
                                        <h3>Контакты</h3>
                                        <ul>
                                            <li>info@roomlook.com</li>
                                            <li>Казахстан, г.Алматы,</li>
                                            <li>ул.Курмангазы, 145, офис 129</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <footer class="clearfix">
                                <div class="span5 col-md-5">
                                    <p style="line-height:14px;"><br />© 2018 Roomlook.com - идеи дизайна мебели для стильного интерьера.<br /> Копирование материалов сайта без разрешения редакции запрещено.</p>
                                </div>
                                <div class="span2 col-md-2 back-top">
                                    <a href="#top"> <img src="/images/back.png" alt=""></a>
                                </div>
                                <div class="span5 col-md-5">
                                    <div class="social-icon">
									<!--
                                        <a class="rss" href=""><img src="/images/pinterest.png"></a>
                                        <a class="twet" href=""><img src="/images/telegram.png"></a>
                                        <a class="fb" href=""><img src="/images/vk.png"></a>
                                        <a class="pin" href=""><img src="/images/fb.png"></a>
									-->	
                                        <a class="google" href=""><img src="/images/insta.png"></a>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
                <!-- FOOTER -->		
		 
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
	

    <link href="/css/rotator.css" rel="stylesheet">
	<script src="/js/rotator.js"></script>
	

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



	    showPage = function(i){  
                $('.mb-tabs').hide();
                $('.mb-tabs').eq(i).show();  
                $('.tab').removeClass("active");
                $('.tab').eq(i).addClass("active");
				
        }
 
        showPage(0);     
 
		$(document).on('click', '.mb-tab', function(e) {   
			e.preventDefault();  
            showPage(parseInt($(this).attr("data-page")));  
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

<script>
$('.location-dropdown, .city').hover(function() { $('.location-dropdown').addClass('open'); }, function() { $('.location-dropdown').removeClass('open'); });
</script>
 
</body>
</html>
