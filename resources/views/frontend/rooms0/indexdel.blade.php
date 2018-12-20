@extends('layouts.master')
@section('title','RoomLook')
@section('seo_keywords', $type->seo_keywords)
@section('seo_description', $type->seo_description)
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
                         @foreach($styles as $s)
                                    <li class="{{ isset($style) && $style->id == $s->id ? 'active' : '' }}">
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
            <section id="main" class="rooms-page room-wrapper">
                <div class="container">
                <!-- <div class="container-fluid"> -->
                    <div class="room-inside-wrapper">
                    <div class="breadcumbs">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/rooms">{{ trans('frontend.common.rooms') }}</a> >
                        <a href="#">{{ $type->name }}</a>
                    </div>
                    <!-- <div class="row filter-toggle-holder visible-xs">
                        <div class="col-md-12 text-right">
                            <button class="filter-toggler">Фильтр</button>
                        </div>
                    </div> -->
                    <aside class="sidebar-left">
                        <div class="filter-by-room">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.room') }}</h4>
                            <ul class="">
                                {{-- <li class="">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id=0&room_style_id={{ $style->id }}&view={{ $request->view }}">{{ trans('frontend.common.all') }}</a>
                                </li> --}}
                                @foreach($roomTypes as $roomType)
                                <li class="{{ $type->id == $roomType->id ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $roomType->id}}&room_style_id={{ isset($style) ? $style->id  : '' }}&view={{ $request->view }}">{{ $roomType->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="divider">
                        <div class="col-md-12">
                            <h4 class="gray">{{ trans('frontend.common.style') }}</h4>
                            <ul class="">

                                <li class="">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $type->id}}&view={{ $request->view }}">{{ trans('frontend.common.all') }}</a>
                                </li>
                                @foreach($styles as $s)
                                    <li class="{{ isset($style) && $style->id == $s->id ? 'active' : '' }}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $type->id}}&room_style_id={{ $s->id }}" >{{ $s->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            {{--<form action="/f/room" action="get">
                            <ul class="no-padding">
                                @foreach($styles as $s)
                                <li>
                                    @if (isset($style) && in_array($s->id,$style->id))
                                    <input type="checkbox" name="style[]" value="{{ $s->id }}" checked > <label for="">{{ $s->name }}</label>
                                    @else
                                    <input type="checkbox" name="style[]" value="{{ $s->id }}" > <label for="">{{ $s->name }}</label>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="room_type_id" value="{{ $type->id }}">
                            </form>--}}
                        </div>
                        <div class="clear"></div>
                        </div>
                    </aside>
                    <!-- <div class="container"> -->
                        <div id="catalog" class="rooms-list">
                        <div class="catalog">
                            <div class="catalog-header hidden-xs">
                                <h2 class="text-left text-uppercase">{{ $type->name }}</h2>
                                    <p>здесь собраны примеры проектов одих из лучших дизайнеров мира</p>
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
                            <?php $countItem = 1 ?>
                            @if (\Input::has('view')) 
                            <?php $countItem = \Input::get('view'); ?>

                            @endif
                            <div class="catalog-body list-group  rooms " data-count-item="1" >
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
                        </div>
                        <div class="text-center">
                            @include('pagination', ['paginator' => $rooms])
                        </div>
                    </div>
                    <!-- </div> -->
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
@stop

