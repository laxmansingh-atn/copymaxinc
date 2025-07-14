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
            <li class = ""><a href = "<?= base_url('admin/testimonials/') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			if($this->uri->segment(3) != "add")
			{
		?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/testimonials') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
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
			if($this->uri->segment(3) == "add" || $this->uri->segment(3) == "edit")
			{
			//StdClass Object Array To Standard Array
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
        
          <form action="" method="post" enctype="multipart/form-data">
          
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Testimonial Name </label>
                <input class="form-control" type="text" name="testimonial_name" value="<?php if(!empty($result)){ echo $result[0]['testimonial_name'];}?>" placeholder="Testimonial Name" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Testimonial Status</label>
                <select class="form-control" name="testimonial_status" id="" required="required">
                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                </select>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label>Testimonial Client Name</label>
                <input class="form-control" type="text" name="client_name" value="<?php if(!empty($result)){ echo $result[0]['testimonial_client_name'];}?>" placeholder="Client Name" required="required">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Testimonial Client Designation</label>
                <input class="form-control" type="text" name="client_designation" value="<?php if(!empty($result)){ echo $result[0]['testimonial_client_designation'];}?>" placeholder="Client Designation">
              </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Testimonial Client Image</label> (Please provide images with 200 x 200)
                <div class="col-md-10">
                  <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" readonly="readonly" placeholder="Client Image" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>
                    
                    <div class="btn btn-default image-preview-input"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>
                      <input type="file" name="client_image" value="<?php if(!empty($result)){echo $result[0]['testimonial_client_image'];}?>"/>
                      <!-- rename it --> 
                    </div>
                    </span> </div>
                </div>
                <div class="col-md-2">
                <?php
                if(empty($result[0]['testimonial_client_image']))
				{
                ?>
                <div class="upload_img"> <img src="<?= base_url();?>assets/admin/images/no-image.png" class="img-responsive" style="height:30px; width:30px;" alt=""> </div>
                <?php
				}
				else
				{
				?>
                <div class="upload_img"> <img src="<?= base_url().$result[0]['testimonial_client_image'];?>" class="img-responsive" style="height:30px;" alt=""> </div>
                <?php
				}
				?>
                </div>
              </div>
            </div>
            </div>
                       
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Testimonial Client Description</label>
                    <!--<input class="form-control" type="text" name="banner_text" value="<?php if(!empty($result)){ echo $result[0]['banner_text'];}?>" placeholder="Banner Text" required="required">-->
                    <textarea class="form-control" type="text" name="client_description" id="client_description" placeholder="Client Description" rows="6" cols="6"><?php if(!empty($result)){ echo $result[0]['testimonial_client_text'];}?></textarea>
                  </div>
                </div>
            </div>
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
              
               <?php if($this->uri->segment(3) == "add"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php }
			  else if($this->uri->segment(3) == "edit"){ ?>
              <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/testimonials/">
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
                    	<div class="panel-heading"> Testimonial Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <!--<th>Image</th>
                                        <th>Category</th>
                                        <th>Order</th>-->
                                        <th>Status</th>
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
                                        <td style="text-align: center;"><?= $results->testimonial_name;?></td>
                                        <td><?php echo ($results->status == 0?"Inactive":"Active");?></td>
                                        <td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                              <li><a class="edit" href="<?= base_url('admin/testimonials/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                              <li><a class="delete" href="<?= base_url('admin/testimonials/delete')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
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