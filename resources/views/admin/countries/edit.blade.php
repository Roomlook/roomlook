@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Country
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.countries.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.countries.form', ['model' => $country])
        </div>
    </div>

@stop