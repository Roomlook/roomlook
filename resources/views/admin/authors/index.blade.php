@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все авторы
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.authors.create') !!}?isPhoto={{ isset($isPhoto) && $isPhoto }}" class="btn btn-default">Добавить новый</a>
		</div>
		<div></div>
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Фильтр
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" value="{{ \Input::get('pName') }}" placeholder="Название товара"/><br>
			<label for="">Показать на странице:</label>
			{!! Form::select('onpage',['10' => '10','20' => '20','50'=>'50','100' => '100', '200' => '200'], \Input::get('onpage') ) !!}
			<br>
			<input type="submit" value="ОК"/>
		   </form>
		  </div>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Пользователь</th>

			<th>Добавлено</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($authors as $author)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $author->user->name !!}</td>
		
					<td>{!! $author->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.authors.destroy', $author->id]]) !!}

							<a href="{!! route('admin.authors.show', $author->id) !!}" class="btn btn-sm btn-default" title="Посмотерть" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.authors.show', $author->id) !!}" class="btn btn-sm btn-default" title="Посмотерть" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="/admin/projects/authors/{{ $author->id }}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-duplicate"></i></a>
							<a href="{!! route('admin.authors.edit', $author->id) !!}" class="btn btn-sm btn-default" title="Изменить" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $authors->render() !!}</div>
	</div>
</div>
@stop