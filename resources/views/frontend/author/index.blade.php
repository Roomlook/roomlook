@extends('layouts.master-stores')
@section('title', $author->user->name)
@section('seo_keywords', $author->seo_keywords)
@section('seo_description', $author->seo_description)
@section('content')
	<section id="main">
				<div id="content">
					<div class="container-fluid padding-bottom-40">
						<div class="container">
							<br>
					        <div class="breadcumbs">
					            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
					            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author">{{ trans('frontend.common.designers') }}</a> >
					            <a href="#">{{ $author->user->name }}</a>
					        </div>
						</div>
						<div class="container about-author">
							<div class="col-md-4 col-md-offset-4">
								<div class="row">
									<div class="col-md-3  col-xs-5">
										<div class="desinger-image"  style="background-image: url(/images/authors/{{$author->image}}); background-size: cover; background-position: center;">
											
										</div>
									</div>
									<div class="col-md-8 col-md-offset-1 author-info  col-xs-7">
										<h5 class="margin-top-0 margin-bottom-10">{{ $author->user->name }}</h5>
										<p>
											{{ $author->phone_number }}<br>
											@if ($author->website != "") {{ $author->website }}<br>@endif
											{{ $author->user->email }} <br>
											<br>
											
                                    @if ($author->city != '')
                                    <p><i class="glyphicon glyphicon-map-marker"></i> &nbsp;{{ $author->city }}</p>
                                    @endif
											
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-8 col-md-offset-2">
								<div class="row about-author-text" >
									<p class="text-center">
										{!! $author->about !!}
									</p>
								</div>
								
							</div>
						</div>

						<div class="clear"></div>
					</div>
					<div class="container ">
							<div class="col-md-12 author-projects">
								
									@foreach($author->projects as $project)
									@if ($project->rooms->count() > 0)
									
										
										<div class="author-project" style="background-image: url(/{{  $project->pictures(1)[0]->imagePath()  }})" onClick="window.location.href='/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}';">
											<a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}"><div class="author-title">{{ $project->name }}</div></a>
										</div>
									@endif
									@endforeach

							</div>

						<div class="clear"></div>
						</div>

						<div class="clear"></div>
					</div>

						<div class="clear"></div>
			</section>
@stop