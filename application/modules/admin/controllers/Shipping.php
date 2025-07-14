<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Shipping extends MY_Controller {



function __construct() {

        parent::__construct();

		$this->load->library(array('ion_auth'));

		$this->load->model('shipping_model');

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

	

		$result = $this->shipping_model->Show_shipping_price();

		$data['result'] = $result;

		

		$data['page_title'] = "Shipping details";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "shipping";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

		//redirect('admin/brands');

    }

	

	public function add(){

		

	    $data['page_title'] = "Shipping details";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "shipping";

		$data['module'] = 'admin';

		if($this->input->post('submit') == 'SUBMIT'){

			

		$insert_data = array(

			'zip_code'=> $this->input->post('zip_code'),

			//'no_days'=> $this->input->post('no_days'),

			'no_days'=> '',

			'price'=> $this->input->post('price'),

			'status'=> $this->input->post('status')

			);

           $data_insert = $this->db->insert('shipping_price',$insert_data);

           if($data_insert== true){

			   $this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

		   }		   

		}

		$this->load->view($this->_container, $data);	

	}

	public function edit(){

		$id = end($this->uri->segments);

		$result = $this->shipping_model->Get_Shipping($id);

		if(isset($_POST['edit']))

		{

			$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required');

		

			

			$update_data = array(		

			'zip_code'=> $this->input->post('zip_code'),

			//'no_days'=> $this->input->post('no_days'),

			'no_days'=> '', 

			'price'=> $this->input->post('price'),

			'status'=> $this->input->post('status')

			);

			$result = $this->shipping_model->Update_Shipping($id,$update_data);

			

			if($result == true)

			{

				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

			}

			redirect(base_url().'admin/shipping/');

		}

		else

		{

			//print_r($result);

			$data['result'] = $result;

			$data['page_title'] = "Shipping";

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "shipping";

			$data['module'] = 'admin';

			$this->load->view($this->_container, $data);

		}

	}

	

	public function delete()

	{

		//$id = $this->uri->segment(4);

		$id = end($this->uri->segments);

		//echo $id; exit;

		$result = $this->shipping_model->Delete_Shipping($id);

		if($result == true)

		{

			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');

			

		}

		else

		{

			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');

		}

		redirect(base_url().'admin/shipping');

	}

	

	public function shipping_no_days(){

		    $result = $this->shipping_model->Show_price_date();

		    $data['result'] = $result;

			$data['page_title'] = "Shipping";

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "date_price";

			$data['module'] = 'admin';

			$this->load->view($this->_container, $data);

		

	}

	

	public function add_price(){

		

			if($this->input->post('submit') == 'SUBMIT'){



			$insert_data = array(

			'no_days'=> $this->input->post('no_days'),

			'price'=> $this->input->post('price'),

			'status'=> $this->input->post('status')

			);

			$data_insert = $this->db->insert('date_price',$insert_data);

			if($data_insert== true){

			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

			}		   

			}

		

			$data['page_title'] = "Shipping";

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "date_price";

			$data['module'] = 'admin';

			$this->load->view($this->_container, $data);

		

	}

	

	public function edit_price(){

		

		$id = end($this->uri->segments);

		$result = $this->shipping_model->Get_price_date($id);

		if(isset($_POST['edit']))

		{

			$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required');

		

			

			$update_data = array(		

			'no_days'=> $this->input->post('no_days'),

			'price'=> $this->input->post('price'),

			'status'=> $this->input->post('status')

			);

			$result = $this->shipping_model->Update_Shipping($id,$update_data);

			

			if($result == true)

			{

				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

			}

			redirect(base_url().'admin/shipping/');

		}

		else

		{

			//print_r($result);

			$data['result'] = $result;

			$data['page_title'] = "Shipping";

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "date_price";

			$data['module'] = 'admin';

			$this->load->view($this->_container, $data);

		}

		

		

	}

	

	public function delete_price()

	{

		//$id = $this->uri->segment(4);

		$id = end($this->uri->segments);

		//echo $id; exit;

		$result = $this->shipping_model->Delete_Shipping($id);

		if($result == true)

		{

			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');

			

		}

		else

		{

			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');

		}

		redirect(base_url().'admin/shipping/shipping_no_days');

	}





}