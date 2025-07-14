<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Salesman
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Salesman</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <!-- Main row -->
     
      <div class="row">
        <div class="col-lg-12">
        	<div class="dashboard-body">
        		<div class="row list-salesman">
        			<div class="col-lg-6">
        				<div class="dashboard-common-heading">
							Salesman Details
						</div>
        			</div>
					<?php if($this->session->flashdata('update_message')){ ?>
					<div class="message"><?=$this->session->flashdata('update_message')?></div>
					<?php } ?>
        			<div class="col-lg-6">
        				<button class="pull-right submit-btn" type="submit" name="submit">
							Add Salesman
						</button>
        			</div>
        		</div>
        		
        		<div class="row">
	           	<div class="col-lg-12">
	           		 <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Profile Pic</th>              
                <th>Name</th>
				<th>Email ID</th>
                <th>Phone No.</th>
               
                <th>Action</th>
            </tr>
        </thead>
       
        <tbody>
          <?php foreach($salesman_list as $list){ ?>
            <tr>
                <td>
                	<div class="view-pro-pic">
                		<img src="<?=$list->category_image?>">
                	</div>
                </td>
                <td><?=$list->fname.' '.$list->lname?></td>
                <td><?=$list->email?></td>
                <td><?=$list->contact_number?></td>              
                <td>
                	
               
					<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i>

					<span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
					<!--<li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
					View</a></li>-->
					<li><a href="<?= base_url('admin/admin/edit_salesman')."/".$list->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					Edit</a></li>
					<li><a href="<?= base_url('admin/admin/delete_sales')."/".$list->id;?>"><i class="fa fa-trash-o" aria-hidden="true"></i>
					Delete</a></li>
					</ul>
					</div> 
                </td>
            
                  
            </tr>
             <?php } ?> 
          
        </tbody>
    </table>
	           	</div>
		          
	            </div>
        	</div>
        </div>
        
       
      </div>
      
  
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>