<div class="item" data-picture-id={{ $picture->id }}>
    <a class="popup-open popup-room" href="/{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img src="/{{ $picture->imagePath() }}" class="fw" alt=""></a>
    

    <div class="like-button-holder">
            <a href="#" class="c_btn_like  @if($picture->isLiked()) liked @endif" data-model-id="{{ $picture->id }}" data-model-name="RoomPicture" tabIndex="-1" >
                <i></i>
            </a>
        <span>{{ $picture->countLikes() }}</span>
    </div>
<div class="tags">
<?php $i = 1; ?>
                        @foreach($picture->tags as $tag)
                                <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open  green-link tags c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                    <div class="hint tag hidden-xs hidden-sm" style="top: 60%; left: 75%;"> <span class="count-number">{{ $i++ }}</span> <span class="hint__dot"></span>
                                      
                                    </div></a>

                        @endforeach
                    </div>

</div>