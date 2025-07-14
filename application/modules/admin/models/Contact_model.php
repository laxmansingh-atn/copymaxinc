<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{
	public function Show_Contacts()
	{
        $this->db->from('tbl_contact_us');
        $this->db->order_by("id", "desc");
        $result = $this->db->get(); 
		return $result->result();
	}
	
	public function Insert_Contact($data)
	{
		$this->db->insert(TBL_CONTACT,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Get_Contact($id)
	{
		$result = $this->db->get_where(TBL_CONTACT,array('id'=>$id))->result_array();
		return $result;
	}
	
	public function Update_Contact($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_CONTACT,$data);
		//$this->db->insert(TBL_CONTACT,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Contact($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_CONTACT);
		return true;
	}
}