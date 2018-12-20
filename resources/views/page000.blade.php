@extends('layouts.auth')

@section('seo_keywords', $article->seo_keywords)
@section('seo_description', $article->seo_description)
@section('content')
	<div class="container auth-block">
		<div class="row">
		<div class="col-md-6 col-md-offset-3">
                <h2 class="text-center no-margin-bottom text-uppercase">{{ $article->title }}</h2>
				<div class="panel-body">
                    @if ($article->image != '' || $article->image != null)
                    <img src="{!! asset('images/articles/' . $article->image) !!}" class="img-responsive">
                    @endif
					{!! $article->body !!}
				</div>
			</div>
		</div>
	</div>
@endsection
