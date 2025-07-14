<div class="about-us_section">
    <div class="container">
        <div class="about-us_section-inner">
        <div class="re-common-header">
            <!--<h3>LOGIN / REGISTER</h3>-->
            <h1 class="title-1">LOGIN / REGISTER</h1>
        </div>
              <div class="account-box">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"> 
            <!--Login:Start-->
            <p><?php                  
                if($this->session->flashdata('message')){
          echo "<div class='col-md-12 alert alert-info'>".$this->session->flashdata("message")."</div>";                
        
                }?></p>
        <p><?php 
        if(validation_errors()){
          echo "<div class='col-md-12 alert alert-danger'>".validation_errors()."</div>"; 
        }?></p> 
            <div class="login-box">
              <h3>LogIn</h3>
              <form method="post" class="login">
                <div class="form-group">
                  <input type="email" class="form-control" name="username" placeholder="Email Address" id="username" value="" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="" required>
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Remember me</label>
                    <a class="forget_pswrd" href="javascript:void(0);" data-toggle="modal" data-target="#forgotPasswordModal">Lost Your Password?</a> </div>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="user_login" Value="Login">
                </div>
              </form>
            </div>
            <!--Login:End--> 
          </div>
          <div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
            <div class="or-text"> <span>OR</span> </div>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"> 
            <!--Register:Start-->
            <div class="register-box">
              <h3>Register</h3>
               <form action="" method="post" class="register" onsubmit="password_match()">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email Address" name="reg_email"  id="reg_email" value="" required>
                </div>
                <div class="form-group">                      
                  <input type="password" class="form-control" placeholder="Password" name="reg_password" id="reg_password" value="" required>
                </div>
                <div class="form-group">                             
                  <input type="password" class="form-control" name="reg_confirm_password" id="reg_confirm_password" required placeholder="Confirm Password">
                </div>
                <div class="form-group">
                   <input type="submit" class="btn btn-primary" name="user_register" value="Sign Up">
                </div>
              </form>
            </div>
            <!--Register:End--> 
          </div>
        </div>
      </div>
    </div>
    </div>
 </div>
