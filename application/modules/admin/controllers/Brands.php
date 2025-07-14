<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
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
		
		$result = $this->brand_model->Show_Brands(get_current_language());
		$data['result'] = $result;
		$data['page_title'] = "Brands";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "brands";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/brands');
    }
	
	public function add()
	{
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('brand_status', 'Brand Status', 'trim|required');
			
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			$insert_data = array(		
				'brand_name'	=>	$this->input->post('brand_name'),
				'brand_slug'	=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('brand_name')))),
				'brand_image'	=>	$this->input->post('brand_image'),
				'status'		=> 	$this->input->post('brand_status'),
				'created_at'	=>	date('Y-m-d H:i:s'),
				'updated_at'	=>	date('Y-m-d H:i:s')
			);
			$brand_id = $this->brand_model->Insert_Brands($insert_data);
			
			$lang_abbr = $this->config->item("lang_uri_abbr");
			$banner_data = array();
			foreach($lang_abbr as $key=>$a_lang){
				if($key != $this->input->post('language_code')){	
					//echo $key."<br />";
					$brand_data[] = array(
						'brand_id'			=>	$brand_id,
						'language_code'		=>	$key,
						'brand_content'		=>	'',
						'created_at'		=>	date('Y-m-d H:i:s'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
				}
				else{
					$brand_data[] = array(
						'brand_id'			=>	$brand_id,
						'language_code'		=>	$this->input->post('language_code'),
						'brand_content'		=>	$this->input->post('brand_title'),
						'created_at'		=>	date('Y-m-d H:i:s'),
						'updated_at'		=>	date('Y-m-d H:i:s')
					);
				}
			}
			//echo "<pre>"; print_r($brand_data);echo "</pre>"; exit();
			$brand_result = $this->brand_model->Insert_Brand_Content($brand_data);
			if($brand_result == true)
			{
				$data['error'] = "success";
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
			}
		}
		$data['page_title'] = "Brands";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "brands";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function showall()
	{
		
		//echo get_current_language(); exit();
		$result = $this->brand_model->Show_Brands(get_current_language());
		$data['result'] = $result;
		$data['page_title'] = "Brands";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "brands";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
	public function edit()
	{
		$id = end($this->uri->segments);
		$result = $this->brand_model->Get_Brand($id,get_current_language());
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('banner_name', 'Banner Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('banner_status', 'Banner Status', 'trim|required');
			$update_data = array(		
				'brand_name'		=>	$this->input->post('brand_name'),
				'brand_slug'	=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('brand_name')))),
				'brand_image'		=>	$this->input->post('brand_image'),
				'status'			=> 	$this->input->post('brand_status'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
			$result = $this->brand_model->Update_Brands($id,$update_data);
			$brand_data = array(
				'brand_id'			=>	$id,
				'brand_content'	=>	$this->input->post('brand_title'),
				'updated_at'		=>	date('Y-m-d H:i:s')
			);
				
			$this->brand_model->Update_Brand_Content($id,$this->input->post('language_code'),$brand_data);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
			}
			redirect(base_url().'admin/brands/');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Brands";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "brands";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
		/*$uploadchk = false;
		$id = end($this->uri->segments);
		$result = $this->brand_model->Get_Brand($id,get_current_language());
		//print_r(json_decode(json_encode($result), true));
		if(isset($_POST['edit']))
		{
			$this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');
			//$this->form_validation->set_rules('brand_image', 'Brand Image', 'trim|required');
			$this->form_validation->set_rules('brand_status', 'Brand Status', 'trim|required');
			
			if($_FILES['brand_image']['name']!="")
            {
				$config['upload_path'] = './uploads/';
				$upload_root_path = 'uploads/';
				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';
				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';
				$config['max_size'] = '10000';
				$this->upload->initialize($config);
				if( !$this->upload->do_upload('brand_image'))
				{
					$data['error'] = "error";
					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());
				}
				else
				{
					$data['error'] = "success";
					$upload = array('upload_data' => $this->upload->data()); 
					//$view_data = $this->upload->data();
					$brand_pic = $upload_root_path.$upload['upload_data']['file_name'];
				}
				
				$update_data = array(		
				'brand_name'	=>	$this->input->post('brand_name'),
				'brand_image'	=>	$brand_pic,
				'status'		=> 	$this->input->post('brand_status'),
				'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$result = $this->brand_model->Update_Brands($id,$update_data);
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			}
			else
			{
				$update_data = array(		
				'brand_name'	=>	$this->input->post('brand_name'),
				'status'		=> 	$this->input->post('brand_status'),
				'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$result = $this->brand_model->Update_Brands($id,$update_data);
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
			}
			redirect(base_url().'admin/brands/showall');
		}
		else
		{
			//print_r($result);
			$data['result'] = $result;
			$data['page_title'] = "Brands";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "brands";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}*/
		
	}
	
	public function delete()
	{
		//$id = $this->uri->segment(4);
		$id = end($this->uri->segments);
		//echo $id; exit;
		$result = $this->brand_model->Delete_Brands($id);
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect(base_url().'admin/brands/showall');
	}
	
	public function get_brand_content($id,$lang){
		if($id != 0)
		{
			$result = $this->brand_model->Get_Brand_Content($id,$lang);
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