@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Order
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.orders.edit', $order->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.orders.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $order->id !!}</td>
            </tr>

			<tr>
                <td><b>Name</b></td>
                <td>{!! $order->name !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $order->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop