<?php
class poll_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function employee_details()
	{
		$this->load->database();
		$query = $this->db->get('article');
		return $query->result();
	}
}