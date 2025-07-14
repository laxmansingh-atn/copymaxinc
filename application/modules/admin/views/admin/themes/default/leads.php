Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Leads
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">View Leads</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
   
    <!-- Main row -->
    <form>
    <div class="row">
      <div class="col-lg-12">
        <div class="dashboard-body">
          <div class="dashboard-common-heading">
            View Leads
          </div>
          <div class="row">
            <?php //echo "<pre>"; print_r($lead_list);die;?>
            <?php foreach ($lead_list as $key => $value) { ?>
              <div class="col-lg-12">
                <div class="view-lead-wrapper">
                  <div class="row process-heading">
                    <div class="col-lg-6">
                      <?php echo date('l, d M Y h.i A',strtotime($value['created_date']))?>
                    </div>
                    <div class="col-lg-6">
                      <div class="process">
                        <ul>
                          <li class="undone">
                            Delivered
                          </li>
                          <li class="done">
                            Process
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="process-table">
                    <table>
                      <thead>
                        <tr>
                      <th colspan="2">Salesman</th>
                      <th colspan="2">Leads <a href="<?= base_url('admin/admin/edit_leads')."/".$value['id'];?>"><i class="fa fa-pencil-square-o pull-right" aria-hidden="true"></i></a></th>
                      </tr>
                      </thead>
                    <tbody>
                      <tr>
                        <td  width="15%" class="hammer">
                          Sales Person
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['first_name']." ".$value['last_name']?>
                        </td>
                        <td  width="15%" class="hammer">
                          Name
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['cname']." ".$value['csurname']?>
                        </td>
                      </tr>
                      <tr>
                        <td  width="15%" class="hammer">
                          Make
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['make']?>
                        </td>
                        <td  width="15%" class="hammer">
                          Address 1
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['address1']?>
                        </td>
                      </tr>
                      <tr>
                        <td  width="15%" class="hammer">
                          Model
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['model']?>
                        </td>
                        <td  width="15%" class="hammer">
                          Address 2
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['address2']?>
                        </td>
                      </tr>
                      <tr>
                        <td  width="15%" class="hammer">
                          Mobile
                        </td>
                        <td  width="30%" >
                          <?=$value['phone']?>
                        </td>
                        <td  width="15%" class="hammer">
                          City 
                        </td>
                        <td  width="30%" >
                          <table>
                            <tr>
                              <td class="hammer">
                                <?=$value['city_name']?>
                              </td>
                              <td class="hammer">
                                State
                              </td>
                              <td class="hammer">
                                <?=$value['state_name']?>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td  width="15%" class="hammer">
                          Email
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['email']?>
                        </td>
                        <td  width="15%" class="hammer">
                          Post Code
                        </td>
                        <td  width="30%" class="hammer">
                          <?=$value['pcode']?>
                        </td>
                      </tr>
                    </tbody>
                </table>
                  </div>
                </div>
              </div>
            <?php }?>
            <div class="pull-right"><?php echo $this->pagination->create_links();?></div>
            <!-- <div class="row">
              <div class="col-lg-12">
                <div class="pagination">
                  <ul>
                    <li>
                      <a href="" >PREV</a>
                    </li>
                    <li>
                      <a href="" class="active">1</a>
                    </li>
                    <li>
                      <a href="">2</a>
                    </li>
                    <li>
                      <a href="">3</a>
                    </li>
                    <li>
                      <a href="">4</a>
                    </li>
                    <li>
                      <a href="">NEXT</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </form>
    <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper