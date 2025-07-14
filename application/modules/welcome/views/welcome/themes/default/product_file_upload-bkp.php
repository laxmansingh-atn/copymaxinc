<div class="page_inner">
  <div class="container">
    <div class="alert alert-danger" style="display:none;" id="error_msg_div">
      <a  class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <span id="error_msg"></span>
    </div>
<div class="row clearfix">
      <div class="col-md-12">
        <div class="upload_pg">
          <h2><img src="<?php echo base_url(); ?>assets/frontend/images/file_add.png" alt="file upload">Upload your file</h2>
          <form id="add_to_cart_form" action="<?php echo base_url(); ?>cart/add_cart" method="post" enctype="multipart/form-data">
            <div class="bg_box">
              <div class="row clearfix">
                <div class="col-md-8">
                  <div class="inprogress">
                    <h3>File Upload In Progress</h3>
                    <div class="inprogress_fld">
                      <div id="hide">
                      <?=($this->session->userdata('uploaded_image'))?'':'No files to preview'?>
                      </div>
                      <div id="image_progress_bar" style="display:none;">
                        <!-- <div id="progress" class="progress">
                          <div class="progress-bar progress-bar-success"></div>
                        </div> -->
                        <div id="progress" class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:10%">
                      </div>
                        </div>
                        <span id="image_name" style="float:left"></span> <span style="float:right"><span id="upload_percentage">0</span>%</span>
                        
                      </div>
                    </div>
                  </div>
                  <div class="inprogress">
                    <h3>File Upload</h3>
                    <div class="inprogress_fld">
                    <span class="text-data"><?=($this->session->userdata('uploaded_image'))?'':'No files to preview'?></span>
                      <div id="image_preview">
                      <?php if($this->session->userdata('uploaded_image')){
                        $image_name=explode("||",$this->session->userdata('uploaded_image'));
                        foreach($image_name as $image){
                        ?>
                        
                        <div class="product-image"><a href="<?=base_url('uploads/files/'.$image)?>"  class="view_uploadded_docs" target="_blank"><?= $image ?></a><div class="secondary-content actions"><a class="delete_button" data-link="./uploads/files/<?=$image?>" data-file_name="<?=$image?>"  data-dz-remove class="btn btn-danger btn-sm"><i class="fa fa-trash white-text"></i></a></div></div>
                      <?php } } ?>

                      </div>
                      
                    </div>
                  </div>
                  <!-- <div class="col-md-12">
                    <span style="color:red;font-weight:bold;font-size:13px;">Please Note : Files will be uploaded to our server after clicking on add to cart button</span>
                  </div> -->
                  <!-- <div class="col-md-12" id="progress_bar" style="display:none;">
                    <h2 id="status_code">Processing....</h2>
                    <p id="status">Please wait,image upload in progress</p>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                      </div>
                    </div>
                  </div> -->

                </div>
				<?php 
				$postvalue = base64_encode(serialize($details));
				
				?>
				
                <input type="hidden" id="product_total" name="product_total" value="<?= $details['total'] ?>">
				<input type="hidden" id="product_total" name="extra_data" value="<?= $postvalue  ?>">
                <input type="hidden" id="product_page_price" name="product_page_price" value="<?= $details['price_page'] ?>">
                <input type="hidden" id="product_id" name="product_id" value="<?= $details['product_id'] ?>">
                <input type="hidden" id="product_slug" name="product_slug" value="<?php echo $this->uri->segment(2); ?>">
                <input type="hidden" id="image_name_hidden" name="image_name_hidden" value="">
                


                <div class="col-md-4">
                  <div class="file-upload">
                    <label for="upload" class="file-upload__label">Click here to upload files</label>
                    <input id="upload" class="file-upload__input" type="file" name="file-upload[]" multiple>
                  </div>
                  <div class="item_descriptions">
                    <h3>Item Description</h3>
                    <p><strong>Number of copies : </strong><?= $details['copies'] ?></p>
                    <input type="hidden" name="copies" value="<?= $details['copies'] ?>">







                    <p><strong>Number of Pages : </strong><?= $details['pages'] ?></p>
                    <input type="hidden" name="pages" value="<?= $details['pages'] ?>">
                    <br>
                    <h4><u><strong>Printing Details</strong></u></h4>

                    <p><strong>Dimensions : </strong><?= $details['dimensions'] ?></p>
                    <input type="hidden" name="dimensions" value="<?= $details['dimensions'] ?>">

                    <p><strong>Paper Type : </strong><?= $details['paper_type'] ?></p>
                    <input type="hidden" name="paper_type" value="<?= $details['paper_type'] ?>">
                    <input type="hidden" name="paper_type_id" value="<?= $details['paper_type_id'] ?>">

                    <p><strong>No Of Sides : </strong><?= $details['no_of_sides'] ?></p>
                    <input type="hidden" name="no_of_sides" value="<?= $details['no_of_sides'] ?>">

                    <?php if ($details['no_of_sides'] == '2-sided' && !empty($details['sides']) && !empty($details['orientation'])) { ?>
                      <p><strong>Sides : </strong><?= $details['sides'] ?></p>
                      <input type="hidden" name="sides" value="<?= $details['sides'] ?>">

                      <p><strong>Orientation : </strong><?= $details['orientation'] ?></p>
                      <input type="hidden" name="orientation" value="<?= $details['orientation'] ?>">
                    <?php } ?>

                    <?php if (!empty($details['divider_sheets'] || $details['stapling'] || $details['folding'] || $details['collation'] || $details['hole_punch'])) : ?>
                      <br>
                      <h4><u><strong>Finishing Details</strong></u></h4>
                    <?php endif; ?>

                    <p><strong>Need To See Digital Proof : </strong><?php if ($details['digital_proof_hid'] == 1) {
                                                                      echo 'Yes';
                                                                    } else {
                                                                      echo 'No';
                                                                    } ?></p>
                    <input type="hidden" name="digital_proof" value="<?= $details['digital_proof_hid'] ?>">

                    <?php if (($this->uri->segment(2) == 'color-copies' || $this->uri->segment(2) == 'enhanced-black-white-copies') && !empty($details['full_bleed'])) : ?>
                      <p><strong>Full Bleed : </strong><?= $details['full_bleed'] ?></p>
                      <input type="hidden" name="full_bleed" value="<?= $details['full_bleed'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['divider_sheets'])) : ?>
                      <p><strong>Divider sheets : </strong><?= $details['divider_sheets'] ?></p>
                      <input type="hidden" name="divider_sheets" value="<?= $details['divider_sheets'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['stapling'])) : ?>
                      <p><strong>Stapling : </strong><?= $details['stapling'] ?></p>
                      <input type="hidden" name="stapling" value="<?= $details['stapling'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['folding'])) : ?>
                      <p><strong>Folding : </strong><?= $details['folding'] ?></p>
                      <input type="hidden" name="folding" value="<?= $details['folding'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['collation'])) : ?>
                      <p><strong>Collation : </strong><?= $details['collation'] ?></p>
                      <input type="hidden" name="collation" value="<?= $details['collation'] ?>">
                    <?php endif; ?>

                    <?php if (!empty($details['hole_punch'])) : ?>
                      <p><strong>3 hole punch : </strong><?= $details['hole_punch'] ?></p>
                      <input type="hidden" name="hole_punch" value="<?= $details['hole_punch'] ?>">
                    <?php endif; ?>
                    <br>
                    <p class="total1"><strong> Total : $<?= number_format($details['total'], 2) ?></strong></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="btn-area clearfix">
              <button type="button" class="btn btn-warning pull-left" onclick="window.location.href='<?php echo base_url(); ?>"><i class="fa fa-angle-left"></i>&nbsp;Continue Shopping</button>
              <div class="add_cart">
                <button type="button" class="btn btn-success pull-right" id="add_to_cart"> Add to Cart&nbsp; <i class="fa fa-angle-right"></i></button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style type="text/css">
  #image_preview {
    text-align: left;
    
  }

  

  .preview_file {

    display: inline-block;
    position: relative;
    margin-bottom: 20px;
    margin-right: 20px;
    border: 1px #e2e2e2 solid;
    max-height: 140px;
    width: 140px;
    height: 140px;

  }

  .preview_file a {
    position: absolute;
    right: -5px;
    top: -10px;
    background: #cc0f0f;
    border-radius: 30px;
    width: 20px;
    height: 20px;
    text-align: center;
    color: #fff;
    font-size: 14px;
  }
  .error_cls p{

    color:red;
    cursor:pointer;
  }
  .product-image {

    position:relative;
  }
  
  .product-image .secondary-content {
    position: absolute;
    right: 10px;
    top:6px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 3px;
    padding: 3px;
    width: 30px;
    height: 30px;
    text-align: center;
}


.product-image .secondary-content i{
	color: red;
}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
  // $(function() {

  //   var bar = $('.bar');
  //   var percent = $('.progress');
  //   var status = $('#status');

  //   $('form').ajaxForm({
  //       beforeSend: function() {
  //         status.empty();
  //         var percentVal = '0%';
  //         bar.width(percentVal);
  //         percent.html(percentVal);
  //       },
  //     uploadProgress: function(event, position, total, percentComplete) {
  //         var percentVal = percentComplete + '%';
  //         bar.width(percentVal);
  //         percent.html(percentVal);
  //     },
  //     complete: function(xhr) {
  //         status.html(xhr.responseText);
  //     }
  //   });
  // }); 

  $(document).on("click", "#add_to_cart", function() {
    var image_name='';
    $('.view_uploadded_docs').each(function(){
        
        image_name += $(this).text() +'||';

    })
    $("#image_name_hidden").val(image_name);
    // if ($("#upload").val()) {
    //   $("#progress_bar").show();
    // }
    $("#add_to_cart").attr('disabled', true);
    $("#add_to_cart").text('Processing......');
    $("#add_to_cart_form").submit();

  })

  // $(document).ready(function() {
  //   //Check File API support
  //   if (window.File && window.FileList && window.FileReader) {

  //     $("#upload").on("change", function(e) {

  //       $('.text-data').hide();
  //       $("#image_preview").html('');

  //       var files = e.target.files,
  //         filesLength = files.length;
  //       var file_name = "";

  //       for (var i = 0; i < filesLength; i++) {
  //         var f = files[i];
  //         //console.log(f);
  //         var fileReader = new FileReader();
  //         fileReader.fileName = f.name;
  //         fileReader.onload = (function(e) {
  //           $("#image_preview").append('<div class="preview_file"><img src="' + e.target.result + '" alt=""/ style="max-height:140px;"><a href="javascript:void(0)" class="remove_pic"><i class="fa fa-close"></i></a><p style="word-break:break-word;font-size:12px;">' + e.target.fileName + '</p></div>');
  //         });

  //         fileReader.onprogress = function(data) {
  //           //console.log(data);
  //           if (data.lengthComputable) {
  //             $("#image_progress_bar").show();
  //             $("#hide").hide();
  //             $("#image_name").html(data.target.fileName);
  //             $("#image_name_hid").val(data.target.fileName);

  //             var progress = parseInt(((data.loaded / data.total) * 100));
  //             $('#progress .progress-bar').css(
  //               'width',
  //               progress + '%'
  //             );
  //             $("#upload_percentage").html(progress);
  //             //console.log(progress);
  //           }
  //         }
  //         fileReader.readAsDataURL(f);
  //       }
  //     });
  //   } else {
  //     console.log("Your browser does not support File API");
  //   }
  // })

  $(document).on('change', '#upload', function() {
    
    if($("#upload").val()){
      
      var image_name='';
      $('.view_uploadded_docs').each(function(){
          
          image_name += $(this).text() +'||';

      })
      $("#image_name_hidden").val(image_name);
      
      var form = $('#add_to_cart_form')[0];
      var formData = new FormData(form);

      $.ajax({
          url: "<?= base_url() ?>welcome/cart/file_upload",
          data: formData,
          type: "post",
          cache: "false",
          dataType: 'json',
          contentType: false,
          processData: false,
          encode: true,
          xhr: function(){
              //upload Progress
              var xhr = $.ajaxSettings.xhr();
              if (xhr.upload) {
                $("#image_progress_bar").show();
                $("#hide").text('Processing....');
                xhr.upload.addEventListener('progress', function(event) {
                  var percent = 0;
                  var position = event.loaded || event.position;
                  var total = event.total;
                    if (event.lengthComputable) {
                      percent = Math.ceil(position / total * 100);
                    }
                    //update progressbar
                    $('#progress .progress-bar').css(
                  'width',
                  percent + '%'
              );
              $("#upload_percentage").html(percent);
                }, true);
              }
              return xhr;
        }
      })
        
        .done(function(data) {
          if(data.status){
            $("#hide").text('Completed');
            $("#image_name").text(data.image_name);
            var image_name=data.image_name.split('||');
            
            $.each(image_name,function(i){
              $("#image_preview").append('<div class="product-image"><a href="<?=base_url()?>uploads/files/'+image_name[i]+'" class="view_uploadded_docs" target="_blank">'+image_name[i]+'</a><div class="secondary-content actions"><a class="delete_button" data-link="./uploads/files/'+image_name[i]+'" data-file_name="'+image_name[i]+'"  data-dz-remove class="btn btn-danger btn-sm"><i class="fa fa-trash white-text"></i></a></div></div>');
            });
            window.location.reload();
          }
          else{
            $("#hide").html('<span class="error_cls">'+data.msg+'</span>');
            $("#error_msg_div").show();
            $("#error_msg").html(data.msg);
          }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          
          alert('server not responding...');

        });
    }
  });


  $('.delete_button').confirm({
    
    title: 'Do you want to remove this file?',
    content: 'Files will be deleted permanently from our server',
    type: 'red',
    typeAnimated: true,
    columnClass:'medium',
    buttons: {
        remove: {
            text: 'Remove',
            btnClass: 'btn-red',
            action: function(){
              var file_link = this.$target.data('link');
              var file_name = this.$target.data('file_name');
              //alert(file_link);
              
              $.ajax({
                url: "<?= base_url() ?>welcome/cart/delete_file",
                data: {"file_link":file_link,"file_name":file_name},
                type: "post",
                cache: "false",
                dataType: 'json',
                encode: true,
              })
              .done(function(data) {
          if(data.status){
            $.alert(data.msg);
            setTimeout(function(){ window.location.reload(); }, 1000);
            //console.log(this.$target);
            //this.$target.parent('.product-image').remove();
          }
          else{
            $.alert(data.msg);
          }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          
          $.alert('server not responding...');
        });
            
            
            
            }
        },
        close: function () {
        }
    }
});

 
  //document.getElementById('upload').addEventListener('change', handleFileSelect, false);
</script>