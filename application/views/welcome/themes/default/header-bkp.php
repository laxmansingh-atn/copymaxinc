<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Copy Max Inc</title>
<link href="<?php echo base_url();?>assets/frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/bootstrap-select.min.css" />
<link href="<?php echo base_url();?>assets/frontend/css/style.css?asasa" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/frontend/css/stellarnav.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/frontend/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/frontend/css/responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<script src="<?php echo base_url();?>assets/frontend/js/jquery-3.2.1.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154761696-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154761696-1');
</script>
 
</head>

<body>
<header>
  <div class="header_top">
    <div class="header_top_inner clearfix">
      <div class="login_part">
        <ul>
          <!--<li><a href="#"><img src="<?php echo base_url();?>assets/frontend/images/register-icon.png" alt="icon">&nbsp;Register</a></li>
          <li><a href="#"><img src="<?php echo base_url();?>assets/frontend/images/wishlist-icon.png" alt="icon">&nbsp;Wishlist</a></li>-->
		    
          <li id="login_logout_div">
		  <?php if($this->ion_auth->logged_in()){?>
		  <a href="<?php echo base_url();?>logout"><img src="<?php echo base_url();?>assets/frontend/images/register-icon.png" alt="icon">&nbsp;LOGOUT</a>
		 
		  <?php } else {?>
		   <a href="<?php echo base_url();?>login"><img src="<?php echo base_url();?>assets/frontend/images/login-icon.png" alt="icon">&nbsp;Login/Register</a>
		  <?php } ?>
		  </li>
		  <?php if($this->ion_auth->logged_in()){ ?>
      <li><a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/frontend/images/register-icon.png" alt="icon">&nbsp;My Account <i class="fa fa-caret-down" aria-hidden="true"></i></a>
        <ul>
          <li><a href="<?php echo base_url('editprofile');?>">Edit Profile</a></li>
          <li><a href="<?php echo base_url('manage-addresses');?>">Manage Address</a></li>
        </ul>
    </li>
		  
		  <li><a href="<?php echo base_url('orderlist');?>"><img src="<?php echo base_url();?>assets/frontend/images/wishlist-icon.png" alt="icon">&nbsp;Order list</a></li>
		   <?php } ?>
        </ul>
      </div>
      <div class="contact_part">
        <ul>
          <li><a href="tel:1-800 DAYCOPY (329.2679)"> <img src="<?php echo base_url();?>assets/frontend/images/call-icon.png" alt="icon"> <span>Call Us On:</span> 1-844-Copymax (2679629)</a> </li>
          <li><a href="<?=base_url('cart')?>"> <img src="<?php echo base_url();?>assets/frontend/images/cart-icon.png" alt="cart_icon"> <span>Shopping Cart:</span> <?=count($this->cart->contents())?></a> </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="header_btm">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-3 col-sm-3 col-xs-4 padRight0">
          <div class="logo"> <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/frontend/images/logo_1.png" alt="logo"></a> </div>
        </div>
        <div class="col-md-3 col-sm-9 col-xs-8 pull-right">
          <div class="header_search">
            <form action="<?php echo base_url(); ?>welcome/index/search_product_frm" id="search_product_frm" name="search_product_frm" method="POST">
              <input type="text"  name="search_product_txt" value="<?php echo set_value('search_product_txt');?>" placeholder="Search">
              <button type="submit"  value="">Search</button>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div id="main-nav" class="stellarnav">
            <ul>
              <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
              <li><a href="<?php echo base_url();?>cms_page/about-us">About Us</a></li>
              <li class="drop-left"><a href="<?php echo base_url();?>cms_page/services">Services</a> 
               <!--  <ul>
                    <li><a href="#">How deep?</a>
                      <ul>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                  </ul> --> 
              </li>
              <li><a href="<?php echo base_url();?>our-products">Our Products</a></li>
              <li><a href="<?php echo base_url();?>cms_page/portfolio">Portfolio</a></li>
              <li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
            </ul>
          </div>
          <!-- .stellar-nav --> 
        </div>
      </div>
    </div>
  </div>
    
    <?php if($this->session->flashdata('success_message_newsletter')){?>
        <div id="update_msg" class="col-md-12 alert alert-success"><?= $this->session->flashdata('success_message_newsletter');?></div>
    <?php } ?>
	<?php if($this->session->flashdata('success_message')){?>        <div id="update_msg" class="col-md-12 alert alert-success text-center"><?= $this->session->flashdata('success_message');?></div>    <?php } ?>	 <?php if($this->session->flashdata('error_message')){?>        <div id="update_msg" class="col-md-12 alert alert-error text-center"><?= $this->session->flashdata('error_message');?></div>    <?php } ?>
</header>

    

<div id="forgotPasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="address_title">Forgot Password</h4>
        </div>
        <div class="modal-body" id="address_details">               

        <form method="post" action="<?php echo base_url('lost-password'); ?>">
          <div class="form-group">
              <input type="email" class="form-control input-sm" placeholder="Email Address" name="user_email" id="user_email" required/>
          </div>
          <div class="form-group">                                              
              <input type="hidden" name="wc_reset_password" value="true" />                                                  
              <input type="submit" class="btn btn-primary" name="forget_password" value="Submit">
          </div>
        </form>
      
        </div>
        <div class="modal-footer">          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <div class="clearfix"></div>
      </div>

    </div>
  </div>