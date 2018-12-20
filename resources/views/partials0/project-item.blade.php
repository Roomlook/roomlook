
@if ($project->rooms->count() > 0)
<div class="room" data-room-id="{{ $project->rooms()->first()->id }}">
    <div>


        <div class="col-md-12 room-slider-holder ">
            <div class="room-slider">
                 <?php $picture = NULL;
                    if ($project->rooms()->first()->pictures()->count() > 0)
                     $picture =  $project->rooms()->first()->pictures()->first(); ?>
                 @if ($picture != NULL)
 <a class="popup-open popup-room" data-type="project" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} >
                <div class="item" data-type="project" data-picture-id="{{ $picture->id }}">

                    <img  href="{{ $picture->imagePath() }}" data-type="project" tabIndex="-1" data-picture-id={{ $picture->id }} src="/{{ $picture->imagePath() }}" class="popup-open popup-room @if ($picture->is_landscape == 1) landscape-image @endif img-responsive" alt="">
                    
                <div class="popup-open popup-room tags" data-type="project" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} style="width: {{ $picture->getThumbWidth() }}px; height: {{ $picture->getThumbHeight() }}px; margin-left: -{{ $picture->getThumbWidth()/2 }}px">
                        
            <?php $i = 1;?>
                        @foreach($picture->tags as $tag)
                         <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                            <div class="hint tag hidden-xs hidden-sm" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">  <span class="count-number">{{ $i++ }}</span> <span class="hint__dot"></span>
                              <div class="tool tool--right">
                                <div class="tip"></div>
                                <div>
                                    <div class="col-md-4 col-xs-4 col-sm-4">
                                        <img src="/{{ $tag->product->imagePath() }}" alt="" class="img-responsive center">
                                    </div>
                                    <div class="col-md-8 col-xs-8 col-sm-8 padding-left-0">
                                        <h5>{{ $tag->product->name }}</h5>
                                        <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}" class="popup-product-open green-link2">{{ trans('frontend.common.more') }}</a>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </a>
                           
                        @endforeach

                    </div>

                    <div class="like-button-holder">
                            <a href="#" class="c_btn_like  @if($picture->isLiked()) liked @endif" data-model-id="{{ $picture->id }}" data-model-name="RoomPicture" tabIndex="-1" >
                                <i></i>
                            </a>
                        <span>{{ $picture->countLikes() }}</span>
                    </div>

                    

                </div>

                    </a>
                @endif
            </div>
            <div class="col-md-12 room-content">
                <div class="padding-top-0  row">
                    <div class="col-md-4 col-xs-4 col-sm-4">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                            <h1 class="title ">
                                {{ $project->name }}

                                
                            </h1>
                        </a>
                        <div class="clear"></div>
                        <p class="published_date">{{ $project->created_at->format('d.m.y') }}</p>
                    </div>
                    <div class="col-md-5 col-xs-5 col-sm-5 room-buttons">
                        <ul class="list-inline ">

                           
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
                            <li class="tag-amount"><div class="hint-amount " data-room-id="{{ $project->rooms()->first()->id }}"></div> <span class="hint-amount-number">{{ --$i }}</span></li>
                            @endif 
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-3 col-sm-3 col-md-offset">
                        <div class="room-designer">
                        <div class="desinger-image pull-left">
                            <img src="/{{ $project->author->imagePath() }}" class="designer img-responsive" alt="">
                        </div>
                        <div class="col-md-8 col-xs-8 col-sm-8">
                            <div class="pull-left">
                                <small>{{ trans('frontend.common.designer') }}</small>
                                <h2 class="designer-name margin-top-0 margin-bottom-0">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a>
                                </h2>
                                <!-- 
                                <p class="rating" data-rate="{{-- $room->project->author->rating --}}">

                                </p> -->
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    
                </div>
            </div>

        <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</div>
@endif