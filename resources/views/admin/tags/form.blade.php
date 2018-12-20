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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.tags.update', $model->id]]) !!}
        @if (app('request')->input('filters') != null)
            @foreach (app('request')->input('filters') as $filter)
            <input type="hidden" name="filter_page[]" value="{{ $filter }}"> 
            @endforeach
        @endif
        @if (app('request')->input('pName') != null)
            <input type="hidden" name="pName_page" value="{{ app('request')->input('pName') }}">
        @endif
        @if (app('request')->input('page') != null)
            <input type="hidden" name="page_page" value="{{ app('request')->input('page') }}">
        @endif
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.tags.store']) !!}
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
		<label class="col-md-2 control-label">Группа тегов:</label>
        <div class="col-sm-9">
		<select class="col-sm-3 js-example-basic-multiple" name="tag_group_id">
	 
			<option value="1">Цвет</option> 
			<option value="2">Стиль</option> 
			<option value="3">Материал</option> 
			<option value="4">Цена</option> 
			<option value="5">Форма</option> 
			<option value="6">Размер</option>  
			
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
	 
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@stop

</div> 