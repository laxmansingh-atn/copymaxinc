
<div class="page_inner">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="shopping_cart_bx">
					<?php if ($this->session->flashdata('error_msg')) : ?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<?php echo $this->session->flashdata('error_msg') ?>
						</div>
					<?php endif ?>

					<h1>Shopping Cart</h1>
					
					<div class="table-responsive">
						<table class="table cart-table">
							<thead>
								<tr>
									<th>Image</th>
									<th>Product</th>
									<th>Printing Details</th>
									<th>Finishing Details</th>
									<th width="20%">Shipping Details</th>
									<th>No Of Page(s)</th>
									<th>No Of Copy(s)</th>
									<th>Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php echo form_open('cart/update_cart'); ?>

								<?php $total = $grand_total = $total_shipping_amount = 0; ?>
								<?php if (count($cart_products) > 0) { ?>
									<?php //echo "<pre>"; print_r($cart_products);die(); 
										?>
									<?php foreach ($cart_products as $cart_result) { ?>
										<?php $total = $total + $cart_result['subtotal'];
										if(!$is_free_shipping || $this->cart->total() < 500){
											$total_shipping_amount = $total_shipping_amount + $cart_result['shipping_amount'];
										}
											
										?>
										<tr>
											<td>
												<div class="product-image">
													<?php if ($cart_result['image'] == "") { ?>
														<img src="<?= base_url() ?>images/no_image_sm_vjbo-hm.png">
													<?php } else {  ?>
														<?php $eachimage = explode('||', $cart_result['image']) ?>
														<?php if (!empty($eachimage)) : foreach ($eachimage as $key => $row) : ?>
																<a href="<?= base_url() . 'uploads/files/' . $row ?>" class="view_uploadded_docs" target="_blank"><?= $row ?></a>
														<?php endforeach;
																	endif ?>
													<?php } ?>
												</div>
											</td>
											<td>
												<div class="product-title"><?= $cart_result['name'] ?></div>
											</td>
											<td>
												<div class="product-description"><?php echo '<b>Printing:</b> ' . safe_str_replace(array(',', '||'), array('<br/>', ' : '), $cart_result['priniting_details']); ?></div>
											</td>
											<td>
												<div class="product-description"><?php if ($cart_result['finishing_details'] != "") echo '<b>Finishing:</b> ' . safe_str_replace(array(',', '||'), array('<br/>', ' : '), $cart_result['finishing_details']); ?></div>
											</td>
											<td>
												<div class="product-description">
													<?php 
													//if ($cart_result['shipping_type'] != "") echo '<b>Shipping Type:</b> ' . $cart_result['shipping_type']; ?>
													<?php if ($cart_result['shipping_service_type'] != "" ) echo '<b>Service Type:</b> ' . $cart_result['shipping_service_type']; ?></br>
													<?php 
													if ($cart_result['shipping_type'] != "") 
														echo '<b>Shipping Amount:</b> ' . ((!$is_free_shipping || $this->cart->total() < 500) ? $cart_result['shipping_amount'] : '0.00'); 
													?>
												</div>
											</td>
											<td>
												<div class="product-quantity"><?php echo $cart_result['pages']; ?></div>
											</td>
											<td>
												<div class="product-quantity">
													<!-- <input type="number"  min="1" pattern="[0-9]*" name="cart[<?php //echo $cart_result['rowid'] 
																															?>]" value="<?php //echo $cart_result['qty']; 
																																											?>" id="cart_item"> -->
													<?php echo $cart_result['copies'] ?>
												</div>
											</td>
											<td>
												<div class="product-line-price"><?php echo number_format($cart_result['subtotal'], 2); ?></div>
											</td>
											<td>
												<div class="product-removal">

													<!-- <a title="Edit" data-rowid="<?= $cart_result['rowid'] ?>" data-id="<?= $cart_result['id'] ?>" data-copies="<?= $cart_result['copies'] ?>" data-pages="<?= $cart_result['pages'] ?>" data-printing="<?= $cart_result['priniting_details'] ?>" data-finishing="<?= $cart_result['finishing_details'] ?>" data-perPage="<?= $cart_result['price_page'] ?>" data-price="<?= $cart_result['price'] ?>" data-image="<?= $cart_result['image'] ?>" href="javascript:void(0)" class="btn btn-success btn-sm edit_cart"> <i class="fa fa-pencil"></i> </a> -->
													<a title="Edit" href="<?php base_url() ?>product-details/<?= $cart_result['product_slug'] ?>?rowid=<?= $cart_result['rowid'] ?>" class="btn btn-success btn-sm edit_cart"> <i class="fa fa-pencil"></i> </a>

													<a title="Delete" onclick="return confirm('Want to remove the item from cart?')" href="<?= base_url() . 'cart/delete_cart_item/' . $cart_result['rowid'] . '/' . $cart_result['id'] ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i> </a>
												</div>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td colspan="9" style="text-align:center">No Product Found.</td>
									</tr>
								<?php } ?>
								<?php echo form_close(); ?>
							</tbody>

						</table>
					</div>
					<div class="shopping-cart clearfix">


						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-5">
								<label><strong>Special Instructions</strong></label>
								<textarea rows="6" cols="50" name="special_instruction" id="special_instruction"></textarea><br>
								<span style="color:red;">Special instructions will be considered but are not guaranteed</span>
							</div>

							<div class="col-md-7 totals clearfix">

								<div class="totals-item">
									<label><strong>Subtotal</strong></label>
									<div class="totals-value" id="cart-subtotal"><strong><?= number_format($total, 2) ?></strong></div><br>
								</div>
								<!-- <div class="totals-item">
									<label>Shipping Amount</label>
									<div class="totals-value cart-shipping">0.00</div>
								</div>  -->
								<div class="totals-item">
									<label>Additional Charges</label>
									<div class="totals-value"><input type="text" name="additional_charges" id="additional_charges" value="0.00" style="text-align:right; width: 92px;"></div>
								</div>
								
								<div class="totals-item">
									<label>Shipping Amount</label>
									<div class="totals-value" id="shipping_amount"><?php
									$total_shipping_amount = number_format($total_shipping_amount, 2);
									echo $total_shipping_amount;
									?></div>
								</div>
								
								<div class="totals-item">
									<label>Sales Tax </label>
									<?php $sales_tax = number_format((($total + $total_shipping_amount) * SALES_TAX_PER), 2); ?>
									<div class="totals-value sales_tax"><?= $sales_tax; ?></div>
								</div>

								<div class="totals-item">
									<label>Coupon Discount</label>
									<div class="totals-value coupon_discount">0.00</div>
								</div>

								<div class="totals-item totals-item-total">
									<label><strong>Grand Total</strong></label>
									<?php $grand_total = $total + $sales_tax + $total_shipping_amount ?>
									<div class="totals-value" id="cart-total"><strong><?= number_format(($grand_total > 0 ? $grand_total : 0), 2) ?></strong></div>
								</div>
							</div>
						</div>
						<div class="apply_coupon">
							<input type="text" id="coupon_code" placeholder="Enter Coupon Code">
							<input type="button" id="coupon" class="btn btn-primary" value="Apply Coupon">
						</div>
						<div class="btn-area clearfix">
							<a href="<?= base_url() ?>" onclick="return gtag_report_conversion('<?= base_url() ?>');" class="btn btn-warning pull-left"><i class="fa fa-angle-left"></i>&nbsp;Continue Shopping</a>
							<!--a href="<?= base_url() ?>" class="btn btn-warning pull-left"><i class="fa fa-angle-left"></i>&nbsp;Continue Shopping</a-->

							<?php echo form_open('checkout', 'name="checkoutform" id="checkoutform"'); ?>
							<!-- <form id="checkoutform" name="checkoutform" action="index/checkout" method="POST"> -->

							<input type="hidden" id="is_logged_in" name="is_logged_in" value="<?php echo $is_logged_in; ?>">
							<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
							<input type="hidden" name="date" id="current_date" value="">
							<input type="hidden" name="completion_date" id="current_date_completion" value="">
							<input type="hidden" name="shipping_amount" id="shipping_amount_hid" value="<?= $total_shipping_amount?>">
							<input type="hidden" name="shipping_service_type" id="shipping_service_type" value="">
							<input type="hidden" name="zip_code" id="zip_data" value="">
							<input type="hidden" name="coupon" id="coupon_discount" value="">
							<input type="hidden" name="subtotal" id="subtotal" value="<?= $total ?>">
							<?php $sales_tax = (($total+ $total_shipping_amount) * SALES_TAX_PER); ?>
							<input type="hidden" name="sales_tax" id="sales_tax" value="<?php echo $sales_tax; ?>">
							<input type="hidden" name="total_amount" id="total_amount" value="<?= $total + $sales_tax + $total_shipping_amount ?>">
							<input type="hidden" name="additional_charges_hid" id="additional_charges_hid">
							<input type="hidden" name="shipping_type" id="shipping_type_val" value="">
							<input type="hidden" name="delivery_time" id="delivery_time_val" value="">
							<input type="hidden" name="special_instruction_hid" id="special_instruction_hid" value="">
							<?php if (count($cart_products) > 0) { 
									if($is_free_shipping && $this->cart->total() < 500){ ?>
									<span style="color:red" class="pull-right">Update The Shipping Details</span>
							<?php	}else { ?>
									<button type="button" class="btn btn-success pull-right" id="btn-checkout">Checkout&nbsp;&nbsp;<i class="fa fa-angle-right"></i>
									</button>
							<?php 	} 
								}	?>
							<!-- </form>  -->
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).on('click', '#btn-checkout', function() {

		var is_logged_in = $("#is_logged_in").val();
		var user_id = $("#user_id").val();
		$("#special_instruction_hid").val($("#special_instruction").val());
		//alert(is_logged_in);alert(user_id);  

		if (is_logged_in != '' && user_id != '') {
			$('#checkoutform').submit();
		} else {

			$('.register-box').hide();
			$('.login_form').show();
			$("#signup_login_modal").modal('show');
		}
	});
</script>