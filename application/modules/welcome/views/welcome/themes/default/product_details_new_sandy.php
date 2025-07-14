<div class="page_inner prod-tab-page">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-12">
		  <div class="col-md-12 col-sm-12">
		  <div class="pricetable">
        
      <table class="table table-bordered"> 
      <?php if($this->uri->segment(2) == 'black-and-white') {?>  
      <span style="font-weight:bold;">BLACK & WHITE COPIES, 20LB PAPER, NO BLEED</span> 
		<tbody> 
			<tr> 
			<th>Pages</th>
			<td>Prices</td> 
			<td>Pages</td> 
			<td>Prices</td> 
			</tr> 
			<tr> 
			<td>1</td> 
			<td>2.5c</td> 
			<td>50,000</td> 
			<td>1.8c</td> 
			</tr> 
			<tr> 
			<td>30,000</td> 
			<td>2c</td> 
			<td>100,000</td> 
			<td>1.65c</td> 
			</tr> 
        </tbody>
        <?php }elseif( $this->uri->segment(2) == 'enhanced-black-and-white'){ ?>
        <span style="font-weight:bold;">ENHANCED BLACK & WHITE COPIES, 20LB PAPER, NO BLEED</span> 
				<tbody> 
				<tr> 
				<th>Pages</th> 
				<td>Prices</td> 
				<td>Pages</td> 
				<td>Prices</td> 
				</tr> 
				<tr> 
				<td>1</td> 
				<td>2.5c</td> 
				<td>50,000</td> 
				<td>1.8c</td> 
				</tr> 
				<tr> 
				<td>30,000</td> 
				<td>2c</td> 
				<td>100,000</td> 
				<td>1.65c</td> 
				</tr> 
        </tbody>
      
        <?php }elseif($this->uri->segment(2) == 'color-copies'){ ?>
        <span style="font-weight:bold;">COLOR COPIES, 20LB PAPER, NO BLEED</span> 
				<tbody> 
				<tr> 
				<th>Pages</th> 
				<td>Prices</td> 
				<td>Pages</td> 
				<td>Prices</td> 
				</tr> 
				<tr> 
				<td>100</td> 
				<td>24c</td> 
				<td>2,500</td> 
				<td>7c</td> 
				</tr> 
				<tr> 
				<td>1,000</td> 
				<td>8c</td> 
				<td>10,000</td> 
				<td>6c</td> 
				</tr> 
        </tbody>
      <?php } ?> 
				</table>
		  </div>
		  	<div class="product_left_tab">
		  		<!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#producttab" aria-controls="home" role="tab" data-toggle="tab">Product</a></li>
					<li role="presentation"><a href="#faqtab" aria-controls="profile" role="tab" data-toggle="tab">FAQ’s</a></li>
					<li role="presentation"><a href="#spectab" aria-controls="messages" role="tab" data-toggle="tab">Specs & Templates</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="producttab">
						<?php if(isset($product_data['product'])){ echo $product_data['product'];}?>
					</div>
					<div role="tabpanel" class="tab-pane" id="faqtab">
						<?php if(isset($product_data['faq'])){ echo $product_data['faq'];}?>
					</div>
					<div role="tabpanel" class="tab-pane" id="spectab">
						<?php if(isset($product_data['specs_templates'])){ echo $product_data['specs_templates'];}?>
					</div>
				  </div>
		  	</div>
		  </div>
        <div class="col-md-12 col-sm-12">
          <div class="assistance_req">
            <h2>Do you require assistance?</h2>
            <ul>
              <li> <img src="<?php echo base_url();?>assets/frontend/images/call-icon-sm.png" alt="icon"> Call For Assistance : <a href="tel:18442679629">1-844-267-9629</a> </li>
              <li> <img src="<?php echo base_url();?>assets/frontend/images/envelope.png" alt="icon"> Email For Assistance : <a href="mailto:sales@copymaxinc.com?bcc=copymaxinc@gmail.com" data-email="sales@copymaxinc.com" class="sendcontactmessage">sales@copymaxinc.com</a> </li>
              <li> <img src="<?php echo base_url();?>assets/frontend/images/clock.png" alt="icon"> Phone Business <span>Hours Mon - Fri 8:30 AM - 5:30 PM PST</span> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-sm-12">
        <div class="mid_body_all clearfix">
          <!-- <div class="col-md-12 col-sm-12">
            <div class="order_color">
              <h2> <?= $product_data[0]['product_name'];?></a> </h2>
              <div class="row clearfix">
                <div class="col-md-6">
                  <div class="order_image"><img src="<?=base_url('uploads/products').'/'.$product_data[0]['product_image'];?>" alt=""></div>
                </div>
                <div class="col-md-6">
                  <div class="order_text">
                    <?//= $product_data[0]['description'];?>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-md-12 col-sm-12 pull-right">
            
            <div class="get_your_color">
            
              <?php if($this->uri->segment(2) == 'black-and-white') {?>    
                <h2 class="getcolor" style="font-weight:bold;">GET YOUR INSTANT PRICE QUOTE ON BLACK & WHITE COPIES ONLINE :</h2>
              <?php }elseif( $this->uri->segment(2) == 'enhanced-black-and-white'){ ?>  
                <h2 class="getcolor" style="font-weight:bold;">GET YOUR INSTANT PRICE QUOTE ON ENHANCED BLACK & WHITE COPIES ONLINE :</h2>
              <?php }elseif($this->uri->segment(2) == 'color-copies'){ ?>
                  <h2 class="getcolor" style="font-weight:bold;">GET YOUR INSTANT PRICE QUOTE ON COLOR COPIES ONLINE :</h2>
              <?php } ?>
              <?php if(in_array($product_data['product_id'],[117])){ ?> 
				<div class="printing_options">
                <div class="print_opt_box">
				<?php if(in_array($product_data['product_id'],[116,117])){ ?>	
					  <h3 class="text-center"><?php echo $product_data['product_name']; ?></h3>
				<?php }else{ ?>
					  <h3>PRINTING OPTIONS</h3>
				<?php } ?>
                
                    <div class="row">
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong> How many copies would you like?</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <input type="number"  min="1" pattern="[0-9]*" value="1" id="no_copies" class="form-control get_input_new">
                              </div>
                          </div>
                      </div>
					</div>
					  <div class="opt_sel clearfix show_div">
						  <div class="col-md-5">
							  <label class="left_pan_taxt"><strong>Orientation</strong></label>
						  </div>
						  <div class="col-md-7">
							  <div class="input_fld">
								<input type="radio" checked name="orientation-val" value="Portrait" class = "get_input_new">&nbsp;<img src="<?=base_url()?>assets/frontend/images/portrait.png">&nbsp;Portrait
								<input type="radio" name="orientation-val" value="Landscape" class = "get_input_new">&nbsp;<img src="<?=base_url()?>assets/frontend/images/landscape.png">&nbsp;Landscape&nbsp;&nbsp;
								 
							  </div>
						  </div>
					  </div>
					<div class="opt_sel clearfix">
					  <div class="col-md-5">
						  <label class="left_pan_taxt"><strong>Dimensions</strong></label>
					  </div>

					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="dimensions" class="dimension-options get_input_new">
									 <optgroup label="Portrait options:" class="portrait-options" style="font-weight:bold;color: white;background: #1660a8;">
								<?php foreach($get_dimensions as $dimention){
									if($product_data['product_id'] == 117){
									if(!empty($dimention['dimension'])){ ?>
										
										<option value="<?php echo $dimention['dimension'] ;?>" <?php if($dimention['dimension'] == "8.5x11"){echo "selected";} ?>> <?php echo $dimention['dimension']; ?></option>
										
									<?php }}else{
										if(!empty($dimention['dimension'])){?>
											
											<option value="<?php echo $dimention['dimension'] ;?>"> <?php echo $dimention['dimension']; ?></option>
											
										<?php }
										
									}?>
								<?php }  ?>
								</optgroup> 
								<optgroup label="Landscape options:" class="landscape-options" style="display:none;font-weight:bold;color: white;background: #1660a8;">
								<?php foreach($get_dimensions as $dimention){
										if(!empty($dimention['dimension'])){									
											$str_reversed = implode("x",array_reverse(explode("x",$dimention['dimension'])));
									?>
									 
									 <option value="<?php echo $str_reversed ;?>"> <?php echo $str_reversed; ?></option>
								<?php }}  ?>
								</optgroup> 
							  </select>
						  </div>
					  </div>
					</div>
					<h3>Inside pages only (No covers)</h3>
				    <div class="opt_sel clearfix">
					  <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>How many pages?</strong></label>
                      </div>
					  <div class="col-md-7">
						<div class="input_fld">
						  <input type="number"  min="1" pattern="[0-9]*" value="1" id="no_pages" class="form-control get_input_new">
						</div>
					  </div>
					</div>
					<div class="opt_sel clearfix" <?php if(in_array($product_data['product_id'],[116])){ echo 'style="display:none;"'; } ?>>
					  <div class="col-md-5">
						  <label class="left_pan_taxt"><strong>Number Of Sides</strong></label>
					  </div>
					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="" class="get_input_new no_of_sides_coil">
								  <option value="1-sided">1-sided</option>
								  <option value="2-sided">2-sided</option>
							  </select>
						  </div>
					  </div>
					</div>
					<div class="opt_sel clearfix">
					  <div class="col-md-5">
						  <label class="left_pan_taxt"><strong>Color Type</strong></label>
					  </div>
					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="" class="get_input_new color_coil">
								  <option value="color">Color</option>
								  <option value="black-ink" selected>Black Ink</option>
							  </select>
						  </div>
					  </div>
					</div>
					
					
					<div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Paper Type</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_printing_option1" class="get_input_new">
                                      <?php $paper_type_id=0?>
                                      <?php if(!empty($paper_type)): foreach($paper_type as $paper):?>
                                        <optgroup class="<?php echo $paper['attr_value']?>" label="<?php echo $paper['attr_value']?>" style="font-weight:bold;color: white;background: #1660a8;">
                                            <?php if(!empty($paper['sub_type'])): foreach($paper['sub_type'] as $sub):?>
                                                <?php if($i==0):?>
                                                    <?php $paper_type_id = $sub['id']?>
                                                <?php endif?>
                                                <option value="<?php echo $sub['attr_value']?>" data-id="<?php echo $sub['id']?>"><?php echo $sub['attr_value']?></option>
                                            <?php $i++; endforeach; endif?>
                                        </optgroup>
                                      <?php endforeach; endif?>
                                  </select>
                                  <input type="hidden" id="paper_type_id" value="<?php echo $paper_type_id?>" >
                              </div>
                          </div>
				  </div>
					<div class="opt_sel clearfix">
						<div class="col-md-5">
							<label class="left_pan_taxt"><strong> Full Bleed  <a href="javascript:void(0)" id="full_bleed_hover">(?)</a></strong> </label>
						</div>
						<div class="col-md-7">
							<div class="input_fld">
								<select id="full_bleed" class="get_input_new">
									<option value="no-full-bleed" selected>No, I don't need printing to the edges of the page</option>
									<option value="full-bleed">Yes, my file is designed for full bleed</option>
								</select>
							</div>
						</div>
					</div>
					<h3>Front cover</h3>
				    <div class="opt_sel clearfix">
					  <div class="col-md-5">
                        <label class="left_pan_taxt"><strong>Front Cover Required?</strong></label>
                      </div>
					  <div class="col-md-7">
						<div class="input_fld">
						  <select id="front_cover_check" name="front_cover_check" class="get_input_new">
								  <option value="yes">Yes</option>
								  <option value="no" selected>No</option>
						  </select>
						</div>
					  </div>
					</div>
					<div class="front_cover_options front_cover_whole_options">
					<div class="opt_sel clearfix">
					  <div class="col-md-5">
						  <label class="left_pan_taxt"><strong>Number Of Sides</strong></label>
					  </div>
					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="" class="get_input_new front_cover_sides">
								  <option value="1-sided">1-sided</option>
								  <option value="2-sided">2-sided</option>
							  </select>
						  </div>
					  </div>
					</div>
					<div class="opt_sel clearfix">
					  <div class="col-md-5">
						  <label class="left_pan_taxt"><strong>Color Type</strong></label>
					  </div>
					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="get_printing_option4" class="get_input_new">
								  <option value="color">Color</option>
								  <option value="black-ink">Black Ink</option>
							  </select>
						  </div>
					  </div>
					</div>
					<div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Paper Type</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="" class="get_input_new front_cover_paper_type">
                                      <?php $paper_type_id=0?>
                                      <?php if(!empty($paper_type)): foreach($paper_type as $paper):?>
                                        <optgroup label="<?php echo $paper['attr_value']?>" class="<?php echo $paper['attr_value']?>" style="font-weight:bold;color: white;background: #1660a8;">
                                            <?php if(!empty($paper['sub_type'])): foreach($paper['sub_type'] as $sub):?>
                                                <?php if($i==0):?>
                                                    <?php $paper_type_id = $sub['id']?>
                                                <?php endif?>
                                                <option value="<?php echo $sub['attr_value']?>" data-id="<?php echo $sub['id']?>"><?php echo $sub['attr_value']?></option>
                                            <?php $i++; endforeach; endif?>
                                        </optgroup>
                                      <?php endforeach; endif?>
                                  </select>
                                  <input type="hidden" id="paper_type_id" value="<?php echo $paper_type_id?>" >
                              </div>
                          </div>
				  </div>
					<div class="opt_sel clearfix">
						<div class="col-md-5">
							<label class="left_pan_taxt"><strong> Full Bleed  <a href="javascript:void(0)" id="full_bleed_hover">(?)</a></strong> </label>
						</div>
						<div class="col-md-7">
							<div class="input_fld">
								<select id="full_bleed" class="get_input_new front_full_bleed">
									<option value="no-full-bleed" selected>No, I don't need printing to the edges of the page</option>
									<option value="full-bleed">Yes, my file is designed for full bleed</option>
								</select>
							</div>
						</div>
					</div>
					</div>
					<h3>Back cover</h3>
				    <div class="opt_sel clearfix">
					  <div class="col-md-5">
                        <label class="left_pan_taxt"><strong>Back Cover Required?</strong></label>
                      </div>
					  <div class="col-md-7">
						<div class="input_fld">
						<?php if($product_data['product_id'] == 117){ ?>
							<select id="back_cover_check" name="back_cover_check" class="get_input_new">
								  <option value="yes">Yes</option>
								  <option value="no" selected>No</option>
								  <option value="yes_but_blank_cover_only">Yes but blank cover only</option>
						  </select>
						<?php }else{ ?>
							<select id="back_cover_check" name="back_cover_check" class="">
								  <option value="yes">Yes</option>
								  <option value="no">No</option>
						  </select>
						<?php } ?>
						    
						</div>
					  </div>
					</div>
					<div class="back_cover_options back_cover_whole_options">
					<div class="opt_sel clearfix" >
					  <div class="col-md-5 back_sides">
						  <label class="left_pan_taxt"><strong>Number Of Sides</strong></label>
					  </div>
					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="" class="get_input_new back_cover_sides">
								  <option value="1-sided">1-sided</option>
								  <option value="2-sided">2-sided</option>
							  </select>
						  </div>
					  </div>
					</div>
					<div class="opt_sel clearfix">
					  <div class="col-md-5 back_color_type">
						  <label class="left_pan_taxt"><strong>Color Type</strong></label>
					  </div>
					  <div class="col-md-7">
						  <div class="input_fld">
							  <select id="" class="get_input_new back_cover_color_type">
								  <option value="color">Color</option>
								  <option value="black-ink">Black Ink</option>
							  </select>
						  </div>
					  </div>
					</div>
					<div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Paper Type</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="" class="get_input_new back_cover_paper_type">
                                      <?php $paper_type_id=0?>
                                      <?php if(!empty($paper_type)): foreach($paper_type as $paper):?>
                                        <optgroup class="<?php echo $paper['attr_value']?>" label="<?php echo $paper['attr_value']?>" style="font-weight:bold;color: white;background: #1660a8;">
                                            <?php if(!empty($paper['sub_type'])): foreach($paper['sub_type'] as $sub):?>
                                                <?php if($i==0):?>
                                                    <?php $paper_type_id = $sub['id']?>
                                                <?php endif?>
                                                <option value="<?php echo $sub['attr_value']?>" data-id="<?php echo $sub['id']?>"><?php echo $sub['attr_value']?></option>
                                            <?php $i++; endforeach; endif?>
                                        </optgroup>
                                      <?php endforeach; endif?>
                                  </select>
                                  <input type="hidden" id="paper_type_id" value="<?php echo $paper_type_id?>" >
                              </div>
                          </div>
				  </div>
					<div class="opt_sel clearfix">
						<div class="col-md-5">
							<label class="left_pan_taxt"><strong> Full Bleed  <a href="javascript:void(0)" id="full_bleed_hover">(?)</a></strong> </label>
						</div>
						<div class="col-md-7">
							<div class="input_fld">
								<select id="full_bleed" class="get_input_new back_cover_full_bleed">
									<option value="no-full-bleed" selected>No, I don't need printing to the edges of the page</option>
									<option value="full-bleed">Yes, my file is designed for full bleed</option>
								</select>
							</div>
						</div>
					</div>
					</div>
					<div class="opt_sel clearfix front_cover_options">
						<div class="col-md-5">
							<label class="left_pan_taxt"><strong> Front Cover Option  </strong><!--<span class="pull-right" style="color: red;">Can choose more than one option</span>--></label>
						</div>
						<div class="col-md-7">
							<div class="input_fld">
								<select id="front_cover_option" class="get_input_new">
									<option selected>None</option>
									<option value="clear-cover-7">Clear cover 7 mil</option>
									<option value="clear-cover-10">Clear cover 10 mil</option>
									<option value="frosty-clear-cover">Frosty clear cover</option>
									<option value="black-vinyl">Black Vinyl</option>
									<option value="blue-vinyl">Blue Vinyl</option>
									<option value="white-vinyl">White Vinyl</option>
								</select>
							</div>
						</div>
					</div>
					<div class="opt_sel clearfix back_cover_options">
						<div class="col-md-5">
							<label class="left_pan_taxt"><strong> Back Cover Option </strong><!--<span class="pull-right" style="color: red;">Can choose more than one option</span>--></label>
						</div>
						<div class="col-md-7">
							<div class="input_fld">
								<select id="back_cover_option" class="get_input_new">
									<option selected>None</option>
									<option value="clear-cover-7">Clear cover 7 mil</option>
									<option value="clear-cover-10">Clear cover 10 mil</option>
									<option value="frosty-clear-cover">Frosty clear cover</option>
									<option value="black-vinyl">Black Vinyl</option>
									<option value="blue-vinyl">Blue Vinyl</option>
									<option value="white-vinyl">White Vinyl</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				</div>	
			  <?php }else{ ?>
              <div class="printing_options">
                <div class="print_opt_box">
				<?php if(in_array($product_data['product_id'],[116,117])){ ?>	
					  <h3 class="text-center"><?php echo $product_data['product_name']; ?></h3>
				<?php }else{ ?>
					  <h3>PRINTING OPTIONS</h3>
				<?php } ?>
                
                    <div class="row">
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong> How many copies would you like?</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <input type="number"  min="1" pattern="[0-9]*" value="1" id="no_copies" class="form-control get_input">
                              </div>
                          </div>
                      </div>
					
					
					  <?php if(!in_array($product_data['product_id'],[116])){ ?>
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>How many pages are in your file?</strong></label>
                          </div>
						  
                          <div class="col-md-7">
							<?php if(in_array($product_data['product_id'],[117])){ ?>
								<p class="text-right"><a href="" data-toggle="modal" data-target="#NoOfPages">How to determione number of pages</a></p>
							<?php } ?>  
                              <div class="input_fld">
                                  <input type="number"  min="1" pattern="[0-9]*" value="1" id="no_pages" class="form-control get_input">
                              </div>
                          </div>
						
                      </div>
					<?php }else{ ?>
							<input type="hidden"  min="2" max="2" value="2" id="no_pages" class="form-control get_input">
					  <?php } ?>
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Dimensions</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_printing_option0" class="get_option">
								  <?php 
								  
								  if($product_data['product_id'] == 116){
									  
								  foreach($get_dimensions as $dimention){ ?>
									<option value="<?php echo $dimention['dimension'] ;?>" <?php if($dimention['dimension'] == "8.5x11" ){echo "selected";} ?>> <?php echo $dimention['dimension']; ?></option>
									<?php }
								  }else{
									foreach($get_dimensions as $dimention){ ?>
										 <option value="<?php echo $dimention['dimension'] ;?>"> <?php echo $dimention['dimension']; ?></option>
								  <?php } } /* ?>
                                      <option value="8.5x11"> 8.5x11</option>
                                      <option value="8.5x14">8.5x14</option>
                                      <option value="11x17">11x17</option>
									  <?php if(!in_array($product_data['product_id'],[116])){ ?>
										  <option value="4.25x5.5">4.25x5.5</option>
										  <option value="4.25x11">4.25x11</option>
										  <option value="8.5x5.5">8.5x5.5 </option>
										  <option value="8.5x7">8.5x7</option>
										  <option value="4x6">4x6</option>
										  <option value="5x7">5x7</option>
										  <option value="8x10">8x10</option>
									  <?php } */ ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Paper Type</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_printing_option1" class="get_option">
                                      <?php $paper_type_id=0?>
                                      <?php if(!empty($paper_type)): foreach($paper_type as $paper):?>
                                        <optgroup label="<?php echo $paper['attr_value']?>" style="font-weight:bold;color: white;background: #1660a8;">
                                            <?php if(!empty($paper['sub_type'])): foreach($paper['sub_type'] as $sub):?>
                                                <?php if($i==0):?>
                                                    <?php $paper_type_id = $sub['id']?>
                                                <?php endif?>
                                                <option value="<?php echo $sub['attr_value']?>" data-id="<?php echo $sub['id']?>"><?php echo $sub['attr_value']?></option>
                                            <?php $i++; endforeach; endif?>
                                        </optgroup>
                                      <?php endforeach; endif?>
                                  </select>
                                  <input type="hidden" id="paper_type_id" value="<?php echo $paper_type_id?>" >
                              </div>
                          </div>
                      </div>
                      <div class="opt_sel clearfix" <?php if(in_array($product_data['product_id'],[116])){ echo 'style="display:none;"'; } ?>>
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Number Of Sides</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_printing_option3" class="get_option">
								    <?php if(!in_array($product_data['product_id'],[116])){
										?>
                                      <option value="1-sided">1-sided</option>
									<?php } ?>  
                                      <option value="2-sided">2-sided</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="opt_sel clearfix show_div" style="display:none;">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Sides</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <input type="radio" name="sides" value="head-to-head"><img src="<?=base_url()?>assets/frontend/images/Head to head.png" width="47px" height="38px">Head-to-Head
                                  <input type="radio" name="sides" value="head-to-toe"><img src="<?=base_url()?>assets/frontend/images/Head to Toe.png" width="47px" height="38px">Head-to-Toe
                              </div>
                          </div>
                      </div>
                      <div class="opt_sel clearfix show_div" style="display:none;">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Orientation</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <input type="radio" name="orientation" value="Landscape">&nbsp;<img src="<?=base_url()?>assets/frontend/images/landscape.png">&nbsp;Landscape&nbsp;&nbsp;
                                  <input type="radio" name="orientation" value="Portrait">&nbsp;<img src="<?=base_url()?>assets/frontend/images/portrait.png">&nbsp;Portrait
                                  <br>
                                  <input type="radio" name="orientation" value="Mixed">&nbsp;<img src="<?=base_url()?>assets/frontend/images/mixed.png" width="47px" height="38px">&nbsp;Mixed
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <br>
                <br>
                <div class="print_opt_box">
                  <h3>FINISHING OPTIONS</h3>
                    <div class="row">
                      
                    <?php //if($this->uri->segment(2)=='color-copies' || $this->uri->segment(2)=='enhanced-black-white-copies'){?>
                    <?php if(in_array($product_data['product_id'],[116,114,137])){?>
                            <div class="opt_sel clearfix">
                                <div class="col-md-5">
                                    <label class="left_pan_taxt"><strong> Full Bleed  <a href="javascript:void(0)" id="full_bleed_hover">(?)</a></strong> </label>
                                </div>
                                <div class="col-md-7">
                                    <div class="input_fld">
                                        <select id="full_bleed" class="get_option">
                                            <option value="no-full-bleed" selected>No, I don't need printing to the edges of the page</option>
                                            <option value="full-bleed">Yes, my file is designed for full bleed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="full_bleed_info" class="hover_table" style="opacity: 1; display: none; position: absolute;">
                                <tbody>
                                <tr>
                                    <td class="left"></td>
                                    <td class="body">
                                        <h3 style="font-size:16px;">Full Bleed</h3>
                                        <br>
                                        <strong style="text-decoration:underline;">How to determine full bleed</strong>
                                        <p>If your design extends to any edge of the sheet,</p>
                                        <p>then you should select full bleed.</p>
                                        <br>
                                        <img class="examples-of-full-bleed-tooltip" src="https://d1luacljur02br.cloudfront.net/assets/product-pages/examples-of-full-bleed-tooltip-d679dff511972e0aee765156e822b8c9caf6c0817c44e44574ae72ae24cff1c9.png">
                                    </td>
                                    <td class="right"></td>
                                </tr>
              
                                <tr>
                                <td class="corner bottomleft"></td>
                                <td class="bottom"></td>
                                <td class="corner bottomright"></td>
                                </tr>
                                </tbody>
                            </table>
                        
                        
                        <?php } ?>
                    
					<?php if(!in_array($product_data['product_id'],[116])){ ?>
                    
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong> Collation  <a href="javascript:void(0)" id="collation_hover">(?)</a></strong> </label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_finishing_option9" class="get_option">
                                      <option value="uncollated">uncollated</option>
                                      <option value="collated">collated</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <table id="collation_info" class="hover_table" style="opacity: 1; display: none; position: absolute;">
                        <tbody>
                          <tr>
                                <td class="corner topleft"></td>
                                <td class="top"></td>
                                <td class="corner topright"></td>
                          </tr>
                  
                          <tr>
                                <td class="left"></td>
                                <td class="body">
                                    <img src="https://d1luacljur02br.cloudfront.net/assets/product-pages/collation-bfbbbe99e853102606b0371aeaf245dead6908f8e401acc69e2aa1f01d611e27.png">
                                </td>
                                <td class="right"></td>    
                          </tr>
                  
                          <tr>
                                <td class="corner bottomleft"></td>
                                <td class="bottom"></td>
                                <td class="corner bottomright"></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Divider sheets  <a href="javascript:void(0)" id="divider_sheet_hover">(?)</a></strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_finishing_option0" class="get_option">
                                      <option value="no-divider-sheets">No Divider sheets</option>
                                      <option value="add-divider-sheets">add divider sheets</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <table id="divider_sheet_info" class="hover_table" style="opacity: 1;display: none; position: absolute;">
                        <tbody>
                          <tr>
                            <td class="corner topleft"></td>
                            <td class="top"></td>
                            <td class="corner topright"></td>
                          </tr>
                          <tr>
                            <td class="left"></td>
                            <td class="body">
                                <h3 style="font-size:16px;">Divider Sheets</h3>
                                <br>
                                <strong style="text-decoration:underline;">Where are divider sheets placed?</strong>
                                <p>- A divider sheet is placed between each document/copy. </p>
                                <p>- The number of documents/copies is selected in the</p>
                                <p>&nbsp;&nbsp;"How many copies would you like?" section of the quoter</p>
                                <p>- <i>Divider sheets will <strong style="text-decoration:underline;">NOT</strong> be put inside a document/copy, </i></p>
                                <p>&nbsp;&nbsp;they will only be put between documents/copies.</p>
                              <br>
                                <img src="https://d1luacljur02br.cloudfront.net/assets/product-pages/divider-b198ef8139e67a80cb592976ffa1f406520145360b60089348508d5a983dae47.png">
                            </td>
                            <td class="right"></td>
                          </tr>
                          <tr>
                            <td class="corner bottomleft"></td>
                            <td class="bottom"></td>
                            <td class="corner bottomright"></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Stapling <a href="javascript:void(0)" id="stapling_hover">(?)</a></strong></label>
                              <br\>
                              <p style="color: red;">(Only collated sheets can be stapled)</p>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_finishing_option1" class="get_option">
                                      <option value="no-stapling">No stapling</option>
                                      <option value="top-left">top left staple</option>
                                      <?php //if($this->uri->segment(2)=='black-white-copies'){?>
                                        <option value="2-staple">2 staples on the left </option>
                                      <?php //} ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <table id="stapling_info" class="hover_table" style="opacity: 1; display: none; position: absolute;">
                        <tbody>
                          <tr>
                            <td class="corner topleft"></td>
                            <td class="top"></td>
                            <td class="corner topright"></td>
                          </tr>
                          <tr>
                            <td class="left"></td>
                            <td class="body">
                                <img width="200" height="200" src="<?=base_url()?>images/two staples on the spine.jpeg">
                                <img width="200" height="200" src="<?=base_url()?>images/staple upper left.jpeg">
                            </td>
                            <td class="right"></td>
                          </tr>
                          <tr>
                            <td class="corner bottomleft"></td>
                            <td class="bottom"></td>
                            <td class="corner bottomright"></td>
                          </tr>
                        </tbody>
                      </table>
					<?php }else{ ?>
						 <select id="get_finishing_option9" class="get_option hidden">
                                      <option value="uncollated">uncollated</option>
						  </select>
					<?php } ?>  
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>Folding <a href="javascript:void(0)" id="folding_hover">(?)</a></strong></strong></label>
							  <?php if(!in_array($product_data['product_id'],[116])){ ?>
                              <br\>
                              <p style="color: red;">(Only uncollated sheets can be folded)</p>
							  <?php } ?>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_finishing_option4" class="get_option">
                                      <option value="no-folding">No folding</option>
                                      <option value="half-fold">half fold</option>
                                      <option value="tri-fold">tri fold</option>
                                      <option value="z-fold">z fold</option>
									<?php if(!in_array($product_data['product_id'],[116])){ ?>
                                      <option value="tri-fold-type-out">Tri fold type out (1-sided)</option>
                                      <option value="tri-fold-type-in">Tri fold type in (1-sided)</option>
									<?php } ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <table id="folding_info" class="hover_table" style="opacity: 1; display: none; position: absolute;">
                        <tbody>
                          <tr>
                            <td class="corner topleft"></td>
                            <td class="top"></td>
                            <td class="corner topright"></td>
                          </tr>
                          <tr>
                            <td class="left"></td>
                            <td class="body">
                                <img width="400" height="400" src="<?=base_url()?>images/Folding templates-01.png">
                            </td>
                            <td class="right"></td>
                          </tr>
                          <tr>
                            <td class="corner bottomleft"></td>
                            <td class="bottom"></td>
                            <td class="corner bottomright"></td>
                          </tr>
                        </tbody>
                      </table>
					<?php if(!in_array($product_data['product_id'],[116])){ ?>  
                      <div class="opt_sel clearfix">
                          <div class="col-md-5">
                              <label class="left_pan_taxt"><strong>3 hole punch</strong></label>
                          </div>
                          <div class="col-md-7">
                              <div class="input_fld">
                                  <select id="get_finishing_option27" class="get_option">
                                      <option value="no-hole-punch">No hole punch</option>
                                      <option value="add-3-holepunch">add 3 holepunch</option>
                                  </select>
                              </div>
                          </div>
                      </div>
					<?php } ?>    
                  </div>
                </div>
              </div>
				<?php } ?>
              <input type="hidden" id="product_id" value="<?php if(isset($product_data)) echo $product_data['product_id'];?>">
              <!-- <div class="printing_delivery">
                 <h2>RUSH SERVICE AVAILABLE. GET IT AS EARLY AS TUESDAY,<br>
                  OCT. 30TH.<br>
                  Order in the next 7 hr 5 min.<br>
                  You can change your delivery date in the shopping cart. </h2> 
                  <h2 style="color:red;">Our cut off time is any business day 11:00am, orders PLACED BEFORE 11AM will be ready FOR PICK UP AFTER TWO BUSINESS DAYS AT 4PM.</h2><br>

                  <h2 style="color:red;">Rush service available, call for details</h2>
              </div> -->
              <!-- <div class="price_box clearfix">
                <span class="price_head">Unit Price</span>
                <span class="priceA">$<span class="price">0.00</span></span>
              </div> -->
              <div class="price_box clearfix"> 
                <span class="price_head">Subtotal:</span>
                <span class="priceA">$<span class="total">0.00</span></span>
              </div>
			  
			  <!--div class="price_box clearfix"> 
                <span class="price_head">Front Cover Cost:</span>
                <span class="priceA">$<span class="front_cover">0.00</span></span>
              </div>
			  <div class="price_box clearfix"> 
                <span class="price_head">Back Cover Cost:</span>
                <span class="priceA">$<span class="back_cover">0.00</span></span>
              </div>
			  <div class="price_box clearfix"> 
                <span class="price_head">Inside Pages cost:</span>
                <span class="priceA">$<span class="inside_page">0.00</span></span>
              </div>
			  <div class="price_box clearfix"> 
                <span class="price_head">Back Cover option cost:</span>
                <span class="priceA">$<span class="back_cover_cost">0.00</span></span>
              </div>
			  <div class="price_box clearfix"> 
                <span class="price_head">Front Cover option cost:</span>
                <span class="priceA">$<span class="front_cover_cost">0.00</span></span>
              </div-->
			 
            </div>
            <div class="button_area">
              
              <!--<span class="pull-left" style="font-weight:700;font-size:20px;color:red;">* We have a $25 minimum charge</span>
               <form id="add_cart_from" action="<?php //echo base_url() .'product-image-upload/'.$product_data[0]['product_slug'] ;?>"  method="post"> -->
              <form id="add_cart_from" action="<?php echo base_url() .'product-image-upload/'.$product_data['product_slug'] ;?>"  method="post">
                  <button type="button" id="open_modal" class="nextstep" disabled="false">Next Step</button>
              </form>
              <div style="margin-top: 10px;">Select the printing and finishing combination above before proceeding</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg continue_dialog" style="width:1300px;margin: 5px auto;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body continue_dialog_body" style="padding: 5px;">
        <section class="body_wrapper">
        <div class="text-center" style="border: 10px solid black;padding: 15px;">
			<img style="width: 30%;" src="https://copymaxinc.com/assets/frontend/images/logo_1.png" alt="logo"/>
			<span style="color: black;font-weight: bold;font-size: 26px;display: block;margin-bottom: 25px;">1-844-267-9629</span>
			
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">
				<h1 style="margin-bottom: 25px;">THINGS YOU SHOULD KNOW WHEN PLACING YOUR ORDER</h1>
			</a>
			<div id="collapseOne" class="collapse text-left">
				  <p class="font-style"><span><u>FILE SIZE</u></span> <u>make sure the size of the file you are uploading matches the print size you selected Ex: If you selected 8.5x11 product</u> make sure the size of your file is also 8.5x11 otherwise your order will be delayed.</p>
				  <div class="row">
					<div class="col-md-12">
					  <div class="bleed-content">
						<p><span>BLACK & WHITE COPIES</span> can not have any bleed and will be reduced to create the white border.</p>
				  
						<p><span>IF YOU ARE UPLOADING</span> Microsoft word, Publisher or Powerpoint file(s) we have to email you a pdf proof for your approval and the production time starts when the proofs are approved not when the order was placed. To save time please always upload pdf files.</p>
					  </div>
					</div>
					<!--div class="col-md-5">
					  <div class="body_box1">
						<div class="bb_bottom">
						  <div class="row">
						  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 no-padd">
							<div class="bleedbox bld1">BLEED</div>
						  </div>
						  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 no-padd">
							<div class="bleedbox bld4">FULL BLEED NEEDS SPECIAL DESIGN</div>
						  </div>
						  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 no-padd">
							<div class="bleedbox bld2">BLEED <div class="bl2inner"></div></div>
						  </div>
						  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 no-padd">
							<div class="bleedbox bld3"><div class="bld3_inner">NO BLEED</div></div>
						  </div>
						</div>
						</div>
						<span class="bb2">Click <b><a href="http://inhouse.fitser.com/copymax/php/uploads/template-files/AA_ 3.16.19.pdf" target="_blank">Here</a></b> for Bleed set up</span>
					  </div>
					</div-->
				  </div>
			</div>
          
          
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"  class="collapsed" aria-expanded="false">
				<h1 style="margin-bottom: 25px;">WHAT HAPPENS AFTER YOU PLACE YOUR ORDER</h1>
			</a>
          
			<div id="collapseTwo" class="collapse text-left">
				<p><span>ORDERING PROCESS</span> after you select your product you will upload your file(s), choose your production turnaround time, choose if your order will be shipped, delivered or picked up & pay for for your order. Once we receive your order one of our trained staff will check your file(s) quickly usually withing 24 Hours and send it to production. If there are any issues we will contact you and go from there.</p>
				  
				<p><span>PRODUCTION TIME</span> <b>is the time it takes to fulfill your order and starts after you place your order, should any issues arise with your file(s)/order the production time will start from the time the issues have been resolved not when the order was placed.</b></p>

				<p><span>WHEN CHOOSING SHIPPING METHOD</span> be aware that the shipping time will be added to the production time, Ex: if you select two days production turn around and three days shipping you will receive your order after five working days.</p>
				  
				<p><span>FREE SHIPPING/DELIVERY </span> orders over $150 will be delivered/shipped ground free of charge</p>
				  
				<p><span>CANCELING YOUR ORDER </span> if you need to cancel your order call us asap, once production has started it can not be canceled.</p>

				<p><span>ANY QUESTIONS</span> please contact us before or during placing your oder 1.844.267.9629.</p>
			</div>
			<a href="<?=base_url('uploads/AA_ 3.16.19 new.pdf')?>" target="_blank"><h1 style="margin-bottom: 25px;">Bleed Set Up</h1></a>
			<div class="row">
              <div class="col-md-3">
                <div class="cancel_button">
                  <a href="#" data-dismiss="modal">Cancel</a>
                </div>
              </div>
              
              
              
              <div class="col-md-6 optionsBox text-left">
                <div class="firstdiv">
                <div class="row clearfix">
                  <div class="col-md-8">
                  <div class="form-group" style="text-align:left;">
                    <h4  style="color:red; font-weight:bold;">DO YOU NEED TO SEE A DIGITAL PROOF? </h4>
                  </div>
                  </div>
                  <div class="col-md-4">
                    <ul class="radiobtn">
                    <li>
                    <div class="form-group" style="text-align:left;">
                    <input type="radio" class="digital_proof_qs" id="radiooptions1" name="digital_proof" value="1">
                    <label for="radiooptions1" style="color:red;">Yes</label>
                  </div>
                    </li>
                    <li>
                    <div class="form-group" style="text-align:left;">
                    <input type="radio" class="digital_proof_qs" id="radiooptions2" name="digital_proof" value="0">
                    <label for="radiooptions2" style="color:red;">No</label>
                  </div>
                    </li>
                    </ul>
                  </div>
                  </div>
                 
                  </div>

                  <div class="secondDiv" id="second_div" style="display:none;">
                  <p>Plz be advised the production time starts from the time proof(s) have been approved</p>
                  <div class="form-group" style="text-align:left;">
                    <input type="checkbox" id="understood_agreed_yes" name="understood_agreed_yes" class="understood_agreed" value="1">
                    <label for="understood_agreed_yes" style="color:red;">Understood and Agreed </label>
                  </div>
                  
                  
                  </div>
                  
                  <div class="thirdDiv" id="third_div" style="display:none;">
                  <p>Plz make sure to check all the spelling, spacing and margins, if there is not enough white border as required
                  we will reduce the file to create enough white border. We are not responsible for any mis-spellings, typos.......
                  </p>
                  
                  <div class="form-group" style="text-align:left;">
                    <input type="checkbox" id="understood_agreed_no" name="understood_agreed_no" class="understood_agreed" value="1">
                    <label for="understood_agreed_no" style="color:red;">Understood and Agreed </label>
                  </div>
                  </div>
              
              
                </div>
                
              
              
              
              
              
              <div class="col-md-3">
                <div class="cont_button">
                  <input type="button" value="Continue" id="continue" />
                </div>
              </div>
        </div>
        </section>
      </div>
    </div>

  </div>
</div>
<div class="modal fade" id="NoOfPages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
			 
	  <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<div class="No-pages-content">
		<h4>How to Determine Number of Pages</h4>
		<h5><u>Books and Booklets</u></h5>
		<p>Count all pages in your finished product - including the front cover, inside front cover, back cover and inside back cover.</p>
			<span class="col-sm-12 text-center"><img src="<?php echo base_url();?>assets/frontend/images/booksSample.png"></span>
		<p>This book is 8 pages, including covers.</p>	
		   
		<h5><u>Still have questions?</u></h5>
			<p>- Please contact us. We are here to help!</p>
			<p>- 1 [877] 649-5463 </p>
			
		<p>- <a href="" data-email="info@copymaxinc.com" class="sendcontactmessage">Email US </a></p>	
		</div>
	  </div>
	</div>
  </div>
		
</div>
<style type="text/css">
  .body_wrapper {
	width: 100%;
	padding: 0px 0;
}
.body_wrapper h1 {
	color: #25aae1;
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	margin: 0 0 5px;
	text-decoration: underline;
	text-align: center;
}
.body_wrapper p {
	color: #000;
	font-size: 14px;
	font-weight: 400;
	margin: 0 0 5px;
	line-height: 21px;
}
  .body_wrapper p span {
    color: #25aae1;
    font-weight: 700;
  }
  .font-style {
    font-weight: 700 !important;
  }
.body_wrapper h2 {
	color: #25aae1;
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	margin: 0 0 6px 0;
	text-align: center;
	text-decoration: underline;
}
  .body_box1 {width:100%;display: inline-block;}
  .body_box1 span.bb1 {width: auto;float: left;color:#000;font-size: 26px;font-weight: 400;margin: 0 80px 20px 0;text-decoration: underline;}
  .body_box1 span.bb2 {
	width: 100%;
	float: left;
	color: #000;
	font-size: 19px;
	font-weight: 700;
	margin: 0 0 20px;
	text-align: center;
}
	
	
  .body_box1 span.bb2 b {
    font-weight: 400;
    color: #25aae1;
    font-style: italic;
  }
  .bleedbox {
	width: 100%;
	padding: 44px 0;
	text-align: center;
	border: 1px solid #000;
	font-size: 17px;
	font-weight: 700;
	margin-bottom: 6px;
}
  .bb_bottom {
    width: 100%;
    display: inline-block;
    margin: 0 0 0;
  }
  .bleedbox.bld1 {background: #828385;}
  .bleedbox.bld2 {position: relative;}
  .bleedbox.bld3 {padding: 10px;}
  .bld3_inner {
	background: #828385;
	padding: 34px 0;
}
  .bl2inner {
	position: absolute;
	height: 25px;
	top: 0;
	left: 0;
	width: 100%;
	background: #828385;
}
  .cont_button {width: auto;float: right;margin-top: 0px;margin-bottom: 10px;}
  .cont_button input {
    border: 2px solid #000;
    background: #eee;
    padding: 8px 40px;
    text-align: center;
    font-size: 22px;
    color: #000;
    font-weight: 600;
    -webkit-border-radius: 22px;
    -moz-border-radius: 22px;
    border-radius: 22px;
  }
  .cancel_button {width: auto;float: left;margin-top: 0px;}
  .cancel_button a {
    border: 2px solid #000;
    background: #eee;
    padding: 8px 40px;
    text-align: center;
    font-size: 22px;
    color: #000;
    font-weight: 600;
    -webkit-border-radius: 22px;
    -moz-border-radius: 22px;
    border-radius: 22px;
    display: inline-block;
    text-decoration: none;
  }
  .bleedbox.bld4 {
	padding: 8px 0;
	border: none;
	font-weight: normal;
	color: #25aae1;
	font-size: 15px;
}
  .no-padd {
    padding: 0 5px;
  }
  .form-group
  {
    text-align: left;
  }
/*.form-group input {
  padding: 0;
  height: initial;
  width: initial;
  margin-bottom: 0;
  display: none;
  cursor: pointer;
}
.form-group label {
    position: relative;
    cursor: pointer;
    font-size: 18px;
}

 .form-group label:before {
  content:'';
  -webkit-appearance: none;
  background-color: transparent;
  border: 2px solid #0079bf;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
  padding: 10px;
  display: inline-block;
  position: relative;
  vertical-align: middle;
  cursor: pointer;
  margin-right: 5px;
}

.form-group input:checked + label:after {
  content: '';
  display: block;
  position: absolute;
  top: 2px;
  left: 9px;
  width: 6px;
  height: 14px;
  border: solid #0079bf;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
} */
.radiobtn{
  margin:0;
  padding: 0;
  list-style: none;
  clear:both;
  display:table;
  width: 100%;
}
.radiobtn li{
  float: left;
  margin-right: 10px;
}
.radiobtn li .form-group label:before{
  border-radius: 50%;
}
.optionsBox .form-group{margin-bottom: 0;}
</style>

<script type="text/javascript">
  $("#divider_sheet_hover").mouseover(function(){
    $("#divider_sheet_info").show();
  });
  $("#divider_sheet_hover").mouseout(function(){
    $("#divider_sheet_info").hide();
  });
  $("#collation_hover").mouseover(function(){
    $("#collation_info").show();
  });
  $("#collation_hover").mouseout(function(){
    $("#collation_info").hide();
  });

  $("#full_bleed_hover").mouseover(function(){
    $("#full_bleed_info").show();
  });
  $("#full_bleed_hover").mouseout(function(){
    $("#full_bleed_info").hide();
  });
  

  $("#stapling_hover").mouseover(function(){
    $("#stapling_info").show();
  });
  $("#stapling_hover").mouseout(function(){
    $("#stapling_info").hide();
  });
  $("#folding_hover").mouseover(function(){
    $("#folding_info").show();
  });
  $("#folding_hover").mouseout(function(){
    $("#folding_info").hide();
  });
  
  
  $(document).on('change','.digital_proof_qs',function(){

    if($(this).val() == 1){
      
      $("#understood_agreed_no").prop('checked',false);
      $("#second_div").show();
      $("#third_div").hide();
    }
    else{
      $("#understood_agreed_yes").prop('checked',false);
      $("#second_div").hide();
      $("#third_div").show();
    }
  })
  
  
  $("#continue").click(function(){
    var check_proof = $("input[name=digital_proof]:checked").val();
    var sides = $("input[name=sides]:checked").val();
    var orientation =$("input[name=orientation]:checked").val();
    
    //alert(check_proof);
    if(check_proof == 1){
        
      if(!$("#understood_agreed_yes").prop('checked')){
        alert('Please Check the Understood & Agreed checkboxes');
      }
      else{  
        var digital_proof = $("input[name=digital_proof]:checked").val();
        //alert(digital_proof);
        $("#add_cart_from").prepend('<input type="hidden" id="digital_proof_hid" name="digital_proof_hid"  value="'+digital_proof+'"><input type="hidden" name="sides" value="'+sides+'"><input type="hidden" name="orientation" value="'+orientation+'">');
        
        $("#add_cart_from").submit();
      }
    
    }
    else if(check_proof == 0){

      if(!$("#understood_agreed_no").prop('checked')){
        alert('Please Check the Understood & Agreed checkboxes');
      }
      else{  
        var digital_proof = $("input[name=digital_proof]:checked").val();
        $("#add_cart_from").prepend('<input type="hidden" id="digital_proof_hid" name="digital_proof_hid"  value="'+digital_proof+'"><input type="hidden" name="sides" value="'+sides+'"><input type="hidden" name="orientation" value="'+orientation+'">');
       
        $("#add_cart_from").submit();
      }
    }
    else{
        alert('Please Check the checkboxes');
    }
    
  })
</script>
<style type="text/css">
  option{
    color: black;
    font-size: 16px;
    font-weight:normal;
    background: #fff
  }
</style>