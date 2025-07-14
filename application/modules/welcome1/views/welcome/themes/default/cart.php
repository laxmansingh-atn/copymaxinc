<div class="about-us_section">
    <div class="container">
        <div class="common-header">
            <h3>Review Your Sale</h3>
        </div>
		
              <!--Cart-part:Start-->
      <?php echo form_open('cart/update_cart'); ?>
	  <div class="cart-part"> 
        <!--cart-information:start-->
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                  <tr>  
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name">Handset/Device Type</th>
					 <th class="product-name">IMEI /Serial No</th>
                       <!--<th class="product-name">Your preferred payment method</th>-->					 
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-subtotal">Total</th>
                  </tr>
                </thead>
                <tbody><?php                    
        //echo "<pre>";print_r($cart_products);exit();
        $total = $grand_total = 0;
        if(count($cart_products)>0){
          
          foreach ($cart_products as $key=>$cart_item){
			 // print_r($cart_item); exit();

                    $product_slug = $this->home_model->get_val('tbl_products', 'product_id', $cart_item['product_id'], 'product_slug');
                    $temp_arr = $this->home_model->getProductImageV2($cart_item['product_id']);                    
                    
                    $img = base_url('assets/frontend/images/popular-model-img3.png');
                    //echo "<pre>";print_r($temp_arr); exit(); 

                    $total = $total + $cart_item['subtotal']; ?>
                    <tr>                                                                                                           
                      <td class="product-remove"><a href="<?php echo base_url('en/cart/delete_cart_item/'.$cart_item['rowid'].'/'.$cart_item['id'])?>" class="remove" title="Remove this item">
            <i class="fa fa-close"></i></a></td>
                      
                      <td class="product-thumbnail"><div class="attachment-shop_thumbnail"> 
                      <a href="<?php echo base_url('product/'.$product_slug); ?>">
                      <?php if(!empty($temp_arr)){?>
                        <img src="<?php echo $temp_arr['product_image'];?>">
                      <?php }else{?>
                        <img src="<?php echo $img;?>">
                      <?php }  ?> 

                      </a> </div></td>  
					  
					  <?php
					  if(isset ($cart_item['product_attribute_value'])){
						$storage = $cart_item['product_attribute_value'] ;  
					  } else {
						  $storage = $cart_item['options']['product_attribute_value'];
					  }
                     					  
					  ?>
                      <td class="product-name"><?php echo $cart_item['name'] .'.. '.$storage.'GB' ; ?></td>  
                      <td class="product-name"><?php echo $cart_item['imei_no']?></td> 
			
                      <!--<td class="product-name"><?php if(isset ($cart_item['payment_type'] )){ echo $cart_item['payment_type'] ; } ?></td>	-->				  
                      <td class="product-price">£ <?php echo number_format($cart_item['price'], 2);?></td>
                      <td class="product-quantity"><div class="quantity">          
                          <input type="number" step="1" min="1" max="1000" name="cart[<?php echo $cart_item['rowid'] ?>]" value="<?php echo $cart_item['qty']; ?>" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                        </div></td>                                                       
                      <td class="product-subtotal"><span class="woocommerce-Price-amount"> <span class="woocommerce-Price-currencySymbol">£</span><?php echo number_format($cart_item['subtotal'], 2);?></span></td>
                    </tr><?php } $lastpay = end($cart_products);           
        }else{?>
          <tr><td colspan="6" style="text-align:left">No Product Found.</td></tr><?php
        }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
		<?php echo form_close(); ?>

        <!--cart-information:End--> 
      
        <!--cart-total:start-->
          <div class="cart-total-outer">
		   <!-- payment type-->
            <div class="row">
			
			 <div class="col-lg-8  col-md-4  col-sm-12 col-xs-12">
				 <?php if(isset($lastpay)) {?>
												<li>
													<div class="product-details-radio-btn">
														<div class="product-details-radio-btn-inner" id="product-details">
															<h3>Your preferred payment method: (click to change)</h3>
															<label>
																<span><input type="radio" name="pay_type" class="payment_type" checked ="checked" <?php if($lastpay['payment_type'] == 'BANK TRANSFER') echo 'checked="checked"' ; ?>value="BANK TRANSFER"></span><font>BANK TRANSFER</font>
															</label>
															<label>
																<span><input type="radio" name="pay_type" class="payment_type"   <?php if($lastpay['payment_type'] == 'CHEQUE') echo 'checked="checked"' ; ?>value="CHEQUE"></span><font>CHEQUE</font>
															</label>
														</div>
													</div>
												</li>
				 <?php } ?>	
										</div>		 
		
	
		<!-- payment end -->
            
                      <div class="col-lg-4  col-md-4  col-sm-12 col-xs-12">
                          <!--update-cart-part-->                          
                          <div class="update-cart-btn-box">
                            <input type="submit" class="btn btn-info btn-block" value="Update Basket">
                          </div>                          
                          <!--update-cart-part-->
                          
                        <!--cart-total-part-->
						 <form  action="<?=base_url(get_current_language())?>/cart/checkout" method="post">
                          <div class="cart-total">
                          <h3>Total Sale Value</h3>
                          <div class="table-responsive">
                            <table class="table table-condensed">
                              <tbody>
                                <tr>
                                  <td align="left"><strong>Subtotal</strong></td>
                                  <td align="right">£<?php echo number_format($total, 2);?></td>
                                </tr>
                                <!--<tr>
                                  <td align="left"><strong>Total</strong></td>
                                  <td align="right"><strong>$<?php echo number_format($total, 2);?></strong></td>
                                </tr>-->
                              </tbody>
                            </table>
                          </div>
						 
						 
						  <input type="hidden" name="payment_type" id="payment_type">
						  <button type="submit" class="wc-proceed-to-checkout">Complete Sale</button>
						
                        <!--<div class="wc-proceed-to-checkout" id="complete_sale"> <a href="<?php echo base_url('cart/checkout');?>" class="btn btn-primary btn-lg btn-block">Complete Sale</a> </div>-->
						  
                        </div>
					</form>
                          <!--cart-total-End-->
                      </div>
                    </div>
                  </div>
                <!--cart-total-End-->
            </div>
          </div>
        </div>
        <!--cart-total:End--> 
      </div>
    </div>
 </div>

