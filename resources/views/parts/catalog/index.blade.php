<div class="item catalog product col-md-4">
	<div> 
	<a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $catalog->id }}" tabIndex="-1" data-product-id="{{ $catalog->id }}" class="popup-product-open">
		<div>
			<img src="/images/pcategories/{{ $catalog->image }}" class="center img-responsive" alt="">
		</div> 
		<div>
			<h4 class="title">
				{{ $catalog->name }} 
			</h4> 
		</div>
	</a>
	<div class="catalogue_section-menu">
	@foreach($ccatalogs as $ccat)
	@if($ccat->parent_id == $catalog->id)
	<a class="category" data-category="{{ $ccat->id }}" href="/catalog?category_id={{ $ccat->id }}">{{ $ccat->name }}</a>
	@endif
	@endforeach
	</div>
	</div> 
</div>