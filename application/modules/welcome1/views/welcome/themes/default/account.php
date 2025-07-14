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
							<li><a href="../index.html" title="Home">INICIO</a>
							</li>
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
	<?php
    if(!$this->ion_auth->logged_in())
    {
		//echo $user_id;
	?>   
    <div class="vc_col-sm-12 wpb_column vc_column_container">
		<div class="col2-set" id="customer_login">
			<div class="col-1">
				<h2>Iniciar Sesion</h2>
				<form method="post" class="login">
                	<p>
                    <?php
					if($this->session->flashdata('message'))
					{
						echo "<div class='col-md-12 alert alert-danger'>".$this->session->flashdata("message")."</div>";
						//echo $this->session->flashdata('user_message');
					}
					?>
                    </p>
					<p class="form-row form-row-wide">
						<label for="username">Usuario o Correo <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="username" value="" required />
					</p>
					<p class="form-row form-row-wide">
						<label for="password">Contraseña <span class="required">*</span></label>
						<input class="input-text" type="password" name="password" id="password" required />
					</p>

					
					<p class="form-row">
						<!--<input type="hidden" id="_wpnonce" name="_wpnonce" value="2eb6926916" /><input type="hidden" name="_wp_http_referer" value="/my-account/" />-->				
                        <input type="submit" class="button" name="userlogin" value="Iniciar Sesion" />
						<label for="rememberme" class="inline">
							<input name="remember" type="checkbox" id="rememberme" value="Remember Me" /> Recordar Contrasena	</label>
					</p>
					<p class="lost_password">
						<a href="<?= base_url();?>my-account/lost-password/">Perdiste tu contrasena?</a>
					</p>

					
				</form>


			</div>

			<div class="col-2">
				<h2>Registrar</h2>
				<form action="" method="post" class="register">
                	<p>
                    <?php
                    if($this->session->flashdata('user_message'))
					{
						echo "<div class='col-md-12 alert alert-danger'>".$this->session->flashdata("user_message")."</div>";
						//echo $this->session->flashdata('user_message');
					}
					?>
					</p>
					<p class="form-row form-row-wide">
						<label for="reg_email">Correo <span class="required">*</span></label>
						<input type="email" class="input-text" name="email" id="reg_email" value="" required />
					</p>
					<p class="form-row form-row-wide">
						<label for="reg_password">Contraseña <span class="required">*</span></label>
						<input type="password" class="input-text" name="password" id="reg_password" required />
					</p>
					
					<!-- Spam Trap -->
					<div style="left: -999em; position: absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

								
					<p class="form-row">
						<!--<input type="hidden" id="_wpnonce" name="_wpnonce" value="56e65ec894" />
						<input type="hidden" name="_wp_http_referer" value="/my-account/" />-->				
						<input type="submit" class="button" name="userregister" value="Registrar" />
					</p>

					
				</form>

			</div>

		</div>

	</div>
	<?php
    }
	else
	{
		//print_r($user);
		//echo $user->email;
	?>
    <div class="vc_col-sm-12 wpb_column vc_column_container woocommerce_my_account">


<p class="myaccount_user">
	Hola <strong><?= $user->email;?></strong> (no eres <?= $user->email;?> ? <a href="<?= base_url();?>logout/">Desconectar sesión</a>). Desde tu cuenta puedes ver ordenes recientes, manejar tus direcciones de facturación y entrega y <a href="">editar tu contraseña y detalles de tu cuenta</a>.</p>





<h2>Mis Direcciones</h2>

<p class="myaccount_address">
	Direcciones que se usaran para finalizar sus compras.</p>

<div class="col2-set addresses">

	<div class="col-1 address">
		<header class="title">
			<h3>DIRECCIÓN DE FACTURACIÓN</h3>
			<a href="<?= base_url();?>my-account/billing-address/" class="edit">Editar</a>
		</header>
		<address>
			You have not set up this type of address yet.		</address>
	</div>


	<div class="col-2 address">
		<header class="title">
			<h3>DIRECCIÓN DE ENTREGA</h3>
			<a href="<?= base_url();?>my-account/shipping-address/" class="edit">Editar</a>
		</header>
		<address>
			You have not set up this type of address yet.		</address>
	</div>


</div>
				<div class="col-1 address billing_data">
		
				
				</div>
</div>
    <?php
	}
	?>
    
</div>
</div>
	</div>
</div>