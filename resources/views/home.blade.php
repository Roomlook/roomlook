@extends('layouts.master')

@section('content')

<section id="main">
                <div id="content">
                    <div class="container-fluid bg-gray padding-bottom-40">
                        <div class="container about-author">
                            <div class="col-md-2">
                                @if (Auth::user()->image == "")
                                <img class="img-responsive" src="/images/user-placeholder.jpg" data-toggle="modal" data-target="#changeProfilePhotoModal"/>
                                @else
                                <img class="img-responsive" src="/{{ Auth::user()->image }}"/>
                                @endif

                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="author-name-and-social">
                                        <h2 class="margin-top-0">{{ Auth::user()->name }}</h2>
                                        <a href="{{ Auth::user()->fb }}" target="_blank"><i class="social_facebook_circle"></i></a>
                                        <a href="{{ Auth::user()->instagram }}" target="_blank"><i class="social_instagram_circle"></i></a>
                                        <a href="{{ Auth::user()->twitter }}" target="_blank"><i class="social_twitter_circle"></i></a>
                                    </div>
                                    <p>
                                </div>
                                <div class="row about-author-text" >
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="container slider-comment-wrapper">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php $c = 0; ?>
                                    @foreach(Auth::user()->ownRooms as $own)
                                    <li role="presentation" class="@if ($c == 0) active @endif"><a href="#ownroom-{{ $own->id }}" aria-controls="author-projects" role="tab" data-toggle="tab">{{ $own->name }}</a></li>
                                    <?php $c++; ?>
                                    @endforeach
                                    <!-- <li role="presentation"><a href="#author-reviews" aria-controls="author-reviews" role="tab" data-toggle="tab">Отзывы</a></li> -->
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                <?php $c = 0; ?>
                                    @foreach(Auth::user()->ownRooms  as $own)
                                    <div role="tabpanel" class="tab-pane @if ($c == 0) active @endif" id="ownroom-{{ $own->id }}">
                                        <h3>{{ trans('frontend.common.rooms') }}</h3>
                                        <div class="">
                                                
                                                @foreach($own->roomPictures()->chunk(4) as $pictures)
                                                    <div class="row">
                                                        @foreach($pictures as $picture)
                                                            <div class="col-md-3">
                                                                <img src="/{{ $picture->imagePath() }}" class="img-resposive" alt="">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                        </div>
                                        <h3>{{ trans('frontend.common.catalog') }}</h3>
                                        <div class="">
                                                
                                                @foreach($own->productPictures()->chunk(4) as $pictures)
                                                    <div class="row">
                                                        @foreach($pictures as $picture)
                                                            <div class="col-md-3">
                                                                <img src="/{{ $picture->imagePath() }}" class="img-resposive" alt="">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                        </div>
                                    </div>
                                    <?php $c++;?>
                                    @endforeach
                                   
                                </div>

                            </div>
                        </div>
                    </div>
            </section>
	<div class="modal fade" id="response-modal" role="dialog">
		<div class="modal-dialog modal-md" >
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<p class="green text-center">Спасибо что оставили заявку на автора. Мы рассмотрим вашу заявку в ближайшее время.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="changeCoverModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">Выберите обложку</h2>
            </div>
            <div class="modal-body">
                <div id="changePhotoCoverDialog">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="ccp-spaces">
                                <div id="projectSpaces" class="project-spaces">
                                    <div class="picker-thumb" data-spaceid="19020938" id="thumb-19020938" style="background-image: url(/images/profile-covers/home.jpg);" data-attr="/images/profile-covers/home.jpg"><div class="selectedcheck"></div></div></div>									</div>
                        </div>
                        <div class="pull-right">
                            <div class="cover-preview">

                            </div>
                        </div>
                        <div class="dropzone-messages"></div>
                    </div>
                    <div class="upload-helper-message">
                        В профиле отображаются только те фотографии, ширина которых совпадает с шириной вашей страницы профиля.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Отменить</button>
                <button type="button" class="btn btn-success" id="save_cover_photo" data-dismiss="modal">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changeProfilePhotoModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">Фотография вашего профиля</h2>
            </div>
            <div class="modal-body">
                <div id="changeProfilePhotoDialog" class="clearfix">
                    <div class="profile-pic-preview">
                        <div class="profilePicThumb">
                            <div class="profile-pic-preview-wrapper" style="top: 50%; margin:10px">
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-details">
                                        <img data-dz-thumbnail />
                                        <img data-dz-remove/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-pic-upload ">
                        <form action="javascript:;" class="dropzone dz-clickable" id="hzDropzone">
                            <div class="dz-default dz-message"><span><i></i>Нажмите или перетащите файлы для загрузки</span></div>
                        </form><div class="hide"></div><div class="upload-helper-message">формат JPG, GIF или PNG</div>
                    </div>
                    <div class="upload-helper-message">
                    </div>
                </div>
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" >Отменить</button>
                <button type="button" class="btn btn-success" id="save_profile_photo" data-dismiss="modal">Сохранить</button>
            </div>
        </div>
    </div>
</div>
@endsection
