<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 no-pad-left"> 
        <!--Banner-Part:Start-->
        <div class="inner-banner">
          <div class="container-fluid">
          	<div class="row">
              	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  	<h1 class="title-1 text-center">Contact Us</h1>
                      <ul class="breadcums-list">
                          <li><a href="#">Home</a> /</li>
                          <li>Contact Us</li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
        <!--Banner-Part:End--> 
        
        <!--Contact-Info:Start-->
        <div class="home-contact-box-wrap">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <ul>
                <li>
                  <div class="home-contact-info-box"> <span><img src="<?php echo base_url();?>assets/frontend/images/phone-icon.png" alt=""/></span>
                    <p>Have a question? Call us now</p>
                    <h4>(02) 9892 1922</h4>
                  </div>
                </li>
                <li>
                  <div class="home-contact-info-box"> <span><img src="<?php echo base_url();?>assets/frontend/images/clock-icon.png" alt=""/></span>
                    <p>We are open Monday-Friday</p>
                    <h4>08:00 - 17:00</h4>
                  </div>
                </li>
                <li>
                  <div class="home-contact-info-box"> <span><img src="<?php echo base_url();?>assets/frontend/images/navigate-icon.png" alt=""/></span>
                    <p>need plumbing? our address</p>
                    <h4>38 Fairfield Street</h4>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--Contact-Info:End--> 
        
        <!--Description-Part:Start-->
        <div class="welcome-part">
          <div class="container-fluid">

            <?php
            if($succ_msg!='' || $error_msg!=''){
              if($succ_msg!=''){
                $class = "alert-success";
                $msg   = $succ_msg; 
              }else{
                $class="alert-danger";
                $msg   = $error_msg; 
              }?>
              <div class="alert alert-success">
                <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
                   <?php echo $msg;?>
              </div>
            <?php
            }?>
            <hgroup>
              <h5>Contact</h5>
              <h2>advantage bathrooms and kitchens</h2>
              <div class="text-left"><img src="<?php echo base_url();?>assets/frontend/images/blue-border-pic.jpg" alt=""/></div>
            </hgroup>
           
           <!--contact-info-part:Start-->
           <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 animated fadeInLeft go">
              <div class="contact-info-box">
              <h3 class="title-3">ADVANTAGE BATHROOMS AND KITCHENS</h3>
              <ul class="contct-info-list">
              <li>
              <div> <span class="icon-box"><i class="fa fa-map-marker"></i></span> <strong>Address</strong><?php echo $content['address'];?></div>
              </li>
              <li>
              <div> <span class="icon-box"><i class="fa fa-phone-square"></i></span> <strong>Phone</strong><?php echo $content['phone'];?></div>
              </li>
              <li>
              <div> <span class="icon-box"><i class="fa fa-envelope"></i></span> <strong>Email</strong><a href="#"><?php echo $content['email'];?></a></div>
              </li>
              </ul>
              </div>
              </div>

              <form name="contact_us" id="contact_us" method="post" action="<?php echo base_url('contact_info_add');?>">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 animated fadeInRight go">
                <div class="contact-form-box">
                <div class="form-group">
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom">
                <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom">
                <input type="text" class="form-control" placeholder="Phone Number" name="ph_no" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <textarea class="form-control" rows="4" placeholder="Message" name="msg" required></textarea>
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                </div>
                </div>
                </div>
                </div>
              </form>

          </div>
           <!--contact--info-part:End-->
          </div>
        </div>
        <!--Description-Part:End--> 
      </div>
    </div>
  </div>
</section>
<!--Banner-and-category-part:End--> 
             
<!--Map-part:Start-->
<div class="container-fluid">
    <div class="row">
        <div class="map-box" id="map">            
        </div>
    </div>
</div>
<!--Map-part:End-->

<script>
  function initMap() {
    var myLatLng = {lat: -25.363, lng: 131.044};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Hello World!'
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPw5K4oNRjjpnIYhK9Yk7i_qE1mjIMpiM&callback=initMap">
</script>