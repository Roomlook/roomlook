
								<div class="items">
										

		<?php					
		$a = \DB::select('select distinct * from `products`
							left join `product_pictures` on products.id = product_pictures.product_id 
							left join `product_translations` on products.id = product_translations.product_id and product_translations.name like "%стол%"
							where product_translations.name != ""');
		  							
    foreach($a as $p) { ?>
									<div class="item active" style="height:135px;overflow:hidden;">
										<div class="item-card">
											<div class="item-card-img" style="
	background:url('/images/products/<?php echo $p->image; ?>') center center no-repeat;    
	background-size: 100px;
    width: 200px;
    height: 135px;
    display: block;"></div>
	
	<div style="display:none;">
	<p style="
    margin: 15px 0 5px;
    font-weight: 100;
	letter-spacing: 1.4px;
    text-transform: uppercase;"><?php echo $p->name; ?></p> 
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
    line-height: 16px;">Цвет: синий</p>
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;">Материал: велюр, дерево.</p>
	</div> 
	
	<?php $l = \DB::select('select * from `store_product`
							left join `stores` on stores.id = store_product.store_id
							where store_product.product_id = '.$p->id.''); ?> 
																	
											<div class="tag-magaz" style="width:150px;padding:30px;">
											<div>
											
											<div style="
    background: url(/images/stores/<?php if($l)echo $l[0]->logo; ?>) center center no-repeat;
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
    <?php } ?>
	
									
								</div> 
					  