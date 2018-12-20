<aside>
	<div class="sidebar"><h2>Категории</h2>
		<ul>
            <li class=""><a href="#">Самое популярное</a></li> 
			@foreach($categories as $c) 
			<li><a href="/ru/articles/{{ $c->slug }}">{{ $c->name }}</a></li> 
			@endforeach	   
            <!--<li><a href="/ru/articles">Все статьи</a></li>-->
		</ul>
     </div>
	<div class="sidebar" style="margin-top:10px;"> 
		<h2 style="font-size:18px;">Популярные теги</h2>
		<div class="artcles-tags">  
		@foreach($tags as $t) 
			@if($parts2)
			@foreach($parts2 as $p)
				@if($p == $t->id)
				<div style="opacity:1;"><a href="/ru/articles/tags/{{ $t->slug }}">{{ $t->title }}</a></div>
				<!--<div style="background:#deafff;"><a style="color:#fff;" href="/ru/articles/tags/{{ $t->slug }}">{{ $t->title }}</a></div>-->
				@else 
				<!--<div style="opacity:1;"><a href="/ru/articles/tags/{{ $t->slug }}">{{ $t->title }}</a></div>-->
				@endif
			@endforeach	   
			@else
				<!--<div><a href="/ru/articles/tags/{{ $t->slug }}">{{ $t->title }}</a></div>-->
			@endif
		@endforeach	   				
		</div> 
		<!--
			<a href="#" class="cst-link" style="
    padding: 5px 10px;
    width: 100%;
    font-size: 10px;">Показать все теги</a> -->
	
	</div>
</aside>