@extends('layouts.master')
@section('title','RoomLook')
@section('content')

<section id="main" class="padding-bottom-20">
<div class="container-fluid bg-gray padding-bottom-40">
                        <div class="container about-author">
                            <div class="col-md-2">
                                @if (Auth::user()->image == "")
                                <img class="img-responsive" src="/images/user-placeholder.jpg" data-toggle="modal" data-target="#changeProfilePhotoModal"/>
                                @else
                                <img class="img-responsive" src="/images/rooms/{{ Auth::user()->image }}" data-toggle="modal" data-target="#changeProfilePhotoModal"/>
                                @endif

                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="author-name-and-social">
                                        <h2 class="margin-top-0">{{ Auth::user()->name }}</h2>
                                        <a href="{{ Auth::user()->fb }}" target="_blank"><i class="social_facebook_circle"></i></a>
                                        <a href="{{ Auth::user()->instagram }}" target="_blank"><i class="social_instagram_circle"></i></a>
                                        <a href="{{ Auth::user()->twitter }}" target="_blank"><i class="social_twitter_circle"></i></a>
                                    </div>
                                    <p>
                                </div>
                                <div class="row about-author-text" >
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
	<div class="container">

		<h1 class="text-uppercase">{{ trans('frontend.common.myrooms') }}</h1>

		<div class="col-md-12 myrooms bg-white margin-bottom-20">
		<div class="row home-btns">
			<div class="col-md-6 col-xs-12">
			<a href="#" tabIndex="-1"  class="pull-left c_btn_transparent_green c_btn_small" data-toggle="modal" data-target="#createModal">+ {{ trans('frontend.common.create-room') }}</a>
			</div>
			<div class="col-md-6 col-xs-12">
			<a href="#" tabIndex="-1"  class="pull-right c_btn_transparent_green c_btn_small" data-toggle="modal" data-target="#uploadModal"><i class="glyphicon glyphicon-cloud-upload"></i> {{ trans('frontend.common.load-picture') }}</a>
			</div>
			</div>

			<br>
		
			
			@foreach (Auth::user()->ownRooms()->get()->chunk(4) as $owns)
				<div class="row">
					@foreach($owns as $own)
					<div  class="col-sm-3 col-xs-12">
					<a href="/f/myroom/room/{{ $own->id }}">
					@if ($own->roomPictures()->count() > 0)
					<div class="ownroom" style="background-image:url(/{{ $own->roomPics()->first()->imagePath() }})">
					@elseif ($own->productPictures()->count())
					<div class="ownroom" style="background-image:url(/{{ $own->productPics()->first()->imagePath() }})">
					@else
					<div class="ownroom" >
					@endif
						<div class="ownroom-overlay">
						<h2 class="text-center">{{ $own->name }}</h2>
						<p class="text-center">{{ trans('frontend.common.photo') }} {{$own->roomPictures()->count()}}, {{ trans('frontend.common.items') }} {{ $own->productPictures()->count() }}</p>
						</div>
					</div>
					</a>
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
    	<form action="/f/myroom/create-room" method="get">
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
			    	<form action="/f/myroom/frompc" method="post" enctype="multipart/form-data">
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

			    	<form action="/f/myroom/fromlink" method="post">
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
            <form action="/f/myroom/change-avatar" method="post" enctype="multipart/form-data">
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


