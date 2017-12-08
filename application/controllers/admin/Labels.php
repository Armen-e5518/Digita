<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Labels extends AdminController
{

    var $tbl = 'labels';

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
        $where = ($q) ? "`{$this->tbl}_ml.text` LIKE '%" . trim($q) . "%'" : 0;

        $data = array();
        $data['pageNum'] = $pageNum;
        $data['PerPage'] = 20;
        $data['NumLinks'] = 5;
        $data['uri_segment'] = 4;
        $data['base_url'] = site_url("admin/" . $this->tbl . "/index");
        $data['total_rows'] = $this->mAdmin->GetCountMl($this->tbl, $where);
        $data['items'] = $this->mAdmin->GetAllML($this->tbl, $data['PerPage'], $data['pageNum'], $where);
        $this->_pagination($data);

        $this->pageData['q'] = $q;

        $this->pageData['current_view'] = "admin/$this->tbl/main";
        $this->_renderPage();
    }

    function edit($id = 0, $pageNum = 0)
    {
        $this->pageData['addEditor'] = true;

        $this->pageData['langArr'] = $langArr = $this->mLang->GetLangList();

        $this->form_validation->set_rules('key', 'Key', 'required');
        foreach ($langArr as $lang) {
            $this->form_validation->set_rules("text_$lang->uid", "Text ($lang->uid)", 'trim');
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


        if ($this->form_validation->run('') == TRUE) {
            $checkLabelByKey = $this->mAdmin->GetWhere($this->tbl, array('key' => $this->input->post('key', true)));

            if ((!$id && empty($checkLabelByKey)) || ($id && !empty($checkLabelByKey))) {

                $data = array(
                    'key' => $this->input->post('key', true),
                    'type' => $this->input->post('type', true),
                );

                if ($id) {
                    $this->mAdmin->Update($this->tbl, $data, $id);
                } else {
                    $liId = $this->mAdmin->Insert($this->tbl, $data);
                }

                foreach ($langArr as $lang) {
                    $dataML = array(
                        'text' => $this->input->post("text_$lang->uid"),
                    );

                    if ($id) {
                        $items = "id, lang, text";
                        $values = $id . ', 
									\'' . $lang->uid . '\', 
									\'' . $dataML['text'] . "'";

                        $this->mAdmin->UpdateML($this->tbl, $items, $values);
                    } else {
                        $dataML["id"] = $liId;
                        $dataML["lang"] = $lang->uid;
                        $this->mAdmin->InsertML($this->tbl, $dataML);
                    }

                }

                redirect("admin/{$this->tbl}/index/{$pageNum}");
            } else {
                $this->pageData['label_exist_msg'] = $this->pageData['labels']->label_exist_msg;
            }
        }

        $this->pageData['error_string'] = validation_errors();
        $this->pageData['pageNum'] = $pageNum;
        $this->pageData['id'] = $id;

        $this->pageData['current_view'] = "admin/{$this->tbl}/edit";
        $this->_renderPage();
    }

    function toggle($id, $pageNum = 0)
    {
        die('hello!');
        $this->mAdmin->Toggle($this->tbl, $id);
        redirect("admin/{$this->tbl}/index/{$pageNum}");
    }

    function remove($id, $pageNum = 0)
    {
        die('hello!');
        $this->mAdmin->RemoveML($this->tbl, $id);
        $this->mAdmin->Remove($this->tbl, $id);
        redirect("admin/{$this->tbl}/index/{$pageNum}");
    }
}