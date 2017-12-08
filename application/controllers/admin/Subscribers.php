<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Subscribers extends AdminController
{

    var $tbl = 'subscribers';

    function __construct()
    {
        parent::__construct();
        if (!$this->_isLoggedIn()) {
            redirect(site_url('admin/admin/login'));
        }
        $this->pageData['mod'] = $this->tbl;
        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    function index($pageNum = 0, $q = 0)
    {
        $where = ($q) ? "`{$this->tbl}_ml.title` LIKE '%" . trim($q) . "%'" : 0;

        $data = array();
        $data['pageNum'] = $pageNum;
        $data['PerPage'] = 20;
        $data['NumLinks'] = 5;
        $data['uri_segment'] = 4;
        $data['base_url'] = site_url("admin/" . $this->tbl . "/index");
        $data['total_rows'] = $this->mAdmin->GetCount($this->tbl, $where);
        $data['items'] = $this->mAdmin->GetAll1($this->tbl, $data['PerPage'], $data['pageNum'], $where);
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