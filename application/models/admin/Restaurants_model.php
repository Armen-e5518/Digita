<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class restaurants_model extends CI_Model
{


    function get_restaurants()
    {
        $this->db->select('*');
        $this->db->from('restaurants_ml');
        $this->db->where('lang', 'en');
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    function get_restaurants_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('restaurants');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
    function insert_status($data)
    {

        $this->db->insert('restaurants', $data);
        $inserted_id = $this->db->insert_id();

        return $inserted_id;
    }

    function insert_restaurant($id, $data)
    {

        $this->db->where('id', $id);
        $this->db->update('restaurants', $data);


    }

    function update_restaurant_images($id, $data)
    {

        $this->db->where('id', $id);
        $this->db->update('restaurants', $data);
    }


    function update_restaurant_menu_item_images($id, $data)
    {

        $this->db->where('id', $id);
        $this->db->update('restaurants_menu_items', $data);
    }


    function restaurantUser($data, $restaurant_id)
    {
        $this->db->where(array('restaurant_id' => $restaurant_id, 'userrole' => 'client'));
        $this->db->update('users', $data);
    }


    function insertRestaurantUser($data, $restaurant_id = 0)
    {
        $this->db->insert('users', $data);
        $id = $this->db->insert_id();
        return $id;
    }
}