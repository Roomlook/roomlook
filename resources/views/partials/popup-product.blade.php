
<div class="popup-info">
    <div class="col-md-12">
        <h1 class="title">{{ $product->name }}</h1>
    </div>
    <hr class="divider"/>
    <div class="col-md-12">
        <h4 class="margin-top-0 margin-bottom-20">
            @if ($product->stores()->count() > 1) {{ trans('frontend.common.stores') }}: 
            @else
            {{ trans('frontend.common.store') }}: 
            @endif
            <?php $i = 0;?>
            @foreach ($product->stores as $store)
                <a href="{{ $store->url }}" class="green-link2">{{ $store->name }}</a>@if ($i + 1 != $product->stores()->count()), @endif
                <?$i++;?>
            @endforeach
        </h4>
    </div>
    <hr class="divider"/>
    <div class="col-md-12">
        <p>
            {!! $product->short_body !!}<br>
            {{ trans('frontend.common.manufacturer') }}: <a href="{{ $product->manufacturer->url }}" class="green-link2">{{ $product->manufacturer->name }}</a>

        </p>
    </div>
    <div class="col-md-12 related-posts">
        <hr class="margin-top-0 margin-bottom-10">
        <a href="#" class="green-link">{{ trans('frontend.common.pictures-with-product') }}</a>
        <div class="related-posts-slider2">
        	@foreach($product->tags as $tag)
        			<a class="popup-open popup-room" href="{{ $tag->picture->imagePath() }}" tabIndex="-1" data-picture-id="{{ $tag->picture->id }}" ><div class="item"><img class="img-responsive" src="/{{ $tag->picture->imagePath() }}"></div></a>
        		
        	@endforeach
            
        </div>
    </div>
    <div class="col-md-12 related-posts">

        <hr class="margin-top-10 margin-bottom-10">
        <a href="#" class="green-link">{{ trans('frontend.common.similar-products') }}</a>
        <div class="related-posts-slider2">
            @if ($product->pcategory)
        	@foreach($product->pcategory->products as $p)
        	<div class="item"><a href="/{{ $p->imagePath() }}" tabIndex="-1" data-product-id="{{ $p->id }}" class="popup-product-open green-link2"><img class="img-responsive" src="/{{ $p->imagePath() }}"></a></div>
        	@endforeach
            @endif
            
        </div>
    </div>
</div>
<div class="popup-product-image">
    
    <div class="slides">
        @foreach($product->pictures as $picture)
        <div class="slide">
            <div class="popup-image-holder">
                <div style="background-image: url(/{{ $picture->imagePath() }})" ></div>
            </div>
            <div class="bottom-buttons text-center">
                <div class="text-center col-md-8 col-md-offset-2">
                    <ul class="list-inline">
                       
                            <li>
                                 <a href="#" tabIndex="-1" class="c_btn_gray c_btn_medium save-btn @if($picture->isSaved()) saved @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $picture->id }}" data-model-name="ProductPicture">
                                            @if($picture->isSaved())
                                             {{   trans('frontend.common.saved') }}
                                            @else
                                              {{  trans('frontend.common.save') }}
                                            @endif
                                        </a>
                                
                            </li>
                            
                            
                            <li>
                                <div class="like-button-holder">
                                        <a href="#" class="c_btn_like  @if($picture->isLiked()) liked @endif" data-model-id="{{ $picture->id }}" data-model-name="ProductPicture" tabIndex="-1" >
                                            <i></i>
                                        </a>
                                    <span>{{ $picture->countLikes() }}</span>
                                </div>
                            </li>
                        
                        
                    </ul>
                    
                    
                </div>
        
    </div>
        </div>

        @endforeach
    </div>
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