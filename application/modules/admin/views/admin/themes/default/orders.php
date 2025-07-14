<style>
	/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $page_title;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="col-md-12 breadcrumb_area1">
        <div class="col-md-10">
          <ol class = "breadcrumb">
            <li><a href = "<?= base_url('admin/dashboard');?>"><i class="fa fa-home"></i></a></li>
            <li><a href = "<?= base_url('admin/dashboard');?>">Home</a></li>
            <li class = ""><a href = "<?= base_url('admin/orders') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
         	
            <?php
			if(!empty($error) && $error == "error")
			{
			?>
				<div class="col-md-12 alert alert-danger"><?= $this->session->flashdata('update_message');?></div>
			<?php
			}
			else if(!empty($error) && $error == "success")
			{
			?>
				<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
			<?php
			}
			else if($this->session->flashdata('update_message'))
			{
			?>
				<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
			<?php
			}
			?>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Order Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="order_table">
                                    <thead>
                                      <tr>
                                        <th> Sl No. </th>
										<th> Image </th>
                                        <th> Order ID </th>
                                        <th> Transaction ID </th>
										<th> Product Name </th>
                                        <th>Quantity</th>
                                       <th>Order Total</th>
                                       <th>Customer Name</th>
                                       <th>Contact No</th>
                                       <th>Created On</th>                                       
                                        <th>Order Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    
                                    <?php
									foreach($result as $key=>$results)
									{
			                        
									?>
									  <tr>
                                      	<td class="text-center" data-order_id="<?=$results->id;?>"><?= ($key+1);?></td>
										<td class="text-center order_details_cls">
										     
										    <?php if(!$results->images){ ?>       
                                                <img width="100px;" src="<?=base_url()?>images/no_image_sm_vjbo-hm.png">
                                            <?php } else {  ?>
                                                <?php $eachimage = explode('||',$results->images)?>
                                                <?php if(!empty($eachimage)): foreach($eachimage as $row):?>
                                                <a href="<?=base_url().'uploads/files/'.$row?>" class="view_uploadded_docs_admin" target="_blank"><?=$row?></a> 
                                                <?php endforeach; endif?>
                                            <?php } ?>
										</td>
                                        <td class="text-center order_details_cls"><?= $results->order_id ;?></td>
                                        <td class="text-center order_details_cls"><?= $results->transaction_id;?></td>
										<td class="text-center order_details_cls"><?= $results->product_name ;?></td>
                                        <td class="text-center order_details_cls"><?= $results->quantity;?></td>
                                        <td class="text-center order_details_cls"><?= $results->total_price;?></td>
                                        <td class="text-center order_details_cls"><?= $results->first_name .' '.$results->last_name;?></td>
                                        <td class="text-center order_details_cls"><?= $results->phone;?></td>
                                        <td class="text-center order_details_cls"><?= $results->created_at;?></td>
										
										
										<td class="text-center">
											<select class="form-control change_status_btn" style="margin-bottom: 10px;">
												<option data-status="0" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>" 
												<?=($results->order_status == 0)?'selected':''?> value="0" <?=($results->order_status > 0)?'disabled':''?>>Order received</option>
												<option data-status="1" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 1)?'selected':''?> value="1" <?=($results->order_status > 1)?'disabled':''?>>Order approved and it is in production</option>
												<option data-status="2" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 2)?'selected':''?> value="2" <?=($results->order_status > 2)?'disabled':''?>>Order received but there is a problem</option>
												<option data-status="3" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 3)?'selected':''?> value="3" <?=($results->order_status > 3)?'disabled':''?>>Order is on hold until confirmed</option>
												<option data-status="4" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 4)?'selected':''?> value="4" <?=($results->order_status > 4)?'disabled':''?>>Order ready for pick up</option>
												<option data-status="5" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 5)?'selected':''?> value="5" <?=($results->order_status > 5)?'disabled':''?>>Order delivered free of charge</option>
												<option data-status="6" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 6)?'selected':''?> value="6" <?=($results->order_status > 6)?'disabled':''?>>Order has been shipped</option>
												<!-- <option data-status="7" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>"
												<?=($results->order_status == 7)?'selected':''?> value="7" <?=($results->order_status > 7)?'disabled':''?>>Order Delivered</option> -->
											</select>
										</td>
										<!-- <?php /* if($results->order_status == 0) { ?>
											<td class="text-center"><button style="white-space: normal;" class="btn btn-info btn-icon dropdown-toggle change_status_btn" data-toggle="dropdown"  data-status="0" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>">Order received</button></td>
										</td>
										<?php } elseif($results->order_status == 1){ ?>
											<td class="text-center"><button style="white-space: normal;" class="btn btn-info btn-icon dropdown-toggle change_status_btn" data-toggle="dropdown" data-status="1" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>">Order approved and it is in production</button></td>
										<?php } elseif($results->order_status == 2){ ?>
											<td class="text-center"><button style="white-space: normal;" class="btn btn-info btn-icon dropdown-toggle change_status_btn" data-toggle="dropdown" data-status="2" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>">Order ready for pick up</button></td>
										<?php } elseif($results->order_status == 3){ ?>
											<td class="text-center"><button style="white-space: normal;" class="btn btn-info btn-icon dropdown-toggle change_status_btn" data-toggle="dropdown" data-status="3" data-order_id="<?= $results->id ;?>" data-order_no="<?= $results->order_id ;?>">Order has been shipped</button></td>
										<?php } elseif($results->order_status == 4){ ?>
											<td class="text-center"><button style="white-space: normal;" class="btn btn-success btn-icon dropdown-toggle" data-toggle="dropdown">Order Delivered</button></td>
										<?php } */ ?> -->							
										
										<td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
											
												<?php /*?><li><a class="edit"  data-toggle="modal" data-target="#order<?= $results->id;?>" href="#order<?= $results->id;?>"><i class="fa fa-pencil"></i>View details</a></li>												
                                              <li><a class="edit" href="<?= base_url('admin/orders/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li><?php */?>
                                              <li><a href="javascript:void(0);" class="delete" onclick="deleteOrders(<?php echo $results->id;?>)"><i class="fa fa-trash"></i>Remove</a></li>
                                              <a  >
                                            </ul>
                                          </div></td>
                                      </tr>
									       <div id="order<?= $results->id;?>" class="modal fade" role="dialog">
											<div class="modal-dialog modal-lg">
											<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title"><?= $results->product_name;?></h4>
											</div>
											<div class="modal-body">
											<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Order Number : </label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= isset($results->order_id)?$results->order_id : '';?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Customer name : </label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->first_name .' '.$results->last_name ;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Customer Details :</label>
													</div>
													<div style="float:right; width:63%;">
													   <!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Contact No:</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->phone;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
														<!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Email Id:</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->email;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
													
													
													
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Customer Shipping Details :</label>
													</div>
													<div style="float:right; width:63%;">
														<!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Address:</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->address;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
														<!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Country:</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->country;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
														<!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">State:</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->state;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
														<!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">City:</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->city;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
														<!-- table mid panel start --->
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Zip code :</span>
															</div>
															<div style="float:left;width:68%">
															  <span style="color:#8E8E8E"><?= $results->zip_code;?></span>
															</div>
															<div style="clear:both;"></div>
														</div>

														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Shipping Type :</span>
															</div>
															<div style="float:left;width:70%">
															<span style="color:#8E8E8E"><?= (!empty($results->shipping_service_type)) ? $results->shipping_service_type : $results->shipping_type ?></span><?php //sandy 15-05-2021 ?>
															</div>
															<div style="clear:both;"></div>
														</div>
														<!-- table mid panel end  --->
													
													</div>
													<div style="clear:both;"></div>
												</div>
												<?php
													 $printing_item='';
													 $printing_item_string=explode(",", $results->printing_item);
													 
													 /* echo "<pre>";
													 print_r($printing_item_string); */
													 
											 
													 foreach($printing_item_string as $key => $printing){
														 
														 if(!empty($printing_item_string[$key])){
														 
														 $item_details=explode("||",$printing);
														 $printing_item .=$item_details[0].' : '.$item_details[1] .'<br>';
														 
														 }
													 }
											 
													 $finishing_item='';
													 $finishing_item_string=explode(",",$results->finishing_item);
													 
													 
													 foreach($finishing_item_string as $key => $finishing){
														 
														 if(!empty($finishing_item_string[$key])){
															 
															 $item_details=explode("||",$finishing);
															 $finishing_item .=$item_details[0].' : '.$item_details[1] .'<br>';
															 
														 }
														 
													 }
												$additional_charge = (!empty($results->additional_charge)) ? $results->additional_charge : 0;
												$coupon_disc = (!empty($results->coupon_disc)) ? $results->coupon_disc : 0;
												
												$grand_total = $results->price + $results->sales_tax + $results->shipping_amount + $additional_charge - $coupon_disc;
												?>
												
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Printing Details :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $printing_item;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Finishing Details :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $finishing_item;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>No Of Pages :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->pages;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>No Of Copies :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->copies;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Subtotal :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->price;?></span> <?php /* Sandy 31-03-2021 */ ?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Additional Charges :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->additional_charge;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Shipping Amount :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->shipping_amount;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Sales Tax :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->sales_tax;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Coupon Discount :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->coupon_disc;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Grand Total :</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $grand_total;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Payment Method</label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= !empty($results->payment_type)?$results->payment_type :'Cash On Delivery';?></span>
													</div>
													<div style="clear:both;"></div>
												</div>

												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Special Instructions </label>
													</div>
													<div style="float:right; width:63%;">
													<span style="color:#8E8E8E"><?= $results->special_instruction;?></span>
													</div>
													<div style="clear:both;"></div>
												</div>
												
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Date</label>
													</div>
													
													<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Placed Order:</span>
															</div>
															<div style="float:right;width:35%">
															  <span style="color:#8E8E8E"><?= date('d/m/Y H:i:s',strtotime($results->created_at)); ?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
														<div style="float:left; width:35%;">
													<label></label>
													</div>
														
														<div style="display:block; padding-bottom:8px;">
															<div style="float:left;width:30%">
															   <span style="font-weight:700; color:#424242;padding-right:15px;width:100px;dispaly:inline-block;">Delivery Date & Time :</span>
															</div>
															<div style="float:right;width:35%">
															  <span style="color:#8E8E8E"><?= $results->delivery_date .' '. $results->delivery_time?></span>
															</div>
															<div style="clear:both;"></div>
														</div>
													<div style="clear:both;"></div>
												</div>
											
											</div>
											</div>
											</div>
											</div>
									<?php
									
                                    }
									?>
                                    </tbody>
                    			</table>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
           
    	
        
    </div>
    <!-- /.container-fluid -->
</div>

<!-- MODAL SECTION -->
<div class="modal fade" id="explain_problem_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal_title"></h4>
			</div>
			<div class="modal-body">
				<form id="explain_problem_form" name="explain_problem_form" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="order_id" name="order_id" value="">
					<input type="hidden" id="status" name="status" value="">
					
					<div class="form-group" id="title_div"  style="display:none;">
						<label for="title" class="control-label">Subject:</label>
						<input type="text" class="form-control" id="title" name="title">
					</div>
					<div class="form-group" id="description_div" style="display:none;">
						<label for="message-text" class="control-label">Explain The Problem :</label>
						<textarea class="form-control custom_textarea" id="description"  name="description"></textarea>
					</div>
					<div class="form-group" id="image_div" style="display:none;">
						<label for="message-text" class="control-label">Upload Documents :</label>
						<input type="file" class="form-control" id="image"  name="image">
					</div>
					<div class="form-group" id="shipping_no_div" style="display:none;">
						<label for="message-text" class="control-label">Enter Tracking No :</label>
						<input type="text" class="form-control" id="shipping_no"  name="shipping_no">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="status_submit_btn" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
			
		</div>
  	</div>
</div>
<div class="loading" style="display:none;">Loading&#8230;</div>
<!-------END--------->
<script>
	$(document).ready(function(){
		$(document).ajaxStart(function(){
   			$(".loading").show();
 		});

		$(document).ajaxComplete(function(){
			$(".loading").hide();
 		});
		
		$('#order_table').DataTable({
    		responsive: true,
			scrollX:true

		});
	})
	var lastValue;
	$(document).on("click",'.change_status_btn',function(e){
    	 lastValue = $(this).find(':selected').val();
	}).on("change",'.change_status_btn',function(e){
		var status=$(this).find(':selected').data('status');
  		var order_id=$(this).find(':selected').data('order_id');
  		var order_no=$(this).find(':selected').data('order_no');
		var order_status_title=$(this).find(':selected').text();
		//alert(status); 
		$("#modal_title").text(order_status_title);  
		if(confirm('Do you want to change the status for this order '+order_no +'?')){
			
			if(status == 2){
				$("#order_id").val(order_id);
				$("#status").val(status);
				$("#shipping_no_div").hide();$("#shipping_no").attr('required',false);
				$("#title_div").show();$("#title").attr('required',true);
				$("#description_div").show();$("#description").attr('required',true);
				$("#image_div").hide();$("#image").attr('required',false);
				$("#explain_problem_modal").modal('toggle');
				$(this).val(lastValue); //set back
    			return;
			}
			else if(status == 3){
				$("#order_id").val(order_id);
				$("#status").val(status);
				$("#shipping_no_div").hide();$("#shipping_no").attr('required',false);
				$("#title_div").show();$("#title").attr('required',true);
				$("#description_div").hide();$("#description").attr('required',false);
				$("#image_div").show();$("#image").attr('required',true);
				$("#explain_problem_modal").modal('toggle');
				$(this).val(lastValue); //set back
    			return;
			}
			else if(status == 6){
				$("#order_id").val(order_id);
				$("#status").val(status);
				$("#shipping_no_div").show();$("#shipping_no").attr('required',true);
				$("#title_div").hide();$("#title").attr('required',false);
				$("#description_div").hide();$("#description").attr('required',false);
				$("#image_div").hide();$("#image").attr('required',false);
				$("#explain_problem_modal").modal('toggle');
				$(this).val(lastValue); //set back
    			return;
			}
			else{
				
				$.ajax({
					type: "POST",
					url: '<?php echo base_url('admin/orders/change_status')?>',
					data: {status:status,order_id:order_id},
					dataType:'json',
					ensode:true,
					success: function(response){
						alert('Order Status Changed Successfully');  
						location.reload();
					}
				});
			}
		}else{
			$(this).val(lastValue); //set back
    		return;     
		}
		
	
	});	

	$(document).on('click','.order_details_cls',function(){
		var order_id=($(this).parents('tr').children('td:nth-child(1)').data('order_id'));
		//alert(order_id);
		$("#order"+order_id).modal('toggle');
	})
	
	$("#explain_problem_form").submit(function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$("#status_submit_btn").attr('disabled',true);
		$("#status_submit_btn").text('Processing...');
		$.ajax({
			url: "<?= base_url() ?>admin/orders/change_status",
			data: formData,
			type: "post",
			cache: "false",
			dataType: 'json',
			contentType: false,
			processData: false,
			encode: true,
      	})
        
        .done(function(data) {
          if(data.status){
				$("#status_submit_btn").attr('disabled',false);
				$("#status_submit_btn").text('Completed');
            	alert('Order Status Changed Successfully');  
				location.reload();
          }
          else{
				$("#status_submit_btn").attr('disabled',false);
				$("#status_submit_btn").text('Submit');
            	alert(data.message);  
			}
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
			$("#status_submit_btn").attr('disabled',false);
			$("#status_submit_btn").text('Submit');
			alert('Server Not Responding');  
		});

	})
	
function deleteOrders(id) {
	if(confirm("Are you sure you want to remove this order?") == true) {
		$.ajax({
			type :"get",
			url : "<?php echo base_url('admin/orders/delete_orders')."/";?>"+id,
			success:function(response) {
				//alert(response);
				location.reload();
			}
		})
	}
}
 </script>