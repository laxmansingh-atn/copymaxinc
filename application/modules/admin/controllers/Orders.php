<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Orders extends MY_Controller {



    function __construct() {

        parent::__construct();

		$this->load->library(array('ion_auth'));

		$this->load->model('order_model');

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

		$result = $this->order_model->Show_Order();
		//$order_details = $this->mcommon->getRow('tbl_orders');
		//$customer_details = $this->mcommon->Show_Order();
		//$billing_details = $this->mcommon->Show_Order();

		$data['result'] = $result;

		$data['page_title'] = "Order Management";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "orders";

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

	}

	

	public function add()

	{

		$category_list = $this->category_model->Show_Category();

		if(isset($_POST['submit']))

		{

			$this->form_validation->set_rules('category_name', 'Brand Name', 'trim|required');

			//$this->form_validation->set_rules('category_image', 'Brand Image', 'trim|required');

			$this->form_validation->set_rules('category_status', 'Brand Status', 'trim|required');

			

			//echo $_FILES['category_image']['name']; exit;

			if ($this->form_validation->run() != FALSE)

			{

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

							'category_image'	=>	$upload_root_path.$upload['upload_data']['file_name'],

							'parent_category'	=>	$this->input->post('parent_category'),

							'status'			=> 	$this->input->post('category_status'),

							'created_at'		=>	date('Y-m-d H:i:s'),

							'updated_at'		=>	date('Y-m-d H:i:s')

						);

						$this->category_model->Insert_Category($insert_data);

					}

				}

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

			else

			{

				$data['error'] = "Please fill up all the required fields";

				//array('error' => $this->upload->display_errors()); 

				//$this -> session -> set_flashdata('update_message',$this->upload->display_errors());

			}

		}

		$data['category_list'] = $category_list;

		$data['page_title'] = "Category";

		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "categories";

		$data['module'] = 'admin';

		$this->load->view($this->_container, $data);

	}*/

	

	public function edit()

	{

		//$uploadchk = false;

		$id = end($this->uri->segments);

		$order_detail = $this->order_model->Get_Order_Detail($id);

		//$result = $this->category_model->Get_Category($id);

		//print_r(json_decode(json_encode($result), true));

		if(isset($_POST['edit']))

		{

			$update_data = array(		

			'delivery_status'	=>	$this->input->post('delivery_status'),

			'updated_on'	=>	date('Y-m-d H:i:s')

			);

			$result = $this->order_model->Update_Order($id,$update_data);

			if($result == true)

			{

				$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');

			}

			redirect(base_url().'admin/orders');

		}

		else

		{

			//print_r($result);

			$data['result'] = $order_detail;

			//$data['category_list'] = $category_list;

			$data['page_title'] = "Order Details #".$id;

			$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "orders";

			$data['module'] = 'admin';

			$this->load->view($this->_container, $data);

		}

		

	}

	

	public function change_status(){
		$image_full_path='';
		$status = $_REQUEST['status'];
		$order_id = $_REQUEST['order_id'];	
		$title= (isset($_REQUEST['title']) && !empty($_REQUEST['title']))?$_REQUEST['title']:'N/A';
		$description= (isset($_REQUEST['description']) && !empty($_REQUEST['description']))?$_REQUEST['description']:'N/A';
		$shipping_no= (isset($_REQUEST['shipping_no']) && !empty($_REQUEST['shipping_no']))?$_REQUEST['shipping_no']:'';
		
		$update_data =array('order_status'=>$status,'shipping_no'=>$shipping_no);
		$order_status_data = array();
		$order_status_data['order_id']	= $order_id;
		$order_status_data['order_status']	= $status;
		$order_status_data['title']	= $title;
		$order_status_data['description']	= $description;
		$order_status_data['shipping_no']	= $shipping_no;
		$order_status_data['created_by']	= $this->ion_auth->get_user_id();
		$order_status_data['created_ts']	= date('Y-m-d H:i:s');
		
		if (!empty($_FILES['image']['name'])) {

			$path = './uploads/status/';
			$upload_file = $this->single_image_upload($path, $_FILES['image'],'status_change_images');
			
			if($upload_file['status']==1){
				$order_status_data['image']=$upload_file['result'];
				$image_full_path = $upload_file['result'];
			}
			else{
				$return_data=array('status'=>false,'message'=>$upload_file['result']);	
				echo json_encode($return_data);exit;
			}
		}

		$insert_order_status_history=$this->order_model->insert('tbl_order_status_history',$order_status_data);
		if($insert_order_status_history){
			
			$result = $this->order_model->Update_Order($order_id,$update_data);
				
				if($status == 1){
					$order_status_msg='order approved and it is in production';
				}
				elseif($status == 2){
					$order_status_msg='Order received but there is a problem';
				}
				elseif($status == 3){
					$order_status_msg='Please see attached proof and confirm, <b style="color:red;">your order is on hold until you reply to this email and put "Approved" in the subject line</b>';
				}
				elseif($status == 4){
					$order_status_msg='Order ready for pick up';
				}
				elseif($status == 5){
					$order_status_msg='Order delivered free of charge';
				}
				elseif($status == 6){
					$order_status_msg='Order has been shipped & UPS Tracking Reference No : '.$shipping_no.'.<br>Please click in this link and track your order with  the reference number. <a href="https://www.ups.com/track">Track Your Order</a>';
				}
				elseif($status == 7){
					$order_status_msg='Order Delivered';
				}

			
			if($result == true){

				$order_details=$this->order_model->Order_details($order_id);
				
				$mail_temp = file_get_contents('./global/mail/order_status_change.html');
                                        
				$mail_temp = safe_str_replace("{LOGO}", base_url('./assets/frontend/images/logo.png'), $mail_temp);
				$mail_temp = safe_str_replace("{web_url}", base_url(), $mail_temp);
				
				$mail_temp = safe_str_replace("{COMPANY_NAME}", "Copymax Inc.", $mail_temp);
				$mail_temp = safe_str_replace("{COMPANY_PHONE}", '1-844-Copymax (2679629)', $mail_temp);
				$mail_temp = safe_str_replace("{COMPANY_EMAIL}", '<a href="mailto:copymaxinc@gmail.com">info@copymaxinc.com</a>', $mail_temp);
				$mail_temp = safe_str_replace("{current_year}", date('Y'), $mail_temp);
				$mail_temp = safe_str_replace("{CUSTOMER_NAME}", $order_details['first_name'] . ' ' . $order_details['last_name'], $mail_temp);
				$mail_temp = safe_str_replace("{order_no}", $order_details['order_id'], $mail_temp);
				$mail_temp = safe_str_replace("{order_status}", $order_status_msg, $mail_temp);
				$mail_temp = safe_str_replace("{title}", $title, $mail_temp);
				$mail_temp = safe_str_replace("{description}", $description, $mail_temp);
				
				//echo $mail_temp;die;
				
				$customer_email=isset($order_details['email'])?$order_details['email']:'';
				$customer_email=isset($order_details['email'])?$order_details['email']:'';
			    //$data['to'] = 'copymaxinc@gmail.com,'.($customer_email)?','.$customer_email :'';
				//$data['to'] = 'copymaxinc@gmail.com,'.($customer_email)?','.$customer_email :'';	
		        $data['to'] = 'copymaxinc@gmail.com,'.($customer_email)?','.$customer_email :'';
                                
				//$data['to']='arindam.biswas@met-technologies.com';   bghooshmand@gmail.com,arshad.iqbal@fitser.com
				$data['name'] = 'Copymax Inc.';
				$data['subject'] = 'Order Status Change';
				$data['message'] = $mail_temp;
				$data['from'] = EMAIL_SMTP_FROM_EMAIL;
				$this->sendMail($data,$image_full_path);
				
				$return_data=array('status'=>true,'message'=>'Order Status Updated Successfully');

			}

			else{

				$return_data=array('status'=>false,'message'=>'Unable To Update');

			}
		}
			echo json_encode($return_data);
	}

	private function single_image_upload($path,$files,$document_type){
		
		$fileName = $document_type.'_'.time().'_'. safe_str_replace(" ","_",$files['name']);
		$config = array(
			'upload_path'   => $path,
			'allowed_types' => 'gif|jpg|png|jpeg|pdf|xls|xlsx|doc|docx',
			'overwrite'     => 1,
			'file_name'		=>$fileName
		);
		$this->load->library('upload', $config); 
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')){
			
			$message = array('result' => $this->upload->display_errors(),'status'=>0);
		}else{ 
			
			$data = array('upload_data' => $this->upload->data());
			$message = array('result' => $data['upload_data']['file_name'],'status'=>1);
		}
		// print_r($message);die;
		return $message;
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
	
	public function delete_orders() {

		//$id = $this->uri->segment(4);
		$id = end($this->uri->segments);
		//echo $id; exit;

		$result = $this->order_model->Delete_Orders($id);
		$result1 = $this->order_model->Delete_Order_History($id);

		if($result == true && $result1 == true)	{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Order deleted successfully.');
		} else {
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
	}

	function transliterateString($txt)

	{

		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');

    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);

	}

	private function sendMail($data,$image_full_path=null)
    {
		$config = get_updated_smtp_config();
        $this->email->initialize($config);

        $this->email->set_crlf("\r\n");

        $this->email->from(EMAIL_SMTP_FROM_EMAIL, EMAIL_SMTP_FROM_NAME);
		$this->email->to($data['to']);
		$this->email->reply_to('copymaxinc@gmail.com', 'Copymax Inc.');
        //$this->email->to('amitava.rc25@gmail.com'); 
		
        $this->email->subject($data['subject']);
		$this->email->message($data['message']);
		
		
		if (!empty($image_full_path)) {
           $image_path = './uploads/status/'.$image_full_path;	
		   $this->email->attach($image_path);
        }

        if ($this->email->send()) {

            return true;
        } else {
            return false;
            //print_r($this->email->print_debugger());
            //die;
        }
    }

}

?>