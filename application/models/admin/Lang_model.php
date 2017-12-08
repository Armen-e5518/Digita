<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lang_model extends CI_Model {	
	
	function GetLangList(){
		$this->db->select('*');
		$this->db->from('lang');
		$this->db->order_by('pos', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	function InsertLang($data) {
		$this->db->insert('lang',$data);
		return ;
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
	
	function UpdateLang($langId, $data){
		$this->db->where('lang.id', $langId);
		$this->db->update('lang',$data);
		return;
	}
	
	function RemoveLang($langId){
		$this->db->where('lang.id', $langId);
		$this->db->delete('lang'); 
	}	
}