@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Country
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.countries.edit', $country->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.countries.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $country->id !!}</td>
            </tr>



            <tr>
                <td><b>Created At</b></td>
                <td>{!! $country->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop