<div class="room" data-room-id="{{ $room->id }}">
    <div class="">
        <div class="col-md-8 room-slider-holder">
            <div class="room-slider">
            
                <?php $picture = NULL;
                    if ($room->pictures->count() > 0)
                     $picture =  $room->pictures()->first(); ?>
                @if ($picture)
                <div class="item" data-picture-id="{{ $picture->id }}"">
                    <a class="popup-open popup-room" href="/{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img src="/{{ $picture->imagePath() }}" @if ($picture->is_landscape == 1) class="landscape-image" @endif alt=""></a>
                    

                    <div class="like-button-holder">
                            <a href="#" class="c_btn_like  @if($picture->isLiked()) liked @endif" data-model-id="{{ $picture->id }}" data-model-name="RoomPicture" tabIndex="-1" >
                                <i></i>
                            </a>
                        <span>{{ $picture->countLikes() }}</span>
                    </div>
                    <div class="popup-open popup-room tags" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} @if ($picture->is_landscape != 1) style="width: {{ $picture->getThumbWidth() }}px; height: {{ $picture->getThumbHeight() }}px; margin-left: -{{ $picture->getThumbWidth()/2 }}px" @else style="width: 100%; height: 100%;left: 0px;" @endif>
                <?php $i = 1; ?>
                                        @foreach($picture->tags as $tag)
                                                <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                            <div class="hint tag hidden-xs hidden-sm" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                                    <span class="count-number">{{ $i++ }}</span> <span class="hint__dot"></span>
                                                      
                                                    </div></a>

                                        @endforeach
                                    </div>
                    </div>
                    @endif
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-md-4 room-content">
            <div class=" padding-top-0 margin-bottom-10">

                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/s/{{ $room->id }}">
                    <h1 class="title">
                        {{ $room->title }}
                    </h1>
                </a>
                <p class="published_date">{{ $room->created_at->format('d.m.y') }}</p>
                <hr class="margin-top-0 margin-bottom-10">
                    <div class="desinger-image pull-left">
                        <img src="/{{ $room->project->author->imagePath() }}" class="designer img-responsive" alt="">
                    </div>
                <div class="col-md-9">
                    <div class="pull-left">
                        <small>{{   trans('frontend.common.designer') }}</small>
                        <h2 class="designer-name margin-top-0 margin-bottom-0">
                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $room->project->author->id }}">{{ $room->project->author->user->name }}</a>
                        </h2>
                        <p class="rating" data-rate="{{ $room->project->author->rating }}">
                        </p>
                    </div>
                </div>
                <div>
                    <ul class="list-inline">

                           
                            <li>
                              
                            @if ($picture != NULL)
                                <a href="#" tabIndex="-1" class="c_btn_transparent_green c_btn_small save-btn @if($picture->isSaved()) saved @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $picture->id }}" data-model-name="RoomPicture">
                                    @if($picture->isSaved())
                                     {{   trans('frontend.common.saved') }}
                                    @else
                                      {{  trans('frontend.common.save') }}
                                    @endif
                                </a>
@endif

                            </li>
                            @if (isset($i))
                            <li class="tag-amount"><div class="hint-amount " data-room-id="{{ $room->id }}"></div> {{ --$i }}</li>
                            @endif
                        </ul>
                </div>
            </div>
            @if ($room->project->rooms->count() > 1)
            <div class=" related-posts">
                <hr class="margin-top-0 margin-bottom-10">
                <a href="/">{{  trans('frontend.common.view-all-project') }}</a>
                <div class="related-posts-slider">
                    @foreach($room->project->rooms as $roomP)
                        @if ($roomP->id != $room->id)

                        @foreach($roomP->pictures as $picture)
                            <div> <a class="popup-open popup-room" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img class="img-responsive" src="/{{ $picture->imagePath() }}"></a></div>
                        @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
            <?php $tagAmount = 0; ?>
            @foreach($room->pictures as $picture)
                        @foreach ($picture->tags as $tag)
                            <?php $tagAmount++; ?>
                        @endforeach
                        @endforeach
            @if ($tagAmount > 0)
            <div class=" list-of-elements">
                <hr class="margin-top-0 margin-bottom-10">
                <a href="#">{{  trans('frontend.common.list-of-elements') }}</a>
                <div class="list-of-elements-slider">
                    @foreach($room->pictures as $picture)
                        @foreach ($picture->tags as $tag)
                            <div><a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}" class="popup-product-open green-link2"><img class="img-responsive" src="/{{ $tag->product->imagePath() }}"></a></div>
                        @endforeach

                    @endforeach
                </div>
            </div>
            @endif
            @if ($room->roomType->rooms->count() > 1)
            <div class=" similar-projects">
                <hr class="margin-top-0 margin-bottom-10">
                <a href="#">{{  trans('frontend.common.similar-projects') }}</a>
                <div class="similar-projects-slider">
                    @foreach($room->roomType->rooms as $roomT)
                        @if ($roomT->id != $room->id)
                        @foreach($roomT->pictures as $picture)
                            <div><a class="popup-open popup-room" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img class="img-responsive" src="/{{ $picture->imagePath() }}"></a></div>
                        @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="clear"></div>
    </div>
</div>
