<?php
class Hello extends CI_Controller {
	
	public $layout_view = 'layout/default';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($name=NULL)
	{
		//Fetch employee details
		$this->load->model('employee_model');
		$data['query'] = $this->employee_model->employee_details();
		
		//Calendar generate libary
		/* $this->load->library('Calendar');
		print_r($this->calendar->generate()); */
		
		$this->load->library('layout');          // Load layout library
		$this->layout->title('Hello World!'); 	// Set page title

		$data['test'] = $name;
		print_r($this->config->site_url());
		$this->layout->view('hello/hello_world', $data);
	}
	
	public function formprocess()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('hello/hello_world');
		}
		else
		{
			$this->load->view('welcome_message');
		}
	}
	
	public function autocomplete($name=NULL)
	{
		
	
		$this->load->library('layout');          // Load layout library
		$this->layout->title('Autocomplete!'); 	// Set page title
	
// 		print_r($this->config->site_url());
		$this->layout->view('hello/autocomplete');
	}
	
}