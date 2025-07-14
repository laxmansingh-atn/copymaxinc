<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
        <!-- <li>
                <a href="#"><i class="fa fa-table fa-fw"></i> Banner Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('admin/banner/') ?>"><i class="fa fa-dot-circle-o"></i> Banner</a>
                    </li>
                </ul>
            </li> -->
			<?php 
			if(isset($this->session->userdata['group_name']))
					{
						
					 $group_name = $this->session->userdata['group_name']['usergroup_name'] ;  
					}
					else
					{ 
						echo "";
					}
					//echo $group_name ; 
			if(strtolower($group_name)!="payments" && strtolower($group_name)!="testing" && strtolower($group_name)!="customer review" ){ ?>
			
			<!--<li class="">-->
   <!--                     <a href="#"><i class="fa fa-user"></i> Attribute Management <span class="fa arrow"></span></a>-->
   <!--                     <ul class="nav nav-third-level">-->
   <!--                       <li>-->
   <!--                             <a href="<?= base_url('admin/attributes/attributename') ?>"><i class="fa fa-dot-circle-o"></i> Attributes</a>-->
   <!--                         </li>-->
   <!--                          <li>-->
   <!--                             <a href="<?= base_url('admin/attributes/attributesvalue') ?>"><i class="fa fa-dot-circle-o"></i> Attributes Values</a>-->
   <!--                         </li>-->
   <!--                         <li>-->
   <!--                     <a href="<?= base_url('admin/shipping/') ?>"><i class="fa fa-dot-circle-o"></i> Price value for shipping </a>-->
   <!--                        </li>-->
   <!--                     <li class="">-->
   <!--                 <a href="<?= base_url('admin/shipping/shipping_no_days/') ?>">-->
			<!--		<i class="fa fa-dot-circle-o"></i> Price for no of days </a>-->
   <!--                     </li>						   -->
   <!--                     </ul>-->
   <!--                 </li>-->
			
            <li class="">
                <a href="#"><i class="fa fa-book"></i> Product Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    
                    <li>
                        <a href="<?= base_url('admin/categories/') ?>"><i class="fa fa-dot-circle-o"></i> Category </a>
                    </li>
                    <li>
                    	<a href="<?= base_url('admin/products/') ?>"><i class="fa fa-dot-circle-o"></i> Products </a>
                    </li>
					
                </ul>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-book"></i> Product Weight Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    
                    <li>
                        <a href="<?= base_url('admin/weight_management/') ?>"><i class="fa fa-dot-circle-o"></i> Weight Management </a>
                    </li>
                </ul>
            </li>
			<li>
                <a href="#"><i class="fa fa-cubes fa-fw"></i> Order Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('admin/orders') ?>"><i class="fa fa-dot-circle-o"></i> Orders</a>
                    </li>
                 
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-cubes fa-fw"></i> Content Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('admin/page/') ?>"><i class="fa fa-dot-circle-o"></i> Pages</a>
                    </li>
                 
                   <!--<li>
                        <a href="<?= base_url('admin/news/'); ?>"><i class="fa fa-dot-circle-o"></i> Blogs </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/activity/'); ?>"><i class="fa fa-dot-circle-o"></i> Customer Review </a>
                    </li>-->
                  
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-file-text-o"></i> Coupon Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('admin/coupon') ?>"><i class="fa fa-dot-circle-o"></i> Coupons</a>
                    </li>
                 
                </ul>
            </li>
           
			  <!-- <li>
                <a href="#"><i class="fa fa-user"></i> Order Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('admin/orders/') ?>"><i class="fa fa-dot-circle-o"></i> Orders </a>
				    </li>
					<li>
                        <a href="<?= base_url('admin/testing/order_logs/') ?>"><i class="fa fa-dot-circle-o"></i> Order Logs </a>
					</li>
						
                </ul>
            </li> -->

            
            <li>
                <a href="#"><i class="fa fa-user"></i> User Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                   
                    <li>
                        <a href="<?= base_url('admin/users/userlist/') ?>"><i class="fa fa-dot-circle-o"></i> User List</a>
                    </li>
                    
                </ul>
            </li>
           
            <?php } ?>
         
		<?php   
          	if(strtolower($group_name)=="payments" || strtolower($group_name)=="testing" || strtolower($group_name)=="customer review" || strtolower($group_name)=="admin" ){ ?>
			 <!--<li>
                <a href="#"><i class="fa fa-user"></i> Product Sale Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                 <?php if(strtolower($group_name)=="testing" || strtolower($group_name)=="admin"){ ?>
						 <li>
                        <a href="<?= base_url('admin/testing/') ?>"><i class="fa fa-dot-circle-o"></i> Testing </a>
                    </li>
				 <?php } if(strtolower($group_name)=="payments" || strtolower($group_name)=="admin" ){ ?>
				    <li>
                        <a href="<?= base_url('admin/testing/payment_details') ?>"><i class="fa fa-dot-circle-o"></i> Payment </a>
                    </li>	
                    <?php } ?>
                </ul>
            </li> -->
			<?php } ?>
			
            
           <!-- <li>
                <a href="<?= base_url('admin/requestforquote/') ?>"><i class="fa fa-user"></i> Request For Quote </a>
            </li> -->
			<?php 
          	if(strtolower($group_name)!="payments" && strtolower($group_name)!="testing" && strtolower($group_name)!="customer review" ){ ?>  
           <!-- <li>
                <a href="#"><i class="fa fa-user"></i> Role Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                 
                    <li>
                        <a href="<?= base_url('admin/users/userlist/') ?>"><i class="fa fa-dot-circle-o"></i> User Role List</a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-user"></i> Contact Management <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url('admin/contacts/') ?>"><i class="fa fa-dot-circle-o"></i> Contacts</a>
                    </li>
                    
                </ul>
            </li> --> 
			<?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>