<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {

	public function __construct() {
		parent::__construct();	
		$this->load->Model('logs_model');
		$this->load->library('../controllers/home');        
	}

	public function index()
	{
		
	}
}