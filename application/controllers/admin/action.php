<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

	public function __construct() {
		parent::__construct();	
		$this->load->Model('User_model');
	}

	public function checklogin()
	{
		//Load Library form_validation of Codeigniter
		$this->load->library('form_validation');

		$username = $this->input->post('txtUsername');
		$password = md5($this->input->post('txtPassword'));
		$level 	  =	1;
		$query 	  =	$this->User_model->getUserLogin($username, $password, $level);
		$data 	  = 0;

		if(count($query) > 0)
		{
			foreach($query as $row)
			{
				$arr_session 	=	array(
									'userid'	=>	$row->id,
									'fullname'	=>	$row->fullname,
									'username'	=>	$username,
									'password'	=>	$password
				);
				$this->session->set_userdata('logged_ad',$arr_session);
			}
			
			$data 	=	1;
		}

		echo $data;
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_ad');
		if($this->session->userdata('logged'))
		{			
			$this->session->unset_userdata('logged');
		}
		redirect(base_url("admin"), "location");
	}
}