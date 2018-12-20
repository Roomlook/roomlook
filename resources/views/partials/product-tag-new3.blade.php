 							
	@if($array3)							
    @foreach($array3 as $relativeProduct)
	<div>
									<div class="item active" style="height:135px;" onclick="clonetag(this)">
										<div class="item-card">
											<div class="item-card-img" style="
	background:url('/{{ $relativeProduct['image'] }}') center center no-repeat;    
	background-size: 100px;
    width: 200px;
    height: 135px;
    display: block;"></div>
	
	<div style="display:none;">
	<p style="
    margin: 15px 0 5px;
    font-weight: 100;
	letter-spacing: 1.4px;
    text-transform: uppercase;">{{ $relativeProduct['name'] }} </p> 
	<p style="
    margin-bottom: 10px;
    font-weight: 500;">
	<a class="pricetag btn">Уточняйте цену</a></p>
	
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;">Характеристики </p>
	<?php echo $relativeProduct['html']; ?> 
	</div> 
											
											<div class="tag-magaz" style="width:150px;padding:30px;">
											<div>
											
											<div style="
    background: url(/images/stores/{{ $relativeProduct['store_logo'] }}) center center no-repeat;
    width: 100%;
    height: 45px;
    background-size: auto 100%;"></div>
	 
	<a class="pricetag btn">Уточняйте цену</a>
	<!--{{ $relativeProduct['price'] }}-->
	 
											</div>
											<div style="
    font-size: 10px;
    text-align: left;
    letter-spacing: 1px;
    line-height: 12px;
    padding-left: 20px;">
	{{ $relativeProduct['store_adress'] }}
											</div>
											</div>
											
											<?php /*
											<div class="tag-manufacturer" style="width:150px;padding:30px;">
											<div>
											
											<div style="
    background: url(/images/stores/{{ $relativeProduct['store_logo'] }}) center center no-repeat;
    width: 100%;
    height: 45px;
    background-size: auto 100%;"></div>
	
												<strong style="
    width: 100%;
    text-align: center;
    display: block;
    font-size: 15px;
    font-weight: 500;" class="big-none">от $ 1000</strong>
											</div>
											
											<div style="
    font-size: 10px;
    text-align: left;
    letter-spacing: 1px;
    line-height: 12px;
    padding-left: 20px;">
											www.marketsvet.com<br />
											</div>
											</div>
											*/ ?>
<div style="display:none"><a class="btn-border-black">подробнее</a></div>
			</div>
		</div>
	</div>
@endforeach
@endif