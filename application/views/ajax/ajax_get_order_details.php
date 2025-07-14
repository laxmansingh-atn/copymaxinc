<div class="control-group">
  <label class="control-label">Transaction Id</label>
  <div class="controls readonly">
    <?php echo $order_list['transaction_id'];?>
  </div>
</div>
<div class="control-group">
  <label class="control-label">Grand Total</label>
  <div class="controls readonly">
    $<?php echo number_format($order_list['total_price'], 2);?>
  </div>
</div>
<div class="control-group">
  <label class="control-label">Order Date</label>
  <div class="controls readonly">
    <?php echo date('dS M Y', strtotime($order_list['created_on']));?>
  </div>
</div>                          
<div class="control-group">
  <label class="control-label">Status</label>
  <div class="controls readonly">
    <?php echo $order_list['delivery_status'];?>
  </div>
</div>

<table class="table">
    <thead>
      <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $order_details = $order_list['order_details'];
      foreach($order_details as $key=>$value){?>
        <tr>
          <td><?php echo $value['product_name'];?></td>
          <td><?php echo $value['qty'];?></td>
          <td>$<?php echo number_format($value['price'], 2);?></td>
        </tr>
      <?php
      }?>
    </tbody>
</table>    