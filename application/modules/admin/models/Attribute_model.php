<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute_model extends CI_Model
{
	public function Show_Attributes()
	{
		$result = $this->db->get(TBL_ATTRIBUTE);
		return $result->result_array();
	}
	
	public function Show_Attributes_Value()
	{
		$result = $this->db->get('tbl_attribute_value');
		return $result->result_array();
	}
	
	
	
	public function Insert_Attribute($data)
	{
		$this->db->insert(TBL_ATTRIBUTE,$data);
        //return $this->db->insert_id();
		return false;
	}
	
	public function Get_Attribute($id)
	{
		$result = $this->db->get_where(TBL_ATTRIBUTE,array('attribute_id'=>$id))->result_array();
		return $result;
	}
	
	public function Update_Attribute($id,$data)
	{
		$this->db->where('attribute_id',$id);
		$this->db->update(TBL_ATTRIBUTE,$data);
		//$this->db->insert(TBL_BRANDS,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_Attribute($id)
	{
		$this->db->where('attribute_id', $id);
		$this->db->delete(TBL_ATTRIBUTE);
		return true;
	}
	
	
	
	public function Show_AttributesValue()
	{
		//$result = $this->db->get(TBL_ATTRIBUTEVALUE);
		$this->db->from(TBL_ATTRIBUTEVALUE);
		 $this->db->join(TBL_ATTRIBUTE , 'tbl_attribute.attribute_id = tbl_attribute_value.attribute_id');
		 $result = $this->db->get();
		 
		return $result->result_array();
	}
	
	public function Insert_AttributeValue($data)
	{
		$this->db->insert(TBL_ATTRIBUTEVALUE,$data);
        //return $this->db->insert_id();
		return false;
	}
	
	public function Get_AttributeValue($id)
	{
		$result = $this->db->get_where(TBL_ATTRIBUTEVALUE,array('value_id'=>$id))->result_array();
		return $result;
	}
	
	public function Update_AttributeValue($id,$data)
	{
		$this->db->where('value_id',$id);
		$this->db->update(TBL_ATTRIBUTEVALUE,$data);
		//$this->db->insert(TBL_BRANDS,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Delete_AttributeValue($id)
	{
		$this->db->where('value_id', $id);
		$this->db->delete(TBL_ATTRIBUTEVALUE);
		return true;
	}
	
	public function Get_AttributeNameValue($id)
	{
		$result = $this->db->get_where(TBL_ATTRIBUTEVALUE,array('attribute_id'=>$id))->result_array();
		return $result;
	}
}