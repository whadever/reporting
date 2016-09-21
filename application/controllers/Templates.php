<?php 

	class Templates extends MY_Controller {

		private $company_id;
		private $user_id;
		private $user_role;

		function __construct(){
			parent::__construct();
			$this->load->model('form_model');
			$this->company_id = $this->session->userdata('company_id');
			$this->user_id = $this->session->userdata('is_active');
			$this->user_role = $this->crud_model->get_by_condition('users',array('id' => $this->user_id))->row('role');

			if($this->user_role == 'staff'){
				redirect('main');
			}
			
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

		public function add_template($id = null){

			/*getting all form fields in case of updating*/
			if(!is_null($id)){

				$form = $this->form_model->get_form($id);
				if(!$form){
					echo "not a valid form"; exit;
				}

				$data['form_fields'] = $this->form_model->get_form_fields($id, 'manager');
				$data['form'] = $form;

				array_walk($data['form_fields'],function($el){
					if($el->select_options){
						$el->select_options = unserialize($el->select_options);
					}
				});

				$data['title'] = 'Edit Template';
			}else{
				$data['title'] = 'Create Template';
			}
	
			
			
			$this->template->load('default', 'user/add_template',$data);
		}

		/*creating the form*/
		public function create($id = null){
			

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
					'manager_id' => $this->user_id,
					'company_id' => $this->company_id,
					'created'=>date("Y-m-d H:i:s")
				);

				

				$this->db->insert('forms', $data);

				$form_id = $this->db->insert_id();

			}
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

			redirect(site_url('templates/assign_staff/'.$form_id));
		}

	
		/*assign staffs to a form*/
		public function staff_add(){
			
			if($this->input->post('save')){
				foreach($this->input->post('staffs') as $staff_id){
					

					if($this->input->post('report_frequency') == 'daily'){
						$data_form_user = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'frequency' => $this->input->post('report_frequency'),
							'deadline' => $this->input->post('deadline')
							
						);

						$data_form_submit = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'manager_id' => $this->input->post('manager_id'),
							'deadline' => date('Y-m-d').' '.$this->input->post('deadline'),

						);
					}elseif($this->input->post('report_frequency') == 'weekly' || $this->input->post('report_frequency') == 'fortnightly'){
						$this_week = 'this '.$this->input->post('week');

						$data_form_user = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'frequency' => $this->input->post('report_frequency'),
							'deadline' => $this->input->post('week').' '.$this->input->post('deadline')
							
						);

						$data_form_submit = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'manager_id' => $this->input->post('manager_id'),
							'deadline' => date('Y-m-d',strtotime($this_week)).' '.$this->input->post('deadline'),

						);
					}elseif($this->input->post('report_frequency') == 'monthly'){

						$data_form_user = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'frequency' => $this->input->post('report_frequency'),
							'deadline' => $this->input->post('day').' '.$this->input->post('deadline')
							
						);

						$data_form_submit = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'manager_id' => $this->input->post('manager_id'),
							'deadline' => date('Y-m').'-'.$this->input->post('day').' '.$this->input->post('deadline'),

						);
					}elseif($this->input->post('report_frequency') == 'yearly'){
						$date = explode('-',$this->input->post('date'));
						$date = $date[1].'-'.$date[0];

						$data_form_user = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'frequency' => $this->input->post('report_frequency'),
							'deadline' => $date.' '.$this->input->post('deadline')
							
						);

						$data_form_submit = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'manager_id' => $this->input->post('manager_id'),
							'deadline' => date('Y').'-'.$date.' '.$this->input->post('deadline'),

						);
					}elseif($this->input->post('report_frequency') == 'custom'){
						$date = explode('-',$this->input->post('date'));
						$date = $date[2].'-'.$date[1].'-'.$date[0];

						$data_form_user = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'frequency' => $this->input->post('report_frequency'),
							'deadline' => $date.' '.$this->input->post('deadline')
							
						);

						$data_form_submit = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'manager_id' => $this->input->post('manager_id'),
							'deadline' => $date.' '.$this->input->post('deadline'),

						);
					}

					
					 $this->crud_model->insert_data('form_users',$data_form_user);
				     $this->crud_model->insert_data('form_submits',$data_form_submit);
				}
				$data_forms = array(
						'frequency' => $this->input->post('report_frequency'),
						'report_color' => '#'.$this->input->post('report_color')
					);
				$this->crud_model->update_data('forms',$data_forms,array('id'=>$this->input->post('form_id')));
				if($this->input->post('managers')){
					$managers_to_notify = implode(', ', $this->input->post('managers'));

					$this->crud_model->update_data('forms',array('managers_to_notify' => $managers_to_notify),
						array('id' => $this->input->post('form_id'), 'company_id' => $this->company_id));

				}


			}
			redirect('templates');
		}
		
		public function assign_staff($form_id=''){
			$data['title'] = 'Assign Staff and Frequency';
			$data['staffs'] = $this->crud_model->get_by_condition('users',array('role !=' => 'admin', 'company_id' => $this->company_id))->result();
			$data['managers'] = $this->crud_model->get_by_condition('users',array('role !=' => 'staff', 'company_id' => $this->company_id))->result();
			$data['form'] = $this->crud_model->get_by_condition('forms',array('id' => $form_id))->row();

			$form_user_id_arr = array();

			$res = $this->db->query("select user_id, frequency, deadline from form_users where form_id = {$data['form']->id}")->result();

			foreach($res as $row){

				$form_user_id_arr[] = $row->user_id;
			}

			$data['form_users'] = $form_user_id_arr;

			$this->template->load('default','user/assign_staff',$data);
		}	

		public function copy_template($form_id=''){
			$form=$this->crud_model->get_by_condition('forms',array('id'=>$form_id))->row();
			if($form){
				$data=array(
					'name'=>$form->name,
					'manager_id'=>$form->manager_id,
					'company_id'=>$form->company_id,
					'managers_to_notify'=>$form->managers_to_notify,
					'report_color'=>$form->report_color,
					'created'=>date("Y-m-d H:i:s"),
					'active'=>1

					);
				$this->db->insert('forms',$data);
				$fid=$this->db->insert_id();
				$fields=$this->crud_model->get_by_condition('form_fields',array('form_id'=>$form_id))->result();
				/*Copy fields*/
				foreach($fields as $field){
					$data = array(
						'form_id' => $form_id,
						'column' => $field->column,
						'order' => $field->order,
						'type' => $field->type,
						'title' => $field->title,
						'select_options' => (isset($field->select_options)) ? serialize($field->select_options) : null,
						'required' => ($field->required == 1) ? 1 : 0
					);
				}
				redirect(site_url('templates/assign_staff/'.$fid));
			}
		}

		public function edit_template($form_id=''){
			$data['title']='Edit Template';
			$data['form']=$this->crud_model->get_by_condition('forms',array('id'=>$form_id))->row();
			
			$data['form_fields'] = $this->crud_model->get_by_condition('form_fields',array('form_id'=>$form_id))->result();
			
			array_walk($data['form_fields'],function($el){
				if($el->select_options){
					$el->select_options = unserialize($el->select_options);
				}
			});
			$this->template->load('default', 'user/edit_template',$data);
			if($this->input->post('assign_staff')){
				$newtitle=$this->input->post('template_title');
				$this->crud_model->update_data('forms',array('name'=>$newtitle),array('id'=>$form_id));
				redirect(site_url('templates/assign_staff/'.$form_id));
			}
			
			

		}


		public function delete_template($form_id=''){
			if($form_id != ''){
				$this->crud_model->delete_data('form_users',array('form_id' => $form_id));
				$this->crud_model->delete_data('form_submits',array('form_id' => $form_id, 'is_submit' => 0));
				$this->crud_model->update_data('forms',array('active' => 0),array('id' => $form_id));				
			}
			redirect('templates');
		}


	}
 ?>