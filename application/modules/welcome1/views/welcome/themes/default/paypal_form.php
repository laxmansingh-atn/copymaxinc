<div class="about-us_section">
    <div class="container">
        <div class="about-us_section-inner"> 
      
      <!--Heading:Start-->
      <div class="common-wrap">
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="inner-heading-box">
      <h1 class="title-1 text-center">You are redirect shortly.... </h1>
    </div>
  </div>
  </div>
  </div>          
        <!--Heading:Start--> 

      <!--Checkout-part:Start-->
      
      <?php
      //Set useful variables for paypal form
      $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
      //$paypal_id = 'info@codexworld.com'; //Business Email
      //$paypal_id = 'support.dfx-facilitator1@gmail.com'; //Business Email
      //$paypal_id = 'aptech.digital@gmail.com'; //Business Email
      //$paypal_id = 'arghya.saha@met-technologies.com'; //Business Email
      $paypal_id = 'avishek.chakraborty5@met-technologies.com'; //Business Email
      //fetch products from the database
      ?>

      <form id="paypal_form" action="<?php echo $paypal_url; ?>" method="post">
          <!-- Identify your business so that you can collect the payments. -->
          <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
          <!-- Specify a Buy Now button. -->
          <input type="hidden" name="cmd" value="_cart">
          <!-- Specify details about the item that buyers will purchase. -->
          <input type="hidden" name="custom" value="<?php echo $order_id;?>">

          <input type="hidden" name="upload" value="1">
          <input type="hidden" name="currency_code" value="GBP">
          
          <?php 
          $i=0;
          foreach($cart_products as $key=>$value){$i++;?>
            <input type="hidden" name="item_name_<?php echo $i;?>" value="<?php echo $value['name'];?>">            
            <input type="hidden" name="item_number_<?php echo $i;?>" value="<?php echo $value['qty'];?>">            
            <input type="hidden" name="amount_<?php echo $i;?>" value="<?php echo number_format($value['subtotal'], 2);?>"><?php          
          }?>
          
          <!-- Specify URLs -->             
          <input type='hidden' name='return' value='<?php echo base_url();?>cart/paypal_success'>
          <input type='hidden' name='cancel_return' value='<?php echo base_url();?>cart/paypal_cancel'>          
          <input type="hidden" name="notify_url" value="<?php echo base_url();?>cart/paypal_notify"> 
          <!-- Display the payment button. -->          
      </form>
      <!--Checkout-total:End--> 
      
    </div>
    </div>
</div>  