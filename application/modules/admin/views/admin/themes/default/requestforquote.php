<?php
//error_reporting (0);
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
            <li class = ""><a href = "<?= base_url('admin/orders') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          <?php 
			if($this->uri->segment(3) != "add")
			{
		  ?>
          <!--<div class="col-md-2 txt_right"> <a href="<?= base_url('admin/categories') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>-->
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
			?>
           <form action="" method="post">
            <h3>Request For Quote</h3>
            <?php
            if(!empty($result))
			{
				//print_r($result);
				//foreach($result['order_info'] as $key=>$order_info)
				//{
				//print_r($result['order_info']);
			?>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name </label>
                    <input class="form-control" type="text" value="<?= $result[0]['name'];?>" readonly="readonly" />
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" value="<?= $result[0]['phone'];?>" readonly="readonly" />
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email </label>
                    <input class="form-control" type="text" value="<?= $result[0]['email'];?>" readonly="readonly" />
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" value="<?= $result[0]['address'];?>" readonly="readonly" />
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                  <label> Write Request Quote To Client </label>
                  <textarea class="form-control" type="text" name="request_quote" id="request_quote" placeholder="" rows="6" cols="6"></textarea>
                  </div>
               </div>
            </div>
            <?php
				//}
			}
			?>
            
            
             <div class="col-md-12 text-right mar_b_3">
               <?php if($this->uri->segment(3) == "add"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php }
			  else if($this->uri->segment(3) == "edit"){ ?>

              <input type="submit" name="edit" value="SEND" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/requestforquote/">
              <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
              </a>
            </div>
            </form>
           <?php
			}
			else
			{
				//print_r($result);
				//echo CI_VERSION;
			?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Order Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    
                                    <?php
									foreach($result as $key=>$results)
									{
									?>
									  <tr>
                                      	<td class="text-center"><?= ($key+1);?></td>
                                        <td class="text-center"><?= $results->name;?></td>
                                        <td class="text-center"><?= $results->phone;?></td>
                                        <td class="text-center"><?= $results->email;?></td>
                                        <td class="text-center"><?= $results->address;?></td>
                                        <td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                              <li><a class="edit" href="<?= base_url('admin/requestforquote/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                              <!--<li><a class="delete" href="<?= base_url('admin/orders/delete')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>-->
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