<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model
{
	public function Show_Images()
	{
		$result = $this->db->get('tbl_gallery');
		
		/*$this->db->select('tbl_news.*,tbl_news_content.news_title,tbl_news_content.news_content');
		$this->db->from('tbl_news');
		$this->db->join('tbl_news_content', 'tbl_news.id = tbl_news_content.news_id','left');
		$this->db->where(array('tbl_news_content.language_code' => $lang));
		$result = $this->db->get();*/
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function Insert_Gallery($data)
	{
		$this->db->insert('tbl_gallery',$data);
        //$banner_id = $this->db->insert_id();
		return $this->db->insert_id();
		return true;
	}
	
	
	public function Insert_Product_Image($data, $flag='update', $product_id=''){
		if($flag == "add"){

			//$this->db->insert_batch('tbl_product_image',$data);
			$this->db->insert('tbl_product_image',$data);
			$id = $this->db->insert_id();
			return $id;
		
		}else if($flag == "update"){				

			$this->db->where('product_id', $product_id);			
			$query = $this->db->update('tbl_product_image', array('product_image'=>$data['product_image']));				
			return true;
		}
	}
	
	public function Update_Product_Image($data){
		$this->db->update_batch('tbl_product_image',$data, 'id');
		return true;
	}
	
	public function Get_Product_Attribute_Images($p_id,$d_id)
	{
		$result = $this->db->get_where('tbl_product_image',array('product_id'=>$p_id));
		return $result->result_array();
	}
	
	public function Get_Product_Image($id){
		$result = $this->db->get_where('tbl_product_image',array('product_id'=>$id))->result_array();
		//$this -> db -> where('id', $id);
		//$this -> db -> delete('tbl_product_image');
		return $result;
	}
	
	public function Delete_Product_Image($id){
		$this -> db -> where('product_id', $id);
		$this -> db -> delete('tbl_product_image');
		return true;
	}
	
	
	//////////////////////////////////////////////////////////////////////////////
	
	public function Get_Image($id)
	{
		//$result = $this->db->get_where(TBL_BANNER,array('id'=>$id))->result_array();
		$this->db->select('*');
		$this->db->from('tbl_gallery');
		$this->db->where(array('tbl_gallery.id'=>$id));
		 
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Update_Gallery($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_gallery',$data);
		//$this->db->insert(TBL_BANNER,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	
	public function Delete_Image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_gallery');
		return true;
	}
}