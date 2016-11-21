<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public $_lang    =   'vi';
    public $_login   =   FALSE;
	public function __construct() {
		parent::__construct();
		$this->load->Model('Project_model');
		$this->load->Model('User_model');
		$this->load->Model('App_model');
        $this->load->Model('App_image_model');
        $this->load->Model('User_app_model');
        $this->load->Model('App_user_statistic_model');
        $this->load->Model('Logs_model');
        
        if($this->input->cookie('lang'))
        {
            if($this->input->cookie('lang') == 'vi' || $this->input->cookie('lang') == 'en' || $this->input->cookie('lang') == 'in' || $this->input->cookie('lang') == 'po' || $this->input->cookie('lang') == 'cn') {                
                $this->_lang    =   $this->input->cookie('lang');
            }
        }
        
		//Thiết lập ngôn ngữ cho hệ thống
		$this->setLang($this->_lang);             
		$this->load->library('../controllers/action/account');        
        $this->_login   =   $this->checklogin();   
        
	}

	public function index()
	{
		$username 	=	'';
		if($this->_login)
		{
			$session_data 		=	$this->session->userdata('logged');
			$username 			=	$session_data['fullname'];
		}
		$data['username']		=	$username;

		$this->load->view('themes/head_view');
		$this->load->view('themes/navbar_view', $data);
		$this->load->view('themes/home_view');
		$this->load->view('themes/footer_view');
		$this->load->view('themes/end_view');
	}

	public function checklogin()
	{
		$bool 	=	FALSE;
		if($this->session->userdata('logged_ad'))
		{
			$session_data 		=	$this->session->userdata('logged_ad');
			$userid 			=	$session_data['userid'];
			$fullname 			=	$session_data['fullname'];
			$username 			=	$session_data['username'];
			$password			=	$session_data['password'];
			$this->account->setLogin($userid, $fullname, $username, $password);
            $bool 	= 	TRUE;
		}
        
		if($this->input->cookie('username'))
        {
            $userid 			=	$this->input->cookie('userid');
            $fullname 			=	$this->input->cookie('fullname');
			$username 			=	$this->input->cookie('username');
			$password			=	$this->input->cookie('password');
            $this->account->setLogin($userid, $fullname, $username, $password);
            $bool 	= 	TRUE;
        }
        
		if($this->session->userdata('logged'))
		{
			$bool 	= 	TRUE;
		}
        
		return $bool;
	}

	public function login()
	{
		$username 	=	'';
		if($this->_login === FALSE)
		{			
			$data['msg'] 			=	"";
			if(isset($_SESSION['reg_success']))
			{
				$data['msg'] 	=	$this->lang->line('reg_success');
				unset($_SESSION['reg_success']);
			}
			$data['username']		=	$username;

			$this->load->view('themes/head_view');
			$this->load->view('themes/navbar_view', $data);
			$this->load->view('themes/login_view');
			$this->load->view('themes/footer_view');
			$this->load->view('themes/end_view');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function register()
	{
		$username 	=	'';
		if($this->_login === FALSE)
		{
			$data['username']		=	$username;
            
            $this->load->helper('Capcha');
            
            $_SESSION['captcha'] = simple_php_captcha();                                      
            $data['img_capcha']    =    $_SESSION['captcha']['image_src'];
            $data['code']          =    $_SESSION['captcha']['code'];
			$this->load->view('themes/head_view');
			$this->load->view('themes/navbar_view', $data);
			$this->load->view('themes/register_view');
			$this->load->view('themes/footer_view');
			$this->load->view('themes/end_view');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function forgot_password()
	{
		$username 	=	'';
		if($this->_login === FALSE)
		{
			//Thiết lập ngôn ngữ cho hệ thống
			$this->setLang();
			$data['username']		=	$username;

			$this->load->view('themes/head_view');
			$this->load->view('themes/navbar_view', $data);
			$this->load->view('themes/forgot_password_view');
			$this->load->view('themes/footer_view');
			$this->load->view('themes/end_view');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function application()
	{
		$username 	=	'';
		$user 		=	'';
		if($this->_login)
		{
			$session_data 		=	$this->session->userdata('logged');
			$username 			=	$session_data['fullname'];
            $user               =   $session_data['userid'];

		}
        else
        {
            redirect(base_url('login.html'));
        }
        
        $language   =   'vietnamese';
        
        switch($this->_lang)
        {
            case 'vi': $language   =   'vietnamese';break;
            case 'en': $language   =   'english';break;
            case 'in': $language   =   'indonesia';break;
            case 'po': $language   =   'portugal';break;
            case 'cn': $language   =   'china';break;
            default: $language   =   'vietnamese';break;
        }
        
        
        $app_user=  $this->User_app_model->get(null, $user);
		$app 	=	$this->App_model->getApp(null, '1', $app_user, null, null, $language);
		$count 	=	0;
		foreach ($app as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
                $row->alias 	    =	$value->alias;
			}

			$class 	=	'';
			if($count % 2 == 0)
			{
				$class 		=	'no_margin_left';
			}
			$row->class 	=	$class;
			$count++;
		}

		$count 	=	0;
		$app_d 	=	$this->App_model->getApp(null, '0', $app_user, null, null, $language);

		foreach ($app_d as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
			}

			$class 	=	'';
			if($count % 2 == 0)
			{
				$class 		=	'no_margin_left';
			}
			$row->class 	=	$class;
			$count++;
		}

		//Get app user not use
		$app_not 	=	$this->App_model->getAppNotUser($app_user, null, $language);
		foreach ($app_not as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
				$row->alias 		=	$value->alias;
			}

		}

		$data['app_enable']		=	$app;
		$data['app_disable']	=	$app_d;
		$data['app_not_use']	=	$app_not;
		$data['username']		=	$username;

		$this->load->view('themes/head_view');
		$this->load->view('themes/navbar_view', $data);
		$this->load->view('themes/application_view', $data);
		$this->load->view('themes/footer_view');
		$this->load->view('themes/end_view');
	}
    
    public function detail($app_id)
    {
        $username 	=	'';
        $data['user'] = null;
		if($this->_login)
		{
			$session_data 		=	$this->session->userdata('logged');
			$username 			=	$session_data['fullname'];
            $data['user']       =   $session_data['userid'];

		}
        else
        {
            redirect(base_url('login.html'));
        }
        
        $language   =   'vietnamese';
        
        switch($this->_lang)
        {
            case 'vi': $language   =   'vietnamese';break;
            case 'en': $language   =   'english';break;
            case 'in': $language   =   'indonesia';break;
            case 'po': $language   =   'portugal';break;
            case 'cn': $language   =   'china';break;
            default: $language     =   'vietnamese';break;
        }
        
		$app 	                =	$this->App_model->getApp($app_id, '1', null, null, null, $language);	
        if(count($app) == 0)
        {
            redirect(base_url(), 'location');
        }
        
        $app_user               =   $this->User_app_model->get($app_id, $data['user']);
        $data['keymod']         =   '';
        foreach($app_user as $row)
        {
            $data['keymod']     =   $row->keymod;
        }
        
        foreach ($app as $row) {
			# code...
			$project 	=	$this->Project_model->getProject($row->projectId);
			foreach ($project as $value) {
				# code...
				$row->projectName 	=	$value->Name;
                $row->alias 	    =	$value->alias;
			}
        }
        $data['app_images']     =   $this->App_image_model->get($app_id);
        
        $data['app']            =   $app;
		$data['username']		=	$username;

		$this->load->view('themes/head_view');
		$this->load->view('themes/navbar_view', $data);
		$this->load->view('themes/application_detail_view', $data);
		$this->load->view('themes/footer_view');
		$this->load->view('themes/end_view');    
    }
    
    public function downloadspe($appId, $userId, $date_added)
    {
        $this->load->helper('download');
    	
    	$app = $this->App_model->getApp($appId);
    	foreach ($app as $row) {
    		if($row->linkAppModel != "")
    		{
    			$data 		= 	file_get_contents($row->linkAppModel); // Read the file's contents
                $filename	=	pathinfo($row->linkAppModel, PATHINFO_FILENAME);
       			$ext 		= 	pathinfo($row->linkAppModel, PATHINFO_EXTENSION);
            	$name 		= 	$filename.'.'.$ext;
                $arr = array(
                        'appId'     =>      $appId,
                        'userId'    =>      $userId,
                        'create_at' =>      $date_added
                );
				if(file_get_contents($row->linkAppModel,0,NULL,0,1)) {
    			
                	if($this->App_user_statistic_model->down($arr))
	                {
	                    force_download($name, $data); 
        				
	                }  
	            }
    		}
    	}
    	exit;
    }

    public function download($alias, $appId, $userId)
    {        
        $datestring         =   "%Y/%m/%d";
        $date_added			=	mdate($datestring, time() - 60*60);
        if($userId == 1)
        {
        	$this->downloadspe($appId, $userId, $date_added);
        }
        else {
        	$query              =   $this->User_app_model->get($appId, $userId);

        	if(count($query) > 0)
	        {            
	            $this->load->helper('download');
	            
	            foreach($query as $row)
	            {
	                $data 		= 	file_get_contents($row->link); // Read the file's contents
	                $filename	=	pathinfo($row->link, PATHINFO_FILENAME);
	       			$ext 		= 	pathinfo($row->link, PATHINFO_EXTENSION);
	            	$name 		= 	$filename.'.'.$ext;
	                
	                $arr = array(
	                        'appId'     =>      $appId,
	                        'userId'    =>      $userId,
	                        'create_at' =>      $date_added
	                );
					if(file_get_contents($row->link,0,NULL,0,1)) {
	    			
	                	if($this->App_user_statistic_model->down($arr))
		                {
		                    force_download($name, $data); 
	        				exit;
		                }  
		                else
		                {
		                	$text   =   'AppID: '.$appId.'.UserId: '.$userId.'. Lỗi thao tác dữ liệu không hợp lệ Table App_user_statistic. Time: '.$date_added;
		            
		            		$arr    =   array('text' => $text, 'create_at' => $date_added);
		            		$bool   =   $this->Logs_model->insert($arr);
		            		redirect(base_url('404_error'));
		                }
	                }
	                else
	                {
	                	$text   =   'AppID: '.$appId.'.UserId: '.$userId.'. App không tồn tại hoặc chưa được up cho thành viên này. Time: '.$date_added;
	            
	            		$arr    =   array('text' => $text, 'create_at' => $date_added);
	            		$bool   =   $this->Logs_model->insert($arr);
	            		redirect(base_url('404_error'));
	                }
	                break;
	                
	            }

	        }
	        //Ghi logs trên database
	        else
	        {
	            $text   =   'AppID: '.$appId.'.UserId: '.$userId.'. App không tồn tại hoặc chưa được up cho thành viên này. Time: '.$date_added;
	            
	            $arr    =   array('text' => $text, 'create_at' => $date_added);
	            $bool   =   $this->Logs_model->insert($arr);
	            redirect(base_url('404_error'));
	        }
        }
    }
    
    public function install($appId, $userId)
    {
        $query  =   $this->User_app_model->get($appId, $userId);
        $datestring         =   "%Y/%m/%d %h:%i:%s";
        $date_added			=	mdate($datestring, time() - 60*60);
        if(count($query) > 0)
        {
            $arr = array(
                        'appId'     =>      $appId,
                        'userId'    =>      $userId,
                        'create_at' =>      $date_added
                );
            $bool   =   $this->App_user_statistic_model->install($arr);
            if($bool == false)
            {
                $text   =   'AppID: '.$appId.'.UserId: '.$userId.'. App không cài đặt được. Time: '.$date_added;
            
            $arr    =   array('text' => $text, 'create_at' => $date_added);
            $bool   =   $this->Logs_model->insert($arr);
            }
        }
    }
                    
    public function addkeymod()
    {
        $appId      =   $this->input->post('app');
        $userId     =   $this->input->post('user');
        $keymod     =   $this->input->post('txtKeymod');
        $arr        =   array(
                            'appId'     =>  $appId,
                            'userId'    =>  $userId,
                            'keymod'    =>  $keymod
                            );
        echo $this->User_app_model->update($arr);
    }
    
	public function page_404_error()
	{
		$username 	=	'';

		if($this->_login)
		{
			$session_data 		=	$this->session->userdata('logged');
			$username 			=	$session_data['fullname'];
		}

		$data['username']		=	$username;

		$this->load->view('themes/head_view');
		$this->load->view('themes/navbar_view', $data);
		$this->load->view('themes/404_view');
		$this->load->view('themes/footer_view');
		$this->load->view('themes/end_view');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged');
		if($this->session->userdata('logged_ad'))
		{			
			$this->session->unset_userdata('logged_ad');
		}
            delete_cookie("fullname");
            delete_cookie("username");
            delete_cookie("password");
		redirect(base_url('login.html'), "location");
	}
    
    public function recapcha()
    {
        $this->load->helper('Capcha');
            
        $_SESSION['captcha'] = simple_php_captcha();   
        //'<img src="" title="Capcha code" />'
        
        echo json_encode(array('capcha' => $_SESSION['captcha']['image_src'], 'code' => $_SESSION['captcha']['code']));
    }
    
    public function seturllang()
    {
        $lang   =   $this->input->get('lang');
        $this->_lang = $lang;
        $this->setLang($this->_lang);
        echo "1";
    }
    
	public function setLang($lang = 'vi')
	{
        $cookie_time	=	3600*24*30;				
        $this->input->set_cookie('lang',$lang,$cookie_time);   
        $language       =   $lang;
        if($this->input->cookie('lang'))
        {            
		  $language 	    =	$this->input->cookie('lang');
        }
		//Thiết lập ngôn ngữ cho hệ thống
        $this->lang->load($language, 'lang');
	}

}
