<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Settings extends AdminController {
	
	var $tbl = 'settings';
	
	function __construct() {
		parent::__construct();
		if(!$this->_isLoggedIn()){ redirect(site_url('admin/admin/login')); }
		if($user = $this->session->userdata('user')){

			$rest_id = $user->restaurant_id;

			if($user->userrole != 'admin'){
				redirect(site_url("admin/restaurants/edit/{$rest_id}/0"));
			}

		}else{

			redirect(site_url('admin/admin/login'));
		}
		$this->pageData['mod'] = $this->tbl;
		$this->pageData['selected_menu_item'] = $this->tbl;
	}
	
	function index($pageNum=0, $q=0){
		$itemsTmp = $this->mAdmin->GetAll($this->tbl);		
		$items= array();
		if(isset($itemsTmp) && !empty($itemsTmp)){
			foreach($itemsTmp as $val){
				$items[$val->type][] = $val;
			}
		}
		
		$this->pageData['items'] = $items;
		$this->pageData['current_view']	= "admin/$this->tbl/main";
		$this->_renderPage();
	}
		
	function edit($id=0, $pageNum=0){
		$this->pageData['addEditor'] = true;
		$this->_addScript('js/jquery.validate.pack.js');

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
	
		if($id){
			$Obj	= $this->mAdmin->Get($this->tbl, $id);
			$this->pageData['obj'] 		= $Obj;
		} else {
			$Obj	= new stdClass();
			$this->pageData['obj'] 		= $Obj;			
		}
		
		if ($this->form_validation->run('') == TRUE) {
			$SettingsStripTagsIds = $this->settings['SettingsStripTagsIds'];
			$id = $this->input->post('id');
			$value = $this->input->post('value');
			if(in_array($id, $SettingsStripTagsIds)){
				$value = strip_tags($value);
			}
			$data = array(
				'status' => $this->input->post('status',true),
				'name' 	 => $this->input->post('name', true),
				'value'	 => $value 
			);

			if($id){
				$this->mAdmin->Update($this->tbl, $data, $id);	
			} else {
			
				$liId = $this->mAdmin->Insert($this->tbl, $data);
			}
			redirect("admin/{$this->tbl}/index/{$pageNum}");
		}

		$this->pageData['error_string']	 = validation_errors();
		$this->pageData['pageNum'] 		 = $pageNum;
		$this->pageData['id']			 = $id;
		
		$this->pageData['current_view']  = "admin/{$this->tbl}/edit";
		$this->_renderPage();
	}
	
	function toggle($id) {
        $this->mAdmin->Toggle($this->tbl, $id);
        redirect("admin/{$this->tbl}/index");
    }
}