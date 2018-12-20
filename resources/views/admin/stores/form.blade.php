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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.stores.update', $model->id]]) !!}
        @if (app('request')->input('city_id') != null)
            <input type="hidden" name="city_id_page" value="{{ app('request')->input('city_id') }}">
        @endif
        @if (app('request')->input('pName') != null)
            <input type="hidden" name="pName_page" value="{{ app('request')->input('pName') }}">
        @endif
        @if (app('request')->input('page') != null)
            <input type="hidden" name="page_page" value="{{ app('request')->input('page') }}">
        @endif
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.stores.store']) !!}
    @endif
        <div class="form-group row">
            {!! Form::label('is_show', 'Показать на сайте:', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('is_show', [0 => 'Нет', 1 => 'Да'], isset($model) ? $model->is_show : 0, ['class' => 'form-control']) !!}
             </div>
            {!! $errors->first('is_show', '<div class="text-danger">:message</div>') !!}
        </div>
    <div class="form-group row">
        {!! Form::label('name_ru', 'Название:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('ru[name]', isset($model) ? $model->translate('ru')->name : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('name_en', 'Name:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('en[name]', isset($model) ? $model->translate('en')->name : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <!-- <div class="form-group row">
        {!! Form::label('address_ru', 'Адрес:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('ru[address]', isset($model) ? $model->translate('ru')->address : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('address_en', 'Address:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('en[address]', isset($model) ? $model->translate('en')->address : null, ['class' => 'form-control']) !!}
        </div>
    </div> -->
    <div class="form-group row">
        {!! Form::label('short_description_ru', 'Краткое описание:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('ru[short_description]', isset($model) ? $model->translate('ru')->short_description : null, ['class' => 'form-control','id' => 'ckeditor'] ) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('short_description_en', 'Short Description:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('en[short_description]', isset($model) ? $model->translate('en')->short_description : null, ['class' => 'form-control','id' => 'ckeditor1']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('body_ru', 'Описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('ru[body]', isset($model) ? $model->translate('ru')->body : null, ['class' => 'form-control','id' => 'ckeditor2'] ) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('body_en', 'Описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('en[body]', isset($model) ? $model->translate('en')->body : null, ['class' => 'form-control','id' => 'ckeditor3']) !!}
        </div>
    </div>


    <div class="form-group row">
        {!! Form::label('url', 'URL:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('url', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="address-wrapper ">
        @if (isset($model))
        @foreach($model->cities as $city)
        <div class="form-group row">
            {!! Form::label('cities', 'Города:',['class'=>'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('cities[]', $cities, $city->id, ['class' => 'form-control js-example-basic-single']) !!}
                {!! $errors->first('stores', '<div class="text-danger">:message</div>') !!}
                <br>
                <br>
                {!! Form::text('address_ru[]', $city->pivot->address_ru, ['class' => 'form-control ru', 'placeholder' => 'Адрес [RU]', 'required' => 'required']) !!}
                <br>
                {!! Form::text('address_en[]', $city->pivot->address_en, ['class' => 'form-control en', 'placeholder' => 'Адрес [EN]', 'required' => 'required']) !!}
                <br>
                <input type="button" class="btn btn-danger remove-city" value="Удалить">
                <input type="hidden" name="city_id" value="{{ $city->id }}">
                <input type="hidden" name="store_id" value="{{ $model->id }}">
            </div>

        </div>
        @endforeach
        @else

        <div class="form-group row">
            {!! Form::label('cities', 'Города:',['class'=>'col-md-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::select('cities[]', $cities, isset($store_city) ? $store_city : null, ['class' => 'form-control js-example-basic-single']) !!}
                {!! $errors->first('stores', '<div class="text-danger">:message</div>') !!}
                <br>
                <br>
                {!! Form::text('address_ru[]', null, ['class' => 'form-control', 'placeholder' => 'Адрес [RU]', 'required' => 'required']) !!}
                <br>
                {!! Form::text('address_en[]', null, ['class' => 'form-control', 'placeholder' => 'Адрес [EN]', 'required' => 'required']) !!}
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <button class="add-city btn btn-primary" type="button">Добавить город</button>
            <br>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('logo', 'Logo (300x300):', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
        {!! Form::file('logo', ['class' => 'form-control']) !!}
        {!! $errors->first('logo', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>

    @if(isset($model))
        <div class="form-group">
            @if($model->logo)
                <img class="img-responsive col-sm-1 col-sm-offset-2" src="{!! asset('images/stores/' . $model->logo) !!}">
            @endif
        </div>
    @endif
    <div class="form-group">
        {!! Form::label('image', 'Фотография (800x800):', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
        {!! Form::file('image', ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>

    @if(isset($model))
        <div class="form-group">
            @if($model->image)
                <img class="img-responsive col-sm-1 col-sm-offset-2" src="{!! asset('images/stores/' . $model->image) !!}">
            @endif
        </div>
    @endif
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div></form>
    <div id="city_select" class="hidden">
        <div class="form-group row">
            <label  class="col-md-2 control-label">Города:</label>
            <div class="col-sm-9">
                <select class="form-control" name="cities[]">
                    @foreach($cities as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                
                <br>
                <br>
                <input class="form-control" placeholder="Адрес [RU]" required="required" name="address_ru[]" type="text">
                <br>
                <input class="form-control" placeholder="Адрес [EN]" required="required" name="address_en[]" type="text">
            </div>

        </div>
    </div>
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script src="/js/ckfinder/ckfinder.js"></script>
    <script type="text/javascript">
        CKEDITOR.editorConfig = function( config ) {
            config.allowedContent = true;
            config.filebrowserBrowseUrl = '/laravel-filemanager?type=Files';
            config.filebrowserImageBrowseUrl = '/laravel-filemanager?type=Images';
            config.protectedSource.push(/<i[^>]*><\/i>/g);
        };

        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor, '') ;
        var editor2 = CKEDITOR.replace( 'ckeditor1' );
        CKFinder.setupCKEditor( editor2, '') ;

        var editor = CKEDITOR.replace( 'ckeditor2' );
        CKFinder.setupCKEditor( editor, '') ;
        var editor2 = CKEDITOR.replace( 'ckeditor3' );
        CKFinder.setupCKEditor( editor2, '') ;


    </script>
</div>
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $(".add-city").on("click", function() {
        var address = $("#city_select > div").first().clone();
        address.appendTo(".address-wrapper");
        address.find("select").select2();   
    });
});
</script>
<script>
    $('.remove-city').click(function (e) {
        e.preventDefault();
        el = $(this);
        $.ajax({
            url: '/admin/city/remove',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'post',
            data: {
                store_id: $(this).siblings('input[name=store_id]').val(),
                city_id: $(this).siblings('input[name=city_id]').val(),
                en: $(this).siblings('input.en').val(),
                ru: $(this).siblings('input.ru').val()
            },
            success: function (response) {
                if (response.msg == 'deleted') {
                    el.parent().parent().remove();
                }
                console.log(response);
            }
        });
    });
</script>
@stop