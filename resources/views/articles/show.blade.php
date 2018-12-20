@extends('layouts.master10') 
@section('content')
<style>
.mb-effect-category {background-color:#fff;position:relative;z-index:1;opacity:0;pointer-events:none;transition:.3s;}
label.mb-tags,
label.mb-categories {display:block;cursor:pointer;}
label.mb-tags a,
label.mb-categories a {display:block;}
.owl-prev,
.owl-next,
.owl-theme .owl-nav [class*=owl-] {display:none!important;}
input.mb-tags,
input.mb-categories {display:none;}
input.mb-tags:checked ~ .mb-effect-category,
input.mb-categories:checked ~ .mb-effect-category {opacity:1;pointer-events:auto;transition:.3s;}
img {height:auto!important;}
.owl-dot {width:10px;height:10px;background:#ccc!important;margin:10px;}
</style>

<section class="container mobile"> 
<div class="row">
	<div class="breadcumbs" style="display:block;margin:15px 0;"> 
		<a href="/">Главная</a> > 
		<a href="/articles">Статьи</a> >
		<a href="/articles/{{ $category2->slug }}">{{ $category2->name }}</a> >
		<a href="/articles/{{ $category2->slug }}/{{ $article->slug }}">{{ $article->name }}</a>
	</div> 
</div>		 
 
<div class=""> 
<div style="
    margin: 0 -10px;">
	<div class="col-xs-6" style="
    position: relative;
    padding: 10px 10px 0;"><div style="
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
    padding: 10px 10px 0;"><div style="
    background: #fff;
    box-shadow: 0px 0px 10px #ccc;
    height: 40px;
    line-height: 40px;
	text-align: center;">
  <input id="mb-tags" class="mb-tags" type="checkbox">
  <label class="mb-tags" for="mb-tags">
	Популярные теги</label>
	
	@foreach($tags as $key => $c)
	@if($key < 9)
	<div class="mb-effect-category" style="transition:.{{ $key }}s;">
	<a href="/articles/tags/{{ $c-> slug }}">{{ $c-> title }}</a>
	</div>
	@endif
	@endforeach
	</div></div>
</div>		
</div>
</section>		 

<section class="container desktop"> 
<div class="row">
	<div class="breadcumbs" style="display:block;margin:15px;"> 
		<a href="/">Главная</a> > 
		<a href="/articles">Статьи</a> >
		<a href="/articles/{{ $category2->slug }}">{{ $category2->name }}</a> >
		<a href="/articles/{{ $category2->slug }}/{{ $article->slug }}">{{ $article->name }}</a>
	</div> 
</div>		
</section>	

<main role="main" class="container">
	<div class="row" style="position:relative;"> 
	@include('parts.articles.sidebar2', ['categories' => $categories]) 
	<div class="article"> 
		<div class="text-center mb-12">
			<p style="text-align:center;">{{ $category2->name }}</p>
			<h1>{{ $article->name }}</h1>
            <img style="width:100%;" src="/images/papers/{{ $article->images }}" alt="" class="img-responsive">
			<p class="lead">{!! $article->content !!}</p>
		</div> 
	</div> 
    </div> 
	
@if (isset($product_relative))
<div style="margin:15px -15px;">
<h4 class="text-uppercase">Товары в тему:</h4>
<div class="owl-carousel aproducts owl-theme">
    @foreach($product_relative as $similarProduct) 
	@if (isset($similarProduct->id)) 
    <div class="item">
		<div style="background:url('/{{ $similarProduct->imagePath() }}') center center no-repeat;
    width: 100%;
    height: 100px;
    background-size: 100px;">
		</div>
		<div class="col-md-6 col-xs-6"><a class="pricetag btn">Уточняйте цену</a></div>
		<div class="col-md-6 col-xs-6">
			<div style="
				background: url(/images/stores/ebe6f071b1c8dd6b18bd2dfeec92e8a329c71825.png) center center no-repeat;
				width: 100%;
				height: 45px;
				background-size: auto 100%;">
			</div>
		</div>
		<div class="clear"></div>
	</div>   
	@endif
	@endforeach
</div>
</div>
@endif

<div style="margin:15px -15px;display:none;">
<h4 class="text-uppercase">Проекты в тему:</h4>
<div class="owl-carousel aprojects owl-theme">
    <div class="item" style="padding:0;">
		<div style="background:url('/images/rooms/md/1530009855.jpg') center center no-repeat;
    width: 100%;
    height: 200px;
    background-size: 100%;">
		</div>
		<div style="padding:20px;"> 
			<h3 style="font-size:20px;"><a href="#">Приятные мелочи</a></h3>
			<div style="font-size:12px;"></div>
		</div>
	</div>
    <div class="item" style="padding:0;">
		<div style="background:url('/images/rooms/md/1530009855.jpg') center center no-repeat;
    width: 100%;
    height: 200px;
    background-size: 100%;">
		</div>
		<div style="padding:20px;"> 
			<h3 style="font-size:20px;"><a href="#">Приятные мелочи</a></h3>
			<div style="font-size:12px;"></div>
		</div>
	</div>
    <div class="item" style="padding:0;">
		<div style="background:url('/images/rooms/md/1530009855.jpg') center center no-repeat;
    width: 100%;
    height: 200px;
    background-size: 100%;">
		</div>
		<div style="padding:20px;"> 
			<h3 style="font-size:20px;"><a href="#">Приятные мелочи</a></h3>
			<div style="font-size:12px;"></div>
		</div>
	</div>
    <div class="item" style="padding:0;">
		<div style="background:url('/images/rooms/md/1530009855.jpg') center center no-repeat;
    width: 100%;
    height: 200px;
    background-size: 100%;">
		</div>
		<div style="padding:20px;"> 
			<h3 style="font-size:20px;"><a href="#">Приятные мелочи</a></h3>
			<div style="font-size:12px;"></div>
		</div>
	</div>
</div>
</div>
 
<div style="margin:15px -15px;">
<h4 class="text-uppercase">Статьи в тему:</h4>
<div class="owl-carousel aprojects owl-theme">
    @foreach($result2 as $a) 
    <div class="item" style="padding:0;">
		<div style="background:url('/images/papers/{{ $a['images'] }}') center top no-repeat;
    width: 100%;
    height: 180px;
    background-size: 100%;">
		</div>
		<div style="padding:20px;">
			<p><a href="#">Интерьер</a></p>
			<h3 style="font-size:20px;"><a href="/articles/{{ $category2->slug }}/{{ $a['slug'] }}">{{ $a['name'] }}</a></h3>
			<div style="font-size:12px;">Как короля делает свита, так и настроение и атмосферу всему интерьеру задают, порой лишенные практического значения, но такие милые и дорогие сердцу аксессуары.</div>
		</div>
	</div>  
	@endforeach
</div>
</div>

</main>
<style>
main {margin:30px 0;}

b { font-weight: 600; }

img {max-width:100%;}

aside {
    width: 220px;
    display: inline-block;
    float: left;
    margin-right: 13px;
    min-height: 10px;
    position: absolute;
    left: -235px;
    top: 0px;
}
aside > div {
    background: #fff;
    padding: 20px;
    width: 100%;
    max-width: 220px;
    box-shadow: 0px 0px 10px #ccc;
}
aside > div h2 {
    font-size: 23px;
    line-height: 28px;
    margin-bottom: 10px;
}
aside > div ul li {
    padding: 2px 0;
    margin: 3px 0;
    font-size: 17px;
}
aside > div ul li:last-child {
	
} 

.article {background:#fff;padding:25px;}
.article p {margin-top:25px;}
.article p, p {
    margin-top: 0!important; 
    font-weight: 300;
    font-size: 18px;
    text-align: left;
    line-height: 20px;
}

.aprojects,
.aarticles,
.aproducts {margin:0;}
.aprojects .owl-item,
.aarticles .owl-item,
.aproducts .owl-item {padding:10px;}
.aprojects .item,
.aarticles .item,
.aproducts .item {background-color:#fff;box-shadow:0 0 15px #ccc;padding:5px 10px 15px;}

.owl-nav {position:absolute;top:50%;margin-top:-35px!important;width:calc(100% + 60px);left:-30px;}
.owl-nav .owl-prev span,
.owl-nav .owl-next span {display:none;}
.owl-nav .owl-prev {float:left;width:30px;height:60px;}
.owl-nav .owl-next {float:right;width:30px;height:60px;}
.owl-nav .owl-prev {background:url('/images/articles/articles/ico.png') left center no-repeat!important;background-size:70px!important;}
.owl-nav .owl-next {background:url('/images/articles/articles/ico.png') right center no-repeat!important;background-size:70px!important;}
</style>
 
    <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">
	
@endsection
@section('script')  
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script>
$(function() {
$('.owl-carousel.once').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
	dots: true,
    responsive:{
        0:{
            items:1
        },
        720:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
$('.owl-carousel.aproducts').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1
        },
        500:{
            items:2
        },
        1000:{
            items:4
        }
    }
});
$('.owl-carousel.aprojects, .owl-carousel.aarticles').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1
        },
        500:{
            items:2
        },
        1000:{
            items:3
        }
    }
});
});
</script> 
@stop 