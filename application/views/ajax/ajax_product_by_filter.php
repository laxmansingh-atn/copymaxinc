<?php 
//echo "<pre>";print_r($products);exit();
foreach($products as $key=>$value){?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
  <div class="product-info-wrap">
    <div class="post-thumbnail">
      <figure><a href="<?php echo base_url('product/'.$value['product_slug']); ?>"><img class="img-responsive center-block" src="<?php echo base_url().$value['product_image'];?>" alt=""/></a></figure>
    </div>
    <div class="product-short-info">
      <h3><?php echo $value['product_name'];?></h3>
      <p><?php echo $value['short_description'];?></p>
      <span class="price">
      <ul>
        <li><del>RRP: $<?php echo number_format($value['regular_price'], 2);?></del></li>
        <li><span class="amount">Saving: $<?php echo number_format(($value['regular_price'] - $value['offer_price1']), 2);?></span></li>
      </ul>
      </span>
      <div class="original-price">Buy It Now: $<?php echo number_format($value['offer_price1'], 2);?> </div>
      <div class="or text-center"> <span>OR</span> </div>
      <div class="extra-price-feature">
        <ul>
          <li><span>Imported Price:</span> $<?php echo number_format($value['offer_price2'], 2);?></li>
          <li><span>Massive Saving:</span> $<?php echo number_format(($value['regular_price'] - $value['offer_price2']), 2);?> </li>
        </ul>
       </div>
      <div class="shop-now-btn"><a href="<?php echo base_url('product/'.$value['product_slug']); ?>">Order Now</a></div>
     </div>
    <div class="clearfix"></div>
  </div>
</div>
<?php }?>
