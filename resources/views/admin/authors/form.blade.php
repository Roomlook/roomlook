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
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.authors.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.authors.store']) !!}
    @endif
        <div class="form-group">
            {!! Form::label('is_show', 'Показать на сайте:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('is_show', [0 => 'Нет', 1 => 'Да'], isset($model) ? $model->is_show : 0, ['class' => 'form-control']) !!}
             </div>
            {!! $errors->first('is_show', '<div class="text-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('type', 'Тип:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('type', [0 => 'Дизайнер', 1 => 'Фотограф'], isset($model) ? $model->type : (\Request::has('isPhoto') ? \Request::get('isPhoto') : 0), ['class' => 'form-control']) !!}
             </div>
            {!! $errors->first('type', '<div class="text-danger">:message</div>') !!}
        </div>
    	<div class="form-group">
            {!! Form::label('name', 'ФИО [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('name', isset($model) ? $model->user->name : null, ['class' => 'form-control']) !!}
             </div>
            {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('name_en', 'ФИО [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('name_en', isset($model) ? $model->user->name_en : null, ['class' => 'form-control']) !!}
             </div>
            {!! $errors->first('name_en', '<div class="text-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
            {!! Form::email('email', isset($model) ? $model->user->email : null, ['class' => 'form-control']) !!}
            </div>
            {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('website', 'Сайт:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('website', isset($model) ? $model->user->website : null, ['class' => 'form-control']) !!}
             </div>
            {!! $errors->first('website', '<div class="text-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('image', 'Картинка:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::file('image',  null, ['class' => 'form-control']) !!}
            </div>
            @if (isset($model))
            <img src="/{{ $model->imagePath() }}" alt="">
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('about_user_ru', 'О пользователе [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('ru[about]',  isset($model) && $model->translate('ru') ? $model->translate('ru')->about : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('about_user_en', 'О пользователе [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[about]',  isset($model) && $model->translate('en') ? $model->translate('en')->about : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('anons_user_ru', 'Анонс [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('ru[anons]',  isset($model) && $model->translate('ru') ? $model->translate('ru')->anons : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('anons_user_en', 'Анонс [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('en[anons]',  isset($model) && $model->translate('en') ? $model->translate('en')->anons : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('ru[city]', 'Город [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                 {!! Form::text('ru[city]', isset($model) && $model->translate('ru') ? $model->translate('ru')->city : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('en[city]', 'Город [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                 {!! Form::text('en[city]', isset($model) && $model->translate('en') ? $model->translate('en')->city : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('main_image', 'Главная фотография:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::file('main_image',  null, ['class' => 'form-control']) !!}
            </div>
            @if (isset($model))
            <img src="/{{ $model->imagePathMain() }}" alt="">
            @endif
        </div>
        
        <div class="form-group">
            {!! Form::label('ru_seo_description', 'SEO описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_description]', isset($model) && $model->translate('ru') ? $model->translate('ru')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('en_seo_description', 'SEO описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_description]', isset($model) && $model->translate('en') ? $model->translate('en')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('ru_seo_keywords', 'SEO keywords [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_keywords]', isset($model) && $model->translate('ru') ? $model->translate('ru')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('en_seo_keywords', 'SEO keywords [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_keywords]', isset($model) && $model->translate('en') ? $model->translate('en')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('phone_number', 'Телефон:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('phone_number',  null, ['class' => 'form-control']) !!}
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