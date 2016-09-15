<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class User extends MY_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set('NZ');
	}

	public function index(){

	}

	public function settings(){
		$data['title'] = 'Settings';
		$this->template->load('default','user/settings',$data);
	}

}


?>