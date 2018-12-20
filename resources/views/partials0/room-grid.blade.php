@if ($room->pictures->count() > 0)
<div class="room" data-room-id="{{ $room->id }}" author="{{ $room->project->author->user->name }}">
    <div>
        <!--<div class="col-md-12 room-slider-holder ">-->
        <div class="room-slider-holder">  
            <div class="room-slider"> 
                <div class="hidden-xs hidden-md room-products"></div>
				 
                 <?php $picture = NULL;
                    if (isset($showPicture) && $showPicture != null) {
                        $picture = $showPicture;
                    }
                    else if ($room->pictures->count() > 0)
                        $picture =  $room->pictures()->first();  
                 ?>
                 @if ($picture != NULL)
                @if (Request::is('ru/room') || Request::is('en/room') )
                     <div class="vertical-text-layer">
                         <div class="vertical-text" style="width: 100%">
                             <div>

                                 {{ trans('frontend.common.designer') }} <a
                                         href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $picture->room->project->author->id }}">{{ $picture->room->project->author->user->name }}</a> @if($picture->room->project->photograph)
                                     @if ($picture->room->project->photograph->user->name != 'нет' && $picture->room->project->photograph->user->name != '001')/ ФОТО <a
                                             href="#">{{ $picture->room->project->photograph->user->name }}</a>@endif @endif
                             </div>
                         </div>
                     </div>
                     @endif
                 <div class="item pg-items" data-picture-id="{{ $picture->id }}" data-project-id="{{ $picture->room->project->id }}" data-project-pictures="{{ $picture->room->project->pictures(0, ['id', 'image']) }}" data-project-room="{{ $picture->room->project->rooms->count() }}">
                     
                    @if (isset($fromProject) && $fromProject)
                             <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                          <a href="https://roomlook.com/{{ $picture->imagePath('') }}"   @if($picture->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $picture->id }}" data-project-id="{{ $picture->room->project->id }}" itemprop="contentUrl" data-size="{{$picture->getWidth(0, '')}}x{{ $picture->getHeight(0, '')}}">
                              <img  
                                    alt=""
                                        src="/{{ $picture->imagePath() }}"
                                        data-src="/{{ $picture->imagePath('') }}"  class="lazyload" tabIndex="-1" data-project-id="{{ $picture->room->project->id }}" data-picture-id={{ $picture->id }} 
                                        class="popup-open popup-room @if ($picture->is_landscape == 1) landscape-image @endif img-responsive" itemprop="thumbnail" alt="Image description"
                                        data-project-id="{{ ($picture->room->project_id) }}">

                          </a>
                            <?php $i = 0; ?>
                            @foreach($picture->tags as $tag)
                           <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                <div class="hint tag" data-picture-id="{{ $picture->id }}"  data-room-id="{{ $room->id }}"  data-tag-id="{{ $tag->id }}" data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">  <div class="ring-container">
                                    <div class="ringring"></div>
                                    <div class="ringring2"></div>
                                    <div class="circle"></div>
                                </div>
                                </div>
                            </a>    
                            @endforeach                          
                        </figure>
                        @foreach($room->project->pictures() as $pic)
                        @if ($pic->id != $picture->id)
                        
                        <figure itemprop="associatedMedia" class="hidden-elements" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="https://roomlook.com/{{ $pic->imagePath('') }}" data-project-id="{{ $pic->room->project->id }}" @if($pic->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $pic->id }}"  itemprop="contentUrl" data-size="{{ $pic->getWidth(0, '') }}x{{ $pic->getHeight(0, '') }}">
                                <img src="/{{ $pic->imagePath('') }}" itemprop="thumbnail" alt="Image description" data-project-id="{{ ($picture->room->project_id) }}">
                                 </a>

                            <?php $i = 0; ?>
                            @foreach($pic->tags as $tag)
                                   <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                <div class="hint tag" data-tag-id="{{ $tag->id }}"    data-room-id="{{ $room->id }}"  data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;"> 
                                    <div class="ring-container">
                                    <div class="ringring"></div>
                                    <div class="ringring2"></div>
                                    <div class="circle"></div>
                                </div>
                                  
                                </div>
                            </a> 
                            @endforeach                           
                        </figure>
                    
                        @endif

                        @endforeach
                @else
                @foreach($roomsAll as $k => $r)
                    @if ($r->id == $room->id)
                         <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                          <a href="https://roomlook.com/{{ $picture->imagePath('') }}"   @if($picture->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $picture->id }}" data-project-id="{{ $picture->room->project->id }}" itemprop="contentUrl" data-size="{{$picture->getWidth(0, '')}}x{{ $picture->getHeight(0, '')}}">
                              <img  
                                    alt=""
                                        src="/{{ $picture->imagePath() }}"
                                        data-src="/{{ $picture->imagePath('') }}"  class="lazyload" tabIndex="-1" data-project-id="{{ $picture->room->project->id }}" data-picture-id={{ $picture->id }} 
                                        class="popup-open popup-room @if ($picture->is_landscape == 1) landscape-image @endif img-responsive" itemprop="thumbnail" alt="Image description"
                                        data-project-id="{{ ($picture->room->project_id) }}">

                          </a>
                            <?php $i = 0; ?>
                            @foreach($picture->tags as $tag)
                           <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                <div class="hint tag" data-picture-id="{{ $picture->id }}"  data-room-id="{{ $room->id }}"  data-tag-id="{{ $tag->id }}" data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">  <div class="ring-container">
                                    <div class="ringring"></div>
                                    <div class="ringring2"></div>
                                    <div class="circle"></div>
                                </div>
                                </div>
                            </a>    
                            @endforeach                          
                        </figure>
                    @else

                    @foreach($r->pictures as $pic)
                        @if ($pic->id != $picture->id)
                            <figure itemprop="associatedMedia" class="hidden-elements" itemscope itemtype="http://schema.org/ImageObject">
                                <a href="https://roomlook.com/{{ $pic->imagePath('') }}" @if($pic->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $pic->id }}"  itemprop="contentUrl" data-size="{{ $pic->getWidth(0, '') }}x{{ $pic->getHeight(0, '') }}">
                                    <img src="/{{ $pic->imagePath('') }}" itemprop="thumbnail" alt="Image description" data-project-id="{{ ($picture->room->project_id) }}">
                                </a>

                                <?php $i = 0; ?>
                                @foreach($pic->tags as $tag)
                                    <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                    <div class="hint tag" data-tag-id="{{ $tag->id }}"    data-room-id="{{ $r->id }}"  data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;"> 
                                        <div class="ring-container">
                                            <div class="ringring"></div>
                                            <div class="ringring2"></div>
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </a> 
                                @endforeach                           
                            </figure>
                        @endif
                    @endforeach
                    @endif
                @endforeach
                @endif
                    <!---
                    <div class="like-button-holder">
                            <a href="#" class="c_btn_like  @if($picture->isLiked()) liked @endif" data-model-id="{{-- $picture->id --}}" data-model-name="RoomPicture" tabIndex="-1" >
                                <i></i>
                            </a>
                        <span>{{-- $picture->countLikes() --}}</span>
                    </div>-->

                    

                </div>

                @endif
            </div>

                <div class="action-btns ">
                    
                        @if ($picture != NULL)
                            <a href="#" tabIndex="-1" class="c_btn_transparent_green c_btn_small save-btn @if($picture->isSaved()) saved @endif @if (isset($fromProject)) hidden @endif" data-save-text="<i class='glyphicon glyphicon-ok'></i>" data-unsave-text="<img src='/images/download-arrow.png' />"  data-model-id="{{ $picture->id }}" data-model-name="RoomPicture">
                                @if($picture->isSaved())
                                 <i class="glyphicon glyphicon-ok"></i>
                                @else
                                  <img src='/images/download-arrow.png' />
                                @endif
                            </a>
                        @endif
                    
                </div>
                <div class="hint-amount visible-xs" data-room-id="{{ $room->id }}"></div>
            <div class="col-md-12 room-content">
                <div class="padding-top-0  row">
                    <div class="col-md-9 col-xs-4">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/s/{{ $room->id }}">
                            <h1 class="title ">
                                {{ $room->title }}

                                
                            </h1>
                        </a>
                        <div class="clear"></div>
                        <p class="published_date">{{ $room->created_at->format('d.m.y') }}</p>
                    </div>
                    <div class="col-xs-5 room-buttons visible-xs">
                        <ul class="list-inline ">

                           
                            <li>
                            @if ($picture != NULL)
                                <a href="#" tabIndex="-1" class="c_btn_transparent_green c_btn_small save-btn @if($picture->isSaved()) saved @endif @if (isset($fromProject)) hidden @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $picture->id }}" data-model-name="RoomPicture">
                                    @if($picture->isSaved())
                                     <i class="glyphicon glyphicon-ok"></i>
                                @else
                                  <img src='/images/download-arrow.png' />
                                    @endif
                                </a>
@endif
                            </li>
                            @if (isset($i))
                            <li class="tag-amount"><div class="hint-amount " data-room-id="{{ $room->id }}"></div> <span class="hint-amount-number">{{ --$i }}</span></li>
                            @endif 
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-3 ">
                        <div class="room-designer">
                        <div class="desinger-image pull-left">
                            <img src="/{{ $room->project->author->imagePath() }}" class="designer img-responsive" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="pull-left">
                                <small>{{ trans('frontend.common.designer') }}</small>
                                <h2 class="designer-name margin-top-0 margin-bottom-0">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $room->project->author->id }}">{{ $room->project->author->user->name }}</a>
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
    @if (isset($fromProject) && isset($pic) && $pic->tags->count() > 0 )
                    <div class="visible-xs project-product-slide">
                        <div style="width: {{ 265*$pic->tags->count() + 20  }}px">
                        @foreach($pic->tags as $tag)
                        @include('partials.product-card', ['product' => $tag->product])
                        @endforeach
                        </div>
                    </div>
                    @endif
</div>
@endif
 