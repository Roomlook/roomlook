@extends('layouts.master')
@section('title','RoomLook')
@section('header-menu')
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
            <section id="main" class="rooms-page room-wrapper">
                <div class="container">
                <!-- <div class="container-fluid"> -->
                    <div class="breadcumbs">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a> >
                        <a href="#">{{ $type->name }}</a>
                    </div>
                    <aside class="sidebar-left">
                        <div class="filter-by-room">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.room') }}</h4>
                            <ul class="">
                                @foreach($roomTypes as $roomType)
                                <li class="{{ $request->room_type_id == $roomType->id ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room/moz?room_type_id={{ $roomType->id }}&room_style_id={{ $request->room_style_id }}">{{ $roomType->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="divider">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.style') }}</h4>
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
                            {{--<form action="/f/room" action="get">--}}
                            {{--<ul class="no-padding">--}}
                                {{--@foreach($styles as $style)--}}
                                {{--<li>--}}
                                    {{--@if ($request->has('style') && in_array($style->id,$request->style))--}}
                                    {{--<input type="checkbox" name="style[]" value="{{ $style->id }}" checked > <label for="">{{ $style->name }}</label>--}}
                                    {{--@else--}}
                                    {{--<input type="checkbox" name="style[]" value="{{ $style->id }}" > <label for="">{{ $style->name }}</label>--}}
                                    {{--@endif--}}
                                {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                            {{--<input type="hidden" name="room_type_id" value="{{ $request->room_type_id }}">--}}
                            {{--</form>--}}
                        </div>
                        <div class="clear"></div>
                        </div>
                    </aside>
                    <div id="catalog" class="rooms-list">
                        <div class="catalog">
                            <div class="catalog-header">
                                <h2 class="text-left text-uppercase">{{ $type->name }}</h2>
                                    <p>здесь собраны примеры проектов одих из лучших дизайнеров мира</p>
                                <div class="col-md-4 text-right layers" data-item-element="room" data-body-element=".catalog-body">
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
                           
                            <div class="catalog-body list-group  rooms "  >
                                
                                <div class="row puzzle-view">
                                    <div class="col-md-6 column-first">
                                        
                                        @foreach($room1 as $room)
                                            @include('partials.room-grid2', array('small' => true, 'rooms' => $rooms ))
                                        @endforeach
                                    </div>
                                    <div class="col-md-6 column-second">
                                        @foreach($room2 as $room)
                                            @include('partials.room-grid2',array('small' => true))
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
@if (\Request::has('top'))
<script>
    $(function() {
        $(document).scrollTop({{ \Request::get('top') }});
    });
</script>
@endif
<script>

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
