<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping_model extends CI_Model
{
   
	   public function Show_shipping_price(){
		 $this->db->select('shipping_price.*');
         $this->db->from('shipping_price');
         $result = $this->db->get();		 
		 return $result->result();  
	   }
	   
	   public function Update_Shipping($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('shipping_price',$data);
		//$this->db->insert(TBL_CATEGORY,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	
	
	public function Get_Shipping($id){
		 $this->db->select('shipping_price.*');
         $this->db->from('shipping_price');
		 $this->db->where('id',$id);
		 $result = $this->db->get();		 
		 return $result->result_array();  
	}
	
	public function Delete_Shipping($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('shipping_price');
		return true;
	}
	////////////////////////////////////////  date price /////////////////////////////////////
	
	 public function Show_price_date(){
		 $this->db->select('date_price.*');
         $this->db->from('date_price');
         $result = $this->db->get();		 
		 return $result->result();  
	   }
	   
	   public function Get_price_date($id){
		 $this->db->select('date_price.*');
         $this->db->from('date_price');
		 $this->db->where('id',$id);
		 $result = $this->db->get();		 
		 return $result->result_array();  
	   }
	   
	   public function Delete_price_date($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('date_price');
		return true;
	}
     
}
?>