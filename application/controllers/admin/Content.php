<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');

class Content extends AdminController {
	
	var $tbl = 'content';
	
	function __construct() {
		parent::__construct();
		if(!$this->_isLoggedIn()){ redirect(site_url('admin/admin/login')); }
		$this->pageData['mod'] = $this->tbl;
		$this->pageData['selected_menu_item'] = $this->tbl;
	}
	
	function index($pageNum=0, $q=0){
		$where = ($q) ? "`{$this->tbl}_ml.title` LIKE '%". trim($q) ."%'" : 0;
		
		$data= array();
		$data['pageNum']	 =  $pageNum;
		$data['PerPage']	 =	20;
		$data['NumLinks']	 =	5;
		$data['uri_segment'] =  4;
		$data['base_url']	 =  site_url("admin/". $this->tbl ."/index"); 
		$data['total_rows']	 =	$this->mAdmin->GetCount($this->tbl, $where);
		$data['items']		 = 	$this->mAdmin->GetAllML($this->tbl, $data['PerPage'], $data['pageNum'], $where);
		$this->_pagination($data);

		$this->pageData['current_view']	= "admin/$this->tbl/main";
		$this->_renderPage();
	}
		
	function edit($id=0, $pageNum=0){
		$this->pageData['addEditor']= true;

		$this->pageData['langArr']= $langArr = $this->mLang->GetLangList();
		$this->form_validation->set_rules('status', 'Status', 'required');
			
		foreach ($langArr as $lang){
			$this->form_validation->set_rules("title_$lang->uid", "Title ($lang->uid)", 'trim|required');
			$this->form_validation->set_rules("text_$lang->uid", "Text ($lang->uid)", 'trim');
		}
		$Obj	= new stdClass();
		$ObjML	= array();
		$this->pageData['obj'] 		= $Obj;			
		$this->pageData['objML']	= $ObjML;
	
		if($id){
			$Obj	= $this->mAdmin->Get($this->tbl, $id);
			$ObjTMP = $this->mAdmin->GetML($this->tbl, $id);
			$ObjML = array();
			foreach ($ObjTMP as $item){
				$ObjML[$item->lang] = $item;
			}			
			$this->pageData['obj'] 		= $Obj;
			$this->pageData['objML'] 	= $ObjML;
		} 		
		if ($this->form_validation->run('') == TRUE) {
			$data = array(
				'status'	=> $this->input->post('status',true),
			);

			if($id){
				if(!empty($_FILES['banner_img']['tmp_name'])){
					$tmp		=	$_FILES["banner_img"]["tmp_name"];
					$tmp_name	=	$_FILES['banner_img']['name'];
					$ex   		= explode('.', $tmp_name);
					$name 		= rand_value() .'.'. end($ex);
					
					$upload_path = $this->settings['FileServerPath'].$this->tbl .'/';
					if (!is_dir($upload_path)) {
						@mkdir($upload_path, 0755, true);
						copy('uploads/index.html', $upload_path .'/index.html');
					}
					$moved = move_uploaded_file($tmp, $upload_path . $name);

					if($moved) {
						$this->_deleteFile($Obj->banner_img, $this->tbl);
						$data['banner_img'] = $name;
					} 
				}	
				
				$this->mAdmin->Update($this->tbl, $data, $id);
				
			} else {
				if(!empty($_FILES['banner_img']['tmp_name'])){
					$tmp		=	$_FILES["banner_img"]["tmp_name"];
					$tmp_name	=	$_FILES['banner_img']['name'];
					$ex   		= explode('.', $tmp_name);
					$name 		= rand_value() .'.'. end($ex);
					
					$upload_path 		= $this->settings['FileServerPath'].$this->tbl .'/';
					if (!is_dir($upload_path)) {
						@mkdir($upload_path, 0755, true);
						copy('uploads/index.html', $upload_path .'/index.html');
					}
					$moved = move_uploaded_file($tmp, $upload_path . $name);

					if($moved) {
						$data['banner_img'] = $name;
					} 
				}	
				
				$liId = $this->mAdmin->Insert($this->tbl, $data);
			}
			
			foreach ($langArr as $lang){
				$dataML = array(
					'title'		=> $this->input->post("title_$lang->uid",true),
					'text'		=> $this->input->post("text_$lang->uid"),
				);
				
				$searchfield = $dataML['title']." ".$dataML['text'];
				$searchfield = strip_tags($searchfield);
				$searchfield = str_replace('  ', ' ', $searchfield);
				$searchfield = mysqli_real_escape_string($searchfield);
				$searchfield = str_replace('\r\n', '', $searchfield);
				
				$dataML['searchfield'] = $searchfield;
				
				if($id){
					$items = "id, lang, title, text, searchfield";
					$values = $id.', 
									\''.$lang->uid.'\', 
									\''.mysqli_real_escape_string($dataML['title']).'\', 
									\''.mysqli_real_escape_string($dataML['text']).'\',
									\''.$dataML['searchfield']."'";
									
					$this->mAdmin->UpdateML($this->tbl, $items, $values);
				} else {
					$dataML["id"]	= $liId;
					$dataML["lang"] = $lang->uid;
					$this->mAdmin->InsertML($this->tbl, $dataML);
				}
				
			}
			redirect("admin/{$this->tbl}/index/{$pageNum}");
		}
		
		$this->pageData['error_string']	 = validation_errors();
		$this->pageData['pageNum'] 	= $pageNum;
		$this->pageData['id']		= $id;
		
		$this->pageData['current_view']    = "admin/{$this->tbl}/edit";
		$this->_renderPage();
	}
	
	function toggle($id, $pageNum=0) {
		$this->mAdmin->Toggle($this->tbl, $id);
		redirect("admin/{$this->tbl}/index/{$pageNum}");
	}
	
	function remove($id, $pageNum=0) {
		$this->mAdmin->RemoveML($this->tbl, $id);
		$this->mAdmin->Remove($this->tbl, $id);
		redirect("admin/{$this->tbl}/index/{$pageNum}");
	}	   
}