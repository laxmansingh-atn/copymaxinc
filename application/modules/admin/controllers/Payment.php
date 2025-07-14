<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller {

    function __construct()
	{
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('payment_model');
		if(!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
		else{

			$user = $this->ion_auth->user()->row();
        	if(!$this->ion_auth->is_admin($user->id)){
				redirect(base_url('auth/logout'));
			}
		}
		$this->_container = $this->config->item('bootsshop_template_dir_admin') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        //log_message('debug', 'CI My Admin : Auth class loaded');
    }

    public function index()
	{
		/*$result = $this->user_model->Show_UserRole();
		$data['result'] = $result;
		$data['page_title'] = "Users";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "users";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);*/
		//redirect('admin/brands');
    }
	
	public function type()
	{
		$result = $this->payment_model->Show_Type(get_current_language());
		$data['result'] = $result;
		$data['page_title'] = "Payment";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/brands');
    }
	
	public function addtype()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
			//$this->form_validation->set_rules('role_description', 'Role Description', 'trim|required');
			
			//print_r($data);
			if ($this->form_validation->run() != FALSE)
			{
				$insert_data = array(
					'type_order'	=>	$this->input->post('payment_type_order'),	
					'created_at'	=>	date('Y-m-d H:i:s'),
					'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$type_id = $this->payment_model->Insert_Type($insert_data);
				$lang_abbr = $this->config->item("lang_uri_abbr");
				$page_data = array();
				foreach($lang_abbr as $key=>$a_lang){
					if($key != $this->input->post('language_code')){	
						$type_data[] = array(
							'type_id'		=>	$type_id,
							'language_code'	=>	$key,
							'content'	=>	'',
							'created_at'	=>	date('Y-m-d H:i:s'),
							'updated_at'	=>	date('Y-m-d H:i:s')
						);
					}
					else{
						$type_data[] = array(
							'type_id'			=>	$type_id,
							'language_code'		=>	$this->input->post('language_code'),
							'content'			=>	$this->input->post('payment_type'),
							'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
					}
				}
				$this->payment_model->Insert_Type_Content($type_data);
				$data['error'] = "success";
				$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			}			
		}
		$data['page_title'] = "Payment Type";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edittype()
	{
		$id = end($this->uri->segments);
		$result = $this->payment_model->Get_Type($id,get_current_language());
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
			
			$update_data = array(
				'type_order'	=>	$this->input->post('payment_type_order'),
				'updated_at'	=>	date('Y-m-d H:i:s')
			);
			$result = $this->payment_model->Update_Type($id,$update_data);
			
			$update_type = array(
				'type_id'		=>	$id,
				'language_code'		=>	$this->input->post('language_code'),
				'content'		=>	$this->input->post('payment_type'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
			$this->payment_model->Update_Type_Content($id,$this->input->post('language_code'),$update_type);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}
			
			redirect(base_url().'admin/payment/type');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Payment Type";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function deletetype()
	{
		$id = end($this->uri->segments);
		$result = $this->payment_model->Delete_Type($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/payment/type');
	}
	
	public function get_type_content($id,$lang){
		//$id = end($this->uri->segments);
		//$lang = $this->input->post('language_code');
		if($id != 0)
		{
		$result = $this->payment_model->Get_Type_Content($id,$lang);
		//echo "<pre>"; print_r($result);echo "</pre>";
		//echo $id."  ".$lang; exit();
		echo json_encode($result);
		}
	}
	
	public function details()
	{
		$result = $this->payment_model->Show_Details(get_current_language());
		$data['result'] = $result;
		$data['page_title'] = "Payment Details";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function adddetails()
	{
		$result = $this->payment_model->Show_Type(get_current_language());
		$data['type'] = $result;
		
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
			$this->form_validation->set_rules('payment_description', 'Payment Description', 'trim|required');
			$this->form_validation->set_rules('enrollment_fees', 'Enrollment Fees', 'trim|required');
			$this->form_validation->set_rules('admission_fees', 'Admission Fees', 'trim|required');
			
			if ($this->form_validation->run() != FALSE)
			{		
				$insert_data = array(
					'type_id'			=>	$this->input->post('payment_type'),
					'enrollment_fees'	=>	$this->input->post('enrollment_fees'),
					'admission_fees'	=>	$this->input->post('admission_fees'),
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$detail_id = $this->payment_model->Insert_Details($insert_data);
				$lang_abbr = $this->config->item("lang_uri_abbr");
				
				foreach($lang_abbr as $key=>$a_lang){
					if($key != $this->input->post('language_code')){	
						$detail_data[] = array(
							'details_id'	=>	$detail_id,
							'language_code'	=>	$key,
							'content'		=>	'',
							'created_at'	=>	date('Y-m-d H:i:s'),
							'updated_at'	=>	date('Y-m-d H:i:s')
						);
					}
					else{
						$detail_data[] = array(
							'details_id'		=>	$detail_id,
							'language_code'		=>	$this->input->post('language_code'),
							'content'			=>	$this->input->post('payment_description'),
							'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
					}
				}
				$this->payment_model->Insert_Details_Content($detail_data);
				$data['error'] = "success";
				$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');	
					
				//$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				//echo $this->db->last_query();
			}
		}
		
		$data['page_title'] = "Payment Details";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function editdetails()
	{
		$id = end($this->uri->segments);
		$result = $this->payment_model->Show_Type(get_current_language());
		$data['type'] = $result;
		$details_result = $this->payment_model->Get_Detail($id,get_current_language());
		$data['result'] = $details_result;
		
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
			$this->form_validation->set_rules('payment_description', 'Payment Description', 'trim|required');
			$this->form_validation->set_rules('enrollment_fees', 'Enrollment Fees', 'trim|required');
			$this->form_validation->set_rules('admission_fees', 'Admission Fees', 'trim|required');
			
			if ($this->form_validation->run() != FALSE)
			{
				$update_details_data = array(
					'type_id'			=>	$this->input->post('payment_type'),
					'enrollment_fees'	=>	$this->input->post('enrollment_fees'),
					'admission_fees'	=>	$this->input->post('admission_fees'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				
				$result_details = $this->payment_model->Update_Detail($id,$update_details_data);
				
				$update_detail_content = array(
					'details_id'		=>	$id,
					'content'			=>	$this->input->post('payment_description'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$this->payment_model->Update_Detail_Content($id,$this->input->post('language_code'),$update_detail_content);
				if($result_details == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			
				redirect(base_url().'admin/payment/details');
				
				
			}
		}
		$data['page_title'] = "Edit Payment Details";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//$result = $this->user_model->Get_UserRole($id);
	}
	
	public function deletedetails()
	{
		$id = end($this->uri->segments);
		$result = $this->payment_model->Delete_Detail($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/payment/details');
	}
	
	public function get_detail_content($id,$lang){
		//$id = end($this->uri->segments);
		//$lang = $this->input->post('language_code');
		if($id != 0)
		{
		$result = $this->payment_model->Get_Detail_Content($id,$lang);
		//echo "<pre>"; print_r($result);echo "</pre>";
		//echo $id."  ".$lang; exit();
		echo json_encode($result);
		}
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