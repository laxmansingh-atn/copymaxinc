<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends MY_Controller {

	function __construct() {
        parent::__construct();		
		$this->load->model('home_model');
		if($this->session->userdata('site_lang') == "")
		{
			$a_lang = $this->config->item('lang_uri_abbr');
			$lang_code = $this->uri->segment(1);
			//$lang_value = "english";
			if(array_key_exists($lang_code,$a_lang))
			{
				$lang_value = $a_lang[$lang_code];
			}
			//echo $lang_value; exit();
			$this->session->set_userdata('site_lang', $lang_value);
		}		
    }

    //Home Page
	public function index()
	{
		$page_slug = end($this->uri->segments);
		$page_title = safe_str_replace("-"," ",$page_slug);
		$page_title = ucwords($page_title);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		
		$data['page_title'] 	= $page_title;	
		$data['page'] 		= $this->config->item('bootsshop_template_dir_welcome') . "policy";
		$data['module'] 	= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);		
	}
	
	public function policy(){
		$page_slug = end($this->uri->segments);
		$page_title = safe_str_replace("-"," ",$page_slug);
		$page_title = ucwords($page_title);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		
		$data['page_title'] 	= $page_title;	
		$data['page'] 		= $this->config->item('bootsshop_template_dir_welcome') . "policy";
		$data['module'] 	= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
	
	public function Welcome_Letter()
	{
		
		$page_slug = end($this->uri->segments);
		
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		//$data['news_list']		= $this->home_model->Show_News(get_current_language()); 	//news list
		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "about_welcome_letter";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);		
    }
	
	public function Accrediation(){
		
		$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "accrediation";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);	
	}
	
	public function Mission_Vision(){
		
		$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "mission_vision";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);	
	}
	
	public function School_Profile(){
		$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "school_profile";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);	
	}
	
	public function Faculty_Staff(){
		$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "faculty_staff";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
	
	public function Teacher_Handbook(){
		$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Teacher Handbook";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "teacher_handbook";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
	
	public function Professional_Development(){
		$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Professional Development";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "professional_development";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
}
?>