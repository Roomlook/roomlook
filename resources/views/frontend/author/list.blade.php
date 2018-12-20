@extends('layouts.master-stores')
@section('title','Дизайнеры')
@section('content')
    <section id="main" class="catalog designers-wrapper">
        <div class="container-fluid">
            <div class="breadcumbs">
                <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author">{{ trans('frontend.common.designers') }}</a>
            </div>
                   <!--  <div class="row filter-toggle-holder visible-xs">
                        <div class="col-md-12 text-right">
                            <button class="filter-toggler">Фильтр</button>
                        </div>
                    </div> -->

            <!-- <aside class="sidebar-left ">
                <div>
                <div class="col-md-12">
                <h4>Город</h4>
                    
                            <form role="form"  method="get" id="chooseCityModal2"  action="/{{ LaravelLocalization::getCurrentLocale() }}/author/">
                                <div class="form-group">
                                <select name="city_id" onchange="this.form.submit()" class="form-control">
                                    <option value="0" @if (\Input::get('city_id') == 0) selected @endif>{{ trans('frontend.common.all') }}</option>
                                 @foreach(App\Models\Country::all() as
                                  $country)
                                        <optgroup label="{{ $country->name }}">
                                            @foreach($country->cities as $city)
                                            <option value="{{ $city->id }}" @if ($cityId == $city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </optgroup>
                                @endforeach
                                </select>
                                </div>
                            </form>
                </div>
                
                <div class="clear"></div>
                </div>
            </aside> -->

            <div id="catalog" class="col-md-12" style="width: 100% !important">
                <div class="designers">
                    <div class="catalog-header">

                <h1 class="text-left">{{ trans('frontend.common.designers') }}</h1>
                <p>здесь собраны примеры проектов одих из лучших дизайнеров мира</p>
                    </div>
                    <div>
                        @foreach($authors as $author)
                            <div class="item">
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{$author->id}}" >
                                <div class="col-md-5 col-xs-12 padding-bottom-30 designer-image" style="background-image: url(/{{$author->imagePathMain()}}">
                                    
                                        <div class="pos-rel">
                                        </div>

                                </div>
                            </a>
                                <div class="designer-name-mob visible-xs">{{$author->user->name}}</div>
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{$author->id}}" >
                                <div class="desinger-image-mob visible-xs" style="background-image: url(/images/authors/{{$author->image}}); background-size: cover; background-position: center;">
                                             
                                        </div>
                                        </a>

                                <div class="col-md-7 designer-content hidden-xs">
                                    <div class="col-md-2 col-xs-3 padding-left-0">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{$author->id}}" ><div class="desinger-image" style="background-image: url(/images/authors/{{$author->image}}); background-size: cover; background-position: center;">
                                             
                                        </div></a>

                                    </div>
                                    <div class="col-md-10 col-xs-9 designer-info">
                                        <div>
                                            <div class="pull-left">
                                                <small class="group inner list-group-item-text">{{-- trans('frontend.common.designer') --}}</small>
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{$author->id}}" ><h4 class="designer-name group inner list-group-item-text margin-top-0 margin-bottom-0">{{$author->user->name}}</h4></a>
                                            </div>
                                             <div class="pull-left col-md-1 padding-top-20">

                                                {{--<i class="icon_star green"></i><br>
                                                {{$author->rating}}--}}
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="intro">
                                            <p >
                                                {{$author->anons}}
                                            </p>
                                        </div>
                                        <div>
                                            <br>
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{$author->id}}" class="c_btn_transparent4 c_btn_medium">{{ trans('frontend.common.more') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="designer-city">
                                    @if ($author->city != '')
                                    <p><i class="glyphicon glyphicon-map-marker"></i> &nbsp;{{ $author->city }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class=" clear"></div>
                        @endforeach
                        
                        <div class="text-center">{!! $authors->render() !!}</div>
                    </div>
                    <div class="clear"></div>
                </div>

            </div>
        </div>

    </section>
@endsection