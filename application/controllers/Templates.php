<?php 

	class Templates extends MY_Controller{

		function __construct(){
			parent::__construct();
			$this->load->model('form_model');

		}

		public function index(){
			$data['title'] = 'Templates';
			$data['forms'] = $this->form_model->get_all_templates();

			
			foreach($data['forms'] as $form){
				$data['form_staffs'][$form->id] = array();

				$this->db->select('users.id, users.name');
				$this->db->join('form_users','users.id = form_users.user_id');
				$this->db->where('form_users.form_id',$form->id);
				$staffs = $this->db->get('users')->result();
				foreach($staffs as $staff){
					$data['form_staffs'][$form->id][] = $staff->name;
					
				}
			}

			 

			$this->template->load('default', 'user/template',$data);
		}

		public function add_template(){
			$data['title'] = 'New Template';
			$this->template->load('default', 'user/add_template',$data);
		}

		/*creating the form*/
		public function create($id = null){

			//if($this->user_app_role != 'manager') return;
			// if($this->user_app_role != 'admin') return; //task #4497

			$messages = array();

			/*validation*/
			if (empty($this->input->post('name')))
			{
				$messages[] = "Report name cannot be blank.";

			}
			$fields = json_decode($this->input->post('fields'));

			if(empty($fields)){

				$messages[] = "Report must have at least one form field.";
			}

			if(!empty($messages)){

				$this->session->set_flashdata('warning-message', implode("<br>",$messages));

				redirect(site_url('templates/add'));
			}

			if(is_null($id)){

				$data = array(
					'name' => $this->input->post('name') ,
					'manager_id' => 1,
					'company_id' => 1,
					'created'=>date("Y-m-d H:i:s")
				);

				echo "<pre>";
				print_r($data);
				echo "</pre>";

				$this->db->insert('forms', $data);

				$form_id = $this->db->insert_id();

			}//else{
			// 	/*update*/
			// 	$form = $this->form_model->get_form($id);
			// 	if(!$form){
			// 		return;
			// 	}
			// 	$form_id = $form->id;
			// 	$this->db->where('id', $form_id);
			// 	$this->db->update('rs_forms', array('name' => $this->input->post('name')));
			// }
			/*adding / updating / deleting form fields*/
			$field_id_arr = array();
			foreach($fields as $field){

				$data = array(
					'form_id' => $form_id,
					'column' => $field->col,
					'order' => $field->order,
					'type' => $field->type,
					'title' => $field->label,
					'select_options' => (isset($field->options)) ? serialize($field->options) : null,
					'required' => ($field->required == 1) ? 1 : 0

				);

				echo "<pre>";
				print_r($data);
				echo "</pre>";

				if(!isset($field->id)){

					$this->db->insert('form_fields', $data);

					$field_id_arr[] = $this->db->insert_id();

				}else{

					$this->db->where('id', $field->id);

					$this->db->update('form_fields', $data);

					$field_id_arr[] = $field->id;
				}
			}

			$this->db->where('form_id',$form_id);
			$this->db->where('id NOT IN ('.implode(',', $field_id_arr).')');
			$this->db->delete('form_fields');

			redirect(site_url('templates/staffs/'.$form_id));
		}

		/*the page to assign staffs to a form*/
		public function staffs($form_id = null){

			// if(is_null($form_id)) exit;

			// //if($this->user_app_role != 'manager') return;
			// //if($this->user_app_role != 'admin') return; //task #4497

			// $form = $this->db->get_where('forms',$form_id);

			// $form_user_id_arr = array();

			// $res = $this->db->query("select user_id, frequency, deadline from form_users where form_id = {$form->id}")->result();

			// foreach($res as $row){

			// 	$form_user_id_arr[] = $row->user_id;
			// }
			// $data['deadline'] = (isset($row))? $row->deadline : null;
			// $data['title'] = 'Add Staffs';

			// $user=  $this->session->userdata('user');
			// $data['user']=$user;
			// $data['wp_company_id'] = $this->wp_company_id;

			// $data['form'] = $form;
			// $data['form_users'] = $form_user_id_arr;
			// $data['notify_managers'] = explode(',',$form->managers_to_notify);
			// $data['frequency'] = (isset($row)) ? $row->frequency : '';
			// $data['staffs'] = $this->form_model->get_all_staffs();
			// $data['managers'] = $this->form_model->get_all_managers();
			/*now a form can be assigned to both staffs and managers */
			// $data['staffs'] = array_merge($data['staffs'], $data['managers']);
			// $data['maincontent'] = $this->load->view('form_users',$data,true);
			// $this->load->view('includes/header',$data);
			// $this->load->view('home',$data);
			// $this->load->view('includes/footer',$data);

		}
	}


 ?>