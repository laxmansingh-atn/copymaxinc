<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('activity_model');
		//$this->load->model('page_model');
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
		$result = $this->activity_model->Show_Activity(get_current_language());
		//print_r($result);
		$data['result'] = $result;
		$data['page_title'] = "Activity Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "activity";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/Activity');
    }
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('activity_name', 'Activity Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('activity_status', 'Activity Status', 'trim|required');
			
			//echo $_FILES['brand_image']['name']; exit;
			//$config['max_width'] = 925;
            //$config['max_height'] = 465;
			$config['upload_path'] = './uploads/activity/';
			$upload_root_path = 'uploads/activity/';
			//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
			$config['max_size'] = '200000';
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('activity_image'))
			{
				$error = array('error' => $this->upload->display_errors());
            	$data['error'] = $error;
				//array('error' => $this->upload->display_errors()); 
				$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
			}	
			else
			{
				$data['error'] = "success";
				$upload = array('upload_data' => $this->upload->data()); 
				//echo $data['upload_data']['file_name'];
				//$this->load->view('upload_success', $data); 
				
				//print_r($data);
				$insert_data = array(		
					'activity_image'	=>	$upload_root_path.$upload['upload_data']['file_name'],
					'status'			=> 	$this->input->post('activity_status'),
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$activity_id = $this->activity_model->Insert_Activity($insert_data);
				
				$lang_abbr = $this->config->item("lang_uri_abbr");
				$activity_data = array();
				foreach($lang_abbr as $key=>$a_lang){
					if($key != $this->input->post('language_code')){
						$activity_data[] = array(
							'activity_id'		=>	$activity_id,
							'language_code'		=>	$key,
							'activity_title'		=>	'',
							'activity_content'	=>	'',
							'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
					}
					else{
						$activity_data[] = array(
							'activity_id'		=>	$activity_id,
							'language_code'		=>	$this->input->post('language_code'),
							'activity_title'	=>	$this->input->post('activity_name'),
							'activity_content'	=>	$this->input->post('activity_text'),
							'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
					}
				}
				$this->activity_model->Insert_Activity_Content($activity_data);
				
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			} 
		}
		$data['page_title'] = "Activity";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "activity";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edit()
	{
		$uploadchk = false;
		//$total_segments = $this->uri->total_segments();
		//$record_num = end($this->uri->segment_array());
		$id = end($this->uri->segments);
		//$id = $this->uri->segment($total_segments);
		//$id = $record_num;
		//echo $record_num; exit();
		$result = $this->activity_model->Get_Activity($id,get_current_language());
		//$category = $this->page_model->Show_Page();
		//$data['activity_category'] = $category;
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('activity_name', 'Activity Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('activity_status', 'Activity Status', 'trim|required');
			
			if($_FILES['activity_image']['name']!="")
            {
				//$config['max_width'] = 925;
            	//$config['max_height'] = 465;
				$config['upload_path'] = './uploads/activity/';
				$upload_root_path = 'uploads/activity/';
				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
				$config['max_size'] = '20000';
				$this->upload->initialize($config);
				if( !$this->upload->do_upload('activity_image'))
				{
					$data['error'] = "error";
					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
				}
				else
				{
					$data['error'] = "success";
					$upload = array('upload_data' => $this->upload->data()); 
					//$view_data = $this->upload->data();
					$activity_pic = $upload_root_path.$upload['upload_data']['file_name'];
					
					$update_data = array(		
					'activity_image'	=>	$activity_pic,
					'status'			=> 	$this->input->post('activity_status'),
					'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$result = $this->activity_model->Update_Activity($id,$update_data);
					
					$count = $this->activity_model->check_content($id,$this->input->post('language_code'));
				
					if($count === 0)
					{
						$activity_data = array(
							'activity_id'			=>	$id,
							'language_code'		=>	$this->input->post('language_code'),
							'activity_title'	=>	$this->input->post('activity_name'),
							'activity_content'	=>	$this->input->post('activity_text'),
							'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
						$this->activity_model->Insert_Activity_Content($activity_data);
					}
					else
					{
						$activity_data = array(
							//'activity_id'			=>	$id,
							//'language_code'		=>	$this->input->post('language_code'),
							'activity_title'	=>	$this->input->post('activity_name'),
							'activity_content'	=>	$this->input->post('activity_text'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
						$this->activity_model->Update_Activity_Content($id,$this->input->post('language_code'),$activity_data);
					}
					
					
					if($result == true)
					{
						$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
					}
				}
			}
			else
			{
				$update_data = array(
				'status'			=> 	$this->input->post('activity_status'),
				'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$result = $this->activity_model->Update_Activity($id,$update_data);
				
				$count = $this->activity_model->check_content($id,$this->input->post('language_code'));
				
				if($count === 0)
				{
					$activity_data = array(
						'activity_id'			=>	$id,
						'language_code'		=>	$this->input->post('language_code'),
						'activity_content'	=>	$this->input->post('activity_text'),
						'created_at'		=>	date('Y-m-d H:i:s'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$this->activity_model->Insert_Activity_Content($activity_data);
				}
				else
				{
					$activity_data = array(
						//'activity_id'			=>	$id,
						'activity_title'	=>	$this->input->post('activity_name'),
						'activity_content'	=>	$this->input->post('activity_text'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$this->activity_model->Update_Activity_Content($id,$this->input->post('language_code'),$activity_data);
				}
				
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			}
			redirect(base_url().'admin/activity/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Activity";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "activity";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function delete()
	{
		//$id = $this->uri->segment(4);
		$id = end($this->uri->segments);
		//echo $id; exit;
		$result = $this->activity_model->Delete_Activity($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/activity/');
	}
	
	public function get_activity_content($id,$lang){
		//$id = end($this->uri->segments);
		//$lang = $this->input->post('language_code');
		if($id != 0)
		{
		$result = $this->activity_model->Get_Activity_Content($id,$lang);
		//echo $id."  ".$lang; exit();
		echo json_encode($result);
		}
	}
}
?>