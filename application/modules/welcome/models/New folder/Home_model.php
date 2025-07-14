<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
	public function checkUserByEmail($email)
	{
		//$this->db->from(TBL_USER);
		//$this->db->where("email", $email);
		$query = "SELECT * FROM `users` WHERE `email`='$email'";
		$result = $this->db->query($query);
		return $result->result_array();
	}
	
	public function Show_Page($lang)
	{
		//$result = $this->db->get(TBL_PAGE);
		//return $result->result();
		
		$this->db->select('tbl_pages.*,tbl_page_content.page_title,tbl_page_content.page_content');
		$this->db->from('tbl_pages');
		$this->db->join('tbl_page_content', 'tbl_pages.id = tbl_page_content.page_id','left');
		$this->db->where(array('tbl_page_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
		
	}
	
	public function Show_Gallery(){
		$result = $this->db->get('tbl_gallery');
		return $result->result();
	}
	
	
	
	public function Show_Banner($value,$lang)
	{
		$this->db->select('tbl_banner.*,tbl_banner_content.banner_content');
		$this->db->from('tbl_banner');
		$this->db->join('tbl_banner_content', 'tbl_banner.id = tbl_banner_content.banner_id','left');
		$this->db->where(array('tbl_banner.banner_category'=>$value,'tbl_banner_content.language_code' => $lang));
		$this->db->order_by("tbl_banner.banner_order", "asc");
		$result = $this->db->get();
		
		return $result->result_array();
	}
	
	public function Show_Brands($lang){
		$this->db->select('tbl_brands.*,tbl_brand_content.brand_content');
		$this->db->from('tbl_brands');
		$this->db->join('tbl_brand_content', 'tbl_brands.id = tbl_brand_content.brand_id','left');
		$this->db->where(array('tbl_brand_content.language_code' => $lang));
		$result = $this->db->get();
		return $result->result();
	}
	
	public function Show_Brand_Category( $lang ,$brand ) {
	    $this->db->select('tbl_category.* , tbl_category_content.category_title');
		$this->db->from('tbl_category');
		$this->db->join('tbl_category_content', 'tbl_category_content.category_id = tbl_category.id','left');
		$this->db->where(array('tbl_category_content.language_code' => $lang , 'tbl_category.parent_category' => $brand));	
		$this->db->order_by("tbl_category.id", "asc");
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result_array();
	}
	
	
	public function Show_Feature_Category($lang){
		$this->db->select('tbl_category.*,tbl_category_content.category_title');
		$this->db->from('tbl_category');
		$this->db->join('tbl_category_content', 'tbl_category.id = tbl_category_content.category_id','left');
		$this->db->where(array('tbl_category_content.language_code' => $lang,'tbl_category.featured_category'=>1));
		$result = $this->db->get();
		return $result->result();
	}

	public function Show_Category(){
		$this->db->select('tbl_category.*');
		$this->db->from('tbl_category');
		$this->db->where(array('tbl_category.status'=>1));
		$result = $this->db->get();
		return $result->result();
	}
	
	public function Insert_Payment_Details($data)
	{
		$this->db->insert('tbl_transaction',$data);
		//return true;
		return $this->db->insert_id();
	}
	
	public function Show_News($lang)
	{
		//$result = $this->db->get(TBL_BANNER);
		$this->db->select('tbl_news.*,tbl_news_content.news_title,tbl_news_content.news_content');
		$this->db->from('tbl_news');
		$this->db->join('tbl_news_content', 'tbl_news.id = tbl_news_content.news_id','left');
		$this->db->where(array('tbl_news_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
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
	
	public function Show_Activity($lang)
	{
		//$result = $this->db->get(TBL_BANNER);
		$this->db->select('tbl_activity.*,tbl_activity_content.activity_title,tbl_activity_content.activity_content');
		$this->db->from('tbl_activity');
		$this->db->join('tbl_activity_content', 'tbl_activity.id = tbl_activity_content.activity_id','left');
		$this->db->where(array('tbl_activity_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}
	
	public function getCategoryNameByID($id)
	{
		$this->db->select("*");
		$this->db->from(TBL_CATEGORY);
		$this->db->where("id", $id);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	// Get All Category
	public function getAllCategory()
	{
		$this->db->from(TBL_CATEGORY);
		$this->db->order_by("id", "asc");		
		$result = $this->db->get();
		return $result->result_array();
	}
	
	/*public function Show_Category()
	{
		$this->db->from(TBL_CATEGORY);
		$this->db->order_by("id", "asc");
		//$result = $this->db->get(TBL_BANNER);
		$result = $this->db->get();
		$cat_arr= $arr = array();
		foreach($result->result_array() as $record){
			$arr['slug'] 	= $record['category_slug'];
			$arr['main_menu'] 	= $record['category_name'];
			$arr['sub_menu'] 	= $this->getAllProductByCategory($record['id']);
			$cat_arr[] 	= $arr;
		}
		return $cat_arr;
	}*/
	
	//Get Product By Category
	public function getAllProductByCategory($catId)
	{
		/*$this->db->from(TBL_PRODUCT);
		$this->db->where("category_id", $catId);
		$this->db->order_by("product_id", "asc");
		$result = $this->db->get();	
		prod.category_id = $catId
		*/
		$query = "SELECT * FROM `tbl_products` AS prod LEFT JOIN `tbl_product_image` AS prodimg ON prod.product_id = prodimg.product_id 

         LEFT JOIN `tbl_product_variants` AS prodvar ON prod.product_id = prodvar.product_id WHERE prod.category_id = $catId";
		$result = $this->db->query($query);
		
		return $result->result_array();
	}
	
	public function getProductByCategorySlug($slug)
	{
		
		//Get Category Id
		$this->db->from('tbl_category');
		$this->db->where("category_slug", $slug);		
		$result = $this->db->get();
		$row = $result->row_array(); 
		$category_id = $row['id'];

		$this->db->from(TBL_PRODUCT);
		$this->db->where("category_id", $category_id);
		$this->db->order_by("product_id", "asc");
		$result = $this->db->get();
		
		$product_list = $temp_arr = array();
		//$arr['product_general'] = $result->result_array();
		foreach($result->result_array() as $record)
		{
			//$arr['product_image'] 	= $this->getProductImage($record['product_id']);
			$temp_arr['category_id'] 		= $record['category_id'];
			$temp_arr['category'] 			= $this->getCategoryNameByID($record['category_id']);
			$temp_arr['product_id'] 		= $record['product_id'];
			$temp_arr['product_name'] 		= $record['product_name'];
			$temp_arr['product_slug'] 		= $record['product_slug'];
			$temp_arr['regular_price'] 		= $record['regular_price'];
			$temp_arr['offer_price1'] 		= $record['offer_price1'];
			$temp_arr['offer_price2'] 		= $record['offer_price2'];
			$temp_arr['short_description'] 	= $record['short_description'];
			$temp_arr['description'] 		= $record['description'];
			$temp_arr['product_image'] 		= $this->get_val('tbl_product_image', 'product_id', $record['product_id'], 'product_image');
			$temp_arr['qty'] 				= $record['quantity'];

			//$arr['product_detail'] = $this->getProductDetailsValue($record['product_id']);
			//$arr['related_products'] = $this->getRelatedProducts($record['category_id'],$record['product_id']);
			
			$product_list[] = $temp_arr;
		}

		return $product_list;
	}
	
	public function getProductByCategoryID($id)
	{
		$this->db->from(TBL_PRODUCT_IMAGE);
		$this->db->where("product_id", $id);
		//$this->db->order_by("id", "asc");
		$result = $this->db->get();
		
		return $result->result_array();
	}
	
	//Get Product Details
public function getProductDetails($val, $flag=''){
		
		$this->db->from('tbl_products');		
		$this->db->join('tbl_product_content', 'tbl_products.product_id = tbl_product_content.product_id');
		$this->db->where('tbl_product_content.language_code', get_current_language());		
		$this->db->where("tbl_products.product_id", $val);	
		/* if($flag=='id')						
			$this->db->where("tbl_products.product_id", $val);		
		else
			$this->db->where("tbl_products.product_slug", $val);
*/		
		
		$result = $this->db->get();		
				
		$temp_arr = array();
		//echo "<pre>";print_r($result->result_array());exit();
		
		foreach($result->result_array() as $record){
						
			$temp_arr['product_id'] 		= $record['product_id'];		
			$temp_arr['product_name'] 		= $record['product_name'];
			$temp_arr['product_image'] 		= $this->getProductImage($record['product_id'], 1);
			$temp_arr['product_slug'] 		= $record['product_slug'];
			$temp_arr['regular_price'] 		= $record['regular_price'];	
            $temp_arr['faulty_price'] 		= $record['faulty_price'];			
			$temp_arr['description'] 		= $record['description'];					
			$temp_arr['product_variants'] 	= $this->getProductVariants($record['product_id']);	
           //$temp_arr['product_allvariants'] = $this->getProductallVariants($record['product_id']);				
		}
		
		//echo"<pre>"; print_r($temp_arr);exit();
		return $temp_arr;
	}
	
	public function getProductallVariants($id, $storage){
		$this->db->from('tbl_product_variants');
		$this->db->where(array('product_id'=> $id , 'storage'=> $storage ));
	
		$result = $this->db->get();
		return $result->result_array();
	} 
	
	
	public function getProductVariants($id){
		$this->db->from('tbl_product_variants');
		$this->db->where("product_id", $id);
		$this->db->group_by('tbl_product_variants.storage');
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function getProductImage($id, $limit='')
	{
		$this->db->from(TBL_PRODUCT_IMAGE);
		$this->db->where("product_id", $id);
		$this->db->order_by("id", "asc");
		if($limit!=''){
			$this->db->limit($limit);
		}	
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function Get_Category_Content($lang , $id )
	{
		
	    $this->db->select('tbl_category_content.* , tbl_category.category_image');
		$this->db->from('tbl_category_content');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_category_content.category_id');		
		$this->db->where(array('tbl_category_content.language_code' => $lang , 'tbl_category_content.category_id' => $id ));
		$result = $this->db->get();
		return $result->result();
	}
									
	public function getProductImageV2($id)
	{
		$this->db->from(TBL_PRODUCT_IMAGE);
		$this->db->where("product_id", $id);
		$this->db->order_by("id", "asc");
		$result = $this->db->get();

		//echo $this->db->last_query();exit();

		return $result->row_array();
	}
	
	public function getProductDetailsValue($id, $flag='')
	{
		$this->db->from(TBL_PRODUCT_DETAIL);

		if($flag=='category')		
			$this->db->where_in("product_id", $id);
		else
			$this->db->where("product_id", $id);
		
		$this->db->order_by("product_detail_id", "asc");
		$result = $this->db->get();
		
		return $result->result_array();
	}
	
	//Get Related Products
	public function getRelatedProducts($category_id, $pro_id)
	{
		
		//$query = "SELECT * FROM `tbl_products` JOIN `tbl_product_image` WHERE `category_id` = '$id' AND `product_id` != '$pro_id' LIMIT 0,4";
		$query = "	SELECT * FROM `tbl_products` AS prod 
					LEFT JOIN `tbl_product_image` AS prodimg 
					ON prod.product_id = prodimg.product_id 
					WHERE prod.category_id = '$category_id' 
					AND prod.product_id != '$pro_id' 
					LIMIT 0, 10";

		$result = $this->db->query($query);
		return $result->result_array();
	}
	
	/* public function Show_Page()
	{
		$this->db->from(TBL_PAGE);
		$this->db->order_by("id", "asc");
		//$result = $this->db->get(TBL_BANNER);
		
		$result = $this->db->get();
		return $result->result();
	}
	*/
	public function Get_Page($value)
	{
		/*$this->db->from(TBL_PAGE);
		$this->db->order_by("id", "asc");
		//$result = $this->db->get(TBL_BANNER);*/
		$result = $this->db->get_where(TBL_PAGE,array('page_slug'=>$value))->result_array();
		//$result = $this->db->get();
		return $result;
	}
	
	public function Get_Banner($id)
	{
		$result = $this->db->get_where(TBL_BANNER,array('id'=>$id))->result_array();
		return $result;
	}
	
   /*  public function getProductSearch($slug=""){
	
	$this->db->select('tbl_products.product_name');
    $this->db->from('tbl_products');
	$this->db->where('tbl_products.product_name Like "%'. $slug .'%"');
	$result = $this->db->get();
	
	//echo $this->db->last_query();exit();
	
	return $result->result();
	} */
	
	 public function getProductSearch($slug=""){
	
	$this->db->select('tbl_products.*');
    $this->db->from('tbl_products');
	//$this->db->join('tbl_product_variants', 'tbl_product_variants.product_id = tbl_products.product_id','left');
	//$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');
	/* if(!empty($group_by)){
	$this->db->group_by($group_by);
	} */

	$this->db->where('tbl_products.product_name Like "%'. $slug .'%"');
	$this->db->or_where('tbl_products.sku  Like "%'. $slug .'%"'); 
	$result = $this->db->get();
	return $result->result() ; 
	
	}
	
	public function getProductByName($slug){ 
		$parent_id = $this->get_val('tbl_products', 'product_name', $slug, 'product_id');	
	    $this->db->select('tbl_products.*');
		$this->db->from('tbl_products');
		$this->db->join('tbl_product_variants', 'tbl_product_variants.product_id = tbl_products.product_id','left');
		$this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_products.product_id','left');
		$this->db->where(array('tbl_products.product_id' => $parent_id) );
		
		
		$result = $this->db->get();
        echo $this->db->last_query();exit();		
	}
	
/*	public function getProductByCategory($slug){
	
		$this->db->select('tbl_products.*,tbl_category.category_slug');
		$this->db->from('tbl_products');
		$this->db->join('tbl_product_variants', 'tbl_product_variants.product_id = tbl_products.product_id','left');
		$this->db->join('tbl_category', 'tbl_product_variants.product_id = tbl_products.product_id','left');
		$this->db->where(array('tbl_category.category_slug' => $slug) );
		
		
		$result = $this->db->get();
			
		$temp_arr = $temp_arr1 = array(); 	
		$category_id = $this->get_val('tbl_category', 'category_slug', $slug, 'id');	//category id
		if($category_id==""){
		 $parent_id = $this->get_val('tbl_category', 'parent_category', $slug, 'id');	
		} else {
		$parent_id = $category_id ;	
		}
		
		$this->db->select('product_id');
		$this->db->from('tbl_product_category');	
		if($parent_id!=""){		
			$this->db->where('category_id', $parent_id);
				$result = $this->db->get();		
		        foreach($result->result_array() as $key=>$value){
			    $temp_arr1[] = $this->getProductDetails($value['product_id'], $flag='id');
	        	}	
		
		    	}
	
		//echo "<pre>"; print_r($temp_arr1);exit();
			echo $this->db->last_query(); exit();
		return $temp_arr1;
		
	}*/
	
		public function getProductByCategory($slug){
	
		$this->db->select('tbl_products.*,tbl_category.category_slug');
		$this->db->from('tbl_products');
		$this->db->join('tbl_product_variants', 'tbl_product_variants.product_id = tbl_products.product_id','left');
		$this->db->join('tbl_category', 'tbl_product_variants.product_id = tbl_products.product_id','left');
		$this->db->where(array('tbl_category.category_slug' => $slug) );
		
		
		$result = $this->db->get();
			
		$temp_arr = $temp_arr1 = array(); 	
		$category_id = $this->get_val('tbl_category', 'category_slug', $slug, 'id');	//category id
		if($category_id==""){
		 $parent_id = $this->get_val('tbl_category', 'parent_category', $slug, 'id');	
		} else {
		$parent_id = $category_id ;	
		}
		
		$this->db->select('product_id');
		$this->db->from('tbl_product_category');	
		if($parent_id!=""){		
			$this->db->where('category_id', $parent_id);
				$result = $this->db->get();		
		        foreach($result->result_array() as $key=>$value){
			    $temp_arr1[] = $this->getProductDetails($value['product_id'], $flag='id');
	        	}	
		
		    	}
	
		//echo "<pre>"; print_r($temp_arr1);exit();
		//echo $this->db->last_query(); exit();
		return $temp_arr1;
		
	}

	public function get_payment_type($lang)
	{
		$this->db->select('tbl_payment_type.*,tbl_payment_type_content.content');
		$this->db->from('tbl_payment_type');
		$this->db->join('tbl_payment_type_content', 'tbl_payment_type.id =tbl_payment_type_content.type_id','left');
		$this->db->where(array('tbl_payment_type_content.language_code' => $lang));
		$this->db->order_by("tbl_payment_type.type_order", "asc");
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}

	public function get_payment_details($id,$lang){
		$this->db->select('tbl_payment_details.*,tbl_payment_details_content.content');
		$this->db->from('tbl_payment_details');
		$this->db->join('tbl_payment_details_content', 'tbl_payment_details.id =tbl_payment_details_content.details_id','left');
		$this->db->where(array('tbl_payment_details.type_id' => $id,'tbl_payment_details_content.language_code' => $lang));
		
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return $result->result();
	}

	// Get contact us content 
	public function get_contactus_contents()
	{
		$this->db->from(TBL_CONTACT);
		$this->db->order_by("id", "asc");		
		$result = $this->db->get();
		//return $result->result();
		$temp_arr = array();
		foreach ($result->result_array() as $key => $value) {
			$temp_arr[$value['contact_type']] = $value['contact_value'];					
		}

		return $temp_arr;
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
	
	//Insert User Registration Data
	public function Insert_UserData($data)
	{
		$this->db->insert(TBL_USER,$data);
        return $this->db->insert_id();
		//return true;
	}
	
	public function Insert_UserGroup($data)
	{
		$this->db->insert(TBL_USERGROUP,$data);
        //return $this->db->insert_id();
		return true;
	}

	//Category Filter
	public function get_products_by_filter($data=array()){

		$where = '';
		$order_by = '';
		
		if(isset($data['attr_val']) && $data['attr_val']!=''){
			
			if($data['attr_val']=='date_new'){
				$order_by = " Order By tbl1.created_at desc";
			}elseif($data['attr_val']=='price_asc'){				
				$order_by = " Order By cast(replace(SUBSTRING_INDEX(regular_price,'.',1),'$','') As SIGNED) asc";				
			}elseif($data['attr_val']=='price_desc'){				
				$order_by = " Order By cast(replace(SUBSTRING_INDEX(regular_price,'.',1),'$','') As SIGNED) desc";				
			}else{
				//order_by 'popularity'
				$order_by = " Order By tbl1.popularity desc";
			}
		}

		

		$sql = "Select tbl1.*, tbl2.product_image From tbl_products As tbl1 
		Left Join tbl_product_image as tbl2 
		On tbl1.product_id = tbl2.product_id
		Where tbl1.category_id = '".$data['cat_id']."' ".$order_by;

		$result = $this->db->query($sql);
		//echo $this->db->last_query();//exit();
		return $result->result_array();
	}

	public function getCategoryId($slug){
		$this->db->select('id');
		$this->db->from(TBL_CATEGORY);
		$this->db->where("category_slug", $slug);
		$result = $this->db->get();
		$row =  $result->row_array();
		return $row['id'];
	}
	
	// Get Billing Details By User ID
	public function getBillingAddressByUser($user_id)
	{
		$query = "SELECT * FROM `tbl_billing_address` WHERE `user_id` = '$user_id'";
		$result = $this->db->query($query);
		return $result->result_array();
	}
	
	public function Insert_Billing_Address($data)
	{
		$this->db->insert(TBL_BILLING,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Update_Billing_Address($id,$data)
	{
		$this->db->where('user_id',$id);
		$this->db->update(TBL_BILLING,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	// Get Billing Details By User ID
	public function getShippingAddressByUser($user_id)
	{
		$query = "SELECT * FROM `tbl_shipping_address` WHERE `user_id` = '$user_id'";
		$result = $this->db->query($query);
		return $result->result_array();
	}
	
	public function Insert_Shipping_Address($data)
	{
		$this->db->insert(TBL_SHIPPING,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	public function Update_Shipping_Address($id,$data)
	{
		$this->db->where('user_id',$id);
		$this->db->update(TBL_SHIPPING,$data);
        //return $this->db->insert_id();
		return true;
	}
	
	//Country List
	public function get_country_list()
	{
		$this->db->select('*');
		$this->db->from('countries');
		$result = $this->db->get();

		$temp_arr = array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$temp_arr[$row['id']] = $row['name'];   
			}	
		}        	

		return $temp_arr;
	}

	//State List 
	public function get_state_list($country_id)
	{
		$this->db->select('*');
		$this->db->from('states');
		$this->db->where('country_id', $country_id);
		$result = $this->db->get();

		$temp_arr = array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$temp_arr[$row['id']] = $row['name'];   
			}	
		}        

		return $temp_arr;	
	}
	
	//City List 
	public function get_city_list($state_id)
	{
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->where('state_id', $state_id);
		$result = $this->db->get();

		$temp_arr = array();
		if($result->num_rows()>0){
			foreach($result->result_array() as $row){
				$temp_arr[$row['id']] = $row['name'];   
			}	
		}        		
		return $temp_arr;
	}

	//Update Address	
	public function update_address($data)
	{
	
		//Shipping Address
		$this->db->insert('tbl_shipping_address', $data['shipping']);
		//Billing Address
		$this->db->insert('tbl_billing_address', $data['billing']);

		return true;		
	}
	
	public function number_rows($table) {
	$this->db->select('*');
    $this->db->from($table);
    $result = $this->db->get();
    return $result->num_rows() ; 	
	}

	//Update order status
	public function update_order_status($serialize_data){
		
		$data = unserialize($serialize_data);

		$order_id = $data['custom']; 

		$insert_data 					= array();	
		$insert_data['transaction_id'] 	= $data['txn_id']; 
		$insert_data['payment_status'] 	= $data['payment_status']; 				
		$insert_data['delivery_status'] = 'Processing'; 	
		//$insert_data['total_price'] 	= $data['payment_gross'];			
 		$insert_data['updated_on'] 		= date('Y-m-d H:i:s');
 		
 		$this->db->where('id', $order_id);							
		$this->db->update('tbl_orders', $insert_data);

		/* Get Order Details */
		$this->db->select('*');
		$this->db->from('tbl_orders');
		$this->db->where('transaction_id', $data['txn_id']);				
		$query = $this->db->get();	
		$row = $query->row_array();

		$temp_arr = array(); 
		$temp_arr['id'] 				= $row['id'];
		$temp_arr['transaction_id'] 	= $row['transaction_id'];
		$temp_arr['total_price'] 		= $row['total_price'];
		$temp_arr['payment_status'] 	= $row['payment_status'];
		$temp_arr['delivery_status']	= $row['delivery_status'];
		$temp_arr['updated_on'] 		= date('m/d/Y H:i:s', strtolower($row['updated_on']));
		$temp_arr['order_details']  	= $this->get_details($row['id']);		
		$temp_arr['user_email']  		= $this->get_val('users', 'id', $row['user_id'], 'email');	
		$temp_arr['shipping_address']	= $this->home_model->get_address_details($row['user_id'], 'shipping'); 	
		$temp_arr['billing_address']	= $this->home_model->get_address_details($row['user_id'], 'billing'); 
		/* End */
		return $temp_arr;
	}	

	//Get Last Order Id
	public function get_last_order_id(){
		
		$user_id = $this->ion_auth->get_user_id();

		$this->db->select('id');
		$this->db->from('tbl_orders');
		$this->db->where('user_id', $user_id);		
		$this->db->order_by('id', 'desc');		
		$query = $this->db->get();

		$row = $query->row_array();
		$order_id = $row['id'];

		return $order_id; 
	}
	
	//Show Testimonials List
	public function Show_Testimonial()
	{
		$query = "SELECT * FROM `tbl_testimonial` WHERE `status` = '1'";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	//Get order list
	public function get_order_list($user_id){

		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->from('tbl_orders');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();		
		$result = $query->result_array();

		$temp_arr = $temp_arr1 = array();
		foreach($result as $key=>$value){
			
			$temp_arr['order_id'] 			= $value['id']; 	
			$temp_arr['order'] 				= $value['transaction_id']; 	
			$temp_arr['date']				= $value['created_on'];
			$temp_arr['delivery_status']	= $value['delivery_status'];	
			$temp_arr['qty']				= $this->get_qty($value['id']);
			$temp_arr['total']				= $value['total_price'];

			$temp_arr1[] = $temp_arr;
		}		

		return $temp_arr1; 	
	}

	//Get qty
	public function get_qty($order_id){

		$this->db->select('qty');
		$this->db->where('order_id', $order_id);	
		$this->db->from('tbl_order_details');
		$query = $this->db->get();		
		$result = $query->result_array();

		$qty = 0;
		foreach($result as $key=>$value){			
			$qty = $qty+$value['qty']; 				
		}		

		return $qty; 	
	}

	//Get order
	public function get_order_details($order_id){

		$this->db->select('*');
		$this->db->where('id', $order_id);
		$this->db->from('tbl_orders');
		
		$query = $this->db->get();		
		$result = $query->result_array();
		//echo "<pre>";print_r($result);

		$temp_arr = array();
		
		foreach($result as $key=>$value){
			
			$temp_arr['id'] 				= $value['id']; 	
			$temp_arr['transaction_id']		= $value['transaction_id'];
			$temp_arr['order_details']		= $this->get_details($value['id']);
			$temp_arr['total_price']		= $value['total_price'];	
			$temp_arr['payment_status']		= $value['payment_status'];
			$temp_arr['delivery_status']	= $value['delivery_status'];
			$temp_arr['created_on']			= $value['created_on'];			
		}
		
		return $temp_arr; 	
	}

	//Get order details
	public function get_details($order_id){

		$this->db->select('*');
		$this->db->where('order_id', $order_id);
		$this->db->from('tbl_order_details');
		
		$query = $this->db->get();		
		$result = $query->result_array();
		
		//echo "<pre>";print_r($result);exit();

		$temp_arr1 = $temp_arr2 = array();
		
		foreach($result as $key=>$value){
			
			$temp_arr1['order_detail_id'] 	= $value['id']; 	
			$temp_arr1['order_id']			= $value['order_id'];
			$temp_arr1['product_id']		= $value['product_id'];	
			$temp_arr1['product_name']		= $this->get_val('tbl_products', 'product_id', $value['product_id'], 'product_name');	
			$temp_arr1['qty']				= $value['qty'];
			$temp_arr1['price']				= $value['price'];			

			$temp_arr2[] =  $temp_arr1;
		}		
			
		return $temp_arr2; 	

	}

	//Get order details
	public function get_val($table, $match_field, $match_value, $find_field){

		$this->db->select($find_field);
		$this->db->where($match_field, $match_value);
		$this->db->from($table);
		$query = $this->db->get();		

		$row = $query->row_array();		
		$temp_value = $row[$find_field];
		
		return $temp_value; 	
	}

	//Get address details
	public function get_address_details($user_id, $type){

		if($type=='shipping'){
			$table = "tbl_shipping_address";
		}else{
			$table = "tbl_billing_address";
		}

		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->from($table);		
		$query = $this->db->get();	

		$result = $query->result_array();
		
		$temp_arr = array();		
		foreach($result as $key=>$value){
			
			$temp_arr['id'] 				= $value['id']; 	
			$temp_arr['user_id']			= $value['user_id'];
			$temp_arr['first_name']			= $value['first_name'];	
			$temp_arr['last_name']			= $value['last_name'];	
			$temp_arr['email']				= $value['email'];	
			$temp_arr['phone']				= $value['phone'];																					
			
			$temp_arr['country_id']			= $value['country'];
			$temp_arr['state_id']			= $value['state'];
			$temp_arr['city_id']			= $value['city'];						
			
			$temp_arr['country']			= $this->get_val('countries', 'id', $value['country'], 'name');
			$temp_arr['state']				= $this->get_val('states', 'id', $value['state'], 'name');
			$temp_arr['city']				= $this->get_val('cities', 'id', $value['city'], 'name');						
			$temp_arr['address']			= $value['address'];	
			$temp_arr['zip_code']			= $value['zip_code'];	
			$temp_arr['created_at']			= $value['created_at'];	
			$temp_arr['updated_at']			= $value['updated_at'];	

		}			
			
		return $temp_arr; 	

	}

	public function update_address_popup($data, $type){

		unset($data['submit']);
		$user_id 			= $this->ion_auth->get_user_id();		
		$data['user_id'] 	= $user_id;		
		$data['created_at'] = date('Y-m-d h:i:s');		
		$data['updated_at'] = date('Y-m-d h:i:s');		

		if($type=='shipping'){
			$table = "tbl_shipping_address";
		}else{
			$table = "tbl_billing_address";		
		}

		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->from($table);		
		$query = $this->db->get();		

		if($query->num_rows()>0){
			$this->db->where('user_id', $user_id);	
			$this->db->update($table, $data);	
		}else{
			$this->db->insert($table, $data);	
		}

		return true;
	}

	public function isexist_product($arr){

		$this->db->select('*');
		$this->db->where('user_id', $arr['user_id']);
		$this->db->where('product_id', $arr['product_id']);
		$this->db->where('product_attribute_value', $arr['product_attribute_value']);
		$this->db->from('tbl_cart');  
		$query = $this->db->get();  

		$row = $query->row_array();
		$temp_arr = array();

		if(!empty($row)){   
		$temp_arr['qty'] = $row['qty'];
		}

		return $temp_arr;
	}

	public function add_Quote($data){
	  $this->db->insert('tbl_request_quote',$data);
	  return true;
	}
	

	/* Stock qty minus */
	public function update_stock($data){

		$sql = "Update `tbl_products` 
				Set `quantity` 		= `quantity` - ".$data['minus_qty']."
				Where `product_id` 	= '".$data['product_id']."'"; 
				
		//exit($sql);
		$this->db->query($sql);
		return true;		
	} 			
    
	public function update_transaction($status , $attr){

		$sql = "Update `tbl_transaction` 
				Set `status` 		= '".$status."'
				Where `transaction_no` 	= '".$attr."'"; 
				
		//exit($sql);
		$this->db->query($sql);
		return true;		
	} 		
	
	//Show Recent Product List
	public function getRecentProducts(){
	
	  $query = "SELECT TP.*, TPI.product_image FROM `tbl_products` AS TP LEFT JOIN `tbl_product_image` AS TPI ON TP.product_id=TPI.product_id ORDER BY TP.product_id DESC LIMIT 0,8";
	  $result = $this->db->query($query);
	  return $result->result_array();
	  /*$this->db->select('*');
	  $this->db->from('tbl_products');
	  $this->db->order_by('product_id', 'desc');
	  $this->db->limit(4);
	  $query = $this->db->get();
	  /return $query->result_array();*/
	 }
	 
	 public function get_attribute_value () {
	     $this->db->select('*');
	     $this->db->from('tbl_attribute_value');
	     $this->db->join('tbl_attribute', 'tbl_attribute.attribute_id = tbl_attribute_value.attribute_id','inner');
	     $result = $this->db->get();
	     return $result->result();
	 }
	 
	 public function Show_Networks( $product_id )
	{
		$this->db->select('tbl_networks.* , network_attribute.id , network_attribute.network_id , network_attribute.price_value , network_attribute.product_id ');
		$this->db->from('tbl_networks');
		 $this->db->join('network_attribute', 'network_attribute.network_id = tbl_networks.id','inner');
	    $this->db->where('tbl_networks.status' , '1');
		$this->db->where('network_attribute.product_id', $product_id );
		$this->db->order_by('network_attribute.id', 'desc');
		
		$result = $this->db->get();
//echo $this->db->last_query();exit();		
		return $result->result();
		
	}
	     


	}