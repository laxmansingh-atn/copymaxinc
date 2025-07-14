<style>
.page_inner p {
    color: #666;
    font-size: 12px;
    line-height: 1.7;
    margin: 0;
    color: red;
}    
</style>
<div class="page_inner">

  <div class="container">

    <div class="row clearfix">

    <br>

    <?php if($this->session->flashdata('update_message_success')){?>
        <div id="update_msg" class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message_success');?></div>
    <?php } ?>
    <?php if($this->session->flashdata('update_message_error')){?>
        <div id="update_msg" class="col-md-12 alert alert-danger"><?= $this->session->flashdata('update_message_error');?></div>
    <?php } ?>
    <div class="col-md-10 col-md-offset-1">

  		<!--<div class="col-md-3">



      <div class="text-center upload_img">

        <img src="images/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">

        <h6>Upload a different photo...</h6>

        <input type="file" class="text-center center-block file-upload">

      </div>

 

        </div> -->

		

    	<div class="col-md-10 col-md-offset-1">

            <div class="profile_form">

                  <form class="form" action="<?=base_url('editprofile')?>" method="post">

                     <div class="row clearfix">

                     <div class="col-md-12">

                     	<div class="personal_info">

                     		<h3>Personal Info</h3>

                     	</div>

                     </div>

                      <div class="col-md-6"> 

                          <div class="form-group">

                              <label>First name</label>

                              <input class="form-control" placeholder="First name" name="f_name" value="<?=$users_data[0]['first_name']?>">
                              <span style="color:red;"><?php echo form_error('f_name'); ?></span> 
                          </div>

                      </div>

                      <div class="col-md-6"> 

                          <div class="form-group">

                            <label>Last name</label>

                              <input class="form-control" placeholder="Last name" name="l_name" value="<?=$users_data[0]['last_name']?>">

                          </div>

                      </div>

          

                      <div class="col-md-6"> 

                          <div class="form-group">

                              <label for="phone">Phone</label>

                              <input class="form-control" placeholder="Enter phone" name="phone_tel_no" value="<?=$users_data[0]['phone_tel_no']?>">

                          </div>

                      </div>

          

                      <div class="col-md-6">

                          <div class="form-group">

                             <label>Mobile</label>

                              <input class="form-control" placeholder="Enter mobile number" name="mobile" value="<?=$users_data[0]['phone']?>">

                          </div>

                      </div>

                      <div class="col-md-6">

                          <div class="form-group">

                              <label>Email</label>

                              <input class="form-control" placeholder="you@email.com" name="reg_mail" readonly value="<?=$users_data[0]['email']?>">

                          </div>

                      </div>

                      <!--<div class="col-md-6">  

                          <div class="form-group">

                              <label>Location</label>

                              <input class="form-control" placeholder="somewhere">

                          </div>

                      </div>-->
                    
                    
                    
                    <div id="change_password_div" style="display:none;">
                        <div class="col-md-6">

                          <div class="form-group">

                              <label>Existing Password</label>

                              <input type="password" class="form-control" placeholder="Enter your password" name="old_password" >

                          </div>

                      </div>

                      <div class="col-md-6">

                          <div class="form-group">

                              <label>New Password</label>

                              <input type="password" class="form-control" placeholder="Enter your password" name="new_password">
                               <span style="color:red;"><?php echo form_error('password'); ?></span> 
                          </div>

                      </div>

                      <div class="col-md-6"> 

                          <div class="form-group">

                            <label>Confirm Password</label>

                              <input type="password" class="form-control" placeholder="Enter your password" name="confirm_password">
                              <span style="color:red;"><?php echo form_error('confirm_password'); ?></span> 
                          </div>

                      </div>
                    </div>
                        
                        
                      <div class="col-md-12">

                           <div class="form-group  pull-right">

                            <button class="btn btn-sm btn-primary" id="change_password" name="change_password" type="button"> Change Password</button>

							</div>

                      </div>
                      
                      <div class="col-md-12">

                           <div class="form-group">

                            <button class="btn btn-sm btn-success" name="save changes" type="submit" value="save changes"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;Update Profile</button>

							

                             <!--<button class="btn btn-sm btn-default" type="reset"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;RESET</button>-->

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
<script>
$("#change_password").on('click',function(){
    
    $("#change_password_div").toggle();
    
})


</script>
</script>