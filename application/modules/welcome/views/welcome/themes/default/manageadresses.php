<div class="page_inner">
  <div class="container">
    <div class="row clearfix">
      <!--<div class="col-md-4 col-sm-4">
         <div class="account_infoside">
           <div class="ac">
            <h3>ACCOUNT</h3>
            <ul class="accountLink">
              <li><a href="#">Order History</a></li>
              <li><a href="#">Manage Addresses</a></li>
              <li><a href="#">Manage Credit Cards</a></li>
              <li><a href="#">Settings</a></li>
            </ul>
          </div> 
          <div class="ac">
            <h3>NEED ASSISTANCE?</h3>
            <ul class="needAssistance">
              <li><a href="#">1-234-567-890</a></li>
              <li><a href="#">Send Us An Email</a></li>
            </ul>
          </div>
        </div> 
      </div>-->
      <div class="col-md-12 col-sm-12 border_left">
        <div class="saved_address">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Account Center</a></li>
              <li class="breadcrumb-item active" aria-current="page">Manage Addresses</li>
            </ol>
          </nav>
          <div class="addrss_heading">
            <h1 class="heading">Saved Addresses</h1>
          </div>
          <div class="update_adres">
            <div class="row clearfix">
             
              <div class="col-md-12">
                <div class="update_notes">
              <?php
                  if($page_content){
                ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                                      <tr>
                                        <th>Address Title</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Zip Code</th>
                                        <th> Action </th>
                                      </tr>
                                    </thead>
                            <tbody>
                  <?php
                                  //  print_r($page_content); die;
                  foreach($page_content as $key=>$results)
                  {
                  ?>
                    <tr>
                                        <td><?= $results['title']?></td>
                                        <td><?= $results['first_name']?></td>
                                        <td><?= $results['address'];?></td>
                                        <td><?= $results['city'];?></td>
                                        <td><?= $results['state'];?></td>
                                        <td><?= $results['zip_code']; ?></td>
                                        <td><a id="edit" class="cstm_view" href="javascript:void(0);" title1="<?= $results['user_id']?>" title="<?= $results['id']?>"><i class="glyphicon glyphicon-edit"></i></a><a id="delete" class="cstm_del" href="javascript:void(0);" tit="<?= $results['user_id']?>" tit1="<?= $results['id']?>"><i class="glyphicon glyphicon-remove"></i></a></td>
                                      </tr>
                  <?php
                                    }
                  ?>
                                    </tbody>
                  </table>
                   <?php
                       }
                       else{
                   ?>
                              <p>You currently do not have any saved addresses. </p>
                              <p>Please click on the button below to add a new address. </p>
                   <?php
                       }
                   ?>
                </div>
              </div>
            </div>
          </div>
          <div class="search_address">
             <?php
                     if($this->session->flashdata('success_message')){
                 ?>
                          <div class="col-md-12 alert alert-success"><?= $this->session->flashdata('success_message');?></div>
                <?php
                        }
                  ?>
            <div class="row clearfix">
               <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                <div class="form-group">
                    <label>Address Title:</label>
                    <input type="text" class="form-control" name="title" required="required">
                  </div>
                  <div class="form-group">
                    <label>Name:</label>
                    <div class="row clearfix">
                      <div class="col-md-6">
                        <input type="text" placeholder="First Name" class="form-control"  name="first_name" required="required">
                      </div>
                      <div class="col-md-6">
                        <input type="text" placeholder="Last Name" class="form-control" name="last_name">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Company:</label>
                    <input type="text" class="form-control" name="company">
                  </div>
                  <div class="form-group">
                    <label>Address:</label>
                    <input type="text" class="form-control" name="address" required="required">
                  </div>
                  <div class="form-group">
                    <label>Email:</label>
                    <input type="text" class="form-control" name="email">
                  </div>
                </div>

                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City:</label>
                    <input type="text" class="form-control" name="city">
                  </div>
                  <div class="form-group">
                    <label>State:</label>
                    <input type="text" class="form-control" name="state">
                  </div>
                  <div class="form-group">
                    <label>Zipcode:</label>
                    <input type="text" class="form-control" name="zip_code">
                  </div>
                  <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" class="form-control" name="phone">
                  </div>
                  
                 
                </div>
                <div class="col-md-12">
                  <div class="text-right srch_address">
                    <input type="submit" name="submit" value="Add new address" class="btn btn-success"> 
                  </div>
                </div>
              </form>
            </div>
          </div>
           
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Modal -->
    <div class="modal" id='myModal'>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Details</h4>
              </div>
              <div class="modal-body" id='modalContent2' title="">
                   <div class="search_address">
                <div class="row clearfix">
                   <form action="<?php echo base_url('welcome/index/update_manage_addresses');?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tbl_user_address_id" id="tbl_user_address_id">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label>Address Title:</label>
                    <input type="text" class="form-control" name="title" id="title" required="required">
                  </div>
                    
                      <div class="form-group">
                        <label>Name:</label>
                        <div class="row clearfix">
                          <div class="col-md-6">
                            <input type="text" placeholder="First Name" class="form-control" id="first_name" name="first_name" required="required">
                          </div>
                          <div class="col-md-6">
                            <input type="text" placeholder="Last Name" class="form-control" id="last_name" name="last_name">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Company:</label>
                        <input type="text" class="form-control" name="company" id="company" >
                      </div>
                      <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" name="address" id="address"  required="required">
                      </div>
                      <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" id="email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>City:</label>
                        <input type="text" class="form-control" name="city" id="city">
                      </div>
                      <div class="form-group">
                        <label>State:</label>
                        <input type="text" class="form-control" name="state" id="state">
                      </div>
                      <div class="form-group">
                        <label>Zipcode:</label>
                        <input type="text" class="form-control" name="zip_code" id="zip_code">
                      </div>
                      <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                      </div>
                      
                    </div>
                    
                  
                </div>
              </div>
              </div>
              <div class="modal-footer">
              <input type="submit" name="submit" value="Update" class="btn btn-success">  
              </div>
            </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    <!-- Modal -->
      <div class="modal" id='myModal2'>
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <form action="<?php echo base_url('welcome/index/delete_manage_addresses');?>" method="post" enctype="multipart/form-data">
                   <input type="hidden" name="tbl_user_address_id1" id="tbl_user_address_id1">
                    <input type="hidden" name="user_id1" id="user_id1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Message</h4>
              </div>
              <div class="modal-body" id='modalContent' title="">
               <!-- <p>Would you like to continue ?</p>-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <input type="submit" name="submit" value="Ok" class="btn btn-success">  
              </div>
            </div>

            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
           </form>
        </div>