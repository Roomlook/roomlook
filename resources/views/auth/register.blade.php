@extends('layouts.auth')

@section('content')
	<div class="container auth-block">
		<div class="row">
		<div class="col-md-6 col-md-offset-3">
                <h2 class="text-center no-margin-bottom text-uppercase">мы всегда в тренде, а ты?</h2>
				<div class="panel-body">
					<div class="alert alert-danger modal-error response-message hide">

                </div>
                    <h1 class="text-center">{{ trans('frontend.common.signup') }}</h1>
                    
<div class="row">
                        <div class="col-md-8 col-md-offset-2">
				 <form role="form" class="ajax-form" id="registerModal" data-form-id="registerModal" action="/auth/register" method="post">
                    <div class="form-group">
                        <label for="name">{{ trans('frontend.form.name') }}</label>

                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('frontend.form.email') }} </label>
                        <input type="text" name="email" class="form-control" id="email"  value="{{ old('email') }}">
                        {!! $errors->first('email', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="psw">{{ trans('frontend.form.password') }} </label>
                        <input type="password" name="password" class="form-control" id="psw">
                        {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="conf_psw">{{ trans('frontend.form.repassword') }} </label>
                        <input type="password" name="password_confirmation" class="form-control" id="conf_psw" >
                        {!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="agreement" required> {{ trans('frontend.form.agreement') }} 
                        {!! $errors->first('agreement', '<div class="text-danger">:message</div>') !!}
                        </label>
                    </div>
                    <div class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <button type="submit" class="center-block c_btn_light">{{ trans('frontend.common.signup') }}</button>
                    </div>

                </form>
                </div>
                    </div>
				</div>
			</div>
		</div>
    <div class="row bottom-line">
            <p><a href="/auth/login" class="c_btn_light" style="color: #fff !important; ">{{ trans('frontend.common.signin') }}</a><br><br>
                <a href="/">Вернуться на сайт</a> <br/>
                <a href="">Регистрируясь, входя или продолжая, вы принимаете и соглашаетесь с Правилами пользования и Политикой конфиденциальности room look.</a></p>
        </div>
	</div>
@endsection
