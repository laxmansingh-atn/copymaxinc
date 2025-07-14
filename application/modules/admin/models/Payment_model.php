<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model
{
	public function Show_Type($lang)
	{
		$this->db->select('tbl_payment_type.*,tbl_payment_type_content.content');
		$this->db->from('tbl_payment_type');
		$this->db->join('tbl_payment_type_content', 'tbl_payment_type.id =tbl_payment_type_content.type_id','left');
		$this->db->where(array('tbl_payment_type_content.language_code' => $lang));
		$this->db->order_by("tbl_payment_type.type_order", "asc");
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function Insert_Type($data)
	{
		$this->db->insert('tbl_payment_type',$data);
    		return $this->db->insert_id();
	}
	
	public function Insert_Type_Content($data){
		$this->db->insert_batch('tbl_payment_type_content', $data);
		return true;
	}
	
	public function Get_Type_Content($id,$lang)
	{
		$result = $this->db->get_where('tbl_payment_type_content',array('type_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Update_Type_Content($id,$lang,$data){
		$this->db->where(array('type_id'=>$id,'language_code'=>$lang));
		$this->db->update('tbl_payment_type_content',$data);
		return true;
	}
	
	public function Get_Type($id,$lang)
	{	
		$this->db->select('*');
		$this->db->from('tbl_payment_type');
		$this->db->join('tbl_payment_type_content', 'tbl_payment_type_content.type_id = tbl_payment_type.id');
		$this->db->where(array('tbl_payment_type_content.type_id'=>$id,'tbl_payment_type_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Type($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_payment_type',$data);
		//$this->db->insert(TBL_PAGE,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Type($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_payment_type');
		return true;
	}
	
	/************* PAYMENT DETAILS ****************/
	
	public function Show_Details($lang)
	{
		$this->db->select('tbl_payment_details.*,tbl_payment_details_content.content');
		$this->db->from('tbl_payment_details');
		$this->db->join('tbl_payment_details_content', 'tbl_payment_details.id = tbl_payment_details_content.details_id','left');
		$this->db->where(array('tbl_payment_details_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function Insert_Details($data)
	{
		$this->db->insert('tbl_payment_details',$data);
    	return $this->db->insert_id();
	}
	
	public function Insert_Details_Content($data){
		$this->db->insert_batch('tbl_payment_details_content', $data);
		return true;
	}
	
	public function Get_Detail_Content($id,$lang)
	{
		$result = $this->db->get_where('tbl_payment_details_content',array('details_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Update_Detail($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_payment_details',$data);
		//$this->db->insert(TBL_PAGE,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Update_Detail_Content($id,$lang,$data){
		$this->db->where(array('details_id'=>$id,'language_code'=>$lang));
		$this->db->update('tbl_payment_details_content',$data);
		return true;
	}
	
	public function Get_Detail($id,$lang)
	{	
		$this->db->select('*');
		$this->db->from('tbl_payment_details');
		$this->db->join('tbl_payment_details_content', 'tbl_payment_details_content.details_id = tbl_payment_details.id');
		$this->db->where(array('tbl_payment_details_content.details_id'=>$id,'tbl_payment_details_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	
	
	public function Delete_Detail($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_payment_details');
		return true;
	}
}