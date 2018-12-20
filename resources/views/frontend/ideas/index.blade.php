@extends('layouts.master')
@section('title','RoomLook')
@section('content')
<style>
        #catalog {
            width: 100% !important;
        }
    @media (max-width: 768px) {
        .idea-item {
            padding: 30px 10px;
        }
        
    }
    @media (min-width: 768px) {
        .margin-y-50 {
            padding: 0 150px;
        }
    }
</style>
    <section id="main" class="rooms-page room-wrapper">
        <div class="container">
            <div id="catalog">
                <div class="catalog-header">
                    
                </div>
                <div class="catalog-body list-group  rooms " data-count-item="1" >
                    
                    <div class="gridview ">
                        @foreach ($ideas as $idea)
                            <div style="margin-top: 40px">
                                <div class="idea-item {{ 's'.$idea->size }}">
                                    <div class="margin-y-50">
                                        <h5>{{ $idea->category }}</h5>
                                        <h3>
                                            <strong>
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}
                                            </a>
                                            </strong>
                                        </h3>
                                        <p>{{ $idea->short_desc }}</p>
                                    </div>
                                    <img src="{{ $idea->main_image }}" alt="" class="img-responsive">
                                    <br>
                                    <div id="idea-{{ $idea->id }}" class="collapse">
                                        {!! $idea->body !!}
                                    </div>
                                    <a href="#idea-{{ $idea->id }}" class="cst-link qew" data-toggle="collapse" >Показать</a>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="text-center">{!! $ideas->render() !!}</div>
          
        </div>
        <div class="clear"></div>
    </section>
@endsection

@section('script')
<script>
    $('.qew').click(function () {
        console.log($(this).text());
        if ($(this).text() == 'Показать') 
            $(this).text('Скрыть');
        else if ($(this).text() == 'Скрыть') 
            $(this).text('Показать');
    });
</script>
@if (\Request::has('top'))
<script>

    $(function() {
        $(document).scrollTop({{ \Request::get('top') }});
    });
</script>

@endif
@stop

