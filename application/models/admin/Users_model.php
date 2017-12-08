<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {


    var $userFields	=  array('*');

    function __construct(){
        parent::__construct();
    }


        function get_users(){

            $this->db->select('*');
            $this->db->from('restaurant_users');
            $query	= $this->db->get();
            $result = $query->result();

            return $result;
        }

        function get_restaurants(){


            $this->db->select('id, title');
            $this->db->from('restaurants_ml');
            $this->db->where('lang', 'en');

            $query	= $this->db->get();
            $result = $query->result_array();

            return $result;

        }function get_user($id){


            $this->db->select('*');
            $this->db->from('restaurant_users');
            $this->db->where('id', $id);

            $query	= $this->db->get();
            $result = $query->result_array();

            return $result;

        }

    function insert_user($data){

        $this->db->insert('restaurant_users', $data);

    }

    function update_user($data, $id){

        $this->db->where('id', $id);
        $this->db->update('restaurant_users', $data);
    }

//    function AdminLogin($username, $password) {
//        $fields = array('id', 'email', 'first_name', 'last_name','userrole');
//        $this->db->select($fields);
//        $this->db->from('users');
//        $this->db->where(array('users.email' => trim($username), 'users.`password`' => sha1($password)));
//        $query = $this->db->get();
//        $user = $query->first_row();
//        $query->free_result();
//        return $user;
//    }
//
//    function GetAdmin(){
//        $this->db->select("*");
//        $this->db->from('users');
//        $this->db->where(array('users.userrole'=>'admin'));
//        $this->db->limit(1);
//        $query = $this->db->get();
//        $user = $query->first_row();
//        $query->free_result();
//        return $user;
//    }
//
//    function UpdateAdmin($prArr){
//        $this->db->where('users.userrole', 'admin');
//        $upd = $this->db->update('users',$prArr);
//        return $upd;
//    }

}
