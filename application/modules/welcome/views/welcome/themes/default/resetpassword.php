<!--Body-part:Start-->
<section id="body-container" class="body-container animatedParent"> 
  <!--category-part:Start-->
  <section id="home-slider-cat-box" class="inner-slide-and-cat-box">
    <div class="container"> 
      
      <!--Heading:Start-->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="inner-heading-box">
            <h1 class="title-1 text-center">Reset password</h1>
          </div>
        </div>
      </div>
      <!--Heading:Start--> 
      
      <!--Login-part:Start-->
      <p><?php  
      if($this->session->flashdata('message')){
          echo "<div class='col-md-12 alert alert-info'>".$this->session->flashdata("message")."</div>";                
      }?></p>
      <p><?php 
      if(validation_errors()){
          echo "<div class='col-md-12 alert alert-danger'>".validation_errors()."</div>"; 
      }?></p>                   
      <div class="account-box">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"> 
            <!--Login:Start-->
            <div class="login-box">
              <h3>Reset Password</h3><?php
				if($this->session->flashdata('reset_message')){?>
                	<div class="woocommerce-message"><?php echo $this->session->flashdata('reset_message');?></div><?php
				}?>
                <form method="post" class="lost_reset_password login" action="<?php echo base_url('my-account/reset-password/'.$code);?>">
												                        
                    <div class="form-group">
                        <label for="password_1">New Password<span class="required">*</span></label>
                        <input type="password" class="form-control" name="password_1" id="password_1" required/>
                     </div>
                     <div class="form-group">
                        <label for="password_2">Confirm Password<span class="required">*</span></label>
                        <input type="password" class="form-control" name="password_2" id="password_2" required/>
                    </div>
            
                    <!--<input type="hidden" name="reset_key" value="jpk25nfluojLXRauH9D6" />
                    <input type="hidden" name="reset_login" value="arghya.saha" />-->
                
                    <div class="clear"></div>
            
                    <p class="form-row">
                        <input type="hidden" name="wc_reset_password" value="true" />
                        <input type="submit" name="reset_password" class="btn btn-primary" value="Save" />
                    </p>
                    <!--<input type="hidden" id="_wpnonce" name="_wpnonce" value="851c339899" /><input type="hidden" name="_wp_http_referer" value="" />-->
                </form>



            </div>
            <!--Login:End--> 
          </div>
         
        </div>
      </div>
      <!--Login-part:Start--> 
      
    </div>
  </section>
  <!--category-part:End--> 