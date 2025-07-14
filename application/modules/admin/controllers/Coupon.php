<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends MY_Controller {
	function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('coupon_model');
		if(!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
		$this->_container = $this->config->item('bootsshop_template_dir_admin') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');        
    }
	
	public function index()
	{
		$result = $this->coupon_model->show_all_blast();
		//echo "<pre>";print_r($result);die();
		$data['result'] = $result;
		$data['page_title'] = "Coupons";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "coupon_list";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
    }

    public function add()
    {
    	if(isset($_POST['submit']))
		{
			$data['error'] = "success";
			$insert_data = array(
				'coupon_code'	=>	$this->input->post('coupon_code'),
				'amount'		=>	$this->input->post('amount')
			);

			$return = $this->coupon_model->check_already_exists($this->input->post('coupon_code'));

			if ($return == "0") {
				$result = $this->coupon_model->insert($insert_data);

				if($result)
				{
					$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				}
				else
				{
					$this->session->set_flashdata('update_message','Something wrong.');
				}
			} else {
				$this->session->set_flashdata('update_message','<strong>Error!</strong> Data for the same state and county is already exists');
			}

			redirect(base_url().'admin/coupon');
		}
		$data['page_title'] = "Add Coupons";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "coupon_list";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
    }

    public function delete($id)
    {
		$result = $this->coupon_model->delete($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/coupon/');
    }

    public function edit($id)
    {
    	if(isset($_POST['edit']))
		{
			$data['error'] = "success";

			$update_data = array(
				'coupon_code'	=>	$this->input->post('coupon_code'),
				'amount'		=>	$this->input->post('amount')
			);
			$result = $this->coupon_model->update($id,$update_data);

			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}else{
				$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
			}
			redirect(base_url().'admin/coupon/');
		}
		$result = $this->coupon_model->get_coupon($id);
		//echo "<pre>";print_r($result);die();
		$data['result'] = $result;
		$data['page_title'] = "Edit Coupons";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "edit_coupon";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
    }
}