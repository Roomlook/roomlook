@extends('layouts.home')

@section('content')
    <section id="main">
        <div class="container">
            <div class="col-md-12 col-md-offset-0" style="background-color: white;margin:20px 0;">
                @include('layouts.home-nav')
                <h4 class="">Сменить пароль</h4>
                @include('home.forms.change-password')
            </div>
        </div>
    </section>
@endsection
