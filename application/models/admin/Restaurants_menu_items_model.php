<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.01.2017
 * Time: 18:27
 */
class restaurants_menu_items_model extends CI_Model
{


    function get_restaurant_menu_items($id = null, $restaurant_id = null)
    {
        if ($id && $restaurant_id) {

            $this->db->select('*');
            $this->db->where('restaurants_menu_id', $id);
            $this->db->from('restaurants_menu_items');
            $query = $this->db->get();
            $result = $query->result_array();

            return $result;


        } else {

            return false;
        }

    }
    function insert_item($data){

        $this->db->insert('restaurants_menu_items', $data);
        $inserted_id = $this->db->insert_id();
        return $inserted_id;

        }
    function insert_item_ml($data){

        $this->db->insert('restaurants_menu_items_ml', $data);

    }
    function update_item_ml($data, $id){

        $this->db->where('id', $id);
        $this->db->where('lang', $data['lang']);
        $this->db->update('restaurants_menu_items_ml', $data);
    }
    function update_item($data, $id){

        $this->db->where('id', $id);
        $this->db->update('restaurants_menu_items', $data);



    }

    function get_category_list($id){

        $this->db->select('pid');
        $this->db->from('restaurants_menu');
        $this->db->where('pid', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_category_items($restaurants_menu_id){


        $this->db->select('*');
        $this->db->order_by('restaurants_menu_items.pos','ASC');
        $this->db->from('restaurants_menu_items');
        $this->db->join('restaurants_menu_items_ml', 'restaurants_menu_items_ml.id = '.'restaurants_menu_items'.'.id','LEFT');
        $this->db->where('restaurants_menu_id', $restaurants_menu_id);
        $this->db->where('lang', 'en');

        $query = $this->db->get();
        $result = $query->result();

        return $result;

    }
}