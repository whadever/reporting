<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct ()
	{
		if(!$this->session->userdata('user_id'))
		{
			$this->login();
		}
	}

	public function login()
	{
		
	}
}
