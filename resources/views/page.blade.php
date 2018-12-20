@extends('layouts.master-glav')

@section('seo_keywords', $article->seo_keywords)
@section('seo_description', $article->seo_description)
@section('content')
	<div class="container">
<div class="row">
				
					<div class="breadcumbs" style="display:block;margin:15px 0;">
                        <a href="/ru">Главная</a> &gt;  
                        <a href="#">{{ $article->title }}</a>
                    </div>
					
                <h1 class="title">{{ $article->title }}</h1>
					</div>
					</div>
	<div class="container auth-block">
		<div class="row">
		<div class="">
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
