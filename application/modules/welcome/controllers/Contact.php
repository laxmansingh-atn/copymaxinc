<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	function __construct() {
        parent::__construct();		
		$this->load->model('home_model');
		
		$a_lang = $this->config->item('lang_uri_abbr');
		$lang_code = $this->uri->segment(1);
		$lang_value = "english";
		if(array_key_exists($lang_code,$a_lang))
		{
			$lang_value = $a_lang[$lang_code];
		}
		$this->session->set_userdata('site_lang', $lang_value);
    }

    //Home Page
    public function index()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		//$data['news_list']		= $this->home_model->Show_News(get_current_language()); 	//news list
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Home";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "contact";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);		
    }
	
	public function lang()
	{
		/*$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$a_lang = $this->config->item('lang_uri_abbr');
		$lang_code = $this->uri->segment(1);
		$lang_value = "english";
		if(array_key_exists($lang_code,$a_lang))
		{
			$lang_value = $a_lang[$lang_code];
			//echo "Key exists!";
		}
		$this->session->set_userdata('site_lang', $lang_value);
		$this->lang->load('message',$lang_value);
		
		$data = array();
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "lang";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);*/
	}
	
    

    //Cms Page
    public function pages()
	{
			
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');

		$page_slug = end($this->uri->segments);
		$result_page = $this->home_model->Get_Page($page_slug);
		$data['banner_list'] 	= $this->home_model->Show_Banner($page_slug); 	//banner list
		$data['content'] 		= $this->home_model->get_contactus_contents();	//content details
		$data['succ_msg'] 		= $this->session->userdata('succ_msg');	
		$data['error_msg'] 		= $this->session->userdata('error_msg');	
		$this->session->unset_userdata('succ_msg');	
		$this->session->unset_userdata('error_msg');
		
		$data['category_list'] 	= $this->home_model->getAllCategory();
		$data['page_result'] = $result_page;
		$data['page_title'] = "";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "pages";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);
	}

	

    //Contact Us Page
   /* public function contact_us()
	{
			
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cms.php";
        $this->_modules = $this->config->item('modules_locations');

        $data = array();				
		$data['banner_list'] 	= $this->home_model->Show_Banner(); 	//banner list		
		$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		$data['content'] 		= $this->home_model->get_contactus_contents();	//content details

		$data['succ_msg'] 		= $this->session->userdata('succ_msg');	
		$data['error_msg'] 		= $this->session->userdata('error_msg');	
		$this->session->unset_userdata('succ_msg');	
		$this->session->unset_userdata('error_msg');	

		$data['page_title'] 	= "";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "contactus";
		$data['module'] 		= 'welcome';

		//echo "<pre>";print_r($data['content']);exit();

		$this->load->view($this->_container, $data);
	}*/

	//Contact us info add
    public function contact_info_add()
	{		
		$temp_arr = $this->input->post();
		$temp_arr['created_on'] = date('Y-m-d h:i:s');

    	$this->db->insert('tbl_contact_info', $temp_arr);
    	$this->session->set_userdata('succ_msg', 'Your email has been sent successfully. we will get back you soon.');
    	redirect(base_url('contact-us'));
	}
	
	// Function to get the client ip address
	public function get_client_ip_env()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
	
	// Function to get the client ip address
	public function get_client_ip_server()
	{
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}

	public function Request_Quote(){
	  $insert_data = array(  
	   'name'   => $this->input->post('quote_name'),
	   'phone'   => $this->input->post('quote_phone'),
	   'email'   => $this->input->post('quote_email'),
	   'address'  => $this->input->post('quote_address'),
	   'created_at' => date('Y-m-d H:i:s'),
	   'updated_at' => date('Y-m-d H:i:s')
	  );
	  $result = $this->home_model->add_Quote($insert_data);
	  echo $result;
	 }

	 //GET in TOUCH 
	 public function GetInTouch(){

	  $contact_first_name = $this->input->post('contact_first_name');
	  $contact_last_name = $this->input->post('contact_last_name');
	  $contact_phone = $this->input->post('contact_phone');
	  $contact_email = $this->input->post('contact_email');
	  $contact_message = $this->input->post('contact_message');
	  $name = $contact_first_name." ".$contact_last_name;
	  //////////////////////  email send /////////////////////////////

	  $this->email->set_mailtype("html");   
	  $this->email->from($contact_email, $name);
	  $this->email->to('arghya.saha@met-technologies.com'); 
	  //$this->email->bcc('arghya.saha@met-technologies.com'); 

	  $this->email->subject('Get In Touch');

	  $message = " Hi,<br><br>
	  ".$contact_message."<br>
	  Thank you<br><br>".$name;   

	  $this->email->message($message); 

	  $this->email->send();

	  //////////////////////  email send end /////////////////////////////
	  //$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Mail has been sent successfully.');
	  //redirect(current_url());

	 }
}
?>