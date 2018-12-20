@extends('layouts.master')
@section('title','RoomLook')
@section('content')
<style>
    .project-image-slide {
        height: 500px;
    }
    .owl-pagination {
        display: none;
    }
    @media (max-width: 767px) {
        .project-image-slide {
            height: 180px;
        }
        .project-block {
            box-shadow: none !important;
            padding: 0px !important;
            background: transparent !important;
        }
        .project-block > .tempcl {
            background: transparent !important;
            padding: 10px !important;
            height: auto !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            box-shadow: none !important;
        }
        .pqrw {
            padding: 10px !important;
        }
        td {
            width: 100% !important;
            display: flex;
        }

    }
    
    @media (min-width: 768px) and (max-width: 1024px) {
        .project-block > div {
            height: auto !important;
        }
    }
    @media (max-width: 1459px) {
        .idea-item {
            padding-right: 5px !important;
            padding-left: 5px !important;
        }
    }
    .idea-item {
        height: 100%;
    }
    td > div {
        position: relative;
        height: 100%;
    }
    .s2x2 {
        padding-bottom: 120px;
    }
    .s2x2, .s2x1 {
        padding-top: 100px;
    }
    .category-image {
        border-radius: 0px;
    }
    .item.pg-items img{
        width: 100%;
    }
    .no-grad:before {
        background: none !important;
    }
    .pos-abs {
        position: absolute;
        bottom: 5px;
        right: 15px;
        left: 15px;
        text-align: center;
    }
    .pos-abs a {
        border: none !important;
        color: #676767;
        font-size: 27px;
    }
    .boxsh {
        -webkit-box-shadow: 5px 5px 10px 0px rgba(153,153,153,1);
        -moz-box-shadow: 5px 5px 10px 0px rgba(153,153,153,1);
        box-shadow: 5px 5px 10px 0px rgba(153,153,153,1);
    }
    .boxsh-s {
        -webkit-box-shadow: 1px -1px 10px 1px rgba(153,153,153,1);
        -moz-box-shadow: 1px -1px 10px 1px rgba(153,153,153,1);
        box-shadow: 1px -1px 10px 1px rgba(153,153,153,1);
    }
    .link-hover:hover, .hr-link:hover, .cst-link:hover {
        border-color: #9f48da !important;
        background: #9f48da;
        color: white;
    }
    .link-hover, .hr-link, .cst-link {
        transition: .5s;
    }
    .project-block {
        margin-bottom: 20px;
    }
    .margin-left-10 {
        margin-left: 20px;
    }
    .p-center {
        padding: 0px 20px;
    }
</style>
    <section id="main">
        <div id="content">
            <div class="container padding-top-20">
                <div class="rooms homepage-rooms " data-count-item="1">
                    <div class="row">
                        <h1 style="margin-top: 0; margin-bottom: 20px;" class="margin-left-10">{{ trans('frontend.common.new-projects') }}</h1>   
                        @foreach ($projects as $key => $project)
                        @if ($project->order_in_main == 3)
                            <div class="project-block col-md-12 padding-7px pqrw boxsh" data-room-id="{{ $project->rooms()->first()->id }}">
                                <div class="project-wrapper">
                                    <div class="project-content">
                                        <?php $pic = $project->pictures(10, [], false);?>
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                        <div class="project-image col-md-12 project-image-slide">
                                            @foreach($pic as $p)

                                            <div class="item projectSS" >
                                                <div class="project-image-el" >
                                                <img src="/{{ $p->imagePath() }}" class="img-responsive">
                                                <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                                            </div></div>
                                            @endforeach
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="project-name">
                                    <h1 class="project-title">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                        @if ($project->name)
                                            {{ $project->name }}
                                        @else
                                            {{ $project->name }}
                                        @endif
                                        </a>
                                    </h1>
                                    @if (isset($project->author->user->name) and $project->author->user->name != null)
                                    <p class="project-desc">{{ trans('frontend.common.designer') }} <strong>{{ $project->author->user->name }}</strong></p>
                                    @endif
                                </div>                   
                            </div>
                        @else
                            <div class="project-block col-md-4 padding-7px" data-room-id="{{ $project->rooms()->first()->id }}" style="
                            background: transparent;
                            @if ($key == 1)
                            padding-right: 10px;
                            padding-left: 0px;
                            @elseif ($key == 2)
                            padding-right: 10px;
                            padding-left: 10px;
                            @else
                            padding-right: 0px;
                            padding-left: 10px;
                            @endif
                            ">
                                <div style="background: white;padding: 20px;height: 360px;" class="tempcl boxsh">
                                    <div class="project-wrapper" style="margin: 0px">
                                        <div class="project-content">
                                            <?php $pic = $project->pictures(1, [], true);?>
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                            <div class="mh-1 project-image col-md-12" >
                                                @foreach($pic as $p)
                                                <div class="item projectSS" >
                                                    <div class="project-image-el" >
                                                    <img src="/{{ $p->imagePath() }}" class="img-responsive">
                                                    <div class="c_btn_transparent6 project_more c_btn_medium2">{{ trans('frontend.common.see') }}</div>
                                                </div></div>
                                                @endforeach
                                            </div>
                                            </a>
                                        </div>
                                    </div> 
                                    <div class="project-name hqw">
                                        <h1 class="project-title" style="width: 99%;">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/project/s/{{ $project->id }}">
                                            @if ($project->name)
                                                {{ $project->name }}
                                            @else
                                                {{ $project->name }}
                                            @endif
                                            </a>
                                        </h1>
                                        @if (isset($project->author->user->name) and $project->author->user->name != null)
                                        <p class="project-desc">{{ trans('frontend.common.designer') }} <strong>{{ $project->author->user->name }}</strong></p>
                                        @endif
                                    </div>   
                                </div>              
                            </div>
                        @endif
                        @endforeach
                        <p class="p-center">Эта светлая студия в Москве, оформленная Марией Дадиани, - практически наглядное пособие по тому, как сделать интерьер маленькой однушки уютным, нескучным и изысканным. Хозяин этой небольшой квартиры оказался противником типичных мужских интерьеров: тёмным цветам и брутальным фактурам он предпочёл свет, разумную планировку и яркие акценты. Ситуацию осложнял размер однокомнатной квартиры, но дизайнер Мария Безрукова нашла способ превратить её в комфортную. </p>
                        <div class="col-md-3 col-md-offset-1"><hr style="border-top: 1px solid black;"></div>
                        <div class="col-md-4" style="text-align: center"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects" class="hr-link">Смотреть больше проектов</a></div>
                        <div class="col-md-3"><hr style="border-top: 1px solid black;"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="container">
                <div class="">
                    <div class="row">
                    <h1 class="margin-left-10">{{ trans('frontend.common.posts') }}</h1>   
                    
                        <table width=100% height=100% style="margin-left: -5px;">
                        <?php $reserved = []; $k = 0; ?>

                        @for ($i = 0; $i < 3; $i++)
                            <tr>
                                @for ($j = 0; $j < 3; $j++)
                                    @foreach ($ideas as $idea)
                                        @if ($idea->position == $k + 1)
                                        <?php
                                            $sizes = explode('x', $idea->size);
                                            $reserved[] = $idea->position; 
                                            if ($sizes[0] > 1) {
                                                $reserved[] = $idea->position + 1;
                                            }
                                            if ($sizes[1] > 1) {
                                                $reserved[] = $idea->position + 3; 
                                            }
                                            if ($sizes[1] > 1 && $sizes[0] > 1) {
                                                $reserved[] = $idea->position + 4;
                                            }
                                         ?>
                                        <td colspan="{{ $sizes[0] }}" 
                                            rowspan="{{ $sizes[1] }}" style="width: {{ $sizes[0] * 33 }}%; padding: 10px;">
                                            @if ($idea->size == '2x1')
                                            <div>
                                                <div class="idea-item s{{ $idea->size }}" style="">
                                                    <div class="col-md-6">
                                                        <img src="{{ $idea->main_image }}" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>{{ $idea->category }}</h5>
                                                        <h3>
                                                            <strong>
                                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}
                                                            </a>
                                                            </strong>
                                                        </h3>
                                                        <p>{{ $idea->short_desc }}</p>
                                                    </div>
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" class="cst-link">{{ trans($idea->link_text) }}</a>
                                                </div>
                                            </div>
                                            @else
                                            <div>
                                                <div class="idea-item {{ 's'.$idea->size }}">
                                                    @if ($idea->size == '1x1' or $idea->size == '1x2')
                                                        <div class="h-120px">
                                                            <h6>{{ $idea->category }}</h6>
                                                            <h4>
                                                                <strong>
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}
                                                                </a>
                                                                </strong>
                                                            </h4>
                                                            <p>{{ substr($idea->short_desc, 0, 200) }}</p>
                                                        </div>
                                                    @else
                                                        <div class="margin-y-50">
                                                            <h5>{{ $idea->category }}</h5>
                                                            <h3>
                                                                <strong>
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" style="margin-bottom: 0px;color: #000;">{{ $idea->title }}
                                                                </a>
                                                                </strong>
                                                            </h3>
                                                            <p>{{ substr($idea->short_desc, 0, 200) }}</p>
                                                        </div>
                                                    @endif
                                                    <img src="{{ $idea->main_image }}" alt="" class="img-responsive">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" class="cst-link">{{ trans($idea->link_text) }}</a>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                        @endif
                                    @endforeach
                                    @if (!in_array($k + 1, $reserved))
                                        
                                        <td colspan="1" rowspan="1">
                                            
                                        </td>
                                    @endif
        

                                    <?php $k++; ?>
                                @endfor
                            </tr>
                        @endfor
                    </table>


                    </div>
                    
                    <div class="row" style="margin-left: -12px; margin-top: 10px">
                        <p class="p-center">Эта светлая студия в Москве, оформленная Марией Дадиани, - практически наглядное пособие по тому, как сделать интерьер маленькой однушки уютным, нескучным и изысканным. Хозяин этой небольшой квартиры оказался противником типичных мужских интерьеров: тёмным цветам и брутальным фактурам он предпочёл свет, разумную планировку и яркие акценты. Ситуацию осложнял размер однокомнатной квартиры, но дизайнер Мария Безрукова нашла способ превратить её в комфортную. </p>
                        <div class="col-md-3 col-md-offset-1"><hr style="border-top: 1px solid black;"></div>
                        <div class="col-md-4" style="text-align: center"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/ideas" class="hr-link">Смотреть больше статей</a></div>
                        <div class="col-md-3"><hr style="border-top: 1px solid black;"></div>
                    </div>
                </div>
            </div>
            <div class="container padding-top-20 mn">
                <div class="">
                    <div class="row" style="margin-left: -12px;">
                        <div class="sel-fur-bg boxsh">
                        <h1 style="margin: 10px 15px;">{{ trans('frontend.common.selection-furniture') }}</h1>
                            @include('partials.room-grid', ['room' => $room])
                            <p>{{ $room->body }}</p>
                            <div class="row margin-top-30">
                                <p class="p-center">Эта светлая студия в Москве, оформленная Марией Дадиани, - практически наглядное пособие по тому, как сделать интерьер маленькой однушки уютным, нескучным и изысканным. Хозяин этой небольшой квартиры оказался противником типичных мужских интерьеров: тёмным цветам и брутальным фактурам он предпочёл свет, разумную планировку и яркие акценты. Ситуацию осложнял размер однокомнатной квартиры, но дизайнер Мария Безрукова нашла способ превратить её в комфортную. </p>
                                <div class="col-md-3 col-md-offset-1"><hr style="border-top: 1px solid black;"></div>
                                <div class="col-md-4" style="text-align: center"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects" class="hr-link">Смотреть больше мебели</a></div>
                                <div class="col-md-3"><hr style="border-top: 1px solid black;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container padding-top-20">
                <div class="">
                    <div class="roomtype-categories">
                        <h1 style="margin-top: 40px;" class="margin-left-10">{{ trans('frontend.common.catalog') }}</h1>
                        <div class="row">
                            @foreach($catalogs as $key => $pcategory)
                            @if ($key == 3)
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-xs-12 {!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                            <div class="category-holder boxsh-s" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}"><div class="no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @else
                            @if ($key == 0 or $key == 4)
                            <div class="col-md-5">
                                <div class="row">
                            @endif
                            @if($key == 2)
                                <div class="row">
                            @endif
                                    <div class="col-xs-12 {!! $pcategory->classes !!} category-item" style="{!! $pcategory->styles !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                            <div class="category-holder boxsh-s" style="height: 100%;">
                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}"><div class="no-grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                                    
                                                </div></a>
                                                <div class="pos-abs">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}" class="category-name" style="border: 1px solid;padding: 0.2rem 1.5rem;">{{ $pcategory->name }}</a>
                                                </div>
                                                <div class="arrow-catalog product-arrow">
                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                                        <div ></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @if($key == 1)
                                    </div>
                                @endif
                                @if($key == 2)
                                    </div>
                                </div>
                                @endif
                            @endif
                            
                            @endforeach
                        </div>

                        </div>

                    </div>
                    <div class="row">
                                <p class="p-center" style="margin-top: 10px">Эта светлая студия в Москве, оформленная Марией Дадиани, - практически наглядное пособие по тому, как сделать интерьер маленькой однушки уютным, нескучным и изысканным. Хозяин этой небольшой квартиры оказался противником типичных мужских интерьеров: тёмным цветам и брутальным фактурам он предпочёл свет, разумную планировку и яркие акценты. Ситуацию осложнял размер однокомнатной квартиры, но дизайнер Мария Безрукова нашла способ превратить её в комфортную. </p>
                                <div class="col-md-3 col-md-offset-1"><hr style="border-top: 1px solid black;"></div>
                                <div class="col-md-4" style="text-align: center"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog" class="hr-link">Смотреть больше товаров</a></div>
                                <div class="col-md-3"><hr style="border-top: 1px solid black;"></div>
                            </div>
                </div>
                </div>
                </div>
            <?php $pcategory = null; ?>
            <div class="container padding-top-20">
                <div class="">
                    <div class="row roomtype-categories">
                        <h1 style="margin-top: 40px; margin-left: 12px;" class="margin-left-10">{{ trans('frontend.common.rooms') }}</h1>
                        <div class="row boxsh" style="padding: 20px;background: white;">
                            @foreach($roomTypes as $key => $pcategory)
                            @if ($key != 2)
                            <div class="col-xs-12 {!! $pcategory->classes !!} {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item" style="{!! $pcategory->styles !!}">
                            @endif
                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                    <div class="category-holder" style="height: 100%; {!! ($key == 2) ? 'margin-top: 15px' : '' !!}">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}"><div class="grad category-image" style="background-image: url(/{{ $pcategory->imagePath() }}); height: 100%;">
                                            
                                        </div></a>
                                        <div class="category-nav">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}" class="category-name link-hover" style="border: 1px solid;padding: 0.5rem 2.2rem;font-size: 20px;">{{ $pcategory->name }}</a>
                                        </div>
                                        <div class="arrow-catalog product-arrow">
                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/room?room_type_id={{ $pcategory->id }}">
                                                <div ></div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            @if ($key != 1)
                            </div>
                            @endif
                            
                            @endforeach
                            <div class="row margin-top-30">
                                <p class="p-center" style="margin-top: 5px; margin-bottom: 15px;">Эта светлая студия в Москве, оформленная Марией Дадиани, - практически наглядное пособие по тому, как сделать интерьер маленькой однушки уютным, нескучным и изысканным. Хозяин этой небольшой квартиры оказался противником типичных мужских интерьеров: тёмным цветам и брутальным фактурам он предпочёл свет, разумную планировку и яркие акценты. Ситуацию осложнял размер однокомнатной квартиры, но дизайнер Мария Безрукова нашла способ превратить её в комфортную. </p>
                                <div class="col-md-3 col-md-offset-1"><hr style="border-top: 1px solid black;"></div>
                                <div class="col-md-4" style="text-align: center"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/projects" class="hr-link">Смотреть больше комнат</a></div>
                                <div class="col-md-3"><hr style="border-top: 1px solid black;"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $('.project-image-slide').owlCarousel({
        autoplay: 1,
        dots: 0,
    });
</script>
@stop

