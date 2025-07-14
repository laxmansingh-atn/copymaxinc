<div class="page_inner">

  <div class="container">

       <?php

                     if($this->session->flashdata('success_message')){

                 ?>

                          <div class="col-md-12 alert alert-success"><?= $this->session->flashdata('success_message');?></div>

                <?php

                        }

                  ?>

    <div class="row clearfix">

      <div class="col-md-6 col-sm-6">

        <div class="contact_left">

          <h2 class="contact-heading">Contact Information</h2>

          <?php     //var_dump($page_content); 

                  echo $page_content[0]['page_content']; ?>

          <div class="map_area">

            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2988.179090767784!2d-83.73642958505891!3d41.500393679253975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883c723b4f25c0e5%3A0x6e7429292c326a7b!2s638+Applegate+St%2C+Waterville%2C+OH+43566%2C+USA!5e0!3m2!1sen!2sin!4v1542021725725" width="" height="" frameborder="0" style="border:0" allowfullscreen></iframe> -->

              <!-- <iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1914%20Hacienda%20drive%2C%20Vista%2C%20CA%2092081+(Copymax)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3341.32972122002!2d-117.1648489243936!3d33.153355073508685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80db8a981b746433%3A0x21c1ba14faab4f83!2s802%20N%20Twin%20Oaks%20Valley%20Rd%2C%20San%20Marcos%2C%20CA%2092069%2C%20USA!5e0!3m2!1sen!2sin!4v1734165032878!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

          </div>

        </div>

      </div>

      <div class="col-md-6 col-sm-6">

        <div class="contact_right">

          <h2 class="contact-heading">Get In Touch</h2>

          <div class="row clearfix">

            <form action="  <?= base_url()?>welcome/index/contact_us_add" method="post" enctype="multipart/form-data">

              <div class="col-md-6">

                <div class="form-group">

                  <input type="text" placeholder="First Name" name="first_name" required="required">

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <input type="text" placeholder="Last Name" name="last_name">

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <input type="text" placeholder="Email" name="email" required="required">

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <input  type="text"  placeholder="Phone No." name="phone_no" required="required">

                </div>

              </div>

              <div class="col-md-12">

                <div class="form-group">

                  <input type="text" placeholder="Subject" name="subject" required="required">

                </div>

              </div>

              <div class="col-md-12">

                <div class="form-group">

                  <textarea placeholder="Message..." rows="5" name="message"></textarea>

                </div>

              </div>

              <div class="col-md-12">

                <input type="submit" name="submit" value="Send Message" class="btn btn-success" />

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>