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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.roompicturetags.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.roompicturetags.store']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('room_picture_id', 'Фотография:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('room_picture_id', App\Models\RoomPicture::lists('id','id'), ['class' => 'form-control']) !!}
        </div>
        <div>
            <img src="" alt="Фото" id="img">
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('product_id', 'Товар:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">

            {!! Form::select('product_id', $products, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('percent_top', 'Растояние в сверху в процентах:', ['class' => 'col-md-2 control-label', 'id' => 'yCoordinate']) !!}
        <div class="col-sm-9">
            {!! Form::number('percent_top', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('percent_left', 'Растояние в слева в процентах:', ['class' => 'col-md-2 control-label', 'id' => 'xCoordinate']) !!}
        <div class="col-sm-9">
            {!! Form::number('percent_left',null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('is_relative', 'Похожий товар', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('is_relative',null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Связь с набором товаров</label>
        <div class="col-sm-9">
		<select class="js-example-basic-single" name="connect"> 
			@foreach($connects as $c)	 
			<option value="{{ $c->id }}">{{ $c->name }}</option>  
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

    <script>
        var x = 0;
        var y =0;


        var elem = document.getElementById('img');


        var imageSelector = document.querySelector("#room_picture_id");
        imageSelector.addEventListener('change', function() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Typical action to be performed when the document is ready:
                    var imagePath  = JSON.parse(xhttp.responseText).path;
                    console.log(xhttp.responseText);
                    console.log(imagePath);
                    if(imagePath){
                        elem.setAttribute('src', "/images/rooms/original/"+imagePath)
                    } else {
                        alert('Фото не найдено');
                    }

                }
            };
            xhttp.open("GET", "/admin/photo/image/" + this.value, true);
            xhttp.send();
        });
        var xCoordinate = document.querySelector("#percent_left");
        var yCoordinate = document.querySelector("#percent_top");

        elem.addEventListener("click", function(){
            x = event.clientX;
            y = event.clientY;
            console.log("X - " + x);
            console.log("Y - " + y);

            var elemSize = this.getBoundingClientRect();
            console.log(elemSize);
            var percentX = (x - elemSize.left)/elemSize.width;
            var percentY = (y - elemSize.top)/elemSize.height;
            xCoordinate.value = Math.floor(percentX * 100);
            yCoordinate.value = Math.floor(percentY * 100);
        });

    </script>
</div>