@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Roomtype
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.roomtypes.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.roomtypes.form')
        </div>
    </div>

@stop