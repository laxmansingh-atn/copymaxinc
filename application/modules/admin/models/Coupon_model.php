<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon_model extends CI_Model
{
	public function show_all_blast()
	{
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$result = $this->db->get();
		//echo $this->db->last_query();die();
		return $result->result_array();
	}

	public function check_already_exists($coupon_code)
	{
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('coupon_code',$coupon_code);
		$result = $this->db->get();
		//echo $this->db->last_query();die();
		return $result->num_rows();
	}

	public function insert($data)
	{
		$this->db->insert('tbl_coupon',$data);
    	return $this->db->insert_id();
		//return true;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_coupon');
		return true;
	}

	public function get_coupon($id)
	{		
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where(array('id'=>$id));
		 
		$result = $this->db->get();
		return $result->row_array();
	}

	public function update($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_coupon',$data);
		return true;
	}
}