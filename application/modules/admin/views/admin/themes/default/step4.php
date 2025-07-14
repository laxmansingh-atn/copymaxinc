<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
        <h1>Finishing Attributes</h1>
		<div class="row">
            <section>
                <div class="tab-content">
                    <form action="" method="post">
                        <div class="custom-field">
                            <div class="add-on side">
                                <h5>Divider</h5>
                                <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="20%">
                                    <tr>
                                        <td width="20%"><input type="number" class="form-control"  name="divider_price" value="" placeholder="Price" step="any" required /></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="add-on side">
                                <h5>Stapling</h5>
                                <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
                                    <tr>
                                        <td width="20%">
                                            <select name="stapling_type[]" required>
                                                <option value="top-left">Portrait top left</option>
                                                <option value="2-staple">2 staples on the spine</option>
                                            </select>
                                        </td>
                                        <td width="12%">
                                            <select name="stapling_side[]" required>
                                                <option value="1-sided">1 Sided</option>
                                                <option value="2-sided">2 Sided</option>
                                            </select>
                                        </td>
                                        <td width="11%">
                                            <select name="stapling_dimension[]" required>
                                                <option value="8.5x5.5">8.5x5.5 </option>
                                                <option value="4.25x11">4.25x11</option>
                                                <option value="4.25x5.5">4.25x5.5</option>
                                                <option value="11x17">11x17</option>
                                                <option value="8.5x11"> 8.5x11</option>
                                                <option value="8.5x14">8.5x14</option>
                                                <option value="8.5x7">8.5x7</option>
                                            </select>
                                        </td>
                                        <td width="12%">
                                            <select name="stapling_page_type[]" required>
                                                <option value="collated">Collated</option>
                                            </select>
                                        </td>
                                        <td width="15%"><input type="number" class="form-control"  name="stapling_from[]" value="" placeholder="From" step="any" required /></td>
                                        <td width="15%"><input type="number" class="form-control"  name="stapling_to[]" value="" placeholder="To" step="any" required /></td>
                                        <td width="15%"><input type="number" class="form-control"  name="stapling_price[]" value="" placeholder="Price" step="any" required /></td>
                                        <td><a href="javascript:void(0);" id="" class="add-bttn addCF3">Add</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="add-on side">
                                <h5>3 Hole Punch</h5>
                                <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
                                    <tr>
                                        <td width="20%">
                                            <select name="hole_side[]" required>
                                                <option value="1-sided">1 Sided</option>
                                                <option value="2-sided">2 Sided</option>
                                            </select>
                                        </td>
                                        <td width="20%">
                                            <select name="hole_dimension[]" required>
                                                <option value="8.5x5.5">8.5x5.5 </option>
                                                <option value="4.25x11">4.25x11</option>
                                                <option value="4.25x5.5">4.25x5.5</option>
                                                <option value="11x17">11x17</option>
                                                <option value="8.5x11"> 8.5x11</option>
                                                <option value="8.5x14">8.5x14</option>
                                                <option value="8.5x7">8.5x7</option>
                                            </select>
                                        </td>
                                        <td width="20%"><input type="number" class="form-control"  name="hole_price[]" value="" placeholder="Price" step="any" required /></td>
                                        <td><a href="javascript:void(0);" id="" class="add-bttn addCF2">Add</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="add-on side">
                                <h5>Folding</h5>
                                <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="50%">
                                    <tr>
                                        <td width="15%">
                                            <select name="folding_page_type" required>
                                                <option value="uncollated">Uncollated</option>
                                            </select>
                                        </td>
                                        <td width="30%">
                                            <select class="js-example-basic-multiple" name="page_types[]" multiple="multiple" required>
                                                <?php foreach ($master_paper_group as $key => $value) : ?>
                                                    <option value="<?=$value['id']?>"><?=$value['attr_value']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td width="30%">
                                            <select class="js-example-basic-multiple" name="folding_dimension[]" multiple="multiple" required>
                                                <option value="8.5x5.5">8.5x5.5 </option>
                                                <option value="4.25x11">4.25x11</option>
                                                <option value="4.25x5.5">4.25x5.5</option>
                                                <option value="11x17">11x17</option>
                                                <option value="8.5x11"> 8.5x11</option>
                                                <option value="8.5x14">8.5x14</option>
                                                <option value="8.5x7">8.5x7</option>
                                            </select>
                                        </td>
                                        <td width="10%"><input type="number" class="form-control"  name="folding_price" value="" placeholder="Price" step="any" required /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="submit" class="btn btn-primary">Save & Continue</button></li>
                        </ul>
                    </form>
                </div>
            </section>
		</div>
    </div>
    <!-- /.container-fluid -->
</div>
<style>
#customFields {
    width: 100%;
}
.side h5 {
    color: #000;
    font-size: 24px;
    font-weight: 700;
    margin: 0;
}
.custom-field-inner {
    padding-left: 50px;
}
.form-table td input {
    border: 1px solid #ccc;
    padding: 6px 15px;
    width: 100%;
}
    .form-table td select {
    border: 1px solid #ccc;
    padding: 6px 15px;
    width: 100%;
}
    .form-table td {
    padding: 5px;
}
.add-bttn {
    background: linear-gradient(to bottom, #62c462, #51a351);
    color: #fff;
    padding: 9px 28px;
}
.remCF {
    background: linear-gradient(to bottom, #ee5f5b, #bd362f);
    color: #fff !important;
    padding: 8px 15px;
    text-decoration: none;
}
.side {
    margin-bottom: 15px;
}
    .add-on {
    padding-top: 24px;
    margin-top: 36px;
}
</style>
<script>
$(document).ready(function(){
    $('.js-example-basic-multiple').select2();
    $(".addCF2").click(function(){
        $(this).parent().parent().parent().parent().parent().append('<table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%"> <tr> <td width="20%"> <select name="hole_side[]" required> <option value="1-sided">1 Sided</option> <option value="2-sided ">2 Sided</option> </select> </td><td width="20%"> <select name="hole_dimension[]" required> <option value="8.5x5.5">8.5x5.5 </option> <option value="4.25x11">4.25x11</option> <option value="4.25x5.5">4.25x5.5</option> <option value="11x17">11x17</option> <option value="8.5x11"> 8.5x11</option> <option value="8.5x14">8.5x14</option> <option value="8.5x7">8.5x7</option> </select> </td><td width="20%"><input type="number" class="form-control" name="hole_price[]" value="" placeholder="Price" step="any" required/></td><td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td></tr></table>');
    });
    $(".addCF3").click(function(){
        $(this).parent().parent().parent().parent().parent().append('<table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%"> <tr> <td width="20%"> <select name="stapling_type[]" required> <option value="top-left">Portrait top left</option> <option value="2-staple">2 staples on the spine</option> </select> </td><td width="20%"> <select name="stapling_side[]" required> <option value="1-sided">1 Sided</option> <option value="2-sided ">2 Sided</option> </select> </td><td width="15%"> <select name="stapling_dimension[]" required> <option value="8.5x5.5">8.5x5.5 </option> <option value="4.25x11">4.25x11</option> <option value="4.25x5.5">4.25x5.5</option> <option value="11x17">11x17</option> <option value="8.5x11"> 8.5x11</option> <option value="8.5x14">8.5x14</option> <option value="8.5x7">8.5x7</option> </select> </td><td width="15%"><input type="number" class="form-control" name="stapling_from[]" value="" placeholder="From" step="any" required/></td><td width="15%"><input type="number" class="form-control" name="stapling_to[]" value="" placeholder="To" step="any" required/></td><td width="15%"><input type="number" class="form-control" name="stapling_price[]" value="" placeholder="Price" step="any" required/></td><td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td></tr></table>');
    })
});
$(document).on('click',".remCF",function(){
    $(this).parent().parent().remove();
});
</script>