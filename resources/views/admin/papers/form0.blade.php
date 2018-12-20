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

    <script src="/cropper/croppr.js"></script>
    <link rel="stylesheet" href="/cropper/croppr.css">
	
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.papers.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.papers.store']) !!}
    @endif 
		
		<div class="form-group"> 
			<label for="square" class="col-md-2 control-label">Првеью для главной:</label> 
			<div class="col-sm-9">
				{!! Form::file('image', ['class' => 'form-control', 'onchange' => 'previewFile(this)', 'name' => 'cropimage2']) !!}
  
		<img src="Загрузка картинки" alt="" id="cropper2"> 
			</div>
		</div>
		
		<div class="form-group"> 
			<label for="square" class="col-md-2 control-label">Првеью для статьи:</label> 
			<div class="col-sm-9">
				{!! Form::file('image', ['class' => 'form-control', 'onchange' => 'previewFile(this)', 'name' => 'cropimage']) !!}
  
		<img src="Загрузка картинки" alt="" id="cropper"> 
			</div>
		</div>
		 
    <script>
	
	function previewFile(input) {
		 
	        if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {  
                    $('#cropper')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); 
		
            }
			  
        var croppr = new Croppr('#cropper', {
			startSize: [1200, 600, 'px'],
            onInitialize: (instance) => { console.log(instance);  
			
			},
            onCropStart: (data) => { console.log('start', data);  

				$('input[name="width"]').val(data.width);
				$('input[name="height"]').val(data.height);
				$('input[name="x"]').val(data.x);
				$('input[name="y"]').val(data.y);

			},
            onCropEnd: (data) => { console.log('end', data);  
			
				$('input[name="width"]').val(data.width);
				$('input[name="height"]').val(data.height);
				$('input[name="x"]').val(data.x);
				$('input[name="y"]').val(data.y);
				
			},
            onCropMove: (data) => { console.log('move', data);  

				$('input[name="width"]').val(data.width);
				$('input[name="height"]').val(data.height);
				$('input[name="x"]').val(data.x);
				$('input[name="y"]').val(data.y);
			 
			}
        }); 
		
		croppr.desctroy();  
		croppr = null; 
		 
	}
		  
    </script>
	
	
        <div style="display:none;">
        <div class="form-group">
            {!! Form::label('width2', 'Ширина:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('width2', 600, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('height2', 'Высота:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('height2', 600, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('x2', 'X:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('x2', 0, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('y2', 'Y:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('y2', 0, ['class' => 'form-control']) !!}
            </div>
        </div>
        </div>
		
        <div class="form-group">
            {!! Form::label('width', 'Ширина:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('width', 1200, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('height', 'Высота:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('height', 600, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('x', 'X:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('x', 0, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('y', 'Y:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('y', 0, ['class' => 'form-control']) !!}
            </div>
        </div>
		
        <div class="form-group">
    	    {!! Form::label('name_ru', 'Название [RU]:', ['class' => 'col-md-2 control-label']) !!}
    	    <div class="col-sm-9">
    	        {!! Form::text('ru[name]', isset($model) && $model->translate('ru') ? $model->translate('ru')->name : null, ['class' => 'form-control']) !!}
    	    </div>
    	</div>
        <div class="form-group">
            {!! Form::label('name_en', 'Название [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[name]', isset($model) && $model->translate('en') ? $model->translate('en')->name : null, ['class' => 'form-control']) !!}
            </div>
        </div>  
        <div class="form-group">
    	    {!! Form::label('anons_ru', 'Анонс [RU]:', ['class' => 'col-md-2 control-label']) !!}
    	    <div class="col-sm-9">
    	        {!! Form::textarea('ru[anons]', isset($model) && $model->translate('ru') ? $model->translate('ru')->anons : null, ['class' => 'form-control editor-body1']) !!}
    	    </div>
    	</div>
        <div class="form-group">
    	    {!! Form::label('content_ru', 'Контент [RU]:', ['class' => 'col-md-2 control-label']) !!}
    	    <div class="col-sm-9">
				{!! Form::textarea('ru[content]', isset($model) && $model->translate('ru') ? $model->translate('ru')->content : null, ['class' => 'form-control editor-body2']) !!}
    	    </div>
    	</div>
        <div class="form-group">
            {!! Form::label('anons_en', 'Анонс [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[anons]', isset($model) && $model->translate('en') ? $model->translate('en')->anons : null, ['class' => 'form-control editor-body3']) !!}
            </div>
        </div> 
        <div class="form-group">
            {!! Form::label('content_en', 'Контент [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[content]', isset($model) && $model->translate('en') ? $model->translate('en')->content : null, ['class' => 'form-control editor-body4']) !!}
            </div>
        </div> 
		
    <div class="form-group">
		<label class="col-md-2 control-label">Категории:</label>
        <div class="col-sm-9"> 
		@if(isset($categories)) 
		<select class="js-example-basic-multiple" name="categories[]" multiple="multiple">
				 
			@foreach($categories as $c)	 
			<option value="{{ $c->paper_categories_id }}">{{ $c->name }}</option>  
			@endforeach 
			 
		</select>
		@else
			<input type="text" name="categories[]" />
		@endif
		</div>
    </div>
	
    <div class="form-group">
		<label class="col-md-2 control-label">Теги:</label>
        <div class="col-sm-9">
		<select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
			  
			@foreach($tags as $t)	  
			<option value="{{ $t->tag_id }}">{{ $t->title }}</option>  
			@endforeach  
			
		</select>
		</div>
    </div>
	
    <div class="form-group">
		<label class="col-md-2 control-label">На главную:</label>
        <div class="col-sm-9">
		{!! Form::checkbox('home', isset($model) ? $model->home : null, ['class' => 'form-control']) !!}
		</div>
    </div>
    <div class="form-group">
		<label class="col-md-2 control-label">Просмотров:</label>
        <div class="col-sm-9">
		{!! Form::number('views', isset($model) ? $model->views : null, ['class' => 'form-control']) !!}
		</div>
    </div>
		
        <?php /*
            $default[0] = 'Нет';
            $relations = App\Models\ProjectRelation::lists('name', 'id');
            // $relation = array_merge($default, $relations);
        ?>
        <div class="form-group">
            {!! Form::label('project_relations_id', 'Связь:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('project_relations_id', [$default, $relations], isset($model) ? $model->project_relations_id : null, ['class' => 'form-control']) !!}
            </div>
        </div>  */
		?>
		 
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
	
<?php /*	 
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
</script>

  <textarea>Next, get a free Tiny Cloud API key!</textarea>
*/ ?>


@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://summernote.org/vendors/summernote/dist/summernote.css" rel="stylesheet">
@stop
@section('script') 

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>

<script src="{!! asset('/js/editor/summernote.js') !!}"></script> 
<script src="{!! asset('/js/editor/summernote-ru-RU.js') !!}"></script> 
<script src="{!! asset('/js/editor/summernote_editor_settings.js') !!}"></script>
<script type="text/javascript">
/**
 * Settings for summernote editor.
 */

$(document).ready(function () {

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

});
</script>
<script type="text/javascript">
/**
 * Settings for summernote editor.
 */

$(document).ready(function () {

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

});
</script>
<script type="text/javascript">
/**
 * Settings for summernote editor.
 */

$(document).ready(function () {

    $(document).ready(function () {

        var editor = $('.editor-body3');

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

});
</script>
<script type="text/javascript">
/**
 * Settings for summernote editor.
 */

$(document).ready(function () {

    $(document).ready(function () {

        var editor = $('.editor-body4');

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

});
</script>
@stop
<?php /* 
<script src="/js/ckeditor/ckeditor.js"></script>
<script src="/js/ckfinder/ckfinder.js"></script>
     <script type="text/javascript">
        CKEDITOR.editorConfig = function( config ) {
            config.allowedContent = true;
            config.filebrowserBrowseUrl = '/admin/laravel-filemanager?type=Files';
            config.filebrowserImageBrowseUrl = '/admin/laravel-filemanager?type=Images';
            config.protectedSource.push(/<i[^>]*><\/i>/g);
        };

        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor, '') ;
        var editor2 = CKEDITOR.replace( 'ckeditor1' );
        CKFinder.setupCKEditor( editor2, '') ;


    </script>
*/ ?>
</div>