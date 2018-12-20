@extends('layouts.master')
@section('title','Добавление комнаты')
@section('content')
    <link rel="stylesheet" href="/css/basic.css">
    <link rel="stylesheet" href="/css/dropzone.css">

    <section id="main">
        <div class="container">
            <div class="col-md-offset-0 col-xs-offset-1">
                <form id="add-room-form" class="dropzone">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input type="text" required value="{{old('title')}}" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="">Описание</label>
                        <textarea name="description" id="" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->

                </form>
                <button type="submit" id="submit-add-room" class="btn btn-success center-block">Добавить</button>
            </div>
        </div>
    </section>
    <script src="/js/jquery-1.12.2.min.js"></script>
    <script src="/js/dropzone.js"></script>
    <script src="/js/dropzone-amd-module.js"></script>
    <script>
        Dropzone.options.addRoomForm = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            paramName : 'images',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            previewsContainer: ".dropzone-previews",
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // The setting up of the dropzone
            init: function() {
                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    //window.location = '/home/rooms';
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    console.log(files);
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        }
        var myDropzone = new Dropzone("form#add-room-form",
            {
                url: "/home/add-room",
            });
        $("#submit-add-room").on("click",function(){
            myDropzone.processQueue();
        })

    </script>
@stop