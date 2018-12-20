@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все разделы
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.sections.create') !!}" class="btn btn-default">Добавить новый</a>
		</div>
		
		<div></div>
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Фильтр
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" value="{{ \Input::get('pName') }}" placeholder="Название товара"/><br>
			<input type="submit" value="ОК"/>
		   </form>
		  </div>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Название</th>

			<th>Создано:</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($sections as $section)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $section->name !!}</td>
		
					<td>{!! $section->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.sections.destroy', $section->id]]) !!}
							<a href="{!! route('admin.sections.show', $section->id) !!}" class="btn btn-sm btn-default" title="Посмотреть" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.sections.edit', $section->id) !!}" class="btn btn-sm btn-default" title="Изменить" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							<button type="submit" class="btn btn-sm btn-default" title="Удалить" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">{!! $sections->render() !!}</div>
	</div>
</div>
@stop