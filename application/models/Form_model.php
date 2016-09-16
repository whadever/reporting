<?php 
	
	class Form_model extends CI_Model{

		function get_all_templates(){
			$this->db->select('forms.*,users.name as manager_name');
			$this->db->from('forms');
			$this->db->join('users','users.id = forms.manager_id');
			$this->db->where('forms.active',1);
			return $this->db->get()->result();
		}

		
	}

 ?>