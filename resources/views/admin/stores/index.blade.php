@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
  
  	{{ session('success') }}
  	{{ session('error') }}
	<div class="panel-heading">
		All Stores
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="/admin/stores/import-excel" class="btn btn-default">Импорт Excel</a>
			<a href="{!! route('admin.stores.create') !!}" class="btn btn-default">Add New</a>
		</div>
		
		<div></div>
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Фильтр
		</a>
		<div class="collapse" id="collapseExample">
		  	<div class="well">
			  <form class="form-horizontal">
				<input 
					type="text" 
					name="pName" 
					value="{{ \Input::get('pName') }}" 
					placeholder="Название товара" 
					class="form-control" />
				<br>
				<label for="">
					Показать на странице:
				</label>
				{!! Form::select('onpage',[
					'10' => '10',
					'20' => '20',
					'50' => '50',
					'100' => '100',
					'200' => '200'
					], 
					\Input::get('onpage') ) !!}
				<br>
				<label for="">Город</label>
				<select name="city_id" id="" class="form-control">
					<option value="">Все города</option>
					@foreach(App\Models\City::all() as $city)
					<option value="{{ $city->id }}">{{ $city->name }}</option>
					@endforeach
				</select>
				<br>
				
				
				<input type="submit" value="ОК" class="btn btn-success" />
			   </form>
		  	</div>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Name</th>
			<th>City</th>
			<th>Short Description</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($stores as $store)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $store->name !!}</td>
					<td>
					@foreach($store->cities as $city) 
						{!! $city->name !!},
					@endforeach
					</td>
					<td>{!! $store->short_description !!}</td>
					<td>{!! $store->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.stores.destroy', $store->id]]) !!}
							<a href="{!! route('admin.stores.show', $store->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.stores.edit', [
								'id' => $store->id,
								'city_id' => app('request')->input('city_id'),
								'pName' => app('request')->input('pName'),
								'page' => app('request')->input('page')
								] ) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $stores !!}</div>
	</div>
</div>
@stop