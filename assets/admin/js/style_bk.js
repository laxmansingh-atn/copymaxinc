$(document).ready(function () {
	var image_id;
	var current_row;
	var type_value = $('#product_type option:selected').val();
	if(type_value == 1)
	{
		$(".sku").show();
		$(".quantity").show();
		$("#li_tab3").hide();
		$(".wizard .nav-tabs > li").css('width', '33%');
		$(".connecting-line").css('width','60%');
	}
	else if(type_value == 2)
	{
		$(".sku").hide();
		$(".quantity").hide();
		$("#li_tab3").show();
		$(".wizard .nav-tabs > li").css('width', '25%');
		$(".connecting-line").css('width','80%');
	}
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });
	
	$(document).on("click","#add_image", function(){
		alert($(this).attr('data-val'));
		
		if($(this).attr('data-val') === "add")
		{
			var image_url = $(".image-preview-filename").val();
		
			//alert(image_url);
			if(image_url !=""){
				$.ajax({
				type:"POST",
				dataType:"json",
				url : baseurl+"en/admin/products/add_product_image/",
				data:{product_id:$('#product_id').val(),image_url:image_url},
				success: function (data){
					//var tbl_data = "<tr><td><img src='"+data.product_image+"' width='100' height='100' /></td><td>Action</td></tr>";
					//alert(data.id+"  "+data.product_image);
					var t = $('#dataTables-image').DataTable();


					t.row.add( [
						"<img src='"+data.product_image+"' width='100' />",
						"<div class='btn-group'><button class='btn btn-default btn-icon dropdown-toggle' data-toggle='dropdown'><i class='fa fa-gears'></i></button><ul class='dropdown-menu icons-right dropdown-menu-right' style='padding:0'><li><a id='"+data.id+"' class='img-edit' style='cursor:pointer'><i class='fa fa-pencil'></i>Edit</a></li><li><a id='"+data.id+"' class='img-delete' style='cursor:pointer'><i class='fa fa-trash'></i>Remove</a></li></ul></div>"
					] ).draw( false );

					$(".image-preview-filename").val("");
					//$(".pro_image").append(tbl_data);
					//console.log(data);
					/*if(data == true){

					}*/
					/*if(data > 0)
					{
						product_id = data;
						$("#product_name").removeClass("has-error");
						var $active = $('.wizard .nav-tabs li.active');
						$active.next().removeClass('disabled');
						nextTab($active);
					}*/
				}
				});
			}
		}
		else if($(this).attr('data-val') === "edit")
		{
			var edit_image_url = $(".image-preview-filename").val();
			//alert(image_id);
			if(edit_image_url !=""){
				$.ajax({
				type:"POST",
				dataType:"json",
				url : baseurl+"en/admin/products/edit_product_image/",
				data:{id:image_id,image_url:edit_image_url},
				success: function (data){
					
					//console.log(data);
					var tableRefresh = $('#dataTables-image').dataTable();
					var imgval = "<img src='"+data.product_image+"' width='100' />";
					
					alert(image_id+"  "+data.product_image+"  "+imgval);
					
					tableRefresh.fnUpdate(imgval, parseInt(current_row.row), parseInt(0));
					$(".image-preview-filename").val("");
					$("#add_image").attr("data-val","add");
				}
				});
			}
		}
		
	});
	
	$(document).on("click",".img-edit",function(){
		//alert($(this).attr('id'));
		var id = $(this).attr('id');
		image_id = id;
		var table = $('#dataTables-image').DataTable();
		current_row = table.cell( $(this).parent().parent().parent().parent()).index();
		/*var table = $('#dataTables-image').DataTable();
		var tableRefresh = $('#dataTables-image').dataTable();
		var current_row = table.cell( $(this).parent().parent().parent().parent()).index();*/
		
		//table.fnUpdate('Verified', parseInt(current_row.row), parseInt(current_row.column+1));
		
		//tableRefresh.fnUpdate('Verified', parseInt(current_row.row), parseInt(0));
		
		//console.log(current_row);
		$.ajax({
			type:"POST",
			dataType:"json",
			url : baseurl+"en/admin/products/get_product_image/",
			data:{id:id},
			success: function (data){
				console.log(data);
				$(".image-preview-filename").val(data.product_image);
				$("#add_image").attr("data-val","edit");
			}
		});
	});
	
	$(document).on("click","#cancel_image",function(){
		$(".image-preview-filename").val("");
		$("#add_image").attr("data-val","add");
	})
	
	$(document).on("click",".img-delete",function(){
		//alert($(this).attr('id'));
		var id = $(this).attr('id');
		var row = $(this).closest("tr").get(0);
		
		$.ajax({
			type:"POST",
			dataType:"json",
			url : baseurl+"en/admin/products/delete_product_image/",
			data:{id:id},
			success: function (data){
				alert(data);
				var oTable = $('#dataTables-image').dataTable(); // JQuery dataTable function to delete the row from the table
				oTable.fnDeleteRow(oTable.fnGetPosition(row));
						
				$(".image-preview-filename").val("");
			}
		});
		
		
	});
	
	var product_id;
	
    //$(".next-step").click(function () {
	$(document).on("click",".next-step", function(){
		//alert("click");
		//var host = window.location.origin;
		//alert(baseurl);
		//alert($(this).attr("id"));
		//return false;
		
		/*if($(this).attr("id") === "skip")
		{
			var $active = $('.wizard .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
		}*/
		
		if($(this).attr("id") === "save_general")
		{
			if($("#product_name").val() === "")
			{
				$("#product_name").addClass("has-error");
				return false;
			}
			else
			{
				//var product_type = $("#product_type").val();
				var language_code = $(".product_lang").val();
				var product_name = $("#product_name").val();
				var product_title = $("#product_title").val();
				var product_model = $("#product_model").val();
				var product_sku = $("#product_sku").val();
				var product_quantity = $("#product_quantity").val();
				var product_regular_price = $("#product_regular_price").val();
				var product_sale_price = $("#product_sale_price").val();
				//var product_offer_price2 = $("#product_offer_price2").val();
				var brand = $("#brand option:selected").val();
				//var category = $("#category option:selected").val();
				var category = $("#category").val();
				//var product_short_description = tinyMCE.get('product_short_description').getContent();
				var product_description1 = tinyMCE.get('product_description1').getContent();
				var product_description2 = tinyMCE.get('product_description2').getContent();
				var product_description3 = tinyMCE.get('product_description3').getContent();
				//alert(tinyMCE.get('product_description').getContent());
				/*var $active = $('.wizard .nav-tabs li.active');
				$active.next().removeClass('disabled');
				nextTab($active);*/
				$.ajax({
					type:"POST",
					url : baseurl+"en/admin/products/add_generalinfo/",
					data:{language_code:language_code,product_type: product_type,product_name: product_name,product_title:product_title,product_model:product_model,product_sku:product_sku,product_quantity:product_quantity,product_regular_price:product_regular_price,product_sale_price:product_sale_price,brand:brand,category:category,product_description1:product_description1, product_description12:product_description2 , product_description3:product_description3},
					success: function (data){
						//alert(data);
						if(data > 0)
						{
							//product_id = data;
							$("#product_id").val(data);
							$("#product_name").removeClass("has-error");
							var $active = $('.wizard .nav-tabs li.active');
							$active.next().removeClass('disabled');
							nextTab($active);
						}
					}
				});
			}
		}
		else if($(this).attr("id") == "edit_general")
		{
			if($("#product_name").val() == "")
			{
				$("#product_name").addClass("has-error");
				return false;
			}
			else
			{
				var productid		= $("#editproductid").val();
				var product_type 	= $("#product_type").val();
				var product_name	= $("#product_name").val();
				var product_model	= $("#product_model").val();
				var product_sku = $("#product_sku").val();
				var product_quantity = $("#product_quantity").val();
				var product_regular_price = $("#product_regular_price").val();
				var product_offer_price1 = $("#product_offer_price1").val();
				var product_offer_price2 = $("#product_offer_price2").val();
				var brand = $("#brand").val();
				var category = $("#category").val();
				var product_short_description = $("#product_short_description").val();
				var product_description = $("#product_description").val();
				
				var product_short_description = tinyMCE.get('product_short_description').getContent();
				var product_description = tinyMCE.get('product_description').getContent();
				//alert(tinyMCE.get('product_description').getContent());
				//alert(product_short_description);
				$.ajax({
					type:"POST",
					url : baseurl+"admin/products/edit_generalinfo/",
					data:{productid:productid,product_type: product_type,product_name: product_name,product_model:product_model,product_sku:product_sku,product_quantity:product_quantity,product_regular_price:product_regular_price,product_offer_price1:product_offer_price1,product_offer_price2:product_offer_price2,brand:brand,category:category,product_short_description:product_short_description,product_description:product_description},
					success: function (data){
						//alert(data);
						product_id = data;
						$("#product_name").removeClass("has-error");
						var $active = $('.wizard .nav-tabs li.active');
						$active.next().removeClass('disabled');
						nextTab($active);
					}
				});
			}
		}
		else if($(this).attr("id") == "upload_image")
		{
			var editproductid	= $("#editproductid").val();
			var formData = new FormData( $("#image_upload")[0] );
			if(editproductid == "")
			{
				formData.append('iflag', 'insert');
				formData.append('id', product_id);
			}
			else
			{
				formData.append('iflag', 'update');
				formData.append('id', editproductid);
			}
			//fd.append("fileToUpload", blobFile);
			//alert(formData);
			$.ajax({
               type:"POST",
               url: baseurl+"admin/products/productImageUpload",
               data:formData,
               mimeType: "multipart/form-data",
               contentType: false,
               cache: false,
               processData: false,
			   dataType: "json",
               success:function(res)
               {
				   //alert("RES :: "+res.flag+"   "+res.msg);
				   if(res.flag == "false")
				   {
					   $("#image_error_msg").html("<div class='col-md-12 alert alert-danger'>"+res.msg+"</div>");
				   }
				   else
				   {
					   var $active = $('.wizard .nav-tabs li.active');
					   var type_value = $('#product_type option:selected').val();
					   
					   if(type_value == 1)
					   {
							$active.next().next().removeClass('disabled');
							nextTab($active.next());
					   }
					   else if(type_value == 2)
					   {
							$active.next().removeClass('disabled');
							nextTab($active);
					   }
					   
					   //$("#product_name").removeClass("has-error");
					  /* var $active = $('.wizard .nav-tabs li.active');
					   $active.next().removeClass('disabled');
					   nextTab($active);*/
				   }
               }
       		});
		}
		else if($(this).attr("id") == "save_image")
		{
			var editproductid	= $("#editproductid").val();
			//var formData = new FormData( $("#image_upload")[0] );
			
			var $active = $('.wizard .nav-tabs li.active');
		   	$active.next().removeClass('disabled');
		   	nextTab($active);
			
			/*if(editproductid == "")
			{
				formData.append('iflag', 'insert');
				formData.append('id', product_id);
			}
			else
			{
				formData.append('iflag', 'update');
				formData.append('id', editproductid);
			}
			
			$.ajax({
               type:"POST",
               url: baseurl+"admin/products/productImageUpload",
               data:formData,
               mimeType: "multipart/form-data",
               contentType: false,
               cache: false,
               processData: false,
			   dataType: "json",
               success:function(res)
               {
				   if(res.flag == "false")
				   {
					   $("#image_error_msg").html("<div class='col-md-12 alert alert-danger'>"+res.msg+"</div>");
				   }
				   else
				   {
					   var $active = $('.wizard .nav-tabs li.active');
					   var type_value = $('#product_type option:selected').val();
					   
					   if(type_value == 1)
					   {
							$active.next().next().removeClass('disabled');
							nextTab($active.next());
					   }
					   else if(type_value == 2)
					   {
							$active.next().removeClass('disabled');
							nextTab($active);
					   }
				   }
               }
       		});*/
		}
		/*else if($(this).attr("id") == "save_image")
		{	
			var formData = new FormData( $("#image_upload")[0] );
			formData.append('id', product_id);
			//fd.append("fileToUpload", blobFile);
			//alert(formData);
			$.ajax({
               type:"POST",
               url: baseurl+"admin/products/fileupload",
               data:formData,
               mimeType: "multipart/form-data",
               contentType: false,
               cache: false,
               processData: false,
               success:function(res)
               {
				   //alert("RES :: "+res);
				   //$("#product_name").removeClass("has-error");
				   var $active = $('.wizard .nav-tabs li.active');
				   $active.next().removeClass('disabled');
				   nextTab($active);
               }
       		});
		}
		else if($(this).attr("id") == "edit_image")
		{
			//alert(product_id);
			var formData = new FormData( $("#image_upload")[0] );
			formData.append('id', product_id);
			//fd.append("fileToUpload", blobFile);
			//alert(formData);
			$.ajax({
               type:"POST",
               url: baseurl+"admin/products/editfileupload/",
               data:formData,
               mimeType: "multipart/form-data",
               contentType: false,
               cache: false,
               processData: false,
               success:function(res)
               {
				   if(res == 1)
				   {
					   alert("Please Choose a file first and then click on 'Edit & Continue'");
					   false;
				   }
				   else
				   {
				   //alert("RES :: "+res);
				   //$("#product_name").removeClass("has-error");
				   var $active = $('.wizard .nav-tabs li.active');
				   $active.next().removeClass('disabled');
				   nextTab($active);
				   }
               }
       		});
		}*/
		else if($(this).attr("id") == "edit_attribute")
		{
			window.location.href = baseurl+"admin/products/";
		}
		else if ($(this).attr("id") == "save_attribute"){
			var $active = $('.wizard .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
		}
    });
    
	$(".skip-step").click(function (e) {
		var $active = $('.wizard .nav-tabs li.active');
		var type_value = $('#product_type option:selected').val();
		if(type_value == 1)
		{
			$active.next().next().removeClass('disabled');
			nextTab($active.next());
		}
		else if(type_value == 2)
		{
			$active.next().removeClass('disabled');
			nextTab($active);
		}
	});
	
	
	$(document).on("change","#product_type",function(){
		//alert($('#product_type option:selected').val())
		var type_value = $('#product_type option:selected').val();
		if(type_value == 1)
		{
			$(".sku").show();
			$(".quantity").show();
			$("#li_tab3").hide();
			$(".wizard .nav-tabs > li").css('width', '33%');
			$(".connecting-line").css('width','60%');
			//$("#product_sku").show();
			//$("#product_quantity").show();
		}
		else if(type_value == 2)
		{
			$(".sku").hide();
			$(".quantity").hide();
			$("#li_tab3").show();
			$(".wizard .nav-tabs > li").css('width', '25%');
			$(".connecting-line").css('width','80%');
			//$("#product_sku").hide();
			//$("#product_quantity").hide();
		}
		//$("#id option:selected")
	});
	
	//$(document).on("click","#add_attribute",function(){
		$("#add_attribute").click(function(){
		
		$("#add_storage").append('<div class="prod-details"><p>Storage Device(GB):&nbsp;<input type="text" name="storage" id="storage" value="" /></p><p>Price:&nbsp;<input type="text" name="price" id="price" value="" /></p></div>');
 
		//alert($("#product_attribute").serialize());
		product_id = $("#product_id").val();
		var datastring = $("#product_attribute").serialize();
		alert(datastring)
		$.ajax({
				url:baseurl+"admin/products/add_attributeValue",
				type:'POST',
				data:datastring+"&product_id="+product_id,
				success:function(res){
					alert(res);
					
				}

		});
	});
	
	$(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });
	
	/*$("#save_general").click(function (e) {
		if($("#product_name").val() == "")
		{
			//alert("Please Insert Product Name");
			return false;
		}
	});*/
	
	

/*$("#add-file-field").click(function(){
	$("#image-field").append("<div class='added-field' style='display:block;'><input name='data[]' type='file' /><input type='button' class='remove-btn' value='Remove Field' /></div>");
	});
	// The live function binds elements which are added to the DOM at later time
	// So the newly added field can be removed too
//$(".remove-btn").live('click',function() {
	$(document).on('click','.remove-btn', function(){
	//alert($(this).parent())
	$(this).parent().remove();
});*/
	
});

$(function(){
	//$("#product_attribute").click(function(event){
		//event.preventDefault();
		//alert($(this).serialize());
		/*$.ajax({
				url:'submit.php',
				type:'GET',
				data:$(this).serialize(),
				success:function(result){
					$("#response").text(result);

				}

		});*/
	//});
});


function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}




/*===============================
			30-08-2016
================================*/
$(document).ready(function(){
	$('.prod-options label'). click(function(){
		
		var x = $(this).find('input[type="checkbox"]');
		var label = $(this).find("span").text();
		var srcClass = $(this).attr("class");
		
		if(x.prop("checked") == true){
			var attrval = getAttributeValue(x.attr("data-id"),srcClass);
			//alert(x.attr("data-id"));
			//alert(getAttributeValue(x.attr("data-id")));
			//$(".filter-product-left-inner").append('<div class="filter-prod-item '+srcClass+'"><h4>'+label+'</h4><input type="text"></div>');
			//$(".filter-product-left-inner").append('<div class="filter-prod-item '+srcClass+'"><h4>'+label+'</h4><div id="selectval-'+srcClass+'">'+attrval+'</div></div>');
			  $(".filter-product-left-inner").append('<div class="filter-prod-item '+srcClass+'"><h4>'+label+'</h4><select class="form-control" id="selectval-'+srcClass+'" name="'+label+'">'+attrval+'</select></div>');
			
		}
		else if(x.prop("checked") == false){
			  $(".filter-product-left-inner").find("."+srcClass).remove();
			
		}
	});
});

function getAttributeValue(id,classv)
{
	 var returnstr = "<option> ----------- Select Value ----------- </option>";
	 //returnstr ="<select class='form-control'>\n<option> ----------- Select Value ----------- </option>\n";
	//alert("ID : "+id);
	$.ajax({
	   type:"POST",
	   url: baseurl+"admin/products/getAttributeValue",
	   data: {"id":id},
	   cache: false,
	   success:function(res)
	   {
		   var result = JSON.parse(res);
		   
		   for(var i = 0; i< result.length; i++)
		   {
			   returnstr += "<option value='"+result[i].value+"'>"+result[i].value+"</option>\n";
		   }
		   //returnstr += "</select>";
		  
		  $("#selectval-"+classv).html(returnstr);
	   }
	   
	});
}