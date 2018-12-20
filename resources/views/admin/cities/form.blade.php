@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Произошла ошибка</strong> <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.cities.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.cities.store']) !!}
    @endif
        <div class="form-group">
            {!! Form::label('name_ru', 'Название:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[name]', isset($model) ? $model->translate('ru')->name : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('name_en', 'Name:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[name]', isset($model) ? $model->translate('en')->name : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('is_capital', 'Столица:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                @if (isset($model) && $model->is_capital == 1)
                {!! Form::checkbox('is_capital', '1', ['class' => 'form-control', 'checked' => 'checked']) !!}
                @else
                {!! Form::checkbox('is_capital', '1', ['class' => 'form-control']) !!}
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('country_id', 'Country:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
            {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
            {!! $errors->first('country_id', '<div class="text-danger">:message</div>') !!}
            </div>
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