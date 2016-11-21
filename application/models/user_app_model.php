<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_app_model extends CI_Model {

	protected  $_table  =   TABLE_USER_APP;
	public function __construct(){
         parent::__construct();
    }
    
    public function get($app_id = null, $userId = null)
    {
        if($app_id != null)
        {
            $this->db->where('appId', $app_id);
        }
        
        if($userId != null)
        {
            $this->db->where('userId', $userId);
        }
        //$this->db->order_by("created_at", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function insert($p_arr)
    {
    	if($this->db->insert($this->_table,$p_arr)){
          return TRUE;
        }
        else {
          return FALSE;
        }
    }

    public function update($p_arr)
    {
    	$this->db->where('appId', $p_arr['appId']);
        $this->db->where('userId', $p_arr['userId']);
        if($this->db->update($this->_table, $p_arr)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }
    
    public function actions($p_arr)
    {
        $this->db->where('appId', $p_arr['appId']);
        $this->db->where('userId', $p_arr['userId']);
        $query  =   $this->db->get($this->_table);
        if(count($query->result()) > 0)
        {
            $bool   =   $this->update($p_arr);
        }
        else
        {
            $bool   =   $this->insert($p_arr);
        }
    }
    
}