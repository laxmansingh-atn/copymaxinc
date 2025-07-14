<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model
{
	public function Show_Page($lang)
	{
		//$result = $this->db->get(TBL_PAGE);
		//return $result->result();
		
		$this->db->select('tbl_pages.*,tbl_page_content.page_title,tbl_page_content.page_content');
		$this->db->from('tbl_pages');
		$this->db->join('tbl_page_content', 'tbl_pages.id = tbl_page_content.page_id','left');
		$this->db->where(array('tbl_page_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
		
	}
	
	public function Get_Page_Content($id,$lang)
	{
		$result = $this->db->get_where('tbl_page_content',array('page_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Insert_Page($data)
	{
		$this->db->insert(TBL_PAGE,$data);
    	return $this->db->insert_id();
		//return true;
	}
	
	public function Insert_Page_Content($data){
		$this->db->insert_batch('tbl_page_content', $data);
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		return true;
	}
	
	public function Update_Page_Content($id,$lang,$data){
		$this->db->where(array('page_id'=>$id,'language_code'=>$lang));
		$this->db->update('tbl_page_content',$data);
		return true;
	}
	
	public function Get_Page($id,$lang)
	{
		//$result = $this->db->get_where(TBL_PAGE,array('id'=>$id))->result_array();
		//return $result;
		
		$this->db->select('*');
		$this->db->from('tbl_pages');
		$this->db->join('tbl_page_content', 'tbl_page_content.page_id = tbl_pages.id');
		$this->db->where(array('tbl_page_content.page_id'=>$id,'tbl_page_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Page($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_PAGE,$data);
		//$this->db->insert(TBL_PAGE,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Page($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_PAGE);
		return true;
	}
}