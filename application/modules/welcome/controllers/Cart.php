<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(FCPATH . 'vendor/autoload.php');

class Cart extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		//$this->load->library(array('ion_auth'));
		$this->load->model('home_model');
		$this->load->model('cart_model');
		$this->load->model('admin/shipping_model');
		$this->load->helper('cookie');
		/*if(!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}*/
		//$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart.php";
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
		$this->_modules = $this->config->item('modules_locations');
		//log_message('debug', 'CI My Admin : Auth class loaded');
		//$this->product_name_rules = '\d\D';
		//$this->product_name_rules = '[:print:]';

	}

	public function index()
	{
		//$this->session->unset_userdata('product_details');
		//echo "<pre>"; print_r($this->cart->contents()); die();
		$data = array();
		$data['page_slug'] 		= end($this->uri->segments);
		$data['cart']                   = $this->cart_model->get_cart_details();
		$data['zip_code']               = $this->shipping_model->Show_shipping_price();

		$data['page_title'] 		= "Product Details";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "cart";
		$data['module'] 		= 'welcome';

		$cart_products 			= $this->cart->contents();


		$data['is_logged_in']   = $this->ion_auth->logged_in();
		$data['user_id']   = $this->ion_auth->get_user_id();
		$data['cart_products'] 			= $cart_products;
		$data['cart_sub_total'] 		= $this->cart->total();
		$this->load->view($this->_container, $data);
	}
	
	

	public function index1()
	{
		//$this->session->unset_userdata('product_details');
		//echo "<pre>"; print_r($this->cart->contents()); die();
		$data = array();
		$data['page_slug'] 		= end($this->uri->segments);
		$data['cart']                   = $this->cart_model->get_cart_details();
		$data['zip_code']               = $this->shipping_model->Show_shipping_price();

		$data['page_title'] 		= "Product Details";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "cart_updated";
		$data['module'] 		= 'welcome';

		$cart_products 			= $this->cart->contents();
		$data['is_free_shipping'] = false;
		foreach($cart_products as $cart){
			if($cart['shipping_type'] == 'free'){
				$data['is_free_shipping'] = true;
				break;
			}
		}

		$data['is_logged_in']   = $this->ion_auth->logged_in();
		$data['user_id']   = $this->ion_auth->get_user_id();
		$data['cart_products'] 			= $cart_products;
		$data['cart_sub_total'] 		= $this->cart->total();
		
		$this->load->view($this->_container, $data);
	}
	
	public function asd()
	{
		//echo "<pre>"; print_r($this->cart->contents()); die();
	}
	//Add to cart
	public function add_to_cart()
	{
		//echo '<pre>';print_r($this->input->post());
		//print_r($_FILES);die;
		$printing_details = "";
		$finishing_details = "";
		
		
		$extra_data = unserialize(base64_decode($this->input->post('extra_data')));
		
		if ($this->input->post()) {
			
			$cart_item = $this->input->post();

			if (!$this->input->post('full_bleed')) {
				$cart_item['full_bleed'] = '';
			}
			if (!$this->input->post('sides')) {
				$cart_item['sides'] = '';
			}
			if (!$this->input->post('orientation')) {
				$cart_item['orientation'] = '';
			}

			//echo"<pre>";print_r($this->cart->contents());
			//echo "<pre>";print_r($cart_item);die();

			foreach ($this->cart->contents() as $cart_contents) {

				if ($cart_contents['product_id'] == $cart_item['product_id']) {

					$this->cart->remove($cart_contents['rowid']);
				}
			}


			$copies = $cart_item['copies'];
			$pages = $cart_item['pages'];


			$printing_details .= "Dimensions||" . $cart_item['dimensions'] . ",";
			$printing_details .= "Paper Type||" . $cart_item['paper_type'] . ",";
			
			if($cart_item['product_id'] == "117"){
			$printing_details .= "No Of Sides||" . $extra_data['no_of_sides']. ",";	
			$printing_details .= "Color Type||" . $extra_data['color_inside_pages']. ",";
			$printing_details .= "Full Bleed||" . $extra_data['full_bleed']. ",";
			
			if($extra_data['front_cover_req'] != "no"){
			$printing_details .= "Front Cover||" . $extra_data['front_cover_req']. ",";
			$printing_details .= "Front Cover Sides||" . $extra_data['front_cover_sides']. ",";
			$printing_details .= "Front Cover Color||" . $extra_data['front_cover_color']. ",";
			$printing_details .= "Front Cover Paper Type||" . $extra_data['front_cover_paper_type']. ",";
			$printing_details .= "Front Cover Bleed||" . $extra_data['front_cover_full_bleed']. ",";
			}else{
				
				$printing_details .= "Front Cover||" . $extra_data['front_cover_req']. ",";
			}
			
			if($extra_data['back_cover_check'] != "no"){
			
			$printing_details .= "Back Cover||" . $extra_data['back_cover_check']. ",";
			$printing_details .= "Back Cover Sides||" . $extra_data['back_cover_sides']. ",";
			$printing_details .= "Back Cover Color||" . $extra_data['back_cover_color_type']. ",";
			$printing_details .= "Back Cover Paper Type||" . $extra_data['back_cover_paper_type']. ",";
			$printing_details .= "Back Cover Bleed||" . $extra_data['back_cover_full_bleed']. ",";
			
			}else{
				
				$printing_details .= "Back Cover||" . $extra_data['back_cover_check']. ",";
			}
			
			$printing_details .= "Front Cover Option||" . $extra_data['front_cover_option']. ",";
			$printing_details .= "Back Cover Option||" . $extra_data['back_cover_option'];
					
			}else{
				
				if(!empty($cart_item['no_of_sides'])){
				
				$printing_details .= "No Of Sides||" . $cart_item['no_of_sides'];
				}
			}

			if ($cart_item['no_of_sides'] == '2-sided' && !empty($cart_item['sides']) && !empty($cart_item['orientation'])) {
				$printing_details .= ",Sides||" . $cart_item['sides'];
				$printing_details .= ",Orientation||" . $cart_item['orientation'];
			}

			if ($cart_item['digital_proof'] == 1) {
				$digital_proof = 'Yes';
			} else {
				$digital_proof = 'No';
			}

			$finishing_details .= "Need To See Digital Proof||" . $digital_proof . ",";

			if (!empty($cart_item['divider_sheets'])) {
				$finishing_details .= "Divider Sheets||" . $cart_item['divider_sheets'] . ",";
			}

			if (!empty($cart_item['stapling'])) {
				$finishing_details .= "Stapling||" . $cart_item['stapling'] . ",";
			}

			if (!empty($cart_item['folding'])) {
				$finishing_details .= "Folding||" . $cart_item['folding'] . ",";
			}

			if (!empty($cart_item['collation'])) {
				$finishing_details .= "Collation||" . $cart_item['collation'] . ",";
			}

			if (!empty($cart_item['hole_punch'])) {
				$finishing_details .= "3 Hole Punch||" . $cart_item['hole_punch']. ",";
			}

			if (!empty($cart_item['full_bleed'])) {
				$finishing_details .= "Full Bleed||" . $cart_item['full_bleed'];
			}

			if ($this->input->post('image_name_hidden')) {
				$upload_file = rtrim($this->input->post('image_name_hidden'), '||');
			} else {
				$upload_file = rtrim($this->session->userdata('uploaded_image'), '||');
			}
			// if(!empty($_FILES['file-upload']['name'][0])){

			// 	$path = './uploads/files/';
			// 	$upload_file = $this->upload_Product_images($path,$_FILES['file-upload'],$cart_item['product_id']);

			// 	if($upload_file === FALSE) {
			// 	 	$this->session->set_flashdata('error_msg',$this->upload->display_errors());
			// 	 	// redirect(base_url('product-image-upload/'.$this->uri->segment(2)));
			// 	}      
			// }
			
			
			if($cart_item['product_id'] == "117" || $cart_item['product_id'] == "116"){
				
				$insert_data = array(
				'user_id'			=> ($this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : ''),
				'id' 				=> $cart_item['product_id'],
				'product_id' 		=> $cart_item['product_id'],
				'name' 				=> $this->home_model->get_val('tbl_products', 'product_id', $cart_item['product_id'], 'product_name'),
				//'image'             => $_FILES['file-upload']['name'],
				'image'             => $upload_file,
				'price' 			=> $cart_item['product_total'],
				'price_page' 		=> $cart_item['product_page_price'],
				'finishing_details' => $finishing_details,
				'paper_type_id' 	=> $this->input->post('paper_type_id'),
				'dimensions'		=> $this->input->post('dimensions'),
				'copies' 			=> $copies,
				'pages' 			=> $pages,
				'qty' 				=> 1,
				'status'            => 1,
				'digital_proof'     => $cart_item['digital_proof'],
				'product_slug'		=> $cart_item['product_slug'],
				'no_of_sides'		=> $cart_item['no_of_sides'],
				'priniting_details' 	=> $printing_details,
				'divider_sheets'	=> "",
				'stapling'			=> "",
				'folding'			=> "",
				'collation'			=> "",
				'hole_punch'		=> "",
				'full_bleed'		=> "",
				'sides'				=> $cart_item['sides'],
				'orientation'		=> $cart_item['orientation']
			);
				
			}else{
				
				$insert_data = array(
				'user_id'			=> ($this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : ''),
				'id' 				=> $cart_item['product_id'],
				'product_id' 		=> $cart_item['product_id'],
				'name' 				=> $this->home_model->get_val('tbl_products', 'product_id', $cart_item['product_id'], 'product_name'),
				//'image'             => $_FILES['file-upload']['name'],
				'image'             => $upload_file,
				'price' 			=> $cart_item['product_total'],
				'price_page' 		=> $cart_item['product_page_price'],
				'priniting_details' => $printing_details,
				'finishing_details' => $finishing_details,
				'paper_type_id' 	=> $this->input->post('paper_type_id'),
				'dimensions'		=> $this->input->post('dimensions'),
				'copies' 			=> $copies,
				'pages' 			=> $pages,
				'qty' 				=> 1,
				'status'            => 1,
				'digital_proof'     => $cart_item['digital_proof'],
				'product_slug'		=> $cart_item['product_slug'],
				'no_of_sides'		=> $cart_item['no_of_sides'],
				'divider_sheets'	=> $cart_item['divider_sheets'],
				'stapling'			=> $cart_item['stapling'],
				'folding'			=> $cart_item['folding'],
				'collation'			=> $cart_item['collation'],
				'hole_punch'		=> $cart_item['hole_punch'],
				'full_bleed'		=> $cart_item['full_bleed'],
				'sides'				=> $cart_item['sides'],
				'orientation'		=> $cart_item['orientation']
			);
				
			}

			
			//echo"<pre>";print_r($insert_data);die;
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($insert_data);
			$this->session->set_userdata('uploaded_image', '');
			//echo"<pre>";print_r($this->cart->contents()); exit(); 
			redirect('cart');
		}
	}

	//sandy 14-05-2021
	public function add_to_cart_new()
	{
		//echo '<pre>';print_r($this->input->post());//die;
		//print_r($_FILES);die;
		$printing_details = "";
		$finishing_details = "";
		
		
		$extra_data = unserialize(base64_decode($this->input->post('extra_data')));
		//print_r($extra_data);die;
		if ($this->input->post()) {
			
			$cart_item = $this->input->post();

			if (!$this->input->post('full_bleed')) {
				$cart_item['full_bleed'] = '';
			}
			if (!$this->input->post('sides')) {
				$cart_item['sides'] = '';
			}
			if (!$this->input->post('orientation')) {
				$cart_item['orientation'] = '';
			}

			
			$id = count($this->cart->contents());//sandy 02-04-2021
			/*if(!empty($this->input->post('row_id'))){
				foreach ($this->cart->contents() as $cart_contents) {

					if ($cart_contents['rowid'] == $this->input->post('row_id')) {
						$id = $cart_content['id']
						
						$this->cart->remove($cart_contents['rowid']);
					}
				}
			}*/

			$copies = $cart_item['copies'];
			$pages = $cart_item['pages'];


			$printing_details .= "Dimensions||" . $cart_item['dimensions'] . ",";
			$printing_details .= "Paper Type||" . $cart_item['paper_type'] . ",";
			
			if($cart_item['product_id'] == "117"){
			$printing_details .= "No Of Sides||" . $extra_data['no_of_sides']. ",";	
			$printing_details .= "Color Type||" . $extra_data['color_inside_pages']. ",";
			$printing_details .= "Full Bleed||" . $extra_data['full_bleed']. ",";
			
			if($extra_data['front_cover_req'] != "no"){
			$printing_details .= "Front Cover||" . $extra_data['front_cover_req']. ",";
			$printing_details .= "Front Cover Sides||" . $extra_data['front_cover_sides']. ",";
			$printing_details .= "Front Cover Color||" . $extra_data['front_cover_color']. ",";
			$printing_details .= "Front Cover Paper Type||" . $extra_data['front_cover_paper_type']. ",";
			$printing_details .= "Front Cover Bleed||" . $extra_data['front_cover_full_bleed']. ",";
			}else{
				
				$printing_details .= "Front Cover||" . $extra_data['front_cover_req']. ",";
			}
			
			if($extra_data['back_cover_check'] != "no"){
			
			$printing_details .= "Back Cover||" . $extra_data['back_cover_check']. ",";
			$printing_details .= "Back Cover Sides||" . $extra_data['back_cover_sides']. ",";
			$printing_details .= "Back Cover Color||" . $extra_data['back_cover_color_type']. ",";
			$printing_details .= "Back Cover Paper Type||" . $extra_data['back_cover_paper_type']. ",";
			$printing_details .= "Back Cover Bleed||" . $extra_data['back_cover_full_bleed']. ",";
			
			}else{
				
				$printing_details .= "Back Cover||" . $extra_data['back_cover_check']. ",";
			}
			
			$printing_details .= "Front Cover Option||" . $extra_data['front_cover_option']. ",";
			$printing_details .= "Back Cover Option||" . $extra_data['back_cover_option'];
					
			}else{
				
				if(!empty($cart_item['no_of_sides'])){
				
				$printing_details .= "No Of Sides||" . $cart_item['no_of_sides'];
				}
			}

			if ($cart_item['no_of_sides'] == '2-sided' && !empty($cart_item['sides']) && !empty($cart_item['orientation'])) {
				$printing_details .= ",Sides||" . $cart_item['sides'];
				$printing_details .= ",Orientation||" . $cart_item['orientation'];
			}

			if ($cart_item['digital_proof'] == 1) {
				$digital_proof = 'Yes';
			} else {
				$digital_proof = 'No';
			}

			$finishing_details .= "Need To See Digital Proof||" . $digital_proof . ",";

			if (!empty($cart_item['divider_sheets'])) {
				$finishing_details .= "Divider Sheets||" . $cart_item['divider_sheets'] . ",";
			}

			if (!empty($cart_item['stapling'])) {
				$finishing_details .= "Stapling||" . $cart_item['stapling'] . ",";
			}

			if (!empty($cart_item['folding'])) {
				$finishing_details .= "Folding||" . $cart_item['folding'] . ",";
			}

			if (!empty($cart_item['collation'])) {
				$finishing_details .= "Collation||" . $cart_item['collation'] . ",";
			}

			if (!empty($cart_item['hole_punch'])) {
				$finishing_details .= "3 Hole Punch||" . $cart_item['hole_punch']. ",";
			}

			if (!empty($cart_item['full_bleed'])) {
				$finishing_details .= "Full Bleed||" . $cart_item['full_bleed'];
			}

			if ($this->input->post('image_name_hidden')) {
				$upload_file = rtrim($this->input->post('image_name_hidden'), '||');
			} else {
				$upload_file = rtrim($this->session->userdata('uploaded_image'), '||');
			}
			// if(!empty($_FILES['file-upload']['name'][0])){

			// 	$path = './uploads/files/';
			// 	$upload_file = $this->upload_Product_images($path,$_FILES['file-upload'],$cart_item['product_id']);

			// 	if($upload_file === FALSE) {
			// 	 	$this->session->set_flashdata('error_msg',$this->upload->display_errors());
			// 	 	// redirect(base_url('product-image-upload/'.$this->uri->segment(2)));
			// 	}      
			// }
			//$this->input->post('shipping_type');
			
			if($cart_item['product_id'] == "117" || $cart_item['product_id'] == "116"){
				
				$insert_data = array(
					'user_id'			=> ($this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : ''),
					//'id' 				=> $id, //$cart_item['product_id'],
					//'product_id' 		=> $cart_item['product_id'],
					'name' 				=> $this->home_model->get_val('tbl_products', 'product_id', $cart_item['product_id'], 'product_name'),
					//'image'             => $_FILES['file-upload']['name'],
					'image'             => $upload_file,
					'price' 			=> $cart_item['product_total'],
					'price_page' 		=> $cart_item['product_page_price'],
					'finishing_details' => $finishing_details,
					'paper_type_id' 	=> $this->input->post('paper_type_id'),
					'dimensions'		=> $this->input->post('dimensions'),
					'copies' 			=> $copies,
					'pages' 			=> $pages,
					'qty' 				=> 1,
					'status'            => 1,
					'digital_proof'     => $cart_item['digital_proof'],
					'product_slug'		=> $cart_item['product_slug'],
					'no_of_sides'		=> $cart_item['no_of_sides'],
					'priniting_details' 	=> $printing_details,
					'divider_sheets'	=> "",
					'stapling'			=> "",
					'folding'			=> "",
					'collation'			=> "",
					'hole_punch'		=> "",
					'full_bleed'		=> "",
					'sides'				=> $cart_item['sides'],
					'orientation'		=> $cart_item['orientation']
				);
				
			}else{
				
				$insert_data = array(
					'user_id'			=> ($this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : ''),
					//'id' 				=> $id, //$cart_item['product_id'],
					//'product_id' 		=> $cart_item['product_id'],
					'name' 				=> $this->home_model->get_val('tbl_products', 'product_id', $cart_item['product_id'], 'product_name'),
					//'image'             => $_FILES['file-upload']['name'],
					'image'             => $upload_file,
					'price' 			=> $cart_item['product_total'],
					'price_page' 		=> $cart_item['product_page_price'],
					'priniting_details' => $printing_details,
					'finishing_details' => $finishing_details,
					'paper_type_id' 	=> $this->input->post('paper_type_id'),
					'dimensions'		=> $this->input->post('dimensions'),
					'copies' 			=> $copies,
					'pages' 			=> $pages,
					'qty' 				=> 1,
					'status'            => 1,
					'digital_proof'     => $cart_item['digital_proof'],
					'product_slug'		=> $cart_item['product_slug'],
					'no_of_sides'		=> $cart_item['no_of_sides'],
					'divider_sheets'	=> $cart_item['divider_sheets'],
					'stapling'			=> $cart_item['stapling'],
					'folding'			=> $cart_item['folding'],
					'collation'			=> $cart_item['collation'],
					'hole_punch'		=> $cart_item['hole_punch'],
					'full_bleed'		=> $cart_item['full_bleed'],
					'sides'				=> $cart_item['sides'],
					'orientation'		=> $cart_item['orientation']
				);
				
			}
			//$insert_data['sales_tax'] = $insert_data['subtotal'] * SALES_TAX_PER;
			if($cart_item['shipping_type'] == 'pick'){
				$insert_data['shipping_type'] = $cart_item['shipping_type'];
				$insert_data['zip_code'] = '';
				$insert_data['ups_shipping'] = '';
				$insert_data['date'] = $cart_item['date'];
				$insert_data['completion_date'] = $cart_item['completion_date'];
				$insert_data['shipping_amount'] = '0.00';
				$insert_data['shipping_service_type'] = 'Pick up';
			}
			else{
				$insert_data['shipping_type'] = $cart_item['shipping_type'];
				$insert_data['zip_code'] = $cart_item['zip_code'];
				$insert_data['ups_shipping'] = $cart_item['ups_shipping'];
				$insert_data['date'] = $cart_item['date'];
				$insert_data['completion_date'] = $cart_item['completion_date'];
				$insert_data['shipping_amount'] = $cart_item['shipping_amount'];
				$insert_data['shipping_service_type'] = ($cart_item['shipping_type'] == 'free') ? 'Free Delivery' : $cart_item['shipping_service_type'];
			}

			
			//echo"<pre>";print_r($insert_data);//die;
			$this->cart->product_name_rules = '[:print:]';
			if(!empty($this->input->post('row_id'))){
				$insert_data['rowid'] = $this->input->post('row_id');
				$this->cart->update($insert_data);
			}else{
				$insert_data['id'] = $id;
				$insert_data['product_id'] = $cart_item['product_id'];
				$this->cart->insert($insert_data);
			}
			$this->session->set_userdata('uploaded_image', '');
			//echo"<pre>";print_r($this->cart->contents()); exit(); 
			//redirect('cart-new');
			redirect('cart'); //sandy 22-04-2021
		}
	}

	//Update cart 
	function update_cart()
	{

		$arr = $arr1 = array();

		foreach ($_POST['cart'] as $id => $qty) {
			$arr['rowid'] 	= $id;
			$arr['qty'] 	= $qty;

			$arr1[] = $arr;
		}
		$this->cart->update($arr1);

		//Cart table data
		$cart_products = $this->cart->contents();
		$arr = $arr1 = array();
		//echo "<pre>";print_r($cart_products); exit;
		foreach ($cart_products as $row) {

			//Update from cart
			if ($this->ion_auth->logged_in()) {

				$user_id = $this->ion_auth->get_user_id();
			}
		}

		redirect('cart');
	}

	public function update_cart_items()
	{

		$printing_details = "";
		$finishing_details = "";

		if ($this->input->post()) {
			$cart_item = $this->input->post();

			//echo "<pre>";print_r($cart_item);die();

			$copies = $cart_item['copies'];
			$pages = $cart_item['pages'];

			$printing_details .= "Dimensions||" . $cart_item['dimensions'] . ",";
			$printing_details .= "Paper Type||" . $cart_item['paper_type'] . ",";
			$printing_details .= "No Of Sides||" . $cart_item['no_of_sides'];

			if (!empty($cart_item['divider_sheets'])) {
				$finishing_details .= "Divider Sheets||" . $cart_item['divider_sheets'] . ",";
			}

			if (!empty($cart_item['stapling'])) {
				$finishing_details .= "Stapling||" . $cart_item['stapling'] . ",";
			}

			if (!empty($cart_item['folding'])) {
				$finishing_details .= "Folding||" . $cart_item['folding'] . ",";
			}

			if (!empty($cart_item['collation'])) {
				$finishing_details .= "Collation||" . $cart_item['collation'] . ",";
			}

			if (!empty($cart_item['hole_punch'])) {
				$finishing_details .= "3 Hole Punch||" . $cart_item['hole_punch'];
			}

			$insert_data = array(
				'rowid'  			=> $cart_item['rowid'],
				'user_id'			=> ($this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : ''),
				'id' 				=> $cart_item['product_id'],
				'product_id' 		=> $cart_item['product_id'],
				'name' 				=> $this->home_model->get_val('tbl_products', 'product_id', $cart_item['product_id'], 'product_name'),
				'image'             => $cart_item['product_image'],
				'price' 			=> $cart_item['total_amount'],
				'price_page' 		=> $cart_item['price_per_page'],
				'priniting_details' => $printing_details,
				'finishing_details' => $finishing_details,
				'copies' 			=> $copies,
				'pages' 			=> $pages,
				'qty' 				=> 1,
				'status'            => 1
			);
			$this->cart->update($insert_data);
		}
	}

	function update_total()
	{
		//$cart_data = $this->cart->contents()) ;
		$type = $this->input->post('type');
		if ($type == 'SHIPPING_PRICE' && null !== $this->input->post('shipping_id')) {
			$id = $this->input->post('shipping_id');
			//echo $id;die;
			//$zip_code = $this->home_model->get_val('shipping_price', 'zip_code' ,$id, 'zip_code');
			$price = $this->home_model->get_val('shipping_price', 'zip_code', $id, 'price');
			$zip_code = $id;
			//echo $price;die;
			$total = $price + $this->cart->total();
		}
		if ($type == 'ADDITIONAL_PRICE' && null !== $this->input->post('delivery_val')) {
			$price = $this->input->post('delivery_val');
			$total	= 	$this->input->post('delivery_val') +  $this->cart->total();
			$zip_code = 92121;
		}
		echo $total . '||' . $zip_code . '||' . $price . '||' . $this->input->post('delivery_val');
	}

	function delete_cart_item($rowid, $id)
	{
		$this->cart->remove($rowid);
		if ($this->ion_auth->logged_in()) {
			$user_id = 	$this->ion_auth->get_user_id();
			$this->db->where('id', $id);
			//$this->db->where('user_id', $user_id);
			$this->db->delete('tbl_cart');
		}
		//echo $this->db->last_query();exit;
		redirect('cart');
	}

	function delete_file()
	{
		$file_link = $this->input->post('file_link');
		$file_name = $this->input->post('file_name');
		
		$file_link_new = safe_str_replace('#', '', $file_link);
		$file_name_new = safe_str_replace('#', '', $file_name);

		//echo $file_link;die;
		if (file_exists($file_link_new)) {

			if (unlink($file_link_new)) {

				$uploaded_image = $this->session->userdata('uploaded_image');
				$uploaded_image_array = explode("||", $uploaded_image);
				if (($key = array_search($file_name, $uploaded_image_array)) !== false) {
					//echo 'aa';die;
					unset($uploaded_image_array[$key]);
				}

				$uploaded_image = implode('||', $uploaded_image_array);
				$this->session->set_userdata('uploaded_image', $uploaded_image);

				$return_data = array('status' => true, 'msg' => 'Document deleted successfully');
			} else {
				$return_data = array('status' => false, 'msg' => 'Document not deleted');
			}
		} else {

			$return_data = array('status' => false, 'msg' => 'Document not deleted');
		}


		echo json_encode($return_data);
	}

	function add_order()
	{

		//Logged in check
		if (!$this->ion_auth->logged_in()) {
			redirect(base_url('my-account/'), 'refresh');
		}

		$cart_products 			= $this->cart->contents();

		//Cart empty check
		if (empty($cart_products)) {
			redirect(base_url());
		}

		$cart_sub_total 		= $this->cart->total();

		//echo "<pre>";print_r($cart_products);exit();

		$arr = $arr1 = $order = $order_details = array();

		//Order table 
		$order_data['user_id'] 		= $this->ion_auth->get_user_id();
		$order_data['created_on'] 	= date('Y-m-d H:i:s');
		$order_data['updated_on'] 	= date('Y-m-d H:i:s');

		$this->db->insert('tbl_orders', $order_data);
		$order_id = $this->db->insert_id();

		//Order details table 
		foreach ($cart_products as $key => $value) {
			$order_details_data['order_id'] 			= $order_id;
			$order_details_data['product_id'] 			= $value['id'];
			$order_details_data['product_detail_id'] 	= 0;
			$order_details_data['qty'] 					= $value['qty'];
			$order_details_data['price'] 				= $value['price'];
			$order_details_data['product_attribute_value']		= $value['options']['product_attribute_value'];

			$arr[] 	= $order_details_data;

			/* Stock qty minus */
			$update_arr = array('minus_qty' => $value['qty'], 'product_id' => $value['id']);
			$this->home_model->update_stock($update_arr);
		}

		$this->db->insert_batch('tbl_order_details', $arr);
		$this->db->where('user_id', $this->ion_auth->get_user_id());
		$this->db->delete('tbl_cart');

		$this->cart->destroy();
		$this->session->unset_userdata('product_data');
		redirect('cart');
	}

	public function order_details()
	{
		$data['page_title'] 			= "Product Details";
		$data['page'] 					= $this->config->item('bootsshop_template_dir_welcome') . "order_list";
		$data['module'] 				= 'welcome';
		$cart_products 				    = $this->cart->contents();
	}

	public function get_product_price()
	{

		$product_id = $_POST['productid'];
		$attribute_value = "Ancho:" . $_POST['ancho'] . ",Alto:" . $_POST['alto'] . ",Rin:" . $_POST['rin'];
		$result = $this->cart_model->getProductDetails($product_id, $attribute_value);
		echo json_encode($result);
		//echo $query;
	}

	// Cart Checkout
	public function checkout()
	{
		if (null !== $this->input->post('payment_type')) {
			$this->session->set_userdata('payment_type', $this->input->post('payment_type'));
		}

		$cart_products = $this->cart->contents();
		//Cart empty check
		if (empty($cart_products)) {
			redirect(base_url());
		}

		$user_id = 	$this->ion_auth->get_user_id();

		$data = array();
		$data['page_slug'] 				= end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		$data['category_list']  = $this->home_model->getAllCategory(); //category list
		$data['shipping_address'] 	= $this->home_model->get_address_details($user_id, 'shipping');
		$data['billing_address'] 	= $this->home_model->get_address_details($user_id, 'billing');

		$data['country_list'] 		= $this->home_model->get_country_list();

		$data['shipping_state_list'] = array();
		$data['shipping_city_list']  = array();
		$data['billing_state_list']  = array();
		$data['billing_city_list']   = array();

		if (!empty($data['shipping_address'])) {

			$data['shipping_state_list'] = $this->home_model->get_state_list($data['shipping_address']['country_id']);
			$data['shipping_city_list']  = $this->home_model->get_city_list($data['shipping_address']['state_id']);
		}

		if (!empty($data['billing_address'])) {

			$data['billing_state_list'] = $this->home_model->get_state_list($data['billing_address']['country_id']);
			$data['billing_city_list']  = $this->home_model->get_city_list($data['billing_address']['state_id']);
		}

		$data['cart_products'] 			= $this->cart->contents();
		$data['cart_sub_total'] 		= $this->cart->total();

		$data['page_title'] = "Cart Checkout";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "checkout";
		$data['module'] = 'welcome';

		//echo "<pre>";print_r($data);exit();
		$this->load->view($this->_container, $data);
	}

	// checkout post   
	public function checkout_post()
	{
		//Add to order table 
		//Logged in check	
		$input_data['user_data'] = $this->input->post();


		if ($this->input->post('acount_type') != 'guest') {
			if (!$this->ion_auth->logged_in()) {

				redirect(base_url('login/'), 'refresh');
			}
		} else {

			$data = array(
				'username' => 'GUEST',
				'email'	=> $input_data['user_data']['email']

			);

			$get_user_id = $this->home_model->Insert_UserData($data);
		}
		/* cart details */ ////
		$cart_products 			= $this->cart->contents();
		$cart_grand_total 		= $this->cart->total();


		$arr = $arr1 = $order_data = $order_details = array();

		//Order table 
		$order_data['user_id'] 		= $this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : $get_user_id;
		$order_data['total_price'] 	= $cart_grand_total;
		$order_data['created_on'] 	= date('Y-m-d H:i:s');

		//echo "<pre>";print_r($order_data);exit();

		$this->db->insert('tbl_orders', $order_data);
		$order_id = $this->db->insert_id();
		$input_data['order_id'] = $order_id;
		//Order details table 

		// echo "<pre>";print_r($cart_products);exit();

		foreach ($cart_products as $key => $value) {
			if (isset($value['condition'])) {
				$condition = $value['condition'];
			} else {
				$condition = "";
			}
			if (isset($value['condi'])) {
				$condition = $value['condi'];
			} else {
				$condition = "";
			}
			if (isset($value['network'])) {
				$network = $value['network'];
			} else {
				$network = "";
			}
			if (isset($value['options']['product_attribute_value'])) {
				$attribute = $value['options']['product_attribute_value'];
			} else {
				$attribute = $value['product_attribute_value'];
			}
			$order_details_data	= array();
			$order_details_data['order_id'] 			= $order_id;
			$order_details_data['product_id'] 			= $value['product_id'];
			$order_details_data['qty'] 					= $value['qty'];
			$order_details_data['price'] 				= $value['price'];
			//	$order_details_data['product_attribute_value'] = $value['options']['product_attribute_value'];
			$order_details_data['product_attribute_value'] = $attribute;
			$order_details_data['imei_no'] = $value['imei_no'];
			$order_details_data['condi']             = $condition;
			$order_details_data['network']           = $network;

			/* Stock qty minus */

			/* $update_arr = array('minus_qty'=>$value['qty'], 'product_id'=>$value['product_id']);
			$this->home_model->update_stock($update_arr);	
			*/

			$arr[] 	= $order_details_data;
		}
		//echo time(); echo "<pre>"; echo $this->session->userdata('payment_type') ; print_r($input_data['order_id']);	exit() ;  	

		$this->db->insert_batch('tbl_order_details', $arr);
		// $this->db->where('user_id', $this->ion_auth->get_user_id());
		$this->db->where('user_id', $this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : $get_user_id);
		$this->db->delete('tbl_cart');

		//$this->cart->destroy();				

		//Add to address table 
		$data =  $this->input->post();
		$data['shipping']['user_id'] = $this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : $get_user_id;
		$data['billing']['user_id']  = $this->ion_auth->get_user_id() > 0 ? $this->ion_auth->get_user_id() : $get_user_id;

		$data['page_slug'] 				= end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		//echo "<pre>";print_r($data);exit();

		//$this->home_model->update_address($data); /* nneed here check */
		$rows = $this->home_model->number_rows('tbl_transaction');
		// $this->home_model->get_val('tbl_orders' , 'id' , $input_data['order_id'], $find_field) ,
		$insert_data = array(
			'transaction_no' => 'EU' . time() . $rows,
			'order_id'		 =>  $input_data['order_id'],
			'amount'		 =>  $this->home_model->get_val('tbl_orders', 'id', $input_data['order_id'], 'total_price'),
			'type'          =>  $this->session->userdata('payment_type'),
			'student_first_name'          =>  $input_data['user_data']['first_name'],
			'student_last_name'          =>  $input_data['user_data']['last_name'],
			'phone'          =>  $input_data['user_data']['phone'],
			'email'          =>  $input_data['user_data']['email'],
			'country'       =>  $this->home_model->get_val('countries', 'id', $input_data['user_data']['country'], 'name'),
			'state'         =>  $this->home_model->get_val('states', 'country_id', $input_data['user_data']['state'], 'name'),
			'city'         =>  $input_data['user_data']['city'],
			'zipcode'         =>  $input_data['user_data']['zip_code'],
			'address'         =>  $input_data['user_data']['address'],
			'status'      => '',
			'description' => $input_data['user_data']['seler_type'],
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('tbl_transaction', $insert_data);
		$tbl_transaction = $this->db->insert_id();
		$this->session->set_userdata('transaction_id',  $tbl_transaction);
		if ($this->session->userdata('payment_type')  == 'CHEQUE') {

			redirect(base_url('placeorder_confirmation'));
		} else {

			redirect(base_url('bank_transfer'));
			// redirect(base_url('cart/paypal_post'));		
		}
	}

	public function cheque_order()
	{
		$data = array();
		$data['page_slug'] 				= end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list
		$data['transaction_id']         = $this->home_model->get_val('tbl_transaction', 'id', $this->session->userdata('transaction_id'), 'transaction_no');
		$data['page_title'] 	= "Cheque";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "payment_type";
		$data['module'] 		= 'welcome';

		$transaction_data = $this->db->get_where('tbl_transaction', array('transaction_no' => $data['transaction_id']))->result_array();
		if ($transaction_data) {
			foreach ($transaction_data as $data) {
				$tran_id =  $data['transaction_no'];
				$name    =  $data['student_first_name'] . ' ' . $data['student_last_name'];
				$mail_id =  $data['email'];
				$amount =   $data['amount'];
				$date 	=  date('Y-m-d H:i:s', strtotime($data['created_at'] . ' +2 day'));
			}
			$subject = 'Euromobile  Welcomes you !';
			$message = "<html>
					<head>
					<title>Welcome to Euromobile</title>
					</head>
					<body>
					<p>Hello  " . $name . ",</p>
					<p>&nbsp;</p>
					<p>You have successfully placed your order <br/> Your Order NO " . $tran_id . " </p>
					<p>Selling Price £ " . $amount . " </p>
					<p> Your amount will be paid  within " . $date . "</p> 
					<p>Thank you for choosing Euromobiles </p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Euromobile Team</p>
					</body>
					</html>";
			$this->email->set_mailtype("html");
			$this->email->to($mail_id);
			//$this->email->to('jayanta.saha@met-technologies.com');		
			$this->email->from('jayanta.saha@met-technologies.com', 'Euromobiles');
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
		}

		$this->cart->destroy();
		$this->session->unset_userdata('transaction_id');

		$this->load->view($this->_container, $data);
	}
	public function bank_order()
	{

		$data = array();

		$transaction_id =  $this->home_model->get_val('tbl_transaction', 'id', $this->session->userdata('transaction_id'), 'transaction_no');

		if ($this->input->post('account_no') != ""  && $this->input->post('account_name') != "" &&  $this->input->post('short_code') != "") {


			$insert_data = array(
				'transaction_id' => $transaction_id,
				'account_name'	 => $this->input->post('account_name'),
				'account_no'	 => $this->input->post('account_no'),
				'short_code'     => $this->input->post('short_code'),
				'created_at'	=> date('Y-m-d H:i:s')
			);

			$this->db->insert('tbl_payment_details', $insert_data);
			$tbl_transaction = $this->db->insert_id();
			if ($tbl_transaction != "") {

				$transaction_data = $this->db->get_where('tbl_transaction', array('transaction_no' => $transaction_id))->result_array();
				$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
				foreach ($transaction_data as $tdata) {
					$tran_id =  $tdata['transaction_no'];
					$name    =  $tdata['student_first_name'] . ' ' . $tdata['student_last_name'];
					$mail_id =  $tdata['email'];
					$amount =   $tdata['amount'];
					$date 	=  date('Y-m-d H:i:s', strtotime($tdata['created_at'] . ' +2 day'));
				}
				/********************************  mail system ************************/
				//	$mail_id = 'jayanta.saha@met-technologies.com'; 
				$subject = 'Euromobile  Welcomes you !';
				$message = "<html>
					<head>
					<title>Welcome to Euromobile</title>
					</head>
					<body>
					<p>Hello  " . $name . ",</p>
					<p>&nbsp;</p>
					<p>You have successfully placed your order <br/> Your Order NO " . $tran_id . " </p>
					<p>Selling Price £ " . $amount . " </p>
					<p> Your amount will be paid  within " . $date . "</p> 
					<p>Thank you for choosing Euromobiles </p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Euromobile Team</p>
					</body>
					</html>";
				$this->email->set_mailtype("html");
				$this->email->to($mail_id);
				$this->email->from('jayanta.saha@met-technologies.com', 'Euromobiles');
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
			}

			$data['transaction'] =  $transaction_id;
		}

		$data['page_slug'] 				= end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		$data['page_title'] 	= "Bank Transfer";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "bank_transfer";
		$data['module'] 		= 'welcome';

		$this->load->view($this->_container, $data);
		$this->cart->destroy();
		// $this->session->unset_userdata('transaction_id') ; 
		//redirect(base_url('cart/paypal_post'));	
	}

	// Paypal form   
	public function paypal_post()
	{

		$data = array();
		$data['page_slug'] 				= end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		$data['method'] 		= $this->router->fetch_method();
		$data['cart_products'] 	= $this->cart->contents();
		$data['cart_sub_total'] = $this->cart->total();
		$data['order_id'] 		= $this->home_model->get_last_order_id();

		$data['page_title'] 	= "Paypal Post";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "paypal_form";
		$data['module'] 		= 'welcome';

		//echo "<pre>";print_r($data['cart_products']);exit();
		$this->load->view($this->_container, $data);
	}

	// Paypal Success   
	public function paypal_success()
	{

		$data = array();
		$data['page_slug'] =  end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list
		$data['method'] 		= $this->router->fetch_method();
		$data['page_title'] 	= "Paypal Success";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "paypal_success";
		$data['module'] 		= 'welcome';
		$data['order_id']       = $this->home_model->get_val('tbl_transaction', 'id', $this->session->userdata('transaction_id'), 'transaction_no');

		if (null !== $this->session->userdata('transaction_id')) {
			$status = 'payment done';
		}

		$this->home_model->update_transaction($status, $data['order_id']);

		$this->cart->destroy();
		$this->session->unset_userdata('transaction_id');
		//Update order table 
		//$serialize_post_data 	= serialize($_REQUEST);
		//$this->home_model->update_order_status($serialize_post_data);

		//echo "<pre>";print_r($data['cart_products']);exit();
		$this->load->view($this->_container, $data);
	}

	// Paypal cancel   
	public function paypal_cancel()
	{

		$data = array();
		$data['method'] 		= $this->router->fetch_method();
		$data['page_title'] 	= "Paypal Cancel";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "paypal_cancel";
		$data['module'] 		= 'welcome';

		//echo "<pre>";print_r($data['cart_products']);exit();
		$this->load->view($this->_container, $data);
		$this->cart->destroy();
		$this->session->destroy();
	}

	// Paypal notify   
	public function paypal_notify()
	{

		$data = array();
		//Write to text file
		$serialize_post_data = serialize($_REQUEST);
		$order_contents = $this->home_model->update_order_status($serialize_post_data);

		$this->cart->destroy();

		$file = fopen("/home/ouronlineportfol/public_html/tradeworld/test.txt", "w");
		echo fwrite($file, serialize($order_contents));
		//echo fwrite($file,'Test');
		fclose($file);

		/***********************************************************/
		/* Invoice generate */
		// require('fpdf.php');
		require('mypdf.php');

		$newFile = 'invoices/' . 'INVOICE_' . $order_contents['transaction_id'] . '.pdf';

		$pdf = new MYPDF();

		$pdf->AliasNbPages();

		//$pdf->SetMargins($pdf->left, $pdf->top, $pdf->right); 

		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 18);
		//$pdf->Cell(40);
		$pdf->SetXY(90, 20);
		$pdf->Cell(10, 10, 'INVOICE', 0, 0, 'C');
		$pdf->Image('assets/frontend/images/logo.png', 5, 5, 0, 10, 'PNG');
		$pdf->SetXY(10, 30);
		$pdf->SetFont('Arial', '', 10);

		$companyaddress = "Tradeworld,
		Address Line 1,
		Address Line 2,
		Phone: 221-9595,
		Email Id: ventas1@repuestosmundiales.com";

		//$pdf->Cell(10,10,$companyaddress,0,0,'L',false);

		$pdf->MultiCell(100, 5, $companyaddress, 0);
		$pdf->SetXY(130, 37);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell("", "", 'Order No. :', '0', 0, 'L', false);
		$pdf->SetXY(160, 37);
		$orderno = $order_contents['id'];
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell("", "", $orderno, '0', 0, 'L', false);

		/************************************/
		/* Transaction */
		$pdf->SetXY(130, 42);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell("", "", 'Transaction Id :', '0', 0, 'L', false);
		$pdf->SetXY(160, 42);
		$orderdate = $order_contents['transaction_id'];
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell("", "", $orderdate, '0', 0, 'L', false);
		/* End */
		/************************************/
		$pdf->SetXY(130, 47);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell("", "", 'Order Date :', '0', 0, 'L', false);
		$pdf->SetXY(160, 47);
		$orderdate =  $order_contents['updated_on'];
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell("", "", $orderdate, '0', 0, 'L', false);


		$pdf->Ln(10);
		$pdf->SetXY(10, 65);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell("", "", 'BILLING ADDRESS,', '0', 0, 'L', false);
		$pdf->Ln(5);
		$pdf->SetFont('Arial', '', 10);

		$billing_address = $order_contents['billing_address']['first_name'] . "\r\n" . $order_contents['billing_address']['last_name'] . "\r\n" . $order_contents['billing_address']['address'] . " " . $order_contents['billing_address']['city'] . " " . $order_contents['billing_address']['zip_code'] . "\r\n" . $order_contents['billing_address']['state'] . "\r\n" . $order_contents['billing_address']['country'] . "\r\nPhone: " . $order_contents['billing_address']['phone'] . "\r\nEmail ID: " . $order_contents['billing_address']['email'];

		/*
		$vendoraddress = 'Kolkata,
		Address Line 1,
		Address Line 2,
		Phone: 221-9595,
		Email Id: ventas1@repuestosmundiales.com';
		*/

		$pdf->MultiCell(100, 5, $billing_address, 0);
		$pdf->SetXY(130, 65);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell("", "", 'SHIPPING ADDRESS,', '0', 0, 'L', false);

		$shipping_address =  $order_contents['shipping_address']['first_name'] . "\r\n" . $order_contents['shipping_address']['last_name'] . "\r\n" . $order_contents['shipping_address']['address'] . " " . $order_contents['shipping_address']['city'] . " " . $order_contents['shipping_address']['zip_code'] . "\r\n" . $order_contents['shipping_address']['state'] . "\r\n" . $order_contents['shipping_address']['country'] . "\r\nPhone: " . $order_contents['shipping_address']['phone'] . "\r\nEmail ID: " . $order_contents['shipping_address']['email'];

		/*
		$shipping_address = 'Kolkata,
		Address Line 1,
		Address Line 2,
		Phone: 221-9595,
		Email Id: ventas1@repuestosmundiales.com';
		*/

		$pdf->SetXY(130, 70);
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(100, 5, $shipping_address, 0, "L");
		$pdf->Ln();

		// create table
		$columns[] = array(

			array('text' => 'Sl No', 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '192,192,192', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			array('text' => 'DESCRIPTION', 'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '192,192,192', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			array('text' => 'QTY', 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '192,192,192', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			array('text' => 'TOTAL(USD)', 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '12', 'font_style' => 'B', 'fillcolor' => '192,192,192', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

		);


		// create table
		$j = $grand_total = 0;
		foreach ($order_contents['order_details'] as $key => $value) {
			$j++;
			$grand_total = $grand_total + ($value['price'] * $value['qty']);
			$col = array(

				array('text' => $j, 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

				array('text' => stripslashes($value['product_name']), 'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

				array('text' => $value['qty'], 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

				array('text' => number_format(($value['price'] * $value['qty']), 2), 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			);

			$columns[] = $col;
		}




		$col = array(

			array('text' => $j, 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			array('text' => '', 'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			array('text' => '', 'width' => '30', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

			array('text' => number_format($grand_total, 2), 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR')

		);

		$columns[] = $col;

		$pdf->WriteTable($columns);
		$pdf->Output($newFile, 'F');

		/* End Invoice generate */

		/* Mail Section Start */
		$to 	 = $order_contents['user_email'];
		$subject = "Tradeworld Order Invoice";
		$message = "<html>
					<head>
					<title>Tradeworld Order Invoice Email</title>
					</head>
					<body>
					<p>Hi " . $to . ",</p>
					<p>&nbsp;</p>
					<p>Please find the attachment for Tradeworld Order Invoice.<br/>Thank you.</p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Tradeworld Team</p>
					</body>
					</html>";

		$this->email->set_mailtype("html");
		$this->email->to($order_contents['user_email']);
		$this->email->from('ventas1@repuestosmundiales.com', 'Tradeworld');
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->attach($newFile);
		$this->email->send();

		/* Mail Section End */
		/******************************************************/
	}

	// Get State List
	public function ajax_get_state_list()
	{

		$data =  array();
		$country_id = $this->input->post('country_id');
		$data['state_list'] = $this->home_model->get_state_list($country_id);



		$this->load->view('ajax/ajax_get_state_list', $data);
	}

	// Get City List
	public function ajax_get_city_list()
	{

		$data =  array();
		$state_id = $this->input->post('state_id');
		$data['city_list'] = $this->home_model->get_city_list($state_id);

		$this->load->view('ajax/ajax_get_city_list', $data);
	}

	public function check_coupon()
	{
		if ($this->input->post()) {
			$coupon_code = $this->input->post('coupon_code');

			$coupon_price = $this->home_model->get_val('tbl_coupon', 'coupon_code', $coupon_code, 'amount');
			if (empty($coupon_price)) {
				echo $coupon_price = 0;
			} else {
				echo $coupon_price;
			}
		}
	}





	public function get_price_from_upi()
	{

		$zip_code = $_REQUEST['zip_code'];
		$pickup_date = $_REQUEST['current_date_completion'];
		$pickup = explode('/', $pickup_date);
		$pickup_formatted_date = $pickup[2] . $pickup[1] . $pickup[0];
		$delivery_time = $_REQUEST['delivery_time'];
		$cart_total = $this->cart->total();
		$data['cart_content']   = $this->cart->contents();

		if ($cart_total > 500) {
			$data['shipping_amount'] = 0.00;
		} else {
			if (!empty($data['cart_content'])) {
				$temp = 0;
				foreach ($data['cart_content'] as $cart_content) {
					//echo '<pre>'; print_r($cart_content); die();
					$services = \Ups\Entity\Service::getServices();
					$services=array(
						'01' => 'UPS Next Day Air',
						'02' => 'UPS Second Day Air',
						'03' => 'UPS Ground',
						'07' => 'UPS Worldwide Express',
						'08' => 'UPS Worldwide Expedited',
						'11' => 'UPS Standard',
						'12' => 'UPS Three-Day Select',
						'13' => 'Next Day Air Saver',
						'14' => 'UPS Next Day Air Early AM',
						'54' => 'UPS Worldwide Express Plus',
						'59' => 'UPS Second Day Air AM',
						'65' => 'UPS Saver',
						'70' => 'UPS Access Point Economy',
						'93' => 'UPS Sure Post'
					);
					//echo '<pre>';print_r($services);die;
					$ups_return_response=array();
					foreach ($services as $code => $code_desc) {
						$ups_return = $this->get_ups_rate($zip_code, $cart_total, $cart_content['paper_type_id'], $cart_content['dimensions'], $pickup_formatted_date, $delivery_time, $cart_content['pages'], $cart_content['copies'],$code,$code_desc,$cart_content['no_of_sides']);
						array_push($ups_return_response,$ups_return);
					}
					//print_r($ups_return_response);die;
					$ups_response[]=$ups_return_response;
				}
				
			}
		}
		$return_data = array('status' => true, 'shipping_response' => $ups_response);
		echo json_encode($return_data);
	}
	
	
	//sandy 14-05-2021
	public function get_price_from_upi_new()
	{
		//echo "<pre>";print_r(unserialize(base64_decode($_POST['extras'])));die;
		$extra_data = unserialize(base64_decode($_POST['extras']));
		//echo $this->cart->total() + $extra_data['total'];die;
		$zip_code = $_REQUEST['zip_code'];
		$pickup_date = $_REQUEST['current_date_completion'];
		$pickup = explode('/', $pickup_date);
		$pickup_formatted_date = $pickup[2] . $pickup[1] . $pickup[0];
		$delivery_time = $_REQUEST['delivery_time'];
		if(!empty($this->input->post('row_id'))){
			$cart_total = $this->cart->total() - $extra_data['total'];
		}else{
			$cart_total = $this->cart->total() + $extra_data['total'];
		}
		
		//echo $cart_total;die;
		$data['cart_content']   = $this->cart->contents();

		$ups_return_response=array();
		if ($cart_total > 500) {
			$data['shipping_amount'] = 0.00;
			$ups_return = array('status'=>'2','shipment_rate'=>'0.00','code'=>'00','code_desc'=>'Free Delivery');
			array_push($ups_return_response,$ups_return);
		} else {
			//if (!empty($data['cart_content'])) {
				$temp = 0;
				error_reporting(-1);
		ini_set('display_errors', 1);
					//echo '<pre>'; print_r($cart_content); die();
					$services = \Ups\Entity\Service::getServices();
							dd('sss');

					$services=array(
						'01' => 'UPS Next Day Air',
						'02' => 'UPS Second Day Air',
						'03' => 'UPS Ground',
						'07' => 'UPS Worldwide Express',
						'08' => 'UPS Worldwide Expedited',
						'11' => 'UPS Standard',
						'12' => 'UPS Three-Day Select',
						'13' => 'Next Day Air Saver',
						'14' => 'UPS Next Day Air Early AM',
						'54' => 'UPS Worldwide Express Plus',
						'59' => 'UPS Second Day Air AM',
						'65' => 'UPS Saver',
						'70' => 'UPS Access Point Economy',
						'93' => 'UPS Sure Post'
					);
					//echo '<pre>';print_r($services);die;
					foreach ($services as $code => $code_desc) {
						$ups_return = $this->get_ups_rate($zip_code, $cart_total, $extra_data['paper_type_id'], $extra_data['dimensions'], $pickup_formatted_date, $delivery_time, $extra_data['pages'], $extra_data['copies'],$code,$code_desc,$extra_data['no_of_sides']);
						array_push($ups_return_response,$ups_return);
					}
					//print_r($ups_return_response);die;
					
				
			//}
				//print_r($ups_response);die;
		}
		$ups_response[]=$ups_return_response;
		$return_data = array('status' => true, 'shipping_response' => $ups_response);
		echo json_encode($return_data);
	}

	public function get_ups_rate($zipcode, $cart_total, $paper_Type_id, $dimensions, $pickup_date, $delivery_time, $pages, $copies,$code=null,$code_desc=null,$no_of_sides=null)
	{
		//echo $paper_Type_id;echo $dimensions;die;
		$accessKey = '4CE90AA1D1E82453';  //DD61CF56B88DDDFA //1D5F52F9E67DD1DA
		$userId = 'babanata';
		$password = '6180XeroX6180';

		$rate = new Ups\Rate(
			$accessKey,
			$userId,
			$password
		);
		$height = 0;
		$weight = 0;
		$volumn = $this->home_model->getProductVolumn($paper_Type_id, $dimensions);


		$dimension = explode('x', $dimensions);
		$width = $dimension[0];
		$length = $dimension[1];
		if (!empty($volumn)) {
			
			
			if ($no_of_sides == "2-sided") {
                if ($no_pages % 2 == 0) {
                    
                    $total_no_of_sheets = ($copies * $pages) / 2;
                
                    
                } else {
                    $even_pages = ($pages - 1) * $copies;
                    $odd_pages = 1 * $copies;
                    $total_no_of_sheets = ($even_pages / 2) + $odd_pages;
                }
            } else {
                
                $total_no_of_sheets = $copies * $pages;
            }


			$height = ($volumn['height'] / $volumn['sheets_count']) * $total_no_of_sheets;
			$weight = ($volumn['weight'] / $volumn['sheets_count']) * $total_no_of_sheets;
		}

		try {
			$shipment = new \Ups\Entity\Shipment();

			$shipperAddress = $shipment->getShipper()->getAddress();
			$shipperAddress->setPostalCode('92081');

			$address = new \Ups\Entity\Address();
			$address->setPostalCode('92081');
			$shipFrom = new \Ups\Entity\ShipFrom();
			$shipFrom->setAddress($address);

			$shipment->setShipFrom($shipFrom);

			$shipTo = $shipment->getShipTo();
			$shipTo->setCompanyName('Test Ship To');
			$shipToAddress = $shipTo->getAddress();
			$shipToAddress->setPostalCode($zipcode);

			
			$service = new \Ups\Entity\Service();
			$service->setCode($code);
			// $package->getPackageWeight()->setWeight($weight);

			// $shipment->Service = new \stdClass();
        	// $shipment->Service->Code = '03';
			$shipment->setService($service);
			// $service->setService('03');

			//echo $code;die;
			$package = new \Ups\Entity\Package();
			$package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
			$package->getPackageWeight()->setWeight($weight);

			// if you need this (depends of the shipper country)
			$weightUnit = new \Ups\Entity\UnitOfMeasurement;
			$weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
			$package->getPackageWeight()->setUnitOfMeasurement($weightUnit);

			$dimensions = new \Ups\Entity\Dimensions();
			$dimensions->setHeight($height);
			$dimensions->setWidth($width);
			$dimensions->setLength($length);

			$unit = new \Ups\Entity\UnitOfMeasurement;
			$unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

			$dimensions->setUnitOfMeasurement($unit);
			$package->setDimensions($dimensions);

			$shipment->addPackage($package);

			$deliveryTimeInformation = new \Ups\Entity\DeliveryTimeInformation();
			$deliveryTimeInformation->setPackageBillType(\Ups\Entity\DeliveryTimeInformation::PBT_NON_DOCUMENT);

			$shipment->setDeliveryTimeInformation($deliveryTimeInformation);
			
			
			// $pickup = new \Ups\Entity\Pickup();
			// $pickup->setDate("20190729");
			// $pickup->setTime("160000");

			//echo '<pre>';print_r($shipment);die;

			//$result = $rate->shopRatesTimeInTransit($shipment);
			$result = $rate->getRate($shipment);
			
			
			//echo '<pre>';print_r($result);die;
			//foreach ($result->RatedShipment as $Rated_Shipment) {
				//if ($Rated_Shipment->ScheduledDeliveryTime == $delivery_time) {
					//print_r($result->RatedShipment[0]);die;
					
					return array('status'=>'1','shipment_rate'=>$result->RatedShipment[0]->TotalCharges->MonetaryValue,'code'=>$code,'code_desc'=>$code_desc);
					
				//}
			//}
		} catch (Exception $e) {
			//echo '<pre>'; print_r($e);die;
			return array('status'=>'0','shipment_rate'=>'0.00','code'=>$code,'code_desc'=>$code_desc);
		}


		//return array('status' => true, 'shipment_rate' => $shipment_rate, 'shipment_description' => $shipment_description);
	}

	// public function get_ups_rate($zipcode,$cart_total,$paper_Type_id,$dimensions,$pickup_date,$delivery_time){

	// 		$accessKey='4CE90AA1D1E82453';  //DD61CF56B88DDDFA //1D5F52F9E67DD1DA
	// 		$userId='babanata';
	// 		$password='6180XeroX6180';
	// 		$timeInTransit = new Ups\TimeInTransit($accessKey, $userId, $password);

	// 		$height = 0; $weight = 0;
	// 		$volumn = $this->home_model->getProductVolumn($paper_Type_id,$dimensions);

	// 		$dimension = explode('x', $dimensions);
	// 		$width = $dimension[0];
	// 		$length = $dimension[1];

	// 		if(!empty($volumn)){
	// 			$height = $volumn['height'];
	// 			$weight = $volumn['weight'];
	// 		}

	// 	try {
	// 		$request = new \Ups\Entity\TimeInTransitRequest;

	// 		// Addresses
	// 		$from = new \Ups\Entity\AddressArtifactFormat;
	// 		$from->setPoliticalDivision3('Amsterdam');
	// 		$from->setPostcodePrimaryLow('1000AA');
	// 		$from->setCountryCode('NL');
	// 		$request->setTransitFrom($from);

	// 		$to = new \Ups\Entity\AddressArtifactFormat;
	// 		$to->setPoliticalDivision3('Amsterdam');
	// 		$to->setPostcodePrimaryLow('1000AA');
	// 		$to->setCountryCode('NL');
	// 		$request->setTransitTo($to);

	// 		// Weight
	// 		$shipmentWeight = new \Ups\Entity\ShipmentWeight;
	// 		$shipmentWeight->setWeight($weight);
	// 		$unit = new \Ups\Entity\UnitOfMeasurement;
	// 		$unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
	// 		$shipmentWeight->setUnitOfMeasurement($unit);
	// 		$request->setShipmentWeight($shipmentWeight);

	// 		// Packages
	// 		$request->setTotalPackagesInShipment(2);

	// 		// InvoiceLines
	// 		$invoiceLineTotal = new \Ups\Entity\InvoiceLineTotal;
	// 		$invoiceLineTotal->setMonetaryValue(100.00);
	// 		$invoiceLineTotal->setCurrencyCode('USD');
	// 		$request->setInvoiceLineTotal($invoiceLineTotal);

	// 		// Pickup date
	// 		// print_r(new DateTime('2019-07-30'));die;
	// 		$request->setPickupDate(new DateTime('2019-07-30'));

	// 		// Get data
	// 		$times = $timeInTransit->getTimeInTransit($request);
	// 	echo '<pre>';
	// 	print_r($times);die;
	// 	foreach($times->ServiceSummary as $serviceSummary) {
	// 		print_r($serviceSummary);
	// 	}
	// 	die;
	// 	} catch (Exception $e) {
	// 		echo '<pre>';print_r($serviceSummary);die;
	// 	}

	// }

	public function file_upload()
	{

		$product_id = $this->input->post('product_id');

		if (!empty($_FILES['file-upload']['name'][0])) {

			$path = './uploads/files/';
			$upload_file = $this->upload_Product_images($path, $_FILES['file-upload'], $product_id);
			$return_file = $upload_file;

			if ($upload_file === FALSE) {
				$this->session->set_flashdata('error_msg', $this->upload->display_errors());
				$return_data = array('status' => false, 'msg' => $this->upload->display_errors());
			} else {
				if ($this->session->userdata('uploaded_image')) {
					$upload_file .= '||' . $this->session->userdata('uploaded_image');
				}
				$this->session->set_userdata('uploaded_image', $upload_file);
				$return_data = array('status' => true, 'msg' => 'Uploaded Successfully', 'image_name' => $return_file);
			}
		}
		echo json_encode($return_data);
	}


	private function upload_Product_images($path, $files, $product_id)
	{

		$config = array(
			'upload_path'   => $path,
			'allowed_types' => 'gif|jpg|png|jpeg|pdf|xls|xlsx|doc|docx|txt|ai',
			'overwrite'     => true
		);

		$images = array();

		foreach ($files['name'] as $key => $image) {

			$_FILES['images[]']['name'] = $files['name'][$key];
			$_FILES['images[]']['type'] = $files['type'][$key];
			$_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
			$_FILES['images[]']['error'] = $files['error'][$key];
			$_FILES['images[]']['size'] = $files['size'][$key];

			$fileName = safe_str_replace(" ", "_", $image);


			$images[] = $fileName;

			$config['file_name'] = $fileName;
			$this->load->library('upload', $config);

			$this->upload->initialize($config);

			if ($this->upload->do_upload('images[]')) {

				$data_val = array(
					'image'     => $fileName,
					'product_id' => $product_id
				);
				$this->db->insert('images', $data_val);
			} else {
				echo $this->upload->display_errors(); die;
				return false;
			}
		}

		$images_name = implode('||', $images);
		return $images_name;
	}
}
