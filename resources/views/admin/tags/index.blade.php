@extends('admin.layouts.master')
@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		Все теги
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.tags.create') !!}" class="btn btn-default">Добавить тег</a>
		</div> 
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
			<th class="text-center">id</th> 
			<th>Название</th> 
			<th>Группа</th> 
			<th>Добавлено</th>
			<th class="text-center">Действия</th>
		</thead> 
		<tbody> 
			@foreach ($projects as $project)
				<tr project_id="{{ $project->id }}">
					<td><input type="checkbox" class="check" name="check[]" id="check" value="{{ $project->id }}">{{ $project->id }}</td>
					<td><a href="/admin/tag?tag_id={{ $project->id }}">{!! $project->title !!}</a></td>
					<td class="text-center">{{ $project->tag_group_id }}</td>
					<td>{!! $project->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group"> 
						
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table> 
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