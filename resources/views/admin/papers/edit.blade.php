@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Изменить статью
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.papers.index') !!}" class="btn btn-default">Назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.papers.form', ['model' => $paper])
        </div>
    </div>

@stop