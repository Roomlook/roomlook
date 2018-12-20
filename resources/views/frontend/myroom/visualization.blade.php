@extends('layouts.master')
@section('title','RoomLook')
@section('onload','initVizualization()')
@section('content')
<section id="main" class="visualization">
		<div class="container">
			<h1 class="text-center">{{ trans('frontend.common.plan-room') }}</h1>
			<div class="col-sm-2 col-xs-12" id="product-element">
				<?php $i = 1; ?>
				<div id="catalog-elements"></div>
			</div>
			<div class="col-sm-8  col-xs-12 dropzone " id="visualization">
				<canvas></canvas>
			</div>	
			<aside class="sidebar-right col-sm-2 col-xs-12">
				<div class="col-md-12">
					<div  id="roomtypes" >
						<canvas tabindex="0" width="328" height="625" style="position: absolute; top: 0px; left: 0px; z-index: 2; -webkit-user-select: none; width: 328px; height: 625px; cursor: auto;"></canvas>
					</div>
				</div>
			</aside>
			<div class="col-xs-12 col-sm-12 text-right">
				<div id="bottom-elements"></div>
			</div>
			<div class="col-xs-12 col-sm-12 text-right">
				<a href="#" class="c_btn c_btn_green c_btn_medium">{{ trans('frontend.common.done') }}</a>
			</div>
		</div>

	</section>
@endsection
@section('script')

		<script src="/js/go.js"></script>
		<script src="/js/DrawCommandHandler.js"></script>
		<script src="/js/RotateMultipleTool.js"></script>
		<script src="/js/ResizeMultipleTool.js"></script>
		<script src="/js/GuidedDraggingTool.js"></script>
		<script>
			var icons = {
				'home' : 'M97.847,4H6.33v60.058h91.517V4z M94.987,61.198H9.19V6.86h85.797V61.198z',
				'l-type' : 'M76.289,83.515H4V2.538h107.899v38.025l-35.393-0.009L76.289,83.515z M7.748,79.768H72.56l0.217-42.963l35.374,0.009V6.286 H7.748V79.768z',
				'p-type' : 'M157.215,115.053h-45.432V89.211l-26.931-0.124l0.002,25.965H40.654V32.709h43.857v26.382h27.181V32.638 l45.523,0.075V115.053z M116.404,110.431h36.189V37.327l-36.28-0.06v26.445H79.889V37.331H45.275v73.1h34.956L80.23,84.445 l36.174,0.166V110.431z"/>',
				'n-type' : 'M146.303,107.511h-39.877V84.163l-25.511-0.117l0.001,23.465H42.154V34.28h104.15V107.511z M109.426,104.511 h33.877V37.28h-98.15v67.231h32.763l-0.001-23.479l31.511,0.144V104.511z',
				'door' : 'M4.243,14.25c1.613-0.496,3.227-0.992,4.925-1.513c7.787,25.662,15.554,51.254,23.32,76.847 c0.057-0.005,0.113-0.009,0.17-0.014c0-28.498,0-56.997,0-85.495c4.352,0,8.704,0,13.055,0c0,37.374,0,74.748,0,112.121 c-4.352,0-8.704,0-13.055,0c0.002-0.063-0.002-0.128,0.005-0.192c0.778-6.33-1.345-12.14-3.141-18.033 C21.194,70.651,12.919,43.313,4.62,15.983c-0.1-0.329-0.25-0.643-0.377-0.964C4.243,14.763,4.243,14.507,4.243,14.25z  M44.499,110.476c0-33.617,0-67.143,0-100.635c-1.215,0-2.346,0-3.475,0c0,33.59,0,67.09,0,100.635 C42.21,110.476,43.324,110.476,44.499,110.476z M33.796,9.788c0,0.366,0,0.648,0,0.93c0,27.446-0.002,54.892,0.009,82.338 c0,0.534,0.074,1.087,0.227,1.598c1.04,3.488,2.109,6.967,3.173,10.449c0.088,0.287,0.202,0.565,0.357,0.992 c0-32.208,0-64.239,0-96.307C36.308,9.788,35.129,9.788,33.796,9.788z M37.185,108.914C27.572,77.235,18.009,45.717,8.424,14.133 c-1.037,0.319-1.963,0.604-2.924,0.899c9.609,31.666,19.172,63.182,28.757,94.766C35.269,109.493,36.175,109.22,37.185,108.914z  M38.407,9.016c0,34.159,0,68.139,0,102.254c-1.594,0-3.076,0-4.545,0c0,1.334,0,2.534,0,3.727c3.598,0,7.129,0,10.65,0 c0-1.267,0-2.464,0-3.78c-1.455,0-2.84,0-4.242,0c0-34.114,0-68.105,0-102.211c1.448,0,2.84,0,4.258,0c0-1.312,0-2.511,0-3.742 c-3.586,0-7.117,0-10.676,0c0,1.255,0,2.453,0,3.753C35.361,9.016,36.818,9.016,38.407,9.016z',
				'block' : 'M0,124.775h173.371V11H0V124.775z M91.684,67.888l76.27-49.208v98.415L91.684,67.888z M161.466,119.357 H11.906l74.78-48.246L161.466,119.357z M86.686,64.664l-74.78-48.246h149.563L86.686,64.664z M81.688,67.888l-76.27,49.208V18.68 L81.688,67.888z',
				'window' : 'M12.363,6.207c0,35.6,0,71.013,0,106.566c-1.661,0-3.205,0-4.736,0c0,1.39,0,2.641,0,3.884 c3.749,0,7.429,0,11.099,0c0-1.321,0-2.568,0-3.939c-1.516,0-2.96,0-4.421,0c0-35.553,0-70.977,0-106.521c1.509,0,2.959,0,4.438,0 c0-1.368,0-2.617,0-3.9c-3.737,0-7.417,0-11.126,0c0,1.308,0,2.557,0,3.911C9.189,6.207,10.708,6.207,12.363,6.207z',

				<?php $cc = 0; $categories = App\Models\Pcategory::all(); ?>
				@foreach ($categories as $category)
					'{{ $category->id }}' : '{{ $category->geo }}',
				@endforeach
			}
		</script>
		<!-- <script src="/js/elements.js"></script> -->
		<script src="/js/visualization.js"></script>
@stop


