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
            <li class = ""><a href = "<?= base_url('admin/shipping/') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			if(end($this->uri->segments) != "add")
			{
		?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/shipping/add_price')?>"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
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
			if(end($this->uri->segments) == "add_price" || $this->uri->segment($segments-1) == "edit_price")
			{
			
		?>
        
        
          <form action="" method="post">
           
            <div class="row">
            <!--<div class="col-md-6">
              <div class="form-group">
                <label>Zip code</label>
                <input class="form-control" type="number" pattern="[0-9]*" min="4"  name="zip_code" value="<?php if(!empty($result)){ echo $result[0]['zip_code'];}?>" placeholder="Zip code" required="required">
              </div>
            </div>-->
           <div class="col-md-6">
            	<div class="form-group">
                <label>Delivery Days</label>
                <select class="form-control" name="no_days" required>
				<?php for($i=1;$i<20;$i++){
				echo '<option ';
                if(!empty($result)){ echo $result[0]['no_days'] == $i?'selected':'';}				
				echo 'value="'.$i.'">'.$i.' days</option>';	
				}?>
				</select>
              </div>
            </div>
            </div>
            <div class="row">
			 <div class="col-md-6">
              <div class="form-group">
                <label>Price</label>
                <input class="form-control" type="text"   name="price" value="<?php if(!empty($result)){ echo $result[0]['price'];}?>" placeholder="Price" required="required">
              </div>
            </div>
                
            	<div class="col-md-6">
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" id="" required>
                        <option <?php if(!empty($result)){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option>
                        <option <?php if(!empty($result)){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option>
                    </select>
                  </div>
                </div>
				
            </div>
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
              
               <?php if(end($this->uri->segments) == "add_price"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php }
			  else if($this->uri->segment($segments-1) == "edit_price"){ ?>
              <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/contacts/">
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
                    	<div class="panel-heading"> Contacts Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th> Sl No.</th> 
                                        <th>Delivery days</th>
										<th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    <?php
									if($result)
									foreach($result as $key=>$results)
									{
									?>
										<tr>
                                      	<td><?= ($key+1);?></td>                                        
                                        <td style="white-space:no-wrap;"><?= $results->no_days;?></td>
                                        <td><?= $results->price;?></td>
                                        <td><?php echo ($results->status == 0?"Inactive":"Active");?></td>
                                        <td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                              <li><a class="edit" href="<?= base_url('admin/shipping/edit_price')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                              <li><a class="delete" href="<?= base_url('admin/shipping/delete_price')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
                                            </ul>
                                          </div></td>
                                      </tr>
									<?php
                                    } else 
								echo '<tr><td> no records found </td></tr>' ; 		
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