<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Salesman
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Salesman</li>
      </ol>
    </section>
	<?php if($this->session->flashdata('update_message')){ ?>
	<div class="message"><?=$this->session->flashdata('update_message')?></div>
	<?php } ?>
    <!-- Main content -->
		
    <section class="content">
    
      <!-- Main row -->
      <form id="add_sales" action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-12">
        	<div class="dashboard-body">
        		<div class="dashboard-common-heading">
        			Personal Details
        		</div>
        		<div class="row">
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>First Name <span class="important-rate">*</span></label>
							<input type="text" placeholder="" name="fname" class="sale-input" required value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->fname;}?>">
						</div>
        			</div>
        			<!--<div class="col-lg-4">
        				<div class="form-group">
							<label>Middle Name <span class="important-rate">*</span></label>
							<input type="text" placeholder="" name="fname" class="sale-input">
						</div>
        			</div>-->
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>Last Name <span class="important-rate">*</span></label>
							<input type="text" placeholder="" name="lname" class="sale-input" required value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->lname;}?>">
						</div>
        			</div>
        			<div class="clearfix"></div>
        		</div>
        		
        		<div class="row">
        			<div class="col-lg-4">
        				
						<div class="form-group">
						<label>Date of Birth <span class="important-rate">*</span></label>

						<div class="input-group date">
						  
						  <input type="text" class="form-control pull-right" id="datepicker123" name="dob" autocomplete="off" required value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->dob;}?>">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						</div>
						<!-- /.input group -->
					  </div>
        			</div>
        			<div class="col-lg-4">
        				<div class="form-group">
						    <label>Gender<span class="important-rate">*</span></label>
						    <div class="cust-radio">
						    	<ul>
						    		<li><input type="radio" name="gender"  <?php if(!empty($edit_salesman[0]->gender) && $edit_salesman[0]->gender == 'M'){ echo  'checked="checked"';}?> value="M"> <span></span> Male</li>
						    		<li><input type="radio" name="gender" <?php if(!empty($edit_salesman[0]->gender) && $edit_salesman[0]->gender == 'F'){ echo  'checked="checked"';}?>  value="F"> <span></span> Female</li>
						    	</ul>
						        
						    </div>
						    
						</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="form-group image-preview">
						    <label>Upload your profile picture <span class="important-rate">*</span></label>							 
							</br>
							 <input type="hidden" class="form-control image-preview-filename" value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->category_image;}?>" name="category_image" id="fieldID" readonly placeholder="Category Image"><div class="btn btn-default image-preview-input" data-toggle="modal" href="javascript:;" data-target="#file-manager"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span></div>
						    <!--<input type="file" name="image">-->
						<div  style="display:inline-block;vertical-align:bottom;margin-left:15px;">
                         <?php
                if(empty($edit_salesman[0]->category_image))
				{
                ?>
                <div class="upload_img"><img src="<?= base_url();?>assets/admin/images/no-image.png" class="img-responsive" style="height:29px;" alt=""> </div>
                <?php
				}
				else
				{
				?>
                <div class="upload_img"> <img src="<?=$edit_salesman[0]->category_image;?>" class="img-responsive" style="height:30px;" alt=""> </div>
                <?php
				}
				?>						    
				</div>		</div>
					   
        			</div>
        			<div class="clearfix"></div>
        		</div>
        	</div>
        </div>
        
        <div class="col-lg-12">
        	<div class="sales-team-body">
        		<div class="dashboard-common-heading">
        			Contact Details
        		</div>
        		<div class="row">
        			<!--<div class="col-lg-4">
        				<div class="form-group">
							<label>Phone Number <span class="important-rate">*</span></label>
							<input type="text" placeholder="" name="contact" class="sale-input">
						</div>
        			</div>-->
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>Mobile Number <span class="important-rate">*</span></label>
							<input type="tel" placeholder="" name="contact_number" class="sale-input" value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->contact_number;}?>" required >
						</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>Email Address <span class="important-rate">*</span></label>
							<input type="email" placeholder="" name="email" class="sale-input" id="email_id" value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->email;}?>" required>
						</div>
						<div class="email_val"></div>
        			</div>
        			<div class="clearfix"></div>
        		</div>
        		
        		<div class="row select_2_box">
        			<div class="col-lg-4">
        				
						<div class="form-group">
							<label>Country <span class="important-rate">*</span></label>
							<select class="form-control input-md select2" placeholder="Country" name="country" id="billing_country" onchange="get_state_list('billing_country', 'state')" required>
							<option>---Select Country---</option>
							<?php
							foreach($country_list as $key=>$value){?>
							<option value="<?php echo $key;?>" <?php if(!empty($edit_salesman) && $edit_salesman[0]->country_id == $key){echo "selected";} ?>><?php echo $value;?></option><?php   
							}
							?>
							</select>
						  </div>
        			</div>
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>State <span class="important-rate">*</span></label>
							<select class="form-control input-md select2"  data-placeholder="Select State" name="state" id="state" onchange="get_city_list('state', 'city')">
							<option>---Select State---</option>
							 <?php
												if(!empty($state_list)){
													
													foreach($state_list as $key=>$value){ ?>
														<option value="<?php echo $key;?>"                                                 
														   <?php if(!empty($edit_salesman) && $edit_salesman[0]->state_id==$key){echo 'selected';}?>>
														   <?php echo $value;?></option><?php   
													}
												}    
											?>      
							</select>
						  </div>
        			</div>
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>City <span class="important-rate">*</span></label>
							<select class="form-control select2" style="width: 100%;" data-placeholder="Select City" id="city" name="city">
							  <option> -- Select City -- </option>
							   <?php
												if(!empty($city_list)){
													foreach($city_list as $key=>$value){?>
														<option value="<?php echo $key;?>"                                                 
														   <?php if(!empty($edit_salesman) && $edit_salesman[0]->city_id==$key){echo 'selected';}?>>
														   <?php echo $value;?></option><?php   
													}
												}    
								?>   
							
							</select>
						  </div>
        			</div>
        			<div class="col-lg-4">
        				<div class="form-group">
							<label>Postal Code <span class="important-rate">*</span></label>
							<input type="tel" placeholder="" name="postal_code" class="sale-input" required value="<?php if(!empty($edit_salesman)){ echo $edit_salesman[0]->postal_code;}?>">
						</div>
        			</div>
        			<div class="clearfix"></div>
        		</div>
        	</div>
        </div>
      </div>
      <div class="row">
      	<div class="col-lg-12">
      		<button class="pull-right submit-btn" type="submit" name="submit" id="sales_submit">
      			Submit
      		</button>
      	</div>
      </div>
   </form>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->