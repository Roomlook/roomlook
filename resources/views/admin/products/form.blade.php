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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.products.update', $model->id]]) !!}
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
        {!! Form::open(['files' => true, 'route' => 'admin.products.store']) !!}
    @endif
    
	
	
	
    <div class="form-group" style="display:none;">
		<label class="col-md-2 control-label">Категории (тест):</label>
        <div class="col-sm-9"> 
		@if(isset($pcategories)) 
			
		
		{!! Form::select('test[]', $pcategories, null, ['multiple' => 'multiple', 'class' => 'js-example-basic-multiple']) !!}
		@else
			<input type="text" name="test[]" />
		@endif
		</div>
    </div>
    <div class="form-group">  
		<label class="col-md-2 control-label">Комнаты:</label>
        <div class="col-sm-9"> 
		<select class="js-example-basic-multiple" name="test2[]" multiple="multiple">
		@foreach($rooms as $r => $i)	
	
	<?php $l = \DB::select('select * from `product_room` 
							where product_id = '.$model->id.' AND product_room_id = '.$r.''); ?> 
		 
		<option <?php echo ($l)?'selected':''; ?> value="{{ $r }}">{{ $i }}</option> 
		
		@endforeach 
		</select> 
		</div>
    </div>
	 
	<div class="form-group">
		<label class="col-md-2 control-label">Группы тегов:</label>
        <div class="col-sm-9">
		<select class="col-sm-3 js-example-basic-multiple" name="groupt[]">
			<option>Выберите группу тегов</option> 
			@foreach($groupt as $g)	
			<option value="{{ $g->tag_group_id }}">{{ $g->title }}</option> 
			@endforeach 
		</select>
		</div>
    </div>
	
	<div class="form-group">
		<label class="col-md-2 control-label">Теги:</label>
        <div class="col-sm-9">
		<select class="col-sm-12 js-example-basic-multiple" name="tags[]" multiple="multiple">
  
			@foreach($tags as $t)	
			
			<?php $l2 = \DB::select('select * from `product_tags` 
										where product_id = '.$model->id.' 
										AND tags_products_id = '.$t->tag_id.''); 
										 
										?> 
		  
			<option <?php echo ($l2)?'selected':''; ?> value="{{ $t->tag_id }}">{{ $t->title }}</option> 
			@endforeach  
			
		</select>
		</div>
    </div>
	 
	
    <div class="form-group">
        {!! Form::label('pcategory_id', 'Категория:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">{!! Form::select('pcategory_id', $pcategories, null, ['class' => 'form-control']) !!}
        {!! $errors->first('pcategory_id', '<div class="text-danger">:message</div>') !!}</div>
    </div> 
    <div class="form-group" style="display:none;">
        {!! Form::label('rooms', 'Комнаты:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">{!! Form::select('room_type_id', $rooms, null, ['class' => 'form-control']) !!}</div>
    </div> 
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
        {!! Form::label('short_body_ru', 'Краткое описание [RU]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('ru[short_body]', isset($model) ? $model->translate('ru')->short_body : null, ['class' => 'form-control','id' => 'ckeditor'] ) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('short_body_en', 'Краткое описание [EN]:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('en[short_body]', isset($model) ? $model->translate('ru')->short_body : null, ['class' => 'form-control','id' => 'ckeditor'] ) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('price', 'Стоимость:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('price', isset($model) ? $model->price : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('is_wide', 'Широкий формат:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('is_wide', [0 => 'Нет', 1 => 'Да'], isset($model) ? $model->is_wide : 0, ['class' => 'form-control']) !!}
         </div>
        {!! $errors->first('is_wide', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('manufacturer_id', 'Производитель:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">{!! Form::select('manufacturer_id', $manufacturers, null, ['class' => 'form-control']) !!}
        {!! $errors->first('manufacturer_id', '<div class="text-danger">:message</div>') !!}</div>
    </div>
    <div class="form-group">
        {!! Form::label('relative_id', 'Связь:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">{!! Form::select('relative_id', $relatives, null, ['class' => 'form-control']) !!}
        {!! $errors->first('relative_id', '<div class="text-danger">:message</div>') !!}</div>
    </div>
    <div id="stores">
        @if (isset($model))
        @foreach($model->store_cities as $storeCity)
        <div class="form-group row">
            <label  class="col-md-2 control-label">Магазин:</label>
            <div class="col-sm-9">
                <select class="form-control js-example-basic-single" name="stores[]">
                    <option value="0">Выберите магазин</option>
                    @foreach($stores as $key => $value)
                    <option value="{{ $key }}" @if ($key == $storeCity->store_id) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <select class="form-control js-example-basic-multiple" name="store_city[]" multiple="multiple">
                    <option value={{ $storeCity->id }} selected>{{ $storeCity->city->name }} {{ $storeCity->address_ru }}</option>
                </select>
                <br>
                <br>
                <input type="button" class="btn btn-danger remove-store" value="Удалить">
                <input type="hidden" name="store_city_id" value="{{ $storeCity->id }}">
                <input type="hidden" name="product_id" value="{{ $model->id }}">
            </div>
        </div>
        @endforeach
        @else
        <div class="form-group row">
            <label  class="col-md-2 control-label">Магазин:</label>
            <div class="col-sm-9">
                <select class="form-control js-example-basic-single" name="stores[]">
                    <option value="0" disabled selected>Выберите магазин</option>
                    @foreach($stores as $key => $value)
                    <option value="{{ $key }}" >{{ $value }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <select class="form-control js-example-basic-multiple" name="store_city[]" multiple="multiple">
                </select>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <button class="add-store btn btn-primary" type="button">Добавить магазин</button>
            <br>
        </div>
    </div>
	
    <div class="form-group">
        {!! Form::label('Image', 'Image:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::file('image[]', ['class' => 'form-control', 'multiple' => 'true']) !!}
            {!! $errors->first('Image', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>
    @if (isset($model))
    <div class="form-group">
        @foreach($model->pictures as $picture)
            <div class="col-sm-3 col-sm-offset-2">
                <img src="/{{ $picture->imagePath() }}" alt="" class="img-responsive">
                <a href="/admin/products/remove-picture/{{ $picture->id }}">Удалить</a>
            </div>
        @endforeach
    </div>
    @endif
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    @if(isset($model))
        <div class="form-group">
            @if($model->logo)
                <img class="img-responsive" src="{!! asset('images/stores/' . $model->logo) !!}">
            @endif
        </div>
    @endif
    {!! Form::close() !!}
    <div class="hidden" id="store_holder">
        <div class="form-group row">
            <label  class="col-md-2 control-label">Магазин:</label>
            <div class="col-sm-9">
                <select class="form-control" name="stores[]">
                    <option value="0" disabled selected>Выберите магазин</option>
                    @foreach($stores as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <select class="form-control" name="store_city[]" multiple="multiple">
                </select>
                <br>
                <br>

                <input type="button" class="btn btn-danger remove-store-1" value="Удалить">

            </div>
        </div>
    </div>
</div>

<?php /*
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    //$('.js-example-basic-multiple').select2();
});
</script>
@stop
*/ ?>

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

<script type="text/javascript">
/*
$(document).ready(function() { 
	$("[name='groupt[]']").on('change', grouptChanged);
    function grouptChanged() {
		var group_id = $(this).val(); 
		  
		$('.js-example-basic-multiple').off('select2:select');   alert('fsd');
		  
		$.ajax({
			url: 'https://roomlook.com/ru/api/groupt/' + group_id, 
			dataType : "json", 
			success: function (data, textStatus) {   
				//textStatus==success 
				$('.js-example-basic-multiple').select2({
					data: data
				}); 
			} 
		});
	 
    }
});
*/
</script>

<script type="text/javascript">// In your Javascript (external .js resource or <script> tag)
var stores = {!! json_encode($storesWithCity) !!};
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-single').select2();
    $('.js-example-tag-single').select2();
    $("[name='stores[]']").on('change', storeChanged);
    function storeChanged() {
        let storeId = $(this).val();
        const addresses = [];
        const addressOptions = [];
        stores.map((el) => {
            if (el.store_id == storeId) {
                addresses.push(el);
                addressOptions.push("<option value=" + el.id + ">" + el.city.name + " " + el.address_ru + "</option>");
            }
        });
        $(this).parent().find('[name="store_city[]"]').html(addressOptions);
    }
    $(".add-store").on("click", function() {
        var address = $("#store_holder > div").first().clone();
        address.appendTo("#stores");
        address.find("select").select2();
        address.find("[name='stores[]']").on('change', storeChanged);

    });
});
</script>
<script>
    $('.remove-store').click(function (e) {
        e.preventDefault();
        el = $(this);
        $.ajax({
            url: '/admin/store/remove',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'post',
            data: {
                store_city_id: $(this).siblings('input[name=store_city_id]').val(),
                product_id: $(this).siblings('input[name=product_id]').val()
            },
            success: function (response) {
                if (response.msg == 'deleted') {
                    el.parent().parent().remove();
                }
                console.log(response);
            }
        });
    });
    $('body').on('click', '.remove-store-1', function () {
        $(this).parent().parent().remove();
    });
</script>
@stop