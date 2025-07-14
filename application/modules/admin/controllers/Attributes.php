<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attributes extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->model('attribute_model');
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
	    
		$result = $this->attribute_model->Show_Attributes();
		$data['result'] = $result;
		$data['page_title'] = "Attributes";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/brands');
    }
	
	public function attributename()
	{
		$segments = $this->uri->total_segments();
		$lang_code = get_current_language(); // Helper "current_language_helper.php"
		
		
		if(end($this->uri->segments) == "add")
		{
			if(isset($_POST['submit']))
			{
				$this->form_validation->set_rules('attribute_name', 'Attribute Name', 'trim|required'); 
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				//print_r($data);
				$insert_data = array(		
					'attribute_name'	=>	$this->input->post('attribute_name'),
					'created_at'	=>	date('Y-m-d H:i:s'),
					'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$this->attribute_model->Insert_Attribute($insert_data);
			}
			
			$data['page_title'] = "Attributes";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
			$data['module'] = 'admin';
			
			$this->load->view($this->_container, $data);
		}
		else if($this->uri->segment($segments-1) == "edit")
		{
			$id = end($this->uri->segments);
			$result = $this->attribute_model->Get_Attribute($id);
			//print_r(json_decode(json_encode($result), true));
			if(isset($_POST['edit']))
			{
				$update_data = array(		
				'attribute_name'	=>	$this->input->post('attribute_name'),
				'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$result = $this->attribute_model->Update_Attribute($id,$update_data);
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
				redirect(base_url().'admin/attributes/attributename/');
			}
			else
			{
				//print_r($result);
				$data['result'] = $result;
				$data['page_title'] = "Attributes";
				$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
				$data['module'] = 'admin';
				$this->load->view($this->_container, $data);
			}
		}
		else if($this->uri->segment($segments-1) == "delete")
		{
			$id = end($this->uri->segments);
			$result = $this->attribute_model->Delete_Attribute($id);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			}
			else
			{
				$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
			}
			redirect(base_url().'admin/attributes/attributename/');
		}
		else
		{
			$result = $this->attribute_model->Show_Attributes();
			$data['result'] = $result;
			$data['page_title'] = "Attributes";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		//redirect('admin/brands');
    }
	
	
	public function getAttribute_varient()
	{
     $id = $_POST['id'];
	 $iid = $_POST['iid'];
	   $attribute = $this->attribute_model->Get_AttributeNameValue($id);
		echo '<select class="form-control selected_val" id="attr_val'.$iid.'" name="network[0][]">';
		foreach($attribute as $attributes)
		{
		echo '<option value="'.$attributes['value_id'].'">'.$attributes['value'].'</option>';	
		}
		echo '</select>';
	  exit();
	}
	
	
	
	public function attributesvalue()
	{
		$segments = $this->uri->total_segments();
		//$lang_code = get_current_language(); // Helper "current_language_helper.php"
		$attribute = $this->attribute_model->Show_Attributes();
		$data['attributelist'] = $attribute;
		if(end($this->uri->segments) == "add")
		{
			if(isset($_POST['submit']))
			{
				$this->form_validation->set_rules('attribute_name', 'Attribute Name', 'trim|required'); 
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');
				 
				$post_data = $this->input->post();
			
				for($i=0; $i<count($post_data['attribute']); $i++){		

					$temp_arr['attribute_id'] 	= $post_data['attribute'][$i];
					$temp_arr['value'] 			= $post_data['attribute_value'][$i];
					//$temp_arr['slug'] 		= safe_str_replace(" ","-",strtolower($this->transliterateString($post_data['attribute_value'][$i])));
					$temp_arr['status'] 		= $post_data['status'][$i];
					$temp_arr['created_at'] 	= date("Y-m-d H:i:s");
					$temp_arr['updated_at'] 	= date("Y-m-d H:i:s");		 
					$temp_arr1[] = $temp_arr; 		 			 
			} 
				    // print_r($temp_arr1) ;  exit() ; 
			         $this->db->insert_batch('tbl_attribute_value', $temp_arr1);
			
			}
			
			
			$data['page_title'] = "Attribute Values";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
			$data['module'] = 'admin';
			
			$this->load->view($this->_container, $data);
		}
		else if($this->uri->segment($segments-1) == "edit")
		{
			$id = end($this->uri->segments);
			$result = $this->attribute_model->Get_AttributeValue($id);
			$data['result'] = $result;
			//print_r(json_decode(json_encode($result), true));
			if(isset($_POST['edit']))
			{
				$update_data = array(
				'attribute_id'	=> $this->input->post('attribute')[0],	
				'value'	        =>	$this->input->post('attribute_value')[0],
				'status'	    =>	$this->input->post('status')[0],
				'created_at'	=>	date('Y-m-d H:i:s') ,				
				'updated_at'	=>	date('Y-m-d H:i:s')
				);
				$result = $this->attribute_model->Update_AttributeValue($id,$update_data);
				if($result == true)
				{
					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
				}
				redirect(base_url().'admin/attributes/attributesvalue/');
			}
			else
			{
				$data['attribute'] = $attribute;
				$data['result'] = $result;
				$data['page_title'] = "Attributes";
				$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
				$data['module'] = 'admin';
				$this->load->view($this->_container, $data);
			}
		}
		else if($this->uri->segment($segments-1) == "delete")
		{
			$id = end($this->uri->segments);
			$result = $this->attribute_model->Delete_AttributeValue($id);
			if($result == true)
			{
				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
			}
			else
			{
				$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
			}
			redirect(base_url().'admin/attributes/attributesvalue/');
		}
		else
		{
			$result = $this->attribute_model->Show_AttributesValue();
			//print_r($result);
			$data['result'] = $result;
			$data['attribute'] = $attribute;
			$data['page_title'] = "Attributes";
			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "attributes";
			$data['module'] = 'admin';
			$this->load->view($this->_container, $data);
		}
		
		
    }
	
	function transliterateString($txt)
	{
		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
	}
}
?>