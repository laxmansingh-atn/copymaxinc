<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academic extends MY_Controller {

	public $page_slug;
	function __construct() {
        parent::__construct();
        $this->page_slug = end($this->uri->segments);	
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
	
	public function Millenium_Kids(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Millenium Kids";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "millenium_kid";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
	}
	
	public function Elementary(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Elementary";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "elementary";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
	}
	
	public function MiddleSchool(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] = $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Middle School";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "middleschool";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
	}
	
	public function HighSchool(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "High School";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "highschool";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
	}
	
	public function School_Calendar()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "School Calendar";	
		$data['page'] 		= $this->config->item('bootsshop_template_dir_welcome') . "school_calendar";
		$data['module'] 	= 'welcome';

		$this->load->view($this->_container, $data);
	}
	
    //Cms Page
    public function School_Uniform()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "School Uniform";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "school_uniform";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
	}
	
	public function Social_Service()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('contact-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Social Service";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "social_service";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
	}
}
?>