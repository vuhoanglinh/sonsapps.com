<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	

	public function __construct() {
		parent::__construct();
		$this->load->Model('User_model');        
        $this->load->Model('User_app_model'); 
        $this->load->Model('Project_model');
		$this->load->Model('App_model');
	}
    
    public function updateBlock()
    {
        $status     =   $this->input->post('status');
        $id         =   $this->input->post('id');
        $array      =   array(
                                'block'        =>      $status
                            );
        $this->User_model->update($id, $array);
        echo json_encode(array('status' =>  $status, 'info' => 1));
    }

    public function updateLevel()
    {
        $level     =   $this->input->post('status');
        $id         =   $this->input->post('id');
        $array      =   array(
                                'level'        =>      $level
                            );
        $this->User_model->update($id, $array);
        echo json_encode(array('status' =>  $level, 'info' => 1));
    }

    public function updateActive()
    {
        $active     =   $this->input->post('status');
        $id         =   $this->input->post('id');
        $array      =   array(
                                'active'        =>      $active
                            );
        $this->User_model->update($id, $array);
        echo json_encode(array('status' =>  $active, 'info' => 1));
    }

    public function deleteUser()
    {
        $bool       =   "0";
        $id         =   $this->input->post('id');
        $array      =   array(
                                'delete'        =>      '1'
                            );
        if($this->User_model->update($id, $array))
        {
            $bool   =   "1";
        }
        echo $bool;
    }

	public function users($offset = 0)
	{        
        $this->load->library('pagination'); 
            $config['base_url'] = base_url('admin/users'); // xác định trang phân trang 
            $config['total_rows'] = $this->User_model->count_all(); // xác định tổng số record 
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
            $config['uri_segment'] = 3; // xác định segment chứa page number 
        
        
		$this->load->library('../controllers/admin/index');
		$this->index->checklogin();

		$session_ad 		=	$this->session->userdata('logged_ad');
		$data['fullname']	=	$session_ad['fullname'];
        $app_user           =   null;
        $app                =   '';
        if($this->input->get('app'))
        {
            $config['suffix']  = '/?app='.$this->input->get('app');
            
            $app_user       =   $this->User_app_model->get($this->input->get('app'));
            $app            =   $this->input->get('app');
        }

        //Key search
        $key    =   NULL;
        if($this->input->get('key') != NULL)
        {
            $config['suffix']   =    '/?key='.$this->input->get('key');
            
            $key                =    $this->input->get('key');
        }

        //Type active or non active
        $type   =   NULL;
        if($this->input->get('active') != NULL)
        {
            if($key != NULL)
            {
                $config['suffix']   .=    '/?key='.$this->input->get('key').'&active='.$this->input->get('active');
            }
            else
            {
                $config['suffix']   =    '/?active='.$this->input->get('active');
            }
            
            $type                =    $this->input->get('active');
        }

        $data['app']        =   $app;
        $data['key']        =   $key;
        $data['type']       =   $type;
		$data['user']		=	$this->User_model->getUser($app_user, $config['per_page'], $offset, $key, $type);
		$data['count_user']	=	count($data['user']);
        
        $config['total_rows'] = $this->User_model->count_all($app_user,$key, $type); // xác định tổng số record 
        $this->pagination->initialize($config);
        $data['pagging']        =   $this->pagination->create_links();


        /*
        $arr_app    =   $this->App_model->getApp();
        foreach ($arr_app as $row) {
            # code...
            $project    =   $this->Project_model->getProject($row->projectId);
            foreach ($project as $value) {
                # code...
                $row->projectName   =   $value->Name;
                $row->alias         =   $value->alias;
            }
        }*/

        $arr_project        =   $this->Project_model->getProject();
        
        $data['arr_app']    =   $arr_project;
        
		$this->load->view('themes/head_view');
		$this->load->view('admin/navbar_view', $data);
		$this->load->view('admin/users/users_view', $data);
		$this->load->view('admin/footer_view');
		$this->load->view('themes/end_view');
	}

    public function getSelectApp()
    {
        if($this->input->get('projectId') != null)
        {
            $projectId  =   $this->input->get('projectId');
            $query      =   $this->App_model->getAppByProject($projectId);
            foreach ($query as $row) {
                echo '<option value="'.$row->id.'">AppID: '.$row->id.'. Package: '.$row->packageName.'</option>';
            }
        }
    }
    
    public function upapp()
    {
        $status =   "";
        $msg    =   "";
        $appid  =   $this->input->post('slApp');
        $userid =   $this->input->post('username');
        $link   =   $this->input->post('txtLink');
        $keymod =   $this->input->post('txtKeyMod');
        $admobuser  =   $this->input->post('txtAbmodUser');
        $admobadmin =   $this->input->post('txtAbmodAdmin');
        $smsNumber  =   $this->input->post('txtSmsNumber');
        $smsContent =   $this->input->post('txtSmsContent');

        //Transection
        $this->db->trans_start(); 
        $array   =  array(
                                                'appId'         =>  $appid,
                                                'userId'        =>  $userid,
                                                'link'          =>  $link,
                                                'keymod'        =>  $keymod,
                                                'admobUser'     =>  $admobuser,
                                                'admobAdmin'    =>  $admobadmin,
                                                'smsNumber'     =>  $smsNumber,
                                                'smsContent'    =>  $smsContent
                                );
        $this->User_app_model->actions($array);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            $status =   "0";
            $msg    =   "Lỗi trong quá trình thao tác dữ liệu, hãy thử lại.";
        }
        else
        {
            $status =   "1";
            $msg    =   "Thông tin app đã được cập nhật thành công";
        }

        echo json_encode(array('status' =>  $status, 'msg'  =>  $msg));
    }

    public function export($type)
    {
        $key    =   NULL;
        if($this->input->get('key') != NULL)
        {
            $key    =   $this->input->get('key');
        }
        $this->load->library('../controllers/admin/index');
        $this->index->checklogin();
        $this->load->library('Excel');
        $filename   =   'thanhvien.xls';
        $app_user           =   null;
        if($this->input->get('app'))
        {
            $app_user       =  $this->User_app_model->get($this->input->get('app'), NULL, NULL, $key);
            $app            =   $this->input->get('app');
        }
		$users	=	$this->User_model->getUser($app_user);
        
        $objPHPExcel = new PHPExcel(); 
        $count      =   2;
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        foreach ($users as $user) 
        { 
            $objPHPExcel->setActiveSheetIndex(0) 
                    ->setCellValue('A'.$count, $user->id) 
                    ->setCellValue('B'.$count, $user->username); 
            $count++;
        } 
        $objPHPExcel->setActiveSheetIndex(0) 
                    ->setCellValue('A1', 'ID'); 
        
        $objPHPExcel->setActiveSheetIndex(0) 
                    ->setCellValue('E1', 'Created by linh_vh. Team: TL Solution.'); 


        // Rename sheet 
        $objPHPExcel->getActiveSheet()->setTitle('Danh sach thanh vien'); 
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet 
        $objPHPExcel->setActiveSheetIndex(0); 
        
        
        switch($type)
        {
            case 'excel' : 
                    $type = 'Excel5';
                    $filename   =   'thanhvien.xls';                      
                    $objPHPExcel->setActiveSheetIndex(0) 
                    ->setCellValue('B1', 'Tài khoản thành viên'); 
                    header('Content-Type: application/vnd.ms-excel');                    
                    break;
            case 'csv'   : 
                    $type = 'CSV';
                    $filename   =   'thanhvien.csv';    
                    $objPHPExcel->setActiveSheetIndex(0) 
                    ->setCellValue('B1', 'Tai khoan thanh vien'); 
                    header( 'Content-Type: application/csv' );
                    break;            
        }
                
        
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0'); 

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $type); 
        $objWriter->save('php://output'); 
        exit;        
    }
}
