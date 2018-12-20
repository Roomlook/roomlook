@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Упс!</strong> Ошибка.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    {!! Form::model($model, ['files' => true, 'method' => 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('user', 'Ф.И.О:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('name', $model->name, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('fb', 'Facebook:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('fb',  $model->fb , ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('vk', 'VK:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('vk',  $model->vk , ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('instagram', 'Instagram:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('instagram',  $model->instagram , ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('twitter', 'Twitter:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('twitter',  $model->twitter, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label"></label>
    <div class="col-sm-9">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
</div>