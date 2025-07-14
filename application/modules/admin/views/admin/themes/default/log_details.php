<div id="page-wrapper">
    <div class="container-fluid">
	  <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $page_title;?></h1>
            </div>          
        </div>
		<?php if(empty($result)){
		echo '<form action="" method="post">
			<div class="search_form">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>check log details </label>
							<input class="form-control" name="find_log" value="" placeholder="Search by client name/IMEI number/client e-mail" required="required" type="text">
							<div class="form-group" style="text-align:center; margin:15px 0 10px 0;">
								<button type="submit" name="submit">search</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>';	
			
		} else {?>
		 <div class="col-md-12 breadcrumb_area1">
		  <div class="col-md-10">
          <ol class = "breadcrumb">
            <li><a href = "<?= base_url('admin/dashboard');?>"><i class="fa fa-home"></i></a></li>
            <li><a href = "<?= base_url('admin/dashboard');?>">Home</a></li>
            <li class = ""><a href = "<?= base_url('admin/testing') ?>"><?= $page_title;?></a></li>
          
          </ol>
          </div>
		   <div class="row">
		    <div class="col-sm-12">
                    <div class="panel panel-default">
                    	<div class="panel-heading"> Log Table </div>
                    	<!-- /.panel-heading -->
                    	<div class="panel-body">
                    		<div class="dataTable_wrapper"><!--dataTables_wrapper-->
                    			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
                                        <th>Sl No.</th>
                                        <th>IMEI number</th>                                      
                                        <th>Customer Name</th>
                                        <th>Product Name</th>                                       
                                        <th>Order Total (£)</th>
										<th>Date</th>
                                        <th>payment Status</th>
										<th>Testing Report</th>
										<th>Testing Comments</th>
                                      </tr>
                                    </thead>
									 <tbody>
									
									  <?php
									$key = 1;
									foreach($result as $results) 
									{   
									    echo '<tr>';
										
									 	echo '<td class="text-center">'.$key.'</td>';
										
										if(!empty($results->imei_no)){ $imei_no = $results->imei_no ;} else {$imei_no ="N/A";}
										
										echo '<td class="text-center">'. $imei_no .'</td>';
										
										if(!empty($results->student_first_name )){ $name = $results->student_first_name ;} else {$name ="N/A";}
										
										echo '<td class="text-center">'. $name .'</td>';
										
										if(!empty($results->product_name )){ $pro_name= $results->product_name ;} else {$pro_name ="N/A";}
										echo '<td class="text-center">'. $pro_name .'</td>';
										
										echo '<td class="text-center">'.$results->total_price .'</td>';
										
										echo '<td class="text-center">'.$results->updated_at .'</td>';
										
										if(!empty($results->payment_status )){ $paymet = $results->payment_status ;} else {$paymet ="N/A";}
										echo '<td class="text-center">'. $paymet .'</td>';
										if($results->status == 0){
										$dat = 'not ok' ;	
										}elseif($results->status == 1){
										$dat = 'ok' ;	
										} else {
											$dat = 'not tested' ;	
										}
										echo '<td class="text-center">'.$dat.'</td>';
											if(!empty($results->comments )){ $paymet = $results->comments ;} else {$comments ="N/A";}
										echo '<td class="text-center">'. $comments .'</td>';
										echo '</tr>';
										$key ++;
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
	  
		<?php } ?> 
  </div>
 </div>  