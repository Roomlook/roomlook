<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120814524-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-120814524-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/elegant-fonts.css" rel="stylesheet">
    <link href="/css/flaticon.css" rel="stylesheet">
    <link href="/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/owl-carousel/owl.theme.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <div class="overlay"></div>

    <!-- Sidebar -->
    <nav class="navbar visible-xs visible-sm navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="/">
                    RoomLook
                </a>
            </li>
            <li>
                <a href="/rooms.php">Комнаты</a>
            </li>
            <li>
                <a href="/catalog.php">Каталог</a>
            </li>
            <li>
                <a href="/myrooms.php">Мои комнаты</a>
            </li>
            <li>
                <a href="/designers.php">Дизайнеры</a>
            </li>
            <li>
                <a href="/">Производители</a>
            </li>
            <li>
                <a href="/">Магазины</a>
            </li>
            <li>
                <a href="/">Вход</a>
            </li>
            <li>
                <a href="/">Регистрация</a>
            </li>

        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <button type="button" class=" visible-xs visible-sm hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <header>
            <div class="container">
                <div class="col-md-2 col-md-offset-0 col-xs-offset-1 col-xs-6">
                    <a href="/">
                        <img src="/images/logo-small.png" alt="" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-10 hidden-xs">
                    <div class="row">
                        <div class="col-md-5 localization">
                            <div class="col-md-6">
                                <div class="dropdown">
                                    <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-nation"></i> <span>Русский язык</span>

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Русский язык</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Английский язык</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dropdown location-dropdown">
                                    <button class="dropdown-toggle c_clear_btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="icon_pin"></i> <span>Казахстан</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li class="dropdown-header">
                                            <a href="#">Казахстан</a>

                                        </li>
                                        <li>
                                            <a href="">Алматы</a>
                                        </li>
                                        <li>
                                            <a href="">Астана</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">
                                            <a href="#">Россия</a>
                                        </li>
                                        <li>
                                            <a href="">Москва</a>
                                        </li>
                                        <li>
                                            <a href="">Санкт-Петербург</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">
                                            <a href="#">США</a>
                                        </li>
                                        <li>
                                            <a href="">Нью-Йорк</a>
                                        </li>
                                        <li>
                                            <a href="">Вашингтон</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 search text-right">
                            <i class="icon_search"></i>
                            <a href="">Поиск</a>
                        </div>
                        <div class="col-md-4 auth text-right">
                            <i class="flaticon-social"></i>
                            <a data-toggle="modal" href="#loginModal">Вход</a>
                            <a data-toggle="modal" href="#signUpModal">Регистрация</a>
                        </div>
                    </div>
                    <div class="row">
                        <nav id="main-menu" class="list-inline">
                            <li>
                                <a href="/rooms.php">Комнаты</a>
                            </li>
                            <li>
                                <a href="/catalog.php">Каталог</a>
                            </li>
                            <li>
                                <a href="/myroom.php">Мои комнаты</a>
                            </li>
                            <li>
                                <a href="/designers.php">Дизайнеры</a>
                            </li>
                            <li>
                                <a href="/">Производители</a>
                            </li>
                            <li>
                                <a href="/">Магазины</a>
                            </li>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="hz-profile-header">
                    <div id="profileHeader" scopeid="profileHeader" class="comp-box">
                        <div class="container">
                            <div class="profile-header user-profile view">
                                <div class="profile-cover">
                                    <div class="profile-pic-container">
                                        <a class="profile-pic-border" href="#">
                                            <span class="profile-camera-icon hzi-font hzi-Add_Photo"
                                                  data-toggle="modal" data-target="#changeProfilePhotoModal">
                                                <i class="glyphicon glyphicon-camera"></i>
                                            </span>
                                            <img class="profile-pic" width="173" height="173" id="mainUserProfilePic" src="{{Auth::user()->avatar}}" oncontextmenu="return false;" onmousedown="preventImageDrag(event);" ondragstart="return false;" onselectstart="return false;">
                                        </a>
                                    </div>
                                    <img id="coverImage" class="cover-image custom-cover" src="{{Auth::user()->cover}}" oncontextmenu="return false;" onmousedown="preventImageDrag(event);" ondragstart="return false;" onselectstart="return false;">
                                    <div class="profile-info">
                                        <div class="profile-title">
                                            <h1><a class="profile-full-name" itemprop="name" href="">{{Auth::user()->name}}</a></h1>
                                        </div>
                                    </div>
                                    <div class="change-cover-photo">
                                        <a class="hzBtn graybutton" id="changeCoverPhoto"><i class="glyphicon glyphicon-camera"></i></i>Изменить обложку</a>
                                    </div>
                                    <div class="profile-pro-actions">
                                        <a class="hzBtn whitebutton profile-action-button" href=""><i class="hzi-Edit-Fill hzi-font"></i>Редактировать профиль</a>
                                        <div class="profile-view-link">
                                            <a class="icon-wrap colorLink text-m text-dt-s" href="">Посмотреть мой профиль<span class="pi-arrow-right"></span></a>
                                        </div>
                                    </div>
                                    <div class="sidebar-group-inline sidebar profile-tabs"><div class="">
                                            <ul class="list-inline list-unstyled touch-scroll-list">
                                                <li class="">
                                                    <div class="profile-pic-placeholder"></div>
                                                </li>
                                                <li class="{{ Request::is('home') ? 'selected' : '' }} sidebar-item">
                                                    <a class="sidebar-item-label" href="/home" compid="your_houzz_tab">
                                                        <span class="option-text">Мой Houzz</span></a>
                                                </li>
                                                @if(Auth::user()->is('author'))
                                                <li class=" {{ Request::is('home/projects') ? 'selected' : '' }} sidebar-item">
                                                    <a class="sidebar-item-label" href="/home/projects" compid="ideabooks_tab">
                                                        <span class="option-text">Альбомы идей</span></a>
                                                </li>
                                                <li class=" {{ Request::is('home/rooms') ? 'selected' : '' }} sidebar-item">
                                                    <a class="sidebar-item-label" href="/home/rooms" compid="ideabooks_tab">
                                                        <span class="option-text">Альбомы идей</span></a>
                                                </li>
                                                @endif
                                                <li class="{{ Request::is('home/favours') ? 'selected' : '' }} sidebar-item">
                                                    <a class="sidebar-item-label" href="/home/favours" compid="bookmarks_tab">
                                                        <span class="option-text">Закладки</span></a>
                                                </li>
                                                <li class="{{ Request::is('home/saves') ? 'selected' : '' }} sidebar-item">
                                                    <a class="sidebar-item-label" href="/home/saves" compid="activity_tab">
                                                        <span class="option-text">Обновление</span></a>
                                                </li>
                                                <li class="{{ Request::is('home/settings') ? 'selected' : '' }} sidebar-item">
                                                    <a class="sidebar-item-label" href="/home/comments" compid="messages_tab">
                                                        <span class="option-text">Сообщения</span></a>
                                                </li>
                                            </ul></div>
                                    </div>			</div>
                            </div></div>
                    </div>

                </div>
            </div>
        </header>
        @yield('content')
        <footer class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="col-md-2 col-md-offset-0 col-xs-offset-1 col-xs-6">
                        <img src="/images/logo-small.png" alt="" class="img-responsive">
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <ul class="list-unstyled">
                            <li><a href="#">О Проекте</a></li>
                            <li><a href="#">Контакты</a></li>
                            <li><a href="#">Новости</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Правила безопасности</a></li>
                            <li><a href="#">Авторское право</a></li>
                            <li><a href="#">Товарный знак</a></li>
                            <li><a href="#">Оставить отзыв</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="row footer-social">
                            <div class="row">
                                <a href="tel:+78003003300"><i class="flaticon-circle"></i>
                                    <span class="footer-phone-number">8 (800) 300 33 33</span></a>
                            </div>
                            <div class="row">
                                <a href=""><i class="social_facebook_circle"></i></a>
                                <a href=""><i class="social_instagram_circle"></i></a>
                                <a href=""><i class=" social_googleplus_circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- /#page-content-wrapper -->

</div>

<!-- LOGIN MODAL -->

<!-- Modal -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog modal-md" >

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">Вход</h2>
                <p class="text-center">Введите ваши данные для авторизации</p>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger modal-error response-message hide">

                </div>
                <form role="form" class="ajax-form" method="post" id="loginModal2" data-form-id="loginModal" action="/auth/login">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Введите email">
                    </div>
                    <div class="form-group">
                        <label for="psw">Пароль</label>
                        <input type="password" name="password" class="form-control" id="psw" placeholder="Введите пароль">
                        <a href="#ForgetPWD" class="forgot-pwd text-right">забыли пароль?</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="center-block clearfix c_btn_login btn btn-lg">Вход</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row social-signs text-center">
                    <p class="text-center">Вход через соц. сети</p>
                    <a href=""><i class="social_facebook_circle"></i></a>
                    <a href=""><i class="social_instagram_circle"></i></a>
                    <a href=""><i class="social_twitter_circle"></i></a>
                </div>
                <p class="text-center reg-href"><a href="">Регистрация</a></p>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN MODAL -->
<!-- SIGN UP MODAL -->
<div class="modal fade" id="signUpModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="text-center no-margin-bottom">Регистрация</h2>
                <p class="text-center">Заполните пустые поля для регистрации</p>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger modal-error response-message hide">

                </div>
                <form role="form" class="ajax-form" id="registerModal" data-form-id="registerModal" action="/auth/register" method="post">
                    <div class="form-group">
                        <label for="name">Имя/Фамилия</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Введите email">
                    </div>
                    <div class="form-group">
                        <label for="psw">Пароль</label>
                        <input type="password" name="password" class="form-control" id="psw" placeholder="Введите пароль">
                    </div>
                    <div class="form-group">
                        <label for="conf_psw">Потвердите пароль</label>
                        <input type="password" name="password_confirmation" class="form-control" id="conf_psw" placeholder="Потвердите пароль">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Заходя на сайт, я принимаю и соглашаюсь  с правилами пользования и политикой конфиденциальности Room Look
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="center-block c_btn_signup btn btn-lg">Регистрация</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row social-signs text-center">
                    <p class="text-center">Регистрация через соц. сети</p>
                    <a href=""><i class="social_facebook_circle"></i></a>
                    <a href=""><i class="social_instagram_circle"></i></a>
                    <a href=""><i class="social_twitter_circle"></i></a>
                </div>
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
<!-- END SIGN UP MODAL -->
<script src="/js/jquery-1.12.2.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/owl-carousel/owl.carousel.js"></script>

<script>
    $(".main-slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
    });
    $(".room-slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        singleItem:true
    });
    $(".related-posts-slider").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
    $(".list-of-elements-slider").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
    $(".similar-projects-slider").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        pagination : false,
        items : 4
    });
</script>

<div class="modal fade roomlook-modal" id="alertModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <div class="modal-body">

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="popup-product">
    <div class="bg"></div>
    <div class="popup-close">
        <button><i class="icon_close"></i></button>
    </div>
    <div class="popup-content">

    </div>
</div>
<div id="popupRoom">
    <div class="bg"></div>
    <div class="popup-close">
        <button><i class="icon_close"></i></button>
    </div>
    <div class="popup-content">

    </div>
</div>
<script src="/js/menu.js"></script>
<script src="/js/script.js"></script>
<script src="/js/frontend.js"></script>
<script src="/js/dropzone.js"></script>
<script>
    var changeAvatarDz = new Dropzone("#hzDropzone",{
        url : '/home/change-avatar',
        method : 'post',
        uploadMultiple : false,
        previewsContainer: '.profile-pic-preview-wrapper',
        paramName : "avatar",
        maxFilesize : 30,
        previewTemplate : document.querySelector(".dz-preview").innerHTML,
        autoProcessQueue : false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            this.on("addedfile", function() {
                if (this.files[1]!=null){
                    this.removeFile(this.files[0]);
                }
            });
        },
        success : function(status, filename){
            $("#mainUserProfilePic").attr("src",filename);
        },
        error  : function(a,b,c){

        }
    });

</script>
</body>
</html>