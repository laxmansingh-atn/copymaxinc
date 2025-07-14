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
            <li class = ""><a href = "<?= base_url('admin/testing') ?>"><?= $page_title;?></a></li>
            <li class = "active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
          
			<div class = "testing"></div>
            <div class="row">
			
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Testing Details </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>Order ID</th>
                                       
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Created On</th>
                                        <th>Order Total (£)</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    
                                    <?php
									foreach($result as $key=>$results)
									{ //echo '<pre>'; print_r($results); 
									?>
									  <tr>
									  
                                      	<td class="text-center"><?= ($key+1);?></td>
                                        <td class="text-center"><?= $results->transaction_no;?></td>
                                       
                                        <td class="text-center"><?= $results->student_first_name .' '.$results->student_last_name ;?></td>
                                        <td class="text-center"><?= $results->product_name;?></td>
                                        <td class="text-center"><?= $results->created_at;?></td>
                                        <td class="text-center"><?= $results->amount;?></td>
                                        <td class="text-center"><div class="btn-group">
                                          <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                            <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
											<li><a class="edit"  data-toggle="modal" data-target="#testing<?= $results->id;?>" href="#testing<?= $results->id;?>"><i class="fa fa-pencil"></i>Verify</a></li>
											
                                              <!--<li><a class="edit"  href="<?= base_url('admin/testing/edit')."/".$results->id;?>"><i class="fa fa-pencil"></i>Edit</a></li>-->
											  
											  
                                              <!--<li><a class="delete" href="<?= base_url('admin/testing/delete')."/".$results->id;?>"><i class="fa fa-trash"></i>Remove</a></li>-->
                                            </ul>
                                          </div></td>
                                      </tr>
											<div id="testing<?=$results->id;?>" class="modal fade" role="dialog">
											<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title"><?= $results->product_name;?></h4>
											</div>
											<div class="modal-body">
											<form>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Condition</label>
													</div>
													<div style="float:right; width:63%;">
													<?= $results->condi;?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Network</label>
													</div>
													<div style="float:right; width:63%;">
													<?= $results->network;?>
													</div>
													<div style="clear:both;"></div>
												</div>
													<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Storage(GB)</label>
													</div>
													<div style="float:right; width:63%;">
													<?= $results->product_attribute_value;?>
													</div>
													<div style="clear:both;"></div>
												</div>
													<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>IMEI number</label>
													</div>
													<div style="float:right; width:63%;">
													<?= $results->imei_no;?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Order Total (£) </label>
													</div>
													<div style="float:right; width:63%;">
													<?= $results->amount;?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Status</label>
													</div>
													<div style="float:right; width:63%;">
													<label class="radio-inline">
													<input type="radio" name="status" value="1">Verified
													</label>
													<label class="radio-inline">
													<input type="radio" name="status" value="0" >Not verified
													</label>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div style="display:block; padding:0 0 20px 0;">
													<div style="float:left; width:35%;">
													<label>Revised cost:</label>
													</div>
													<div style="float:right; width:63%;">
													<input type="text" style="width:100px; padding:5px 10px; border:1px solid #d1d1d1; border-radius:3px;"  id="revised_cost<?=$results->id?>">
													</div>
													<div style="clear:both;"></div>
												</div>
											   <div></div>
											   <div></div>
											   <div></div>
											   
											   <div>
													
											   </div>
												<div class="form-group">
												
												
												</div>
											
											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" onclick="testing_param('<?= $results->id;?>' , '#revised_cost<?=$results->id?>','<?= $results->amount;?>' ,'<?= $results->email;?>','<?= $results->transaction_no;?>' ,'<?= $results->student_first_name?>' )">Submit</button>
											</div>
											</div>
                                        </form>
											</div>
											</div>
			
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
           
		  
    	
        
    </div>
    <!-- /.container-fluid -->
</div>