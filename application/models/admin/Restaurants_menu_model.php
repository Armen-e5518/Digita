<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class restaurants_menu_model extends CI_Model {

    function get_restaurants(){

        $this->db->select('*');
        $this->db->from('restaurants_ml');
        $this->db->where('lang', 'en');
        $query	= $this->db->get();
        //$result	= $query->first_row();
        $result = $query->result();
        return $result;


    }
    function get_menu_category($restaurant_id){

        $this->db->select('*');
        $this->db->from('restaurants_menu_ml');
        $this->db->where('restaurants_id', $restaurant_id);
        $this->db->where('parent_id', 0);
        $query	= $this->db->get();
        //$result	= $query->first_row();
        $result = $query->result();
        return $result;


    }
    function get_category_group($category_id){

        $this->db->select('*');
        $this->db->from('restaurants_menu_ml');
        $this->db->where('parent_id', $category_id);
        //$this->db->where('parent_id', 0);
        $query	= $this->db->get();
        //$result	= $query->first_row();
        $result = $query->result();
        return $result;


    }

}