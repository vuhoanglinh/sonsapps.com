<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

	public function __construct() {
		parent::__construct();	
		$this->load->Model('events_model');
		$this->load->library('../controllers/home');        
	}

	public function index()
	{
		
	}
}