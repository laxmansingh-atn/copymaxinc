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
              			<h3>Upload Image</h3>
						<form method="post" action="" enctype="multipart/form-data">
                			<div class="row row_block">
                                <div class="col-md-6">
                                  	<div class="form-group">
                                    	<input type="file" name="image" accept="image/*">
                                  	</div>
                                </div>
				            </div>
                            <!--<p>This is step 1</p>-->
                            <ul class="list-inline pull-right">
                            	<li><button type="submit" class="btn btn-primary">Complete</button></li>
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