<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Order_model extends CI_Model

{



      

  /*   public function Show_Order()

	{

		$this->db->select('tbl_transaction.*,tbl_products.product_name , tbl_product_image.product_image , tbl_order_details.qty ,tbl_orders.payment_status , tbl_orders.payment_details');

		$this->db->from('tbl_transaction');

		$this->db->join('tbl_order_details', 'tbl_order_details.order_id = tbl_transaction.order_id','left');

		$this->db->join('tbl_products', 'tbl_products.product_id = tbl_order_details.product_id','left');

		$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');

		$this->db->join('tbl_orders', 'tbl_orders.id = tbl_transaction.order_id','left');

		//$this->db->where(array('tbl_page_content.language_code' => $lang));



		$result = $this->db->get();

		//echo $this->db->last_query();exit();

		return $result->result();		

	}	*/

	

	 public function Show_Order()

	{

		$this->db->select('to.*,tp.product_name,tp.product_id,u.first_name,u.last_name,u.phone,tba.first_name,tba.last_name,tba.email,tba.phone,tba.country, tba.state, tba.city, tba.address, tba.zip_code, tba.title');

		$this->db->from('tbl_orders to');

		$this->db->join('tbl_products tp', 'tp.product_id = to.product_id','left');

		$this->db->join('users u', 'u.id = to.user_id','left');

		$this->db->join('tbl_billing_address tba', 'tba.id = to.billing_id','left');

		$this->db->order_by('to.id', 'DESC');

		//$this->db->join('tbl_shipping_address tsa', 'tsa.id = to.shipping_id','left');

		



		$result = $this->db->get();

		//echo $this->db->last_query();exit();

		return $result->result();		

	}	

	

	

	public function Order_details($order_id)

	{

		$this->db->select('to.*,tp.product_name,tp.product_id,u.first_name,u.last_name,u.email,u.phone');

		$this->db->from('tbl_orders to');

		$this->db->join('tbl_products tp', 'tp.product_id = to.product_id','left');

		$this->db->join('users u', 'u.id = to.user_id','left');

		$this->db->where('to.id',$order_id);

		

		//$this->db->join('tbl_shipping_address tsa', 'tsa.id = to.shipping_id','left');

		



		$result = $this->db->get();

		//echo $this->db->last_query();exit();

		return $result->row_array();		

	}	

	



	

	public function Get_Order_Detail($id)

	{

		//$query = "SELECT user_id FROM `tbl_orders` WHERE `user` = $id";

		$a_order_info = array();

		

		$order_query = "SELECT * FROM tbl_orders WHERE id = $id";

		$order_result = $this->db->query($order_query);

		$a_order_info['order_info'][] = $order_result->result_array();

		

		foreach($order_result->result() as $users)

		{

			$user_details = "SELECT * FROM tbl_billing_address WHERE `user_id` = $users->user_id";

			$user_details_result = $this->db->query($user_details);

			//$a_order_info['user_billing_info'] = $user_details_result->result_array();

			$temp_arr = array();

			foreach($user_details_result->result_array() as $key=> $value){

					

                    $temp_arr['first_name'] 	= $value['first_name'];

					$temp_arr['last_name'] 		= $value['last_name'];

					$temp_arr['email'] 			= $value['email'];

					$temp_arr['phone'] 			= $value['phone'];

					$temp_arr['country'] 		= $this->get_val('countries', 'id', $value['country'], 'name');

					$temp_arr['state'] 			= $this->get_val('states', 'id', $value['state'], 'name');

					$temp_arr['city'] 			= $this->get_val('cities', 'id', $value['city'], 'name');

					$temp_arr['address'] 		= $value['address'];

					$temp_arr['zip_code'] 		= $value['zip_code'];

            			

			}			

			

			$a_order_info['user_billing_info'] = $temp_arr;

			

		}

		

		foreach($order_result->result() as $users)

		{

			$user_details = "SELECT * FROM tbl_shipping_address WHERE `user_id` = $users->user_id";

			$user_details_result = $this->db->query($user_details);

			//$a_order_info['user_shipping_info'][] = $user_details_result->result_array();

			$temp_arr = array();

			foreach($user_details_result->result_array() as $key=> $value){

					

                    $temp_arr['first_name'] 	= $value['first_name'];

					$temp_arr['last_name'] 		= $value['last_name'];

					$temp_arr['email'] 			= $value['email'];

					$temp_arr['phone'] 			= $value['phone'];

					$temp_arr['country'] 		= $this->get_val('countries', 'id', $value['country'], 'name');

					$temp_arr['state'] 			= $this->get_val('states', 'id', $value['state'], 'name');

					$temp_arr['city'] 			= $this->get_val('cities', 'id', $value['city'], 'name');

					$temp_arr['address'] 		= $value['address'];

					$temp_arr['zip_code'] 		= $value['zip_code'];

            			

			}			

			

			$a_order_info['user_shipping_info'] = $temp_arr;

		}

		

		$product_query = "SELECT tbl_order_details.product_id from tbl_order_details LEFT JOIN tbl_orders ON tbl_orders.id = tbl_order_details.order_id";

		$product_result = $this->db->query($product_query);

		foreach($product_result->result() as $products)

		{

			$product_details = "SELECT * FROM tbl_products WHERE `product_id` = $products->product_id";

			$product_details_result = $this->db->query($product_details);

			$a_order_info['product_info'][] = $product_details_result->result_array();

		}

		//$query = "SELECT tbl_orders.id, tbl_orders.transaction_id,tbl_orders.total_price,tbl_orders.payment_status,tbl_orders.delivery_status,tbl_orders.created_on,tbl_order_details.product_id,tbl_order_details.qty,tbl_order_details.price from tbl_order_details LEFT JOIN  tbl_orders ON tbl_orders.id = tbl_order_details.order_id";

		//$query = "SELECT tbl_orders.id,users.email, tbl_orders.transaction_id,tbl_orders.total_price,tbl_orders.payment_status,tbl_orders.delivery_status,tbl_orders.created_on from tbl_orders LEFT JOIN users ON users.id = tbl_orders.user_id";

		

		//$result = $this->db->query($query);

		return $a_order_info;

	}

	

	public function get_val($table, $match_field, $match_value, $find_field)

	{

		$this->db->select($find_field);

		$this->db->where($match_field, $match_value);

		$this->db->from($table);

		$query = $this->db->get();  

		

		$row = $query->row_array();  

		$temp_value = $row[$find_field];

		

		return $temp_value;  

	 }

	

	public function Insert_Category($data)

	{

		$this->db->insert(TBL_CATEGORY,$data);

        //return $this->db->insert_id();

		return false;

	}



	public function insert($table,$data){

        $this->db->insert($table,$data);

       //echo $this->db->last_query(); exit();

        return $this->db->insert_id();

    }

	

	public function Get_Category($id)

	{

		$result = $this->db->get_where(TBL_CATEGORY,array('id'=>$id))->result_array();

		return $result;

	}

	

	public function Update_Order($id,$data)

	{

		$this->db->where('id',$id);

		$this->db->update(TBL_ORDER,$data);

		//echo $this->db->last_query();die;

		//$this->db->insert(TBL_CATEGORY,$data);

        //return $this->db->insert_id();

		return true;

	}

	

	public function Delete_Category($id)

	{

		$this->db->where('id', $id);

		$this->db->delete(TBL_CATEGORY);

		return true;

	}
	
	public function Delete_Orders($id)
	{	
		$query = "DELETE FROM `tbl_orders` WHERE `tbl_orders`.id = '$id'";
		$result = $this->db->query($query);
		return true;
	}
	
	public function Delete_Order_History($id)
	{	
		$query = "DELETE FROM `tbl_order_status_history` WHERE `tbl_order_status_history`.order_id = '$id'";
		$result = $this->db->query($query);
		return true;
	}

}