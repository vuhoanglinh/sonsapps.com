<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();	
		$this->load->library('../controllers/home');
        $this->setUrlUpFile();
	}

	public function checklogin()
	{
		if(!$this->session->userdata('logged_ad'))
		{
			redirect(base_url("admin"), "location");
		}
		$this->home->setLang();
	}

	public function index()
	{
		$this->checklogin();

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/index_view');
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function login()
	{
		if($this->session->userdata('logged_ad'))
		{
			redirect(base_url("admin/index.html"), "location");
		}

		$this->load->view('themes/head_view');		
		$this->load->view('admin/login_view');
		$this->load->view('themes/end_view');
	}

	public function game()
	{
		$this->checklogin();

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game_view');
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function setUrlUpFile()
	{
		$_SESSION['base_url'] 	=	base_url().'upload/';
	}
}