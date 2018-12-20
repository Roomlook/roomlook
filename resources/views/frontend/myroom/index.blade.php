@extends('layouts.master', ['noajax' => true])
@section('title','RoomLook')
@section('content')
<style>
.avator {border:1px solid #000;border-radius:100%; 
    overflow: hidden;
    width: 140px;
    height: 140px;}
.avator img {max-width:100%;}
.col-md-4 {padding:30px;}
a {display:block;clear:both;}
.col-sm-3.col-xs-12 {padding:35px;}
</style>
<section id="main" class="padding-bottom-20">
    <div class="container"> 
    <div class="row">
	
		<div style="
    background-color: #fff;
    height: 230px;
    width: 100%;
    margin: 35px 0;
    box-shadow: 0px 0px 10px #ccc;
		">
		<div class="col-md-4">
			<div class="col-md-6">
				<div class="avator">
				<img src="/images/users/noavator.png" />
				</div>
			</div>
			<div class="col-md-6">
				<h2>{{ Auth::user()->name }}</h2>
				<a href="#">Россия, Москва</a>
				<a href="#">Настроить фильтр</a> 
				<a href="#">Свежие тренды</a>
			</div>
		</div>
		<div class="col-md-4"></div>
		<div class="col-md-4" style="text-align:right;">
			<h3>Редактировать профиль</h3>
			<a href="/{{ LaravelLocalization::getCurrentLocale() }}/home/settings">Настройки</a>
			<a href="#">Новости</a>
		</div>
		</div>
	
		<div style="
    background-color: #fff; 
    width: 100%;
    margin: 35px 0;
    box-shadow: 0px 0px 10px #ccc;
		">
		 
		 
			@foreach (Auth::user()->ownRooms()->get()->chunk(4) as $owns) 
					@foreach($owns as $own)
					<div  class="col-sm-3 col-xs-12">
					<div class="ownroom-item" >
					
						<h2>
							<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/room/{{ $own->id }}">
								@if ($own->name != null)
								{{ $own->name }}
								@else
								default-name
								@endif
							</a>
							<small class="pull-right remove-myroom">
								<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/delete/{{ $own->id }}">
									Удалить
								</a>
							</small>
						</h2>
						<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/room/{{ $own->id }}">
							@if ($own->roomPictures()->count() > 0)
							<div style="background-image:url(/{{ $own->roomPics()->first()->imagePath() }})"  class="ownroom-image" ></div>
							@elseif ($own->productPictures()->count())
							<div style="background-image:url(/{{ $own->productPics()->first()->imagePath() }})"  class="ownroom-image" ></div>
							@else
							<div class="ownroom-image" ></div>
							
							@endif
						</a>
					</div>
					</div>
					@endforeach 
			@endforeach
					
	                            <div class="row">
	                            	<div class="col-md-3 col-xs-5">
	                            		<a href="" class="create-alb" data-toggle="modal"  data-dismiss="modal" data-target="#createDirModal">
	                            			<span>+</span>
	                            		Создать альбом</a>
	                            	</div> 
	                            </div>
		
		</div>
		
	</div>
	</div>



<div class="container-fluid padding-bottom-10">
                        <div class=" about-owner">
                                <div class="row">
                            		<div class="col-md-4 col-md-offset-4">
	                                    <div class="author-name-and-social">
	                                        <h3 class="margin-top-10 text-center">Мой кабинет</h3>
	                                        <hr>
	                                        <h2 class="margin-top-0 text-center">{{ Auth::user()->name }}</h2>
	                                        
	                                    </div>
	                                    <p>
	                                </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col-md-3 col-xs-5">
	                            		<a href="" class="create-alb" data-toggle="modal"  data-dismiss="modal" data-target="#createDirModal">
	                            			<span>+</span>
	                            		Создать альбом</a>
	                            	</div>
	                            	<div class="col-md-6 col-xs-7 text-center">
	                            		<a href="/{{ LaravelLocalization::getCurrentLocale() }}/home/settings" class="edit-profile">Редактировать профиль</a>
	                            	</div>
	                            </div>
	                        </div>
	                    </div>
						
						
						
	<div class="container-fluid">


		<div class="col-md-12 myrooms bg-white margin-bottom-20">
		

			@foreach (Auth::user()->ownRooms()->get()->chunk(4) as $owns)
				<div class="row">
					@foreach($owns as $own)
					<div  class="col-sm-3 col-xs-12">
					<div class="ownroom-item" >
					
						<h2>
							<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/room/{{ $own->id }}">
								@if ($own->name != null)
								{{ $own->name }}
								@else
								default-name
								@endif
							</a>
							<small class="pull-right remove-myroom">
								<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/delete/{{ $own->id }}">
									Удалить
								</a>
							</small>
						</h2>
						<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/room/{{ $own->id }}">
							@if ($own->roomPictures()->count() > 0)
							<div style="background-image:url(/{{ $own->roomPics()->first()->imagePath() }})"  class="ownroom-image" ></div>
							@elseif ($own->productPictures()->count())
							<div style="background-image:url(/{{ $own->productPics()->first()->imagePath() }})"  class="ownroom-image" ></div>
							@else
							<div class="ownroom-image" ></div>
							
							@endif
						</a>
					</div>
					</div>
					@endforeach
				</div>
				

			@endforeach
		</div>
</div>

		
	</div>
    
</section>
<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form action="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/create-room" method="get">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">{{ trans('frontend.common.create-room') }}</h4>
	      </div>
	      <div class="modal-body">
	      	
	      		<div class="form-group">
	      			<input type="text" name="name" class="form-control" required placeholder="{{ trans('frontend.common.create-room') }}">
	      			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	      		</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('frontend.common.save') }}</button>
	        <button type="submit" class="btn btn-primary">{{ trans('frontend.auth.submit') }}</button>
	      </div>
      	</form>
    </div>
  </div>
</div>
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div>
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#uploadfrompc" aria-controls="uploadfrompc" role="tab" data-toggle="tab">{{ trans('frontend.common.load-from-pc') }}</a></li>
			    <li role="presentation"><a href="#uploadfromlink" aria-controls="uploadfromlink" role="tab" data-toggle="tab">{{ trans('frontend.common.load-from-link') }}</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="uploadfrompc">
			    	<form action="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/frompc" method="post" enctype="multipart/form-data">
			    	<div class="form-group" style="padding: 5px 20px;">
			    		<label for="">{{ trans('frontend.common.choose-room') }}</label>
			    		<select name="own_room_id" class="form-control" id="">
			    		@foreach (Auth::user()->ownRooms()->get() as $own)
			    			<option value="{{ $own->id }}">{{ $own->name }}</option>
			    			@endforeach
			    		</select>
			    	</div>
					<div class="form-group">
						<input type="file" name="image">
		      			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		      		</div>
		      		<div class="form-group text-center">
		      		<button type="submit" class="c_btn_transparent_green c_btn_small">{{ trans('frontend.common.load-picture') }}</button>
		      		</div>
		      		</form>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="uploadfromlink">

			    	<form action="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/fromlink" method="post">
			    	<div class="form-group">
			    		<label for="">{{ trans('frontend.common.choose-room') }}</label>
			    		<select name="own_room_id" class="form-control" id="">
			    			@foreach (Auth::user()->ownRooms()->get() as $own)
			    			<option value="{{ $own->id }}">{{ $own->name }}</option>
			    			@endforeach
			    		</select>
			    	</div>
						<div class="form-group">
							<label for="">{{ trans('frontend.common.load-from-link') }}</label>
							<input type="text" name="link" placeholder="{{ trans('frontend.common.past-here') }}" class="form-control" >
			      			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			      		</div>
			      		<div class="form-group text-center">
			      			<button type="submit" class="c_btn_transparent_green c_btn_small">{{ trans('frontend.common.load-picture') }}</button>
			      		</div>
		      		</form>
			    </div>
			  </div>

		</div>
    </div>
  </div>
</div>
<div class="modal fade" id="changeProfilePhotoModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">Фотография вашего профиля</h2>
            </div>
            <form action="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/change-avatar" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="file" name="avatar" required="required">
                
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" >Отменить</button>
                <button type="submit" class="btn btn-success" >Сохранить</button>
            </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}
</script>

@stop


