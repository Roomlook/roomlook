@extends('layouts.masterrooms')
@section('title','RoomLook') 
@section('script')
<script>
	function contentresizeheight() {
		
	}

    $(window).resize(function() {
        var h = $(window).height(),
			h2 = h - 300,
			h3 = h2/3;  
				
		$('.category-item').each(function(i, a) {
			
			$(this).css('height', h3 + 'px');
			
		});		
		
		$('html,body').css('overflow', 'hidden');
		
	});
    $(function() {
        var h = $(window).height(),
			h2 = h - 300,
			h3 = h2/3;  
				
		$('.category-item').each(function(i, a) {
			
			$(this).css('height', h3 + 'px');
			
		});		
		
		$('html,body').css('overflow', 'hidden');
		
    }); 
</script> 
@stop
@section('content')
            <section id="main" class="rooms-page roomtype-wrapper">
                <div class="container-fluid">
        <div class="breadcumbs">
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a>
        </div>

                            <div class="catalog-header ">
                                
                                    <h2 class="text-left text-uppercase">{{ trans('frontend.common.rooms') }}</h2>
                                    <p>здесь собраны примеры проектов одих из лучших дизайнеров мира</p>
                            </div>
							 
                   <aside class="sidebar-left">
                        <div class="filter-by-room">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.room') }}</h4>
                            <ul class="">
                                @foreach($roomTypes as $roomType)
		                            <?php
		                            	$href = route('frontend.room.index',['room_type_id'=>$roomType->id,'room_style_id'=>$request->room_style_id]);
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
                                <li class="{{ $request->room_type_id == $roomType->id ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">{{ $roomType->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="divider">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.style') }}</h4>
                            <ul class="">
                                @foreach($styles as $style)
		                            <?php
		                            	$href = route('frontend.room.index',['room_type_id'=>$request->room_type_id,'room_style_id'=>$style->id]);
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
                                    <li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" >{{ $style->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clear"></div>
                        </div>
                    </aside>
                    <div id="catalog" style="width: 100%!important; ">
                        <div class="catalog">
                            
                            <div class="catalog-body list-group roomtype-categories"  > 
                                        <div class="row">
                                        @foreach ($roomTypes->chunk(3) as $pcategoriesArr)
                                            @foreach($pcategoriesArr as $pcategory)
		                            <?php
		                            	$href = 'room?room_type_id='.$pcategory->id;
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
                                                <div class="col-xs-6 {{ $pcategory->is_wide == 0 ? 'col-md-20' : 'col-md-6'  }} category-item" style="max-height:230px;overflow:hidden;">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                        														
                                                            <div class="category-nav">
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}" class="category-name">{{ $pcategory->name }}</a>
                                                            </div>
														
														<div class="category-holder">
                                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
															<div class="category-image" style="background-image: url(/{{ $pcategory->imagePath('md/') }});">
                                                               
                                                            </div></a>
                                                            <div class="arrow-catalog product-arrow">
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{$href}}">
                                                                    <div ></div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endforeach
                                        </div>
                                </div>
                            <div class="clear"></div>
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
@stop 
