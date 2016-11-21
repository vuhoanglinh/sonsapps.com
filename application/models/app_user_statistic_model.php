<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_user_statistic_model extends CI_Model {

	protected  $_table  =   TABLE_APP_STATISTIC;
	public function __construct(){
         parent::__construct();
    }
    
    public function get($app_id = null, $userId = null, $create_at = null)
    {
        if($app_id != null)
        {
            $this->db->where('appId', $app_id);
        }
        
        if($userId != null)
        {
            $this->db->where('userId', $userId);
        }
        
        if($create_at != null)
        {
            $this->db->where('create_at', $userId);
        }
        
        //$this->db->order_by("created_at", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function insert($p_arr)
    {
    	if($this->db->insert($this->_table,$p_arr) === FALSE){
          return FALSE;
        }
        else {
          return TRUE;
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
    
    public function down($p_arr)
    {
        $bool  = false;
        $this->db->where('appId', $p_arr['appId']);
        $this->db->where('userId', $p_arr['userId']);
        $this->db->where('create_at', $p_arr['create_at']);
        $query  =   $this->db->get($this->_table);
        if(count($query->result()) > 0)
        {
            foreach($query->result() as $row)
            {                
                $p_arr['down']     =   $row->down + 1;
                $bool   =   $this->update($p_arr);
                break;
            }
        }
        else
        {
            $bool   =   $this->insert($p_arr);
        }
        return $bool;
    }
    
    public function install($p_arr)
    {
        $bool  = false;
        $this->db->where('appId', $p_arr['appId']);
        $this->db->where('userId', $p_arr['userId']);
        $this->db->where('create_at', $p_arr['create_at']);
        $query  =   $this->db->get($this->_table);
        if(count($query->result()) > 0)
        {
            foreach($query->result() as $row)
            {                
                $p_arr['install']     =   $row->install + 1;
                $bool   =   $this->update($p_arr);
                break;
            }
        }
        else
        {
            $bool   =   $this->insert($p_arr);
        }
        return $bool;
    }
}
