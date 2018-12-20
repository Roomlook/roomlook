@if($array)							
@foreach($array as $relativeProduct)
<div class="slide-item" data-id="{{ $relativeProduct['id'] }}">
	<div class="mb-item-card">
		<div class="mb-tag-img col-xs-6" style="background:url('/{{ $relativeProduct['image'] }}') center center no-repeat;background-size:100%;"></div>  	
		<div class="mb-tag-info col-xs-6"> 
			<div style="background: url(/images/stores/{{ $relativeProduct['store_logo'] }}) center center no-repeat;background-size:auto 100%;">
				<p>от {{ $relativeProduct['price'] }}тг</p>
			</div>
		</div> 
		<div class="clear"></div>	
	</div>
</div>
@endforeach 
@endif 