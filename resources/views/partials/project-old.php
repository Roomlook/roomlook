@if ($project->rooms->count() > 0)
<div class="article project-block col-md-12" data-room-id="{{ $project->rooms()->first()->id }}">
	<div class="text-center mb-12">
	
				<div class="margin-y-50">
                    <p>{{ $project->author->user->name }}</p>
                    <h3>
                        <strong>
                            <a href="/project/s/{{ $project->id }}" style="font-weight: 500;margin-bottom: 0px;color: #000;">{{ $project->name }}</a>
                        </strong>
                    </h3> 
                </div> 	
 
    <div class="project-wrapper">
        <div class="project-content">
            <?php   
                            $pic = $project->pictures(1, [], true);

                 ?>
                 <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
            <div class="project-image col-md-12 project-image-slide" >
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
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var element = document.querySelector('.project-image');
        element.style.height = element.offsetHeight;
    });

</script>
@endif