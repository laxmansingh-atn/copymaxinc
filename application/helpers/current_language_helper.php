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

if ( ! function_exists('get_current_language'))
{
	function get_current_language() {
		 $CI =& get_instance();
		 $lang_code = "";
		 
		 if($CI->session->userdata('site_lang') != "")
		 {
			 $current_language = $CI->session->userdata('site_lang');
			 $a_lang = $CI->config->item('lang_uri_abbr'); // new line
			 //$lang_code = $CI->uri->segment(1); // new line
			 $lang_code = array_search($current_language, $a_lang); // new line
		 }
		 else
		 {
		 	$lang_code = $CI->uri->segment(1);
		 }
		return $lang_code;
	}
}
?>