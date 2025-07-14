<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('category_model');
		$this->load->model('brand_model');
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
		$result = $this->category_model->Show_Category(get_current_language());
		$data['result'] = $result;
		$data['page_title'] = "Category";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/categories');
    }
	
	/*public function showall()
	{
		$result = $this->category_model->Show_Category();
		$data['result'] = $result;
		$data['page_title'] = "Category";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}*/
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
			//$this->form_validation->set_rules('category_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('category_status', 'Category Status', 'trim|required');
			
			//echo $_FILES['category_image']['name']; exit;
			if ($this->form_validation->run() != FALSE)
			{
				$insert_data = array(		
					'category_name'		=>	$this->input->post('category_name'),
					'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('category_name')))),
					'category_image'	=>	$this->input->post('category_image'),
					'parent_category'	=>	$this->input->post('parent_category'),
					'featured_category'	=>	$this->input->post('featured_category'),
					'status'		=> 	$this->input->post('category_status'),
					'created_at'		=>	date('Y-m-d H:i:s'),
					'updated_at'		=>	date('Y-m-d H:i:s')
				);
				$category_id = $this->category_model->Insert_Category($insert_data);
				
				
				
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Category inserted successfully.');
			}
			else
			{
				$data['error'] = "Please fill up all the required fields";
				//array('error' => $this->upload->display_errors()); 
				//$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
			}
		}
		//$category_list = $this->category_model->Show_Category(get_current_language());
		//$data['category_list'] = $category_list;
		//$data['brand_list'] = $this->brand_model->Show_Brands(get_current_language());
		
		$data['page_title'] = "Category";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edit()
	{
		$uploadchk = false;
		$id = end($this->uri->segments);
		$category_list = $this->category_model->Show_Category(get_current_language());
		$result = $this->category_model->Get_Category($id,get_current_language());
		
		if(isset($_POST['edit']))
		{
		   // echo '<pre>'; print_r( $this->input->post() ) ; exit() ;
			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('category_status', 'Category Status', 'trim|required');
			
			$update_data = array(		
				'category_name'		=>	$this->input->post('category_name'),
				'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('category_name')))),
				'parent_category'	=>	$this->input->post('parent_category'),
				'category_image'	=>	$this->input->post('category_image'),
				'featured_category'	=>	$this->input->post('featured_category'),
				'status'			=> 	$this->input->post('category_status'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);

			$result = $this->category_model->Update_Category($id,$update_data);
            /* 
			$category_data = array(
				'category_id'		=>	$id,
			    'language_code'		=>	$this->input->post('language_code') ,
				'category_title'	=>	$this->input->post('category_title'),
				'short_description'  =>	$this->input->post('short_description'),
				'category_content'  =>	$this->input->post('category_content'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
				
			$this->category_model->Update_Category_Content($id,$this->input->post('language_code'),$category_data);
			*/
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}
			
			redirect(base_url().'admin/categories/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			// $data['brand_list'] =  $this->brand_model->Show_Brands(get_current_language());
			$data['page_title'] = "Category";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
	}
	
	public function delete()
	{
		//$id = $this->uri->segment(4);
		$id = end($this->uri->segments);
		//echo $id; exit;
		$result = $this->category_model->Delete_Category($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/categories');
	}
	
	public function get_category_content($id,$lang){
		//$id = end($this->uri->segments);
		//$lang = $this->input->post('language_code');
		if($id != 0)
		{
		$result = $this->category_model->Get_Category_Content($id,$lang);
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
?>