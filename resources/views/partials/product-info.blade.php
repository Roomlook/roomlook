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
            <h5>
                {{ $product->name }}
            </h5>
            <h4 class="price">
                {{ $product->price }} тг
            </h4>
            <p>
                @if ($product->manufacturer)
                <span>{{ $product->manufacturer->name }}</span><br>
                @endif
                <a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" class="c_btn_small c_btn_transparent5">смотреть</a>
            </p>
        </div>
    </div>
    @foreach($products as $relativeProduct)
    @if ($product->id === $relativeProduct->id)
        <?php continue; ?>
    @endif
    <div class="product-popup-item">
        <div class="col-md-6 col-xs-6 product-image-holder">
            <a  href="#" tabIndex="-1" class="green-link save-btn @if($relativeProduct->isSaved()) saved @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<span>{{ trans('frontend.common.save') }} </span><i class='glyphicon glyphicon-plus'></i>" data-model-id="{{ $relativeProduct->id }}" data-model-name="Product">@if($relativeProduct->isSaved())
                         <i class="glyphicon glyphicon-ok"></i>
                        @else
                          <i class="glyphicon glyphicon-plus"></i>
                        @endif</a>
            <img src="/{{ $relativeProduct->imagePath() }}" class="img-responsive">
        </div>
        <div class="col-md-6 col-xs-6">
            <h5>
                {{ $relativeProduct->name }}
            </h5>
            <h4 class="price">
                {{ $relativeProduct->price }} тг
            </h4>
                
            <p>
                @if ($relativeProduct->manufacturer)
                <span>{{ $relativeProduct->manufacturer->name }}</span><br>
                
            @endif
                <a  href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $relativeProduct->id }}" class="c_btn_small c_btn_transparent5">смотреть</a>
            </p>
        </div>
    </div>
    @endforeach
</div>