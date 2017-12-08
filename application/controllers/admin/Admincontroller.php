<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminController extends CI_Controller{

    var $pageData = array();
    var $settings = array();
    var $formData = array();
    var $userData = null;
    var $userId 	= 0;
    var $styles 	= array();
    var $scripts 	= array();
    var $ajaxCall	= false;
	var $admin_lang = '';
	

    function __construct() { 		
        parent::__construct();
		$this->load->config('admin_config');
		$this->load->helper(array('admin'));
		$this->load->model('admin/admin_model', 'mAdmin');
		$this->load->model('admin/lang_model',  'mLang');	
		// $this->output->enable_profiler();
        $user 					= $this->session->userdata('user');
        $this->userId			= isset($user->id)?$user->id:0;
        $this->userData 		= isset($user->id)?$user:NULL;

        $this->pageData['modules']	= array('content');
        $this->pageData['actions']	= array('add', 'edit');
		$this->pageData['is_active'] = $this->uri->segment(2);
		
		$settings	=	$this->config->item('settings');
		
		$this->pageData['settings'] = $this->settings = $settings;


		$this->admin_lang = ADMIN_DEF_LANG;
        include_once 'admin_labels.php';
        $this->pageData['labels']	= $labels;

        $this->pageData['pageNum'] 		= 0;
        $this->pageData['title'] 		= 'Admin Page';
        $this->pageData['styles']		= '';
        $this->pageData['scripts']		= '';
        $this->pageData['current_view'] 	= 'admin/default';
        $this->ajaxCall = ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest');
		$this->form_validation->set_error_delimiters('<div class="error_validation">', '</div>');
    }
	
    function _pagination($data){
		if(isset($data['items']) && !empty($data['items'])){				
			$config['uri_segment']	 = $data['uri_segment'];
			$config['base_url'] 	 = $data['base_url']; 
			$config['total_rows']	 = $data['total_rows'];
			$config['num_links'] 	 = $data['NumLinks'];
			$config['per_page'] 	 = $data['PerPage'];
			$config['full_tag_open']  = '<div class="pagerbody"><span>';	
			$config['full_tag_close'] = '</span></div>';

			$config['cur_tag_open'] = '<a class="page-activ">&nbsp;';
			$config['cur_tag_close'] = '</a>';
			$config['num_tag_open'] = '<span class="page-num">';
			$config['num_tag_close'] = '</span>';
			$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
			$config['next_link'] = '<i class="fa fa-angle-right"></i>';
			$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
			$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
			$this->pagination->initialize($config);
			$this->pageData['pagination'] 	= $this->pagination->create_links();		
			$this->pageData['items'] 		= $data['items'];
			$this->pageData['PerPage'] 		= $data['PerPage'];
			$this->pageData['pageNum'] 		= $data['pageNum'];
		}
	}
	

    function _addScript($fileName) {
        $this->scripts[$fileName] = 1;
    }

    function _addStyle($fileName) {
        $this->styles[$fileName] = 1;
    }

    function _getScripts() {
        $scripts = array_keys($this->scripts);
        foreach ($scripts as $script) {
            $this->pageData['scripts'] .= '<script type="text/javascript" language="javascript" src="' . site_url($script) . '"></script>';
            $this->pageData['scripts'] .= "\n";
        }
    }

    function _getStyles() {
        $styles = array_keys($this->styles);
        foreach ($styles as $style) {
            $this->pageData['styles'] .= '<link rel="stylesheet" media="screen" type="text/css" href="' . site_url($style) . '"/>';
            $this->pageData['styles'] .= "\n";
        }
    }

    function _renderPage() {
        $this->_getScripts();
        $this->_getStyles();
        $this->load->view('admin/master', $this->pageData);
    }

    function _isLoggedIn() {
        $this->load->library('encrypt');
        $mustVerifyCode 	= $this->config->item('encryption_key');
        $user			= $this->session->userdata('user');
        $user_email		= isset($user->email)?$user->email:'';
        $mustVerifyCode 	= $user_email.$this->config->item('encryption_key');

        $verifyCode 		= $this->session->userdata('verify_code');
        $verifyCode 		= $this->encrypt->decode($verifyCode);
        return ( strcmp($verifyCode,$mustVerifyCode) === 0 );
    }
		
	function _do_upload_img($userfile, $folder){
		$path 						= $this->config->item('fileServerPath');
        $config['upload_path'] 		= "{$path}{$folder}"; // server directory
        if (!is_dir($config['upload_path'])) {
        	@mkdir($config['upload_path'], 0755, true);
        }

        $config['allowed_types'] 	= 'gif|jpg|jpeg|jpe|png'; //'|bmp|zip|rar|tgz|doc|docx|xsl|xlsx|pdf|ppt|pptx|pps|ppsx|mdb'; // by extension, will check for whether it is an image
        $config['encrypt_name'] 	= true;
        $this->load->library('upload', $config);
        $files = $this->upload->do_upload($userfile);
        if ($files === false) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $files);
            return $data;
        }
	}
	
	function _do_upload_file($userfile, $folder){
		$path 						= $this->config->item('fileServerPath');
        $config['upload_path'] 		= "{$path}{$folder}"; // server directory
        if (!is_dir($config['upload_path'])) {
        	@mkdir($config['upload_path'],0755,true);
        }

        $config['allowed_types'] 	= 'pdf|doc|docx|xls|xlsx';
        $config['encrypt_name'] 	= true;
        $this->load->library('upload', $config);
        $files = $this->upload->do_upload($userfile);
        if ($files === false) {
            $error = array('error' => $this->upload->display_errors('<div class="error_validation">', '</div>'));
            return $error;
        } else {
            $data = array('upload_data' => $files);
            return $data;
        }
	}
	
	function _deleteFile($filename, $folder){
		$path	= $this->settings['FileServerPath'];
		$file 	= "{$path}{$folder}/{$filename}";
		@unlink($file);
	}
	
	function _recursiveList($list=array(),$identificator='pid', $parentId=0) {	
		$parents = array();
		$menu	 = array();
		foreach ($list as $item) {				
			if ((int)$item->$identificator === (int)$parentId) {
				$menu = array(
								'section_id' => $item->section_id,
								'id' 		 => $item->id, 
								'pid' 		 => $item->pid, 
								'url'		 => $item->url, 
								'title' 	 => $item->title,
							);
				
				$menu['children'] = $this->_recursiveList($list, $identificator='pid', $item->id);
				$parents[] = $menu;				
			}
		}		
		return $parents;
	}
		
	function _printRecurseParentDropDown($list, $level=0, $selected = 0, $selectedBy = 'id') {
		$draw  = '';
		$level = intval($level);                
		$dash  = str_repeat('| -', $level);
		
		if(isset($list) && !empty($list)) {
		   foreach ($list as $item) {
				$draw = $draw. '
					<option data-url="'. $item['url'] .'" value="'.$item['id'].'"'. (($selected == $item[$selectedBy]) ? 'selected="selected"':'' ).'>'. $dash . ' ' . $item['title'].'</option>
					';
				if (is_array($item['children']) && count($item['children'])) {
					
						$level = $level++;
						$draw = $draw . $this->_printRecurseParentDropDown($item['children'],  $level+1, $selected);
				}                   
			}
		}	
		return $draw;
	}	
}