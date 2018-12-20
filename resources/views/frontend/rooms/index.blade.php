@extends('layouts.master-roomslist2')
@section('title','RoomLook - Комнаты')
@section('seo_keywords', $type->seo_keywords)
@section('seo_description', $type->seo_description)
@section('header-menu') 
<style>
aside {
    width: 220px;
    display: inline-block;
    float: left; 
    min-height: 10px;
    position: absolute;
    left: -220px;
    top: 0;
}
aside > div {
    background: #fff;
    padding: 20px;
    width: 100%;
    max-width: 195px;
}
aside > div h2 {
    font-size: 23px;
    line-height: 28px;
    margin-bottom: 10px;
}
.ajax-tag2 {
    opacity: 0; 
}
.ajax-tag2.active {
    opacity: 1; 
}
</style>
 
    <div class="col-xs-12 visible-xs margin-top-10"> 
            <ul class="list-inline room-selects"> 
                <li>
                <div class="dropdown rooms-dropdown">
                    <button class="dropdown-toggle c_clear_btn" type="button" id="roomDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span>{{ trans('frontend.common.room') }}</span> <i class="glyphicon glyphicon-triangle-bottom"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="roomDropDown">
                        <?php $i = 0; 
                        $n =  $roomTypes->count() - 1;?>
                        @foreach($roomTypes as $roomType)
                            <li>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $roomType->id }}" data-roomtype-id="{{ $roomType->id }}">{{ $roomType->name }}</a>
                            </li> 
                        @endforeach 
                    </ul>
                </div>
                </li>
                <li>
                <div class="dropdown style-dropdown">
                    <button class="dropdown-toggle c_clear_btn" type="button" id="styleDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span>{{ trans('frontend.common.style') }}</span> <i class="glyphicon glyphicon-triangle-bottom"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="styleDropDown">
                        <?php $i = 0; 
                        $n =  $styles->count() - 1;?>
                         @foreach($styles as $s)
                                    <li class="{{ isset($style) && $style['id'] == $s->id ? 'active' : '' }}">
                                        <a href="{{route('frontend.room.index',['room_type_id'=>$type->id,'room_style_id'=>$s->id])}}" >{{ $s->name }}</a>
                                        }
                                    </li>
                                @endforeach
                       
                    </ul></li>
                    </ul>
        </div>
    </div>
@stop
@section('content')

<section class="mobile" style="padding:20px 0;">
    <div class="container-fluid">
<!--<section id="main" class="container rooms-page room-wrapper">-->
                <div class="row">
				
					<div class="breadcumbs" style="display:block;margin:15px 0;">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a> >
                        <a href="#">{{ $type->name }}</a>
                    </div>
									
                <!-- <div class="container-fluid"> -->
                    <div class="room-inside-wrapper">
                    <!-- <div class="row filter-toggle-holder visible-xs">
                        <div class="col-md-12 text-right">
                            <button class="filter-toggler">Фильтр</button>
                        </div>
                    </div> -->
					
					 
					
                            <div class="catalog-header hidden-xs"> 
                                <div class="col-md-12 text-right layers" data-item-element="room" data-body-element=".catalog-body">
                                    <ul class="list-inline">
                                       <!--  <li>
                                        <a href="/f/room/?room_type_id={{-- $type->id --}}&page={{-- $request->page --}}&view=1" class="green-link c_clear_btn c_btn_2column active"  >
                                        
                                                <i class="flaticon-square-shape-shadow"></i>
                                          
                                            </a>
                                        </li>
                                        -->
                                        <li>
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/moz?room_type_id={{ $type->id }}"  class="green-link c_clear_btn c_btn_2column" >
                                                <i class="flaticon-square"></i>
                                            

                                            </a>
                                        </li>
                                       
                                        <!-- <li>
                                        <a href="/f/room/?room_type_id={{-- $type->id --}}&page={{-- $request->page --}}&view=3"  >
                                                
                                            <button class="green-link @if (!\Input::has('view') || \Input::get('view') == 3) active @endif c_clear_btn c_btn_listview"   data-layer-type="row" data-layer-column="list">
                                                <i class="flaticon-signs"></i>
                                            </button>

                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                                
                            </div>
					

							
							<h1 class="project-title"><a href="/ru/project/s/251">{{ $type->name }}</a></h1>
							<p class="project-desc"></p>
							<div class="project-wrapper"></div>					
					
<div style="position:relative">					
<aside>
	<div class="sidebar"> 
		<h2>{{ trans('frontend.common.room') }}</h2>
		<ul>   
            @foreach($roomTypes as $roomType)
                <li class="{{ $type->id == $roomType->id ? 'active' : '' }}">
                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $roomType->id}}&room_style_id={{ isset($style) ? $style['id']  : '' }}&view={{ $request->view }}">{{ $roomType->name }}</a>
                </li>
            @endforeach
        </ul>
		
		<h2 style="margin-top:25px;">{{ trans('frontend.common.style') }}</h2>
		<ul>
                                @foreach($styles as $s)
                                    <li class="{{ isset($style) && $style['id'] == $s->id ? 'active' : '' }}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $type->id}}&room_style_id={{ $s->id }}" >{{ $s->name }}</a>
                                    </li>
                                @endforeach
		</ul> 
</aside>		

			
							
							
                    <!-- <div class="container"> -->
                        <div id="catalog" class="rooms-list"> 
						<?php //print_r($rooms); ?>
							
                            <?php $countItem = 1 ?>
                            @if (\Input::has('view')) 
                            <?php $countItem = \Input::get('view'); ?>

                            @endif
                            <!--<div class="catalog-body list-group  rooms " data-count-item="1" >-->
                            <div class="catalog-body list-group" data-count-item="1" >
							 
                                @if (\Input::get('view') == 3)
                                <div class="listview @if (\Input::get('view') != 3) hidden @endif">
                                    @foreach ($rooms as $room)
                                        <?php /* @include('partials.room') */?>
                                    @endforeach
                                </div>
                                @else
                                <div class="gridview @if (\Input::get('view') == 3) hidden @endif">
                                    @foreach ($rooms as $room)
                                        @include('parts.rooms.mb-rooms', ['rooms' => $rooms])
										<div id="gallery{{ $room->id }}" class="gallery"></div>	
                                    @endforeach
                                </div>
                                @endif
								
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div> 
						
                                <div class="text-center">
                                    {!! $rooms->render() !!}
                                </div>
						
						<!--		 
                        <div class="text-center">  
                            @include('pagination', ['paginator' => $rooms])
                        </div>
						-->
						
                    </div>
</div>
                    
                    </div>
                </div>
                  <div class="clear"></div>
            </section>
			
<section class="desktop" style="padding:20px 0;">
    <div class="container">
<!--<section id="main" class="container rooms-page room-wrapper">-->
                <div class="row">
				
					<div class="breadcumbs" style="display:block;margin:15px 0;">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a> >
                        <a href="#">{{ $type->name }}</a>
                    </div>
									
                <!-- <div class="container-fluid"> -->
                    <div class="room-inside-wrapper">
                    <!-- <div class="row filter-toggle-holder visible-xs">
                        <div class="col-md-12 text-right">
                            <button class="filter-toggler">Фильтр</button>
                        </div>
                    </div> -->
					
					 
					
                            <div class="catalog-header hidden-xs"> 
                                <div class="col-md-12 text-right layers" data-item-element="room" data-body-element=".catalog-body">
                                    <ul class="list-inline">
                                       <!--  <li>
                                        <a href="/f/room/?room_type_id={{-- $type->id --}}&page={{-- $request->page --}}&view=1" class="green-link c_clear_btn c_btn_2column active"  >
                                        
                                                <i class="flaticon-square-shape-shadow"></i>
                                          
                                            </a>
                                        </li>
                                        -->
                                        <li>
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/moz?room_type_id={{ $type->id }}"  class="green-link c_clear_btn c_btn_2column" >
                                                <i class="flaticon-square"></i>
                                            

                                            </a>
                                        </li>
                                       
                                        <!-- <li>
                                        <a href="/f/room/?room_type_id={{-- $type->id --}}&page={{-- $request->page --}}&view=3"  >
                                                
                                            <button class="green-link @if (!\Input::has('view') || \Input::get('view') == 3) active @endif c_clear_btn c_btn_listview"   data-layer-type="row" data-layer-column="list">
                                                <i class="flaticon-signs"></i>
                                            </button>

                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                                
                            </div>
					

							
							<h1 class="project-title"><a href="/ru/project/s/251">{{ $type->name }}</a></h1>
							<p class="project-desc"></p>
							<div class="project-wrapper"></div>					
					
<div style="position:relative">					
<aside>
	<div class="sidebar"> 
		<h2>{{ trans('frontend.common.room') }}</h2>
		<ul>   
            @foreach($roomTypes as $roomType)
                <li class="{{ $type->id == $roomType->id ? 'active' : '' }}">
                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $roomType->id}}&room_style_id={{ isset($style) ? $style['id']  : '' }}&view={{ $request->view }}">{{ $roomType->name }}</a>
                </li>
            @endforeach
        </ul>
		
		<!--$type->id-->
		
		<h2 style="margin-top:25px;">{{ trans('frontend.common.style') }}</h2>
		<ul>
                                @foreach($styles as $s)
                                    <li class="{{ isset($style) && $style['id'] == $s->id ? 'active' : '' }}">
                                        <a href="?room_style_id={{ $s->id }}" >{{ $s->name }}</a>
                                    </li>
                                @endforeach
		</ul> 
</aside>		

			 
                        <div id="catalog" class="rooms-list">  
							
                            <?php $countItem = 1 ?>
                            @if (\Input::has('view')) 
                            <?php $countItem = \Input::get('view'); ?>

                            @endif 
                            <div class="catalog-body list-group rooms" data-count-item="1" >
							
                                @if (\Input::get('view') == 3)
                                <div class="listview @if (\Input::get('view') != 3) hidden @endif">
                                    @foreach ($rooms as $room)
                                        @include('partials.room')
                                    @endforeach
                                </div>
                                @else
                                <div class="gridview @if (\Input::get('view') == 3) hidden @endif">
                                    @foreach ($rooms as $room)
                                        @include('partials.room-grid', ['rooms' => $rooms])
                                    @endforeach
                                </div>
                                @endif
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div> 
						
                                <div class="text-center">
                                    {!! $rooms->render() !!}
                                </div> 
						
                    </div>
					
					<div class="tgl"> 
					<?php
					
					$string = strip_tags($type->seo_description);
					$string = substr($string, 0, 700);
					$string = rtrim($string, "!,.-");
					$string = substr($string, 0, strrpos($string, ' '));
					echo $string."… ";
					
					?>
					</div>
					 
					<div class="tgl" style="display:none;"> 
					{!! $type->seo_description !!}
					</div>
					
					<div style="text-align:center;">
					<a href="#" data-room-tab="tgl" class="tgl-a tgl cst-link">Развернуть</a>
					<a href="#" data-room-tab="tgl" class="tgl-a tgl cst-link" style="display:none;">Свернуть</a>
					</div>
					
</div>
                    
                    </div>
                </div>
                  <div class="clear"></div>
            </section>
 
    </div> 
    </div> 
@endsection

@section('script') 
<script>
	$('.tgl-a').on('click', function(e) {
		e.preventDefault();
		var clas = $(this).attr('data-room-tab');
		 
		$('.' + clas).toggle();
	});
	
	
    $(function() {
		
        $(".custom-ajax-button").on("click", function(e) { 

            e.preventDefault();
            
            var url = $(this).attr("href");


            $.ajax({
                url,
                dataType: 'json',
                type: 'get',
                success: function(res) {
                    if (res.status == 'success') {

                        window.location.reload();

                    }
                }
            });


        });
		
    });
		
</script>
@if (\Request::has('top'))
<script>
    $(function() {
        $(document).scrollTop({{ \Request::get('top') }});
    });
</script>
@endif
@stop

