<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
   <form id="address" method="post" action="<?php echo base_url();?>update_address_details/shipping">
    	<div class="shipping-form">    	
            <div class="shipping-form-outer">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="First Name" name="first_name" id="shipping_first_name" 
                    value="<?php echo $address['first_name'];?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="Last Name" name="last_name" id="shipping_last_name" value="<?php if(!empty($address)){echo $address['last_name'];}?>" required>
                </div>
                <div class="form-group">																			
                    <textarea class="form-control" rows="2" placeholder="Address" name="address" id="shipping_address" required><?php if(!empty($address)){echo $address['address'];}?></textarea>
                </div>
                <div class="form-group">
                    <select class="form-control input-sm" placeholder="Country" name="country" id="shipping_country" 
                    onchange="get_state_list('shipping_country', 'shipping_state')" required>
                        <option>---Select Country---</option>
                        <?php
                        	foreach($country_list as $key=>$value){?>
                        		<option value="<?php echo $key;?>" <?php if(!empty($address) && $address['country_id']==$key){echo "selected";} ?>><?php echo $value;?></option><?php	
                        	}
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control input-sm" placeholder="State" name="state" id="shipping_state" onchange="get_city_list('shipping_state', 'shipping_city')" required>
                        <option>---Select State---</option>
                        <?php
                            if(!empty($state_list)){
                                foreach($state_list as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php if($address['state_id']==$key){echo "selected";} ?>><?php echo $value;?></option><?php  
                                }
                            }    
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control input-sm" name="city" id="shipping_city" required>
                        <option>---Select City---</option>
                        <?php
                            if(!empty($city_list)){
                                foreach($city_list as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php if($address['city_id']==$key){echo "selected";} ?>><?php echo $value;?></option><?php  
                                }
                            }    
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="Zip code" name="zip_code" id="shipping_zipcode" value="<?php if(!empty($address))
                    {echo $address['zip_code'];} ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="Phone" name="phone" id="shipping_phone" value="<?php if(!empty($address)){echo $address['phone'];} ?>" required>
                </div>
                <div class="form-group">																			
                    <input type="email" class="form-control input-sm" placeholder="Email" name="email" id="shipping_email" value="<?php if(!empty($address)){echo $address['email'];} ?>" required>
                </div>
                <div class="form-group">                                                                                                
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
            </div>
        </div>
   </form>
</div>
<div class="clearfix"></div>