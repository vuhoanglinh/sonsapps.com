<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Project_model extends CI_Model {

	protected  $_table  =   TABLE_PROJECT;
	public function __construct(){
         parent::__construct();
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

    public function update($p_id, $p_arr)
    {
        $this->db->trans_start();        
        $this->db->where('projectId', $p_id);
        $this->db->update($this->_table, $p_arr);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
          return FALSE;
        }
        else {
          return TRUE;
        }        
    }

    public function getProject($projectid = null, $number = null, $offset = 0, $delete = 0)
    {
        if($projectid != null)
        {
            $this->db->where('projectId', $projectid);
        }
        if($number != null)
        {            
            $this->db->limit($number,$offset);
        }
        $this->db->where('delete', $delete);
        $this->db->order_by("created_at", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function count_all($delete = 0)
    {
        $this->db->where('delete', $delete);
        return $this->db->count_all($this->_table); 
    }
    
    public function checkname($name)
    {
        $this->db->where('Name', $name);
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

    public function delete($projectId)
    {
        $this->db->where('projectId', $projectId);
        if($this->db->delete($this->_table)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }  
}