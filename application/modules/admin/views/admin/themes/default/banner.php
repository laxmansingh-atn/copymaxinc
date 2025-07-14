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
            <li><a href = "<?= base_url('admin/dashboard/');?>"><i class="fa fa-home"></i></a></li>
            <li><a href = "<?= base_url('admin/dashboard/');?>">Home</a></li>
            <li class = ""><a href = "<?= base_url('admin/banner/') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			//if($this->uri->segment(3) != "add")
			if(end($this->uri->segments) != "add")
			{
		?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/banner') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
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
			//StdClass Object Array To Standard Array
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
        
          <form action="" method="post" enctype="multipart/form-data">
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
					<select class="form-control banner_lang" name="language_code" >
						<option value="en" <?php if ($lang_code == "en") echo "selected='selected'";?>>English</option>
						<option value="es" <?php if ($lang_code == "es") echo "selected='selected'";?>>Spanish</option> 
					</select>
			  	</div>
			  </div>
			</div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Banner Name </label>
                <input class="form-control" type="text" name="banner_name" value="<?php if(!empty($result)){ echo $result[0]['banner_name'];}?>" placeholder="Banner Name" required="required">
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Banner Image</label> <!--(Please provide images with 925x465)-->
                <div class="col-md-10">
                  <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" value="<?php if(!empty($result)){ echo $result[0]['banner_image'];}?>" name="banner_image" id="fieldID" readonly placeholder="Banner Image" />
                    <span class="input-group-btn">
                    <!--<button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>-->
                    
                    <div class="btn btn-default image-preview-input" data-toggle="modal" href="javascript:;" data-target="#file-manager"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>
                      <!--<input type="file" name="banner_image" value="<?php if(!empty($result)){echo $result[0]['banner_image'];}?>"/>-->
                      <!-- rename it --> 
                    </div>
                    </span> </div>
                </div>
                <div class="col-md-2">
                <?php
                if(empty($result[0]['banner_image']))
				{
                ?>
                <div class="upload_img"> <img src="<?= base_url();?>assets/admin/images/no-image.png" class="img-responsive" style="height:29px;" alt=""> </div>
                <?php
				}
				else
				{
				?>
                <div class="upload_img"> <img src="<?= $result[0]['banner_image'];?>" class="img-responsive" style="height:30px;" alt=""> </div>
                <?php
				}
				?>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Banner Category</label>
                <?php
				//echo "<pre>";print_r($banner_category);
				?>
                <select class="form-control" name="banner_category" id="" required>
                    <?php
					foreach($banner_category as $b_category)
					{
					?>
                    <option <?php if(!empty($result)){ echo $result[0]['banner_category'] == $b_category->page_slug ?'selected':'';}?> value="<?= $b_category->page_slug;?>"><?= $b_category->page_name;?></option>
                    <!--<option <?php if(!empty($result)){ echo $result[0]['banner_category'] == 0?'selected':'';}?> value="0">Inactive</option>-->
                    <?php
					}
					?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Banner Order</label>
                <input class="form-control" type="text" name="banner_order" value="<?php if(!empty($result)){ echo $result[0]['banner_order'];}?>" placeholder="Banner Order">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Banner Status</label>
                <select class="form-control" name="banner_status" id="" required>
                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                </select>
              </div>
            </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Banner Text</label>
                    <textarea class="form-control" type="text" name="banner_text" id="banner_text" placeholder="Banner Text" rows="6" cols="6"><?php if(!empty($result)){ echo $result[0]['banner_content'];}?></textarea>
                  </div>
                </div>
            </div>
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
              
               <?php if(end($this->uri->segments) == "add"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php }
			  else if($this->uri->segment($segments-1) == "edit"){ ?>
              <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/banner/">
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
                    	<div class="panel-heading"> Banner Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Order</th>
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
                                        <td style="text-align: center;"><?= $results->banner_name;?></td>
                                        <td style="text-align: center;"><img src="<?= $results->banner_image;?>" width="200" height="70" /></td>
                                        <td style="text-align: center;"><?= ucfirst($results->banner_category);?></td>
                                        <td style="text-align: center;"><?= $results->banner_order;?></td>
                                        <td><?php echo ($results->status == 0?"Inactive":"Active");?></td>
                                        <td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                              <li><a class="edit" href="<?= base_url('admin/banner/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                              <li><a class="delete" href="<?= base_url('admin/banner/delete')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
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