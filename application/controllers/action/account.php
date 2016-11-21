<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	protected $_email_debugger 	=	 "";

	public function __construct() {
		parent::__construct();
		$this->load->Model('User_model');
	}

	public function setEmail()
	{
		$config['protocol'] 	= 'smtp';
		$config['smtp_host'] 	= 'smtp.gmail.com';
		$config['smtp_port'] 	=  '465';
		$config['smtp_timeout'] = '30';
		$config['smtp_user'] 	= 'kimiapi.ad@gmail.com';
		$config['smtp_pass'] 	= 'Kimi@api@d';
		$config['mailtype'] 	= 'html';
		$config['charset'] 		= 'utf-8';
		$config['wordwrap'] 	= TRUE;

		return $config;
	}

	/**
	* Function checkname, using ajax check name form register
	* @param Post input username
	*/
	public function checkname()
	{
		$bool 		=	0;
		$username 	=	$this->input->post('username');
		if($username != "")
		{
			if($this->User_model->getUsername($username))
			{
				$bool 	=	1;
			}
		}
		echo $bool;
	}

	public function register()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtName', 'Full Name', 'trim|required|max_length[255]|xss_clean');
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|max_length[30]|xss_clean');
		$this->form_validation->set_rules('txtRePassword', 'Confirm Password', 'trim|required|max_length[30]|matches[txtPassword]|xss_clean');
		$this->form_validation->set_rules('txtPhone', 'Phone', 'trim|required|max_length[30]|xss_clean');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|max_length[30]|xss_clean');

		//Status = 0: lỗi không thêm vào được cơ sở dữ liệu
		//Status = 1: lỗi username bị trùng
		//Status = 2: user đăng ký tài khoản thành công, nhưng không thêm vào được cơ sở dữ liệu
		//Status = 3: user đăng ký thành công.

		$status =	'0';
		$result = '0';
		if($this->form_validation->run() == FALSE) {
			$status =	'0';
		}
		else
		{
			$username =	$this->input->post('txtUsername');
			if($this->User_model->getUsername($username))
			{
				$status =	'1';
			}
			else
			{
				$status = '2';
				$datestring         =   "%Y/%m/%d %h:%i:%s";
				$date_added			=	mdate($datestring, time() - 60*60);
				$last_modified      =   mdate($datestring, time() - 60*60);

				$fullname 	        =	$this->input->post('txtName');
				$password 	        =	md5($this->input->post('txtPassword'));
				$phone 			    =	$this->input->post('txtPhone');
				$email 			    =	$this->input->post('txtEmail');

				$arr 				=	array(
													'username'		=>	$username,
													'fullname'	    =>	$fullname,
													'password'	    =>	$password,
													'phone'			=>	$phone,
													'email'			=>	$email,
													'created_at'    =>	$date_added,
													'updated_at'    =>	$last_modified,
													'delete'		=>	'0'
											);
				if($this->User_model->insert($arr))
				{
					$status 	=	'3';
					$result 	=	$this->sendRegisterMail($email, $fullname);
					//$this->setLogin($fullname,$username, $password);
					$_SESSION['reg_success']	=	TRUE;
				}
			}
		}
		echo json_encode(array('status' => $status, 'result' => $result, 'debug'	=>	$this->_email_debugger));
	}

	public function complete($username, $email)
	{
		$this->User_model->complete($username, $email);
		redirect(base_url());
	}

	public function sendRegisterMail($email, $username)
	{
		//$config 	=	$this->setEmail();

		$data['username']	=	$username;
		$data['email']		=	$email;
		$message 			=	$this->load->view('email/register_view', $data, TRUE);

		$this->load->library('email');
		//$this->email->initialize( $config);
		$result = $this->email->from('support@sonsapps.com', 'Register sonsapps.com')
		                      ->to($email)
		                      ->subject('Thank you for registering. Welcome to Sonsapps.com')
		                      ->message($message)
                              ->send();
		
		$this->_email_debugger 	=	$this->email->print_debugger();
		return $result;
	}
       
	public function login()
	{
			//Load Library form_validation of Codeigniter
			$this->load->library('form_validation');

			$username = $this->input->post('txtUsername');
			$password = md5($this->input->post('txtPassword'));
			$query 	  =	$this->User_model->getUserLogin($username, $password);
			$data 	  = 0;

			if(count($query) > 0)
			{
				foreach ($query as $row) {
					# code...
					$this->setLogin($row->id, $row->fullname, $username, $password);
					break;
				}
				$data 	=	1;
			}
			echo $data;
	}

	public function setLogin($userid, $fullname, $username, $password, $level = 0)
	{
		$arr_session 	=	array(
										'userid'	=>	$userid,
										'fullname'	=>	$fullname,
										'username'	=>	$username,
										'password'	=>	$password,
										'level'		=>	0
									);
		$this->session->set_userdata('logged',$arr_session);
        $cookie_time	=	3600*24*30;				
        $this->input->set_cookie('userid',$arr_session['userid'],$cookie_time);
        $this->input->set_cookie('fullname',$arr_session['fullname'],$cookie_time);    
        $this->input->set_cookie('username',$arr_session['username'],$cookie_time);
        $this->input->set_cookie('password',$arr_session['password'],$cookie_time);
	}
}
