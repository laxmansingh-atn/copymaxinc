<!-- <style>
.listing_product.product_list ul li {
    margin: 0 1em 1em 0;
    padding: 0;
    list-style-type: none;
    float: left;
    width: 108px;
    position: relative;
}
.listing_product.product_list ul li:nth-child(9n) {
    margin-right: 0;
}
  </style> -->

<div class="mid_section">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-3 col-sm-4">
        <div class="left_sidebar">
          <div class="get_quote">
             </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="right_panel">
          <div class="product_list listing_product">
          <div class="row clearfix">
              <?php foreach($productlist as $key=>$productlists) { ?>
                  
                  <?php /*if($productlists->product_id == 114 || $productlists->product_id == 112 || $productlists->product_id == 137){ ?>        
                      <div class="col-sm-2">
                        <div class="p_box">
                          <a onclick="return gtag_report_conversion('<?php echo base_url() .'product-details/'.$productlists->product_slug ;?>');" href="<?php echo base_url() .'product-details/'.$productlists->product_slug ;?>">
                          <div class="imgtxt">
                          <img onclick="return gtag_report_conversion('<?=base_url('uploads/products').'/'.$productlists->product_image;?>')" src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>"> 
                          <div class="imgbtn">
                            <!-- <img src="<//?=base_url('images/btn.png')?>"> -->
                            click for pricing
                          </div>
                          </div>   
                            <div class="pbxcontent"><?= $productlists->product_name;?></div>
                          </a>
                         
                        </div>
                      </div>
                  <?php } else*/{
						//<a href="javascript:void(0);" data-toggle="modal" data-target="#product_info_modal">
					  ?>
                      
                    <div class="col-sm-2">
                        <div class="p_box">
							<?php 
							if(in_array($productlists->product_id, [135])){
								$url = base_url('uploads/products/Car Wraps New.png');//.'/'.$productlists->product_image;
							}else{
								$url = base_url() .'product-details/'.$productlists->product_slug ;
							}
							?>
							<a onclick="return gtag_report_conversion('<?php echo $url?>');" href="<?php echo $url?>">
                          <!--a href="<?=base_url('uploads/products').'/'.$productlists->product_image;?>"-->
                          <div class="imgtxt">
                          <img src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>" onclick="return gtag_report_conversion('<?=base_url('uploads/products').'/'.$productlists->product_image;?>')"> 
                          <div class="imgbtn">
                            <!-- <img src="<//?=base_url('images/btn.png')?>"> -->
                            click for pricing
                          </div>
                          </div>   
                            <div class="pbxcontent"><?= $productlists->product_name;?></div>
                          </a>
                         
                        </div>
                      </div>
                    
                  <?php } ?> 
                
              <?php } ?>  
                   
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>