 
<div class="item product @if ($product->is_wide == 0) col-md-4 @else col-md-6 @endif ">
	<div class="row">
		<div class="@if ($product->is_wide == 0) col-md-6 @else col-md-8 @endif col-xs-6">
			<a class="popup-product-open"  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" tabIndex="-1" data-product-id="{{ $product->id }}">
				<img src="/images/products/{{ $product->image }}" class="center img-responsive" alt="">
			</a>
		</div>
		<div class="@if ($product->is_wide == 0) col-md-6 @else col-md-4 @endif  col-xs-6">
			<h4 class="title">
				<a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" tabIndex="-1" data-product-id="{{ $product->id }}" class="popup-product-open">{{ $product->name }}</a>
			</h4>
			<p class="mag">
			<?php /*
				@foreach($product->stores as $store)
                @foreach ($store->cities as $scity)
                    @if ($scity->pivot->city_id == session('city_id')) 
						{{ $store->name }}<br>                      
						<?php break; ?>
                    @endif
                @endforeach
                @endforeach
			*/ ?>	
			</p>
			<p class="price">
				{{ $product->price }} тг
			</p>
		</div>
	</div>
	<?php /*
	<div class="save-btn @if($product->isSaved()) saved @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<span>{{ trans('frontend.common.save') }} </span><i class='glyphicon glyphicon-plus'></i>"  data-model-id="{{ $product->id }}" data-model-name="Product">
			
			@if(!$product->isSaved())
		<span>{{ trans('frontend.common.save') }} </span> <img src='/images/download-arrow.png' class="save-image" />
			@else
			<i class="glyphicon glyphicon-ok"></i>
			@endif
			
	</div>
	*/ ?>
</div>