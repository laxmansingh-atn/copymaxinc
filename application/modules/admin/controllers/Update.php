<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Update extends MY_Controller {



    function __construct() {

        parent::__construct();

		$this->load->library(array('ion_auth'));

		$this->load->model('category_model');

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

		$data['page_title'] = "Category";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

		//redirect('admin/categories');

    }

	

	public function showall()

	{

		$result = $this->category_model->Show_Category();

		$data['result'] = $result;

		$data['page_title'] = "Category";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

	}
safe_str_replace(
	safe_str_replace(

	public function add()

	{

		$category_list = $this->category_model->Show_Category();

		if(isset($_POST['submit']))

		{

			$this->form_validation->set_rules('category_name', 'Brand Name', 'trim|required');

			//$this->form_validation-safe_str_replace(category_image', 'Brand Image', 'trim|required');
safe_str_replace(
			$this->form_validation->set_rules('category_status', 'Brand Status', 'trim|required');

			

			//echo $_FILES['category_image']['name']; exit;

			if($_FILES['category_image']['name']!="")

            {

				$config['upload_path'] = './uploads/';

				$upload_root_path = 'uploads/';

				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';

				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';

				$config['max_size'] = '10000';

				$this->upload->initialize($config);

				

				if ( ! $this->upload->do_upload('category_image'))

				{

					$data['error'] = "error";

					//array('error' => $this->upload->display_errors()); 

					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());

				}	

				else

				{

					$data['error'] = "success";

					$upload = array('upload_data' => $this->upload->data()); 

					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

					

					$insert_data = array(		

						'category_name'		=>	$this->input->post('category_name'),

						//'category_slug'		=>	mysql_real_escape_string(safe_str_replace(" ","-",strtolower($this->input->post('category_name')))),

						'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('category_name')))),
safe_str_replace(
						'category_image'	=>	$upload_root_path.$upload['upload_data']['file_name'],

						'parent_category'	=>	$this->input->post('parent_category'),

						'status'			=> 	$this->input->post('category_status'),

						'created_at'		=>	date('Y-m-d H:i:s'),

						'updated_at'		=>	date('Y-m-d H:i:s')

					);

					$this->category_model->Insert_Category($insert_data);

				}
safe_str_replace(
			}safe_str_replace(

			else

			{

				$insert_data = array(		

						'category_name'		=>	$this->input->post('category_name'),

						//'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->input->post('category_name'))),

						'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('category_name')))),

						'category_image'	=>	'',

						'parent_category'	=>	$this->input->post('parent_category'),

						'status'			=> 	$this->input->post('category_status'),

						'created_at'		=>	date('Y-m-d H:i:s'),

						'updated_at'		=>	date('Y-m-d H:i:s')

					);

					$this->category_model->Insert_Category($insert_data);

					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

			}

		}

		$data['category_list'] = $category_list;

		$data['page_title'] = "Category";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

	}

	
safe_str_replace(
	public function edit()

	{

		$uploadchk = false;

		$id = $this->uri->segment(4);

		$category_list = $this->category_model->Show_Category();

		$result = $this->category_model->Get_Category($id);

		//print_r(json_decode(json_encode($result), true));

		if(isset($_POST['edit']))

		{

			//echo $this->input->post('parent_category'); die;

			$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');

			//$this->form_validation->set_rules('category_image', 'Brand Image', 'trim|required');

			$this->form_validation->set_rules('category_status', 'Category Status', 'trim|required');

			

			if($_FILES['category_image']['name']!="")

            {

				$config['upload_path'] = './uploads/';

				$upload_root_path = 'uploads/';

				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';

				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';

				$config['max_size'] = '10000';

				$this->upload->initialize($config);

				if( !$this->upload->do_upload('category_image'))

				{

					$data['error'] = "error";

					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());

				}

				else

				{

					$data['error'] = "success";

					$upload = array('upload_data' => $this->upload->data()); 

					//$view_data = $this->upload->data();

					$category_pic = $upload_root_path.$upload['upload_data']['file_name'];

				}

				

				$update_data = array(		

				'category_name'	=>	$this->input->post('category_name'),

				//'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->input->post('category_name'))),

				'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('category_name')))),

				'category_image'	=>	$category_pic,

				'parent_category'	=>	$this->input->post('parent_category'),

				'status'		=> 	$this->input->post('category_status'),

				'updated_at'	=>	date('Y-m-d H:i:s')

				);

				$result = $this->category_model->Update_Category($id,$update_data);

				if($result == true)

				{

					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

				}

			}

			else

			{

				$update_data = array(		

				'category_name'	=>	$this->input->post('category_name'),

				'category_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('category_name')))),

				//'category_slug'		=>	mysql_real_escape_string(safe_str_replace(" ","-",strtolower(htmlentities($this->input->post('category_name'))))),

				'parent_category'	=>	$this->input->post('parent_category'),

				'status'		=> 	$this->input->post('category_status'),

				'updated_at'	=>	date('Y-m-d H:i:s')

				);

				$result = $this->category_model->Update_Category($id,$update_data);

				if($result == true)

				{

					$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

				}

			}

			redirect(base_url().'admin/categories/showall');

		}

		else

		{

			//print_r($result);

			$data['result'] = $result;

			$data['category_list'] = $category_list;

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

		redirect(base_url().'admin/categories/showall');

	}

	

	function transliterateString($txt)

	{

		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');

    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);

	}

}

?>