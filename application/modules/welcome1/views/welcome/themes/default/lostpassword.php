<div class="theme-page padding-bottom-70">
	<div class="vc_row wpb_row vc_row-fluid gray full-width page-header vertical-align-table">
		<div class="vc_row wpb_row vc_inner vc_row-fluid full-width padding-top-bottom-50 vertical-align-cell">
			<div class="vc_row wpb_row vc_inner vc_row-fluid">
				<div class="page-header-left">
					<h1>MI CUENTA</h1>
				</div>
				<div class="page-header-right">
					<div class="bread-crumb-container">
						<label>ESTÁ AQUI:</label>
						<ul class="bread-crumb">
							<li><a href="<?= base_url();?>" title="Home">INICIO</a></li>
							<li class="separator">&#47;</li>
							<li>MI CUENTA</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<div class="woocommerce">
			<div class="vc_row wpb_row vc_row-fluid page-margin-top">
				<div class="vc_col-sm-12 wpb_column vc_column_container">
                <?php
				echo $gorget_code = end($this->uri->segments);
				if(!empty($error_message)){
				?>
                <div class="woocommerce-message"><?php echo $error_message;?></div>
                <?php } ?>
					<form method="post" class="lost_reset_password">
						<p>Perdiste tu contraseña? Favor ingrese su usuario o correo. Recibirá un enlace en su correo para crear una nueva contraseña.</p>

						<p class="form-row form-row-first"><label for="user_login">Usuario o Correo</label> <input class="input-text" type="text" name="user_email" id="user_login" /></p>
						
						<div class="clear"></div>

						<p class="form-row">
							<input type="hidden" name="wc_reset_password" value="true" />
							<input type="submit" name="forget_password" class="button" value="Restablecer contraseña" />
						</p>

						<!--<input type="hidden" id="_wpnonce" name="_wpnonce" value="f421a31c29" />
						<input type="hidden" name="_wp_http_referer" value="/my-account/lost-password/" />-->
					</form>
				</div>
			</div>
		</div><!--/.woocommerce-->
	</div>
</div>