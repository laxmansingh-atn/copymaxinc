<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('news_model');
		$this->load->model('page_model');
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
		$result = $this->news_model->Show_News(get_current_language());
		//print_r($result);
		$data['result'] = $result;
		$data['page_title'] = "News Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "news";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/Banner');
    }
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('news_name', 'News Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('news_status', 'News Status', 'trim|required');
			
			//$config['max_width'] = 925;
            //$config['max_height'] = 465;
			$config['upload_path'] = './uploads/news/';
			$upload_root_path = 'uploads/news/';
			//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
			$config['max_size'] = '200000';
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('news_image'))
			{
				$error = array('error' => $this->upload->display_errors());
            	$data['error'] = $error;
				
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
					'news_image'		=>	$upload_root_path.$upload['upload_data']['file_name'],
					'status'			=> 	$this->input->post('news_status'),
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$news_id = $this->news_model->Insert_News($insert_data);
				
				$news_data = array(
					'news_id'			=>	$news_id,
					'language_code'		=>	$this->input->post('language_code'),
					'news_title'		=>	$this->input->post('news_name'),
					'news_content'		=>	$this->input->post('news_text'),
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				
				$this->news_model->Insert_News_Content($news_data);
				
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			} 
		}
		
		//$category = $this->page_model->Show_Page();
		
		//$data['banner_category'] = $category;
		$data['page_title'] = "News";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "news";
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
		$result = $this->news_model->Get_News($id,get_current_language());
		//$category = $this->page_model->Show_Page();
		//$data['banner_category'] = $category;
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('news_name', 'News Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('news_status', 'News Status', 'trim|required');
			
			if($_FILES['news_image']['name']!="")
            {
				//$config['max_width'] = 925;
            	//$config['max_height'] = 465;
				$config['upload_path'] = './uploads/news/';
				$upload_root_path = 'uploads/news/';
				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
				$config['max_size'] = '20000';
				$this->upload->initialize($config);
				if( !$this->upload->do_upload('news_image'))
				{
					$data['error'] = "error";
					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
				}
				else
				{
					$data['error'] = "success";
					$upload = array('upload_data' => $this->upload->data()); 
					//$view_data = $this->upload->data();
					$news_pic = $upload_root_path.$upload['upload_data']['file_name'];
					
					$update_data = array(		
					
					'news_image'		=>	$news_pic,
					'status'			=> 	$this->input->post('news_status'),
					'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$result = $this->news_model->Update_News($id,$update_data);
					
					$count = $this->news_model->check_content($id,$this->input->post('language_code'));
				
					if($count === 0)
					{
						$news_data = array(
							'news_id'			=>	$id,
							'language_code'		=>	$this->input->post('language_code'),
							'news_title'		=>	$this->input->post('news_name'),
							'news_content'		=>	$this->input->post('news_text'),
							'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
						
						$this->news_model->Insert_News_Content($news_data);
					}
					else
					{
						$news_data = array(
							//'news_id'			=>	$news_id,
							//'language_code'		=>	$this->input->post('language_code'),
							'news_title'		=>	$this->input->post('news_name'),
							'news_content'		=>	$this->input->post('news_text'),
							//'created_at'		=>	date('Y-m-d H:i:s'),
							'updated_at'		=>	date('Y-m-d H:i:s')
						);
						
						
						$this->news_model->Update_News_Content($id,$this->input->post('language_code'),$news_data);
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
					//'news_image'		=>	$news_pic,
					'status'			=> 	$this->input->post('news_status'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$result = $this->news_model->Update_News($id,$update_data);
				
				$count = $this->news_model->check_content($id,$this->input->post('language_code'));
				
				if($count === 0)
				{
					$news_data = array(
						'news_id'			=>	$id,
						'language_code'		=>	$this->input->post('language_code'),
						'news_title'		=>	$this->input->post('news_name'),
						'news_content'		=>	$this->input->post('news_text'),
						'created_at'		=>	date('Y-m-d H:i:s'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$this->news_model->Insert_News_Content($news_data);
				}
				else
				{
					$news_data = array(
						'news_title'		=>	$this->input->post('news_name'),
						'news_content'		=>	$this->input->post('news_text'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
					$this->news_model->Update_News_Content($id,$this->input->post('language_code'),$news_data);
				}
				
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			}
			redirect(base_url().'admin/news/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "News";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "news";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	/*public function delete()
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
	}
	*/
	public function get_news_content($id,$lang){
		//$id = end($this->uri->segments);
		//$lang = $this->input->post('language_code');
		if($id != 0)
		{
		$result = $this->news_model->Get_News_Content($id,$lang);
		//echo $id."  ".$lang; exit();
		echo json_encode($result);
		}
	}
}
?>