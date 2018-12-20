@extends('layouts.master')
@section('title','RoomLook')
@section('content')
<section id="main" class="padding-top-20 padding-bottom-30">
	<div class=" padding-top-10  padding-bottom-10">
		<h1 class="text-center title text-center">{{ trans('frontend.common.brands') }}</h1>
		<div class="clear"></div>
    
	</div>    
	<div class="container  ">
            <div class="manufacturers">
                
            
    		@foreach($manufacturers as $manufacturer)
    		<div class="manufacturer" >
                    <div class="col-sm-4 col-xs-4">
                        <img src="/{{ $manufacturer->imagePath() }}" alt="" class="img-responsive">
                    </div>
                    
                    <div class="col-sm-8 col-xs-8">
                        <h3 class="title margin-top-0"><a href="/{{ LaravelLocalization::getCurrentLocale() }}/brands/s/{{ $manufacturer->id }}" class="green-link">{{ $manufacturer->name }}</a></h3>
                        <p>
                            <i class="icon_pin_alt"></i> {{ $manufacturer->address }}
                        </p>
                        <div class="gray">
                            {!! $manufacturer->body !!}
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
    		@endforeach
            </div>
    </div>
    <div class="clear"></div>
</section>
@endsection


