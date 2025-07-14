<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package  CodeIgniter
 * @subpackage Helpers
 * @category Helpers
 * @author  EllisLab Dev Team
 * @link  https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

function get_menu_items() {
     $CI =& get_instance();
     $CI->load->model('home_model');
     $result = $CI->home_model->Show_Category();
	 return $result;
}

function get_footer_menu_items() {
     $CI =& get_instance();
     $CI->load->model('home_model');
     $result = $CI->home_model->Show_Page();
     return $result;
}

function get_contact_details()
{
	$CI =& get_instance();
    $CI->load->model('home_model');
    $result = $CI->home_model->Show_Contacts();
    return $result;
}