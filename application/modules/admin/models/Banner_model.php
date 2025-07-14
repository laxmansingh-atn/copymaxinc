<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model
{
	public function Show_Banner($lang)
	{
		//$result = $this->db->get(TBL_BANNER);
		
		$this->db->select('tbl_banner.*,tbl_banner_content.banner_content');
		$this->db->from('tbl_banner');
		$this->db->join('tbl_banner_content', 'tbl_banner.id = tbl_banner_content.banner_id','left');
		$this->db->where(array('tbl_banner_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function Get_Banner_Content($id,$lang)
	{
		$result = $this->db->get_where(TBL_BANNER_CONTENT,array('banner_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Insert_Banner($data)
	{
		$this->db->insert(TBL_BANNER,$data);
        //$banner_id = $this->db->insert_id();
		return $this->db->insert_id();
		//return true;
	}
	
	public function Insert_Banner_Content($data){
		$this->db->insert_batch(TBL_BANNER_CONTENT, $data);
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		return true;
	}
	
	public function Update_Banner_Content($id,$lang,$data){
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		$this->db->where(array('banner_id'=>$id,'language_code'=>$lang));
		$this->db->update(TBL_BANNER_CONTENT,$data);
		return true;
	}
	
	public function Get_Banner($id,$lang)
	{
		//$result = $this->db->get_where(TBL_BANNER,array('id'=>$id))->result_array();
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$this->db->join('tbl_banner_content', 'tbl_banner_content.banner_id = tbl_banner.id');
		$this->db->where(array('tbl_banner_content.banner_id'=>$id,'tbl_banner_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Banner($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_BANNER,$data);
		//$this->db->insert(TBL_BANNER,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function check_content($id,$lang){
		$query_content = $this->db->get_where('tbl_banner_content', array('banner_id' => $id,'language_code'=>$lang));
		$count = $query_content->num_rows(); //counting result from query
		return $count;
	}
	
	public function Delete_Banner($id)
	{	
		$query = "DELETE `tbl_banner`, `tbl_banner_content` FROM `tbl_banner` INNER JOIN `tbl_banner_content` WHERE `tbl_banner`.id= `tbl_banner_content`.banner_id and `tbl_banner`.id = '$id'";
		$result = $this->db->query($query);
		return true;
	}
}