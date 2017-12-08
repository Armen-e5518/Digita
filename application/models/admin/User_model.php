<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	
	var $userFields	=  array('*');

  	function __construct(){
        parent::__construct();
    }
	
	function AdminLogin($username, $password) {
		$fields = array('id', 'email', 'first_name', 'last_name','userrole', 'restaurant_id');
		$this->db->select($fields);
		$this->db->from('users');
		$this->db->where(array('users.email' => trim($username), 'users.`password`' => sha1($password)));
		$query = $this->db->get();
		$user = $query->first_row();
		$query->free_result();
		return $user;
	}

	function GetAdmin(){
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where(array('users.userrole'=>'admin'));
		$this->db->limit(1);
		$query = $this->db->get();
		$user = $query->first_row();
		$query->free_result();
		return $user;
	}
	
	function UpdateAdmin($prArr){
		$this->db->where('users.userrole', 'admin');
		$upd = $this->db->update('users',$prArr);
		return $upd; 
	}

}
