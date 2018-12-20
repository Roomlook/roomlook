<div class="col-sm-12 item product">
    <div class="row">
        <div class="col-sm-6 col-xs-6">
            <div class="product-image-holder">
                <a class="popup-product-open"  href="/{{ $product->imagePath() }}" tabIndex="-1" data-product-id="{{ $product->id }}"><img src="/{{ $product->imagePath() }}" class="center img-responsive" alt=""></a>
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <h3 class="title">
                <a  href="/{{ $product->imagePath() }}" tabIndex="-1" data-product-id="{{ $product->id }}" class="popup-product-open">{{ $product->name }}</a>
            </h3>
            <p class="margin-top-0 margin-bottom-20">
                @if ($product->stores()->count() > 1) {{ trans('frontend.common.stores') }}: 
                @else
                {{ trans('frontend.common.store') }}: 
                @endif
                <?php $i = 0;?>
                @foreach ($product->stores as $store)
                    <a href="/f/store/{{ $store->id }}" class="green-link2">{{ $store->name }}</a>@if ($i + 1 != $product->stores()->count()), @endif
                    <?$i++;?>
                @endforeach
            </p>
            <p>
                {!! $product->short_body !!}<br>
                {{ trans('frontend.common.manufacturer') }}: <a href="{{  $product->manufacturer ? $product->manufacturer->url  : ''}}" class="green-link2">{{  $product->manufacturer ? $product->manufacturer->name : ''}}</a>
            </p>
            <div class="row">
                <div class="col-xs-8 margin-top-5 col-sm-8">
                    <a  href="#" tabIndex="-1" class="green-link save-btn @if($product->isSaved()) saved @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<span>{{ trans('frontend.common.save') }} </span><img src='/images/download-arrow.png' />" data-model-id="{{ $product->id }}" data-model-name="Product">@if($product->isSaved())
                         <i class="glyphicon glyphicon-ok"></i>
                        @else
                                  <img src='/images/download-arrow.png' />
                        @endif</a>
                </div>
                
            </div>

            
            </div>
        </div>
    
	
</div>