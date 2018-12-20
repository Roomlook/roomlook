@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>УПС!</strong> Ошибка.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Добавить тэг</h4>
      </div>
      <?php 
        $room = App\Models\Room::find(\Input::get('room_id'));
      ?>
      <div class="modal-body">
        <?php $productIds = [];
            foreach (App\Models\Product::whereIn('relative_id', App\Models\ProductRelationship::where('project_id', $room->project_id)->lists('id'))->get() as $product) {
                $productIds[$product->id] = $product->name;
            }

         ?>
        {!! Form::open(['route' => 'admin.roompicturetags.store', 'id' => "add-tag-form"]) !!}
        {!! Form::select('product_id', $productIds, null, ['class' => 'form-control']) !!}
        {!! Form::hidden('percent_top',  null, ['class' => 'form-control', 'id' => 'top-value']) !!}
        {!! Form::hidden('percent_left', null, ['class' => 'form-control', 'id' => 'left-value']) !!}
        {!! Form::hidden('room_picture_id', null, ['class' => 'form-control', 'id' => 'picture-id']) !!}
        {!! Form::hidden('is_relative', 1, ['class' => 'form-control', 'id' => 'picture-id']) !!}
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" id="save-tag" class="btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</div>
<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.roompictures.update', $model->id],'id' => "upload"]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.roompictures.store', 'id' => "upload"]) !!}
    @endif
    <div class="form-group">
        {!! Form::label('room_id', 'Комната:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('room_id', App\Models\RoomTranslation::where('locale', 'ru')->lists('title','room_id'),\Input::get('room_id') ,['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group home_checkbox">
        {!! Form::label('is_home_slider', 'Главная фотография', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::checkbox('is_home_slider', 1, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('image-room', 'Фото (2080x1298px для главной: 250кб | для других с минимальной шириной или высотой 2080px):', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::file('image', ['class' => 'form-control','id' =>'image']) !!}
            
        </div>
    </div>
    {!! Form::close() !!}
    <div id="trash">
        <h1 class="text-center"><i class="fa fa-trash"></i></h1>
    </div>
    <div id="output" style="">
        <div class="dots">
            @if (isset($model))
            @foreach($model->allTags as $tag)
            <div class="tag-dot" style="left: {{$tag->percent_left}}%; top: {{ $tag->percent_top }}%;" data-tag-id="{{ $tag->id }}"></div>
            @endforeach
            @endif
        </div>
        @if (isset($model))
        <img src="/{{ $model->imagePath() }}" alt="" class="img-responsive" data-picture-id="{{ $model->id }}">
        @else
        <img src="" alt="" class="img-responsive" data-picture-id="">
        @endif
    </div>
</div>

@section('script')

        <script type="text/javascript">
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        </script>
<script src="/js/jquery.form.min.js"></script>
<script>
$(document).ready(function() {
    var options = { 
                beforeSubmit:  showRequest,
        success:       showResponse,
        dataType: 'json' 
        }; 

    $('body').delegate('#image','change', function(){
        $(".dots").html("");
        $('#upload').ajaxForm(options).submit();        
    }); 
    $('#is_home_slider').on('ifToggled', function(){
        console.log('ad');
        $('#upload').ajaxForm(options).submit();        
    }); 
    $('#output .dots').dblclick(function(e) {   
        $("#myModal").modal('show');
        var offset = $(this).offset();
        var x = e.pageX - offset.left - 15;
        var y = e.pageY - offset.top - 15;
        var width = $("#output img").width();
        var height = $("#output img").height();
        $("#top-value").val(y*100/height);
        $("#left-value").val(x*100/width);
        $("#picture-id").val($("#output img").data('picture-id'));
    });

    $("#save-tag").on("click",function(e) {
        $("#add-tag-form").ajaxForm({success: function(e) {
            console.log(e);
            if (!e.success) {
                console.log(e.errors);
                return;
            }
            var y = $("#top-value").val();
            var x = $("#left-value").val();
            $(".dots").append("<div data-tag-id='" + e.tagId + "' class='tag-dot' style='top: " + y + "%; left: " + x +"%;'></div>");
            $("#myModal").modal('hide');
        }}).submit();

    });
    var $dragging = null;

    $(document.body).on("mousemove", function(e) {
        if ($dragging) {
            
            $dragging.offset({
                top: e.pageY - 15,
                left: e.pageX - 15
            });

        }
    });

    $(document.body).on("mousedown", ".tag-dot", function (e) {
        $dragging = $(e.target);

    });

    $(document.body).on("mouseup", function (e) {
        if (!$dragging) return;
        var tagId = $dragging.attr('data-tag-id');
        var x = parseInt($dragging.css("left"));
        var y = parseInt($dragging.css("top"));
        if (x < 0 ||
            y < 0) {
            $dragging.remove();
            
            $.ajax({
                url: "/admin/roompicturetags/" + tagId,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}" },
                success: function(e) {
                    if (e.success) {
                        console.log("success deleted!!!");
                    }
                }
            });
        } else {
            var left = x*100/$("#output img").width();
            var top = y*100/$("#output img").height();
            $.ajax({
                url: "/admin/roompicturetags/" + tagId,
                data: {
                    percent_top: top,
                    percent_left: left,
                    _token: "{{ csrf_token() }}" 
                },
                type: 'PUT',
                success: function(e) {
                    if (e.success) {
                        console.log("success updated!!!");
                    }
                }
            });
        }
        $dragging = null;
        // if ($dragging.css("top") < 0 || $dragging.css("left") < 0) {
        //     $dragging.remove();
        // }
    });
});     
function showRequest(formData, jqForm, options) { 
    $("#validation-errors").hide().empty();
    $("#output").css('display','none');
    return true; 
} 
function showResponse(response, statusText, xhr, $form)  { 
    if(response.success == false)
    {
        var arr = response.errors;
        $.each(arr, function(index, value)
        {
            if (value.length != 0)
            {
                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
            }
        });
        $("#validation-errors").show();
    } else {
        console.log(response);
         $("#output img").attr("src","/"+response.file);
         $("#output img").attr("data-picture-id", response.picture_id);
         $("#output").css('display','block');

    }
}
</script>
<style>
    #trash {
        background-color: #eee;
        padding: 5px;
        color: #fff;
    }
    #trash h1 {
         padding: 10px 0px;
         margin: 0px;
         border: 1px dashed #fff;
    }
    .tag-dot {
        height: 30px;
        width: 30px;
        background: #fff;
        border: 5px solid #39b54a;
        position:absolute;
        border-radius: 50%;
    }
    #output {
        position:relative;
    }
    #output img {
        width: 100%;
    }
    .dots {
        position: absolute;
        width: 100%;
        height: 100%;
    }
    .modal-dialog {
        z-index: 1050;
    }
</style>
@stop