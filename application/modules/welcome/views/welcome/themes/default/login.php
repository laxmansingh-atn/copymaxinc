

<div class="page_inner">

  <div class="container">

    <div class="row clearfix">

      <div class="col-md-4 col-sm-4">

	  

			

			<p><?php 

			if(validation_errors()){

			echo "<div class='col-md-12 alert alert-danger'>".validation_errors()."</div>"; 

      }
      else if($this->session->flashdata('message')){

        echo "<div class='col-md-12 alert alert-danger'>".$this->session->flashdata("message")."</div>";                
      }
      ?></p> 


      
      <p><div class='col-md-12 alert alert-danger'  style="display:none;" id="error_msg"></div></p> 
      

        
        <div class="login_form" style=<?= isset($signup_or_login_open) && ($signup_or_login_open !='signup')?"display:block;":"display:none;";?>>

          <form action="<?=base_url('login')?>" method="post">

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

              

              <button type="submit" class="submit_btn" name="user_login" style="cursor:pointer;">Login</button>

            </div>

            <div class="new_user">

              <ul>

                <li><a href="javascript:void(0);" class="register_account">Create a new account</a></li>

                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</a></li>

              </ul>

            </div>

          </form>

        </div>

		

		  <div class="register-box" style=<?= isset($signup_or_login_open) && ($signup_or_login_open =='signup')?"display:block;":"display:none;"?>>

              <h3>Register</h3>

               <form action="<?=base_url('login')?>" id="sign_up_form" method="post" class="register">

			    <div class="form-group">

                  <input type="text" class="form-control" placeholder="First name" name="f_name"  id="f_name" value="<?php echo set_value('f_name'); ?>" required>

                </div>

				 <div class="form-group">

                  <input type="text" class="form-control" placeholder="Last Name" name="l_name"  id="l_name" value="<?php echo set_value('l_name'); ?>" required>

                </div>

                <div class="form-group">

                  <input type="email" class="form-control" placeholder="Email Address" name="reg_email"  id="reg_email"  value="<?php echo set_value('reg_email'); ?>" required>

                </div>

				<div class="form-group">

                  <input type="text" class="form-control" placeholder="Contact Number" name="phone"  id="phone_no" value="<?php echo set_value('phone'); ?>"  required>

                </div>

                <div class="form-group">                      

                  <input type="password" class="form-control" placeholder="Password" name="reg_password" id="reg_password" required>

                </div>

                <div class="form-group">                             

                  <input type="password" class="form-control" name="reg_confirm_password" id="reg_confirm_password" required placeholder="Confirm Password">

                </div>

                <div class="form-group">

                   <input type="submit" class="submit_btn" id="sign_up_btn" name="user_register" value="Sign Up">

                </div>

				

				 <div class="new_user">

              <ul>

                <li><a href="javascript:void(0);" class="login_account">Login account</a></li>

             

              </ul>

            </div>

              </form>

            </div>

      </div>

      <div class="col-md-8 col-sm-8">

        <div class="login_share_ad">

          <h2>Can you believe people are still paying 50 cents for color copies in <?php echo date('Y'); ?>? Crazy! </h2>

          <h5>Help your friends save money: Tip them off about Copymax</h5>

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