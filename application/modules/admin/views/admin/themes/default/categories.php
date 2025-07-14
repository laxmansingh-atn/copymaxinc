<?php
$segments = $this->uri->total_segments();
$lang_code = get_current_language(); // Helper "current_language_helper.php"
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $page_title;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="col-md-12 breadcrumb_area1">
        <div class="col-md-10">
          <ol class = "breadcrumb">
            <li><a href = "<?= base_url('admin/dashboard');?>"><i class="fa fa-home"></i></a></li>
            <li><a href = "<?= base_url('admin/dashboard');?>">Home</a></li>
            <li class = ""><a href = "<?= base_url('admin/categories') ?>/"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			//if($this->uri->segment(3) != "add")
			if(end($this->uri->segments) != "add")
			{
		?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/categories') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
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
			//if($this->uri->segment(3) == "add" || $this->uri->segment(3) == "edit")
			if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit")
			{
			//StdClass Object Array To Standard Array
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
        
          <form action="" method="post" enctype="multipart/form-data">
          
          	<!--<div class="row">
			  <div class="col-md-6">
			  	<div class="form-group"> 
			  		<label for="lang" class="control-label">Language</label> 
					<select class="form-control category_lang" name="language_code" > 
						<option value="en" <?php if ($lang_code == "en") echo "selected='selected'";?>>English</option>
						<option value="es" <?php if ($lang_code == "es") echo "selected='selected'";?>>Spanish</option> 
					</select>
			  	</div>
			  </div>
			</div> -->
       
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Category Name </label>
                <input class="form-control" type="text" name="category_name" value="<?php if(!empty($result)){ echo $result[0]['category_name'];}?>" placeholder="Category Name" required="required">
              </div>
            </div>
            <!--<div class="col-md-6">
              <div class="form-group">
                <label>Category Title</label>
                <input class="form-control" type="text" name="category_title" id="category_title" value="<?php if(!empty($result)){ echo $result[0]['category_title'];}?>" placeholder="Category Title" required="required">
              </div>
            </div>-->
          
			
            <div class="col-md-6">
                <div class="form-group">
                <label>Category Image</label>
                <div class="col-md-10">
                  <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" value="<?php if(!empty($result)){ echo $result[0]['category_image'];}?>" name="category_image" id="fieldID" readonly placeholder="Category Image" />
                    <span class="input-group-btn"> 
                    
                    <!--<button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>-->
                    
                    <div class="btn btn-default image-preview-input" data-toggle="modal" href="javascript:;" data-target="#file-manager"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>
                      <!--<input type="file" name="category_image" value="<?php if(!empty($result)){echo $result[0]['category_image'];}?>"/>-->
                      <!-- rename it --> 
                    </div>
                    </span> </div>
                </div>
                <div class="col-md-2">
                <?php
                if(empty($result[0]['category_image']))
				{
                ?>
                  <div class="upload_img"><img src="<?= base_url();?>assets/admin/images/no-image.png" class="img-responsive" style="height:29px;" alt=""> </div>
                <?php
				}
				else
				{
				?>
                <div class="upload_img"> <img src="<?= $result[0]['category_image'];?>" class="img-responsive" style="height:30px;" alt=""> </div>
                <?php
				}
				?>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Featured Category</label>
                <select class="form-control" name="featured_category" id="" required>
                    <option <?php if(!empty($result)){ echo $result[0]['featured_category'] == 0?'selected':'';}?> value="0">Inactive</option>
                    <option <?php if(!empty($result)){ echo $result[0]['featured_category'] == 1?'selected':'';}?> value="1">Active</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Category Status</label>
                <select class="form-control" name="category_status" id="" required>
                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                </select>
              </div>
            </div>
			
			<!-- <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">								 
                                    <label>Short Description</label>									
                                    <textarea class="form-control"  type="text" name="short_description" id ="short_description" value="" placeholder="Product Description" rows="6" cols="6"><?php if(!empty($result)){ echo $result[0]['short_description'];}?>
									</textarea>								
                                  </div>
                                </div>
                            </div> 
			 <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">								 
                                    <label>Category Description</label>									
                                    <textarea class="form-control"  type="text" name="category_content" id ="category_content" value="" placeholder="Product Description" rows="6" cols="6"><?php if(!empty($result)){ echo $result[0]['category_content'];}?>
									</textarea>								
                                  </div>
                                </div>
                            </div>-->
            </div>
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
               <?php if(end($this->uri->segments) == "add"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php }
			  else if($this->uri->segment($segments-1) == "edit"){ ?>
              <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/categories/">
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
                    	<div class="panel-heading"> Categorys Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <!--<th>Brand Category</th>-->
                                        <th>Featured</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    <?php
									foreach($result as $key=>$results)
									{  
									?>
									  <tr>
                                      	<td><?= ($key+1);?></td>
                                        <td><?= $results->category_name;?></td>
                                        <td style="text-align: center;"><img src="<?= ($results->category_image != '' ? safe_str_replace("source","thumbs" , $results->category_image):base_url('assets/admin/images/no-image.png'));?>" width="auto" height="70%" /></td>
                                       <!-- <td>
										<?=$results->parent_category;?>
										<?php
										/* 
                                      
									   if($results->parent_category > 0)
										{
											foreach($result as $p_result)
											{
												if($p_result->id == $results->parent_category)
												{
													echo $p_result->category_name;
													break;
												}
											}
										}
										else
										{
											echo "";
										}
*/										
										?>
                                        </td>-->
                                        <td><?php echo ($results->featured_category == 0?"Inactive":"Active");?></td>
                                        <td><?php echo ($results->status == 0?"Inactive":"Active");?></td>
                                        <td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                              <li><a class="edit" href="<?= base_url('admin/categories/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                              <li><a class="delete" href="<?= base_url('admin/categories/delete')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
                                            </ul>
                                          </div></td>
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