<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('pre')) {
	function pre($data=false, $e=false) {
		$bt = debug_backtrace();
		$caller = array_shift($bt);		
		print "<pre><xmp>";
		print_r($data); 	  
		print "\r\n Called in : ". $caller['file'].", At line:". $caller['line'];
		echo "</xmp></pre>\n";
		if($e){ exit; }
	}
}

if(!function_exists('last_sql')) {
	function last_sql($e=false) {
		$bt 	= debug_backtrace();
		$caller = array_shift($bt);
		$CI 	= & get_instance();
		echo  $CI->db->last_query();
		echo "<br/>Called in : ". $caller['file'].", At line:". $caller['line'];
		if($e){ exit; }
	}
}

if (!function_exists('translate')) {
    function translate($str = false)
    {
        $CI = &get_instance();
        if (isset($CI->pageData['labels']->{$str})) {
            $line = $CI->pageData['labels']->{$str};
        } else {
            $line = $str;
        }
        return $line;
    }
}


if(!function_exists('end_url')) {
	function end_url() {
		$currUrl = current_url(); 
		$url_arr = explode('/',$currUrl);
		$endUrl	 = end($url_arr);
		return $endUrl;
	}
}

if(!function_exists('is_extUrl')) {
	function is_extUrl($url) {
		$valid = false;		
		if(preg_match('/^(http|https):\/\/([a-z0-9-]\.+)*/i', $url)){
			$valid = true;
		}
		return $valid;
	}
}

if(!function_exists('clean_url')) {
	function clean_url($text){
		$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','*','+','~','`','=');
		$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		return mb_strtolower(trim($text, '-'), 'UTF-8');
	}
}

// RecursiveList
if(!function_exists('RecursiveList')) {
	function RecursiveList($itmes, $parentId = 0, $level = 0) {
		$parents = array();
		if(isset($itmes) && !empty($itmes)){			
			foreach($itmes as $index => $item) {		
				if($item->pid == $parentId){
					$data = array('id' => $item->id, 'pid' => $item->pid, 'url' => $item->url, 'title' => $item->title);
					$parents[$index] = $data;
					$children = RecursiveList($itmes, $item->id, $level+1);
					if(sizeof($children) > 0)
					$parents[$index]['children'] = $children;
				}
			}
		}
		return $parents;
	}
}

if(!function_exists('treealize')) {
	function treealize($items, $identifier = 'id', $parentIdentifier='pid', $parentId = null){
		$results = array();	
		foreach($items as $item){					
			if($item[$parentIdentifier] === $parentId) {
				$children = treealize($items, $identifier, $parentIdentifier, $item[$identifier]);
				if (sizeof($children) > 0)
					$item["children"] = $children;
				
				$results[ $item[$identifier] ] = $item;
			}
		}	
		return $results;
	}
}

if(!function_exists('Development')) {
	function Development($params=array()) {
		$url ='http://e-works.am/eworksremoteinfo/copyright.php';
	
		$uagent = $_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
		curl_setopt($ch, CURLOPT_HEADER, 0);           
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   
		curl_setopt($ch, CURLOPT_ENCODING, "");        
		curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);  
		if(!empty($params)){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		}
		$content = curl_exec($ch);
		$err     = curl_errno($ch);
		$errmsg  = curl_error($ch);
		$header  = curl_getinfo($ch);
		curl_close($ch);

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;	
	}
}

if(!function_exists('last_sql')) {
	function last_sql($exit=false){
		$CI = get_instance();
		echo $CI->db->last_query();
		if($exit){ exit; }
	}
}
