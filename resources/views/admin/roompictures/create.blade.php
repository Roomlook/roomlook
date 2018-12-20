@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Добавить фотографию
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.roompictures.index',['room_id' => \Input::get('room_id') ]) !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.roompictures.form')
        </div>
    </div>

@stop