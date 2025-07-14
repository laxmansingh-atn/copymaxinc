<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
	
	public function Show_Category(){
		$this->db->select('tbl_category.*');
		$this->db->from('tbl_category');
		$this->db->where(array('tbl_category.status'=>1));
		$result = $this->db->get();
		return $result->result();
	}
	
	
	public function product_printing_details($slug){
	
	    $product_id = $this->get_val('tbl_products', 'product_slug', $slug, 'product_id');    	
		$this->db->select('tbl_product_variants.*');
		$this->db->from('tbl_product_variants');
		//$this->db->join('tbl_attribute', 'tbl_attribute.attribute_id = tbl_product_variants.attribute_id','left');
		//$this->db->join('tbl_attribute_value', 'tbl_attribute_value.attribute_id = tbl_attribute.attribute_id','left');
		//$this->db->group_by('attribute_id');
		$this->db->where(array('tbl_product_variants.product_id' => $product_id ));
		$this->db->where('tbl_product_variants.attr_type','printing');
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result_array();
	}
	
	// ankush 
	
	public function getProductPricing($data,$attr_type = null){
		 
		$price = 0; 
                                if($attr_type=='printing'){
                                                $count = count($data['printing_attributes']);
                                                $attributes = $data['printing_attributes'];
                                }elseif($attr_type=='finishing'){
                                                $count = count($data['finishing_attributes']);
                                                $attributes = $data['finishing_attributes'];
                                }
                                if($count > 0){
                                                $i=0;$condition="";
                                                foreach($attributes as $key => $value){
                                                                if(++$i === $count) {
                                                                                $condition .= "(attribute_id=$key AND attr_value_id=$value)";
                                                                }else{
                                                                                $condition .= "(attribute_id=$key AND attr_value_id=$value) OR";
                                                                }
                                                }
                                                $sql = "select p_varient_group_id from tbl_product_variants where product_id='".$data['product_id']."' AND (".$condition.") AND attr_type='".$attr_type."' AND row_count = '".$count."' GROUP BY p_varient_group_id HAVING COUNT(id) =".$count;
                                                $query = $this->db->query($sql);
                                               // echo $this->db->last_query(); die();
                                                if($query->num_rows() > 0){
                                                                $p_varient_group_id = $query->row()->p_varient_group_id;
															 if($attr_type=='printing'){	
                                                                $sql2 = "select price from tbl_product_range_price where ".$data['copies'].">=range_from AND ".$data['copies']."<=range_to AND c_varient_group_id='".$p_varient_group_id."'";
																
                                                                $query2 = $this->db->query($sql2);
																
                                                                if($query2->num_rows() == 1){
																	
                                                                                return $query2->row()->price;
                                                                              // $price =  $query2->row()->price;																				
                                                                }else{
                                                                                return "0.00";
																				 //$price = 0.00;
                                                                }
															 }
															 if($attr_type=='finishing'){
																 
																 $sql3 = "select price from tbl_product_range_price where ".$data['pages'].">=range_from AND ".$data['pages']."<=range_to AND c_varient_group_id='".$p_varient_group_id."'";
																
                                                                $query3 = $this->db->query($sql3);
																
                                                                if($query3->num_rows() == 1){
																	    return $query3->row()->price;
                                                                         //$price1 =  $query3->row()->price;   
                                                                }else{
                                                                        return "0.00";
																				//$price1 = 0.00;
                                                                }
																 
															 }
															//return  $price+ $price1; 
																
                                                }else{
                                                                return "0.00";
                                                }
                                }else{
                                                return "0.00";
                                }
                }

	
	
   public function product_finishing_details($slug){
    $product_id = $this->get_val('tbl_products', 'product_slug', $slug, 'product_id');    	
	$this->db->select('tbl_product_variants.*');
	$this->db->from('tbl_product_variants');
	
	$this->db->where(array('tbl_product_variants.product_id' => $product_id ));
	$this->db->where('tbl_product_variants.attr_type','finishing');
	$result = $this->db->get();
	//echo $this->db->last_query();exit();
	return $result->result_array();
	}
	public function product_details_main($slug){
	    $product_id = $this->get_val('tbl_products', 'product_slug', $slug, 'product_id');    	
	    //echo $product_id;
		//$this->db->select('tbl_products.*,tbl_product_image.product_image','tbl_product_tab_value.product', 'tbl_product_tab_value.faq', 'tbl_product_tab_value.specs_templates');
		//$this->db->from('tbl_products');
		//$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');
		//$this->db->join('tbl_product_tab_value', 'tbl_product_tab_value.product_id = tbl_products.product_id','left');
		//$this->db->where('tbl_products.product_id',$product_id);
		$sql="select tbl_products.*, tbl_product_image.product_image, tbl_product_tab_value.product, tbl_product_tab_value.faq, tbl_product_tab_value.specs_templates from tbl_products left join tbl_product_image on tbl_product_image.product_id = tbl_products.product_id left join tbl_product_tab_value on tbl_product_tab_value.product_id = tbl_products.product_id where tbl_products.product_id = '".$product_id."'";
		$result = $this->db->query($sql);
		//echo $this->db->last_query();exit();
		return $result->row_array();
	 
	}
	
	public function get_val($table, $match_field, $match_value, $find_field){

		$this->db->select($find_field);
		$this->db->where($match_field, $match_value);
		$this->db->from($table);
		$query = $this->db->get();		
		//echo $this->db->last_query();exit();
		$row = $query->row_array();		
		$temp_value = $row[$find_field];
		
		return $temp_value; 	
	}
	
	public function get_vals($data){
		$sql= "select p_varient_group_id from tbl_product_variants where product_id=".$data['product_id']." AND attr_value_id=".$data['attr_value_id']." AND attr_type='".$data['attr_type']."' AND status=1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	
   	public function get_attribute_val($product_id,$attribute_id,$attr_type){

		$this->db->select('tbl_attribute_value.value,tbl_attribute_value.value_id');
		$this->db->from('tbl_product_variants');
		$this->db->join('tbl_attribute_value', 'tbl_attribute_value.value_id = tbl_product_variants.attr_value_id');
		$this->db->where('tbl_product_variants.product_id',$product_id);
		$this->db->where('tbl_product_variants.attribute_id',$attribute_id);
		$this->db->where('tbl_product_variants.attr_type',$attr_type);
		$query = $this->db->get();		
        //echo $this->db->last_query();exit();
		$row = $query->result_array();		
		$temp_value = $row;	
		return $temp_value; 	
	}
	
	public function get_rows($table, $match_field, $match_value, $find_field){

		$this->db->select($find_field);
		$this->db->where($match_field, $match_value);
		$this->db->from($table);
		$query = $this->db->get();		
       // echo $this->db->last_query();exit();
		$row = $query->result_array();		
		$temp_value = $row;
		
		return $temp_value; 	
	}
public function Show_Page_Content($slug,$lang){
		$this->db->select('tbl_pages.*,tbl_page_content.page_title,tbl_page_content.page_content');
		$this->db->from('tbl_pages');
		$this->db->join('tbl_page_content', 'tbl_pages.id = tbl_page_content.page_id','left');
		$this->db->where(array('tbl_pages.page_slug'=>$slug,'tbl_page_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result_array();
	}
	
public function price_calculator($product_id , $attr_id , $no_copies){
	    
		$this->db->select('tbl_product_range_price.price');
		$this->db->from('tbl_product_range_price');
		$this->db->where(array('tbl_product_range_price.product_id'=>$product_id,'tbl_product_range_price.c_varient_group_id' => $attr_id , 'tbl_product_range_price.range_from <='=> $no_copies , 'tbl_product_range_price.range_to >='=> $no_copies ) 
		);
		$result = $this->db->get();
        // echo $this->db->last_query();exit();		
		return $result->row_array();		
    }
public function get_attribute_detail_list($attribute_id){

		$this->db->select('tbl_attribute_value.value,tbl_attribute_value.value_id,tbl_attribute_value.attribute_id');
		$this->db->from('tbl_attribute_value');
		$this->db->join('tbl_attribute', 'tbl_attribute_value.attribute_id = tbl_attribute.attribute_id');
		$this->db->where('tbl_attribute_value.attribute_id',$attribute_id);
		
		$query = $this->db->get();		
        //echo $this->db->last_query();exit();
		$row = $query->result_array();		
		$temp_value = $row;	
		return $temp_value; 	
	}
	public function Show_Address_Book($user_id){
		$this->db->select('tbl_user_address.*');
		$this->db->from('tbl_user_address');
		$this->db->where('tbl_user_address.user_id',$user_id);
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result_array();
	}

// GEt All Users
	public function getAllUsers()
	{
		$this->db->from(TBL_USER);
		$this->db->order_by("id", "asc");
		//$result = $this->db->get(TBL_BANNER);
		$result = $this->db->get();
		return $result->result_array();
	}

   public function getAllDetails($table )
	{
		$this->db->from($table);
		$this->db->order_by("id", "asc");
		//$result = $this->db->get(TBL_BANNER);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function checkUserByEmail($email)
	{
		//$this->db->from(TBL_USER);
		//$this->db->where("email", $email);
		$query = "SELECT * FROM `users` WHERE `email`='$email'";
		$result = $this->db->query($query);
		return $result->result_array();
	}
	
	public function get_data($table , $where , $value){
	$this->db->from($table);
    $this->db->where($where ,$value );		
	$result = $this->db->get();
	//echo $this->db->last_query();exit();
	return $result->result_array();	
		
	}
	
	public function get_order_data($user_id){
	$this->db->select('to.*,ifnull(to.pages,"1") as pages,ifnull(to.copies,"1") as copies,tp.product_name');
    $this->db->from('tbl_orders to');
    $this->db->join('tbl_products tp','tp.product_id=to.product_id');
    $this->db->where('to.user_id',$user_id);		
	$result = $this->db->get();
	//echo $this->db->last_query();exit();
	return $result->result_array();	
		
	}
	
	public function Update_user($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		//$this->db->insert(TBL_CATEGORY,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function get_price()
	{
		$this->db->select('price');
		$this->db->from('tbl_product_range_price tprp');
		$this->db->join('tbl_product_variants tpv','tpv.id=tprp.product_varient_id');
		$this->db->where('tpv.paper_type','20/50-white');
		$this->db->where('tpv.number_of_side','1-sided');
		$this->db->where('tpv.dimensions','8.5x5.5');
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->row_array();
	}
	
	public function get_printing_price($dimensions,$no_of_sides,$product_id,$total_pages)
	{
		$this->db->select('price');
		$this->db->from('tbl_product_printing_price');
		$this->db->where('page_side',$no_of_sides);
		$this->db->where('dimension',$dimensions);
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','printing');
		$this->db->where("$total_pages between `range_from` and `range_to`");
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->row_array();
	}
	
		public function get_inside_page_price($no_of_sides,$color_coil,$paper_type,$product_id,$total_pages,$dimensions)
	{
		
		
		if($color_coil == "color"){
			
			$color_coil = "Color Copies";
		}else{
			
			$color_coil = "Black and White";
			
		}
		
		$this->db->select('price');
		$this->db->from('tbl_back_cover');
		$this->db->where('page_side',$no_of_sides);
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','black and white');
		$this->db->where('ink_type',$color_coil);
		$this->db->where('dimension',$dimensions);
		$this->db->where("$total_pages between `range_from` and `range_to`");
		
		
		
		$result = $this->db->get();
		
		return $result->row_array();
	}
	
	
		public function get_fornt_cover_price($front_cover_sides,$front_cover_color,$front_cover_paper_type,$product_id,$total_pages,$dimensions)
	{
		
		
		if($front_cover_color == "color"){
			
			$color_coil = "Color Copies";
		}else{
			
			$color_coil = "Black and White";
			
		}
		
		$this->db->select('price');
		$this->db->from('tbl_back_cover');
		$this->db->where('page_side',$front_cover_sides);
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','black and white');
		$this->db->where('ink_type',$color_coil);
		$this->db->where('dimension',$dimensions);
		$this->db->where("$total_pages between `range_from` and `range_to`");
		
		
		$result = $this->db->get();
		
		
		
		return $result->row_array();
	}
	
	public function get_product_paper($product_id,$paper_type,$dimensions)


	{


		$this->db->select('paper_type_group_id,product_id');


		$this->db->from('tbl_product_printing_attribute');


		$this->db->where('product_id',$product_id);


		$this->db->where('paper_type_group_id !=',0);


		$result = $this->db->get();
		
	
		foreach ($result->result_array() as $key => $value) {


			$temp = $value;


			$temp['attribute'] = $this->get_page_details('page_type,price,dimension',$value['paper_type_group_id'],'tbl_product_printing_price','paper_group_id',$value['product_id']);


			$temp['master'] = $this->get_page_details('attr_value',$value['paper_type_group_id'],'tbl_master_printing_attribute','page_group_id','');


			$temp_arr[] = $temp;


		}
				
		
		/* if($paper_type == "80 lb matte paper"){
			
			$paper_type = "80 lb matte cardstock";
			
		}elseif($paper_type == "100 lb matte paper"){
			
			$paper_type = "100 lb matte cardstock";
		} *//* else{
			
			$paper_type = "100 lb matte cardstock";
			
		} */
		
		/* echo "<pre>";
		print_r($paper_type);
		die(); */
		
		foreach($temp_arr as $value){
			
			foreach($value['attribute'] as $value2){
				
				if($value2['dimension'] == $dimensions && $value2['page_type'] == $paper_type){
				
					$temp_arr = $value2['price'];
				
			}
				
				
			}
			
			
		}
		

		return $temp_arr;


	}
	
	
	public function get_page_details($field,$paper_type_group_id,$table,$where,$product_id)


	{


		$this->db->select($field);


		$this->db->from($table);


		$this->db->where($where,$paper_type_group_id);


		if (!empty($product_id)) {


			$this->db->where('product_id',$product_id);	


		}


		$result = $this->db->get();


		return $result->result_array();


	}
	
	
	public function get_back_cover_price($back_cover_sides,$back_cover_color_type,$back_cover_paper_type,$product_id,$total_pages,$dimensions)
	{
		
		
		
		if($back_cover_color_type == "color"){
			
			$color_coil = "Color Copies";
		}else{
			
			$color_coil = "Black and White";
			
		}
		
		$this->db->select('price');
		$this->db->from('tbl_back_cover');
		$this->db->where('page_side',$back_cover_sides);
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','black and white');
		$this->db->where('ink_type',$color_coil);
		$this->db->where('dimension',$dimensions);
		$this->db->where("$total_pages between `range_from` and `range_to`");
		
	
		$result = $this->db->get();
		
		return $result->row_array();
	}
	
	public function get_back_cover_option_price($back_cover_option,$product_id)
	{
		
		$this->db->select('price');
		$this->db->from('tbl_back_cover');
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','front cover options');
		$this->db->where('front_cover_type',$back_cover_option);
		
		
	
		$result = $this->db->get();
		
		return $result->row_array();
	}
	
	
	
	public function get_front_cover_option($front_cover_option,$product_id)
	{
		
		$this->db->select('price');
		$this->db->from('tbl_back_cover');
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','front cover options');
		$this->db->where('front_cover_type',$front_cover_option);
		
	
		$result = $this->db->get();
		
		/* echo "<pre>";
		print_r($result->row_array());
		die(); */
	
		return $result->row_array();
	}
	
		public function get_binding_price($no_sheets,$product_id,$no_copies)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_back_cover');
		$this->db->where('product_id',$product_id);
		$this->db->where('attr_type','coil binding cost');
		$this->db->where("$no_copies between `range_from` and `range_to`");
		
		$binding_cost = 0;
		
	
		$result = $this->db->get()->result_array();
		
	
		foreach($result as $value){
			
		$str = $value['sheets'];
		preg_match_all('!\d+!', $str, $matches);
		
		
		  $sheets_from 	= (int)($matches['0']['0']);
		  $sheets_to 		= (int)($matches['0']['1']);
		  
		
		
		
		 if(($sheets_from <= $no_sheets) && ($sheets_to >= $no_sheets)){
			
		$binding_cost = $value['price'];	
			
		} 
				
				
			
		}
		
		
		
		
		 $final_price = $binding_cost*$no_copies;
		 
		return $final_price;
	}


	public function get_finishing_price($condition)
	{
		$this->db->select('price');
		$this->db->from('tbl_product_finishing_price');
		$this->db->where($condition);
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->row_array();
	}

	public function get_paper_price($paper_type,$product_id,$dimension)
	{
		$this->db->select('price');
		$this->db->from('tbl_product_printing_price');
		$this->db->where('page_type',$paper_type);
		$this->db->where('product_id',$product_id);
		$this->db->where('dimension',$dimension);
		$this->db->where('attr_type','printing');
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->row_array();
	}

	public function getPaperTypes($product_id){
		$sql1 = "select id,attr_value,page_group_id from tbl_master_printing_attribute where id in (select distinct paper_group_id from tbl_product_printing_price where product_id='".$product_id."' and range_to=0) and page_group_id=0 and attr_name='paper type'";
		$query = $this->db->query($sql1);
		if($query->num_rows() > 0){
			//echo $this->db->last_query();echo "<br>";
			//echo "<pre>"; print_r($query->result_array());die();
			$result = $query->result_array();$i=0;
			foreach($result as $row){
				$sql2 = "select id,attr_value,page_group_id from tbl_master_printing_attribute where page_group_id='".$row['id']."' and attr_name='paper type'";
				$query2 = $this->db->query($sql2);
				if($query2->num_rows() > 0){
					$result[$i]['sub_type'] = $query2->result_array();
				}else{
					$result[$i]['sub_type'] = array();
				}
				$i++;
			}
			return $result;
			//echo "<pre>"; print_r($result);die();
		}else{
			return array();
		}
	}

	public function getProductVolumn($paper_Type_id,$dimensions){
		
		$sql = "select * from product_weight where master_printing_attribute_id='".$paper_Type_id."' and dimension='".$dimensions."'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			//echo "<pre>"; print_r($query->row_array()); die();
			return $query->row_array();
		}else{
			//echo "<pre>"; print_r($query->num_rows()); die();
			return array();
		}
	}

	public function getRow($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
       // echo $this->db->last_query();die;
        return $query->row_array();
    }



}