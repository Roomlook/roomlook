<div class="slide product-pp" data-picture-id="{{ $picture->id }}">
        
        <div class="popup-image-holder">

            
                <img src="/{{ $picture->imagePath('') }}" class="@if ($picture->is_landscape == 1) landscape-img @endif" alt="">
            
        </div>
        <div class="tags" style="position:relative; " data-width="{{ $picture->getWidth() }}" data-height="{{ $picture->getHeight() }}">
        <?php $i = 1; ?>
            @foreach($picture->tags as $tag)
            <a href="#" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open   tags c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                            <div class="hint tag popup-product-open"  href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;"> <span class="count-number">{{-- $i++ --}}</span> <span class="hint__dot"></span>
                              
                              <?php $product = $tag->product; ?>
                              <div class="loading-block">
                                  <div class="loading-img">
                                      
                                  </div>

                                <div class="loading-line"><div class="pace-progress-inner"></div></div>
                              </div>
                            </div>

                        </a>
                        <?php $i++;?>
            @endforeach
        </div>
        
        
        <div class="bottom-buttons text-center">
            
            {{--<div class="text-center">
                <ul class="list-inline">
                    <li>
                        <!-- <a href="/f/room/s/{{-- $room->id --}}" class="c_btn_green c_btn_small">{{-- trans('frontend.common.more') --}}</a> -->
                    </li>
                    <li>
                         <a href="#" tabIndex="-1" class="c_btn_green c_btn_small save-btn @if($picture->isSaved()) saved @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $picture->id }}" data-model-name="RoomPicture">
                                    @if($picture->isSaved())
                                        {{   trans('frontend.common.saved') }}
                                    @else
                                        {{  trans('frontend.common.save') }}
                                    @endif
                                </a>
                        
                    </li>
                    
                    
                    
                    <li>
                        @if ($picture->room->project->rooms->count() > 1)
                <div class="has-popup-block  related-posts hidden-xs">
                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $picture->room->project->id }}" target="_blank" tabIndex="-1" class="c_btn_green c_btn_small ">{{  trans('frontend.common.view-all-project') }}
                    </a>
                    <div class="related-posts-slider popup-block" id="popup-related-posts">
                    <div class="inner-popup-block">
                        @foreach($picture->room->project->rooms()->take(6)->get() as $roomP)
                            @if ($roomP->id != $room->id)

                            @foreach($roomP->pictures as $picture)
                                <div> <a target="_blank" href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $picture->room->project_id }}?picture_id={{ $picture->id }}" t ><img class="img-responsive" src="/{{ $picture->imagePath('md/') }}"></a></div>
                            @endforeach
                            @endif
                        @endforeach
</div>
                        <div class="clear"></div>
                    </div>
                    </a>
                </div>
                @endif
                    </li>
                    <li>
                        
                @if (false)
                <div class="has-popup-block  similar-projects hidden-xs">
                    <a href="#" tabIndex="-1" class="has-popup-block c_btn_green c_btn_small ">{{  trans('frontend.common.similar-projects') }}
                    </a>
                    <div class="similar-projects-slider popup-block" id="popup-similar-posts">
                        @foreach($room->roomType->rooms()->take(6)->get() as $roomT)
                            @if ($roomT->id != $room->id)
                            @foreach($roomT->pictures as $picture)
                                <div><a class="popup-open popup-room" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img class="img-responsive" src="/{{ $picture->imagePath('md/') }}"></a></div>
                                <?php break; ?>
                            @endforeach
                            @endif

                        @endforeach
                    </div>
                </div>
                @endif
                    </li>
                        @if ($i - 1 != 0) <li><div class="hint-amount " data-picture-id="{{ $picture->id }}">{{ --$i }}</div> </li> @endif

                    <!-- <li>
                        <div class="like-button-holder">
                                <a href="#" class="c_btn_like  @if($picture->isLiked()) liked @endif" data-model-id="{{-- $picture->id --}}" data-model-name="RoomPicture" tabIndex="-1" >
                                    <i></i>
                                </a>
                            <span>{{-- $picture->countLikes() --}}</span>
                        </div>
                    </li> -->
                </ul>
                
                
            </div> --}}
                <div class="row">
                    
                
                
                </div>
            
            
        </div>
    </div>
