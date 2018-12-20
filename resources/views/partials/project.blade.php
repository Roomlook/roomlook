@if ($project->rooms->count() > 0) 
<div class="project-block col-md-12" data-room-id="{{ $project->rooms()->first()->id }}" style="padding:0 0 30px;">
    <h1 class="project-title">
        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
        @if ($project->name)
            {{ $project->name }}
        @else
            {{ $project->name }}
        @endif
        </a>
    </h1>
    <p class="project-desc">{{ $project->author->user->name }}</p>
    <div class="project-wrapper">
        <div class="project-content">
            <?php   
                            $pic = $project->pictures(1, [], true);

                 ?>
                 <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
            <div class="project-image col-md-12 project-image-slide" style="height:auto">
                    @foreach($pic as $p)
                    <div class="item projectSS" >
                        <div class="project-image-el" >
                        <img src="/{{ $p->imagePath() }}" class="img-responsive">
                        <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                    </div></div>
                    @endforeach
            </div>
                </a>
        </div>

    </div>                  
              
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var element = document.querySelector('.project-image');
        element.style.height = element.offsetHeight;
    });

</script>
@endif