@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Idea
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.ideas.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.ideas.form', ['model' => $idea])
        </div>
    </div>

@stop