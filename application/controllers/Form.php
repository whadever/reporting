<?php 

	class Form extends MY_Controller{

		private $company_id;
		private $user_id;
		private $user_role;

		function __construct(){
			parent::__construct();
			$this->load->model('form_model');
			$this->company_id = $this->session->userdata('company_id');
			$this->user_id = $this->session->userdata('is_active');
			$this->user_role = $this->crud_model->get_by_condition('users',array('id' => $this->user_id))->row('role');
			
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

		public function print_fields($form_id){
			$form_fields = $this->crud_model->get_by_condition('form_fields',array('form_id' => $form_id))->result();

			array_walk($form_fields,function($el){
				if($el->select_options){
					$el->select_options = unserialize($el->select_options);
				}
			});
			
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
			                    $output .= '<input type="date" name="field_'.$field->id.' " class="form-control date" id="" placeholder=""'. $required.' >';
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
			                    $output .= '<input type="date" name="field_'.$field->id.' " class="form-control date" id="" placeholder=""'. $required.' >';
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

		public function submit($form_id){

			/*submitting form*/
			$submit_date = date('Y-m-d H:i:s');
			$this->db->update('form_submits',array(
				
				'submit_date' => $submit_date,
				'is_submit' => 1	
			));
			$this->db->where();
			

			/*initializing file upload (for document type fields)*/
			$config['upload_path'] = FCPATH.'documents';

			$config['allowed_types'] = '*';
			$config['max_size'] = '100000KB';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			$form_fields = $this->crud_model->get_by_condition('form_fields',array('form_id' => $form_id))->result();
			$data = array();
			$error_message = "";
			foreach($form_fields as $field){
				if($field->required && $field->type != 'document' && $this->input->post('field_'.$field->id) == ''){
					$error_message = "Some required fields are empty.";
					$this->session->set_flashdata('warning-message', $error_message);
					/*restoring the overdue counter and deleting the form submission*/
					$sql = "update rs_form_users set overdue = overdue + 1 where form_id = {$form->id} and user_id = {$this->user_id}";
					$this->db->simple_query($sql);
					$this->db->delete('rs_submits', array('id' => $submit_id));
					redirect(site_url('form/submit/'.$form->id."/".$submission_period_id));
				}
				/*checking for document type field*/
				$fid = null;
				if($field->type == 'document'){
					if($field->required && $_FILES['field_'.$field->id]['size'] == 0){
						$error_message = "Some required fields are empty.";
						$this->session->set_flashdata('warning-message', $error_message);
						/*restoring the overdue counter and deleting the form submission*/
						$sql = "update rs_form_users set overdue = overdue + 1 where form_id = {$form->id} and user_id = {$this->user_id}";
						$this->db->simple_query($sql);
						$this->db->delete('rs_submits', array('id' => $submit_id));
						redirect(site_url('form/submit/'.$form->id));
					}
					/*uploading the file (for document type field)*/
					if ($this->upload->do_upload('field_'.$field->id)) {
						$upload_data = $this->upload->data();
						$document = array(
							'wp_company_id' => $this->wp_company_id,
							'filename' => $upload_data['file_name'],
							'filetype' => $upload_data['file_type'],
							'filesize' => $upload_data['file_size'],
							'filepath' => $upload_data['full_path'],
							'filename_custom' => $upload_data['file_name'],
							'created' => time(),
							'uid' => $this->user_id,
						);
						$this->db->insert('file',$document);
						$fid = $this->db->insert_id();
					}

				}
				$data[] = array(
					'submit_id' => $submit_id,
					'user_id' => $this->user_id,
					'form_id' => $form->id,
					'field_id' => $field->id,
					'field_label' => $field->title,
					/*saving the fid in case of document type field*/
					'field_value' => ($fid) ? $fid : nl2br($this->input->post('field_'.$field->id))
				);
			}

			if($this->db->insert_batch('rs_submit_values', $data)){

				/*saving the report pdf*/
				$this->_save_report_pdf($submit_id);

				/*sending mail to manager*/
				$recipients = array();
				$res = $this->db->query("select * from users where uid = {$form->manager_id} or uid = {$this->user_id} limit 0,2")->result();
				foreach($res as $r){
					//task #4116 - the creator manager of the form will not get mail by default
					//if($r->uid == $form->manager_id){
						/*task #4091*/
					//	$recipients[] = array(
					//		'name' => $r->username, 'email' => $r->email
					//	);
					//}
					if($r->uid == $this->user_id){
						$user_name = $r->username;
						/*task #4095*/
						$user_email = $r->email;
					}
				}
				/*getting managers to notify*/
				$managers_to_notify = array();
				if($form->managers_to_notify){
					$this->db->select('username, email');
					$this->db->where("uid in ({$form->managers_to_notify})");
					$this->db->where("company_id",$form->wp_company_id);
					$rows = $this->db->get('users')->result();
					foreach($rows as $r){
						//$managers_to_notify[] = $r->email;
						/*task #4091*/
						$recipients[] = array(
							'name' => $r->username, 'email' => $r->email
						);
					}

				}
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.wclp.co.nz';
				$config['smtp_port'] = '2525';
				$config['smtp_user'] = 'reporting_system@wclp.co.nz';
				$config['smtp_pass'] = 'Reporting1';
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['newline'] = "\r\n";

				$this->load->library('email',$config);
				$this->email->set_mailtype("html");

				/*$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$msg = "Hi {$to_name},<br> {$user_name} has submitted report: <b>{$form->name}</b>.<br>Thank You.";
				mail($to, "Reporting system: report submission notification", $msg, $headers);*/

				$subject = "Reporting system: report submission notification";
				$message =  "Hi #to_name#,<br><br>".
					        "<b>{$user_name}</b> has submitted <b>{$form->name}</b> on ".$submit_date."<br><br>".
							"<a href='".site_url('form/report/'.$submit_id)."'>Click this link</a> to see the report.<br><br>".
							"Thank You.";
				$file = FCPATH.'reports/'.$user_name."-".$form->name."-".str_replace(':','_',$submit_date).".pdf";

				/*if(!empty($managers_to_notify)){
					$this->email->cc($managers_to_notify);
				}*/ // task #4091

				$this->email->attach($file);
				// task #4091
				foreach($recipients as $recipient){
					$this->email->clear();
					$this->email->to($recipient['email']);
					//$this->email->from('reporting_system@wclp.co.nz', 'Reporting System');
					$this->email->from($user_email, $user_name); // task #4095
					$this->email->subject($subject);
					$this->email->message(str_replace('#to_name#',$recipient['name'],$message));
					$this->email->send();
				}

				$this->session->set_flashdata('success-message', "Report <b>{$form->name}</b> submitted successfully.");
				redirect(site_url('form/submit'));
			}
		}


	}

 ?>