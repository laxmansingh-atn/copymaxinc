<div class="mid_section">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-3 col-sm-4">
        <div class="left_sidebar">
          <div class="category_list">
            
            <div class="category_list_box">

              <ul>
                  <?php
                        
                      foreach($productlist as $key=>$productlists){
                         
                        if(in_array($productlists->product_id,[114,112,137,116,117,119])){ ?>
                          <li><a href="<?php echo base_url() .'product-details/'.$productlists->product_slug ;?>"><?php echo $productlists->product_name;?></a></li>
                        <?php } else{ ?>
                          <li><a href="javascript:void(0);" data-toggle="modal" data-target="#product_info_modal"><?php echo $productlists->product_name;?></a></li>

                        <?php } }?>
                <!-- <li><a href="#">Brochure</a></li>
                <li><a href="#">Business Cards</a></li>
                <li><a href="#">Postcards</a></li>
                <li><a href="#">Envelopes</a></li>
                <li><a href="#">Letterhead</a></li>
                <li><a href="#">Brochure</a></li>
                <li><a href="#">Mini Poster</a></li>
                <li><a href="#">Spiral Bound Booklets</a></li>
                <li><a href="#">Perfect Bound Bokklet</a></li>
                <li><a href="#">Saddle Stitched Booklets</a></li> -->
              </ul>
            </div>
          </div>
          <div class="get_quote">
            <div class="quote_text">
              <h2>Rush service available, call for details<span>1-844-267-9629</span></h2>
              </div>
           </div>
        </div>
      </div>
      <div class="col-md-9 col-sm-8">
        <div class="right_panel">
          <div class="product_list">
            <div class="row clearfix">
              <?php foreach($productlist as $key=>$productlists) { ?>
                  
                  <?php   if(in_array($productlists->product_id,[114,112,137,116,117,119,135])){ ?>      
                      <div class="col-sm-3">
                        <div class="p_box">
						
							<?php 
							if(in_array($productlists->product_id, [135])){
								$url = base_url('uploads/products/Car Wraps New.png');//.'/'.$productlists->product_image;
							}else{
								$url = base_url() .'product-details/'.$productlists->product_slug ;
							}
							?>
                          <a onclick="return gtag_report_conversion('<?php echo $url?>');" href="<?php echo $url?>">
                          <div class="imgtxt">
                              <!--<div class="product_label">Please call for details</div>-->
                          <img onclick="return gtag_report_conversion('<?=base_url('uploads/products').'/'.$productlists->product_image;?>')" src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>"> 
                          <div class="imgbtn">
                            <!-- <img src="<//?=base_url('images/btn.png')?>"> -->
                            click for pricing
                          </div>
                          </div>   
                            <div class="pbxcontent"><?= $productlists->product_name;?></div>
                          </a>
                         
                        </div>
                      </div>
                      

                  <?php } else{ 
                    
							if(in_array($productlists->product_id, [135])){
								$url = base_url('uploads/products/Car Wraps New.png');//.'/'.$productlists->product_image;
							}else{
								$url = base_url() .'product-details/'.$productlists->product_slug ;
							}
							
                  ?>
                      
                    <div class="col-sm-3 ">
                        <div class="p_box">
                          <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#product_info_modal">-->
                          <a onclick="return gtag_report_conversion('<?php echo $url?>');" href="<?php echo $url?>">
                          <div class="imgtxt">
                              <div class="product_label">Please call for details</div>
                          <img src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>"> 
                          <div class="imgbtn">
                            <!-- <img src="<//?=base_url('images/btn.png')?>"> -->
                            click for pricing
                          </div>
                          </div>   
                            <div class="pbxcontent"><?= $productlists->product_name;?></div>
                          </a>
                         
                        </div>
                      </div>
                    
                  <?php } ?> 
                
              <?php } ?>  
                   
              </div>
            
          </div>
          <div class="welcome_section">
            <h2> <span>Welcome to </span> Copymax Inc.</h2>
              <p>

					We are a family owned and operated company committed to making your online copy & print ordering experience as easy as possible, providing you with best possible customer service, quality and price. Copymax Inc. provides many online services such as newsletter printing, booklets, manuals, reports, binders, flyers, envelopes, banners, signs, magnets, all kind of retractable banner stands......... at locally and nationally competitive prices. We have very knowledgeable customer service representatives who can guide you through basic printing questions and help you to design and create any custom printed products.

              
              </p>
              <p>
                We use highest quality Digital and Offset printing, we will ship directly to any location in the United States & offer Free UPS shipping & Free Delivery anywhere in San Diego or L.A. county with minimum order. Our website was designed to make printing online convenient, quick, and complete with helpful, personal support. You will find that our prices (even after shipping) will beat all your local printers. Just check our prices and our services.
              </p>

           <!--   <p>
                Here at  San Diego Copies/Prints we take the headache and hassle out of your printing needs and let you focus on your business plus we will save you tons of money. We are specialized in black and white & color copying & printing, from a single flayer to newsletters, programs, memos, reports, forms.....Basically we are your one stop source for all your copying & printing needs from manuals to binders with or without tabs, 3 hole punched, stapled or bound, the sky is the limit. On the top of all of that our prices are out of this planet, $0.025 per copy, lowest price Online, period. 
                
                 We use latest technology Xerox laser equipment such as Documented 6135, 6180 and Nu-Vera with 600 dip which is perfect for line and text copies plus your images and graphics will look good enough but if you want your images and graphics to look picture quality you should use our “Enhanced black printers” with 2400 dip. 
                We use latest technology Xerox laser equipment for <a href="<?=base_url('product-details/black-white-copies')?>">Black & White</a> and <a href="<?=base_url('product-details/color-copies')?>">Color Prints</a> and we are very confident you will love the quality of our work.Our Black & White printers are good for line and text documents and your graphics and images will come out good enough but if you want your images and graphics to be picture quality you may want to use our <a href="<?=base_url('product-details/enhanced-black-white-copies')?>">Enhanced Black and White</a> printers.
              </p>-->
              
              <p>Here at Copymax Inc. we take the headache and hassle out of your printing needs and let you focus on your business plus we will save you tons of money.<br>We are specialized in black and white & color printing from a single flyer to newsletters, programs, memos, reports, forms.....Basically we are your one stop source for all your copying & printing needs from manuals to binders with or without tabs, 3 hole punched, stapled or bound, the sky is the limit.<b> On the top of all of that our prices are out of this world, Black & White prints with no minimum starting at $0.025 as low as $.013 lowest price Online, period.</b> We use latest technology Xerox laser equipment for <a href="<?=base_url('product-details/black-white-copies')?>">Black & White</a> and <a href="<?=base_url('product-details/color-copies')?>">Color Prints</a> and we are very confident you will love the quality of our work. Our Black & White printers are good for line and 
				text documents and your graphics and images will come out good enough but if you want your images and graphics to be picture quality you may want to use our <a href="<?=base_url('product-details/enhanced-black-white-copies')?>"> Enhanced 
				Black and White</a> printers.
</p>

              <p>
                All orders will ship or have to be picked up at Copymax Inc. located at:
                <p>802 North twin oaks valley road</p> 
                <p>STE 108</p>
                <p>San Marcos, CA 92069</p>
              </p>
              <p><b>We truly appreciate your business and looking forward to working with you on all your projects.</b></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>