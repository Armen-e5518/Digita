<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lang_model extends CI_Model {		

	function __construct(){
		parent::__construct();
	}
	
	function GetLangList(){
		$this->db->select('*');
		$this->db->from('lang');
		$this->db->where(array('lang.status'=> DEF_STATUS_PUBLISHED ));	
		$this->db->order_by("pos", "asc");
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	
	function GetLang($langId){
		$this->db->select('*');
		$this->db->from('lang');
		$this->db->where(array('lang.id'=>$langId));
		$query = $this->db->get();
		$result = $query->first_row();
		$query->free_result();
		return $result;
	}
	
	function GetSwitchUrls($curr_lang, $slug) {
		if($slug){
			$query = $this->db->query('SELECT mm.id FROM `menus_ml` AS mm
			  WHERE mm.`url` = "'.$slug.'" AND mm.`lang` = "'.$curr_lang.'"');
	        if($query->num_rows()) {
                $temp = $query->first_row();
                $query->free_result();
		        $id = $temp->id;
				$langs_arr = $this->GetLangList();
				$slugs = array();
				foreach($langs_arr as $langObj) {
		            $query = $this->db->query('SELECT mm.`url` FROM `menus_ml` AS mm
		                WHERE mm.`lang` = "' . $langObj->uid . '" AND mm.`id` = '.$id);
		            $result = $query->first_row();
		            $slugs[$langObj->uid] = $result->url;
					$query->free_result();
				}
				return $slugs;
	        }
	        return false;
		} else {
			return false;
		}
	}
}
