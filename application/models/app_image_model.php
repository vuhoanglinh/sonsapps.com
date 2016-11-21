<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_image_model extends CI_Model {

	protected  $_table  =   TABLE_APP_IMAGES;
	public function __construct(){
         parent::__construct();
    }
    
    public function get($app_id = null)
    {
        if($app_id != null)
        {
            $this->db->where('appId', $app_id);
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

    public function update($id, $p_arr)
    {
    	$this->db->where('id', $id);
        if($this->db->update($this->_table, $p_arr)){
            return TRUE;
        }        
        else {
            return FALSE;
        }
    }

    public function updateIDGame($id_game, $p_arr)
    {
    	$this->db->where('id_game', $id_game);
        if($this->db->update($this->_table, $p_arr)){
            return TRUE;
        }        
        else {
            return FALSE;
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