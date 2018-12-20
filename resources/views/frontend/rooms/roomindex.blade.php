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


<section class="mobile" style="padding:20px 0;">
    <div class="container-fluid">
        <div class="row"> 
        @foreach ($roomTypes->chunk(3) as $pcategoriesArr)
			@foreach($pcategoriesArr as $pcategory)
            <div class="col-xs-6" style="padding:2px;">
            <div style="margin:0;height:150px;overflow:hidden;position:relative;">
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
				<div style="background-image: url(/images/roomtypes/md/{{ $pcategory->formenu }});
    height: 200px;
    width: 100%;  
    text-align: center; 
    background-repeat: no-repeat;
    background-size: contain;
    background-position: top center;">
					<div style="    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    top: 0;
    margin-top: 0;
    font-size: 28px;
    text-align: center; 
    font-weight: 100;
    font-size: 22px;
    background: rgba(102, 102, 102, 0.3);
    color: #fff;"><span style="
	position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    top: 50%;
    height: 30px;
    margin-top: -15px;
    text-align: center;
	">{{ $pcategory->name }}</span></div>   
				</div>
			</a> 
            </div> 
            </div>
			@endforeach
        @endforeach
		</div>
	</div>
</section>

            <section id="main" class="desktop rooms-page roomtype-wrapper">
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
                                <li class="{{ $request->room_type_id == $roomType->id ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{route('frontend.room.index',['room_type_id'=>$roomType->id,'room_style_id'=>$request->room_style_id])}}">{{ $roomType->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="divider">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.style') }}</h4>
                            <ul class="">
                                @foreach($styles as $style)
                                    <li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{route('frontend.room.index',['room_type_id'=>$request->room_type_id,'room_style_id'=>$style->id])}}" >{{ $style->name }}</a>
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
                                                <div class="col-xs-6 {{ $pcategory->is_wide == 0 ? 'col-md-20' : 'col-md-6'  }} category-item" style="max-height:230px;overflow:hidden;">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                                        														
                                                            <div class="category-nav">
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}" class="category-name">{{ $pcategory->name }}</a>
                                                            </div>
														
														<div class="category-holder">
                                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
															<div class="category-image" style="background-image: url(/images/roomtypes/menu/{{ $pcategory->formenu }});">
                                                               
                                                            </div></a>
                                                            <div class="arrow-catalog product-arrow">
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
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