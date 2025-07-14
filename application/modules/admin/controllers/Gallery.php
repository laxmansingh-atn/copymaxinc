<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('gallery_model');
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
		$data = array() ; 	
		$data['page_title'] = "Gallery Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "gallery";
		$data['module'] = 'admin';
		$data['productlist'] = $this->gallery_model->Show_Images();
		$this->load->view($this->_container, $data);
		//redirect('admin/Banner');
    }
	
	public function add_generalinfo() {
	$this->form_validation->set_rules('gallery_name', 'Product Name', 'trim|required');
		//$this->form_validation->set_rules('product_regular_price', 'Product Regular Price', 'trim|required');		
				
		if ($this->form_validation->run() != FALSE){
			
			 
			$insert_data = array(
			 	'title' =>	$this->input->post('gallery_name'),
				'image' =>  $this->input->post('brand_image'),
				'created_at'		=>	date('Y-m-d H:i:s'),
			    'updated_at'		=>	date('Y-m-d H:i:s')
			);
           	$product_id = $this->gallery_model->Insert_Gallery($insert_data);			
			
		}	
		echo $product_id;
	}
	
	public function add_product_image(){

		$product_id	= $this->input->post('product_id');

		$image_data = array(		
			//'product_type_id'	=>	$this->input->post('product_type'),
			'product_id'		=>	$product_id,
			'product_image'		=>	$this->input->post('image_url')
			);
			
		$id = $this->product_model->Insert_Product_Image($image_data, 'add', $product_id);
		$temp_array = array(
			'id'	=>	$id,
			'product_image'		=>	$this->input->post('image_url'),
			'product_id'		=>	$product_id
		);
		
		$this->session->set_userdata('image_id', $id);
		
		echo json_encode($temp_array);
	}
	
	
	public function edit_product_image()
	{
		$id = $this->input->post('id');
		
		$data = array(
			'product_image'		=>	$this->input->post('image_url')
		);
		
		$result = $this->product_model->Update_Product_Image($id,$data);
		
		if($result)
		{
			$temp_array = array(
				'product_image'		=>	$this->input->post('image_url')
			);
			
			echo json_encode($temp_array);
		}
	}
	
	public function delete_product_image()
	{
		$id = $this->input->post('id');
		
		$result = $this->product_model->Delete_Product_Image($id);
		
		echo $result;
	}
	
	public function get_product_image()
	{
		$id = $this->input->post('id');
		
		$result = $this->product_model->Get_Product_Image($id);
		
		$temp_array = array(
			'product_image'		=>	$result[0]['product_image']
		);
		
		echo json_encode($temp_array);
		
		//echo $result;
	}
	
	
	public function delete_image(){
		$id = $this->input->post('image_id');
		$this->db->delete('tbl_product_image', array('id'=>$id));		
		echo "success";
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////
	
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('gallery_name', 'Title', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			//$config['max_width'] = 925;
            //$config['max_height'] = 465;
			$config['upload_path'] = './uploads/gallery/';
			$upload_root_path = 'uploads/gallery/';
			//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
			$config['max_size'] = '200000';
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('gallery_image'))
			{
				$error = array('error' => $this->upload->display_errors());
            	$data['error'] = $error;
				
				$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
			}	
			else
			{
				$data['error'] = "success";
				$upload = array('upload_data' => $this->upload->data()); 
				$insert_data = array(
					'title'			=>	$this->input->post('gallery_name'),
					'image'		=>	$upload_root_path.$upload['upload_data']['file_name'],
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				
				$res = $this->gallery_model->Insert_Gallery($insert_data);
				if($res == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				}
				
			} 
		}
		
		$data['page_title'] = "Gallery";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "gallery";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edit()
	{
		$uploadchk = false;
		//$total_segments = $this->uri->total_segments();
		//$record_num = end($this->uri->segment_array());
		$id = end($this->uri->segments);
		$result = $this->gallery_model->Get_Image($id);
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('gallery_name', 'Title', 'trim|required');
			
			if($_FILES['gallery_image']['name']!="")
            {
				//$config['max_width'] = 925;
            	//$config['max_height'] = 465;
				$config['upload_path'] = './uploads/gallery/';
				$upload_root_path = 'uploads/gallery/';
				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
				$config['max_size'] = '20000';
				$this->upload->initialize($config);
				if( !$this->upload->do_upload('gallery_image'))
				{
					$data['error'] = "error";
					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
				}
				else
				{
					$data['error'] = "success";
					$upload = array('upload_data' => $this->upload->data()); 
					//$view_data = $this->upload->data();
					$gallery_pic = $upload_root_path.$upload['upload_data']['file_name'];
					
					$update_data = array(		
					'title'			=>	$this->input->post('gallery_name'),
					'image'			=>	$gallery_pic,
					'updated_at'	=>	date('Y-m-d H:i:s')
					);
					$res = $this->gallery_model->Update_Gallery($id,$update_data);
					
										
					if($res == true)
					{
						$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
					}
				}
			}
			else
			{
				$update_data = array(
					'title'			=> 	$this->input->post('gallery_name'),
					'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$res = $this->gallery_model->Update_Gallery($id,$update_data);
				
				if($res == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			}
			redirect(base_url().'admin/gallery/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Gallery";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "gallery";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function delete()
	{
		$id = end($this->uri->segments);
		$result = $this->gallery_model->Delete_Image($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/gallery/');
	}
}
?>