<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

    
    function __construct() {
        parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('user_model');
		$this->load->model('testing_model');
		
		
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
		else
		{
			$user = $this->ion_auth->user()->row();
        		//$user->first_name;
				
	   
			if(!$this->ion_auth->is_admin($user->id)){
				redirect(base_url('auth/logout'));
			}
			$session_data = array(
				'firstname' => $user->first_name,
				'lastname' => $user->last_name,
				'username' => $user->username
			//'email' => $result[0]->user_email,
			);
			// Add user data in session
			$this->session->set_userdata('logged_in', $session_data);
			
		   $get_role =  $this->testing_model->get_val('users_groups', 'user_id', $user->user_id, 'group_id');  
           $group_name =  $this->testing_model->get_val('groups', 'id', $get_role, 'name');
           $session = array(
		    'usergroup_name' => $group_name 
		   ) ;		   
			$this->session->set_userdata('group_name', $session);
		}
		$this->_container = $this->config->item('bootsshop_template_dir_admin') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');
        //log_message('debug', 'CI My Admin : Auth class loaded');
    }

	public function index()
	{
		redirect('admin/dashboard');
	}
	
	public function dashboard()
	{
		//$data['order_count'] = count($this->order_model->Show_Order());
		$data['page_title'] = "Dashboard";
		$data['page'] = $this->config->item('bootsshop_template_dir_admin') . "dashboard";
		$data['module'] = 'admin';
		$data['no_of_order']=$this->user_model->getCount('tbl_orders',array(1=>1));
		$data['no_of_customer']=$this->user_model->getCount('users',array('id !='=>1));
		//echo $data['no_of_customer'];die;
		$this->load->view($this->_container, $data);
	}
	
	/********************************* salesman details ************************************/
	
	public function salesman(){
		$data['page_title'] = "Sales Man";
		$data['page']       = $this->config->item('bootsshop_template_dir_admin') . "salesman";
		$data['module']     = 'admin';
		$data['salesman_list']  = $this->user_model->get_data($table='salesman');    
		$this->load->view($this->_container, $data);
		
	}
	
	public function check_email(){
		$email = $this->input->post('email_id');
		$result = $this->db->get_where('salesman',array('email'=>$email))->num_rows();
		echo  $result;
	}
	
	public function add_salesman() {
		$data                   = array();
		
		$data['country_list'] 	= $this->user_model->get_country_list(); 	
		$data['state_list'] 	= array(); 		
   		$data['city_list'] 		= array(); 	
	    $data['page_title']     = "Add Salesman";
		$data['page']           = $this->config->item('bootsshop_template_dir_admin') . "add_salesman";
		$data['module']         = 'admin';
		
		if(null !== ($this->input->post('submit'))){
			
	      $this->form_validation->set_rules('email', 'Email', 'trim|required');
		  $this->form_validation->set_rules('dob', 'dob', 'trim|required');
          if ($this->form_validation->run() == true) {
			$arr['fname']                       = $this->input->post('fname') ;
			$arr['lname']                       = $this->input->post('lname');
			$arr['dob']                         =  $this->input->post('dob') ;
			$arr['gender']                      =  $this->input->post('gender') ;
			$arr['category_image']              =  $this->input->post('category_image') ;
			$arr['contact_number']              =  $this->input->post('contact_number') ;
			$arr['email']                       =  $this->input->post('email') ;
			$arr['country_id']                  =  $this->input->post('country') ;
			$arr['state_id']                    =  $this->input->post('state') ;
			$arr['city_id']                     =  $this->input->post('city') ;
			$arr['postal_code']                 =  $this->input->post('postal_code') ;
			$arr['created_date']                =  date('Y-m-d H:i:s');
			$arr1[] =  $arr;
			if($this->db->insert_batch('salesman', $arr1)){
			 $additional_data = array(
		    'username'   => 'salesman' ,
		    'first_name' => $this->input->post('fname'),
		    'last_name'  => $this->input->post('lname'),
		    'phone'      =>  $this->input->post('contact_number'),
		    'created_on' => time(),
		    'active'     => ($manual_activation === false ? 1 : 0)
		);
				$this->ion_auth->register('', '12345', $this->input->post('email'),  $additional_data , array('2'));			
				redirect('admin/salesman' , 'refresh');
			}
		  } else {
			$this -> session -> set_flashdata('update_message','<strong>Validate issue!</strong> Some fields are missing .');
            redirect('admin/add_salesman' , 'refresh');			
		  }
		}
		
		$this->load->view($this->_container, $data);	
	}
	public function edit_salesman(){
	    $id = end($this->uri->segments);
		
        $data                   = array();
        $data['edit_salesman']  = $this->db->get_where('salesman',array('id'=>$id))->result();			
		$data['country_list'] 	= $this->user_model->get_country_list(); 		
	    $data['page_title']     = "Edit Salesman";
		$data['state_list'] 	= $this->user_model->get_state_list($data['edit_salesman'][0]->country_id ); 		
   		$data['city_list'] 		= $this->user_model->get_city_list($data['edit_salesman'][0]->state_id ); 
	   
		if(null !== ($this->input->post('submit'))){
           $insert_data = array(
            'fname'  => $this->input->post('fname') ,
			'lname'  => $this->input->post('lname'),
			'dob'    =>  $this->input->post('dob') ,
			'gender' =>  $this->input->post('gender') ,
			'category_image' =>  $this->input->post('category_image') ,
			'contact_number' =>  $this->input->post('contact_number') ,
		    'email'          =>  $this->input->post('email') ,
			'country_id'    =>  $this->input->post('country') ,
			'state_id'      =>  $this->input->post('state') ,
			'city_id'       =>  $this->input->post('city') ,
			'postal_code'   =>  $this->input->post('postal_code') ,
			'created_date'  =>  date('Y-m-d H:i:s')
			);
				
		 $result = $this->user_model->Update_data($id ,'salesman' ,  $insert_data);
		 if($result == true){
		 $this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
         redirect('admin/salesman' , 'refresh');		 
		 }
        		 
		}
		$data['page']           = $this->config->item('bootsshop_template_dir_admin') . "add_salesman";
		$data['module']         = 'admin';	
		$this->load->view($this->_container, $data);
	   
	}
	
	public function delete_sales(){
		$id = end($this->uri->segments);
		$result = $this->db->delete('salesman', array('id' => $id)); 
		if($result == true)
		{
			$this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record deleted successfully.');
		}
		else
		{
			$this -> session -> set_flashdata('update_message','<strong>Error!</strong>.');
		}
		redirect('admin/salesman' , 'refresh');
		
	}
	
	
	/********************* end sales man *****************************/


	/********************* Leads Details *****************************/

	public function leads(){
		$this->load->library('pagination');

		$data['page_title'] = "Leads";
		$data['page']       = $this->config->item('bootsshop_template_dir_admin') . "leads";
		$data['module']     = 'admin';
		$user_id = $this->ion_auth->get_user_id();
		$data['all_leads']  = $this->user_model->get_leads_details($user_id);

		$limit_per_page = 1;
        $start_index = (end($this->uri->segments)) ? end($this->uri->segments) : 0;
        
    	$config['base_url'] = base_url()."admin/leads";
		$config['total_rows'] = count($data['all_leads']);
		$config['per_page'] = $limit_per_page;

		$data['lead_list']  = $this->user_model->get_leads_details_per_page($user_id,$limit_per_page,$start_index);

		$config['full_tag_open'] = "<ul class='pagination'>";
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';



	    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';


	    $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		//echo "<pre>";print_r($config);die;
		$this->load->view($this->_container, $data);
	}

	public function add_leads() {
		$user_id = $this->ion_auth->get_user_id();
		//echo $user_id;die;
		$data                   = array();
		
		$data['country_list'] 	= $this->user_model->get_country_list();
		$data['state_list'] 	= array();
   		$data['city_list'] 		= array();
   		$data['user_details'] 	= $this->user_model->getUserDataByID($user_id);
   		//echo "<pre>";print_r($data['user_details']);die;
	    $data['page_title']     = "Add Leads";
		$data['page']           = $this->config->item('bootsshop_template_dir_admin') . "add_leads";
		$data['module']         = 'admin';
		
		if(null !== ($this->input->post('submit'))){

			//echo "<pre>";print_r($this->input->post());die;
			
			$this->form_validation->set_rules('cname', 'Customer Name', 'trim|required');
			$this->form_validation->set_rules('csurname', 'Customer Surname', 'trim|required');
			if ($this->form_validation->run() == true) {
				$arr['user_id']               = $this->input->post('user_id') ;
				$arr['make']                  = $this->input->post('make');
				$arr['model']                 =  $this->input->post('model') ;
				$arr['cname']                 =  $this->input->post('cname') ;
				$arr['csurname']              =  $this->input->post('csurname') ;
				$arr['address1']              =  $this->input->post('address1') ;
				$arr['address2']              =  $this->input->post('address2') ;
				$arr['country_id']            =  $this->input->post('country') ;
				$arr['state_id']              =  $this->input->post('state') ;
				$arr['city_id']               =  $this->input->post('city') ;
				$arr['pcode']                 =  $this->input->post('pcode') ;
				$arr['created_date']          =  date('Y-m-d H:i:s');
				$arr1[] =  $arr;
				if($this->db->insert_batch('tbl_leads', $arr1)){
					redirect('admin/leads' , 'refresh');
				}
			} else {
				$this -> session -> set_flashdata('update_message','<strong>Validate issue!</strong> Some fields are missing .');
				redirect('admin/add_leads' , 'refresh');			
			}
		}
		
		$this->load->view($this->_container, $data);	
	}

	public function edit_leads(){
	    $id = end($this->uri->segments);
		
        $data                   = array();
        $data['edit_leads']  	= $this->user_model->get_leads($id);
		$data['country_list'] 	= $this->user_model->get_country_list();
	    $data['page_title']     = "Edit Leads";
		$data['state_list'] 	= $this->user_model->get_state_list($data['edit_leads']['country_id'] ); 		
   		$data['city_list'] 		= $this->user_model->get_city_list($data['edit_leads']['state_id'] ); 
	   
		if(null !== ($this->input->post('submit'))){
           	$insert_data = array(
            	'user_id'               => $this->input->post('user_id'),
				'make'                  => $this->input->post('make'),
				'model'                 =>  $this->input->post('model'),
				'cname'                 =>  $this->input->post('cname'),
				'csurname'              =>  $this->input->post('csurname'),
				'address1'              =>  $this->input->post('address1'),
				'address2'              =>  $this->input->post('address2'),
				'country_id'            =>  $this->input->post('country'),
				'state_id'              =>  $this->input->post('state'),
				'city_id'               =>  $this->input->post('city'),
				'pcode'                 =>  $this->input->post('pcode'),
				'created_date'          =>  date('Y-m-d H:i:s')
			);
				
		 $result = $this->user_model->Update_data($id ,'tbl_leads' ,  $insert_data);
		 if($result == true){
		 $this -> session -> set_flashdata('update_message','<strong>Well done!</strong> Record updated successfully.');
         redirect('admin/leads' , 'refresh');		 
		 }
        		 
		}
		$data['page']           = $this->config->item('bootsshop_template_dir_admin') . "add_leads";
		$data['module']         = 'admin';	
		$this->load->view($this->_container, $data);
	   
	}


	/********************* end leads Details *************************/

	
	/*********************  country list *****************************/
	
	public function ajax_get_state_list(){

		$data =  array();		
		$country_id = $this->input->post('country_id');
		$data['state_list'] = $this->user_model->get_state_list($country_id); 		
		$this->load->view('ajax/ajax_get_state_list', $data);
	}
	
	// Get City List
	public function ajax_get_city_list(){

		$data =  array();		
		$state_id = $this->input->post('state_id');
		$data['city_list'] = $this->user_model->get_city_list($state_id); 					
		$this->load->view('ajax/ajax_get_city_list', $data);
	}
	
	
	
}
?>