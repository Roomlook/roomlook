@extends('admin.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все проекты
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.projects.create') !!}" class="btn btn-default">Добавить проект</a>
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
	<table class="table table-stripped table-bordered" id="table_draggable">
		<thead>
			<th class="text-center"></th>
			<th class="text-center">#</th>

			<th>Название</th>
			<th>Автор</th>
			<th>Добавлено</th>
			<th class="text-center">Действия</th>
		</thead>
		<tbody>
			@foreach ($projects as $project)
				<tr project_id="{{ $project->id }}">
					<td><input type="checkbox" class="check" name="check[]" id="check" value="{{ $project->id }}"></td>
					<td class="text-center">{!! $project->order !!}</td>
					<td><a href="/admin/rooms?project_id={{ $project->id }}">{!! $project->name !!}</a></td>
					<td>{!! $project->author->user->name !!}</td>
					<td>{!! $project->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.projects.destroy', $project->id]]) !!}
							<a href="{!! route('admin.projects.show', $project->id) !!}" class="btn btn-sm btn-default" title="Посмотреть" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>

							<a href="/admin/projects/duplicate/{{ $project->id }}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-duplicate"></i></a>
							<a href="{!! route('admin.projects.edit', $project->id) !!}" class="btn btn-sm btn-default" title="Изменить" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							<a href="/admin/projects/enable/{{ $project->id }}" class="btn @if ($project->trashed()) disabled-item @endif status-button btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon  glyphicon-off"></i></a>
							<button type="submit" class="btn btn-sm btn-default" title="Удалить" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></button>
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
					<a href="#" data-url="/admin/projects/remove" id="delete-selected"><i class="fa fa-trash"></i>  Удалить</a>
				</li>

			</ul>
			
		</div>
	</div>
</div>
@stop
@section('script')
<script type="text/javascript" src="/js/RowSorter.js"></script>
<script type="text/javascript">
	$('#table_draggable').rowSorter({
		onDrop: function(tbody, row, new_index, old_index) {
        	var table = tbody.tagName === "TBODY" ? tbody.parentNode : tbody;

        	let indexes = {};
        	$('tbody > tr').each(function (index, value) {
        		indexes[index] = value.getAttribute('project_id');
        	});
        	$.ajax({
        		type: 'GET',
        		data: {
        			indexes
        		},
        		url: '/admin/projects/changeOrder',
        		success: function() {

        		}
        	});
    	}
	});
</script>
@stop