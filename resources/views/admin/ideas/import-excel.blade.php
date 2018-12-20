@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Добавить товары
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.manufacturers.index') !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
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
        {!! Form::model($model, ['files' => true, 'method' => 'POST', 'route' => ['admin.products.import-excel', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true,'method' => 'POST',  'route' => 'admin.products.import-excel']) !!}
    @endif
        
        <div class="form-group">
            {!! Form::label('file', 'Excel (CVS):', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::file('file',['class' => 'form-control']) !!}
            </div>
        </div>
        
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

        </div>
    </div>

@stop
