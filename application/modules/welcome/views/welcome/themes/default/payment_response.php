<div class="page_inner">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="order_success">
          <?php if(array_key_exists('transaction_id', $payment_details)):?>
              <h1><?php echo $payment_details['description']?></h1>
              <p>Your Transaction is<span><?php echo $payment_details['transaction_id']?></span></p>
              <p>You will receive an order confirmation email with details of your order.</p>
          <?php else:?>
              <h1><?php echo $payment_details['error_message']?></h1>
              <p>Error code is<span style="color: red;"><?php echo $payment_details['error_code']?></span></p>
              <!-- <h1>Success</h1> -->
          <?php endif?>
          
          <button class="btn btn-warning" onclick="window.location.href='<?=base_url()?>'">Continue Shopping</button>
        </div>
      </div>
    </div>
  </div>
</div>