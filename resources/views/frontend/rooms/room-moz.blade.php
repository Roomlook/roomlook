@extends('layouts.master4')
@section('title','RoomLook')
@section('header-menu')

<style>
ol, ul {
    list-style: none; padding: 0; margin: 0;
}
aside {
    width: 200px;
    display: inline-block;
    float: left; 
    min-height: 10px;
    position: absolute;
    left: -200px;
    top: 0;
}
aside > div {
    background: #fff;
    padding: 20px;
    width: 100%;
    max-width: 180px;
}
aside > div h2 {
    font-size: 23px;
    line-height: 28px;
    margin-bottom: 10px;
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
                         @foreach($styles as $style)
                                    <li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{route('frontend.room.index',['room_type_id'=>$request->room_type_id,'room_style_id'=>$style->id])}}" >{{ $style->name }}</a>
                                    </li>
                                @endforeach
                       
                    </ul></li>
                    </ul>
        </div>
    </div>
@stop
@section('content')
            <section id="main" class="container rooms-page room-wrapper">
                <div class="row">
                <!-- <div class="container-fluid"> -->
                    <div class="breadcumbs" style="display:block;margin:15px 0;">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a> >
                        <a href="#">{{ $type->name }}</a>
                    </div>
					
					
					
                            <div class="catalog-header">
                                <h2 class="text-left text-uppercase">{{ $type->name }}</h2>
                                    <p>здесь собраны примеры проектов одих из лучших дизайнеров мира</p>
                                <div class="col-md-12 text-right layers" data-item-element="room" data-body-element=".catalog-body">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $request->room_type_id  }}&view=1"  class="green-link c_clear_btn c_btn_2column ">
                                                <img src="/images/squared.png" style="width: 32px; opacity: 0.5;">
                                               
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <button class="green-link c_clear_btn  c_btn_2column active" data-layer-type="column" data-layer-column="2">
                                                <i class="flaticon-square"></i>
                                            </button>
                                        </li> 
                                        -->
                                        <!-- <li>
                                            <a href="/f/room?room_type_id={{-- $request->room_type_id  --}}&view=3" class="green-link c_clear_btn c_btn_listview "  >
                                                <i class="flaticon-signs"></i>
                                            
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
                        <div class="" style="padding:0 10px;">
                            <h4>{{ trans('frontend.common.room') }}</h4>
                            <ul class="">
                                @foreach($roomTypes as $roomType)
                                <li class="{{ $request->room_type_id == $roomType->id ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/moz?room_type_id={{ $roomType->id }}&room_style_id={{ $request->room_style_id }}">{{ $roomType->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="divider"> 
                            <h4>{{ trans('frontend.common.style') }}</h4>
                            <ul class="">
                                <li>
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/moz?room_type_id={{ $request->room_type_id }}" >{{ trans('frontend.common.all') }}</a>
                                </li>
                                @foreach($styles as $style)
                                    <li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/moz?room_type_id={{ $request->room_type_id }}&room_style_id={{ $style->id }}" >{{ $style->name }}</a>
                                    </li>
                                @endforeach
                            </ul>  
                        <div class="clear"></div>
                        </div>
                    </aside>
                    <div id="catalog" class="rooms-list">
                        <div>
                           
                            <div class="catalog-body list-group  rooms "  >
                                
                                <div class="row puzzle-view">
                                    <div class="col-md-6 column-first"> 
										
										<?php $sum = 0; ?>
										<?php $i = 1; ?>
									
                                        @foreach($room1 as $room)
										
											<?php 
											
											//print_r($room->pictures());
											
											/*$picture = $room->pictures()->first(); ?>
											
											<?php $sum += (int)$picture->getHeight(0, ''); ?>
											
											<?php //if($i == count($room1)) echo $sum;
													
													$i++;*/  ?>
											
                                            @include('partials.room-grid2', array('small' => true, 'rooms' => $rooms ))
                                        @endforeach
                                    </div>
                                    <div class="col-md-6 column-second"> 
										
										<?php $sum = 0; ?>
										<?php $i = 1; ?>
										
                                        @foreach($room2 as $room)
										
											<?php /*$picture = $room->pictures()->first(); ?>
											
											<?php $sum += (int)$picture->getHeight(0, ''); ?>
											
											<?php //if($i == count($room1)) echo $sum;
													
													$i++;*/  ?>
													
                                            @include('partials.room-grid2',array('small' => true, 'rooms' => $rooms ))
                                        @endforeach
                                    </div>
                                   
                                </div>
                                <div class="text-center">
                                    {!! $rooms->render() !!}
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                       
                    </div>
                    </div>
                </div>
                  <div class="clear"></div>
            </section>
 
    </div>
@endsection

@section('script')
@if (\Request::has('top'))
<script>
    $(function() {
        $(document).scrollTop({{ \Request::get('top') }});
    });
</script>
@endif
<script>
 
    $(document).ready(function() {

		var h = 0, h2 = 0;
		
		$('.column-second').css('overflow', 'hidden');
		$('.column-first').css('overflow', 'hidden');
		
		$('.column-first .room').each(function(e) { 

			h = h + $(this).height();
			h2 = h2 + $('.column-second .room').eq(e).height();
		  
			//if(e==4) $('.column-second .room').eq(e).css('height', $(this).height());
		
		});
		
		if(h2 > h) { 
		
				var h3 = (h2 - h)/5;  
		
				//$('.column-second').css('height', h + 20);
		
			$('.column-second .room').each(function(e) {

				var cssval = {
					'height': $(this).height() - h3,
					'overflow': 'hidden'
				}
		
				$('.column-second .room').find('.room-slider-holder').eq(e).css(cssval);
		
			});
		}
		
		if(h > h2) { 
		
				var h4 = (h - h2)/5;  
		
				//$('.column-first').css('height', h + 20);
		
			$('.column-first .room').each(function(e) {

				var cssval = {
					'height': $(this).height() - h4,
					'overflow': 'hidden'
				}
		
				$('.column-first .room').find('.room-slider-holder').eq(e).css(cssval);
		
			});
		}
		
	});

//     function updateQueryStringParameter(uri, key, value) {
//       var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
//       var separator = uri.indexOf('?') !== -1 ? "&" : "?";
//       if (uri.match(re)) {
//         return uri.replace(re, '$1' + key + "=" + value + '$2');
//       }
//       else {
//         return uri + separator + key + "=" + value;
//       }
//     }

// $(document).ready(function() {
//     var nextPage = 2;
//     var baseUrl = window.location.href;
//     var url = updateQueryStringParameter(baseUrl, 'page' , nextPage);
//     // url = updateQueryStringParameter(url, 'paginate' , 1);
//     console.log(url);
//     var checker = true;
//     var pg;
//     $(window).scroll(function() {
//         // var documentHeight = $(document).height();
//         if($(window).scrollTop() + $(window).height() + 2000 > $(document).height() && checker) {
//             checker = false;
//             $.ajax({url:url, success: function(data) {
//                 var $data = $(data);
//                 $('.column-first').append($data.find('.column-first .room'));
//                 $('.column-second').append($data.find('.column-second .room'));
//                 nextPage++;
//                 checker = true;
//                 url = updateQueryStringParameter(window.location.href, 'page' , nextPage);

//                 pg = initPhotoSwipeFromDOM('.pg-items');
//             }});
//        }
//     });
    
        
// });
</script>
@stop
