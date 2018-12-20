@extends('layouts.master')
@section('title','RoomLook')
@section('content')
<section id="main">
				<div id="content">
					<div class="container-fluid bg-gray padding-bottom-40">
						<div class="container about-author">
							<div class="col-md-4">
								<img class="img-responsive" src="/{{ $manufacturer->imagePath() }}"/>
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="author-name-and-social">
										<h2 class="margin-top-0">{{ $manufacturer->name }}</h2>
										<a href="http://facebook.com/" target="_blank"><i class="social_facebook_circle"></i></a>
										<a href="http://instagram.com/" target="_blank"><i class="social_instagram_circle"></i></a>
										<a href="http://twitter.com/" target="_blank"><i class="social_twitter_circle"></i></a>
									</div>
									<p>
									<p><i class="glyphicon glyphicon-map-marker"></i> &nbsp;{{ $manufacturer->address }}</p>
									</p>
								</div>
								<div class="row about-author-text" >
									<p>
										{!! $manufacturer->body !!}
									</p>
								</div>
								<div class="row author-contacts">
									<a href="#" class="col-xs-12"><i class="flaticon-circle"></i><span>{{ $manufacturer->phone }}</span></a>
									@if ($manufacturer->url != "") <a href="{{ $manufacturer->url }}" class="col-xs-12"><i class="glyphicon glyphicon-globe"></i><span>{{ $manufacturer->url }}</span></a>@endif
								</div>
							</div>
						</div>
					</div>
					<div id="catalog" class="margin-top-40 margin-bottom-40 manufacturer-products">
						<div class="container slider-comment-wrapper">
							<div class="catalog-body list-group  products " data-count-item="4" >
			                    <div class="gridview">
			                        @foreach ($products as $product)
			                            @include('frontend.partials.product-grid')
			                        @endforeach
			                    </div>
			                    <div class="text-center">{!! $products->render() !!}</div>
			                </div>
                        
						</div>
					</div>
					
				</div>
		</section>
@endsection


