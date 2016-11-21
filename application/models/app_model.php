<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_model extends CI_Model {

	protected  $_table  =   TABLE_APP;
	public function __construct(){
         parent::__construct();
    }

    public function getApp($id = null, $status = null, $arrId = null, $number = null, $offset = 0, $lang = null, $delete = 0)
    {
        if($id != null)
        {
            $this->db->where('id', $id);
        }

        if($status != null)
        {
            $this->db->where('status', $status);
        }
        
        if(is_array($arrId))
        {
            $app  =   array();
            foreach($arrId as $appId)
            {
                $app[]    =   $appId->appId;                
            }
            if(count($app) > 0)
            {
                $this->db->where_in('id', $app);
            }
            else
            {
                return array();
            }
        }
        
        if($number != null)
        {            
            $this->db->limit($number,$offset);
        }
        
        if($lang != null)
        {            
            $this->db->where('language', $lang);
        }

        $this->db->where('delete', $delete);
        $this->db->order_by("id", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function getAppNotUser($arrId = null, $status = null, $lang = null, $delete = 0)
    {
        if($status != null)
        {
            $this->db->where('status', $status);
        }
        if($lang != null)
        {            
            $this->db->where('language', $lang);
        }

        if(is_array($arrId))
        {
            $app  =   array();
            foreach($arrId as $appId)
            {
                $app[]    =   $appId->appId;                
            }
            if(count($app) > 0)
            {
                $this->db->where_not_in('id', $app);
            }
            else
            {
                return array();
            }
        }


        $this->db->where('delete', $delete);
        $this->db->order_by("id", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function getAppByProject($projectId, $delete = 0)
    {
        $this->db->where('projectId', $projectId);
        $this->db->where('delete', $delete);
        $this->db->order_by("id", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function count_all($status = null,  $lang = null, $delete = 0)
    {
        if($status != null)
        {
            $this->db->where('status', $status);
        }

        if($lang != null)
        {            
            $this->db->where('language', $lang);
        }
        
        $this->db->where('delete', $delete);
        return $this->db->count_all_results($this->_table); 
    }
    
    public function insert($p_arr)
    {
        $this->db->trans_start();
        $this->db->insert($this->_table,$p_arr);
        $this->db->trans_complete();
    	if($this->db->trans_status() === FALSE){
          return FALSE;
        }
        else {
          return TRUE;
        }
    }

    public function update($id, $p_arr)
    {
        $this->db->trans_start();        
        $this->db->where('id', $id);
        $this->db->update($this->_table, $p_arr);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
          return FALSE;
        }
        else {
          return TRUE;
        }
    }

    public function checkID($id)
    {
        $this->db->where('id', $id);
        $query  =   $this->db->get($this->_table);
        $query  =   $query->result();
        if(count($query) > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function delete($id)
    {
    	$this->db->where('id', $id);
    	if($this->db->update($this->_table, array('status' => 0))){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }
}