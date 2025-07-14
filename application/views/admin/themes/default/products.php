<div class="mid_section">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-3 col-sm-4">
        <div class="left_sidebar">
          <div class="get_quote">
             </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12">
        <div class="right_panel">
          <div class="product_list">
            <ul>
               <?php
                          foreach($productlist as $key=>$productlists)
                          {
                 ?>
                       <li>
                          <div class="product_itembox"> <img src="<?=base_url('uploads/products').'/'.$productlists->product_image;?>" alt=""> </div>
                          <a href="<?php echo base_url() .'product-details/'.$productlists->product_slug ;?>">
                            <?= $productlists->product_name;?></a> 
                        </li>
                  <?php
                     }
                  ?>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product1.jpg" alt=""> </div>
                <a href="<?php echo base_url();?>product-details/1">Color Copies</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product2.jpg" alt=""> </div>
                <a href="#">Business Cards</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product3.jpg" alt=""> </div>
                <a href="#">Saddle-Stitched Booklets</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product4.jpg" alt=""> </div>
                <a href="#">Perfect Bound Booklets</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product5.jpg" alt=""> </div>
                <a href="#">Postcards</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product6.jpg" alt=""> </div>
                <a href="#">Mini Poster</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product7.jpg" alt=""> </div>
                <a href="#">Spiral Bound Booklets</a> </li>
              <li>
                <div class="product_itembox"> <img src="<?php echo base_url();?>assets/frontend/images/product8.jpg" alt=""> </div>
                <a href="#">Brochures</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>