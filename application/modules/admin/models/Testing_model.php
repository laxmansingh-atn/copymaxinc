<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing_model extends CI_Model
{
	public function Show_testing()
	{ 
		// $this->db->select('tbl_transaction.*,tbl_products.product_name , tbl_product_image.product_image , tbl_order_details.condi , tbl_order_details.network'); 
		$this->db->select('tbl_transaction.*,tbl_products.product_name  , tbl_order_details.condi , tbl_order_details.network , tbl_order_details.product_attribute_value , tbl_order_details.imei_no');
		$this->db->from('tbl_transaction');
		$this->db->join('tbl_order_details', 'tbl_order_details.order_id = tbl_transaction.order_id','left');
		$this->db->join('tbl_products', 'tbl_products.product_id = tbl_order_details.product_id','left');
	//	$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');
		//$this->db->where(array('tbl_page_content.language_code' => $lang));

		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();	
		
	}
	
		public function Show_payment()
	{
	
		$this->db->select('tbl_transaction.*,tbl_payment_details.account_name  , tbl_products.product_name , tbl_payment_details.account_no , tbl_payment_details.short_code');
		$this->db->from('tbl_transaction');
		$this->db->join('tbl_payment_details', 'tbl_payment_details.transaction_id = tbl_transaction.transaction_no','left');
		 $this->db->join('tbl_order_details', 'tbl_order_details.order_id = tbl_transaction.order_id','left');
    	$this->db->join('tbl_products', 'tbl_products.product_id = tbl_order_details.product_id','left');

		//$this->db->where(array('tbl_page_content.language_code' => $lang));

		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();	
		
	}
	
	
	
	public function get_val($table, $match_field, $match_value, $find_field)
	{
		$this->db->select($find_field);
		$this->db->where($match_field, $match_value);
		$this->db->from($table);
		$query = $this->db->get();  
		
		$row = $query->row_array();  
		$temp_value = $row[$find_field];
		
		return $temp_value;  
	 }
	
	public function Insert_Testing($data)
	{
		$this->db->insert('testing',$data);
        //return $this->db->insert_id();
		return false;
	}
	
	public function Get_Category($id)
	{
		$result = $this->db->get_where(TBL_CATEGORY,array('id'=>$id))->result_array();
		return $result;
	}
	
	public function Update_Testing($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('testing',$data);
		//$this->db->insert(TBL_CATEGORY,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Category($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_CATEGORY);
		return true;
	}
}