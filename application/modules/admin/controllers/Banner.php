<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('banner_model');
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
		$result = $this->banner_model->Show_Banner(get_current_language());
		//print_r($result);
		$data['result'] = $result;
		$data['page_title'] = "Banner Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "banner";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/Banner');
    }
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('banner_status', 'Banner Status', 'trim|required');
			$data['error'] = "success";
			
			$insert_data = array(		
				'banner_name'		=>	$this->input->post('banner_name'),
				'banner_category'	=>	$this->input->post('banner_category'),
				'banner_image'		=>	$this->input->post('banner_image'),
				'banner_text'		=>	$this->input->post('banner_text'),
				'banner_order'		=> 	$this->input->post('banner_order'),
				'status'			=> 	$this->input->post('banner_status'),
				'created_at'		=>	date('Y-m-d H:i:s'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
			$banner_id = $this->banner_model->Insert_Banner($insert_data);
				
			$lang_abbr = $this->config->item("lang_uri_abbr");
			$banner_data = array();
			foreach($lang_abbr as $key=>$a_lang){
				if($key != $this->input->post('language_code')){	
					//echo $key."<br />";
					$banner_data[] = array(
						'banner_id'			=>	$banner_id,
						'language_code'		=>	$key,
						'banner_content'	=>	'',
						'created_at'		=>	date('Y-m-d H:i:s'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
				}
				else{
					$banner_data[] = array(
						'banner_id'			=>	$banner_id,
						'language_code'		=>	$this->input->post('language_code'),
						'banner_content'	=>	$this->input->post('banner_text'),
						'created_at'		=>	date('Y-m-d H:i:s'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
				}
			}
				
			$this->banner_model->Insert_Banner_Content($banner_data);
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
		}
		
		$category = $this->page_model->Show_Page(get_current_language());
		
		$data['banner_category'] = $category;
		$data['page_title'] = "Banner";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "banner";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	/*public function showall()
	{
		$result = $this->banner_model->Show_Banner();
		$data['result'] = $result;
		$data['page_title'] = "Banner";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "banner";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}*/
	
	public function edit()
	{
		$id = end($this->uri->segments);
		$result = $this->banner_model->Get_Banner($id,get_current_language());
		$category = $this->page_model->Show_Page(get_current_language());
		$data['banner_category'] = $category;
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('banner_status', 'Banner Status', 'trim|required');
			$update_data = array(		
				'banner_name'		=>	$this->input->post('banner_name'),
				'banner_category'	=>	$this->input->post('banner_category'),
				'banner_image'		=>	$this->input->post('banner_image'),
				'banner_order'		=> 	$this->input->post('banner_order'),
				'status'			=> 	$this->input->post('banner_status'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
			//print_r($update_data); exit();

			$result = $this->banner_model->Update_Banner($id,$update_data);

			$banner_data = array(
				'banner_id'			=>	$id,
				'banner_content'	=>	$this->input->post('banner_text'),
				//'created_at'		=>	date('Y-m-d H:i:s'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
				
			$this->banner_model->Update_Banner_Content($id,$this->input->post('language_code'),$banner_data);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}
			redirect(base_url().'admin/banner/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Banner";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "banner";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function delete()
	{
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
	
	public function get_banner_content($id,$lang){
		//$id = end($this->uri->segments);
		//$lang = $this->input->post('language_code');
		if($id != 0)
		{
		$result = $this->banner_model->Get_Banner_Content($id,$lang);
		//echo $id."  ".$lang; exit();
		echo json_encode($result);
		}
	}
}
?>