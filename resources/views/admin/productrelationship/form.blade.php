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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.productrelationship.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.productrelationship.store']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('name', 'Название:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('name', isset($model) ? $model->name : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('project_relations_id', 'Проект:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('project_id', App\Models\Project::lists('name','id', 1), isset($model) ? $model->project_id : null, ['class' => 'form-control']) !!}
        </div>
    </div>  
	
	<div class="form-group">
		<label class="col-md-2 control-label">Группы тегов:</label>
        <div class="col-sm-9">
		<select class="col-sm-3 js-example-basic-single" name="groupt[]">
			<option>Выберите группу тегов</option> 
			@if(isset($groupt))
			@foreach($groupt as $g)	
			<option value="{{ $g->tag_group_id }}">{{ $g->title }}</option> 
			@endforeach 
			@endif
		</select>
		</div>
    </div>
	
	<div class="form-group">
		<label class="col-md-2 control-label">Теги:</label>
        <div class="col-sm-9">
		<select class="col-sm-3 js-example-basic-multiple" name="tags[]" multiple="multiple">
 
			<?php /*$part2 = explode(';', $model->tags); ?> 
			
			@foreach($tags as $t)	 
			<?php if (in_array($t->tag_id, $part2)) { ?> 
			<option selected value="{{ $t->tag_id }}">{{ $t->title }}</option> 
			<?php }else{ ?>
			<option value="{{ $t->tag_id }}">{{ $t->title }}</option> 
			<?php } ?>  
			@endforeach */ ?>
			
		</select>
		</div>
    </div>
   
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
		
	<div>	
	@if(isset($products2))	
	@foreach($products2 as $p)	
	<div class="item product col-md-1">
		<div>
		<input checked type="checkbox" name="product_check[]" value="{{ $p->id }}" />
					
		<a href="/ru/product/{{ $p->id }}" tabindex="-1" data-product-id="{{ $p->id }}" class="popup-product-open">
		<div><img src="/images/products/{{ $p->image }}" class="center img-responsive" alt=""></div>
		<div><p style="font-size:12px;line-height:13px;height:40px;" class="title">{{ $p->name }}</p></div>
		</a>
		</div>
	</div> 
	@endforeach 
	@endif
	<div id="result">
	
	</div>
	</div>
	
    {!! Form::close() !!}

	
</div>
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() { 
    $('.js-example-basic-single').select2();
	$("[name='groupt[]']").on('change', grouptChanged);
    function grouptChanged() {
		var group_id = $(this).val(); 
		  
		$('.js-example-basic-multiple').off('select2:select');  
		  
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
	
	$("[name='tags[]']").on('change', productsChanged);
    function productsChanged() {
		var group_id = $(this).val(), 
			form = $("form").serialize();
		
		
		
		//alert(form);  
		//$('.js-example-basic-multiple').off('select2:select');  
		 
		$.ajax({ 
			url: 'https://roomlook.com/ru/api/group_products/?group=' + group_id,  
			data: form, 
            type: 'post', 
			success: function (data) {   
				
				obj = JSON.parse(data);
 
				$('#result').html(obj);
				
			} 
		});
		
		/*
		.done(function( msg ) {
			alert( "Data Saved: " + msg );
		});
		*/
		
    }
});
</script>
@stop