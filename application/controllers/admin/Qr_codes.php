<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Qr_codes extends AdminController
{

    var $tbl = 'qr';

    function __construct()
    {
        parent::__construct();
        if (!$this->_isLoggedIn()) {
            redirect(site_url('admin/admin/login'));
        }
        $this->pageData['mod'] = $this->tbl;
//        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    function index()
    {
        $count = null;
        $restaurant_id = null;
        if (!empty($this->input->get('count')) && is_numeric($this->input->get('count'))) {
            $this->load->model('admin/restaurants_model');
            $count = $this->input->get('count');
            $QR = [];
            $api_qr = $this->config->item('settings')['QrUrl'];
            $url = $this->config->base_url();
            $user = $this->session->userdata('user');
            if(!empty($this->input->get('id'))){
                $restaurant_id = $this->input->get('id');
            }else{
                $restaurant_id = $user->restaurant_id;
            }
//print_r($user->restaurant_id);exit;
            $slag = $this->restaurants_model->get_restaurants_by_id($restaurant_id) ;
//            print_r($slag);exit;
            $slag = $slag[0]->url;
            for ($i = 1; $i <= $count; $i++) {
                $ob = new stdClass();
                $ob->qr = $api_qr . $url . $slag . '/' . $i;
                $ob->url = $url . $slag . '/' . $i;
                array_push($QR, $ob);
            }
            $this->pageData['qrs'] = $QR;
        }
        if (!empty($this->input->get('id'))){
            $restaurant_id = $this->input->get('id');
        }
        $this->pageData['count'] = $count;
        $this->pageData['restaurant_id'] = $restaurant_id;
        $this->pageData['current_view'] = "admin/$this->tbl/main";
        $this->_renderPage();
    }

}