<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('Admincontroller.php');
class Ajax extends AdminController {
    function __construct() {
        parent::__construct();
        if ($this->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
            die('Directory access is forbidden.');
        }
    }
	
	function chackslug() {
        $title = $this->input->post('title', true);
        $title = mb_strtolower($title, 'UTF-8');
        $tbl = $this->input->post('tbl', true);
        $id = $this->input->post('id', true);
        $title = $this->clean_url($title);
        $title = str_replace('--', '-', $title);
        $obj = $this->mAdmin->GetSlug($tbl, $title, $id);  
        if(count($obj)) {
            $title = $title . "-" . time();
        }
        echo json_encode($title); exit;
    }
	
	function edit_menu(){
		$section_id  = $this->input->post('section_id', true);
		$parent_id	 = $section_id;			
		$menu_array = $this->input->post('menu_array', true);
		
		$menu = array();
		foreach($menu_array as $k => $item){
			$pos = isset($item['left']) ? $item['left'] : 99999;
			if(isset($item['parent_id'])){
				$menu[$k] = array(
					'id'	=> $item['item_id'],
					'pid' 	=> $item['parent_id'],
					'pos' 	=> $pos,
				);				
			}
			else {						
				$menu[$k] = array(
					'id' 	=> $item['item_id'],
					'pid'   => $parent_id,
					'pos'   => $pos,
				);
			}
		}		
		$upd = $this->mAdmin->MenuEdit($menu);	
		if($upd){ $this->session->set_userdata('edit', 1); echo 1; exit; }		
	}
	
	function edit_restaurant_menu(){
		$section_id  = $this->input->post('section_id', true);
		$parent_id	 = $section_id;			
		$menu_array = $this->input->post('menu_array', true);
		
		$menu = array();
		foreach($menu_array as $k => $item){
			$pos = isset($item['left']) ? $item['left'] : 99999;
			if(isset($item['parent_id'])){
				$menu[$k] = array(
					'id'	=> $item['item_id'],
					'pid' 	=> $item['parent_id'],
					'pos' 	=> $pos,
				);				
			}
			else {						
				$menu[$k] = array(
					'id' 	=> $item['item_id'],
					'pid'   => $parent_id,
					'pos'   => $pos,
				);
			}
		}		
		$upd = $this->mAdmin->RestaurantMenuEdit($menu);	
		if($upd){ $this->session->set_userdata('edit', 1); echo 1; exit; }		
	}

    function clean_url($text) {
        $code_entities_match = array(' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
        $code_entities_replace = array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $text = str_replace($code_entities_match, $code_entities_replace, $text);
        return mb_strtolower(trim($text, '-'), 'UTF-8');
    }
	
    function delimg(){	
        $id 	= $this->input->post('id', true);
        $tbl 	= $this->input->post('tbl',true);
        $row 	= $this->input->post('row',true);        
        $Obj = $this->mAdmin->Get($tbl, $id);
		if(isset($Obj) && !empty($Obj)){
			$img = $Obj->$row;
			$this->_deleteFile($img, $tbl);
			$this->mAdmin->Update($tbl, $data = array($row => ''), $id);
		}	
		echo 1; exit;
	}	
}