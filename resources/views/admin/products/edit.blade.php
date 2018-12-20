@extends('admin.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Product
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.products.form', ['model' => $product])
        </div>
    </div>

@stop