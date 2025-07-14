<section id="body-container" class="body-container animatedParent"> 
  <!--category-part:Start-->
  <section id="home-slider-cat-box" class="inner-slide-and-cat-box">
    <div class="container"> 
      
      <!--Heading:Start-->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="inner-heading-box">
            <h1 class="title-1 text-center">My Account</h1>
          </div>
        </div>
      </div>
      <!--Heading:Start--> 
      
      <!--Checkout-part:Start-->
      <div class="myaccount-part common-wrap">
      	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<div class="ma-tab-box">
                	<ul class="tab-btn-list">
                    	<li id="tab1">Dashboard</li>
                    	<li id="tab2">Previous Orders</li>
                    	<li id="tab3">Edit Details</li>
                    </ul>
                    
                    <div class="ma-tab-container">
                    	<div id="tab-box1" class="tab-box">
                        	
                          <?php 
                          echo stripcslashes($content);
                          /* ?>
                          <p class="myaccount_user">Hello <strong>admin</strong> ( not admin? <a href="<?= base_url();?>logout/">Sign out</a> ). From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="#" 
                            data-toggle="modal" data-target="#resetPasswordModal"
                          >edit your password and account details.</a><br>
                          Do you have orders that aren't appearing here? Contact us with your order number and we'll get them added to your account.</p>
                          <?php */ ?>   

                        </div>
                    	<div id="tab-box2" class="tab-box">
                        	<div class="table-responsive">
                            	<table class="table table-condensed table-hover">
                                <thead>
                                  <tr>
                                    <th class="product-order">Transaction Id</th>
                                    <th class="product-date">Date</th>
                                    <th class="product-status">Status</th>
                                    <th class="product-qnty">Total Qty</th>
                                    <th class="product-total">Total Price</th>                                    
                                    <th class="product-view">&nbsp;</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <?php 
                                 if(!empty($order_list)){
                                 	foreach($order_list as $key=>$value){?>
	                                  <tr>
	                                    <td class="product-order"><a href="javascript:void(0);" 
	                                    onclick="get_order_details(<?php echo $value['order_id'];?>);">
	                                    <?php echo $value['order']?></a></td>
	                                    <td class="product-date"><?php echo date('dS M Y', strtotime($value['date']));?></td>
	                                    <td class="product-status"><?php echo $value['delivery_status'];?></td>
	                                    <td class="product-qnty"><?php echo $value['qty'];?> item</td>
	                                    <td class="product-total">$<?php echo number_format($value['total'], 2);?></td>
	                                    <td class="product-view"><a href="javascript:void(0);" 
	                                    onclick="get_order_details(<?php echo $value['order_id'];?>);">View</a></td>
	                                  </tr>                                 
	                                <?php
	                                }
	                              }?>  
                                </tbody>
                              </table>
                            </div>
                        </div>
                    	<div id="tab-box3" class="tab-box">
                        	<div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<p>The following addresses will be used on the checkout page by default.</p>
                                </div>
                            </div>
                            
                        	<div class="row">
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<div class="shipping-form">
                                    	<h4>Shipping Address</h4><?php 
                                          if(!empty($shipping_address)){?>
                                              <p><?php echo $shipping_address['first_name'].' '.$shipping_address['last_name']; ?><br>
                                              <?php echo $shipping_address['address']; ?><br>
                                              <?php echo $shipping_address['city']; ?><br>
                                              <?php echo $shipping_address['state']; ?><br>
                                              <?php echo $shipping_address['country']; ?></p><?php
                                          }?>
                                                                                            
                                        <a href="javascript:void(0)" onclick="address_set('shipping')">Edit</a>
                                    </div>
                                </div>
                            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                	<div class="billing-form">
                                    	<h4>Billing Address</h4><?php 
                                          if(!empty($billing_address)){?>
                                              <p><?php echo $billing_address['first_name'].' '.$shipping_address['last_name']; ?><br>
                                              <?php echo $billing_address['address']; ?><br>
                                              <?php echo $billing_address['city']; ?><br>
                                              <?php echo $billing_address['state']; ?><br>
                                              <?php echo $billing_address['country']; ?></p><?php
                                          }?>
                                        
                                        <a href="javascript:void(0)" onclick="address_set('billing')">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!--Checkout-total:End--> 
      
    </div>
  </section>
  <!--category-part:End--> 