<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_faq extends CI_Controller {

	public function __construct() {
		parent::__construct();		
        $this->load->Model('Faq_model');
	}

    public function updateSTT()
    {

        $stt        =   ($this->input->post('status') % 1 == 0) ? $this->input->post('status') : 0;
        $id         =   $this->input->post('id');
        $array      =   array(
                                'index'     =>      $stt
                            );
        $this->Faq_model->update($id, $array);
        echo json_encode(array('status' =>  $stt, 'info' => 1));
    }
    public function updatestatus()
    {
        $status     =   $this->input->post('status');
        $id         =   $this->input->post('id');
        $array      =   array(
                                'status'        =>      $status
                            );
        $this->Faq_model->update($id, $array);
        echo json_encode(array('status' =>  $status, 'info' => 1));
    }

    public function delete()
    {
        $id         =   $this->input->post('id');        
        if($this->Faq_model->delete($id))
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
        
        $this->form_validation->set_rules('txtQuestion', 'Question', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtAlias', 'Alias', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtAnwser', 'Anwser', 'xss_clean');
        
        if($this->form_validation->run() === FALSE)
        {
            $msg    =   'Thông tin nhập vào không hợp lệ';
            $status =   '0';
        }
        else
        {
            $question   =   trim($this->input->post('txtQuestion'));
            
            if($this->Faq_model->getQuestion($question) === FALSE)
            {
                $datestring         =   "%Y/%m/%d %h:%i:%s";
				$date_added			=	mdate($datestring, time() - 60*60);
	        	$last_modified      =   mdate($datestring, time() - 60*60);
                
                $alias  =   trim($this->input->post('txtAlias'));
                $type   =   $this->input->post('slType');
                $stt    =   trim($this->input->post('txtNumber'));
                $answer =   $this->input->post('txtAnswer');
                $status =   $this->input->post('rdstatus');
                $lang   =   $this->input->post('slLang');
                
                
                $arr    =   array(
                                'question'  =>  $question,
                                'alias'     =>  $alias,
                                'type'      =>  $type,
                                'answer'    =>  $answer,
                                'index'     =>  $stt,
                                'status'    =>  $status,
                                'lang'      =>  $lang,
                                'create_at' =>  $date_added,
                                'update_at' =>  $last_modified
                            );
                $msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
				$status =	'0';
                
                if($this->Faq_model->insert($arr))
                {
                    $msg 	=	"Câu hỏi đã thêm thành công";
				    $status =	'2';
                }                
            }
            else
            {
                $msg    =   'Câu hỏi đã tồn tại';
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
        $bLag   =   TRUE;
        $id         =   $this->input->post('id');
        $oldquestion=   $this->input->post('oldquestion');
        $question   =   $this->input->post('txtQuestion');
        
        $this->form_validation->set_rules('txtQuestion', 'Question', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtAlias', 'Alias', 'required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('txtAnwser', 'Anwser', 'xss_clean');
        
        if($this->form_validation->run() === FALSE)
        {
            $msg    =   'Thông tin nhập vào không hợp lệ';
            $status =   '0';
        }
        else
        {
            if($oldquestion != $question)
            {
                if($this->Faq_model->getQuestion($question))
                {          
                    $msg        =   'Câu hỏi đã tồn tại';
                    $status     =   '1';
                    $bLag       =   FALSE;
                }
            }
            
            if($bLag)
            {
                $datestring         =   "%Y/%m/%d %h:%i:%s";
	        	$last_modified      =   mdate($datestring, time() - 60*60);
                
                $alias  =   trim($this->input->post('txtAlias'));
                $type   =   $this->input->post('slType');
                $stt    =   trim($this->input->post('txtNumber'));
                $answer =   $this->input->post('txtAnswer');
                $status =   $this->input->post('rdstatus');
                $lang   =   $this->input->post('slLang');
                
                $arr    =   array(
                                'question'  =>  $question,
                                'alias'     =>  $alias,
                                'type'      =>  $type,
                                'answer'    =>  $answer,
                                'index'     =>  $stt,
                                'status'    =>  $status,
                                'lang'      =>  $lang,
                                'update_at' =>  $last_modified
                            );
                $msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
				$status =	'0';
                
                if($this->Faq_model->update($id, $arr))
                {
                    $msg 	=	"Câu hỏi đã cập nhật thành công";
				    $status =	'2';
                }      
            }
        }
        
        echo json_encode(array('msg' => $msg, 'status' => $status));
        
    }
}
