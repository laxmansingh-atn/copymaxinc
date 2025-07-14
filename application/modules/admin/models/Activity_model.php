<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity_model extends CI_Model
{
	public function Show_Activity($lang)
	{
		//$result = $this->db->get(TBL_BANNER);
		
		$this->db->select('tbl_activity.*,tbl_activity_content.activity_title,tbl_activity_content.activity_content');
		$this->db->from('tbl_activity');
		$this->db->join('tbl_activity_content', 'tbl_activity.id = tbl_activity_content.activity_id','left');
		$this->db->where(array('tbl_activity_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function Get_Activity_Content($id,$lang)
	{
		$result = $this->db->get_where('tbl_activity_content',array('activity_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Insert_Activity($data)
	{
		$this->db->insert('tbl_activity',$data);
		return $this->db->insert_id();
	}
	
	public function Insert_Activity_Content($data){
		$this->db->insert_batch('tbl_activity_content', $data);
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		return true;
	}
	
	public function Update_Activity_Content($id,$lang,$data){
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		$this->db->where(array('activity_id'=>$id,'language_code'=>$lang));
		$this->db->update('tbl_activity_content',$data);
		return true;
	}
	
	public function Get_Activity($id,$lang)
	{
		//$result = $this->db->get_where(TBL_BANNER,array('id'=>$id))->result_array();
		$this->db->select('*');
		$this->db->from('tbl_activity');
		$this->db->join('tbl_activity_content', 'tbl_activity_content.activity_id = tbl_activity.id');
		$this->db->where(array('tbl_activity_content.activity_id'=>$id,'tbl_activity_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Activity($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_activity',$data);
		//$this->db->insert(TBL_BANNER,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function check_content($id,$lang){
		$query_content = $this->db->get_where('tbl_activity_content', array('activity_id' => $id,'language_code'=>$lang));
		$count = $query_content->num_rows(); //counting result from query
		return $count;
	}
	
	public function Delete_Activity($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_activity');
		return true;
	}
}