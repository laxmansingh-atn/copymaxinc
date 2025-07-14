<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
	public function Show_Category($lang)
	{
		//$result = $this->db->get(TBL_CATEGORY);
		$this->db->select('tbl_category.*');
		$this->db->from('tbl_category');
		//$this->db->join('tbl_category_content', 'tbl_category.id = tbl_category_content.category_id','left');
		//$this->db->where(array('tbl_category_content.language_code' => $lang));
		$result = $this->db->get();
		return $result->result();
		
	}
	
	public function Get_Category_List($lang)
	{
		//$result = $this->db->get(TBL_CATEGORY);
		$this->db->select('tbl_category.*');
		$this->db->from('tbl_category');
		//$this->db->join('tbl_category_content', 'tbl_category.id = tbl_category_content.category_id','left');
		//$this->db->where(array('tbl_category_content.language_code' => $lang));
		$result = $this->db->get();
		return $result->result();
	}
	
	public function Insert_Category($data)
	{
		$this->db->insert(TBL_CATEGORY,$data);
        return $this->db->insert_id();
		//return $this->db->insert_id();
		//return false;
	}
	
	public function Insert_Category_Content($data){
		$this->db->insert_batch(TBL_CATEGORY_CONTENT, $data);
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		return true;
	}
	
	public function Get_Category($id,$lang)
	{
		//$result = $this->db->get_where(TBL_CATEGORY,array('id'=>$id))->result_array();
		//return $result;
		$this->db->select('*');
		$this->db->from('tbl_category');
		//$this->db->join('tbl_category_content', 'tbl_category_content.category_id = tbl_category.id');
		// $this->db->where(array('tbl_category_content.category_id'=>$id,'tbl_category_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Get_Category_Content($id,$lang)
	{
		$result = $this->db->get_where(TBL_CATEGORY_CONTENT,array('category_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	
	public function Update_Category($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_CATEGORY,$data);
		//$this->db->insert(TBL_CATEGORY,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Update_Category_Content($id,$lang,$data){
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		$this->db->where(array('category_id'=>$id,'language_code'=>$lang));
		$this->db->update(TBL_CATEGORY_CONTENT,$data);
		return true;
	}
	
	public function Delete_Category($id)
	{	
		$query = "DELETE `tbl_category` FROM `tbl_category`  WHERE  `tbl_category`.id = '$id'";
		$result = $this->db->query($query);
		return true;
	}
}