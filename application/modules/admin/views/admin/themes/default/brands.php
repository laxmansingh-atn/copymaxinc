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

            <li class = ""><a href = "<?= base_url('admin/brands') ?>/showall"><?= $page_title;?></a></li>

            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>

          </ol>

          </div>

          <?php 

			if(end($this->uri->segments) != "add")

			{

		?>

          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/brands') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>

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

			//else if(!empty($this->session->flashdata('update_message')))

			//{

			?>

				<!--<div class="col-md-12 alert alert-success"><?//= $this->session->flashdata('update_message');?></div>-->

			<?php

			//}

		  ?>

          

        <?php 

			if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit")

			{

			//StdClass Object Array To Standard Array

			//print_r(json_decode(json_encode($my_Arrray), true));

			//echo "<pre>"; print_r($result);echo "</pre>";

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

				}

				?>

			  		<label for="lang" class="control-label">Language</label> 

					<select class="form-control brand_lang" name="language_code" >

						<option value="en" <?php if ($lang_code == "en") echo "selected='selected'";?>>English</option>

						<option value="es" <?php if ($lang_code == "es") echo "selected='selected'";?>>Spanish</option> 

					</select>

			  	</div>

			  </div>

			</div>

          	

            <div class="row">

            <div class="col-md-6">

              <div class="form-group">

                <label>Brand Name </label>

                <input class="form-control" type="text" name="brand_name" value="<?php if(!empty($result)){ echo $result[0]['brand_name'];}?>" placeholder="Brand Name" required="required">

              </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                <label>Brand Image</label>

                <div class="col-md-10">
safe_str_replace(
                  <div class="input-group image-preview">

                    <input type="text" class="form-control image-preview-filename" value="<?php if(!empty($result)){ echo $result[0]['brand_image'];}?>" name="brand_image" id="fieldID" readonly placeholder="Brand Image" />

                    <span class="input-group-btn"> 

                    

                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;"> <span class="glyphicon glyphicon-remove"></span> Clear </button>

                    

                    <div class="btn btn-default image-preview-input" data-toggle="modal" href="javascript:;" data-target="#file-manager"> <span class="fa fa-folder-open"></span> <span class="image-preview-input-title">Image</span>

                      <!--<input type="file" name="banner_image" value="<?php if(!empty($result)){echo $result[0]['banner_image'];}?>"/>-->

                      <!-- rename it --> 

                    </div>

                    </span> </div>

                </div>

                <div class="col-md-2">

                <?php

                if(empty($result[0]['brand_image']))

				{

                ?>

                  <div class="upload_img"> <img src="<?= base_url();?>assets/admin/images/no-image.png" class="img-responsive" style="height:29px;" alt=""> </div>

                <?php

				}

				else

				{

				?>

                <div class="upload_img"> <img src="<?= $result[0]['brand_image'];?>" class="img-responsive" style="height:30px;" alt=""> </div>

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

                <label>Brand Title</label>

                <input class="form-control" type="text" name="brand_title" id="brand_title" value="<?php if(!empty($result)){ echo $result[0]['brand_content'];}?>" placeholder="Brand Title" required="required">

              </div>

            </div>

            <div class="col-md-6">

              <div class="form-group">

                <label>Brand Status</label>

                <select class="form-control" name="brand_status" id="" required>

                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>

                    <option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>

                </select>

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

              <a href="<?= base_url('admin/brands/showall/');?>">

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

                    	<div class="panel-heading"> Brands Details </div>

                    	<!-- /.panel-heading -->

                    	<div class="panel-body">

                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->

                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                      <tr>

                                        <th>Sl No.</th>

                                        <th>Name</th>

                                        <th>Image</th>

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

                                        <td><?= $results->brand_name;?></td>

                                        <td><img src="<?= safe_str_replace("source","thumbs", $results->brand_image);?>" width="auto" height="100%" /></td>

                                        <td><?php echo ($results->status == 0?"Inactive":"Active");?></td>

                                        <td class="text-center"><div class="btn-group">

                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>

                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">

                                              <li><a class="edit" href="<?= base_url('admin/brands/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>

                                              <li><a class="delete" href="<?= base_url('admin/brands/delete')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>

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