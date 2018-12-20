@if ($project->rooms->count() > 0)
<div class="project col-md-12" data-room-id="{{ $project->rooms()->first()->id }}">
    <div class="row">
        
        
        <div class="col-md-12 room-slider-holder ">
        <div class="col-md-12 room-content">
                <div class="padding-top-0  row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <a href="/f/project/s/{{ $project->id }}">
                            <h1 class="title ">
                                {{ $project->name }}

                                
                            </h1>
                        </a>
                        <div class="clear"></div>
                        <p class="published_date">{{ $project->created_at->format('d.m.y') }}</p>
                    </div>
                    
                    
                </div>
            </div>
            <div class="room-slider">
            <?php $i = 0; ?>
            @if ($project->rooms()->first()->pictures()->count() > 0)
                 <?php $picture = NULL;
                    
                      ?>
                    @foreach($project->pictures(6) as $picture)
                 @if ($i == 0) <div class="items-xl">  @elseif ($i == 1) <div class="items-xs"> @endif
                <div class="item @if ($i == 0) xl @else xs @endif" data-type="project" data-picture-id="{{ $picture->id }}">
                    <img  href="{{ $picture->imagePath() }}" data-type="project" tabIndex="-1" data-picture-id={{ $picture->id }} src="/{{ $picture->imagePath() }}" class="popup-open popup-room @if ($picture->is_landscape == 1) landscape-image @endif " alt="">
                 </div>
                 @if ($i == 0) </div> @endif
                 <?php $i++; ?>
            @endforeach
            @if ($i > 1)
 <a href="/f/project/s/{{ $project->id }}">
                <div class="item xs item-text">
                   {{ trans('frontend.common.more') }}
                </div></a>
            </div>
            @endif
                @endif
                <div class="project-desc">
                    <div class="room-designer">
                        <div class="desinger-image pull-left">
                            <img src="/{{ $project->author->imagePath() }}" class="designer img-responsive" alt="">
                        </div>
                        <div class="col-md-8 col-xs-8 col-sm-8">
                            <div class="pull-left">
                                <small>{{ trans('frontend.common.designer') }}</small>
                                <h2 class="designer-name margin-top-0 margin-bottom-0">
                                    <a href="/f/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a>
                                </h2>
                                <!-- 
                                <p class="rating" data-rate="{{-- $room->project->author->rating --}}">

                                </p> -->
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    {!! $project->description !!}
                </div>
            </div>
            

        <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
</div>
@endif