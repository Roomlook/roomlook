<div class="room">
    

    <div class="col-md-8 room-slider-holder">
        <div class="room-slider">
            @foreach($room->pictures as $picture)
                @include('frontend.partials.slider-item-room')
            @endforeach
        </div>
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
                    </a>
                    <p class="rating" data-rate="{{ $room->project->author->rating }}">
                        
                    </p>
                </div>
            </div>
        </div>

        <div class=" related-posts">
            <hr class="margin-top-0 margin-bottom-10">
            <a href="/">{{  trans('frontend.common.view-all-project') }}</a>
            
        </div>
        <div class=" list-of-elements">
            <hr class="margin-top-0 margin-bottom-10">
            <a href="#">{{  trans('frontend.common.list-of-elements') }}</a>
            
        </div>
        <div class=" similar-projects">
            <hr class="margin-top-0 margin-bottom-10">
            <a href="#">{{  trans('frontend.common.similar-projects') }}</a>
            <hr class="margin-top-0 margin-bottom-10">
            
        </div>
    </div>
</div>
