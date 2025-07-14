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
		//echo $this->uri->segment(3);
			if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit")
			{
			//StdClass Object Array To Standard Array
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
        <div class="row">
        	<section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist"><?php

					if(end($this->uri->segments) == "add"){?>

                        <li role="presentation" class="active li_tab" id="li_tab1">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="General Information">
                                <span class="round-tab">
                                    <i class="fa fa-info"></i>
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="li_tab" id="li_tab2">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Product Image">
                                <span class="round-tab">
                                    <i class="fa fa-file-image-o"></i>
                                </span>
                            </a>
                        </li>
                        <!--<li role="presentation" class="li_tab" id="li_tab3">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Product Attribute">
                                <span class="round-tab">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </a>
                        </li>-->        
                        <li role="presentation" class="li_tab" id="li_tab4">
                            <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                            </a>
                        </li>
						
						<!--<li role="presentation" class="li_tab disabled" id="li_tab4"> // 'disabled' for tab disable 
                            <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                            </a>
                        </li>-->
						<?php

					}else if($this->uri->segment($segments-1) == "edit"){?>

                    	<li role="presentation" class="active li_tab" id="li_tab1">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="General Information">
                                <span class="round-tab">
                                    <i class="fa fa-info"></i>
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="li_tab" id="li_tab2">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Product Image">
                                <span class="round-tab">
                                    <i class="fa fa-file-image-o"></i>
                                </span>
                            </a>
                        </li>                           
                       <!-- <li role="presentation" class="li_tab" id="li_tab3">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Product Attribute">
                                <span class="round-tab">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </a>
                        </li> -->       
                        <li role="presentation" class="li_tab" id="li_tab4">
                            <a href="#step4" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                            </a>
                        </li><?php
					
                    }?>
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
                                    <label> Language </label>
                                    <select class="form-control product_lang" name="language_code" >
										<option value="en" <?php if ($lang_code == "en") echo "selected='selected'";?>>English</option>
										<option value="es" <?php if ($lang_code == "es") echo "selected='selected'";?>>Spanish</option> 
									</select>                                    
                                  </div>
                                </div>							
                               <!-- <div class="col-md-6">
                                  <div class="form-group">
                                    <label> Product Title </label>
                                    <input class="form-control" type="text" name="product_title" id="product_title" value="<?php if(!empty($result)){ echo $result[0]['product_title'];}?>" placeholder="Product Name" required="required">
                                  </div>
                                </div>-->
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label> Product Name </label>
                                    <input class="form-control" type="text" name="product_name" id="product_name" value="<?php if(!empty($result)){ echo $result[0]['product_name'];}?>" placeholder="Product Name" required="required">
                                  </div>
                                </div>
                               <!-- <div class="col-md-6">
                                  <div class="form-group">
                                    <label> Product Model </label>
                                    <input class="form-control" type="text" name="product_model" id="product_model" value="<?php if(!empty($result)){ echo $result[0]['product_model'];}?>" placeholder="Product Model">
                                  </div>
                                </div> -->
							    <div class="col-md-6 sku">
                                  <div class="form-group">
                                    <label>SKU</label>
                                    <input class="form-control" type="text" name="product_sku" id="product_sku" value="<?php if(!empty($result)){ echo $result[0]['sku'];}?>" placeholder="Product SKU" required="required">
                                  </div>
                                </div>                                
							    <!--<div class="col-md-6">
                                  <div class="form-group">
                                    <label>Working Price (£)</label>
                                    <input class="form-control" type="text" name="product_regular_price" id="product_regular_price" value="<?php if(!empty($result)){ echo $result[0]['regular_price'];}?>" placeholder="Product Price" required="required">
                                  </div>
                                </div>  

								<div class="col-md-6">
									  <div class="form-group">
										<label>Faulty Price (£)</label>
										<input class="form-control" type="text" name="faulty_price" id="faulty_price" value="<?php if(!empty($result)){ echo $result[0]['faulty_price'];}?>" placeholder="Product Price" required="required">
									  </div>
									</div>-->
								
							  <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Brand Name </label>
                                    <select class="form-control" name="brand" id="brand"><?php
										foreach($brandlist as $brandlists){?>
                                        <option <?php if(!empty($result)){if($brandlists->id == $result[0]['brand_id']) echo 'selected' ; }  ?> value="<?= $brandlists->id;?>"><?= $brandlists->brand_name;?></option><?php
										}?>
                                    </select>
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
									<select class="form-control" name="category_status" id="category_status" required>
										<option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                                        <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
									</select>
								  </div>
								</div>	

                               </div>
							   
							   
							   <div class="row" >
							    <a class="add_varient" class="btn">
							   <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Attribute</a> 
                                </div>							   
							   
							   
							    <div class="row">                                									 
                                <div class="col-md-12">                                                                           
								<div class="filter-product-wrapper">
                                <div class="row">
                                <div class="container-fluid">
								  
								  <?php 								  
                                if(!empty($attributes)){   
									?>  
                                    
                                    <input type="hidden" name="product_id" id="product_attribute_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
									
								 <div class="col-md-4">
								 <label>Storage (GB)</label>
                                 </div>
                                 <div class="col-md-4">
								 <input type="textbox" class="form-control validate" name="storage[]" >
                                 </div>
									
									
								   <label>Working Price with Network  (£):</label>
								   <div class="attribute_network">
								  <?php 
                                  $i = 0 ;  								  
								  foreach($attributes as $attribute){  
								  ?>
								   <div class="row">
								   <div class="col-md-4">
										 <div class="form-group">
										     
											<select class="form-control selected_val" id="network" name="network[1][]">
											<?php
											/*foreach($attributes as $attribute){
											$network_val[] = $attribute['network_id'] ; 	
											} */
                                             foreach($network as $list) {
												 
											echo '<option class="dropdown"';
											if($attribute['network_id'] ==$list['id'] ){echo 'selected' ; } 
											echo ' value="'.$list['id'].'">'.$list['brand_name'].'</option>' ; 
											
											//echo 'class="dropdown">'.$list['brand_name'].'</option>' ; 
											 }
											?>
											</select>
                                         </div>
										 </div>
                                                      
                                         <div class="col-md-4">
										 <div class="form-group">
                                          
                                            <input type="text" class="form-control validate" name="price[]" id="price_val" placeholder ="price" value="<?php if(!empty($attribute)){ echo $attribute['price_value'] ; }?>">
                                         
                                         </div>
										 </div>
										 
										  <div class="col-md-4">
										 <div class="form-group">
                                            <?php if($i == 0 ){?>                              
                                            <a class="add_more_network" class="btn btn-success">Add more</a> 
											<?php } else {?>
											 <a class="remove_btn_network" class="btn btn-success">Remove</a> 
											<?php } ?>											
                                         </div>
										 </div>
										 
								   <div class="clearfix"></div>
								   </div>
								   <?php $i ++ ; } ?>								   
                                    </div>      
                                        
                                    
									<?php
                                
                                }else {?>
								
                                  <div class="varient-content" data-id="0">								
                                  <input type="hidden" name="product_id" id="product_attribute_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
								    <div class="row">
									<div class="col-md-4">
									<label>Storage (GB)</label>
									</div>
									<div class="col-md-4">
									<input type="textbox" class="form-control validate" name="storage[]" required="required">
									</div>
									
								   </div>
								   <label>Working Price with Network  (£):</label>
								   
								
								   <div class="row  add-network-val">
								   <div class="col-md-4">
										 <div class="form-group">
										     
											<select class="form-control selected_val" id="network" name="network[0][]">
											<?php
											
                                             foreach($network as $list) {
												 
											echo '<option class="dropdown" value="'.$list['id'].'">'.$list['brand_name'].'</option>' ; 
											 }
											?>
											</select>
                                         </div>
										 </div>
                                                      
                                         <div class="col-md-4">
										 <div class="form-group">
                                          
                                            <input type="text" class="form-control validate" name="price[0][]" id="price_val" placeholder ="price" required="required">
                                         
                                         </div>
										 </div>
										 
										 <div class="col-md-4">
										  <div class="form-group">
                                                                          
                                            <a class="add_more_network" class="btn btn-success">Add more</a>    
                                          </div>
										 </div>
								   <div class="clearfix"></div>
								   </div>
									
                                     </div> 
                                <?php                                                               
                                }?>
                                 </div>
                                </div>
                                <div class="clearfix"></div>
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
                                                <img class="img-responsive" src="<?php echo $value['product_image'];?>" />                                                
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
									<div class="input-group image-preview" style="margin-bottom: 5px;">
										<input type="text" class="form-control image-preview-filename" value="" name="product_image" id="fieldID" readonly placeholder="Product Image" />
										<span class="input-group-btn">
										<div class="btn btn-default image-preview-input imgclick" data-toggle="modal" href="javascript:;" data-target="#file-manager"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>
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
						
						
                    <!-- <div class="tab-pane" role="tabpanel" id="step3">
                           <h3>Product Variants</h3>
                            
                            <div class="filter-product-wrapper">
                                <div class="row">
                                  <div class="container-fluid">
								  <?php                                    
                                  if(end($this->uri->segments) == "add"){ ?>  
                                   
                                    <form id="product_attribute">
                                    <input type="hidden" name="product_id" id="product_attribute_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
                                     
                                    <div class="attribute_section">                                     
                                       <div class="row attribute_row">                                     
                                         <div class="form-group col-md-3">
                                            <label>Storage (GB):</label>
                                            <input type="text" class="form-control validate" name="storage[]">
                                         </div>
                                          
                                         <div class="form-group col-md-3">                                        
                                            <a id="add_more_btn" class="btn btn-success" style="margin-top:24px;">Add more</a>    
                                         </div>
                                        </div>
                                     </div>
                                    </form>
									<?php
                                
                                }else {?>

                                    <form id="product_attribute">
                                    <input type="hidden" name="product_id" id="product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
                                     
                                    <div class="attribute_section">                                     
                                       <?php 
                                       $i=0;
                                       foreach($attributelist as $key=>$value){?>                                 
                                           <div class="row attribute_row">
                                         <div class="form-group col-md-3">
                                            <label>Storage (GB):</label>
                                            <input type="text" class="form-control validate" name="storage[]" value="<?php echo $value['attribute_value']?>">
                                         </div>
                                                                                              
                                         <div class="form-group col-md-3">   
                                            <?php if($i==0){?>                                     
                                                <a id="add_more_btn" class="btn btn-success" style="margin-top:24px;">Add more</a><?php 
                                            }else{?>
                                                <a id="remove_btn" class="btn btn-success" style="margin-top:24px;">Remove</a><?php 
                                            }?>
                                         </div>
                                           </div>
                                       <?php $i++;}?>

                                     </div>
                                    </form>
                                <?php                                                               
                                }?>
                                 </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
							
                            
                            <ul class="list-inline pull-right"><?php                                    

                                if(end ($this->uri->segments) == "add"){?>
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step" id="save_attribute">Save and continue</button></li><?php
                                }else if($this->uri->segment($segments-1) == "edit"){?>
                                    <li><button type="button" class="btn btn-primary prev-step">Previous</button></li>
                                    <li><button type="button" class="btn btn-primary skip-step">Skip</button></li>                                
                                    <li><button type="button" class="btn btn-primary btn-info-full next-step" id="edit_attribute">Edit and continue</button></li>
                                    <?php  
                                }?>

                            </ul>
                        </div>-->
						
						
						
                        <div class="tab-pane" role="tabpanel" id="step4">
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
                                        <th>Sl No.</th>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										foreach($productlist as $key=>$productlists)
										{
										?>
                                        <tr>
                                            <td><?= ($key+1);?></td>
                                            <td><?= $productlists->product_name;?></td>
                                            <td class="text-center"><div class="btn-group">
                                              <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                                <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                                  <li><a class="edit" href="<?= base_url('admin/products') ?>/edit/<?= $productlists->product_id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                                  <li><a class="delete" href="<?= base_url('admin/products') ?>/delete/<?= $productlists->product_id;?>"><i class="fa fa-trash"></i>Remove</a></li>
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
