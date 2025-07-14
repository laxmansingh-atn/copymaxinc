<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_model extends CI_Model
{
	public function Show_Brands($lang)
	{
		//$result = $this->db->get(TBL_BRANDS);
		$this->db->select('tbl_brands.*,tbl_brand_content.brand_content');
		$this->db->from('tbl_brands');
		$this->db->join('tbl_brand_content', 'tbl_brands.id = tbl_brand_content.brand_id','left');
		$this->db->where(array('tbl_brand_content.language_code' => $lang));
		
		$result = $this->db->get();
		return $result->result();
	}
	public function Get_Brand_Content($id,$lang)
	{
		$result = $this->db->get_where('tbl_brand_content',array('brand_id'=>$id,'language_code'=>$lang))->result_array();
		return $result;
	}
	public function Insert_Brands($data)
	{
		$this->db->insert(TBL_BRANDS,$data);
        return $this->db->insert_id();
		//return false;
	}
	public function Insert_Brand_Content($data){
		//$this->db->insert('tbl_brand_content',$data);
		$this->db->insert_batch('tbl_brand_content', $data);
		return true;
	}
	public function Get_Brand($id,$lang)
	{
		//$result = $this->db->get_where(TBL_BRANDS,array('id'=>$id))->result_array();
		//return $result;
		$this->db->select('*');
		$this->db->from('tbl_brands');
		$this->db->join('tbl_brand_content', 'tbl_brand_content.brand_id = tbl_brands.id');
		$this->db->where(array('tbl_brand_content.brand_id'=>$id,'tbl_brand_content.language_code' => $lang));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Brands($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update(TBL_BRANDS,$data);
		//$this->db->insert(TBL_BRANDS,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Update_Brand_Content($id,$lang,$data){
		//$this->db->insert(TBL_BANNER_CONTENT,$data);
		$this->db->where(array('brand_id'=>$id,'language_code'=>$lang));
		$this->db->update('tbl_brand_content',$data);
		return true;
	}
	
	public function Delete_Brands($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TBL_BRANDS);
		return true;
	}
}