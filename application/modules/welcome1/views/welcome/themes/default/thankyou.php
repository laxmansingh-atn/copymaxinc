<?php
require_once(APPPATH.'alignet/vpos_plugin.php');
//echo $this->config->item('alignet_private_crypto_key'); exit();
?>
<!--Content-box:Start-->
            <div class="home-content-box">
                <div class="container">
                   <div class="policy-common-wrapper">
                   		<div class="policy-pannel">
                   			<div class="plicy-common-header">
                   				<?= (get_current_language() == "en"?"Thank You":"Gracias");?>
                   			</div>
                   			<div class="policy-common-text-wrapper">
                   			
                   			<p>
                   			<?php
                   			$vector_id = $this->config->item('alignet_vector_id');
					$public_signature_key = $this->config->item('alignet_public_signature_key');
					$private_crypto_key = $this->config->item('alignet_private_crypto_key');
					if(isset($_POST['IDCOMMERCE']) && isset($_POST['IDCOMMERCE']) && isset($_POST['XMLRES']) && isset($_POST['DIGITALSIGN']) && isset($_POST['SESSIONKEY']))
							{
								$arrayIn['IDACQUIRER']	= $_POST['IDACQUIRER'];
								$arrayIn['IDCOMMERCE']	= $_POST['IDCOMMERCE'];
								$arrayIn['XMLRES']		= $_POST['XMLRES'];
								$arrayIn['DIGITALSIGN']	= $_POST['DIGITALSIGN'];
								$arrayIn['SESSIONKEY']	= $_POST['SESSIONKEY'];
								$arrayOut = '';
								if(VPOSResponse($arrayIn,$arrayOut,$llaveVPOSFirmaPub,$llaveComercioCryptoPriv,$vector))
								{
									echo "<pre>";print_r($arrayOut);echo "</pre>";
									$order_id = $arrayOut['purchaseOperationNumber'];

									if($arrayOut['errorCode'] == '00')
									{
										if(get_current_language() == "en")
										{
											$msg = "Thank you for choosing us. Your account has been charged and your transaction is successful. ";
										}
										else{
											$msg = "Gracias por elegirnos. Se ha cargado tu cuenta y tu transacci贸n se ha realizado correctamente.";
										}

										echo "<h1 style='text-align:center; color:#F00;'>".$msg."</h1>";

									}
									else
									{

										echo "<h1 style='text-align:center; color:#F00;'>".$arrayOut['errorMessage']."</h1>";
									}

								}
								else
								{
									echo "Error durante el proceso de interpretacion de la respuesta. ". "Verificar los componentes de seguridad: Vector Hexadecimal y Llaves.";
								}
							}
							else
							{
								echo "<h1 style='text-align:center; color:#F00;'>Unable To Load This Page....</h1>";
							}
                   			?>
                   			</p>
                   				
                   			</div>
                   		</div>
                   </div>


                </div>
            </div>
            <!--Content-box:End-->


            <!--background-video:Start-->
            <div class="settings">
                <div class="fillWidth settings-wrapper">
                    
                </video>
            </div> 
            <!--background-video:End-->
        </header>