<style>
.terms-condition p input[type="checkbox"] {
    margin: 0 8px 0 0;
    position: relative;
    top: 1px;
}
.terms-condition p {
    font-size: 15px;
    color: #000;
    margin: 0;
}
.terms-condition a {
    display: block;
    font-size: 16px;
    color: #1660a8;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 8px;
}
.terms-condition {
    background: #ebe9eb;
    padding: 20px;
    margin-bottom: 15px;
}
  </style>
<div class="page_inner">
  <div class="container">
    <div class="row clearfix">
    <?php  if($this->session->flashdata('payment_details')): 
      $payment_details =$this->session->flashdata('payment_details');?>
      <div class="order_success">
          <span style="cursor:pointer;" class="pull-right" aria-label="Close" id="close_btn">
            <i class="fa fa-times-circle" aria-hidden="true"></i>
          </span>
          <?php if(array_key_exists('transaction_id', $payment_details)):?>
              <h1><?php echo $payment_details['description']?></h1>
              <p>Your Transaction is<span><?php echo $payment_details['transaction_id']?></span></p>
              <p>You will receive an order confirmation email with details of your order.</p>
          <?php else:?>
              <h1><?php echo $payment_details['error_message']?></h1>
              <p>Error code is<span style="color: red;"><?php echo $payment_details['error_code']?></span></p>
              <!-- <h1>Success</h1> -->
          <?php endif ?>

        </div>
        <?php  endif ?>
      
      
      <?php if($this->session->flashdata('user_message')){
        echo "<p><div class='col-md-12 alert alert-info'>".$this->session->flashdata("user_message")."</div></p>";
      }?>
      <?php 
      if(validation_errors()){
        echo "<p><div class='col-md-12 alert alert-danger'>".validation_errors()."</div></p>"; 
      }
      if(!empty($user)){ 
        echo "<p><div class='col-md-12 alert alert-info'> <b>Welcome</b> ".$user->email ."</div></p>" ; 
      }
      ?>
       
      <?php if ($this->ion_auth->logged_in()) { ?>
        <?php echo form_open('place_order'); ?>
          <div class="checkout-bd">
            <div class="row clearfix">
              <div class="col-md-6 col-sm-6">
                <div class="billing_details">
                  <h3>Billing Details</h3>
                 <!-- <form> -->
                    <div class="bill_address">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Saved Address</label>
                          <select class="form-control" name="billing_title" id="billing_title">
                            <option value="" selected>Add New Address</option>
                            <?php  if(!empty($address)){
                              foreach ($address as $key=>$val) { ?>

                              <option value="<?=$val['title']?>" data-address_id="<?=$val['id']?>" data-title="<?=$val['title']?>" data-first_name="<?=$val['first_name']?>" data-last_name="<?=$val['last_name']?>" data-address="<?=$val['address']?>" data-city="<?=$val['city']?>" data-state="<?=$val['state']?>" data-zip_code="<?=$val['zip_code']?>" data-phone="<?=$val['phone']?>" data-email="<?=$val['email']?>"><?=$val['title']?></option>
                        
                                <?php }
                            } ?>
                      </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>First name</label>
                          <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name');?>" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last name</label>
                          <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name');?>" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Shipping address</label>
                          <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Country</label>
                          <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" id="country" name="country" required>
              						  <?php foreach($countries as $country) { ?>
              						    <option value="<?=$country['name']?>" <?php if($country['name']=='United States') { ?>selected<?php } ?>><?=$country['name']?></option>
              						  <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>State</label>
                          <input type="text" class="form-control" id="state" name="state" required value="<?php echo set_value('state');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Zipcode</label>
                          <input type="text" class="form-control" id="zip_code" name="zip_code" required value="<?php echo set_value('zip_code');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" class="form-control" id="contact_no" name="contact_no" required value="<?php echo set_value('contact_no');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label>Email</label>
                          <input type="email" class="form-control" id="email" name="email" required value="<?php echo set_value('email');?>"> 
                        </div>
                      </div>
                    </div>
                 <!-- </form>-->
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="billing_details">
                  <h3>
                    <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <input type="checkbox" name="ship_to_different_address" value="1"> 
                      Ship to a different address? </label>
                  </h3>
                  <!--<form>-->
                    <div class="bill_address collapse" id="collapseOne" aria-expanded="false">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Saved Address</label>
                          <select class="form-control" name="shipping_title" id="shipping_title">
                            <option value="" selected>Add New Address</option>
                            <?php  if(!empty($address)){
                              foreach ($address as $key=>$val) { ?>

                              <option value="<?=$val['title']?>" data-address_id="<?=$val['id']?>" data-title="<?=$val['title']?>" data-first_name="<?=$val['first_name']?>" data-last_name="<?=$val['last_name']?>" data-address="<?=$val['address']?>" data-city="<?=$val['city']?>" data-state="<?=$val['state']?>" data-zip_code="<?=$val['zip_code']?>" data-phone="<?=$val['phone']?>" data-email="<?=$val['email']?>"><?=$val['title']?></option>
                        
                                <?php }
                            } ?>
                      </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" id="shipping_first_name" name="shipping_first_name" value="<?php echo set_value('shipping_first_name');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" id="shipping_last_name" name="shipping_last_name" value="<?php echo set_value('shipping_last_name');?>">
                        </div>
                      </div>
                     <!-- <div class="col-md-12">
                        <div class="form-group">
                          <label>Company</label>
                          <input type="text" class="form-control">
                        </div>
                      </div> -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Shipping address</label>
                          <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="<?php echo set_value('shipping_address');?>">
                        </div>
                      </div>
                     
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Country</label>
                          <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" id="shipping_country" name="shipping_country" required>
              						  <?php foreach($countries as $country) { ?>
              						    <option value="<?=$country['name']?>" <?php if($country['name']=='United States') { ?>selected<?php } ?>><?=$country['name']?></option>
              						  <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>State</label>
                          <input type="text" class="form-control" id="shipping_state"  name="shipping_state" value="<?php echo set_value('shipping_state');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" class="form-control" id="shipping_city" name="shipping_city" value="<?php echo set_value('shipping_city');?>">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Zipcode</label>
                          <input type="text" class="form-control" id="shipping_zip_code" name="shipping_zip_code" value="<?php echo set_value('shipping_zip_code');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" class="form-control" id="shipping_contact" name="shipping_contact" value="<?php echo set_value('shipping_contact');?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" id="shipping_email" name="shipping_email" value="<?php echo set_value('shipping_email');?>">
                        </div>
                      </div>
                    </div>
                    <div class="order_notes">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Order notes</label>
                          <textarea placeholder="Notes about your order, e.g. special notes for delivery." class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                 <!-- </form>  -->
                </div>
              </div>
            </div>
          </div>
          
          <div class="your_order">
            <h2>Your Order</h2>
            <div class="row clearfix">
              <div class="col-md-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="50%">Product</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
  				    <?php 
					//echo "<pre>";print_r($cart_content);  var_dump($is_free_shipping);echo "</pre>";//die;
					
					foreach($cart_content as $conent){
						
						?>
                      <tr>
                        <td><?=$conent['name']?></td>
                        <td><?=number_format($conent['price'],2)?></td>
                      </tr>
					  <?php //sandy 04-05-2021 start ?>
					  <tr>
						<td>No of copies : <?= $conent['copies']?></td>
						<td>No of pages : <?= $conent['pages']?></td>
					  </tr>
					  <?php //sandy 04-05-2021 end ?>
  					  <tr>
                        <td>
  					              <?php if($conent['priniting_details']){ echo safe_str_replace(array(',', '||'), array('<br/>', ': '), $conent['priniting_details']);}?> </td>
                        <td>
  					              <?php if($conent['finishing_details']){
                            echo safe_str_replace(array(',', '||'), array('<br/>', ': '), $conent['finishing_details']); 					
  					              } ?> 
                        </td>
                      </tr>
						<tr>
							<td>Shipping Information</td>
							<td>
								<?= "Shipping Service: ".$conent['shipping_service_type']?></br>
								<?= "Shipping Amount: ". (($is_free_shipping) ? '0.00' : $conent['shipping_amount'])?></br>
								<?= "Completion Date: ".$conent['completion_date']?></br>
							</td>
						</tr>
  				    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Subtotal</th>
                      <td>$<?=number_format($subtotal,2); ?></td>
                    </tr>
                    <tr>
                      <th>Shipping</th>
                      <td>$<?=number_format($shipping_amount,2);?></td>
                    </tr>
                    <?php /*if($shipping_amount > 0) { ?>
                    <tr>
                      <th>Shipping Service Type</th>
                      <td><?=!empty($shipping_service_type)?$shipping_service_type:'--'?></td>
                    </tr>
                    <?php } */?>
                    
                    <tr>
                      <th>Additional Charges</th>
                      <td>$<?=number_format(($additional_charges != '') ? $additional_charges : 0,2);?></td>
                    </tr>
					<tr>
                      <th>Sales Tax</th>
                      <td>$<?=number_format($sales_tax,2);?></td>
                    </tr>
                    <tr>
                      <th>Coupon Discount</th>
                      <td>$<?=number_format($coupon,2);?></td>
                    </tr>
                    
                    <tr>
                      <th>Total</th>
                      <td>$<?=number_format(($cart_sub_total >0 ? $cart_sub_total : 0),2); ?></td>
                      <?php $total = $cart_sub_total?>
                      <input type="hidden" name="total" value="<?=$total?>">
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
		 <?php if($cart_sub_total > 0){ ?>
          <div class="payment_mood">
            <h2>Payment Method</h2>
            <div class="row clearfix">
              <div class="col-md-12">
                <div class="paymood_box">
                  <div class="panel-group" id="accordion">
                    
					<!--<div class="panel panel-default hidden">-->
					<?php
					/* */?>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <label for="r11">
                            <input type="radio" id="r11" name="payment_method" class="payment_method" onChange="show_dialog()" value="cod" required />
                            Cash on Delivery <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a> </label>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>Pay with cash upon delivery.</p>
                        </div>
                      </div>
                    </div>
                    <?php //*/?>
               
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <label for="r12">
                            <input type="radio" id="r12" name="payment_method" class="payment_method" value="card" required/>
                            Credit Card<img src="images/credits.png" alt="credit_card"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a> </label>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <div class="payment_box">
                            <div class="row clearfix">
                             <!-- <form> -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Name on Card</label>
                                    <input type="text" name="name_on_card" class="form-control required_cls" required>
                                  </div>
                                </div>
                                <!-- <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Billing Zipcode</label>
                                    <input type="text" class="form-control">
                                  </div>
                                </div> -->
                                <div class="clear"></div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Card Number</label>
                                    <input type="text" class="form-control required_cls" name="card_no" placeholder="XXXX XXXX XXXX XXXX" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Expiry Date (MM/YY)</label>
                                    <input type="text" class="form-control required_cls" name="exp_date" placeholder="MM/YY" required>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Card Code</label>
                                    <input type="password" class="form-control required_cls" name="card_code" placeholder="CVC" required>
                                  </div>
                                </div>
                              <!-- </form>-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		 <?php }else { ?>
		  <div class="row">
			<div class="col-md-5">
				<span style="color:red;">No Payment Required.</span>
			</div>	
		  </div>
		 <?php } ?>
          <div class="terms-condition">
              <a href="<?php echo base_url()?>cms_page/terms-&-conditions" target="_blank"><u>Click Here to view payment terms & Condition</u></a>
              <p><input type="checkbox" required>I understand and agree to the payment term & Condition</p>
          </div>              


          <div class="place_order">
            <div class="row clearfix">
              <div class="col-md-12">
                <div class="text-right">
                  <button  type="submit" name="place_order" value="place order" class="btn btn-success">Place Order&nbsp;<i class="fa fa-angle-right"></i></button>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" id="shipping_amount_hid" name="shipping_amount" value="<?php if(isset($shipping_amount) && $shipping_amount) { echo $shipping_amount;}else{ echo '0.00'; }?>">
          <input type="hidden" name="shipping_service_type" value="<?php if(isset($shipping_service_type) && $shipping_service_type) { echo $shipping_service_type;}?>">
          
        <?php  echo form_close(); ?>
      <?php } ?>
	  </div>
	</div> 
</div>

<div class="modal fade" id="cod_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- <form method="POST" id="signup_login_modal_form" name="signup_login_modal_form"> -->
			<div class="modal-header">
				<!--button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button-->
				<h4 class="modal-title" id="myModalLabel">Cash On Delivery</h4>
			</div>
			<div class="modal-body">

				<div class="row clearfix">
					<div class="col-md-12 col-sm-12">
						<div class="">
							<h4 style="color:red; font-weight:bold">COD can be only used if you have already set up an account, if you did not please use credit card payment.</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal" aria-label="Ok">Ok</button>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
  .form.green {
      background-color: #999999;
      border: 1px solid #a5a5a5;
      margin-bottom: 20px;
      color: #fff;
  }
  .form .container {
    margin: 10px;
  }
  .form .block {
      display: block;
      float: right;
      text-align: center;
      margin-right: 24px;
      margin-left: 8px;
  }
</style>
<script>

  $(document).on('click','#close_btn',function(){
      $(".order_success").hide();
  })

  $(document).on('change','#shipping_title', function(){
    //alert()
    //$('.modal_input').val('');
    
    if($(this).val()!=''){
      //$('#billing_address_id').val($(this).val());
      //$('#shipping_title_1').hide();
      //$('#address_title').val($(this).data("title"));
      $('#shipping_first_name').val($(this).find(':selected').data('first_name'));
      $('#shipping_last_name').val($(this).find(':selected').data('last_name'));
      $('#shipping_address').val($(this).find(':selected').data('address'));
      $('#shipping_city').val($(this).find(':selected').data('city'));
      $('#shipping_state').val($(this).find(':selected').data('state'));
      $('#shipping_zip_code').val($(this).find(':selected').data('zip_code'));
      $('#shipping_contact').val($(this).find(':selected').data('phone'));
      $('#shipping_email').val($(this).find(':selected').data('email'));
    }
    else{
      //$('#shipping_title_1').show();
      $('#shipping_first_name').val("").prop('readonly', false);
      $('#shipping_last_name').val("").prop('readonly', false);
      $('#shipping_address').val("").prop('readonly', false);
      $('#shipping_city').val("").prop('readonly', false);
      $('#shipping_state').val("").prop('readonly', false);
      $('#shipping_zip_code').val("").prop('readonly', false);
      $('#shipping_contact').val("").prop('readonly', false);
      $('#shipping_email').val("").prop('readonly', false);
    }
  }) 

  $(document).on('change','#billing_title', function(){
    //alert()
    //$('.modal_input').val('');
    
    if($(this).val()!=''){
      $('#billing_address_id').val($(this).val());
      //$('#shipping_title_1').hide();
      //$('#address_title').val($(this).data("title"));
      $('#first_name').val($(this).find(':selected').data('first_name'));
      $('#last_name').val($(this).find(':selected').data('last_name'));
      $('#address').val($(this).find(':selected').data('address'));
      $('#city').val($(this).find(':selected').data('city'));
      $('#state').val($(this).find(':selected').data('state'));
      $('#zip_code').val($(this).find(':selected').data('zip_code'));
      $('#contact_no').val($(this).find(':selected').data('phone'));
      $('#email').val($(this).find(':selected').data('email'));
    }
    else{
      //$('#shipping_title_1').show();
      $('#first_name').val("").prop('readonly', false);
      $('#last_name').val("").prop('readonly', false);
      $('#address').val("").prop('readonly', false);
      $('#city').val("").prop('readonly', false);
      $('#state').val("").prop('readonly', false);
      $('#zip_code').val("").prop('readonly', false);
      $('#contact_no').val("").prop('readonly', false);
      $('#email').val("").prop('readonly', false);
    }
  })  

  $(document).on('change','.payment_method',function(){
   
    if($(this).val() == 'card'){
      $(document).find('.required_cls').attr('required',true);
    }
    else{
      $(document).find('.required_cls').removeAttr('required');
    }
  })
  function show_dialog(){
	  $("#cod_modal").modal("show");
  }
  
  
</script>