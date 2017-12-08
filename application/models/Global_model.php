<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Global_model extends CI_Model {		

	function __construct() {
		parent::__construct();
	}

	function GetSettings(){
		$data=array();
		$this->db->select("*");
		$this->db->from('settings');
		$this->db->where(array('settings.status' => DEF_STATUS_PUBLISHED));		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			foreach($result as $val){
				$data[$val->key] = $val->value;
			}
		}
		$query->free_result();
		return $data;
	}
	
	function GetAll($tbl, $lang, $perPage = 0, $pageNum = 0, $where=false, $order=array()){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join($tbl.'_ml',$tbl.'.id = '.$tbl.'_ml.id','LEFT');
		$this->db->where(array($tbl.'_ml.lang'=>$lang, $tbl.'.status' => DEF_STATUS_PUBLISHED));
		if($where){ $this->db->where($where); }		
		if($order){
			foreach($order as $k => $v){
				$this->db->order_by($tbl.'.'. $k , $v);
			}
		} else{ $this->db->order_by($tbl.'.id', 'desc');	}
		if($perPage){ $this->db->limit($perPage, $pageNum);	}
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	function GetAllWhereIn($tbl, $lang, $perPage = 0, $pageNum = 0, $where_in=false, $where=false, $order=array()){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join($tbl.'_ml',$tbl.'.id = '.$tbl.'_ml.id','LEFT');
		$this->db->where(array($tbl.'_ml.lang'=>$lang, $tbl.'.status' => DEF_STATUS_PUBLISHED));
		if($where_in){ $this->db->where_in($tbl .'.'. $where_in['key'], $where_in['data']); }
		if($where){ $this->db->where($where);}		
		if($order){
			foreach($order as $k => $v){
				$this->db->order_by($tbl.'.'. $k, $v);
			}
		}else{ $this->db->order_by($tbl.'.id', 'desc');	}
		if($perPage){ $this->db->limit($perPage, $pageNum);	}
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		return $result;
	}
	
	function GetSlidersById($tbl, $id, $lang){	
		$fields = array(
				'`'.$tbl.'`.`id`',					
				'`'.$tbl.'`.`status`',
				'`'.$tbl.'_images_ml`.*',
				'`'.$tbl.'_images`.*',				
				);
		$this->db->select($fields);
		$this->db->from($tbl);
		$this->db->join($tbl.'_images', $tbl.'_images.sid = '.$tbl.'.id','LEFT');
		$this->db->join($tbl.'_images_ml', $tbl.'_images_ml.id = '.$tbl.'_images.id','LEFT');
		$this->db->where(array(
			$tbl.'.id'=>$id,		
			$tbl.'.status' 	=>	DEF_STATUS_PUBLISHED , 
			$tbl.'_images.status' => DEF_STATUS_PUBLISHED ,
			$tbl.'_images_ml.lang' =>$lang,
			));		
		$this->db->order_by($tbl.'_images.pos', 'ASC');		
		$query	= $this->db->get();
		$result	= $query->result();
		$query->free_result();
		return $result;
	}	
	
	function GetAllGallery($lang, $perPage = 0, $pageNum = 0, $where=array(), $order=array()){
		$tbl ='gallery_images';
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join($tbl.'_ml',$tbl.'.id = '.$tbl.'_ml.id','LEFT');
		$this->db->where(array($tbl.'_ml.lang'=>$lang));
		if($where){ $this->db->where($where);}
		if($order){
			foreach($order as $k => $v){ $this->db->order_by($tbl.'.'. $k , $v);}
		}else{
			$this->db->order_by($tbl.'.pos', 'ASC');
		}
		if($perPage){ $this->db->limit($perPage, $pageNum);	}
		
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		return $result;
	}

	function GetItem($tbl, $lang, $id=0, $where=false){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join($tbl.'_ml',$tbl.'.id = '.$tbl.'_ml.id','LEFT');
		$this->db->where(array($tbl.'.id'=>$id, $tbl.'_ml.lang'=>$lang, $tbl.'.status' => DEF_STATUS_PUBLISHED ));
		
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get();
		$result = $query->first_row();
		$query->free_result();
		return $result;
	}	
	
    function GetAllCount($tbl, $where=false){
    	$this->db->select('count(*) as qty');
    	$this->db->from($tbl);
    	$this->db->where(array($tbl.'.status'=> DEF_STATUS_PUBLISHED ));
    	if($where){
			$this->db->where($where);
		}
    	$query = $this->db->get();
		$result = $query->first_row();
//    	echo $this->db->last_query();
		$query->free_result();
		return $result->qty;	
    }
	
    
    function GetWhere($tbl, $where){
    	$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where($where);
		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->first_row();
		$query->free_result();
		return $result;
    }
	
	function GetMLWhere($tbl, $lang, $where){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->join($tbl.'_ml',$tbl.'.id = '.$tbl.'_ml.id','LEFT');
		$this->db->where(array($tbl.'_ml.lang'=>$lang, $tbl.'.status' => DEF_STATUS_PUBLISHED ));
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->first_row();
		$query->free_result();
		return $result;
	}
	
// subscribe
	function emailexist($email, $where=false){
		$tbl ='subscribe';
		$this->db->select('email');
    	$this->db->from($tbl);
    	$this->db->where(array($tbl.'.email'=> $email));
    	if($where){	$this->db->where($where);}
    	$query = $this->db->get();
		$rowcount = $query->num_rows();
		$query->free_result();
		
		if($rowcount > 0){
			return true;	
		}
		return false;	
	}
	function GetAllEmail($where=false){
		$tbl ='subscribe';
		$this->db->select('email');
    	$this->db->from($tbl);    	
    	if($where){	$this->db->where($where);}
    	$sql = $this->db->get();
		$result = $sql->result();
		$sql->free_result();
		return $result;	
	}
		

    
    function update($tbl, $data, $id){
    	$this->db->where('id', $id);
		$this->db->update($tbl, $data);
    }
    
	function insert($tbl, $data){
		$this->db->insert($tbl, $data);
		$id = $this->db->insert_id();
		return $id;
	}


    function GetAllNoStatus($tbl, $lang, $perPage = 0, $pageNum = 0, $where = false, $order = array())
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->join($tbl . '_ml', $tbl . '.id = ' . $tbl . '_ml.id', 'LEFT');
        $this->db->where(array($tbl . '_ml.lang' => $lang));
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $k => $v) {
                $this->db->order_by($tbl . '.' . $k, $v);
            }
        } else {
            $this->db->order_by($tbl . '.id', 'desc');
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }



}