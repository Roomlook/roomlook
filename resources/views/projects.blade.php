@extends('layouts.master-glav')
<?php /*@extends('layouts.master4')*/ ?>
@section('title','RoomLook')
@section('header-menu')
 
    <div class="col-xs-12 visible-xs" style="padding:0;">
	
<div style="position:relative;z-index:9;">
	<content class="mob-view"> 
  <input id="hamburger" class="hamburger" type="checkbox">
  <label class="hamburger" for="hamburger" style="left:0;margin-left:0px;">
    <i style="left:20%;"></i>
    <text style="display:none;">
      <close>закрыть</close>
      <open>меню</open>
    </text>
  </label>
  <section class="drawer-list" style="width:100%;"> 
        <ul>
                        <?php $i = 0; 
                        $n =  $styles->count() - 1;?>
                         @foreach($styles as $style)
		<li> 
		<a data-id="1" href="{{route('frontend.projects.index',['room_style_id'=>$style->id])}}">{{ $style->name }}</a></li><li> 
		
                                @endforeach
		</ul>
      </section>
</content>
</div>
        
            <ul class="list-inline room-selects" style="display:none;">
                
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
<style>
@media (max-width: 720px) {
.project-image, .small-project .project-image-el, .project-image-slide {
    min-height: 250px!important;
    height: auto!important;
    max-height: 1000px!important;
}
}
</style>
<section class="mobile">
    <div class="container-fluid">
        <div class="row"> 
				
                    <div class="breadcumbs" style="display:block;margin:15px;">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="#">{{ trans('frontend.common.projects') }}</a>
                    </div>
					
                    <div style="position:relative;">
                    <aside>
                        <div class="sidebar"> 
		<h2>Стили</h2>
		<ul>
            @foreach($styles as $style)
			<li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}"><a href="/projects?room_style_id={{ $style->id }}">{{ $style->name }}</a></li> 
            @endforeach
            <li class="{{ $request->room_style_id ? '' : 'active' }}">
                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{ trans('frontend.common.all') }}</a>
            </li>
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
                    </aside>
					
                    <div id="catalog">
                        <div class="catalog-header">
                            
                        </div>
                        <div class="catalog-body list-group" data-count-item="1" >
                            
                            <div class="gridview ">  
                                @foreach ($projects as $project) 
                                    @include('partials.project')
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div> 
                    <div class="text-center">{!! $projects->render() !!}</div>
                    </div>
                    </div>
                  
                </div>
                </div>
                  <div class="clear"></div>
            </section> 
			
            <section id="main" class="desktop container rooms-page room-wrapper">
                <div class="row">
				
                    <div class="breadcumbs" style="display:block;margin:15px;">
                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> > 
                        <a href="#">{{ trans('frontend.common.projects') }}</a>
                    </div>
					
                    <div style="position:relative;">
                    <aside>
                        <div class="sidebar"> 
		<h2>Стили</h2>
		<ul>
            @foreach($styles as $style)
			<li class="{{ $request->room_style_id == $style->id ? 'active' : '' }}"><a href="/projects?room_style_id={{ $style->id }}">{{ $style->name }}</a></li> 
            @endforeach
            <li class="{{ $request->room_style_id ? '' : 'active' }}">
                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects">{{ trans('frontend.common.all') }}</a>
            </li>
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
                    <div class="text-center">{!! $projects->render() !!}</div>
                    </div>
                    </div>
                  
                </div>
                  <div class="clear"></div>
            </section> 
    
	<!--</div>-->
	
<style>
main {margin:30px 0;}

.margin-y-50 {
    margin-bottom: 0!important;
    height: auto!important;
    margin-bottom: 25px!important;
}

aside {width:200px;display:inline-block;float:left;margin-right:13px;min-height:10px;position:absolute;left:-200px;top:65px;}
aside + div#catalog {width:100%;display:inline-block;}
aside > div {background:#fff;padding:20px;width:100%;max-width:180px;}
aside > div h2 {font-size:23px;line-height:28px;margin-bottom:10px;}
aside > div ul li {padding:2px 0;}
aside > div ul li.active a {color:#8404dd;font-weight:bold;}
aside > div.fixed {position:fixed;left:50%;top:0;margin-left:-600px;}

.article {margin-bottom:25px;padding:0px;transition:.2s;}
.article p {margin-top:25px;}
.article:hover {box-shadow:0px 0px 10px #ccc;transition:.2s;} 
</style> 
<script>  
/*
function MobileDetect() {
  var UA = navigator.userAgent.toLowerCase();
  return (/android|webos|iris|bolt|mobile|iphone|ipad|ipod|iemobile|blackberry|windows phone|opera mobi|opera mini/i.test(UA)) ? true : false;
}
jQuery(document).ready(function($) {
 
  if (!MobileDetect()) {
    var 
      $window = $(window),  
      $target = $(".sidebar"), 
      $h2 = $target.offset().top;  
	  $h = 125;
 
    $window.on('scroll', function() {
  
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  
      if (scrollTop > $h) { 
        $target.addClass("fixed"); 
      } else { 
        $target.removeClass("fixed");
      }
    });
  }
});
*/
</script>
@endsection 
@section('script')
<script>
$(function() { 
	 
        $(".custom-ajax-button").on("click", function(e) { 

            e.preventDefault();
            
            var url = $(this).attr("href");
 
            $.ajax({
                url,
                dataType: 'json',
                type: 'get',
                success: function(res) {
                    if (res.status == 'success') {

                        window.location.reload();

                    }
                }
            });


        });
		
});
</script>
@if (\Request::has('top'))
<script>
$(function() {  
    $(document).scrollTop({{ \Request::get('top') }});
});
</script> 
@endif
@stop 