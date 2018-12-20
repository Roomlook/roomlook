@extends('layouts.master')
@section('title','RoomLook')
@section('content')

<section id="main" class="padding-bottom-20">

	<div class="container">

		<h1 class="text-uppercase">{{ trans('frontend.common.checkout') }}</h1>

		<div class="col-md-12 myrooms bg-white margin-bottom-20">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-12">
						<h2>1. Шаг</h2>
					</div>
					<form action="/{{ LaravelLocalization::getCurrentLocale() }}/order/checkout" method="post" id="checkout-form" enctype="multipart/form-data">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Ф.И.О</label>
								<input type="text" name="name" class="form-control" required="required" value="{{ Auth::user()->name }}" placeholder="Введите Ф.И.О">
							</div>
							<div class="form-group">
								<label for="">E-mail</label>
								<input type="email" name="email" class="form-control" required="required"  value="{{ Auth::user()->email }}" placeholder="Введите e-mail">
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="">Телефон</label>
								<input type="text" name="phone" class="form-control" required="required"  placeholder="Введите телефон">
							</div>
						</div>
						<div class="col-md-12 margin-top-50">
							<h2>2. Шаг</h2>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Площадь комнаты</label>
								<input type="text" name="square" class="form-control" required="required"  placeholder="Площадь комнаты">
							</div>

							<div class="form-group">
								<label for="">Загрузите схему комнаты</label>
								<input type="file" name="schema" class="form-control" required="required"  placeholder="Загрузите схему комнаты">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Высота комнаты</label>
								<input type="number" name="height" class="form-control" required="required"  placeholder="Высота комнаты">
							</div>

						</div>
						<div class="col-md-12 margin-top-50">
							<h2>3. Шаг</h2>
						</div>
						<div class="col-md-12 text-center">
							<script src="https://checkout.stripe.com/checkout.js"></script>
							<input type="hidden" name="stripeToken" id="stripeToken" value="">
							{!! Form::token() !!}
							<input type="hidden" name="own_room_id" value="{{ $own->id }}">
							<button id="customButton" class="c_btn_transparent_green c_btn_small">Оплатить через карту</button>

							<script>
							var handler = StripeCheckout.configure({
							  key: 'pk_test_0zHW36F1gZuJqsFWw18WZQQD',
							  image: 'http://roomlook.com/images/logo-small.png',
							  locale: 'auto',
							  token: function(token) {
							    document.getElementById('stripeToken').value = token.id;
							    document.getElementById('checkout-form').submit();
							  }
							});

							document.getElementById('customButton').addEventListener('click', function(e) {
							  // Open Checkout with further options:
							  handler.open({
							    name: 'RoomLook',
							    description: 'roomlook.com',
							    amount: 2000
							  });
							  e.preventDefault();
							});

							// Close Checkout on page navigation:
							window.addEventListener('popstate', function() {
							  handler.close();
							});
							</script>
						</div>
						<div class="col-md-6">
							
						</div>
					</form>
					<br>
				</div>
			</div>
		</div>
		
			
			
		</div>
	</div>
		
</div>
    
</section>

@stop