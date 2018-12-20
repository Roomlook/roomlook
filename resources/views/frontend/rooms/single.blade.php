@extends('layouts.master')
@section('title','RoomLook')
@section('content')
<section id="main" class="single-room">
    <div class="news-bg">
        <div class="container-fluid" style="background-image: url('/{{ $room->pictures()->first()->imagePath() }}')">
            <div class="container">
                <div class="standard-style">
                    <h1>{{ $room->title }}</h1>
                    <p>
                        {{trans('frontend.common.interior-in-style')}} {{ $room->project->author->user->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container padding-top-40 padding-bottom-30">
            <div class="row">
            <div class="col-md-8">
                <div class="col-md-12 bg-white main-content">
                    <div class="news-content">
                        <h2 class="news-intro">
                            {{ $room->title }}
                        </h2>
                        <p style="text-align:justify;color: #888; font-size:15px">
                            {!! $room->body !!}
                        </p>
                        <div class="col-md-12 room-slider-holder">
                            <div class="room-slider">
                                @foreach($room->pictures as $picture)
                                    @include('frontend.partials.slider-item-room')
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="padding-top-0">
                    <p class="published_date">{{ $room->created_at->format('d.m.y') }}</p>
                    <hr class="margin-top-0 margin-bottom-10">
                    <div class="row">
                        <div class="col-md-12">
                            
                       
                            <div class="col-md-1 padding-left-0">
                                <div class="desinger-image">
                                    <img src="/{{ $room->project->author->imagePath() }}" class="designer img-responsive" alt="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="pull-left">
                                    <small>{{ trans('frontend.common.designer') }}</small>
                                    <h2 class="designer-name margin-top-0 margin-bottom-0">
                                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/author/s/{{ $room->project->author->id }}">{{ $room->project->author->user->name }}</a></h2>
                                    </a>
                                   <!--  <p class="rating" data-rate="{{-- $room->project->author->rating --}}">
                                    </p> -->
                                </div>
                                <!-- <div class="pull-left col-md-1 padding-top-10 padding-right-0">
                                    <i class="icon_star green"></i><br>
                                    {{-- $room->project->author->rating --}}
                                </div> -->
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <!-- AddToAny BEGIN -->
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-icon-color="lightgray">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                                <a class="a2a_button_vk"></a>
                                <a class="a2a_button_skype"></a>
                                </div>
                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                                <!-- AddToAny END -->
                            </div>
                        </div>
                    </div>
                    
                </div>

                    <!-- <div class="news-likes-and-comments">
                        <div class="btn btn-sm c_btn_black"><span class="content_hor_line">Комментировать</span>2</div>
                        <div class="btn btn-sm c_btn_black">Нравится</div>
                        <div class="news-socials">
                            <i class="social_facebook_circle"></i>
                            <i class="social_instagram_circle"></i>
                            <i class="social_twitter_circle"></i>
                        </div>
                    </div>
                    <div class="news-comments">
                        <div class="row comment">
                            <img src="images/designer.jpg" alt="comment_photo" class="img-responsive img-circle col-md-2"/>
                            <p class="col-md-10 comment-name"><b>Арман Серикжан</b></p>
                            <p class="col-md-10">в целом все понравилось, но фанерные шкафы... у моего папы в гараже такие же, вот с ними и ассоциация.
                                как то не для квартиры с дизайном:-/</p>
                        </div>
                        <div class="row comment">
                            <img src="images/designer.jpg" alt="comment_photo" class="img-responsive img-circle col-md-2"/>
                            <p class="col-md-10 comment-name"><b>Арман Серикжан</b></p>
                            <p class="col-md-10">в целом все понравилось, но фанерные шкафы... у моего папы в гараже такие же, вот с ними и ассоциация.
                                как то не для квартиры с дизайном:-/</p>
                        </div>
                    </div> -->

                </div>
            </div>


            <aside class="col-md-3 right-sidebar  center-block">
                <div class="fw bg-white padding-20 margin-top-20 margin-bottom-20">
                    
                <div class=" related-posts">
                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{  trans('frontend.common.view-all-project') }}</a>
                            <div class="related-posts-slider">
                                @foreach($room->project->rooms as $roomP)
                                    @if ($roomP->id != $room->id)
                                    
                                    @foreach($roomP->pictures as $picture)
                                        <div> <a class="popup-open popup-room" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img class="img-responsive" src="/{{ $picture->imagePath() }}"></a></div>
                                    @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class=" list-of-elements">
                            <hr class="margin-top-0 margin-bottom-10">
                            <a href="#">{{  trans('frontend.common.list-of-elements') }}</a>
                            <div class="list-of-elements-slider">
                                @foreach($room->pictures as $picture)
                                    @foreach ($picture->tags as $tag)
                                        <div><a href="/{{ $tag->product->imagePath() }}" tabIndex="-1" data-product-id="{{ $tag->product->id }}" class="popup-product-open green-link2"><img class="img-responsive" src="/{{ $tag->product->imagePath() }}"></a></div>
                                    @endforeach
                                    
                                @endforeach
                            </div>
                        </div>
                        <div class=" similar-projects">
                            <hr class="margin-top-0 margin-bottom-10">
                            <a href="#">{{  trans('frontend.common.similar-projects') }}</a>
                            <div class="similar-projects-slider">
                                @foreach($room->roomType->rooms as $roomT)
                                    @if ($roomT->id != $room->id)
                                    @foreach($roomT->pictures as $picture)
                                        <div><a class="popup-open popup-room" href="{{ $picture->imagePath() }}" tabIndex="-1" data-picture-id={{ $picture->id }} ><img class="img-responsive" src="/{{ $picture->imagePath() }}"></a></div>
                                    @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                </div>
                <h3 class="margin-top-0 text-center">{{ trans('frontend.common.popular') }}</h3>
                
                <div class="populars" style="padding: 0">
                    @foreach(App\Models\Room::popular() as $rmPicture)
                        <div class="popular-item">
                            <img src="/{{ $rmPicture->imagePath() }}" alt="" class="img-responsive center-block"/>
                            <div class="popular-item-title">
                                <h4 class=""><a href="#" class="green-link2">{{ $rmPicture->room->title }}</a><small class="gray pull-right"><i class="flaticon-favorite flaticon-05x" ></i> {{ $rmPicture->countLikes() }}</small></h4>
                                <small><a href="#" class="green-link">{{ $rmPicture->room->project->author->user->name }}</a></small>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </aside>
            </div>
        </div>

    </div>
</section>
@endsection


