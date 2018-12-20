@extends('layouts.master', ['noajax' => true])
@section('title','RoomLook')
@section('content')

<section id="main" class="padding-bottom-20">
<div class="container-fluid padding-bottom-10">
                        <div class=" about-owner">
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="author-name-and-social">
                                            <h3 class="margin-top-10 text-center">Мой кабинет</h3>
                                            <hr>
                                            <h2 class="margin-top-0 text-center">{{ Auth::user()->name }}</h2>
                                            
                                        </div>
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
    <div class="container-fluid">


        <div class="col-md-12 myrooms bg-white margin-bottom-20">
        

                 @include('home.settings-form', ['model' => $user])
        </div>
</div>

        
    </div>
    
</section>
<!-- Modal -->
@stop