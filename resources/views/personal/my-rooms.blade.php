@extends('layouts.master')
@section('title','Изменить личные данные')
@section('content')
    <section id="main">
        <div class="container">
            <div class="col-md-offset-0 col-xs-offset-1">
                <a href="/home/add-room" class="btn btn-large btn-default">Добавить комнату</a>
                <a href="#"></a>
            </div>
            @each('partials.room',$rooms,'room')
        </div>
    </section>
@stop