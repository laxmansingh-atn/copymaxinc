<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial_model extends CI_Model
{
	public function Show_Testimonial()
	{
		$result = $this->db->get(TBL_TESTIMONIAL);
		return $result->result();
	}
	
	public function Insert_Testimonial($data)
	{
		$this->db->insert(TBL_TESTIMONIAL,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Update_Testimonial($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_TESTIMONIAL,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Testimonial($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_TESTIMONIAL);
		return true;
	}
	
	public function Get_Testimonial($id)
	{
		$result = $this->db->get_where(TBL_TESTIMONIAL,array('id'=>$id))->result_array();
		return $result;
	}
}