@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Добавить новую комнату
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.rooms.index',['project_id' => \Input::get('project_id')]) !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.rooms.form')
        </div>
    </div>

@stop