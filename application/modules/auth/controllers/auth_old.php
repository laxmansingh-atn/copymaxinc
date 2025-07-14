<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*class Auth extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('auth_database');
		//$this->load->database();
		//$this->_container = $this->config->item('bootsshop_template_dir_admin') . "layout.php";
        //$this->_modules = $this->config->item('modules_locations');
        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    public function index() {
        if(isset($this->session->userdata['logged_in']))
		{
			//echo $this->session->userdata['logged_in']['username'];
			redirect('admin/dashboard','refresh');
		}
		else
		{
			$data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
        	$data['module'] = 'auth';
        	$this->load->view($this->_container, $data);
		}
	}
	
	public function login_process()
	{
		// Load database
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		//echo "Value:=> " .$this->form_validation->run()."<br>";
		if ($this->form_validation->run() === FALSE)
		{
			$data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
        	$data['module'] = 'auth';
        	$this->load->view($this->_container, $data);
		}
		else
		{
			//echo "true";
			$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
			$result = $this->auth_database->login($data);
			if ($result == true)
			{
				$username = $this->input->post('username');
				$result_info = $this->auth_database->read_user_information($username);
				if ($result_info != false)
				{
					$session_data = array(
					'username' => $result_info[0]->user_name,
					//'email' => $result[0]->user_email,
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
					redirect('admin/dashboard','refresh');
					//$this->load->view('admin_page');
				}
			}
			else
			{
				$data['error_message'] = 'Invalid Username or Password';
				$data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
        		$data['module'] = 'auth';
        		//$this->load->view($this->_container, $data);
				//redirect('auth','refresh');
				$this->load->view('auth', $data);
			}
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}*/

/*class Auth extends MY_Controller {
    function __construct() {
        parent::__construct();
        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    function index() {
        $data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
        $data['module'] = 'auth';
        $this->load->view($this->_container, $data);
    }
}*/
?>