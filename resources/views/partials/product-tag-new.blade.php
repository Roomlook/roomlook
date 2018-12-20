


 									
	@if($array)							
    @foreach($array as $relativeProduct)
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
    font-weight: 500;">от {{ $relativeProduct['price'] }}тг  {{ $relativeProduct['id'] }}</p>
	
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;">Характеристики </p> 
	
	<?php
		$tags = \DB::table('tags')
							->leftJoin('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
							->leftJoin('product_tags', 'product_tags.tags_products_id', '=', 'tags.id')
							->where('locale', 'ru')
							->where('product_tags.product_id', $relativeProduct['id'])
							->get(); 
							
	foreach($tags as $t) { 
	
	$group = \DB::table('tag_group_translations')
							->where('locale', 'ru')
							->where('tag_group_translations.tag_group_id', $t->tag_group_id)
							->first(); 
							
	if($group) { $gtitle = $group->title; }else{ $gtitle = ''; }
	?>
 
	<p style="
    font-size: 14px;
    margin: 3px 0;
    font-weight: 500; letter-spacing: 2px;
    line-height: 16px;"><?php echo $gtitle; ?>: <span style="font-weight:100;"><?php echo $t->title; ?><span></p> 
	
	<?php
	
	}	
	?> 
	 
	</div> 
											
											<div class="tag-magaz" style="width:150px;padding:30px;">
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
    font-weight: 500;" class="big-none">от {{ $relativeProduct['price'] }}тг</strong>
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
											
	<div style="display:none"><a class="btn-border-black">подробнее</a></div>										
											
										</div>
									</div>
	</div>
    @endforeach
    @endif
 	  