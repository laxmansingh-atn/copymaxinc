<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    /*function switchLang($language = "") {
        
        $language = ($language != "") ? $language : "english";
		
		$this->config->set_item('language',$language);
		
		$a_lang = $this->config->item('lang_uri_abbr');
		$lang_code = $this->uri->segment(1);
		$lang_code = array_search($language, $a_lang);
				
        $this->session->set_userdata('site_lang', $language);
        //echo $_SERVER['HTTP_REFERER'];exit();
        //redirect($_SERVER['HTTP_REFERER'].$lang_slug);
		//redirect($_SERVER['HTTP_REFERER']);
		redirect(base_url($a_lang));
        
    }*/
	public function switchLang($language = "") {
		
		$language = ($language != "") ? $language : "english";
		$this->config->set_item('language',$language);
		
		$a_lang = $this->config->item('lang_uri_abbr'); // new line
		//print_r($a_lang); exit();
		/*if(array_key_exists($lang_code,$a_lang))
		{
			$lang_value = $a_lang[$lang_code];
			//echo "Key exists!";
		}*/
		
		
		$lang_code = $this->uri->segment(1); // new line
		$lang_code = array_search($language, $a_lang); // new line
		
		$this->session->set_userdata('site_lang', $language); // new line
		
    		$this->load->library('user_agent');
    		$referrer = $this->agent->referrer();
    		//$referrer = $_SERVER['HTTP_REFERER'];
		$l = substr($referrer, strlen(base_url()));
		//echo $lang_code."<br />".$referrer; exit();
		//echo "URL : ".$referrer."<br />".$l; 
		//echo "<br />".$_SERVER['HTTP_REFERER'];
		//exit();
    		if(isset($referrer)){
	        	preg_match('/\/(.+)$/i',$l,$match);
	        	$redirect_url;
	        	if(empty($match)) {
	            	redirect(base_url().$lang_code ,'refresh');
	        	}
	        	else{
	            	$redirect_url = base_url().$lang_code.'/'.$match[1];
	        	}
				//echo $redirect_url;exit();
	        	redirect($redirect_url,'refresh');
	    	}else{
	        	redirect(base_url(),'refresh');
	    	}
  	}
	
	/*public function switchLang($language = "") {

	$this->session->set_userdata('site_lang', $language); // new line
    $this->load->library('user_agent');
    $referrer = $this->agent->referrer();

    $l = substr($referrer, strlen(base_url()));

    if(isset($referrer)){
        preg_match('/\/(.+)$/i',$l,$match);
        $redirect_url;
        if (empty($match)) {
            redirect(base_url().$language ,'refresh');
        }
        else{
            $redirect_url = base_url().$language.'/'.$match[1];
        }
		echo $redirect_url;exit();
        redirect($redirect_url,'refresh');
    }else{
        redirect(base_url(),'refresh');
    }
  }*/
	
}