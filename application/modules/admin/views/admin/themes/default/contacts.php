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
            <li class=""><a href = "<?= base_url('admin/contacts/') ?>"><?= $page_title;?></a></li>
            <li class="active"><?= ucfirst($this->uri->segment(3));?></li>
          </ol>
          </div>
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
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                      </tr>
                                    </thead>
                    				<tbody>
                                    <?php
									foreach($result as $key=>$results)
									{
									?>
										<tr>
                                      	<td><?= ($key+1);?></td>
                                        <td><?= $results->first_name." ".$results->last_name;?></td>
                                        <td><?= $results->email;?></td>
                                        <td><?= $results->phone_no;?></td>
                                        <td><?= $results->subject; ?></td>
                                        <td><?= substr($results->message,0,80);?></td>
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
    </div>
    <!-- /.container-fluid -->
</div>