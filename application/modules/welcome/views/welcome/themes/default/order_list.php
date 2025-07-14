<div class="page_inner">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group clearfix">
          <div class="order_list_heading">
            <h3>Your Order List<small></small></h3>
          </div>
          <!--<div class="order_listcal">
            <label>Choose your delivery date:</label>
            <div class="inputFld dpicker">
              <input type="text" id="datepicker">
              <button type="submit" value=""><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>-->
        </div>
      </div>
      <div class="col-md-12">
        <div class="order_list">
		<?php
// 		print_r($order_list);die;
		foreach($order_list as $list) {  ?>
				<div class="product_listBox clearfix">
				<div class="order_id"><span class="odid"><?=$list['order_id']?></span></div>
				<div class="product_img">
          <?php if($list['images']==""){ ?>       
            <img src="<?=base_url()?>images/no_image_sm_vjbo-hm.png">
          <?php } else {  ?>
            <?php $eachimage = explode('||', $list['images'])?>
            <?php if(!empty($eachimage)): foreach($eachimage as $row):?>
              <a href="<?=base_url().'uploads/files/'.$row?>" class="view_uploadded_docs" target="_blank"><?=$row?></a> 
            <?php endforeach; endif?>
          <?php } ?>
        </div>
				<div class="product_descriptions">
				<div class="product-title"><?=$list['product_name']?></div>
				<p class="product-description">
				<?php echo safe_str_replace("||" ,"-" , $list['printing_item'])  ?>
				<?php echo safe_str_replace("||" ,"-" , $list['finishing_item'])  ?>
				</p>
				<span class="quantity">Pages: <span><?=$list['pages']?></span></span><br>
                                <span class="quantity">Copies: <span><?=$list['copies']?></span></span> 
                                </div>
				<div class="poduct_price"> <?=number_format($list['total_price'],2)?> </div>
				<div class="delivery_date"> <span class="status_date">Delivery Date <?=$list['delivery_date'].' '.$list['delivery_time']?> 
                                </span> </div>
				<div class="delivery_status"> <span class="btn btn-success btn-sm">Order Placed</span> </div>
				</div>
		<?php } ?>
		
          
        </div>
      </div>
    </div>
  </div>
</div>