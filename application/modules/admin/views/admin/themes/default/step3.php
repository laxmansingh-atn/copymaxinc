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
                    <form action="" method="post">
                        <div class="custom-field">
                            <?php if(!empty($printing_attributes)): ?>
                                <?php foreach ($printing_attributes as $key => $value) : ?>
                                    <?php if ($value['dimension'] != "") : ?>
                                        <h3 style="margin-left: 15px;"><?=$value['dimension']?></h3>
                                        <div class="custom-field-inner">
                                            <div class="side">
                                                <h5>1-Sided</h5>
                                                <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
                                                    <tr>
                                                        <td><input type="number" class="form-control" name="range_from[]" value="" placeholder="Range From" step="any" required/></td>
                                                        <td><input type="number" class="form-control"  name="range_to[]" value="" placeholder="Range To" step="any" required/></td>
                                                        <td><input type="number" class="form-control"  name="price[]" value="" placeholder="Price" step="any" required/></td>
                                                        <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
                                                        <input type="hidden" name="dimension[]" value="<?=$value['dimension']?>">
                                                        <input type="hidden" name="page_side[]" value="1-sided">
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="side">
                                                <h5>2-Sided</h5>
                                                <table class="form-table" id="customFields2" border="0" cellspacing="2" cellpadding="2" width="100%">
                                                    <tr>
                                                        <td><input type="number" class="form-control" name="range_from[]" value="" placeholder="Range From" step="any" required/></td>
                                                        <td><input type="number" class="form-control"  name="range_to[]" value="" placeholder="Range To" step="any" required/></td>
                                                        <td><input type="number" class="form-control"  name="price[]" value="" placeholder="Price" step="any" required/></td>
                                                        <td><a href="javascript:void(0);" id="" class="add-bttn addCF2">Add</a></td>
                                                        <input type="hidden" name="dimension[]" value="<?=$value['dimension']?>">
                                                        <input type="hidden" name="page_side[]" value="2-sided">
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="add-on side">
                                <h5>Add On</h5>
                                <?php if(!empty($printing_attributes)): ?>
                                    <?php foreach ($printing_attributes as $key => $value) : ?>
                                        <?php if($value['paper_type_group_id'] != 0): ?>
                                            <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
                                                <tr>
                                                    <td width="40%">
                                                        <select name="page_type[]">
                                                            <?php foreach ($value['page_types'] as $key2 => $value2) : ?>
                                                                <option><?=$value2['attr_value']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td width="40%">
                                                        <select name="page_dimension[]">
                                                            <?php foreach ($printing_attributes as $key3 => $value3) : ?>
                                                                <option><?=$value3['dimension']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td width="20%"><input type="number" class="form-control"  name="page_price[]" value="" placeholder="Price" step="any" required /></td>
                                                    <td><a href="javascript:void(0);" id="" class="add-bttn addCF3">Add</a></td>
                                                    <input type="hidden" name="paper_group_id[]" value="<?=$value['paper_type_group_id']?>">
                                                </tr>
                                            </table>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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
    border-top: 1px solid #ccc;
    padding-top: 24px;
    margin-top: 36px;
}
</style>
<script>
$(document).ready(function(){
    $(".addCF1").click(function(){
        var html = $(this).parent().parent().html();
        html = html.replace('addCF1', 'remCF');
        html = html.replace('Add', 'Remove');
        $(this).parent().parent().parent().append('<tr>'+html+'</tr>');
    });
    $(".addCF2").click(function(){
        var html = $(this).parent().parent().html();
        html = html.replace('addCF2', 'remCF');
        html = html.replace('Add', 'Remove');
        $(this).parent().parent().parent().append('<tr>'+html+'</tr>');
    });
    $(".addCF3").click(function(){
        var html = $(this).parent().parent().html();
        //console.log(html);
        html = html.replace('addCF3', 'remCF');
        html = html.replace('Add', 'Remove');
        $(this).parent().parent().parent().append("<tr>"+html+"</tr>");
    })
});
$(document).on('click',".remCF",function(){
    //alert();
    $(this).parent().parent().remove();
});
</script>