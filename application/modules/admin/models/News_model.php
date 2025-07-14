<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
	public function Show_News($lang)
	{
		//$result = $this->db->get(TBL_BANNER);
		
		$this->db->select('tbl_news.*,tbl_news_content.news_title,tbl_news_content.news_content');
		$this->db->from('tbl_news');
		$this->db->join('tbl_news_content', 'tbl_news.id = tbl_news_content.news_id','left');
		$this->db->where(array('tbl_news_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function Get_News_Content($id,$lang)
	{
		$result = $this->db->get_where('tbl_news_content',array('news_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Insert_News($data)
	{
		$this->db->insert('tbl_news',$data);
        //$banner_id = $this->db->insert_id();
		return $this->db->insert_id();
		//return true;
	}
	
	public function Insert_News_Content($data){
		$this->db->insert('tbl_news_content',$data);
		return true;
	}
	
	public function Update_News_Content($id,$lang,$data){
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		$this->db->where(array('id'=>$id,'language_code'=>$lang));
		$this->db->update('tbl_news_content',$data);
		return true;
	}
	
	public function Get_News($id,$lang)
	{
		//$result = $this->db->get_where(TBL_BANNER,array('id'=>$id))->result_array();
		$this->db->select('*');
		$this->db->from('tbl_news');
		$this->db->join('tbl_news_content', 'tbl_news_content.news_id = tbl_news.id');
		$this->db->where(array('tbl_news_content.news_id'=>$id,'tbl_news_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_News($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_news',$data);
		//$this->db->insert(TBL_BANNER,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function check_content($id,$lang){
		$query_content = $this->db->get_where('tbl_news_content', array('news_id' => $id,'language_code'=>$lang));
		$count = $query_content->num_rows(); //counting result from query
		return $count;
	}
	
	public function Delete_News($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_BANNER);
		return true;
	}
}