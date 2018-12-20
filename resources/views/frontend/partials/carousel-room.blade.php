@if ($room->pictures->count() > 0)
<div class="item author-project">
	<div class="pos-rel">
	 <?php $picture = NULL;
                    if (isset($showPicture) && $showPicture != null) {
                        $picture = $showPicture;
                    }
                    else if ($room->pictures->count() > 0)
                        $picture =  $room->pictures()->first(); 

                 ?>
                 @if ($picture != NULL)
                 <div class="item pg-items" data-picture-id="{{ $picture->id }}" data-project-id="{{ $picture->room->project->id }}" data-project-pictures="{{ $picture->room->project->pictures(0, ['id', 'image']) }}" data-project-room="{{ $picture->room->project->rooms->count() }}">

                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                      <a href="https://roomlook.com/{{ $picture->imagePath() }}"   @if($picture->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $picture->id }}" itemprop="contentUrl" data-size="{{$picture->getWidth()}}x{{ $picture->getHeight()}}">
                          <img  
                                alt=""
                                    src="/{{ $picture->imagePath() }}"
                                    data-src="/{{ $picture->imagePath('') }}"  class="lazyload" tabIndex="-1" data-picture-id={{ $picture->id }} src="https://roomlook.com/{{ $picture->imagePath() }}" class="popup-open popup-room @if ($picture->is_landscape == 1) landscape-image @endif img-responsive" itemprop="thumbnail" alt="Image description">

                      </a>
                        <?php $i = 0; ?>
                        @foreach($picture->tags as $tag)
                       <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open hidden-elements   c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                            <div class="hint tag hidden-xs hidden-sm" data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">  <span class="count-number">{{ $i++ }}</span> <span class="hint__dot"></span>
                              <div class="loading-block">
                                  <div class="loading-img">
                                  </div>

                                <div class="loading-line"><div class="pace-progress-inner"></div></div>
                              </div>
                            </div>
                        </a>    
                        @endforeach                          
                    </figure>
                        @foreach($room->pictures as $pic)
                        @if ($pic->id != $picture->id)
                        <figure itemprop="associatedMedia" class="hidden-elements" itemscope itemtype="http://schema.org/ImageObject">
                        <a href="https://roomlook.com/{{ $pic->imagePath() }}" @if($pic->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $pic->id }}"  itemprop="contentUrl" data-size="{{ $pic->getWidth() }}x{{ $pic->getHeight() }}">
                            <img src="/{{ $pic->imagePath('') }}" itemprop="thumbnail" alt="Image description">
                             </a>

                        <?php $i = 0; ?>
                        @foreach($pic->tags as $tag)
                               <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                            <div class="hint tag hidden-xs hidden-sm" data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">  <span class="count-number">{{ $i++ }}</span> <span class="hint__dot"></span>
                              <div class="loading-block">
                                  <div class="loading-img">
                                  </div>

                                <div class="loading-line"><div class="pace-progress-inner"></div></div>
                              </div>
                            </div>
                        </a> 
                        @endforeach                           
                    </figure>
                        @endif
                        @endforeach
                
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
	<p class="project-descr text-center">
		{{ $room->title }}
	</p>
</div>
@endif