@extends('layouts.master')
@section('title','RoomLook')
@section('onload', 'init();')
@section('content')
<section id="main" class="padding-top-20 padding-bottom-20">
	<div class="container">
		<h1 class="text-uppercase">{{  $ownRoom->name }}</h1>
		<div class="row home-btns">
			<div class="col-xs-12 col-sm-6">
			
			</div>
			<div class="col-xs-12 col-sm-6">
			<a href="#" tabIndex="-1"  class="pull-right c_btn_transparent_green c_btn_small" data-toggle="modal" data-target="#uploadModal"><i class="glyphicon glyphicon-cloud-upload"></i> {{ trans('frontend.common.load-picture') }}</a>
			</div>

			<br>
		</div>
		<div class="col-md-12 myrooms bg-white margin-bottom-20">
				
				
			<div class="myroom-items row">
				<div class="col-sm-12 col-xs-12" style="border-right: 1px solid #edeeee;">
					@if ($ownRoom->roomPictures()->count() != 0)
					
					<h3 class="text-uppercase" >{{ trans('frontend.common.photo') }}</h3>
					@foreach($ownRoom->roomPictures()->chunk(3) as $pictures)
					<div class="row">
						@foreach($pictures as $picture)
						<div class="col-sm-3 col-xs-12">
							<div class="saved-item">
								<div class="item pg-items" data-picture-id="{{ $picture->id }}" data-project-id="{{ $picture->room->project->id }}" data-project-pictures="{{ $picture->room->project->pictures(0, ['id', 'image']) }}" data-project-room="{{ $picture->room->project->rooms->count() }}">
									<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
				                      <a href="https://roomlook.com/{{ $picture->imagePath() }}"   @if($picture->isSaved()) data-status="saved" @else data-status="" @endif data-picture-id="{{ $picture->id }}" itemprop="contentUrl" data-size="{{$picture->getWidth()}}x{{ $picture->getHeight()}}">
				                          <img  
				                                alt=""
				                                    src="/{{ $picture->imagePath() }}"
				                                    data-src="/{{ $picture->imagePath('') }}"  class="lazyload" tabIndex="-1" data-picture-id={{ $picture->id }} src="https://roomlook.com/{{ $picture->imagePath() }}" class="popup-open popup-room @if ($picture->is_landscape == 1) landscape-image @endif img-responsive" itemprop="thumbnail" alt="Image description">

				                      </a>
								</div>
							</div>
							<textarea class="comment" placeholder="Комментарии..."  onkeyup="textAreaAdjust(this)" data-save-id="{{ $picture->saveModel()->id }}"  name="comment" id="" cols="30" rows="1">{{ $picture->saveModel()->comment }}</textarea>

						</div>
						@endforeach
					</div>
					@endforeach
					@endif
				</div>
				<div class="col-sm-12 col-xs-12">
					@if ($ownRoom->productPictures()->count() != 0)
					<h3 class="text-uppercase">{{ trans('frontend.common.items') }}</h3>
					

					
					@foreach($ownRoom->productPictures()->chunk(3) as $productsChunk)
					<div class="row">
						@foreach($productsChunk as $product)
						<div class="col-sm-3 col-xs-12">
							<div class="saved-item">

							<a href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}" tabIndex="-1" data-product-id="{{ $product->model_id }}" class="popup-product-open"><img src="/{{ $product->imagePath() }}" alt="" class="img-responsive"></a>
							</div>
							<textarea class="comment" placeholder="Комментарии..."  onkeyup="textAreaAdjust(this)" data-save-id="{{ $product->saveModel()->id }}"  name="comment" id="" cols="30" rows="1">{{ $product->saveModel()->comment }}</textarea>
						</div>
						@endforeach
					</div>
					@endforeach
					@endif

				</div>
				<div class="col-sm-12 col-xs-12">
					@if ($ownRoom->uploadedFiles->count() > 0)
					<h3 class="text-uppercase">{{ trans('frontend.common.saved-pictures') }}</h3>
					
						
							
							@foreach($ownRoom->uploadedFiles->chunk(4) as $pictures)
							<div class="row">
							@foreach($pictures as $picture)
							
								<div class="col-sm-3 col-xs-12">
									<div class="saved-item">
									<a href="/{{ $picture->imagePath() }}" tabIndex="-1" ><img src="/{{ $picture->imagePath() }}" alt="" class="img-responsive"></a>
									</div>
									<textarea class="comment uploadedfile" placeholder="Комментарии..."  onkeyup="textAreaAdjust(this)" data-uploaded-id="{{ $picture->id }}"  name="comment" id="" cols="30" rows="1">{{ $picture->comment }}</textarea>
								</div>
								
							
							@endforeach
								</div>
							@endforeach
						@endif
				</div>
			</div>
			<!--div class="text-center col-xs-12 margin-top-20 padding-top-20">
				<a href="/{{ LaravelLocalization::getCurrentLocale() }}/myroom/visualization?myroom={{-- $ownRoom->id --}}" class="c_btn c_btn_medium c_btn_green">{{-- trans('frontend.common.order-design') --}}</a>
				<div class="clear"></div>
			</div-->
		</div>
	</div>
    
</section><!-- Modal -->
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
function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (25+o.scrollHeight)+"px";
}
$("textarea.comment").on("focusout", function() {
	if ($(this).has('uploadedfile')) {
		var uploadedId = $(this).data('uploaded-id');
		var commentText = $(this).val();
		$.ajax({
			url  : '/ajax/common/edit-comment-uploaded',
			data : {
				uploaded_id : uploadedId,
				comment : commentText
			},
			success : function(e) {
				console.log(e);
			}
		});
	} else {
		var saveId = $(this).data('save-id');
		var commentText = $(this).val();
		$.ajax({
			url  : '/ajax/common/edit-comment',
			data : {
				save_id : saveId,
				comment : commentText
			},
			success : function(e) {
				console.log(e);
			}
		});
	}
});
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init () {
    var texts = document.getElementsByClassName("comment");
    
    for (var i = 0; i < texts.length; i++) {
    	el(texts[i]);
    }
    function el(text) {
		// observe(text, 'change',  resize);
	    observe(text, 'cut',     delayedResize);
	    observe(text, 'paste',   delayedResize);
	    observe(text, 'drop',    delayedResize);
	    // observe(text, 'keydown', delayedResize);

	    // text.focus();
	    // text.select();

   	 	resize();
	    function resize () {
	        text.style.height = 'auto';
	        text.style.height = text.scrollHeight+'px';
	    }
	    /* 0-timeout to get the already changed text */
	    function delayedResize () {
	        window.setTimeout(resize, 0);
    
	    }
    
	}
}
</script>


@stop
