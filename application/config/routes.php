<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['admin'] 		        = 'welcome/Index/contact_us';
$route['auth'] 		            = 'auth';
$route['reset-newpassword/(:any)'] = 'auth/Auth/reset_password/$i' ;
$route['default_controller'] 	= 'welcome/index';
//$route['product-details/(:any)']=  "welcome/Index/product_details/$3";
$route['product-details/(:any)']=  "welcome/Index/product_details_new/$3";
$route['product-details-sandy/(:any)']=  "welcome/Index/product_details_new_sandy/$3";
$route['product-details-new/(:any)']=  "welcome/Index/product_details_new/$3";
$route['contact-us'] 			= 'welcome/Index/contact_us';
$route['cms_page/(:any)']       =  "welcome/Index/cms_page/$3";
$route['our-products'] 			= 'welcome/Index/products_listing';
$route['product-image-upload-old/(:any)']	=   "welcome/Index/image_upload/$3";
//$route['product-image-upload/(:any)']		=   "welcome/Index/image_upload_new/$3"; //sandy 14-05-2021
$route['product-image-upload/(:any)']		=   "welcome/Index/image_upload_new_1/$3"; //sandy 14-05-2021
$route['product-image-upload-new/(:any)']		=   "welcome/Index/image_upload_new_1/$3"; //sandy 14-05-2021

$route['cart-old'] 				= 'welcome/Cart/index';
$route['cart'] 					= 'welcome/Cart/index1'; //sandy 14-05-2021
$route['cart/add_cart_old'] 	= 'welcome/Cart/add_to_cart';
$route['cart/add_cart'] 		= 'welcome/Cart/add_to_cart_new'; //sandy 14-05-2021
$route['cart/update_cart'] 		= 'welcome/Cart/update_cart';
$route['cart/delete_cart_item/(:any)/(:any)'] = 'welcome/Cart/delete_cart_item/$1/$2';

$route['login'] 				= 'welcome/Index/login_register';
$route['register'] 				= 'welcome/Index/login_register';

$route['checkout_old'] 			= 'welcome/Index/checkout';
$route['checkout'] 				= 'welcome/Index/checkout_new'; //sandy 14-05-2021
$route['logout'] 			    = 'welcome/Index/logout';
$route['place_order_old'] 		= 'welcome/Index/place_order';
$route['place_order'] 			= 'welcome/Index/place_order_new';  //sandy 14-05-2021
//$route['manage-addresses/(:any)'] 			= 'welcome/Index/manage_addresses/$3';
$route['manage-addresses'] 	    = 'welcome/Index/manage_addresses';
$route['editprofile'] 			= 'welcome/Index/edit_profile';
$route['lost-password']         = 'welcome/Index/forget_password';
$route['my-account/reset-password/(:any)'] = 'welcome/Index/reset_password/$1';
$route['orderlist']             = 'welcome/Index/order_list';

$route['question'] 				= 'welcome/index/question';

