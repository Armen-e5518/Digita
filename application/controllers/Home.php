<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
    var $view = 'home';

    function __construct()
    {
        parent::__construct();
        $this->pageData['is_home'] = true;
    }

    public function index()
    {
        $url_s = explode('/', $this->uri->uri_string());

        $user_session = $this->session->userdata('user_id');
        $restaurant_id = $user_session['restaurant_id'];
        $session = $this->session->userdata('cart_data') ? $this->session->userdata('cart_data') : array();

        if (empty($url_s[1])) {
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

                $menuLisForAdv = array();
                foreach ($products as $product) {
                    $menuLisForAdv[] = 0;
                }
                $this->pageData['menuLisForAdv'] = $menuLisForAdv;
                $this->pageData['empty_page'] = $empty_page;
                $this->pageData['restaurant'] = $restaurant;
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
            $this->pageData['sliderIndex'] = 0;
            $this->pageData['target_menu'] = 0;
            $this->_currentView('restaurant_menu');
            $this->_renderPage();
        } else {
            $this->load->model('admin/restaurants_model');
            $res = $this->restaurants_model->get_restaurants_by_id($restaurant_id);
            $this->pageData['logo_img'] = !empty($res[0]->logo_img) ? $res[0]->logo_img : "";
            $this->pageData['background_image'] = !empty($res[0]->background_image) ? $res[0]->background_image : "";
            $this->pageData['table_flag'] = true;
            $this->pageData['table_index'] = $url_s[1];
            $this->pageData['restaurant_id'] = $restaurant_id;
            $this->_currentView('table');
            $this->_renderPage();
        }

    }


    function map_tree($dataSet, $restaurant_id)
    {
        $tree = array();

        foreach ($dataSet as $id => &$node) {
            if (isset($node['pid'])) {

                if ($node['pid'] == $restaurant_id) {
                    $tree[$id] = &$node;
                } else {
                    $dataSet[$node['pid']]['childs'][$id] = &$node;
                }
            }
        }

        return $tree;
    }


    function categories_to_string($data, $slug)
    {
        $string = "";
        $index = 0;
        foreach ($data as $item) {
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


    function send_table_number()
    {
        $obj = new stdClass();
        $obj->error = false;
        if ($this->input->post('tableNumber') && intval($this->input->post('tableNumber'))) {
            $lid = $this->mGlobal->insert(
                'order_table_numbers',
                array(
                    'table_number' => intval($this->input->post('tableNumber')),
                    'date' => time(),
                    'restaurant_id' => $this->input->post('restaurant_id'),
                    'bill_status' => ($this->input->post('bill')) ? 1 : 0,
                )
            );
            $obj->id = $lid;
        } else {
            $obj->error = true;
        }
        echo json_encode($obj);
    }

    function send_table_number_url()
    {

        $obj = new stdClass();
        $obj->error = false;
        if ($this->input->post('tableNumber') && intval($this->input->post('tableNumber'))) {


            $lid = $this->mGlobal->insert(
                'order_table_numbers',
                array(
                    'table_number' => intval($this->input->post('tableNumber')),
                    'date' => time(),
                    'restaurant_id' => $this->input->post('restaurant_id'),
                    'bill_status' => !empty($this->input->post('bill')) ? 1 : 0
                )
            );
            $obj->id = $lid;

        } else {
            $obj->error = true;
        }
        echo json_encode($obj);
    }

    function get_item_info($id = 0)
    {

        $item = $this->mGlobal->GetItem('restaurants_menu_items', $this->_lang, $id);
        $this->pageData['item'] = $item;
        $this->load->view('product_item', $this->pageData);
    }

}