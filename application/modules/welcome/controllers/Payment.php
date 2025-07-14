<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

	function __construct() {
        parent::__construct();
        
        	$this->config->load('alignet_config');		
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
    public function index(){
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');
		
		$data = array();				
		$data['banner_list']		= $this->home_model->Show_Banner('payment',get_current_language()); 	//banner list		
		//$data['news_list']		= $this->home_model->Show_News(get_current_language()); 	//news list
		$data['contact'] 		= $this->home_model->get_contactus_contents();
		$data['payment_type'] 		= $this->home_model->get_payment_type(get_current_language());
		$data['payment_detail'] 	= $this->home_model->get_payment_details('3',get_current_language());
		$data['page_title'] 		= "Payment";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "payment";
		$data['module'] 		= 'welcome';
				
		//$data['recent_products']= $this->home_model->getRecentProducts();

		$this->load->view($this->_container, $data);		
    }

    public function get_payment_details($id,$lang){
    //exit($id." ".$lang);
    	$result = $this->home_model->get_payment_details($id,$lang);
	//echo "<pre>"; print_r($result);echo "</pre>";exit();
	echo json_encode($result);
    }

    public function checkout_process(){
    
	//$this->form_validation->set_rules('transaction_amount', 'Transaction Amount', 'trim|required');
	//if($this->form_validation->run() != FALSE)
	//{
		$order_id = time();
		$amount  = $this->input->post('amount');
		$description = $this->input->post('description');
		$type = $this->input->post('type');
		
		/*$data = array(
		'order_id'			=>	$order_id,
		'transaction_amount' 		=>	$amount,
		'transaction_description'	=>	$details,
		'transaction_status'		=>	'0'
		);*/
		
		//$return_id = $this->home_model->Insert_Transaction($data);
		$this->session->set_userdata('amount',$amount);
		$this->session->set_userdata('type',$type);
		$this->session->set_userdata('description',$description);
		$this->session->set_userdata('order_id',$order_id);
		
		echo "success";
		//print_r($this->session); exit();
		
		//$this->session->set_userdata('transaction_id',$return_id);
		
		//if($return_id != "")
		//{
		//redirect('payment/checkout');
		//}
		//echo 'success';
	//}
    }
	
    public function Checkout(){
    	$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
	$data = array();				
	$data['banner_list']	= $this->home_model->Show_Banner('payment',get_current_language()); //banner list		
	$data['contact'] 	= $this->home_model->get_contactus_contents();
	//$data['payment_type'] 	= $this->home_model->get_payment_type(get_current_language());
	//$data['payment_detail'] = $this->home_model->get_payment_details('3',get_current_language());
	$data['page_title'] 	= "Home";	
	$data['page'] 		= $this->config->item('bootsshop_template_dir_welcome') . "checkout";
	$data['module'] 	= 'welcome';
	//$data['recent_products']= $this->home_model->getRecentProducts();
	$this->load->view($this->_container, $data);		
    }	
    
    public function payment_process(){
		require_once(APPPATH.'alignet/vpos_plugin.php');
		//print_r($this->input->post());
		//echo $this->input->post('zipcode'); 
		//exit();
		/*
		$this->config->item('alignet_acquirer_id');
		$this->config->item('alignet_commerce_id');
		$this->config->item('alignet_vector_id');
		$this->config->item('alignet_public_crypto_key');
		$this->config->item('alignet_private_signature_key');
		$this->config->item('alignet_public_signature_key');
		$this->config->item('alignet_private_crypto_key');*/
		//echo $this->config->item('alignet_url'); exit();
		
		/*if($this->session->userdata('order_id'))
       		{
       			$order_id = $this->session->userdata('order_id');
       		}*/
		
		if($this->session->userdata('amount'))
       		{
       			$amount = $this->session->userdata('amount');
       		}
       		//echo $amount; exit();
		$purchaseCurrencyCode = '840';
		$commerceMallId = '1';
		$language = 'SP';
		$terminalCode = '00000000';
		if($this->session->userdata('order_id'))
       		{
       			$operationno = $this->session->userdata('order_id');
       		}
		//$operationno = time();
		
		$insert_data = array(
			'order_id'		=>	$operationno,
			'amount'		=>	$this->input->post('payment_amount'),
			'type'			=>	$this->input->post('payment_type'),
			'description'		=>	$this->input->post('payment_description'),
			'student_first_name'	=>	$this->input->post('student_first_name'),
			'student_last_name'	=>	$this->input->post('student_last_name'),
			'guardian_first_name'	=>	$this->input->post('guardian_first_name'),
			'guardian_last_name'	=>	$this->input->post('guardian_last_name'),
			'phone'			=>	$this->input->post('phone'),
			'email'			=> 	$this->input->post('email'),
			'address'		=> 	$this->input->post('address'),
			'city'			=> 	$this->input->post('city'),
			'state'			=> 	$this->input->post('state'),
			'country'		=> 	$this->input->post('country'),
			'zipcode'		=> 	$this->input->post('zipcode'),
			'status'		=>	'Pending',
			'created_at'		=>	date('Y-m-d H:i:s'),
			'updated_at'		=>	date('Y-m-d H:i:s')
		);
		
		$return_result = $this->home_model->Insert_Payment_Details($insert_data);
		
		$this->session->set_userdata('transaction_id',$return_result);
		
		$array_send['acquirerId'] = $this->config->item('alignet_acquirer_id');
		$array_send['commerceId'] = $this->config->item('alignet_commerce_id');
		$array_send['purchaseOperationNumber']	=	$operationno;
		$array_send['purchaseAmount'] = safe_str_replace(".","",($amount * 100));
		$array_send['purchaseCurrencyCode'] = $purchaseCurrencyCode;
		$array_send['commerceMallId']	= $commerceMallId;
		$array_send['language']	=	$language;
		
		$array_send['billingFirstName'] = $this->input->post('guardian_first_name');
		$array_send['billingLastName'] = $this->input->post('guardian_last_name');
		$array_send['billingAddress'] = $this->input->post('address');
		$array_send['billingCity'] = $this->input->post('city');
		$array_send['billingState'] = $this->input->post('state');
		$array_send['billingCountry'] = $this->input->post('country');
		$array_send['billingZIP'] = $this->input->post('zipcode');
		$array_send['billingEMail'] = $this->input->post('email');
		$array_send['billingPhone'] = $this->input->post('phone');
		$array_send['shippingAddress'] = $this->input->post('address');
		$array_send['shippingCity'] = $this->input->post('city');
		$array_send['shippingState'] = $this->input->post('state');
		$array_send['shippingCountry'] = $this->input->post('country');
		$array_send['shippingZIP'] = $this->input->post('zipcode');
		$array_send['shippingFirstName'] = $this->input->post('guardian_first_name');
		$array_send['shippingLastName'] = $this->input->post('guardian_last_name');
		$array_send['terminalCode'] = $terminalCode;
		$array_send['HTTPSessionId'] = $_SERVER['SERVER_NAME'];
		//$array_send['HTTPSessionId'] = 'https://www.zoom40.com/';

		$array_get['XMLREQ']="";
		$array_get['DIGITALSIGN']="";
		$array_get['SESSIONKEY']="";

		$publiccryptokey = $this->config->item('alignet_public_crypto_key');
		$privatesignaturekey = $this->config->item('alignet_private_signature_key');
		$vector_id = $this->config->item('alignet_vector_id');
		
		$a_publiccryptokey = (preg_split("/((\r?\n)|(\r\n?))/", $publiccryptokey));
		$a_privatesignaturekey = (preg_split("/((\r?\n)|(\r\n?))/", $privatesignaturekey));
		
		VPOSSend($array_send,$array_get, $publiccryptokey,$privatesignaturekey,$vector_id);
	       
	        $data['alignet_url']	= $this->config->item('alignet_url');
	        $data['acquirer_id']	= $this->config->item('alignet_acquirer_id');
	        $data['commerce_id']    = $this->config->item('alignet_commerce_id');
	        $data['array_get']      = $array_get;
		
		$data['page_title'] 	= "Alignet Process";	
		$data['page'] 		= $this->config->item('bootsshop_template_dir_welcome') . "alignet_process";
		$data['module'] 	= 'welcome';
		$this->load->view($this->_container, $data);
		
	}
	
    public function thankyou(){
    	$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
	$data = array();				
	$data['banner_list']	= $this->home_model->Show_Banner('payment',get_current_language()); //banner list		
	$data['contact'] 	= $this->home_model->get_contactus_contents();
	//$data['payment_type'] 	= $this->home_model->get_payment_type(get_current_language());
	//$data['payment_detail'] = $this->home_model->get_payment_details('3',get_current_language());
	$data['page_title'] 	= "Thank You";	
	$data['page'] 		= $this->config->item('bootsshop_template_dir_welcome') . "thankyou";
	$data['module'] 	= 'welcome';
	//$data['recent_products']= $this->home_model->getRecentProducts();
	$this->load->view($this->_container, $data);		
    }
    
}
?>