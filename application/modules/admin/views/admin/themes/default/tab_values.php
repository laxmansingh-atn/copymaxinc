<?php
$segments = $this->uri->total_segments();
$lang_code = get_current_language(); // Helper "current_language_helper.php"

?>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
		
		<form action="" method="post" id="myform" accept-charset="utf-8" enctype="multipart/form-data">
            <?php //echo '<pre>';print_r($tab_values);exit; ?>
            <input type="hidden" 
               name="<?php echo $this->security->get_csrf_token_name();?>" 
               value="<?php echo $this->security->get_csrf_hash();?>">
            
            <?php if(isset($tab_values) && in_array($tab_values['product_id'], [112,114,116,117])) { ?>        
                <div class="row">
	            <div class="col-md-12">
	              <div class="form-group">
	                <label>Product Tab Description</label>
	                <textarea class="form-control summernote" type="text" name="product_tab" id="product_tab" rows="10" cols="6"><?php if(!empty($tab_values['product'])){ echo $tab_values['product'];}?></textarea>
	              </div>
	            </div>
            </div>
            <div class="row">
	            <div class="col-md-12">
	              <div class="form-group">
	                <label>FAQ Tab Description</label>
	                <textarea class="form-control summernote" type="text" name="faq_tab" id="faq_tab" rows="10" cols="6"><?php if(isset($tab_values['faq'])){ echo $tab_values['faq'];}?></textarea>
	              </div>
	            </div>
            </div>
            <div class="row">
	            <div class="col-md-12">
	              <div class="form-group">
	                <label>Specs & Templates Tab Description</label>
	                <textarea class="form-control summernote" type="text" name="specs_tab" id="specs_tab" rows="10" cols="6"><?php if(isset($tab_values['specs_templates'])){ echo $tab_values['specs_templates'];}?></textarea>
	              </div>
	            </div>
            </div>
            <?php } else { ?>

            	<div class="row">
    	            <div class="col-md-12">
    	              <div class="form-group">
    	                <label>Product Tab Description</label>
    					        
                      <input type="hidden" name="product_tab" id="product_tab_one" value="" />
                      <div class="summernote"><?php if(!empty($tab_values['product'])){ echo $tab_values['product'];}?></div>
    
    
                      <!-- <textarea class="form-control summernote" type="text" name="faq_tab" id="faq_tab" rows="10" cols="6"><?php if(isset($tab_values['faq'])){ echo $tab_values['faq'];}?></textarea> -->
                      
    	              </div>
    	            </div>
                </div>

                
            <?php } ?>
          	<hr>
          	<div class="col-md-12 text-right mar_b_3">
          		<input type="submit" name="submit" value="SUBMIT" class="btn btn-success" />
              
            	<a href="<?= base_url('admin/products/');?>">
              		<button type="button" name="cancel" class="btn btn-default">CANCEL</button>
              	</a>
            </div>
            
          </form>
    </div>
    <!-- /.container-fluid -->
</div>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/summernote-image-attributes.js"></script>

<style type="text/css">
	.wizard .nav-tabs > li {
	    width: 20%;
	}
</style>
<script>
$(document).ready(function() {
  $('.summernote').summernote({
    maximumImageFileSize: 1048576,
    popover: {
        image: [
            ['custom', ['imageAttributes']],
            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
        ],
    },
    lang: 'en-US', // Change to your chosen language
    imageAttributes:{
        icon:'<i class="note-icon-pencil"/>',
        removeEmpty:false, // true = remove attributes | false = leave empty if present
        disableUpload: true // true = don't display Upload Options | Display Upload Options
    }, 
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]   
    ], 
    // callbacks: {
    //     onImageUpload: function(files, editor, welEditable) {
    //     console.log("image");
    //     $("#product_tab_one").val($(".summernote").summernote('code'));
    //   }
    // },
  });

    $("#myform").submit(function(e) {
        //e.preventDefault();
       var product_data =  $("#product_tab_one").val($(".summernote").summernote('code'));
       
       //e.currentTarget.submit();
       // $(this).submit();
    });

  // summernote.keyup
  $('.summernote').on('summernote.keyup', function(we, e) {
    $("#product_tab_one").val($(".summernote").summernote('code'));
  });

  $('.summernote').on('summernote.onImageUpload', function(we, files) {
    console.log("image");
    $("#product_tab_one").val($(".summernote").summernote('code'));
  });

});
</script>

