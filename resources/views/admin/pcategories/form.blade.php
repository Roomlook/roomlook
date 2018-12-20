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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.pcategories.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.pcategories.store']) !!}
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
            {!! Form::label('geo', 'GEO:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('geo', isset($model) ? $model->geo : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_description_en', 'SEO описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_description]', isset($model) ? $model->translate('en')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_keywords_en', 'SEO keywords [EN]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('en[seo_keywords]', isset($model) ? $model->translate('en')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_description_ru', 'SEO описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_description]', isset($model) ? $model->translate('ru')->seo_description : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('seo_keywords_ru', 'SEO keywords [RU]:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('ru[seo_keywords]', isset($model) ? $model->translate('ru')->seo_keywords : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
        {!! Form::label('image', 'Фото (c белыми или прозрачными полями снизу минимум 80px, размер: 550x270px для широких и 360x270px для узких):', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
                @if (isset($model))
                    <img src="/{{ $model->imagePath() }}" alt="">
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('parent_id', 'Родитель:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                <select name="parent_id" id="parent_id">
                    <option value="0">Нет</option>
                    @foreach(App\Models\Pcategory::all() as $category)
                        <option value="{{ $category->id }}" {!! isset($model) && $model->parent_id == $category->id ? 'selected="selected"' : '' !!} >{{ $category->name }}</option>
                    @endforeach
                </select>
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