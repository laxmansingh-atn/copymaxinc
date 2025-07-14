<?php 
	//echo "<pre>";print_r($front_cover_data);die("in view");
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
                                                    <?php if(!empty($value['dimension_value'])) : ?>
                                                        <?php $count = 0; ?>
                                                        <?php foreach ($value['dimension_value'] as $key2 => $value2) : ?>
                                                            <?php if($value2['page_side'] == "1-sided") : ?>
                                                                <tr>
                                                                    <td><input type="number" class="form-control" name="range_from[]" value="<?=$value2['range_from']?>" placeholder="Range From" step="any" required/></td>
                                                                    <td><input type="number" class="form-control"  name="range_to[]" value="<?=($value2['range_to'] == "9223372036854775807")?'0':$value2['range_to']?>" placeholder="Range To" step="any" required/></td>
                                                                    <td><input type="number" class="form-control"  name="price[]" value="<?=$value2['price']?>" placeholder="Price" step="any" required/></td>
                                                                    <?php if($count == 0) : ?>
                                                                        <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
                                                                        <?php $count++; ?>
                                                                    <?php else :?>
                                                                        <td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
                                                                    <?php endif; ?>
                                                                    <input type="hidden" name="dimension[]" value="<?=$value['dimension']?>">
                                                                    <input type="hidden" name="page_side[]" value="1-sided">
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td><input type="number" class="form-control" name="range_from[]" value="" placeholder="Range From" step="any" required/></td>
                                                            <td><input type="number" class="form-control"  name="range_to[]" value="" placeholder="Range To" step="any" required/></td>
                                                            <td><input type="number" class="form-control"  name="price[]" value="" placeholder="Price" step="any" required/></td>
                                                            <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
                                                            <input type="hidden" name="dimension[]" value="<?=$value['dimension']?>">
                                                            <input type="hidden" name="page_side[]" value="1-sided">
                                                        </tr>
                                                    <?php endif; ?>
                                                </table>
                                            </div>
                                            <div class="side">
                                                <h5>2-Sided</h5>
                                                <table class="form-table" id="customFields2" border="0" cellspacing="2" cellpadding="2" width="100%">
                                                    <?php if(!empty($value['dimension_value'])) : ?>
                                                        <?php $count = 0; ?>
                                                        <?php foreach ($value['dimension_value'] as $key2 => $value2) : ?>
                                                            <?php if($value2['page_side'] == "2-sided") : ?>
                                                                <tr>
                                                                    <td><input type="number" class="form-control" name="range_from[]" value="<?=$value2['range_from']?>" placeholder="Range From" step="any" required/></td>
                                                                    <td><input type="number" class="form-control"  name="range_to[]" value="<?=($value2['range_to'] == "9223372036854775807")?'0':$value2['range_to']?>" placeholder="Range To" step="any" required/></td>
                                                                    <td><input type="number" class="form-control"  name="price[]" value="<?=$value2['price']?>" placeholder="Price" step="any" required/></td>
                                                                    <?php if($count == 0) : ?>
                                                                        <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
                                                                        <?php $count++; ?>
                                                                    <?php else :?>
                                                                        <td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
                                                                    <?php endif; ?>
                                                                    <input type="hidden" name="dimension[]" value="<?=$value['dimension']?>">
                                                                    <input type="hidden" name="page_side[]" value="2-sided">
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td><input type="number" class="form-control" name="range_from[]" value="" placeholder="Range From" step="any" required/></td>
                                                            <td><input type="number" class="form-control"  name="range_to[]" value="" placeholder="Range To" step="any" required/></td>
                                                            <td><input type="number" class="form-control"  name="price[]" value="" placeholder="Price" step="any" required/></td>
                                                            <td><a href="javascript:void(0);" id="" class="add-bttn addCF2">Add</a></td>
                                                            <input type="hidden" name="dimension[]" value="<?=$value['dimension']?>">
                                                            <input type="hidden" name="page_side[]" value="2-sided">
                                                        </tr>
                                                    <?php endif; ?>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="add-on side">
                                <h5>Add On</h5>
                                <?php if(!empty($product_paper)): ?>
                                    <?php foreach ($product_paper as $key => $value) : ?>
                                        <?php if(!empty($value['attribute'])) : ?>
                                            <?php foreach ($value['attribute'] as $key2 => $value2) : ?>
                                                <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
                                                    <tr>
                                                        <td width="40%">
                                                            <select name="page_type[]">
                                                                <?php foreach ($value['master'] as $key3 => $value3) : ?>
                                                                    <option <?php if($value2['page_type'] == $value3['attr_value']){echo "selected";} ?>><?=$value3['attr_value']?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td width="40%">
                                                            <select name="page_dimension[]">
                                                                <?php foreach ($printing_attributes as $key4 => $value4) : ?>
                                                                    <option <?php if($value2['dimension'] == $value4['dimension']){echo "selected";} ?>><?=$value4['dimension']?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td width="20%"><input type="number" class="form-control"  name="page_price[]" value="<?=$value2['price']?>" placeholder="Price" step="any" required /></td>
                                                        <?php if($key2 == 0): ?>
                                                            <td><a href="javascript:void(0);" id="" class="add-bttn addCF3">Add</a></td>
                                                        <?php else: ?>
                                                            <td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
                                                        <?php endif; ?>
                                                        <input type="hidden" name="paper_group_id[]" value="<?=$value['paper_type_group_id']?>">
                                                    </tr>
                                                </table>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
                                                <tr>
                                                    <td width="40%">
                                                        <select name="page_type[]">
                                                            <?php foreach ($value['master'] as $key3 => $value3) : ?>
                                                                <option><?=$value3['attr_value']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>

                                                    <td width="40%">
                                                            <select name="page_dimension[]">
                                                                <?php foreach ($printing_attributes as $key4 => $value4) : ?>
                                                                    <option><?=$value4['dimension']?></option>
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
					<h5>Front Cover Option</h5>
					<?php if (isset($front_cover_data))
						{
							foreach ($front_cover_data as $value)
							{ ?>			
								<table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
								<tbody>							  
								<tr>								 
								<td width="40%">									
								<select name="front_cover_type[]">									
								<option <?php if ($value['front_cover_type'] == "clear-cover")
								{
									echo "selected";
								} ?> value="clear-cover">Clear cover</option>									
								<option <?php if ($value['front_cover_type'] == "frosty-clear-cover")
								{
									echo "selected";
								} ?> value="frosty-clear-cover">Frosty clear cover</option>									
								<option <?php if ($value['front_cover_type'] == "black-vinyl")
								{
									echo "selected";
								} ?> value="black-vinyl">Black Vinyl</option>									
								<option <?php if ($value['front_cover_type'] == "blue-vinyl")
								{
									echo "selected";
								} ?> value="blue-vinyl">Blue Vinyl</option>									
								<option <?php if ($value['front_cover_type'] == "white-vinyl")
								{
									echo "selected";
								} ?> value="white-vinyl">White Vinyl</option>									
								</select>								 
								</td>								 
								<td width="20%"><input type="number" class="form-control" name="front_cover_price[]" value="<?php echo $value['price']; ?>" placeholder="Price" step="any" required=""></td>								 
								<td><a href="javascript:void(0);" id="" class="add-bttn addCF3">Add</a></td>								 
								<input type="hidden" name="paper_group_id[]" value="81">							  
								</tr>						   
								</tbody>						
								</table>													
								<?php
							}
						}
						else
						{ ?>
						<table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">	
						<tbody>							  
						<tr>								 
						<td width="40%">									
						<select name="front_cover_type[]">									
						<option value="clear-cover">Clear cover</option>									
						<option value="frosty-clear-cover">Frosty clear cover</option>									
						<option value="black-vinyl">Black Vinyl</option>									
						<option value="blue-vinyl">Blue Vinyl</option>									
						<option value="white-vinyl">White Vinyl</option>									
						</select>								 
						</td>								 
						<td width="20%"><input type="number" class="form-control" name="front_cover_price[]" value="" placeholder="Price" step="any" required=""></td>								 
						<td><a href="javascript:void(0);" id="" class="add-bttn addCF3">Add</a></td>								 
						<input type="hidden" name="paper_group_id[]" value="81">							  
						</tr>						  
						</tbody>						
						</table>																						
						<?php
						} ?>
						
						<h3 style="margin-left: 15px;">8.5x5.5</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  
							  
							  
							 
								  
										  
										  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
										   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
									
									
										
										
										
								
							   </div>
							   <h3 style="margin-left: 15px;">2-Sided</h3>
							   <div class="side">
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
										   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
							 
						   </div>
						</div>
						
						<h3 style="margin-left: 15px;">5x7</h3>
							<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
							 	<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						</div>
						
						
						<h3 style="margin-left: 15px;">8.5x11</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
							 	<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						</div>
						
						<h3 style="margin-left: 15px;">8x8</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
							 	<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						</div>
						
												<h3 style="margin-left: 15px;">8x10</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
							 	<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
						   </div>
						</div>

                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="submit" name="complete" value="complete" class="btn btn-primary">Complete</button></li>
                            <li><button type="submit" name="update" value="update" class="btn btn-primary">Update & Continue</button></li>
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