
                        <nav id="main-menu" class="list-inline hidden-xs" style="padding:0;">
					<?php /*
                        <nav id="main-menu" class="container list-inline hidden-xs" style="padding:0;">
					<a href="/" style="position:absolute;left:-150px;">
                        <img src="/images/logo-small.png" alt="" class="logo logo-nonfix img-responsive">
                        <img src="/images/logo-small.png" alt="" class="logo logo-fix img-responsive">
                    </a>*/ ?>
						
                                <li class="dropdown {{ strpos(\Request::path(), 'f/projects') != false ? 'active' : '' }}">
                                    <a class="dropdown2" href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{trans('frontend.common.projects') }}</a>
									
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 206px;"></div>
	
								<div class="menu-dropdown">
								 
                                   <div class="col-md-12">
                                   <div class="col-md-4">
								   <div id="thumb" style="background:url(https://roomlook.com/images/rooms/md/1536220673.jpg) center center no-repeat;width:100%;"> 
								   </div>
								   </div>
								   
                                <div class="col-md-4">
                                <h4 class="gray">Стили</h4>
                                <ul>
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1536220673.jpg" href="/ru/projects">Все проекты</a></li>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1536220673.jpg" href="/ru/projects?room_style_id=1">Классический</a></li>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1539675908.jpg" href="/ru/projects?room_style_id=2">Современный</a></li>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1536220673.jpg" href="/ru/projects?room_style_id=3">Фьюжн/Эклектика</a></li>
                                </ul>
                                <ul>
                                    <li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1528356680.jpg" href="/ru/projects?room_style_id=5">Лофт</a></li>
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1537856806.jpg" href="/ru/projects?room_style_id=8">Скандинавский</a></li>
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1537420141.jpg" href="/ru/projects?room_style_id=12">Минимализм</a></li> 
									<li ><a class="thumb" data-img="https://roomlook.com/images/rooms/md/1539675908.jpg" href="/ru/projects?room_style_id=15">Ар Деко</a></li> 
                                </div>
                                <div class="col-md-4">
                                <h4 class="gray">Поиск</h4>
								<form action="/search" method="get" autocomplete="off">
									<input style="width:70%;" type="search" name="q" autocomplete="off" />
									<input type="hidden" name="projects" value="true" />
									<p style="font-size:12px;margin-top:-15px;font-style:italic;">Название проекта, дизайнер и т.д.<p>
								</form>
								</div>
								
								</div> 
								</div>
								</li>
                                <li class="dropdown {{ strpos(\Request::path(), 'f/room') != false ? 'active' : '' }}">
                                    <a class="dropdown2" href="/{{ LaravelLocalization::getCurrentLocale() }}/room">{{ trans('frontend.common.rooms') }}</a>
								
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 167px;"></div>
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 412px;"></div>
								
								<div class="menu-dropdown menu-rooms">
                                <div class="col-md-12" style="display:flex;">  
								<ul style="width:calc(100% + 10px);margin:0 -5px;">
                                @foreach(App\Models\RoomType::all() as $roomType)
		                            <?php
		                            	$href = route('frontend.room.index',['room_type_id'=>$roomType->id]);
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
                                    <li class="col-md-20" style="float:left;padding:5px 5px 0;">
										<div style="height:140px;background-image: url(/images/roomtypes/menu/{{ $roomType->formenu }});background-size:cover;">
										<a 
										style="
										width: 100%;
										display: block;
										height: 140px;
										text-align: center;
										color: #fff;
										line-height: 140px;
										font-weight: 400;
										position: relative;
										z-index: 1;
										font-size: 18px;"
										href="{{route('frontend.room.index',['room_type_id'=>$roomType->id])}}">{{ $roomType->name }}</a> 
										</div>
									</li>
								@endforeach  
                                </ul>   
								</div> 
								</div>
								
								</li>
                                <li class=" {{ strpos(\Request::path(), 'f/ideas') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/articles">{{trans('frontend.common.posts') }}</a>
                                </li>
                                <li class="dropdown {{ strpos(\Request::path(), 'f/catalog') != false ? 'active' : '' }}">
                                    <a class="dropdown2" href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>
                        		
								<div style="
    position: absolute;
    height: 108px;
    width: 40px;
    top: 0;
	z-index:999;
    left: 206px;"></div>
								 
								<div class="menu-dropdown">
                                <div class="col-md-12" style="display:flex;">  
								
                                @foreach(App\Models\Pcategory::parents() as $pcategory)
								<?php if($pcategory->id != 98) { ?>
								<ul style="width:25%;">
                                <li><a href="{{route('frontend.catalog.index',['category_id'=>$pcategory->id])}}">{{ $pcategory->name }}</a>
									<ul>
									<?php $i = 0; ?>
									@foreach(App\Models\Pcategory::where('parent_id', $pcategory->id)->get() as $pcategory2) 
									<?php if($i < 8) { ?> <li><a href="/catalog/{{ $pcategory2->slug }}">{{ $pcategory2->name }}</a></li><?php } ?>
									<?php $i++; ?>
									@endforeach 
									</ul>
								</li>
								</ul> 
								<?php } ?>
								@endforeach
								
								</div> 
								</div>
								
								</li>
                               {{--< <li>
                                    @if (Auth::check())
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom">{{ trans('frontend.common.myrooms') }}</a>
                                    @else
                                    <a href="/auth/login">{{ trans('frontend.common.myrooms') }}</a>
                                    @endif
                                </li>--}}


                                <li class=" {{ strpos(\Request::path(), 'f/author') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author?city_id=@if(session('city_id')){{ session('city_id') }} @endif">{{ trans('frontend.common.designers') }}</a>
                                </li>
                                <!--<li>
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/manufacturers">{{--- trans('frontend.common.manufacturers') ---}}</a>
                                </li> -->
                               <li class=" {{ strpos(\Request::path(), 'f/stores') != false ? 'active' : '' }}">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/stores">{{trans('frontend.common.stores') }}</a>
                                </li>
                                 <!-- <li>

                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/brands">{{-- trans('frontend.common.brands') --}}</a>
                                </li> -->
                        </nav>