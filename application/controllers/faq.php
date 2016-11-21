<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function __construct() {
		parent::__construct();	
		$this->load->Model('Faq_model');
		$this->load->library('../controllers/home');
        if($this->input->cookie('lang'))
        {
            $this->home->_lang    =   $this->input->cookie('lang');
        }
        
		//Thiết lập ngôn ngữ cho hệ thống
		$this->home->setLang($this->home->_lang);
	}

	public function index()
	{	
		$username 	=	'';
		if($this->home->checklogin())
		{
			$session_data 		=	$this->session->userdata('logged');
			$username 			=	$session_data['fullname'];
		}
		$data['username']		=	$username;

		$language   =   'vietnamese';
        
        switch($this->home->_lang)
        {
            case 'vi': $language   =   'vietnamese';break;
            case 'en': $language   =   'english';break;
            case 'in': $language   =   'indonesia';break;
            case 'po': $language   =   'portugal';break;
            case 'cn': $language   =   'china';break;
            default: $language   =   'vietnamese';break;
        }

        //Get Faq list 1
        $data['faq1']	=	$this->Faq_model->get(null, 1, $language, null, null, 0);

        //Get Faq list 2
        $data['faq2']	=	$this->Faq_model->get(null, 1, $language, null, null, 1);

        //Get Faq list 3
        $data['faq3']	=	$this->Faq_model->get(null, 1, $language, null, null, 2);

        //Get Faq list 4
        $data['faq4']	=	$this->Faq_model->get(null, 1, $language, null, null, 3);

		$this->load->view('themes/head_view');
		$this->load->view('themes/navbar_view', $data);
		$this->load->view('themes/faq_view', $data);
		$this->load->view('themes/footer_view');
		$this->load->view('themes/end_view');
	}

	public function detail($alias, $id)
	{
		$username 	=	'';
		if($this->home->checklogin())
		{
			$session_data 		=	$this->session->userdata('logged');
			$username 			=	$session_data['fullname'];
		}
		$data['username']		=	$username;

		$data['faq']			=	$this->Faq_model->get($id, 1);
		if(count($data['faq']) > 0)
		{
			$this->load->view('themes/head_view');
			$this->load->view('themes/navbar_view',$data);
			$this->load->view('themes/faq_detail_view', $data);
			$this->load->view('themes/footer_view');
			$this->load->view('themes/end_view');
		}
		else
		{
			redirect(base_url());
		}
	}
}