@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Roompicturetag
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.roompicturetags.edit', $roompicturetag->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.roompicturetags.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $roompicturetag->id !!}</td>
            </tr>

			<tr>
                <td><b>Name</b></td>
                <td>{!! $roompicturetag->name !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $roompicturetag->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop