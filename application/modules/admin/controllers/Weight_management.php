<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Weight_management extends MY_Controller {



    function __construct() {

        parent::__construct();

		$this->load->library(array('ion_auth'));

		$this->load->model('product_model');

		

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

		$result = $this->product_model->Show_Weight_List();

		$data['result'] = $result;

		$data['page_title'] = "Weight Management";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "weight_management";

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

	

	public function add(){

		

		if(isset($_POST['submit'])){

			

			$this->form_validation->set_rules('product_id', 'Product ID', 'trim|required');

			$this->form_validation->set_rules('dimension[]', 'Dimension', 'trim|required');

			

			$dimension=$this->input->post('dimension');

			

			if($this->form_validation->run() != FALSE){

				$insert_data=array();

				for($i=0; $i < count($dimension); $i++){

				

					array_push($insert_data,array(		

						'product_id'		=>	$this->input->post('product_id'),

						'dimension'		=>	$this->input->post('dimension')[$i],

						'master_printing_attribute_id'	=>	$this->input->post('master_printing_attribute_id')[$i],

						'weight'	=>	$this->input->post('weight')[$i],

						'height'	=>	$this->input->post('height')[$i],

						'sheets_count'		=> 	50,

						'created_on'		=>	date('Y-m-d H:i:s')));

				}

				//echo '<pre>';print_r($insert_data);	

				

				$category_id = $this->product_model->batch_insert('product_weight',$insert_data);

				

				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Product weight added successfully');

			}

			else{

				

				$data['error'] = "Please fill up all the required fields";

				

			}

		}

        $data['product_list'] = $this->product_model->Show_Products_admin();

        //print_r($data['product_list']);die;

		$data['page_title'] = "Weight Management";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "weight_management";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

    }

    

    public function get_dimension(){

        $product_id=$_REQUEST['product_id'];

        $dimension_list=$this->product_model->get_dimension($product_id);

        $paper_type_list=$this->product_model->getPaperTypes($product_id);

        

        $return_data=array('status'=>true,'dimension_list'=>$dimension_list,'paper_type_list'=>$paper_type_list);

		echo json_encode($return_data);

	}



	public function get_product_weight_data(){

        $product_id=$_REQUEST['product_id'];
safe_str_replace(
        $paper_weight_list=$this->product_model->get_product_weight_data($product_id);

        $return_data=array('status'=>true,'paper_weight_list'=>$paper_weight_list);

		echo json_encode($return_data);

	}

	

	

	

	public function edit(){

		//echo '<pre>'; print_r($this->input->post());die;

		

		if(isset($_POST['edit'])){

			

			$this->form_validation->set_rules('product_id', 'Product ID', 'trim|required');

			$this->form_validation->set_rules('dimension[]', 'Dimension', 'trim|required');

			

			$dimension=$this->input->post('dimension');

			

			if($this->form_validation->run() != FALSE){

				$insert_data=array();

				for($i=0; $i < count($dimension); $i++){

				

					$insert_data = array(		

							

							'product_id'		=>	$this->input->post('product_id'),

							'dimension'		=>	$this->input->post('dimension')[$i],

							'master_printing_attribute_id'	=>	$this->input->post('master_printing_attribute_id')[$i],

							'weight'	=>	$this->input->post('weight')[$i],

							'height'	=>	$this->input->post('height')[$i],

							'sheets_count'		=> 	50,

							'created_on'		=>	date('Y-m-d H:i:s')

						);

						if($this->input->post('product_weight_id')[$i]){

							$this->product_model->update('product_weight',array('product_weight_id'=>$this->input->post('product_weight_id')[$i]),$insert_data);

						}

						else{

							$this->product_model->insert('product_weight',$insert_data);

						}

						

				}

				

				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Product weight added successfully');

			}

			else{

				

				$data['error'] = "Please fill up all the required fields";

				

			}

			redirect(base_url('admin/weight_management'));

		}

		else{

			

			$data['product_list'] = $this->product_model->Show_Products_admin();

			$data['page_title'] = "Weight Management";

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "weight_management";

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