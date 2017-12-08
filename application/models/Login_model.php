<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    function get_user_data($username)
    {

        $this->db->select('username, password, id');
        $this->db->from('restaurants');
        $this->db->where('username', $username);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function getRestoUserBySlug($segments)
    {

        $this->db->select('username, password, id,url');
        $this->db->from('restaurants');
        $this->db->where_in('url', $segments);
        $this->db->where(array('status' => 1));
        $this->db->where('LENGTH(url) > 0');
        $query = $this->db->get();
        $result = $query->row();
        return $result;

    }

    function get_user_data_pass($username, $password)
    {

        $this->db->select('username, password, id');
        $this->db->from('restaurants');
        $this->db->where(array('username' => $username, 'password' => sha1($password), 'status' => 1));
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function getRestoUser($username, $password)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('email' => $username, 'password' => sha1($password), 'userrole' => 'client'));
        $query = $this->db->get();
        $result = $query->row();

        return $result;

    }

}