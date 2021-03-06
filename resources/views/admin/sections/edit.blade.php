@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Изменить раздел
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.sections.index') !!}" class="btn btn-default">назад</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.sections.form', ['model' => $section])
        </div>
    </div>

@stop