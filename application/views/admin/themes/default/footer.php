<!--<footer class="footer">
  <div class="container">
    <p style="color:#FFF;">Copyright &copy;2016 Shiva Kitchen Equepment Pvt. Ltd. All Rights Reserved.</p>
    <p class="mrg0B">Designed by :- <a href="" target="_blank">Comapny Name</a></p>
  </div>
</footer>-->
<?php
//$host	=(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].'/errea_dev';
 //$host	= (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].'/fitser/euromobiles'; 
 $host	= (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].'/copymax/php'; 
?>
<div class="modal fade" id="file-manager" style="width: 100%; display: none;" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title">File Manager</h4>
    </div>
    <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
      <!-- <iframe width="100%" height="500" src="<?php // echo base_url();?>filemanager/filemanager/dialog.php?type=2&field_id=fieldID" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe> -->
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
</div>
<input type="hidden" id="product_id" value="<?php echo $this->session->userdata('product_id');?>">
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/admin/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/select2.min.js"></script>
<!--<script type="text/javascript" src="<?= base_url() ?>assets/admin/fancybox/jquery.fancybox-1.3.4.pack.js"></script>-->
<!-- <script src="<?php // echo base_url() ?>assets/admin/tinymce/tinymce.min.js"></script> -->

<script src="https://cdn.tiny.cloud/1/5r1h9o5qsdtm39hh7p6dpygjqdc08ur06fnrd58uw5j6hpvj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
tinymce.init({
	selector: '#product_tab',
	plugins: 'anchor autolink charmap codesample emoticons image code link lists media searchreplace table visualblocks wordcount',
	toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image code media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
	image_title: true,
	/* enable automatic uploads of images represented by blob or data URIs*/
	automatic_uploads: true,
	/*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

});
</script>


<script type="text/javascript">
	//alert("<?= $this->session->userdata('product_id');?>");
//var product_id = "<?php if($this->session->userdata('product_id')){echo $this->session->userdata('product_id');}else{echo '';} ?>";
	var fieldid;
	var baseurl = "<?php echo base_url(); ?>";
</script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/sb-admin-2.js"></script>
<!-- <script src="<?php //echo base_url() ?>filemanager/filemanager/js/modernizr.custom.js"></script> -->

<!--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>-->


<script type="text/javascript">
var $= $.noConflict();
function responsive_filemanager_callback(field_id){
	console.log(field_id);
	var url=jQuery('#'+field_id).val();
	
}

$(document).on("click",".imgclick",function(){
fieldid = $(this).parent().parent().children('.image-preview-filename').attr('id');
$('.cur_field_id').attr('src',"<?= base_url();?>/filemanager/filemanager/dialog.php?type=2&field_id="+fieldid)
		
})
	
</script>

<script type="text/javascript">
tinymce.init({ selector: "textarea :not(.custom_textarea)",theme: "modern",width: 1000,height: 400,relative_urls: false,remove_script_host : false,
				plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons paste textcolor imagetools responsivefilemanager code"
				],
				toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
				toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor ",
				image_advtab: true ,
				external_filemanager_path:"<?php echo base_url();?>filemanager/filemanager/",
				filemanager_title:"Responsive Filemanager" ,
				external_plugins: { "filemanager" : "<?php echo base_url();?>filemanager/filemanager/plugin.min.js"}
		 });
</script>

<script type="text/javascript" src="<?= base_url() ?>assets/admin/js/style.js"></script>

<script type="text/javascript"> 
$(document).ready(function(){
	$('#dataTables-example').DataTable({
        responsive: true
    });
	
$('.alert-success').fadeIn(4000);
$('.alert-success').fadeOut(4000);	
	
});
	
$(".js-example-basic-multiple").select2({ placeholder: "Select Category"});
	
$(document).on("change",".banner_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	
	$.ajax({
		url: '<?= base_url('admin/banner/get_banner_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				tinyMCE.activeEditor.setContent(data[0].banner_content);
			}
			else{
				tinyMCE.activeEditor.setContent("");
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});

$(document).on("change",".category_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)	
	$.ajax({
		url: '<?= base_url('admin/categories/get_category_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				//tinyMCE.activeEditor.setContent(data[0].banner_content);
				$("#category_title").val(data[0].category_title);
			}
			else{
				//tinyMCE.activeEditor.setContent("");
				$("#category_title").val("");
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});


$(document).on("change",".product_lang",function(){
	var id = "<?= end($this->uri->segments)?>";
	var lang = $(this).val();

	
	$.ajax({
		url: '<?= base_url()?>en/admin/products/get_product_content/'+id+'/'+lang,
		dataType: 'json',
		type: 'post',		
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				$("#product_title").val(data[0].product_title);				
				tinyMCE.get('product_description1').setContent(data[0].description);				
			}
			else{
				$("#product_title").val('');				
				tinyMCE.get('product_description1').setContent("");				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});	

$(document).on("change",".brand_lang",function(){
	var id = "<?= end($this->uri->segments)?>";
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)
	
	$.ajax({
		url: '<?= base_url('admin/brands/get_brand_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				$("#brand_title").val(data[0].brand_content);
				//tinyMCE.activeEditor.setContent(data[0].news_content);
			}
			else{
				$("#brand_title").val('');
				//tinyMCE.activeEditor.setContent("");
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});
	
$(document).on("click", ".image_delete", function(){

	var image_id 	= $(this).attr('id');
	var section 	= $(this).parent().parent(); 
	if(image_id){
		if(confirm('are you sure?')){
			$.post( "<?php echo base_url(); ?>en/admin/products/delete_image" ,{image_id:image_id} ,function( data ){	  		  			
	  			section.remove();	  			
			});
		}	
	}
});

$(document).on("change",".news_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)
	
	$.ajax({
		url: '<?= base_url('admin/news/get_news_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				$("#news_title").val(data[0].news_title);
				tinyMCE.activeEditor.setContent(data[0].news_content);
			}
			else{
				$("#news_title").val('');
				tinyMCE.activeEditor.setContent("");
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});

$(document).on("change",".activity_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)
	
	$.ajax({
		url: '<?= base_url('admin/activity/get_activity_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				$("#activity_title").val(data[0].activity_title);
				tinyMCE.activeEditor.setContent(data[0].activity_content);
			}
			else{
				$("#activity_title").val('');
				tinyMCE.activeEditor.setContent("");
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});

$(document).on("change",".page_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)
	
	$.ajax({
		url: '<?= base_url('admin/page/get_page_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//alert(data);
			if(data != ""){
				$("#page_title").val(data[0].page_title);
				tinyMCE.activeEditor.setContent(data[0].page_content);
			}
			else{
				$("#page_title").val('');
				tinyMCE.activeEditor.setContent("");
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});

$(document).on("change",".payment_type_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)
	//alert(id+"  "+lang);
	$.ajax({
		url: '<?= base_url('admin/payment/get_type_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//console.log(data);
			if(data != ""){
				$("#payment_type").val(data[0].content);
			}
			else{
				$("#payment_type").val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});
	
$(document).on("change",".payment_details_lang",function(){
	var id = <?= end($this->uri->segments)?>;
	var lang = $(this).val();
	//alert(<?= end($this->uri->segments)?>)
	//alert(id+"  "+lang);
	$.ajax({
		url: '<?= base_url('admin/payment/get_detail_content')."/";?>'+id+"/"+lang,
		dataType: 'json',
		type: 'post',
		//data: JSON.stringify( { "first-name": $('#first-name').val(), "last-name": $('#last-name').val() } ),
		processData: false,
		success: function( data, textStatus, jQxhr ){
			//console.log(data);
			if(data != ""){
				$("#payment_description").val(data[0].content);
			}
			else{
				$("#payment_description").val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});


<!----------------------------------------  copymax details -------------------------->

$(document).on('click',".add_more_network", function(){
	var foo = [] ;
	
	var network_val = [] ; 

   var iid = $(this).parent().parent().parent().parent().attr('data-id');
   //alert(iid);	
  if(typeof(iid) == 'undefined'){
	iid = 0;    
  }
  
	
	/* var html = '<div class="row"><div class="col-md-4"><label>Quantitys Range</label></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_from['+iid+'][][]" required="required" placeholder="range from" min = "0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_to['+iid+'][][]" required="required" placeholder="range to" min = "0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="price['+iid+'][][]" required="required" placeholder="price" min = "0"></div><div class="col-md-2"><div class="form-group"><a class="remove_btn_network price_text_ btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><div class="clearfix"></div></div></div>';*/
	
	var html = '<div class="row"><div class="col-md-4"><label>Quantitys Range</label></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_from['+iid+'][]" required="required" placeholder="range from" min = "0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_to['+iid+'][]" required="required" placeholder="range to" min = "0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="price['+iid+'][]" required="required" placeholder="price" min = "0"></div><div class="col-md-2"><div class="form-group"><a class="remove_btn_network price_text_ btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div><div class="clearfix"></div></div></div>';
	
	$(this).parent().parent().parent().parent().append(html) ;
	
    // $( "div.attribute_network" ).last().after(html) ;

});    
							
$(document).on('click', ".remove_btn_network", function(){    
	
    $(this).parent().parent().parent(). remove();
});

////  add multiple attribute for printing option 
var m = 0 ; 
$(document).on('click',".attribute_set", function(){
var id = $(this).parent().parent().parent().parent().parent().attr('data-id');
//var id = $('.varient-content').attr('data-id');
//alert(id + 'hii') ;
var c  = "child" ;
var option = 'printing'; 	
m++ ;
attribute_data(m+id  , c , option);	
//alert(m) ;

var attr_html = '<div><div class="col-md-4"><label>Attribute:</label><div class="form-group"><select class="form-control selected_val" id="attribute_data_'+m+id +'" name="attribute['+id+'][]"><?php echo '<option class="dropdown" selected>Select</option>';if(isset($attributelist)) foreach($attributelist as $list) { echo '<option class="dropdown" value="'.$list['attribute_id'].'">'.$list['attribute_name'] .'</option>' ; } ?> </select></div></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control selected_val" id="attr_val'+m+id +'" name="attribute_value['+id+'][]"></select></div></div><div class="col-md-4"><label>&nbsp;</label><div class="form-group"><a class="remove_btn_printing btn btn-danger btn-sm">remove</a></div></div></div>';
$(this).parent().parent().parent().append(attr_html) ; 

});

$(document).on('click', ".remove_btn_printing", function(){    	
    $(this).parent().parent().parent().remove();
});


$(document).on('click', "#add_more_btn", function(){    
    $(".attribute_section").append('<div class="attribute_row row"><div class="form-group col-md-3"><label>Storage:</label><input type="text" class="form-control validate" name="storage[]"></div><div class="form-group col-md-3"><a class="remove_btn btn btn-success"  style="margin-top:24px;">Remove</a></div></div>');
});    
							
$(document).on('click', ".remove_btn", function(){    
	
    $(this).parent().parent().remove();
});

// printing option
var l = 0 ;  
$(document).on('click' , '.add_varient' , function(){
	var p = 'parent' ;
    var option = 'printing' ; 	
    l++; 
    attribute_data(l,p,option);

	$('.varient-content').last().after('<div><div class="varient-content" data-id="'+l+'"><div class="row add-network-val"><div class=""><input type="hidden" name="cnt['+l+']" value="'+l+'"><div class="col-md-4"><label>Attribute:</label><p>Paper Type</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="paper_type" name="paper_type[]" class="paper_type"><optgroup label="Uncoated copy paper white"><option value="20/50-white">20/50 lb white copy paper</option><option value="24/60-white">24/60 lb white copy paper</option><option value="28/70-white">28/70 lb white copy paper</option></optgroup><optgroup label="Uncoated copy paper pastel color"><option value="20/50-blue">20/50 lb blue paper</option><option value="20/50-green">20/50 lb green paper</option><option value="20/50-canary">20/50 lb canary paper</option><option value="20/50-orchid">20/50 lb orchid paper</option><option value="20/50-ivory">20/50 lb ivory paper</option><option value="20/50-golden-rod">20/50 lb golden rod paper</option><option value="20/50-cherry">20/50 lb cherry paper</option><option value="20/50-salmon">20/50 lb salmon paper</option><option value="20/50-tan">20/50 lb tan paper</option></optgroup><optgroup label="Uncoated copy paper bright color"><option value="24/60-solar-yellow">24/60 lb solar yellow paper</option><option value="24/60-lift-off-lemon">24/60 lb lift off lemon paper</option><option value="24/60-lunar-blue">24/60 lb lunar blue paper</option><option value="24/60-celestial-blue">24/60 lb celestial blue paper</option><option value="24/60-rocket-red">24/60 lb rocket red paper</option><option value="24/60-re-entry-red">24/60 lb re-entry red paper</option><option value="24/60-cosmic-orange">24/60 lb cosmic orange paper</option><option value="24/60-orbit-orange">24/60 lb orbit orange paper</option><option value="24/60-galaxy-gold">24/60 lb galaxy gold paper</option><option value="24/60-green">24/60 lb green paper</option><option value="24/60-terra-green">24/60 lb terra green paper</option><option value="24/60-planetary-purple">24/60 lb planetary purple paper</option><option value="24/60-pulsar-pink">24/60 lb pulsar pink paper</option></optgroup><optgroup label="Uncoated cardstock  pastel color"><option value="90-white">90 lb white cardstock</option><option value="90-green">90 lb green cardstock</option><option value="90-blue">90 lb blue cardstock</option><option value="90-canary">90 lb canary cardstock</option><option value="90-ivory">90 lb ivory cardstock</option><option value="90-cherry">90 lb cherry cardstock</option><option value="90-gold">90 lb gold cardstock</option><option value="90-salmon">90 lb salmon cardstock</option><option value="90-tan">90 lb tan cardstock</option><option value="90-otchid">90 lb otchid cardstock</option></optgroup><optgroup label="Uncoated cardstock bright color"><option value="65-white">65 lb white cardstock</option><option value="65-solar-yellow">65 lb solar yellow cardstock</option><option value="65-lift-off-lemon">65 lb lift off lemon cardstock</option><option value="65-galaxy-gold">65 lb galaxy gold cardstock</option><option value="65-planetary-purple">65 lb planetary purple cardstock</option><option value="65-lunar-blue">65 lb lunar blue cardstock</option><option value="65-celestial-blue">65 lb celestial blue cardstock</option><option value="65-rocket-red">65 lb rocket red cardstock</option><option value="65-re-entry-red">65 lb re-entry red cardstock</option><option value="65-orbit-orange">65 lb orbit orange cardstock</option><option value="65-cosmic-orange">65 lb cosmic orange cardstock</option><option value="65-pulsar-pink">65 lb pulsar pink cardstock</option></optgroup></select></div></div></div><div class="clearfix"></div></div><div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>Number Of Sides</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="number_of_side" name="number_of_side[]" class="number_of_side"><option value="1-sided">1-sided</option><option value="2-sided">2-sided</option></select></div></div></div><div class="clearfix"></div></div><div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>Dimensions</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="dimensions" name="dimensions[]" class="dimensions"><option value="8.5x5.5">8.5x5.5 </option><option value="4.25x11">4.25x11</option><option value="4.25x5.5">4.25x5.5</option><option value="11x17">11x17</option><option value="8.5x11"> 8.5x11</option><option value="8.5x14">8.5x14</option><option value="8.5x7">8.5x7</option></select></div></div></div><div class="clearfix"></div></div><input type="hidden" name="product_id" id="product_attribute_id" value="<?php if(!empty($result)){ echo $result[0]['product_id'];}?>"><div class="row"><div class="col-md-4"><label>Quantity Range</label></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_from['+l+'][]" required="required" placeholder="Range from" min = "0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_to['+l+'][]" required="required" placeholder="Range to" min = "0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="price['+l+'][]" required="required" placeholder="price" min = "0"></div><div class="col-md-1"><div class="form-group"><a class="add_more_network btn btn-success btn-sm">Add</a></div></div><div class="col-md-1"><div class="form-group"><a class="remove_btn_varient btn btn-danger btn-sm">delete</a></div></div></div><div class="clr"></div></div></div>');
});

$(document).on('click', ".remove_btn_varient", function(){    	
    $(this).parent().parent().parent().parent().remove();
});


// finishing option 
var j = 0;
$(document).on('click' , '.add_finishing' , function(){
	var p = 'parent' ; 
	var option = 'finishing' ; 
    j++; 
    finishing_data(j,p,option);
$('.finishing-content').last().after('<div> <div class="finishing-content" data-id="'+j+'"> <input type="hidden" name="cnt['+j+']" value="'+j+'"> <div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>Divider Sheets</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="divider_sheets" name="divider_sheets[]"><option value="add-divider-sheets">add divider sheets</option></select> </div></div></div><div class="clearfix"></div></div><div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>Stapling</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="stapling" name="stapling[]"><option value="top-left-staple">top left staple</option><option value="2-staples-on-the-spine">2 staples on the spine </option></select> </div></div></div><div class="clearfix"></div></div><div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>Folding</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="folding" name="folding[]"><option value="half-fold">half fold</option> <option value="tri-fold">tri fold</option> <option value="z-fold">z fold</option> <option value="tri-fold-type-out">Tri fold type out</option> <option value="tri-fold-type-in">Tri fold type in</option></select> </div></div></div><div class="clearfix"></div></div><div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>Collation</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="collation" name="collation[]"><option value="collated">collated</option> <option value="uncollated">uncollated</option></select> </div></div></div><div class="clearfix"></div></div><div class="row add-network-val"><div class=""><div class="col-md-4"><label>Attribute:</label><p>3 hole punch</p></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control" id="hole_punch" name="hole_punch[]"><option value="add-3-holepunch">add 3 holepunch</option></select> </div></div></div><div class="clearfix"></div></div><input type="hidden" name="product_id" id="product_attribute_id" value="<?php if(!empty($result)){echo $result[0]['product_id'];}?>"> <div class="row"> <div class="col-md-4"><label>Quantity Range</label></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_from['+j+'][]" required="required" placeholder="Range from" min="0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="quantity_to['+j+'][]" required="required" placeholder="Range to" min="0"></div><div class="col-md-2"><input type="number" class="form-control validate" name="price['+j+'][]" required="required" placeholder="price" min="0"></div><div class="col-md-1"> <div class="form-group"><a class="add_more_network btn btn-success btn-sm">Add</a></div></div><div class="col-md-1"> <div class="form-group"><a class="remove_finish_btn btn btn-danger btn-sm">delete</a></div></div></div><div class="clr"></div></div></div>'); 
	
});

$(document).on('click', ".remove_finish_btn", function(){    	
    $(this).parent().parent().parent().parent().remove();
});

// finishing attribute options

var k = 0 ;	 
$(document).on('click',".finishing_set", function(){
var id = $(this).parent().parent().parent().parent().parent().attr('data-id');

var c  = "child" ;
var option = 'finishing' 	
k++ ;

finishing_data(k+id , c , option);	
//var id = $(this).parent().parent().parent().attr('data-id');
//alert(id) ;

var attr_html = '<div><div class="col-md-4"><label>Attribute:</label><div class="form-group"><select class="form-control selected_val" id="finishing_data_'+k+id+'" name="attribute['+id+'][]"><?php echo '<option class="dropdown" selected>Select</option>'; if(isset($attributelist)) foreach($attributelist as $list) { echo '<option class="dropdown" value="'.$list['attribute_id'].'">'.$list['attribute_name'] .'</option>' ; } ?> </select></div></div><div class="col-md-4"><label>Attribute Values:</label><div class="form-group"><select class="form-control selected_val" id="finishing_val_'+k+id+'" name="attribute_value['+id+'][]"></select></div></div><div class="col-md-4"><label>&nbsp;</label><div class="form-group"><a class="remove_btn_finishing btn btn-danger btn-sm">remove</a></div></div></div>';
$(this).parent().parent().parent().append(attr_html) ; 
});

$(document).on('click', ".remove_btn_finishing", function(){    	
    $(this).parent().parent().parent().remove();
});



/// varient data ///

var i = 0;	
$(document).on('click' , '.add_more_attribute' , function(){

   //alert(i);
   i++;	
   attribute_varient(i);
$('.attribute-content').last().after('<div class="row attribute-content" data-id="'+i+'"><div class="col-md-4"><div class="form-group"><label>Attribute Name </label><select class="form-control" name="attribute[]" id="attribute_varient_'+i+'" required><option>--- Select Attribute --</option><?php if(isset($attributelist)) foreach($attributelist as $attributes) { ?><option <?php if(!empty($result[0]['attribute_id'])){ echo $result[0]['attribute_id'] == $attributes['attribute_id'] ?'selected':'';}?> value="<?= $attributes['attribute_id'] ;?>"><?= $attributes['attribute_name'];?></option><?php } ?></select></div></div><div class="col-md-4"><div class="form-group"><label>Attribute Value</label><input class="form-control" name="attribute_value[]" id="varient_'+i+'" value="" placeholder="Attribute Value" required="required" type="text"></div></div><div class="col-md-2"><div class="form-group"><label>Status</label><select class="form-control" name="status[]" id="category_status" required><option <?php if(!empty($result[0]['status'])){ echo $result[0]['status'] == 1?'selected':'';}?> value="1">Active</option><option <?php if(!empty($result[0]['status'])){ echo $result[0]['status'] == 0?'selected':'';}?> value="0">Inactive</option></select></div></div><div class="col-md-2"><div class="form-group"><a class="remove_attribute btn btn-success"  style="margin-top:24px;">Remove</a></div></div><div class="clearfix"></div></div>');

});



$(document).on('click', ".remove_attribute", function(){    	
    $(this).parent().parent().parent().remove();
});

function attribute_data(i,p,option) {
//alert(i);
$(document).on("change","#attribute_data_"+i, function(){
	var id = $(this).val();
	 
	$.ajax({
		url: '<?= base_url('admin/products/getAttributeValue')?>',
		type: 'post',
		data: { id: id , iid:i ,type:p, option:option} ,
		success: function( data){
			console.log(data);
			if(data != ""){
				$("#attr_val"+i).html(data);
			}
			else{
				$("#attr_val"+i).val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});
	
}

function finishing_data(i,p,option) {
//alert(i);
$(document).on("change","#finishing_data_"+i, function(){
	var id = $(this).val();
	 
	$.ajax({
		url: '<?= base_url('admin/products/getAttributeValue')?>',
		type: 'post',
		data: { id: id , iid:i ,type:p, option:option} ,
		success: function( data){
			console.log(data);
			if(data != ""){
				$("#finishing_val_"+i).html(data);
			}
			else{
				$("#finishing_val_"+i).val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});
	
}



$(document).on("change","#attribute_data_0", function(){
	var id = $(this).val();
	var i = 0 ;
    var  p = 'parent' ;
    var option = 'printing';	  
	$.ajax({
		url: '<?= base_url('admin/products/getAttributeValue')?>',
		type: 'post',
		data: { id: id , iid:i,type:p , option: option} ,
		success: function( data){
			console.log(data);
			if(data != ""){
				$("#attr_val"+i).html(data);
			}
			else{
				$("#attr_val"+i).val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});

$(document).on("change","#finishing_data_0", function(){
	var id = $(this).val();
	 var i = 0 ;
      var  p = 'parent' ;
       var option = 'finishing';	  
	$.ajax({
		url: '<?=base_url('admin/products/getAttributeValue')?>',
		type: 'post',
		data: { id: id , iid:i,type:p , option: option } ,
		success: function( data){
			console.log(data);
			if(data != ""){
				$("#finishing_val_"+i).html(data);
			}else{
				$("#finishing_val_"+i).val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});


$(document).on("change","#attribute_varient_0", function(){
	var id = $(this).val();
	 var i = 0 ;
      var  p = 'parent' ;
       var option = 'finishing';	  
	$.ajax({
		url: '<?=base_url('admin/products/getAttribute_varient')?>',
		type: 'post',
		data: { id: id , iid:i } ,
		success: function( data){
			console.log(data);
			if(data != ""){
				$("#varient_"+i).html(data);
			}else{
				$("#varient_"+i).val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});


function attribute_varient(n){
//alert(n) ; 	
$(document).on("change","#attribute_varient_"+n, function(){
	var id = $(this).val();
	var i = 0 ;
       
	$.ajax({
		url: '<?=base_url('admin/products/getAttribute_varient')?>',
		type: 'post',
		data: { id: id , iid:i } ,
		success: function( data){
			console.log(data);
			if(data != ""){
				$("#varient_"+n).html(data);
			}else{
				$("#varient_"+n).val('');
				
			}
		},
		error: function( jqXhr, textStatus, errorThrown ){
			console.log( errorThrown );
		}
	});
	
});	
	
}











		$("input[type='radio']").click(function(){
		var columns = $("input[name=status]:checked").val();
		if(columns == 0){
		$('.comment').css("display","block");   
		} else {
		$('.comment').css("display","none"); 	
		}
		});

  
   
function testing_param(a, b , c , d , e , f, g) {

  var status = $("input[name=status]:checked").val(); 

  if(typeof (status) !== 'undefined'){
  $.ajax({
		url: '<?= base_url(get_current_language())?>/admin/testing/testing_update',		
		type: 'post',
	data: { user_id: a, revised_cost: $(''+b+'').val() , status: status , existing_price : c ,email : d , transaction_id : e , name:f , comment: $(''+g+'').val()} ,		
		success: function( res ){
		alert(res);
		 if(res == 1){
			$('.testing').html('<span style="color:green;text-align: center">Testing done successfully</span>') ;
            $('.testing').fadeIn(3000) ; 
			$('.testing').fadeOut(5000) ; 
		} 
		}
  }) ;
  } else {
	  alert('please check the verified button') ;
	  return false ; 
  }  
		
}

function payment_param(a, b ) {
	var status = $("input[name=status]:checked").val(); 

  if(typeof (status) !== 'undefined'){
  $.ajax({
		url: '<?= base_url(get_current_language())?>/admin/testing/payment_update',		
		type: 'post',
		data: { user_id: a , payment : $(''+b+'').val() , status : status } ,		
		success: function( res ){
		
		 if(res == 1){
			$('.payment').html('<span style="color:green;text-align: center">Verification done successfully</span>') ;
            $('.payment').fadeIn(3000) ; 
			$('.payment').fadeOut(5000) ; 
		} 
		}
  }) ;
  } else {
	  alert('please check the complete button') ;
	  return false ; 
  }  
	
}
function paymentcard_check(a){
	var card_no = $(''+a+'').val() ;
     $.ajax({
		url: '<?= base_url(get_current_language())?>/welcome/index/card_check',		
		type: 'post',
		data: { card_no: card_no } ,		
		success: function( res ){
		 alert(res) ; 
		 
		}
  }) ;	
	
}
$("#del").click(function(){
	var inputs = $("input[type='checkbox']");
	var vals=[];
for(var i = 0; i < inputs.length; i++) 
		{
		if(inputs[i].checked){
		vals.push(inputs[i].value);					
		}
		}
		$.ajax({
		url: '<?= base_url(get_current_language())?>/admin/products/delete_multiple_product',		
		type: 'post',
		data: { product_id : vals } ,		
		success: function( res ){
		 //alert(res) ; 
		 window.location.reload();
	}
  });			
			
}); 

</script>
</body>
</html>
