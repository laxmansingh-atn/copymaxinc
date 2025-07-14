<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}
	
	public function get_cart_details(){
	    $this->db->select('*');
	    $this->db->from('tbl_cart');
	    $query = $this->db->get();
        return $query->result_array();		
	}
	
	public function get_cart_product($user_id) {
 			
 		$this->db->select('*');
	    $this->db->from('tbl_cart');
	    $this->db->where('user_id', $user_id);
	    $query = $this->db->get();

	    $arr = $arr1 = array();
	    if($query->num_rows()>0){		    
		    foreach($query->result_array() as $row){
		       //print_r($row);exit();
				$arr['user_id'] 				= $row['user_id'];
				$arr['id'] 						= $row['id'];
				$arr['product_id']				= $row['product_id'];				
				$arr['product_attribute_value']	= $row['product_attribute_value'];								
				$arr['name'] 					= $row['name'];
				$arr['price'] 					= $row['price'];
				$arr['qty'] 					= $row['qty'];
		    	$arr['imei_no'] 				= $row['imei_no'];
				$arr['condi'] 				    = $row['condi'];
				$arr['network'] 				= $row['network'];
				$arr['payment_type'] 			= $row['payment_type'];
		    	$arr1[] = $arr;
		    }
		}		
		return $arr1;
	}
	
	//Get product details based on id and value
	public function getProductDetails($id,$value)
	{
		//$query = "SELECT * FROM `tbl_product_details` WHERE `product_id` = $id AND `product_attribute_value` = $value";
		$query = "SELECT * FROM `tbl_product_details` WHERE `product_id` = $id AND `product_attribute_value` = '$value'";
		$result = $this->db->query($query);
		//$query->num_rows()
		/*$this->db->from(TBL_PRODUCT_DETAIL);
		$this->db->where("product_id", $id);
		$this->db->order_by("product_detail_id", "asc");
		$result = $this->db->get();*/
		return $result->result_array();
	}	

}