@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Добавить производителя
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.manufacturers.index') !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.manufacturers.form')
        </div>
    </div>

@stop