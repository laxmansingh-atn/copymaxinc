<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends MY_Controller {

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
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
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

		$this->load->view($this->_container, $data);		
    }
	
	public function Student_Service()
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
		$data['page_title'] 	= "Student Service Department";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "student_service";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);		
    }
	
	public function Transportation(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('about-us',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "transportation";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);	
	}
	
	public function Cafeteria(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']	= $this->home_model->Show_Banner('cafeteria',get_current_language()); 	//banner list		
		$data['page_content']	= $this->home_model->Show_Page_Content($this->page_slug,get_current_language());
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "Welcome Letter From Director";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "cafeteria";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);	
	}
}
?>