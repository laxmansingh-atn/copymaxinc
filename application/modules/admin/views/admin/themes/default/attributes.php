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
            <li><a href = "<?= base_url('admin/dashboard');?>">Home</a></li>
            <li class = ""><a href = "<?= base_url('admin/attributes')."/".$this->router->fetch_method(); ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			//if($this->uri->segment(3) == "attributename")
			if(end($this->uri->segments) == "attributename")
			{
		  ?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/attributes/attributename') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
          <?php
			}
			//if($this->uri->segment(3) == "attributesvalue")
			if(end($this->uri->segments) == "attributesvalue")
			{
		  ?>
         <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/attributes/attributesvalue') ?>/add"><button type="button" class="btn btn-success">ADD VALUE</button></a></div> 
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
			
			if($this->router->fetch_method() == "attributename")
			{
				//echo $this->uri->segment($segments-1);
				if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit")
				{
					//print_r($result[0]['attribute_name']);
				?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Attribute Name </label>
                        <input class="form-control" type="text" name="attribute_name" value="<?php if(!empty($result)){ echo $result[0]['attribute_name'];}?>" placeholder="Attribute Name" required="required">
                      </div>
                    </div>
                    </div>
                    <hr>
                    <div class="col-md-12 text-right mar_b_3">
                      <?php if(end($this->uri->segments) == "add")
					  {
					  ?>
                      <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
                      <?php 
					  }
                      else if($this->uri->segment($segments-1) == "edit"){ ?>
                      <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
                      <?php } ?>
                      <a href="<?= base_url('admin/attributes/attributename/');?>">
                      <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
                      </a>
                    </div>
                </form>
                <?php
				}
				else
				{
				?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> Atributes Details </div>
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
                                                <td><?= $results['attribute_name'];?></td>
                                                <td class="text-center"><div class="btn-group">
                                                  <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                                    <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                                      <li><a class="edit" href="<?= base_url('admin/attributes/attributename/edit')."/".$results['attribute_id'];?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                                      <li><a class="delete" href="<?= base_url('admin/attributes/attributename/delete')."/".$results['attribute_id'];?>"><i class="fa fa-trash"></i>Remove</a></li>
                                                    </ul>
                                                  </div>
                                                  </td>
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
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
        
          
          <?php
			}
			else if($this->router->fetch_method() == "attributesvalue")
			{
				if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit")
				{
					//print_r($result);
				?>
                <form action="" method="post" enctype="multipart/form-data">
				
                    <div class="row attribute-content" data-id="0">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Attribute Name </label>
                            <select class="form-control" name="attribute[]" id="attribute_varient_0" required>
                				<option>----- Select Attribute -----</option>
                            	<?php
								foreach($attributelist as $attributes)
								{
								?>
                                
									<option <?php if(!empty($result)){ echo $result[0]['attribute_id'] == $attributes['attribute_id'] ?'selected':'';}?> value="<?= $attributes['attribute_id'];?>"><?= $attributes['attribute_name'];?></option>
								<?php
								}
								?>
                             </select>
                               
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <!--<label>Attribute Value</label>
							<select class="form-control selected_val" id="varient_0" name="attribute_value[]">											
							</select>-->
							
                            <label>Attribute Value</label>
                            <input class="form-control" name="attribute_value[]" id="varient_0" value="<?php if(!empty($result)) echo $result[0]['value']?>" placeholder="Attribute Value" required="required" type="text">
                          
							
							
                          </div>
                        </div>
						<div class="col-md-2">
								  <div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status[]" id="status" required>
										<option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                                        <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
									</select>
								  </div>
								</div>
                        <?php if(end($this->uri->segments) == "add"){?>							
                        <div class="col-md-2">
								<div class="form-group">                                                                         
                               <a class="add_more_attribute" class="btn btn-success">Add more</a>    
                                </div>
						</div>
				<?php }?>
						
                         <div class="clearfix"></div>   						
                    </div>

					
					
                    <hr>
                    <div class="col-md-12 text-right mar_b_3">
                      <?php if(end($this->uri->segments) == "add")
					  {
					  ?>
                      <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
                      <?php 
					  }
                      else if($this->uri->segment($segments-1) == "edit"){ ?>
                      <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
                      <?php } ?>
                      <a href="<?= base_url('admin/attributes/attributesvalue/');?>">
                      <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
                      </a>
                    </div>
                </form>
                <?php
				}
				else
				{
				?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> Atributes Details </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper"><!--dataTables_wrapper-->
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                          <tr>
                                            <th>Sl No.</th>
                                            <th>Name</th>
                                           <th>Value</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($result))
                                        {
											//print_r($result);
											//print_r($attribute);
                                            foreach($result as $key=>$results)
                                            {
                                        ?>
                                            <tr>
                                                <td><?= ($key+1);?></td>
                                                <td>
                                                <?php
										
												if($results['attribute_id'] > 0)
												{
													foreach($attribute as $attributes)
													{
														if($attributes['attribute_id'] == $results['attribute_id'])
														{
															echo $attributes['attribute_name'];
															break;
														}
													}
												}
												else
												{
													echo "";
												}
												?>
                                                </td>
                                                <td><?= $results['value'];?></td>
                                                <td class="text-center"><div class="btn-group">
                                                  <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                                    <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                                      <li><a class="edit" href="<?= base_url('admin/attributes/attributesvalue/edit')."/".$results['value_id'] ;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                                      <li><a class="delete" href="<?= base_url('admin/attributes/attributesvalue/delete')."/".$results['value_id'];?>"><i class="fa fa-trash"></i>Remove</a></li>
                                                    </ul>
                                                  </div>
                                                  </td>
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
            
            <?php
			}
		  ?>
        
    </div>
    <!-- /.container-fluid -->
</div>