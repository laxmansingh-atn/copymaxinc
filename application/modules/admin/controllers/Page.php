<?php if (!defined('BASEPATH')) exit('No direct script access allowed');





class Page extends MY_Controller {


	function __construct() {


        parent::__construct();


		$this->load->library(array('ion_auth'));


		$this->load->model('page_model');


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



		$result = $this->page_model->Show_Page(get_current_language());


		$data['result'] = $result;


		$data['page_title'] = "Page Management";


		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "page";


		$data['module'] = 'admin';


		$this->load->view($this->_container, $data);


		//redirect('admin/brands');


    }


	


	public function add()


	{


		if(isset($_POST['submit']))


		{


			$this->form_validation->set_rules('page_name', 'Page Name', 'trim|required');


			//print_r($_FILES);exit();


			$data['error'] = "success";


			$insert_data = array(


				'page_name'		=>	$this->input->post('page_name'),


				'page_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('page_name')))),


				'page_image'	=>	$this->input->post('page_image'),


				'status'		=> 	$this->input->post('page_status'),


				'created_at'	=>	date('Y-m-d H:i:s'),


				'updated_at'	=>	date('Y-m-d H:i:s')


			);


			$page_id = $this->page_model->Insert_Page($insert_data);





			$lang_abbr = $this->config->item("lang_uri_abbr");


			$page_data = array();


			foreach($lang_abbr as $key=>$a_lang){


				if($key != $this->input->post('language_code')){


					$page_data[] = array(


						'page_id'		=>	$page_id,


						'language_code'	=>	$key,


						'page_title'	=>	'',


						'page_content'	=>	'',


						'created_at'	=>	date('Y-m-d H:i:s'),


						'updated_at'	=>	date('Y-m-d H:i:s')


					);


				}


				else{


					$page_data[] = array(


						'page_id'			=>	$page_id,


						'language_code'		=>	$this->input->post('language_code'),


						'page_title'		=>	$this->input->post('page_title'),


						'page_content'		=>	stripslashes($this->input->post('page_description')),


						'created_at'		=>	date('Y-m-d H:i:s'),


						'updated_at'		=>	date('Y-m-d H:i:s')


					);


				}


			}


			$this->page_model->Insert_Page_Content($page_data);


			$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');


		}


		


		$data['page_title'] = "Add New Page";


		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "page";


		$data['module'] = 'admin';


		$this->load->view($this->_container, $data);


	}


	


	public function edit()


	{


		$id = end($this->uri->segments);


		$result = $this->page_model->Get_Page($id,get_current_language());


		//echo "<pre>"; print_r($result);echo "</pre>";


		if(isset($_POST['edit']))


		{		


			$data['error'] = "success";


			





			$update_data = array(		


			'page_name'			=>	$this->input->post('page_name'),


			'page_slug'			=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('page_name')))),


			'page_image'		=>	$this->input->post('page_image'),


			'status'			=> 	$this->input->post('page_status'),


			'updated_at'		=>	date('Y-m-d H:i:s')


			);


			$result = $this->page_model->Update_Page($id,$update_data);





			$page_data = array(


				'page_title'	=>	$this->input->post('page_title'),


				'page_content'	=>	stripslashes($this->input->post('page_description')),


				'updated_at'	=>	date('Y-m-d H:i:s')


			);


			$res = $this->page_model->Update_Page_Content($id,$this->input->post('language_code'),$page_data);





			if($result == true)


			{


				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');


			}


			redirect(base_url().'admin/page/');


		}


		else


		{


			//print_r($result);


			$data['result'] = $result;


			$data['page_title'] = "Page Management";


			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "page";


			$data['module'] = 'admin';


			$this->load->view($this->_container, $data);


		}


		


	}


	


	public function delete()


	{


		//$id = $this->uri->segment(4);


		$id = end($this->uri->segments);


		//echo $id; exit;


		$result = $this->page_model->Delete_Page($id);


		if($result == true)


		{


			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');


			


		}


		else


		{


			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');


		}


		redirect(base_url().'admin/page/');


	}


	


	public function get_page_content($id,$lang){



		//$id = end($this->uri->segments);


		//$lang = $this->input->post('language_code');


		if($id != 0)


		{


		$result = $this->page_model->Get_Page_Content($id,$lang);


		//echo $id."  ".$lang; exit();


		echo json_encode($result);


		}


	}


	


	function transliterateString($txt)


	{


		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');


    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);


	}


}