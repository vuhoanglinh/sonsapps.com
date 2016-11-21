<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logs_model extends CI_Model {

	protected  $_table  =   TABLE_LOGS;
	public function __construct(){
         parent::__construct();
    }

    public function get($number = null, $offset = 0)
    {
        if($number != null)
        {            
            $this->db->limit($number,$offset);
        }
        $this->db->order_by("created_at", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }

    public function count_all()
    {
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

    public function delete()
    {
      $this->db->where('id', $id);
      if($this->db->delete($this->_table)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }
}