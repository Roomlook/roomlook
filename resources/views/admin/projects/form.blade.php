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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.projects.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.projects.store']) !!}
    @endif
	
		<div class="form-group"> 
			<label for="square" class="col-md-2 control-label">Првеью для проекта:</label> 
			<div class="col-sm-9">
				{!! Form::file('image', ['class' => 'form-control', 'onchange' => 'previewFile(this)', 'name' => 'cropimage']) !!}
 
				<?php if($model->cropimage) { ?>
		<img src="/images/projects/<?php echo $model->cropimage; ?>" alt="" id="del-cropper">
		<img src="Загрузка картинки" alt="" id="cropper">
				<?php }else{ ?>
		<img src="Загрузка картинки" alt="" id="cropper">
				<?php } ?>
	 
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
			 
		
		/*
		var preview = document.getElementById('cropper');
		var file = document.querySelector('input[type=file]').files[0];
		var reader = new FileReader();
		 
		if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) { 
 
			reader.addEventListener("load", function () { 
				preview.src = reader.result;  
			}, false);
 
			if (file) {   
				reader.readAsDataURL(file);
			}
  
		}else{
	  
		alert('Загрузите картинку');
		return false;
 
		}
		*/ 
		 
	}
		  
    </script>
	
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
    	    {!! Form::label('author_project', 'Дизайнер:', ['class' => 'col-md-2 control-label']) !!}
    	    <div class="col-sm-9">
    	        {!! Form::select('author_id', App\Models\Author::lists('name', null, 0), isset($model) ? $model->author_id : null, ['class' => 'form-control']) !!}
    	    </div>
    	</div>	
        <div class="form-group">
            {!! Form::label('photograph_project', 'Фотограф:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('photograph_id', App\Models\Author::lists('name',null, 1), isset($model) ? $model->photograph_id : null, ['class' => 'form-control']) !!}
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
            {!! Form::label('square', 'Площадь:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('square', null, ['class' => 'form-control']) !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('short_desc_ru', 'Краткое описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[short_desc]', isset($model) && $model->translate('ru') ? $model->translate('ru')->short_desc : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('short_desc_en', 'Краткое описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[short_desc]',  isset($model) && $model->translate('en') ? $model->translate('en')->short_desc : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_description_ru', 'SEO описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_description]', isset($model) && $model->translate('ru') ? $model->translate('ru')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_description_en', 'SEO описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_description]', isset($model) && $model->translate('en') ? $model->translate('en')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_keywords_ru', 'SEO keywords [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_keywords]', isset($model) && $model->translate('ru') ? $model->translate('ru')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_keywords_en', 'SEO keywords [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_keywords]', isset($model) && $model->translate('en') ? $model->translate('en')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('is_new', 'Свежий?', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::checkbox('is_new', 1, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('is_active', 'На главную', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9"> 
               {!! Form::checkbox('is_active', false) !!} 
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('order', 'Order:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::number('order', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description_ru', 'Описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('ru[description]', isset($model) && $model->translate('ru') ? $model->translate('ru')->description : null, ['class' => 'form-control ckeditor']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description_en', 'Описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[description]', isset($model) && $model->translate('en') ? $model->translate('en')->description : null, ['class' => 'form-control ckeditor']) !!}
            </div>
        </div>
        <?php
            $default[0] = 'Нет';
            $relations = App\Models\ProjectRelation::lists('name', 'id');
            // $relation = array_merge($default, $relations);
        ?>
        <div class="form-group">
            {!! Form::label('project_relations_id', 'Связь:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('project_relations_id', [$default, $relations], isset($model) ? $model->project_relations_id : null, ['class' => 'form-control']) !!}
            </div>
        </div>  
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
	
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
</div>