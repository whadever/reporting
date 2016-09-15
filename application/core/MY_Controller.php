<?php  

	class MY_Controller extends CI_Controller
	{
		function __construct ()
		{
			parent::__construct ();

			if($this->session->userdata('user_logged') == NULL)
			{
				redirect('accounts');
			}elseif($this->session->userdata('is_active') == ''){
				redirect('accounts/login');
			}
		}

	}

?>