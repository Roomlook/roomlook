@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Упс!</strong> Ошибка.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.rooms.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.rooms.store']) !!}
    @endif
    	<div class="form-group">
	    {!! Form::label('project_id', 'Проект:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
           
            {!! Form::select('project_id', App\Models\ProjectTranslation::orderBy('name', 'ASC')->groupBy('project_id')->lists('name', 'project_id'),  \Input::get('project_id')  , ['class' => 'form-control']) !!}

        </div>
	    </div>
        <div class="form-group">
        {!! Form::label('title_ru', 'Название [RU]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('ru[title]', isset($model) && $model->translate('ru') ? $model->translate('ru')->title : null, ['class' => 'form-control']) !!}
        </div>
        </div>
        <div class="form-group">
        {!! Form::label('title_en', 'Название [EN]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('en[title]', isset($model) && $model->translate('en') ? $model->translate('en')->title : null, ['class' => 'form-control']) !!}
        </div>
        </div>
        <div class="form-group">
        {!! Form::label('in_main', 'На главной', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('in_main', [0 => 'Нет', 1 => 'Да'], isset($model) ? $model->in_main: null, ['class' => 'form-control']) !!}
        </div>
        </div>
        <div class="form-group">
        {!! Form::label('position', 'Позиция:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('position', null, ['class' => 'form-control']) !!}
        </div>
        </div>
        {{-- 
        <div class="form-group">
        {!! Form::label('body_room_ru', 'Описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('ru[body]',  isset($model) && $model->translate('ru') ? $model->translate('ru')->body : null, ['class' => 'form-control ckeditor']) !!}
        </div>
        </div>
        <div class="form-group">
        {!! Form::label('body_room_en', 'Описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('en[body]',  isset($model) && $model->translate('en') ? $model->translate('en')->body : null, ['class' => 'form-control ckeditor']) !!}
        </div>
        </div>
        --}}
        <div class="form-group">
            {!! Form::label('Стили', 'Стили:', ['class' => 'col-md-2 control-label']) !!}
             <div class="col-sm-9">
            {!! Form::select('styles[]', $styles, isset($room_style) ? $room_style: null, ['multiple' => 'multiple', 'class' => 'form-control']) !!}
            {!! $errors->first('styles', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('room_type_id', 'Тип комнаты:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('room_type_id', App\Models\RoomType::lists('name','id'), isset($model) ? $model->room_type_id : null , ['class' => 'form-control']) !!}
            </div>
        </div>
        @if (isset($model))
        <div class="form-group">
            {!! Form::label('status_id', 'Статус:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('status_id', App\Models\Status::lists('name','id'), null , ['class' => 'form-control']) !!}
            </div>
        </div>
        
        @else
        {!! Form::hidden('status_id',1) !!}
        @endif
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
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