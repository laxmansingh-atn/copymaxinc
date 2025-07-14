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
		//$this->db->join('tbl_product_content', 'tbl_products.product_id = tbl_product_content.product_id','left');
		//$this->db->join('tbl_product_category', 'tbl_products.product_id = tbl_product_category.product_id','left');
		
		//$this->db->join('tbl_category', 'tbl_category.id = tbl_product_category.category_id','left');
		//$this->db->where(array('tbl_product_content.language_code' => $lang));
		
		//$this->db->join('tbl_category', 'tbl_category.id = tbl_product_category.category_id','left');
		$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');
		$this->db->where('status',1);
		$this->db->order_by('showing_rank','ASC');
		
		$result = $this->db->get();
		return $result->result();
	}
	
	public function Show_search_Products($search_product_txt)
	{
		//$result = $this->db->get(TBL_CATEGORY);
        $this->db->select('tbl_products.*,tbl_product_image.product_image');
		$this->db->from('tbl_products');
		$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');
		$this->db->where('status',1);
		$this->db->order_by('showing_rank','ASC');
		$this->db->like('tbl_products.product_name', $search_product_txt);
		$result = $this->db->get();
		return $result->result();
	}
	
	
	public function Insert_Products_data($table , $data)
	{
		$this->db->insert($table ,$data);
       //echo  $this->db->last_query(); exit() ;
        $insert_id = $this->db->insert_id();
     //print_r($insert_id) ; 	exit() ; 	
		return $insert_id ; 
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
		//$this->db->delete('tbl_product_content', array('product_id' => $product_id));
		//$this->db->delete('tbl_product_category', array('product_id' => $product_id));		
		$this->db->delete('tbl_product_image', array('product_id'=>$product_id));
		//$this->db->delete('tbl_product_variants', array('product_id'=>$product_id));
		//$this->db->delete('network_attribute', array('product_id'=>$product_id));
		
		return true;
	}
	
	public function Delete_Product_Detail($product_id,$detail_id){
		
		$this->db->delete('tbl_product_variants', array('product_id'=>$product_id));
		$this->db->delete('tbl_product_image', array('product_id'=>$product_id));		
		return true;
	}
	
	public function Get_Network($id=null)
	{		
		$this->db->select('*');
		$this->db->from('tbl_networks');
		if(!empty($id)){
		$this->db->where(array('tbl_networks.id'=>$id));
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
		$this->db->select('tbl_products.*,tbl_product_content.product_title,tbl_product_content.description');
		$this->db->from('tbl_products');
		$this->db->join('tbl_product_content', 'tbl_product_content.product_id = tbl_products.product_id');
		//$this->db->join('network_attribute', 'network_attribute.product_id = tbl_products.product_id' , 'right');
		$this->db->where(array('tbl_product_content.product_id'=>$id,'tbl_product_content.language_code' => $lang));
		 
		$result = $this->db->get();
		//echo $this->db->last_query(); exit();
		return $result->result_array();
	}
	
	public function Get_attribute($id){
	/* $this->db->select('network_attribute.*') ;
    $this->db->from('network_attribute'); 
	$this->db->where('network_attribute.product_id' , $id );
	$result = $this->db->get();
	//echo $this->db->last_query(); exit();
	return $result->result_array();
	*/
	$this->db->select('tbl_product_variants.*') ;
	$this->db->from('tbl_product_variants');
	$this->db->where('tbl_product_variants.product_id' , $id );
	$result = $this->db->get();
	return $result->result_array();
	
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
	
	public function get_product_dimensions($id){		
		$sql = "
			SELECT t1.*
			FROM tbl_product_printing_attribute t1
			INNER JOIN (
				SELECT MIN(id) AS id
				FROM tbl_product_printing_attribute
				WHERE product_id = ?
				GROUP BY dimension
			) t2 ON t1.id = t2.id
		";

		$result = $this->db->query($sql, [$id]);
		$dim_arr = $result->result_array();
	
		foreach($dim_arr as $key=> $value){
			
			if($value['dimension'] == "8.5x11"){
				
				$dim_arr[$key]['s_no'] = 1;
				
			}elseif($value['dimension'] == "8.5x14"){
				
				$dim_arr[$key]['s_no'] = 2;
				
			}elseif($value['dimension'] == "11x17"){
				
				$dim_arr[$key]['s_no'] = 3;
				
			}elseif($value['dimension'] == "4.25x5.5"){
				
				$dim_arr[$key]['s_no'] = 4;
				
			}elseif($value['dimension'] == "4.25x11"){
				
				$dim_arr[$key]['s_no'] = 5;
				
			}elseif($value['dimension'] == "8.5x5.5"){
				
				$dim_arr[$key]['s_no'] = 6;
				
			}elseif($value['dimension'] == "8.5x7"){
				
				$dim_arr[$key]['s_no'] = 7;
				
			}elseif($value['dimension'] == "4x6"){
				
				$dim_arr[$key]['s_no'] = 8;
				
			}elseif($value['dimension'] == "5x7"){
				
				$dim_arr[$key]['s_no'] = 9;
				
			}elseif($value['dimension'] == "8x10"){
				
				$dim_arr[$key]['s_no'] = 10;
				
			}else{
				
				$dim_arr[$key]['s_no'] = 99;
				
			}
			
		}
		
		
		$s_no = array();
		foreach ($dim_arr as $key => $row)
		{
			$s_no[$key] = $row['s_no'];
		}
		array_multisort($s_no, SORT_ASC, $dim_arr);
		
		return $dim_arr;
		
		//return $result->result_array();		
				
	}
}