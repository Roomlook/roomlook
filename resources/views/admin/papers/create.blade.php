@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Добавить статью
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.projects.index') !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.papers.form0')
        </div>
    </div>

@stop