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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.papers_categories.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.papers_categories.store']) !!}
    @endif 
	
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
    	    {!! Form::label('content_ru', 'Контент [RU]:', ['class' => 'col-md-2 control-label']) !!}
    	    <div class="col-sm-9">
    	        {!! Form::textarea('ru[content]', isset($model) && $model->translate('ru') ? $model->translate('ru')->content : null, ['class' => 'form-control ckeditor']) !!}
    	    </div>
    	</div>
        <div class="form-group">
            {!! Form::label('content_en', 'Контент [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[content]', isset($model) && $model->translate('en') ? $model->translate('en')->content : null, ['class' => 'form-control ckeditor']) !!}
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