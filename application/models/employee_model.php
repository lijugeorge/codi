<?php
class Employee_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function employee_details()
	{
		$query = $this->db->get('election_poll');
		return $query->result();
	}
}