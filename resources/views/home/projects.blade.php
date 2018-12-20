@extends('layouts.master')
@section('content')
    <section id="main">
        <div class="container">
            <div class="col-md-12 col-md-offset-0" style="background-color: white;margin:20px 0;">
                <h1 class="green">Проекты {{$author->user->name}}</h1>
                <a href="/home/projects/create" class="btn btn-default pull-right">Создать проект</a>
                @foreach($projects as $project)
                    <div class="item">
                    <h1><a href="/home/projects/{{$project->id}}">{{$project->name}}</a></h1>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="modal fade" id="response-modal" role="dialog">
        <div class="modal-dialog modal-md" >
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="green text-center">Спасибо что оставили заявку на автора. Мы рассмотрим вашу заявку в ближайшее время.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
