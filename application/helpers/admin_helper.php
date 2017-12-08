<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// ##get_menu_html
if(!function_exists('get_menu_html')) {	
	function get_menu_html($section_id, $items, $attributes = array(), $flag = true, $level = 1){
		$CI 	= & get_instance();
		$settings = $CI->settings;
		$attributes_str = "";
		if(!empty($attributes)){
			foreach($attributes as $k => $v){
				$attributes_str .= $k."='".$v."'";
			}	}
		
			$html = "";
			if($flag){
				$html = "<div ". $attributes_str .">";
			}			
				$html .= "<ol class='dd-list'>";
				foreach($items as $item) {
					$status = (isset($item['status']) && $item['status']>0)?'n_valid':'a';
					$del = '<i class="fa">&nbsp;&nbsp;&nbsp;</i>';
					if(!in_array($item['id'],$settings['MenuNotRemovedIds'])){
						$del = "<a href='". site_url('/admin/menu/remove/'. $section_id .'/'. $item['id']) ."' class='remove-btn delete'><i class='fa fa-trash-o'></i></a>";
					}
					if(isset($item['children'])) {	$del ='<i class="fa">&nbsp;&nbsp;&nbsp;</i>'; }	
						$html .= "<li class='dd-item dd3-item' data-id='".$item['id']."'>
								<div class='dd-handle dd3-handle'>Drag</div>
								<div class='dd3-content'>
									<a href='". site_url('/admin/menu/edit/'. $section_id .'/'. $item['id'] .'/'. $item['pid']) ."'>". $item['title'] ."</a>
									<div class='n_transparence re'>									
										<a href='". site_url('admin/menu/toggle/'.$section_id.'/'.$item['id'])."' class='n_valid_icon ". $status ."'><i class='fa fa-check-circle'></i></a>
										&nbsp;
										<a href='". site_url('/admin/menu/edit/'. $section_id .'/'. $item['id'] .'/'.  $item['pid']) ."'><i class='fa fa-pencil'></i></a>
										&nbsp;&nbsp;&nbsp;". $del ."
										
									</div>
									<div class='clr'></div>
								</div>";
									if (isset($item['children'])) { 
										$html .= get_menu_html($section_id,$item['children'], array(), false);
									}
					$html .= "</li>";				
				}
				$html .= "</ol><div class='clr'></div>";
			if($flag){	
				$html .= "</div>";
			}
			
		return $html;
	}
}

if(!function_exists('restaurants_menu_html')) {	
	function restaurants_menu_html($section_id, $items, $attributes = array(), $flag = true, $level = 1){
		$CI 	= & get_instance();
		$settings = $CI->settings;
		$attributes_str = "";
		if(!empty($attributes)){
			foreach($attributes as $k => $v){
				$attributes_str .= $k."='".$v."'";
			}	}
		
			$html = "";
			if($flag){
				$html = "<div ". $attributes_str .">";
			}			
				$html .= "<ol class='dd-list'>";
				foreach($items as $item) {
					$status = (isset($item['status']) && $item['status']>0)?'n_valid':'a';
					$del = '<i class="fa">&nbsp;&nbsp;&nbsp;</i>';
					if(!in_array($item['id'],$settings['MenuNotRemovedIds'])){
						$del = "<a href='". site_url('/admin/restaurants/remove_menu/'. $section_id .'/'. $item['id']) ."' class='remove-btn delete'><i class='fa fa-trash-o'></i></a>";
					}
					if(isset($item['children'])) {	$del ='<i class="fa">&nbsp;&nbsp;&nbsp;</i>'; }	
						$html .= "<li class='dd-item dd3-item' data-id='".$item['id']."'>
								<div class='dd-handle dd3-handle'>Drag</div>
								<div class='dd3-content'>
									<a href='". site_url('/admin/restaurants/restaurant_menu_edit/'. $section_id .'/'. $item['id'] .'/'. $item['pid']) ."'>". $item['title'] ."</a>
									<div class='n_transparence re'>									
										<a href='". site_url('admin/restaurants/restaurants_menu_toggle/'.$section_id.'/'.$item['id'])."' class='n_valid_icon ". $status ."'><i class='fa fa-check-circle'></i></a>
										&nbsp;
										<a href='". site_url('/admin/restaurants/restaurant_menu_edit/'. $section_id .'/'. $item['id'] .'/'.  $item['pid']) ."'><i class='fa fa-pencil'></i></a>
										&nbsp;&nbsp;&nbsp;". $del ."
										
									</div>
									<div class='clr'></div>
								</div>";
									if (isset($item['children'])) { 
										$html .= restaurants_menu_html($section_id,$item['children'], array(), false);
									}
					$html .= "</li>";				
				}
				$html .= "</ol><div class='clr'></div>";
			if($flag){	
				$html .= "</div>";
			}
			
		return $html;
	}
}
// ##treealize
if(!function_exists('treealize')) {
	function treealize($items, $identifier = 'id', $parentIdentifier='pid', $parentId = null){
		$results = array();	
		foreach($items as $item){					
			if($item[$parentIdentifier] === $parentId) {
				$children = treealize($items, $identifier, $parentIdentifier, $item[$identifier]);
				if (sizeof($children) > 0)
					$item["children"] = $children;
				
				$results[] = $item;
			}
		}	
		return $results;
	}
}
// ##clean_url
if(!function_exists('clean_url')) {
	function clean_url($text){
		$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','*','+','~','`','=');
		$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		return mb_strtolower(trim($text, '-'), 'UTF-8');
	}
}
if(!function_exists('FolderExist')) {
	function FolderExist($folder) {
		$path = realpath($folder);
		if($path !== false AND is_dir($path)) {
			return $path;
		}
		return false;
	}
}

if(!function_exists('FolderDelete')) {
	function FolderDelete($path) {
		if (is_dir($path) === true)	{
			$files = array_diff(scandir($path), array('.', '..'));
			foreach ($files as $file) {
				FolderDelete(realpath($path) . '/' . $file);
			}
			return rmdir($path);
		}
		else if(is_file($path) === true) {
			return unlink($path);
		}
		return false;
	}
}

if(!function_exists('pre')) {
	function pre($data, $exit=false) {
		$bt = debug_backtrace();
		$caller = array_shift($bt);
		echo "<pre><xmp>";
		print_r($data); 	  
		echo "\r\n Called in : ". $caller['file'].", At line:". $caller['line'];
		echo "</xmp></pre>\n";
		if($exit){ exit; }
	}
}

if(!function_exists('last_sql')) {
	function last_sql($exit=false){
		$CI = get_instance();
		echo $CI->db->last_query();
		if($exit){ exit; }
	}
}

if(!function_exists('rand_value')) {
	function rand_value($isnumber = false){
		if($isnumber){			
			$str = mt_rand(100000000, 999999999); // lenght 9
		}else{
			$string="0123456789abcdefghijklmnopqrstuvwxyz";
			$str = "";
			for($i = 0; $i < 25; $i++)  {
				$index = mt_rand(0, 35);
				$str .= $string[$index];		
			}
		}
		return $str;	
	}
}
if(!function_exists('xml_pars_array')) {	
function xml_pars_array($url, $get_attributes = 1, $priority = 'tag')
{
    $contents = "";
    if (!function_exists('xml_parser_create'))
    {
        return array ();
    }
    $parser = xml_parser_create('');
    if(!($fp = @fopen($url, 'rb'))) {
        return array ();
    }
    while (!feof($fp))
    {
        $contents .= fread($fp, 8192);
    }
    fclose($fp);

    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if (!$xml_values)
        return; //Hmm...
    $xml_array = array ();
    $parents = array ();
    $opened_tags = array ();
    $arr = array ();
    $current = & $xml_array;
    $repeated_tag_index = array (); 
    foreach ($xml_values as $data)
    {
        unset ($attributes, $value);
        extract($data);
        $result = array ();
        $attributes_data = array ();
        if (isset ($value))
        {
            if ($priority == 'tag')
                $result = $value;
            else
                $result['value'] = $value;
        }
        if (isset ($attributes) and $get_attributes)
        {
            foreach ($attributes as $attr => $val)
            {
                if ($priority == 'tag')
                    $attributes_data[$attr] = $val;
                else
                    $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }
        if ($type == "open")
        { 
            $parent[$level -1] = & $current;
            if (!is_array($current) or (!in_array($tag, array_keys($current))))
            {
                $current[$tag] = $result;
                if ($attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                $current = & $current[$tag];
            }
            else
            {
                if (isset ($current[$tag][0]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                { 
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    ); 
                    $repeated_tag_index[$tag . '_' . $level] = 2;
                    if (isset ($current[$tag . '_attr']))
                    {
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset ($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = & $current[$tag][$last_item_index];
            }
        }
        elseif ($type == "complete")
        {
            if (!isset ($current[$tag]))
            {
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
            }
            else
            {
                if (isset ($current[$tag][0]) and is_array($current[$tag]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    if ($priority == 'tag' and $get_attributes and $attributes_data)
                    {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    ); 
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes)
                    {
                        if (isset ($current[$tag . '_attr']))
                        { 
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset ($current[$tag . '_attr']);
                        }
                        if ($attributes_data)
                        {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                }
            }
        }
        elseif ($type == 'close')
        {
            $current = & $parent[$level -1];
        }
    }
    return ($xml_array);
}

}