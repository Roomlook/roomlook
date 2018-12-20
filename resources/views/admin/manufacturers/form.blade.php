@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Упс!</strong> не которых полях есть ошибки.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.manufacturers.update', $model->id]]) !!}
        @if (app('request')->input('pName') != null)
            <input type="hidden" name="pName_page" value="{{ app('request')->input('pName') }}">
        @endif
        @if (app('request')->input('onpage') != null)
            <input type="hidden" name="page_page" value="{{ app('request')->input('onpage') }}">
        @endif
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.manufacturers.store']) !!}
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
            {!! Form::label('url', 'Ссылка:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('url', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('body_ru', 'Описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('ru[body]', isset($model) && $model->translate('ru') ? $model->translate('ru')->body : null, ['class' => 'form-control ckeditor']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('body_en', 'Описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[body]', isset($model) && $model->translate('en') ? $model->translate('en')->body : null, ['class' => 'form-control ckeditor']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('logo', 'Logo:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::file('logo',['class' => 'form-control']) !!}
            </div>
        </div>
        @if(isset($model))
            <div class="form-group">
                @if($model->logo)
                    <img class="img-responsive" src="{!! asset('images/manufacturers/' . $model->logo) !!}">
                @endif
            </div>
        @endif
	</div>
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
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
{!! Form::close() !!}
