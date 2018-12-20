@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.pages.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.pages.store']) !!}
    @endif
    	<div class="form-group">
	    {!! Form::label('on_main_menu', '', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::checkbox('on_main_menu') !!}
	        On Main Menu
	    </div>
	</div>	<div class="form-group">
	    {!! Form::label('on_footer_menu', '', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::checkbox('on_footer_menu') !!}
	        On Footer Menu
	    </div>
	</div>	<div class="form-group">
	    {!! Form::label('published_at', 'Published At:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('published_at', null, ['class' => 'form-control']) !!}
	    </div>
	</div>
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>