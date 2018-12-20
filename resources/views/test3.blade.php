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


 
<section class="mobile home">
    <div class="container-fluid">
        <div class="row">
		
		<h1 class="mb-title">{{ trans('frontend.common.new-projects') }}</h1>
		<div class="project-wrapper">
            <div class="mb-projects project-content"> 
            @foreach ($projects2 as $key => $project) 
			<div style="position:relative;margin-bottom:13px;">
			<a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
            <img src="/images/projects/{{ $project->cropimage }}" class="img-responsive">
			</a>
			
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
		<div class="mb-articles project-wrapper">
            <div class="project-content"> 
            @foreach ($articles2 as $key => $project)
			<div style="position:relative;margin-bottom:13px;">
            <img src="/images/papers/{{ $project->images }}" class="img-responsive">
			
                                <div class="project-name">
									<small>{{ $project->cname }}</small>
                                    <h1 class="project-title">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">{{ $project->name }}</a>
                                    </h1>
									{!! $project->anons !!} 
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
	<div id="gallery{{ $room->id }}" class="gallery"></div>	
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
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?catalog_tree={{$pcategory->id}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?catalog_tree={{$pcategory->id}}">	
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
                                            </div>
                                        </a>
                                    </div>
                                </div>
		@elseif ($key == 3)
								<div class="col-xs-8" style="padding:2px;">
                                    <div class="{!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!};margin:0;height:150px;">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?catalog_tree={{$pcategory->id}}">
                                            <div class="category-holder" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?catalog_tree={{$pcategory->id}}">
												<div class="small-project no-grad category-image" style="background-image: url(/images/mb-project-01.png); height: 100%;
    background-size: 180px;
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
						@if(isset($project->rooms()->first()->id))
                            <div data-aos="zoom-in-up" class="col-md-12 hover pqrw" style="padding:0;" data-room-id="{{ $project->rooms()->first()->id }}">
						@else
							 <div data-aos="zoom-in-up" class="col-md-12 hover pqrw" style="padding:0;" data-room-id="">
						@endif
							
                        <h1 class="margin-left-10" style="
    position: absolute;
    z-index: 1;
    background: rgba(122, 75, 148, 0.7); 
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
                                                <img class="lazyload" data-src="/images/projects/{{ $project->cropimage }}" class="img-responsive">
                                                <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                                            </div></div>
									 
                                        </div>
                                        </a>
                                    </div>
                                </div> 
                                <div class="project-name" style="background:<?php echo $project['color']; ?>;position:absolute;bottom:10px;left:10px;padding:10px 20px;">
							
                                    <h1 class="project-title" style="padding:0;">
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
							margin:10px 5px;
							position:relative;
                            ">
                                <div data-aos="zoom-in-up">
                                    <div style="margin: 0px">
                                        <div> 
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                            <div class="mh-1 project-image">
                                               
                                                <div class="item projectSS" >
                                                    <div class="project-image-el" >
                                                    <img class="lazyload" data-src="/images/projects/{{ $project->cropimage }}" class="img-responsive">
                                                    <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                                                </div></div>
											 
											</div>
                                            </a>
                                        </div>
                                    </div> 
                                    <div class="project-name" style="background:<?php echo $project['color']; ?>;position:absolute;bottom:10px;left:10px;
							padding: 10px 20px;">
                                        <h1 class="project-title" style="padding:0;">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}" style="color:#fff;
    font-family: 'Source Sans Pro', sans-serif!important;
    font-weight: 100;
    line-height: 28px;">
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
						
						<div data-aos="zoom-in-up" class="project-block hover" data-room-id="893" style="
							max-width: 190px; 
							overflow: hidden; 
                            background:#ababab url(/images/more-00.png) center center;
							background-size:100% 100%;
							margin:10px 5px;">
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
						
		<div class="row margin-top-30">				
			<p class="p-center" style="margin-bottom:35px;">
<span class="tgl2">Интересные идеи современного дизайна интерьера. Нынешний ритм жизни и слово спешка уже давно стали синонимами, ведь мы все время торопимся, стремимся и бежим куда-то вперед, поэтому именно дом, должен стать уютным гнездышком, куда хочется возвращаться после тяжелого дня, долгой командировки или просто с прогулки, чтобы наслаждаться каждой минутой пребывания в нем. Именно поэтому дизайнеры создают оригинальные проекты и воплощают их в жизнь в разных уголках земли. 

					<br />
					<br />
					<a href="#" data-room-tab="tgl2" class="tgl-a tgl2 cst-link" style="clear:both;margin:0 auto;">Развернуть</a> 
					
</span>
<span class="tgl2" style="display:none;">
Интересные идеи современного дизайна интерьера.
Нынешний ритм жизни и слово спешка уже давно стали синонимами, ведь мы все время торопимся, стремимся и бежим куда-то вперед, поэтому именно дом, должен стать уютным гнездышком, куда хочется возвращаться после тяжелого дня, долгой командировки или просто с прогулки, чтобы наслаждаться каждой минутой пребывания в нем. Именно поэтому дизайнеры создают оригинальные проекты и воплощают их в жизнь в разных уголках земли. <br /><br />
Наш гид-портал RoomLook это уникальное пространство потрясающих дизайнерских находок. Сайт, где собраны современные идеи дизайна интерьера со всего мира. Интересный, стильный, необычный – все это о дизайнерских проектах, которые вы можете использовать для создания своего дома мечты!

					<br />
					<br />
					<a href="#" data-room-tab="tgl2" class="tgl-a tgl2 cst-link" style="clear:both;margin:0 auto;display:none;">Свернуть</a>
					
</span>
			</p> 
		</div>
				
                    <div class="clear"></div>
                </div>
				 
            </div>
			
<!--end projects-->
<!--papers-->
			  
<div class="container" style="padding:0;">
	<h1>{{ trans('frontend.common.posts') }}</h1>   
	<div style="margin:0 -40px;">
		<div class="row" style="display:flex;min-height:850px;">
@foreach ($papers as $key => $p) 
@if($key == 0) 
	<div class="col-md-8">
		<div style="height:100%;padding:10px 0;">
		<div class="small-project idea-big idea-item">
            <h5>{{ $p->cname }}</h5> 
			<h3><strong>{{ $p->name }}</strong></h3>
            <center>{!! $p->anons !!}</center>
			<div class="thumb" style="text-align:center;">
				<img src="/images/papers/{{ $p->images2 }}" alt="" class="img-responsive">
			</div>
            <a href="/articles/{{ $p->cslug }}/{{ $p->slug }}" class="cst-link">перейти</a>
		</div>
		</div>
	</div>
@else
	<div class="col-md-4 lp5">
		<div style="height:60%;padding:10px 0;">
		<div class="small-project idea-small idea-item">
            <h5>{{ $p->cname }}</h5> 
			<h3><strong>{{ $p->name }}</strong></h3>
            <center>{!! $p->anons !!}</center>
			<div class="thumb">
				<img src="/images/papers/{{ $p->images2 }}" alt="" class="img-responsive">
			</div>
            <a href="/articles/{{ $p->cslug }}/{{ $p->slug }}" class="cst-link">перейти</a>
		</div>
		</div>
		<div style="height:40%;padding:10px 0;">
		<div class="small-project idea-item" style="
    display: flex;
    justify-content: center;
    align-self: center;">
			<div style="width:50%;margin:0 auto;
    display: flex;
    justify-content: center;
    align-self: center;">
			<a href="/articles">
			<img style="width:100%;" src="/images/more.png" />
			<h3 style="text-transform:uppercase;padding:0 20px;font-size:20px;">Смотреть все статьи</h3>
			</a>
			</div>
		</div>
		</div>
	</div>
@endif
@endforeach
		</div>					
		<div class="row margin-top-30" style="margin-left: -12px;">
			<p class="p-center" style="margin-bottom:35px;">
<span class="tgl2">Затеяли ремонт дома и еще не решили, каким будет его оформление?  Хотите учесть все детали и максимально использовать пространство, да так, чтобы оно соответствовало пожеланиям всех членов семьи, при этом было оригинальным и красивым?

					<br />
					<br />
					<a href="#" data-room-tab="tgl2" class="tgl-a tgl2 cst-link" style="clear:both;margin:0 auto;">Развернуть</a> 
					
</span>
<span class="tgl2" style="display:none;">
Затеяли ремонт дома и еще не решили, каким будет его оформление?  Хотите учесть все детали и максимально использовать пространство, да так, чтобы оно соответствовало пожеланиям всех членов семьи, при этом было оригинальным и красивым?<br /><br />
Мы собрали для вас самые актуальные материалы и красивые идеи стильного интерьера и архитектуры, статьи о вдохновении и новинках, о модных трендах, интервью со знаменитыми дизайнерами, советы архитекторов, а также проекты студий дизайна и многое другое в рубрике «Статьи».

					<br />
					<br />
					<a href="#" data-room-tab="tgl2" class="tgl-a tgl2 cst-link" style="clear:both;margin:0 auto;display:none;">Свернуть</a>
					
</span>
			</p> 
		</div>
	</div>
</div>
			
<!--end papers-->
<!---->

<div class="container padding-top-20 mn">
	<div class="">
		<div class="row" style="margin-left: -12px;"> 
    <div style="position:relative;"> 
                        <h1 class="margin-left-10" style="
    position: absolute;
    z-index: 1;
    background: rgba(122, 75, 148, 0.7); 
    padding: 10px 20px;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 100;
    border-radius: 5px;
    top: 20px; 
    left: 0px;">{{ trans('frontend.common.selection-furniture') }}</h1>  
        @include('parts.rooms.room-grid-new', ['room' => $room])
        <p>{{ $room->body }}</p>
        <div class="row margin-top-30">
			<p class="p-center" style="margin-bottom:5px;">
Мы уверены, что правильно подобранная мебель способна преобразить и украсить весь дом, поэтому создали для вас платформу по подбору мебели, где просматривая лучшие идеи дизайна интерьера и вдохновившись ими вы сможете выбрать частичку этого интерьера для своего дома, определив ценовую категорию и приобрести в близлежащем магазине.
Почувствуйте себя настоящим дизайнером!
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
						<h1 style="margin-top: 10px;" class="margin-left-10">{{ trans('frontend.common.catalog') }}</h1>
                        
						
						<div class="mob-view">
						
							<div style="margin:0 -5px;">
							
							@foreach($catalogs as $key => $pcategory)
		                            <?php
		                            	$href = 'catalog?room_type_id='. $pcategory->id ;
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
		                            	$href = 'catalog?catalog_tree='. $pcategory->id ;
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
		                            <?php
		                            	$href = 'catalog?catalog_tree='. $pcategory->id ;
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
							
                            @if ($key == 6)
								
							<div class="col-xs-12 col-md-6 category-item" style="height: 230px;">
                                <div class="category-holder" style="background:#fff;height:100%;">
								<a href="/catalog"> 
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
    margin-bottom: 5px;">
<span class="tgl">Предстоит ремонт, и вы ищите краску, лак, обои или мебель для гостиной, спальни, кухни, детской, а может вам необходимы современные и необычные аксессуары? Добро пожаловать на Roomlook!

					<br />
					<br />
					<a href="#" data-room-tab="tgl" class="tgl-a tgl cst-link" style="clear:both;margin:0 auto;">Развернуть</a> 
					
</span>
<span class="tgl" style="display:none;">
Предстоит ремонт, и вы ищите краску, лак, обои или мебель для гостиной, спальни, кухни, детской, а может вам необходимы современные и необычные аксессуары? Добро пожаловать на Roomlook!<br /><br />
Вас ждет обширный каталог отделочных материалов, мебели, сантехники, освещения, бытовой техники, декора и многого другого от ведущих магазинов со всего мира.  Чтобы найти подходящую мебель, переходите в каталог и выбирайте все для уюта вашего дома, а мы подскажем магазин, где можно приобрести все понравившиеся товары, недалеко от вашего дома.
 
					<br />
					<br />
					<a href="#" data-room-tab="tgl" class="tgl-a tgl cst-link" style="clear:both;margin:0 auto;display:none;">Свернуть</a>
					
</span>
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
    margin-bottom: 5px;">
Дизайнерские идеи оформления интерьера дома. 
Источником вашего вдохновения могут стать идеи интерьера в эксклюзивных проектах именитых архитекторов и дизайнерских студий со всего мира, которые вы сможете использовать для обустройства своего дома мечты. Все проекты удобно распределены по комнатам, что упростит поиск и выбор определенного интерьера.
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
	$('.tgl-a').on('click', function(e) {
		e.preventDefault();
		var clas = $(this).attr('data-room-tab');
		 
		$('.' + clas).toggle();
	});
</script>
<script>
    $('.project-image-slide').owlCarousel({
        autoplay: 1,
        dots: 0,
    });
</script>
@stop

