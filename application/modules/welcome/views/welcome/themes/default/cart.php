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
					<div class="shopping_order">
						<div class="row clearfix">
							<div class="col-md-6 col-sm-6">
								<div class="update_shipping_quote">
									<h3>Update Your Shipping Quote</h3>
									<div class="quote_box">

										<div class="form-group deliver_details">
											<label>Choose your Completion date:</label>
											<div class="inputFld dpicker">
												<input type="text" id="cart_datepicker_completion" autocomplete="off">
											</div>
										</div>


										<div class="form-group">
											<label>Choose Your Delivery Option </label>
											<div class="inputFld">
												<select id="shipping_type">
													<option value="" disabled="disabled" selected="selected">Please select an option</option>
													<option value="pick">I'll pick up</option>
													<?php if ($this->cart->total() >= 500) : ?>
														<option value="free">Free Delivery</option>
													<?php else : ?>
														<option value="ship">Ship my order</option>
													<?php endif ?>
												</select>
											</div>
										</div>

										<div class="form-group deliver_details" id="delivery_date_show_hide" style="display:none;">
											<label>Choose your delivery date:</label>
											<div class="inputFld dpicker">
												<input type="text" id="cart_datepicker" autocomplete="off">
											</div>
										</div>

										<div class="form-group deliver_details" id="delivery_time_show_hide" style="display:none;">
											<label>By the following time: (?):</label>
											<div class="inputFld">

												<div id="show_hide_time_fixed" style="display:none;"></div>

												<div id="show_hide_time" style="display:none;">
													<select id="delivery_time">
													</select>
												</div>
											</div>
										</div>
										<div class="form-group zip" style="display:none">
											<label>Ship to the following ZIP code:</label>
											<div class="inputFld zip">
												<!-- <select name="zip_code" id="zip_code">
													<option value="">  Select </option>
													<?php /*foreach($zip_code as $code){ 
														echo '<option value="'.$code->zip_code .'">'.$code->zip_code.'</option>';
												 	} */ ?>
												</select> -->
												<input type="text" name="zip_code" id="zip_code" autocomplete="off">
											</div>
										</div>
										<div class="form-group" id="price_button" style="display:none;">

											<button type="button" class="btn btn-success pull-right" id="price_check_btn">Check Shipping Price</button>

										</div>

										<div class="" id="ups_response_div" style="display:none;">



										</div>


										<div class="form-group">
											<!-- style="display:none;" -->
											<div class="quote_retrieve" id="quote_hide_show" style="display:none;">Your quote has been retrieved.</div>
										</div>
										<div class="form-group address">
											<div id="delivery_address_div" style="display:none;">
												<label>Pickup Address</label>
												<div class="inputFld">
													<b>Pick up at our partner Facility only<br>
														Copymax<br>
														<p>802 North twin oaks valley road</p> 
														<p>STE 108</p>
														<p>San Marcos, CA 92069</p>

												</div>
											</div>
											<div id="delivery_note_div" style="display:none;">
												<label>Please Note</label>
												<div class="inputFld">
													<b>Order will be delivered next business day before 4 P.M.<br>
														After completion of your order<br>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- <p style="font-size: 20px;font-weight: bold;color: red;margin-top: 10px;">If you need your order “Next Day” please call us to discuss options.</p> -->
								<p style="font-size: 14px;font-weight: bold;color: red;margin-top: 10px;">Our cut off time is any business day 11:00am, orders PLACED BEFORE 11AM will be ready FOR PICK UP AFTER TWO BUSINESS DAYS AT 4PM.</p>
								<p style="font-size: 18px;font-weight: 800;color: red;margin-top: 10px;">Rush service available, call for details 1-844-Copymax (2679629)</p>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="update_shipping_text">

									<h2>Choose your delivery date here</h2>
									<p>-To get started fill out the form on the left.</p>
									<p>-The shipping/Delivery time starts from the time your job is completed,</p>
									<p> -If your order is more than $500 you get free Delivery within San Diego County & normally it arrives next business day before 4:00 pm after completion of your order. </p>

								</div>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table cart-table">
							<thead>
								<tr>
									<th>Image</th>
									<th>Product</th>
									<th>Printing Details</th>
									<th>Finishing Details</th>
									<th>No Of Page(s)</th>
									<th>No Of Copy(s)</th>
									<th>Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php echo form_open('cart/update_cart'); ?>

								<?php $total = $grand_total = 0; ?>
								<?php if (count($cart_products) > 0) { ?>
									<?php //echo "<pre>"; print_r($cart_products);die(); 
										?>
									<?php foreach ($cart_products as $cart_result) { ?>
										<?php $total = $total + $cart_result['subtotal']; ?>
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
												<div class="product-description"><?php echo '<b>Printing:</b> ' . safe_str_replace('||', '-', $cart_result['priniting_details']); ?></div>
											</td>
											<td>
												<div class="product-description"><?php if ($cart_result['finishing_details'] != "") echo '<b>Finishing:</b> ' . safe_str_replace('||', '-', $cart_result['finishing_details']); ?></div>
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
										<td colspan="8" style="text-align:center">No Product Found.</td>
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
									<label>Sales Tax <?= SALES_TAX_PER?></label>
									<?php $sales_tax = number_format(($total * SALES_TAX_PER), 2); ?>
									<div class="totals-value sales_tax"><?= $sales_tax; ?></div>
								</div>

								<div class="totals-item">
									<label>Shipping Amount</label>
									<div class="totals-value" id="shipping_amount">0.00</div>
								</div>

								<div class="totals-item">
									<label>Coupon Discount</label>
									<div class="totals-value coupon_discount">0.00</div>
								</div>

								<div class="totals-item totals-item-total">
									<label><strong>Grand Total</strong></label>
									<div class="totals-value" id="cart-total"><strong><?= number_format(($total + $sales_tax), 2) ?></strong></div>
								</div>
							</div>
						</div>
						<div class="apply_coupon">
							<input type="text" id="coupon_code" placeholder="Enter Coupon Code">
							<input type="button" id="coupon" class="btn btn-primary" value="Apply Coupon">
						</div>
						<div class="btn-area clearfix">
							<a onclick="return gtag_report_conversion('<?= base_url() ?>');" href="<?= base_url() ?>" class="btn btn-warning pull-left"><i class="fa fa-angle-left"></i>&nbsp;Continue Shopping</a>

							<?php echo form_open('checkout', 'name="checkoutform" id="checkoutform"'); ?>
							<!-- <form id="checkoutform" name="checkoutform" action="index/checkout" method="POST"> -->

							<input type="hidden" id="is_logged_in" name="is_logged_in" value="<?php echo $is_logged_in; ?>">
							<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
							<input type="hidden" name="date" id="current_date" value="">
							<input type="hidden" name="completion_date" id="current_date_completion" value="">
							<input type="hidden" name="shipping_amount" id="shipping_amount_hid" value="0">
							<input type="hidden" name="shipping_service_type" id="shipping_service_type" value="">
							<input type="hidden" name="zip_code" id="zip_data" value="">
							<input type="hidden" name="coupon" id="coupon_discount" value="">
							<input type="hidden" name="subtotal" id="subtotal" value="<?= $total ?>">
							<?php $sales_tax = ($total * SALES_TAX_PER); ?>
							<input type="hidden" name="sales_tax" id="sales_tax" value="<?php echo $sales_tax; ?>">
							<input type="hidden" name="total_amount" id="total_amount" value="<?= $total + $sales_tax ?>">
							<input type="hidden" name="additional_charges_hid" id="additional_charges_hid">
							<input type="hidden" name="shipping_type" id="shipping_type_val" value="">
							<input type="hidden" name="delivery_time" id="delivery_time_val" value="">
							<input type="hidden" name="special_instruction_hid" id="special_instruction_hid" value="">
							<?php if (count($cart_products) > 0) { ?>
								<button type="button" class="btn btn-success pull-right" disabled id="btn-checkout">Checkout&nbsp;&nbsp;<i class="fa fa-angle-right"></i>
								</button>
							<?php } ?>
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
	// $(document).ready(function(){




	// }



	$(document).on('click', '#btn-checkout', function() {


		var shipping_type = $('#shipping_type').val();
		var current_date = $('#current_date').val();
		var current_date_completion = $('#current_date_completion').val();
		var is_logged_in = $("#is_logged_in").val();
		var user_id = $("#user_id").val();
		$("#special_instruction_hid").val($("#special_instruction").val());
		//alert(is_logged_in);alert(user_id);  

		if (is_logged_in != '' && user_id != '') {

			if ($("#shipping_type").val() == 'pick') {
				var delivery_time = '4.00 P.M';
			} else {
				var delivery_time = $('#delivery_time').val();
			}


			$("#delivery_time_val").val(delivery_time);
			if (shipping_type == 'ship') {
				var zip_code = $('#zip_code').val();
				var shipping_amount_hid = $("#shipping_amount_hid").val();
				//current_date != "" && delivery_time != ""
				if (zip_code != ""  && shipping_amount_hid > 0) {
					$('#checkoutform').submit();
				} else {
					alert('Please fillup all shipping Quote');
					return false;
				}
			} else if (shipping_type == 'pick') {
				if (current_date_completion != "" && delivery_time != "") {
					$('#checkoutform').submit();
				} else {
					alert('Please fillup all shipping Quote');
					return false;
				}
			} else if (shipping_type == 'free') {
				if (current_date_completion != "" && zip_code != "") {
					$('#checkoutform').submit();
				} else {
					alert('Please fillup all shipping Quote');
					return false;
				}
			}
		} else {

			$('.register-box').hide();
			$('.login_form').show();
			$("#signup_login_modal").modal('show');
		}
	});

	$(document).on('click', '#price_check_btn', function() {
		$("#ups_response_div").html('');
		$("#ups_response_div").show();
		var shipping_type = $('#shipping_type').val();
		var current_date = $('#current_date').val();
		var current_date_completion = $('#current_date_completion').val();
		var zip_code = $('#zip_code').val();
		var delivery_time = $("#delivery_time").val();



		if (shipping_type == 'ship') {
            //&& current_date != "" && delivery_time != "" 
			if (zip_code != "" && current_date_completion != "") {
				$("#delivery_time_val").val(delivery_time);
				$("#price_check_btn").attr('disabled', true);
				$("#price_check_btn").text('Please Wait.....');
				$("#btn-checkout").attr('disabled', true);
				$.ajax({
						url: "<?= base_url() ?>welcome/cart/get_price_from_upi",
						data: {
							shipping_type: shipping_type,
							current_date: current_date,
							current_date_completion: current_date_completion,
							zip_code: zip_code,
							delivery_time: delivery_time
						},
						type: "post",
						cache: "false",
						dataType: 'json',
						encode: true
					})
					.done(function(data) {
						//console.log(data);
						$("#price_check_btn").attr('disabled', false);
						$("#price_check_btn").text('Check Shipping Price');
						$("#btn-checkout").attr('disabled', false);
						var resulthtml = '';

						if (data.shipping_response) {

							$.each(data.shipping_response, function(key, value) {

								if (value) {
									$.each(value, function(key1, value1) {

										if (value1.status == 1) {
											resulthtml += `<label for="r_` + key1 + `">
                            								<input type="radio" id="r_` + key1 + `" name="ups_shipping" class="ups_shipping" value="` + value1.shipment_rate + `" required data-shipping_service_type="`+value1.code_desc+`"/>  `+value1.code_desc+`<span style="color:red;font-weight:bold;">  $` + value1.shipment_rate + `</span></label><br>`;

										}
									})

								} else {
									resulthtml = '<span style="color:red;font-weight:bold;">No shipping option available</span>';
								}

							})
						} else {
							resulthtml = '<span style="color:red;font-weight:bold;">No shipping option available</span>';

						}
						$("#ups_response_div").html(resulthtml);
						$("#quote_hide_show").show();
					})
					.fail(function(jqXHR, ajaxOptions, thrownError) {
						$("#price_check_btn").attr('disabled', false);
						$("#price_check_btn").text('Check Shipping Price');
						$("#btn-checkout").attr('disabled', false);
						alert('server not responding...');
						$("#ups_response_div").html('<span style="color:red;font-weight:bold;">No shipping option available</span>');

					});
			} else {
				alert('Please fillup all shipping Quote');
				return false;
			}
		}
	});

	$(document).on('change', '.ups_shipping', function() {


		var shipping_amount = parseFloat($(this).val()).toFixed(2);
		var shipping_service_type = $(this).data('shipping_service_type');
		$("#shipping_amount_hid").val(shipping_amount);
		$("#shipping_amount").text(shipping_amount);
		$("#shipping_service_type").val(shipping_service_type);


		var total_cost = Number($('#subtotal').val()) + Number($('#additional_charges').val()) + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());

		$('#cart-total').text(parseFloat(total_cost).toFixed(2));
		$('#total_amount').val(total_cost);


	})
</script>