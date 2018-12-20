@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все фотографии
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.roompictures.create', ['room_id' =>  \Input::get('room_id') ]) !!}" class="btn btn-default">Добавить новый</a>
			@if (\Input::has('room_id') && App\Models\Room::find(\Input::get('room_id')))
			<a href="{!! route('admin.rooms.index', ['project_id' => App\Models\Room::find(\Input::get('room_id'))->project_id ]) !!}" class="btn btn-default">Назад</a>
			@else
			<a href="{!! route('admin.rooms.index') !!}" class="btn btn-default">Назад</a>
			@endif
		</div>
		<div></div>
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Фильтр
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" value="{{ \Input::get('pName') }}" placeholder="Название товара"/><br>
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
			<th>Фото</th>
			<th>Комната</th>
			<th>Скачать</th>
			<th>Главная фотография</th>
			<th>Добавленно</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($roompictures as $roompicture)
				<tr>
					<td class="text-center"><input type="checkbox" class="check" name="check[]" id="check" value="{{ $roompicture->id }}"></td>
					<td class="text-center">{!! $no !!}</td>
					<td><a href="/{{ $roompicture->imagePath('') }}" title="ImageName"><img src="/{{ $roompicture->imagePath('') }}"></a>
					<a download="/{{ $roompicture->imagePath('') }}" href="/{{ $roompicture->imagePath('') }}" title="ImageName">Cкачать</a></td>
					<td>{!! $roompicture->room->title !!}</td>
					<td></td>
					
					<td>{!! $roompicture->is_home_slider === 1 ? 'Да' : '' !!}</td>
					<td>{!! $roompicture->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.roompictures.destroy', $roompicture->id]]) !!}
							<a href="{!! route('admin.roompictures.show', $roompicture->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.roompictures.edit', $roompicture->id) !!}?room_id={{ \Input::get('room_id') }}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
					<a href="#" data-url="/admin/roompictures/remove" id="delete-selected"><i class="fa fa-trash"></i>  Удалить</a>
				</li>

			</ul>
			
		</div>
		<div class="text-center">{!! $roompictures !!}</div>
	</div>
</div>
@stop