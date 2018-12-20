@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Products
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="/admin/products/import-excel" class="btn btn-default">Импорт Excel</a>
			<a href="{!! route('admin.products.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<div class="panel-heading">
		<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Filter
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" placeholder="Название товара"/><br>
			@foreach($categories as $categery)
				<input type="checkbox" name="filters[]" value="{{$categery->id}}"/>
				<label>{{$categery->name}}</label><br>
			@endforeach
			<input type="submit" value="Filter"/>
		   </form>
		  </div>
		</div>
	</div>
	<div class="text-center">{!! $products->render() !!}</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center"></th>
			<th class="text-center">#</th>
			<th>Name</th>
			<th>Manufacturer</th>
			<th>Image</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($products as $product)
				<tr>
					<td class=""><input type="checkbox" class="check" id="check" name="check[]" value="{{ $product->id }}"></td>
					<td class="text-center">{!! $product->id !!}</td>
					<td>{!! $product->name !!}</td>
					<td>@if ($product->manufaturer ) {!! $product->manufacturer->name !!} @endif</td>

					<td>@if ($product->pictures->count() > 0)<img src="/{{$product->pictures()->first()->imagePath() }}" width="100px" alt=""/>@endif</td>
					<td>{!! $product->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.products.destroy', $product->id]]) !!}
							<a href="{!! route('admin.products.show', $product->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="/admin/products/duplicate/{{ $product->id }}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-duplicate"></i></a>
							<a href="{!! route('admin.products.edit',
								[
								'id' => $product->id,
								'filters' => app('request')->input('filters'),
								'pName' => app('request')->input('pName'),
								'page' => app('request')->input('page')
								]

								) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							<a href="/admin/products/enable/{{ $product->id }}" class="btn @if ($product->trashed()) disabled-item @endif status-button btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon  glyphicon-off"></i></a>
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
					<a href="#" data-url="/admin/products/remove" id="delete-selected"><i class="fa fa-trash"></i>  Удалить</a>
				</li>

			</ul>
			
		</div>
		<div class="text-center">{!! $products->render() !!}</div>
	</div>
</div>
@stop