@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Изменить автора
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.authors.index') !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.authors.form', ['model' => $author])
        </div>
    </div>

@stop