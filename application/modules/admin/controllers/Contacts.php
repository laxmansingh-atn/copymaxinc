<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('contact_model');
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
		$result = $this->contact_model->Show_Contacts();
		$data['result'] = $result;
		//print_r($data['result']); die;
		$data['page_title'] = "Contact Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "contacts";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
    }
}
?>