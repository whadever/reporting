<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    private $company_id;
    private $user_id;
    private $user_role;

    function __construct(){
        parent::__construct();
        $this->load->model('calendar_model');
        $this->company_id = $this->session->userdata('company_id');
        $this->user_id = $this->session->userdata('is_active');
        $this->user_role = $this->crud_model->get_by_condition('users',array('id' => $this->user_id))->row('role');

    }

    public function faq(){
        $data['title']="FAQ";
        $this->template->load('default','user/faq',$data);
    }

    //dashboard
	public function index($year = '', $month = '')

	{  
        
        if($year == '' || $month == ''){
            $year = date('Y');
            $month = date('m');
        }
       

		$data['title'] = 'Dashboard';

        //checking the user role
        if($this->user_role == 'staff'){
            $data['calendar'] = $this->calendar_model->generate($year,$month,$this->user_id);    
        }elseif($this->user_role == 'manager'){
            $data['calendar'] = $this->calendar_model->manager_generate($year,$month,$this->company_id,$this->user_id);
        }elseif($this->user_role == 'admin'){
            $data['calendar'] = $this->calendar_model->admin_generate($year,$month,$this->company_id);
        }
        

		$this->template->load('default', 'user/home', $data);

	}

	
}
