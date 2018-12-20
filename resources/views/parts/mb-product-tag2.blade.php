@if($array3)			
<?php $i = 0; ?>	
@foreach($array3 as $relativeProduct)
<div>  
	<div class="mb-item-card small" data-id="{{ $relativeProduct['id'] }}">
		<div class="mb-tag-img col-xs-6" style="background:url('/{{ $relativeProduct['image'] }}') center center no-repeat;background-size:100%;"></div>  	
		<div class="mb-tag-info col-xs-6"> 
			<div style="background: url(/images/stores/{{ $relativeProduct['store_logo'] }}) center 0px no-repeat;background-size:60px;">
				<!--<p>от {{ $relativeProduct['price'] }}тг</p>-->
				<a class="product btn" href="#">уточняйте цену</a>
			</div>
		</div> 
		<div class="clear"></div>	
	</div>  
</div>
<?php $i++; ?>
@endforeach
@endif 