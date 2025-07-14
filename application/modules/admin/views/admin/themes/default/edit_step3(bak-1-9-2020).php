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
					<hr>		
					<h4>Front Cover Option and Back Cover Option</h4>
					<?php if (!(empty($front_cover_data)))
						{
							 $count = 0; 
							foreach ($front_cover_data as $value)
							{ ?>			
								<table class="form-table" id="customFields3" border="0" cellspacing="2" cellpadding="2" width="100%">
								<tbody>							  
								<tr>								 
								<td width="40%">									
								<select name="front_cover_type[]">									
								<option <?php if ($value['front_cover_type'] == "clear-cover-7")
								{
									echo "selected";
								} ?> value="clear-cover-7">Clear cover 7 mil</option>
								<option <?php if ($value['front_cover_type'] == "clear-cover-10")
								{
									echo "selected";
								} ?> value="clear-cover-10">Clear cover 10 mil</option>
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
								 <?php if($count == 0) : ?>
                                  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
								   <?php $count++; ?>
								<?php else :?>
									<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
								<?php endif; ?>								 
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
						<hr>
						<h3 style="margin-left: 15px;">8.5x5.5</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  
							  <?php
							  
							  if(!(empty($black_and_white_data))){
								 
								   $count = 0;
								   $count_btn = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8.5x5.5" && $value['page_side'] == "1-sided"){ 
										$count++;
									  
									  ?>
										  
										  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
										   <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
										   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
												  <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>		
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
									<? }} if($count == 0){ ?>
									
									
										  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
										   <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
												  
											   </select>
											</td>
										   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
										   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
										
										
								<?php	}}else{?>
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
										     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
										   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
										   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
									
								<?php } ?>
							   </div>
							   <h3 style="margin-left: 15px;">2-Sided</h3>
							   <div class="side">
							   
							   <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count = 0;
								   $count_btn = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8.5x5.5" && $value['page_side'] == "2-sided"){ 
										$count++;
									  
									  ?>
										  
										 <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
										     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
												<option <?php if ($value['page_type'] == "20 lb white")
												{
													echo "selected";
												} ?> value = "20 lb white">20 lb white</option>
												
											  <option <?php if ($value['page_type'] == "80 lb gloss paper")
												{
													echo "selected";
												} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
											  <option <?php if ($value['page_type'] == "100 lb gloss paper")
												{
													echo "selected";
												} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
										   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
										   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
									<? }} if($count == 0){ ?>
									
									
										  <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
										    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
										   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
										   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
										
										
								<?php	}}else{ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
									 <tbody>
										<tr>
										   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
										   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
										    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
										   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
										   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
										   <input type="hidden" name="black_and_white[dimension][]" value="8.5x5.5">
										   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
										   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
										</tr>
									 </tbody>
								  </table>
									
								<?php } ?>
						   </div>
						</div>
						
						<h3 style="margin-left: 15px;">5x7</h3>
							<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  
							  
							  <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count_btn =0;
								   $count = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "5x7" && $value['page_side'] == "1-sided"){ 
										$count++;
									  
									  ?>
										  
										 <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
										 <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									 <table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
									
								<?php } ?>
							  
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
						   
							<?php 
							  
							  if(!(empty($black_and_white_data))){
								  $count_btn = 0;
								   $count = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "5x7" && $value['page_side'] == "2-sided"){ 
										$count++;
									  
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="5x7">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
									
								<?php } ?>
								
						   </div>
						</div>
						
						
						<h3 style="margin-left: 15px;">8.5x11</h3>
						<div class="custom-field-inner">
						   <div class="side">
						      
							  <h5>1-Sided</h5>
							  
							  
							  <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count = 0;
								   $count_btn = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8.5x11" && $value['page_side'] == "1-sided"){ 
										$count++;
									  
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
												<option <?php if ($value['page_type'] == "20 lb white")
												{
													echo "selected";
												} ?> value = "20 lb white">20 lb white</option>
												
											  <option <?php if ($value['page_type'] == "80 lb gloss paper")
												{
													echo "selected";
												} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
											  <option <?php if ($value['page_type'] == "100 lb gloss paper")
												{
													echo "selected";
												} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									  <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
								
								
								<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
								<?php } ?>
							  
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
								
								<?php 
							  
							  if(!(empty($black_and_white_data))){
								  $count_btn = 0;
								   $count = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8.5x11" && $value['page_side'] == "2-sided"){ 
										$count++;
									  
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8.5x11">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
								<?php } ?>
						   
						   </div>
						</div>
						
						<h3 style="margin-left: 15px;">8x8</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  
							  <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count = 0;
								   $count_btn = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8x8" && $value['page_side'] == "1-sided"){ 
										$count++;
									  
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									   
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
						
											  <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
											
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
								<?php } ?>
							  
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
						   
						   
						    <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count = 0;
								   $count_btn = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8x8" && $value['page_side'] == "2-sided"){ 
										$count++;
									  
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									  <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x8">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
								<?php } ?>
						   
						 
						   </div>
						</div>
						
						<h3 style="margin-left: 15px;">8x10</h3>
						<div class="custom-field-inner">
						   <div class="side">
							  <h5>1-Sided</h5>
							  
							  <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count_btn = 0;
								   $count = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8x10" && $value['page_side'] == "1-sided"){ 
										$count++;
									  
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									    <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="1-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									
									
								<?php } ?>
							  
						   </div>
						   <h3 style="margin-left: 15px;">2-Sided</h3>
						   <div class="side">
						   
							 <?php 
							  
							  if(!(empty($black_and_white_data))){
								   $count = 0;
								   $count_btn = 0;
								  foreach($black_and_white_data as $value){
									 
									  if($value['dimension'] == "8x10" && $value['page_side'] == "2-sided"){ 
										$count++;
									  ?>
										  
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="<?php echo $value['range_from'] ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="<?php echo $value['range_to'] ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="<?php echo $value['price'] ?>" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option <?php if ($value['page_type'] == "90 lb white cardstock")
													{
														echo "selected";
													} ?>
												  value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb green cardstock")
													{
														echo "selected";
													} ?> value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb blue cardstock")
													{
														echo "selected";
													} ?> value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb canary cardstock")
													{
														echo "selected";
													} ?> value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb ivory cardstock")
													{
														echo "selected";
													} ?> value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb cherry cardstock")
													{
														echo "selected";
													} ?> value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gold cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb salmon cardstock")
													{
														echo "selected";
													} ?> value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb buff cardstock")
													{
														echo "selected";
													} ?> value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb orchid cardstock")
													{
														echo "selected";
													} ?> value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option <?php if ($value['page_type'] == "90 lb gray cardstock")
													{
														echo "selected";
													} ?> value = "90 lb gray cardstock">90 lb gray cardstock</option>
													
													<option <?php if ($value['page_type'] == "20 lb white")
													{
														echo "selected";
													} ?> value = "20 lb white">20 lb white</option>
													
												  <option <?php if ($value['page_type'] == "80 lb gloss paper")
													{
														echo "selected";
													} ?> value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option <?php if ($value['page_type'] == "100 lb gloss paper")
													{
														echo "selected";
													} ?> value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option <?php if ($value['ink_type'] == "Black and White")
												{
													echo "selected";
												} ?> value="Black and White">Black and White</option>
											  <option <?php if ($value['ink_type'] == "Color Copies")
												{
													echo "selected";
												} ?> value="Color Copies">Color Copies</option>
											</select></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
									<? }} if($count == 0){ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
										
										
								<?php	}}else{ ?>
									
									
									<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									   <td><input type="number" class="form-control" name="black_and_white[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="black_and_white[price][]" value="" placeholder="Price" step="any" required=""></td>
									     <td width="20%">
											   <select name="black_and_white[page_type][]">
												  <option value = "90 lb white cardstock">90 lb white cardstock</option>
												  <option value = "90 lb green cardstock">90 lb green cardstock</option>
												  <option value = "90 lb blue cardstock">90 lb blue cardstock</option>
												  <option value = "90 lb canary cardstock">90 lb canary cardstock</option>
												  <option value = "90 lb ivory cardstock">90 lb ivory cardstock</option>
												  <option value = "90 lb cherry cardstock">90 lb cherry cardstock</option>
												  <option value = "90 lb gold cardstock">90 lb gold cardstock</option>
												  <option value = "90 lb salmon cardstock">90 lb salmon cardstock</option>
												  <option value = "90 lb buff cardstock">90 lb buff cardstock</option>
												  <option value = "90 lb orchid cardstock">90 lb orchid cardstock</option>
												  <option value = "90 lb gray cardstock">90 lb gray cardstock</option>
												  <option value = "20 lb white">20 lb white</option>
												  <option value = "80 lb gloss paper">80 lb gloss paper</option>
												  <option value = "100 lb gloss paper">100 lb gloss paper</option>
											   </select>
											</td>
									   <td><select class="form-control" name="black_and_white[ink_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="black_and_white[dimension][]" value="8x10">
									   <input type="hidden" name="black_and_white[page_side][]" value="2-sided">
									   <input type="hidden" name="black_and_white[attr_type][]" value="black and white">
									</tr>
								 </tbody>
							  </table>
								<?php } ?>
							<hr>	
							<h4>Coil Binding Cost</h4>
							
							<?php
								if(!(empty($coil_binding_cost_data))){?>
								
								<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
								 
								 <?php $count_btn = 0; 
								 foreach($coil_binding_cost_data as $Key=>$value){ ?>
									<tr>
									 <td width="20%">
											   <select name="coil_binding_cost[sheets][]">
												  <option <?php if($value['sheets'] == "1 to 15 sheets"){
												  echo "selected";} ?>
												  value = "1 to 15 sheets">1 to 15 sheets</option>
												  <option <?php if($value['sheets'] == "16 to 25 sheets"){
												  echo "selected";} ?> value = "16 to 25 sheets">16 to 25 sheets</option>
												  <option <?php if($value['sheets'] == "26 to 50 sheets"){
												  echo "selected";} ?> value = "26 to 50 sheets">26 to 50 sheets</option>
												  <option <?php if($value['sheets'] == "51 to 120 sheets"){
												  echo "selected";} ?> value = "51 to 120 sheets">51 to 120 sheets</option>
												  <option <?php if($value['sheets'] == "121 to 170 sheets"){
												  echo "selected";} ?> value = "121 to 170 sheets">121 to 170 sheets</option>
												  <option <?php if($value['sheets'] == "171 to 240 sheets"){
												  echo "selected";} ?> value = "171 to 240 sheets">171 to 240 sheets</option>
												  <option <?php if($value['sheets'] == "241 to 270 sheets"){
												  echo "selected";} ?> value = "241 to 270 sheets">241 to 270 sheets</option>
												  <option <?php if($value['sheets'] == "271 to 380 sheets"){
												  echo "selected";} ?> value = "271 to 380 sheets">271 to 380 sheets</option>
												  <option <?php if($value['sheets'] == "381 to 420 sheets"){
												  echo "selected";} ?> value = "381 to 420 sheets">381 to 420 sheets</option>    
											   </select>
											</td>
									   <td><input type="number" class="form-control" name="coil_binding_cost[range_from][]" value="<?php echo $value['range_from']; ?>" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="coil_binding_cost[range_to][]" value="<?php echo $value['range_to']; ?>" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="coil_binding_cost[price][]" value="<?php echo $value['price']; ?>" placeholder="Price" step="any" required=""></td>
									   <?php if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php $count_btn++; ?>
												<?php else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php endif; ?>	
									   <input type="hidden" name="coil_binding_cost[attr_type][]" value="coil binding cost">
									</tr>
								 <?php } ?>
								 </tbody>
							  </table>
							  
								<?php }else{ ?>
								
								<table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									 <td width="20%">
											   <select name="coil_binding_cost[sheets][]">
												  <option value = "1 to 15 sheets">1 to 15 sheets</option>
												  <option value = "16 to 25 sheets">16 to 25 sheets</option>
												  <option value = "26 to 50 sheets">26 to 50 sheets</option>
												  <option value = "51 to 120 sheets">51 to 120 sheets</option>
												  <option value = "121 to 170 sheets">121 to 170 sheets</option>
												  <option value = "171 to 240 sheets">171 to 240 sheets</option>
												  <option value = "241 to 270 sheets">241 to 270 sheets</option>
												  <option value = "271 to 380 sheets">271 to 380 sheets</option>
												  <option value = "381 to 420 sheets">381 to 420 sheets</option>    
											   </select>
											</td>
									   <td><input type="number" class="form-control" name="coil_binding_cost[range_from][]" value="" placeholder="Range From" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="coil_binding_cost[range_to][]" value="" placeholder="Range To" step="any" required=""></td>
									   <td><input type="number" class="form-control" name="coil_binding_cost[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="coil_binding_cost[attr_type][]" value="coil binding cost">
									</tr>
								 </tbody>
							  </table>
								
									
									
									
								<?php } ?>
								
								<!--h4> Front Cover Option</h4-->
								
								<?php
								//if(!(empty($front_cover_price_data))){ 
							
								?>
									
									<!--table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
								 <?php 
								 /* $count_btn = 0;
								 foreach($front_cover_price_data as $value){ */ ?>
									<tr>
									 <td width="20%">
											   <select name="front_cover_option[dimension][]">
												  <option <?php //if($value['dimension'] == "8.5x5.5"){
													  //echo "selected";
													  
												  //} ?> value = "8.5x5.5">8.5x5.5</option>
												  <option <?php //if($value['dimension'] == "5x7"){
													  //echo "selected";
													  
												  //} ?> value = "5x7">5x7</option>
												  <option <?php //if($value['dimension'] == "8.5x11"){
													 // echo "selected";
													  
												  //} ?> value = "8.5x11">8.5x11</option>
												  <option <?php //if($value['dimension'] == "8x8"){
													  //echo "selected";
													  
												  //} ?>  value = "8x8">8x8</option>
												  <option <?php //if($value['dimension'] == "8x10"){
													  //echo "selected";
													  
												  //} ?> value = "8x10">8x10</option>  
											   </select>
											</td>
									   <td><select name="front_cover_option[sides][]">
												  <option <?php //if($value['sides'] == "1-Sided"){
													  //echo "selected";
													  
												  //} ?> value = "1-Sided">1-Sided</option>
												  <option <?php //if($value['sides'] == "2-Sided"){
													  //echo "selected";
													  
												  //} ?> value = "2-Sided">2-Sided</option>
											</select></td>
									  <td><select class="form-control" name="front_cover_option[color_type][]">
											  <option <?php //if($value['ink_type'] == "Black and White"){
													  //echo "selected";
													  
												  //} ?> value="Black and White">Black and White</option>
											  <option <?php //if($value['ink_type'] == "Color Copies"){
													  //echo "selected";
													  
												  //} ?>value="Color Copies">Color Copies</option>
											</select></td>
									  <td><select class="form-control" name="front_cover_option[paper_type][]">
											  <option value="20 lb white"<?php //if($value['page_type'] == "20 lb white"){
													  //echo "selected";
													  
												  //} ?>>20 lb white</option>
											  <option value="80 lb matte paper"<?php //if($value['page_type'] == "80 lb matte paper"){
													  //echo "selected";
													  
												  //} ?>>80 lb matte paper</option>
											  <option value="100 lb matte paper"<?php //if($value['page_type'] == "80 lb matte paper"){
													  //echo "selected";
													  
												  //} ?>>100 lb matte paper</option>
											</select></td>
											  <td><input type="number" class="form-control" name="front_cover_option[price][]" value="<?php //echo $value['price'];?>" placeholder="Price" step="any" required=""></td>
									   <?php //if($count_btn == 0) : ?>
												  <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
												   <?php //$count_btn++; ?>
												<?php //else :?>
													<td><a href="javascript:void(0);" id="" class="add-bttn remCF">Remove</a></td>
												<?php //endif; ?>	
									   <input type="hidden" name="front_cover_option[attr_type][]" value="front cover">
									</tr>
								 <?php //} ?>
								 </tbody>
							  </table-->
								 <?php //}else{ ?>
									
									<!--table class="form-table" id="customFields1" border="0" cellspacing="2" cellpadding="2" width="100%">
								 <tbody>
									<tr>
									 <td width="20%">
											   <select name="front_cover_option[dimension][]">
												  <option value = "8.5x5.5">8.5x5.5</option>
												  <option value = "5x7">5x7</option>
												  <option value = "8.5x11">8.5x11</option>
												  <option value = "8x8">8x8</option>
												  <option value = "8x10">8x10</option>  
											   </select>
											</td>
									   <td><select name="front_cover_option[sides][]">
												  <option value = "1-Sided">1-Sided</option>
												  <option value = "2-Sided">2-Sided</option>
											</select></td>
									  <td><select class="form-control" name="front_cover_option[color_type][]">
											  <option value="Black and White">Black and White</option>
											  <option value="Color Copies">Color Copies</option>
											</select></td>
									  <td><select class="form-control" name="front_cover_option[paper_type][]">
											  <option value="20 lb white">20 lb white</option>
											  <option value="80 lb matte paper">80 lb matte paper</option>
											  <option value="100 lb matte paper">100 lb matte paper</option>
											</select></td>
											  <td><input type="number" class="form-control" name="front_cover_option[price][]" value="" placeholder="Price" step="any" required=""></td>
									   <td><a href="javascript:void(0);" id="" class="add-bttn addCF1">Add</a></td>
									   <input type="hidden" name="front_cover_option[attr_type][]" value="front cover">
									</tr>
								 </tbody>
							  </table-->
								<?php //} ?>
								

						   
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