<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Networks extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('network_model');
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
	
		$result = $this->network_model->Show_Brands(get_current_language());
		$data['result'] = $result;
		
		$data['page_title'] = "Networks";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "networks";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/brands');
    }
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('brand_status', 'Brand Status', 'trim|required');
			
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			$insert_data = array(		
				'brand_name'	=>	$this->input->post('brand_name'),
				'product_id'	=>	'',
				'brand_image'	=>	$this->input->post('brand_image'),
				'status'		=> 	$this->input->post('brand_status'),
				//'value'			=> 	$this->input->post('brand_title'),
				'value'			=> 	'',
				//'description'   =>  $description ,
				'description'   =>  '' ,
				'created_at'	=>	date('Y-m-d H:i:s'),
				'updated_at'	=>	date('Y-m-d H:i:s')
			);
			$brand_id = $this->network_model->Insert_Brands($insert_data);
			
			//echo "<pre>"; print_r($brand_data);echo "</pre>"; exit();
		
			if($brand_id == true)
			{
				$data['error'] = "success";
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			}
		}
		$data['page_title'] = "Networks";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "networks";
		$data['module'] = 'admin';
		//$data['productlist'] = $this->network_model->Show_allProducts(get_current_language());
		$this->load->view($this->_container, $data);
	}
	
	public function showall()
	{
		
		//echo get_current_language(); exit();
		$result = $this->network_model->Show_Brands(get_current_language());
		$data['result'] = $result;
		$data['page_title'] = "Networks";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "networks";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edit()
	{
		$id = end($this->uri->segments);
		$result = $this->network_model->Get_Brand($id,get_current_language());
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('banner_status', 'Banner Status', 'trim|required');
			
			$update_data = array(		
				'brand_name'		=>	$this->input->post('brand_name'),
			  //'product_id'	=>	$this->input->post('product_id'),
				'product_id'	=>	'',
				'brand_image'		=>	$this->input->post('brand_image'),
				'status'			=> 	$this->input->post('brand_status'),
				//'value'			    => 	$this->input->post('brand_title'),
				'value'			    => 	'',
				// 'description'       =>  $description ,
				'description'   =>  '' ,
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
			$result = $this->network_model->Update_Brands($id,$update_data);
			/* $brand_data = array(
				'brand_id'			=>	$id,
				'brand_content'	=>	$this->input->post('brand_title'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			); */
				
			//$this->network_model->Update_Brand_Content($id,$this->input->post('language_code'),$brand_data);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}
			redirect(base_url().'admin/networks/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Networks";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "networks";
			$data['module'] = 'admin';
			$data['productlist'] = $this->network_model->Show_allProducts(get_current_language());
			$this->load->view($this->_container, $data);
		}
		
		
		
	}
	
	public function delete()
	{
		//$id = $this->uri->segment(4);
		$id = end($this->uri->segments);
		//echo $id; exit;
		$result = $this->network_model->Delete_Brands($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/networks/showall');
	}
	
	public function get_brand_content($id,$lang){
		if($id != 0)
		{
			$result = $this->network_model->Get_Brand_Content($id,$lang);
			echo json_encode($result);
		}
	}
}
?>