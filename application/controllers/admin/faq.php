<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function __construct() {
		parent::__construct();		
        $this->load->Model('Faq_model');	
    }

    public function index()
    {

        $this->load->library('../controllers/admin/index');
        $this->index->checklogin();

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	    =	$session_ad['fullname'];
        $this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/faq/faq_view',$data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
    }
    
    public function add()
    {

        $this->load->library('../controllers/admin/index');
        $this->index->checklogin();

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];
        $this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/faq/add_view');
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
    }
    
    public function edit($id)
    {   

        $this->load->library('../controllers/admin/index');

        $this->index->checklogin();
        $data['faq']        =   $this->Faq_model->get($id);
       
        if(count($data['faq']) > 0) 
        {
            $session_ad 		=	$this->session->userdata('logged_ad');
            $data['fullname']	=	$session_ad['fullname'];
            $this->load->view('themes/head_view');
            $this->load->view('admin/navbar_view', $data);
            $this->load->view('admin/faq/edit_view',$data);
            $this->load->view('admin/footer_view');
            $this->load->view('themes/end_view');
        }
        else
        {
            redirect(base_url('admin'), 'location');
        }
		
    }
    
    public function lists($offset = 0)
    {
        $status =   null;
        $lang   =   null;

        if($this->input->get('lang') != NULL)
        {
            $lang           =   $this->input->get('lang');
        }

        if($this->input->get('status') != NULL)
        {
            $status           =   $this->input->get('status');
        }
        $data['status']       = $status;
        $data['lang']       = $lang;

            $this->load->library('pagination'); 
            $config['base_url'] = base_url('admin/faq/lists'); // xác định trang phân trang 
            $config['total_rows'] = $this->Faq_model->count($status, $lang); // xác định tổng số record 
            $config['per_page'] = 10; // xác định số record ở mỗi trang 
            $config['full_tag_open'] = '<div class="pagination"><ul>';
            $config['full_tag_close'] = '</ul></div><!--pagination-->';

            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            $config['uri_segment'] = 4; // xác định segment chứa page number 
        if($lang != null)
        {
            $config['suffix']  = '/?lang='.$lang;
        }

        $this->pagination->initialize($config);
        $this->load->library('../controllers/admin/index');
        $this->index->checklogin();

		$session_ad 		=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

        

        $data['faq']        =   $this->Faq_model->get(null, $status, $lang, $config['per_page'], $offset);
        $data['pagging']       =   $this->pagination->create_links();
        $datestring        =   "%Y/%m/%d %h:%i:%s";
        $data['datestring'] =   $datestring;
        $this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/faq/list_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
    }
}