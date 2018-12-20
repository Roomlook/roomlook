@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Добавить магазинов
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.stores.index') !!}" class="btn btn-default">Назад</a>
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
        {!! Form::model($model, ['files' => true, 'method' => 'POST', 'route' => ['admin.stores.import-excel', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true,'method' => 'POST',  'route' => 'admin.stores.import-excel']) !!}
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

{!! Form::close() !!}

        </div>
    </div>

@stop
