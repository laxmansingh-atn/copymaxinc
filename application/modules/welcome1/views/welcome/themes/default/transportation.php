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
					if($this->router->fetch_class() == "Resources")
					{
						if(get_current_language() == "en")
						{
					  		echo "Resources";
					  	}
					  	else
					  	{
					  		echo "Recursos";
					  	}
					}
					?>
					</a>
  				</li>
  				<li>
  					<?= $page_content[0]['page_title'];?>
  				</li>
  			</ul>
  		</div>
  	</div>
  </section>
  <!-- Page Header Main -->
  <div class="common-header-main-wrapper">
  	<div class="container">
		<div class="common-main-page-header">
			<?= $page_content[0]['page_title'];?>
		</div>
		<div class="common-main-page-header-strip"></div>
	</div>
  </div>
  <!-- Page Header Main End -->
  
  
 
  
  <div class="container">
  	<div class="kids-page-wrapper">
  		
  		
  		<div class="kids-page-text-content">
  			<ul>
				<?= $page_content[0]['page_content'];?>
  			</ul>
  		</div>
  		
  	</div>
  </div>