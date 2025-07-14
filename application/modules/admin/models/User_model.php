<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends CI_Model

{

	public function Show_UserRole()

	{

		$result = $this->db->get(TBL_ROLE);

		return $result->result();

	}

	

	public function Insert_UserRole($data)

	{

		$this->db->insert(TBL_ROLE,$data);

        //return $this->db->insert_id();

		return true;

	}

	

	public function Update_UserRole($id,$data)

	{

		$this->db->where('id',$id);

		$this->db->update(TBL_ROLE,$data);

        //return $this->db->insert_id();

		return true;

	}

	

	public function Get_UserRole($id)

	{

		$result = $this->db->get_where(TBL_ROLE,array('id'=>$id))->result_array();

		return $result;

	}

	

	

	

	public function Delete_UserRole($id)

	{

		$this->db->where('id', $id);

		$this->db->delete(TBL_ROLE);

		return true;

	}

	

	public function Insert_UserData($data)

	{

		$this->db->insert(TBL_USER,$data);

        return $this->db->insert_id();

		//return true;

	}

	

	public function Insert_UserGroup($data)

	{

		$this->db->insert(TBL_USERGROUP,$data);

        //return $this->db->insert_id();

		return true;

	}

	

	// Get User data

	public function getUserData()

	{

		$query = "SELECT USER.*, USERGROUP.group_id  FROM `users` AS USER JOIN `users_groups` AS USERGROUP ON USER.id = USERGROUP.user_id GROUP BY USER.id";

		$result = $this->db->query($query);

		

		return $result->result();

	}

	

	// Get User data By ID

	public function getUserDataByID($id)

	{

		$query = "SELECT * FROM `users` WHERE `id`=$id";

		$result = $this->db->query($query);

		

		return $result->result_array();

	}

	

	public function get_data($table){

	 

		$result = $this->db->get($table);

		$this->db->order_by("id", "asc");

		return $result->result();

	}

	public function Update_data($id,$table,$data)

	{

		$this->db->where('id',$id);

		$this->db->update($table , $data);

        //return $this->db->insert_id();

		return true;

	}

	

	public function get_country_list()

	{

		$this->db->select('*');

		$this->db->from('countries');

		$result = $this->db->get();



		$temp_arr = array();

		if($result->num_rows()>0){

			foreach($result->result_array() as $row){

				$temp_arr[$row['id']] = $row['name'];   

			}	

		}        	



		return $temp_arr;

	}



	//State List 

	public function get_state_list($country_id)

	{

		$this->db->select('*');

		$this->db->from('states');

		$this->db->where('country_id', $country_id);

		$result = $this->db->get();



		$temp_arr = array();

		if($result->num_rows()>0){

			foreach($result->result_array() as $row){

				$temp_arr[$row['id']] = $row['name'];   

			}	

		}        



		return $temp_arr;	

	}

	

	//City List 

	public function get_city_list($state_id)

	{

		$this->db->select('*');

		$this->db->from('cities');

		$this->db->where('state_id', $state_id);

		$result = $this->db->get();



		$temp_arr = array();

		if($result->num_rows()>0){

			foreach($result->result_array() as $row){

				$temp_arr[$row['id']] = $row['name'];   

			}	

		}        		

		return $temp_arr;

	}



	public function get_leads_details($user_id)

	{

		$this->db->select('users.first_name, users.last_name, users.email, users.phone, tl.*, cities.name as city_name, states.name as state_name');

		$this->db->from('tbl_leads tl');

		$this->db->join('users', 'users.id = tl.user_id');

		$this->db->join('cities', 'cities.id = tl.city_id');

		$this->db->join('states', 'states.id = tl.state_id');

		$this->db->where("users.id", $user_id);

		

		$result = $this->db->get();

		//echo $this->db->last_query();exit;

		return $result->result_array();

	}



	public function get_leads_details_per_page($user_id,$limit_per_page,$start_index)

	{

		$this->db->select('users.first_name, users.last_name, users.email, users.phone, tl.*, cities.name as city_name, states.name as state_name');

		$this->db->from('tbl_leads tl');

		$this->db->join('users', 'users.id = tl.user_id');

		$this->db->join('cities', 'cities.id = tl.city_id');

		$this->db->join('states', 'states.id = tl.state_id');

		$this->db->where("users.id", $user_id);

		$this->db->limit($limit_per_page, $start_index);

		

		$result = $this->db->get();

		//echo $this->db->last_query();exit;

		return $result->result_array();

	}



	public function get_leads($id)

	{

		$this->db->select('users.first_name, users.last_name, users.email, users.phone, tl.*');

		$this->db->from('tbl_leads tl');

		$this->db->join('users', 'users.id = tl.user_id');

		$this->db->where("tl.id", $id);

		

		$result = $this->db->get();

		//echo $this->db->last_query();exit;

		return $result->row_array();

	}

	public function getCount($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        return $query->num_rows();
    } 

	

}