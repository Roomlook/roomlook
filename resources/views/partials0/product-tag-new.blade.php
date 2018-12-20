
								<div class="items">
														
	@if($products)							
    @foreach($products as $relativeProduct)
									<div class="item active" style="height:135px;">
										<div class="item-card">
											<div class="item-card-img" style="
	background:url('/{{ $relativeProduct->imagePath() }}') center center no-repeat;    
	background-size: 100px;
    width: 200px;
    height: 135px;
    display: block;"></div>
	
	<div style="display:none;">
	<p style="
    margin: 15px 0 5px;
    font-weight: 100;
	letter-spacing: 1.4px;
    text-transform: uppercase;">{{ $relativeProduct->name }}</p> 
	<p style="
    margin-bottom: 10px;
    font-weight: 500;">от 50 000тг</p>
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;">Характеристики</p>
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;">Цвет: <span style="font-weight:100;">синий<span></p>
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;">Материал: <span style="font-weight:100;">велюр, дерево</span></p>
	</div> 
											
											<div class="tag-magaz" style="width:150px;padding:30px;">
											<div>
											
											<div style="
    background: url(/images/logo-00.png) center center no-repeat;
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
											Маркер света<br />
											блок А, 1-ый этаж<br />
											+7(7272)289 98 99<br />
											www.marketsvet.com<br />
											</div>
											</div>
											
											<div class="tag-manufacturer" style="width:150px;padding:30px;">
											<div>
											
											<div style="
    background: url(/images/logo-00.png) center center no-repeat;
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
											
	<div style="display:none"><a style="
    display: block;
    border: 1px solid #000;
    width: 150px;
    margin: 0 auto;
    padding: 5px 0 3px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 12px;
    line-height: 12px;">подробнее</a></div>										
											
										</div>
									</div>
    @endforeach
    @endif
	
									
								</div> 
					  