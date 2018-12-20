@extends('layouts.master')
@section('title','RoomLook')

@section('content')
<section id="main" class="rooms-page">
    <div class="container">
        <div id="search">
            <div class="catalog">
                <div class="catalog-header">
                    <div class="breadcrumbs col-md-12">
                        <ul class="list-inline">
                            <li><a href="/">{{ trans('frontend.common.home') }}</a></li>
                            <li><i class="arrow_carrot-right"></i></li>
                            <li><a href="#">{{ trans('frontend.common.search') }}</a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <h4>{{ trans('frontend.common.search-result') }} <strong>{{ $keyword }}</strong></h4>
               
                
                <div class="col-md-12">
                 <h4 class="gray">{{ trans('frontend.common.room') }}</h4>
                            <h5> @if ($rooms->count() == 0 )
                                {{ trans('frontend.common.nothing-found') }}
                                @endif
                            </h5>
                    <div class="catalog-body list-group  rooms search-result" data-count-item="1" >
                        <div class="gridview">
                            @foreach ($rooms as $room)
                                @include('partials.room-grid')
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="text-center">{!! $rooms->appends(['q' => $keyword])->render() !!}</div>
                </div>
                <div class="col-md-12">
                 <h4 class="gray">{{ trans('frontend.common.catalog') }}</h4>
                         <h5> @if ($products->count() == 0)
                                {{ trans('frontend.common.nothing-found') }}
                                @endif
                            </h5>
                    <div class="catalog-body list-group  rooms " data-count-item="1" >
                        <div class="gridview">

               
                            @foreach ($products as $product)
                @include('frontend.partials.product')
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
            <div class="text-center">{!! $products->appends(['q' => $keyword])->render() !!}</div>
                        
                </div>
                <div class="col-md-12">
                 <h4 class="gray">{{ trans('frontend.common.designers') }}</h4>
                         <h5> @if ($designers->count() == 0)
                                {{ trans('frontend.common.nothing-found') }}
                                @endif
                            </h5>
                    <div class="catalog-body list-group  rooms " data-count-item="1" >
                        <div class="gridview">
                            @foreach ($designers as $author)
                            <div class="row">
                                    <div class="col-md-3  col-xs-5">
                                        <div class="desinger-image" 
                                        style="background-image: url("/images/authors/
                                        @if (isset($author->author->image)) 
                                        {{ $author->author->image }}
                                        @endif)"); background-size: cover; background-position: center;">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-md-offset-1 author-info  col-xs-7">
                                        <h5 class="margin-top-0 margin-bottom-10">{{ $author->name }}</h5>
                                        <p>
                                            {{ $author->author->phone_number }}<br>
                                            @if ($author->author->website != "") {{ $author->author->website }}<br>@endif
                                            @if (isset($author) and isset($author->email)) {{ $author->email }} @endif<br>
                                            <br>
                                            
                                    @if ($author->author->city != '')
                                    <p><i class="glyphicon glyphicon-map-marker"></i> &nbsp;{{ $author->author->city }}</p>
                                    @endif
                                            
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
            <div class="text-center">{!! $designers->appends(['q' => $keyword])->render() !!}</div>
                        
                </div>
                <div class="col-md-12">
                 <h4 class="gray">{{ trans('frontend.common.projects') }}</h4>
                         <h5> @if ($projects->count() == 0)
                                {{ trans('frontend.common.nothing-found') }}
                                @endif
                            </h5>
                    <div class="catalog-body list-group rooms" data-count-item="1" >
                        <div class="gridview">
                            @foreach ($projects as $project)
                            @include('partials.project')
                            @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
            <div class="text-center">{!! $projects->appends(['q' => $keyword])->render() !!}</div>
                        
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
@if (\Request::has('top'))
<script>
    $(function() {
        $(document).scrollTop({{ \Request::get('top') }});
    });
</script>
@endif
@stop

