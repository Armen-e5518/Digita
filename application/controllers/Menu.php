<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{
    var $view = 'restaurant_menu';

    function __construct()
    {
        parent::__construct();
        $this->pageData['is_home'] = true;
    }


    function index($menu_id, $index = 0, $slug = '')
    {


        print_r($menu_id);
        if (!intval($menu_id)) {
            redirect(base_url());
        }
        $user_session = $this->session->userdata('user_id');
        $restaurant_id = $user_session['restaurant_id'];
        $session = $this->session->userdata('cart_data') ? $this->session->userdata('cart_data') : array();

        $this->load->model('restaurants_menu');

        if ($restaurant = $this->restaurants_menu->get_restaurant($restaurant_id, $this->_lang)) {

            $array_menu = $this->restaurants_menu->get_restaurant_menu($restaurant_id, $this->_lang);
            $menu_map = $this->map_tree($array_menu, $restaurant_id);

            $top_menu = array();
            foreach ($menu_map as $item) {
                if (isset($item['childs'])) {
                    foreach ($item['childs'] as $childs_item) {
                        $top_menu[] = $childs_item['id'];
                    }
                } else {
                    $top_menu[] = $item['id'];
                }
            }

            $menu = $this->categories_to_string($menu_map, $this->pageData['resto_slug']);

            if ($products = $this->restaurants_menu->get_menus($restaurant_id, $this->_lang)) {

                $empty_page = "";
            } else {

                $empty_page = $this->restaurants_menu->get_empty_pages_message($this->_lang);
            };


//            if ($target_menu = $this->restaurants_menu->get_menu($menu_id, $this->_lang)) {
            $target_menu = $this->restaurants_menu->get_menu($menu_id, $this->_lang);


            $selected_products = array();
            foreach ($session as $arr_tow) {
                if (!empty($arr_tow) && !in_array($arr_tow, $selected_products)) {
                    $selected_products[] += $arr_tow;
                }
            }

            $advertisement = $this->restaurants_menu->get_random_advertisement($this->_lang, $restaurant_id);

            $this->pageData['page'] = 'menu';
            $this->pageData['advertisement'] = $advertisement;
            $this->pageData['selected_products'] = $selected_products;
            $this->pageData['products'] = $products;
            $this->pageData['empty_page'] = $empty_page;
            $this->pageData['restaurant'] = $restaurant;
            $this->pageData['target_menu'] = $target_menu;
            $this->pageData['menu'] = $menu;


        }


        $this->pageData['productsCount'] = $session;

        $productIds = array();
        foreach ($session as $keyID => $product) {
            $productIds[] = $keyID;
        }

        if (!empty($productIds)) {
            $cartProducts = $this->restaurants_menu->getMenuItems($productIds);
        } else {
            $cartProducts = array();
        }
        $this->pageData['cartProducts'] = $cartProducts;


        $this->pageData['sliderIndex'] = $menu_id;


        $this->_currentView('restaurant_menu');
        $this->_renderPage();
    }

    function map_tree($dataSet, $restaurant_id)
    {
        $tree = array();

        foreach ($dataSet as $id => &$node) {
            if ($node['pid'] == $restaurant_id) {
                $tree[$id] = &$node;
            } else {
                $dataSet[$node['pid']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }


    function categories_to_string($data, $slug)
    {
        $string = "";
        $index = 0;
        foreach ($data as $key => $item) {
            $string .= $this->categories_to_template($item, $index++, $slug);
        }
        return $string;
    }


    function categories_to_template($category, $index, $slug)
    {
        ob_start();
        include 'application/views/menu/menu_template.php';
        return ob_get_clean();
    }


}