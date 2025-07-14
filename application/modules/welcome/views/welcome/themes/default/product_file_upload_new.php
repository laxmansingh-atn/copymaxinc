<?php
$total_cart_ship = $this->cart->total();
if(!empty($details['row_id'])){
	foreach($this->cart->contents() as $cart){
		if($cart['rowid'] == $details['row_id']){
			$total_cart_ship -= $cart['subtotal'];
		}
	}
	$total_cart_ship += $details['total'];
}else{
	$total_cart_ship += $details['total'];
}
?>

<div class="page_inner">
  <div class="container">
    <div class="alert alert-danger" style="display:none;" id="error_msg_div">
      <a  class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <span id="error_msg"></span>
    </div>
	<style>
		/*.update_shipping_text h2{
			font-size : 
		}*/
		.upload_pg {
			max-width : 950px !important;
		}
		.update_shipping_text{
			margin: 0 !important;
			padding:20px 0 0 0 !important;
		}
		.update_shipping_text > h2 {
			color: #333;
			float: none;
			font-size: 24px;
			font-weight:700;
			text-transform: inherit;
			margin: 0;
			position: relative;
			padding: 0 0 10px 60px;
		}
		.update_shipping_text > h2:before {
			content: "";
			transform: rotate(90deg);
			background: url(/assets/frontend/images/back-icon.png) no-repeat;
			height: 25px;
			width: 50px;
			background-position: center top;
			background-size: contain;
			position: absolute;
			left: 0;
			top: 0;
		}
	</style>
<div class="row clearfix">
      <div class="col-md-12">
        <div class="upload_pg">
			<div class="mgs">
				<h2><img src="<?php echo base_url(); ?>assets/frontend/images/file_add.png" alt="file upload">Upload your file</h2>
				<p>If you have any problems with uploading your file(s) please place your order without uploading your file(s) and we will send you a link to upload your files. Sorry for any inconvenience.</p>
			</div>
          <form id="add_to_cart_form" action="<?php echo base_url(); ?>cart/add_cart" method="post" enctype="multipart/form-data">
		  
            <div class="bg_box">
              <div class="row clearfix">
                <div class="col-md-8">
                  <div class="inprogress">
                    <h3>File Upload In Progress</h3>
                    <div class="inprogress_fld">
                      <div id="hide">
                      <?=($this->session->userdata('uploaded_image'))?'':'No files to preview'?>
                      </div>
                      <div id="image_progress_bar" style="display:none;">
                        <!-- <div id="progress" class="progress">
                          <div class="progress-bar progress-bar-success"></div>
                        </div> -->
                        <div id="progress" class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:10%">
                      </div>
                        </div>
                        <span id="image_name" style="float:left"></span> <span style="float:right"><span id="upload_percentage">0</span>%</span>
                        
                      </div>
                    </div>
                  </div>
                  <div class="inprogress">
                    <h3>File Upload</h3>
                    <div class="inprogress_fld">
                    <span class="text-data"><?=($this->session->userdata('uploaded_image'))?'':'No files to preview'?></span>
                      <div id="image_preview">
                      <?php if($this->session->userdata('uploaded_image')){
                        $image_name=explode("||",$this->session->userdata('uploaded_image'));
                        foreach($image_name as $image){
                        ?>
                        
                        <div class="product-image"><a href="<?=base_url('uploads/files/'.$image)?>"  class="view_uploadded_docs" target="_blank"><?= $image ?></a><div class="secondary-content actions"><a class="delete_button" data-link="./uploads/files/<?=$image?>" data-file_name="<?=$image?>"  data-dz-remove class="btn btn-danger btn-sm"><i class="fa fa-trash white-text"></i></a></div></div>
                      <?php } } ?>

                      </div>
                      
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <span style="color:red;font-weight:bold;font-size:13px;">Please Note : Files will be uploaded to our server after clicking on add to cart button</span>
                  </div> -->
                  <!-- <div class="col-md-12" id="progress_bar" style="display:none;">
                    <h2 id="status_code">Processing....</h2>
                    <p id="status">Please wait,image upload in progress</p>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                      </div>
                    </div>
                  </div> -->
				
                </div>
				<?php 
				$postvalue = base64_encode(serialize($details));
				
				?>
				<input type="hidden" name="date" id="current_date" value="">
				<input type="hidden" name="completion_date" id="current_date_completion" value="">
				<input type="hidden" name="shipping_amount" id="shipping_amount_hid" value="0">
				<input type="hidden" name="shipping_service_type" id="shipping_service_type" value="">
				<input type="hidden" name="zip_code" id="zip_data" value="">
				
                <input type="hidden" id="product_total" name="product_total" value="<?= $details['total'] ?>">
				<input type="hidden" id="extra_data" name="extra_data" value="<?= $postvalue  ?>">
                <input type="hidden" id="product_page_price" name="product_page_price" value="<?= $details['price_page'] ?>">
                <input type="hidden" id="product_id" name="product_id" value="<?= $details['product_id'] ?>">
				<input type="hidden" id="row_id" name="row_id" value="<?= !empty($details['row_id']) ? $details['row_id'] : '' ?>">
                <input type="hidden" id="product_slug" name="product_slug" value="<?php echo $this->uri->segment(2); ?>">
                <input type="hidden" id="image_name_hidden" name="image_name_hidden" value="">
                


                <div class="col-md-4">
                  <div class="file-upload">
                    <label for="upload" class="file-upload__label">Click here to upload files</label>
                    <input id="upload" class="file-upload__input" type="file" name="file-upload[]" multiple>
                  </div>
                  <div class="item_descriptions">
                    <h3>Item Description</h3>
                    <p><strong>Number of copies : </strong><?= $details['copies'] ?></p>
                    <input type="hidden" name="copies" value="<?= $details['copies'] ?>">







                    <p><strong>Number of Pages : </strong><?= $details['pages'] ?></p>
                    <input type="hidden" name="pages" value="<?= $details['pages'] ?>">
                    <br>
                    <h4><u><strong>Printing Details</strong></u></h4>

                    <p><strong>Dimensions : </strong><?= $details['dimensions'] ?></p>
                    <input type="hidden" name="dimensions" value="<?= $details['dimensions'] ?>">

                    <p><strong>Paper Type : </strong><?= $details['paper_type'] ?></p>
                    <input type="hidden" name="paper_type" value="<?= $details['paper_type'] ?>">
                    <input type="hidden" name="paper_type_id" value="<?= $details['paper_type_id'] ?>">

                    <p><strong>No Of Sides : </strong><?= $details['no_of_sides'] ?></p>
                    <input type="hidden" name="no_of_sides" value="<?= $details['no_of_sides'] ?>">

                    <?php if ($details['no_of_sides'] == '2-sided' && !empty($details['sides']) && !empty($details['orientation'])) { ?>
                      <p><strong>Sides : </strong><?= $details['sides'] ?></p>
                      <input type="hidden" name="sides" value="<?= $details['sides'] ?>">

                      <p><strong>Orientation : </strong><?= $details['orientation'] ?></p>
                      <input type="hidden" name="orientation" value="<?= $details['orientation'] ?>">
                    <?php } ?>

                    <?php if (!empty($details['divider_sheets'] || $details['stapling'] || $details['folding'] || $details['collation'] || $details['hole_punch'])) : ?>
                      <br>
                      <h4><u><strong>Finishing Details</strong></u></h4>
                    <?php endif; ?>

                    <p><strong>Need To See Digital Proof : </strong><?php if ($details['digital_proof_hid'] == 1) {
                                                                      echo 'Yes';
                                                                    } else {
                                                                      echo 'No';
                                                                    } ?></p>
                    <input type="hidden" name="digital_proof" value="<?= $details['digital_proof_hid'] ?>">

                    <?php if (($this->uri->segment(2) == 'color-copies' || $this->uri->segment(2) == 'enhanced-black-white-copies') && !empty($details['full_bleed'])) : ?>
                      <p><strong>Full Bleed : </strong><?= $details['full_bleed'] ?></p>
                      <input type="hidden" name="full_bleed" value="<?= $details['full_bleed'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['divider_sheets'])) : ?>
                      <p><strong>Divider sheets : </strong><?= $details['divider_sheets'] ?></p>
                      <input type="hidden" name="divider_sheets" value="<?= $details['divider_sheets'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['stapling'])) : ?>
                      <p><strong>Stapling : </strong><?= $details['stapling'] ?></p>
                      <input type="hidden" name="stapling" value="<?= $details['stapling'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['folding'])) : ?>
                      <p><strong>Folding : </strong><?= $details['folding'] ?></p>
                      <input type="hidden" name="folding" value="<?= $details['folding'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['collation'])) : ?>
                      <p><strong>Collation : </strong><?= $details['collation'] ?></p>
                      <input type="hidden" name="collation" value="<?= $details['collation'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['hole_punch'])) : ?>
                      <p><strong>3 hole punch : </strong><?= $details['hole_punch'] ?></p>
                      <input type="hidden" name="hole_punch" value="<?= $details['hole_punch'] ?>">
                    <?php endif; ?>
                    <br>
					<p class="shipping_amt"></p>
                    <p class="total1"><strong> Total : $<?= number_format($details['total'], 2) ?></strong></p>
                  </div>
                </div>
              </div>
			  <div class="col-md-9 pull-right">
				<div class="shopping_order">
					<div class="row clearfix">
						<div class="col-md-12 col-sm-12">
							<div class="update_shipping_quote">
								<h3>Choose your completion date & delivery</h3>
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
											<select id="shipping_type" name="shipping_type">
												<option value="" disabled="disabled" selected="selected">Please select an option</option>
												<option value="pick">I'll pick up</option>
												<?php
												$cart_total = $this->cart->total() + $details['total'];
												//if (($this->cart->total() >= 150) && ($this->cart->total() < 200)) : ?>
													<!--<option value="regular">Free Regular UPS Ground</option>-->
												<?php  if ($total_cart_ship >= 150) : ?>
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
										<label>By the following time: </label>
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
													1914 Hacienda Drive<br>
													Vista, CA 92081 <br>
													1-844-copymax (267-9629)</b>
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
							
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="update_shipping_text">

								<p>-The shipping/Delivery time starts from the time your job is completed,</p>
								<p> -If your order is more than $150 you get free Delivery within San Diego County & normally it arrives next business day before 4:00 pm after completion of your order. </p>

							</div>
							<p style="font-size: 14px;font-weight: bold;color: red;margin-top: 10px;">Our cut off time is any business day 11:00am, orders PLACED BEFORE 11AM will be ready FOR PICK UP AFTER TWO BUSINESS DAYS AT 4PM.</p>
							<p style="font-size: 18px;font-weight: 800;color: red;margin-top: 10px;">Rush service available, call for details 1-800 DAYCOPY (329.2679)</p>
						</div>
					</div>
				</div>
				
				  
				<div class="add_cart">
					<button type="button" class="btn btn-success pull-right" disabled id="add_to_cart"> Add to Cart&nbsp; <i class="fa fa-angle-right"></i></button>
				</div>
			  </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style type="text/css">
  #image_preview {
    text-align: left;
    
  }

  

  .preview_file {

    display: inline-block;
    position: relative;
    margin-bottom: 20px;
    margin-right: 20px;
    border: 1px #e2e2e2 solid;
    max-height: 140px;
    width: 140px;
    height: 140px;

  }

  .preview_file a {
    position: absolute;
    right: -5px;
    top: -10px;
    background: #cc0f0f;
    border-radius: 30px;
    width: 20px;
    height: 20px;
    text-align: center;
    color: #fff;
    font-size: 14px;
  }
  .error_cls p{

    color:red;
    cursor:pointer;
  }
  .product-image {

    position:relative;
  }
  
  .product-image .secondary-content {
    position: absolute;
    right: 10px;
    top:6px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 3px;
    padding: 3px;
    width: 30px;
    height: 30px;
    text-align: center;
}


.product-image .secondary-content i{
	color: red;
}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
  // $(function() {

  //   var bar = $('.bar');
  //   var percent = $('.progress');
  //   var status = $('#status');

  //   $('form').ajaxForm({
  //       beforeSend: function() {
  //         status.empty();
  //         var percentVal = '0%';
  //         bar.width(percentVal);
  //         percent.html(percentVal);
  //       },
  //     uploadProgress: function(event, position, total, percentComplete) {
  //         var percentVal = percentComplete + '%';
  //         bar.width(percentVal);
  //         percent.html(percentVal);
  //     },
  //     complete: function(xhr) {
  //         status.html(xhr.responseText);
  //     }
  //   });
  // }); 
  $(document).on("change", "#shipping_type", function() {
	var shipping = $(this).val();
	$("#ups_response_div").html('');
	$(".shipping_amt").text('');
	if(shipping == 'pick'){
		$("#add_to_cart").removeAttr('disabled');
	}
	else if(shipping == 'free'){
		
		$("#add_to_cart").removeAttr('disabled');
		
	}else {
		$("#add_to_cart").attr('disabled', true);
	}
  });

  $(document).on("click", "#add_to_cart", function(event) {
	  event.preventDefault();
	var shipping_type = $("#shipping_type").val();
	var cart_date = $("#cart_datepicker_completion").val();
	var zipcode = $("#zip_code").val();
	var shipping_type = $("#shipping_type").val();
    var image_name='';
	var ups_shipping = $('input[name=ups_shipping]:checked').val();
	var valid = false;
    $('.view_uploadded_docs').each(function(){
        
        image_name += $(this).text() +'||';

    })
	//console.log(ups_shipping);
    $("#image_name_hidden").val(image_name);
    // if ($("#upload").val()) {
    //   $("#progress_bar").show();
    // }
	if( shipping_type == 'pick'){
		if(cart_date != ''){
			valid = true;
		}
		
	}else if(shipping_type == 'ship'){
		if(cart_date != '' && zipcode != '' && (ups_shipping != undefined && ups_shipping != '')	){
			valid = true;
		}
	}
	else if(shipping_type == 'free'){
		if(cart_date != '' && zipcode != ''	){
			valid = true;
		}
	}
    $("#add_to_cart").attr('disabled', true);
	if(!valid){
		
		alert('Please fillup all shipping Quote');
		$("#add_to_cart").html('Add to cart&nbsp; <i class="fa fa-angle-right"></i>');
		$("#quote_hide_show").hide();
		return;
	}else{
		$("#add_to_cart").text('Processing......');
		$("#add_to_cart_form").submit();
	}

  })
	$(document).on('change', '.ups_shipping', function() {


		var shipping_amount = parseFloat($(this).val()).toFixed(2);
		var shipping_service_type = $(this).data('shipping_service_type');
		$("#shipping_amount_hid").val(shipping_amount);
		$(".shipping_amt").text('Shipping : $' + shipping_amount);
		$("#shipping_service_type").val(shipping_service_type);


	})
  // $(document).ready(function() {
  //   //Check File API support
  //   if (window.File && window.FileList && window.FileReader) {

  //     $("#upload").on("change", function(e) {

  //       $('.text-data').hide();
  //       $("#image_preview").html('');

  //       var files = e.target.files,
  //         filesLength = files.length;
  //       var file_name = "";

  //       for (var i = 0; i < filesLength; i++) {
  //         var f = files[i];
  //         //console.log(f);
  //         var fileReader = new FileReader();
  //         fileReader.fileName = f.name;
  //         fileReader.onload = (function(e) {
  //           $("#image_preview").append('<div class="preview_file"><img src="' + e.target.result + '" alt=""/ style="max-height:140px;"><a href="javascript:void(0)" class="remove_pic"><i class="fa fa-close"></i></a><p style="word-break:break-word;font-size:12px;">' + e.target.fileName + '</p></div>');
  //         });

  //         fileReader.onprogress = function(data) {
  //           //console.log(data);
  //           if (data.lengthComputable) {
  //             $("#image_progress_bar").show();
  //             $("#hide").hide();
  //             $("#image_name").html(data.target.fileName);
  //             $("#image_name_hid").val(data.target.fileName);

  //             var progress = parseInt(((data.loaded / data.total) * 100));
  //             $('#progress .progress-bar').css(
  //               'width',
  //               progress + '%'
  //             );
  //             $("#upload_percentage").html(progress);
  //             //console.log(progress);
  //           }
  //         }
  //         fileReader.readAsDataURL(f);
  //       }
  //     });
  //   } else {
  //     console.log("Your browser does not support File API");
  //   }
  // })
  

	

  $(document).on('change', '#upload', function() {
    
    if($("#upload").val()){
      
      var image_name='';
      $('.view_uploadded_docs').each(function(){
          
          image_name += $(this).text() +'||';

      })
      $("#image_name_hidden").val(image_name);
      
      var form = $('#add_to_cart_form')[0];
      var formData = new FormData(form);

      $.ajax({
          url: "<?= base_url() ?>welcome/cart/file_upload",
          data: formData,
          type: "post",
          cache: "false",
          dataType: 'json',
          contentType: false,
          processData: false,
          encode: true,
          xhr: function(){
              //upload Progress
              var xhr = $.ajaxSettings.xhr();
              if (xhr.upload) {
                $("#image_progress_bar").show();
                $("#hide").text('Processing....');
                xhr.upload.addEventListener('progress', function(event) {
                  var percent = 0;
                  var position = event.loaded || event.position;
                  var total = event.total;
                    if (event.lengthComputable) {
                      percent = Math.ceil(position / total * 100);
                    }
                    //update progressbar
                    $('#progress .progress-bar').css(
                  'width',
                  percent + '%'
              );
              $("#upload_percentage").html(percent);
                }, true);
              }
			  //console.log(xhr);
              return xhr;
        }
      })
        
        .done(function(data) {
          if(data.status){
			  
            $("#hide").text('Completed');
            $("#image_name").text(data.image_name);
            var image_name=data.image_name.split('||');
			
            $.each(image_name,function(i){
              $("#image_preview").append('<div class="product-image"><a href="<?=base_url()?>uploads/files/'+image_name[i]+'" class="view_uploadded_docs" target="_blank">'+image_name[i]+'</a><div class="secondary-content actions"><a data-link="./uploads/files/'+image_name[i]+'" data-file_name="'+image_name[i]+'"  data-dz-remove jc-attached="true" class="delete_button"><i class="fa fa-trash white-text"></i></a></div></div>');
            });
            $('#image_progress_bar').hide();
            $('#hide').hide();
			var old = document.getElementById("upload");
			var newElm = document.createElement('input');
			newElm.type = "file";
			newElm.id = "upload";
			newElm.name = old.name;
			newElm.className = old.className;
			// Put code to copy other attributes as well
			old.parentNode.replaceChild(newElm, old);
            //window.location.reload();
          }
          else{
            $("#hide").html('<span class="error_cls">'+data.msg+'</span>');
            $("#error_msg_div").show();
            $("#error_msg").html(data.msg);
          }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          
          alert('server not responding...');

        });
    }
  });


  $('body').on('click', '.delete_button', function(){
	var dltBtn = $(this);
	$.confirm({
    
    title: 'Do you want to remove this file?',
    content: 'Files will be deleted permanently from our server',
    type: 'red',
    typeAnimated: true,
    columnClass:'medium',
    buttons: {
        remove: {
            text: 'Remove',
            btnClass: 'btn-red',
            action: function(){
				var file_link = dltBtn.data('link');
				var file_name = dltBtn.data('file_name');
              //alert(file_link);
              
			$.ajax({
				url: "<?= base_url() ?>welcome/cart/delete_file",
				data: {"file_link":file_link,"file_name":file_name},
				type: "post",
				cache: "false",
				dataType: 'json',
				encode: true,
			})
			.done(function(data) {
				//console.log(data, dltBtn.parents().find('.product-image'));
				if(data.status){
					$.alert(data.msg);
					//setTimeout(function(){ window.location.reload(); }, 1000);
					dltBtn.parent().parent().remove();
				}
				else{
					$.alert(data.msg);
				}
			})
			.fail(function(jqXHR, ajaxOptions, thrownError) {
				$.alert('server not responding...');
			});
            
            
            
            }
        },
        close: function () {
            
        }
    }
});
});
	

	$(document).on('click', '#price_check_btn', function() {
		$("#ups_response_div").html('');
		$("#ups_response_div").show();
		$("#quote_hide_show").hide();
		var shipping_type = $('#shipping_type').val();
		var zip_code = $('#zip_code').val();
		var delivery_time = $("#delivery_time").val();
		$("#add_to_cart").attr('disabled', true);
		
		if($('#cart_datepicker_completion').val() == ''){
			$('#current_date_completion').val('');
			$('#current_date').val('');
		}

		var current_date = $('#current_date').val();
		var current_date_completion = $('#current_date_completion').val();

		if (shipping_type == 'ship') {
            //&& current_date != "" && delivery_time != "" 
			if (zip_code != "" && current_date_completion != "") {
				$("#delivery_time_val").val(delivery_time);
				$("#price_check_btn").attr('disabled', true);
				$("#price_check_btn").text('Please Wait.....');
				$.ajax({
						url: "<?= base_url() ?>welcome/cart/get_price_from_upi_new",
						data: {
							shipping_type: shipping_type,
							current_date: current_date,
							current_date_completion: current_date_completion,
							zip_code: zip_code,
							delivery_time: delivery_time,
							extras:$("#extra_data").val(),
							row_id:$("#row_id").val(),
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
						$("#add_to_cart").removeAttr('disabled');
						var resulthtml = '';

						if (data.shipping_response) {

							$.each(data.shipping_response, function(key, value) {

								if (value) {
									$.each(value, function(key1, value1) {

										if (value1.status == 1) {
											resulthtml += `<label for="r_` + key1 + `">
                            								<input type="radio" id="r_` + key1 + `" name="ups_shipping" class="ups_shipping" value="` + value1.shipment_rate + `" required data-shipping_service_type="`+value1.code_desc+`"/>  `+value1.code_desc+`<span style="color:red;font-weight:bold;">  $` + value1.shipment_rate + `</span></label><br>`;

										}
										else if (value1.status == 2) {
											resulthtml += `<label for="r_` + key1 + `">
                            								<input type="radio" id="r_` + key1 + `" name="ups_shipping" class="ups_shipping" value="` + value1.shipment_rate + `" required data-shipping_service_type="`+value1.code_desc+`" checked/>  `+value1.code_desc+`<span style="color:red;font-weight:bold;">  $` + value1.shipment_rate + `</span></label><br>`;

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
						$("#add_to_cart").attr('disabled', true);
						alert('server not responding...');
						$("#ups_response_div").html('<span style="color:red;font-weight:bold;">No shipping option available</span>');

					});
			} else {
				alert('Please fillup all shipping Quote');
				return false;
			}
		}
	});
 
  //document.getElementById('upload').addEventListener('change', handleFileSelect, false);
</script>