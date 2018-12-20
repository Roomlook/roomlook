@extends('layouts.master-glav')
@section('title','RoomLook')
@section('content')
<style>
    @media (max-width: 767px) {
		
		#main {padding:0 15px;}
		
        .project-image-slide {
            height: 180px;
        }
        .project-block {
            box-shadow: none !important;
            padding: 0px !important;
            /*background: transparent !important;*/
        }
        .project-block > .tempcl {
            background: transparent !important; 
            height: auto !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            box-shadow: none !important;
        } 
        td {
            width: 100% !important;
            display: flex;
        }

    }
    
    @media (min-width: 768px) and (max-width: 1024px) {
        .project-block > div {
            height: auto !important;
        }
    }
    @media (max-width: 1459px) {
        .idea-item {
            padding-right: 5px !important;
            padding-left: 5px !important;
        }
    }
    .idea-item {
        height: 100%;
    }
    td > div {
        position: relative;
        height: 100%;
    }
    .s2x2 {
        padding-bottom: 120px;
    }
    .s2x2, .s2x1 {
        padding-top: 100px;
    }
    .category-image {
        border-radius: 0px;
    }
    .item.pg-items img{
        width: 100%;
    }
    .no-grad:before {
        background: none !important;
    }
    .pos-abs {
        position: absolute;
        bottom: 5px;
        right: 15px;
        left: 15px;
        text-align: center;
    }
    .pos-abs a {
        border: none !important;
        color: #676767;
        font-size: 27px;
    }
    .boxsh {
        -webkit-box-shadow: 5px 5px 10px 0px rgba(153,153,153,1);
        -moz-box-shadow: 5px 5px 10px 0px rgba(153,153,153,1);
        box-shadow: 5px 5px 10px 0px rgba(153,153,153,1);
    }
    .boxsh-s {
        -webkit-box-shadow: 1px -1px 10px 1px rgba(153,153,153,1);
        -moz-box-shadow: 1px -1px 10px 1px rgba(153,153,153,1);
        box-shadow: 1px -1px 10px 1px rgba(153,153,153,1);
    }
    .link-hover:hover, .hr-link:hover, .cst-link:hover {
        border-color: #8404dd !important;
        background: #8404dd;
        color: white;
    }
    .link-hover, .hr-link, .cst-link {
        transition: .5s;
    }
    .project-block {
        margin-bottom: 20px;
    }
    .margin-left-10 {
        margin-left: 20px;
    }
    .p-center {
        padding: 0px 20px;
    }
</style>


 
<section class="mobile">
    <div class="container-fluid">
        <div class="row">
		
		<h1 class="mb-title">{{ trans('frontend.common.new-projects') }}</h1>
		<div class="project-wrapper">
            <div class="project-content">
            @foreach ($projects2 as $key => $project) 
			<div style="position:relative;margin-bottom:13px;">
            <img src="/images/projects/{{ $project->cropimage }}" class="img-responsive">
			
                                <div class="project-name" style="">
                                    <h1 class="project-title" style="width:99%;padding:0;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" style="color:#fff;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 100;
    line-height: 28px;
    font-size: 28px;">
                                        @if ($project->name)
                                            {{ $project->name }}
                                        @else
                                            {{ $project->name }}
                                        @endif
                                        </a>
                                    </h1>
                                    @if (isset($project->author->user->name) and $project->author->user->name != null)
                                    <p class="project-desc" style="color:#fff;">{{ trans('frontend.common.designer') }} <strong>{{ $project->author->user->name }}</strong></p>
                                    @endif
                                </div>  
								
			</div>
            @endforeach
			</div>
		</div>
		
		<a class="mb-more" href="/projects">Смотреть больше проектов</a>
		
		</div>
		
        <div class="row">
		
		<h1 class="mb-title">{{ trans('frontend.common.posts') }}</h1>
		<div class="project-wrapper">
            <div class="project-content"> 
            @foreach ($articles2 as $key => $project)
			<div style="position:relative;margin-bottom:13px;">
            <img src="/images/papers/{{ $project->images }}" class="img-responsive">
			
                                <div class="project-name">
                                    <h1 class="project-title" style="width:99%;padding:0;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" style="color:#000;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 100; 
    line-height: 26px;
    font-size: 26px;">{{ $project->name }}</a>
                                    </h1>
                                    @if (isset($project->author->user->name) and $project->author->user->name != null)
                                    <p class="project-desc" style="color:#fff;">{{ trans('frontend.common.designer') }} <strong>{{ $project->author->user->name }}</strong></p>
                                    @endif
                                </div>  
								
			</div>
            @endforeach
			</div>
		</div>
		
		<a class="mb-more" href="/articles">Смотреть больше статей</a>
		
		</div>
		
<div class="row">
	<h1 class="mb-title">{{ trans('frontend.common.selection-furniture') }}</h1>
	@include('parts.mb-room-tags', ['room' => $room])
    <p>{{ $room->body }}</p>
	<div class="gallery"></div>	
</div>
		 
        <div class="row">
		<h1 class="mb-title">{{ trans('frontend.common.catalog') }} товаров</h1>
		@foreach($catalogs as $key => $pcategory)		
        <?php
        	$href = 'room?room_type_id='. $pcategory->id ;
        	$href = preg_replace ('/\?room_type_id=11(&.*?)?$/i', '/garderob', $href);
        	$href = preg_replace ('/\?room_type_id=12(&.*?)?$/i', '/stolovaya', $href);
        	$href = preg_replace ('/\?room_type_id=1(&.*?)?$/i', '/kitchen', $href);
        	$href = preg_replace ('/\?room_type_id=2(&.*?)?$/i', '/vannaya', $href);
        	$href = preg_replace ('/\?room_type_id=3(&.*?)?$/i', '/spalnya', $href);
        	$href = preg_replace ('/\?room_type_id=4(&.*?)?$/i', '/gostinaya', $href);
        	$href = preg_replace ('/\?room_type_id=5(&.*?)?$/i', '/kabinet', $href);
        	$href = preg_replace ('/\?room_type_id=6(&.*?)?$/i', '/detskaya', $href);
        	$href = preg_replace ('/\?room_type_id=9(&.*?)?$/i', '/lestnitsa', $href);
        ?>
		@if ($key == 0 || $key == 1 || $key == 2)
								<div class="col-xs-4" style="padding:2px;">
                                    <div class="{!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!};margin:0;height:150px;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">	
		@if ($key == 0) 
		<div class="small-project no-grad category-image" style="background-image: url(/images/mb-project-04.png); height: 100%;
    background-size: 1000px;
    background-position: center;">
		@elseif ($key == 1)
		<div class="small-project no-grad category-image" style="background-image: url(/images/mb-project-03.png); height: 100%;
    background-size: 1000px;
    background-position: center;">
		@elseif ($key == 2)
		<div class="small-project no-grad category-image" style="background-image: url(/images/mb-project-02.png); height: 100%;
    background-size: 1000px;
    background-position: center;"> 
		@endif 
                                                    
                                                </div></a>
												<!--
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                                        <div ></div>
                                                    </a>
                                                </div>
												-->
                                            </div>
                                        </a>
                                    </div>
                                </div>
		@elseif ($key == 3)
								<div class="col-xs-8" style="padding:2px;">
                                    <div class="{!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!};margin:0;height:150px;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
												<div class="small-project no-grad category-image" style="background-image: url(/images/mb-project-01.png); height: 100%;
    background-size: 1000px;
    background-position: center;">
                                                    
                                                </div></a> 
                                            </div>
                                        </a>
                                    </div>
                                </div>
		@elseif ($key == 4)
								<div class="col-xs-4" style="padding:2px;">
								<div class="col-md-12 category-item" style="margin:0;height: 150px;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">
								<div class="small-project no-grad category-image" style="background-image: url(/images/mb-project-more.png); height: 100%;
    background-size: 1000px;
    background-position: center;">
                                                    
                                                </div></a> 
                                </div>
                                </div>
		@elseif ($key == 5)
		 
		@endif 
        @endforeach 
		</div>
		
		
        <div class="row">
		<h1 class="mb-title">{{ trans('frontend.common.rooms') }}</h1>
		
		
		
		@foreach($roomTypes as $key => $pcategory) 
		                            <?php
		                            	$href = 'room?room_type_id='. $pcategory->id ;
		                            	$href = preg_replace ('/\?room_type_id=11(&.*?)?$/i', '/garderob', $href);
		                            	$href = preg_replace ('/\?room_type_id=12(&.*?)?$/i', '/stolovaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=1(&.*?)?$/i', '/kitchen', $href);
		                            	$href = preg_replace ('/\?room_type_id=2(&.*?)?$/i', '/vannaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=3(&.*?)?$/i', '/spalnya', $href);
		                            	$href = preg_replace ('/\?room_type_id=4(&.*?)?$/i', '/gostinaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=5(&.*?)?$/i', '/kabinet', $href);
		                            	$href = preg_replace ('/\?room_type_id=6(&.*?)?$/i', '/detskaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=9(&.*?)?$/i', '/lestnitsa', $href);
		                            ?>
		@if ($key == 0 || $key == 1 || $key == 2 || $key == 3 || $key == 4)
								<div class="col-xs-6" style="padding:2px;">
							
                            <div class="{!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="margin:0;height:150px;">
                            
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? 'margin-top: 0px' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
										<div class="small-project grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }});background-size: 300px;height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav" style="
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    top: 50%;
    height: 30px;
    margin-top: -15px;
    text-align: center;">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name link-hover" style="
     
    padding: 0.8rem 1.5rem;
	font-weight:100;
    font-size: 22px;
    color: #fff;">{{ $pcategory->name }}</a>
                                        </div>
										<!--
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                <div ></div>
                                            </a>
                                        </div>
										-->
                                    </div>
                                </a>
                            
                            </div>
							
								</div> 
		@elseif ($key == 5)
		@endif
        @endforeach
		 
					<div class="col-xs-6" style="padding:2px;height:150px;">
						<div class="{!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="margin:0;height:150px;">
                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"> 
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room">
								<div class="small-project grad category-image" style="background-image: url(/images/mb-room-more.png); 
    background-size: 1300px;
    background-position: center;height: 100%;">
                                </div></a>
                        </div>
                    </div> 
		
		</div>
		
								
	</div>
</section>








    <section id="main" class="desktop" style="background:none;">
        <div id="content" style="padding:0;">
            <div class="container" style="padding-top:30px;">
                <div class="rooms homepage-rooms " data-count-item="1">
                    <div class="row"> 
					
                        @foreach ($projects as $key => $project) 
                            <div data-aos="zoom-in-up" class="col-md-12 hover pqrw" style="padding:0;" data-room-id="{{ $project->rooms()->first()->id }}">
							
                        <h1 class="margin-left-10" style="
    position: absolute;
    z-index: 1;
    background: #7a4b94;
    padding: 10px 20px;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 100;
    border-radius: 5px;
    top: 20px;
    left: 0px;">{{ trans('frontend.common.new-projects') }}</h1>  
	
                                <div class="project-wrapper">
                                    <div class="project-content">
                                        <?php $pic = $project->pictures(10, [], false);?>
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                        <div class="project-image col-md-12 project-image-slide">
                                            

                                            <div class="item projectSS" >
                                                <div class="project-image-el" >
                                                <img src="/images/projects/{{ $project->cropimage }}" class="img-responsive">
                                                <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                                            </div></div>
									 
                                        </div>
                                        </a>
                                    </div>
                                </div> 
                                <div class="project-name" style="position:absolute;bottom:10px;left:10px;width:320px; 
							background: #666;
							padding: 10px 20px;">
                                    <h1 class="project-title" style="width:99%;padding:0;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" style="color:#fff;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 100;
    line-height: 28px;
    font-size: 28px;">
                                        @if ($project->name)
                                            {{ $project->name }}
                                        @else
                                            {{ $project->name }}
                                        @endif
                                        </a>
                                    </h1>
                                    @if (isset($project->author->user->name) and $project->author->user->name != null)
                                    <p class="project-desc" style="color:#fff;">{{ trans('frontend.common.designer') }} <strong>{{ $project->author->user->name }}</strong></p>
                                    @endif
                                </div>                   
                            </div> 
                        @endforeach
						
						<div class="clear"></div>
						<div class="homepage-rooms-mini" style="display:flex;margin:0 -5px;">
						
                        @foreach ($projects2 as $key => $project)
						@if($key != 0)
                            <div class="homepage-rooms-item hover" data-aos="zoom-in-up" data-room-id="{{ $project->rooms()->first()->id }}" style="
                            padding-bottom: 0;
							margin:25px 5px;
							position:relative;
                            ">
                                <div data-aos="zoom-in-up">
                                    <div style="margin: 0px">
                                        <div> 
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                            <div class="mh-1 project-image">
                                               
                                                <div class="item projectSS" >
                                                    <div class="project-image-el" >
                                                    <img src="/images/projects/{{ $project->cropimage }}" class="img-responsive">
                                                    <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                                                </div></div>
											 
											</div>
                                            </a>
                                        </div>
                                    </div> 
                                    <div class="project-name" style="position:absolute;bottom:10px;left:10px;width:320px;
							background: #666;
							padding: 10px 20px;">
                                        <h1 class="project-title" style="width:99%;padding:0;">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" style="color:#fff;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 100;
    line-height: 28px;
    font-size: 28px;">
                                            @if ($project->name)
                                                {{ $project->name }}
                                            @else
                                                {{ $project->name }}
                                            @endif
                                            </a>
                                        </h1>
                                        @if (isset($project->author->user->name) and $project->author->user->name != null)
                                        <p class="project-desc" style="color:#fff;">{{ trans('frontend.common.designer') }} <strong>{{ $project->author->user->name }}</strong></p>
                                        @endif
                                    </div>   
                                </div>              
                            </div> 
						@endif
                        @endforeach
						
						<div data-aos="zoom-in-up" class="project-block" data-room-id="893" style="
							max-width: 190px;
							max-height: 248px;
							overflow: hidden;
							width: 33.333%;
                            background:#ababab url(/images/more-00.png) center center;
							background-size:100% 100%;
							margin:25px 5px;">
						<div>
						
							<a href="/projects">
							<img style="
	margin:0 auto;
    transform: translateY(35%); 
							" src="/images/more-01.png" class="img-responsive" />
							</a>
							
						</div>
						</div>
						
					</div>
                    </div>
						
<p class="p-center" style="margin-bottom:35px;">
		
</p>
                       
                    <div class="clear"></div>
                </div>
            </div>
			
<!--end projects-->
			
			<p><br /></p>
			<p><br /></p>
			<p><br /></p>
			
            <div class="container" style="padding:0;">
                <h1>{{ trans('frontend.common.posts') }}</h1>   
                <div style="margin:0 -40px;">
                    <div class="row">
                    
                        <table width=100% height=100%>
                        <?php $reserved = []; $k = 0; ?>

                        @for ($i = 0; $i < 3; $i++)
                            <tr>
                                @for ($j = 0; $j < 3; $j++)
                                    @foreach ($ideas as $idea)
								 
									
								 
                                        @if ($idea->position == $k + 1)
                                        <?php
                                            $sizes = explode('x', $idea->size);
                                            $reserved[] = $idea->position; 
                                            if ($sizes[0] > 1) {
                                                $reserved[] = $idea->position + 1;
                                            }
                                            if ($sizes[1] > 1) {
                                                $reserved[] = $idea->position + 3; 
                                            }
                                            if ($sizes[1] > 1 && $sizes[0] > 1) {
                                                $reserved[] = $idea->position + 4;
                                            }
                                         ?>
                                        <td colspan="{{ $sizes[0] }}" 
                                            rowspan="{{ $sizes[1] }}" style="width: {{ $sizes[0] * 33 }}%; padding: 10px;height: 100%;
    vertical-align: top;">
                                            @if ($idea->size == '2x1')
												
                                            <div style="height:100%;"> 
                                                <div class="big-project idea-item s{{ $idea->size }}" style="padding:60px!important;">
                                                    <div class="col-md-6">
                                                        <img src="{{ $idea->main_image }}" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>{{ $idea->category }}</h5>
                                                        <h3 style="">
                                                            <strong>
                                                            <a href="/article/{{ $idea->id }}" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}
                                                            </a>
                                                            </strong>
                                                        </h3>
                                                        <p>{{ $idea->short_desc }}</p>
                                                    </div>
                                                    <a href="/article/{{ $idea->id }}" class="cst-link">{{ trans($idea->link_text) }}</a>
                                                </div>
                                            </div>
											
                                            @else
												
                                            <div style="height:100%;"> 
                                                <div data-aos="zoom-in-up" class="small-project idea-item {{ 's'.$idea->size }}" 
												
												@if ($idea->size == '2x2')
													style="padding: 45px!important;">
												@endif
                                                @if ($idea->size == '1x1' or $idea->size == '1x2')
													style="padding: 30px 20px!important;">
												@endif
												
												@if ($i == 1)
													
												<a href="/articles">
													<img style="margin:30px 0;" src="/images/more-05.png" />
												</a>	
													
												@else
												
													@if ($idea->size == '1x1' or $idea->size == '1x2')
                                                        <div class="h-120px">
                                                            <h6>{{ $idea->category }}</h6>
                                                            <h4 style="
    margin: 5px 0;">
                                                                <strong>
                                                                <a href="/article/{{ $idea->id }}" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}</a>
                                                                </strong>
                                                            </h4>
                                                            <p>{{ substr($idea->short_desc, 0, 200) }}</p>
                                                        </div>
                                                    @else
                                                        <div class="margin-y-50">
                                                            <h5>{{ $idea->category }}</h5>
                                                            <h3>
                                                                <strong>
                                                                <a href="/article/{{ $idea->id }}" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}</a>
                                                                </strong>
                                                            </h3>
                                                            <p>{{ substr($idea->short_desc, 0, 200) }}</p>
                                                        </div>
                                                    @endif

													<?php if($i==0 && $j==0) { ?>				
                                                    <img src="{{ $idea->main_image }}" alt="" style="height:512px;" class="img-responsive">
													<?php }else{ ?>
                                                    <img src="{{ $idea->main_image }}" alt="" class="img-responsive">
													<?php } ?>
													
													
                                                    <a href="/article/{{ $idea->id }}" class="cst-link">{{ trans($idea->link_text) }}</a>
																									
												@endif
												
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                        @endif
                                    @endforeach
                                    @if (!in_array($k + 1, $reserved))
                                        
                                        <td colspan="1" rowspan="1">
                                            
                                        </td>
                                    @endif
        

                                    <?php $k++; ?>
                                @endfor
                            </tr>
                        @endfor
                    </table>


                    </div>
                    
                    <div class="row" style="margin-left: -12px; margin-top: 10px">
                        <p class="p-center" style="margin-bottom:35px;">
Самые актуальные материалы о дизайне интерьера и архитектуры, о вдохновении и новинках, о модных трендах, интервью с именитыми дизайнерами, а также проекты студий дизайна со всего мира и многое другое мы собрали для вас в рубрике «Статьи».
						</p>
                    </div>
                </div>
            </div>
			
<!---->
<div class="container padding-top-20 mn">
	<div class="">
		<div class="row" style="margin-left: -12px;"> 
    <div style="position:relative;margin-top:35px;padding-bottom:35px;"> 
                        <h1 class="margin-left-10" style="
    position: absolute;
    z-index: 1;
    background: #7a4b94;
    padding: 10px 20px;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 100;
    border-radius: 5px;
    top: 20px; 
    left: 0px;">{{ trans('frontend.common.selection-furniture') }}</h1>  
        @include('partials.room-grid-new', ['room' => $room])
        <p>{{ $room->body }}</p>
        <div class="row margin-top-30">
			<p class="p-center" style="margin-bottom:35px;">
Мы уверены, что правильно подобранная мебель способна преобразить и украсить весь дом, поэтому создали для вас платформу по подбору мебели, где необходимо указать форму, цвет, размер и комнату для ее использования, а мы предложим лучшие результаты.
			</p>      
		</div>
    </div>
		</div>
	</div>
</div>	
<!---->
	
			<style>
			.action-btns {display:none!important;}
			</style>
            <div class="container padding-top-20">
                <div style="margin:0 -20px">
                    <div>
                        <div>
						<h1 style="margin-top: 40px;" class="margin-left-10">{{ trans('frontend.common.catalog') }}</h1>
                        
						
						<div class="mob-view">
						
							<div style="margin:0 -5px;">
							
							@foreach($catalogs as $key => $pcategory)
		                            <?php
		                            	$href = 'room?room_type_id='. $pcategory->id ;
		                            	$href = preg_replace ('/\?room_type_id=11(&.*?)?$/i', '/garderob', $href);
		                            	$href = preg_replace ('/\?room_type_id=12(&.*?)?$/i', '/stolovaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=1(&.*?)?$/i', '/kitchen', $href);
		                            	$href = preg_replace ('/\?room_type_id=2(&.*?)?$/i', '/vannaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=3(&.*?)?$/i', '/spalnya', $href);
		                            	$href = preg_replace ('/\?room_type_id=4(&.*?)?$/i', '/gostinaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=5(&.*?)?$/i', '/kabinet', $href);
		                            	$href = preg_replace ('/\?room_type_id=6(&.*?)?$/i', '/detskaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=9(&.*?)?$/i', '/lestnitsa', $href);
		                            ?>
							@if ($key == 1)
								<div class="col-xs-6" style="padding:5px;">
                                    <div class="{!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;
    background-size: 100%;
    background-position: center;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
							@if ($key == 2)
								<div class="col-xs-6" style="padding:5px;">
                                    <div class="{!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;
    background-size: 100%;
    background-position: center;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @endforeach
							</div>
							<div>

							@foreach($catalogs as $key => $pcategory)
		                            <?php
		                            	$href = 'room?room_type_id='. $pcategory->id ;
		                            	$href = preg_replace ('/\?room_type_id=11(&.*?)?$/i', '/garderob', $href);
		                            	$href = preg_replace ('/\?room_type_id=12(&.*?)?$/i', '/stolovaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=1(&.*?)?$/i', '/kitchen', $href);
		                            	$href = preg_replace ('/\?room_type_id=2(&.*?)?$/i', '/vannaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=3(&.*?)?$/i', '/spalnya', $href);
		                            	$href = preg_replace ('/\?room_type_id=4(&.*?)?$/i', '/gostinaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=5(&.*?)?$/i', '/kabinet', $href);
		                            	$href = preg_replace ('/\?room_type_id=6(&.*?)?$/i', '/detskaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=9(&.*?)?$/i', '/lestnitsa', $href);
		                            ?>
							@if ($key == 0)
                                    <div class="col-xs-12 {!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;
    background-size: 100%;
    background-position: center;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            @endif
                            @endforeach
									
							</div>
						
						</div>
						
						
						<div class="comp-view">
							@foreach($catalogs as $key => $pcategory)
							
                            @if ($key == 6)
								
							<div class="col-xs-12 col-md-6 category-item" style="height: 230px;">
                                <div class="category-holder" style="background:#fff;height:100%;">
								<a href="/ru/room?room_type_id=25"> 
                                <div> 
									<img style="
    transform: translateY(-50%);
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -48px;" src="/images/more-04.png" />
									 
                                </div>
								</a>
                                </div>
                            </div>	
							
                            @else
							
                            @if ($key == 3)
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-xs-12 {!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;
    background-size: 100%;
    background-position: center;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @else
                            @if ($key == 0 or $key == 4)
                            <div class="col-md-5">
                                <div class="row">
                            @endif
                            @if($key == 2)
                                <div class="row">
                            @endif
                                    <div class="col-xs-12 {!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;
    background-size: 100%;
    background-position: center;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @if($key == 1)
                                    </div>
                                @endif
                                @if($key == 2)
                                    </div>
                                </div>
                                @endif
                            @endif
							
                            @endif 
                            
                            @endforeach
                        </div>
						
						
						
                        </div>

                        </div>

                    </div>
                    <div class="row">
                                <p class="p-center" style="
    margin-top: 25px;
    margin-bottom: 35px;">
Ищите мебель для гостиной, спальни, кухни или детской? Вас ждет обширный каталог мебели, сантехники, освещения, аксессуаров и многого другого от ведущих магазинов со всего мира.  Чтобы найти подходящую мебель, переходите в каталог и выбирайте все для уюта вашего дома, а мы подскажем магазин, где можно приобрести все понравившиеся товары, недалеко от вашего дома.
	</p> 
                          
                            </div>
                </div>
                </div>
                </div>
            <?php $pcategory = null; ?>
            <div class="container padding-top-20">
                <div class="">
                    <div class="row roomtype-categories">
                        <div>
							
							
							
							 
						<div class="mob-view">
							<div style="
    margin: 0 -5px 15px;
    display: block;
    height: 500px;"> 
							@foreach($roomTypes as $key => $pcategory)
		                            <?php
		                            	$href = 'room?room_type_id='. $pcategory->id ;
		                            	$href = preg_replace ('/\?room_type_id=11(&.*?)?$/i', '/garderob', $href);
		                            	$href = preg_replace ('/\?room_type_id=12(&.*?)?$/i', '/stolovaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=1(&.*?)?$/i', '/kitchen', $href);
		                            	$href = preg_replace ('/\?room_type_id=2(&.*?)?$/i', '/vannaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=3(&.*?)?$/i', '/spalnya', $href);
		                            	$href = preg_replace ('/\?room_type_id=4(&.*?)?$/i', '/gostinaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=5(&.*?)?$/i', '/kabinet', $href);
		                            	$href = preg_replace ('/\?room_type_id=6(&.*?)?$/i', '/detskaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=9(&.*?)?$/i', '/lestnitsa', $href);
		                            ?>
                            @if ($key == 1)
								<div class="col-xs-6" style="padding:5px;height:500px;">
							
                            <div class="{!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="height:500px;">
                            
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? 'margin-top: 10px' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name link-hover" style="
     
    padding: 0.8rem 1.5rem;
	font-weight:100;
    font-size: 27px;">{{ $pcategory->name }}</a>
                                        </div>
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                <div ></div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            
                            </div>
							
								</div>
                            @endif 
                            @if ($key == 2)
								<div class="col-xs-6" style="padding:5px;height:245px;margin-bottom:10px">
							
                            <div class="{!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="height:245px;">
                            
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? '' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name link-hover" style="
    
    padding: 0.8rem 1.5rem;
	font-weight:100;
    font-size: 27px;">{{ $pcategory->name }}</a>
                                        </div>
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                <div ></div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            
                            </div>
						
								</div>
                            @endif 
                            @if ($key == 3)
								<div class="col-xs-6" style="padding:5px;height:245px;">
							
                            <div class="{!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="height:245px;">
                            
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? '' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name link-hover" style="
 
    padding: 0.8rem 1.5rem;
	font-weight:100;
    font-size: 27px;">{{ $pcategory->name }}</a>
                                        </div>
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                <div ></div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            
                            </div>
						
								</div>
                            @endif 
                            @endforeach
								
							</div>
							
							@foreach($roomTypes as $key => $pcategory)
		                            <?php
		                            	$href = 'room?room_type_id='. $pcategory->id ;
		                            	$href = preg_replace ('/\?room_type_id=11(&.*?)?$/i', '/garderob', $href);
		                            	$href = preg_replace ('/\?room_type_id=12(&.*?)?$/i', '/stolovaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=1(&.*?)?$/i', '/kitchen', $href);
		                            	$href = preg_replace ('/\?room_type_id=2(&.*?)?$/i', '/vannaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=3(&.*?)?$/i', '/spalnya', $href);
		                            	$href = preg_replace ('/\?room_type_id=4(&.*?)?$/i', '/gostinaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=5(&.*?)?$/i', '/kabinet', $href);
		                            	$href = preg_replace ('/\?room_type_id=6(&.*?)?$/i', '/detskaya', $href);
		                            	$href = preg_replace ('/\?room_type_id=9(&.*?)?$/i', '/lestnitsa', $href);
		                            ?>
							@if ($key == 0)
                            <div class="col-xs-12 {!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="{!! $pcategory->styles !!}">
                          
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? 'margin-top: 10px' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name link-hover" style="
    border: 2px solid;
    padding: 0.8rem 1.5rem;
	font-weight:100;
    font-size: 27px;">{{ $pcategory->name }}</a>
                                        </div>
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                <div ></div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                         
                            </div>
                            @endif
                            @endforeach
							
						</div>
							
						
						
						 
						
						
						<div class="comp-view" style="
    margin: 0 -6px;">	
						<h1 style="margin-top: 10px; padding-bottom: 10px; margin-left: 12px;" class="margin-left-10">{{ trans('frontend.common.rooms') }}</h1>
							@foreach($roomTypes as $key => $pcategory)
							@if ($key == 4)
<div class="col-xs-12 col-md-4 col-md-4 category-item" style="height: 462px;">
<a href="/ru/room/kitchen"> 
    <div class="category-holder" style="height: 100%; "> 
		<div class="small-project grad category-image" style="background-image:url(/images/more-02.png);background-size:100% 100%;height:100%;">
            <img style="
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -76px;
    transform: translateY(-50%);" src="/images/more-03.png" />                               
        </div> 
	</div>
</a>                                
</div>
							@else
								
                            @if ($key != 2)
                            <div class="col-xs-12 {!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="{!! $pcategory->styles !!}">
                            @endif
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"> 
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? 'margin-top: 10px' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}"><div class="small-project grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name link-hover" style="
  
    padding: 0.8rem 1.5rem;
	font-weight:100;
    font-size: 27px;">{{ $pcategory->name }}</a>
                                        </div>
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                <div ></div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            @if ($key != 1)
                            </div>
                            @endif
                            
							@endif
                            @endforeach
                            <div class="row margin-top-30">
                                <p class="p-center" style="
    margin-top: 25px;
    margin-bottom: 35px;">
Источником вашего вдохновения могут стать эксклюзивные проекты именитых архитекторов и дизайнерских студий со всего мира, которые вы сможете использовать для обустройства своего дома мечты. Все проекты удобно распределены по комнатам, что упростит поиск и выбор определенного интерьера. 
	</p> 
                             
                            </div>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $('.project-image-slide').owlCarousel({
        autoplay: 1,
        dots: 0,
    });
</script>
@stop

