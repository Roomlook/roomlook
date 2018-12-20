@extends('layouts.master10')  
@section('content')

<style>
.mb-effect-category {background-color:#fff;position:relative;z-index:1;opacity:0;pointer-events:none;transition:.3s;}
label.mb-tags,
label.mb-categories {display:block;cursor:pointer;}
label.mb-tags a,
label.mb-categories a {display:block;}
input.mb-tags,
input.mb-categories {display:none;}
input.mb-tags:checked ~ .mb-effect-category,
input.mb-categories:checked ~ .mb-effect-category {opacity:1;pointer-events:auto;transition:.3s;}
.anons p {
    font-size: 16px;
    line-height: 20px;
    padding-top: 5px;
}
.hover {cursor:pointer;}
.hover a {color:#fff;}
</style>   
 
<section class="container mobile"> 
<div class="row">
	<div class="breadcumbs" style="display:block;margin:15px 0;"> 
		<a href="/">Главная</a> > 
		<a href="/articles">Статьи</a> 
	</div> 
</div>		 
 
<div class=""> 
<div style="
    margin: 0 -10px;">
	<div class="col-xs-6" style="
    position: relative;
    padding: 10px;"><div style="
    background: #fff;
    box-shadow: 0px 0px 10px #ccc;
    height: 40px;
    line-height: 40px;
	text-align: center;">
	
  <input id="mb-categories" class="mb-categories" type="checkbox">
  <label class="mb-categories" for="mb-categories">
	Категории</label>
	
	@foreach($categories as $key => $c)
	<div class="mb-effect-category" style="transition:.{{ $key }}s;">
	<a href="/articles/{{ $c-> slug }}">{{ $c-> name }}</a>
	</div>
	@endforeach
	</div></div>
	<div class="col-xs-6" style="
    position: relative; 
    padding: 10px;"><div style="
    background: #fff;
    box-shadow: 0px 0px 10px #ccc;
    height: 40px;
    line-height: 40px;
	text-align: center;">
  <input id="mb-tags" class="mb-tags" type="checkbox">
  <label class="mb-tags" for="mb-tags">
	Популярные теги</label>
	
	@foreach($tags as $key => $c)
	@if($key < 9)<div class="mb-effect-category" style="transition:.{{ $key }}s;">
	<a href="/articles/tags/{{ $c-> slug }}">{{ $c-> title }}</a>
	</div>
	@endif
	@endforeach
	</div></div>
</div>		
</div>
</section>	

	<section class="mobile" style="margin-top:0;"> 
 
    <div class="container-fluid">
        <div class="row"> 
		<h1 style="margin-bottom:5px;" class="mb-title">Самое читаемое</h1>
		<div class="project-wrapper">
            <div class="project-content"> 
		@foreach($articles as $a => $k)
			<div style="position:relative;margin-bottom:13px;">
			<a href="/{{ LaravelLocalization::getCurrentLocale() }}/papers/s/{{ $k-> id }}">
            <img src="/images/papers/{{ $k->images }}" class="img-responsive">
			</a>
                                <div class="project-name">								
											<small style="
    font-size: 14px;
    letter-spacing: 2px;
    text-transform: uppercase;">Интерьер</small> 
								
                                    <h1 class="project-title" style="width:99%;padding:0;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/papers/s/{{ $k-> id }}" style="
    color: #000;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 500;
    line-height: 26px;
    font-size: 26px;
    margin: 10px 0;
    display: block;">{{ $k-> name }}</a> 
                                    </h1>
                               
				<div class="mb-anons" style="">
{!! $k-> anons !!}
					</div>											   
                </div>  								
			</div>
		@endforeach	  
		</div>
		</div>
		</div>
	</div>
	</section>
	
<div class="container desktop"> 
<div class="row">
	<div class="breadcumbs" style="display:block;margin:15px;"> 
		<a href="/">Главная</a> > 
		<a href="/articles">Статьи</a>
	</div> 
</div>		
</div>		
	
<main role="main" class="desktop container">
 
	<div class=""> 
		
	
	<h1 class="project-title" style="padding-top: 0px; padding-bottom: 15px;">
        <a href="/ru/articles">Самое читаемое</a>
    </h1>
	
	<div style="height:630px;display:flex; position:relative;margin-bottom:30px;">
	@include('parts.articles.sidebar', ['categories' => $categories]) 
	
	
	
	<div class="" style="width:100%;">
	<div class="" style="margin:0 -15px;display:flex;min-height:450px;">
	@foreach($articles as $a => $k)
	@if ( $a == 0 )
		<div class="col-md-6" >
		<div class="hover" style="height: 100%;
		margin-right: -10px;
		position: relative;
		background:url(/images/papers/{{ $k->images }}) center center no-repeat;
		background-size: auto 100%;
		">
		
			<h1 style="line-height:590px;text-align:center;color:#fff;font-size:0px;">
			<a style="height:100%;display:block;position:relative;" href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/podborka/pokachaemsya">
			<small style="position:absolute;top:-50px;color:#fff;letter-spacing:2px;">Интерьер</small> 
			{{ $k-> name }}</a></h1>			
		
			<div style="
    position: absolute;
    bottom: 0;
    padding: 20px;
    color: #fff;
    width: 100%;
    background: rgba(0, 0, 0, 0.4);">
				<p style="
    font-size: 16px;
    text-transform: uppercase;">Интерьер</p>
				<p><a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/podborka/pokachaemsya">{{ $k-> name }}</a></p>
			</div>
			
		</div>
		</div>
	@else
	@if ( $a == 1 )
	<div class="col-md-6">
	
			<div class="hover" style="
		height:310px;
		position: relative;
		margin-left: -10px;
		background:url(https://roomlook.com/images/papers/{{ $k-> images }}) center center no-repeat;
	
	">
	
			<h1 style="line-height:310px;text-align:center;color:#fff;font-size:0px;">
			<a style="height:100%;display:block;position:relative;" href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/podborka/priyatnye_melochi">
			<small style="position:absolute;top:-20px;color:#fff;width:100%;letter-spacing:2px;">Советы дня</small> 
			{{ $k-> name }}</a></h1>
			
			<div style="
    position: absolute;
    bottom: 0;
    padding: 20px;
    color: #fff;
    width: 100%;
    background: rgba(0, 0, 0, 0.4);">
				<p style="
    font-size: 16px;
    text-transform: uppercase;">Интерьер</p>
				<p><a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/podborka/priyatnye_melochi">{{ $k-> name }}</a></p>
				<div class="anons">{!! $k-> anons !!}</div>
			</div>
	  
	</div>
	@endif
	@if ( $a == 2 )
			<div class="hover" style="
		background:url(https://roomlook.com/images/papers/{{ $k-> images }}) center center no-repeat;
		margin-top: 10px;
		margin-left: -10px;
		position: relative;
		height:310px;
	">
	
			<h1 style="line-height:310px;text-align:center;color:#fff;font-size:0px;">
			<a style="height:100%;display:block;position:relative;" href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/interier/{{ $k->slug }}">
			<small style="position:absolute;top:-20px;color:#fff;width:100%;letter-spacing:2px;">Советы дня</small> 
			{{ $k-> name }}</a></h1>
			
			<div style="
    position: absolute;
    bottom: 0;
    padding: 20px;
    color: #fff;
    width: 100%;
    background: rgba(0, 0, 0, 0.4);">
				<p style="
    font-size: 16px;
    text-transform: uppercase;">Интерьер</p>
				<p><a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/interier/{{ $k->slug }}">{{ $k-> name }}</a></p>
				<div class="anons">{!! $k-> anons !!}</div>
			</div>
			
	</div>
		</div>	
	@endif
	@endif
	@endforeach	  
	</div>
	</div>
	</div>
	
	
	@foreach($articles_all as $a)
	<?php $i = 0; $count = count($a); ?>
	@foreach($a as $aa)	
	
	<?php if($i == 3) { ?> 	
	</div> 
	</div>  
	<?php break; } ?>
	
	<?php if($i == 0 && $i % 3 == 0) { ?>
	<h1 class="project-title" style="padding-top: 0px; padding-bottom: 15px;">
        <a href="/ru/articles">
                   {{ $aa-> cname }}
                </a>
    </h1> 
	<div class="second-articles"><div>
	<?php }elseif($i % 3 == 0) { ?>
	</div></div>
	<h1 class="project-title none<?php echo $i; ?>" style="padding-top: 0px; padding-bottom: 15px;">
        <a href="/ru/articles">
                   {{ $aa-> cname }}
                </a>
    </h1> 
	<div class="second-articles"><div>
	<?php } ?>
	
		<div class="col-md-4">
			<div class="hover articles-s-img" onclick="javascript:location.href='/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $aa-> cslug }}/'" style="
		margin-right: -10px; background:url(/images/papers/{{ $aa->images }}) center top no-repeat;">
		
			<h1 style="padding-top:200px;text-align:left;color: #000;">
			<div style="color:#000;font-weight:500;position:relative;">
			<small><a style="color:#000;
    font-size: 16px;
    text-transform: uppercase;
    clear: both;
    display: block;
    padding: 10px 0;" href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $aa-> cslug }}/">{{ $aa-> cname }}</a></small> 
			
			<h2>
			<a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $aa-> cslug }}/{{ $aa->slug }}">
			{{ $aa-> name }}
			</a>
			</h2>
	
			<div class="anons">{!! $aa-> anons !!}</div>
			</div>
			</h1>
		
		</div>
		</div>
		
	<?php if(($count - 1) == $i) { ?>
	</div> 
	</div>  
	<?php } ?>
	<?php $i++; ?>
	@endforeach	  
	@endforeach	  
	 
	 
    </div> 
</main>
<style>
main {margin-top:25px;position:relative;padding:0!important;}
h1 {margin-bottom:20px;}
.margin-y-50 {margin-bottom:0!important;height:auto!important;margin-bottom:25px!important;}
.margin-y-50 h3 {font-size:32px;font-weight:100;text-decoration:none;margin:10px 0;}
.margin-y-50 h5 {text-decoration:underline;}
.margin-y-50 p {margin:0!important;}
.article {background:#fff;margin-bottom:25px;padding:25px;transition:.2s;}
.article p {margin-top:25px;}
.article:hover {
    box-shadow: 0px 0px 10px #ccc;
	transition: .2s;
    -webkit-transform: scale(1.02);
    -ms-transform: scale(1.02);
    transform: scale(1.02);
}
.btn-primary {
    border: 1px solid #000;
    border-radius: 0;
    background: white;
    color: #000;
    margin: 25px 0 25px;
	transition: .5s;
    padding-top: 2px;
    padding-bottom: 2px;
}
.btn-primary:hover {
    border-color: #9f48da !important;
    background: #9f48da;
    color: white;
	transition: .5s;
} 
aside.sidebar-left,
.sidebar-left {transform: translate(0, 0);}
aside.sidebar-left {left:-200px;}
@media (min-width: 1460px) { 
	.sidebar-left.fixed {position:fixed;left:50%;top:0;margin-left:-625px;}
}
@media screen and (max-width: 1460px) {  
	.sidebar-left.fixed {position:fixed;left:50%;top:0;margin-left:-570px;}
}
</style>
<script>
// Определяем мобильный браузер
function MobileDetect() {
  var UA = navigator.userAgent.toLowerCase();
  return (/android|webos|iris|bolt|mobile|iphone|ipad|ipod|iemobile|blackberry|windows phone|opera mobi|opera mini/i.test(UA)) ? true : false;
}
jQuery(document).ready(function($) {
  // Если браузер не мобильный, работаем
  if (!MobileDetect()) {
    var
 
      $window = $(window), // Основное окно
 
      $target = $(".sidebar-left"), // Блок, который нужно фиксировать при прокрутке
 
      $h2 = $target.offset().top; // Определяем координаты верха нужного блока (например, с навигацией или виджетом, который надо фиксировать)
 
	  $h = 120;
 
    $window.on('scroll', function() {
 
      // Как далеко вниз прокрутили страницу
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
 
      // Если прокрутили скролл ниже макушки нужного блока, включаем ему фиксацию
      if (scrollTop > $h) {
 
        $target.addClass("fixed");
 
        // Иначе возвращаем всё назад
      } else {
 
        $target.removeClass("fixed");
      }
    });
  }
});
</script>
@endsection  
@section('css')      
<link rel="stylesheet" href="/css/new/articles.css">
@stop 