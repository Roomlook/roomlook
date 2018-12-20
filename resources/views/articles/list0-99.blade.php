@extends('layouts.master10')  
@section('content') 

<div class="container desktop"> 
<div class="row">
	<div class="breadcumbs" style="display:block;margin:15px;"> 
		<a href="/">Главная</a> > 
		<a href="/articles">Статьи</a> >
		<a href="/articles/{{ $category2->slug }}">{{ $category2->name }}</a>
	</div> 
</div>		
</div>		

<main role="main" class="container"> 
	<div class=""> 
	
	<h1 class="project-title" style="
    padding-top: 0px;
    padding-bottom: 15px;">
        <a href="/ru/articles"> 
		{{ $category2->name }}
                </a>
    </h1>
	 
	<div style="position:relative;">   
	@include('parts.articles.sidebar', ['categories' => $categories]) 
	
	<?php $i = 0; ?>
	@foreach($articles as $a)
	 
	<?php if($i % 3) { echo '<div class="col-md-6">'; }else{ echo '<div class="col-md-12">'; } ?>
	 
		<div class="article">
		<?php if($i % 3) { ?>
			<div class="text-center mb-12" style="max-height:260px;overflow:hidden;">
			<a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $category2->slug }}/{{ $a->slug }}">
                <img style="width:100%;" src="/images/papers/{{ $a->images }}" alt="" class="img-responsive">  		
			</a>
			</div>
		<?php }else{ ?>
			<div class="text-center mb-12" style="">
			<a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $category2->slug }}/{{ $a->slug }}">
                <img style="width:100%;" src="/images/papers/{{ $a->images }}" alt="" class="img-responsive">  	
			</a>	
			</div>
		<?php } ?>
			
				<div>
                    <h5 style="
    text-transform: uppercase;
    margin: 15px 0 5px;
    font-family: 'Source Sans Pro', sans-serif;
    font-size: 16px;">{{ $category2->name }}</h5>
                    <h1 style="
    font-family: 'Source Sans Pro', sans-serif;
    font-size: 30px;
    padding: 0;
    font-weight: 400;
    margin: 5px 0;">
					<a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $category2->slug }}/{{ $a->slug }}" style="margin-bottom: 0px;color: #000;">{{ $a->name }}</a>
                    </h1>
                    <div class="anons">{!! htmlspecialchars_decode(substr($a->content, 0, 200)) !!}</div>
                </div> 	
			<!--
			<div class="text-center"> 
			<a class="btn btn-lg btn-primary" href="/{{ LaravelLocalization::getCurrentLocale() }}/articles/{{ $category2->slug }}/{{ $a->slug }}" role="button">далее</a>
			</div>
			-->
		</div>
	</div>
	<?php $i++; ?>
	@endforeach	  
    </div> 
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
.article p {margin-top:25px;
    line-height: 22px;
    padding-top: 5px;
    font-size: 18px;}
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

.anons p {line-height:22px;padding-top:5px;font-size:18px;}

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