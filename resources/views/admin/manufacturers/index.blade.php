@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
  	{{ session('success') }}
  	{{ session('error') }}
	<div class="panel-heading">
		Все производители
		<div class="panel-nav pull-right" style="margin-top: -7px;">

			<a href="/admin/manufacturers/import-excel" class="btn btn-default">Импорт Excel</a>
			<a href="{!! route('admin.manufacturers.create') !!}" class="btn btn-default">Добавить новый</a>
		</div>
		<div></div>
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Фильтр
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" value="{{ \Input::get('pName') }}" placeholder="Название товара"/><br><label for="">Показать на странице:</label>
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
			<th>Название</th>
			<th>Logo</th>
			<th>Создано:</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($manufacturers as $manufacturer)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $manufacturer->name !!}</td>
					<td><img style="width: 100px" src="/images/manufacturers/{{$manufacturer->logo}}"></td>
					<td>{!! $manufacturer->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.manufacturers.destroy', $manufacturer->id]]) !!}
							<a href="{!! route('admin.manufacturers.show', $manufacturer->id) !!}" class="btn btn-sm btn-default" title="Посмотреть" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.manufacturers.edit', 
								[
								'id' => $manufacturer->id,
								'pName' => app('request')->input('pName'),
								'onpage' => app('request')->input('onpage')
								]
							) !!}" class="btn btn-sm btn-default" title="Изменить" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $manufacturers->render() !!}</div>
	</div>
</div>
@stop