<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_event extends CI_Controller {

	public function __construct() {
		parent::__construct();		
        $this->load->Model('Events_model');
	}

	public function updatestatus()
    {
        $status     =   $this->input->post('status');
        $id         =   $this->input->post('id');
        $array      =   array(
                                'status'        =>      $status
                            );
        $this->Events_model->update($id, $array);
        echo json_encode(array('status' =>  $status, 'info' => 1));
    }

    public function delete()
    {
        $id         =   $this->input->post('id');        
        if($this->Events_model->delete($id))
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

	public function add()
	{
		$this->load->library('form_validation');
        $msg        =   '';
        $status     =   '';
        
        $this->form_validation->set_rules('txtTitle', 'Title', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtAlias', 'Alias', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtContent', 'Content', 'xss_clean');
        $this->form_validation->set_rules('txtTime', 'Time', 'max_length[255]|xss_clean');
        
        if($this->form_validation->run() === FALSE)
        {
            $msg    =   'Thông tin nhập vào không hợp lệ';
            $status =   '0';
        }
        else
        {
            $title   =   trim($this->input->post('txtTitle'));
            
            if($this->Events_model->getTitle($title) === FALSE)
            {
                $datestring         =   "%Y/%m/%d %h:%i:%s";
				$date_added			=	mdate($datestring, time() - 60*60);
	        	$last_modified      =   mdate($datestring, time() - 60*60);
                
                $alias  	=   trim($this->input->post('txtAlias'));
                $content 	=   $this->input->post('txtContent');
                $status 	=   $this->input->post('rdstatus');
                $lang   	=   $this->input->post('slLang');
                $time 		=	$this->input->post('txtTime');
                
                
                $arr    =   array(
                                'title'  		=>  $title,
                                'alias'     	=>  $alias,
                                'content'    	=>  $content,
                                'status'    	=>  $status,
                                'lang'      	=>  $lang,
                                'time'			=>	$time,
                                'create_at' 	=>  $date_added,
                                'update_at' 	=>  $last_modified
                            );
                $msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
				$status =	'0';
                
                if($this->Events_model->insert($arr))
                {
                    $msg 	=	"Sự kiện đã thêm thành công";
				    $status =	'2';
                }                
            }
            else
            {
                $msg    =   'Tiêu đề đã tồn tại';
                $status =   '1';
            }
        }
        
        echo json_encode(array('msg' => $msg, 'status' => $status));
	}

	public function edit()
	{
		$this->load->library('form_validation');
        $msg        =   '';
        $status     =   '';
        $bLag   	=   TRUE;
        $id         =   $this->input->post('id');
        $oldtitle=   $this->input->post('oldtitle');
        $title   =   $this->input->post('txtTitle');
        
        $this->form_validation->set_rules('txtTitle', 'Title', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtAlias', 'Alias', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtContent', 'Content', 'xss_clean');
        $this->form_validation->set_rules('txtTime', 'Time', 'max_length[255]|xss_clean');
        
        if($this->form_validation->run() === FALSE)
        {
            $msg    =   'Thông tin nhập vào không hợp lệ';
            $status =   '0';
        }
        else
        {
            if($oldtitle != $title)
            {
                if($this->Events_model->getTitle($title))
                {          
                    $msg        =   'Tiêu đề đã tồn tại';
                    $status     =   '1';
                    $bLag       =   FALSE;
                }
            }
            
            if($bLag)
            {
                $datestring         =   "%Y/%m/%d %h:%i:%s";
	        	$last_modified      =   mdate($datestring, time() - 60*60);
                
                $alias  	=   trim($this->input->post('txtAlias'));
                $content 	=   $this->input->post('txtContent');
                $status 	=   $this->input->post('rdstatus');
                $lang   	=   $this->input->post('slLang');
                $time 		=	$this->input->post('txtTime');
                
                $arr    =   array(
                                'title'  		=>  $title,
                                'alias'     	=>  $alias,
                                'content'    	=>  $content,
                                'status'    	=>  $status,
                                'lang'      	=>  $lang,
                                'time'			=>	$time,
                                'update_at' 	=>  $last_modified
                            );
                $msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
				$status =	'0';
                
                if($this->Events_model->update($id, $arr))
                {
                    $msg 	=	"Sự kiện đã cập nhật thành công";
				    $status =	'2';
                }      
            }
        }
        
        echo json_encode(array('msg' => $msg, 'status' => $status));
	}
}