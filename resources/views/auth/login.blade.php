@extends('layouts.auth')

@section('content')
	<div class="container auth-block">
		<div class="row">
		<div class="col-md-6 col-md-offset-3">
				<h2 class="text-center no-margin-bottom text-uppercase">мы всегда в тренде, а ты?</h2>
                <div class="panel-body">
					<div class="alert alert-danger modal-error response-message hide">

                 </div>
                    <h1 class="text-center">{{ trans('frontend.common.signin') }}</h1>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            
                        
				<form role="form" method="post" id="loginModal2" data-form-id="loginModal" action="/auth/login">

                    
                    <div class="form-group">
                        <label for="email">{{ trans('frontend.form.email') }}</label>
                        <input type="text" name="email" class="form-control" id="email" >
                    </div>
                    <div class="form-group">
                        <label for="psw">{{ trans('frontend.form.password') }}</label>
                        <input type="password" name="password" class="form-control" id="psw" >
                    </div>
                    <div>
                        <br>

                        <a href="/{{ LaravelLocalization::getCurrentLocale() }}/auth/forgot" class="forgot-pwd text-center">{{ trans('frontend.form.forgot') }}</a>
                        <br>
                    </div>
                    <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <button type="submit" class="center-block clearfix  c_btn_light">{{ trans('frontend.common.signin') }}</button>
                    </div>
                </form>
                </div>
                    </div>

                <br>
                <!-- <a href="/redirect">FB Login</a></p> -->
				</div>
			</div>
		</div>
        <div class="row bottom-line">
            <p><a href="/auth/register" class="c_btn_light" style="color: #fff !important; ">{{ trans('frontend.common.signup') }}</a><br><br>
                <a href="/">Вернуться на сайт</a> <br/>
                <a href="#">Регистрируясь, входя или продолжая, вы принимаете и соглашаетесь с Правилами пользования и Политикой конфиденциальности room look.</a></p>
        </div>
	</div>
@endsection
