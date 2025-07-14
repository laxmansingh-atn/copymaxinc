<?php
$segments = $this->uri->total_segments();
$lang_code = get_current_language(); // Helper "current_language_helper.php"

//echo "<pre>"; print_r($result);echo "</pre>";

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
            <li><a href = "<?= base_url('admin/dashboard/');?>"><i class="fa fa-home"></i></a></li>
            <li><a href = "<?= base_url('admin/dashboard/');?>">Home</a></li>
            <li class = ""><a href = "<?= base_url('admin/payment/type'); ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			if(end($this->uri->segments) == "type")
			{
		  ?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/payment/') ?>/addtype"><button type="button" class="btn btn-success">ADD Payment Type</button></a></div>
          <?php
			}
			else if(end($this->uri->segments) == "details")
			{
			?>
            <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/payment') ?>/adddetails"><button type="button" class="btn btn-success">ADD Payment Details</button></a></div>
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
			if(end($this->uri->segments) == "addtype" || $this->uri->segment($segments-1) == "edittype")
			{
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
          <form action="" method="post">
          
          	<div class="row">
			  <div class="col-md-6">
			  	<div class="form-group"> 
                <?php
				$id = 0;
				if(!empty($result))
				{
				$id = $result[0]['id'];
				//$id = $id."/";
				}
				?>
			  		<label for="lang" class="control-label">Language</label> 
					<select class="form-control payment_type_lang" name="language_code" >
						<option value="en" <?php if ($lang_code == "en") echo "selected='selected'";?>>English</option>
						<option value="es" <?php if ($lang_code == "es") echo "selected='selected'";?>>Spanish</option> 
					</select>
			  	</div>
			  </div>
			</div>
            
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Payment Type </label>
                <input class="form-control" type="text" id="payment_type" name="payment_type" value="<?php if(!empty($result)){ echo $result[0]['content'];}?>" placeholder="Payment Type" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Payment Type Order </label>
                <input class="form-control" type="text" id="payment_type_order" name="payment_type_order" value="<?php if(!empty($result)){ echo $result[0]['type_order'];}?>" placeholder="Payment Type Order" required>
              </div>
            </div>
            
            </div>
           
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
              
               <?php if(end($this->uri->segments) == "addtype"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php 
			  }
			  else if($this->uri->segment($segments-1) == "edittype"){ ?>
              <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/payment/type/">
              <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
              </a>
            </div>
          </form>
          <?php
			}
			else if(end($this->uri->segments) == "adddetails" || $this->uri->segment($segments-1) == "editdetails")
			{
				//echo "<pre>"; print_r($type); echo "</pre>";
				//echo "<pre>"; print_r($detail); echo "</pre>";
			?>
              <form action="" method="post">
               <div class="row">
				  <div class="col-md-6">
					<div class="form-group"> 
					<?php
						$id = 0;
						if(!empty($result))
						{
							$id = $result[0]['id'];
						}
					?>
						<label for="lang" class="control-label">Language</label> 
						<select class="form-control payment_details_lang" name="language_code" >
							<option value="en" <?php if ($lang_code == "en") echo "selected='selected'";?>>English</option>
							<option value="es" <?php if ($lang_code == "es") echo "selected='selected'";?>>Spanish</option> 
						</select>
					</div>
				  </div>
				</div>
                <div class="row">
                   	<div class="col-md-6">
                    	<div class="form-group">
                        <label>Payment Type</label>
                        <select class="form-control" name="payment_type" id="" required>
                        	<option>------- Select Payment Type -------</option>
                            <?php
							if(!empty($type))
							{
								foreach($type as $key=>$types)
								{
							?>
								<option value="<?= $types->id;?>" <?php if(!empty($result)){if($result[0]['type_id'] == $types->id) echo "selected='selected'";}?>><?= $types->content;?></option>
							<?php
                            	}
							}
							?>
                        </select>
                    	</div>
                	</div>
                   
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label>Payment Description</label>
                        <input class="form-control" type="text" id="payment_description" name="payment_description" value="<?php if(!empty($result)){ echo $result[0]['content'];}?>" placeholder="Payment Description" required>
                    	</div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-6">
                    	<div class="form-group">
                        <label>Fees 1</label>
                        <input class="form-control" type="text" name="enrollment_fees" value="<?php if(!empty($result)){ echo $result[0]['enrollment_fees'];}?>" placeholder="Enrollment Fees">
                    	</div>
                	</div>
                     <div class="col-md-6">
                    	<div class="form-group">
                        <label>Fees 2</label>
                        <input class="form-control" type="text" name="admission_fees" value="<?php if(!empty($result)){ echo $result[0]['admission_fees'];}?>" placeholder="Admission Fees">
                    	</div>
                	</div>
                </div>
                
                
                <hr>
                <div class="col-md-12 text-right mar_b_3">
                  
                   <?php if(end($this->uri->segments) == "adddetails"){ ?>
                  <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
                  <?php 
                  }
                  else if($this->uri->segment($segments-1) == "editdetails"){ ?>
                  <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
                  <?php } ?>
                  <a href="<?= base_url();?>admin/payment/details/">
                  <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
                  </a>
                </div>
              </form>
            <?php
			}
			else if(end($this->uri->segments) == "type")
			{
			?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Payment Type </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    <?php
									if(!empty($result))
									{
										foreach($result as $key=>$results)
										{
									?>
											<tr>
											<td><?= ($key+1);?></td>
											<td><?= $results->content;?></td>
											
											<td class="text-center"><div class="btn-group">
											  <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
												<ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
												  <li><a class="edit" href="<?= base_url('admin/payment/edittype')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
												  <li><a class="delete" href="<?= base_url('admin/payment/deletetype')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
												</ul>
											  </div></td>
										  </tr>
									<?php
										}
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
			else if(end($this->uri->segments) == "details")
			{
				//echo "<pre>"; print_r($result);echo "</pre>";
			?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Payment Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <!--<th>Email</th>
                                        <th>User Name</th>-->
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    <?php
									if(!empty($result))
									{
										foreach($result as $key=>$results)
										{
									?>
											<tr>
											<td><?= ($key+1);?></td>
                                           	<td><?= $this->payment_model->Get_Type_Content($results->type_id,get_current_language())[0]['content'];?></td>
                                            <td><?= $results->content;?></td>
											
											<td class="text-center"><div class="btn-group">
											  <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
												<ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
												  <li><a class="edit" href="<?= base_url('admin/payment/editdetails')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
												  <li><a class="delete" href="<?= base_url('admin/payment/deletedetails')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
												</ul>
											  </div></td>
										  </tr>
									<?php
										}
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