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
            <li class = ""><a href = "<?= base_url('admin/users/') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(4));?></li>
          </ol>
          </div>
          <?php 
	
			if(end($this->uri->segments) == "role")
			{
		?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/users/') ?>/addrole"><button type="button" class="btn btn-success">ADD NEW ROLE</button></a></div>
          <?php
			}
			else if(end ($this->uri->segments) === "userlist")
			{
			?>
            <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/users') ?>/adduser"><button type="button" class="btn btn-success">ADD NEW USER</button></a></div> 
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
			if(end ($this->uri->segments) == "addrole" ||  $this->uri->segment(4) == "editrole")
			{
			//print_r(json_decode(json_encode($my_Arrray), true));
		?>
          <form action="" method="post">
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Role Name </label>
                <input class="form-control" type="text" name="role_name" value="<?php if(!empty($result)){ echo $result[0]['name'];}?>" placeholder="User Role Name" required="required">
              </div>
            </div>
            
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Role Description</label>
                <textarea name="role_description" rows="6" cols="4"><?php if(!empty($result)){ echo $result[0]['description'];}?></textarea>
              </div>
            </div>
			
			<!--<div class="col-md-6">
              <div class="form-group">
                <label>Role Access </label></br>
				<label>Role name</label>
                <input class="form-control" type="checkbox" name="role_name" value="<?php if(!empty($result)){ echo $result[0]['name'];}?>" placeholder="User Role Name" required="required">	
              </div>
            </div> -->
			 
            </div>
			
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
              
               <?php if(end ($this->uri->segments) == "addrole"){ ?>
              <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php 
			  }
			  else if($this->uri->segment(4) == "edit"){ ?>
              <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url();?>admin/users/role/">
              <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
              </a>
            </div>
          </form>
          <?php
			}
			else if(end ($this->uri->segments) == "adduser" || $this->uri->segment(3) == "edituser")
			{
			?>
              <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label>First Name </label>
                        <input class="form-control" type="text" name="first_name" value="<?php if(!empty($result)){ echo $result[0]['first_name'];}?>" placeholder="First Name" required="required">
                    	</div>
                	</div>
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label>Last Name </label>
                        <input class="form-control" type="text" name="last_name" value="<?php if(!empty($result)){ echo $result[0]['last_name'];}?>" placeholder="Last Name" required="required">
                    	</div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-6">
                    	<div class="form-group">
                        <!--<label>User Name </label>
                        <input class="form-control" type="text" name="user_name" value="<?php if(!empty($result)){ echo $result[0]['name'];}?>" placeholder="Enter User Name" required="required">-->
                        <label>Email </label>
                        <input class="form-control" type="email" name="email" value="<?php if(!empty($result)){ echo $result[0]['email'];}?>" placeholder="Enter Email ID" required="required">
                    	</div>
                	</div>
                  <div class="col-md-6">

                    	<div class="form-group">
                        <label>Change Password</label>

                        <input class="form-control" type="password" name="password" placeholder="Enter New Password" autocomplete="new-password">

                    	</div>
                	</div>

                </div>
                <div class="row">
                    <!--<div class="col-md-4">
                    	<div class="form-group">
                        <label>Email </label>
                        <input class="form-control" type="email" name="email" value="<?php if(!empty($result)){ echo $result[0]['name'];}?>" placeholder="Enter Email ID" required="required">
                    	</div>
                	</div>-->
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label>Phone Number </label>
                        <input class="form-control" type="text" name="phone_number" value="<?php if(!empty($result)){ echo $result[0]['phone'];}?>" placeholder="Enter Phone Number" required="required">
                    	</div>
                	</div>
                    <!-- <div class="col-md-6">
                    	<div class="form-group">
                        <label>Company Name</label>
                        <input class="form-control" type="text" name="company_name" value="<?php if(!empty($result)){ echo $result[0]['company'];}?>" placeholder="Enter Company Name" required="required">
                    	</div>
                	</div> -->
                </div>
                
                <div class="row">
                    <?php
					if($this->uri->segment(3) != "edituser")
					{
					?>
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="user_role" id="" required="required">
                        	<option>------- Select User Role -------</option>
                            </select>
                    	</div>
                	</div>
                    <?php
					}
					?>
                    <div class="col-md-6">
                    	<div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="user_status" id="" required="required">
                            <option <?php if(!empty($result)){ echo $result[0]['active'] == 0?'selected':'';}?> value="0">Inactive</option>
                            <option <?php if(!empty($result)){ echo $result[0]['active'] == 1?'selected':'';}?> value="1">Active</option>
                        </select>
                    	</div>
                	</div>
                </div>
                
                
                <hr>
                <div class="col-md-12 text-right mar_b_3">
                  
                   <?php if(end ($this->uri->segments) == "adduser"){ ?>
                  <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
                  <?php 
                  }
                  else if($this->uri->segment(3) == "edituser"){ ?>
                  <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
                  <?php } ?>
                  <a href="<?= base_url();?>admin/users/userlist/">
                  <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
                  </a>
                </div>
              </form>
            <?php
			}
			else if(end ($this->uri->segments) == "role")
			{
			?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> User Role Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Description</th>
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
											<td><?= $results->name;?></td>
											<td><?= $results->description;?></td>
											<td class="text-center"><div class="btn-group">
											  <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
												<ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
												  <li><a class="edit" href="<?= base_url('admin/users/editrole')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
												  <li><a class="delete" href="<?= base_url('admin/users/deleterole')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>
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
			else if(end ($this->uri->segments) == "userlist")
			{
			?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> User Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!--<th>User Name</th>-->
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    <?php
									if(!empty($result))
									{
										//echo "<pre>";
										//print_r($result);
										foreach($result as $key=>$results)
										{
									?>
											<tr>
											<td><?= ($key+1);?></td>
                                            <td><?= $results->first_name." ".$results->last_name;?></td>
											<td><?= $results->email;?></td>
                                            <!--<td><?= $results->username;?></td>-->
											<td class="text-center"><div class="btn-group">
											  <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
												<ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
												  <li><a class="edit" href="<?= base_url('admin/users/edituser')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
												  <!--<li><a class="delete" href="<?= base_url('admin/users/deleteuser')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>-->
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