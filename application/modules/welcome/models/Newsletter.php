<?php

/*
** NewsLetter Modal
*/

class Newsletter extends CI_Model {

    public function signUp($data)
	{
		$data = $this->db->insert('newsletter_signup', $data);
		
		return;
	}

}