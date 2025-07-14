<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_model extends CI_Model
{
	public function Show_Request_Quote()
	{
		$result = $this->db->get('tbl_request_quote');
		return $result->result();
	}
	
	public function Get_Request_Quote($id)
	{
		$result = $this->db->get_where('tbl_request_quote',array('id'=>$id))->result_array();
		return $result;
		//$result = $this->db->get('tbl_request_quote');
		//return $result->result();
	}
	
	/*public function Insert_Banner($data)
	{
		$this->db->insert(TBL_BANNER,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Get_Banner($id)
	{
		$result = $this->db->get_where(TBL_BANNER,array('id'=>$id))->result_array();
		return $result;
	}
	
	public function Update_Banner($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_BANNER,$data);
		//$this->db->insert(TBL_BANNER,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Banner($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_BANNER);
		return true;
	}*/
}