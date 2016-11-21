<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller {

	public function __construct() {
		parent::__construct();				
		$this->load->Model('Project_model');	
		$this->load->Model('App_model');
        $this->load->Model('App_image_model');        
        $this->load->Model('User_app_model');
	}

	public function up()
	{        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();
		$this->index->setUrlUpFile();

		$data['arr_project']	=	$this->Project_model->getProject();
		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/upload_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function edit($id)
	{        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();
		$this->index->setUrlUpFile();

		$arr 	=	$this->App_model->getApp($id);
        foreach ($arr as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
			}
        }

		if(count($arr) > 0)
		{
			$data['arr_app']		=	$arr;
			$data['arr_project']	=	$this->Project_model->getProject();
			$session_ad 			=	$this->session->userdata('logged_ad');
			$data['fullname']	=	$session_ad['fullname'];

			$this->load->view('themes/head_view');
			$this->load->view('admin/navbar_view', $data);
			$this->load->view('admin/game/edit_view', $data);
			$this->load->view('admin/footer_view');
			$this->load->view('themes/end_view');
		}
		else
		{
			redirect(base_url("404_error.html"), "location");
		}
	}

	public function game()
	{        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		$session_ad 		=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game_view');
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function info($offset = 0)
	{        
		
        $this->load->library('pagination'); 
            $config['base_url'] = base_url('admin/application/project'); // xác định trang phân trang 
            $config['total_rows'] = $this->Project_model->count_all(); // xác định tổng số record 
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
        
        $this->pagination->initialize($config);
        
		$data['arr_project']	=	$this->Project_model->getProject(null,$config['per_page'],$offset);
		$data['total']			=	count($this->Project_model->getProject());
		$data['datestring'] 	= 	"%d/%m/%Y %h:%i";
		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	    =	$session_ad['fullname'];
        $data['pagging']        =   $this->pagination->create_links();
        
        $this->load->library('../controllers/admin/index');
		$this->index->checklogin();
        
		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/app_info_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}
    
    public function images($app_id)
    {
        $this->load->library('../controllers/admin/index');
        $this->index->checklogin();
        $arr 	        =	$this->App_model->getApp($app_id);
        foreach ($arr as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
			}
        }
        $data['app']    =   $arr;
        if(count($arr) == 0)
        {
            redirect(base_url("admin"), "location");
        }
		$session_ad 		=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];
        
        $data['app_images'] =   $this->App_image_model->get($app_id);
        
		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/app_images_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
    }
        
	public function add_project()
	{
        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		$session_ad 		=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/add_info_view');
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function edit_project($projectId)
	{
        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		$arr 	=	$this->Project_model->getProject($projectId);

		if(count($arr) > 0)
		{
			$data['arr_project']	=	$arr;
			$session_ad 			=	$this->session->userdata('logged_ad');
			$data['fullname']	    =	$session_ad['fullname'];

			$this->load->view('themes/head_view');
			$this->load->view('admin/navbar_view', $data);
			$this->load->view('admin/game/edit_info_view', $data);
			$this->load->view('admin/footer_view');
			$this->load->view('themes/end_view');
		}
		else
		{
			redirect(base_url("404_error.html"), "location");
		}
	}

	public function start($offset = 0)
	{
		$lang   =   null;
		if($this->input->get('lang') != NULL)
        {
            $lang           =   $this->input->get('lang');
        }
        $data['lang']       = $lang;

        $this->load->library('pagination'); 
            $config['base_url'] = base_url('admin/application/start'); // xác định trang phân trang 
            $config['total_rows'] = $this->App_model->count_all('1', $lang); // xác định tổng số record 
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
        
		$app 	=	$this->App_model->getApp(null, '1', null,$config['per_page'], $offset, $lang);
        $data['pagging']        =   $this->pagination->create_links();
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		foreach ($app as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
			}
		}
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['app']	=	$app;

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/start_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function stop($offset = 0)
	{
        
		$lang   =   null;
		if($this->input->get('lang') != NULL)
        {
            $lang           =   $this->input->get('lang');
        }
        $data['lang']       = $lang;

        $this->load->library('pagination'); 
            $config['base_url'] = base_url('admin/application/stop'); // xác định trang phân trang 
            $config['total_rows'] = $this->App_model->count_all('0', $lang); // xác định tổng số record 
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
        
		$app 	=	$this->App_model->getApp(null, '0', null,$config['per_page'], $offset, $lang);
        $data['pagging']        =   $this->pagination->create_links();
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		foreach ($app as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
			}
		}
		$data['datestring'] = 	"%d/%m/%Y %h:%i";
		$data['app']	=	$app;

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/stop_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

	public function users_app()
	{
        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		$session_ad 			=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];
        $data['success']    =   '';
        if(isset($_SESSION['success']))
        {
            $data['success']    =   $_SESSION['success'];
            unset($_SESSION['success']);
        }

		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/game/users_app_view',$data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}
    
	public function upfile_excel()
	{  
		$this->load->library('Excel');
		//$inputFile 	=	base_url($this->input->post('txtFile'));
		//Check valid spreadsheet has been uploaded
		if(isset($_FILES['spreadsheet'])){
			if($_FILES['spreadsheet']['name']){
			    if(!$_FILES['spreadsheet']['error'])
			    {

			        $inputFile = $_FILES['spreadsheet']['name'];
			        $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
			        if($extension == 'XLSX' || $extension == 'XLS' || $extension == 'CSV'){

			            //Read spreadsheeet workbook
			            try {
			                 $inputFile = $_FILES['spreadsheet']['tmp_name'];
			                 $inputFileType = PHPExcel_IOFactory::identify($inputFile);
			                 $objReader = PHPExcel_IOFactory::createReader($inputFileType);
			                 $objPHPExcel = $objReader->load($inputFile);
			            } catch(Exception $e) {
			                    die($e->getMessage());
			            }

			            //Get worksheet dimensions
			            $sheet = $objPHPExcel->getSheet(0); 
			            $highestRow = $sheet->getHighestRow(); 
			            $highestColumn = $sheet->getHighestColumn();
                        //Transection
                        $this->db->trans_start(); 
			            //Loop through each row of the worksheet in turn
			            for ($row = 2; $row <= $highestRow; $row++){ 
			                    //  Read a row of data into an array
			                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
			                    //Insert into database
                                //echo $rowData[0][0].'<br />...'.$rowData[0][1].'<br />.....'.$rowData[0][2].'<br />';
                                if($rowData[0][0] != null && $rowData[0][1] != null)
                                {
                                	$array   =  array(
                                                'appId'         =>  $rowData[0][0],
                                                'userId'        =>  $rowData[0][1],
                                                'link'          =>  $rowData[0][2],
                                                'keymod'        =>  $rowData[0][3],
                                                'admobUser'     =>  $rowData[0][4],
                                                'admobAdmin'    =>  $rowData[0][5],
                                                'smsNumber'     =>  $rowData[0][6],
                                                'smsContent'    =>  $rowData[0][7]
                                	);
                                	$this->User_app_model->actions($array);
                                }
			            }			
                        $this->db->trans_complete();
                        $_SESSION['success']    =   'Các thông tin của ứng dụng đã cập nhật thành công';
                        redirect(base_url('admin/application/users_app.html'));
			        }
			        else{
			            echo "Please upload an XLSX or XLS file";
			        }
			    }
			    else{
			        echo $_FILES['spreadsheet']['error'];
			    }
			}
		}

	}
}