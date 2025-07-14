<?php 

  $cart_contents = $this->cart->contents();

  $printing_dsafe_str_replace(lode(",", $cart_contents[$rowid]['priniting_details']);

  foreach ($printing_details as $key => $value) {

    $value = safe_str_replace("||", ":", $value);

    $printing_data[] = explode(":", $value);

  }

  foreach ($printsafe_str_replace($key => $value) {

    $printing_type[$value[0]] = $value[1];

  }

  if (!empty($cart_contents[$rowid]['finishing_details'])) {

    $finishing_details = explode(",", $cart_contents[$rowid]['finishing_details']);

    if (!empty($finishing_details)) {

      foreach ($finishing_details as $key => $value) {

        $value = safe_str_replace("||", ":", $value);

        $finishing_data[] = explode(":", $value);

      }

    }

    if (!empty($finishing_data)) {

      foreach ($finishing_data as $key => $value) {

        $finishing_type[$value[0]] = $value[1];

      }

    }

  }

  //echo "<pre>";print_r($cart_contents);echo "</pre>";

?>

<div class="get_your_color">

  <div class="printing_options">

    <div class="print_opt_box">

      <h3>PRINTING OPTIONS</h3>

        <div class="row">

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">How many copies would you like?</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <input type="number"  min="1" pattern="[0-9]*" value="<?=$cart_contents[$rowid]['copies']?>" id="no_copies" class="form-control get_input">

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">How many pages are in your file?</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <input type="number"  min="1" pattern="[0-9]*" value="<?=$cart_contents[$rowid]['pages']?>" id="no_pages" class="form-control get_input">

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">Dimensions</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_printing_option0" class="get_option">

                          <option <?=($printing_type['Dimensions'] == "8.5x5.5")?'selected':''?> value="8.5x5.5">8.5x5.5 </option>

                          <option <?=($printing_type['Dimensions'] == "4.25x11")?'selected':''?> value="4.25x11">4.25x11</option>

                          <option <?=($printing_type['Dimensions'] == "4.25x5.5")?'selected':''?> value="4.25x5.5">4.25x5.5</option>

                          <option <?=($printing_type['Dimensions'] == "11x17")?'selected':''?> value="11x17">11x17</option>

                          <option <?=($printing_type['Dimensions'] == "8.5x11")?'selected':''?> value="8.5x11"> 8.5x11</option>

                          <option <?=($printing_type['Dimensions'] == "8.5x14")?'selected':''?> value="8.5x14">8.5x14</option>

                          <option <?=($printing_type['Dimensions'] == "8.5x7")?'selected':''?> value="8.5x7">8.5x7</option>

                      </select>

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">Paper Type</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_printing_option1" class="get_option">

                          <optgroup label="Uncoated copy paper white">

                            <option <?=($printing_type['Paper Type'] == "20/50 lb white copy paper")?'selected':''?>>20/50 lb white copy paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb white copy paper")?'selected':''?>>24/60 lb white copy paper</option>

                            <option <?=($printing_type['Paper Type'] == "28/70 lb white copy paper")?'selected':''?>>28/70 lb white copy paper</option>

                          </optgroup>

                          <optgroup label="Uncoated copy paper pastel color">

                            <option <?=($printing_type['Paper Type'] == "20/50 lb blue paper")?'selected':''?>>20/50 lb blue paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb green paper")?'selected':''?>>20/50 lb green paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb canary paper")?'selected':''?>>20/50 lb canary paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb orchid paper")?'selected':''?>>20/50 lb orchid paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb ivory paper")?'selected':''?>>20/50 lb ivory paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb golden rod paper")?'selected':''?>>20/50 lb golden rod paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb cherry paper")?'selected':''?>>20/50 lb cherry paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb salmon paper")?'selected':''?>>20/50 lb salmon paper</option>

                            <option <?=($printing_type['Paper Type'] == "20/50 lb tan paper")?'selected':''?>>20/50 lb tan paper</option>

                          </optgroup>

                          <optgroup label="Uncoated copy paper bright color">

                            <option <?=($printing_type['Paper Type'] == "24/60 lb solar yellow paper")?'selected':''?>>24/60 lb solar yellow paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb lift off lemon paper")?'selected':''?>>24/60 lb lift off lemon paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb lunar blue paper")?'selected':''?>>24/60 lb lunar blue paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb celestial blue paper")?'selected':''?>>24/60 lb celestial blue paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb rocket red paper")?'selected':''?>>24/60 lb rocket red paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb re-entry red paper")?'selected':''?>>24/60 lb re-entry red paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb cosmic orange paper")?'selected':''?>>24/60 lb cosmic orange paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb orbit orange paper")?'selected':''?>>24/60 lb orbit orange paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb galaxy gold paper")?'selected':''?>>24/60 lb galaxy gold paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb green paper")?'selected':''?>>24/60 lb green paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb terra green paper")?'selected':''?>>24/60 lb terra green paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb planetary purple paper")?'selected':''?>>24/60 lb planetary purple paper</option>

                            <option <?=($printing_type['Paper Type'] == "24/60 lb pulsar pink paper")?'selected':''?>>24/60 lb pulsar pink paper</option>

                          </optgroup>

                          <optgroup label="Uncoated cardstock  pastel color">

                            <option <?=($printing_type['Paper Type'] == "90 lb white cardstock")?'selected':''?>>90 lb white cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb green cardstock")?'selected':''?>>90 lb green cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb blue cardstock")?'selected':''?>>90 lb blue cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb canary cardstock")?'selected':''?>>90 lb canary cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb ivory cardstock")?'selected':''?>>90 lb ivory cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb cherry cardstock")?'selected':''?>>90 lb cherry cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb gold cardstock")?'selected':''?>>90 lb gold cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb salmon cardstock")?'selected':''?>>90 lb salmon cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb tan cardstock")?'selected':''?>>90 lb tan cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "90 lb otchid cardstock")?'selected':''?>>90 lb otchid cardstock</option>

                          </optgroup>

                          <optgroup label="Uncoated cardstock bright color">

                            <option <?=($printing_type['Paper Type'] == "65 lb white cardstock")?'selected':''?>>65 lb white cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb solar yellow cardstock")?'selected':''?>>65 lb solar yellow cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb lift off lemon cardstock")?'selected':''?>>65 lb lift off lemon cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb galaxy gold cardstock")?'selected':''?>>65 lb galaxy gold cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb planetary purple cardstock")?'selected':''?>>65 lb planetary purple cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb lunar blue cardstock")?'selected':''?>>65 lb lunar blue cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb celestial blue cardstock")?'selected':''?>>65 lb celestial blue cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb rocket red cardstock")?'selected':''?>>65 lb rocket red cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb re-entry red cardstock")?'selected':''?>>65 lb re-entry red cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb orbit orange cardstock")?'selected':''?>>65 lb orbit orange cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb cosmic orange cardstock")?'selected':''?>>65 lb cosmic orange cardstock</option>

                            <option <?=($printing_type['Paper Type'] == "65 lb pulsar pink cardstock")?'selected':''?>>65 lb pulsar pink cardstock</option>

                          </optgroup>

                      </select>

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">Number Of Sides</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_printing_option3" class="get_option">

                          <option <?=($printing_type['No Of Sides'] == "1-sided")?'selected':''?> value="1-sided">1-sided</option>

                          <option <?=($printing_type['No Of Sides'] == "2-sided")?'selected':''?> value="2-sided">2-sided</option>

                      </select>

                  </div>

              </div>

          </div>

      </div>

    </div>

    <br>

    <br>

    <div class="print_opt_box">

      <h3>FINISHING OPTIONS</h3>

        <div class="row">

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">Divider sheets</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_finishing_option0" class="get_option">

                          <option value="">Select</option>

                          <option <?php if(isset($finishing_type['Divider Sheets']) && $finishing_type['Divider Sheets'] == "add-divider-sheets"){echo "selected";}?> value="add-divider-sheets">add divider sheets</option>

                      </select>

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">Stapling</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_finishing_option1" class="get_option">

                          <option value="">Select</option>

                          <option <?php if(isset($finishing_type['Stapling']) && $finishing_type['Stapling'] == "top-left"){echo "selected";}?> value="top-left">top left staple</option>

                          <option <?php if(isset($finishing_type['Stapling']) && $finishing_type['Stapling'] == "2-staple"){echo "selected";}?> value="2-staple">2 staples on the spine </option>

                      </select>

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">Folding</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_finishing_option4" class="get_option">

                          <option value="">Select</option>

                          <option <?php if(isset($finishing_type['Folding']) && $finishing_type['Folding'] == "half-fold"){echo "selected";}?> value="half-fold">half fold</option>

                          <option <?php if(isset($finishing_type['Folding']) && $finishing_type['Folding'] == "tri-fold"){echo "selected";}?> value="tri-fold">tri fold</option>

                          <option <?php if(isset($finishing_type['Folding']) && $finishing_type['Folding'] == "z-fold"){echo "selected";}?> value="z-fold">z fold</option>

                          <option <?php if(isset($finishing_type['Folding']) && $finishing_type['Folding'] == "tri-fold-type-out"){echo "selected";}?> value="tri-fold-type-out">Tri fold type out</option>

                          <option <?php if(isset($finishing_type['Folding']) && $finishing_type['Folding'] == "tri-fold-type-in"){echo "selected";}?> value="tri-fold-type-in">Tri fold type in</option>

                      </select>

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt"> Collation </label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_finishing_option9" class="get_option">

                          <option value="">Select</option>

                          <option <?php if(isset($finishing_type['Collation']) && $finishing_type['Collation'] == "collated"){echo "selected";}?> value="collated">collated</option>

                          <option <?php if(isset($finishing_type['Collation']) && $finishing_type['Collation'] == "uncollated"){echo "selected";}?> value="uncollated">uncollated</option>

                      </select>

                  </div>

              </div>

          </div>

          <div class="opt_sel clearfix">

              <div class="col-md-5">

                  <label class="left_pan_taxt">3 hole punch</label>

              </div>

              <div class="col-md-7">

                  <div class="input_fld">

                      <select id="get_finishing_option27" class="get_option">

                          <option value="">Select</option>

                          <option <?php if(isset($finishing_type['3 Hole Punch']) && $finishing_type['3 Hole Punch'] == "add-3-holepunch"){echo "selected";}?> value="add-3-holepunch">add 3 holepunch</option>

                      </select>

                  </div>

              </div>

          </div>

      </div>

    </div>

  </div>

  <div class="price_box clearfix">

    <span class="price_head">Price / Page</span>

    <span class="priceA">$<span class="price"><?=$cart_contents[$rowid]['price_page']?></span></span>

  </div>

  <div class="price_box clearfix"> 

    <span class="price_head">Subtotal:</span>

    <span class="priceA">$<span class="total"><?=$cart_contents[$rowid]['price']?>.00</span></span>

  </div>

  <input type="hidden" id="product_id" value="<?=$cart_contents[$rowid]['product_id']?>">

</div>