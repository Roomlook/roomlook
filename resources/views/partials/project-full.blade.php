@if ($project->rooms->count() > 0)
<div class="project-block col-md-12" data-room-id="{{ $project->rooms()->first()->id }}" style="padding:0;">
    <h1 class="project-title">
        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
<?php
		 
    $t = explode(" ", $search);
                
    foreach($t as $i)
            if(strlen($i) >= 2) $source = preg_replace('#' . $i . '#i', '<span class=bold>$0</span>', $project->name);
 
    echo $source;
		
?>	
        </a>
    </h1>
    <p class="project-desc">{{ $project->author->user->name }}</p>
	 
	<div class="text-center mb-12"> 
	
	<?php //if(empty($project->pictures(1, [], true)))print_r($project->pictures(1, [], true)); ?>
	
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

	<div class="clear"></div>
	
	<div>
		<p>
		
		<?php
		 
        $t = explode(" ", $search);
                
        foreach($t as $i)
                if(strlen($i) >= 2) $source = preg_replace('#' . $i . '#i', '<span class=bold>$0</span>', $project->description);
 
        echo $source;
		
		?>
		 
		
		</p>
	</div>
              
	</div>
</div>
<style>
.bold {font-weight:700}
</style>
<script>

	/*
    document.addEventListener("DOMContentLoaded", function(){
        var element = document.querySelector('.project-image');
        element.style.height = element.offsetHeight;
    });
	*/

</script>
@endif