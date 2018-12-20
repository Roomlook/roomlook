@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Orders
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.orders.create') !!}" class="btn btn-default">Add New</a>
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
			<th>ФИО</th>
			<th>Схема</th>
			<th>Размер</th>
			<th>Контакты</th>
			<th style="width: 300px">Фотографии</th>
			<th>Дата заказа</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($orders as $order)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $order->name !!}</td>
					<td><a href="/images/order/{{ $order->schema }}" download>скачать</a></td>
					<td>Площадь: {{ $order->square }}<br>Высота: {{ $order->height }}</td>
					<td>Email: {{ $order->email }}<br>Телефон: {{ $order->phone }}</td>
					<td>
						Комнаты:
						@foreach($order->own->roomPictures() as $picture)
									<a  href="/{{ $picture->imagePath() }}" target="_blank"><img src="/{{ $picture->imagePath() }}" alt="" style="width: 40px; margin: 5px;"></a>
								
						@endforeach
						<br>
						Товары:
						@foreach($order->own->productPictures() as $picture)
								<a  href="/{{ $picture->imagePath() }}" target="_blank"><img src="/{{ $picture->imagePath() }}" alt="" style="width: 40px; margin: 5px;"></a>
						@endforeach
						<br>
						Загруженные:
						@foreach($order->own->uploadedFiles as $picture)
								<a  href="/{{ $picture->imagePath() }}" target="_blank"><img src="/{{ $picture->imagePath() }}" alt="" style="width: 40px; margin: 5px;"></a>
							@endforeach
					</td>
		
					<td>{!! $order->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.orders.destroy', $order->id]]) !!}
							<a href="{!! route('admin.orders.show', $order->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.orders.edit', $order->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $orders !!}</div>
	</div>
</div>
@stop