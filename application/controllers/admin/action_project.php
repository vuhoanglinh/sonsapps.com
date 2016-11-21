<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_project extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->Model('Project_model');
		$this->load->Model('App_model');
        $this->load->Model('App_image_model');
	}

	public function checkname()
	{
		$bool 			=   0;
		$name_project 	=	$this->input->post('name');
		if($this->Project_model->checkname($name_project))
		{
			$bool 		=	1;
		}
		echo $bool;
	}

	

	public function updateLocked()
	{
		$locked 	=	$this->input->post('status');
		$id 		=	$this->input->post('id');
		$array  	=	array(
								'locked'		=>		$locked
							);
		$this->Project_model->update($id, $array);
		echo json_encode(array('status'	=>	$locked, 'info' => 1));
	}

	public function updateAdMod()
	{
		$activeAdmob 	=	$this->input->post('status');
		$id 		    =	$this->input->post('id');
		$array  	    =	array(
								'activeAdmob'		=>		$activeAdmob
							);
		$this->Project_model->update($id, $array);
		echo json_encode(array('status'	=>	$activeAdmob, 'info' => 1));
	}

	public function deleteProject()
    {
        $bool       =   "0";
        $id         =   $this->input->post('id');
        $array      =   array(
                                'delete'        =>      '1'
                            );
        if($this->Project_model->update($id, $array))
        {
            $bool   =   "1";
        }
        echo $bool;
    }

    public function deleteApp()
    {
        $bool       =   "0";
        $id         =   $this->input->post('id');
        $array      =   array(
                                'delete'        =>      '1'
                            );
        if($this->App_model->update($id, $array))
        {
            $bool   =   "1";
        }
        echo $bool;
    }

	public function up_project()
	{
		$this->load->library('form_validation');
		$name_project 	=	trim($this->input->post('txtName'));
        $alias          =   trim($this->input->post('txtAlias'));

		$this->form_validation->set_rules('txtName', 'txtName', 'required|xss_clean');
        $this->form_validation->set_rules('txtAlias', 'Alias', 'xss_clean');
		$msg 	=	'';
		$status = 	'';
		//Kiểm tra validation hợp lệ
		if($this->form_validation->run() == FALSE) {
			$msg 	=	'Tên project không hợp lệ';
			$status = 	'0';
		}
		else
		{
			if( $this->Project_model->checkname($name_project))
			{
				$msg 	=	'Tên project đã tồn tại';
				$status = 	'0';
			}
			else
			{

				$datestring         =   "%Y/%m/%d %h:%i:%s";
				$date_added			=	mdate($datestring, time() - 60*60);
	        	$last_modified      =   mdate($datestring, time() - 60*60);

				$arr 	=	array(
								'Name' 			=> $name_project,
                                'alias'         => $alias,
								'created_at' 	=> $date_added,
								'updated_at'	=> $last_modified);

				$msg 	=	"Project đã thêm thành công";
				$status =	'1';
				if($this->Project_model->insert($arr) === FALSE)
				{
					$msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
					$status =	'0';
				}
			}
		}

		echo json_encode(array('msg' => $msg, 'status' => $status, 'name' => $name_project));

	}

	public function edit_project()
	{
        $bLag   =   TRUE;
		$this->load->library('form_validation');        
		$this->form_validation->set_rules('txtName', 'Project Name', 'required|xss_clean');
        $this->form_validation->set_rules('txtAlias', 'Alias', 'required|xss_clean');
        
        $alias              =   trim($this->input->post('txtAlias'));
		$projectId			=	$this->input->post('projectId');
		$projectName		=	trim($this->input->post('txtName'));
		$oldprojectName 	=	trim($this->input->post('projectName'));
		$msg 	=	'';
		$status = 	'';
		//Kiểm tra validation hợp lệ
		if($this->form_validation->run() == FALSE) {
			$msg 	=	'Tên project không hợp lệ';
			$status = 	'0';
		}
		else
		{
			if($oldprojectName != $projectName)
			{
                if($this->Project_model->checkname($projectName))
                {                       
                    $msg 	=	'Tên project đã tồn tại';
                    $status = 	'0';
                    $bLag   =   FALSE;
                }
			}
            
            if($bLag)
			{
				$datestring         =   "%Y/%m/%d %h:%i:%s";
	        	$last_modified      =   mdate($datestring, time() - 60*60);

	        	$locked 			=	$this->input->post('rdlocked');
	        	$activeAdmob 		=	$this->input->post('rdAdmod');

	        	$arr 	=	array(
								'Name' 			=> $projectName,
                                'alias'         => $alias,
								'locked'		=> $locked,
								'activeAdmob'	=> $activeAdmob,
								'updated_at'	=> $last_modified);

				$msg 	=	"Project đã cập nhật thành công";
				$status =	'1';
				if($this->Project_model->update($projectId, $arr) === FALSE)
				{
					$msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
					$status =	'0';
				}
			}
		}
		echo json_encode(array('msg' => $msg, 'status' => $status));
	}

	public function up_app()
	{
		$this->load->library('form_validation');
		$package_name 	=	$this->input->post('txtId');

		$this->form_validation->set_rules('txtId', 'Package Name', 'required|xss_clean');
		$this->form_validation->set_rules('txtFolder', 'Folder', 'required|xss_clean');
		$this->form_validation->set_rules('txtLink', 'Folder', 'xss_clean');
		$this->form_validation->set_rules('txtImage', 'Logo', 'xss_clean');
		$this->form_validation->set_rules('txtForms', 'Forms', 'xss_clean');
		$this->form_validation->set_rules('txtShortDescription', 'Short Description', 'xss_clean');
		$this->form_validation->set_rules('txtDescription', 'Description', 'xss_clean');

		$msg 	=	'';
		$status = 	'';

	    $folder 		=	trim($this->input->post('txtFolder'));

		$path 			= 	"appson/".$folder;

		//Kiểm tra validation hợp lệ
		if($this->form_validation->run() == FALSE) {
			$msg 	=	'Dữ liệu nhập vào chưa hợp lệ';
			$status = 	'0';
		}
		else if(is_dir($path))
		{
			$msg 	=	'Thư mục chứa ứng dụng đã tồn tại.';
			$status = 	'2';
		}
		else
		{
			if($this->App_model->checkId($package_name))
			{
				$msg 	=	'Package name đã tồn tại';
				$status = 	'0';
			}
			else
			{
				mkdir($path,0755,TRUE);
				$datestring         =   "%Y/%m/%d %h:%i:%s";
				$date_added			=	mdate($datestring, time() - 60*60);
	        	$last_modified      =   mdate($datestring, time() - 60*60);


				$projectId			=	$this->input->post('slProject');
				$link 				=	trim($this->input->post('txtLink'));
				$logo 				=	trim($this->input->post('txtImage'));
				$forms 				=	trim($this->input->post('txtForms'));
				$status 			=	$this->input->post('rdstatus');
				$lang 				=	$this->input->post('slLang');
				$shortdescription 	=	trim($this->input->post('txtShortDescription'));
				$description 		=	trim($this->input->post('txtDescription'));

				$arr 		=	array(
									'packageName' 		=>		$package_name,
									'projectId'			=>		$projectId,
									'folder'			=>		$folder,
									'linkAppModel'		=>		$link,
									'logo'				=>		$logo,
									'forms'				=>		$forms,
									'status'			=>		$status,
									'short_description'	=>		$shortdescription,
									'description'		=>		$description,
									'language'			=>		$lang,
									'created_at'		=>		$date_added,
									'updated_at'		=>		$last_modified
								);


				$msg 	=	"App đã thêm thành công";
				$status =	'1';

				if($this->App_model->insert($arr) === FALSE)
				{
					$msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
					$status =	'0';
				}
			}
		}

		echo json_encode(array('msg' => $msg, 'status' => $status));
	}

	public function edit_app()
	{
        $bFlag = TRUE;
		$this->load->library('form_validation');
		$package_name 	=	$this->input->post('txtId');
		$oldpackage 	=	$this->input->post('oldpackage');

		$this->form_validation->set_rules('txtId', 'Package Name', 'required|xss_clean');
		$this->form_validation->set_rules('txtImage', 'Logo', 'xss_clean');
		$this->form_validation->set_rules('txtForms', 'Forms', 'txss_clean');
		$this->form_validation->set_rules('txtShortDescription', 'Short Description', 'xss_clean');
		$this->form_validation->set_rules('txtDescription', 'Description', 'xss_clean');

		$msg 	=	'';
		$status = 	'';

		$folder 		=	trim($this->input->post('txtFolder'));
		$oldfolder 		=	$this->input->post('oldfolder');
		$path 			= 	"appson/".$folder;
		//Kiểm tra validation hợp lệ
		if($this->form_validation->run() == FALSE) {
			$msg 	=	'Package name không hợp lệ';
			$status = 	'0';
		}
		else
		{

			if ($oldfolder != $folder) {
				if(is_dir($path))
				{
					$bFlag  = FALSE;
					$msg 	=	'Thư mục chứa ứng dụng đã tồn tại.';
					$status = 	'2';
				}
				else
				{
					mkdir($path,0755,TRUE);
				}
			}

			if($oldpackage != $package_name)
			{
                if($this->App_model->checkId($package_name))
                {                    
                    $msg 	=	'Package name đã tồn tại';
                    $status = 	'0';
                    $bFlag  = FALSE;
                }
			}
			
            if($bFlag)
			{
				$datestring         =   "%Y/%m/%d %h:%i:%s";
				$date_added			=	mdate($datestring, time() - 60*60);
	        	$last_modified      =   mdate($datestring, time() - 60*60);

				$projectId	=	$this->input->post('slProject');
				$link 		=	trim($this->input->post('txtLink'));
				$logo 		=	trim($this->input->post('txtImage'));
				$forms 		=	trim($this->input->post('txtForms'));
				$status 	=	$this->input->post('rdstatus');
				$lang 		=	$this->input->post('slLang');
				$shortdescription 	=	trim($this->input->post('txtShortDescription'));
				$description=	$this->input->post('txtDescription');
				$id 		=	$this->input->post('id');
				$arr 		=	array(
									'packageName' 	=>		$package_name,
									'projectId'		=>		$projectId,
									'folder'		=>		$folder,
									'logo'			=>		$logo,
									'forms'			=>		$forms,
									'status'		=>		$status,
									'short_description'	=>		$shortdescription,
									'description'	=>		$description,
									'language'		=>		$lang,
									'created_at'	=>		$date_added,
									'updated_at'	=>		$last_modified
								);


				$msg 	=	"App cập nhật thành công";
				$status =	'1';
				if($this->App_model->update($id, $arr) === FALSE)
				{
					$msg 	=	"Lỗi trong quá trình thao tác dữ liệu, dữ liệu không thể cập nhật vào database";
					$status =	'0';
				}
			}
		}

		echo json_encode(array('msg' => $msg, 'status' => $status));
	}
    
    public function edit_app_image()
    {
        $bflag = '0';
        $message    =   '';
        $action     =   $this->input->post('hd_action');
        $imageId    =   $this->input->post('hd_imageId');
        $appId      =   $this->input->post('hd_appId');
        $link       =   $this->input->post('txtImage');
        $array      =   array(
                            'appId'  =>  $appId,
                            'link'    =>  $link,                            
                        );
        if($action  ==  'insert')
        {
            if($this->App_image_model->insert($array))
            {
                $bflag      =   '1';
                $message    =   'Thêm hình thành công';
            }
            else
            {
                $message    =   'Thêm hình ảnh thất bại';
            }
        }
        else
        {
            if($imageId != 0)
            {
                if($this->App_image_model->update($imageId,$array))
                {
                    $bflag      =   '1';
                    $message    =   'Cập nhật hình thành công';
                }
                else
                {
                    $message    =   'Cập nhật hình ảnh thất bại';
                }
            }  
            else
            {
                $message    =   'Thao tác cập nhật không hợp lệ';
            }
        }
        
        echo json_encode(array('status' =>  $bflag, 'msg'   =>  $message));
    }
    
    public function delete_app_image()
    {
        $bflag =    '0';
        $id    =    $this->input->post('id');
        
        if($this->App_image_model->delete($id))
        {
            $bflag  =   '1';
        }
        
        echo $bflag;
    }
}
