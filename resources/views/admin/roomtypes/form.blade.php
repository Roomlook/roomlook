@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>УПС!</strong> Ошибка.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.roomtypes.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.roomtypes.store']) !!}
    @endif
    	<div class="form-group">
        {!! Form::label('name_ru', 'Название:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('ru[name]', isset($model) ? $model->translate('ru')->name : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('name_en', 'Name:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('en[name]',  isset($model) ? $model->translate('en')->name : null, ['class' => 'form-control']) !!}
        </div> 
        <div class="form-group">
            {!! Form::label('seo_keywords_en', 'SEO keywords [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_keywords]', isset($model) ? $model->translate('en')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_keywords_ru', 'SEO keywords [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_keywords]', isset($model) ? $model->translate('ru')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>		
		
        <div class="form-group">
            {!! Form::label('seo_description_ru', 'SEO описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
    	    <div class="col-sm-9">
    	        {!! Form::textarea('ru[description]', isset($model) ? $model->translate('ru')->seo_description : null, ['class' => 'form-control editor-body1']) !!}
    	    </div>
    	</div>
        <div class="form-group">
            {!! Form::label('seo_description_en', 'SEO описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[description]', isset($model) ? $model->translate('en')->seo_description : null, ['class' => 'form-control editor-body2']) !!}
            </div>
        </div> 		
		 
    <div class="form-group">
        {!! Form::label('image', 'Фото 560x270px:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::file('image', null, ['class' => 'form-control']) !!}
            @if (isset($model))
                <img src="/images/roomtypes/{{ $model->image }}" alt="">
            @endif
        </div>
    </div>
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!} 
	
@section('style')
<link href="https://summernote.org/vendors/summernote/dist/summernote.css" rel="stylesheet">
@stop
@section('script') 
<script src="{!! asset('/js/editor/summernote.js') !!}"></script> 
<script src="{!! asset('/js/editor/summernote-ru-RU.js') !!}"></script> 
<script src="{!! asset('/js/editor/summernote_editor_settings.js') !!}"></script>

<script type="text/javascript">
/**
 * Settings for summernote editor.
 */

$(document).ready(function () {  

        var editor = $('.editor-body1');

        var configFull = {
            lang: 'ru-RU', // default: 'en-US'
            shortcuts: false,
            airMode: false,
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
            disableDragAndDrop: false,
            callbacks: {
                onImageUpload: function (files) {
                    uploadFile(files);
                },

                onMediaDelete: function ($target, editor, $editable) {

                    var fileURL = $target[0].src;
                    deleteFile(fileURL);

                    // remove element in editor
                    $target.remove();
                }
            }
        };

        // Featured editor
        editor.summernote(configFull);

        // Upload file on the server.
        function uploadFile(filesForm) {
            data = new FormData();

            // Add all files from form to array.
            for (var i = 0; i < filesForm.length; i++) {
                data.append("files[]", filesForm[i]);
            }
			 
			//var url = "/admin/papers/14/edit"; 
			//var url = "/ajax/uploader/upload"; 
			var url = "/admin/add_image"; 
			  
            $.ajax({
                data: data,
                type: "POST",
                url: url,
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,
                processData: false,
                success: function (images) { 
                    //console.log(images);
					
					//alert(images['url']); 
					if(images['count']==1) {
					
					var fileurl = 'https://roomlook.com/images/papers/articles/' + images['filename']; 
 
					editor.summernote('insertImage', fileurl);

					}else{
						
					var fileurl = 'https://roomlook.com/images/papers/articles/' + images['filename'];
					var node = document.createElement('div');
						
					node.className = 'owl-carousel once';
					node.innerHTML = '<div class="item"><img src="https://roomlook.com/images/papers/articles/' + images['filename'] + '"></div><div class="item"><img src="https://roomlook.com/images/papers/articles/' + images['filename2'] + '"></div>';
					
					editor.summernote('insertNode', node);  
					 
					}	
					
					/*	
					setTimeout(function() { alert(fileurl);


					}, 1000);        
						
                    // If not errors.
                    //if (typeof images['error'] == 'undefined') {
                    if (images['error'] == 'false') {

                        // Get all images and insert to editor.
                        for (var i = 0; i < images['url'].length; i++) {

                            editor.summernote('insertImage', images['url'][i], function ($image) {
                                //$image.css('width', $image.width() / 3);
                                //$image.attr('data-filename', 'retriever')
                            });
                        }
                    }
                    else {
                        // Get user's browser language.
                        var userLang = navigator.language || navigator.userLanguage;

                        if (userLang == 'ru-RU') {
                            var error = 'Ошибка, не могу загрузить файл! Пожалуйста, проверьте файл или ссылку. ' +
                                'Изображение должно быть не менее 500px!';
                        }
                        else {
                            var error = 'Error, can\'t upload file! Please check file or URL. Image should be more then 500px!';
                        }

                        alert(error);
                    }
					*/
					
                }
            });
        }

        // Delete file from the server.
        function deleteFile(file) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "/ajax/uploader/delete",
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,
                processData: false,
                success: function (image) {
                    //console.log(image);
                }
            });
        } 

});
</script>
<script type="text/javascript">
/**
 * Settings for summernote editor.
 */

$(document).ready(function () { 

        var editor = $('.editor-body2');

        var configFull = {
            lang: 'ru-RU', // default: 'en-US'
            shortcuts: false,
            airMode: false,
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
            disableDragAndDrop: false,
            callbacks: {
                onImageUpload: function (files) {
                    uploadFile(files);
                },

                onMediaDelete: function ($target, editor, $editable) {

                    var fileURL = $target[0].src;
                    deleteFile(fileURL);

                    // remove element in editor
                    $target.remove();
                }
            }
        };

        // Featured editor
        editor.summernote(configFull);

        // Upload file on the server.
        function uploadFile(filesForm) {
            data = new FormData();

            // Add all files from form to array.
            for (var i = 0; i < filesForm.length; i++) {
                data.append("files[]", filesForm[i]);
            }
			 
			//var url = "/admin/papers/14/edit"; 
			//var url = "/ajax/uploader/upload"; 
			var url = "/admin/add_image"; 
			  
            $.ajax({
                data: data,
                type: "POST",
                url: url,
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,
                processData: false,
                success: function (images) { 
                    //console.log(images);
					
					//alert(images['url']); 
					if(images['count']==1) {
					
					var fileurl = 'https://roomlook.com/images/papers/articles/' + images['filename']; 
 
					editor.summernote('insertImage', fileurl);

					}else{
						
					var fileurl = 'https://roomlook.com/images/papers/articles/' + images['filename'];
					var node = document.createElement('div');
						
					node.className = 'owl-carousel once';
					node.innerHTML = '<div class="item"><img src="https://roomlook.com/images/papers/articles/' + images['filename'] + '"></div><div class="item"><img src="https://roomlook.com/images/papers/articles/' + images['filename2'] + '"></div>';
					
					editor.summernote('insertNode', node);   
					 
					}	
					
					/*	
					setTimeout(function() { alert(fileurl);


					}, 1000);        
						
                    // If not errors.
                    //if (typeof images['error'] == 'undefined') {
                    if (images['error'] == 'false') {

                        // Get all images and insert to editor.
                        for (var i = 0; i < images['url'].length; i++) {

                            editor.summernote('insertImage', images['url'][i], function ($image) {
                                //$image.css('width', $image.width() / 3);
                                //$image.attr('data-filename', 'retriever')
                            });
                        }
                    }
                    else {
                        // Get user's browser language.
                        var userLang = navigator.language || navigator.userLanguage;

                        if (userLang == 'ru-RU') {
                            var error = 'Ошибка, не могу загрузить файл! Пожалуйста, проверьте файл или ссылку. ' +
                                'Изображение должно быть не менее 500px!';
                        }
                        else {
                            var error = 'Error, can\'t upload file! Please check file or URL. Image should be more then 500px!';
                        }

                        alert(error);
                    }
					*/
					
                }
            });
        }

        // Delete file from the server.
        function deleteFile(file) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "/ajax/uploader/delete",
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: false,
                processData: false,
                success: function (image) {
                    //console.log(image);
                }
            });
        } 

});
</script>
@stop
<?php /* 
	<script src="/js/ckeditor/ckeditor.js"></script>
	<script src="/js/ckfinder/ckfinder.js"></script>
     <script type="text/javascript">
        CKEDITOR.editorConfig = function( config ) {
            config.allowedContent = true;
            config.filebrowserBrowseUrl = '/laravel-filemanager?type=Files';
            config.filebrowserImageBrowseUrl = '/laravel-filemanager?type=Images';
            config.protectedSource.push(/<i[^>]*><\/i>/g);
        };

        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor, '') ;
        var editor2 = CKEDITOR.replace( 'ckeditor1' );
        CKFinder.setupCKEditor( editor2, '') ;


    </script>
*/ ?>
</div>