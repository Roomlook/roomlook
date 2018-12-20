@extends('layouts.master-stores')
@section('title','RoomLook')
@section('content')
<style>
    @media (max-width: 768px) {
        #catalog {
            width: 100% !important;
        }
    }
</style>
<section id="main" class="rooms-page stores">
    <div class="container">
        <div class="breadcumbs">
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores">{{ trans('frontend.common.store') }}</a>
        </div>
                    <div class="row filter-toggle-holder visible-xs">
                        <div class="col-md-12 text-right">
                            <button class="filter-toggler">Фильтр</button>
                        </div>
                    </div>
        <aside class="sidebar-left " style="display: block;">
            <div>
            <div class="col-md-12">
            <!-- <h4>Город</h4>
                
                        <form role="form"  method="get" id="chooseCityModal2"  action="/f/stores/">
                            <div class="form-group">
                            <select name="city_id" onchange="this.form.submit()" class="form-control">
                                <option value="0" @if ($cityId == 0) selected @endif>{{ trans('frontend.common.all') }}</option>
                             @foreach(App\Models\Country::all() as $country)
                                    <optgroup label="{{ $country->name }}">
                                        @foreach($country->cities as $city)
                                        <option value="{{ $city->id }}" @if ($cityId == $city->id) selected @endif>{{ $city->name }}</option>
                                        @endforeach
                                    </optgroup>
                            @endforeach
                            </select>
                            </div>
                        </form> -->
                <h4>{{ trans('frontend.common.section') }}</h4>
                <ul class="no-padding">
                    
                 @foreach(App\Models\Pcategory::parents() as $sParent)
                        @if ($category != null && $category->getParents()->get()->contains($sParent->id) )
                        <li class="active">
                        @else
                        <li >
                        @endif
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores?category_id={{ $sParent->id }}">{{ $sParent->name }}</a>

                        {!! $sParent->getChildrenHtml($category, 'stores') !!}
                        </li>
                        @endforeach
                </ul>
            </div>
            <hr class="divider">
            
            <div class="clear"></div>
            </div>
        </aside>
        <div id="catalog" >
            <div class="catalog">
            <div id="store-list" > 
                <h1 class="text-left">{{ trans('frontend.common.stores') }}</h1>
                <p>здесь собраны магазины со всего мира, для наилучшего выбора воспользуйтесь фильтром в левой части экрана</p>
                @if ($stores != null) 
                @foreach($stores as $store)
                @if ($store->name != "")
                <div class="store" data-store-id="{{ $store->id }}" >
                    <div class="col-sm-4 col-xs-12">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores/s/{{ $store->id }}">
                            @if($store->image != "")
                                <img class="img-responsive" src="/{{ $store->image2Path() }}"/>
                            @else
                                <img class="img-responsive" src="/images/nophoto.jpg">
                            @endif</a>
                    </div>
                    <div class="col-sm-8 hidden-xs">
                        <h3 class="title margin-top-0"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores/s/{{ $store->id }}" class="green-link">{{ $store->name }}</a></h3>
                        <p>
                           
                        <?php $i = 0; ?>
                            @foreach($store->categories()->get() as $category)
                            {{-- 
                                {{ $category->name }}
                                @if (++$i != count($store->categories()->get()))
                                /
                                @endif
                                --}}
                            @endforeach                           
                        </p>
                        <div class="store-desc">
                            <p>{!! strip_tags($store->short_description) !!}</p>
                        </div>
                        <div >
                            <br>
                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores/s/{{ $store->id }}?
                                category_id={{ (isset($_GET['category_id'])) ? $_GET['category_id'] : '' }}" class="c_btn_transparent4 c_btn_medium">подробнее</a>
                        </div>
                    </div>
                    <div class="store-logo">
                        @if($store->logo != "")
                            <img class="img-responsive" src="/{{ $store->imagePath() }}"/>
                        @endif
                    </div>
                    <div class="store-name visible-xs">
                        {{ $store->name }}<br/>                         
                        <?php $i = 0; ?>
                        @foreach($store->categories()->get() as $category)
                        {{--
                                {{ $category->name }}
                                @if (++$i != count($store->categories()->get()))
                                /
                                @endif
                                --}}
                            @endforeach                            
                    </div>
                    <div class="store-address">
                        {{ $store->website }} <i class="icon_pin_alt"></i>                        
                        <?php $i = 0; ?>
                            @foreach($store->cities as $city) 
                            {{ $city->name }}
                        <?php break; ?>
                        @endforeach
                    </div>
                    <div class="clear"></div>
                </div>
                @endif
                @endforeach
                @endif
                <div class="clear"></div>
                <div class="text-center"> 
                    {!! $stores ? $stores->render() : '' !!}
                </div>
            </div>
            </div>
         
    <div class="clear"></div>
    </div></div>
</section>
@endsection
<?php /*
@section('modals')
@if (false )
<!-- Modal -->
<div class="modal fade" id="choseCityModal" role="dialog">
    <div class="modal-dialog modal-sm" >

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="text-center no-margin-bottom">{{ trans('frontend.common.choose-city') }}</h4>

            </div>
            <div class="modal-body">
                <div class="alert alert-danger modal-error response-message hide">
                </div>
                <form role="form"  method="get" id="chooseCityModal2" action="/f/stores/">
                    <div class="form-group">
                    <select name="city_id" class="form-control">
                     <option value="0" @if (\Input::get('city_id') == 0) selected @endif>{{ trans('frontend.common.all') }}</option>
                     @foreach(App\Models\Country::all() as $country)
                            <optgroup label="{{ $country->name }}">
                                @foreach($country->cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </optgroup>
                    @endforeach
                    </select>
                        <br>
                    <div class="form-group">
                        <button type="submit" class="center-block clearfix c_btn_medium c_btn_green btn btn-lg">OK</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
<script type="text/javascript">
    $('#choseCityModal').modal('show');
</script>
@endsection
*/ ?>