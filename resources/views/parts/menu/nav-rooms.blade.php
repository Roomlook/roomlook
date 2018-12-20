<nav id="main-menu" class="list-inline hidden-xs" style="padding:0;"> 
						
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