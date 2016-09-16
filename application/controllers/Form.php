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
	}

 ?>