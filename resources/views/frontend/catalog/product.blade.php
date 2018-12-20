@extends('layouts.master-product')
@section('title','RoomLook')
@section('content')
<section id="main" class="product-single">
    <div id="content" style="padding-bottom: 0px;">

        <div class="container-fluid">
            <div class="container">
                <br>
                <div class="breadcumbs">
                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a> >
                    <a href="#">{{ $product->name }}</a>
                </div>
            </div>
            <div class="container product" style="
	background: #fff;
    padding-top: 40px;
    padding-bottom: 40px;
    margin-top: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px #ccc;">
                <div class="col-md-6 col-xs-6">
					<?php /*
                    <a  href="#" tabIndex="-1" class="green-link save-btn @if($product->isSaved()) saved @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<span>{{ trans('frontend.common.save') }} </span><img src='/images/download-arrow.png' />" data-model-id="{{ $product->id }}" data-model-name="Product">@if($product->isSaved())
                         <i class="glyphicon glyphicon-ok"></i>
                        @else
                          <span>{{ trans('frontend.common.save') }} </span><img src='/images/download-arrow.png' class="save-image" />
                        @endif</a>
					*/ ?>
                    <a href="/images/products/{{ $product->image }}" data-lightbox="product-lightbox" data-title="{{ $product->name }}"><img src="/images/products/{{ $product->image }}" class="img-responsive" alt="{{ $product->name }}"/></a>
                </div>
                <div class="col-md-6 col-xs-6">
                    <h3 data-id="{{ $product->id }}">{{ $product->name }}</h3>
                    <p class="mag">
                        <?php /* $i = 1; ?>
                        @foreach($product->stores as $store)
                        @foreach ($store->cities as $scity)
                            @if ($scity->pivot->city_id == session('city_id')) 
                                <a href="{{ $store->url }}" target="_blank">{{ $store->name }}</a>@if($i++ != $product->stores->count()),@endif
                                <?php break; ?>
                            @endif
                        @endforeach
                        @endforeach
						*/ ?>
                    </p>
                    <p class="description hidden-xs">
                        {!! $product->short_body !!}
                    </p>
					@if($product->manufacturer)
                    <div class="description hidden-xs">
						<h3 class="mtitle">Производитель</h3>  
                        <p><img title="{{ $product->manufacturer ? $product->manufacturer->name : '' }}" alt="{{ $product->manufacturer ? $product->manufacturer->name : '' }}" style="max-width:100px;" src="/images/manufacturers/{{ $product->manufacturer->logo }}" /></p>
                          
                    </div>
					@endif
					<div class="toggle-click">
					<label>Полное описание</label>
					<div style="padding-top:10px;">
						<p class="description">
                        {!! $product->short_body !!}
						</p>
					</div>
					</div>
					<div class="toggle-click">
					<label>Характеристики</label> 
						{!! $html !!} 
					</div>
					<div class="toggle-click">
					<label>Товар в интерьере</label>
					<div> 
                        {!! $product->short_body !!} 
					</div>
					</div>
					
					<div style="display:none">
					<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,pinterest"  
	data-lang="ru" 
	data-title="{{ $product->name }}"
	data-image="https://roomlook.com/images/products/{{ $product->image }}"
	data-description="{!! $product->short_body !!}"
	>

</div>
					</div>
					<div class="soc-seti">
						<div class="ssfb" onclick="socclick('Facebook')"></div>
						<div class="ssvk" onclick="socclick('ВКонтакте')"></div>
						<div class="ssin" onclick="socclick()"></div>
						<div class="sspi" onclick="socclick('Pinterest')"></div>
					</div>
					
					
                    <div class="manufacturer-product col-md-12 col-xs-12"> 
						<h3 class="mtitle">Магазин</h3>
                        <p><img title="{{ $store ? $store->name : '' }}" alt="{{ $store ? $store->name : '' }}" style="margin-bottom:25px;max-width:100px;" src="/images/stores/{{ $store->logo }}" /></p>
                        <a style="
    border: 1px solid #ccc;
    padding: 10px 30px;
    border-radius: 5px; 
    font-size: 16px;
    text-transform: uppercase;" href="/store/{{ $store->slug }}" target="_blank">Перейти в магазин</a>
                    
					</div> 
                    <div class="manufacturer-product col-md-4 col-xs-4"> 
					{!! $store->body !!}
					</div> 
					
                    <h2 class="price visible-xs text-right">
                        {{ $product->price }} тг.
                    </h2>
                </div>
                <div class="clear"></div>
                    <p class="description visible-xs">
                        {!! $product->short_body !!}
                    </p>
                    <h2 class="product-price hidden-xs text-right">
                        {{ $product->price }} тг.
                    </h2>
                
            </div>
        </div>
        
        <div id="catalog" class="padding-top-40 padding-bottom-40 manufacturer-products">
@if(isset($product_relative))
            <div class="container slider-comment-wrapper">
                <div class="catalog-body list-group  products " data-count-item="4" >
                        <h4 class="text-uppercase">{{ trans('frontend.common.similar-products') }}</h4>
                        @if(isset($product_relative))
                        <div class="owl-carousel aproducts" style="background:none;">
							 @foreach($product_relative as $similarProduct) 
								@if (isset($similarProduct->id))
                                @if ($product->id != $similarProduct->id)
									
    <div class="item">
		<div style="background:url('/{{ $similarProduct->imagePath() }}') center center no-repeat;
    width: 100%;
    height: 100px;
    background-size: 100px;">
	
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $similarProduct->id }}" tabIndex="-1" data-product-id="{{ $similarProduct->id }}" class="popup-product-open green-link2"></a>
									
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
                                @endif 
                            @endforeach  
                        </div>
						@endif
                </div>
            
            </div>
@endif
			 
@if(!empty($product->tags)) 
<div class="container slider-comment-wrapper">
<div class="catalog-body list-group  products"> 
<h4 class="text-uppercase">Товары в проекте</h4>
<div class="owl-carousel aprojects owl-theme">  
    @foreach($product->tags as $tag)
    <div class="item" style="padding:0;">
		<a href="/product/{{ $tag->id }}">
		<div style="background:url('/{{ $tag->picture ? $tag->picture->imagePath() : '' }}') center center no-repeat;
    width: 100%;
    height: 200px;
    background-size: 100%;">
		</div>
		</a>
		<div style="padding:20px;"> 
			<h3 style="font-size:20px;"><a href="#">{{ $tag->picture->name }}</a></h3>
			<div style="font-size:12px;"></div>
		</div>
	</div> 
    @endforeach
</div> 
            </div>
            </div>
@endif
            <div class="clear"></div>
        </div>
		  
        @if ($product->tags->count() > 0)
        <div style="display:none;" id="catalog" class="padding-top-40 padding-bottom-40 manufacturer-products">
            <div class="container slider-comment-wrapper">
                <div class="catalog-body list-group" data-count-item="4" >
                        <h4 class="text-uppercase">{{ trans('frontend.common.projects') }}</h4>
                        <div class="project-product-slider" >
                             @foreach($product->tags as $tag)
							 
    <div class="item">
		<div style="background:url('/images/products/045430-Foscarini-Caboche-Suspension-Light-Transparent.jpg') center center no-repeat;
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
	
                                <div class="item">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $tag->picture ? $tag->picture->room->project->id : ''}}?picture_id={{ $tag->picture ? $tag->picture->id : '' }}" tabIndex="-1" data-project-id="{{ $tag->picture ? $tag->picture->room->project->id : ''}}" class="popup-product-open green-link2">
                                        <img src="/{{ $tag->picture ? $tag->picture->imagePath() : '' }}" class="img-responsive" alt=""/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                </div>
            
            </div>
            <div class="clear"></div>
        </div>
        @endif
		  
		<div class="clear"></div>
    </div>
</section>

<style>
.aprojects,
.aarticles,
.aproducts {margin:0;}
.aprojects .owl-item,
.aarticles .owl-item,
.aproducts .owl-item {padding:5px;} 
.aarticles .item,
.aproducts .item {background-color:#fff;box-shadow:0 0 15px #ccc;padding:5px 10px 15px;}
.aproducts .owl-stage-outer {position:relative;z-index:1;}
.aproducts .item a {display:block;height:100%;width:100%;}

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
$(".project-product-slider").owlCarousel({
    navigation: !0,
    loop:true,
    addClassActive: !0,
    slideSpeed: 300,
    paginationSpeed: 400,
    pagination: !1
})

$('.owl-carousel.aproducts').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
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
        600:{
            items:1
        },
        1000:{
            items:3
        }
    }
});
});
</script> 
@stop 