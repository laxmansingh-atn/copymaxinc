<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Testimonials extends MY_Controller {

	function __construct() {

        parent::__construct();

		$this->load->library(array('ion_auth'));

		$this->load->model('testimonial_model');

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

		$result = $this->testimonial_model->Show_Testimonial();

		$data['result'] = $result;

		$data['page_title'] = "Testimonial Management";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "testimonials";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

		//redirect('admin/brands');

    }

	

	public function add()

	{

		if(isset($_POST['submit']))

		{

			if($_FILES['client_image']['name']!="")

            {

				$config['max_width'] = 200;

				$config['max_height'] = 200;

				$config['upload_path'] = './uploads/testimonials/';

				$upload_root_path = 'uploads/testimonials/';

				//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';

				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';

				$config['max_size'] = '200000';

				$this->upload->initialize($config);

				if( !$this->upload->do_upload('client_image'))

				{

					$data['error'] = "error";

					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());

				}

				else

				{

					$data['error'] = "success";

					$upload = array('upload_data' => $this->upload->data()); 

					$banner_pic = $upload_root_path.$upload['upload_data']['file_name'];

					$insert_data = array(		

						'testimonial_name'					=>	$this->input->post('testimonial_name'),

						'testimonial_client_name'			=>	$this->input->post('client_name'),

						'testimonial_client_image'			=>	$upload_root_path.$upload['upload_data']['file_name'],

						'testimonial_client_designation'	=> 	$this->input->post('client_designation'),

						'testimonial_client_text'			=> $this->input->post('client_description'),

						'status'							=>	$this->input->post('testimonial_status'),

						'created_at'						=>	date('Y-m-d H:i:s'),

						'updated_at'						=>	date('Y-m-d H:i:s')

					);

					$this->testimonial_model->Insert_Testimonial($insert_data);

					if($result == true)

					{

						$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

					}

				}

			}

			else

			{

				$insert_data = array(		

					'testimonial_name'					=>	$this->input->post('testimonial_name'),

					'testimonial_client_name'			=>	$this->input->post('client_name'),

					'testimonial_client_designation'	=> 	$this->input->post('client_designation'),

					'testimonial_client_text'			=> $this->input->post('client_description'),

					'status'							=>	$this->input->post('testimonial_status'),

					'created_at'						=>	date('Y-m-d H:i:s'),

					'updated_at'						=>	date('Y-m-d H:i:s')

				);

				$result = $this->testimonial_model->Insert_Testimonial($insert_data);

				if($result == true)

				{

					$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

				}

			}

		}

		

		$data['page_title'] = "Add New Testimonial";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "testimonials";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

	}

	

	public function edit()

	{safe_str_replace(

		$id = $this->uri->segment(4);

		$result = $this->testimonial_model->Get_Testimonial($id);

		//print_r(json_decode(json_encode($result), true));

		if(isset($_POST['edit']))

		{

			if($_FILES['client_image']['name']!="")

            {

				$config['max_width'] = 200;

				$config['max_height'] = 200;

				$config['upload_path'] = './uploads/testimonials/';

				$upload_root_path = 'uploads/testimonials/';

				$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';

				$config['max_size'] = '200000';

				$this->upload->initialize($config);

				if( !$this->upload->do_upload('client_image'))

				{

					$data['error'] = "error";

					$this -> session -> set_flashdata('update_message',$this->upload->display_errors());

				}

				else

				{

					$data['error'] = "success";

					$upload = array('upload_data' => $this->upload->data()); 

					$banner_pic = $upload_root_path.$upload['upload_data']['file_name'];

					$update_data = array(		

						'testimonial_name'					=>	$this->input->post('testimonial_name'),

						'testimonial_client_name'			=>	$this->input->post('client_name'),

						'testimonial_client_image'			=>	$upload_root_path.$upload['upload_data']['file_name'],

						'testimonial_client_designation'	=> 	$this->input->post('client_designation'),

						'testimonial_client_text'			=> 	$this->input->post('client_description'),

						'status'							=>	$this->input->post('testimonial_status'),

						'created_at'						=>	date('Y-m-d H:i:s'),

						'updated_at'						=>	date('Y-m-d H:i:s')

					);

					$this->testimonial_model->Update_Testimonial($id,$update_data);

					if($result == true)

					{

						$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

					}

				}

			}

			else

			{

				$update_data = array(		

					'testimonial_name'					=>	$this->input->post('testimonial_name'),

					'testimonial_client_name'			=>	$this->input->post('client_name'),

					'testimonial_client_designation'	=> 	$this->input->post('client_designation'),

					'testimonial_client_text'			=> 	$this->input->post('client_description'),

					'status'							=>	$this->input->post('testimonial_status'),

					'created_at'						=>	date('Y-m-d H:i:s'),

					'updated_at'						=>	date('Y-m-d H:i:s')

				);

				$result = $this->testimonial_model->Update_Testimonial($id,$update_data);

				if($result == true)

				{

					$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

				}

			}

			redirect(base_url().'admin/testimonials/');

		}

		else

		{

			//print_r($result);

			$data['result'] = $result;

			$data['page_title'] = "Testimonial Management";

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "testimonials";

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

	

	function transliterateString($txt)

	{

		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');

    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);

	}

}