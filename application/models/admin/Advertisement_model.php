<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement_model extends CI_Model
{


    function get_restaurants_menu_list()
    {

        $this->db->select('id, title');
        $this->db->from('restaurants_ml');
        $this->db->where('restaurants_ml.lang', 'en');
        $query = $this->db->get();
        $result_rest = $query->result_array();


        $a = '';
        foreach ($result_rest as $rest) {
            $a[] += $rest['id'];
        }
        $this->db->select('*');
        $this->db->from('restaurants_menu');
        $this->db->join('restaurants_menu_ml', 'restaurants_menu_ml.id = restaurants_menu.id', 'LEFT');
        $this->db->where('lang', 'en');
        $this->db->where_in('section_id', $a);
        $query = $this->db->get();
        $result_menu = $query->result_array();

        $arr3 = array();

        foreach ($result_rest as $rest) {

            $rest['pid'] = 0;
            $arr3[$rest['id']] = $rest;
        }

        $arr = array_merge($result_menu, $arr3);

        $arr1 = array();
        foreach ($arr as $id => $item) {
            $arr1[$item['id']] = $item;
        }

        return $arr;

    }

    function get_restaurants_by_menus()
    {
        $this->db->select('id, title');
        $this->db->from('restaurants_ml');
        $this->db->where('restaurants_ml.lang', 'en');
        $query = $this->db->get();
        $result_rest = $query->result();
        $query->free_result();

        foreach ($result_rest as $rest) {
            $this->db->select('restaurants_menu.id, restaurants_menu_ml.title');
            $this->db->from('restaurants_menu');
            $this->db->join("restaurants_menu_ml", "restaurants_menu.id = restaurants_menu_ml.id", "INNER");
            $this->db->where(array('restaurants_menu_ml.lang' => 'en', 'restaurants_menu.section_id' => $rest->id, 'restaurants_menu.pid' => $rest->id));
            $query = $this->db->get();
            $menus = $query->result();
            $query->free_result();
            //getting sub menus
            foreach ($menus as $menu) {

                $this->db->select('restaurants_menu.id, restaurants_menu_ml.title');
                $this->db->from('restaurants_menu');
                $this->db->join("restaurants_menu_ml", "restaurants_menu.id = restaurants_menu_ml.id", "INNER");
                $this->db->where(array('restaurants_menu_ml.lang' => 'en', 'section_id' => $rest->id, 'pid' => $menu->id));
                $query = $this->db->get();
                $submenus = $query->result();
                $query->free_result();
                if (!empty($submenus)) {
                    $menu->submenus = $submenus;
                }
            }
            $rest->menu_list = $menus;
        }
        return $result_rest;
    }


    function insert_advertisement($data)
    {

        $this->db->insert('advertisement', $data);
        $inserted_id = $this->db->insert_id();
        return $inserted_id;
    }

    function update_advertisement($data, $id)
    {

        $this->db->where('id', $id);
        $this->db->update('advertisement', $data);

    }

    function insert_advertisement_ml($data)
    {

        $this->db->insert('advertisement_ml', $data);

    }

    function update_advertisement_ml($data, $id)
    {

        $this->db->where('id', $id);
        $this->db->where('lang', $data['lang']);
        $this->db->update('advertisement_ml', $data);
    }

    function get_selected_restaurants($id)
    {

        $this->db->select('restaurants_id');
        $this->db->from('advertisement');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        if ($result) {
            $selected_restaurants = explode(",", $result[0]['restaurants_id']);
        } else {
            $selected_restaurants = false;
        }

        return $selected_restaurants;
    }

}