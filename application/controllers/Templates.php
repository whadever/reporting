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

		public function add_template(){
	
			
			$data['title'] = 'New Template';
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

			redirect(site_url('templates/assign_staff/'.$form_id));
		}

	
		/*assign staffs to a form*/
		public function staff_add(){
			if($this->input->post('save')){
				foreach($this->input->post('staffs') as $staff_id){
					
					$data_form_user = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'frequency' => $this->input->post('report_frequency'),
							'deadline' => $this->input->post('deadline'),
						);

					$data_form_submit = array(
							'form_id' => $this->input->post('form_id'),
							'user_id' => $staff_id,
							'manager_id' => $this->input->post('manager_id'),
							'deadline' => date('Y-m-d').' '.$this->input->post('deadline'),

						);

					$this->crud_model->insert_data('form_users',$data_form_user);
					$this->crud_model->insert_data('form_submits',$data_form_submit);
				}

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

		public function submit_report(){
			$data['title'] = 'Submit Report';
			$data['forms'] = $this->form_model->get_staff_forms($this->user_id,$this->company_id);
			
			$this->template->load('default', 'user/submit_report',$data);

		}

		public function get_period($form_id = ''){

			$form_period = $this->crud_model->get_by_condition('form_submits', 
				array('user_id'=>$this->user_id, 'is_submit' => 0,'form_id' => $form_id))->result();

			$period = '';
			if($form_period){
				$period .= '<option value="">Select Report Period</option>';
				foreach ($form_period as $row) {
					$deadline = explode(' ',$row->deadline);

					$period .= '<option value="'.$row->id.'">'.$deadline[0].'</option>';
				}
			}
			else{

				$period .= '<option value="">You dont have blabla</option>';
			}
				

			echo $period;
			
		}

		public function delete_template($form_id=''){
			if($form_id != ''){
				$this->crud_model->delete_data('form_users',array('form_id' => $form_id));
				$this->crud_model->update_data('forms',array('active' => 0),array('id' => $form_id));				
			}
			redirect('templates');
		}

		
		public function print_fields($form_id){
			$form_fields = $this->crud_model->get_by_condition('form_fields',array('form_id' => $form_id))->result();
			
			$output = '';

			
			$output .=	'<div class="col-md-6">';
					foreach($form_fields as $field): 
			         if($field->column == 1): 
			             $required = ($field->required == 1) ? "required" : "";
			          $output .=  '<div class="form-group">';
			          $output .=   '<label class="field-label '.$required.'" for="field_'.$field->id.' ">'. $field->title .'</label>';

			                 if($field->type == 'text'): 
			                    $output .= '<textarea name="field_'.$field->id.' " class="form-control" id="" placeholder="" '.$required.' ></textarea>';
			                 endif; 

			                 if($field->type == 'select'): 
			                    $output .= '<select name="field_'.$field->id.' "  class="form-control">';
			                         if($required == ""): 
			                            $output .= '<option value="">---select---</option>';
			                         endif; 
			                         foreach($field->select_options as $val): 
			                            $output .= '<option value="'. $val.' "> '. $val .' </option>';
			                         endforeach; 
			                    $output .= '</select>';
			                 endif; 

			                 if($field->type == 'date'): 
			                    $output .= '<input type="text" name="field_'.$field->id.' " class="form-control date" id="" placeholder=""'. $required.' >';
			                 endif; 

			                 if($field->type == 'radio-group-yes-no-na'): 

			                    $output .= '<input type="radio" name="field_'.$field->id.' " value="yes"> Yes';
			                    $output .= '<input type="radio" name="field_'.$field->id.' " value="no"> No';
			                    $output .= '<input type="radio" name="field_'.$field->id.' " value="na"> N/A';

			                 endif; 

			                 if($field->type == 'numbers'): 

			                    $output .= '<select name="field_'.$field->id.' " class="form-control">';
			                         if($required == ""): 
			                            $output .= '<option value="">---select---</option>';
			                         endif; 
			                         for($i=0; $i <= 100; $i++ ): 
			                            $output .= '<option value="'.$i.' ">'. $i .'</option>';
			                         endfor; 
			                    $output .= '</select>';

			                 endif; 

			                 if($field->type == 'document'): 
			                    $output .= '<input type="file" name="field_'.$field->id.' " class="" id="" '.$required.' >';
			                 endif; 


			            $output .= '</div>';
			         endif; 
			     endforeach; 
			$output .=	'</div>';
			$output .=	'<div class="col-md-6">';
					 foreach($form_fields as $field): 
			         if($field->column == 2): 
			             $required = ($field->required == 1) ? "required" : "";
			          $output .=  '<div class="form-group">';
			          $output .=   '<label class="field-label '.$required.'" for="field_'.$field->id.' ">'. $field->title .'</label>';

			                 if($field->type == 'text'): 
			                    $output .= '<textarea name="field_'.$field->id.' " class="form-control" id="" placeholder="" '.$required.' ></textarea>';
			                 endif; 

			                 if($field->type == 'select'): 
			                    $output .= '<select name="field_'.$field->id.' "  class="form-control">';
			                         if($required == ""): 
			                            $output .= '<option value="">---select---</option>';
			                         endif; 
			                         foreach($field->select_options as $val): 
			                            $output .= '<option value="'. $val.' "> '. $val .' </option>';
			                         endforeach; 
			                    $output .= '</select>';
			                 endif; 

			                 if($field->type == 'date'): 
			                    $output .= '<input type="text" name="field_'.$field->id.' " class="form-control date" id="" placeholder=""'. $required.' >';
			                 endif; 

			                 if($field->type == 'radio-group-yes-no-na'): 

			                    $output .= '<input type="radio" name="field_'.$field->id.' " value="yes"> Yes';
			                    $output .= '<input type="radio" name="field_'.$field->id.' " value="no"> No';
			                    $output .= '<input type="radio" name="field_'.$field->id.' " value="na"> N/A';

			                 endif; 

			                 if($field->type == 'numbers'): 

			                    $output .= '<select name="field_'.$field->id.' " class="form-control">';
			                         if($required == ""): 
			                            $output .= '<option value="">---select---</option>';
			                         endif; 
			                         for($i=0; $i <= 100; $i++ ): 
			                            $output .= '<option value="'.$i.' ">'. $i .'</option>';
			                         endfor; 
			                    $output .= '</select>';

			                 endif; 

			                 if($field->type == 'document'): 
			                    $output .= '<input type="file" name="field_'.$field->id.' " class="" id="" '.$required.' >';
			                 endif; 


			            $output .= '</div>';
			         endif; 
			     endforeach;  
			$output .=	'</div>';
			

			
			echo $output;
		     


		}

	}
 ?>