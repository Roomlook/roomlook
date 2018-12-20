@if(isset($model))
{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.categories.update', $model->id]]) !!}
@else
{!! Form::open(['files' => true, 'route' => 'admin.categories.store']) !!}
@endif
	<div class="form-group">
		{!! Form::label('ru_name', 'Название [RU]:') !!}
		{!! Form::text('ru[name]', null, ['class' => 'form-control']) !!}
		{!! $errors->first('ru_name', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('en_name', 'Название [EN]:') !!}
		{!! Form::text('en[name]', null, ['class' => 'form-control']) !!}
		{!! $errors->first('en_name', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('ru_description', 'Description [RU]:') !!}
		{!! Form::text('ru[description]', null, ['class' => 'form-control']) !!}
		{!! $errors->first('ru_description', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('en_description', 'Description [EN]:') !!}
		{!! Form::text('en[description]', null, ['class' => 'form-control']) !!}
		{!! $errors->first('en_description', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div class="form-group">
		{!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
	</div>
{!! Form::close() !!}
