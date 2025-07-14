<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Products extends MY_Controller {

	function __construct() {

        parent::__construct();

		$this->load->library(array('ion_auth'));

		$this->load->model('attribute_model');

		//$this->load->model('brand_model');

		$this->load->model('category_model');

		$this->load->model('product_model');

		if(!$this->ion_auth->logged_in())

		{

			redirect('auth', 'refresh');

		}

		else{

			$user = $this->ion_auth->user()->row();
        	if(!$this->ion_auth->is_admin($user->id)){
				redirect(base_url('auth/logout'));
			}
		}

		$this->_container = $this->config->item('bootsshop_template_dir_admin') . "layout.php";

        $this->_modules = $this->config->item('modules_locations');

        //log_message('debug', 'CI My Admin : Auth class loaded');

    }

	

	public function index()

	{

		$data = array();

		$data['productlist'] = $this->product_model->Show_Products();

		//echo "<pre>";print_r($data);exit();	

		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "products";

		$data['module'] = 'admin';		

		$this->load->view($this->_container, $data);

		

		//$this->session->unset_userdata('product_id');

		//$this->session->unset_userdata('image_id');

		//$this->session->unset_userdata('attribute_data');

		//redirect('admin/brands');

    }

	

	public function get_options($array, $parent=0, $indent="")

	{

		//$categorylist = $this->category_model->Show_Category(get_current_language());

		$return = array();

		$return1 = array();

		$a_return = array();

		foreach($array as $key => $val) {

			$temp_array = array();

			//echo $key."<br />";

		  if($val->parent_category == $parent) {

			//$return['id'][] = $val->id;

			$temp_array['id'] = $val->id;

			$temp_array['value'] = $indent.$val->category_name;

			//$return[] = $indent.$val->category_name;

			$return[] = $temp_array;

			//$return1[] = $this->get_options($array, $val->id, $indent."&nbsp;&nbsp;&nbsp;");

			$return = array_merge($return, $this->get_options($array, $val->id, $indent."&nbsp;&nbsp;&nbsp;"));

		  	//$a_return = array_merge($return,$return1);

		  }

		}

		return $return;

		exit() ; 

	}

	

	public function add()

	{

		$data = array();

		

		$categorylists = $this->category_model->Show_Category(get_current_language());

		//$data['categorylist']  = $categorylists;

		$categorylist            = $this->get_options($categorylists);

		

		$data['categorylist']  = $categorylist ;



		if ($this->input->post()) {

			$insert_data['product_name'] = $this->input->post('product_name');

			$insert_data['product_slug'] = url_title($this->input->post('product_name'), 'dash', true);

			$insert_data['base_price'] = "25.00";

			$insert_data['created_at'] = date('Y-m-d H:i:s');

			$insert_data['updated_at'] = date('Y-m-d H:i:s');

			//$insert_data['status'] = $this->input->post('product_status');

			$insert_data['status'] = 0;



			$product_id = $this->product_model->Insert_Products_data('tbl_products',$insert_data);

			$this->session->set_userdata('product_id', $product_id);



			redirect('admin/products/step2');

		}

	

		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "add_products";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function step2()

	{

		$data['printing_attributes'] = $this->product_model->get_printing_attributes();



		//echo "<pre>";print_r($data);die();



		$product_id = $this->session->userdata('product_id');



		if ($this->input->post()) {

			for ($i=0; $i < 10; $i++) { 

				$insert_data['product_id'] = $product_id;

				if (isset($this->input->post('dimensions')[$i])) {

					$insert_data['dimension'] = $this->input->post('dimensions')[$i];

				}else{

					$insert_data['dimension'] = "";

				}

				if (isset($this->input->post('page_type')[$i])) {

					$insert_data['paper_type_group_id'] = $this->input->post('page_type')[$i];

				}else{

					$insert_data['paper_type_group_id'] = "";

				}

				if (!empty($insert_data['paper_type_group_id']) || !empty($insert_data['dimension'])) {

					$product_attr_id[] = $this->product_model->Insert_Products_data('tbl_product_printing_attribute',$insert_data);

				}

			}

			redirect('admin/products/step3');

		}



		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "step2";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function step3()

	{

		$product_id = $this->session->userdata('product_id');

		$data['printing_attributes'] = $this->product_model->get_printing_product_attributes($product_id);



		if ($this->input->post()) {

			//9223372036854775807 for infinity

			//echo "<pre>";print_r($this->input->post());die();



			for ($i=0; $i < count($this->input->post('range_from')); $i++) { 

				$insert_data['product_id'] = $product_id;

				$insert_data['range_from'] = $this->input->post('range_from')[$i];

				$insert_data['range_to'] = $this->input->post('range_to')[$i] == 0 ? 9223372036854775807 : $this->input->post('range_to')[$i];

				$insert_data['dimension'] = $this->input->post('dimension')[$i];

				$insert_data['page_side'] = $this->input->post('page_side')[$i];

				$insert_data['price'] = $this->input->post('price')[$i];

				$insert_data['attr_type'] = 'printing';

				$this->product_model->Insert_Products_data('tbl_product_printing_price',$insert_data);

			}



			for ($i=0; $i < count($this->input->post('page_type')) ; $i++) { 

				$insert_data1['product_id'] = $product_id;

				$insert_data1['page_type'] = $this->input->post('page_type')[$i];

				$insert_data1['dimension'] = $this->input->post('page_dimension')[$i];

				$insert_data1['price'] = $this->input->post('page_price')[$i];

				$insert_data1['paper_group_id'] = $this->input->post('paper_group_id')[$i];

				$insert_data1['attr_type'] = 'printing';

				$this->product_model->Insert_Products_data('tbl_product_printing_price',$insert_data1);

			}

			redirect('admin/products/step4');

		}



		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "step3";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function step4()

	{

		$product_id = $this->session->userdata('product_id');

		//$data['printing_attributes'] = $this->product_model->get_printing_product_attributes($product_id);

		$data['master_paper_group'] = $this->product_model->master_paper_group();

		if ($this->input->post()) {

			//9223372036854775807 for infinity

			//echo "<pre>";print_r($this->input->post());die();



			$insert_data['price'] = $this->input->post('divider_price');

			$insert_data['product_id'] = $product_id;

			$insert_data['attr_type'] = 'divider';



			$this->db->insert('tbl_product_finishing_price',$insert_data);



			$insert_data = array();



			for ($i=0; $i < count($this->input->post('stapling_type')) ; $i++) { 

				$insert_data['stapling_type'] = $this->input->post('stapling_type')[$i];

				$insert_data['page_side'] = $this->input->post('stapling_side')[$i];

				$insert_data['dimension'] = $this->input->post('stapling_dimension')[$i];

				$insert_data['range_from'] = $this->input->post('stapling_from')[$i];

				$insert_data['range_to'] = $this->input->post('stapling_to')[$i] == 0 ? 9223372036854775807 : $this->input->post('stapling_to')[$i];

				$insert_data['price'] = $this->input->post('stapling_price')[$i];

				$insert_data['product_id'] = $product_id;

				$insert_data['attr_type'] = 'stapling';



				$this->db->insert('tbl_product_finishing_price',$insert_data);

			}



			$insert_data = array();



			for ($i=0; $i < count($this->input->post('hole_side')) ; $i++) {

				$insert_data['page_side'] = $this->input->post('hole_side')[$i];

				$insert_data['dimension'] = $this->input->post('hole_dimension')[$i];

				$insert_data['price'] = $this->input->post('hole_price')[$i];

				$insert_data['product_id'] = $product_id;

				$insert_data['attr_type'] = 'hole';



				$this->db->insert('tbl_product_finishing_price',$insert_data);

			}



			$insert_data = array();



			for ($i=0; $i < count($this->input->post('page_types')); $i++) {

				$paper_type = $this->product_model->get_paper_types($this->input->post('page_types')[$i]);

				foreach ($paper_type as $key => $value) {

					for ($j=0; $j < count($this->input->post('folding_dimension')); $j++) {

						$insert_data['dimension'] = $this->input->post('folding_dimension')[$j];

						$insert_data['price'] = $this->input->post('folding_price');

						$insert_data['folding_paper_type'] = $this->input->post('folding_page_type');

						$insert_data['product_id'] = $product_id;

						$insert_data['attr_type'] = 'folding';

						$insert_data['paper_group_id'] = implode(",", $this->input->post('page_types'));

						$insert_data['paper_type'] = $value['attr_value'];



						$this->db->insert('tbl_product_finishing_price',$insert_data);

					}

				}

			}



			$this->db->insert('tbl_product_finishing_price',$insert_data);

			

			redirect('admin/products/step5');

		}



		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "step4";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function step5()

	{

		$product_id = $this->session->userdata('product_id');

		//echo $product_id;die(); 

		if(!empty ($_FILES['image']['name'])){

			$img_path = './uploads/products/' ;

			$moved =  move_uploaded_file($_FILES['image']['tmp_name'], $img_path .$_FILES['image']['name']);



			$image_data=$this->product_model->getRow('tbl_product_image',array('product_id'=>$product_id));

			

			if(empty($image_data)){

				$insert_data['product_id'] = $product_id;

				$insert_data['product_image'] = $_FILES['image']['name'];

				$this->product_model->Insert_Products_data('tbl_product_image',$insert_data);



				$update_data['status'] = 1;

				$this->db->where('product_id',$product_id);

				$this->db->update('tbl_products',$update_data);



				$this->session->unset_userdata('product_id');

				$this -> session -> set_flashdata('update_message','Product Inserted Successfully');



			}

			else{

				 

				$update_data['product_image'] = $_FILES['image']['name'];

				$this->db->where('product_id',$product_id);

				$this->db->update('tbl_product_image',$update_data);

				

				



				$update_data['status'] = 1;

				$this->db->where('product_id',$product_id);

				$this->db->update('tbl_products',$update_data); 



				$this->session->unset_userdata('product_id');

				$this -> session -> set_flashdata('update_message','Product Updated Successfully');





			}

			

			redirect('admin/products');

		}

		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "step5";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}

	

	

	public function edit(){



		$product_id = end($this->uri->segments);



		$categorylists = $this->category_model->Show_Category(get_current_language());

		$categorylist = $this->get_options($categorylists);



		$data['categorylist']  = $categorylist ;



		$data['product_details'] = $this->product_model->get_edit_product_details($product_id);



		if ($this->input->post()) {



			$update_array['product_name'] = $this->input->post('product_name');

			$update_array['product_slug'] = url_title($this->input->post('product_name'), 'dash', true);

			$update_array['status'] = $this->input->post('product_status');



			$this->db->where('product_id',$product_id);

			$this->db->update('tbl_products',$update_array);



			if ($this->input->post('complete')) {

				$this -> session -> set_flashdata('update_message','Product updated successfully');

				redirect('admin/products');

			} else {

				$this->session->set_userdata('product_id', $product_id);

				redirect('admin/products/edit_step2');	

			}

		}



		$data['page_title'] = "Edit Product";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "edit_products";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

	}



	public function edit_step2()

	{

		$product_id = $this->session->userdata('product_id');

		$data['printing_attributes'] = $this->product_model->get_printing_attributes();

		$data['product_printing_attribute'] = $this->product_model->get_product_printing_attribute($product_id);

		if ($this->input->post()) {

			$this->db->where('product_id',$product_id);

			$this->db->delete('tbl_product_printing_attribute');

			for ($i=0; $i < 10; $i++) { 

				$insert_data['product_id'] = $product_id;

				if (isset($this->input->post('dimensions')[$i])) {

					$insert_data['dimension'] = $this->input->post('dimensions')[$i];

				}else{

					$insert_data['dimension'] = "";

				}

				if (isset($this->input->post('page_type')[$i])) {

					$insert_data['paper_type_group_id'] = $this->input->post('page_type')[$i];

				}else{

					$insert_data['paper_type_group_id'] = "";

				}

				if (!empty($insert_data['paper_type_group_id']) || !empty($insert_data['dimension'])) {

					$product_attr_id[] = $this->product_model->Insert_Products_data('tbl_product_printing_attribute',$insert_data);

				}

			}

			redirect('admin/products/edit_step3');

		}



		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "edit_step2";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function edit_step3()

	{

		$product_id = $this->session->userdata('product_id');

		$data['printing_attributes'] = $this->product_model->get_edit_printing_product_attributes($product_id);

		$data['product_paper'] = $this->product_model->get_product_paper($product_id);
		
		$data['front_cover_data'] = $this->product_model->get_front_cover_data($product_id);
		
		$data['black_and_white_data'] = $this->product_model->get_black_and_white_data($product_id);
		
		$data['coil_binding_cost_data'] = $this->product_model->get_coil_binding_cost_data($product_id);
		

		if ($this->input->post()) {

			//9223372036854775807 for infinity

			//echo "<pre>";print_r($this->input->post());die();

			$this->db->where('product_id',$product_id);

			$this->db->delete('tbl_product_printing_price');
			
			$this->db->where('product_id',$product_id)->delete('tbl_back_cover');
			
			
			

			foreach($this->input->post('black_and_white')['range_from'] as $Key => $value){
				
				
				$insert_data_new['product_id'] = $product_id;

				$insert_data_new['range_from'] = $value;

				$insert_data_new['range_to'] = $this->input->post('black_and_white')['range_to'][$Key] == 0 ? 9223372036854775807 : $this->input->post('black_and_white')['range_to'][$Key];

				$insert_data_new['dimension'] = $this->input->post('black_and_white')['dimension'][$Key];

				$insert_data_new['page_side'] = $this->input->post('black_and_white')['page_side'][$Key];
				
				$insert_data_new['page_type'] = $this->input->post('black_and_white')['page_type'][$Key];

				$insert_data_new['price'] = $this->input->post('black_and_white')['price'][$Key];
				$insert_data_new['ink_type'] = $this->input->post('black_and_white')['ink_type'][$Key];

				$insert_data_new['attr_type'] = $this->input->post('black_and_white')['attr_type'][$Key];
				
				
				$this->product_model->insert_black_and_white_data('tbl_back_cover',$insert_data_new);
				
				
			}
			
			
			foreach($this->input->post('coil_binding_cost')['sheets'] as $Key => $value){
				
				$insert_data_new = [];
				
				
				$insert_data_new['product_id'] = $product_id;

				$insert_data_new['range_from'] = $this->input->post('coil_binding_cost')['range_from'][$Key];
				
				$insert_data_new['sheets'] = $this->input->post('coil_binding_cost')['sheets'][$Key];

				$insert_data_new['range_to'] = $this->input->post('coil_binding_cost')['range_to'][$Key] == 0 ? 9223372036854775807 : $this->input->post('coil_binding_cost')['range_to'][$Key];


				$insert_data_new['price'] = $this->input->post('coil_binding_cost')['price'][$Key];
				

				$insert_data_new['attr_type'] = $this->input->post('coil_binding_cost')['attr_type'][$Key];
								
				
				$this->product_model->insert_coil_binding_cost_data('tbl_back_cover',$insert_data_new);
				
				
			}
			
			
			for ($i=0; $i < count($this->input->post('front_cover_type')); $i++) { 
				
				$front_cover_data[$i]['product_id'] = $product_id;
				$front_cover_data[$i]['front_cover_type'] = $this->input->post('front_cover_type')[$i];
				$front_cover_data[$i]['price'] = $this->input->post('front_cover_price')[$i];
				$front_cover_data[$i]['attr_type'] = "front cover";
			
			}
			
			
			$this->product_model->Insert_front_cover_data('tbl_back_cover',$front_cover_data);
			
	

			for ($i=0; $i < count($this->input->post('range_from')); $i++) { 

				$insert_data['product_id'] = $product_id;

				$insert_data['range_from'] = $this->input->post('range_from')[$i];

				$insert_data['range_to'] = $this->input->post('range_to')[$i] == 0 ? 9223372036854775807 : $this->input->post('range_to')[$i];

				$insert_data['dimension'] = $this->input->post('dimension')[$i];

				$insert_data['page_side'] = $this->input->post('page_side')[$i];

				$insert_data['price'] = $this->input->post('price')[$i];

				$insert_data['attr_type'] = 'printing';

				$this->product_model->Insert_Products_data('tbl_product_printing_price',$insert_data);

			}



			for ($i=0; $i < count($this->input->post('page_type')) ; $i++) { 

				$insert_data1['product_id'] = $product_id;

				$insert_data1['page_type'] = $this->input->post('page_type')[$i];

				$insert_data1['price'] = $this->input->post('page_price')[$i];

				$insert_data1['dimension'] = $this->input->post('page_dimension')[$i];

				$insert_data1['paper_group_id'] = $this->input->post('paper_group_id')[$i];

				$insert_data1['attr_type'] = 'printing';

				$this->product_model->Insert_Products_data('tbl_product_printing_price',$insert_data1);

			}



			if ($this->input->post('complete')) {

				$this -> session -> set_flashdata('update_message','Product updated successfully');

				redirect('admin/products');

			} else {

				//$this->session->set_userdata('product_id', $product_id);

				redirect('admin/products/edit_step4');	

			}

		}



		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "edit_step3";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function edit_step4()

	{

		$product_id = $this->session->userdata('product_id');

		//echo $product_id;

		$data['finishing_attributes'] = $this->product_model->get_finishing_attributes($product_id);

		$data['master_paper_group'] = $this->product_model->master_paper_group();

		$data['folding'] = $this->product_model->get_folding_details($product_id);

		$folding_dimension = $this->product_model->get_folding_dimension($product_id);

		$folding_dimension_array = array();

		foreach ($folding_dimension as $key => $value) {

			$folding_dimension_array[] = $value['dimension'];

		}

		$data['folding_dimension'] = $folding_dimension_array;

		//echo "<pre>";print_r($data['folding_dimension']);die();



		if ($this->input->post()) {

			//9223372036854775807 for infinity



			//echo "<pre>";print_r($this->input->post());die();



			$this->db->where('product_id',$product_id);

			$this->db->delete('tbl_product_finishing_price');



			$insert_data['price'] = $this->input->post('divider_price');

			$insert_data['product_id'] = $product_id;

			$insert_data['attr_type'] = 'divider';



			$this->db->insert('tbl_product_finishing_price',$insert_data);



			$insert_data = array();



			for ($i=0; $i < count($this->input->post('stapling_type')) ; $i++) { 

				$insert_data['stapling_type'] = $this->input->post('stapling_type')[$i];

				$insert_data['page_side'] = $this->input->post('stapling_side')[$i];

				$insert_data['dimension'] = $this->input->post('stapling_dimension')[$i];

				$insert_data['range_from'] = $this->input->post('stapling_from')[$i];

				$insert_data['range_to'] = $this->input->post('stapling_to')[$i] == 0 ? 9223372036854775807 : $this->input->post('stapling_to')[$i];

				$insert_data['folding_paper_type'] = $this->input->post('stapling_page_type')[$i];

				$insert_data['price'] = $this->input->post('stapling_price')[$i];

				$insert_data['product_id'] = $product_id;

				$insert_data['attr_type'] = 'stapling';



				$this->db->insert('tbl_product_finishing_price',$insert_data);

			}



			$insert_data = array();



			for ($i=0; $i < count($this->input->post('hole_side')) ; $i++) {

				$insert_data['page_side'] = $this->input->post('hole_side')[$i];

				$insert_data['dimension'] = $this->input->post('hole_dimension')[$i];

				$insert_data['price'] = $this->input->post('hole_price')[$i];

				$insert_data['product_id'] = $product_id;

				$insert_data['attr_type'] = 'hole';



				$this->db->insert('tbl_product_finishing_price',$insert_data);

			}



			$insert_data = array();



			for ($i=0; $i < count($this->input->post('page_types')); $i++) {

				$paper_type = $this->product_model->get_paper_types($this->input->post('page_types')[$i]);

				foreach ($paper_type as $key => $value) {

					for ($j=0; $j < count($this->input->post('folding_dimension')); $j++) {

						$insert_data['dimension'] = $this->input->post('folding_dimension')[$j];

						$insert_data['price'] = $this->input->post('folding_price');

						$insert_data['folding_paper_type'] = $this->input->post('folding_page_type');

						$insert_data['product_id'] = $product_id;

						$insert_data['attr_type'] = 'folding';

						$insert_data['paper_group_id'] = implode(",", $this->input->post('page_types'));

						$insert_data['paper_type'] = $value['attr_value'];

						//echo "<pre>";print_r($insert_data);die();

						$this->db->insert('tbl_product_finishing_price',$insert_data);

						//echo $this->db->last_query();die();

					}

				}

			}



			if ($this->input->post('complete')) {

				$this -> session -> set_flashdata('update_message','Product updated successfully');

				redirect('admin/products');

			} else {

				//$this->session->set_userdata('product_id', $product_id);

				redirect('admin/products/edit_step5');	

			}

		}



		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "edit_step4";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



	public function edit_step5()

	{

		$product_id = $this->session->userdata('product_id');

		//echo $product_id;die();



		$data['product_image'] = $this->product_model->get_edit_product_image($product_id);



		//echo "<pre>";print_r($data);die();

		//echo "<pre>";print_r($this->input->post());die();



		if ($this->input->post()) {

			//echo "<pre>";print_r($this->input->post());die();

			if(!empty ($_FILES['image']['name'])){

				

				$img_path = './uploads/products/' ;

				$moved =  move_uploaded_file($_FILES['image']['tmp_name'], $img_path .$_FILES['image']['name']);	

			

				$image_data=$this->product_model->getRow('tbl_product_image',array('product_id'=>$product_id));

			

				if(empty($image_data)){	

				



					$insert_data['product_id'] = $product_id;

					$insert_data['product_image'] = $_FILES['image']['name'];

					$this->product_model->Insert_Products_data('tbl_product_image',$insert_data);



					$this->session->unset_userdata('product_id');

					$this -> session -> set_flashdata('update_message','Product updated successfully');

					redirect('admin/products');

			

				}

				else{

				 

				

				

					$update_data['product_image'] = $_FILES['image']['name'];

					$this->db->where('product_id',$product_id);

					$this->db->update('tbl_product_image',$update_data);

					

					$this->session->unset_userdata('product_id');

					$this -> session -> set_flashdata('update_message','Product Updated Successfully');

					redirect('admin/products');

	

				}

			

			

			}else{

				$this->session->unset_userdata('product_id');

				$this -> session -> set_flashdata('update_message','Product updated successfully');

				redirect('admin/products');

			}

		}

		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "edit_step5";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}

	

	public function getAttributeValue()

	{

		$id = $_POST['id'];

		$iid = $_POST['iid'];

		$type = $_POST['type'] ;

		$options = $_POST['option'] ;

		

		if($options == 'printing'){

        if($type == 'parent'){ 		

		$attribute = $this->attribute_model->Get_AttributeNameValue($id);

		echo '<select class="form-control selected_val" id="attr_val'.$iid.'" name="network[0][]">';

		foreach($attribute as $attributes)

		{

		echo '<option value="'.$attributes['value_id'].'">'.$attributes['value'].'</option>';	

		}

		echo '</select>';

		

		} elseif($type == 'child'){

		echo $id; 	

		$attributevalue = $this->attribute_model->Get_AttributeNameValue($id);

		echo '<select class="form-control selected_val" id="attr_val'.$iid.'" name="network[0][]">';

		foreach($attributevalue as $attributevalues)

		{

		echo '<option value="'.$attributevalues['value_id'].'">'.$attributevalues['value'].'</option>';	

		}

		echo '</select>';

		}

		} else if($options == 'finishing'){

		if($type == 'parent'){ 		

		$attribute = $this->attribute_model->Get_AttributeNameValue($id);

		echo '<select class="form-control selected_val" id="attr_val'.$iid.'" name="network[0][]">';

		foreach($attribute as $attributes)

		{

		echo '<option value="'.$attributes['value_id'].'">'.$attributes['value'].'</option>';	

		}

		echo '</select>';

		

		} elseif($type == 'child'){

		$attributevalue = $this->attribute_model->Get_AttributeNameValue($id);

		echo '<select class="form-control selected_val" id="attr_val'.$iid.'" name="network[0][]">';

		foreach($attributevalue as $attributevalues)

		{

		echo '<option value="'.$attributevalues['value_id'].'">'.$attributevalues['value'].'</option>';	

		}

		echo '</select>';

		}

	}	

		exit();

	}

	

	public function add_generalinfo()

	{

		// echo '<pre>';

		// print_r($this->input->post()) ; exit() ;

        $this->session->unset_userdata('product_id');	

		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');

		//$this->form_validation->set_rules('product_regular_price', 'Product Regular Price', 'trim|required');		

				

		if ($this->form_validation->run() != FALSE){

			

			$insert_data = array(					

			'product_name'		=>	$this->input->post('product_name'),

			'product_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('product_name')))),

			'sku'				=>	$this->input->post('product_sku'),

            'description'	    =>	$this->input->post('product_description'),			

			'status'			=>	$this->input->post('status'),						

			'created_at'		=>	date('Y-m-d H:i:s'),

			'updated_at'		=>	date('Y-m-d H:i:s')

			);

		

		  $product_id = $this->product_model->Insert_Products_data(TBL_PRODUCT , $insert_data); 

		   

		 //$this->session->set_userdata('product_id', $product_id);            

			//exit() ;			

			$a_category = $this->input->post('category');



			//echo "<pre>";print_r($a_category);exit();



			$category_data = array();

			foreach($a_category as $a_cat){

				$category_data[] = array(

						'product_id'		=>	$product_id,

						'category_id'		=>	$a_cat

					);

			}

			

			$this->product_model->Insert_Product_Category($category_data, 'add', $product_id);

			//$this->session->set_userdata('product_id', $product_id);

			echo $product_id;

			

		}		

	}

	

	public function edit_generalinfo(){		

        

		

		$product_id = $this->input->post('product_id');

		

		

		//print_r($this->input->post()) ;  exit() ; 

       	

			$update_data = array(					

			'product_name'		=>	$this->input->post('product_name'),

			'product_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($this->input->post('product_name')))),

			'sku'				=>	$this->input->post('product_sku'),

           'description'	    =>	$this->input->post('product_description'),		

			'status'			=>	$this->input->post('status'),						

			'created_at'		=>	date('Y-m-d H:i:s'),

			'updated_at'		=>	date('Y-m-d H:i:s')

			);

	

		$this->product_model->Update_Products($product_id, $update_data);

	

		echo 'success';

		

	}

	

	public function add_attributeValue(){

		

		if(null !==$this->input->post('pproduct_id') && $this->input->post('pproduct_id')!="" ){

			$product_id = $this->input->post('pproduct_id');

		} else {

			$product_id = $this->input->post('fproduct_id');	

		}

		//$product_id = 95;

	    //if(null !==$this->input->post('product_id') && $this->input->post('product_id')!="" ){

	   	if(null !==$product_id && $product_id!="" ){	   

		  

			$this->db->delete('tbl_product_variants', array('product_id' => $product_id,'attr_type'=>  $this->input->post('type')));

			

			$this->db->delete('tbl_product_range_price', array('product_id' => $product_id,'attr_type'=>  $this->input->post('type')));

			

		   //$product_id = $this->input->post('product_id');

	   	} else {

	   

	  		// $product_id = $this->session->userdata('product_id');

	   	}

	   	$attr_values = $this->input->post() ; 

      

        //echo '<pre>';	   

	   	//print_r($attr_values);	   

       	//exit() ;

	

	    foreach($attr_values['cnt'] as $key=>$counts){

	    	if (isset($attr_values['paper_type'])) {

	    		for( $i = 0 ;$i < count($attr_values['paper_type'][$key]);$i++ ){

				

					$attribute_data = array(

					'product_id'    =>	$product_id,

					'paper_type'  	=>  $this->input->post('paper_type')[$key] ,

					'number_of_side'=>  $this->input->post('number_of_side')[$key] ,

					'dimensions'  	=>  $this->input->post('dimensions')[$key] ,

					'attr_type'     =>  $this->input->post('type'),

					'status'		=>	1

					);

					//print_r($attribute_data);

					$product_varient_id = $this->product_model->Insert_Product_varient('tbl_product_variants' ,$attribute_data);

				}

	    	} else {

	    		for( $i = 0 ;$i < count($attr_values['divider_sheets'][$key]);$i++ ){

				

					$attribute_data = array(

					'product_id'    =>	$product_id,

					'divider_sheets'=>  $this->input->post('divider_sheets')[$key] ,

					'stapling'		=>  $this->input->post('stapling')[$key] ,

					'folding'  		=>  $this->input->post('folding')[$key] ,

					'collation'  	=>  $this->input->post('collation')[$key] ,

					'3_hole_punch'  =>  $this->input->post('hole_punch')[$key] ,

					'attr_type'     =>  $this->input->post('type'),

					'status'		=>	1

					);

					//print_r($attribute_data);

					$product_varient_id = $this->product_model->Insert_Product_varient('tbl_product_variants' ,$attribute_data);

				}

	    	}

			// echo '<pre>';

			//echo sizeof($attr_values['quantity_from'][$key][$i]) ; 

			

			for( $j = 0 ;$j < count($attr_values['quantity_from'][$key]);$j++ ){

				$attribute_rangedata = array(

				'product_id'          =>  $product_id,

				'product_varient_id'  =>  $product_varient_id,

				'attr_type'           =>  $this->input->post('type'),

				'range_from'          =>  $this->input->post('quantity_from')[$key][$j],

				'range_to'            =>  $this->input->post('quantity_to')[$key][$j]== 0 ? 9223372036854775807 : $this->input->post('quantity_to')[$key][$j],

				'price'		          =>  $this->input->post('price')[$key][$j]                   				

				);

				//print_r($attribute_rangedata) ; //exit() ; 

				$product_range_id  = $this->product_model->Insert_Product_varient('tbl_product_range_price' , $attribute_rangedata);

		    }

			

		}

		echo $product_id ; 

		// $this->session->unset_userdata('product_id');

	}

	

	

	public function edit_attributeValue(){

	/* 	

	  echo '<pre>';	   

	   print_r($this->input->post());	   

        exit() ;

		*/

		if($this->input->post('type') == 'printing'){

		$product_id = $this->input->post('product_id');	

		} else {

		$product_id = $this->input->post('fproduct_id');	

		}

	

		if(null !==$product_id && $product_id !="" ){

		  

			$this->db->delete('tbl_product_variants', array('product_id' => $product_id ,'attr_type'=>  $this->input->post('type')));

			

			$this->db->delete('tbl_product_range_price', array('product_id' => $product_id ,'attr_type'=>  $this->input->post('type') ));

			

	   } 

	  // $product_id = $this->input->post('fproduct_id');

	   $attr_values = $this->input->post() ;

	     

		

	

	      foreach($attr_values['cnt'] as $key=>$counts){

			for( $i = 0 ;$i < sizeof($attr_values['attribute'][$key]);$i++ ){

				

				$attribute_data = array(

				'product_id'    =>	 $product_id,

				'attribute_id'  =>  $this->input->post('attribute')[$key][$i] ,

				'attr_value_id' =>  $this->input->post('attribute_value')[$key][$i],

				'attr_type'     =>  $this->input->post('type'),

                'row_count'	     =>  count($attr_values['attribute'][$key]),			

				'status'		=>	1,

				'p_varient_group_id' => $product_id.'_'.$key .'_'.substr($this->input->post('type'), 0 , 1)

				);

			$product_varient_id = $this->product_model->Insert_Product_varient('tbl_product_variants' ,$attribute_data);

		}

			// echo '<pre>';

			// echo count($attr_values['quantity_from'][$key]) ; 

			

				 for( $j = 0 ;$j < count($attr_values['quantity_from'][$key]);$j++ ){

					$attribute_rangedata = array(

					'product_id'          =>  $product_id ,

					'product_varient_id'  =>  $product_varient_id  ,

					'c_varient_group_id'  =>  $product_id.'_'.$key .'_'.substr($this->input->post('type'), 0 , 1),

					'attr_type'           =>  $this->input->post('type'),

					'range_from'          =>  $this->input->post('quantity_from')[$key][$j],

					'range_to'            =>  $this->input->post('quantity_to')[$key][$j]== 0 ? 9223372036854775807 : $this->input->post('quantity_to')[$key][$j],

					'price'		          =>  $this->input->post('price')[$key][$j]                   				

					);

					

					//print_r($attribute_rangedata) ; exit() ; 

				 $product_range_id  = $this->product_model->Insert_Product_varient('tbl_product_range_price' , $attribute_rangedata);

				

			    }

			

		  }

	    echo $product_id;    

            // $this->session->unset_userdata('product_id');

	}

	

	

	public function add_product_image(){

		/* echo '<pre>';	   

	   print_r($this->session->userdata('product_id'));	   

        exit() ;

		*/

		if($this->input->post('product_id')){

		$product_id = $this->input->post('product_id');

		}else {

		$product_id = $this->session->userdata('product_id');

		}

		if(!empty ($_FILES['file']['name'])){

		$img_path = './uploads/products/' ;

		$moved =  move_uploaded_file($_FILES['file']['tmp_name'], $img_path .$_FILES['file']['name']);

		

		}

       

		$image_data = array(		

			'product_id'		=>	$product_id,			

			'product_image'		=>	$_FILES['file']['name']

			);

		$cnt =  $this->db->get_where('tbl_product_image',array('product_id'=>$product_id))->num_rows();

        if($cnt > 0 ){

		$id = $this->product_model->Insert_Product_Image($image_data, 'update', $product_id);	

		} else {		

		$id = $this->product_model->Insert_Product_Image($image_data, 'add', $product_id);

		}

		$temp_array = array(

			'id'	            =>	$id,

			'product_image'		=>	$img_path .$_FILES['file']['name'],

			'product_id'		=>	$product_id

		);

		

		$this->session->set_userdata('image_id', $id);

		

		echo json_encode($temp_array);

	}

	

	

	

	public function edit_product_image()

	{

		$id = $this->input->post('id');

		

		$data = array(

			'product_image'		=>	$this->input->post('image_url')

		);

		

		$result = $this->product_model->Update_Product_Image($id,$data);

		

		if($result)

		{

			$temp_array = array(

				'product_image'		=>	$this->input->post('image_url')

			);

			

			echo json_encode($temp_array);

		}

	}

	

	public function delete_product_image()

	{

		$id = $this->input->post('id');

		

		$result = $this->product_model->Delete_Product_Image($id);

		

		echo $result;

	}

	

	public function get_product_image()

	{

		$id = $this->input->post('id');

		

		$result = $this->product_model->Get_Product_Image($id);

		

		$temp_array = array(

			'product_image'		=>	$result[0]['product_image']

		);

		

		echo json_encode($temp_array);

		

		//echo $result;

	}

	

	public function productImageUpload()

	{

		$return_array = array();

		$returnval = 'false';

		$config['max_width'] = 500;

		$config['max_height'] = 500;

		$config['upload_path'] = './uploads/products/';

		$upload_root_path = 'uploads/products/';

		//$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|xlsx|xlt|xls|csv|doc|docx|GIF|PNG|JPG|JPEG|PDF';

		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|PNG|JPG|JPEG';

		$config['max_size'] = '20000';

		$config['remove_spaces'] = true;

		$config['overwrite'] = false;

		$this->upload->initialize($config);

		

		if (!$this->upload->do_upload('product_image'))

		{

			$error = array('error' => $this->upload->display_errors());

			//$data['error'] = $error;

			//$this -> session -> set_flashdata('update_message',$this->upload->display_errors());

			$returnval = 'false';

			$return_array = array('flag'=>$returnval,'msg'=>$this->upload->display_errors());

		}	

		else

		{

			$data['error'] = "success";

			$upload = array('upload_data' => $this->upload->data());

			$returnval = 'true';

			$return_array = array('flag'=>$returnval,'msg'=>$this->upload->display_errors());

			if($_POST['iflag'] == "insert")

			{

				$insert_data = array(		

					'product_id'	=>	$_POST['id'],

					'product_image'	=>	$upload_root_path.$upload['upload_data']['file_name'],

					'created_at'	=>	date('Y-m-d H:i:s'),

					'updated_at'	=>	date('Y-m-d H:i:s')

				);

				$this->product_model->Insert_Product_Images($insert_data);

			}

			else if($_POST['iflag'] == "update")

			{

				$update_data = array(

					'product_image'	=>	$upload_root_path.$upload['upload_data']['file_name'],

					'updated_at'	=>	date('Y-m-d H:i:s')

				);

				//$uploadData[$i]['product_image'] = $uploadPath.$fileData['file_name'];

				//$uploadData[$i]['created_at'] = date("Y-m-d H:i:s");

				//$uploadData[$i]['updated_at'] = date("Y-m-d H:i:s");

				$this->product_model->Update_Product_Images($_POST['id'],$update_data);

			}

			//$this->session->set_flashdata('update_message','<strong>Well done!</strong> Record inserted successfully.');

			

		}

		echo json_encode($return_array);

	}

	

	public function fileupload()

	{

		$uploadPath = 'uploads/products/';

		$files = $_FILES;

		$count = count($_FILES['userfile']['name']);

		//echo $count;

		for($i=0; $i<$count; $i++)

		{

			//$_FILES['userfile']['name']= time().$files['userfile']['name'][$i];

			$_FILES['userfile']['name'] = $files['userfile']['name'][$i];

			$_FILES['userfile']['type'] = $files['userfile']['type'][$i];

			$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];

			$_FILES['userfile']['error'] = $files['userfile']['error'][$i];

			$_FILES['userfile']['size'] = $files['userfile']['size'][$i];

			$config['upload_path'] = './uploads/products/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$config['max_size'] = '2000000';

			$config['remove_spaces'] = true;

			$config['overwrite'] = false;

			$config['max_width'] = '';

			$config['max_height'] = '';

			$this->load->library('upload', $config);

			$this->upload->initialize($config);

			//$this->upload->do_upload();

			if($this->upload->do_upload())

			{

				$fileData = $this->upload->data();

				$uploadData[$i]['product_id'] = $_POST['id'];

				$uploadData[$i]['product_image'] = $uploadPath.$fileData['file_name'];

				$uploadData[$i]['created_at'] = date("Y-m-d H:i:s");

				$uploadData[$i]['updated_at'] = date("Y-m-d H:i:s");

			}

			$fileName = $_FILES['userfile']['name'];

			$images[] = $fileName;

		}

		$fileName = implode(',',$images);

		$this->product_model->Insert_Product_Images($uploadData);

		echo $fileName;

		//$this->welcome->upload_image($this->input->post(),$fileName);

		//redirect('welcome/view');

	}

	

	public function editfileupload()

	{

		$uploadPath = 'uploads/products/';

		$files = $_FILES;

		

		$fileName = "";

		//print_r($_FILES['userfile']['name']);

		//exit();

		if($_FILES['userfile']['name'][0] !="")

		{

			//exit("1");

			$count = count($_FILES['userfile']['name']);

			for($i=0; $i<$count; $i++)

			{

				//$_FILES['userfile']['name']= time().$files['userfile']['name'][$i];

				$_FILES['userfile']['name'] = $files['userfile']['name'][$i];

				$_FILES['userfile']['type'] = $files['userfile']['type'][$i];

				$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];

				$_FILES['userfile']['error'] = $files['userfile']['error'][$i];

				$_FILES['userfile']['size'] = $files['userfile']['size'][$i];

				$config['upload_path'] = './uploads/products/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$config['max_size'] = '2000000';

				$config['remove_spaces'] = true;

				$config['overwrite'] = false;

				$config['max_width'] = '';

				$config['max_height'] = '';

				$this->load->library('upload', $config);

				$this->upload->initialize($config);

				//$this->upload->do_upload();

				if($this->upload->do_upload())

				{

					$fileData = $this->upload->data();

					//$uploadData[$i]['product_id'] = $_POST['id'];

					$uploadData[$i]['product_image'] = $uploadPath.$fileData['file_name'];

					//$uploadData[$i]['created_at'] = date("Y-m-d H:i:s");

					$uploadData[$i]['updated_at'] = date("Y-m-d H:i:s");

				}

				$fileName = $_FILES['userfile']['name'];

				$images[] = $fileName;

			}

			$fileName = implode(',',$images);

		

			$this->product_model->Update_Product_Images($_POST['id'],$uploadData[0]);

			//exit('1');

		}

		else

		{

			echo 1;

		}

		//echo $fileName;

		//$this->welcome->upload_image($this->input->post(),$fileName);

		//redirect('welcome/view');

	}

	

	 /* public function add_attributeValue(){   

		

	    //print_r($this->input->post()); exit();

		//$this->session->unset_userdata('product_id');

		$post_data = $this->input->post(); 	

		$temp_arr = $temp_arr1 = array();		



		$product_id = $msg = '';

		if(!empty($post_data['storage'])){		

			$product_id = $post_data['product_id'];	



			for($i=0; $i<count($post_data['storage']); $i++){		



			 $temp_arr['product_id'] 				= $product_id;

	         $temp_arr['attribute_value'] 			= $post_data['storage'][$i];

			 $temp_arr['condition'] 				= '' ;

			 //$temp_arr['condition'] 				= $post_data['condition'][$i];

			// $temp_arr['price'] 					= $post_data['price'][$i];

			 $temp_arr['price'] 					= '';

	         $temp_arr['created_at'] 				= date("Y-m-d H:i:s");

			 $temp_arr['updated_at'] 				= date("Y-m-d H:i:s");		 



			 $temp_arr1[] = $temp_arr; 		 			 

			} 

		}



		//echo "<pre>";print_r($temp_arr1);exit();

			

		if(!empty($temp_arr1)){

			$this->db->delete('tbl_product_variants', array('product_id'=> $product_id)); //delete variants of a particular product

			//$this->db->attribute_model->Insert_Attribute('tbl_product_variants', $temp_arr1);

			$this->db->insert_batch('tbl_product_variants', $temp_arr1); // Insert  batch

			$this->session->set_userdata('attribute_data' ,$product_id ) ; 

			$msg = 'success';

		}						



		echo $msg;

	}

	

	*/

	

	public function product_update()

	{

		$id = end($this->uri->segments);

		$productlist = $this->product_model->Show_Products();

		

		foreach($productlist as $productlists)

		{

			$update_data = array(		

				//'category_name'		=>	$this->input->post('category_name'),

				'product_slug'		=>	safe_str_replace(" ","-",strtolower($this->transliterateString($productlists->product_name))),

				'updated_at'		=>	date('Y-m-d H:i:s')

			);

			//echo $productlists->product_id;

			$this->product_model->Update_Products($productlists->product_id,$update_data);

		}

		

		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "products";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

	}

	

	

	

    public function delete_multiple_product(){

	

	foreach($this->input->post('product_id') as $id ){

	//echo $id ; 	

	$result = $this->product_model->Delete_Product($id);	

	}

    exit() ;	

	}

	

	public function delete()

	{

		$id = end($this->uri->segments);

		$result = $this->product_model->Delete_Product($id);

		

		if($result == true)

		{

			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');

			

		}

		else

		{

			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');

		}

		redirect(base_url().'admin/products/');

	}

	

	public function update_attr_val(){

		$data = $this->input->post();

		$this->product_model->update_attr_val($data);

		$this->session->set_userdata('step','step3');

		redirect(base_url('admin/products/edit/'.$data['product_id']));

	}

	

	public function get_product_content($id,$lang){		

		if($id != 0)

		{

			$result = $this->product_model->Get_Product_Content($id,$lang);			

			echo json_encode($result);

		}

	}

	

	function transliterateString($txt)

	{

		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');

    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);

	}



	public function delete_image(){

		$id = $this->input->post('image_id');

		$this->db->delete('tbl_product_image', array('id'=>$id));		

		echo "success";

	}



	public function tab_values($product_id)

	{

		$data = array();

		

		$data['tab_values'] = $this->product_model->get_tab_values($product_id);



		//echo "<pre>";print_r($tab_values);die();



		if ($this->input->post()) {



			//echo "<pre>";print_r($data['tab_values']);die();



			$product_tab = $this->input->post('product_tab');

			$faq_tab = $this->input->post('faq_tab');

			$specs_tab = $this->input->post('specs_tab');



			$data1 = array(

				'product' 			=> $product_tab,

				'faq' 				=> $faq_tab,

				'specs_templates'  	=> $specs_tab

			);



			if (empty($data['tab_values'])) {

				$data1['product_id'] = $product_id;

				$this->db->insert('tbl_product_tab_value',$data1);

			} else {

				$this->db->where('product_id',$product_id);

				$this->db->update('tbl_product_tab_value',$data1);

			}

			$this -> session -> set_flashdata('update_message','Product tab details saved successfully');

			redirect('admin/products');

		}

	

		$data['page_title'] = "Products";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "tab_values";

		$data['module'] = 'admin';

  

		$this->load->view($this->_container, $data);

	}



}

