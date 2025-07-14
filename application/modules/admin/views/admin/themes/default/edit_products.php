<?php 
	//echo "<pre>";print_r($categorylist);die();
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
                <li class = "active"><?= $page_title;?></li>
              </ol>
            </div>
        </div>
       
        <?php if(!empty($error) && $error == "error") { ?>
        	<div class="col-md-12 alert alert-danger"><?= $this->session->flashdata('update_message');?></div>
        <?php } else if(!empty($error) && $error == "success") { ?>
        	<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
        <?php } else if($this->session->flashdata('update_message')) { ?>
    			<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
    		<?php } ?>

    		<div class="row">
        	<section>
    				<div class="tab-content">
        				<div class="active tab-pane" role="tabpanel" id="step1">
                  	<h3>General Information</h3>
    						    <form method="post" action="">
                			<div class="row row_block">
                        <div class="col-md-6">
                          	<div class="form-group">
                            	<label> Product Name </label>
                            	<input class="form-control" type="text" name="product_name" id="product_name" value="<?=$product_details['product_name']?>" placeholder="Product Name" required="required">
                          	</div>
                        </div>
                  			<div class="col-md-6">
                    				<div class="form-group">
                      				<label>Category Name </label>     
                      					<select class="js-example-basic-multiple form-control" id="category" name="category[]" multiple="" tabindex="-1" aria-hidden="true">
                          				<?php
                      						/******************** PRODUCT CATEGORY ********************/
                      						$product_category = array();
                      						$inc_cat = 0;
				    						          if(isset($category))
                                    foreach($category as $a_category)
                                    {
                                        $product_cat_ids[] = $a_category['id'];
                                        $product_category[] = $a_category['category_id'];
                                    }
	                                  foreach($categorylist as $categorylists) {
                                      $selected = '';
                                      $data_id = '';
                                      if(!empty($product_category))
                                      {
                                          
                                          if(in_array($categorylists['id'],$product_category)){
                                              $selected = 'selected';
                                              $key = array_search($categorylists['id'],$product_category);
                                              $data_id = $product_cat_ids[$key];
                                          }
                                      }
                                  ?>
                                      <option <?= $selected;?> value="<?= $categorylists['id']."-".$data_id;?>"><?= $categorylists['value'];?></option>
                                  <?php } ?>
                       					</select>
                    					</div>
                  			</div>
    								    <div class="col-md-6">
    									  	<div class="form-group">
    											<label>Product Status</label>
    											<select class="form-control" name="product_status" id="status" required>
    												<option <?php if(!empty($product_details)){ echo $product_details['status'] == 1?'selected':'';}?> value="1">Active</option>
    		                    <option <?php if(!empty($product_details)){ echo $product_details['status'] == 0?'selected':'';}?> value="0">Inactive</option>
    											</select>
    									  	</div>
    									  </div>
                   		</div>
                      <ul class="list-inline pull-right">
                        <li><button type="submit" name="complete" value="complete" class="btn btn-primary">Complete</button></li>
                      	<li><button type="submit" name="update" value="update" class="btn btn-primary">Update & Continue</button></li>
                      </ul>
                    </form>
                </div>
                <div class="clearfix"></div>
      			</div>
       		</section>
    		</div>
    </div>
    <!-- /.container-fluid -->
</div>