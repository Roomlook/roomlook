@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все заявки на автора
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Name</th>
			<th>Status</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($requesttoauthors as $requesttoauthor)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $requesttoauthor->user ? $requesttoauthor->user->name : 'безименний' !!}</td>
					<td>{!! $requesttoauthor->status !!}</td>
					<td>{!! $requesttoauthor->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.requesttoauthors.destroy', $requesttoauthor->id]]) !!}
							<a href="{!! route('admin.requesttoauthors.show', $requesttoauthor->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.requesttoauthors.edit', $requesttoauthor->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">{!! $requesttoauthors !!}</div>
	</div>
</div>
@stop