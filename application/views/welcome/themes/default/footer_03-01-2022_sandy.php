<style type="text/css">
	.datepicker.dropdown-menu {
    color: green !important;
    font-weight:bold;
  }

  .datepicker.dropdown-menu tr td.day
  {
    background: green;
    color: #fff;
    border-radius: 50%;
  }
  .datepicker.dropdown-menu tr td.day:hover
  {
    background: #024f02;
    color: #fff;
  }
  .datepicker.dropdown-menu tr td.day.disabled
  {
    background: 0 0;
    color: #777;
    cursor: default;
    border-radius: 0;
  }

thead {
    color: #000;
}
.welcome-content {
	font-size: 16px;
    text-align: center;
    color: #2E3192;
    margin: 14px 0px;
    font-weight: 600;
    font-style: italic;
}
.table {
 display: table;
 height:100%;
}
.table-cell {
display: table-cell;
vertical-align: middle;
}

p.error.newerror {
    color:#bd0000;
    font-size: 15px;

}
</style>

<div class="newsletter">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-6 col-sm-6">
        <div class="newletter_form">
            <div class="ctct-inline-form" data-form-id="48d2b27b-fa70-4dbd-ad23-2c31e86220bd"></div>
           <!--<form action="<?php echo base_url()?>welcome/index/newsletter_submit_form" method="POST" name="newsletter_submit_frm">
            <label>Newsletter sign Up</label>
<div class="ff imm_footer">
              <input type="text" name="newsletter_name" placeholder="Name" required>
              <input type="email" name="newsletter_email" placeholder="Email" required>
              <input type="hidden" name="redirect_url" value="<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"?>">
              <button type="submit">Submit</button>
            </div>-->
          </form>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="social_area">
          <label>Follow us</label>
          <ul>
            <li><a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#" class="twt"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#" class="gplus"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="#" class="insta"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="footer_top clearfix">
        <div class="col-md-8 col-sm-12">
          <div class="row clearfix">
            <div class="col-md-4 col-sm-4 no_pad_right">
              <div class="ft_header">
                <h2>Quick Links</h2>
              </div>
              <div class="ft_nav">
                <ul>
                  <li><a href="<?php echo base_url();?>">Home</a></li>
                  <li><a href="<?php echo base_url();?>cms_page/about-us">About Us</a></li>
                  <li><a href="<?php echo base_url();?>cms_page/services">Services</a></li>
                  <li><a href="<?php echo base_url();?>our-products">Our Products</a></li>
                  <li><a href="<?php echo base_url();?>cms_page/portfolio">Portfolio</a></li>
                  <li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
                  <li><a href="<?php echo base_url();?>cms_page/privacy-policy">Privacy Policy</a></li>
                  <li><a href="<?php echo base_url();?>cms_page/terms-&-conditions">Terms & Conditions</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 no_pad_right">
              <div class="ft_header">
                <h2>Info & Resources</h2>
              </div>
              <div class="ft_nav">
                <ul>
                  <!--<li><a href="<?php echo base_url();?>cms_page/product-listing">Product Listing</a></li>-->
                  <li><a href="<?php echo base_url();?>cms_page/help-center-&-faq">Help Center & FAQ</a></li>
                  <!--<li><a href="<?php echo base_url();?>cms_page/marketing-blog">Marketing Blog</a></li>-->
                  <!--<li><a href="<?php echo base_url();?>cms_page/printing-blog">Printing Blog</a></li>-->
                  <li><a href="<?php echo base_url();?>cms_page/graphic-guide-lines">Graphic Guide Lines</a></li>
                </ul>
              </div>
            </div>
            <!--<div class="col-md-3 col-sm-3 no_pad_right">-->
            <!--  <div class="ft_header">-->
            <!--    <h2>My Account</h2>-->
            <!--  </div>-->
            <!--  <div class="ft_nav">-->
            <!--    <ul>-->
            <!--      <li><a href="<?php echo base_url();?>cms_page/bands">Bands</a></li>-->
            <!--      <li><a href="<?php echo base_url();?>cms_page/gift-voucher">Gift Voucher</a></li>-->
            <!--      <li><a href="<?php echo base_url();?>cms_page/affiliates">Affiliates</a></li>-->
            <!--      <li><a href="<?php echo base_url();?>cms_page/specials">Specials</a></li>-->
            <!--      <li><a href="<?php echo base_url();?>cms_page/our-blog">Our blog</a></li>-->
            <!--    </ul>-->
            <!--  </div>-->
            <!--</div>-->
            <div class="col-md-4 col-sm-4 no_pad_right">
              <div class="ft_header">
                <h2>Contact Us</h2>
              </div>
              <div class="contact_info">
                <p>We are open M-F from 9 to 5</p>
                <p>1914 Hacienda Drive in Vista, CA 92081</p>
                <p>Phone : <a href="tel:1-844-Copymax (2679629)">1-844-Copymax (2679629)</a></p>
                <p>Email : <a href="mailto:info@copymaxinc.com" data-email="info@copymaxinc.com" class="sendcontactmessage">info@copymaxinc.com</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="footer_map">
          <iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1914%20Hacienda%20drive%2C%20Vista%2C%20CA%2092081+(Copymax)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
          </div>
        </div>
      </div>
      <div class="footer_btm">
        <div class="col-md-12 col-sm-12">
          <p class="copyright">© <?php echo date('Y');?> <span>Copymax Inc.</span> All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Cart Item</h4>
      </div>
      <div class="modal-body">
        <div class="get_your_color">
            <div class="printing_options">
              <div class="print_opt_box">
                <h3>PRINTING OPTIONS</h3>
                  <div class="row">
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">How many copies would you like?</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <input type="number"  min="1" pattern="[0-9]*" value="1" id="no_copies" class="form-control get_input">
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">How many pages are in your file?(?)</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <input type="number"  min="1" pattern="[0-9]*" value="1" id="no_pages" class="form-control get_input">
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">Dimensions</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_printing_option0" class="get_option">
                                    <option value="8.5x11"> 8.5x11</option>
                                    <option value="8.5x14">8.5x14</option>
                                    <option value="11x17">11x17</option>
                                    <option value="4.25x5.5">4.25x5.5</option>
                                    <option value="4.25x11">4.25x11</option>
                                    <option value="8.5x5.5">8.5x5.5 </option>
                                    <option value="8.5x7">8.5x7</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">Paper Type</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_printing_option1" class="get_option">
                                    <option disabled style="font-weight:bold;color: white;background: #1660a8;">Uncoated copy paper white</option>
                                      <option >20/50 lb white copy paper</option>
                                      <option >24/60 lb white copy paper</option>
                                      <option >28/70 lb white copy paper</option>
                                    <option disabled style="font-weight:bold;color: white;background: #1660a8;">Uncoated copy paper pastel color</option>
                                      <option >20/50 lb blue paper</option>
                                      <option >20/50 lb green paper</option>
                                      <option >20/50 lb canary paper</option>
                                      <option >20/50 lb orchid paper</option>
                                      <option >20/50 lb ivory paper</option>
                                      <option >20/50 lb golden rod paper</option>
                                      <option >20/50 lb cherry paper</option>
                                      <option >20/50 lb salmon paper</option>
                                      <option >20/50 lb tan paper</option>
                                      <option >20/50 lb gray paper</option>
                                      <option >20/50 lb pink paper</option>
                                    <option disabled style="font-weight:bold;color: white;background: #1660a8;">Uncoated copy paper bright color</option>
                                      <option >24/60 lb solar yellow paper</option>
                                      <option >24/60 lb lift off lemon paper</option>
                                      <option >24/60 lb lunar blue paper</option>
                                      <option >24/60 lb celestial blue paper</option>
                                      <option >24/60 lb rocket red paper</option>
                                      <option >24/60 lb re-entry red paper</option>
                                      <option >24/60 lb cosmic orange paper</option>
                                      <option >24/60 lb orbit orange paper</option>
                                      <option >24/60 lb galaxy gold paper</option>
                                      <option >24/60 lb terra green paper</option>
                                      <option >24/60 lb planetary purple paper</option>
                                      <option >24/60 lb pulsar pink paper</option>
                                      <option >24/60 lb gamma green paper</option>
                                      <option >24/60 lb terestrial teal paper</option>
                                    <option disabled style="font-weight:bold;color: white;background: #1660a8;">Uncoated cardstock  pastel color</option>
                                      <option >90 lb white cardstock</option>
                                      <option >90 lb green cardstock</option>
                                      <option >90 lb blue cardstock</option>
                                      <option >90 lb canary cardstock</option>
                                      <option >90 lb ivory cardstock</option>
                                      <option >90 lb cherry cardstock</option>
                                      <option >90 lb gold cardstock</option>
                                      <option >90 lb salmon cardstock</option>
                                      <option >90 lb gray cardstock</option>
                                      <option >90 lb orchid cardstock</option>
                                      <option >90 lb buff cardstock</option>
                                    <option disabled style="font-weight:bold;color: white;background: #1660a8;">Uncoated cardstock bright color</option>
                                      <option >65 lb white cardstock</option>
                                      <option >65 lb solar yellow cardstock</option>
                                      <option >65 lb lift off lemon cardstock</option>
                                      <option >65 lb galaxy gold cardstock</option>
                                      <option >65 lb planetary purple cardstock</option>
                                      <option >65 lb lunar blue cardstock</option>
                                      <option >65 lb celestial blue cardstock</option>
                                      <option >65 lb rocket red cardstock</option>
                                      <option >65 lb re-entry red cardstock</option>
                                      <option >65 lb orbit orange cardstock</option>
                                      <option >65 lb cosmic orange cardstock</option>
                                      <option >65 lb pulsar pink cardstock</option>
                                      <option >65 lb terestrial teal cardstock</option>
                                      <option >65 lb gamma green cardstock</option>
                                      <option >65 lb terra green cardstock</option>
                                    <option disabled style="font-weight:bold;color: white;background: #1660a8;">Uncoated cardstock  pastel color</option>
                                      <option>110 lb blue cardstock</option>
                                      <option>110 lb buff cardstock</option>
                                      <option>110 lb canary cardstock</option>
                                      <option>110 lb cherry cardstock</option>
                                      <option>110 lb gray cardstock</option>
                                      <option>110 lb green cardstock</option>
                                      <option>110 lb ivory cardstock</option>
                                      <option>110 lb salmon cardstock</option>
                                      <option>110 lb white cardstock</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">Number Of Sides</label>
                        </div>
                        <div class="col-md-7 4">
                            <div class="input_fld selectid-sha">
                                <select id="get_printing_option3" class="get_option">
                                    <option >Select page sided</option>
                                    <option value="1-sided">1-sided</option>
                                    <option value="2-sided">2-sided</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <br>
              <br>
              <div class="print_opt_box">
                <h3>FINISHING OPTIONS</h3>
                  <div class="row">
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">Divider sheets</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_finishing_option0" class="get_option">
                                    <option value="">Select</option>
                                    <option value="add-divider-sheets">add divider sheets</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">Stapling</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_finishing_option1" class="get_option">
                                    <option value="">Select</option>
                                    <option value="top-left">top left staple</option>
                                    <option value="2-staple">2 staples on the spine </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">Folding</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_finishing_option4" class="get_option">
                                    <option value="">Select</option>
                                    <option value="half-fold">half fold</option>
                                    <option value="tri-fold">tri fold</option>
                                    <option value="z-fold">z fold</option>
                                    <option value="tri-fold-type-out">Tri fold type out</option>
                                    <option value="tri-fold-type-in">Tri fold type in</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt"> Collation </label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_finishing_option9" class="get_option">
                                    <option value="">Select</option>
                                    <option value="collated">collated</option>
                                    <option value="uncollated">uncollated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="opt_sel clearfix">
                        <div class="col-md-5">
                            <label class="left_pan_taxt">3 hole punch</label>
                        </div>
                        <div class="col-md-7">
                            <div class="input_fld">
                                <select id="get_finishing_option27" class="get_option">
                                    <option value="">Select</option>
                                    <option value="add-3-holepunch">add 3 holepunch</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="product_id" value="">
            <input type="hidden" id="rowid" value="">
            <input type="hidden" id="product_image" value="">
            <div class="price_box clearfix">
              <span class="price_head">Unit Price</span>
              <span class="priceA">$<span class="price">0.00</span></span>
            </div>
            <div class="price_box clearfix"> 
              <span class="price_head">Subtotal:</span>
              <span class="priceA">$<span class="total">0.00</span></span>
            </div>
          </div>
          <div style="text-align: center;">
            <button class="btn btn-primary" id="update_cart">Update</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="add_topic_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form method="POST" id="quote_form" name="quote_form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Get A Quote</h4>
      </div>
      <div class="modal-body">
       
        <div class="row">
        	<div class="col-sm-12 dashboard_form">

                <div class="col-sm-12">
          			  <div class="form-group">
                    <label>Name<span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span class="error" style="color:red" id="name_error" style="display:none"></span>
                  </div>
                </div> 

                <div class="col-sm-12">
          			  <div class="form-group">
                    <label>Email<span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="form-control">
                    <span class="error" style="color:red" id="email_error" style="display:none"></span>
                  </div>
                </div>


                <div class="col-sm-12">
          			  <div class="form-group">
                    <label>Message<span class="required">*</span></label>
                    <input type="message" name="message" id="message" class="form-control">
                    <span class="error" style="color:red" id="message_error" style="display:none"></span>
                  </div>
                </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-black" data-dismiss="modal">Close</button>
        <button type="button" id="add_topic" class="btn btn-red">Save Data</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Product Info Modal -->
<div class="modal fade" id="product_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <form method="POST" id="product_info_modal_form" name="product_info_modal_form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Product Information</h4>
      </div>
      <div class="modal-body">
       
        <div class="row">
        	<div class="col-sm-12 dashboard_form">

                
          <h4>This product is under construction please call for details.</h4><br>
          <h4>Contact No : 1-844-Copymax (2679629) </h4>

                <!-- <div class="col-sm-12">
          			  <div class="form-group">
                    <label>Name<span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span class="error" style="color:red" id="name_error" style="display:none"></span>
                  </div>
                </div> 

                <div class="col-sm-12">
          			  <div class="form-group">
                    <label>Email<span class="required">*</span></label>
                    <input type="email" name="email" id="email" class="form-control">
                    <span class="error" style="color:red" id="email_error" style="display:none"></span>
                  </div>
                </div>


                <div class="col-sm-12">
          			  <div class="form-group">
                    <label>Message<span class="required">*</span></label>
                    <input type="message" name="message" id="message" class="form-control">
                    <span class="error" style="color:red" id="message_error" style="display:none"></span>
                  </div>
                </div> -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-black" data-dismiss="modal">Close</button>
        <!-- <button type="button" id="add_topic" class="btn btn-red">Save Data</button> -->
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Contact Modal Modal -->

<div class="modal fade" id="contact_form" class="contact_form" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>		
         </div>
         <form action="  <?= base_url()?>welcome/index/contactsendemail" method="post" enctype="multipart/form-data">
            <div class="modal-body">
			
               <!--<div class="form-group"> 
					<label for="recipient-name" class="col-form-label">TO Email:</label>            
					<!--<input type="email" required class="form-control email_to" readonly name="emailTo"> -->
					<input type="hidden" required class="form-control email_to" name="emailTo" value="copymaxinc@gmail.com">		  
				<!--</div>-->
               <div class="form-group">
					<label for="recipient-name" class="col-form-label">Your Email:</label>
					<input type="email" required class="form-control" name="from_email">
				</div>
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Name:</label>
					<input type="text" required class="form-control" name="from_name">
				</div>
				<div class="form-group">
					<label for="recipient-name" class="col-form-label">Phone No:</label>
					<input type="text" required class="form-control" name="from_phone_no">
				</div>
               <div class="form-group">            
					<label for="recipient-name" class="col-form-label">Subject:</label>
					<input type="text" required class="form-control" name="subject">
				</div>
               <div class="form-group">
					<label for="message-text" class="col-form-label">Message:</label>
					<textarea class="form-control" name="message" required></textarea>
				</div>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Send message</button>
			</div>
         </form>
      </div>
   </div>
</div>
<!-- Signup/Login Modal -->
<div class="modal fade" id="signup_login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <!-- <form method="POST" id="signup_login_modal_form" name="signup_login_modal_form"> -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Signup/Login</h4>
      </div>
      <div class="modal-body">
      
    <div class="row clearfix">
      <div class="col-md-12 col-sm-12">
	  
			<p>
        <div class='col-md-12 alert alert-info' id="success_msg" style="display:none;"></div>               
      </p>
			<p>
		    <div class='col-md-12 alert alert-danger' id="error_msg" style="display:none;"></div>
			</p> 
        <div class="login_form">
          <form id="login_form" method="post">
            <div class="login_box">
              <h2>Login</h2>
              <div class="form-group">
                <label>Email</label>
               <input type="email" class="form-control" name="username" placeholder="Email Address" id="username" value="" required>
              </div>
              <div class="form-group">
                <label>Password</label>
               <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="" required>
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox">
                  &nbsp;&nbsp;Remember me</label>
              </div>
              <input type="hidden" id="user_login_hid" name="user_login_hid">
              <button type="button" class="submit_btn" name="user_login" id="user_login">Login</button>
            </div>
            <div class="new_user">
              <ul>
                <li><a href="javascript:void(0);" class="register_account">Create a new account</a></li>
                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#forgotPasswordModal" data-dismiss="modal">Forgot Password?</a></li>
              </ul>
            </div>
          </form>
        </div>
		
		  <div class="register-box" style="display:none;">
              <h3>Register</h3>
               <form  method="post" id="user_register_form" class="register" onsubmit="password_match()">
			    <div class="form-group">
                  <input type="text" class="form-control" placeholder="First Name" name="f_name"  id="reg_email" value="" required>
                </div>
				 <div class="form-group">
                  <input type="text" class="form-control" placeholder="Last Name" name="l_name"  id="reg_email" value="" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email Address" name="reg_email"  id="reg_email" value="" required>
                </div>
				<div class="form-group">
                  <input type="text" class="form-control" placeholder="Contact Number" name="phone"  id="phone_no" value="" required>
                </div>
                <div class="form-group">                      
                  <input type="password" class="form-control" placeholder="Password" name="reg_password" id="reg_password" value="" required>
                </div>
                <div class="form-group">                             
                  <input type="password" class="form-control" name="reg_confirm_password" id="reg_confirm_password" required placeholder="Confirm Password">
                </div>
               
                <input type="hidden" class="btn-" id="user_register_hid" name="user_register_hid"  value="Sign Up">   
                <button type="button" class="submit_btn" name="user_register" id="user_register">Sign Up</button>
                
               
				
				 <div class="new_user">
              <ul>
                <li><a href="javascript:void(0);" class="login_account">Login account</a></li>
             
              </ul>
            </div>
              </form>
            </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="login_share_ad">
          <h2>Can you believe people are still paying 50 cents for color copies in <?=date('Y')?>? Crazy! </h2>
          <h5>Help your friends save money: Tip them off about Copymax Inc. copies and prints</h5>
          <ul>
            <li>- A lot of people are still printing in the dark ages</li>
            <li>- They’re missing out on great service and great prices</li>
            <li>- New customers are discovering online printing every day</li>
            <li>- You’re ahead of the curve; why don’t you share the tip?</li>
          </ul>
        </div>
      </div>
    </div>
 
        
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-black" data-dismiss="modal">Close</button>
        <button type="button" id="add_topic" class="btn btn-red">Save Data</button>
      </div> -->
      <!-- </form> -->
    </div>
  </div>
</div>
<!--<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="table">
	<div class="table-cell">	
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			 
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<div class="welcome-content">
			<p>Thank you for your interest in our website where you get the highest quality products 
			at lowest prices. Just choose the product your are interested in to get instant pricing, 
			as you will see some of the products are still in progress and not available yet, just call 
			or email us to get instant pricing on products not available yet. 
			We appreciate your business and looking forward to working with you on all your projects.</p>
			   
			<p>Keep in mind orders more than $150 will be 
			delivered free of charge.</p>
			  
			<p>Copymax Inc.  1-844-Copymax (2679629)</p>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>	
</div>-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.standalone.min.css">
<script src="<?php echo base_url();?>assets/frontend/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/frontend/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/stellarnav.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/frontend/js/jquery-ui.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/frontend/js/custom.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" type="text/javascript" ></script> 
<script type="text/javascript">
jQuery(document).ready(function($) {
  jQuery('.stellarnav').stellarNav({
    theme: 'light'
  });
  
  
  setTimeout(function(){$("#update_msg").fadeOut('slow','swing')}, 5000);
  
    var d = new Date(); 
		var hour = d.getHours(); 
		
    var todayDay = new Date(new Date().getTime());
		var today_weekday = todayDay.getDay();
    //alert(today_weekday);
    var completion_avl_dates = [];
    

    if(today_weekday == 0 || today_weekday == 1){
      
        completion_avl_days_1=format_date(new Date(new Date().getTime() + 2 * (24 * 60 * 60 * 1000)));
        completion_avl_days_2=format_date(new Date(new Date().getTime() + 3 * (24 * 60 * 60 * 1000)));
        completion_avl_days_3=format_date(new Date(new Date().getTime() + 4 * (24 * 60 * 60 * 1000)));
      
      
    
    }
    else if(today_weekday == 2){
      
        completion_avl_days_1=format_date(new Date(new Date().getTime() + 2 * (24 * 60 * 60 * 1000)));
        completion_avl_days_2=format_date(new Date(new Date().getTime() + 3 * (24 * 60 * 60 * 1000)));
        completion_avl_days_3=format_date(new Date(new Date().getTime() + 6 * (24 * 60 * 60 * 1000)));
      
        
    
    }
    else if(today_weekday == 3){
      
      completion_avl_days_1=format_date(new Date(new Date().getTime() + 2 * (24 * 60 * 60 * 1000)));
      completion_avl_days_2=format_date(new Date(new Date().getTime() + 5 * (24 * 60 * 60 * 1000)));
      completion_avl_days_3=format_date(new Date(new Date().getTime() + 6 * (24 * 60 * 60 * 1000)));
    
     
  
    }
    else if(today_weekday == 4 || today_weekday == 5){
      
      completion_avl_days_1=format_date(new Date(new Date().getTime() + 4 * (24 * 60 * 60 * 1000)));
      completion_avl_days_2=format_date(new Date(new Date().getTime() + 5 * (24 * 60 * 60 * 1000)));
      completion_avl_days_3=format_date(new Date(new Date().getTime() + 6 * (24 * 60 * 60 * 1000)));
    
     
    }
    else if(today_weekday == 6){
      
      completion_avl_days_1=format_date(new Date(new Date().getTime() + 3 * (24 * 60 * 60 * 1000)));
      completion_avl_days_2=format_date(new Date(new Date().getTime() + 4 * (24 * 60 * 60 * 1000)));
      completion_avl_days_3=format_date(new Date(new Date().getTime() + 5 * (24 * 60 * 60 * 1000)));
    
    }
    else{
      
      completion_avl_dates=[];

    }
    
      //--------------------------------------------- checking before or after 11 A.M. --------------------------------------------------//
      if (hour < 11) {
        completion_avl_dates=[completion_avl_days_1,completion_avl_days_2];
      }else{
        completion_avl_dates=[completion_avl_days_2,completion_avl_days_3];
      }
    
    
    
    Date.prototype.addDays = function(days) {
      var date = new Date(this.valueOf());
      date.setDate(date.getDate() + days);
      return date;
    }
    //alert(before_after_11_am);
    
    $("#cart_datepicker_completion" ).datepicker({
      format:"mm/dd/yyyy",
      startDate: new Date(),
      daysOfWeekDisabled: [0,6],
      //datesDisabled:before_after_11_am,
      beforeShowDay:
        function(date){
          var allDates = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
            if(completion_avl_dates.indexOf(allDates) != -1)
              return true;
            else
              return false;
        },
    autoclose: true
  }).on('changeDate', function (selected) {
      
      var minDate = new Date(selected.date.valueOf()).addDays(1);
      var maxDate =new Date(selected.date.valueOf()).addDays(1);
      
      var minDate_weekday = minDate.getDay();
      //alert(minDate_weekday);
      if(minDate_weekday == 0){
        
        maxDate = new Date(selected.date.valueOf()).addDays(2);

      }
      else if(minDate_weekday == 1){

        maxDate = new Date(selected.date.valueOf()).addDays(2);
      
      }
      else if(minDate_weekday == 2 || minDate_weekday == 3){

        maxDate = new Date(selected.date.valueOf()).addDays(2);

      }
      else if(minDate_weekday == 4){

        maxDate = new Date(selected.date.valueOf()).addDays(2);

      }
      else if(minDate_weekday == 5){

        maxDate = new Date(selected.date.valueOf()).addDays(4);

      }
      else if(minDate_weekday == 6){

        maxDate = new Date(selected.date.valueOf()).addDays(4);

      }
      $('#cart_datepicker').datepicker('setStartDate', minDate);
      $('#cart_datepicker').datepicker('setEndDate', maxDate);
      
      
      // $('#cart_datepicker').datepicker({
      //   startDate: minDate,
      //   endDate: maxDate,
      //   daysOfWeekDisabled: [0,6],
      //   autoclose: true
      // }).on('changeDate', function (selected) {
      //   var maxDate = new Date(selected.date.valueOf());
      //   $('#cart_datepicker_completion').datepicker('setEndDate', maxDate);
      //   $('#current_date').val($(this).val());
      // });
      
      $('#current_date_completion').val($(this).val());
      $('#current_date').val($(this).val());
  });

    

  $("#cart_datepicker").datepicker({
      format:"m/d/yyyy",
      daysOfWeekDisabled: [0,6],
      autoclose: true,

  }).on('changeDate', function (selected) {
      // var maxDate = new Date(selected.date.valueOf());
      // $('#cart_datepicker_completion').datepicker('setEndDate', maxDate);
      $('#current_date').val($(this).val());
  });

});

$('#add_quote_button').on('click',function(){
  $('#add_topic_modal').modal('toggle');
  
})

$('#add_topic').on('click',function(){

      var name = $('#name').val();
      var email = $('#email').val();
      var message = $('#message').val();
      
      if(name=='' || name==null){
          $('#name_error').show().text('Please Enter Topic Name');
          setTimeout(function() {
            $('#name_error').hide().text('');
          }, 2000);
          
          return false;
      }

      if(email=='' || email==null){
          $('#email_error').show().text('Please Enter Email');
          setTimeout(function() {
            $('#email_error').hide().text('');
          }, 2000);
          
          return false;
      }

      if(message=='' || message==null){
          $('#message_error').show().text('Please Enter a Message');
          setTimeout(function() {
            $('#message_error').hide().text('');
          }, 2000);
          
          return false;
      }
      
      
      $.ajax({
      url: "<?php echo base_url('welcome/Index/add_quote');?>",
      type: "POST",     
      data:  {'name':name,'email':email,'message':message},
      dataType: 'json',
      success:function(result){
          if(result.status){
            $('#add_topic_modal').modal('toggle');
            var dialog = bootbox.dialog({
              message : 'Quote saved Successfully',
              closeButton: true
            });
            // setTimeout(function(){
            //   dialog.modal('hide');
            //   //window.location.replace('<?=base_url('cart')?>');
            //   window.location.reload();
            // },2000);
          }else{
            //alert("else");
            bootbox.alert({
                message: "Something went wrong, Please try again",
                className: 'rubberBand animated'
            }); 
          }
        }
      });
  });

  function format_date(date){
      var day = date.getDate();
		  var month = date.getMonth() + 1;
		  var year = date.getFullYear();
      return  month + "/" +day + "/" + year;

  }

  function format_date_available(date){
      var day = date.getDate();
		  var month = date.getMonth() + 1;
		  var year = date.getFullYear();
      return  year + "-" +  month + "-" + day;

  }

  


// function readURL(input) {

//   if (input.files && input.files[0]) {
//     var reader = new FileReader();

//     reader.onload = function(e) {
      
//       $('#image_preview').append('<div class="preview_file"><img src="'+e.target.result+'" alt=""/ style="max-height:140px;"><a href="javascript:void(0)" class="remove_pic"><i class="fa fa-close"></i></a><p style="word-break:break-word;font-size:12px;">'+input.files[0].name+'</p></div>');
//       //$('#preview_file').attr('src', e.target.result);
//     }

//     reader.onprogress = function(data) {
//         //console.log(data);
//         if (data.lengthComputable) {
//             $("#image_progress_bar").show();
//             $("#hide").hide();
//             $("#image_name").html(input.files[0].name);
//             $("#image_name_hid").val(input.files[0].name);
            
//             var progress = parseInt( ((data.loaded / data.total) * 100) );
//             $('#progress .progress-bar').css(
//                 'width',
//                 progress + '%'
//             );
//             $("#upload_percentage").html(progress);
//             //console.log(progress);
//         }
//     }

//     //console.log(input.files[0].name);

//     reader.readAsDataURL(input.files[0]);
//   }
// }

$(document).on('click','.remove_pic', function(){
  $(this).parent().remove();
});
$('.add_img').click(function(){
  alert('Please select an image');
});

$("#upload").change(function() {
  $("#image_progress_bar").hide();
  $("#hide").show();
  // readURL(this);
  $('.text-data').hide();
  //$('.add_cart').html('<button type="submit" class="btn btn-success pull-right">Add to cart&nbsp; <i class="fa fa-angle-right"></i></button>');
});

  $(document).on( "click",'#edit.cstm_view',function() {
      var id=$(this).attr('title');
      var user_id = $(this).attr('title1');
      //alert(user_id);return false;
      $.ajax({
          type:'POST',
          url :'<?php echo base_url('welcome/Index/update_addresses');?>',
          data:'tbl_user_address_id='+id,
          dataType:'json',
          success:function(result){
                  $("#user_id").val(user_id);
                  $("#tbl_user_address_id").val(id);
                  $("#first_name").val(result.first_name);
                  $("#title").val(result.title);
                  $("#last_name").val(result.last_name);
                  $("#city").val(result.city);
                  $("#company").val(result.company);
                  $("#state").val(result.state);
                  $("#address").val(result.address);
                  $("#zip_code").val(result.zip_code);
                  $("#phone").val(result.phone);
                  $("#email").val(result.email);
                  if(result.is_default == '1'){
                       $('#is_default').attr('checked', true);
                  }
                  //console.log(first_name);
          },error:function(){

          }
      });
      $('#myModal').modal('show');
  });
  
  $(document).on( "click",'#delete.cstm_del',function() {
    $('#modalContent').html('<p>Would you like to Delete this address ?</p>');
    var user_id = $(this).attr('tit');
    var id = $(this).attr('tit1');
    //alert(user_id);
    $("#user_id1").val(user_id);
    $("#tbl_user_address_id1").val(id);
    $('#myModal2').modal('show');
  });
  
  // 12-12-18

  $(document).on("change","#get_printing_option1", function(){
      var id = $(this).find('option:selected').data('id');
      $('#paper_type_id').val(id);
  });
  
  $(document).on("change keyup",".get_option, .get_input",function(){  
      var current = $(this);
      var total_val = 0;
      var no_copies = $('#no_copies').val();
      var no_page = $('#no_pages').val();
      //alert(no_copies);
      isNumber(no_copies, no_page);
      var product_id = $('#product_id').val();
      var dimensions = $("#get_printing_option0").val();
      var paper_type = $("#get_printing_option1").val();
      var no_of_sides = $("#get_printing_option3").val();
      var divider_sheets = ($("#get_finishing_option0").val() == 'no-divider-sheets')? '' : $("#get_finishing_option0").val();
      var stapling = ($("#get_finishing_option1").val() == 'no-stapling')? '' : $("#get_finishing_option1").val();  
      var folding =($("#get_finishing_option4").val() == 'no-folding')? '' : $("#get_finishing_option4").val(); 
      var collation = $("#get_finishing_option9").val();
      var hole_punch = ($("#get_finishing_option27").val() == 'no-hole-punch')? '' : $("#get_finishing_option27").val();
      var paper_type_id = $('#paper_type_id').val();

      var divider_sheets_form_val = $("#get_finishing_option0").val();
      var stapling_form_val = $("#get_finishing_option1").val(); 
      var folding_form_val = $("#get_finishing_option4").val(); 
      var hole_punch_form_val =  $("#get_finishing_option27").val();
      var full_bleed=$("#full_bleed").val();

      if(no_of_sides == "2-sided" && no_page < 2 && $('#no_pages').val() != "2"){
		   $('#no_pages').val(2);
		   var no_page   = $('#no_pages').val();
	  }

      //alert(paper_type_id);
      var total_copy = parseInt(no_copies)*parseInt(no_page);
      if (no_page == 1 && no_of_sides == "2-sided") {
        bootbox.alert("Total number of pages should be greater than 1");
        $("#get_printing_option3").prop("selectedIndex", 0);
        return false;
      };

      $.ajax({
          url: '<?= base_url("welcome/index/price_calculator")?>',
          type: 'post',
          data: {
              "dimensions": dimensions,
              "paper_type": paper_type,
              "no_of_sides": no_of_sides,
              "divider_sheets": divider_sheets,
              "stapling": stapling,
              "folding": folding,
              "collation": collation,
              "hole_punch": hole_punch,
              "product_id": product_id,
              "no_copies": no_copies,
              "no_pages": no_page,
              'full_bleed':full_bleed
          },
          dataType: 'json',
          success: function(data) {
              //console.log(data);return false;
              if (data.error == "1") {
                //alert("<p style='color:red;font-weight:bold;'>The option is not available for the current combination</p>");
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>The option is not available for the current combination.<br>Please choose another option.</p>");
                //current.prop("selectedIndex", 0);
                current.children('option:enabled').eq(0).prop('selected',true);
				return false;
              }else if (data.error == "2"){
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Only 8.5x11 can be 3 hole punched</p>");
                current.children('option:enabled').eq(0).prop('selected',true);
				return false;
			  }else if (data.error == "3"){
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Only uncollated sheets, 8.5x11, 8.5x14 & 11x17 can be folded, NO cardstock can be folded.</p>");
                current.children('option:enabled').eq(0).prop('selected',true);
				$("#get_finishing_option4").prop('selectedIndex',0).trigger("change");
				
				return false;
              }else if (data.error == "4"){
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Only collated sheets with these dimensions(8.5x11,8.5x14,11x17,4.25x5.5,4.25x11,8.5x5.5,8.5x7,4x6,5x7,8x10) can be stapled.</p>");
                current.children('option:enabled').eq(0).prop('selected',true)
				return false;
              }
              
              
              else if (data.price != "") {
                  var input="";
                  var product_slug = "<?php echo $this->uri->segment(2);?>";
				  var row_id = "<?=!empty($_REQUEST['rowid']) ? $_REQUEST['rowid'] : ''?>";
				  
                  input += "<input type='hidden' name='row_id' value='"+row_id+"'>";
				  
                  input += "<input type='hidden' name='dimensions' value='"+dimensions+"'>";
                  input += "<input type='hidden' name='paper_type' value='"+paper_type+"'>";
                  input += "<input type='hidden' name='paper_type_id' value='"+paper_type_id+"'>";
                  input += "<input type='hidden' name='no_of_sides' value='"+no_of_sides+"'>";
                  input += "<input type='hidden' name='divider_sheets' value='"+divider_sheets_form_val+"'>";
                  input += "<input type='hidden' name='stapling' value='"+stapling_form_val+"'>";
                  input += "<input type='hidden' name='folding' value='"+folding_form_val+"'>";
                  input += "<input type='hidden' name='collation' value='"+collation+"'>";
                  input += "<input type='hidden' name='hole_punch' value='"+hole_punch_form_val+"'>";
                  input += "<input type='hidden' class='total' name='total' value='"+(Math.round(data.total* 100) / 100).toFixed(2)+"'>";
                  input += "<input type='hidden' name='price_page' value='"+(Math.round(data.price* 100) / 100).toFixed(2)+"'>";
                  input += "<input type='hidden' name='product_id' value='"+product_id+"'>";
                  input += "<input type='hidden' name='copies' value='"+no_copies+"'>";
                  input += "<input type='hidden' name='pages' value='"+no_page+"'>";
                  input += "<input type='hidden' name='product_slug' value='"+product_slug+"'>";
                  input += "<input type='hidden' name='full_bleed' value='"+full_bleed+"'>";
                  
                  

                  $("#add_cart_from").find('input').remove();
                  $("#add_cart_from").prepend(input);
                  $("#add_cart_from .nextstep").removeAttr('disabled');

                  $(".price").html((Math.round(data.price* 100) / 100).toFixed(2));
                  $(".total").html((Math.round(data.total* 100) / 100).toFixed(2));
              
                  if (data.error == "9"){
                    bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Bleed not available for this paper type</p>");
                    current.children('option:enabled').eq(0).prop('selected',true);
                    $("#full_bleed").children('option:enabled').eq(0).prop('selected',true);
                    
                  }
              
              
                } else {
                  $(".price").html('0.00');
                  $(".total").html('0.00');
              }
          },
          error: function(jqXhr, textStatus, errorThrown) {
              console.log(errorThrown);
          }
      });
  });
  $(document).on("change keyup",".no_of_sides_coil",function(){
	  
	   if($(".no_of_sides_coil").val() == "2-sided" && $("#no_pages").val() < 2){
		   $('#no_pages').val(2);
	  }
	  
  });
  
  
    
	   $(document).on("change","#no_pages",function(){
	  
	  if ($("#no_pages").val() < 2 && $(".no_of_sides_coil").val() == "2-sided") {
        bootbox.alert("Total number of pages should be greater than 1");
        $("#get_printing_option3").prop("selectedIndex", 0);
		$('#no_pages').val(2);
        return false;
      };
	  
  });
  
  /* if (no_page == 1 && no_of_sides == "2-sided") {
        bootbox.alert("Total number of pages should be greater than 1");
        $("#get_printing_option3").prop("selectedIndex", 0);
        return false;
      }; */
  
  
  /* ****************************** Ajax for COIL BOUND BOOKS ***************************************** */
  
    $(document).on("change keyup",".get_option, .get_input_new",function(){
		
	  var product_id = $('#product_id').val();
	  
	  if(product_id == "117"){
		  
	  var current 					= $(this);
      var total_val 				= 0;
      var no_copies 				= $('#no_copies').val();
      var no_page 					= $('#no_pages').val();
	  var orientation_val 			= $('input[name="orientation-val"]:checked').val();
	  var dimensions 				= $('#dimensions option:selected').val();
	  var no_of_sides 				= $('.no_of_sides_coil option:selected').val();
	  var color_coil 				= $('.color_coil option:selected').val();
	  var paper_type 				= $("#get_printing_option1").val();
	  var full_bleed				= $('#full_bleed option:selected').val();
	  var front_cover_check			= $('#front_cover_check option:selected').val();
	  var front_cover_sides 		= $('.front_cover_sides option:selected').val();
	  var front_cover_color 		= $('#get_printing_option4 option:selected').val();
	  var front_cover_paper_type	= $('.front_cover_paper_type option:selected').val();
	  var front_cover_full_bleed 	= $('.front_full_bleed option:selected').val();
	  var back_cover_check			= $('#back_cover_check option:selected').val();
	  var back_cover_sides 			= $('.back_cover_sides option:selected').val();
	  var back_cover_color_type 	= $('.back_cover_color_type option:selected').val();
	  var back_cover_paper_type 	= $('.back_cover_paper_type option:selected').val();
	  var back_cover_full_bleed		= $('.back_cover_full_bleed option:selected').val();
	  var front_cover_option 		= $('#front_cover_option option:selected').val();
	  var back_cover_option 		= $('#back_cover_option option:selected').val();
	  var divider_sheets_form_val = $("#get_finishing_option0").val();
	  var stapling_form_val = $("#get_finishing_option1").val();
	  var folding_form_val = $("#get_finishing_option4").val(); 
	  var collation = $("#get_finishing_option9").val();	  
	  var hole_punch_form_val =  $("#get_finishing_option27").val();
	  var paper_type_id = $('#paper_type_id').val();
	  
	//console.log(front_cover_paper_type);
	  
	  if(no_of_sides == "2-sided" && no_page < 2){
		   var no_page   = $('#no_pages').val();
	  }
	  
	  /* if (no_page == 1 && no_of_sides == "2-sided") {
        bootbox.alert("Total number of pages should be greater than 1");
        $("#get_printing_option3").prop("selectedIndex", 0);
        return false;
      }; */
	  
	 
	  
      /* alert(no_page);
      isNumber(no_copies, no_page);
      var product_id = $('#product_id').val();
      var dimensions = $("#get_printing_option0").val();
      var paper_type = $("#get_printing_option1").val();
      var no_of_sides = $("#get_printing_option3").val();
      var divider_sheets = ($("#get_finishing_option0").val() == 'no-divider-sheets')? '' : $("#get_finishing_option0").val();
      var stapling = ($("#get_finishing_option1").val() == 'no-stapling')? '' : $("#get_finishing_option1").val();  
      var folding =($("#get_finishing_option4").val() == 'no-folding')? '' : $("#get_finishing_option4").val(); 
      var collation = $("#get_finishing_option9").val();
      var hole_punch = ($("#get_finishing_option27").val() == 'no-hole-punch')? '' : $("#get_finishing_option27").val();
     

      var stapling_form_val = $("#get_finishing_option1").val(); 
      var folding_form_val = $("#get_finishing_option4").val(); 
      var hole_punch_form_val =  $("#get_finishing_option27").val();
      var full_bleed=$("#full_bleed").val();

      if(no_of_sides == "2-sided" && no_page < 2){
		   $('#no_pages').val(2);
		   var no_page   = $('#no_pages').val();
	  }

      //alert(paper_type_id);
      var total_copy = parseInt(no_copies)*parseInt(no_page);
      if (no_page == 1 && no_of_sides == "2-sided") {
        bootbox.alert("Total number of pages should be greater than 1");
        $("#get_printing_option3").prop("selectedIndex", 0);
        return false;
      }; */

      $.ajax({
          url: '<?= base_url("welcome/index/price_calculator_for_coil_bound_books")?>',
          type: 'post',
          data: {
               "dimensions": dimensions,
              "no_of_sides": no_of_sides,
			  "color_coil": color_coil,
              "paper_type": paper_type, 
              /*"divider_sheets": divider_sheets,
              "stapling": stapling,
              "folding": folding,
              "collation": collation,
              "hole_punch": hole_punch,*/
              "product_id": product_id, 
              "no_copies": no_copies,
              "no_pages": no_page,
			  "orientation-val": orientation_val,
			  "front_cover_check":front_cover_check,
			  "front_cover_sides":front_cover_sides,
			  "front_cover_color":front_cover_color,
			  "front_cover_paper_type":front_cover_paper_type,
			  "front_cover_full_bleed":front_cover_full_bleed,
			  "back_cover_check":back_cover_check,
			  "back_cover_sides":back_cover_sides,
			  "back_cover_color_type":back_cover_color_type,
			  "back_cover_paper_type":back_cover_paper_type,
			  "back_cover_full_bleed":back_cover_full_bleed,
			  "front_cover_option":front_cover_option,
			  "back_cover_option":back_cover_option,
              'full_bleed':full_bleed
          },
          dataType: 'json',
          success: function(data) {
              //console.log(data);return false;
              if (data.error == "1") {
                //alert("<p style='color:red;font-weight:bold;'>The option is not available for the current combination</p>");
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>The option is not available for the current combination.<br>Please choose another option.</p>");
                //current.prop("selectedIndex", 0);
                current.children('option:enabled').eq(0).prop('selected',true);
				return false;
              }else if (data.error == "2"){
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Only 8.5x11 can be 3 hole punched</p>");
                current.children('option:enabled').eq(0).prop('selected',true);
				return false;
			  }else if (data.error == "3"){
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Only uncollated sheets, 8.5x11, 8.5x14 & 11x17 can be folded, NO cardstock can be folded.</p>");
                current.children('option:enabled').eq(0).prop('selected',true);
				$("#get_finishing_option4").prop('selectedIndex',0).trigger("change");
				
				return false;
              }else if (data.error == "4"){
                bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Only collated sheets with these dimensions(8.5x11,8.5x14,11x17,4.25x5.5,4.25x11,8.5x5.5,8.5x7,4x6,5x7,8x10) can be stapled.</p>");
                current.children('option:enabled').eq(0).prop('selected',true)
				return false;
              }
              
              
              else if (data.price != "") {
				  //debugger;
                  var input="";
                  var product_slug = "<?php echo $this->uri->segment(2);?>";
				  var row_id = "<?=!empty($_REQUEST['rowid']) ? $_REQUEST['rowid'] : ''?>";
				  
                  input += "<input type='hidden' name='row_id' value='"+row_id+"'>";
				  
                  input += "<input type='hidden' name='dimensions' value='"+dimensions+"'>";
                  input += "<input type='hidden' name='paper_type' value='"+paper_type+"'>";
                  input += "<input type='hidden' name='paper_type_id' value='"+paper_type_id+"'>";
                  input += "<input type='hidden' name='no_of_sides' value='"+no_of_sides+"'>";
                  input += "<input type='hidden' name='divider_sheets' value='"+divider_sheets_form_val+"'>";
                  input += "<input type='hidden' name='stapling' value='"+stapling_form_val+"'>";
                  input += "<input type='hidden' name='folding' value='"+folding_form_val+"'>";
                  input += "<input type='hidden' name='collation' value='"+collation+"'>";
				  input += "<input type='hidden' name='orientation' value='"+orientation_val+"'>";
                  input += "<input type='hidden' name='hole_punch' value='"+hole_punch_form_val+"'>";
                  input += "<input type='hidden' class='total' name='total' value='"+(Math.round(data.total* 100) / 100).toFixed(2)+"'>";
                  input += "<input type='hidden' name='price_page' value='"+(Math.round(data.price* 100) / 100).toFixed(2)+"'>";
                  input += "<input type='hidden' name='product_id' value='"+product_id+"'>";
                  input += "<input type='hidden' name='copies' value='"+no_copies+"'>";
                  input += "<input type='hidden' name='pages' value='"+no_page+"'>";
                  input += "<input type='hidden' name='product_slug' value='"+product_slug+"'>";
                  input += "<input type='hidden' name='full_bleed' value='"+full_bleed+"'>";
				  input += "<input type='hidden' name='color_inside_pages' value='"+color_coil+"'>";
				  input += "<input type='hidden' name='front_cover_req' value='"+front_cover_check+"'>";
				  input += "<input type='hidden' name='front_cover_sides' value='"+front_cover_sides+"'>";
				  input += "<input type='hidden' name='front_cover_color' value='"+front_cover_color+"'>";
				  input += "<input type='hidden' name='front_cover_paper_type' value='"+front_cover_paper_type+"'>";
				  input += "<input type='hidden' name='front_cover_full_bleed' value='"+front_cover_full_bleed+"'>";
				  input += "<input type='hidden' name='back_cover_check' value='"+back_cover_check+"'>";
				  input += "<input type='hidden' name='back_cover_sides' value='"+back_cover_sides+"'>";
				  input += "<input type='hidden' name='back_cover_color_type' value='"+back_cover_color_type+"'>";
				  input += "<input type='hidden' name='back_cover_paper_type' value='"+back_cover_paper_type+"'>";
				  input += "<input type='hidden' name='back_cover_full_bleed' value='"+back_cover_full_bleed+"'>";
				  input += "<input type='hidden' name='front_cover_option' value='"+front_cover_option+"'>";
				  input += "<input type='hidden' name='back_cover_option' value='"+back_cover_option+"'>";
				  
                  

                  $("#add_cart_from").find('input').remove();
                  $("#add_cart_from").prepend(input);
                  $("#add_cart_from .nextstep").removeAttr('disabled');

                  $(".total").html((Math.round(data.price* 100) / 100).toFixed(2));
				  $(".front_cover").html((Math.round(data.front_cover* 100) / 100).toFixed(2));
				  $(".back_cover").html((Math.round(data.back_cover* 100) / 100).toFixed(2));
				  $(".inside_page").html((Math.round(data.inside_page* 100) / 100).toFixed(2));
				  $(".back_cover_cost").html((Math.round(data.back_cover_cost* 100) / 100).toFixed(2));
				  $(".front_cover_cost").html((Math.round(data.front_cover_cost* 100) / 100).toFixed(2));
                  //$(".total").html((Math.round(data.total* 100) / 100).toFixed(2));
				  
			
                  if (data.error == "9"){
                    bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Bleed not available for this paper type</p>");
                    current.children('option:enabled').eq(0).prop('selected',true);
                    $("#full_bleed").children('option:enabled').eq(0).prop('selected',true);
                    
                  }
              
              
                } else {
                  $(".price").html('0.00');
                  $(".total").html('0.00');
              }
          },
          error: function(jqXhr, textStatus, errorThrown) {
              console.log(errorThrown);
          }
      });
		  
	  }

  });
  
  /* ****************************** Ajax for COIL BOUND BOOKS ENDS ***************************************** */
  
  
 $(document).ready(function() {
	 
	 $(document).on("change",".get_input_new",function(){
	  
	  var no_page 					= $('#no_pages').val();
	  var no_of_sides 				= $('.no_of_sides_coil option:selected').val();
	 
	  var product_id = $('#product_id').val();
	  if(product_id == "117"){
	 
	   if (no_page > 330 && no_of_sides == "1-sided") {
		  
        bootbox.alert(`<div class="text-center">
        <h1 style='color:red'>Maximum number of sheets exceeded.</h1> 
        <br> Maximum number of pages for 1-sided are 330<br>
        Maximum number of pages for 2-sided are 660<br><br>
        <span style='color:red'>If you are doing 2-sided please select number <br>Of side first and than number of pages.</span>
        </div>`).find('.modal-content').css({'font-weight' : 'bold', 'font-size': '18px'});
		
		$("#no_pages").val('1');
        
        return false;
      }; 
	  
if (no_page > 660 && no_of_sides == "2-sided") {
		  
        bootbox.alert(`<div class="text-center"><h1 style='color:red'>Maximum number of sheets exceeded.</h1> 
        <br>Maximum number of pages for 1-sided are 330
        <br>Maximum number of pages for 2-sided are 660<br><br>
        <span style='color:red'>If you are doing 2-sided please select number Of side first and than number of pages.
</span></div>`).find('.modal-content').css({'font-weight' : 'bold', 'font-size': '18px'});
		$("#no_pages").val('2');
        
        return false;
      }; 
	  };
	 }); 
	 
	 var inside_color_options = $("#get_printing_option1 optgroup");
	 var front_color_options = $(".front_cover_paper_type optgroup");
	 var back_color_options = $(".back_cover_paper_type optgroup");

	 
  $(document).on("change keyup",".get_option, .get_input_new",function(){
	  
  
	  var product_id = $('#product_id').val();
	  
	  if(product_id == "117"){
	  
   if ($(".color_coil").val() == "black-ink" || $("#get_printing_option1").val() == "20/50 lb white copy paper") {
      $("#full_bleed").prop("disabled", true);
	  $("#full_bleed").val($("#full_bleed option:first").val());
	  $('#full_bleed').css('background','#dddddd');
	  
	  
   } else {
      $("#full_bleed").prop("disabled", false);
	  $('#full_bleed').css('background','none');	  
   }
   
   
      if ($("#get_printing_option4").val() == "black-ink") {
      $(".front_full_bleed").prop("disabled", true);
	  $(".front_full_bleed").val($(".front_full_bleed option:first").val());
	  $('.front_full_bleed').css('background','#dddddd');
	  
	  
   } else {
      $(".front_full_bleed").prop("disabled", false);
	  $('.front_full_bleed').css('background','none');	  
   }
   
   
   if ($(".back_cover_color_type").val() == "black-ink") {
      $(".back_cover_full_bleed").prop("disabled", true);
	  $(".back_cover_full_bleed").val($(".back_cover_full_bleed option:first").val());
	  $('.back_cover_full_bleed').css('background','#dddddd');
	  
	  
   } else {
      $(".back_cover_full_bleed").prop("disabled", false);
	  $('.back_cover_full_bleed').css('background','none');	  
   }
   
   
   if ($("#back_cover_check").val() == "yes_but_blank_cover_only") {
	  $(".back_cover_color_type").val($(".back_cover_color_type").find('option:nth-child(2)').val());
	  $('.back_cover_sides').css('display','none');
	  $('.back_cover_color_type').css('display','none');
	  $('.back_sides').css('display','none');
	  $('.back_color_type').css('display','none');
	  
	
   }else{
	   
	   $('.back_cover_sides').css('display','block');
	  $('.back_cover_color_type').css('display','block');
	  $('.back_sides').css('display','block');
	  $('.back_color_type').css('display','block');
   }
   
   
   		
	if($(".color_coil").val() == "color"){
		
		   $(inside_color_options).each(function()
		{  
		
		if($(this).attr("class") != "Uncoated copy paper white" && 
		   $(this).attr("class") != "Hammermill Laser Paper" && 
		   $(this).attr("class") != "Coated Gloss paper" && 
		   $(this).attr("class") != "Coated matte paper"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
	});
		
	}else{
		
		   $(inside_color_options).each(function()
		{
		
		if($(this).attr("class") != "Uncoated copy paper white" && 
		   $(this).attr("class") != "Hammermill Laser Paper"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
		});
	}
	
	/************************ Inside Page ENDS *******************************/
	
		if($("#get_printing_option4").val() == "color"){
		
		   $(front_color_options).each(function()
		{
			
		if($(this).attr("class") != "Coated gloss cardstock" && 
		   $(this).attr("class") != "Coated matte  cardstock" && 
		   $(this).attr("class") != "Semi gloss thick cardstock"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
	});
		
	}else{
		
	  $(front_color_options).each(function()
		{
		
		if($(this).attr("class") != "Uncoated cardstock pastel 90 lb color" && 
		   $(this).attr("class") != "Uncoated cardstock bright 65 lb color" &&
		   $(this).attr("class") != "Uncoated cardstock pastel color 110"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
		});
	}
		
	if($(".back_cover_color_type").val() == "color"){
		
		   $(back_color_options).each(function()
		{
			
		if($(this).attr("class") != "Coated gloss cardstock" && 
		   $(this).attr("class") != "Coated matte  cardstock" && 
		   $(this).attr("class") != "Semi gloss thick cardstock"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
	});
		
	}else{
		
		   $(back_color_options).each(function()
		{
		
		if($(this).attr("class") != "Uncoated cardstock pastel 90 lb color" && 
		   $(this).attr("class") != "Uncoated cardstock bright 65 lb color" &&
		   $(this).attr("class") != "Uncoated cardstock pastel color 110"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
		});
	}
	
	
	  //$('#get_printing_option1 optgroup')[0].label;
    
  }
   
   
 });
 

  
 
});

$(document).ready(function() {
	 
	 var inside_color_options = $("#get_printing_option1 optgroup");
	 var front_color_options = $(".front_cover_paper_type optgroup");
	 var back_color_options = $(".back_cover_paper_type optgroup");
	 
	 
	 	if($(".back_cover_color_type").val() == "color"){
		
		   $(back_color_options).each(function()
		{
			
		if($(this).attr("class") != "Coated gloss cardstock" && 
		   $(this).attr("class") != "Coated matte  cardstock" && 
		   $(this).attr("class") != "Semi gloss thick cardstock"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
	});
		
	}else{
		
		   $(back_color_options).each(function()
		{
		
		if($(this).attr("class") != "Uncoated cardstock pastel 90 lb color" && 
		   $(this).attr("class") != "Uncoated cardstock bright 65 lb color" &&
		   $(this).attr("class") != "Uncoated cardstock pastel color 110"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
		});
	}
	 
	 	if($("#get_printing_option4").val() == "color"){
		
		   $(front_color_options).each(function()
		{
			
		if($(this).attr("class") != "Coated gloss cardstock" && 
		   $(this).attr("class") != "Coated matte  cardstock" && 
		   $(this).attr("class") != "Semi gloss thick cardstock"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
	});
		
	}else{
		
	  $(front_color_options).each(function()
		{
		
		if($(this).attr("class") != "Uncoated cardstock pastel 90 lb color" && 
		   $(this).attr("class") != "Uncoated cardstock bright 65 lb color" &&
		   $(this).attr("class") != "Uncoated cardstock pastel color 110"){
			
			$(this).hide();
		}else{
			
			$(this).show();
		}
		});
	}
	
	var check_front_color = 0;
	   $(front_color_options).each(function()
		{
			$(this).each(function () {
				if ($(this).css('display') != 'none') {
					$(this).children().eq(0).prop("selected", true);
					check_front_color= 1;
					return false;
				}
			});
			
			if(check_front_color == 1){
				
				return false;
			}
		})
		
		var check_back_color = 0;
	   $(back_color_options).each(function()
		{
			$(this).each(function () {
				if ($(this).css('display') != 'none') {
					$(this).children().eq(0).prop("selected", true);
					check_back_color= 1;
					return false;
				}
			});
			
			if(check_back_color == 1){
				
				return false;
			}
		})
	 

$(document).on("change keyup",".get_option, .back_cover_color_type",function(){
	  var check_back_color = 0;
	   $(back_color_options).each(function()
		{
			$(this).each(function () {
				if ($(this).css('display') != 'none') {
					$(this).children().eq(0).prop("selected", true);
					check_back_color= 1;
					return false;
				}
			});
			
			if(check_back_color == 1){
				
				return false;
			}
		})
		})
		
 
 $(document).on("change keyup","#get_printing_option4",function(){
var check_front_color = 0;
	   $(front_color_options).each(function()
		{
			$(this).each(function () {
				if ($(this).css('display') != 'none') {
					$(this).children().eq(0).prop("selected", true);
					check_front_color= 1;
					return false;
				}
			});
			
			if(check_front_color == 1){
				
				return false;
			}
		})
		
		})	
		})	
  
  
  
  /* ********************************************************************************************** */
  
  

  $(document).on("change","#get_printing_option3",function(){
    if ($(this).val() == "2-sided" && $("#no_pages").val() != 1) {
      $(".show_div").show('slow');
    }else{
      $(".show_div").hide('fade');
    }
  })

  $(document).on("click","#open_modal",function(){
    
	var product_id = $("#product_id").val();
	
	
		
		 if ($("#get_printing_option3").val() == "2-sided") {
        //console.log($('input[name="orientation"]:checked').val());
		if(product_id != 116){
        if (($('input[name="sides"]:checked').val() == undefined) || ($('input[name="orientation"]:checked').val() == undefined)) {
          bootbox.alert("<p style='color:red;font-weight:bold;font-size:16px;'>Have to select any option from Sides and any option from Orientation</p>");
        }else{
          $("#myModal").modal('show');
        }} else{
          $("#myModal").modal('show');
        };
      }else{
        $("#myModal").modal('show');
      }
	
  })
  
  $(document).ready(function($) {
    var no_copies = $('#no_copies').val();     
    var no_page   = $('#no_pages').val();
	var no_of_sides = $("#get_printing_option3").val();
	if(no_of_sides == "2-sided" && no_page < 2){
		   $('#no_pages').val(2);
		    var no_page   = $('#no_pages').val();
	}
    if (no_copies != "" && no_page != "") {
      get_price_val(no_copies ,no_page );
    };
  });
 
  function get_price_val(no_copies, no_page) {
	
      var total_val = 0;
      isNumber(no_copies, no_page);
      var product_id = "<?php if(isset($product_data)) echo $product_data['product_id'];?>";
      var dimensions = $("#get_printing_option0").val();
      var paper_type = $("#get_printing_option1").val();
      var no_of_sides = $("#get_printing_option3").val();
      var collation = $("#get_finishing_option9").val();
      var divider_sheets = ($("#get_finishing_option0").val() == 'no-divider-sheets')? '' : $("#get_finishing_option0").val();
      var stapling = ($("#get_finishing_option1").val() == 'no-stapling')? '' : $("#get_finishing_option1").val(); 
      var folding = ($("#get_finishing_option4").val() == 'no-folding')? '' : $("#get_finishing_option4").val(); 
      var hole_punch = ($("#get_finishing_option27").val() == 'no-hole-punch')? '' : $("#get_finishing_option27").val();

      var divider_sheets_form_val = $("#get_finishing_option0").val();
      var stapling_form_val = $("#get_finishing_option1").val(); 
      var folding_form_val = $("#get_finishing_option4").val(); 
      var hole_punch_form_val =  $("#get_finishing_option27").val();
      var paper_type_id =$("#paper_type_id").val();
      var product_slug = "<?php echo $this->uri->segment(2);?>";
      var full_bleed=$("#full_bleed").val(); 

      

      $.ajax({
          url: '<?= base_url("welcome/index/price_calculator")?>',
          type: 'post',
          data: {
              dimensions: dimensions,
              paper_type: paper_type,
              no_of_sides: no_of_sides,
              divider_sheets: divider_sheets,
              stapling: stapling,
              folding: folding,
              collation: collation,
              hole_punch: hole_punch,
              product_id: product_id,
              no_copies: no_copies,
              no_pages: no_page,
              full_bleed:full_bleed
          },
          dataType: 'json',
          success: function(data) {
              if (data.price != "") {
                  var input="";
				  var row_id = "<?=!empty($_REQUEST['rowid']) ? $_REQUEST['rowid'] : ''?>";
				  
                  input += "<input type='hidden' name='row_id' value='"+row_id+"'>";
                  input += "<input type='hidden' name='dimensions' value='"+dimensions+"'>";
                  input += "<input type='hidden' name='paper_type' value='"+paper_type+"'>";
                  input += "<input type='hidden' name='no_of_sides' value='"+no_of_sides+"'>";
                  input += "<input type='hidden' name='divider_sheets' value='"+divider_sheets_form_val+"'>";
                  input += "<input type='hidden' name='stapling' value='"+stapling_form_val+"'>";
                  input += "<input type='hidden' name='folding' value='"+folding_form_val+"'>";
                  input += "<input type='hidden' name='collation' value='"+collation+"'>";
                  input += "<input type='hidden' name='hole_punch' value='"+hole_punch_form_val+"'>";
                  input += "<input type='hidden' class='total' name='total' value='"+(Math.round(data.total* 100) / 100).toFixed(2)+"'>";
                  input += "<input type='hidden' name='price_page' value='"+(Math.round(data.price* 100) / 100).toFixed(2)+"'>";
                  input += "<input type='hidden' name='product_id' value='"+product_id+"'>";
                  input += "<input type='hidden' name='copies' value='"+no_copies+"'>";
                  input += "<input type='hidden' name='pages' value='"+no_page+"'>";
                  input += "<input type='hidden' name='product_slug' value='"+product_slug+"'>";
                  input += "<input type='hidden' name='paper_type_id' value='"+paper_type_id+"'>";
                  input += "<input type='hidden' name='full_bleed' value='"+full_bleed+"'>";
                  
                  

                  

                  $("#add_cart_from").find('input').remove();
                  $("#add_cart_from").prepend(input);
                  $("#add_cart_from .nextstep").removeAttr('disabled');

                  $(".price").html((Math.round(data.price* 100) / 100).toFixed(2));
                  $(".total").html((Math.round(data.total* 100) / 100).toFixed(2)); 
              } else {
                  $(".price").html('0.00');
                  $(".total").html('0.00');
              }
          },
          error: function(jqXhr, textStatus, errorThrown) {
              console.log(errorThrown);
          }
      });
  }
  
  function isNumber(copies ,pages ) {
   if(copies.indexOf('.') == 1 || pages.indexOf('.') == 1){
     alert('Please do not enter any decimal format');
    // $("#add_cart_from .nextstep").addClass('disabled');
    $("#add_cart_from .nextstep").addClass('disabled');
     return false;
   }
   else {
    $("#add_cart_from .nextstep").removeClass('disabled'); 
    return true;
   }
  
  }

$('.register_account').click(function(){
  $('.login_form').hide();
  $('.register-box').show();
});
$('.login_account').click(function(){
  $('.register-box').hide();
  $('.login_form').show();
});

// $(document).on('click','#sign_up_btn',function(){
//   if($.safe_trim($('#reg_password').val()) != $.safe_trim($('#reg_confirm_password').val())){
//       $("#error_msg").show();
//       $("#error_msg").text('The Confirm Password field does not match the Password field.');
//       return false; 
//   } else {
//     $("#error_msg").hide();
//     $("#error_msg").text('');
//     $("#sign_up_form").submit(); 
//   }
// })

$(document).on('change', '#shipping_type' , function(){//alert('aaaaaaaa');
  //$('#cart_datepicker').val('');
  $('#btn-checkout').prop('disabled', false);
  
  if($(this).val() =='ship'){
    $("#ups_response_div").show();
    $("#delivery_time_show_hide").hide();
    $("#delivery_date_show_hide").hide();
    $("#price_button").show();
    $("#show_hide_time_fixed").hide();
    $("#show_hide_time").show();
    $('#delivery_time').html('<option value="0">Select Time</option><option value="8:00 A.M.">8:00 A.M.</option><option  value="10:30 A.M.">10:30 A.M.</option><option value="3:00 P.M.">3:00 P.M.(End Of Day)</option>');
    $('#delivery_time_val').val('0');
    $('#delivery_time_val_default').val('0');
    $('#additional_charges').val('0.00');
    $('#additional_charges_hid').val('0.00');
    
    
    var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val()) + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
    $('#cart-total').text(parseFloat(total_cost).toFixed(2));
    $('#total_amount').val(total_cost);
    
    
    $('.zip').show();
   // $('#current_date').val('');
    $('.address').hide();
  }
  if($(this).val() =='pick'){
    
    $("#delivery_time_show_hide").show();
    $("#delivery_date_show_hide").hide();
    $("#quote_hide_show").hide();
    $("#price_button").hide();
    $("#show_hide_time_fixed").show();
    $("#show_hide_time_fixed").text('4:00 PM');
    $("#show_hide_time").hide();
    $('#delivery_time').html('<option value="4.00" data-charges="4">4:00 PM</option>');
    $('#delivery_time').html('<option value="4.00" data-charges="4">4:00 PM</option>');
    $('#delivery_time_val').val('4:00 PM');
    $('#delivery_time_val_default').val('4');
    $('#additional_charges').val('0.00');
    $('#additional_charges_hid').val('0.00');

    $("#shipping_amount_hid").val('0.00');
		$("#shipping_amount").text('0.00');
    $("#ups_response_div").hide();
    $("#shipping_service_type").val('');
  
    var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val()) + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
    
    //alert($('#subtotal').val());alert($('#additional_charges').val());alert($("#sales_tax").val());alert($("#coupon_discount").val());
    $('#cart-total').text(parseFloat(total_cost).toFixed(2));
    $('#total_amount').val(total_cost);
    
    $('.zip').hide();
    //$('#current_date').val('');
    $('.address').show();
    $("#delivery_address_div").show();
    $("#delivery_note_div").hide();
  }
  if($(this).val() =='free'){
    $("#delivery_time_show_hide").hide();
    $("#delivery_date_show_hide").hide();
    $("#quote_hide_show").hide();
    $("#price_button").hide();
    $('.zip').show();
    //$('#current_date').val('');
    $('.address').show();
    $("#delivery_address_div").hide();
    $("#delivery_note_div").show();

    $("#show_hide_time_fixed").hide();
    $("#show_hide_time").hide();

    
  
    // $('#delivery_time').html('<option value="0" data-charges="0">Select Time</option><option value="0" data-charges="0">4:00 PM</option><option data-charges="0" value="0">6:00 PM</option><option value="0" data-charges="0">8:00 PM</option><option data-charges="0" value="0">10:00 PM</option>');
    $('#delivery_time_val').val('0');
    $('#delivery_time_val_default').val('0');
    $('#additional_charges').val('0.00');
    $('#additional_charges_hid').val('0.00');

    $("#shipping_amount_hid").val('0.00');
		$("#shipping_amount").text('0.00');

    $("#ups_response_div").hide();
    $("#shipping_service_type").val('');
    
    
    var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val()) + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
    $('#cart-total').text(parseFloat(total_cost).toFixed(2));
    $('#total_amount').val(total_cost);
  
  
  }
  if($(this).val() =='regular'){
    $("#delivery_time_show_hide").hide();
    $("#delivery_date_show_hide").hide();
    $("#quote_hide_show").hide();
    $("#price_button").hide();
    $("#show_hide_time_fixed").hide();
    $("#show_hide_time").show();
    $('#delivery_time').html('<option value="0">Select Time</option><option value="8:00 A.M.">8:00 A.M.</option><option  value="10:30 A.M.">10:30 A.M.</option><option value="3:00 P.M.">3:00 P.M.(End Of Day)</option>');
    $('#delivery_time_val').val('0');
    $('#delivery_time_val_default').val('0');
    $('#additional_charges').val('0.00');
    $('#additional_charges_hid').val('0.00');

    $("#shipping_amount_hid").val('0.00');
		$("#shipping_amount").text('0.00');
    
    
    var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val()) + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
    $('#cart-total').text(parseFloat(total_cost).toFixed(2));
    $('#total_amount').val(total_cost);
    
    $('.zip').show();
    //$('#current_date').val('');
    $('.address').hide();
    $("#ups_response_div").hide();
    $("#shipping_service_type").val('');
  
  }
  $('#shipping_type_val').val($(this).find('option:selected').text());
});

  


  $(document).on('change keyup', '#zip_code' , function(){
    
    var id = $(this).val();
    $('#zip_data').val(id);
  
  });

// $(document).on('change', '#delivery_time' , function(){
//   var val = $(this).val();
//   $("#delivery_time_val").val(val);
//   $.ajax({
//       type:'POST',
//       url :'<?php echo base_url('welcome/cart/update_total');?>',
//       data:{"delivery_val":val,"type":"ADDITIONAL_PRICE"},
//       success:function(result){
//         var res = result.split("||");
//         var sales_tax=parseFloat($("#sales_tax").val());
//         // $('.cart-shipping').text(parseFloat(res[2]).toFixed(2));
//         // $('#cart-shipping').val(res[2]);
        
//         // $('#additional_charges').val('0.00');
//         // $('#additional_charges_hid').val('0.00');
        
//         var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val())  + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
            
//         $('#cart-total').text(parseFloat(total_cost).toFixed(2));
//         $('#total_amount').val(total_cost);
       
//         //$('#cart-additional').text(parseFloat(res[3]).toFixed(2));
//       }
//   });
// });
/*
$(document).on('keyup', '#additional_charges' , function(){
  var val = $(this).val();
  $.ajax({
      type:'POST',
      url :'<?php echo base_url('welcome/cart/update_total');?>',
      data:{"delivery_val":val,"type":"ADDITIONAL_PRICE"},
      success:function(result){
        var res = result.split("||");
       
       //alert(res);
        $('#additional_charges').val(isNaN(res[3])? 0 : res[3]);
        $('#additional_charges_hid').val(isNaN(res[3])? 0 : res[3]);

        var sales_tax=parseFloat((Number($('#subtotal').val()) + Number($('#additional_charges').val())) * <?=SALES_TAX_PER?>).toFixed(2);
        $("#sales_tax").val(sales_tax);
        $(".sales_tax").text(sales_tax);
        
        var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val())  + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
        $('#cart-total').text(parseFloat(total_cost).toFixed(2));
        $('#total_amount').val(total_cost);
        //$('#cart-additional').text(parseFloat(res[3]).toFixed(2));
      }
  });
});
*/

$(document).on('keyup', '#additional_charges' , function(){
  var val = $(this).val();
  $.ajax({
      type:'POST',
      url :'<?php echo base_url('welcome/cart/update_total');?>',
      data:{"delivery_val":val,"type":"ADDITIONAL_PRICE"},
      success:function(result){
        var res = result.split("||");
       
       //alert(res);
        $('#additional_charges').val(isNaN(res[3])? 0 : res[3]);
        $('#additional_charges_hid').val(isNaN(res[3])? 0 : res[3]);

        var sales_tax= parseFloat((Number($('#subtotal').val()) + Number($('#additional_charges').val()) + Number($("#shipping_amount_hid").val())) * <?=SALES_TAX_PER?>).toFixed(2);
        $("#sales_tax").val(sales_tax);
        $(".sales_tax").text(sales_tax);
        
        var total_cost=Number($('#subtotal').val()) + Number($('#additional_charges').val())  + Number($("#sales_tax").val()) + Number($("#shipping_amount_hid").val()) - Number($("#coupon_discount").val());
        $('#cart-total').text(parseFloat(total_cost).toFixed(2));
        $('#total_amount').val(total_cost);
        //$('#cart-additional').text(parseFloat(res[3]).toFixed(2));
      }
  });
});
$(document).on("click","#coupon",function(){
  var coupon_code = $("#coupon_code").val();
  var total_amount = $("#total_amount").val();
  var subtotal = $("#subtotal").text();
  var coupon_discount=$("#coupon_discount").val();
  
  if(coupon_discount <= 0){
      $.ajax({
          type:'POST',
          url :'<?php echo base_url('welcome/cart/check_coupon');?>',
          data:{coupon_code: coupon_code},
          success:function(result){
            var coupon_discount = result;
            var after_discount = Number(total_amount) - Number(coupon_discount);
            
            $('.coupon_discount').text(parseFloat(result).toFixed(2));
            $('#coupon_discount').val(parseFloat(result).toFixed(2));
            if (result == 0) {
              alert("Not valid coupon");
              $('#cart-total').text(parseFloat(total_amount).toFixed(2));
              $('#total_amount').val(parseFloat(total_amount).toFixed(2));
            } else{
              alert("Coupon applied successfully");
              $('#cart-total').text(parseFloat(after_discount).toFixed(2));
              $('#total_amount').val(parseFloat(after_discount).toFixed(2));
            };
          }
      });
  }
  else{
    
    alert('Coupon Already Applied');
  
  }

})

$(document).on("click",".edit_cart",function(){
  var rowid = $(this).data('rowid');
  var id = $(this).data('id');
  var copies = $(this).data('copies');
  var pages = $(this).data('pages');
  var printing = $(this).data('printing');
  var finishing = $(this).data('finishing');
  var price_page = $(this).data('perpage');
  var price = $(this).data('price');
  var image = $(this).data('image');

  if (printing != "") {
    all_printing = printing.split(",");
    var printing_type = {};
    if (all_printing != "" || all_printing !== undefined) {
      $.each(all_printing, function(index, item) {
          printing_data = item.split("||");
          printing_type[printing_data[0].replace(/ /g,"_")] = printing_data[1];
      });
    };
  };

  var finishing_type = {};
  if (finishing != "") {
    all_finishing = finishing.split(",");
    if (all_finishing != "" || all_finishing !== undefined) {
      $.each(all_finishing, function(index, item) {
          finishing_data = item.split("||");
          finishing_type[(finishing_data[0].replace("3","three")).replace(/ /g,"_")] = finishing_data[1];
      });
    };
  };

  //console.log(finishing_type);return false;

  $("#no_copies").val(copies);
  $("#no_pages").val(pages);
  $("#get_printing_option0").val(printing_type.Dimensions);
  $("#get_printing_option1").val(printing_type.Paper_Type);
  $("#get_printing_option3").val(printing_type.No_Of_Sides);
  if (finishing_type.Divider_Sheets !== undefined) {
    $("#get_finishing_option0").val(finishing_type.Divider_Sheets);
  };
  if (finishing_type.Stapling !== undefined) {
    $("#get_finishing_option1").val(finishing_type.Stapling);
  };
  if (finishing_type.Folding !== undefined) {
    $("#get_finishing_option4").val(finishing_type.Folding);
  };
  if (finishing_type.Collation !== undefined) {
    $("#get_finishing_option9").val(finishing_type.Collation);
  };
  if (finishing_type.three_Hole_Punch !== undefined) {
    $("#get_finishing_option27").val(finishing_type.three_Hole_Punch);
  };
  $("#product_id").val(id);
  $("#rowid").val(rowid);
  $("#product_image").val(image);
  $(".price").html((Math.round(price_page* 100) / 100).toFixed(2));
  $(".total").html((Math.round(price* 100) / 100).toFixed(2));
  $("#myModal").modal("show");
})

$(document).on("click","#update_cart",function(){
  var copies = $("#no_copies").val();
  var pages = $("#no_pages").val();
  var dimensions = $("#get_printing_option0").val();
  var paper_type = $("#get_printing_option1").val();
  var no_of_sides = $("#get_printing_option3").val();
  var divider_sheets = ($("#get_finishing_option0").val() == 'no-divider-sheets')? '' : $("#get_finishing_option0").val();
  var stapling = ($("#get_finishing_option1").val() == 'no-stapling')? '' : $("#get_finishing_option1").val(); 
  var folding = ($("#get_finishing_option4").val() == 'no-folding')? '' : $("#get_finishing_option4").val(); 
  var collation = $("#get_finishing_option9").val();
  var hole_punch = ($("#get_finishing_option27").val() == 'no-hole-punch')? '' : $("#get_finishing_option27").val();
  var product_id = $("#product_id").val();
  var rowid = $("#rowid").val();
  var product_image = $("#product_image").val();
  var price_per_page = $(".price").html();
  var total_amount = $(".total").html();

  $.ajax({
      type:'POST',
      url :'<?php echo base_url('welcome/cart/update_cart_items');?>',
      data:{copies: copies, pages: pages, dimensions: dimensions, paper_type: paper_type, no_of_sides: no_of_sides, divider_sheets: divider_sheets, stapling: stapling, folding: folding, collation: collation, hole_punch: hole_punch, product_id: product_id, rowid: rowid, product_image: product_image, price_per_page: price_per_page, total_amount: total_amount},
      success:function(result){
        location.reload();
      }
  });
})



$(document).on('click','#user_login',function(){
  $("#success_msg").html('');
  $("#error_msg").html('');
  var senddata=$("#login_form").serializeArray();
    $.ajax({
        type:'POST',
        url :'<?php echo base_url('welcome/Index/login_register_1');?>',
        data:senddata,
        dataType:'json',
        encode:true,
        success:function(data){
          if(data.status){
            $("#success_msg").show();
            $("#error_msg").hide();
            $("#success_msg").html(data.message);
            $("#is_logged_in").val(data.is_logged_in);
            $("#user_id").val(data.user_id);
            $("#login_logout_div").html('<a href="<?php echo base_url();?>logout"><img src="<?php echo base_url();?>assets/frontend/images/register-icon.png" alt="icon">&nbsp;LOGOUT</a>');
            setTimeout(function(){$('#signup_login_modal').modal('hide');}, 1000);
            
          
          }
          else{
            $("#success_msg").hide();
            $("#error_msg").show();
            $("#error_msg").html(data.message);

          }
          //location.reload();
        }
    });
})



$(document).on('click','#user_register',function(){
  $("#success_msg").html('');
  $("#error_msg").html('');
  var senddata=$("#user_register_form").serializeArray();
    $.ajax({
        type:'POST',
        url :'<?php echo base_url('welcome/Index/login_register_1');?>',
        data:senddata,
        dataType:'json',
        encode:true,
        success:function(data){
          if(data.status){
            $("#success_msg").show();
            $("#error_msg").hide();
            $("#success_msg").html(data.message);
            $("#is_logged_in").val(data.is_logged_in);
            $("#user_id").val(data.user_id);
            $("#login_logout_div").html('<a href="<?php echo base_url();?>logout"><img src="<?php echo base_url();?>assets/frontend/images/register-icon.png" alt="icon">&nbsp;LOGOUT</a>');
            setTimeout(function(){$('#signup_login_modal').modal('hide');}, 1000);
            
          }
          else{
            $("#success_msg").hide();
            $("#error_msg").show();
            $("#error_msg").html(data.message);
            

          }
        }
    });
})
$(".sendcontactmessage").click(function(e){
	e.preventDefault();
	//$(".email_to").val($(this).data("email"));
	$("#contact_form").modal();
})
// debugger;
if (!(localStorage.getItem('firstVisit') === "1"))
{
	//debugger;
   $("#welcomeModal").modal(); 
   localStorage.setItem('firstVisit', '1');
} 


/* $("#back_cover_check").change(function(){
	if($(this).val() == "yes"){
		$(".back_cover_options").show();
	}else{
		$(".back_cover_options").hide();
	}
})
$("#front_cover_check").change(function(){
	if($(this).val() == "yes"){
		$(".front_cover_options").show();
	}else{
		$(".front_cover_options").hide();
	}
}) */

 $("#back_cover_check").change(function(){
	if($(this).val() == "no"){
		$(".back_cover_whole_options").hide();
	}else{
		$(".back_cover_whole_options").show();
	}
})
$("#front_cover_check").change(function(){
	if($(this).val() == "yes"){
		$(".front_cover_whole_options").show();
	}else{
		$(".front_cover_whole_options").hide();
	}
}) 


$(document).ready(function() {
      if($("#front_cover_check").val() == "yes"){
		$(".front_cover_whole_options").show();
	}else{
		$(".front_cover_whole_options").hide();
	}
	
	
		if($("#back_cover_check").val() == "no"){
		$(".back_cover_whole_options").hide();
	}else{
		$(".back_cover_whole_options").show();
	}
});


function blink_text() {
    $('.mgs p').fadeOut(500);
    $('.mgs p').fadeIn(500);
}
setInterval(blink_text, 5000);


$('input[type=radio][name=orientation-val]').change(function() {
	if(this.value == 'Portrait'){
		$(".portrait-options").show();
		$(".portrait-options option:first").prop('selected',true);
		$(".landscape-options").hide();
	}
	if(this.value == 'Landscape'){
		$(".landscape-options").show();
		$(".landscape-options option:first").prop('selected',true);
		$(".portrait-options").hide();
	}
})

/*$("input").on("keydown keyup change", function(){
    var value = $(this).val();
    if (value.length < minLength)
        $("span").text("Text is short");
    else if (value.length > maxLength)
        $("span").text("Text is long");
    else
        $("span").text("Text is valid");
});
*/
/*========================shakil=========================*/

/*
$('#no_pages').keyup(function(){
    var maxv=parseInt($('#no_pages').attr('max'));
      var textde='Maximum number of pages for 1-sided are '+ maxv;
      

  if ($(this).val() > maxv){
  $(".newerror").text(textde);
  $(this).val('');
  }
});


$('.get_input_new').on('change', function() {
    
    
        $("#no_pages p").empty();
          if(this.value === "1-sided"){
               $(".newerror").text('Maximum number of pages for 1-sided are 330');
                $("#no_pages").attr({ "max" : 330, "min" : 1});
                  $("#no_pages").val('1');
          }
               

    if(this.value==="2-sided"){
         $(".newerror").text('Maximum number of pages for 2-sided are 660');
          $("#no_pages").attr({ "max" : 660, "min" : 1});
          $("#no_pages").val('');
    }
    
    
    
    
});


$( document ).ready(function() {
     
            var page = $(".get_input_new.no_of_sides_coil option:selected").val();
             if(page ==="1-sided"){
             $("#no_pages").after('<p class="error newerror">Maximum number of pages for 1-sided are 330</p>');
            $("#no_pages").attr({ "max" : 330, "min" : 1});
             }
});*/

</script>


</body>
</html>