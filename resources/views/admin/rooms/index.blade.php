@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все комнаты
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.rooms.create') !!}?project_id={{ \Input::get('project_id') }}" class="btn btn-default">Add New</a>
		</div>
		<div></div>
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Фильтр
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" value="{{ \Input::get('pName') }}" placeholder="Название товара"/><br>
			@foreach(App\Models\RoomType::all() as $roomtype)

				<input type="checkbox" name="roomtypes[]" value="{{$roomtype->id}}" @if (\Input::has('roomtypes') && in_array($roomtype->id, \Input::get('roomtypes'))) checked @endif/>
				<label>{{$roomtype->name}}</label><br>
			@endforeach
			{!! Form::select('onpage',['10' => '10','20' => '20','50'=>'50','100' => '100', '200' => '200'], \Input::get('onpage') ) !!}
			<br>
			
			<input type="submit" value="ОК"/>
		   </form>
		  </div>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center"></th>
			<th class="text-center">#</th>
			<th>Название</th>
			<th>Позиция</th>

			<th>Добавлено</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($rooms as $room)
				<tr>
					<td class="text-center"><input type="checkbox" class="check" id="check" name="check[]" value="{{ $room->id }}"></td>
					<td class="text-center">{!! $no !!}</td>
					<td><a href="/admin/roompictures/?room_id={{ $room->id }}">{!! $room->title !!}</a></td>
					<td>{!! $room->position !!}</td>
					<td>{!! $room->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.rooms.destroy', $room->id]]) !!}
							<a href="{!! route('admin.rooms.show', $room->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="/admin/rooms/duplicate/{{ $room->id }}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-duplicate"></i></a>
							<a href="{!! route('admin.rooms.edit', $room->id) !!}?project_id={{ $room->project_id }}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							<a href="/admin/rooms/enable/{{ $room->id }}" class="btn @if ($room->trashed()) disabled-item @endif status-button btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon  glyphicon-off"></i></a>
							<button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="row">
			<ul class="list-inline">
				<li>
					<label for="check"><i class="fa fa-check"></i> Выбрать все</label>
				</li>
				<li>
					<a href="#" data-url="/admin/rooms/remove" id="delete-selected"><i class="fa fa-trash"></i>  Удалить</a>
				</li>

			</ul>
			
		</div>
		<div class="text-center">{!! $rooms->render() !!}</div>
	</div>
</div>
@stop