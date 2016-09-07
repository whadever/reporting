<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller
{
	public function index ()
	{
		if($this->session->userdata('user_logged') == NULL)
		{
			$this->login();
		}
	}

	public function login ()
	{
		$data['title'] = "User Login";

		if($this->input->post())
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			//Check for username and password validness
			if($userdata = $this->db->get_where('users', array('username' => $username, 'password' => $password))->row())
			{
				//Set The Session with no one logged
				if($this->session->userdata('user_logged') == NULL)
				{
					$session = array(

						'user_logged'				=> 1,
						'is_active'					=> $userdata->id,
						'id_' . $userdata->id 		=> array(

							'user_id' 	=> $userdata->id,
							'username'	=> $userdata->username

							)

						);

				$this->session->set_userdata($session);

				echo 'pisang lu';
				echo '<pre>';
				print_r($this->session->userdata());
				echo '</pre>';

				exit;
				}
				//Set The Session with someone one logged
				else
				{
					$session = array(

						'user_logged'				=> $this->session->userdata('user_logged') + 1,
						'is_active'					=> $userdata->id,
						'id_' . $userdata->id 		=> array(

							'user_id' 	=> $userdata->id,
							'username'	=> $userdata->username

							)

						);

					$this->session->set_userdata($session);

					echo 'apel lu';
					echo '<pre>';
					print_r($this->session->userdata());
					echo '</pre>';

					exit;
				}

			}
			//Username Is not found
			else
			{
				echo 'ga ada';
				exit;
			}
		}


		//If not post
		if($this->session->userdata('user_logged') == NULL)
		{
			//If there is no one logged in
			$this->template->load('default', 'accounts/login_non_logged', $data);
		}else
		{
			//If there is a person logged in
			$this->template->load('default', 'accounts/login_others_logged', $data);
		}
	}

	public function logout ()
	{
		$active_user = $this->session->userdata('is_active');
		$this->session->unset_userdata('id_' . $active_user);
		$this->session->set_userdata(array('is_active' => NULL));

		echo '<pre>';
		print_r($this->session->userdata());
		echo '</pre>';
	}

	public function switch_account ($id = '')
	{
		if($id == '')
		{
			redirect('accounts/login');
		}
	}
}

?>