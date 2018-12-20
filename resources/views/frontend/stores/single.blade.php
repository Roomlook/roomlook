@extends('layouts.master-stores')
@section('title','RoomLook')
@section('content')
<section id="main">
	<div id="content" style="padding-bottom: 0px;">

		<div class="container-fluid padding-bottom-10">
			<div class="container">
				<br>
		        <div class="breadcumbs">
		            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
		            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores">{{ trans('frontend.common.store') }}</a> >
		            <a href="#">{{ $store->name }}</a>
		        </div>
			</div>
			<div class="container about-author store-info">
				<div class="col-md-4 col-md-offset-4">
					<div class="row">
						<div class="col-md-3 col-xs-4">
							<img class="img-responsive" src="/{{ $store->imagePath() }}"/>
						</div>
						<div class="col-md-8 col-xs-8 col-md-offset-1 author-info">
							<h5 class="margin-top-0" style="color: #666;">{{ $store->name }}</h5>
							<p>
								
								@foreach($store->categories()->get() as $category)
								{{-- 
									{{ $category->name }} 
								--}}
							@endforeach<br/>
							@if ($store->phone_number != "") {{ $store->phone_number }}<br> @endif
								@if ($store->url != "") <a href="{{ $store->url }}" target="_blank">{{ $store->url }}</a><br>@endif
								@if ($store->email != "") {{ $store->email }} <br>@endif
								
							@if ($store->cities()->where('cities.id', session('city_id'))->get()->count() > 0)
							<br/><i class="glyphicon glyphicon-map-marker"></i> &nbsp;
							<?php $i = 0; ?>
	         					{{ $store->cities()->where('cities.id', session('city_id'))->get()->first()->pivot->address_ru  }}
							@endif
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<div class="row about-author-text" >
						<p class="text-center">
							{!! $store->body !!}
						</p>
					</div>
				</div>
			</div>
		</div>
		<div id="catalog" class="padding-top-10 padding-bottom-40 manufacturer-products">
			<div class="container slider-comment-wrapper">
				<div class="row">
					
			            <div class="visible-xs project-product-slide">
		                        <div style="width: {{ 265*$products->count() + 20  }}px">
		                        @foreach($products as $product)
		                        @include('partials.product-card')
		                        @endforeach
		                        </div>
		                    </div>
				<div class="catalog-body list-group  products hidden-xs" data-count-item="4" >
                    
                    	<div class="project-product-slider " >
			                 @foreach($products as $product)
			                    <div class="item">
			                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" tabIndex="-1" data-product-id="{{ $product->id }}" class="popup-product-open green-link2">
			                            <img src="/{{ $product->imagePath() }}" class="img-responsive" alt=""/>
			                        </a>
			                    </div>
			                @endforeach
			            </div>
                </div>
				</div>
            
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</section>
@endsection


