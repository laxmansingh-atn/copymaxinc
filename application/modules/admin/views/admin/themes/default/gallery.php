<?php
$segments = $this->uri->total_segments();
//$lang_code = get_current_language(); // Helper "current_language_helper.php"
 
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
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/gallery') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
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
                        <!--<li role="presentation" class="li_tab" id="li_tab3">
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
							<form id="gallery_info">
                            <input type="hidden" id="editproductid" name="product_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>">
                            <div class="row row_block">
                                
                               
							    <div class="col-md-6 sku">
                                  <div class="form-group">
                                    <label>Gallery Name</label>
                                    <input class="form-control" type="text" name="gallery_name" id="gallery_name" value="<?php if(!empty($result)){ echo $result[0]['title'];}?>" placeholder="Gallery Name">
                                  </div>
                                </div>                                
							   
                                <div class="col-md-6">
                <div class="form-group">
                <label> Gallery Image</label>
                <div class="col-md-10">
                  <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" value="<?php if(!empty($result)){ echo $result[0]['brand_image'];}?>" name="brand_image" id="fieldID" readonly placeholder="Gallery Image" />
                    <span class="input-group-btn"> 
                    
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>
                    
                    <div class="btn btn-default image-preview-input" data-toggle="modal" href="javascript:;" data-target="#file-manager"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>
                      <!--<input type="file" name="banner_image" value="<?php if(!empty($result)){echo $result[0]['image'];}?>"/>-->
                      <!-- rename it --> 
                    </div>
                    </span> </div>
                </div>
                <div class="col-md-2">
                <?php
                if(empty($result[0]['image']))
				{
                ?>
                  <div class="upload_img"> <img src="<?= base_url();?>assets/admin/images/no-image.png" class="img-responsive" style="height:29px;" alt=""> </div>
                <?php
				}
				else
				{
				?>
                <div class="upload_img"> <img src="<?= $result[0]['image'];?>" class="img-responsive" style="height:30px;" alt=""> </div>
                <?php
				}
				?>
                </div>
              </div>
            </div>
								
								
							 
                               	
							   

                               </div>
							   
							   
                            <ul class="list-inline pull-right">
                            	<?php
                                if(end($this->uri->segments) == "add")
								{
                                ?>
								<li><button type="button" class="btn btn-primary next_1" id="save_gallery">Save & Continue</button></li>
                            	<?php
								}
								else if($this->uri->segment($segments-1) == "edit")
								{
								?>
                                <li><button type="button" class="btn btn-primary next-step" id="edit_gallery">Edit and continue</button></li>
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
                        <div class="tab-pane" role="tabpanel" id="step3">
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
                                                      
                                         <!--<div class="form-group col-md-3">
                                            <label>Price ($):</label>
                                            <input type="text" class="form-control validate" name="price[]">
                                         </div>-->
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
                                                        
                                        <!-- <div class="form-group col-md-3">
                                            <label>Price($):</label>
                                            <input type="text" class="form-control validate" name="price[]" value="<?php echo $value['price']?>">
                                         </div>-->
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
							<!--/.filter-product-wrapper-->
                            
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
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step4">
                            <h3>Complete</h3>
                            <p>You have successfully completed all steps.</p>
                            <a href="<?= base_url();?>admin/gallery/" class="btn btn-primary btn-info-full" id="">Back to List page</a>
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
                        <div class="panel-heading"> Gallery Details </div>
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
                                            <td><?= $productlists->title ;?></td>
                                            <td class="text-center"><div class="btn-group">
                                              <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                                <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                                  <li><a class="edit" href="<?= base_url('admin/gallery') ?>/edit/<?= $productlists->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                                  <li><a class="delete" href="<?= base_url('admin/gallery') ?>/delete/<?= $productlists->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
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
