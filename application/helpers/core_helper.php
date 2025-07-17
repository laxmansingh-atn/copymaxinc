<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (!function_exists('sendMail')) {
	function sendMail($data, $image_full_path = null, $invoice_path = null) {
		$mail = new PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->Host       = EMAIL_SMTP_HOST;
			$mail->SMTPAuth   = EMAIL_SMTP_VALIDATION;
			$mail->Username   = EMAIL_SMTP_USER;
			$mail->Password   = EMAIL_SMTP_PASSWORD;
			$mail->SMTPSecure = EMAIL_SMTP_CRYPTO;
			$mail->Port       = EMAIL_SMTP_PORT;
			$mail->setFrom(EMAIL_SMTP_FROM_EMAIL, EMAIL_SMTP_FROM_NAME);

            //For Testing Purpose only
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'laxmansingh.atn@gmail.com';
            $mail->Password   = 'krtfuzadtpefgvaa';          // Your Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
			$mail->setFrom('laxmansingh.atn@gmail.com', EMAIL_SMTP_FROM_NAME);

			// Main recipient
			$mail->addAddress($data['to']);

			// Optional: Add CC
			if (!empty($data['cc'])) {
				if (is_array($data['cc'])) {
					foreach ($data['cc'] as $cc) {
						$mail->addCC($cc);
					}
				} else {
					$mail->addCC($data['cc']);
				}
			}

			// Optional: Add BCC
			if (!empty($data['bcc'])) {
				if (is_array($data['bcc'])) {
					foreach ($data['bcc'] as $bcc) {
						$mail->addBCC($bcc);
					}
				} else {
					$mail->addBCC($data['bcc']);
				}
			}

			// Email content
			$mail->isHTML(true);
			$mail->Subject = $data['subject'];
			$mail->Body    = $data['message'];

			if (!empty($image_full_path)) {
				if (is_array($image_full_path)) {
					foreach ($image_full_path as $img) {
						if (file_exists($img)) {
							$mail->addAttachment($img);
						}
					}
				} elseif (file_exists($image_full_path)) {
					$mail->addAttachment($image_full_path);
				}
			}

			if (!empty($invoice_path)) {
				if (is_array($invoice_path)) {
					foreach ($invoice_path as $invoice) {
						if (file_exists($invoice)) {
							$mail->addAttachment($invoice);
						}
					}
				} elseif (file_exists($invoice_path)) {
					$mail->addAttachment($invoice_path);
				}
			}

            // Enable verbose debug output (0 = off, 2 = full)
            // $mail->SMTPDebug = 2; // or use 3 for even more detailed logs
            // $mail->Debugoutput = function($str, $level) {
            //     echo "Debug level $level; message: $str<br>";
            // };

			return $mail->send();

		} catch (Exception $e) {
			return false;
		}
	}
}



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


        $config['protocol']    = 'smtp';
        $config['smtp_host']   = 'smtp.gmail.com';
        $config['smtp_port']   = 587;
        $config['smtp_user']   = 'laxmansingh.atn@gmail.com';
        $config['smtp_pass']   = 'krtfuzadtpefgvaa';  //krtf uzad tpef gvaa
        $config['smtp_crypto'] = 'tls';
        $config['mailtype']    = 'html';
        $config['charset']     = 'utf-8';
        $config['newline']     = "\r\n";

        //End Of test mail info

		return $config;
	}
}
     
/** @var CI_Controller|CI_Email $CI */
if (!function_exists('sendMail_old')) {
	function sendMail_old($data) {
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