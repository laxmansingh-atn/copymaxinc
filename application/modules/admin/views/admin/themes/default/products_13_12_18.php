<?php
$segments = $this->uri->total_segments();
$lang_code = get_current_language(); // Helper "current_language_helper.php"
 
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $page_title."<br />"//.$page;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="col-md-12 breadcrumb_area1">
            <div class="col-md-10">
              <ol class = "breadcrumb">
                <li><a href = "<?= base_url('admin/dashboard');?>"><i class="fa fa-home"></i></a></li>
                <li class = "active"><?= $page_title;?></li>
              </ol>
            </div>
        
         <?php 
			if(end($this->uri->segments) != "add")
			{
		  ?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/products') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
          <?php
			}
		  ?>
        </div>
       
        <?php
        if(!empty($error) && $error == "error")
        {
		?>
        	<div class="col-md-12 alert alert-danger"><?= $this->session->flashdata('update_message');?></div>
        <?php
        }
		else if(!empty($error) && $error == "success")
		{
		?>
        	<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
        <?php
		}
		else if($this->session->flashdata('update_message'))
		{
		?>
			<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
		<?php
		}
		?>
        
        <?php 
	
			if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit")
			{
			
		?>
    <div class="row">
        	<section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
					
                        <li role="presentation" class="active li_tab" id="li_tab1">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="General Information">
                                <span class="round-tab">
                                    <i class="fa fa-info"></i>
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="li_tab" id="li_tab2">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="PRINTING OPTIONS">
                                <span class="round-tab">
                                    <i class="fa fa-pencil"></i> 
                                </span>
                            </a>
                        </li>
						
						<li role="presentation" class="li_tab" id="li_tab3">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="FINISHING OPTIONS">
                                <span class="round-tab">
                                    <i class="fa fa-cubes"></i> 
                                </span>
                            </a>
                        </li>
						
						 <li role="presentation" class="li_tab" id="li_tab4">
                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Product Image">
                                <span class="round-tab">
                                    <i class="fa fa-file-image-o"></i>
                                </span>
                            </a>
                        </li> 
                        
                        <li role="presentation" class="li_tab" id="li_tab5">
                            <a href="#step5" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                            </a>
                        </li>
						
                    </ul>
                </div>
				
        
                <!--<form role="form" enctype="multipart/form-data">-->
            <div class="tab-content">
                <div class="active tab-pane" role="tabpanel" id="step1">
                          <h3>General Information</h3>
                            <!--<form role="form" method="post">-->
						<form id="general_info">
                            <input type="hidden" id="editproductid" name="product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
                            <div class="row row_block">
							
                               
								
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label> Product Name </label>
                                    <input class="form-control" type="text" name="product_name" id="product_name" value="<?php if(!empty($result)){ echo $result[0]['product_name'];}?>" placeholder="Product Name" required="required">
                                  </div>
                                </div>
                              
							    <div class="col-md-6 sku">
                                  <div class="form-group">
                                    <label>SKU</label>
                                    <input class="form-control" type="text" name="product_sku" id="product_sku" value="<?php if(!empty($result)){ echo $result[0]['sku'];}?>" placeholder="Product SKU" required="required">
                                  </div>
                                </div>                                
							    
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Category Name </label>     
                                    <select class="js-example-basic-multiple form-control" id="category" name="category[]" multiple="" tabindex="-1" aria-hidden="true">
                                        <?php
                                        /******************** PRODUCT CATEGORY ********************/
                                        $product_category = array();                                        
                                        $inc_cat = 0;
									    if(isset($category))
                                        foreach($category as $a_category)
                                        {
                                            $product_cat_ids[] = $a_category['id'];
                                            $product_category[] = $a_category['category_id'];
                                        }
      
                                        foreach($categorylist as $categorylists)
                                        {
                                            $selected = '';
                                            $data_id = '';
                                            if(!empty($product_category))
                                            {
                                                
                                                if(in_array($categorylists['id'],$product_category)){
                                                    $selected = 'selected';
                                                    $key = array_search($categorylists['id'],$product_category);
                                                    $data_id = $product_cat_ids[$key];
                                                }      
                                            }
                                        ?>                                                          
                                            <option <?= $selected;?> value="<?= $categorylists['id']."-".$data_id;?>"><?= $categorylists['value'];?></option>
                                        <?php
                                        }
                                        ?>
                                     </select>
                                  </div>
                                </div>	
								
							    <div class="col-md-6">
								  <div class="form-group">
									<label>Product Status</label>
									<select class="form-control" name="product_status" id="category_status" required>
										<option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                                        <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
									</select>
								  </div>
								</div>	

                               </div>
							   
									<div class="row">
									<div class="col-md-10">
									<div class="form-group">
									<label>Description</label>
									<?php //print_r($result[0]); die; ?>
									<textarea class="form-control" type="text" name="description" id="page_description" placeholder="Description" rows="10" cols="6"><?php if(!empty($result)){ echo $result[0]['description'];}?></textarea>
									
									</div>
									</div>
									</div>
							   
                            <!--<p>This is step 1</p>-->
                            <ul class="list-inline pull-right">
                            	<?php
                                if(end($this->uri->segments) == "add")
								{
                                ?>
								<li><button type="button" class="btn btn-primary next-step" id="save_general">Save & Continue</button></li>
                            	<?php
								}
								else if($this->uri->segment($segments-1) == "edit")
								{
								?>
                                <li><button type="button" class="btn btn-primary next-step" id="edit_general">Edit and continue</button></li>
                                <?php
								}
								?>
                            </ul>
                            </form>
                        </div>
						
			  
                <div class="tab-pane" role="tabpanel" id="step2">
					    <form id="product_attribute">
					     <div class="row">
						 <label>PRINTING OPTIONS</label>
							   <a class="add_varient btn">
								
							   <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Attribute</a> 
                               </div>							   
							   
							   <input type="hidden" name="type"  value="printing">
							  
							    <div class="row">                                									 
                                <div class="col-md-12">                                                                           
								<div class="filter-product-wrapper">
                                <div class="row">
                                <div class="container-fluid">
							<?php 
							if(!empty($printing_attributes)){ ?>
							<input type="hidden" name="product_id" id="printing_product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
							<?php
								foreach($printing_attributes as $key=>$a) { 
								for($i = 0; $i< sizeof($a)-1; $i++){
                                 ?> 					
							     <input type="hidden" name="cnt[<?=$key?>]"  value="<?=$key?>">
                               <div class="row">
								  <div class="">
								 
								   <div class="col-md-4">
										 <label>Attribute:</label>
										 <div class="form-group">
										     
										<select class="form-control selected_val" id="attribute_data_<?=$key.$i?>" name="attribute[<?=$key?>][<?=$i?>]" onchange="attribute_data('<?=$key.$i?>' , 'child', 'printing')">
											<?php
											echo '<option class="dropdown">Select</option>'; 
                                             foreach($attributelist as $list) { 
											 echo '<option ';
										      if($list['attribute_id'] == $a[$i]['attribute_id']){ 
											  echo 'selected="selected"';
											  }
											echo ' class="dropdown" value="'.$list['attribute_id'] .'">'.$list['attribute_name'] .'</option>' ; 
											 }
											?>
											</select>
                                         </div>
								  </div>
										
								   <div class="col-md-4">
										   <label>Attribute Values:</label>
										     <div class="form-group">
										   <?php  $sql ="SELECT * FROM tbl_attribute_value where attribute_id = '".$a[$i]['attribute_id']."'";
								           $resultd1 = $this->db->query($sql); 
								           
										   ?>
											<select class="form-control selected_val" id="attr_val<?=$key.$i?>" name="attribute_value[<?=$key?>][<?=$i?>]">
											<option>select</option>
											<?php    
											if ($resultd1->num_rows() > 0) {
											 foreach($resultd1->result()  as $row_d) { 	
											echo '<option ';
											 if($row_d->value_id == $a[$i]['attr_value_id']){
                                             echo 'selected="selected"';
											 }												 
											echo ' class="dropdown" value="'.$row_d->value_id.'">'.$row_d->value .'</option>';
											} }?>	
											</select>
                                         </div>
								    </div>
									 
									<div class="col-md-4">
									  <label>&nbsp;</label>
										 <div class="form-group">
                                                                          
                                            <a class="attribute_set btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
											         
                                         
										 
										 </div>
										 
										   <div class="clearfix"></div>
								   </div>
								   <?php
                                    }								   
								   $sql ="SELECT * FROM tbl_product_range_price where c_varient_group_id = '".$a['p_varient_group_id']."'";
								   $query = $this->db->query($sql);
								   if ($query->num_rows() > 0) {
									  foreach($query->result()  as $rows) {
								   ?>
								   <div class="row add-network-val">
									<div class="col-md-4">
									<label>Quantitys Range</label>
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_from[<?=$key?>][]" required="required" placeholder="Range from" min = "0" value="<?=$rows->range_from?>">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_to[<?=$key?>][]" required="required" placeholder="Range to" min = "0" value="<?=$rows->range_to?>">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="price[<?=$key?>][]" required="required" placeholder="price" min = "0" value="<?=$rows->price?>">
									</div>
									
									 <div class="col-md-2">
										 <div class="form-group">
                                                                          
                                            <a class="add_more_network btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
									
										 <div class="clr"></div>
									
								   </div>

					<?php  	
					} }							
					?>   
								
								<?php } } else { ?>
								
                            <div class="varient-content" data-id="0">
								  <input type="hidden" name="cnt[]"  value="0"> 
                                 <!--<input type="hidden" name="product_id" id="printing_product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">-->
								  
								  
								<div class="row">
								  <div class="">
								 
								   <div class="col-md-4">
										 <label>Attribute:</label>
										 <div class="form-group">
										     
											<select class="form-control selected_val" id="attribute_data_0" name="attribute[0][]">
											<?php
											echo '<option class="dropdown" selected>Select</option>'; 
                                             foreach($attributelist as $list) {
										
											echo '<option class="dropdown" value="'.$list['attribute_id'] .'">'.$list['attribute_name'] .'</option>' ; 
											 }
											?>
											</select>
                                         </div>
								  </div>
										
								   <div class="col-md-4">
										  <label>Attribute Values:</label>
										     <div class="form-group">
										     
											<select class="form-control selected_val" id="attr_val0" name="attribute_value[0][]">
											
											</select>
                                         </div>
								    </div>
									 
									<div class="col-md-4">
									  <label>&nbsp;</label>
										 <div class="form-group">
                                                                          
                                            <a class="attribute_set btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
											         
                                         
										 
										 </div>
										 
								   <div class="clearfix"></div>
								   </div>
								  
								    <div class="row add-network-val">
									<div class="col-md-4">
									<label>Quantitys Range.......</label>
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_from[0][][]" required="required" placeholder="Range from" min = "0">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_to[0][][]" required="required" placeholder="Range to" min = "0">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="price[0][][]" required="required" placeholder="price" min = "0">
									</div>
									 <div class="col-md-2">
										 <div class="form-group">
                                                                          
                                            <a class="add_more_network btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
										 <div class="clr"></div>
									
								   </div>
								   
                                 </div> 
                                <?php                                                               
                                }
								?>
                                 </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                                        </div>
                                     </div>
					 

                        <ul class="list-inline pull-right">
                            	<?php
                                if(end($this->uri->segments) == "add")
								{
                                ?>
								<li><button type="button" class="btn btn-primary next-step" id="save_attribute">Save & Continue</button></li>
                            	<?php
								}
								else if($this->uri->segment($segments-1) == "edit")
								{
								?>
                                <li><button type="button" class="btn btn-primary next-step" id="edit_attribute">Edit and continue</button></li>
                                <?php
								}
								?>
                            </ul> 					 
						</form>
				</div>
					 
					 
			  <div class="tab-pane" role="tabpanel" id="step3">
					    <form id="finishing_attribute">
					     <div class="row">
						 <label>FINISHING OPTIONS</label>
							    <a class="add_finishing btn">
								
							   <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Attribute</a> 
                                </div>							   
							      <input type="hidden" name="type"  value="finishing">
							    <div class="row">                                									 
                                <div class="col-md-12">                                                                           
								<div class="filter-product-wrapper">
                                <div class="row">
                                <div class="container-fluid">
							<?php 
								 if(!empty($finishing_attributes)){ ?>								
							<input type="hidden" name="product_id" id="printing_product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
							<?php
							   
								foreach($finishing_attributes as $key=>$a) { 
									
                                    for($j = 0; $j< sizeof($a)-1; $j++){									
                                 ?> 					
											
							
                               <div class="row">
								  <div class="">
								 
								   <div class="col-md-4">
										 <label>Attribute:</label>
										 <div class="form-group">
										    <input type="hidden" name="cnt[<?=$key?>]"  value="<?=$key?>">   
										<select class="form-control selected_val" id="attribute_data_<?=$key?>" name="attribute[]" onchange="attribute_data('<?=$key?>','parent' ,'printing')">
											<?php
											echo '<option class="dropdown">Select</option>'; 
                                             foreach($attributelist as $list) { echo $a[$j]['attribute_id'];
											 echo '<option ';
										      if($list['attribute_id'] == $a[$j]['attribute_id']){ 
											  echo 'selected="selected"';
											  }
											echo ' class="dropdown" value="'.$list['attribute_id'] .'">'.$list['attribute_name'] .'</option>' ; 
											 }
											?>
											</select>
                                         </div>
								  </div>
										
								   <div class="col-md-4">
										   <label>Attribute Values:</label>
										     <div class="form-group">
										   <?php  $sql ="SELECT * FROM tbl_attribute_value where attribute_id = '".$a[$j]['attribute_id']."'";
								           $result1 = $this->db->query($sql); 
								           
										   ?>
											<select class="form-control selected_val" id="attr_val<?=$key?>" name="attribute_value[<?=$key?>][<?=$j?>]">
											<option>select</option>
											<?php    
											if ($result1->num_rows() > 0) {
											 foreach($result1->result()  as $row) { 	
											echo '<option ';
											 if($row->value_id == $a[$j]['attr_value_id']){
                                             echo 'selected="selected"';
											 }												 
											echo ' class="dropdown" value="'.$row->value_id.'">'.$row->value .'</option>';
											} }?>	
											</select>
                                         </div>
								    </div>
									 
									<div class="col-md-4">
									  <label>&nbsp;</label>
										 <div class="form-group">
                                                                          
                                            <a class="attribute_set btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
											         
                                         
										 
										 </div>
										 
								   <div class="clearfix"></div>
								   </div>
								   <?php
                                    }								   
								   $sql ="SELECT * FROM tbl_product_range_price where c_varient_group_id = '".$a['p_varient_group_id']."'";
								   $query = $this->db->query($sql);
								   if ($query->num_rows() > 0) {
									  foreach($query->result()  as $rows) {
								   ?>
								   <div class="row add-network-val">
									<div class="col-md-4">
									<label>Quantitys Range</label>
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_from[<?=$key?>][]" required="required" placeholder="Range from" min = "0" value="<?=$rows->range_from?>">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_to[<?=$key?>][]" required="required" placeholder="Range to" min = "0" value="<?=$rows->range_to?>">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="price[<?=$key?>][]" required="required" placeholder="price" min = "0" value="<?=$rows->price?>">
									</div>
									
									 <div class="col-md-2">
										 <div class="form-group">
                                                                          
                                            <a class="add_more_network btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
									
										 <div class="clr"></div>
									
								   </div>
								   
						<?php  	
					} }							
					?>   

					<?php } } else { ?>
							</div>	
								
                            <div class="finishing-content" data-id="0">
								<input type="hidden" name="cnt[]"  value="0">   
                               <!--<input type="hidden" name="product_id" id="finishing_product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">-->
								  
								  
								<div class="row">
								  <div class="">
								 
								      <div class="col-md-4">
										 <label>Attribute:</label>
										 <div class="form-group">
										     
											<select class="form-control selected_val" id="finishing_data_0" name="attribute[0][]">
											<?php
											echo '<option class="dropdown" selected>Select</option>'; 
                                             foreach($attributelist as $list) {
										
											echo '<option class="dropdown" value="'.$list['attribute_id'] .'">'.$list['attribute_name'] .'</option>' ; 
											 }
											?>
											</select>
                                         </div>
								  </div>
										
								   <div class="col-md-4">
										  <label>Attribute Values:</label>
										     <div class="form-group">
										     
											<select class="form-control selected_val" id="finishing_val_0" name="attribute_value[0][]">
											
											</select>
                                         </div>
								    </div>
									 
									<div class="col-md-4">
									  <label>&nbsp;</label>
										 <div class="form-group">
                                                                          
                                            <a class="finishing_set btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
										
										 </div>
										 
								   <div class="clearfix"></div>
								   </div>
								  
								    <div class="row add-network-val">
									<div class="col-md-4">
									<label>Quantitys Range</label>
									</div>
									<div class="col-md-2"> 
									<input type="number" class="form-control validate" name="quantity_from[0][][]" required="required" placeholder="Range from" min = "0">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="quantity_to[0][][]" required="required" placeholder="Range to" min = "0">
									</div>
									<div class="col-md-2">
									<input type="number" class="form-control validate" name="price[0][][]" required="required" placeholder="price" min = "0">
									</div>
									 <div class="col-md-2">
										 <div class="form-group">
                                                                          
                                            <a class="add_more_network btn btn-success btn-sm">Add</a>    
                                         </div>
									</div>
										 <div class="clr"></div>
									
								   </div>
								   
                                 </div> 
                                <?php                                                               
                                }
								?>
                                 </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                                        </div>
                                     </div>
					 

                        <ul class="list-inline pull-right">
                            	<?php
                                if(end($this->uri->segments) == "add")
								{
                                ?>
								<li><button type="button" class="btn btn-primary next-step" id="save_finishing">Save & Continue</button></li>
                            	<?php
								}
								else if($this->uri->segment($segments-1) == "edit")
								{
								?>
                                <li><button type="button" class="btn btn-primary next-step" id="finish_attribute">Edit and continue</button></li>
                                <?php
								}
								?>
                            </ul> 					 
						</form>
					 </div>


					 
						
                        <div class="tab-pane" role="tabpanel" id="step4">
                          
                          <div id="image_error_msg"></div>
                            <h3> Product Image </h3>
                            <p class="pro_image">
                                <?php /*if(!empty($product_image)){?> <img src="<?php echo $product_image[0]['product_image'];?>"><?php }*/?>
                            </p>
          
                            <div class="row row_image">
                             <?php 
                             if(isset($product_image) && !empty($product_image)){
                             foreach($product_image as $key=>$value){?>                                 
                             <div class="col-md-3">
                                <div class="brand-img-dsp">
                                    <div class="brand-img-dsp-inner">
                                        <div class="brand-img-dsp-inner1">
                                            <div class="brand-img-dsp-inner2">
                      <img class="img-responsive" src="<?php echo base_url().'uploads/products/'.$value['product_image'];?>">                                                
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="image_delete" id="<?php echo $value['id'];?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </div>
                             </div>
                             <?php 
                             }}?> 
                             </div>

                            <input type="hidden" class="product_id" id="product_id" name="product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
							<div class="row">
								<div class="col-md-6 add-image">
								 
							<div class="input-group image-preview">
								<input class="form-control image-preview-filename" readonly="readonly" placeholder="Product Image" type="text">
								<span class="input-group-btn">
								<button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>

								<div class="btn btn-default image-preview-input"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>
								<input name="product_image" id="product_image" value="" type="file">
								<!-- rename it --> 
								</div>
								</span> 
							</div>
                
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<button type="button" class="btn btn-primary" id="add_image" data-val="add">Upload</button>
										<button type="button" class="btn btn-default" id="cancel_image">Cancel</button>										
									</div>
								</div>
							</div>
                       
                            <hr>
                            <ul class="list-inline pull-right"><?php
                                if(end($this->uri->segments) == "add"){?>
                                <li><button type="button" class="btn btn-primary next-step" id="save_image" disabled>Continue</button></li><?php
								
                                }else if($this->uri->segment($segments-1) == "edit"){?>

                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>                                
                                <li><button type="button" class="btn btn-default skip-step" id="skip">Skip</button></li>
								<li><button type="button" class="btn btn-primary next-step" id="update_image">Continue</button></li><?php
								}?>                                
                            </ul>

                        </div>
						
                       <div class="tab-pane" role="tabpanel" id="step5">
                            <h3>Complete</h3>
                            <p>You have successfully completed all steps.</p>
                            <a href="<?= base_url();?>admin/products/" class="btn btn-primary btn-info-full" id="">Back to List page</a>
                        </div>
                        <div class="clearfix"></div>
              </div>
                <!--</form>-->
            </div>
       </section>
    </div>
        <?php
			}
			else
			{
		?>
	<div class="row">
		<div class="col-sm-12">
		<div class="panel panel-default">
	<div class="panel-heading"> Products Details </div>
	<div class="panel-body">
	<div class="dataTable_wrapper">
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
	<tr>
	<!--<th><button id="del">delete</button></th>-->
	<th>Sl No.</th>
	<th>Image</th>
	<th>Product Name</th>
	<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach($productlist as $key=>$productlists)
	{
	//echo '<pre>';
	//print_r($productlists);
	?>
	<tr>
	<!--<td><input type="checkbox" id="product_id[]" value="<?=$productlists->product_id?>"></td>-->

	<td><?= ($key+1);?></td>
	<td><img src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>" height="30px" width="40px"></td>
	<td><?= $productlists->product_name;?></td>
	<td class="text-center"><div class="btn-group">
	<button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
	<ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
	<li><a class="edit" href="<?= base_url('admin/products') ?>/edit/<?=$productlists->product_id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
	<li><a class="delete" href="<?= base_url('admin/products') ?>/delete/<?=$productlists->product_id;?>"><i class="fa fa-trash"></i>Remove</a></li>
	</ul>
	</div>
	</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
	</div>
	</div>
	</div>
		</div>
	</div>
			
        <?php
		}
		?>
        
    </div>
    <!-- /.container-fluid -->
</div>
<input type="hidden" id="step" value="<?=(isset($step)?$step:'');?>" />


