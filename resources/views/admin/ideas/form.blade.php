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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.ideas.update', $model->id]]) !!}
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
        {!! Form::open(['files' => true, 'route' => 'admin.ideas.store']) !!}
    @endif
    
    <div class="form-group">
        {!! Form::label('category', 'Категория:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('category', isset($model) ? $model->category : null, ['class' => 'form-control']) !!}
            {!! $errors->first('category', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('title', 'Название:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('title', isset($model) ? $model->title : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('short_desc', 'Краткое описание:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('short_desc', isset($model) ? $model->short_desc : null, ['class' => 'form-control'] ) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Содержание', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('body', isset($model) ? $model->body : null, ['class' => 'form-control','id' => 'ckeditor'] ) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('in_main', 'Отображать на главной', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('in_main', [0 => 'Нет', 1 => 'Да'], isset($model) ? $model->in_main : 0, ['class' => 'form-control']) !!}
         </div>
        {!! $errors->first('in_main', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('size', 'Размер', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('size', ['2x2' => '2x2', '2x1' => '2x1', '1x1' => '1x1'], isset($model) ? $model->size : null, ['class' => 'form-control']) !!}
         </div>
        {!! $errors->first('in_main', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('position', 'Позиция.', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            Имя проекта: <strong>{{ $model->title }}</strong>
            <div class="position-wrapper">
                <table width=100% height=100% border=1>
                    <?php $reserved = []; $k = 0; ?>

                    @for ($i = 0; $i < 3; $i++)
                        <tr>
                            @for ($j = 0; $j < 3; $j++)
                                @foreach($positions as $position)
                                    @if ($position->position == $k + 1)
                                    <?php
                                        $sizes = explode('x', $position->size);
                                        $reserved[] = $position->position; 
                                        if ($sizes[0] > 1) {

                                            $reserved[] = $position->position + 1;

                                        }

                                        if ($sizes[1] > 1) {

                                            $reserved[] = $position->position + 3; 

                                        }

                                        if ($sizes[1] > 1 && $sizes[0] > 1) {

                                            $reserved[] = $position->position + 4;

                                        }


                                     ?>
                                    <td colspan="{{ $sizes[0] }}" 
                                        rowspan="{{ $sizes[1] }}" width="{{ $sizes[0]*100 }}" height="{{ $sizes[1]*100 }}" style="text-align: center">
                                        <a href="https://roomlook.com/admin/ideas/{{ $position->id }}/edit">{{ $position->title }}</a>
                                    </td>
                                    @endif
                                @endforeach
                                @if (!in_array($k + 1, $reserved))
                                    <td colspan="1" rowspan="1" style="text-align: center">
                                        <input type="radio" name="position" value="{{ $k + 1 }}">
                                    </td>
                                @endif
    

                                <?php $k++; ?>
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('link_text', 'Название кнопки', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('link_text', [
                'frontend.common.go-to' => 'Перейти', 
                'frontend.common.read' => 'Читать',
                'frontend.common.more' => 'Подробнее'
                ], isset($model) ? $model->link_text : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('Image', 'Image:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::file('main_image', ['class' => 'form-control', 'multiple' => 'true']) !!}
            {!! $errors->first('Image', '<div class="text-danger">:message</div>') !!}
        </div>
    </div>
    @if (isset($model))
    <div class="form-group">
        <div class="col-sm-3 col-sm-offset-2">
            <img src="/{{ $model->main_image }}" alt="" class="img-responsive">
            <a href="/admin/ideas/remove-picture/{{ $model->id }}">Удалить</a>
        </div>
    </div>
    @endif
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    
</div>

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    .s1x1 {
        height: 100px;
        width: 100px;
        background: red;
    }
    .s2x2 {
        height: 200px;
        width: 200px;
        background: blue; 
    }
    .s2x1 {
        height: 100px;
        width: 200px;
        background: yellow;
    }
    .d-inline-block {
        display: inline-block;
    }
    .position-wrapper {
        width: 300px;
        height: 300px;
    }
    /*.m-10 {
        margin: 10px;
    }*/
</style>
@stop
@section('script')
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


    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

@stop