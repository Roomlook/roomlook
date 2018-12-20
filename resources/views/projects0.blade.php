@extends('layouts.master')
@section('title','RoomLook')
@section('header-menu')
    <style>
        @media (max-width: 768px){
            #main #catalog {
                width: 100% !important;
            }
            #catalog {
                margin-top: 20px;
            }
        }
        @media (max-width: 1750px) and (min-width: 768px){
            #main-menu {
                display: inline-block !important;
            }
        }
    </style>
    <div class="col-xs-12 visible-xs margin-top-10">
        
            <ul class="list-inline room-selects">
                
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
                                        <a href="{{route('frontend.projects.index',['room_style_id'=>$style->id])}}" >{{ $style->name }}</a>
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
                    <div class="breadcumbs">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="#">{{ trans('frontend.common.projects') }}</a>
                    </div>
                    <aside class="sidebar-left">
                        <div class="filter-by-room">
                            <div class="col-md-12">
                                <h4 class="gray">{{ trans('frontend.common.style') }}</h4>
                                <ul class="">

                                    <li class="">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{ trans('frontend.common.all') }}</a>
                                    </li>
                                    @foreach($styles as $style)
                                        <li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects?room_style_id={{ $style->id }}" >{{ $style->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                {{--<form action="/f/room" action="get">
                                <ul class="no-padding">
                                    @foreach($styles as $style)
                                    <li>
                                        @if ($request->has('style') && in_array($style->id,$request->style))
                                        <input type="checkbox" name="style[]" value="{{ $style->id }}" checked > <label for="">{{ $style->name }}</label>
                                        @else
                                        <input type="checkbox" name="style[]" value="{{ $style->id }}" > <label for="">{{ $style->name }}</label>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="room_type_id" value="{{ $request->room_type_id }}">
                                </form>--}}
                            </div>
                            <div class="clear"></div>
                        </div>
                    </aside>
                    <div id="catalog">
                        <div class="catalog-header">
                            
                        </div>
                        <div class="catalog-body list-group  rooms " data-count-item="1" >
                            
                            <div class="gridview ">
                                @foreach ($projects as $project)
                                    @include('partials.project')
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="text-center">{!! $projects->render() !!}</div>
                  
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

