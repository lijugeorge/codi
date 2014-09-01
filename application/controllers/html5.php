<?php
class Html5 extends CI_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('html');
		$this->load->view('html/index');
	}
	
	public function psuedo()
	{
		$this->load->helper('html');
		$this->load->view('html/psuedo');
	}
}