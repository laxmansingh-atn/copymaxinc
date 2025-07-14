<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	//protected $lang;
	function __construct() {
        parent::__construct();
        $this->load->library('encryption');
		$this->load->model('home_model');
		$this->load->model('product_model');
		if($this->session->userdata('site_lang') == "")
		{
		$a_lang = $this->config->item('lang_uri_abbr');
		$lang_code = $this->uri->segment(1);
		//echo $lang_code; exit();
		$lang_value = "english";
		if(array_key_exists($lang_code,$a_lang))
		{
			$lang_value = $a_lang[$lang_code];
		}
		$this->session->set_userdata('site_lang', $lang_value);
		}
		else
		{
		$a_lang = $this->config->item('lang_uri_abbr');
		$lang_code = $this->uri->segment(1);
		if(array_key_exists($lang_code,$a_lang))
		{
			$lang_value = $a_lang[$lang_code];
		}
		    //$this->session->set_userdata('site_lang', $lang_value);
		}
    }

    //Home Page
    public function index()
	{
	  $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php"; 
	  $this->_modules = $this->config->item('modules_locations'); 
	  $data = array();
	  $data['page_slug'] =  end($this->uri->segments);
	  //$data['header_content']  = $this->home_model->Show_Page(get_current_language());		
	  //$data['banner_list']	= $this->home_model->Show_Banner('home',get_current_language() ); 	//banner list
	  //$data['brand_list']	= $this->home_model->Show_Brands(get_current_language()); 	//brands list
	  $data['category_lists']	= $this->home_model->Show_Category(); //category  list
      $data['productlist'] = $this->product_model->Show_Products();
	  //print_r($data['productlist']); die;
	  $data['page_title'] 	= "Home";	
	  $data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "index";
	  $data['module'] 		= 'welcome';
      //print_r($data); die;
	  $this->load->view($this->_container, $data);		
    }
    
    // brand by category listing 
	public function display_brand_category () {
		$brand = $this->input->post('brand_slug') ; 
		if(isset ($brand)) {
		$get_data = $this->home_model->Show_Brand_Category(get_current_language() , $brand);
		echo '<div class="row">' ;
		foreach($get_data as $category_list ){
			echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
			echo '<div  class="gallery-desc prod-item-collect">										
												<div class="gallery-inner">
													<a href="'.base_url(get_current_language()).'/product-list/'.$category_list['id'] .'/'. $category_list['category_slug'] .' ">
														<img src="'.$category_list['category_image'] .'" alt="'.$category_list['category_name'] .'"  height="90px" width="70px"/>
														
														<h3>Sell my '.$category_list['category_name'] .'</h3>
													</a> 
												</div>
												</div></div>';
			
		}
		echo '</div>' ; 
		
		}
		else {
			redirect(base_url());
		}
		exit() ; 
	}
	
	// search by model //
	
	public function search_by_model(){
	
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php"; 

		$product_name = $this->home_model->getProductSearch($this->input->post('product_name'));
		$a = "<ul id='modal_name'>";

		foreach($product_name as $product){
		$a .='<li data-value="'. $product->product_id .'||'.$product->product_name.'">'.$product->product_name .'</li>'; 
		}
		$a .= "</ul>";
		echo $a ; 	  
	 
	}
	public function searchby_modelno() {
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php"; 

		$product_name = $this->home_model->getProductSearch($this->input->post('product_name'));
		$a = "<ul id='modal_search'>";

		foreach($product_name as $product){
		$a .='<li data-value="'. $product->product_id .'||'.$product->product_name.'">'.$product->product_name .'</li>'; 
		}
		$a .= "</ul>";
		echo $a ; 	 
		
	}
	
	public function get_modal_data() {
		
	$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
	$data = array();
	$data['page_slug'] =  end($this->uri->segments);
	$data['header_content']  = $this->home_model->Show_Page(get_current_language());
    $data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
    if(!empty ($this->input->post('search_modelno'))){
	
	$data['search_by_modal'][] = $this->home_model->getProductDetails($this->input->post('product_id'), $flag='id');
	foreach($data['search_by_modal'] as $val){
		if(empty($val['product_id']))
			redirect(base_url());
	}
	
	}
		
		$data['page_title'] = "Product List";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "searchby_modal";
		$data['module'] = 'welcome';	
		$this->load->view($this->_container, $data);
	}
	
	
	public function search_my_mobile() {
	//echo '<pre>' ;
  //print_r($_REQUEST); exit();	
	$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
	$data = array();
	$data['page_slug'] =  end($this->uri->segments);
	$data['header_content']  = $this->home_model->Show_Page(get_current_language());
    $data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
    if(!empty ($this->input->post('search_modelno'))){
	
	$data['search_by_modal'][] = $this->home_model->getProductDetails($this->input->post('product_id'), $flag='id');
	foreach($data['search_by_modal'] as $val){
	if(empty($val['product_id']))
		redirect(base_url());
	} 
	}
		
		$data['page_title'] = "Product List";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "searchby_modal";
		$data['module'] = 'welcome';	
		$this->load->view($this->_container, $data); 
	}
	public function reject_sellingprice (){
	 $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
     $this->_modules = $this->config->item('modules_locations');
     $page_slug =  end($this->uri->segments);
     $data_attr = array(
	   'revised_cost_status' => 'declined'
	   );
		$iid = $this->encryption->decrypt($page_slug) ;
		$this->db->where('order_id', $this->encryption->decrypt($page_slug));
		$this->db->update('testing',$data_attr);
		$data = array() ; 
		$data['page_slug'] =  end($this->uri->segments);
		$data['header_content']  = $this->home_model->Show_Page(get_current_language());
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
		$data['page_title'] = "Euromobile update";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "updated_product_price";
		$data['module'] = 'welcome';	
		$this->load->view($this->_container, $data);	   
	}
	
	public function verify_new_sellingprice() {
	    $this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        
	    $page_slug =  end($this->uri->segments);
    //echo $this->encryption->decrypt($page_slug) ; exit() ;
   
	   $data_attr = array(
	   'revised_cost_status' => 'accepted'
	   );
	   $iid = $this->encryption->decrypt($page_slug) ; 
	   $this->db->where('order_id', $this->encryption->decrypt($page_slug));
	   $this->db->update('testing',$data_attr);
	   $data = array() ; 
	   $data['page_slug'] =  end($this->uri->segments);
	   $data['header_content']  = $this->home_model->Show_Page(get_current_language());
       $data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
        $data['page_title'] = "Euromobile new price update";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "updated_product_price";
		$data['module'] = 'welcome';	
		$this->load->view($this->_container, $data);
	}
	
	public function card_check(){
			$number = $this->input->post('card_no') ; 
			// Strip any non-digits (useful for credit card numbers with spaces and hyphens)
			$number=preg_replace('/\D/', '', $number);

			// Set the string length and parity
			$number_length=safe_strlen($number);
			$parity=$number_length % 2;

			// Loop through each digit and do the maths
			$total=0;
			for ($i=0; $i<$number_length; $i++) {
			$digit=$number[$i];
			// Multiply alternate digits by two
			if ($i % 2 == $parity) {
			$digit*=2;
			// If the sum is two digits, add them together (in effect)
			if ($digit > 9) {
			$digit-=9;
			}
			}
			// Total up the digits
			$total+=$digit;
			}

			// If the total mod 10 equals 0, the number is valid
		//	return ($total % 10 == 0) ? TRUE : FALSE;
		if(fmod($total , 10) == 0){
				echo  1 ;
			}
			else {
				echo  2 ; 
			}
	}
	
   //Login & Registration
    public function login_register()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart";
        $this->_modules = $this->config->item('modules_locations');

		$data = array();						
		//echo "<pre>"; print_r($this->input->post());

       // echo htmlentities(end($this->uri->segments));exit;
        $data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
		if($this->ion_auth->logged_in())
		{
			$data['user_id'] = $this->ion_auth->get_user_id();
			$user = $this->ion_auth->user()->row();
			$data['user'] = $user;
		}
		
		if(isset($_POST['user_register']))
		{
			
			$users_arr = $this->home_model->getAllUsers();
			$status = 1;
			$group_id = 2;
			
			$this->form_validation->set_rules('reg_email', 'Email', 'trim|required');
			$this->form_validation->set_rules('reg_password', 'Password', 'trim|required');
			$this->form_validation->set_rules('reg_confirm_password', 'Confirm Password', 'trim|required|matches[reg_password]');
			
			$isExists  = false;			
			
			if($this->form_validation->run() != FALSE)
			{
				foreach($users_arr as $user)
				{
					//echo $users['email']."<br />";
					if($user['email'] == $this->input->post('reg_email'))
					{
						$isExists = true;
						break;
					}
					else
					{
						$isExists = false;
					}
				}

				//echo $isExists;
				if($isExists != true)
				{					

					//if($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array('username'=>$this->input->post('reg_username')), array('2')) != FALSE)
			if($this->ion_auth->register('', $this->input->post('reg_password'), $this->input->post('reg_email'), array(), array('2')) != FALSE)
					{						

						/* Mail Section Start */
						$to 	 = $this->input->post('reg_email');
						$subject = "Euromobile Registration";
						$message = "<html>
									<head>
									<title>Registration Email</title>
									</head>
									<body>
									<p>Hi ".$this->input->post('reg_email').",</p>
									<p>&nbsp;</p>
									<p>Your Registration has been done successfully.<br/>Thank you for joining with Euromobile.</p>
									<p>&nbsp;</p>
									<p>Best Regards,<br/>Euromobile Team</p>
									</body>
									</html>";

						$headers = "From: jayanta.saha@met-technologies.com" . "\r\n";
						@mail($to, $subject, $message, $headers);
						/* Mail Section End */

						$this -> session -> set_flashdata('message','Registration done successfully.');
					}	
				}
				else
				{
					$this -> session -> set_flashdata('user_message','User already exists...');
				}
			}
			else
			{
				$this -> session -> set_flashdata('user_message','Please Insert proper data...');
			}
		}

		if(isset($_POST['user_login']))
		{
			
			$page = $this->uri->segment('2');
			
			$this->form_validation->set_rules('username', 'Username|Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
						
			if($this->form_validation->run() == true)
			{
				$remember = (bool) $this->input->post('remember');
				//echo $this->input->post('username')."  ".$this->input->post('password')."  ".$remember;
				if($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
				{
					$user = $this->ion_auth->user()->row();
					$data['user'] = $user;
                	$this->session->set_flashdata('message', $this->ion_auth->messages());
                						
					//Cart Session Update
					 $cart_contents = $this->cart->contents();  					 
					 //echo "<pre>";print_r($cart_contents);exit();
					 
					 if(!empty($cart_contents)){
				
					  $user_id = $this->ion_auth->get_user_id();
					  $arr = $arr1 = $arr_session = array();
					  foreach($cart_contents as $row){ 

					  	   //echo "<pre>";print_r($row);exit();   
				
						   $arr['user_id']     		= $user_id;  
						   $arr['id']     			= $row['id'];					   					   
						   $arr['product_id']     	= $row['id'];	
						   $arr['name']      		= $row['name'];
						   $arr['price']      		= $row['price'];
						   $arr['qty']      		= $row['qty'];						   
						   $arr['options']['product_attribute_value'] = $row['options']['product_attribute_value'];					   					   
						   $arr_session[] 			= $arr; //Session array    
						   
						   $arr['created_on']     	= date('Y-m-d H:i:s');
						   $arr['updated_on']     	= date('Y-m-d H:i:s'); 
						   $arr['status']      		= 1; 
						   unset($arr['id']);		//for auto increment id
						   unset($arr['options']);	
						   $arr['product_attribute_value']	= $row['options']['product_attribute_value'];					   					   
						   $arr1[] 					= $arr; //Table array 			
					  }
				
					  
					  //Cart Session Update
					  $this->cart->destroy();  
					  $this->cart->insert($arr_session);  					  
					  //echo "<pre>";print_r($arr);//print_r($arr1);
					  //exit;
					  
					  //Update cart table          
					  $this->db->insert_batch('tbl_cart', $arr1);
					}

					if($page=='checkout')
						redirect(base_url('cart/checkout'));
					else	
						//redirect(base_url('profile'));
						redirect(base_url());
				} 
				else
				{
					//echo "<br />ERROR";
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					//redirect('auth', 'refresh');
				}
			}
			else
			{
				$this -> session -> set_flashdata('message',$this->ion_auth->errors());
			}
		}

		//echo "<pre>";print_r($data);exit();
		$data['page_slug'] 		  	= end($this->uri->segments);
		$data['header_content']  	= $this->home_model->Show_Page(get_current_language());				
		$data['brand_list']			= $this->home_model->Show_Brands(get_current_language()); 	//brands list
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //brands list

		$data['page_title'] 	= "Login & Registration";	
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "login";
		$data['module'] 		= 'welcome';
		
		$this->load->view($this->_container, $data);	

	}

    //Cms Page
	public function pages()
	{
		
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');

		$page_slug = end($this->uri->segments);
		if($page_slug == 'home'){ redirect(base_url());}else if($page_slug == 'sell-my-mobile'){ redirect(base_url().'en/sell-my-mobile');} else {} 
		$page_title = safe_str_replace("-"," ",$page_slug);
		$page_title = ucwords($page_title);
		$data = array();
		$data['header_content']  = $this->home_model->Show_Page(get_current_language());
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
		$result_page = $this->home_model->Show_Page_Content($page_slug,get_current_language());
		//$data['banner_list']	= $this->home_model->Show_Banner($page_slug,get_current_language() ); 	//banner list
		
		
		//$data['succ_msg'] 		= $this->session->userdata('succ_msg');	
		//$data['error_msg'] 		= $this->session->userdata('error_msg');	
		//$this->session->unset_userdata('succ_msg');	
		//$this->session->unset_userdata('error_msg');
		$data['breadcrumb'] = array($page_title);
		$data['page_slug'] = $page_slug ; 
		$data['page_content'] = $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['page_title'] = $page_title;
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "pages";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);
	}
	
	public function policy()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        	$this->_modules = $this->config->item('modules_locations');

		$page_slug = end($this->uri->segments);
		$page_title = safe_str_replace("-"," ",$page_slug);
		$page_title = ucwords($page_title);
		//$result_page = $this->home_model->Get_Page($page_slug);
		//$result_page = $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['banner_list']	= $this->home_model->Show_Banner($page_slug,get_current_language() ); 	//banner list
		
		
		//$data['category_list'] 	= $this->home_model->getAllCategory();
		$data['breadcrumb'] = array($this->router->fetch_method(),$page_title);
		$data['page_content'] = $this->home_model->Show_Page_Content($page_slug,get_current_language());
		$data['page_title'] = $page_title;
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "policy";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);
	}

	//Product List 
	public function product_list()
	{
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
		
		$data = array();					
		$data['page_slug']       =  end($this->uri->segments);
		$data['header_content']  = $this->home_model->Show_Page(get_current_language());
		$data['feature_category_list']	= $this->home_model->Show_Feature_Category(get_current_language()); //category  list
			$data['category_content']	= $this->home_model->Get_Category_Content(get_current_language() , $this->uri->segment(3) ); 
	 	$slug = end($this->uri->segments); 
		if($slug==""){
			redirect(base_url());							
		}
		else {
		
			$data['product_list'] = $this->home_model->getProductByCategory($slug);
            
		}		

		
		$data['breadcrumb'] = array("Product List");
		$data['page_title'] = "Product List";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "product_list";
		$data['module'] = 'welcome';


		$this->load->view($this->_container, $data);		
    }
	
	
	
	 public function product_data() {
		
       
          $deliveryData = array(
                'product_id' => $this->input->post('product_id'),
                'price'      => $this->input->post('price'),
				'faulty_price' => $this->input->post('faulty_price'),
                'storage' => $this->input->post('storage')
                );
          $this->session->set_userdata('product_data', $deliveryData);		 
	 }

	//Product details 
	public function product_details()
	{

		//echo "product details"; die;
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        
		$data = array();			
		$slug = end($this->uri->segments);

			//$table = 'tbl_products';
		    //$id = $product_data['product_id'];
			/*$data['page_slug']       =  end($this->uri->segments);
            $data['header_content']  =  $this->home_model->Show_Page(get_current_language());			
		    $data['product_details'] =  $this->home_model->getProductDetails($id) ; 
            $data['image_list']      =   $this->home_model->getProductImage($id);		
			$data['varient_value']   =   $product_data['storage'];            
			$data['regular_price']    =   $product_data['price'];
			$data['faulty_price']    =   $product_data['faulty_price'];
	        $data['attribute_data']   =   $this->home_model->get_attribute_value();
		    $data['show_networks']     =   $this->home_model->Show_Networks($product_data['product_id'] , $product_data['storage']);*/
			
		$data['page_title'] 		= "Product Details";
		$data['page'] 				= $this->config->item('bootsshop_template_dir_welcome') . "product_details";
		$data['module']				= 'welcome';

		//echo "<pre>";print_r($data);exit();
		$this->load->view($this->_container, $data);
		
		
    }

    //Contact Us Page
    public function contact_us()
	{
			
		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout.php"; 
        $this->_modules = $this->config->item('modules_locations');

        $data = array();				
	

		$data['page_title'] 	= "Contact Us";
		$data['page'] 			= $this->config->item('bootsshop_template_dir_welcome') . "contactus";
		$data['module'] 		= 'welcome';

		//echo "<pre>";print_r($data['content']);exit();

		$this->load->view($this->_container, $data);
	}

	//Contact us info add
    public function contact_info_add()
	{		
		$temp_arr = $this->input->post();
		$temp_arr['created_on'] = date('Y-m-d h:i:s');

    	$this->db->insert('tbl_contact_info', $temp_arr);
    	$this->session->set_userdata('succ_msg', 'Your email has been sent successfully. we will get back you soon.');
    	redirect(base_url('contact-us'));
	}


	//unusesd part
	public function category()
	{
		$slug = end($this->uri->segments);
		$products = $this->home_model->getProductByCategorySlug($slug);
		$data['category_id'] = $this->home_model->getCategoryId($slug);
		$data['products'] = $products;
		$data['page_title'] = "Category";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "category";
		$data['module'] = 'welcome';
		
		$product_ids = array();
		//echo "<pre>";print_r($data['products']);exit();
		if(!empty($products)){
			foreach($products[0]['product'] as $record){
				$product_ids[] = $record['product_id'];
			}

			$data['product_details'] = $this->home_model->getProductDetailsValue($product_ids, $flag='category');	
			//echo "<pre>";print_r($data['product_details']);exit();
		}
			
		$this->load->view($this->_container, $data);
		//redirect('admin/categories');
    }
	
	//Get product by category 
    public function get_products_by_filter(){
		
		$data 				= $this->input->post();
		$arr = array();
		$arr['products'] 	= array();				
		if($data['cat_id']!=''){
			$arr['products'] 	= $this->home_model->get_products_by_filter($data);				
		}
		//echo "<pre>";print_r($arr);exit();				
		$this->load->view("ajax/ajax_product_by_filter", $arr);	
		
			
    }
	
	public function my_account()
	{
		//echo htmlentities(end($this->uri->segments));exit;
		if($this->ion_auth->logged_in())
		{
			$data['user_id'] = $this->ion_auth->get_user_id();
			$user = $this->ion_auth->user()->row();
			$data['user'] = $user;
		}
		
		if(isset($_POST['userregister']))
		{
			//echo $this->get_client_ip_server(); exit;
			//$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			//$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			//$this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
			$a_users = $this->home_model->getAllUsers();
			$status = 1;
			$group_id = 2;
			//$user_role = "members";
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$isExists  = false;
			/*$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
			$this->form_validation->set_rules('company_name', 'Password', 'trim|required');
			$this->form_validation->set_rules('user_role', 'User Role', 'trim|required');*/
			
			//$this->form_validation->set_rules('user_status', 'User Status', 'trim|required');
			//print_r($data);
			
			if($this->form_validation->run() != FALSE)
			{
				foreach($a_users as $users)
				{
					//echo $users['email']."<br />";
					if($users['email'] == $this->input->post('email'))
					{
						$isExists = true;
						break;
					}
					else
					{
						$isExists = false;
					}
				}
				//echo $isExists;
				if($isExists != true)
				{
					if($this->ion_auth->register('', $this->input->post('password'), $this->input->post('email'), array(), array('2')) != FALSE)
					{
						$this -> session -> set_flashdata('user_message','Registration done successfully.');
					}
					/*$time = time();
					$insert_data = array(
						'ip_address'	=>	$this->get_client_ip_env(),	
						'email'			=>	$this->input->post('email'),
						'password'		=>	md5($this->input->post('password')),
						'active'		=>	$status,
						'created_on' 	=>	$time
					);
					$id = $this->home_model->Insert_UserData($insert_data);
					if($id > 0)
					{
						$group_data = array(
							'user_id'	=> $id,
							'group_id'	=> $group_id
						);
						$this->home_model->Insert_UserGroup($group_data);
						$data['error'] = "success";
						$this -> session -> set_flashdata('user_message','Registration done successfully.');
					}*/
				}
				else
				{
					$this -> session -> set_flashdata('user_message','User already exists...');
				}
			}
			else
			{
				$this -> session -> set_flashdata('user_message','Please Insert proper data...');
			}
		}
		
		if(isset($_POST['userlogin']))
		{
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			
			if($this->form_validation->run() == true)
			{
				$remember = (bool) $this->input->post('remember');
				//echo $this->input->post('username')."  ".$this->input->post('password')."  ".$remember;
				if($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
				{
					$user = $this->ion_auth->user()->row();
					$data['user'] = $user;
                	$this->session->set_flashdata('message', $this->ion_auth->messages());
                	//redirect('/admin/dashboard', 'refresh');
					//echo "<br />".$this->ion_auth->get_user_id(); exit;
					//$data['user_id'] = $this->ion_auth->get_user_id();
					/*$data['page_title'] = "MI CUENTA";
					$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "account";
					$data['module'] = 'welcome';
					$this->load->view($this->_container, $data);*/
					
					//Cart Session Update
					 $cart_contents = $this->cart->contents();  
					 //echo "<pre>";print_r($arr1);print_r($arr_session);exit();
					 
					 if(!empty($cart_contents)){
				
					  $user_id = $this->ion_auth->get_user_id();
					  $arr = $arr1 = $arr_session = array();
					  foreach($cart_contents as $row){   
				
					   $arr['user_id']     		= $user_id;  
					   $arr['product_id']     	= $row['id'];
					   $arr['product_detail_id'] = $row['product_detail_id'];
					   $arr['product_attribute_value'] = $row['product_attribute_value'];
					   $arr['product_stock']   	= $row['product_stock'];
					   $arr['name']      		= $row['name'];
					   $arr['price']      		= $row['price'];
					   $arr['qty']      		= $row['qty'];
					   $arr_session[] 			= $arr; //Session array    
					   
					   $arr['created_on']     	= date('Y-m-d H:i:s');
					   $arr['updated_on']     	= date('Y-m-d H:i:s'); 
					   $arr['status']      		= 1; 
					   $arr1[] 					= $arr; //Table array 			
				
					  }
				
					  /*print_r($arr1);
					  
					  print_r($arr_session);
					  exit;*/
					  //Cart Session Update
					  $this->cart->destroy();  
					  $this->cart->insert($arr_session);  
					  //Update cart table          
					  $this->db->insert_batch('tbl_cart', $arr1);
					}
				} 
				else
				{
					//echo "<br />ERROR";
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					//redirect('auth', 'refresh');
				}
			}
			else
			{
				$this -> session -> set_flashdata('message',$this->ion_auth->errors());
			}
		}
		
		$data['page_title'] = "MI CUENTA";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "account";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);
		//redirect('admin/categories');
    }

    //My Account
    public function profile(){

		$this->_container 	= $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart.php";
        $this->_modules 	= $this->config->item('modules_locations');

		//Get order list
		$data['user_id'] 	= $this->ion_auth->get_user_id();
        $data['order_list'] = $this->home_model->get_order_list($data['user_id']); 

        $data['content'] 	= $this->home_model->get_val('tbl_pages', 'page_slug', 'dashboard', 'page_description');	

		$data['shipping_address'] 	= $this->home_model->get_address_details($data['user_id'], 'shipping'); 	
		$data['billing_address'] 	= $this->home_model->get_address_details($data['user_id'], 'billing'); 	

        //echo"<pre>"; print_r($data); exit;

    	$data['page_title'] = "My Profile";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "my_account";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);
    }

    //Order details
    public function order_details(){

		$order_id 			= $this->input->post('order_id');				
        //exit($order_id);

        $data['order_list'] = $this->home_model->get_order_details($order_id); 
		//echo "<pre>";print_r($data);exit();
				
		if(!empty($data['order_list'])){
			$this->load->view("ajax/ajax_get_order_details", $data);	
		}else{
			echo '0';
		}		
				
    }

    //Address details
    public function address_details(){

    	$user_id     	 		= $this->ion_auth->get_user_id();
		$type 					= $this->input->post('type');				        

        $data['address'] 		= $this->home_model->get_address_details($user_id, $type); 		
        $data['country_list'] 	= $this->home_model->get_country_list(); 		
		$data['state_list'] 	= array(); 		
   		$data['city_list'] 		= array(); 		
   		
       	if(!empty($data['address'])){
       		$data['state_list'] = $this->home_model->get_state_list($data['address']['country_id']); 		
       		$data['city_list'] 	= $this->home_model->get_city_list($data['address']['state_id']); 		
       	}

		//echo "<pre>";print_r($data);exit();
			
		if($type=='shipping')				
			$this->load->view("ajax/ajax_set_shipping_address", $data);	
		else
			$this->load->view("ajax/ajax_set_billing_address", $data);		
			
    }

    //Update address details
    public function update_address_details($type){	        	

		$data = $this->input->post();				        
		$this->home_model->update_address_popup($data, $type);

		redirect(base_url('profile'));				
    }
	
	//Logout	
	public function logout() 
	{
        $this->ion_auth->logout();
		$this->cart->destroy();
        redirect(base_url());
    }
	
	public function forget_password()
	{
		if(isset($_POST['forget_password']))
		{
			$this->form_validation->set_rules('user_email', 'User Email', 'trim|required');

			if($this->form_validation->run() != FALSE)
			{
				$user_email = $this->input->post('user_email');
				$result = $this->home_model->checkUserByEmail($user_email);
				
				if(count($result) > 0)
				{
					$forgotten = $this->ion_auth->forgotten_password($user_email);
					//echo count($forgotten)."<br>";
					//echo $forgotten['forgotten_password_code']."<br>";
					//echo"<pre>"; print_r($forgotten); exit;
					
					$this->email->set_mailtype("html");			
					$this->email->from('admin@tradeworld.com', 'Tradeworld');
					$this->email->to($user_email); 
					
					$this->email->subject('Forgot Password');
					
					$forget_link = base_url()."my-account/reset-password/?key=".$forgotten['forgotten_password_code'];
		
					$message = "<html>
									<head>
									<title>Forgot Password</title>
									</head>
									<body>
									<p>Hi ".$this->input->post('reg_email').",</p>
									<p>&nbsp;</p>
									<p>Click <a href='$forget_link'>here</a> to reset your tradeworld account password.</p>
									<p>&nbsp;</p>
									<p>Best Regards,<br/>Tradeworld Team</p>
									</body>
									</html>"; 			

					
					$this->email->message($message);						
					
					if($this->email->send()){
						$this->session->set_flashdata('message', 'Please check your email to reset your tradeworld account password.');						
					}else{
						$this->session->set_flashdata('message', 'Please try again.');						
					}		
				}
				else
				{
					$this->session->set_flashdata('message', 'Please try again.');					
				}

				redirect(base_url("login/"), 'refresh');
			}
		}
		
		//$data['page_title'] = "";
		//$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "lostpassword";
		//$data['module'] = 'welcome';
		//$this->load->view($this->_container, $data);
	}
	
	public function reset_password()
	{

		$this->_container = $this->config->item('bootsshop_template_dir_welcome') . "layout/layout_cart";
        $this->_modules = $this->config->item('modules_locations');

		//$forget_code = end($this->uri->segments);

		$code = $this->input->get('key');
		$data = array();
		$data['code'] = $code;

		if(isset($_POST['reset_password']))
		{			

			$this->form_validation->set_rules('password_1', 'Password 1', 'trim|required');
			$this->form_validation->set_rules('password_2', 'Password 2', 'trim|required');
			
			$password1 = $this->input->post('password_1');
			$password2 = $this->input->post('password_2');
			
			if($password1 == $password2)
			{
				$reset = $this->ion_auth->forgotten_password_complete($code, $password1);				

				if ($reset) 
				{  					
					//if the reset worked then send them to the login page
					$this->session->set_flashdata('message', $this->ion_auth->messages());								
				}
				else
				{ 
					//if the reset didnt work then send them back to the forgot password page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					//redirect("auth/forgot_password", 'refresh');					
				}
			}
			else
			{
				$this->session->set_flashdata('message', "Password doesn't match. Please try again.");
			}

			redirect(base_url("login/"), 'refresh');			
		}
		
		$data['page_title'] = "Reset Password";
		$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "resetpassword";
		$data['module'] = 'welcome';
		$this->load->view($this->_container, $data);
		
	}
	
	public function billing_address()
	{
		//if(isset($this->session->userdata['user_id']))
		if($this->ion_auth->logged_in())
		{
			$user_id = $this->ion_auth->get_user_id();
			$user_email = $this->ion_auth->user()->row()->email;
			//$user_id = $this->session->userdata['user_id'];
			//echo $user_id."<br />";
			//echo $this->ion_auth->user()->row()->email;
			$a_users = $this->home_model->getBillingAddressByUser($user_id);
			//echo count($a_users);
			if(isset($_POST['save_billing_address']))
			{
				$this->form_validation->set_rules('billing_first_name', 'First Name', 'trim|required');
				$this->form_validation->set_rules('billing_last_name', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('billing_email', 'Email', 'trim|required');
				$this->form_validation->set_rules('billing_phone', 'Phone', 'trim|required');
				$this->form_validation->set_rules('billing_country', 'Country', 'trim|required');
				$this->form_validation->set_rules('billing_address_1', 'Address', 'trim|required');
				//$this->form_validation->set_rules('billing_address_2', 'Address', 'trim|required');
				$this->form_validation->set_rules('billing_city', 'City', 'trim|required');
				$this->form_validation->set_rules('billing_state', 'State', 'trim|required');
				
				if($this->form_validation->run() != FALSE)
				{
					$time = date('Y-m-d H:i:s');
					$first_name = $this->input->post('billing_first_name');
					$last_name = $this->input->post('billing_last_name');
					$email = $this->input->post('billing_email');
					$company = $this->input->post('billing_company');
					$phone = $this->input->post('billing_phone');
					$country = $this->input->post('billing_country');
					$address1 = $this->input->post('billing_address_1');
					$address2 = $this->input->post('billing_address_2');
					$city = $this->input->post('billing_city');
					$state = $this->input->post('billing_state');
					$postcode = $this->input->post('billing_postcode');
					
					if(count($a_users) > 0)
					{
						$update_data = array(
							'first_name'	=> $first_name,	
							'last_name'		=> $last_name,
							'company_name'	=> $company,
							'phone'			=> $phone,
							'country'		=> $country,
							'address1'		=> $address1,
							'address2'		=> $address2,
							'city'			=> $city,
							'province'		=> $state,
							'postal_code'	=> $postcode,
							'updated_at' 	=> $time
						);
						$this->home_model->Update_Billing_Address($user_id,$update_data);
					}
					else if(count($a_users) == 0)
					{
						$insert_data = array(
							'user_id'		=> $user_id,
							'first_name'	=> $first_name,	
							'last_name'		=> $last_name,
							'company_name'	=> $company,
							'phone'			=> $phone,
							'country'		=> $country,
							'address1'		=> $address1,
							'address2'		=> $address2,
							'city'			=> $city,
							'province'		=> $state,
							'postal_code'	=> $postcode,
							'created_at'	=> $time,
							'updated_at' 	=> $time
						);
						$this->home_model->Insert_Billing_Address($insert_data);
					}
				}
			}
			$data['user_email'] = $user_email;
			$data['users'] = $a_users;
			$data['page_title'] = "";
			$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "billingaddress";
			$data['module'] = 'welcome';
			$this->load->view($this->_container, $data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function shipping_address()
	{
		//if(isset($this->session->userdata['user_id']))
		if($this->ion_auth->logged_in())
		{
			$user_id = $this->ion_auth->get_user_id();
			$user_email = $this->ion_auth->user()->row()->email;
			//$user_id = $this->session->userdata['user_id'];
			//echo $user_id."<br />";
			//echo $this->ion_auth->user()->row()->email;
			$a_users = $this->home_model->getShippingAddressByUser($user_id);
			//echo count($a_users);
			if(isset($_POST['save_shipping_address']))
			{
				$this->form_validation->set_rules('shipping_first_name', 'First Name', 'trim|required');
				$this->form_validation->set_rules('shipping_last_name', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('shipping_email', 'Email', 'trim|required');
				$this->form_validation->set_rules('shipping_phone', 'Phone', 'trim|required');
				$this->form_validation->set_rules('shipping_country', 'Country', 'trim|required');
				$this->form_validation->set_rules('shipping_address_1', 'Address', 'trim|required');
				//$this->form_validation->set_rules('shipping_address_2', 'Address', 'trim|required');
				$this->form_validation->set_rules('shipping_city', 'City', 'trim|required');
				$this->form_validation->set_rules('shipping_state', 'State', 'trim|required');
				
				if($this->form_validation->run() != FALSE)
				{
					$time = date('Y-m-d H:i:s');
					$first_name = $this->input->post('shipping_first_name');
					$last_name = $this->input->post('shipping_last_name');
					$email = $this->input->post('shipping_email');
					$company = $this->input->post('shipping_company');
					$phone = $this->input->post('shipping_phone');
					$country = $this->input->post('shipping_country');
					$address1 = $this->input->post('shipping_address_1');
					$address2 = $this->input->post('shipping_address_2');
					$city = $this->input->post('shipping_city');
					$state = $this->input->post('shipping_state');
					$postcode = $this->input->post('shipping_postcode');
					
					if(count($a_users) > 0)
					{
						$update_data = array(
							'first_name'	=> $first_name,	
							'last_name'		=> $last_name,
							'company_name'	=> $company,
							'phone'			=> $phone,
							'country'		=> $country,
							'address1'		=> $address1,
							'address2'		=> $address2,
							'city'			=> $city,
							'province'		=> $state,
							'postal_code'	=> $postcode,
							'updated_at' 	=> $time
						);
						$this->home_model->Update_shipping_Address($user_id,$update_data);
					}
					else if(count($a_users) == 0)
					{
						$insert_data = array(
							'user_id'		=> $user_id,
							'first_name'	=> $first_name,	
							'last_name'		=> $last_name,
							'company_name'	=> $company,
							'phone'			=> $phone,
							'country'		=> $country,
							'address1'		=> $address1,
							'address2'		=> $address2,
							'city'			=> $city,
							'province'		=> $state,
							'postal_code'	=> $postcode,
							'created_at'	=> $time,
							'updated_at' 	=> $time
						);
						$this->home_model->Insert_shipping_Address($insert_data);
					}
				}
			}
			$data['user_email'] = $user_email;
			$data['users'] = $a_users;
			$data['page_title'] = "";
			$data['page'] = $this->config->item('bootsshop_template_dir_welcome') . "shippingaddress";
			$data['module'] = 'welcome';
			$this->load->view($this->_container, $data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	// Function to get the client ip address
	public function get_client_ip_env()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
	
	// Function to get the client ip address
	public function get_client_ip_server()
	{
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}

	public function Request_Quote(){
	  $insert_data = array(  
	   'name'   => $this->input->post('quote_name'),
	   'phone'   => $this->input->post('quote_phone'),
	   'email'   => $this->input->post('quote_email'),
	   'address'  => $this->input->post('quote_address'),
	   'created_at' => date('Y-m-d H:i:s'),
	   'updated_at' => date('Y-m-d H:i:s')
	  );
	  $result = $this->home_model->add_Quote($insert_data);
	  echo $result;
	 }

	 //GET in TOUCH 
	 public function GetInTouch(){

	  $contact_first_name = $this->input->post('contact_first_name');
	  $contact_last_name = $this->input->post('contact_last_name');
	  $contact_phone = $this->input->post('contact_phone');
	  $contact_email = $this->input->post('contact_email');
	  $contact_message = $this->input->post('contact_message');
	  $name = $contact_first_name." ".$contact_last_name;
	  //////////////////////  email send /////////////////////////////

	  $this->email->set_mailtype("html");   
	  $this->email->from($contact_email, $name);
	  $this->email->to('arghya.saha@met-technologies.com'); 
	  //$this->email->bcc('arghya.saha@met-technologies.com'); 

	  $this->email->subject('Get In Touch');

	  $message = " Hi,<br><br>
	  ".$contact_message."<br>
	  Thank you<br><br>".$name;   

	  $this->email->message($message); 

	  $this->email->send();

	  //////////////////////  email send end /////////////////////////////
	  //$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Mail has been sent successfully.');
	  //redirect(current_url());

	 }


}
