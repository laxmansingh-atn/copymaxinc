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
                <li class = "active"><?= $page_title;?></li>
              </ol>
            </div>
        
         	<?php if(end($this->uri->segments) != "add") { ?>
          		<div class="col-md-2 txt_right"> <a href="<?= base_url('admin/products') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
          	<?php } ?>
        </div>
       
        <?php if(!empty($error) && $error == "error") { ?>
        	<div class="col-md-12 alert alert-danger"><?= $this->session->flashdata('update_message');?></div>
        <?php } else if(!empty($error) && $error == "success") { ?>
        	<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
        <?php } else if($this->session->flashdata('update_message')) { ?>
			<div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
		<?php } ?>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading"> Products Details </div>
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Sl No.</th>
										<th>Image</th>
										<th>Product Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($productlist as $key=>$productlists) { ?>
										<tr>
											<td><?= ($key+1);?></td>
											<td><img src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>" height="30px" width="40px"></td>
											<td><?= $productlists->product_name;?></td>
											<td class="text-center">
												<div class="btn-group">
													<button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
													<ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
														<li><a class="edit" href="<?= base_url('admin/products') ?>/edit/<?=$productlists->product_id;?>"><i class="fa fa-pencil"></i>Edit</a></li>
														<li><a class="delete" href="<?= base_url('admin/products') ?>/delete/<?=$productlists->product_id;?>"><i class="fa fa-trash"></i>Remove</a></li>
														<li><a href="<?= base_url('admin/products') ?>/tab_values/<?=$productlists->product_id;?>"><i class="fa fa-pencil-square-o"></i>Add/Edit Tab Value</a></li>
													</ul>
												</div>
											</td>
										</tr>
									<?php }	?>
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
<input type="hidden" id="step" value="<?=(isset($step)?$step:'');?>" />

<style type="text/css">
	.wizard .nav-tabs > li {
	    width: 20%;
	}
</style>
