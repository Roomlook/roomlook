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
    {!! Form::model(['method' => 'POST']) !!}
    <div class="form-group">
        {!! Form::label('old_password', 'Текущий пароль:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::password('old_password', ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Новый пароль', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Потвердите пароль', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
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