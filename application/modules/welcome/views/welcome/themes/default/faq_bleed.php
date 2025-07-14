<style type="text/css">
	body {
	padding-top: 0px;
	padding-bottom: 0px;
	/*-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;*/
	font-family: 'Open Sans', sans-serif;
	position:relative;
	background: #fff;
}
a,
a:active,
a:focus,
button,
button:focus,
button:active,
.btn,
.btn:focus,
.btn:active:focus,
.btn.active:focus,
.btn.focus,
.btn.focus:active,
.btn.active.focus {
	outline: none;
	outline: 0;
}
 input::-moz-focus-inner {
 border: 0;
}
  
  @-webkit-keyframes bounce {
    0%       { bottom:0px; }
    50%      { bottom:15px; }
    100%     {bottom:30;}
  }
  
   @-moz-keyframes bounce {
    0%       { bottom:0px; }
    50%      { bottom:15px; }
    100%     {bottom:30;}
  }
  
   @-o-keyframes bounce {
    0%       { bottom:0px; }
    50%      { bottom:15px; }
    100%     {bottom:30;}
  }
  
   @keyframes bounce {
    0%       { bottom:0px; }
    50%      { bottom:15px; }
    100%     {bottom:30;}
  }


.clr{
	clear: both;
}

.bodywrapper {width: 100%;padding: 60px 0;}
.page_left {width: 100%;}
.pagebox1 {width: 100%;background: #818285;text-align: center;border:1px solid #000;padding: 45px 0;text-transform: uppercase;font-size: 35px;color:#000;font-weight: bold;}
.pagebox2 {width: 100%;background: #fff;border:1px solid #000;padding: 5px;text-align: center;}
.bleed_inner {width: 100%;background: #818285;text-align: center;padding: 40px 0;text-transform: uppercase;font-size: 35px;color:#000;font-weight: bold;}
.pageleft_info {width: 100%;margin: 20px 0 0;}
.pageleft_info h2 {font-size: 20px;font-weight: bold;color:#3B3B3B;margin: 0 0 15px;}
.pageleft_info p {font-size: 15px;font-weight: normal;color:#000;margin: 0 0 25px;line-height: 24px;}
.pageleft_info_listing {width: 100%;margin-top: 30px;}
.pageleft_info_listing h2 {font-size: 20px;font-weight: bold;color:#3B3B3B;margin: 0 0 15px;}
.pageleft_info_listing h2 img {max-width: 100%;display: inline-block;margin-right: 8px;}
.pageleft_info_listing ul {width: 100%;margin: 0 0 30px;padding: 0;}
.pageleft_info_listing ul li {display: block;margin: 0;padding: 0 0 4px 32px;font-size: 15px;font-weight: normal;color:#000;background: url(images/arrow1.png) no-repeat 0 9px;}
.page_right {width: 100%;}
.page_right .pagebox1 {background: #d1d2d4;margin: 0 0 20px;}
.pageright_box {width: 100%;position: relative;margin: 0 0 30px;display: inline-block;border-bottom: 1px solid #ccc;padding-bottom: 40px;}
.pageright_box h2 {font-size: 20px;font-weight: bold;color:#3B3B3B;margin: 0 0 15px;}
.pageright_box p {font-size: 15px;font-weight: normal;color:#000;margin: 0;line-height: 24px;width:60%;float:right;background: #fff200;}
.pageright_box span {width: auto;float:left;padding-top: 50px;}
.pageright_box:nth-child(2) p {border:10px solid #f15c28;}
.pageright_box:nth-child(3) p {border:5px solid #f15c28;}
.pageright_box:nth-child(4) p {border:10px solid #f15c28;}
.pageright_box:nth-child(4) p font {position: relative;left:-4px;}
.pageright_box:last-child {border:none;}
.page_bottom {width: 100%;margin: 30px 0 0;text-align: center;}
.page_bottom p {margin: 0;font-weight: bold;font-size: 22px;}

@media only screen and (min-width:200px) and (max-width:767px) {
	.pagebox1 {margin: 0 0 20px;}
	.pageright_box p {width: 100%;margin: 20px 0 0;}
}
@media only screen and (min-width:200px) and (max-width:319px) {
}

@media only screen and (min-width:320px) and (max-width:479px) {
}
	
@media only screen and (min-width:480px) and (max-width:767px) {
}

@media only screen and (min-width:768px) and (max-width:991px) {	
}

/********************@media only screen and (min-width:1024px) and (max-width:1200px)********************/


@media (min-width:992px) and (max-width:1199px) {
}

	
/********************@media only screen and (min-width:1201px)********************/

	

/********************@media only screen and (min-width:1201px)********************/

</style>
<div class="bodywrapper">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="page_left">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="pagebox1">Bleed</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="pagebox2"><div class="bleed_inner">No Bleed</div></div>
						</div>
					</div>
					<div class="pageleft_info">
						<h2>What is Bleed:</h2>
						<p>When printing goes all the way to the edge it’s 
						called Bleed or Full Bleed so whatever goes all the 
						way to the edge needs to extend beyond the cut line 
						by 1/8” or .125” on all four side which will be trimmed 
						off so there is no white. </p>
						<h2>What is safety Margins:</h2>
						<p>Everything that does not go all the way to the 
						edge normally text or other important stuff needs 
						to stay .125” inside the cut line</p>
					</div>
					<div class="pageleft_info_listing">
						<h2><img src="<?=base_url()?>images/tri1.png" alt="" /> Bleed Margins</h2>
						<ul>
							<li>xtend your graphics to the edge of this template.</li>
							<li>The bleeds (Green area) will be cut off, allowing us to  “print to the edge”.</li>
						</ul>
						<h2><img src="<?=base_url()?>images/tri2.png" alt="" /> Cut Line</h2>
						<ul>
							<li>Your print will be cut along the dashed line</li>
						</ul>
						<h2><img src="<?=base_url()?>images/tri3.png" alt="" /> Safety Margins</h2>
						<ul>
							<li>DO NOT include any critical text or graphics in safety margin.</li>
							<li>Anything in this area is at risk of being cut off.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="page_right">
					<div class="pagebox1">8.5 x 11/Full Bleed</div>
					<div class="pageright_box">
						<h2>Correct Bleed Set Up:</h2>
						<span>
							This is your trim line <img src="<?=base_url()?>images/trim-arrow.png" alt="" />
						</span>
						<p>No matter what size your sheet/document is: All the text and anything that does not get cut needs to be inside the yellow box which is 1/8” inside the trim line from all four sides. Everything that goes to the edge (Bleeds) needs to be 1/8“ past the trim line from all the four edges. </p>
					</div>
					<div class="pageright_box">
						<h2>Incorrect/wrong Bleed Set Up <br>No Bleed:</h2>
						<span>
							This is your trim line <img src="<?=base_url()?>images/trim-arrow.png" alt="" />
						</span>
						<p>No matter what size your sheet/document is: All the text and anything that does not get cut needs to be inside the yellow box which is 1/8” inside the trim line from all four sides. Everything that goes to the edge (Bleeds) needs to be 1/8“ past the trim line from all the four edges. </p>
					</div>
					<div class="pageright_box">
						<h2>Incorrect Set Up <br>Text too close to the trim line and may get cut:</h2>
						<span>
							This is your trim line <img src="<?=base_url()?>images/trim-arrow.png" alt="" />
						</span>
						<p><font>No matter what size your sheet/document is: All the text and anything that does not get cut needs to be inside the yellow box which is 1/8” inside the trim line from all four sides. Everything that goes to the edge (Bleeds) needs to be 1/8“ past the trim line from all the four edges. </font></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page_bottom">
					<p>If you have any questions, don’t hesitate to contact our Service Department: <br>1-800-COPYKING</p>
				</div>
			</div>
		</div>
	</div>
</div>