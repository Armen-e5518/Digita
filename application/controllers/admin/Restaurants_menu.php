<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Restaurants_menu extends Admincontroller
{


    var $tbl = 'restaurants_menu';

    function __construct()
    {
        parent::__construct();
        if (!$this->_isLoggedIn()) {
            redirect(site_url('admin/admin/login'));
        }
        $this->pageData['mod'] = $this->tbl;
        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    public function create_menu($data)
    {
        $tree = (object)array();
        foreach ($data as $id => &$node) {
            if ($node->parent_id == 0) {
                $tree->id = &$node;
            } else {
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    function index($pageNum = 0, $q = 0)
    {


        $this->load->model('admin/restaurants_menu_model');
        $result = $this->restaurants_menu_model->get_restaurants();
        $this->pageData['items'] = $result;

        $this->pageData['current_view'] = "admin/$this->tbl/main";
        $this->_renderPage();


    }

    function get_menu_category($restaurant_id, $pageNum)
    {

        if (isset($restaurant_id) && isset($pageNum)) {
            //var_dump($q);die;
            $this->load->model('admin/restaurants_menu_model');
            $result = $this->restaurants_menu_model->get_menu_category($restaurant_id);

            $this->pageData['items'] = $result;

            var_dump($result);
            $this->pageData['current_view'] = "admin/$this->tbl/menu_categories";
            $this->_renderPage();
        } else {

            redirect('admin/restaurants_menu');
        }
    }


    function get_category_group($category_id, $pageNum)
    {
        if (isset($category_id) && isset($pageNum)) {

            $this->load->model('admin/restaurants_menu_model');
            $result = $this->restaurants_menu_model->get_category_group($category_id);

            $this->pageData['items'] = $result;

            var_dump($result);
            $this->pageData['current_view'] = "admin/$this->tbl/category_croup";
            $this->_renderPage();

        }else{

            redirect('admin/restaurants_menu');
        }

    }

    function get_category_items($category_id, $pageNum)
    {
        if (isset($category_id) && isset($pageNum)) {

            $this->load->model('admin/restaurants_menu_model');
            $result = $this->restaurants_menu_model->get_category_items($category_id);

            $this->pageData['items'] = $result;

            var_dump($result);
            $this->pageData['current_view'] = "admin/$this->tbl/category_croup";
            $this->_renderPage();

        }else{

            redirect('admin/restaurants_menu');
        }

    }
}