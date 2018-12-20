@extends('layouts.master10')
@section('title','RoomLook')
@section('content')
<style> 

body {background:#fff!important;}

.affix {
    position: relative!important;
}

aside {
    width: 220px;
    display: inline-block;
    float: left;
    margin-right: 13px;
    min-height: 10px;
    position: absolute;
    left: -220px;
    top: 0px;
}
aside > div {
    background: #fff;
    padding: 20px;
    width: 100%;
    max-width: 200px;
    box-shadow: 0px 0px 10px #ccc;
}
aside > div h2 {
    font-size: 23px;
    line-height: 28px;
    margin-bottom: 10px;
}
aside > div ul li {
    padding: 2px 0;
    margin: 3px 0;
}


.sort {
    margin: 5px 0 15px;
    height: 30px;
}

.sitem {
	text-align: center;
	color: #9A5AD7;
	line-height: 28px;
	position: relative;
}
.sitem:first-child {border-right: 1px solid #9A5AD7;}
.sitem:last-child {border-left: 1px solid #9A5AD7;}
	
.sitem:before {
    content: '';
    position: absolute;
    top: 50%;
    right: 5px;
    margin: -5px 0 0;
    width: 10px;
    height: 10px;
    background: url(https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Angle_down_font_awesome.svg/2000px-Angle_down_font_awesome.svg.png) center center no-repeat;
    background-size: 100%;
}

.sitem.on:before {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg); 
}

.ajax-rooms { cursor: pointer; line-height: 30px; 
    position: relative;
    z-index: 1; }	

.fitem {
	position:relative;
	background:#fff;
	box-shadow:0px 0px 10px #ccc;
    padding: 10px;
	height: 40px;
    margin: 0 -10px;
}

.fitem:before { 
    content: '';
    position: absolute;
    top: 50%;
    right: 10px;
    margin: -5px 0 0;
    width: 20px;
    height: 10px;
    background: url(https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Angle_down_font_awesome.svg/2000px-Angle_down_font_awesome.svg.png) center center no-repeat;
    background-size: 100%;
}

.filter-tags label {font-size:12px;margin:5px 5px 15px 5px;position:relative;padding-right:10px;cursor:pointer;}
.filter-tags label:before{
    content: '';
    position: absolute;
    top: 0;
    right: 0px;
    margin: -5px 0 0;
    width: 10px;
    height: 10px;
    background: url(http://www.acb-portesetfenetres.fr/wp-content/themes/html5blank/src/img/fermer.png) center center no-repeat;
    background-size: 100%;	
}

.ajax-rooms:last-child .drop-rooms {display:none;}
.ajax-rooms:last-child:hover .drop-rooms {display:block;}
.ajax-rooms:last-child:before {
    content: '';
    position: absolute;
    top: 50%;
    right: 10px;
    margin: -5px 0 0;
    width: 20px;
    height: 10px;
    background: url(https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Angle_down_font_awesome.svg/2000px-Angle_down_font_awesome.svg.png) center center no-repeat;
    background-size: 100%;
}

.filter-tags,
.rooms {height: 30px;}
.filter {height: 50px;}
.fitem ul {list-style:none;margin:0;padding:0;}

.body-check { 
    overflow-x: visible;
    overflow-y: scroll;
    max-height: 200px;
    border-bottom: 1px solid #efefef;
}

.panel-choice {
	display: none;
    position: absolute;
    top: 40px;
    background: #fff;
    z-index: 9;
    padding: 20px;
    width: 100%;    
	box-sizing: content-box;
    margin-left: -20px; 
    box-shadow: 0px 0px 5px #ccc;
}

.fitem:hover .panel-choice { display: block; }

.sort-item { cursor: pointer; }

.panel-choice:before {
    position: absolute;
    top: -11px;
    left: 50%;
    margin: 0 0 0 -11px;
    content: '';
    display: block;
    width: 23px;
    height: 11px;
    background: url(https://www.zod.ru/local/templates/zod_2016/images/sprite.png) -113px -275px no-repeat;
}

    @media (max-width: 768px) {
        #catalog {
            width: 100% !important;
        }
    }
</style>
<section id="main" class="catalog">
    <div class="container"> 
    <div class="row">
	
        <div class="breadcumbs" style="display:block;margin:15px;">
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>
        </div>
        <br>
        
                    <div class="row filter-toggle-holder visible-xs">
                        <div class="col-md-12 text-right">
                            <button class="filter-toggler">Фильтр</button>
                        </div>
                    </div>
					
					
					<div style="position:relative;">
					 
        <div id="catalog">
            <div class=" products-page">
			
				<div class="mobile filter mb-group-filter"> 
					<div class="col-md-2">
						<div class="fitem mb-tab" data-page="1"> 
						Комнаты
						</div>
					</div>
					<div class="col-md-2">
						<div class="fitem mb-tab" data-page="2"> 
						Категории
						</div>
					</div>
					<div class="col-md-2">
						<div class="fitem mb-tab" data-page="3"> 
						Фильтр
						</div>
					</div> 
				</div>
				
				<div class="mobile">
				<div class="mb-tabs"></div>
				<div class="mb-tabs filter">
				  
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/kitchen">Кухня</a></div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/vannaya">Ванная</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/spalnya">Спальня</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/gostinaya">Гостиная</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/kabinet">Кабинет</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/detskaya">Детская</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/lestnitsa">Лестница</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/garderob">Гардероб</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room/stolovaya">Столовая</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room?room_type_id=14">Фасад</a>
					</div>
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room?room_type_id=13">Бассейн/Спортзал</a></div>  
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room?room_type_id=15">Терраса/Балкон</a></div>  
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room?room_type_id=18">Прихожая/Коридор</a></div>  
					<div class="col-md-2 ajax-rooms" style="height:30px;"><a href="/ru/room?room_type_id=19">Ландшафт/Двор</a></div>  
					<div class="col-md-2 ajax-rooms" style="display:none;height:30px;"></div>  
					  
				</div>
				<div class="mb-tabs filter" style="height:70px;">
				
            @foreach(App\Models\Pcategory::parents() as $sParent)
                @if ( isset($category->id) && $category->getParents()->get()->contains($sParent->id) )
                <div class="col-md-2">
				@else
                <div class="col-md-2">
				@endif
            	<a class="category" data-category="{{ $sParent->id }}" href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $sParent->id }}">{{ $sParent->name }}</a>
				
				{!! $sParent->getChildrenHtml($category) !!}
				</div>
            @endforeach 
				
				</div>
				<div class="mb-tabs filter">
				
					<div class="col-md-2" style="height:30px;">
						<div class="fitem"> 
						<span>Стиль</span>
						<div class="panel-choice">
							<div class="body-check">
								<div class="item-check">
									<ul>
										<li>
											<input type="checkbox" class="fcheckbox" value="3" data-group="2" name="tag_id[]" id="style-classic" data-val="style-classic">
											<label for="style-classic" class="css-label">Классический</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="4" data-group="2" name="tag_id[]" id="style-skandinavskiy" data-val="style-skandinavskiy">
											<label for="style-skandinavskiy" class="css-label">Скандинавский</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="5" data-group="2" name="tag_id[]" id="style-sovremeniy" data-val="style-sovremeniy">
											<label for="style-sovremeniy" class="css-label">Современный</label>
										</li> 
										<li>
											<input type="checkbox" class="fcheckbox" value="6" data-group="2" name="tag_id[]" id="style-loft" data-val="style-loft">
											<label for="style-loft" class="css-label">Ловт</label>
										</li> 
									</ul>
									</div>
								</div>  
						</div>
					</div> 
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class="fitem">
						<span>Цвет</span> 
						<div class="panel-choice">
							<div class="body-check">
								<div class="item-check">
									<ul>
										<li>
											<input type="checkbox" class="fcheckbox" value="1" data-group="1" name="tag_id[]" id="color-red" data-val="color-red">
											<label for="color-red" class="css-label">Красный</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="2" data-group="1" name="tag_id[]" id="color-green" data-val="color-green">
											<label for="color-green" class="css-label">Зеленый</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="Y" data-group="1" name="tag_id[]" id="color-white" data-val="color-white">
											<label for="color-white" class="css-label">Белый</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="Y" data-group="1" name="tag_id[]" id="color-grey" data-val="color-grey">
											<label for="color-grey" class="css-label">Серый</label>
										</li>  
									</ul>
									</div>
								</div> 
							</div>  
						</div>  
					</div> 
					<div class="col-md-2" style="height:30px;">
					
						<div class="fitem">
						<span>Цена</span>
						<div class="panel-choice">
							<div class="body-check">
								<div class="item-check">
						
						
<p> 
  <input type="text" id="amount" readonly="" style="border:0; color:#f6931f; font-weight:bold;">
</p>

<br>
<br>

							<div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0.15%; width: 39.85%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0.15%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 40%;"></span></div>
						
								</div>
							</div>
						</div>
						</div>
						
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class="fitem">
						<span>Материал</span>
						
						</div>
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class="fitem">
						<span>Форма</span>
						
						</div>
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class=""> 
						<div class="col-md-4"></div>
						<div class="col-md-8">
						<form class="ajax-catalog" style="opacity:0;">
						
						 <input type="hidden" id="room_id" name="room_id" value="0">
						 <input type="hidden" id="category_id" name="category_id" value="0">
						 <input type="hidden" id="page" name="page" value="0">
						 <input type="hidden" id="price_min" name="price_min" value="0">
						 <input type="hidden" id="price_max" name="price_max" value="50000">
						 
						 
						<button class="col-md-6">Применить</button>
						</form>  
						</div>
						</div>
					</div> 
					
				</div>
				
				</div>
				
				
				
                <div class="catalog-body list-group  products " data-count-item="3" >   
				
				<div class="desktop">
				
<div class="rooms">
	@foreach(App\Models\RoomType::all() as $roomType)
	<div class="col-md-1 ajax-rooms" data-room-id="{{ $roomType->id }}" style="height:30px;">
		<a href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}">{{ $roomType->name }}</a>
	</div> 
	@endforeach   
</div>
								
				<div class="filter-tags">
					
				</div>
				
				<div class="filter">
				
					<div class="col-md-2" style="height:30px;">
						<div class="fitem"> 
						<span>Стиль</span>
						<div class="panel-choice">
							<div class="body-check">
								<div class="item-check">
									<ul>
										<li>
											<input type="checkbox" class="fcheckbox" value="3" data-group="2" name="tag_id[]" id="style-classic" data-val="style-classic">
											<label for="style-classic" class="css-label">Классический</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="4" data-group="2" name="tag_id[]" id="style-skandinavskiy" data-val="style-skandinavskiy">
											<label for="style-skandinavskiy" class="css-label">Скандинавский</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="5" data-group="2" name="tag_id[]" id="style-sovremeniy" data-val="style-sovremeniy">
											<label for="style-sovremeniy" class="css-label">Современный</label>
										</li> 
										<li>
											<input type="checkbox" class="fcheckbox" value="6" data-group="2" name="tag_id[]" id="style-loft" data-val="style-loft">
											<label for="style-loft" class="css-label">Ловт</label>
										</li> 
									</ul>
									</div>
								</div>  
						</div>
					</div> 
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class="fitem">
						<span>Цвет</span> 
						<div class="panel-choice">
							<div class="body-check">
								<div class="item-check">
									<ul>
										<li>
											<input type="checkbox" class="fcheckbox" value="1" data-group="1" name="tag_id[]" id="color-red" data-val="color-red">
											<label for="color-red" class="css-label">Красный</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="2" data-group="1" name="tag_id[]" id="color-green" data-val="color-green">
											<label for="color-green" class="css-label">Зеленый</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="Y" data-group="1" name="tag_id[]" id="color-white" data-val="color-white">
											<label for="color-white" class="css-label">Белый</label>
										</li>
										<li>
											<input type="checkbox" class="fcheckbox" value="Y" data-group="1" name="tag_id[]" id="color-grey" data-val="color-grey">
											<label for="color-grey" class="css-label">Серый</label>
										</li>  
									</ul>
									</div>
								</div> 
							</div>  
						</div>  
					</div> 
					<div class="col-md-2" style="height:30px;">
					
						<div class="fitem">
						<span>Цена</span>
						<div class="panel-choice">
							<div class="body-check">
								<div class="item-check">
						
						
<p> 
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>

<br />
<br />

							<div id="slider-range"></div>
						
								</div>
							</div>
						</div>
						</div>
						
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class="fitem">
						<span>Материал</span>
						
						</div>
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class="fitem">
						<span>Форма</span>
						
						</div>
					</div> 
					<div class="col-md-2" style="height:30px;">
						<div class=""> 
						<div class="col-md-4"></div>
						<div class="col-md-8">
						<form class="ajax-catalog" style="opacity:0;">
						
						 <input type="hidden" id="room_id" name="room_id" value="0">
						 <input type='hidden' id='category_id' name='category_id' value='0' />
						 <input type='hidden' id='page' name='page' value='0' />
						 <input type='hidden' id='price_min' name='price_min' value='0' />
						 <input type='hidden' id='price_max' name='price_max' value='50000' />
						 
						 
						<button class="col-md-6">Применить</button>
						</form>  
						</div>
						</div>
					</div> 
					<div></div>
				</div>
				
				<div class="sort">
				
					<div class="col-md-4">
					<div style="
    border: 1px solid #9A5AD7;
    height: 30px;
    margin: 0 -10px;">
						<div class="col-md-4 sitem">
						<span class="sort-item" data-sort="price" data-order="desc">Цена</span>
						
						</div> 
						<div class="col-md-4 sitem">
						<span class="sort-item" data-sort="popular" data-order="desc">Популярность</span>
						
						</div> 
						<div class="col-md-4 sitem">
						<span class="sort-item" data-sort="new" data-order="desc">Новое</span>
						
						</div>
					</div> 
					</div> 
					
					<div class="col-md-8" style="height:30px;">
					</div> 
					 
					<div></div>
				</div>
				</div>
				
                    @if (\Input::get('view') == 1)
                    <div class="listview">
                        
                        @foreach($products as $product)
                            @include('frontend.partials.product')
                        @endforeach

                    </div>
                    @endif
                     @if (\Input::get('view') != 1)
                    <div style="position:relative;">  
					<aside>
                        <div class="sidebar"> 
		<h2>{{ trans('frontend.common.section') }}</h2>
		<ul>
            @foreach(App\Models\Pcategory::parents() as $sParent)
                @if ( isset($category->id) && $category->getParents()->get()->contains($sParent->id) )
                <li class="active">
				@else
                <li class="">
				@endif
            	<a class="category" data-category="{{ $sParent->id }}" href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $sParent->id }}">{{ $sParent->name }}</a>
				
				{!! $sParent->getChildrenHtml($category) !!}
				</li> 
            @endforeach 
                        <li>
                <a class="ajax-rooms" data-room-id="0" href="/ru/catalog">Все проекты</a>
            </li>
		</ul>
                           	
                        </div>
                    </aside>
					
					<div class="gridview">
					
                        @foreach ($products as $product) 
                            @include('frontend.partials.product-grid2')
                        @endforeach 
						
                    </div>
                    </div>
                    @endif
                    <!--<div class="text-center" style="clear:both;">{!! $products->appends($request->all())->render() !!}</div>-->
                </div>
                <div class="clear"></div>
            </div>
            
        </div>
        </div>
    </div>
    </div>
    
</section>
@endsection


