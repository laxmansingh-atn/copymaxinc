<!-- Content Wrapper. Contains page content -->
  <link href="<?= base_url() ?>assets/admin/dist1/css/AdminLTE.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/admin/dist1/css/custom-style.css" rel="stylesheet">
  <div id="page-wrapper" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$no_of_order?></h3>

              <p>Total Order</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text" aria-hidden="true"></i>

            </div>
            <a href="<?php echo base_url('admin/orders');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$no_of_customer?></h3>

              <p>Total Customer</p>
            </div>
            <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>

            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
          </div>
        </div>
      
      </div>
    </section>
    <!-- /.content -->
  </div>
  
</div>