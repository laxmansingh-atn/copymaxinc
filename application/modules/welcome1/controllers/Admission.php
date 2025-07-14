<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends MY_Controller {

	public $page_slug;
	function __construct() {
        parent::__construct();
        $this->page_slug = end($this->uri->segments);	
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
		/*$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		//$data['news_list']		= $this->home_model->Show_News(get_current_language()); 	//news list
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Home";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "about";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);*/		
    }
	
	public function Admission_For_2017()
	{
		//echo $this->page_slug."<br />".$page_slug; exit();
		//$page_slug = end($this->uri->segments);
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Admission For 2017";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "admission_for_2017";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);		
    }
	
	/*public function Summer_2017(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		//$data['news_list']		= $this->home_model->Show_News(get_current_language()); 	//news list
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "summer_2017";
		$data['module'] 		= 'welcome';
		//$data['recent_products']= $this->home_model->getRecentProducts();
		$this->load->view($this->_container, $data);
	}*/
	
	
	public function Admission_Fees_2017(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Teacher Handbook";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "admission_fees_2017";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
	
	public function Admission_Procedure(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Professional Development";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "admission_procedure";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
	
	public function Registration_For_Siblings()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Professional Development";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "registration_for_siblings";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);
	}
	
    public function Requirements()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Professional Development";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "requirement";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);	

	}
}
?>