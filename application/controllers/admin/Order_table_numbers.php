<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Order_table_numbers extends AdminController
{

    var $tbl = 'order_table_numbers';

    function __construct()
    {
        parent::__construct();
        if (!$this->_isLoggedIn()) {
            redirect(site_url('admin/admin/login'));
        }
        $this->pageData['mod'] = $this->tbl;
        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    function index($pageNum = 0)
    {
        $where = array('restaurant_id' => $this->userData->restaurant_id);

        $data = array();
        $bill = array();
        $garcon = array();
        $data['pageNum'] = $pageNum;
        $data['PerPage'] = 10000;
        $data['NumLinks'] = 5;
        $data['uri_segment'] = 4;
        $data['base_url'] = site_url("admin/" . $this->tbl . "/index");
        $data['total_rows'] = $this->mAdmin->GetCount($this->tbl, $where);
        $data_all = $this->mAdmin->GetAllArm($this->tbl, $data['PerPage'], $data['pageNum'], $where, ['push_date'=>'DESC']);
        $data['items'] = $data_all;
        foreach ($data_all as $d) {
            if ($d->bill_status == 1) {
                array_push($bill, $d);
            } else {
                array_push($garcon, $d);
            }
        }


        $GLOBALS['newBill'] = array();
        array_map(function($e){
            $GLOBALS['newBill'];
            $e = (array)$e;
            $nk = array_search($e['table_number'], array_column($GLOBALS['newBill'], 'table_number'));
            if(is_integer($nk)) $GLOBALS['newBill'][$nk]['count'] +=1;
            else {
                $e['count'] = 1;
                $GLOBALS['newBill'][] = $e;
            }
        },$bill);

        $bill = array_map(function ($e){
            return (object)$e;
        },$GLOBALS['newBill']);


        $GLOBALS['newGarcon'] = array();
        array_map(function($e){
            $GLOBALS['newGarcon'];
            $e = (array)$e;
            $nk = array_search($e['table_number'], array_column($GLOBALS['newGarcon'], 'table_number'));
            if(is_integer($nk)) $GLOBALS['newGarcon'][$nk]['count'] +=1;
            else {
                $e['count'] = 1;
                $GLOBALS['newGarcon'][] = $e;
            }
        },$garcon);

        $garcon = array_map(function ($e){
            return (object)$e;
        },$GLOBALS['newGarcon']);


        $this->pageData['bill'] = $bill;
        $this->pageData['garcon'] = $garcon;
        $this->_pagination($data);

        $this->pageData['current_view'] = "admin/$this->tbl/main";
        $this->_renderPage();
    }

    function remove($id, $pageNum = 0)
    {
        $this->mAdmin->Remove($this->tbl, $id);
        redirect("admin/{$this->tbl}/index/{$pageNum}");
    }

    function export()
    {
        $this->mAdmin->Export('subscribers', array('id', 'email'));
    }
}