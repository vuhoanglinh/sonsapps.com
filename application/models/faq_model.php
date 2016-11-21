<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faq_model extends CI_Model {

	protected  $_table  =   TABLE_FAQ;
	public function __construct(){
         parent::__construct();
    }
    
    public function getQuestion($question)
    {
        $bool   =   FALSE;
        $this->db->where('question', $question);
        $query  =   $this->db->get($this->_table);
        if(count($query->result()) > 0)
        {
            $bool   =   TRUE;
        }
        
        return $bool;
    }
    
    public function get($id = null, $status = null, $lang = null, $number = null, $offset = 0, $type = null)
    {
        if($id != null)
        {
            $this->db->where('id', $id);
        }
        
        if($status != null)
        {
            $this->db->where('status', $status);
        }

        if($lang != null)
        {
            $this->db->where('lang', $lang);
        }
        
        if($number != null)
        {            
            $this->db->limit($number,$offset);
        }

        if($type != null)
        {
            $this->db->where('type', $type);
        }
        $this->db->order_by("index");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function count($status = null, $lang = null)
    {
               
        if($status != null)
        {
            $this->db->where('status', $status);
        }

        if($lang != null)
        {
            $this->db->where('lang', $lang);
        }
        
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
    
    public function delete($id)
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