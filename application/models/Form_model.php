<?php 
	
	class Form_model extends CI_Model{

		function get_all_templates(){
			$this->db->select('forms.*,users.name as manager_name');
			$this->db->from('forms');
			$this->db->join('users','users.id = forms.manager_id');
			return $this->db->get()->result();
		}

		function get_form_fields($form_id){
			$this->db->select('forms.name, form_fields.*');
		}

		function get_staff_forms($user_id, $company_id){

			$this->db->select('forms.*');
			$this->db->from('forms');
			$this->db->join('form_users', 'forms.id = form_users.form_id');
			$this->db->where('form_users.user_id',$user_id);
			$this->db->where('forms.company_id',$company_id);
			return $this->db->get()->result();

		}

	}

 ?>