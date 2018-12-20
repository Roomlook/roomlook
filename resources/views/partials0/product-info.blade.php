<div class="product-sidebar-list" style="width: {{ ($products->count())*230 }}px">
    <div class="product-popup-item">
        <div class="col-md-7 col-xs-7 product-image-holder">
            <a  href="#" tabIndex="-1" class="green-link save-btn @if($product->isSaved()) saved @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<i class='glyphicon glyphicon-plus'></i>" data-model-id="{{ $product->id }}" data-model-name="Product">@if($product->isSaved())
                         <i class="glyphicon glyphicon-ok"></i>
                        @else
                          <i class="glyphicon glyphicon-plus"></i>
                        @endif</a>
            <img src="/{{ $product->imagePath() }}" class="img-responsive">
        </div> 
        <div class="col-md-5 col-xs-5"> 
			<p style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">Магазин</p>
            <span style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">
				<?php 
				
					$product_store = \DB::table('store_product')->where('product_id', $product->id)->first(); 
					$store = \DB::table('store_translations')->where('store_id', $product_store->store_id)->first(); 
				
					print_r($store->name);
				
				?> 
            </span> 
			<p style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">Производитель</p> 
            @if ($product->manufacturer)
			<span style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">{{ $product->manufacturer->name }}</span><br>
            @endif
            <a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" class="c_btn_small c_btn_transparent5">смотреть</a>
        </div>
    </div>
    @foreach($products as $relativeProduct)
    @if ($product->id === $relativeProduct->id)
        <?php continue; ?>
    @endif
    <div class="product-popup-item">
        <div class="col-md-7 col-xs-6 product-image-holder">
            <a  href="#" tabIndex="-1" class="green-link save-btn @if($relativeProduct->isSaved()) saved @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<span>{{ trans('frontend.common.save') }} </span><i class='glyphicon glyphicon-plus'></i>" data-model-id="{{ $relativeProduct->id }}" data-model-name="Product">@if($relativeProduct->isSaved())
                         <i class="glyphicon glyphicon-ok"></i>
                        @else
                          <i class="glyphicon glyphicon-plus"></i>
                        @endif</a>
            <img src="/{{ $relativeProduct->imagePath() }}" class="img-responsive">
        </div>
        <div class="col-md-5 col-xs-6">
			<p style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">Магазин</p>
            <span style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">
				<?php 
				
					$product_store = \DB::table('store_product')->where('product_id', $product->id)->first(); 
					$store = \DB::table('store_translations')->where('store_id', $product_store->store_id)->first(); 
				
					print_r($store->name);
				
				?> 
            </span>
			<p style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">Производитель</p>  
            @if ($relativeProduct->manufacturer)
			<span style="font-family: 'Source Sans Pro', sans-serif !important;margin:0">{{ $relativeProduct->manufacturer->name }}</span> 
            @endif
            <a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $relativeProduct->id }}" class="c_btn_small c_btn_transparent5">Подробнее</a>
        </div>
    </div>
    @endforeach
</div>