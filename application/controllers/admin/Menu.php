<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');
class Menu extends AdminController {
    var $tbl = 'menu';
    function __construct()  {
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
		
        $this->pageData['mod'] 				  = $this->tbl;
        $this->pageData['selected_menu_item'] = $this->tbl;
    }

    function index() {
        $this->sections();
    }

    function sections() {        
        $this->pageData['pageNum'] = 0;
        $this->pageData['items'] = $this->mAdmin->GetAll("menu_sections");
        $this->pageData['current_view'] = "admin/{$this->tbl}/section_list";
        $this->_renderPage();
    }

    function opensection($id) {
		if(!$id){redirect(site_url('admin/menu')); }		
		$items = $this->mAdmin->GetMenuBySectionsId($id, array('class'=>'dd','id'=>'nestable'));
		$this->pageData['menu']		= $items;
		$this->pageData['id']		= $id;
		$this->pageData['current_view']	= "admin/$this->tbl/main";
        $this->_renderPage();
    }

	function edit($section_id, $id=0, $pid=0){
		
		$admin_lang = $this->admin_lang;
		if(!$section_id){ exit('is not set Section ID'); }

		$this->pageData['addEditor'] = true;			
		$this->pageData['langArr'] = $langArr = $this->mLang->GetLangList();
	
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('section_id', 'Section', 'required');
		$this->form_validation->set_rules('url', 'url', 'trim|required'); // callback_urlUnique
		foreach ($langArr as $lang){					
			$this->form_validation->set_rules("title_$lang->uid", "Title ($lang->uid)", 'trim|required');
		}
		
		if($id){
			$Obj	= $this->mAdmin->Get($this->tbl, $id, array('section_id' => $section_id));
			$ObjTMP = $this->mAdmin->GetML($this->tbl, $id);
			$ObjML = array();
			foreach ($ObjTMP as $item){
				$ObjML[$item->lang] = $item;
			}			
			$this->pageData['obj'] = $Obj;
			$this->pageData['objML'] = $ObjML;
			
		} else {			
			$Obj	= new stdClass();
			$ObjML	= array();
			$this->pageData['obj'] = $Obj;			
			$this->pageData['objML'] = $ObjML;
		}

		$_pid  = ($pid) ? $pid : $section_id;
		$pid   = ($this->input->post('pid',true)) ? $this->input->post('pid',true) : $_pid;
			
		if($this->form_validation->run('') == TRUE) {
			$url 	= $this->input->post('url', true);			
			$extUrl = is_extUrl($url);
			if(!$extUrl){ $url = clean_url($url); }
		
			$data = array(
				'status'		=> $this->input->post('status',true),				
				'section_id'	=> $section_id,
				'show'			=> $this->input->post('show',true),	
				'pid'			=> $pid,
				'cid'			=> $this->input->post('cid',true),	
				'pos'			=> $this->input->post('pos',true),
				'url'			=> $url,
			); 		
			
			if(!empty($_FILES['img']['tmp_name'])){
				$tmp		= $_FILES["img"]["tmp_name"];
				$tmp_name	= $_FILES['img']['name'];
				$ex 		= explode('.', $tmp_name);
				$name 		= rand_value() .'.'. end($ex);
				
				$path 			= $this->config->item('fileServerPath');
				$upload_path 		= $path . $this->tbl .'/';
				if(!is_dir($upload_path)) { @mkdir($upload_path, 0755, true); }					
				$moved = move_uploaded_file($tmp, $upload_path . $name);					
				if($moved) {
					if($id){ $this->_deleteFile($Obj->img, $this->tbl); }
					$data['img'] = $name;
				} 
			}
			
			if($id){	
				$this->mAdmin->Update($this->tbl, $data, $id);
			} else {				
				$liId = $this->mAdmin->Insert($this->tbl, $data);
			}
			
			foreach ($langArr as $lang){
				$dataML = array(					
					'meta_title'	=> $this->input->post("meta_title_$lang->uid", true),
					'meta_desc'		=> $this->input->post("meta_desc_$lang->uid", true),
					'title'			=> $this->input->post("title_$lang->uid"),
				);	


				$dataML['searchfield'] = '';
				$searchfield = $dataML['meta_title'] ." ". $dataML['meta_desc']." ".$dataML['title'];
				$searchfield = strip_tags($searchfield);
				$searchfield = str_replace('  ', ' ', $searchfield);
				$searchfield = str_replace('\r\n', '', $searchfield);
				if($data['url'] != '0'){
					$dataML['searchfield'] = $searchfield;
				}

				if($id){
					$items = "`id`, `lang`, `meta_title`, `meta_desc`,`title`,`searchfield`";
					$values = $id.', 
								\''.$lang->uid.'\', 
								\''.($dataML['meta_title']).'\', 							
								\''.($dataML['meta_desc']).'\', 							
								\''.($dataML['title']).'\', 							
								\''.($dataML['searchfield'])."'";
					
					$this->mAdmin->UpdateML($this->tbl, $items, $values);
					
				} else {
					$dataML["id"]	= $liId;
					$dataML["lang"] = $lang->uid;
					$this->mAdmin->InsertML($this->tbl, $dataML);
				}			
			}
			redirect("admin/{$this->tbl}/opensection/{$section_id}");
		}
	
	// get drop down menum
		$drawItems	='';
		$menus 		= $this->mAdmin->GetAllML('menu', $perPage=0, $pageNum=0, $where=0, $admin_lang); 	
		$menuList 	= $this->_recursiveList($menus,'pid',$section_id);	
        $draw_disabled ='';
		if($id){ $draw_disabled ='disabled'; }
			$drawItems  = '<select name="pid" '.$draw_disabled.' class="select_menu">
							<option value="0">-'. $this->pageData['labels']->select .'-</option>
							'.$this->_printRecurseParentDropDown($menuList, 0, $pid).
						'</select>';
        $this->pageData['menum_drop_down'] = $drawItems;

	// get sections		
		$sections 	 = array();
		$sectionsTmp = $this->mAdmin->GetAll('menu_sections');
        foreach($sectionsTmp as $opt) {
            $sections[$opt->id] = $opt->title;
        }
        $this->pageData['sections'] = $sections;
		
		$contents 	 = array();
        $contentTmp  = $this->mAdmin->GetAllML('content');
		if($contentTmp){
			foreach($contentTmp as $opt) {
				$contents[$opt->id] = $opt->title;
			}
		}
        $this->pageData['contents'] = $contents;	
		
		$this->pageData['error_string'] = validation_errors();
		$this->pageData['sections']		= $sections;
		$this->pageData['section_id']	= $section_id;
		$this->pageData['id']			= $id;
		$this->pageData['pid']			= ($pid) ? $pid : $section_id;
		
		$this->pageData['current_view']    = "admin/{$this->tbl}/edit";
		$this->_renderPage();
	}
	
	function toggle($sId, $id) {
        $this->mAdmin->Toggle($this->tbl, $id);
        redirect("admin/{$this->tbl}/opensection/{$sId}");
    }
	
	function remove($sectionId, $id) {
        $this->mAdmin->Remove($this->tbl, $id);
        $this->mAdmin->RemoveML($this->tbl, $id);
        redirect("admin/{$this->tbl}/opensection/{$sectionId}");
    }

	public function urlUnique($val) {
		$val = clean_url($val);
		$id  = $this->uri->segment(5);
		$data = $this->mAdmin->is_unique_field_by_id($val, 'menu.url.id.'.$id);
		if(!$data){
			$this->form_validation->set_message('urlUnique', "URL '$val' Exsist");
			return FALSE;
		}
		return TRUE;
	}	
}