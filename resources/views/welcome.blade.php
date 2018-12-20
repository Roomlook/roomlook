@extends('layouts.master3')
@section('title','RoomLook')
@section('content')
    <section id="main">
        {{-- <div id="slider">
            <div class="main-slider">
                @if (isset($slider) && isset($sliderPicture))
                <div class="item" style="background-image: url(/{{ $sliderPicture->imagePath() }})">
                    <div class="tags" style="position: absolute; width: 100%; left: 0px; right: 0px; height: 100%;">

                        @foreach($sliderPicture->tags as $tag)
                           <a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}"  class="popup-product-open    c_clear_btn" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">
                                <div class="hint tag "  data-room-id="{{ $sliderPicture->room->id }}"  data-tag-id="{{ $tag->id }}" data-product-id="{{ $tag->product_id }}" style="top: {{ $tag->percent_top }}%; left: {{ $tag->percent_left }}%;">  <div class="ring-container">
                                    <div class="ringring"></div>
                                    <div class="ringring2"></div>
                                    <div class="circle"></div>
                                </div>
                                </div>
                            </a>    
                        @endforeach 
                    </div>

                    <div class="container-fluid " id="slider-c">
                        <div class="standard-style">
                            <h1>{{ $slider->name }}</h1>
                        </div>
                    </div>
                </div>
                @else
                <div class="item" style="background-image: url('/images/bg.jpg')">
                    <div class="tags" style="position: absolute; width: 100%; left: 0px; right: 0px; height: 100%;">
                        <div class="hint tag hidden-xs hidden-sm" style="top: 50%; left: 60%;">
                            <div class="ring-container">
                                <div class="ringring"></div>
                                <div class="ringring2"></div>
                                <div class="circle"></div>
                            </div>
                            <div class="pointer">
                                <img src="/images/pointer.png">
                            </div>
                            <div class="pointer-text">
                                Выбери подходящий товар и
                                узнай где он продается
                            </div>
                        </div>

                        <div class="hint tag hidden-xs hidden-sm" style="top: 16%; left: 30%;">
                            <div class="ring-container">
                                <div class="ringring"></div>
                                <div class="ringring2"></div>
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="hint tag hidden-xs hidden-sm" style="top: 60%; left: 75%;">
                            <div class="ring-container">
                                <div class="ringring"></div>
                                <div class="ringring2"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="sidebar-pr">

                        </div>
                    </div>

                    <div class="container-fluid " id="slider-c">
                        <div class="standard-style">
                            <h1>{!! trans('frontend.welcome.title') !!}</h1>
                        </div>
                    </div>
                </div>
                @endif
                <!-- <div class="item" style="background-image: url('/images/slide2.jpg')">
                    
                </div> -->
                <!-- <div class="item" style="background-image: url('/images/slider.jpg')">
                    <div class="container">
                        <div class="standard-style">
                            <h1>Дизайн нового уровня</h1>
                            <p>
                                Вдохновленно. Креативно. Функционально. <br/>
                                Поздравляем, Вы на шаг ближе к дому своей! мечты!
                            </p>
                            <br>
                            <a href="" class="c_btn_transparent c_btn_large">Начать</a>

                        </div>
                    </div>

                </div> -->
            </div>
        </div> --}}
        <div id="content">
            <div class="container-fluid padding-top-20">
            <!--  <div class="row">

                   <div class="col-sm-12">
                        <h1 class="text-left" style="display:inline">{{-- trans('frontend.common.newest') --}}</h1>
                        <div class="pull-right layers" data-item-element="room" data-body-element=".catalog-body">
                            <ul class="list-inline">
                                <li>
                                    <button class="green-link c_clear_btn c_btn_2column active c_btn_square" data-layer-type="column" data-layer-column="1">
                                        <div></div>
                                    </button>
                                </li>
                                            <li>
                                                <button class="green-link c_clear_btn c_btn_2column" data-layer-type="column" data-layer-column="2">
                                                    <i class="flaticon-square"></i>
                                                </button>
                                            </li>

                                <li>
                                    <a href="/?view=3"><button class="green-link c_clear_btn c_btn_listview" data-layer-type="row" data-layer-column="list">
                                        <i class="flaticon-signs"></i>
                                    </button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->


                <div class="container rooms homepage-rooms " data-count-item="1">
                    <div class="gridview">
                        {{-- 
                        <div class="col-md-12">
                            <h3 class="text-uppercase black projects-title">{{ trans('frontend.common.all') }}</h3>
                        </div>
                        --}}
                        @foreach ($projects as $project)
                            @include('partials.project')
                        @endforeach
                    </div>


                    <div class="clear"></div>
                </div>
                <div class="text-center">
                    {!! $projects->render() !!}
                </div>
                <!-- <p class="text-center">{!! trans('frontend.common.loading') !!}</p> -->
            </div>

        </div>
    </section>
@endsection

@section('script')

    <script>

        // function updateQueryStringParameter(uri, key, value) {
        //     var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        //     var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        //     if (uri.match(re)) {
        //         return uri.replace(re, '$1' + key + "=" + value + '$2');
        //     }
        //     else {
        //         return uri + separator + key + "=" + value;
        //     }
        // }

        // $(document).ready(function () {
        //     var nextPage = 11;
        //     var baseUrl = "/ajax/common/load-rooms";
        //     var url = updateQueryStringParameter(baseUrl, 'page', nextPage);
        //     // url = updateQueryStringParameter(url, 'paginate' , 1);
        //     console.log(url);
        //     var docHeight = 0;
        //     // setTimeout(
        //     //     function () {
        //     //         $("#slider-c").addClass("slider-content");
        //     //         $("#slider .tags").show();
        //     //         $(".tags .tag .pointer").show();
        //     //         setTimeout(function () {
        //     //             $(".tags .tag .pointer img").addClass("move");
        //     //             setTimeout(function () {
        //     //                 $(".pointer-text").show();
        //     //                 $(".sidebar-pr").css("right", "0px");
        //     //             }, 1000);
        //     //         }, 1500);
        //     //     }, 3000);
        //     var checker = true;
        //     $(window).scroll(function () {
        //         // var documentHeight = $(document).height();


        //         if ($(window).scrollTop() + $(window).height() + 1000 > $(document).height() && checker) {
        //             checker = false;
        //             $.ajax({
        //                 url: url, success: function (data) {
        //                     var $data = $(data).find('.gridview .project-block');
        //                     $data.each(function (e, i) {
        //                         $(i).find('img').on("load", function (e) {
        //                             $('.gridview').append($(i));
        //                         });
        //                     });
        //                     $data.find(".project-image-slide").owlCarousel({
        //                         navigation: true,
        //                         addClassActive: true,
        //                         slideSpeed: 300,
        //                         singleItem: true,
        //                         paginationSpeed: 400,
        //                         pagination: true,
        //                     });
        //                     $data.find(".project-product-slider").owlCarousel({
        //                         navigation: true,
        //                         addClassActive: true,

        //                         slideSpeed: 300,
        //                         paginationSpeed: 400,
        //                         pagination: false,
        //                     });
        //                     $('.gridview').append($data.find('.gridview .project-block'));
        //                     // $(".project-image-slide").trigger('refresh.owl.carousel');
        //                     $("project-product-slider").trigger('refresh.owl.carousel');


        //                      /*$('.listview').append($data.find('.listview .room')); , project-product-slider
        //                              $(".room").each(function(e, i) {
        //                          $(i).find(".item .popup-open.popup-room img").one("load", function() {
        //                              var imgHeight = $(this).height();
        //                              var imgWidth = $(this).width();
        //                              $(i).find(".tags").css({height: imgHeight, width: imgWidth, marginLeft: -imgWidth/2});
        //                          }).each(function() {
        //                            if(this.complete) $(this).load();
        //                          });

        //                           console.log(i);
        //                      });*/


        //                     checker = true;
        //                     nextPage++;
        //                     url = updateQueryStringParameter(window.location.href, 'page', nextPage);
        //                 }
        //             });
        //         }
        //     });


        // });
    </script>
@stop

