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
        <form action="" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Coupon Code</label>
                <input class="form-control" type="text" name="coupon_code" value="<?=$result['coupon_code']?>" placeholder="Coupon Code" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Amount(in $)</label>
                <input class="form-control" type="number" name="amount" value="<?=$result['amount']?>" placeholder="Amount" required="required">
              </div>
            </div>
          </div>
          <hr>
          <div class="col-md-12 text-right mar_b_3">
            <input type="submit" name="edit" value="UPDATE" class="btn btn-info" />
            <a href="<?= base_url('admin/coupon/');?>">
            <button type="button" name="cancel" class="btn btn-default">CANCEL</button>
            </a>
          </div>
        </form>        
    </div>
    <!-- /.container-fluid -->
</div>