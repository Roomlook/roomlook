@extends('layouts.master-glav')
<?php /*@extends('layouts.master8')*/ ?>
@section('title','RoomLook')
@section('body-class', 'project-page')
@section('seo_keywords', $project->seo_keywords)
@section('seo_description', $project->seo_description)
@section('content') 
<section class="mobile">
    <div class="container-fluid">
        <div class="row"> 
		<div class="breadcumbs" style="display:block;margin:15px 0;">
                <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> >
                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{ trans('frontend.common.projects') }}</a> >
                <a href="#">{{ $project->name }}</a>
		</div> 
		</div>
        <div class="row"> 
		<h1 class="project-title">{{ $project->name }}</h1>
        <p class="single-project-sd">{{ $project->short_desc }}</p>
		
        <div class="row">
            <div class="catalog">			 
                <div class="catalog-body list-group  rooms " data-count-item="1">

                    <div class="gridview">
                        @if (false)
                            <?php $checker = str_replace(' ', '', $project->description) == "" ? 6 : 4;
                            ?>
                            <div class="project project-single project-line col-md-12"
                                 data-room-id="{{ $project->rooms()->first()->id }}"
                                 style="background-image: url(/{{ $project->getFLImage()->imagePath()  }})">
                                <div class="dark-bg row">

                                    <div class="col-sm-12">
                                        <h2 class="text-center">{{ $project->name }}</h2>
                                    </div>
                                    <div class="col-sm-{{ $checker }} col-xs-{{ $checker }} ">
                                        <h4 class="text-center"><i class="glyphicon glyphicon-user"
                                                                   style="margin-top: 15px; font-size: 25px;color: #fff;"></i><br/>{{ $project->author->user->name }}
                                        </h4>
                                    </div>

                                    <div class="col-sm-{{ $checker }}  col-xs-{{ $checker }}  ">
                                        <h4 class="text-center"><i class="glyphicon glyphicon-resize-full"
                                                                   style="margin-top: 15px; font-size: 25px;color: #fff;"></i><br/>{{ trans('frontend.common.square') }}
                                            : {{ $project->square }} {{ trans('frontend.common.kv') }}</h4>
                                    </div>
                                    @if ($checker == 4)
                                        <div class="col-sm-4 col-xs-4 text-center">
                                            {!! $project->description !!}

                                        </div>
                                    @endif
                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>
                            </div>
                    @endif
                    </div>
                    <div class="catalog-body list-group  rooms " data-count-item="1">
                        <div class="vertical-text-layer">
                            <div class="vertical-text">
                                <div>
                                    {{ trans('frontend.common.designer') }} <a
                                            href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a> @if($project->photograph)
                                            @if ($project->photograph->user->name  != 'нет' && $project->photograph->user->name  != '001')
                                        / ФОТО <a
                                                href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->photograph ? $project->photograph->id : '' }}">{{ $project->photograph->user->name }}</a>@endif @endif
                                </div>
                            </div>
                        </div>
                        <div class="gridview"> 
                            <?php $i = 0; ?>
                            @foreach ($project->rooms()->orderBy('position', 'asc')->get() as $room)
							 
								<?php /*
                                @if ($showPicture != null && $showPicture->room_id == $room->id)
                                    @include('partials.room-grid', ['showPicture' => $showPicture, 'fromProject' => true] )
                                @else
                                    @include('partials.room-grid',['showPicture' => NULL,  'fromProject' => true])
                                @endif 
								*/ ?>
									 
                                @if ($showPicture != null && $showPicture->room_id == $room->id) 
									@include('parts.mb-project-room-tags', ['showPicture' => $showPicture, 'fromProject' => true] )
                                @else     
                                    @include('parts.mb-project-room-tags',['showPicture' => NULL,  'fromProject' => true])
                                @endif								
								
								<div id="gallery{{ $room->id }}" class="gallery"></div>	
								
								<?php /*
                                @if ($showPicture != null && $showPicture->room_id == $room->id)
                                    @include('partials.room-grid-new', ['showPicture' => $showPicture, 'fromProject' => true] )
                                @else
                                    @include('partials.room-grid-new',['showPicture' => NULL,  'fromProject' => true])
                                @endif  
								*/ ?>
								
                                @if ($i++ == 0)
                                    <div class="clear"></div>
                                    <div class="single-project-description">
                                        {{ strip_tags($project->description) }}
                                        <div class="vertical-text-mb">
                                            {{ trans('frontend.common.designer') }} <a
                                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a>
                                                    @if ($project->photograph)
                                            @if ($project->photograph->user->name  != 'нет' && $project->photograph->user->name  != '001')/ ФОТО <a
                                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->photograph->user->name }}</a>@endif @endif
                                        </div>
                                    </div>
                                @endif
								
                            @endforeach
							
							<!--СПИСОК КОМНАТ-->
								
                            <div class="clear"></div>
                        </div>
                        <div class="vertical-text-mb">
                            {{ trans('frontend.common.designer') }} <a
                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a>
                                    @if ($project->photograph)
                           @if ($project->photograph->user->name  != 'нет' && $project->photograph->user->name  != '001') / ФОТО <a
                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/photograph/s/{{ $project->photograph->id }}">{{ $project->photograph->user->name }}</a>@endif @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row" >
                <div class="col-md-12">
                    <h3 class="text-uppercase">{{ trans('frontend.common.similar-projects') }}</h3>
                    <div class="row">
                    @foreach($relativeProjects as $proj)
                        <div class="item col-md-6 col-xs-6 project-item-holder">
                            <h6>{{ $proj->name }}</h6><a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $proj->id }}" tabIndex="-1">
                            <div class="project-item">
                                
                                    <img src="/{{ $proj->pictures(1)->count() > 0 ? $proj->pictures(1)[0]->imagePath() : null }}" class="img-responsive" alt=""/>
                                
                            <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                            </div></a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
			
		</div>
	</div>
</section>
	
<div class="container"> 
<div class="row">
	<div class="breadcumbs" style="display:block;margin:15px 0;"> 
        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> >
        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{ trans('frontend.common.projects') }}</a> >
		<a href="#">{{ $project->name }}</a>
	</div> 
</div>		
</div>	
		
    <section id="main" class="desktop container rooms-page" style="margin-top:30px;"> 
        <div class="row single-project"> <div class="catalog"> 
                <div class="catalog-header row">
                    <div class="col-md-12">
                        <h1 class="single-project-title">{{ $project->name }}</h1>
                        <p class="single-project-sd">{{ $project->short_desc }}</p>
                    </div>

                </div>
                <div class="catalog-body list-group  rooms " data-count-item="1">
                    <div class="gridview ">
                        @if (false)
                            <?php $checker = str_replace(' ', '', $project->description) == "" ? 6 : 4;
                            ?>
                            <div class="project project-single project-line col-md-12"
                                 data-room-id="{{ $project->rooms()->first()->id }}"
                                 style="background-image: url(/{{ $project->getFLImage()->imagePath()  }})">
                                <div class="dark-bg row">

                                    <div class="col-sm-12">
                                        <h2 class="text-center">{{ $project->name }}</h2>
                                    </div>
                                    <div class="col-sm-{{ $checker }} col-xs-{{ $checker }} ">
                                        <h4 class="text-center"><i class="glyphicon glyphicon-user"
                                                                   style="margin-top: 15px; font-size: 25px;color: #fff;"></i><br/>{{ $project->author->user->name }}
                                        </h4>
                                    </div>

                                    <div class="col-sm-{{ $checker }}  col-xs-{{ $checker }}  ">
                                        <h4 class="text-center"><i class="glyphicon glyphicon-resize-full"
                                                                   style="margin-top: 15px; font-size: 25px;color: #fff;"></i><br/>{{ trans('frontend.common.square') }}
                                            : {{ $project->square }} {{ trans('frontend.common.kv') }}</h4>
                                    </div>
                                    @if ($checker == 4)
                                        <div class="col-sm-4 col-xs-4 text-center">
                                            {!! $project->description !!}

                                        </div>
                                    @endif
                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>
                            </div>
                    </div>
                    @endif
                    <div class="catalog-body list-group  rooms " data-count-item="1">
                        <div class="vertical-text-layer">
                            <div class="vertical-text">
                                <div>
                                    {{ trans('frontend.common.designer') }} <a
                                            href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a> @if($project->photograph)
                                            @if ($project->photograph->user->name  != 'нет' && $project->photograph->user->name  != '001')
                                        / ФОТО <a
                                                href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->photograph ? $project->photograph->id : '' }}">{{ $project->photograph->user->name }}</a>@endif @endif
                                </div>
                            </div>
                        </div>
                        <div class="gridview">
                            <?php $i = 0; ?>
                            @foreach ($project->rooms()->orderBy('position', 'asc')->get() as $room)
							 
                                @if ($showPicture != null && $showPicture->room_id == $room->id)
                                    @include('partials.room-grid', ['showPicture' => $showPicture, 'fromProject' => true] )
                                @else
                                    @include('partials.room-grid',['showPicture' => NULL,  'fromProject' => true])
                                @endif
								
								<?php /*
                                @if ($showPicture != null && $showPicture->room_id == $room->id)
                                    @include('partials.room-grid-new', ['showPicture' => $showPicture, 'fromProject' => true] )
                                @else
                                    @include('partials.room-grid-new',['showPicture' => NULL,  'fromProject' => true])
                                @endif
								*/ ?>
								
                                @if ($i++ == 0)
                                    <div class="clear"></div>
                                    <div class="single-project-description">
                                        {!! $project->description !!}
                                        <div class="vertical-text-mb">
                                            {{ trans('frontend.common.designer') }} <a
                                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a>
                                                    @if ($project->photograph)
                                            @if ($project->photograph->user->name  != 'нет' && $project->photograph->user->name  != '001')/ ФОТО <a
                                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->photograph->user->name }}</a>@endif @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="clear"></div>
                        </div>
                        <div class="vertical-text-mb">
                            {{ trans('frontend.common.designer') }} <a
                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $project->author->id }}">{{ $project->author->user->name }}</a>
                                    @if ($project->photograph)
                           @if ($project->photograph->user->name  != 'нет' && $project->photograph->user->name  != '001') / ФОТО <a
                                    href="/{{ LaravelLocalization::getCurrentLocale() }}/photograph/s/{{ $project->photograph->id }}">{{ $project->photograph->user->name }}</a>@endif @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row" >
                <div class="col-md-12">
                    <h3 class="text-uppercase">{{ trans('frontend.common.similar-projects') }}</h3>
                    <div class="row">
                    @foreach($relativeProjects as $proj)
                        <div class="item col-md-6 col-xs-6 project-item-holder">
                            <h6>{{ $proj->name }}</h6><a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $proj->id }}" tabIndex="-1">
                            <div class="project-item">
                                
                                    <img src="/{{ $proj->pictures(1)->count() > 0 ? $proj->pictures(1)[0]->imagePath() : null }}" class="img-responsive" alt=""/>
                                
                            <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                            </div></a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>


        </div>
        <div class="clear"></div>
    </section>
    <!-- <div id="save-position" {{-- @if (\Request::cookie('room_save_position')) class="hidden" @endif --}}title="{{-- trans('frontend.common.save-here') --}}">
        <button class="c_btn_transparent"><i class="flaticon-save"></i></button>
    </div> -->
    {{--
        <!-- <div id="return-position" title="{{ trans('frontend.common.back-position') }}" @if (!\Request::cookie('room_save_position')) class="hidden" @endif>
                <a href="{{ \Request::cookie('room_save_position') }}" class="c_btn_transparent">{{ trans('frontend.common.back-position') }}</a>
                <button class="c_btn_transparent">
                    &times;
                </button> -->--}}
    </div>
@endsection 
@section('script')

    <script>
        $(function () {

            @if (\Request::has('top'))
            $(document).scrollTop({{ \Request::get('top') }});
                    @endif
                    @if ($showPicture != null)
            var pictureId = {{ $showPicture->id }};
            var picture = $(".room .item[data-picture-id=" + pictureId + "]");
            // console.log(picture);
            $('html,body').animate({
                    scrollTop: picture.offset().top
                },
                'slow');
            @endif
            setTimeout(function() {
                $('.gridview .save-btn').removeClass('hidden');
            } ,2000)
        });


    </script>
@stop


