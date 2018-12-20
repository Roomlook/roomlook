@extends($layout)

@section('content-header')
	<h1>
		{!! $title or 'All Users' !!} ({!! $users->count() !!})
		&middot;
		<a href="/admin/user/export" target="_blank">Экспорт</a>
		<small>{!! link_to_route('admin.users.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	@if(isset($search))
		@include('admin::users.search-form')
	@endif

	<table class="table">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $user->name !!}</td>
				<td>{!! $user->email !!}</td>
				<td>{!! $user->created_at !!}</td>
				<td class="text-center">
					<a href="{!! route('admin.users.edit', $user->id) !!}">Edit</a>
					&middot;
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($users) !!}
	</div>
@stop
