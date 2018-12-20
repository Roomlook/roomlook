<div class="item product @if ($product->is_wide == 0) col-md-4 @else col-md-6 @endif ">
	<div> 
	<a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" tabIndex="-1" data-product-id="{{ $product->id }}" class="popup-product-open">
		<div>
			<img src="/images/products/{{ $product->image }}" class="center img-responsive" alt="">
		</div> 
		<div>
			<h4 class="title">
				{{ $product->name }} 
			</h4>
			<!--
			<p class="mag">
			   
				@foreach($product->stores as $store)
                @foreach ($store->cities as $scity)
                    @if ($scity->pivot->city_id == session('city_id')) 
						{{ $store->image }}
						{{ $store->name }}<br>                      
						<?php break; ?>
                    @endif
                @endforeach
                @endforeach
			 
			</p>
			<p class="price">
				{{ $product->price }} тг
			</p>
		<div>
			<p>Стиль: красный</p>
			<p></p>
			<p></p>
			<p></p>
		</div>
		-->
		</div>
	</a>
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