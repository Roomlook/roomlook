@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Product
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.products.edit', $product->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $product->id !!}</td>
            </tr>



            <tr>
                <td><b>Created At</b></td>
                <td>{!! $product->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop