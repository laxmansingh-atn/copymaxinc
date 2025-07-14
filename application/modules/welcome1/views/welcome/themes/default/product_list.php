<section class="product-listing-sell-content">
	<div class="container">
		<div class="product-listing-sell">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="product-listing-sell-img">
					<?php if($category_content[0]->category_image == ""){?>
						<img src="<?=base_url()?>images/product-details-img.jpg" alt="product-listing-img">
					<?php } else {?>
					<img src="<?=$category_content[0]->category_image?>" alt="product-listing-img">
					<?php } ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<div class="product-listing-sell-descp">
					
						<h2>Sell my <?=$page_slug?></h2>
						<?=$category_content[0]->short_description ;  ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="product-listing-iphone-model-content">
	<div class="container">
		<div class="product-listing-iphone-model">
			<h4>Find your <?=$page_slug?> Model</h4>
			<p>Please select Gigabyte (GB) size of your <?=$page_slug?> model to see what it's worth...</p>
		</div>
	</div>
</section>

<section class="product-listing-product-content">
	<div class="container">
		<div class="row">
		
			<?php
  		
			foreach($product_list as $list) {  ?>
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="product-listing-product">
					<div class="product-listing-product-img">
						<img src="<?=$list['product_image'][0]['product_image']?>" alt="product-listing-product2">
					</div>
					<div class="product-listing-product-desp">
						<div class="product-listing-product-title">
							<h4>Sell <?=$list['product_name']?></h4>
						</div>
						<div classs="product-listing-product-btn">						   
							<ul>							
							<!--<form id="product_frm" action="<?=base_url(get_current_language()).'/product-details/'.$list['product_name']?>"  method="post">-->
							<?php 							
							for( $i= 0 ; $i< count($list['product_variants']); $i++ ) { 
						//$regular_price = $list['regular_price'] + $list['product_variants'][$i]['price'] ; 
						    $regular_price = "" ; 
							//$faulty_price = $list['faulty_price'] + $list['product_variants'][$i]['price'] ;
							$faulty_price = ""  ;
							?>
							    
								<li>
								<button  type="submit" class="btn btn-default active variant-btn" onclick="get_product_attribute('<?=$list['product_variants'][$i]['product_id']?>','<?=$regular_price?>' , '<?=$list['product_variants'][$i]['storage']?>','<?=$list['product_name']?>' , '<?=$faulty_price?>')"><?=$list['product_variants'][$i]['storage']?>GB</button>
								</li>								
							<?php } ?>
							<!--</form>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
				</div>
	</div>
</section>

<section class="product-listing-iphone-content">
	<div class="container">
		<div class="product-listing-iphone">
		<?=$category_content[0]->category_content ;  ?>
		
		</div>
	</div>
</section>


