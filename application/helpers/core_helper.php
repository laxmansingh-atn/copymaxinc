<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_smtp_config'))
{
	function get_updated_smtp_config() {
        $config = [];
		$config['protocol']      = EMAIL_SMTP_PROTOCOL; //'mail';
        $config['smtp_host']     = EMAIL_SMTP_HOST; //'tls.copymaxinc.com';
        $config['smtp_port']     = EMAIL_SMTP_PORT; //'465';
        $config['smtp_user']     = EMAIL_SMTP_USER; //'test123@fitser.com';
        $config['smtp_pass']     = EMAIL_SMTP_PASSWORD; //'Test123@';
        $config['validation']    = EMAIL_SMTP_VALIDATION; //FALSE;
        $config['newline']       = EMAIL_SMTP_NEWLINE; //"\r\n";
        $config['smtp_crypto']   = EMAIL_SMTP_CRYPTO; //'tls';
        
        $config['charset']       = EMAIL_SMTP_CHARSET; //'utf-8';
        $config['mailtype']      = EMAIL_SMTP_MAIL_TYPE; //'html';
        $config['crlf']     = "\r\n";
        $config['newline']     = "\r\n";



        // For Testing Purpose only after Testing compete please comment below code
        
        // start Of test mail info
        // $config['protocol']      = 'smtp';
        // $config['smtp_host']     = 'sandbox.smtp.mailtrap.io';
        // $config['smtp_port']     = 2525;
        // $config['smtp_user']     = '55a3b694333fe0';
        // $config['smtp_pass']     = '22b482fa129282';
        // $config['smtp_crypto']   = 'tls';
        // $config['crlf']          = 'tls';
        //End Of test mail info

		return $config;
	}
}
     
/** @var CI_Controller|CI_Email $CI */
if (!function_exists('sendMail')) {
	function sendMail($data) {
        error_reporting(-1);
		ini_set('display_errors', 1);
        $CI =& get_instance();
        $config = get_updated_smtp_config();
        $email = $CI->load->library('email');
        $CI->email->initialize($config);
        $CI->email->set_crlf("\r\n");
        $CI->email->from(EMAIL_SMTP_FROM_EMAIL, EMAIL_SMTP_FROM_NAME);
        $CI->email->to($data['to']);
        $CI->email->subject($data['subject']);
        $CI->email->message($data['message']);
        if ($CI->email->send()) {
            return true;
        } else {
            dd($CI->email->print_debugger());
            return false;
        }
    }
}

?>