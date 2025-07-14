<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Cart extends MY_Controller {

	function __construct() {
        parent::__construct();
		//$this->load->library(array('ion_auth'));
		$this->load->model('home_model');
		$this->load->model('cart_model');
		$this->load->helper('cookie');
		/*if(!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}*/
		//$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart.php";
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        //log_message('debug', 'CI My Admin : Auth class loaded');
    }

    public function index(){	
		$data = array();
		$data['page_slug'] 				= end($this->uri->segments);	
/*		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());		
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		$result_category = $this->home_model->getAllCategory();
		$data['category_result']	= $result_category;
		$data['category_list']  = $this->home_model->getAllCategory(); //category list

		$cart_products 				= $this->cart->contents();				
		if($this->ion_auth->logged_in()){
			$user_id = 	$this->ion_auth->get_user_id();			
			$cart_products = $this->cart_model->get_cart_product($user_id);						
			
			if(!empty($cart_products)){
				$arr = $arr1 = array();
				foreach($cart_products as $row){ 
						
					
					$arr['user_id']					= $user_id;  
					$arr['id']						= $row['id'];
					$arr['product_id']				= $row['product_id'];										
					$arr['name'] 					= $row['name'];
					$arr['price'] 					= $row['price'];
					$arr['imei_no'] 				= $row['imei_no'];
					$arr['payment_type'] 			= $row['payment_type'];
					$arr['qty'] 					= $row['qty'];					
					//$arr['product_attribute_value']	= $row['product_attribute_value'];
					$arr['condi'] 					= $row['condi'];
                    $arr['network'] 					= $row['network'];					
					$arr['options']['product_attribute_value']	= $row['product_attribute_value'];
					
					$arr1[] = $arr;  			
				}
				$this->cart->destroy();
				$this->cart->insert($arr1);		
				$cart_products = $this->cart->contents();		
			}
		}
	
		$data['cart_products'] 			= $cart_products;
		
		$data['cart_sub_total'] 		= $this->cart->total();
		$data['cart_extra_percentage'] 	= number_format($data['cart_sub_total']*(7/100), 2, '.', ''); 
		$data['cart_grand_total'] 		= number_format(($data['cart_sub_total']+$data['cart_extra_percentage']), 2, '.', ''); */

		$data['page_title'] 			= "Product Details";
		$data['page'] 					= $this->config->item('bootsshop_template_dir_welcome') . "cart";
		$data['module'] 				= 'welcome';
		
		//echo "<pre>";print_r($data);exit();
		$this->load->view($this->_container, $data);		
    }
    
    //Update cart 
    function update_cart(){

    	//echo "<pre>";print_r($_POST);exit();
    	
    	//Set Cookie for cart data 		
		//$cart_products = $this->cart->contents();	
		//$this->input->set_cookie($cart_products);

    	$arr = $arr1 = array();
 		foreach($_POST['cart'] as $id => $qty){			
			$arr['rowid'] 	= $id;
			$arr['qty'] 	= $qty;

			$arr1[] = $arr;  			
		}
		$this->cart->update($arr1);

		//Cart table data
		$cart_products = $this->cart->contents();				
		$arr = $arr1 = array();
		//echo "<pre>";print_r($cart_products); exit;
		foreach($cart_products as $row){
			
			//Update product popularity
			$sql = "UPDATE tbl_products	SET popularity = popularity + 1 WHERE product_id = '".$row['product_id']."'"; 
  			$this->db->query($sql);
			
			//Update from cart
			if($this->ion_auth->logged_in()){

				$user_id = $this->ion_auth->get_user_id();
				// Cart session update  
				$temp_arr = $this->home_model->isexist_product($arr=array('user_id'=>$user_id, 'product_id'=>$row['product_id'], 
																'product_attribute_value'=>$row['options']['product_attribute_value']));
				/*
				if(!empty($temp_arr)){
					$arr['qty']           	= $temp_arr['qty'] + $row['qty'];
				}else{
					$arr['qty']           	= $row['qty'];			
				}
				*/

				$arr['qty']           	= $row['qty'];
				$arr['updated_on'] 		= date('Y-m-d H:i:s'); 
				
				$this->db->where('user_id',$user_id);
				$this->db->where('product_id',$row['product_id']);
				$this->db->where('product_attribute_value',$row['options']['product_attribute_value']);
				$this->db->update('tbl_cart', $arr);

				//echo $this->db->last_query();exit();
			}						
			
		}		

		redirect('cart');
	}	

	function add_order(){
		
		//Logged in check
		if(!$this->ion_auth->logged_in()){
			redirect(base_url('my-account/'), 'refresh');
		}	

		$cart_products 			= $this->cart->contents();
			
		//Cart empty check
		if(empty($cart_products)){
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
 		foreach($cart_products as $key=>$value){			
	 		$order_details_data['order_id'] 			= $order_id;	 		
	 		$order_details_data['product_id'] 			= $value['id'];
			$order_details_data['product_detail_id'] 	= 0;
	 		$order_details_data['qty'] 					= $value['qty'];
	 		$order_details_data['price'] 				= $value['price'];
	 		$order_details_data['product_attribute_value']		= $value['options']['product_attribute_value'];

	 		$arr[] 	= $order_details_data;	 		

			/* Stock qty minus */
			$update_arr = array('minus_qty'=>$value['qty'], 'product_id'=>$value['id']);
			$this->home_model->update_stock($update_arr);
	 	
	 	}

		$this->db->insert_batch('tbl_order_details', $arr);
		$this->db->where('user_id',$this->ion_auth->get_user_id());
		$this->db->delete('tbl_cart');
		
		$this->cart->destroy();
		$this->session->unset_userdata('product_data');		
		redirect('cart');
	}
	
	//Add to cart 
	function add_to_cart(){

		//print_r($this->input->post());exit();		      

		$data = $this->input->post();
		
         $product_id				= $this->input->post('product_id') ; 		
		 $product_name 				= $this->input->post('product_name') ; 
		$product_attribute_value 	= $this->input->post('varient_value');
		$product_price  			= $this->input->post('regular_price'); 
		$imei_no                    = $this->input->post('imei_no');
		$payment_type               = $this->input->post('pay_details');
		$product_qty 				= 1; 
        $condition                  = $this->input->post('condition_val');
        $network                    = $this->input->post('network');		

		//Update product popularity
		$sql = "UPDATE tbl_products	SET popularity = popularity + 1 WHERE product_id = '".$product_id."'"; 
  		$this->db->query($sql);
         if($imei_no == ""){
			 $imei_no = "" ; 
		 }
		 if($payment_type == ""){
			 $payment_type = "" ;
		 }
		 
			
		$insert_data = array(
			'user_id'					=> ($this->ion_auth->get_user_id() > 0 ?$this->ion_auth->get_user_id():''), 			
			'id' 						=> $product_id, 
			'product_id' 				=> $product_id, 						
			'name' 						=> $product_name,
			'price' 					=> $product_price,
			'imei_no'                   => $imei_no,
			'qty' 						=> $product_qty,
			'payment_type' 			    => $payment_type,
			'condition'                 => $condition , 
            'network'                   => $network , 
			'options' 					=> array('product_attribute_value' => $product_attribute_value) 
			//'product_attribute_value' 	=>$product_attribute_value 
			 
		);

		//echo "<pre>";print_r($insert_data);exit();		
		$this->cart->insert($insert_data);
		
		//echo '<pre>';
		//print_r($this->cart->contents());exit;
		// Cart table update
		if($this->ion_auth->logged_in()){
			
			$user_id = $this->ion_auth->get_user_id();		
			// Cart session update  
			$temp_arr = $this->home_model->isexist_product($arr=array('user_id'=>$user_id, 
																	  'product_id'=>$product_id, 
																	  'product_attribute_value'=>$product_attribute_value));

			$cart_data = array(); 
			$cart_data['user_id'] 					= $user_id; 			
			$cart_data['product_id'] 				= $product_id;
			$cart_data['product_attribute_value']	= $product_attribute_value;			
            $cart_data['imei_no'] 			        = $imei_no;
			$cart_data['condi'] 			        = $condition;
			$cart_data['network'] 			        = $network;
            $cart_data['payment_type']			    =  $payment_type;			
			if(!empty($temp_arr)){

				$cart_data['qty'] 			= $temp_arr['qty'] + $product_qty;   						

				$this->db->where('user_id', $user_id);									
				$this->db->where('product_id', $product_id);									
				$this->db->where('product_attribute_value', $product_attribute_value);													
				$this->db->update('tbl_cart', $cart_data);				
							
			}else{
				 
				$cart_data['name'] 				= $product_name; 
				$cart_data['price'] 			= $product_price;
                $cart_data['imei_no'] 			= $imei_no;
				$cart_data['condi'] 	        = $condition;
			   $cart_data['network'] 			= $network;
                $cart_data['payment_type']		= $payment_type;				
				$cart_data['qty'] 				= $product_qty;   						
				$cart_data['created_on'] 		= date('Y-m-d H:i:s');
				$cart_data['updated_on'] 		= date('Y-m-d H:i:s'); 
				$cart_data['status'] 			= 1; 

				$this->db->insert('tbl_cart', $cart_data);				

			}

		}	
		
		redirect('cart');
    }

	function delete_cart_item($rowid, $id){		
		$this->cart->remove($rowid);

		if($this->ion_auth->logged_in()){
			$user_id = 	$this->ion_auth->get_user_id();			
			$this->db->where('id', $id);
			//$this->db->where('user_id', $user_id);
			$this->db->delete('tbl_cart');
		}	
		//echo $this->db->last_query();exit;
		redirect('cart');
	} 

	public function get_product_price(){
		
		$product_id = $_POST['productid'];
		$attribute_value = "Ancho:".$_POST['ancho'].",Alto:".$_POST['alto'].",Rin:".$_POST['rin'];
		$result = $this->cart_model->getProductDetails($product_id,$attribute_value);
		echo json_encode($result);
		//echo $query;
	}

	// Cart Checkout
	public function checkout(){
		if( null !== $this->input->post('payment_type')){
		$this->session->set_userdata('payment_type' , $this->input->post('payment_type'));
		}
		
		$cart_products = $this->cart->contents();
		//print_r($cart_products) ; 
      //echo $this->input->post('') ; exit();  		
		//Cart empty check
		if(empty($cart_products)){
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

		if(!empty($data['shipping_address'])){

			$data['shipping_state_list'] = $this->home_model->get_state_list($data['shipping_address']['country_id']); 		
			$data['shipping_city_list']  = $this->home_model->get_city_list($data['shipping_address']['state_id']); 		

		}

		if(!empty($data['billing_address'])){

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
	public function checkout_post(){		
		//Add to order table 
		//Logged in check	
		$input_data['user_data'] = $this->input->post() ;
		
		
		 if($this->input->post('acount_type') != 'guest'){
		 if(!$this->ion_auth->logged_in()){
			
			redirect(base_url('login/'), 'refresh');
		}
		} 
		 else {
			 
			 $data = array(
			 'username' => 'GUEST' ,
             'email'	=> $input_data['user_data']['email'] 	
            		 
			 ) ;
			
		 $get_user_id = $this->home_model->Insert_UserData($data) ; 
		
		} 		
         /* cart details */////
		$cart_products 			= $this->cart->contents();
		$cart_grand_total 		= $this->cart->total();
		

    	$arr = $arr1 = $order_data = $order_details = array();
 		
 		//Order table 
 		$order_data['user_id'] 		= $this->ion_auth->get_user_id() > 0 ?$this->ion_auth->get_user_id():$get_user_id ;
 		$order_data['total_price'] 	= $cart_grand_total;
 		$order_data['created_on'] 	= date('Y-m-d H:i:s');
 		
 		//echo "<pre>";print_r($order_data);exit();

 		$this->db->insert('tbl_orders', $order_data);
 		$order_id = $this->db->insert_id();
        $input_data['order_id'] = $order_id; 
 		//Order details table 

 		// echo "<pre>";print_r($cart_products);exit();

 		foreach($cart_products as $key=>$value){ if( isset( $value['condition']) ) { $condition = $value['condition'] ; } else {  $condition ="" ; }
 		if( isset( $value['condi']) ) { $condition = $value['condi'] ; } else { $condition ="" ; } 
 		 if( isset( $value['network']) ) { $network = $value['network'] ; } else { $network = "";  }
            if( isset($value['options']['product_attribute_value'])){$attribute = $value['options']['product_attribute_value'] ;  } else {
			  $attribute = $value['product_attribute_value'] ; 	
			}			
 			$order_details_data	= array();	 		
	 		$order_details_data['order_id'] 			= $order_id;	 		
	 		$order_details_data['product_id'] 			= $value['product_id'];			
	 		$order_details_data['qty'] 					= $value['qty'];
	 		$order_details_data['price'] 				= $value['price'];
	 	//	$order_details_data['product_attribute_value'] = $value['options']['product_attribute_value'];
			$order_details_data['product_attribute_value'] = $attribute;
			$order_details_data['imei_no'] = $value['imei_no'];
			$order_details_data['condi']             = $condition  ; 
            $order_details_data['network']           = $network  ; 
            
	 		/* Stock qty minus */
			
			/* $update_arr = array('minus_qty'=>$value['qty'], 'product_id'=>$value['product_id']);
			$this->home_model->update_stock($update_arr);	
			*/ 		

	 		$arr[] 	= $order_details_data;	 		
	 	}
         //echo time(); echo "<pre>"; echo $this->session->userdata('payment_type') ; print_r($input_data['order_id']);	exit() ;  	
          
		$this->db->insert_batch('tbl_order_details', $arr);
		// $this->db->where('user_id', $this->ion_auth->get_user_id());
		$this->db->where('user_id', $this->ion_auth->get_user_id() > 0 ?$this->ion_auth->get_user_id():$get_user_id);
		$this->db->delete('tbl_cart');
	
		//$this->cart->destroy();				
			
		//Add to address table 
		$data =  $this->input->post();
		$data['shipping']['user_id'] = $this->ion_auth->get_user_id() > 0 ?$this->ion_auth->get_user_id():$get_user_id ;
		$data['billing']['user_id']  = $this->ion_auth->get_user_id() > 0 ?$this->ion_auth->get_user_id():$get_user_id ;
		
		$data['page_slug'] 				= end($this->uri->segments);	
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());		
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		//echo "<pre>";print_r($data);exit();
		
		//$this->home_model->update_address($data); /* nneed here check */
		 $rows = $this->home_model->number_rows('tbl_transaction') ;
		// $this->home_model->get_val('tbl_orders' , 'id' , $input_data['order_id'], $find_field) ,
			$insert_data = array (
				'transaction_no' => 'EU'.time().$rows , 
				'order_id'		 =>  $input_data['order_id'] , 
				'amount'		 =>  $this->home_model->get_val('tbl_orders' , 'id' , $input_data['order_id'], 'total_price') ,
				'type'          =>  $this->session->userdata('payment_type') , 
				'student_first_name'          =>  $input_data['user_data']['first_name'] ,
				'student_last_name'          =>  $input_data['user_data']['last_name'] ,
				'phone'          =>  $input_data['user_data']['phone'] ,
				'email'          =>  $input_data['user_data']['email'] ,
				'country'       =>  $this->home_model->get_val('countries' , 'id' , $input_data['user_data']['country'], 'name') ,
				'state'         =>  $this->home_model->get_val('states' , 'country_id' , $input_data['user_data']['state'], 'name') ,
				'city'         =>  $input_data['user_data']['city'] ,
				'zipcode'         =>  $input_data['user_data']['zip_code'] ,
				'address'         =>  $input_data['user_data']['address'] ,
				'status'      => '' ,
				'description' => $input_data['user_data']['seler_type'],
				'created_at' => date("Y-m-d H:i:s"), 
				'updated_at' => date("Y-m-d H:i:s")
			); 

		  $this->db->insert('tbl_transaction', $insert_data); 
		 $tbl_transaction = $this->db->insert_id();
		 $this->session->set_userdata('transaction_id' ,  $tbl_transaction); 
		if($this->session->userdata('payment_type')  == 'CHEQUE' ){
		
		redirect(base_url('placeorder_confirmation'));		
			
		} else {
		 
		redirect(base_url('bank_transfer'));
       // redirect(base_url('cart/paypal_post'));		
		}

	 }
	
	public function cheque_order() {
		$data = array();
		$data['page_slug'] 				= end($this->uri->segments);	
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());		
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list
        $data['transaction_id']         = $this->home_model->get_val('tbl_transaction' , 'id' , $this->session->userdata('transaction_id'), 'transaction_no'); 
		$data['page_title'] 	= "Cheque";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "payment_type";
		$data['module'] 		= 'welcome';
		
		$transaction_data = $this->db->get_where('tbl_transaction' , array('transaction_no' => $transaction_id))->result_array();
	    if($transaction_data){
		foreach($transaction_data as $data ){
			$tran_id =  $data['transaction_no'] ;
            $name    =  $data['student_first_name'].' '. $data['student_last_name'] ;
            $mail_id =  $data['email'] ;
            $amount =   $data['amount'] ; 
            $date 	=  date('Y-m-d H:i:s', strtotime($data['created_at'] . ' +2 day'));	
		}
		$subject = 'Euromobile  Welcomes you !'; 
         $message = "<html>
					<head>
					<title>Welcome to Euromobile</title>
					</head>
					<body>
					<p>Hello  ".$name.",</p>
					<p>&nbsp;</p>
					<p>You have successfully placed your order <br/> Your Order NO " . $tran_id . " </p>
					<p>Selling Price £ ". $amount ." </p>
					<p> Your amount will be paid  within ". $date ."</p> 
					<p>Thank you for choosing Euromobiles </p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Euromobile Team</p>
					</body>
					</html>";
		$this->email->set_mailtype("html"); 
		$this->email->to( $mail_id );	
         //$this->email->to('jayanta.saha@met-technologies.com');		
		$this->email->from('jayanta.saha@met-technologies.com', 'Euromobiles');
		$this->email->subject($subject);                   
     	$this->email->message($message);
        $this->email->send();
		}		
		
		$this->cart->destroy();
        $this->session->unset_userdata('transaction_id') ; 
	
	    $this->load->view($this->_container, $data);
		
		
	}
    public function bank_order() {
		
		$data = array();
		
     	$transaction_id =  $this->home_model->get_val('tbl_transaction' , 'id' , $this->session->userdata('transaction_id') , 'transaction_no' ); 
	
		if($this->input->post('account_no')!=""  && $this->input->post('account_name')!="" &&  $this->input->post('short_code')!="" ) { 
	
		
		$insert_data = array(
		'transaction_id' => $transaction_id  ,
        'account_name'	 => $this->input->post('account_name') , 
        'account_no'	 => $this->input->post('account_no') ,
        'short_code'     => $this->input->post('short_code'),
        'created_at'	=> date('Y-m-d H:i:s')	
		);
		
		$this->db->insert('tbl_payment_details', $insert_data);
       $tbl_transaction = $this->db->insert_id();
        if($tbl_transaction!="") {
		
        $transaction_data = $this->db->get_where('tbl_transaction' , array('transaction_no' => $transaction_id))->result_array();
	    $data['header_content']  		= $this->home_model->Show_Page(get_current_language());
		foreach($transaction_data as $tdata ){ 
			$tran_id =  $tdata['transaction_no'] ;
            $name    =  $tdata['student_first_name'].' '. $tdata['student_last_name'] ;
            $mail_id =  $tdata['email'] ;
            $amount =   $tdata['amount'] ; 
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
					<p>Hello  ".$name.",</p>
					<p>&nbsp;</p>
					<p>You have successfully placed your order <br/> Your Order NO " . $tran_id . " </p>
					<p>Selling Price £ ". $amount ." </p>
					<p> Your amount will be paid  within ". $date ."</p> 
					<p>Thank you for choosing Euromobiles </p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Euromobile Team</p>
					</body>
					</html>";
					$this->email->set_mailtype("html"); 
		$this->email->to( $mail_id );		
		$this->email->from('jayanta.saha@met-technologies.com', 'Euromobiles');
		$this->email->subject($subject);                   
     	$this->email->message($message);
        $this->email->send(); 
					
		}
	
	    $data['transaction'] =  $transaction_id ;
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
	public function paypal_post(){
		
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
	public function paypal_success(){
		
		$data = array();
		$data['page_slug'] =  end($this->uri->segments);
		$data['header_content']  		= $this->home_model->Show_Page(get_current_language());		
		$data['brand_list']				= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list
		$data['method'] 		= $this->router->fetch_method();
		$data['page_title'] 	= "Paypal Success";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "paypal_success";
		$data['module'] 		= 'welcome';
		$data['order_id']       = $this->home_model->get_val('tbl_transaction' , 'id' , $this->session->userdata('transaction_id'), 'transaction_no');
	
		if(null !== $this->session->userdata('transaction_id')){
		$status = 'payment done' ; 	
		}
        		
		$this->home_model->update_transaction($status , $data['order_id']);
	
	    $this->cart->destroy();
        $this->session->unset_userdata('transaction_id');  
		//Update order table 
		//$serialize_post_data 	= serialize($_REQUEST);
		//$this->home_model->update_order_status($serialize_post_data);

		//echo "<pre>";print_r($data['cart_products']);exit();
		$this->load->view($this->_container, $data);

	}

	// Paypal cancel   
	public function paypal_cancel(){
		
		$data = array();
		$data['method'] 		= $this->router->fetch_method();
		$data['page_title'] 	= "Paypal Cancel";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "paypal_cancel";
		$data['module'] 		= 'welcome';
		
		//echo "<pre>";print_r($data['cart_products']);exit();
		$this->load->view($this->_container, $data);
       $this->cart->destroy();
        $this->session->destroy() ; 
	}
	
	// Paypal notify   
	public function paypal_notify(){
						
		$data = array();				
		//Write to text file
		$serialize_post_data = serialize($_REQUEST);
		$order_contents = $this->home_model->update_order_status($serialize_post_data);

		$this->cart->destroy();				
		
		$file = fopen("/home/ouronlineportfol/public_html/tradeworld/test.txt","w");
		echo fwrite($file,serialize($order_contents));
		//echo fwrite($file,'Test');
		fclose($file);	
		
		/***********************************************************/
		/* Invoice generate */
		// require('fpdf.php');
		require('mypdf.php');

		$newFile = 'invoices/'.'INVOICE_'.$order_contents['transaction_id'].'.pdf';
		
		$pdf = new MYPDF();

		$pdf->AliasNbPages();

		//$pdf->SetMargins($pdf->left, $pdf->top, $pdf->right); 

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',18);
		//$pdf->Cell(40);
		$pdf -> SetXY(90, 20);
		$pdf->Cell(10,10,'INVOICE',0,0,'C');
		$pdf->Image('assets/frontend/images/logo.png',5,5,0,10,'PNG');
		$pdf -> SetXY(10, 30);
		$pdf->SetFont('Arial','',10);

		$companyaddress = "Tradeworld,
		Address Line 1,
		Address Line 2,
		Phone: 221-9595,
		Email Id: ventas1@repuestosmundiales.com";

		//$pdf->Cell(10,10,$companyaddress,0,0,'L',false);

		$pdf->MultiCell(100, 5, $companyaddress, 0);
		$pdf -> SetXY(130, 37);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell("","",'Order No. :', '0', 0, 'L', false);
		$pdf -> SetXY(160, 37);
		$orderno = $order_contents['id'];
		$pdf->SetFont('Arial','',10);
		$pdf->Cell("","",$orderno, '0', 0, 'L', false);

		/************************************/
		/* Transaction */
		$pdf -> SetXY(130, 42);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell("","",'Transaction Id :', '0', 0, 'L', false);
		$pdf -> SetXY(160, 42);
		$orderdate = $order_contents['transaction_id'];		
		$pdf->SetFont('Arial','',10);
		$pdf->Cell("","",$orderdate, '0', 0, 'L', false);
		/* End */
		/************************************/
		$pdf -> SetXY(130, 47);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell("","",'Order Date :', '0', 0, 'L', false);
		$pdf -> SetXY(160, 47);
		$orderdate =  $order_contents['updated_on'];
		$pdf->SetFont('Arial','',10);
		$pdf->Cell("","",$orderdate, '0', 0, 'L', false);


		$pdf->Ln(10);
		$pdf -> SetXY(10, 65);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell("","",'BILLING ADDRESS,', '0', 0, 'L', false);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',10);

		$billing_address = $order_contents['billing_address']['first_name']."\r\n".$order_contents['billing_address']['last_name']."\r\n".$order_contents['billing_address']['address']." ".$order_contents['billing_address']['city']." ".$order_contents['billing_address']['zip_code']."\r\n".$order_contents['billing_address']['state']."\r\n".$order_contents['billing_address']['country']."\r\nPhone: ".$order_contents['billing_address']['phone']."\r\nEmail ID: ".$order_contents['billing_address']['email'];

		/*
		$vendoraddress = 'Kolkata,
		Address Line 1,
		Address Line 2,
		Phone: 221-9595,
		Email Id: ventas1@repuestosmundiales.com';
		*/

		$pdf->MultiCell(100, 5, $billing_address, 0);
		$pdf -> SetXY(130, 65);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell("","",'SHIPPING ADDRESS,', '0', 0, 'L', false);

		$shipping_address =  $order_contents['shipping_address']['first_name']."\r\n".$order_contents['shipping_address']['last_name']."\r\n".$order_contents['shipping_address']['address']." ".$order_contents['shipping_address']['city']." ".$order_contents['shipping_address']['zip_code']."\r\n".$order_contents['shipping_address']['state']."\r\n".$order_contents['shipping_address']['country']."\r\nPhone: ".$order_contents['shipping_address']['phone']."\r\nEmail ID: ".$order_contents['shipping_address']['email'];

		/*
		$shipping_address = 'Kolkata,
		Address Line 1,
		Address Line 2,
		Phone: 221-9595,
		Email Id: ventas1@repuestosmundiales.com';
		*/

		$pdf -> SetXY(130, 70);
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(100, 5, $shipping_address, 0,"L");
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
		foreach($order_contents['order_details'] as $key=>$value){$j++;
			$grand_total = $grand_total + ($value['price'] * $value['qty']);
			$col = array(

				array('text' => $j, 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

				array('text' => stripslashes($value['product_name']), 'width' => '70', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

				array('text' => $value['qty'], 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

				array('text' => number_format(($value['price'] * $value['qty']),2), 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '10', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR'),

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
		$pdf->Output($newFile,'F');

		/* End Invoice generate */

		/* Mail Section Start */
		$to 	 = $order_contents['user_email'];
		$subject = "Tradeworld Order Invoice";
		$message = "<html>
					<head>
					<title>Tradeworld Order Invoice Email</title>
					</head>
					<body>
					<p>Hi ".$to.",</p>
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
	public function ajax_get_state_list(){

		$data =  array();		
		$country_id = $this->input->post('country_id');
		$data['state_list'] = $this->home_model->get_state_list($country_id); 		
		


		$this->load->view('ajax/ajax_get_state_list', $data);

	}
	
	// Get City List
	public function ajax_get_city_list(){

		$data =  array();		
		$state_id = $this->input->post('state_id');
		$data['city_list'] = $this->home_model->get_city_list($state_id); 		
			
		$this->load->view('ajax/ajax_get_city_list', $data);

	}
	

}
