<?php
$lang_code = "";
if($this->session->userdata('site_lang') != "")
{
	$current_language = $this->session->userdata('site_lang');
	$a_lang = $this->config->item('lang_uri_abbr'); // new line
	//$lang_code = $this->uri->segment(1); // new line
	$lang_code = array_search($current_language, $a_lang); // new line
	$lang_code = $lang_code."/";
}
?>


<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="<?= base_url('assets/admin/images/logo.png');?>" alt="heading" style="width:100%"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php
			 if($this->session->flashdata('message')!= "")
			 {
			 ?>
			<label style="color:#FFFFEE;"><?=$this->session->flashdata('message');?></label>
			<?php
			 }
			?></p>

    <form action="<?= base_url()?>auth/login" method="post">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="E-mail" name="username" type="email" autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Password" name="password" type="password" value="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>


<div id="myModal1" class="modal fade" role="dialog">
<div class="modal-dialog">
 <button type="button" class="close" style="color:#ffff;" data-dismiss="modal">&times;</button>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="<?= base_url('assets/admin/images/logo.png');?>" alt="heading"></a>
  </div>
  <!-- /.login-logo -->
 <form action="<?= base_url()?>auth/forget_password" method="post">
  <div class="login-box-body">  
    <p class="login-box-msg">Forgot Password</p>
      <div class="form-group has-feedback">
        <input type="Email ID" class="form-control" name="user_email" id="user_email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>      
      <div class="row">
     
        <div class="col-xs-12">
          <button type="submit" class="btn-primary-forgot" id="forgotten_password">Submit</button>
        </div>
     
      </div>
  </div>
  </form>

  <!-- /.login-box-body -->
</div>
</div>
</div>
