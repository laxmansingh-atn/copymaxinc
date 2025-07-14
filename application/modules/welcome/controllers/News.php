<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

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
		$data['banner_list']	= $this->home_model->Show_Banner('news',get_current_language()); 	//banner list		
		$data['news_list']		= $this->home_model->Show_News(get_current_language()); 	//news list
		$data['contact'] 	= $this->home_model->get_contactus_contents();
		//$data['category_list'] 	= $this->home_model->getAllCategory();	//category list
		//$data['page_result'] 	= $result_page;
		//$data['testimonial']	= $testimonials;
		$data['page_title'] 	= "News";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "news";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);		
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
}
?>