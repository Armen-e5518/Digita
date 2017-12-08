<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class selected extends MY_Controller
{
    var $view = 'home';

    function __construct()
    {
        parent::__construct();
        $this->pageData['is_home'] = true;
        $this->load->model('restaurants_menu');
    }

    function index()
    {

        $user_session = $this->session->userdata('user_id');
        $restaurant_id = $user_session['restaurant_id'];


        $session = $this->session->userdata('cart_data') ? $this->session->userdata('cart_data') : array();


        if ($restaurant = $this->restaurants_menu->get_restaurant($restaurant_id, $this->_lang)) {

            $array_menu = $this->restaurants_menu->get_restaurant_menu($restaurant_id, $this->_lang);
            $menu_map = $this->map_tree($array_menu, $restaurant_id);
            $menu = $this->categories_to_string($menu_map);

            $restoIds = array();
            foreach ($session as $key => $item) {
                $restoIds[] = $key;
            }

            if (!empty($restoIds)) {
                $products = $this->restaurants_menu->get_selected_products($this->_lang, $restoIds);
                $order = $this->restaurants_menu->get_not_empty_message($this->_lang);
                $total = $this->restaurants_menu->get_total_message($this->_lang);
            } else {
                $products = '';
                $order = $this->restaurants_menu->get_not_empty_message($this->_lang);
                $total = "";
            }

            $reset_order = $this->restaurants_menu->get_reset_order_message($this->_lang);

            $empty_page = $this->restaurants_menu->get_empty_message($this->_lang);

            $advertisement = $this->restaurants_menu->get_random_advertisement($this->_lang, $restaurant_id);

            $this->pageData['advertisement'] = $advertisement;
            $this->pageData['reset_order'] = $reset_order;
            $this->pageData['page'] = 'order';
            $this->pageData['total'] = $total;
            $this->pageData['empty_page'] = $empty_page;
            $this->pageData['order'] = $order;
            $this->pageData['products'] = $products;
            $this->pageData['restaurant'] = $restaurant;
            $this->pageData['menu'] = $menu;

        } else {
            $this->pageData['page'] = 'not found';
            $this->pageData['menu'] = 'not found';
            $this->pageData['restaurant'] = 'not found';

        }


        $this->pageData['productsCount'] = $session;

        $this->_currentView('selected_products');
        $this->_renderPage();

    }


    function productajax()
    {

        $obj = new stdClass();

        $productsCount = array();
        $productIds = array();

        if ($this->session->userdata('cart_data')) {

            $num = $this->input->post('product_num');

            $products = $this->session->userdata('cart_data');
            if (isset($products[$num])) {
                $products[$num]++;
            } else {
                $products[$num] = 1;
            }


            $this->session->set_userdata('cart_data', $products);

        } else {

            $products = array();
            if (isset($products[$this->input->post('product_num')])) {
                $products[$this->input->post('product_num')]++;
            } else {
                $products[$this->input->post('product_num')] = 1;
            }
            $this->session->set_userdata('cart_data', $products);
        }


        foreach ($products as $keyID => $product) {
            $productIds[] = $keyID;
        }

        $cartProducts = $this->restaurants_menu->getMenuItems($productIds);

        $obj->cartTotal = 0;
        foreach ($cartProducts as $cartProduct) {
            if (isset($products[$cartProduct->uid])) {
                $obj->cartTotal += ($products[$cartProduct->uid] * $cartProduct->price);
            }
        }

        $tmpMenuItems = array();
        foreach ($products as $keyID => $product) {
            foreach ($cartProducts as $cartProduct) {
                if ($keyID == $cartProduct->uid) {
                    $tmpMenuItems[] = $cartProduct;
                    break;
                }
            }
        }


        $obj->cartProducts = $tmpMenuItems;
        $obj->productsCount = $products;
        $obj->productsAllCount = array_sum($products);
        echo json_encode($obj);
    }


    function remove_product()
    {

        $obj = new stdClass();
        $obj->totalPrice = 0;
        $productIds = array();

        $productsCount = array();
        $products = array();
        if ($session = $this->session->userdata('cart_data')) {

            unset($session[$this->input->post('product_num')]);

            $this->session->set_userdata('cart_data', $session);

            if (!empty($session)) {
                $products = $this->restaurants_menu->get_selected_products($this->_lang, array_keys($session));

                foreach ($products as $product) {
                    $obj->totalPrice += $product['price'];
                }
            }


        } else {

        }

        foreach ($session as $keyID => $product) {
            $productIds[] = $keyID;
        }

        if (!empty($productIds)) {

            $cartProducts = $this->restaurants_menu->getMenuItems($productIds);
        } else {
            $cartProducts = array();
        }


        $tmpMenuItems = array();
        foreach ($products as $keyID => $product) {
            foreach ($cartProducts as $cartProduct) {
                if ($keyID == $cartProduct->uid) {
                    $tmpMenuItems[] = $cartProduct;
                    break;
                }
            }
        }


        $obj->cartTotal = 0;
        foreach ($cartProducts as $cartProduct) {

            if (isset($session[$cartProduct->uid])) {
                $obj->cartTotal += ($session[$cartProduct->uid] * $cartProduct->price);
            }
        }

        $obj->productsCount = $session;
        $obj->productsAllCount = array_sum($session);
        echo json_encode($obj);
    }

    /**
     *
     */
    function reset()
    {

        $this->load->library('session');
        $this->session->unset_userdata('cart_data');
        $this->session->unset_userdata('prew');
        redirect(base_url() . "selected/index");

    }

    function reset_ajax()
    {
        $this->load->library('session');
        $this->session->unset_userdata('cart_data');
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

    function subscribe()
    {
        $this->load->model('global_model');

        if ($this->input->post('email')) {
            $email = $this->global_model->GetWhere('subscribers', array('email' => $this->input->post('email')));
            if (empty($email)) {
                $this->global_model->insert('subscribers', array('email' => $this->input->post('email'), 'date' => time()));
            }
        }
    }


    function categories_to_string($data)
    {
        $string = "";
        $index = 0;
        foreach ($data as $item) {
            $string .= $this->categories_to_template($item, $index++);
        }
        return $string;
    }


    function categories_to_template($category, $index)
    {
        ob_start();
        include 'application/views/menu/menu_template.php';
        return ob_get_clean();
    }

    function previewajax()
    {

        if ($this->input->post('prew') == 1) {
            $newData = array(
                'prew' => 1,
            );
            $this->session->set_userdata('prew', $newData);
        } else {
            $newData = array(
                'prew' => 0,
            );
            $this->session->set_userdata('prew', $newData);
        }

        var_dump($this->session->userdata('prew'));
    }

}