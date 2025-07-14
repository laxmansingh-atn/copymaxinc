<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Network_model extends CI_Model
{
	public function Show_Brands($lang='')
	{
		//$result = $this->db->get(TBL_BRANDS);
		$this->db->select('tbl_networks.* , tbl_products.product_name');
		$this->db->from('tbl_networks');
	    $this->db->join('tbl_products', 'tbl_products.product_id = tbl_networks.product_id','left');
		$result = $this->db->get();
		return $result->result();
	}
	
	public function Show_allProducts($lang='')
	{		
		$this->db->select('*');
		$this->db->from('tbl_products');
		//$this->db->join('tbl_product_content', 'tbl_products.product_id = tbl_product_content.product_id','left');
		//$this->db->where(array('tbl_product_content.language_code' => $lang));
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Insert_Brands($data)
	{
		$this->db->insert('tbl_networks',$data);
        return $this->db->insert_id();
		//return false;
	}

	public function Get_Brand($id)
	{
		//$result = $this->db->get_where(TBL_BRANDS,array('id'=>$id))->result_array();
		//return $result;
		$this->db->select('*');
		$this->db->from('tbl_networks');
		
		$this->db->where(array('tbl_networks.id'=>$id));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Brands($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_networks',$data);
		//$this->db->insert(TBL_BRANDS,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	
	public function Delete_Brands($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_networks');
		return true;
	}
}