<div class="popup-close">
    <button><i class="icon_close"></i></button>
</div>
<div class="col-md-12">
                <img src="/{{ $product->imagePath() }}"  class="img-responsive center product-main-img" alt="">
            </div>
            <div class="col-md-12">
                <h1 class="title text-center">{{ $product->name }}</h1>
                <p class="text-center">
                <a  href="#" tabIndex="-1" class="c_btn_small c_btn_green save-btn @if($product->isSaved()) saved @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $product->id }}" data-model-name="Product">@if($product->isSaved())
                         {{   trans('frontend.common.saved') }}
                        @else
                          {{  trans('frontend.common.save') }}
                        @endif</a></p>
            </div>

            <hr class="divider"/>
            <div class="col-md-12">
                <h4 class="margin-top-0 margin-bottom-20">
                    @if ($product->stores()->count() > 1) {{ trans('frontend.common.stores') }}: 
                    @else
                    {{ trans('frontend.common.store') }}: 
                    @endif
                    <?php $j = 0;?>
                    @foreach ($product->stores as $store)
                        <a href="{{ $store->url }}" class="green-link2">{{ $store->name }}</a>@if ($j + 1 != $product->stores()->count()), @endif
                        <?$j++;?>
                    @endforeach
                </h4>
            </div>
            <hr class="divider"/>
            <div class="col-md-12 product-description">
                <p>
                    {!! $product->short_body !!}<br>
                    {{ trans('frontend.common.manufacturer') }}: <a href="{{ $product->manufacturer->url }}" class="green-link2">{{ $product->manufacturer->name }}</a>
                </p>
            </div>
            <div class="col-md-12 related-posts">
            {{-- 
                <hr class="margin-top-0 margin-bottom-10">
                <a href="#" class="green-link">{{ trans('frontend.common.pictures-with-product') }}</a>
                <div class="related-posts-slider2">
                    @foreach($product->tags as $tg)
                            <a class="popup-open popup-room" href="{{ $tg->picture->imagePath() }}" tabIndex="-1" data-picture-id="{{ $tg->picture->id }}" ><div class="item"><img class="img-responsive" src="/{{ $tg->picture->imagePath() }}"></div></a>
                        
                    @endforeach
                    
                </div>
                --}}
            </div>
            <div class="col-md-12 related-posts">

            @if ($product->relative_id != 0)
            @foreach($product->relative->products as $pr)
                @if ($pr->id != $product->id)
                <div class="row" style="padding: 10px 0px;">
                    <div class="col-md-3"><img src="/{{ $pr->imagePath() }}" class="img-responsive"/></div>
                    <div class="col-md-6"><h5>{{ $pr->name }}</h5>
                        <p>{{ trans('frontend.common.manufacturer') }}: <a href="{{ $product->manufacturer->url }}" class="green-link2">{{ $product->manufacturer->name }}</a></p></div>
                    <div class="col-md-3">
                    <br><br>
                        <a  href="#" tabIndex="-1" class="c_btn_small c_btn_green save-btn @if($pr->isSaved()) saved @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $pr->id }}" data-model-name="Product">@if($product->isSaved())
                         -
                        @else
                        +
                        @endif</a>
                    </div>
                
                </div> 
                @endif
            @endforeach
            @endif
            {{-- 
                <hr class="margin-top-10 margin-bottom-10">
                <a href="#" class="green-link">{{ trans('frontend.common.similar-products') }}</a>
                <div class="related-posts-slider2">
                    @if ($product->pcategory)
                    @foreach($product->pcategory->products as $p)
                    <div class="item"><a href="/{{ $p->imagePath() }}" tabIndex="-1" data-product-id="{{ $p->id }}" class="popup-product-open green-link2"><img class="img-responsive" src="/{{ $p->imagePath() }}"></a></div>
                    @endforeach
                    @endif
                    
                </div>
                --}}
            </div>
            <script >
$(".slides").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        singleItem:true
    });
    $(".related-posts-slider2").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
    $(".related-posts-slider2").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
</script>