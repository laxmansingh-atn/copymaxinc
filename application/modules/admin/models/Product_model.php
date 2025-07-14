<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Product_model extends CI_Model


{


	// Get Prduct Types


	public function Get_Product_Type()


	{


		$result = $this->db->get_where(TBL_PRODUCTTYPE,array('status'=>'1'));


		//$result = $this->db->get(TBL_PRODUCTTYPE);


		return $result->result();


	}


	


	public function Get_Product_Content($id,$lang)


	{


		$result = $this->db->get_where('tbl_product_content',array('product_id'=>$id,'language_code'=>$lang))->result_array();


		return $result;


	}


	


	/*public function Show_Products()


	{


		$result = $this->db->get(TBL_PRODUCT);


		return $result->result();


	}*/


	


	public function Show_Products()


	{


		//$result = $this->db->get(TBL_CATEGORY);


        $this->db->select('tbl_products.*,tbl_product_image.product_image');


		$this->db->from('tbl_products');


		$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');


		$result = $this->db->get();


		return $result->result();


	}





	public function Show_Products_admin()


	{


		//$result = $this->db->get(TBL_CATEGORY);


        $this->db->select('tbl_products.*,tbl_product_image.product_image');


		$this->db->from('tbl_products');


		$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');


		$this->db->order_by('tbl_products.showing_rank');


		$result = $this->db->get();


		return $result->result_array();


	}


	


	public function Insert_Products_data($table , $data)


	{


		$this->db->insert($table ,$data);


       //echo  $this->db->last_query(); exit() ;


        $insert_id = $this->db->insert_id();


     //print_r($insert_id) ; 	exit() ; 	


		return $insert_id ; 


	}
	
	
		public function insert_black_and_white_data($table , $data)


	{
		

		$this->db->insert($table ,$data);


       //echo  $this->db->last_query(); exit() ;


        $insert_id = $this->db->insert_id();


     //print_r($insert_id) ; 	exit() ; 	


		return $insert_id ; 


	}
	
	
	public function insert_coil_binding_cost_data($table , $data)


	{
		
		$this->db->insert($table ,$data);


       //echo  $this->db->last_query(); exit() ;


        $insert_id = $this->db->insert_id();


     //print_r($insert_id) ; 	exit() ; 	


		return $insert_id ; 


	}
	
		public function insert_front_cover_option_data($table , $data)


	{
		
		
		$this->db->insert($table ,$data);


       //echo  $this->db->last_query(); exit() ;


        $insert_id = $this->db->insert_id();



		return $insert_id ; 


	}
	
	public function Insert_front_cover_data($table , $data)


	{

		$result = $this->db->insert_batch($table ,$data);


	}
	


	public function Insert_Product_varient($table , $data)


	{


		$this->db->insert($table , $data);


		//echo  $this->db->last_query(); exit() ;


		$insert_id = $this->db->insert_id();


        


		return $insert_id ; 


	}


	


	public function Insert_Networkcontent($data)


	{


		


		$this->db->insert_batch('network_attribute', $data);


        //return $this->db->last_query();


		return true ; 


	}


	public function Update_Networkcontent($network_data)


	{


		


		$this->db->update_batch('network_attribute',$network_data, 'product_id'); 


         //echo $this->db->last_query(); exit() ;


		return true ; 


	}


	


	public function Update_Products($id, $data)


	{


		$this->db->where('product_id',$id);


		$this->db->update(TBL_PRODUCT,$data);


		


		//echo $this->db->last_query();


		return true;


	}


	


	public function Insert_Product_Content($data)


	{


		$this->db->insert_batch('tbl_product_content', $data);


		//$this->db->insert(TBL_BANNER_CONTENT,$data);


		return true;


	}


	


	public function Update_Product_Content($id,$lang,$data)


	{


		$this->db->where(array('product_id'=>$id,'language_code'=>$lang));


		$this->db->update('tbl_product_content',$data);


		return true;


	}


	


	public function Insert_Product_Image($data, $flag='update', $product_id=''){


		if($flag == "add"){





			//$this->db->insert_batch('tbl_product_image',$data);


			$this->db->insert('tbl_product_image',$data);


			$id = $this->db->insert_id();


			return $id;


		


		}else if($flag == "update"){				





			$this->db->where('product_id', $product_id);			


			$query = $this->db->update('tbl_product_image', array('product_image'=>$data['product_image']));				


			return true;


		}


	}


	


	public function Delete_Product($product_id)


	{


		$this->db->delete('tbl_products', array('product_id' => $product_id));


		$this->db->delete('tbl_product_category', array('product_id' => $product_id));		


		$this->db->delete('tbl_product_image', array('product_id'=>$product_id));


		$this->db->delete('tbl_product_variants', array('product_id'=>$product_id));


		$this->db->delete('tbl_product_range_price', array('product_id'=>$product_id));


		


		return true;


	}


	


	public function Delete_Product_Detail($product_id,$detail_id){


		


		$this->db->delete('tbl_product_variants', array('product_id'=>$product_id));


		$this->db->delete('tbl_product_image', array('product_id'=>$product_id));		


		return true;


	}


	


	public function Get_price_range($id=null)


	{		


		$this->db->select('*');


		$this->db->from('tbl_product_range_price');


		if(!empty($id)){


		$this->db->where(array('tbl_product_range_price.product_id'=>$id));


		} 


		


		$result = $this->db->get();


		return $result->result_array();


	}


	


	


	public function Delete_Product_Image($id){


		$this -> db -> where('product_id', $id);


		$this -> db -> delete('tbl_product_image');


		return true;


	}


	


	


	


	


	public function Get_Product_Image($id){


		$result = $this->db->get_where('tbl_product_image',array('product_id'=>$id))->result_array();


		//$this -> db -> where('id', $id);


		//$this -> db -> delete('tbl_product_image');


		return $result;


	}


	


	public function Insert_Product_Category($data, $flag='update', $product_id='')


	{


		if($flag == 'add')


		{


			$this->db->insert_batch('tbl_product_category', $data);


			return true;


		}


		else if($flag == 'update')


		{


			$new_exist_keys = $all_exist_keys = array();


			$a_pro_cat = array();





			$this->db->select('*');


			$this->db->where('product_id', $product_id);


			$query = $this->db->get('tbl_product_category');				


			$a_pro_cat = $query->result_array();


			


			$a_old_data = array();


			$a_new_data = array();


			foreach($a_pro_cat as $a_pro){


				$a_old_data[] = $a_pro['category_id'];


			}


			foreach($data as $datas)


			{	


				$a_new_data[] = $datas['category_id'];


				$new_exist_keys[] = $datas['category_id'];


				if($datas['id'] == "")


				{


					$a_insert = array('product_id'=>$datas['product_id'],'category_id'=>$datas['category_id']);


					$this->db->insert('tbl_product_category', $a_insert);


				}


			}


		


			foreach($a_old_data as $old_datas){


				if(!in_array($old_datas,$a_new_data)){


					$this->db->delete('tbl_product_category',array('product_id'=>$product_id,'category_id'=>$old_datas,));


					//echo "Match : ".$old_datas;


				}


			}


			return true;


		}


	}


	


	public function is_in_array($array, $key, $key_value)


	{


		$within_array = 'no';


		foreach( $array as $k=>$v ){


		if( is_array($v) ){


			$within_array = is_in_array($v, $key, $key_value);


			if( $within_array == 'yes' ){


				break;


			}


		} else {


				if( $v == $key_value && $k == $key ){


						$within_array = 'yes';


						break;


				}


		}


		}


		return $within_array;


	}


	


	


	public function Update_Product_Category($data)


	{


		$this->db->update_batch('tbl_product_category',$data, 'id');


		return true;


	}


	


	public function Delete_Product_Category($id)


	{


		$this->db->where('product_id', $id);


		$this->db->delete('tbl_product_category');


		return true;


	}


	


	public function Get_product_data($id ){


	$this->db->select('tbl_products.*') ;


    $this->db->from('tbl_products');	


	$this->db->where('tbl_products.product_id' , $id ) ;


	$result = $this->db->get();


	return $result->result_array();


	}


	


	public function Get_Product($id,$lang)


	{


		//$result = $this->db->get_where(TBL_CATEGORY,array('id'=>$id))->result_array();


		//return $result;


		$this->db->select('tbl_products.*');


		$this->db->from('tbl_products');


		//$this->db->join('tbl_product_content', 'tbl_product_content.product_id = tbl_products.product_id');


		//$this->db->join('network_attribute', 'network_attribute.product_id = tbl_products.product_id' , 'right');


		//$this->db->where(array('tbl_product_content.product_id'=>$id,'tbl_product_content.language_code' => $lang));


		$this->db->where(array('tbl_products.product_id'=>$id)); 


		$result = $this->db->get();


		//echo $this->db->last_query(); exit();


		return $result->result_array();


	}


	


	/* public function Get_attribute($id , $type){


	


	$this->db->select('tbl_product_variants.* , tbl_attribute_value.value, tbl_product_range_price.product_varient_id,tbl_product_range_price.range_from,tbl_product_range_price.range_to,tbl_product_range_price.price') ;


	$this->db->from('tbl_product_variants');


	$this->db->join('tbl_attribute_value', 'tbl_attribute_value.value_id = tbl_product_variants.attr_value_id' , 'right');


	$this->db->join('tbl_product_range_price', 'tbl_product_range_price.product_varient_id = tbl_product_variants.id' , 'left');


	$this->db->where('tbl_product_variants.product_id' , $id );


	$this->db->where('tbl_product_variants.attr_type' , $type );


	$result = $this->db->get();


	return $result->result_array();


	


	}


	*/


	


	public function Get_distinct_attribute($id , $type){


		$this->db->select('tbl_product_variants.*');


		$this->db->from('tbl_product_variants');


	


	    $this->db->where('tbl_product_variants.product_id' , $id );


	    $this->db->where('tbl_product_variants.attr_type' , $type );


		//$this->db->group_by('p_varient_group_id');


		$result = $this->db->get();


		$product_attr_list = $temp_arr = array();


		foreach($result->result_array() as $key=> $attributerow){


		//$arr = $attributerow ;


		


        //$temp_arr[$key] = $this->Get_attributeval($id ,$type,$attributerow['p_varient_group_id']);		


		//$product_attr_list[] = $arr;


       // $temp_arr['attribute']['price_list'] = $this->get_attribute_price($attributerow['p_varient_group_id']);


          //$temp_arr[$key]['p_varient_group_id'] = $attributerow['p_varient_group_id']; 	   


	}


		//return $result->result_array();


		return $temp_arr; 


}


		


		


  public function Get_attributeval($id , $type , $group_id){


	


	$this->db->select('tbl_product_variants.*') ;


	$this->db->from('tbl_product_variants');


	


	$this->db->where('tbl_product_variants.product_id' , $id );


	$this->db->where('tbl_product_variants.attr_type' , $type );


	$this->db->where('tbl_product_variants.p_varient_group_id' , $group_id );


	


	$result = $this->db->get();


	/* $product_attr_list = $temp_arr = array();


	foreach($result->result_array() as  $attributerow){


		$arr = $attributerow ;


       // $temp_arr['price_list'] = $this->get_attribute_price($attributerow['p_varient_group_id']);		


		$product_attr_list[] = $arr; 


	} */


	


	return $result->result_array();


	


	}


	


	


	public function Get_attribute($id , $type){


	


	$this->db->select('tbl_product_variants.*') ;


	$this->db->from('tbl_product_variants');


	


	$this->db->where('tbl_product_variants.product_id' , $id );


	$this->db->where('tbl_product_variants.attr_type' , $type );


	


	$result = $this->db->get();


	/* $product_attr_list = $temp_arr = array();


	foreach($result->result_array() as  $attributerow){


		$arr = $attributerow ;


       // $temp_arr['price_list'] = $this->get_attribute_price($attributerow['p_varient_group_id']);		


		$product_attr_list[] = $arr; 


	} */


	


	return $result->result_array();


	


	}


	


	public function get_attribute_price($group_id){


	  $this->db->select('tbl_product_range_price.*') ;


      $this->db->from('tbl_product_range_price');


      $this->db->where('tbl_product_range_price.c_varient_group_id ' , $group_id );


      $result = $this->db->get();


	  $product_attr_list = $temp_arr = array();


	  foreach($result->result_array() as  $price){


		  if($group_id == $price['c_varient_group_id']){


		  


		  $product_attr_list[] = $price; 


		 continue; 


		  } else {


			  break;


		  }


	  }


      return $product_attr_list;	  


	}


	


	


	


	public function Get_Product_Category($id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_category');


		$this->db->where(array('tbl_product_category.product_id'=>$id));


		


		//$this->db->get_where('tbl_product_category',array('product_id'=>$id))->result_array();


		$result = $this->db->get();


		return $result->result_array();


	}


	


	public function Get_ProductImage($id)


	{


		$result = $this->db->get_where(TBL_PRODUCT_IMAGE,array('product_id'=>$id))->result_array();


		//echo $this->db->last_query();exit();


		return $result;


	}


	


	


	


	public function Show_product_Details($id)


	{


		$result = $this->db->get_where('tbl_product_details',array('product_id'=>$id));


		//echo $this->db->last_query();exit();


		return $result->result_array();


		/*$this->db->select('tbl_products.*,tbl_product_content.product_title,tbl_product_content.short_description,tbl_product_content.description');


		$this->db->from('tbl_products');


		$this->db->join('tbl_product_content', 'tbl_products.id = tbl_product_content.product_id','left');


		$this->db->where(array('tbl_product_content.language_code' => $lang));


		$result = $this->db->get();


		return $result->result();*/


	}


	


	public function Get_Product_Details($p_id,$d_id)


	{


		$result = $this->db->get_where('tbl_product_details',array('id'=>$d_id,'product_id'=>$p_id));


		return $result->result_array();


	}


	


	public function Get_Product_Attribute_Details($p_id,$d_id='')


	{


		$result = $this->db->get_where('tbl_product_variants',array('product_id'=>$p_id));


		return $result->result_array();


	}


	


	public function Get_Product_Attribute_Images($p_id,$d_id)


	{


		$result = $this->db->get_where('tbl_product_image',array('product_id'=>$p_id));


		return $result->result_array();


	}


	


	public function Insert_Product_Details($data)


	{


		$insert = $this->db->insert(TBL_PRODUCT_DETAIL,$data);


        //return $insert?true:false;


        return $this->db->insert_id();


		//return false;


	}


	


	public function Insert_Product_Attribute($data)


	{


		$insert = $this->db->insert_batch('tbl_product_variants',$data);


		//$id = $this->db->insert_id();


		return $insert?true:false;


		//echo $this->db->last_query(); exit();


		//return true;


	}


	


	public function Insert_Product_AttributeValue($data)


	{


		$insert = $this->db->insert(TBL_PRODUCT_VARIANT,$data);


        return $insert?true:false;


		//$this->db->insert(TBL_PRODUCT_IMAGE,$data);


        //return $this->db->insert_id();


		//return false;


	}


	


	public function Update_Product_Details($id,$data)


	{


		$this->db->where('id', $id);


		$this->db->update(TBL_PRODUCT_DETAIL, $data);	


		return true;


	}


	


	public function Update_Product_Image($data){


		$this->db->update_batch('tbl_product_image',$data, 'id');


		return true;


	}


	


	public function Update_Product_Attribute($data,$product_id,$detail_id)


	{


		$this->db->select('*');


		$this->db->where('product_id', $product_id);		


		$query = $this->db->get('tbl_product_variants');				


		$a_pro_attr = $query->result_array();


		


		$a_insert = array();


		$a_update = array();


		


		$a_old_data = array();


		$a_new_data = array();


		


		foreach($a_pro_attr as $a_pro_attrs){


			$a_old_data[] = $a_pro_attrs['id'];


		}


		


		foreach($data as $datas)


		{


			if($datas['id'] != "")


			{


				$a_new_data[] = $datas['id'];


				$a_update[] = $datas;


			}


			else


			{


				unset($datas['id']);


				$a_insert[] = $datas;


			}


		}


		


		if(!empty($a_update))


		{


			$this->db->update_batch('tbl_product_variants',$a_update,'id');


		}


		if(!empty($a_insert))


		{


			$this->db->insert_batch('tbl_product_variants',$a_insert);


		}


		


		foreach($a_old_data as $old_datas){


			if(!in_array($old_datas,$a_new_data)){


				$this->db->delete('tbl_product_variants',array('id'=>$old_datas));


				//echo "UNMatch : ".$old_datas;


			}


		}


		//echo "<pre>"; print_r($a_pro_attr);print_r($data);echo "</pre>";exit();


		return true;


	}


	


	


	public function getProductDetailsValue($id, $flag='')


	{


		$this->db->from(TBL_PRODUCT_VARIANT);





		if($flag=='category')		


			$this->db->where_in("product_id", $id);


		else


			$this->db->where("product_id", $id);


		


		$this->db->order_by("product_id", "asc");


		$result = $this->db->get();


		


		return $result->result_array();


	}


	


	public function getAttributeValueByName($name){		


		$sql = "Select * From tbl_attribute_value Where attribute_id = 


				(Select attribute_id From tbl_attribute Where attribute_name = '".$name."')";				


		


		//echo $sql;exit();


		$result = $this->db->query($sql);


		return $result->result_array();		


	}


	


	public function update_attr_val($data=array()){		


			


		$arr = array();


		foreach($data['post_val'] as $key=>$value){			


			$arr[] = $key.":".$value;


		}		


		$product_attribute_value = implode(',', $arr);		


							


		$this->db->where('product_detail_id', $data['product_detail_id']);


		$this->db->update(TBL_PRODUCT_DETAIL, array('product_attribute_value'=>$product_attribute_value));


		return true;


	}





	public function get_printing_attributes()


	{


		$this->db->select('*');


		$this->db->from('tbl_master_printing_attribute');


		$result = $this->db->get();





		return $result->result_array();


	}





	public function get_printing_product_attributes($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_printing_attribute');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();





		//echo "<pre>";print_r($result->result_array());die();


		


		foreach ($result->result_array() as $key => $value) {


			$temp = $value;


			if ($value['paper_type_group_id'] != 0) {


				$temp['page_types'] = $this->get_paper_types($value['paper_type_group_id']);


			}


			$temp_arr[] = $temp;


		}


		return $temp_arr;


	}





	public function get_paper_types($group_id)


	{


		$this->db->select('attr_value');


		$this->db->from('tbl_master_printing_attribute');


		$this->db->where('page_group_id',$group_id);


		$result = $this->db->get();


		return $result->result_array();


	}





	public function get_edit_printing_product_attributes($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_printing_attribute');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		


		foreach ($result->result_array() as $key => $value) {


			$temp = $value;


			if(!empty($value['dimension'])){


				$temp['dimension_value'] = $this->get_dimension_value($value['dimension'], $product_id);


			}


			$temp_arr[] = $temp;


		}


		return $temp_arr;


	}
	
	
	
		public function get_front_cover_data($product_id)


	{
		
		
		$this->db->select('*');


		$this->db->from('tbl_back_cover');


		$this->db->where('product_id',$product_id);
		
		$this->db->where('attr_type',"front cover options");


		$result = $this->db->get();
		$temp_arr = [];
		
		foreach($result->result_array() as $key=>$value){
			
			$temp_arr[$key]['front_cover_type'] = $value['front_cover_type'];
			$temp_arr[$key]['price'] = $value['price'];
				
		}



		return $temp_arr;


	}
	
	
	public function get_black_and_white_data($product_id)


	{
		
		
		$this->db->select('*');


		$this->db->from('tbl_back_cover');


		$this->db->where('product_id',$product_id);
		
		$this->db->where('attr_type',"black and white");


		$result = $this->db->get();
		$temp_arr = [];
		
		foreach($result->result_array() as $key=>$value){
			
			$temp_arr[$key]['range_from'] = $value['range_from'];
			$temp_arr[$key]['range_to'] = $value['range_to'];
			
			$temp_arr[$key]['dimension'] = $value['dimension'];
			$temp_arr[$key]['page_side'] = $value['page_side'];
			$temp_arr[$key]['page_type'] = $value['page_type'];
			
			$temp_arr[$key]['ink_type'] = $value['ink_type'];
			$temp_arr[$key]['price'] = $value['price'];
			$temp_arr[$key]['attr_type'] = $value['attr_type'];
				
		}



		return $temp_arr;


	}
	
	
		public function get_coil_binding_cost_data($product_id)


	{
		
		
		$this->db->select('*');


		$this->db->from('tbl_back_cover');


		$this->db->where('product_id',$product_id);
		
		$this->db->where('attr_type',"coil binding cost");


		$result = $this->db->get();
		$temp_arr = [];
		
		foreach($result->result_array() as $key=>$value){
			
			$temp_arr[$key]['range_from'] = $value['range_from'];
			$temp_arr[$key]['range_to'] = $value['range_to'];
			$temp_arr[$key]['sheets'] = $value['sheets'];
			
			$temp_arr[$key]['price'] = $value['price'];
			$temp_arr[$key]['attr_type'] = $value['attr_type'];
				
		}



		return $temp_arr;


	}
	
	
	public function get_front_cover_price_data($product_id)


	{
		
		
		$this->db->select('*');


		$this->db->from('tbl_back_cover');


		$this->db->where('product_id',$product_id);
		
		$this->db->where('attr_type',"front cover");


		$result = $this->db->get();
		$temp_arr = [];
		
	
		
		foreach($result->result_array() as $key=>$value){
			
			
			$temp_arr[$key]['dimension'] = $value['dimension'];
			$temp_arr[$key]['price'] = $value['price'];
			$temp_arr[$key]['attr_type'] = $value['attr_type'];
			$temp_arr[$key]['page_type'] = $value['page_type'];
			$temp_arr[$key]['ink_type'] = $value['ink_type'];
			$temp_arr[$key]['sides'] = $value['sides'];
				
		}
		


		return $temp_arr;


	}





	public function get_dimension_value($dimension, $product_id)


	{


		$this->db->select('range_from,range_to,page_side,price');


		$this->db->from('tbl_product_printing_price');


		$this->db->where('dimension',$dimension);


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		return $result->result_array();


	}





	public function get_edit_product_details($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_products');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		return $result->row_array();


	}





	public function get_product_printing_attribute($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_printing_attribute');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		return $result->result_array();


	}





	public function get_product_paper($product_id)


	{


		$this->db->select('paper_type_group_id,product_id');


		$this->db->from('tbl_product_printing_attribute');


		$this->db->where('product_id',$product_id);


		$this->db->where('paper_type_group_id !=',0);


		$result = $this->db->get();


		foreach ($result->result_array() as $key => $value) {


			$temp = $value;


			$temp['attribute'] = $this->get_page_details('page_type,price,dimension',$value['paper_type_group_id'],'tbl_product_printing_price','paper_group_id',$value['product_id']);


			$temp['master'] = $this->get_page_details('attr_value',$value['paper_type_group_id'],'tbl_master_printing_attribute','page_group_id','');


			$temp_arr[] = $temp;


		}


		return $temp_arr;


	}





	public function get_page_details($field,$paper_type_group_id,$table,$where,$product_id)


	{


		$this->db->select($field);


		$this->db->from($table);


		$this->db->where($where,$paper_type_group_id);


		if (!empty($product_id)) {


			$this->db->where('product_id',$product_id);	


		}


		$result = $this->db->get();


		return $result->result_array();


	}





	public function get_product_finishing_paper($product_id)


	{


		$this->db->select('paper_type_group_id');


		$this->db->from('tbl_product_printing_attribute');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();





		//echo "<pre>";print_r($result->result_array());die();


		


		foreach ($result->result_array() as $key => $value) {


			$temp = $value;


			if ($value['paper_type_group_id'] != 0) {


				$temp['page_types'] = $this->get_paper_types($value['paper_type_group_id']);


			}


			$temp_arr[] = $temp;


		}


		return $temp_arr;


	}





	public function master_paper_group()


	{


		$this->db->select('*');


		$this->db->from('tbl_master_printing_attribute');


		$this->db->where(array('attr_name'=>'paper type','page_group_id'=>0));


		$result = $this->db->get();


		return $result->result_array();


	}





	public function get_finishing_attributes($product_id)


	{


		$this->db->select('distinct(attr_type)');


		$this->db->from('tbl_product_finishing_price');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		//return $result->result_array();


		$temp_arr = array();


		foreach ($result->result_array() as $key => $value) {


			$temp = $value;


			$temp[$value['attr_type']] = $this->get_finishing($value['attr_type'],$product_id);


			$temp_arr[$value['attr_type']] = $temp;


		}


		//echo "<pre>";print_r($temp_arr);die();


		return $temp_arr;


	}





	public function get_finishing($attr_type,$product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_finishing_price');


		$this->db->where('attr_type',$attr_type);


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		return $result->result_array();


	}





	public function get_edit_product_image($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_image');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		return $result->row_array();


	}





	public function get_tab_values($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_tab_value');


		$this->db->where('product_id',$product_id);


		$result = $this->db->get();


		return $result->row_array();


	}





	public function get_folding_details($product_id)


	{


		$this->db->select('*');


		$this->db->from('tbl_product_finishing_price');


		$this->db->where('product_id',$product_id);


		$this->db->where('attr_type','folding');


		$result = $this->db->get();


		return $result->row_array();


	}





	public function get_folding_dimension($product_id)


	{


		$this->db->select('dimension');


		$this->db->from('tbl_product_finishing_price');


		$this->db->where('product_id',$product_id);


		$this->db->where('attr_type','folding');


		$this->db->group_by('dimension');


		$result = $this->db->get();


		return $result->result_array();


	}





	public function getRow($table,$condition){


        $this->db->where($condition);


        $query=$this->db->get($table);


       // echo $this->db->last_query();die;


        return $query->row_array();


	}


	


	public function get_dimension($product_id){


		


		$sql1 = "select id,dimension from tbl_product_printing_attribute where product_id='".$product_id."'";


		$query = $this->db->query($sql1);


		$result = $query->result_array();


		return $result;


		


	}

/* shakil*/
	

	public function getPaperTypes_New(){
		$sql1 = "select id,attr_value,page_group_id from tbl_master_printing_attribute where attr_name='paper type'";
		$query = $this->db->query($sql1);
			$result = $query->result_array();
            return $result;
	}
	
public function paper_management_New($id){
                if($id==0){
                $sql1 = "select * from paper_management INNER JOIN tbl_master_printing_attribute ON tbl_master_printing_attribute.id= paper_management.paper_type";
                }else{
                $sql1 = "select * from paper_management INNER JOIN tbl_master_printing_attribute ON tbl_master_printing_attribute.id= paper_management.paper_type WHERE paper_management.paper_type='$id'";
                }

                $query = $this->db->query($sql1);
                $result = $query->result_array();
                return $result;
	}
	
public function did_delete_row($id){
    $this -> db -> where('paper_type', $id);
    $this -> db -> delete('paper_management');
    $result = 1;
    return $result; 
}
	

	
	
	


	public function getPaperTypes($product_id){


		$sql1 = "select id,attr_value,page_group_id from tbl_master_printing_attribute where id in (select distinct paper_group_id from tbl_product_printing_price where product_id='".$product_id."' and range_to=0) and page_group_id=0 and attr_name='paper type'";


		$query = $this->db->query($sql1);


		if($query->num_rows() > 0){


			//echo $this->db->last_query();echo "<br>";


			//echo "<pre>"; print_r($query->result_array());die();


			$result = $query->result_array();$i=0;


			foreach($result as $row){


				$sql2 = "select id,attr_value,page_group_id from tbl_master_printing_attribute where page_group_id='".$row['id']."' and attr_name='paper type'";


				$query2 = $this->db->query($sql2);


				if($query2->num_rows() > 0){


					$result[$i]['sub_type'] = $query2->result_array();


				}else{


					$result[$i]['sub_type'] = array();


				}


				$i++;


			}


			return $result;


			//echo "<pre>"; print_r($result);die();


		}else{


			return array();


		}


	}





	public function batch_insert($table,$data){


        $this->db->insert_batch($table,$data); 


        return 1; 


	}


	


	public function Show_Weight_List(){


		


		$sql = "SELECT  pw.product_id,pw.sheets_count,tp.product_name FROM product_weight pw 


				INNER JOIN tbl_products tp ON pw.product_id=tp.product_id


				GROUP BY pw.product_id";


		$query = $this->db->query($sql);


		$result = $query->result_array();


		return $result;


	}





	public function get_product_weight_data($product_id){


		


		$sql = "SELECT  product_weight_id, product_id, dimension, master_printing_attribute_id, weight, height, created_on, updated_on, sheets_count FROM product_weight pw WHERE pw.product_id=".$product_id;


		$query = $this->db->query($sql);


		$result = $query->result_array();


		return $result;


	}





	public function insert($table,$data){
        $this->db->insert($table,$data);     
        return $this->db->insert_id();


        //echo $this->db->last_query(); die();


	}


	


	public function update($table,$condition,$data){


        $this->db->where($condition);


        $this->db->update($table,$data);


        //echo $this->db->last_query();die;


        return 1;


    }
    
    
    





	


}