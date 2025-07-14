<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends MY_Controller {

    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth'));
		$this->load->library('encryption');
		$this->load->model('testing_model');
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
		$result = $this->testing_model->Show_testing();		
		$data['result'] = $result;
		$data['page_title'] = "Testing Management";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "testing";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
		//redirect('admin/categories');
    }

	
public function testing_update(){
	if($this->input->post('existing_price')) {
 
		$id = $this->input->post('user_id') ;
		$EXITING_PRICE   = $this->input->post('existing_price') ;
		$transaction_no  = $this->input->post('transaction_id') ;
		$revised_cost = $this->input->post('revised_cost') ;
		$to 	         = $this->input->post('email');	
		//$to 	         = 'jayanta.saha@met-technologies.com' ;	
		$link = base_url(get_current_language()).'/verify_new_sellingprice/'.$this->encryption->encrypt($id);
		$rej_link =  base_url(get_current_language()).'/reject_sellingprice';
		
		$insert_data = array(
		'order_id'     =>   $this->input->post('user_id') ,
        'status'       =>	$this->input->post('status'),		
		'revised_cost' =>   $this->input->post('revised_cost')  ? $this->input->post('revised_cost') : "" ,
       	'comments'     =>    $this->input->post('comment')  ?  $this->input->post('comment') : ""
		);
		print_r($insert_data); exit() ; 
        $this->db->insert('testing', $insert_data) ;
	   	
	if($revised_cost == ""){
	 $message = "<html>
					<head>
					<title>Euromobile Product Review</title>
					</head>
					<body>
					<p>Hello  ".$to.",</p>
					<p>&nbsp;</p>
					<p>Your Order no " .$transaction_no. " is verrified and is for sale £ <b>".$EXITING_PRICE."</b> <br/><p>Thank you.</p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Euromobile Team</p>
					</body>
					</html>";	
	}else {
	$message = "<html>
					<head>
					<title>Euromobile Product Review</title>
					</head>
					<body>
					<p>Hello ".$to.",</p>
					<p>&nbsp;</p>
					<p>Your Order no ".$transaction_no."   is verrified and we have set a revised  selling price  £ ".$revised_cost."<br/>
					Your old selling price £ ".$EXITING_PRICE." </br>
					<P>If you accept our new selling price. Please click the link bellow to accept</P>
                    <a href=".$link."> Click here to accept </a>
                   <P> If you reject our new selling price. Please click the link bellow to reject</P>
                    <a href=".$rej_link."> Click here to reject </a>					
					<p>Thank you.</p>
					<p>&nbsp;</p>
					<p>Best Regards,<br/>Euromobile Team</p>
					</body>
					</html>";	
	}

	
    
		$subject = "Euromobile Order Details";
		

		$this->email->set_mailtype("html"); 
		$this->email->to($to);		
		$this->email->from('jayanta.saha@met-technologies.com', 'Euromobiles');
		$this->email->subject($subject);                   
     	$this->email->message($message);
        //$this->email->attach($newFile);
     	$this->email->send();
	  
 
     echo 1;
} 
}

	
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
	
	/****************************************  payment section ****************************/
	public function payment_details() {
	    $result = $this->testing_model->Show_payment();		
		$data['result'] = $result ;
		$data['page_title'] = "Payment Details";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "payment_details";
		$data['module'] = 'admin';
		$this->load->view($this->_container, $data);
	}
	
    public function payment_update(){
		$user_id = $this->input->post('user_id'); 
		$insert_data = array(				
		'payment_details' => $this->input->post('payment')  ? $this->input->post('payment') : "" ,
         'payment_status'         => $this->input->post('status') ,
          'updated_on'         => date("Y-m-d H:i:s")		 
		);
		
		$this->db->where('id',$user_id);
		$this->db->update(TBL_ORDER,$insert_data);
		echo 1 ; 
	}

	
	function transliterateString($txt)
	{
		$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    	return safe_str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
	}
}
?>