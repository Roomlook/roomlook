@extends('layouts.auth')

@section('content')
	<div class="container auth-block">
		<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <br>
                <h2 class="text-center no-margin-bottom text-uppercase">Спасибо, Вы успешно зарегистрировались на RoomLook.com, теперь можете войти на сайт</h2>
				
			</div>
		</div>
    <div class="row bottom-line">
            <p><a href="/auth/login" class="c_btn_light" style="color: #fff !important; ">{{ trans('frontend.common.signin') }}</a><br><br>
                <a href="/">Вернуться на сайт</a> <br/>
        </div>
	</div>
@endsection
