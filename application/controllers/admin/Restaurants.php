<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Restaurants extends AdminController
{

    function __construct()
    {
        parent::__construct();
        if (!$this->_isLoggedIn()) {
            redirect(site_url('admin/admin/login'));
        }

        $this->pageData['mod'] = $this->tbl;
        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    var $tbl = 'restaurants';

    function restaurant_menu($id, $pageNum = 0)
    {

        $user = $this->session->userdata('user');


        if ($user->userrole != 'admin') {

            if ($id != $user->restaurant_id) {
                redirect(site_url("admin/restaurants/edit/{$user->restaurant_id}/0"));
            }

        }


        if (!$id) {
            redirect(site_url('admin/restaurants'));
        }
        $items = $this->mAdmin->GetRestaurantsMenuBySectionsId($id, array('class' => 'dd', 'id' => 'nestable'));
        $this->pageData['menu'] = $items;
        $this->pageData['id'] = $id;
        $this->pageData['current_view'] = "admin/$this->tbl/restaurant_menu/main";
        $this->pageData['pageNum'] = $pageNum;
        $this->_renderPage();
    }


    function restaurant_menu_add($section_id, $pageNum)
    {


        if ($user = $this->session->userdata('user')) {

            if ($user->userrole != 'admin') {

                if ($section_id != $user->restaurant_id) {
                    redirect(site_url("admin/restaurants/edit/{$user->restauran}/0"));
                } else {

                    redirect(site_url('admin/admin/login'));
                }
            }

        } else {

            redirect(site_url('admin/admin/login'));
        }

        if (isset($section_id)) {
            $this->form_validation->set_rules('status', 'Status', 'required');

            $data_menu['status'] = $this->input->post('status');
            $data_menu['section_id'] = $section_id;

            if ($this->input->post('pid') != 0) {

                $data_menu['pid'] = $this->input->post('pid');

            } else {

                $data_menu['pid'] = $section_id;

            }

            $data_menu['pos'] = $this->input->post('status');

            $this->load->model('restaurants_menu');
            $inserted_id = $this->restaurants_menu->add_blocks($data_menu);

            $langArr = $this->mLang->GetLangList();
            foreach ($langArr as $lang) {

                $data_menu_ml['id'] = $inserted_id;
                $data_menu_ml['lang'] = $lang->uid;
                $data_menu_ml['title'] = $this->input->post('title_' . $lang->uid);
                $this->restaurants_menu->add_block_menu($data_menu_ml);
            }
            redirect('admin/restaurants/restaurant_menu/' . $section_id . "/{$pageNum}");
        } else {


            redirect('admin/restaurants/restaurant_menu/' . $section_id . "/{$pageNum}");
        }


    }

    function restaurant_menu_edit($section_id, $id = 0, $pid = 0, $pageNum = 0)
    {


        $user = $this->session->userdata('user');


        if ($user->userrole != 'admin') {

            if ($section_id != $user->restaurant_id) {
                redirect(site_url("admin/restaurants/edit/{$user->restaurant_id}/0"));
            }

        }

        $admin_lang = $this->admin_lang;
        if (!$section_id) {
            exit('is not set Section ID');
        }

        $this->pageData['addEditor'] = true;
        $this->pageData['langArr'] = $langArr = $this->mLang->GetLangList();

        $this->form_validation->set_rules('status', 'Status', 'required');
        foreach ($langArr as $lang) {
            $this->form_validation->set_rules("title_$lang->uid", "Title ($lang->uid)", 'trim|required');
        }

        if ($id) {
            $Obj = $this->mAdmin->Get('restaurants_menu', $id, array('section_id' => $section_id));
            $ObjTMP = $this->mAdmin->GetML('restaurants_menu', $id);
            $ObjML = array();
            foreach ($ObjTMP as $item) {
                $ObjML[$item->lang] = $item;
            }
            $this->pageData['obj'] = $Obj;
            $this->pageData['objML'] = $ObjML;

        } else {
            $Obj = new stdClass();
            $ObjML = array();
            $this->pageData['obj'] = $Obj;
            $this->pageData['objML'] = $ObjML;
        }

        $_pid = ($pid) ? $pid : $section_id;
        $pid = ($this->input->post('pid', true)) ? $this->input->post('pid', true) : $_pid;

        if ($this->form_validation->run('') == TRUE) {
            $url = $this->input->post('url', true);
            $extUrl = is_extUrl($url);
            if (!$extUrl) {
                $url = clean_url($url);
            }

            $data = array(
                'status' => $this->input->post('status', true),
                'section_id' => $section_id,
                'show' => $this->input->post('show', true),
                'pid' => $pid,
                'cid' => $this->input->post('cid', true),
                'pos' => $this->input->post('pos', true),
                'url' => $url,
            );


            if ($id) {
                $this->mAdmin->Update('restaurants_menu', $data, $id);
            } else {
                $liId = $this->mAdmin->Insert('restaurants_menu', $data);
            }

            foreach ($langArr as $lang) {
                $dataML = array(

                    'title' => $this->input->post("title_$lang->uid"),
                );


//                    $dataML['searchfield'] = '';
//                    $searchfield = $dataML['title'];
//                    $searchfield = strip_tags($searchfield);
//                    $searchfield = str_replace('  ', ' ', $searchfield);
//                    $searchfield = str_replace('\r\n', '', $searchfield);
//                    if($data['url'] != '0'){
//                        $dataML['searchfield'] = $searchfield;
//                    }

                if ($id) {


                    $data_ml['id'] = $id;
                    $data_ml['lang'] = $lang->uid;
                    $data_ml['title'] = $dataML['title'];

                    $this->mAdmin->UpdateRestML($id, $data_ml, $lang->uid);

                } else {
                    $dataML["id"] = $liId;
                    $dataML["lang"] = $lang->uid;
                    $this->mAdmin->InsertML('restaurants_menu', $dataML);
                }
            }
            redirect('admin/restaurants/restaurant_menu/' . $section_id . "/{$pageNum}");
        }

        // get drop down menum
        $drawItems = '';
        $menus = $this->mAdmin->GetAllMenuML('restaurants_menu', $perPage = 0, $pageNum = 0, $where = 0, $admin_lang);
        $menuList = $this->_recursiveList($menus, 'pid', $section_id);
        $draw_disabled = '';
        if ($id) {
            $draw_disabled = 'disabled';
        }
        $drawItems = '<select name="pid" ' . $draw_disabled . ' class="select_menu">
							<option value="0">-' . $this->pageData['labels']->select . '-</option>
							' . $this->_printRecurseParentDropDown($menuList, 0, $pid) .
            '</select>';
        $this->pageData['menum_drop_down'] = $drawItems;

        // get sections
        $sections = array();
        $sectionsTmp = $this->mAdmin->GetAllRestaurants('restaurants');
        foreach ($sectionsTmp as $opt) {
            $sections[$opt->id] = $opt->title;
        }
        $this->pageData['sections'] = $sections;

        $contents = array();
        $contentTmp = $this->mAdmin->GetAllML('content');
        if ($contentTmp) {
            foreach ($contentTmp as $opt) {
                $contents[$opt->id] = $opt->title;
            }
        }
        $this->pageData['contents'] = $contents;

        $this->pageData['error_string'] = validation_errors();
        $this->pageData['sections'] = $sections;
        $this->pageData['section_id'] = $section_id;
        $this->pageData['id'] = $id;
        $this->pageData['pid'] = ($pid) ? $pid : $section_id;
        $this->pageData['pageNum'] = $pageNum;
        $this->load->model('admin/restaurants_menu_items_model');
        $list = $this->restaurants_menu_items_model->get_category_list($id);
        if ($list) {
            $this->pageData['menu_list'] = false;
        } else {

            $this->pageData['menu_list'] = true;
        }


        $this->pageData['current_view'] = "admin/{$this->tbl}/restaurant_menu/edit";
        $this->_renderPage();
    }


    function index($pageNum = 0, $q = 0)
    {

        $user = $this->session->userdata('user');


        if ($user->userrole != 'admin') {
            redirect(site_url("admin/restaurants/edit/{$user->restaurant_id}/0"));
        }


        $where = ($q) ? "`{$this->tbl}_ml.title` LIKE '%" . trim($q) . "%'" : 0;

        $data = array();
        $data['pageNum'] = $pageNum;
        $data['PerPage'] = 20;
        $data['NumLinks'] = 5;
        $data['uri_segment'] = 4;
        $data['base_url'] = site_url("admin/" . $this->tbl . "/index");
        $data['total_rows'] = $this->mAdmin->GetCount($this->tbl, $where);
        $data['items'] = $this->mAdmin->GetAllML($this->tbl, $data['PerPage'], $data['pageNum'], $where);
        $this->_pagination($data);

        $this->pageData['current_view'] = "admin/$this->tbl/main";
        $this->_renderPage();
    }

    function edit($id = 0, $pageNum = 0)
    {

//        redirect(site_url("admin/order_table_numbers"));
        $user = $this->session->userdata('user');


        if ($user->userrole != 'admin') {
            redirect(site_url("admin/order_table_numbers"));
            if ($id != $user->restaurant_id) {
                redirect(site_url("admin/restaurants/edit/{$user->restaurant_id}/0"));
            }
        }else{
            $this->pageData['admin'] = true;
        }


        $this->pageData['addEditor'] = true;

        $this->pageData['langArr'] = $langArr = $this->mLang->GetLangList();
        $this->form_validation->set_rules('status', 'Status', 'required');

        foreach ($langArr as $lang) {
            $this->form_validation->set_rules("title_$lang->uid", "Title ($lang->uid)", 'trim|required');
            $this->form_validation->set_rules("text_$lang->uid", "Text ($lang->uid)", 'trim');

        }

        $this->form_validation->set_rules("username", "username", 'trim|required|valid_email');
        if (!$id) {

            $this->form_validation->set_rules("password", "password", 'trim|required');
        } else {

            $this->form_validation->set_rules("password", "password", 'trim');
        }


        $Obj = new stdClass();
        $ObjML = array();
        $this->pageData['obj'] = $Obj;
        $this->pageData['objML'] = $ObjML;

        if ($id) {

            $Obj = $this->mAdmin->Get($this->tbl, $id);
            $ObjTMP = $this->mAdmin->GetML($this->tbl, $id);
            $ObjML = array();
            foreach ($ObjTMP as $item) {
                $ObjML[$item->lang] = $item;
            }
            $this->pageData['obj'] = $Obj;
            $this->pageData['objML'] = $ObjML;
        }
        $data = array();
        if ($this->form_validation->run('') == TRUE) {

            if ($id) {

                $this->load->model('admin/restaurants_model');
                $restaurant_id = $id;

                if (!empty($_FILES['logo_img']['tmp_name'])) {


                    $path_name = "./uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    $image_data_base_path = "uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    if (!is_dir($path_name)) {
                        @mkdir($path_name, 0755, true);
                    }
                    $this->load->helper("file");
                    unlink('./' . $image_data_base_path);
                    $config['upload_path'] = $path_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 1024;
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('logo_img')) {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        die;
                    }
                    $image_data = $this->upload->data();
                    $logo_img = $image_data_base_path . $image_data['file_name'];
                } else {

                    $logo_img = "";

                }
                if (!empty($_FILES['background_image']['tmp_name'])) {

                    $path_name = "./uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    $image_data_base_path = "uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    if (!is_dir($path_name)) {
                        @mkdir($path_name, 0755, true);
                    }
                    $this->load->helper("file");
                    unlink('./' . $Obj->item_image);
                    $config['upload_path'] = $path_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 10240;
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('background_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        die;
                    }
                    $image_data = $this->upload->data();
                    $background_image = $image_data_base_path . $image_data['file_name'];
                } else {

                    $background_image = "";
                }

                if (!empty($background_image)) {

                    $data['background_image'] = $background_image;
                }
                if (!empty($logo_img)) {

                    $data['logo_img'] = $logo_img;
                }


                $data += array(
                    'status' => $this->input->post('status', true),
                    'header_icons' => $this->input->post('header_icons', true),
                    'menu_scrolling_bar' => $this->input->post('menu_scrolling_bar', true),
                    'menu_link' => $this->input->post('menu_link', true),
                    'menu_link_active' => $this->input->post('menu_link_active', true),
                    'product_menu' => $this->input->post('product_menu', true),
                    'site_link' => $this->input->post('site_link', true),
                    'site_text' => $this->input->post('site_text', true),
                    'heading_title' => $this->input->post('heading_title', true),
                    'product_menu_heading_title' => $this->input->post('product_menu_heading_title', true),
                    'product_menu_active' => $this->input->post('product_menu_active', true),
                    'header' => $this->input->post('header', true),
                    'home_content_title_color' => $this->input->post('home_content_title_color', true),
                    'username' => $this->input->post('username', true),
                    'url' => $this->input->post('url', true),
                );

                if ($this->input->post('password', true)) {

                    $password = $this->input->post('password', true);
                    $data['password'] = sha1($password);
                }


                $this->restaurants_model->insert_restaurant($restaurant_id, $data);
                $liId = $restaurant_id;


                $restoUserData = array('email' => $this->input->post('username', true));
                if ($this->input->post('password', true)) {
                    $password = $this->input->post('password', true);
                    $restoUserData['password'] = sha1($password);
                }

                $this->restaurants_model->restaurantUser($restoUserData, $restaurant_id);

            } else {

                $this->load->model('admin/restaurants_model');
                $data['status'] = $this->input->post('status');
                $restaurant_id = $this->restaurants_model->insert_status($data);

                if (!empty($_FILES['logo_img']['tmp_name'])) {


                    $path_name = "./uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    $image_data_base_path = "uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    if (!is_dir($path_name)) {
                        @mkdir($path_name, 0755, true);
                    }
                    $config['upload_path'] = $path_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 1024;
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('logo_img')) {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        die;
                    }
                    $image_data = $this->upload->data();
                    $logo_img = $image_data_base_path . $image_data['file_name'];
                } else {

                    $logo_img = "";

                }
                if (!empty($_FILES['background_image']['tmp_name'])) {

                    $path_name = "./uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    $image_data_base_path = "uploads/restaurants/{$restaurant_id}/restaurant_images/";
                    if (!is_dir($path_name)) {
                        @mkdir($path_name, 0755, true);
                    }

                    $config['upload_path'] = $path_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 10240;
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('background_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        die;
                    }
                    $image_data = $this->upload->data();
                    $background_image = $image_data_base_path . $image_data['file_name'];
                } else {

                    $background_image = "";
                }

                if (!empty($background_image)) {

                    $data['background_image'] = $background_image;
                }
                if (!empty($logo_img)) {

                    $data['logo_img'] = $logo_img;
                }

                $data += array(
                    'status' => $this->input->post('status', true),
                    'header_icons' => $this->input->post('header_icons', true),
                    'menu_scrolling_bar' => $this->input->post('menu_scrolling_bar', true),
                    'menu_link' => $this->input->post('menu_link', true),
                    'menu_link_active' => $this->input->post('menu_link_active', true),
                    'product_menu' => $this->input->post('product_menu', true),
                    'site_link' => $this->input->post('site_link', true),
                    'site_text' => $this->input->post('site_text', true),
                    'heading_title' => $this->input->post('heading_title', true),
                    'product_menu_heading_title' => $this->input->post('product_menu_heading_title', true),
                    'product_menu_active' => $this->input->post('product_menu_active', true),
                    'header' => $this->input->post('header', true),
                    'home_content_title_color' => $this->input->post('home_content_title_color', true),
                    'username' => $this->input->post('username', true),
                    'url' => $this->input->post('url', true),

                );
                if ($this->input->post('password', true)) {

                    $password = $this->input->post('password', true);
                    $data['password'] = sha1($password);
                }

                $this->restaurants_model->insert_restaurant($restaurant_id, $data);
                $liId = $restaurant_id;


                $restoUserData = array(
                    'userrole' => 'client',
                    'restaurant_id' => $liId,
                    'email' => $this->input->post('username', true),
                    'password' => sha1($this->input->post('password', true)),
                    'first_name' => '',
                    'last_name' => '',
                );

                if ($liId) {
                    $this->restaurants_model->insertRestaurantUser($restoUserData, $liId);
                }

            }

            foreach ($langArr as $lang) {
                $dataML = array(
                    'title' => $this->input->post("title_$lang->uid", true),
                    'text' => $this->input->post("text_$lang->uid"),
                );

                $searchfield = $dataML['title'] . " " . $dataML['text'];
                $searchfield = strip_tags($searchfield);
                $searchfield = str_replace('  ', ' ', $searchfield);
                $searchfield = str_replace('\r\n', '', $searchfield);

                $dataML['searchfield'] = $searchfield;

                if ($id) {

                    $items = "id, lang, title, text, searchfield";
                    $values = $id . ', 
									\'' . $lang->uid . '\', 
									\'' . addslashes($dataML['title']) . '\', 
									\'' . addslashes($dataML['text']) . '\',
									\'' . addslashes($dataML['searchfield']) . "'";
                    $this->mAdmin->UpdateML($this->tbl, $items, $values);
                } else {
                    $dataML["id"] = $liId;
                    $dataML["lang"] = $lang->uid;
                    $this->mAdmin->InsertML($this->tbl, $dataML);
                }

            }
            redirect("admin/{$this->tbl}/index/{$pageNum}");
        }

        $this->pageData['error_string'] = validation_errors();
        $this->pageData['pageNum'] = $pageNum;
        $this->pageData['id'] = $id;

        $this->pageData['current_view'] = "admin/{$this->tbl}/edit";
        $this->_renderPage();
    }

    function restaurants_menu_toggle($section_id, $id, $pageNum)
    {
        $this->mAdmin->Toggle('restaurants_menu', $id);
        redirect("admin/{$this->tbl}/restaurant_menu/{$section_id}/{$pageNum}");
    }


    function remove($id, $pageNum = 0)
    {
        $this->mAdmin->RemoveML($this->tbl, $id);
        $this->mAdmin->Remove($this->tbl, $id);
        redirect("admin/{$this->tbl}/index/{$pageNum}");
    }

    function remove_menu($section_id, $id, $pageNum = 0)
    {
        $this->mAdmin->RemoveML('restaurants_menu', $id);
        $this->mAdmin->Remove('restaurants_menu', $id);
        redirect("admin/{$this->tbl}/restaurant_menu/{$section_id}/{$pageNum}");
    }


    function products_list($section_id, $restaurants_menu_id, $pid, $pageNum)
    {


        $user = $this->session->userdata('user');
        if ($user->userrole != 'admin') {

            if ($section_id != $user->restaurant_id) {
                redirect(site_url("admin/restaurants/edit/{$user->restaurant_id}/0"));
            }

        }

        if (isset($restaurants_menu_id) && isset($pageNum)) {
            $this->load->model('admin/restaurants_menu_items_model');
            $result = $this->restaurants_menu_items_model->get_category_items($restaurants_menu_id);

            $this->pageData['items'] = $result;
            $this->pageData['restaurants_menu_id'] = $restaurants_menu_id;
            $this->pageData['section_id'] = $section_id;
            $this->pageData['pid'] = $pid;
            $this->pageData['current_view'] = "admin/$this->tbl/products_list/main";
            $this->_renderPage();

        } else {

            redirect('admin/restaurants_menu');
        }
    }


    function edit_product($section_id, $id, $restaurants_menu_id, $pid, $pageNum = 0)
    {


        $user = $this->session->userdata('user');


        if ($user->userrole != 'admin') {

            if ($section_id != $user->restaurant_id) {
                redirect(site_url("admin/restaurants/edit/{$user->restaurant_id}/0"));
            }

        }

        $this->pageData['addEditor'] = true;
        $this->pageData['section_id'] = $section_id;
        $this->pageData['langArr'] = $langArr = $this->mLang->GetLangList();
        $this->form_validation->set_rules('status', 'Status', 'required');

        $this->form_validation->set_rules("price", "Price", 'trim|required');

        foreach ($langArr as $lang) {
            $this->form_validation->set_rules("title_$lang->uid", "Title ($lang->uid)", 'trim|required');
            $this->form_validation->set_rules("compound_$lang->uid", "Compound ($lang->uid)", 'trim');
        }
        $Obj = new stdClass();
        $ObjML = array();
        $this->pageData['obj'] = $Obj;
        $this->pageData['objML'] = $ObjML;

        if ($id) {
            $Obj = $this->mAdmin->Get('restaurants_menu_items', $id);
            $ObjTMP = $this->mAdmin->GetML('restaurants_menu_items', $id);
            $ObjML = array();
            foreach ($ObjTMP as $item) {
                $ObjML[$item->lang] = $item;
            }
            $this->pageData['obj'] = $Obj;
            $this->pageData['objML'] = $ObjML;
        }

        if ($this->input->post()) {


            if ($id) {


                if (!empty($_FILES['userfile']['tmp_name'])) {

                    $path_name = "./uploads/restaurants/{$section_id}/products/{$restaurants_menu_id}/";
                    $image_data_base_path = "uploads/restaurants/{$section_id}/products/{$restaurants_menu_id}/";
                    if (!is_dir($path_name)) {
                        @mkdir($path_name, 0755, true);
                    }
                    $this->load->helper("file");
                    unlink(FCPATH . '/' . $Obj->item_image);
                    $config['upload_path'] = $path_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 1024;
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload()) {
                        $error = array('error' => $this->upload->display_errors());

                        var_dump($error);
                        die;
                    }
                    $image_data = $this->upload->data();
                    $item_image = $image_data_base_path . $image_data['file_name'];

                } else {

                    $item_image = "";
                }

                $this->load->model('/admin/restaurants_menu_items_model');
                if (!empty($item_image)) {

                    $data['item_image'] = $item_image;
                }
                $data['status'] = $this->input->post('status');
                $data['pos'] = $this->input->post('pos');

                $this->restaurants_menu_items_model->update_item($data, $id);

                $langArr = $this->mLang->GetLangList();
                foreach ($langArr as $lang) {


                    $data_ml['restaurants_menu_id'] = $this->input->post('restaurants_menu_id');
                    $data_ml['title'] = $this->input->post("title_{$lang->uid}");
                    $data_ml['id'] = $id;
                    $data_ml['lang'] = $lang->uid;
                    $data_ml['compound'] = $this->input->post("compound_{$lang->uid}");
                    $data_ml['price'] = $this->input->post("price");
                    $data_ml['desc'] = $this->input->post("desc_{$lang->uid}");

                    $this->restaurants_menu_items_model->update_item_ml($data_ml, $id);

                }
                redirect("admin/restaurants/products_list/{$section_id}/{$restaurants_menu_id}/{$pid}/{$pageNum}");

            } else {


                if (!empty($_FILES['userfile']['tmp_name'])) {

                    $path_name = "./uploads/restaurants/{$section_id}/products/{$restaurants_menu_id}/";
                    $image_data_base_path = "uploads/restaurants/{$section_id}/products/{$restaurants_menu_id}/";
                    if (!is_dir($path_name)) {
                        @mkdir($path_name, 0755, true);
                    }

                    $config['upload_path'] = $path_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 1024;
                    $config['encrypt_name'] = true;
                    $config['remove_spaces'] = true;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload()) {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        die;
                    }
                    $image_data = $this->upload->data();
                    $item_image = $image_data_base_path . $image_data['file_name'];

                } else {

                    $item_image = "";
                }

                $this->load->model('/admin/restaurants_menu_items_model');

                $data['status'] = $this->input->post('status');
                $data['pos'] = $this->input->post('pos');
                if (!empty($item_image)) {

                    $data['item_image'] = $item_image;
                }

                $inserted_id = $this->restaurants_menu_items_model->insert_item($data);
                $langArr = $this->mLang->GetLangList();

                foreach ($langArr as $lang) {


                    $data_ml['restaurants_menu_id'] = $this->input->post('restaurants_menu_id');
                    $data_ml['title'] = $this->input->post("title_{$lang->uid}");
                    $data_ml['lang'] = $lang->uid;
                    $data_ml['id'] = $inserted_id;
                    $data_ml['compound'] = $this->input->post("compound_{$lang->uid}");
                    $data_ml['price'] = $this->input->post("price");
                    $data_ml['desc'] = $this->input->post("desc_{$lang->uid}");


                    $this->restaurants_menu_items_model->insert_item_ml($data_ml);

                }
                redirect("admin/restaurants/products_list/{$section_id}/{$restaurants_menu_id}/{$id}/{$pid}/{$pageNum}");
            }

        }
        $this->pageData['error_string'] = validation_errors();
        $this->pageData['pageNum'] = $pageNum;
        $this->pageData['id'] = $id;
        $this->pageData['pid'] = $pid;
        $this->pageData['restaurants_menu_id'] = $restaurants_menu_id;


        $restaurantMenuList = $this->db->query("SELECT * FROM restaurants_menu INNER JOIN restaurants_menu_ml ON restaurants_menu.id = restaurants_menu_ml.id AND restaurants_menu_ml.lang = 'en' WHERE section_id = {$section_id}");
        $this->pageData['restaurantMenuList'] = $restaurantMenuList->result();


        $this->pageData['current_view'] = "admin/{$this->tbl}/products_list/edit";
        $this->_renderPage();

    }

    function toggle($id, $pageNum = 0)
    {

        $this->mAdmin->Toggle('restaurants', $id);
        redirect("admin/restaurants");
    }

    function product_toggle($section_id, $restaurants_menu_id, $pid, $pageNum = 0, $id)
    {

        $this->mAdmin->Toggle('restaurants_menu_items', $id);
        redirect("admin/restaurants/products_list/{$section_id}/{$restaurants_menu_id}/{$pid}/{$pageNum}");
    }

    function product_remove($section_id, $restaurants_menu_id, $pid, $pageNum = 0, $id)
    {

        $this->mAdmin->RemoveML('restaurants_menu_items', $id);
        $this->mAdmin->Remove('restaurants_menu_items', $id);
        redirect("admin/restaurants/products_list/{$section_id}/{$restaurants_menu_id}/{$pid}/{$pageNum}");
    }

    function deleteimage()
    {


        $this->load->model('admin/restaurants_model');

        unlink('./' . $this->input->post('path'));
        $id = $this->input->post('id');
        $row = $this->input->post('row');
        if ($row == 'logo_img') {
            $data['logo_img'] = NULL;
        } else if ($row == 'background_image') {
            $data['background_image'] = NULL;
        } else if ($row == 'item_image') {
            $data['item_image'] = NULL;
            $this->restaurants_model->update_restaurant_menu_item_images($id, $data);
        } else {

            $this->restaurants_model->update_restaurant_images($id, $data);
        }


        return true;
    }
}