<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Menu_model extends CI_Model {		

	function __construct() {
		parent::__construct();
	}
		
	function GetMenuSectionByUrl($url ='', $lang=DEF_LANG, $where = false) {
			$fields = array(
					'`menu`.`id`',
					'`menu`.`section_id`',					
					'`menu`.`url`',					
					'`menu`.`status`',
					'`menu`.`show`',
					'`menu`.`cid`',					
					'`menu`.`pid`',
					'`menu`.`pos`',
					'`menu_ml`.`title`',
					);
			$this->db->select($fields);
			$this->db->from('menu');
			$this->db->join('menu_sections','menu_sections.id = menu.section_id','LEFT');
			$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
			$this->db->where(array(
							'menu_sections.url'		=> $url, 
							'menu_sections.status'	=> DEF_STATUS_PUBLISHED,
							'menu.status' 			=> DEF_STATUS_PUBLISHED,
							'menu.show' 			=> DEF_STATUS_PUBLISHED,
							'menu_ml.lang'			=> $lang
							)
						);
			if(isset($where) && $where != ''){
				$this->db->where($where);
			}
			
			$this->db->order_by('menu.pos', 'ASC');
			$this->db->order_by('menu.pid', 'ASC');
			$this->db->order_by('menu.id', 'ASC');
			$query	= $this->db->get();
			$result	= $query->result();
			$query->free_result();
			
			if (!empty($result)){
				return $result;
			} else {
				return false;
			}
		}
	
	function GetSectionsPageByUrl($section_id, $menuUrl, $lang=DEF_LANG) {
		
		$fields = array(
				'`menu`.`id`',
				'`menu`.`section_id`',
				'`menu`.`pid`',
				'`menu`.`status`',
				'`menu`.`img`',								
				'`menu`.`url`',
				'`menu`.`cid`',
				'`menu_ml`.*',
				);
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array('`menu`.`section_id`' => $section_id, 'menu.url'=>$menuUrl, 'menu_ml.lang'=>$lang, 'menu.status' => DEF_STATUS_PUBLISHED));		
		$this->db->limit(1);
		$query	= $this->db->get();
		$result	= $query->first_row();
		$query->free_result();
		return $result;
	}

	function GetPageById($id, $lang=DEF_LANG) {
		$fields = array(
				'`menu`.`id`',
				'`menu`.`section_id`',
				'`menu`.`pid`',
				'`menu`.`cid`',					
				'`menu`.`url`',				
				'`menu`.`show`',
				'`menu_ml`.*',
				);
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array('menu.id'=>$id, 'menu_ml.lang'=>$lang, 'menu.status' => DEF_STATUS_PUBLISHED));
		$this->db->limit(1);
		$query	= $this->db->get();
		$result	= $query->first_row();
		$query->free_result();
		return $result;
	}
	
	function GetPageByUrl($url, $lang=DEF_LANG) {		
		$fields = array(
				'`menu`.`id`',
				'`menu`.`section_id`',
				'`menu`.`pid`',
				'`menu`.`cid`',					
				'`menu`.`url`',				
				'`menu`.`show`',
				'`menu_ml`.*',
				);
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array('menu.url'=>$url, 'menu_ml.lang'=>$lang, 'menu.status' => DEF_STATUS_PUBLISHED));		
		$this->db->limit(1);
		$query	= $this->db->get();
		$result	= $query->first_row();
		$query->free_result();
		return $result;
	}
	
	function GetContentById($id, $lang=DEF_LANG){
		$this->db->select('*');
		$this->db->from('content');
		$this->db->join('content_ml','content_ml.id = content.id','LEFT');
		$this->db->where(array('content.id'=>$id, 'content_ml.lang'=>$lang, 'content.status' => DEF_STATUS_PUBLISHED));
		$this->db->limit(1);
		$query	= $this->db->get();
		$result	= $query->first_row();
		$query->free_result();
		return $result;
	}
	
	function GetMenuMLItemBySlag($slag){
		$fields = array('menu_ml.id','menu.url',  'menu_ml.title');
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array('menu_ml.url'=>$slag));
		$query = $this->db->get();
		$result = $query->first_row();
		$query->free_result();
		return $result;
	}
		
	function GetMenuMLItemsById($menuId){
		$fields = array('menu_ml.id','menu_ml.lang','menu.url', 'menu_ml.title');
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array('menu_ml.id'=>$menuId));
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		return $result;
	}	
		
	function GetMenuSection($url='', $lang=DEF_LANG) {
		$fields = array(
				'`menu`.`id`',
				'`menu`.`section_id`',
				'`menu_ml`.`title`',
				'`menu`.`url`',
				'`menu`.`status`',
				'`menu`.`show`',
				'`menu`.`pid`'
				);
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_sections','menu_sections.id = menu.section_id','LEFT');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array(
						'menu_sections.url'=>$url, 
						'menu_sections.status' => DEF_STATUS_PUBLISHED,
						'menu.status' => DEF_STATUS_PUBLISHED,
						'menu.show' => DEF_STATUS_PUBLISHED,
						'menu_ml.lang' => $lang,
						'menu.pid' => 0,
						)
					);
		$this->db->order_by('menu.pos', 'ASC');
		$this->db->order_by('menu.pid', 'ASC');
		$this->db->order_by('menu.id', 'ASC');
		$query	= $this->db->get();

		$result	= $query->result();
		$query->free_result();
		
		
		if (!empty($result)){
			return $result;
		} else {
			return false;
		}
	}
	
	function GetSelectedSiteBarMenu($sections_url, $url,  $lang=DEF_LANG,  $where=false){
		$section_query = "SELECT * FROM `menu_sections` WHERE `url` = '{$sections_url}'";
		$section_result = $this->db->query($section_query);		
		$section_obj = $section_result->first_row();			
		
		   $menu_query = "SELECT 
									`menu`.*,`menu_ml`.`title` FROM `menu` 
							LEFT JOIN
								`menu_ml` ON `menu`.`id` = `menu_ml`.`id`
							WHERE 
								`menu`.`url` = '{$url}' AND `menu`.`section_id` = {$section_obj->id}  AND `menu_ml`.`lang` = '{$lang}' ";
         

            $menu_result = $this->db->query($menu_query);			
            $menu_obj 	 = $menu_result->first_row();
		
		if(!empty($menu_obj)) {
                if ($menu_obj->pid != 0) {
                    $menu_list = $this->GetSubMenusByParentId($menu_obj->pid, $this->_lang, array('menu.section_id' => $section_obj->id));
		    
		    $parent_menu = $this->GetPageById($menu_obj->pid, $this->_lang);				
		}
				
		$SiteBarMenu = array(
			'parent_menu' 		=> isset($parent_menu) ? $parent_menu : '',
			'menu_submenus' 	=> isset($menu_list) ? $menu_list : '',	
		);			
		return $SiteBarMenu;						
            }
		return false;			
	}
	
	function GetSubMenusByParentId($pid, $lang=DEF_LANG, $where = false){
		$fields = array('menu_ml.id','menu_ml.lang','menu.url', 'menu_ml.title');
		$this->db->select($fields);
		$this->db->from('menu');
		$this->db->join('menu_ml','menu_ml.id = menu.id','LEFT');
		$this->db->where(array('menu.pid'=>$pid, 'menu.status' => DEF_STATUS_PUBLISHED, 'menu.show' => DEF_STATUS_PUBLISHED, 'menu_ml.lang' => $lang));
		if($where){ $this->db->where($where); }
		$this->db->order_by('menu.pos', 'ASC');
		$this->db->order_by('menu.pid', 'ASC');
		$this->db->order_by('menu.id', 'ASC');
		$query = $this->db->get();
		$result = $query->result();	
		$query->free_result();
		return $result;
	}
	function GetParentMenuIdsByMenuUrl($url){
		$this->db->select('`menu`.`id`');
		$this->db->from('menu');
		$this->db->where(array('`menu`.`url`' =>$url,'`menu`.`status`' => DEF_STATUS_PUBLISHED, '`menu`.`show`' => DEF_STATUS_PUBLISHED));
		$query = $this->db->get();
		$result = $query->row();
		$query->free_result();
		
		if(isset($result) && !empty($result)){			
			$this->db->select('*');
			$this->db->from('menu');
			$this->db->where(array('`menu`.`pid`' => $result->id ,'`menu`.`status`' => DEF_STATUS_PUBLISHED, '`menu`.`show`' => DEF_STATUS_PUBLISHED));
			$query = $this->db->get();
			$result = $query->result();
			$query->free_result();
			if(isset($result) && !empty($result)){
				$Ids = array();
				foreach($result as $val){
					$Ids[] = $val->id;
				}
			}
			return $Ids;
		}
		return false;
	}
		
	
}