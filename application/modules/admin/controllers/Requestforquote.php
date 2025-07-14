<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Requestforquote extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		//$this->load->model('banner_model');
		$this->load->model('request_model');
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
		$result = $this->request_model->Show_Request_Quote();
		$data['result'] = $result;
		$data['page_title'] = "Request Quote Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "requestforquote";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/Banner');
    }
	
	public function edit()
	{
		$id = $this->uri->segment(4);
		$result = $this->request_model->Get_Request_Quote($id);
		
		if(isset($_POST['edit']))
		{
			//echo $result[0]['email']; exit;
			///////////////////////  email send //////////////////////////////
                
			$this->email->set_mailtype("html");			
			$this->email->from('ventas1@repuestosmundiales.com', 'TradeWorld');
			$this->email->to($result[0]['email']); 
			$this->email->bcc('arghya.saha@met-technologies.com'); 
			//$this->email->bcc('them@their-example.com'); 
			
			$this->email->subject('Request For Quote');
			
			$message = " Dear ".$result[0]['name'].",<br><br>
			".$this->input->post('request_quote')."<br>
			Thank you<br><br>";			
			
			$this->email->message($message);	
			
			$this->email->send();

			///////////////////////  email send end //////////////////////////////
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Mail has been sent successfully.');
			//redirect(current_url());
		}
		
		$data['result'] = $result;
		$data['page_title'] = "Request Quote Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "requestforquote";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	/*public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('banner_status', 'Banner Status', 'trim|required');
			
			//echo $_FILES['brand_image']['name']; exit;
			$config['max_width'] = 925;
            $config['max_height'] = 465;
			$config['upload_path'] = './uploads/banner/';
			$upload_root_path = 'uploads/banner/';
			//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
			$config['max_size'] = '200000';
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('banner_image'))
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
					'banner_name'		=>	$this->input->post('banner_name'),
					'banner_category'	=>	$this->input->post('banner_category'),
					'banner_image'		=>	$upload_root_path.$upload['upload_data']['file_name'],
					'banner_text'		=>	$this->input->post('banner_text'),
					'banner_order'		=> 	$this->input->post('banner_order'),
					'status'			=> 	$this->input->post('banner_status'),
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$this->banner_model->Insert_Banner($insert_data);
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			} 
		}
		
		$category = $this->page_model->Show_Page();
		
		$data['banner_category'] = $category;
		$data['page_title'] = "Banner";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "banner";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edit()
	{
		$uploadchk = false;
		$id = $this->uri->segment(4);
		$result = $this->banner_model->Get_Banner($id);
		$category = $this->page_model->Show_Page();
		$data['banner_category'] = $category;
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('banner_status', 'Banner Status', 'trim|required');
			
			if($_FILES['banner_image']['name']!="")
            {
				$config['max_width'] = 925;
            	$config['max_height'] = 465;
				$config['upload_path'] = './uploads/banner/';
				$upload_root_path = 'uploads/banner/';
				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
				$config['max_size'] = '10000';
				$this->upload->initialize($config);
				if( !$this->upload->do_upload('banner_image'))
				{
					$data['error'] = "error";
					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
				}
				else
				{
					$data['error'] = "success";
					$upload = array('upload_data' => $this->upload->data()); 
					//$view_data = $this->upload->data();
					$banner_pic = $upload_root_path.$upload['upload_data']['file_name'];
					
					$update_data = array(		
					'banner_name'		=>	$this->input->post('banner_name'),
					'banner_category'	=>	$this->input->post('banner_category'),
					'banner_image'		=>	$banner_pic,
					'banner_text'		=>	$this->input->post('banner_text'),
					'banner_order'		=> 	$this->input->post('banner_order'),
					'status'			=> 	$this->input->post('banner_status'),
					'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$result = $this->banner_model->Update_Banner($id,$update_data);
					if($result == true)
					{
						$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
					}
				}
			}
			else
			{
				$update_data = array(		
				'banner_name'		=>	$this->input->post('banner_name'),
				'banner_category'	=>	$this->input->post('banner_category'),
				'status'			=> 	$this->input->post('banner_status'),
				'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$result = $this->banner_model->Update_Banner($id,$update_data);
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			}
			redirect(base_url().'admin/Banner/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Banner";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "Banner";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function delete()
	{
		//$id = $this->uri->segment(4);
		$id = end($this->uri->segments);
		//echo $id; exit;
		$result = $this->banner_model->Delete_Banner($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/Banner/');
	}*/
}
?>