@extends('layouts.master2')
@section('title','RoomLook | Карта сайта')
@section('content')
<style>
body {background:#ececec;}
#main {background:none;}
header { 
    width: 100%;
    background-color: white;
    padding: 0;
    box-shadow: 0px 5px 5px #ccc;
    margin: 0;
    height: 98px;
}
.sitemap {margin:25px auto;}
.sitemap .content {background-color:white;padding:20px;}
</style>
<section id="main" class="sitemap-page">
    <div class="container sitemap">
		<h1>Карта сайта</h1>
		<div class="content"> 
		<ul class="map-site level1">
		<li><div class="text-container"><a href="/">Главная</a></div></li>
		<li><div class="text-container"><a href="/">Комнаты</a></div>
	        <ul class="level2">
			@foreach($room as $key => $r)
			<li><div class="text-container"><a href="/">{{ $r->title }}</a></div></li>
            @endforeach		
			</ul>
			</li>
		<li><div class="text-container"><a href="/">Статьи</a></div></li>
		<li><div class="text-container"><a href="/">Каталог</a></div></li>
		<li><div class="text-container"><a href="/">Дизайнеры</a></div></li>
		<li><div class="text-container"><a href="/">Магазин</a></div></li>
		</ul> 
		</div>
	</div>
</section>
@endsection