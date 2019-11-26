<?php
Class Login_model extends CI_Model{
	function login($user, $pass){
		$this->db->select('*');
		$this->db->from('aktor');
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows()==1) {
			return $query->result();
		} else{
			return false;
		}
	}
}
?>