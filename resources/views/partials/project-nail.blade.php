
@if ($project->rooms->count() > 0)
<div class="project-block col-md-12" data-room-id="{{ $project->rooms()->first()->id }}">
    <h1 class="project-title"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">{{ $project->name }}</a></h1>
    <p class="project-desc">{{ $project->short_desc }}</p>
    <div class="project-wrapper">
        <div class="project-content">
            <?php   
                            $pic = $project->pictures(3);

                 ?>
            <div class="project-image col-md-6 project-image-slide" >
                    @foreach($pic as $p)
                    <div class="item projectSS"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" tabIndex="-1" data-product-id="{{ $p->id }}" class="popup-product-open green-link2"><div class="project-image-el" style="background-image: url(/{{ $p->imagePath() }})"></div></a></div>
                    @endforeach
            </div>
            <div class="project-text col-md-6 ">
                <div>
                    <h2>{{ trans('frontend.common.designer') }} <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a> @if ($project->designer) &nbsp;&nbsp; ФОТО <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->designer->id }}">{{ $project->designer->user->name }}@endif</a></h2>
                    <div class="project-descr">
                        {!! $project->description !!}
                    </div>
                    <p>
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" class="c_btn_transparent_green c_btn_medium">смотреть проект</a>
                    </p>
                </div>
                @if ($project->products()->count() > 0)
                    <div class="project-products">
                        <div class="text-right project-product-text">Подходящие товары для этого интерьера в твоем <a href="#" tabIndex="-1" data-toggle="modal" data-target=".city-modal">городе</a></div>
                        <div class="project-product-slider" >
                            @foreach($project->products() as $product)
                                <div class="item">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" tabIndex="-1" data-product-id="{{ $p->id }}" class="popup-product-open green-link2">
                                        <img src="/{{ $product->imagePath() }}" class="img-responsive" alt=""/>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endif
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