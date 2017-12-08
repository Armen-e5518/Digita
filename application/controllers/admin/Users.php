<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Users extends AdminController
{

    var $tbl = 'restaurant_users';

    function __construct() {
        parent::__construct();
        if(!$this->_isLoggedIn()){ redirect(site_url('admin/admin/login')); }
        $this->pageData['mod'] = $this->tbl;
        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    function index($pageNum=0, $q=0){

        $this->load->model('admin/users_model');
        $items = $this->users_model->get_users();


        $this->pageData['items']	 =  $items;
        $this->pageData['current_view']	= "admin/users/main";
        $this->_renderPage();
    }

    function edit($id=0, $pageNum=0){
        $this->load->model('admin/users_model');
        $this->pageData['addEditor']= true;

        $this->pageData['langArr']= $langArr = $this->mLang->GetLangList();
        $this->form_validation->set_rules('status', 'Status', 'required');


            $this->form_validation->set_rules("username", "username", 'trim|required');
            $this->form_validation->set_rules("password", "password", 'trim|required');

        $Obj	= new stdClass();
        $ObjML	= array();
        $this->pageData['obj'] 		= $Obj;
        $this->pageData['objML']	= $ObjML;

        if($id){
            $Obj	= $this->mAdmin->Get($this->tbl, $id);
            $this->pageData['obj'] 		= $Obj;
        }
        if($this->input->post()){

            if ($this->form_validation->run('') == TRUE) {


                if($id){

                    $data['username'] = $this->input->post('username');
                    $data['password'] = $this->input->post('password');
                    $data['status'] = $this->input->post('status');
                    $data['restaurant_id'] = $this->input->post('restaurants');

                    $this->users_model->update_user($data, $id);

                } else {

                    $data['username'] = $this->input->post('username');
                    $data['password'] = $this->input->post('password');
                    $data['status'] = $this->input->post('status');
                    $data['restaurant_id'] = $this->input->post('restaurants');

                    $this->users_model->insert_user($data);
                }


                redirect("admin/users/index/{$pageNum}");
        }

        }

        $this->pageData['restaurants'] = $this->users_model->get_restaurants();
        $this->pageData['error_string']	 = validation_errors();
        $this->pageData['pageNum'] 	= $pageNum;
        $this->pageData['id']		= $id;
        $this->pageData['user']		= $this->users_model->get_user($id);

        $this->pageData['current_view']    = "admin/users/edit";
        $this->_renderPage();
    }

    function toggle($id, $pageNum=0) {
        $this->mAdmin->Toggle($this->tbl, $id);
        redirect("admin/users/index/{$pageNum}");
    }

    function remove($id, $pageNum=0) {
        $this->mAdmin->Remove($this->tbl, $id);
        redirect("admin/users/index/{$pageNum}");
    }

}