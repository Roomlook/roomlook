@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Статьи
	</div>
	<div class="panel-heading">
		<a href="{{ route('admin.ideas.create') }}">Новая запись</a>
		{{--<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Filter
		</a>
		<div class="collapse" id="collapseExample">
		  <div class="well">
		  <form class="form-horizontal">
			<input type="text" name="pName" placeholder="Название статьи"/><br>
			@foreach($categories as $categery)
				<input type="checkbox" name="filters[]" value="{{$categery->id}}"/>
				<label>{{$categery->name}}</label><br>
			@endforeach
			<input type="submit" value="Filter"/>
		   </form>
		  </div>
		</div>--}}
	</div>
	<div class="text-center">{!! $ideas->render() !!}</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center"></th>
			<th class="text-center">#</th>
			<th>Название</th>
			<th>Анонс</th>
			<th>Image</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($ideas as $idea)
				<tr>
					<td class=""><input type="checkbox" class="check" id="check" name="check[]" value="{{ $idea->id }}"></td>
					<td class="text-center">{!! $idea->id !!}</td>
					<td>{!! $idea->title !!}</td>
					<td>@if ($idea->short_desc ) {!! $idea->short_desc !!} @endif</td>

					<td>@if ($idea->main_image)<img src="/{{$idea->main_image }}" width="100px" alt=""/>@endif</td>
					<td>{!! $idea->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.ideas.destroy', $idea->id]]) !!}
							<a href="{!! route('admin.ideas.show', $idea->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="/admin/ideas/duplicate/{{ $idea->id }}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-duplicate"></i></a>
							<a href="{!! route('admin.ideas.edit',
								[
								'id' => $idea->id,
								'filters' => app('request')->input('filters'),
								'pName' => app('request')->input('pName'),
								'page' => app('request')->input('page')
								]

								) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							
							<button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
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
					<a href="#" data-url="/admin/ideas/remove" id="delete-selected"><i class="fa fa-trash"></i>  Удалить</a>
				</li>

			</ul>
			
		</div>
		<div class="text-center">{!! $ideas->render() !!}</div>
	</div>
</div>
@stop