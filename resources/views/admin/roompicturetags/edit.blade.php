@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Roompicturetag
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.roompicturetags.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.roompicturetags.form', ['model' => $roompicturetag])
        </div>
    </div>

@stop