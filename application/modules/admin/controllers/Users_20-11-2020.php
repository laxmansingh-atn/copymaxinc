<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

    function __construct()
	{
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('user_model');
		if(!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
		$this->_container = $this->config->item('bootsshop_template_dir_admin') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        //log_message('debug', 'CI My Admin : Auth class loaded');
    }

    public function index()
	{
		$result = $this->user_model->Show_UserRole();
		$data['result'] = $result;
		$data['page_title'] = "Users";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/brands');
    }
	
	public function role()
	{
		$result = $this->user_model->Show_UserRole();
		$data['result'] = $result;
		
		$data['page_title'] = "Users";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/brands');
    }
	
	public function addrole()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
			//$this->form_validation->set_rules('role_description', 'Role Description', 'trim|required');
			
			//print_r($data);
			if ($this->form_validation->run() != FALSE)
			{
				$insert_data = array(		
					'name'	=>	$this->input->post('role_name'),
					'description'	=>	$this->input->post('role_description')
				);
				$result = $this->user_model->Insert_UserRole($insert_data);
				if($result == true)
				{
					$data['error'] = "success";
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				}
			}			
		}
		$data['page_title'] = "Users";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function editrole()
	{
		$id = end($this->uri->segments);
		$result = $this->user_model->Get_UserRole($id);
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
			
			$update_data = array(		
			'name'	=>	$this->input->post('role_name'),
			'description'	=>	$this->input->post('role_description')
			
			);
			$result = $this->user_model->Update_UserRole($id,$update_data);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}
			
			redirect(base_url().'admin/users/role');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Users";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function deleterole()
	{
		$id = end($this->uri->segments);
		$result = $this->user_model->Delete_UserRole($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/users/role');
	}
	
	public function userlist()
	{
		$result = $this->user_model->getUserData();
		$data['result'] = $result;
		
		$data['page_title'] = "Users";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function adduser()
	{
		$result = $this->user_model->Show_UserRole();
		$data['roleresult'] = $result;
		
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
			$this->form_validation->set_rules('company_name', 'Password', 'trim|required');
			$this->form_validation->set_rules('user_role', 'User Role', 'trim|required');
			$this->form_validation->set_rules('user_status', 'User Status', 'trim|required');
			
			if ($this->form_validation->run() != FALSE)
			{
				$time = time();
				//$username = $this->input->post('user_name');
				//echo $username; exit;
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$additional_data = array(
									'ip_address'	=> 	$this->get_client_ip_env(),
									'first_name'	=> 	$this->input->post('first_name'),
									'last_name'		=> 	$this->input->post('last_name'),
									'phone'			=>	$this->input->post('phone_number'),
									'company'		=>	$this->input->post('company_name'),
									'active'		=>	$this->input->post('user_status'),
									'created_on' 	=> 	$time
									);
				$group = array($this->input->post('user_role')); // Sets user to admin.
				
				if($this->ion_auth->register('', $password, $email, $additional_data, $group))
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				}
				else
				{
					$this -> session -> set_flashdata('update_message','<strong>Something wrong!!!</strong>.');
				}
				//echo $this->db->last_query();
			}
		}
		
		$data['page_title'] = "Users";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edituser()
	{
		$roleresult = $this->user_model->Show_UserRole();
		$data['role'] = $roleresult;
		$id = end($this->uri->segments);
		$data['result'] = $this->user_model->getUserDataByID($id);
		//echo $id;
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
			$this->form_validation->set_rules('company_name', 'Password', 'trim|required');
			//$this->form_validation->set_rules('user_role', 'User Role', 'trim|required');
			$this->form_validation->set_rules('user_status', 'User Status', 'trim|required');
			
			if ($this->form_validation->run() != FALSE)
			{
				
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$update_data = array(
									'ip_address'	=> 	$this->get_client_ip_env(),
									'first_name'	=> 	$this->input->post('first_name'),
									'last_name'		=> 	$this->input->post('last_name'),
									'email'			=>	$email,
									'password'		=>	$password,
									'phone'			=>	$this->input->post('phone_number'),
									'company'		=>	$this->input->post('company_name'),
									'active'		=>	$this->input->post('user_status'),
									);
				
				if($this->ion_auth->update($id, $update_data))
				{
					$this -> session -> set_flashdata('update_message','<strong></strong> Record Updated successfully.');
					redirect(base_url().'admin/users/userlist/');
				}
				else
				{
					$this -> session -> set_flashdata('update_message','<strong>Something wrong!!!</strong>.');
				}
				//echo $this->db->last_query();
			}
		}
		$data['page_title'] = "Edit User";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//$result = $this->user_model->Get_UserRole($id);
	}
	
	// Function to get the client ip address
	public function get_client_ip_env()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
	
	// Function to get the client ip address
	public function get_client_ip_server()
	{
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
}
?>