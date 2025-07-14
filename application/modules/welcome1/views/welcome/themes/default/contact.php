<!-- Modal Section -->
  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Oxford International School</h4>
      </div>
      <div class="modal-body">
        <div class="cont-view-map">
		<div id="map1"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.6562570795536!2d-79.51432778579111!3d9.003742693538381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8faca8ef376c0b33%3A0x17b0feb9ef148039!2sOxford+International+School!5e0!3m2!1sen!2sin!4v1487229368502" width="570" height="425" frameborder="0" style="border:0" allowfullscreen></iframe></div>
	</div>
      </div>
    </div>
  </div>
</div>
 
 
 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Millenium kids </h4>
      </div>
      <div class="modal-body">
        <div class="cont-view-map">
  		<div id="map2"><iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1970.335749704759!2d-79.51625897627017!3d9.002343934808636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sCentro+Infantil+bilingue+Millenium+Kids!5e0!3m2!1sen!2sin!4v1487229850464" width="570" height="425" frameborder="0" style="border:0" allowfullscreen></iframe></div>
  	</div>
      </div>
    </div>
  </div>
</div>
  
<?php
//echo "<pre>"; print_r($banner_list); echo "</pre>";
foreach($banner_list as $key=>$banner_lists){
?>
<div class="common-paralax-section-wrapper">
	<img src="<?php echo base_url().$banner_lists->banner_image;?>" alt="paralax">
</div>
<?php
}
?>
<section class="breadcrumbs-bg">
  	<div class="container">
  		<div class="bread-crumbs-wrapper">
  			<ul>
  				<li>
  					<a href="<?= base_url();?>"><?= (get_current_language() == "en"?"Home":"Inicio");?></a>
  				</li>
  				<li>
  					<a href="#">
					<?php
					if($this->router->fetch_class() == "Contact")
					{
						if(get_current_language() == "en")
						{
					  		echo "Contact";
					  	}
					  	else
					  	{
					  		echo "Contáctanos";
					  	}
					}
					?>
					</a>
  				</li>
  				<!--<li>
  					<?= ucwords(safe_str_replace("_"," ",$this->router->fetch_method()));?>
  				</li>-->
  			</ul>
  		</div>
  	</div>
  </section>
 <!--<div class="common-paralax-section-wrapper">
  	<img src="images/pay-paralax-bg123.jpg" alt="paralax">
 </div>-->
  
  <!-- Page Header Main -->
  <div class="common-header-main-wrapper">
  	<div class="container">
		<div class="common-main-page-header">
			<?= (get_current_language()=="en"?"Contact Us":"Contáctenos");?>
		</div>
		<div class="common-main-page-header-strip"></div>
	</div>
  </div>
  <!-- Page Header Main End -->
  
  
  
  <!-- Page Main Body Section -->
  <div class="about-section-wrapper">
  	<div class="container">
  		<div class="contact-area-section">
  			<ul>
  				<li>
  					<div class="contact-area-wrapper">
  						<div class="contact-common-heading">
  							Oxford International School
  						</div>
  						<div class="contact-common-content">
  							The School is centrally located at 74th EAST Street and Via España, Carrasquilla, Panama City, Panama
  						</div>
  						<div class="contact-common-content">
  							<table class="contact-page-wrapper-table">
  								<tbody>
  									<tr>
  										<td><i class="fa fa-phone" aria-hidden="true"></i>
</td>
  										<td>(507) 308-7100</td>
  									</tr>
  									<tr>
  										<td><i class="fa fa-fax" aria-hidden="true"></i>

</td>
  										<td>(507) 308-7144</td>
  									</tr>
  									<tr>
  										<td><i class="fa fa-envelope-o" aria-hidden="true"></i>

</td>
  										<td>oxford@ois.edu.pa </td>
  									</tr>
  									<tr>
  										<td>

</td>
  										<td><a href="" class="animated contact-view-marp" data-toggle="modal" data-target="#myModal1">View Map</a></td>
  									</tr>
  								</tbody>
  							</table>
  						</div>
  						
  					</div>
  				</li>
  				<li>
  					
  					<div class="contact-area-wrapper">
  						<div class="contact-common-heading">
  							Millenium kids
  						</div>
  						<div class="contact-common-content">
  							<!--Francisco Gómez S8-56 y Mariano Reyes (Villa Flora)-->
  						</div>
  						<div class="contact-common-content">
  							<table class="contact-page-wrapper-table">
  								<tbody>
  									<tr>
  										<td><i class="fa fa-phone" aria-hidden="true"></i>
</td>

  										<td>(593 2) 2666 854 / 2666 860 / 2666 857</td>
  									</tr>
  									<tr>
  										<td>

</td>
  										<td><a href="" class="animated contact-view-marp" data-toggle="modal" data-target="#myModal2">View Map</a></td>
  									</tr>
  								</tbody>
  							</table>
  						</div>
  						
  					</div>
  				</li>
  			</ul>
  		</div>
  	</div>
  </div>
  <!-- Page Main Body Section End -->