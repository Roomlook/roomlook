@extends('layouts.master')
@section('title','RoomLook')
@section('content')
<section id="main" class="padding-top-20 padding-bottom-20">
	<div class="container">
		<h1 class="text-uppercase">{{ trans('frontend.common.myrooms') }}</h1>
		<div class="col-md-12 myrooms bg-white margin-bottom-20">
				<a href="#" tabIndex="-1"  class="c_btn c_btn_medium c_btn_green" data-toggle="modal" data-target="#createModal">+ 
				{{ trans('frontend.common.create-room') }}</a>
				@foreach (Auth::user()->ownRooms()->get() as $own)
			<div class="myroom-items">
				<h3 class="text-uppercase text-center">{{  $own->name }}</h3>
				<div class="col-sm-12 col-xs-12" style="border-right: 1px solid #edeeee;">
					<h3 class="text-uppercase" >{{ trans('frontend.common.rooms') }}</h3>
					@foreach($own->roomPictures()->chunk(3) as $pictures)
					<div class="row">
						@foreach($pictures as $picture)
						<div class="col-sm-4 col-xs-4">
							<a  class="popup-open popup-room" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img src="/{{ $picture->imagePath() }}" alt="" class="img-responsive"></a>
						</div>
						@endforeach
					</div>
					
					@endforeach
				</div>
				<div class="col-sm-12 col-xs-12">
					<h3 class="text-uppercase">{{ trans('frontend.common.catalog') }}</h3>
					@foreach($own->productPictures()->chunk(3) as $productsChunk)
					<div class="row">
						@foreach($productsChunk as $product)
						<div class="col-sm-4 col-xs-4">
							<a href="/{{ $product->imagePath() }}" tabIndex="-1" data-product-id="{{ $product->id }}" class="popup-product-open"><img src="/{{ $product->imagePath() }}" alt="" class="img-responsive"></a>
						</div>
						@endforeach
					</div>
					@endforeach
				</div>
			</div>
			@endforeach
			<div class="text-center col-xs-12 margin-top-20 padding-top-20">
				<a href="/f/myroom/visualization" class="c_btn c_btn_medium c_btn_green">Заказать дизайн</a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
    
</section>
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form action="/f/myroom/create-room" method="get">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">{{ trans('frontend.common.create-room') }}</h4>
	      </div>
	      <div class="modal-body">
	      	
	      		<div class="form-group">
	      			<input type="text" name="name" class="form-control" placeholder="{{ trans('frontend.common.create-room') }}">
	      			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	      		</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('frontend.common.save') }}</button>
	        <button type="submit" class="btn btn-primary">{{ trans('frontend.auth.submit') }}</button>
	      </div>
      	</form>
    </div>
  </div>
</div>
@stop


<section id="main">
				<div id="content">
					<div class="container-fluid bg-gray padding-bottom-40">
						<div class="container about-author">
							<div class="col-md-4">
								@if (Auth::user()->image == "")
								<img class="img-responsive" src="/images/user-placeholder.jpg"/>
								@else
								<img class="img-responsive" src="/{{ Auth::user()->image }}"/>
								@endif

							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="author-name-and-social">
										<h2 class="margin-top-0">{{ Auth::user()->name }}</h2>
										<a href="{{ Auth::user()->fb }}" target="_blank"><i class="social_facebook_circle"></i></a>
										<a href="{{ Auth::user()->instagram }}" target="_blank"><i class="social_instagram_circle"></i></a>
										<a href="{{ Auth::user()->twitter }}" target="_blank"><i class="social_twitter_circle"></i></a>
									</div>
									<p>
								</div>
								<div class="row about-author-text" >
									
								</div>
								<!-- <div class="row author-contacts">
									<a href="#" class="col-xs-12"><i class="flaticon-circle"></i><span>{{-- $author->phone_number --}}</span></a>
									<a href="mailto:{{-- $author->user->email --}}" class="col-xs-12"><i class="flaticon-closed-envelope-circle"></i><span>{{-- $author->user->email --}}</span></a>
									@if ($author->website != "") <a href="{{ $author->website }}" class="col-xs-12"><i class="glyphicon glyphicon-globe"></i><span>{{-- $author->website --}}</span></a>@endif
								</div> -->
							</div>
						</div>
					</div>
					<div class="container slider-comment-wrapper">
							<div class="col-md-12">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									@foreach()
									<li role="presentation" class="active"><a href="#author-projects" aria-controls="author-projects" role="tab" data-toggle="tab">Проекты</a></li>
									<!-- <li role="presentation"><a href="#author-reviews" aria-controls="author-reviews" role="tab" data-toggle="tab">Отзывы</a></li> -->
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									@foreach($author->projects as $project)
									<div role="tabpanel" class="tab-pane active" id="author-projects">
										<h3>{{ $project->name }}</h3>
										<div class="author-projects-sliders2">
											
												@foreach($project->rooms as $room)
												@include('frontend.partials.carousel-room')
												@endforeach
										</div>
									</div>

									@endforeach
									<div role="tabpanel" class="tab-pane" id="author-reviews">

									</div>
								</div>

							</div>
						</div>
					</div>
			</section>