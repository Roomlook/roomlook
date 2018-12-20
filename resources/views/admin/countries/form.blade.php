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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.countries.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.countries.store']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('name_ru', 'Название:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('ru[name]', isset($model) ? $model->translate('ru')->name : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('name_en', 'Name:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('en[name]', isset($model) ? $model->translate('en')->name : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
	    {!! Form::label('iso_code', 'Iso Code:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('iso_code', null, ['class' => 'form-control']) !!}
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