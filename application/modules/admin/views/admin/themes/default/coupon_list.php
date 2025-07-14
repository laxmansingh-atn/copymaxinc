<?php
$segments = $this->uri->total_segments();
$lang_code = get_current_language(); // Helper "current_language_helper.php"
//echo "<pre>"; print_r($result[0]['page_image']);echo "</pre>";exit();
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
              <li class = ""><a href = "<?= base_url('admin/coupon/'); ?>">All Coupon</a></li>
              <li class = "active"><?= $page_title;?></li>
            </ol>
          </div>
      
          <?php if(end($this->uri->segments) != "add") { ?>
          <div class="col-md-2 txt_right"> <a href="<?= base_url('admin/coupon') ?>/add"><button type="button" class="btn btn-success">ADD NEW</button></a></div>
          <?php } ?>
        </div>
       
        <?php if(!empty($error) && $error == "error") { ?>
          <div class="col-md-12 alert alert-danger"><?= $this->session->flashdata('update_message');?></div>
        <?php } else if(!empty($error) && $error == "success") { ?>
          <div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
        <?php } else if($this->session->flashdata('update_message')) { ?>
          <div class="col-md-12 alert alert-success"><?= $this->session->flashdata('update_message');?></div>
        <?php } ?>
        
        <?php if(end($this->uri->segments) == "add" || $this->uri->segment($segments-1) == "edit") { ?>
          <form action="" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group"> 
                  <?php
                    $id = 0;
                    if(!empty($result))
                    {
                      $id = $result[0]['id'];
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Coupon Code</label>
                  <input class="form-control" type="text" name="coupon_code" value="" placeholder="Coupon Code" required="required">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Amount(in $)</label>
                  <input class="form-control" type="number" name="amount" value="" placeholder="Amount" required="required">
                </div>
              </div>
            </div>
            <hr>
            <div class="col-md-12 text-right mar_b_3">
              <?php if(end($this->uri->segments) == "add"){ ?>
                <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              <?php } else if($this->uri->segment($segments-1) == "edit"){ ?>
                <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
              <?php } ?>
              <a href="<?= base_url('admin/coupon/');?>">
              <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
              </a>
            </div>
          </form>
        <?php } else { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> All Coupon </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                    <tr>
                                      <th>Sl No.</th>
                                      <th>Coupon Code</th>
                                      <th>Price(in $)</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php foreach($result as $key=>$results) { ?>
                                    <tr>
                                      <td><?= ($key+1);?></td>
                                      <td><?= $results['coupon_code'];?></td>
                                      <td><?= $results['amount'];?></td>
                                      <td class="text-center"><div class="btn-group">
                                        <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></button>
                                          <ul class="dropdown-menu icons-right dropdown-menu-right" style="padding:0">
                                            <li><a class="edit" href="<?= base_url('admin/coupon/edit')."/".$results['id'];?>"><i class="fa fa-pencil"></i>Edit</a></li>
                                            <li><a class="delete" href="<?= base_url('admin/coupon/delete')."/".$results['id'];?>" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i>Remove</a></li>
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
        <?php
      }
    ?>
        
    </div>
    <!-- /.container-fluid -->
</div>