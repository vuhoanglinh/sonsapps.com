<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

	protected  $_table  =   TABLE_USER;
	public function __construct(){
         parent::__construct();
    }

    public function getUser($arrUser = null, $number = null, $offset = 0, $key =  null, $type = null, $delete = 0)
    {
        if(is_array($arrUser))
        {
            $app  =   array();
            foreach($arrUser as $userId)
            {
                $app[]    =   $userId->userId;                
            }            
            if(count($app) > 0)
            {
                $this->db->where_not_in('id', $app);
            }
        }
        
        if($number != null)
        {            
            $this->db->limit($number,$offset);
        }

        if($key != null)
        {
            if($type != NULL)  
            {
                switch ($type) {
                    case 0:
                        $condition  =   "(`id` LIKE '%$key%' AND active = 0) OR (`username` LIKE '%$key%' AND active = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND active = 0) OR (`email` LIKE '%$key%' AND active = 0)";
                        $this->db->where($condition);
                        break;
                    case 1:
                        $condition  =   "(`id` LIKE '%$key%' AND active = 1) OR (`username` LIKE '%$key%' AND active = 1) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND active = 1) OR (`email` LIKE '%$key%' AND active = 1) ";
                        $this->db->where($condition);
                        break;
                    case 2:
                        $condition  =   "(`id` LIKE '%$key%' AND block = 0) OR (`username` LIKE '%$key%' AND block = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND block = 0) OR (`email` LIKE '%$key%' AND block = 0)";
                        $this->db->where($condition);
                        break;
                    case 3:
                        $condition  =   "(`id` LIKE '%$key%' AND block = 1) OR (`username` LIKE '%$key%' AND block = 1) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND block = 1) OR (`email` LIKE '%$key%' AND block = 1)";
                        $this->db->where($condition);
                        break;
                    case 4:
                        $condition  =   "(`id` LIKE '%$key%' AND level = 0) OR (`username` LIKE '%$key%' AND level = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND level = 0) OR (`email` LIKE '%$key%' AND level = 0)";
                        $this->db->where($condition);
                        break;
                    case 5:
                        $condition  =   "(`id` LIKE '%$key%' AND level = 1) OR (`username` LIKE '%$key%' AND level = 1) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND level = 1) OR (`email` LIKE '%$key%' AND level = 1)";
                        $this->db->where($condition);
                        break;
                    default:
                        $condition  =   "(`id` LIKE '%$key%' AND active = 0) OR (`username` LIKE '%$key%' AND active = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND active = 0) OR (`email` LIKE '%$key%' AND active = 0)";
                        $this->db->where($condition);
                        break;
                }                
            }         
            else
            {
                $this->db->like('id', $key);
                $this->db->or_like('username', $key);
                $this->db->or_like('fullname', $key);
                $this->db->or_like('phone', $key);
                $this->db->or_like('email', $key);
            }
        }
        else
        {
            if($type != null)
            {
                switch ($type) {
                    case 0:
                        $condition  =   "active = 0";
                        $this->db->where($condition);
                        break;
                    case 1:
                        $condition  =   "active = 1";
                        $this->db->where($condition);
                        break;
                    case 2:
                        $condition  =   "block = 0";
                        $this->db->where($condition);
                        break;
                    case 3:
                        $condition  =   "block = 1";
                        $this->db->where($condition);
                        break;
                    case 4:
                        $condition  =   "level = 0";
                        $this->db->where($condition);
                        break;
                    case 5:
                        $condition  =   "level = 1";
                        $this->db->where($condition);
                        break;
                    default:
                        $condition  =   "active = 0";
                        $this->db->where($condition);
                        break;
                } 
            }
        }
        
        $this->db->where('delete', $delete);
        $this->db->order_by("id", "desc");
        $query  =   $this->db->get($this->_table);
        return $query->result();
    }
    
    public function count_all($arrUser = null, $key =  null, $type = null, $delete = 0)
    {

        if($key != null)
        {
            if($type != NULL)  
            {
                switch ($type) {
                    case 0:
                        $condition  =   "(`id` LIKE '%$key%' AND active = 0) OR (`username` LIKE '%$key%' AND active = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND active = 0) OR (`email` LIKE '%$key%' AND active = 0)";
                        $this->db->where($condition);
                        break;
                    case 1:
                        $condition  =   "(`id` LIKE '%$key%' AND active = 1) OR (`username` LIKE '%$key%' AND active = 1) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND active = 1) OR (`email` LIKE '%$key%' AND active = 1) ";
                        $this->db->where($condition);
                        break;
                    case 2:
                        $condition  =   "(`id` LIKE '%$key%' AND block = 0) OR (`username` LIKE '%$key%' AND block = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND block = 0) OR (`email` LIKE '%$key%' AND block = 0)";
                        $this->db->where($condition);
                        break;
                    case 3:
                        $condition  =   "(`id` LIKE '%$key%' AND block = 1) OR (`username` LIKE '%$key%' AND block = 1) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND block = 1) OR (`email` LIKE '%$key%' AND block = 1)";
                        $this->db->where($condition);
                        break;
                    case 4:
                        $condition  =   "(`id` LIKE '%$key%' AND level = 0) OR (`username` LIKE '%$key%' AND level = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND level = 0) OR (`email` LIKE '%$key%' AND level = 0)";
                        $this->db->where($condition);
                        break;
                    case 5:
                        $condition  =   "(`id` LIKE '%$key%' AND level = 1) OR (`username` LIKE '%$key%' AND level = 1) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND level = 1) OR (`email` LIKE '%$key%' AND level = 1)";
                        $this->db->where($condition);
                        break;
                    default:
                        $condition  =   "(`id` LIKE '%$key%' AND active = 0) OR (`username` LIKE '%$key%' AND active = 0) OR (`fullname` LIKE '%$key%' AND active = 0) OR (`phone` LIKE '%$key%' AND active = 0) OR (`email` LIKE '%$key%' AND active = 0)";
                        $this->db->where($condition);
                        break;
                }                
            }         
            else
            {
                $this->db->like('id', $key);
                $this->db->or_like('username', $key);
                $this->db->or_like('fullname', $key);
                $this->db->or_like('phone', $key);
                $this->db->or_like('email', $key);
            }
        }
        else
        {
            if($type != null)
            {
                switch ($type) {
                    case 0:
                        $condition  =   "active = 0";
                        $this->db->where($condition);
                        break;
                    case 1:
                        $condition  =   "active = 1";
                        $this->db->where($condition);
                        break;
                    case 2:
                        $condition  =   "block = 0";
                        $this->db->where($condition);
                        break;
                    case 3:
                        $condition  =   "block = 1";
                        $this->db->where($condition);
                        break;
                    case 4:
                        $condition  =   "level = 0";
                        $this->db->where($condition);
                        break;
                    case 5:
                        $condition  =   "level = 1";
                        $this->db->where($condition);
                        break;
                    default:
                        $condition  =   "active = 0";
                        $this->db->where($condition);
                        break;
                } 
            }
        }

        if(is_array($arrUser))
        {
            $app  =   array();
            foreach($arrUser as $userId)
            {
                $app[]    =   $userId->userId;                
            }      
            if(count($app) > 0)
            {      
                $this->db->where_not_in('id', $app);
            }
        }

        $this->db->where('delete', $delete);
        
        return $this->db->count_all_results($this->_table); 
    }
    
    public function getUserLogin($username, $password, $level = null)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        if($level != null)
        {
            $this->db->where('level', $level);   
        }
        
        $query  =   $this->db->get($this->_table);
        return $query->result();    
    }

    public function getUsername($p_username)
    {
        $bool   =   FALSE;
        $this->db->where('username', $p_username);
        $query  =   $this->db->get($this->_table);
        if(count($query->result()) > 0)
        {
            $bool   =   TRUE;
        }
        return $bool;
    }

    public function complete($username, $email)
    {
        $this->db->where('username', $username);
        $this->db->where('email', $email);
        $query  =   $this->db->get($this->_table);
        if(count($query->result) > 0)
        {
            $arr    =   array(
                        'active' => 1);
            foreach ($query->result as $row) {
                
                $this->update($row->id, $arr);            
            }
        }
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