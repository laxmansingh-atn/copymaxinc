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
		 
		if($(this).attr('data-val') === "add")
		{
			//var image_url = $(".image-preview-filename").val();
				var file_data = $('#product_image').prop('files')[0];   
				var form_data = new FormData();                  
				form_data.append('file', file_data);
				//alert(form_data);                  
			if(form_data !=""){
				$.ajax({
					type:"POST",
					dataType:"json",
					cache: false,
                    contentType: false,
                    processData: false,
					url : baseurl+"admin/products/add_product_image",
					data:form_data,
					success: function (data){
					
						console.log(data);
						
						/* $('.row_image').append('<div class="col-md-3"><div class="brand-img-dsp"><div class="brand-img-dsp-inner"><div class="brand-img-dsp-inner1"><div class="brand-img-dsp-inner2"><a href="javascript:void(0);" class="image_delete" id=="'+data.id+'"><img class="img-responsive" src="'+data.product_image+'" /></div></div></div><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');
						*/
						
						$('#save_image').prop('disabled', false);
                       // $('#product_id').val(data.product_id);						
						$('#product_attribute_id').val(data.product_id);		
                              
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
				url : baseurl+"admin/products/edit_product_image/",
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
			url : baseurl+"admin/products/get_product_image/",
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
			url : baseurl+"admin/products/delete_product_image/",
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
	
    $(document).on("click",".next-step", function(){		
		
		if($(this).attr("id") == "save_general"){						
			if($("#product_name").val() === ""){
				$("#product_name").addClass("has-error");
				alert('Product name could not be blank!');
				return false;
			}else if($("#product_title").val() === ""){
				$("#product_title").addClass("has-error");
				alert('Product title could not be blank!');
				return false;
			}else if($("#product_regular_price").val() === ""){
				$("#product_regular_price").addClass("has-error");
				alert('Product price could not be blank!');
				return false;
			}else if($("#category").val() === null){
				$("#category").addClass("has-error");
				alert('Category could not be blank!');
				return false;
			}else{						
				
				$.ajax({
					type:"POST",
					url : baseurl+"admin/products/add_generalinfo",
					
                    data:$('#general_info').serialize(),				
					success: function (data){
                         console.log(data) ; 						
						if(data > 0){							

							$("#printing_product_id").val(data);
							//$("#product_attribute_id").text(data)
							$("#product_name").removeClass("has-error");
							var $active = $('.wizard .nav-tabs li.active');							
							$active.next().removeClass('disabled');
							nextTab($active);
							//$active.addClass('disabled');
						}
					}
				});
			}

		}else if($(this).attr("id") == "edit_general"){
			
			if($("#editproductid").val() == "")
			{
				$("#editproductid").addClass("has-error");
				return false;

			}else{ 				

				$.ajax({
					type:"POST",
					url : baseurl+"admin/products/edit_generalinfo",
					
					 data:$('#general_info').serialize(),
					success: function (data){
						 
						if(data){
					   /*  alert(data); 					
						$("#editproductid").removeClass("has-error");
						var $active = $('.wizard .nav-tabs li.active');							
							$active.next().removeClass('disabled');
							nextTab($active);
						//$active.addClass('disabled');
						*/
							$("#product_name").removeClass("has-error");
							var $active = $('.wizard .nav-tabs li.active');							
							$active.next().removeClass('disabled');
							nextTab($active);
						}
					}
				});
			}

		}else if($(this).attr("id") == "update_image"){
			
			var editproductid	= $("#editproductid").val();			
			
			var $active = $('.wizard .nav-tabs li.active');
		   	$active.next().removeClass('disabled');
		   	nextTab($active);		
			//$active.addClass('disabled'); 
		
		}else if($(this).attr("id") == "save_image"){
			var editproductid	= $("#editproductid").val();
               $("#product_attribute_id").val($('#product_id').val());
			//var formData = new FormData( $("#image_upload")[0] );
			
			var $active = $('.wizard .nav-tabs li.active');
		   	$active.next().removeClass('disabled');
		   	nextTab($active);
         //$('#edit_printing').prop('disabled', false); 			
			//$active.addClass('disabled'); 

		}else if($(this).attr("id") == "edit_printing"){
			        
			$.ajax({

				url:baseurl+"admin/products/edit_attributeValue",
				type:'POST',
				data:$('#product_attribute').serialize(),				
			   	//dataType: "json",
	           	success:function(result){
                             		
	           		console.log(result);
	           		var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');					
					nextTab($active);		
					//$active.addClass('disabled');	
	           	}	
			});								

		}else if($(this).attr("id") == "finish_attribute"){
		
			/* var res = false;		
			$('.validate').each(function(){
				if($(this).val()==''){
	            	res = true;	
	               	return false;
	        	}        	
			});
		    	
			if(res){        	
	        	alert('Field value should not be empty!');
	        	return false;
	        }
			*/
	        	        
			$.ajax({

				url:baseurl+"admin/products/edit_attributeValue",
				type:'POST',
				data:$('#finishing_attribute').serialize(),				
			   	//dataType: "json",
	           	success:function(result){               		
	           		console.log(result);
	           		var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');					
					nextTab($active);		
					//$active.addClass('disabled');	
	           	}	
			});								

		}
		/* else if ($(this).attr("id") == "save_attribute"){
			     
			$.ajax({

				url:baseurl+"/admin/products/add_attributeValue",
				type:'POST',
				data:$('#product_attribute').serialize(),				
			   	//dataType: "json",
	           	success:function(result){               		
	           	 console.log(result) ; 	
	           		var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');					
					nextTab($active);		
					//$active.addClass('disabled');	
	           	}	
			});								

	  	} */
		else if ($(this).attr("id") == "save_attribute"){

             $.ajax({

				url:baseurl+"/admin/products/add_attributeValue",
				type:'POST',
				data:$('#product_attribute').serialize(),				
			   	//dataType: "json",
	           	success:function(result){               		
	           	 console.log(result) ;
                    				 
	           		var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');					
					nextTab($active);		
					//$active.addClass('disabled');	
	           	}	
			});		
		
		} else if ($(this).attr("id") == "save_finishing"){

             $.ajax({

				url:baseurl+"/admin/products/add_attributeValue",
				type:'POST',
				data:$('#finishing_attribute').serialize(),				
			   	//dataType: "json",
	           	success:function(result){               		
	           	 console.log(result) ; 	
	           		var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');					
					nextTab($active);		
					//$active.addClass('disabled');	
	           	}	
			});		
		
		}	
		
 	 	
    });
	
    
	$(".skip-step").click(function (e) {
		var $active = $('.wizard .nav-tabs li.active');
		$active.next().removeClass('disabled');
		nextTab($active);
					
		/*
		var type_value = $('#product_type option:selected').val();
		if(type_value == 1){
			$active.next().next().removeClass('disabled');
			nextTab($active.next());

		}else if(type_value == 2){

			$active.next().removeClass('disabled');
			nextTab($active);
		}
		*/
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
		
	$("#add_attribute").click(function(){		
		$("#add_storage").append('<div class="prod-details"><p>Storage Device(GB):&nbsp;<input type="text" name="storage" id="storage" value="" /></p><p>Price:&nbsp;<input type="text" name="price" id="price" value="" /></p></div>');
 
		//alert($("#product_attribute").serialize());
		product_id = $("#product_id").val();
		var datastring = $("#product_attribute").serialize();
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