<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
		
		//$this->load->model('ion_auth_model');
		
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    }

    public function index() {
        if ($this->ion_auth->logged_in()) {
            redirect('admin/dashboard', 'refresh');
        } else {
            $data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
            $data['module'] = 'auth';

            $this->load->view($this->_container, $data);
        }
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
		//echo $_POST['username']."  ".$_POST['password'];exit();
		//echo $this->input->post('username')." ".$this->input->post('password');exit();
        if ($this->form_validation->run() == true) {
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                 $user_id=$this->ion_auth->get_user_id();
                 if($user_id == 1){
                //echo $this->ion_auth->messages(); exit();
               
                	redirect('admin/dashboard', 'refresh');
            	}
            	else{
            		$this->session->set_flashdata('message', 'Login with proper credentials');
                	$data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
            		$data['module'] = 'auth';
            		//$data['message'] = $this->data['message'];
			$this->load->view($this->_container, $data);
            	
            	}
            } else {
                $this->session->set_flashdata('message', 'Login with proper credentials');
                	$data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
            		$data['module'] = 'auth';
            		//$data['message'] = $this->data['message'];
			$this->load->view($this->_container, $data);
            }
        } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['page'] = $this->config->item('bootsshop_template_dir_public') . "login_form";
            $data['module'] = 'auth';
            //$data['message'] = $this->data['message'];

            $this->load->view($this->_container, $data);
        }
    }
	
 public function forget_password(){

  if(!empty($this->input->post())){

   $this->form_validation->set_rules('user_email', 'User Email', 'trim|required');

   if($this->form_validation->run() != FALSE)
    {
    $user_email = $this->input->post('user_email');
	
	$result = $this->db->get_where('users',array('email'=>$user_email))->result_array();
	
    //$result = $this->home_model->checkUserByEmail($user_email);

    if(count($result)== 1){

     $forgotten = $this->ion_auth->forgotten_password($user_email);

     $forget_link = base_url()."reset-newpassword/" . $forgotten['forgotten_password_code'];
     $email  = $this->input->post('user_email');

     $to   = $this->input->post('user_email');
     $subject = "Forget Password";

     $message = "<html>
        <head>
        <title>Forget Password Email</title>
        </head>
        <body>
        <p>Hello ".$email.",</p>
        <p>&nbsp;</p>
        <p>Please click on below link to reset your password.</p>
        <p><a href=".$forget_link.">CLICK HERE</a></p>
        <p>&nbsp;</p>
        <p>Best Regards,<br/>My tek Hub Team</p>
        </body>
        </html>";
		
		$this->email->set_mailtype("html"); 
		$this->email->to($to);		
		$this->email->from('jayanta.saha@met-technologies.com', 'MY TEK HUB');
		$this->email->subject($subject);                   
     	$this->email->message($message);
        //$this->email->attach($newFile);
     	$this->email->send();
	
	 $this -> session->set_flashdata('message','Please check your inbox');
     redirect('auth', 'refresh');
    
    }
	else {
      $this -> session->set_flashdata('message','This userID does not exist');
      redirect('auth', 'refresh');
		
	}
   }
  }
 }
 
 
 public function reset_password()
 {
  //$code = $this->input->get('key');
  $code = end($this->uri->segments); 
  $data = array();
  $data['code'] = $code;

  if(isset($_POST['reset_password']))
  {   

   $this->form_validation->set_rules('password_1', 'Password 1', 'trim|required');
   $this->form_validation->set_rules('password_2', 'Password 2', 'trim|required');

   $password1 = $this->input->post('password_1');
   $password2 = $this->input->post('password_2');
   $code =      $this->input->post('code');
   if($password1 == $password2)
   {
    $reset = $this->ion_auth->forgotten_password_complete($code, $password1); 
     	
    
    if ($reset) 
    {       
     //if the reset worked then send them to the login page
     $this->session->set_flashdata('message',  "Password has been changed !");        
    }
    else
    { 
     //if the reset didnt work then send them back to the forgot password page
     $this->session->set_flashdata('message', $this->ion_auth->errors());
     //redirect("auth/forgot_password", 'refresh');     
    }
   }
   else
   {
    $this->session->set_flashdata('message', "Password doesn't match. Please try again.");
   }

   redirect(base_url("auth/"), 'refresh');   
  }

  $data['page_title'] = "Reset Password";
 
  $data['page'] = $this->config->item('bootsshop_template_dir_public') . "reset_password";
  $data['module'] = 'auth';
  $this->load->view($this->_container, $data);

 }
 

   public function logout() {
        $this->ion_auth->logout();

        redirect('auth', 'refresh');
    }

}