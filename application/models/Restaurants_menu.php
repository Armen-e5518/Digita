<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.01.2017
 * Time: 16:25
 */
class restaurants_menu extends CI_Model
{


    function get_restaurant_menu($id, $lang)
    {

        $this->db->select('*');
        $this->db->from('restaurants_menu');
        $this->db->join('restaurants_menu_ml', 'restaurants_menu_ml.id = restaurants_menu.id', 'LEFT');
        $this->db->where('section_id', $id);
        $this->db->where('lang', $lang);
        $this->db->where('status', 1);
        $this->db->order_by('pos');
        $query = $this->db->get();
        $result = $query->result_array();
        $arr = array();
        foreach ($result as $id => $item) {
            $arr[$item['id']] = $item;
        }

        return $arr;
    }

    function get_restaurant($id, $lang)
    {

        $this->db->select('*');
        $this->db->from('restaurants');
        $this->db->join('restaurants_ml', 'restaurants_ml.id = restaurants.id', 'LEFT');
        $this->db->where('restaurants.id', $id);
        $this->db->where('lang', $lang);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }


    function get_menu_category()
    {

        $this->db->select('*');
        $this->db->where('restaurants_id', 1);
        $this->db->from('restaurants_menu');
        $query = $this->db->get();
        $result = $query->result_array();
        $arr = array();
        foreach ($result as $id => $item) {
            $arr[$item['id']] = $item;
        }
        return $arr;
    }

    function add_blocks($id, $data, $lang)
    {

        $this->db->select('uid');
        $this->db->from('restaurants_menu_ml');
        $this->db->where('id', $id);
        $this->db->where('lang', $lang);
        $query = $this->db->get();
        $uid = $query->result_array();
        $this->db->update('restaurants_menu_ml', $data);
        $this->db->where('uid', $uid['uid']);

        return $uid;
    }

    function add_block_menu($data)
    {
        $this->db->insert('restaurants_menu_ml', $data);

    }

    function get_menu_products($menu_id, $lang, $restaurant_id)
    {

        $this->db->select('*');
        $this->db->from('restaurants_menu_items');
        $this->db->join('restaurants_menu_items_ml', 'restaurants_menu_items_ml.id = restaurants_menu_items.id', 'LEFT');
        $this->db->join('restaurants_menu', "restaurants_menu.id = {$menu_id}", 'LEFT');
        $this->db->where('restaurants_menu_items_ml.restaurants_menu_id', $menu_id);
        $this->db->where('lang', $lang);
        $this->db->where('section_id', $restaurant_id);
        $this->db->where('restaurants_menu_items.status', 1);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_menus($restaurant_id, $lang)
    {


        $this->db->select('*');
        $this->db->from('restaurants_menu_ml');
        $this->db->where('lang', $lang);
        $this->db->join('restaurants_menu', 'restaurants_menu.id = restaurants_menu_ml.id', 'LEFT');
        $this->db->where('section_id', $restaurant_id);
        $this->db->where('status', 1);
        $this->db->order_by('pos');

        $query = $this->db->get();
        $results = $query->result_array();

        $rest_array = array();

        $i = 0;
        foreach ($results as $result) {

            $rest_array[$i]['title'] = $result['title'];
            $rest_array[$i]['id'] = $result['id'];
            $rest_array[$i]['products'] = $this->get_menu($result['id'], $lang);
            $i++;
        }

        //pre($rest_array);

        return $rest_array;


    }

    function get_selected_products($lang, $selected_products)
    {

        $this->db->select('*');
        $this->db->from('restaurants_menu_items_ml');
        $this->db->join('restaurants_menu_items', 'restaurants_menu_items.id = restaurants_menu_items_ml.id', 'LEFT');
        $this->db->where_in('uid', $selected_products);
        $this->db->where('lang', $lang);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_empty_message($lang)
    {

        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('key', 'order_empty');
        // $this->db->where('lang', $lang);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_not_empty_message($lang)
    {

        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('key', 'order_not_empty');
        // $this->db->where('lang', $lang);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_total_message($lang)
    {

        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('key', 'total_price');
        // $this->db->where('lang', $lang);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_empty_pages_message($lang)
    {

        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('key', 'empty_pages');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }

    function get_reset_order_message($lang)
    {

        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('key', 'reset_order');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;

    }


    function get_random_advertisement($lang, $restaurant_id)
    {
        $restoMenuList = $this->db->query("SELECT id FROM restaurants_menu WHERE section_id = {$restaurant_id}")->result();


        $this->db->select('*');
        $this->db->from('advertisement');
        $this->db->join('advertisement_ml', 'advertisement_ml.id = advertisement.id AND advertisement.status = 1', 'LEFT');
        $this->db->where('lang', $lang);

//        foreach ($restoMenuList as $key => $item) {
//            if (!$key) {
//                $this->db->like('restaurants_id', $item->id);
//            } else {
//                $this->db->or_like('restaurants_id', $item->id);
//            }
//        }

        $orWhere = array();
        foreach ($restoMenuList as $key => $item) {
//            $this->db->or_where("FIND_IN_SET('$item->id',restaurants_id)");
            $orWhere[] = " FIND_IN_SET('$item->id',restaurants_id)";
        }
        $this->db->where('status = 1 AND ('.implode(' OR ',$orWhere).')');

        $query = $this->db->get();
        $advertisement = $query->result_array();


        if (!empty($advertisement)) {
//            $result = $advertisement[array_rand($advertisement, 1)];
            $result = $advertisement;
        } else {
            $result = array();
        }

        return $result;


    }

    function get_menu($menu_id, $lang)
    {

        $this->db->select('*');
        $this->db->order_by('restaurants_menu_items.pos', 'ASC');
        $this->db->from('restaurants_menu_items_ml');
        $this->db->where('lang', $lang);
        $this->db->join('restaurants_menu_items', 'restaurants_menu_items.id = restaurants_menu_items_ml.id', 'LEFT');
        $this->db->where('restaurants_menu_id', $menu_id);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }


    function getMenuItems($ids = array(), $lang = DEF_LANG)
    {


        $this->db->select('*');
        $this->db->from('restaurants_menu_items');
        $this->db->where('lang', $lang);
        $this->db->join('restaurants_menu_items_ml', 'restaurants_menu_items.id = restaurants_menu_items_ml.id', 'LEFT');
        $this->db->where_in('restaurants_menu_items_ml.uid', $ids);
        $query = $this->db->get();

        $result = $query->result();


        return $result;
    }

}