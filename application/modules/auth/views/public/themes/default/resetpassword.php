<div id="myModal1" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="<?= base_url('assets/admin/images/logo.png');?>" alt="heading"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   <form action="<?= base_url()?>auth/reset_password" method="post">
    <p class="login-box-msg">Reset Password</p>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_1" placeholder="Set password">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div> 

<p class="login-box-msg">Confirm Password</p>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password_2" placeholder="Set password">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div> 	  
      <div class="row">
     
        <div class="col-xs-12">
          <button type="submit" class="btn-primary-forgot" name="reset_password">Submit</button>
        </div>
     
      </div>
   
</form>
  </div>
  <!-- /.login-box-body -->
</div>
</div>
</div>