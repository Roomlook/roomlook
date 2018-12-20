@if ($project->rooms->count() > 0)
<div class="project-block col-md-12" data-room-id="{{ $project->rooms()->first()->id }}">
        
       
            <div class="room-slider row">
            @if ($project->rooms()->first()->pictures()->count() > 0)
                <div class="project-img" style="">
                    <div class="pic-count">
                        <i class="glyphicon glyphicon-camera"></i>  {{$project->pictures()->count()}}
                    </div>
                    <div class="project-title">
                        <div>
                            <h1 class="text-center"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">{{ $project->name }}</a></h1>
                            <p class="text-center">{{ $project->author->user->name }}</p>
                            <p class="text-center">{{ trans('frontend.common.square') }}: {{ $project->square }} {{ trans('frontend.common.kv') }}</p>
                            <br>
                            <h3 class="text-center">
                                 <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" class="c_btn_transparent3 ">{{ trans('frontend.common.more') }}</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <?php   $pic = $project->getFLImage();
                        if ($pic == null)
                            $pic = $project->pictures(1)[0];

                 ?>
                <img src="/{{ $pic->imagePath() }}" class="img-responsive" alt="">
            @endif
            </div>
              
</div>
@endif