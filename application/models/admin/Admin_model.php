<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function debug($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

    public function GetMenuBySectionsId($section_id, $attributes = array())
    {
        $this->db->select("*");
        $this->db->from('menu_sections');
        $this->db->where(array('id' => $section_id));
        $query = $this->db->get();
        $result = $query->row_array();
        $query->free_result();
        $data = array('id' => $result['id'], 'name' => $result['title']);
        $items = $this->GetAllML('menu', $perPage = 0, $pageNum = 0, $where = array('section_id' => $section_id), $lang = ADMIN_DEF_LANG, $return = 'arr');

        $items_tree = treealize($items, 'id', 'pid', $data['id']);
        $items_tree = $this->Sort_Multidimension_Array($items_tree);
        $html = get_menu_html($section_id, $items_tree, $attributes);
        return array('name' => $data['name'], 'section_id' => $result['id'], 'html' => $html);
    }

    function GetAllML($tbl, $perPage = 0, $pageNum = 0, $where = 0, $lng = ADMIN_DEF_LANG, $return = 'obj')
    {
        $order_bay_pos = array('menu');
        $this->db->select("*");
        $this->db->from($tbl);
        $this->db->join($tbl . "_ml", $tbl . ".id = " . $tbl . "_ml.id", "LEFT");
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where(array($tbl . '_ml.lang' => $lng));
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if (in_array($tbl, $order_bay_pos)) {
            $this->db->order_by($tbl . ".pos", 'asc');
        } else {
            $this->db->order_by($tbl . ".id", 'DESC');
        }
        $query = $this->db->get();
        if ($return != 'obj') {
            $result = $query->result_array();
        } else {
            $result = $query->result();
        }
        $query->free_result();
        return $result;
    }

    function GetAllMenuML($tbl, $perPage = 0, $pageNum = 0, $where = 0, $lng = ADMIN_DEF_LANG, $return = 'obj')
    {
        $order_bay_pos = array('restaurants_menu');
        $this->db->select("*");
        $this->db->from($tbl);
        $this->db->join($tbl . "_ml", $tbl . ".id = " . $tbl . "_ml.id", "LEFT");
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where(array($tbl . '_ml.lang' => $lng));
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if (in_array($tbl, $order_bay_pos)) {
            $this->db->order_by($tbl . ".pos", 'asc');
        } else {
            $this->db->order_by($tbl . ".id", 'DESC');
        }
        $query = $this->db->get();
        if ($return != 'obj') {
            $result = $query->result_array();
        } else {
            $result = $query->result();
        }
        $query->free_result();
        return $result;
    }

    public function GetRestaurantsMenuBySectionsId($section_id, $attributes = array())
    {
        $this->db->select("*");
        $this->db->from('restaurants');
        $this->db->join("restaurants_ml", "restaurants.id = restaurants_ml.id", "LEFT");
        $this->db->where(array('restaurants_ml.lang' => 'en', 'restaurants.id' => $section_id));
        $query = $this->db->get();
        $result = $query->row_array();
        $query->free_result();

        $data = array('id' => $result['id'], 'name' => $result['title']);

        $items = $this->GetAllML('restaurants_menu', $perPage = 0, $pageNum = 0, $where = array('restaurants_menu.section_id' => $section_id), $lang = ADMIN_DEF_LANG, $return = 'arr');

//        last_sql();
//        pre($items, 1);

        $items_tree = treealize($items, 'id', 'pid', $data['id']);
        $items_tree = $this->Sort_Multidimension_Array($items_tree);
        // pre($items_tree );
        $html = restaurants_menu_html($section_id, $items_tree, $attributes);

        $result = array('name' => $data['name'], 'section_id' => $result['id'], 'html' => $html);

        return $result;
    }

    function GetRestaurantsAllML($tbl, $perPage = 0, $pageNum = 0, $where = 0, $lng = ADMIN_DEF_LANG, $return = 'obj')
    {
        $order_bay_pos = array('restaurants_menu');
        $this->db->join($tbl . "_ml", $tbl . ".id = " . $tbl . "_ml.id", "LEFT");
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where(array($tbl . '_ml.lang' => $lng));
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if (in_array($tbl, $order_bay_pos)) {
            $this->db->order_by($tbl . ".pos", 'asc');
        } else {
            $this->db->order_by($tbl . ".id", 'DESC');
        }
        $query = $this->db->get();
        if ($return != 'obj') {
            $result = $query->result_array();
        } else {
            $result = $query->result();
        }
        $query->free_result();
        return $result;
    }

    private function Sort_Multidimension_Array(&$categories_tree)
    {
        if (!function_exists('cmp_by_optionNumber')) {
            function cmp_by_optionNumber($a, $b)
            {
                return $a["pos"] - $b["pos"];
            }
        }
        usort($categories_tree, "cmp_by_optionNumber");
        foreach ($categories_tree as &$v) {
            if (isset($v['children'])) {
                $this->Sort_Multidimension_Array($v['children']);
            }
        }
        return $categories_tree;
    }

    public function MenuEdit($menu)
    {
        if (!empty($menu)) {
            foreach ($menu as $item) {
                $this->db->where('id', $item['id']);
                $this->db->update('menu', array('pid' => $item['pid'], 'pos' => $item['pos']));
            }
        }
        return true;
    }

    public function RestaurantMenuEdit($items)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->db->where('id', $item['id']);
                $this->db->update('restaurants_menu', array('pid' => $item['pid'], 'pos' => $item['pos']));
            }
        }
        return true;
    }

    function Get($tbl, $id, $where = false)
    {
        $this->db->select("*");
        $this->db->from($tbl);
        $this->db->where(array('id' => $id));
        if ($where) {
            $this->db->where($where);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        $user = $query->first_row();
        $query->free_result();
        return $user;
    }

    function GetML($tbl, $id, $where = false)
    {
        $this->db->select("*");
        $this->db->from($tbl . "_ml");
        $this->db->where(array($tbl . '_ml.id' => $id));
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetCount($tbl, $where = 0, $lng = ADMIN_DEF_LANG)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->num_rows();
        $query->free_result();
        return $result;
    }

    function GetAll($tbl, $perPage = 0, $pageNum = 0, $where = 0, $order = 0)
    {
        $this->db->select("*");
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if ($order) {
            foreach ($order as $k => $v) {
                $this->db->order_by($tbl . "." . $k, $v);
            }
        } else {
            $this->db->order_by($tbl . ".status", 'ASC');
            $this->db->order_by($tbl . ".id", 'DESC');
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetAll1($tbl, $perPage = 0, $pageNum = 0, $where = 0, $order = 0)
    {
        $this->db->select("*");
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if ($order) {
            foreach ($order as $k => $v) {
                $this->db->order_by($tbl . "." . $k, $v);
            }
        } else {
            $this->db->order_by($tbl . ".id", 'DESC');
        }

        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetAllArm($tbl, $perPage = 0, $pageNum = 0, $where = 0, $order = 0)
    {
        $this->db->select("*");
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }

        $this->db->order_by($tbl . ".date", 'ACK');
        $this->db->order_by($tbl . ".status", 'DESC');


//        echo '<pre>';
//        print_r($this->db->get_compiled_select());
//        exit;
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetAllGroup($tbl, $perPage = 0, $pageNum = 0, $where = 0, $order = 0)
    {
        $this->db->select($tbl . ".* , COUNT(table_number) as count_t");
        $this->db->from($tbl);
        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        $this->db->group_by('table_number');
        if ($order) {
            foreach ($order as $k => $v) {
                $this->db->order_by($tbl . "." . $k, $v);
            }
        } else {
            $this->db->order_by($tbl . ".id", 'DESC');
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetAllRestaurants($tbl, $perPage = 0, $pageNum = 0, $where = 0, $order = 0)
    {
        $this->db->select("*");
        $this->db->from($tbl);
        $this->db->where('lang', 'en');
        $this->db->join($tbl . "_ml", $tbl . ".id = " . $tbl . "_ml.id", "LEFT");
        if ($where) {
            $this->db->where($where);
        }
        if ($perPage) {
            $this->db->limit($perPage, $pageNum);
        }
        if ($order) {
            foreach ($order as $k => $v) {
                $this->db->order_by($tbl . "." . $k, $v);
            }
        } else {
            $this->db->order_by($tbl . ".status", 'ASC');
            $this->db->order_by($tbl . ".id", 'DESC');
        }
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }


    function GetWhere($tbl, $where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->first_row();
        $query->free_result();
        return $result;
    }

    function GetMLWhere($tbl, $where, $lang = false)
    {
        if ($lang) {
            $lng = ADMIN_DEF_LANG;
        }
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->join($tbl . "_ml", $tbl . ".id = " . $tbl . "_ml.id", "LEFT");
        if ($lang) {
            $lng = ADMIN_DEF_LANG;
            $this->db->where(array($tbl . '_ml.lang' => $lng));
        }
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->result();
        if ($lang) {
            $result = $query->row();
        }
        $query->free_result();
        return $result;
    }

    function GetWhereList($tbl, $where)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function is_unique_field_by_id($val, $field)
    {
        list($tbl, $field, $fid, $vid) = explode('.', $field);
        if ($vid) {
            $query = $this->db->limit(1)->get_where($tbl, array('`' . $tbl . '`.`' . $field . '`' => $val, '`' . $tbl . '`.`' . $fid . '` !=' => $vid));
        } else {
            $query = $this->db->limit(1)->get_where($tbl, array($tbl . '.' . $field => $val));
        }
        return $query->num_rows() === 0;
    }

    function Update($tbl, $data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($tbl, $data);
        return $id;
    }

    function UpdateML($tbl, $items, $values)
    {
        $sql = "REPLACE INTO {$tbl}_ml ($items) VALUES ($values)";
        $this->db->query($sql);
        return;
    }

    function UpdateRestML($id, $data, $lang)
    {
        $this->db->select('uid');
        $this->db->from('restaurants_menu_ml');
        $this->db->where('id', $id);
        $this->db->where('lang', $lang);
        $query = $this->db->get();
        $uid = $query->result_array();
        $this->db->where('uid', $uid['0']['uid']);
        $this->db->update('restaurants_menu_ml', $data);


        return $uid;
    }

    function UpdateWhere($tbl, $data, $where)
    {
        $this->db->where($where);
        $upd = $this->db->update($tbl, $data);
        return $upd;
    }

    function Update_new_ML($tbl, $data, $id, $lang)
    {
        $this->db->where('id', $id);
        $this->db->where('lang', $lang);
        $this->db->update($tbl, $data);
        return $id;
    }

    function Insert($tbl, $data)
    {
        $this->db->insert($tbl, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function InsertML($tbl, $data)
    {
        $this->db->insert("{$tbl}_ml", $data);
        return;
    }

    function Remove($tbl, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($tbl);
        return $id;
    }

    function RemoveWhere($tbl, $where)
    {
        $this->db->where($where);
        $del = $this->db->delete($tbl);
        return $del;
    }

    function RemoveML($tbl, $id)
    {
        $this->db->where("{$tbl}_ml.id", $id);
        $this->db->delete("{$tbl}_ml");
        return $id;
    }

    function Toggle($tbl, $id, $fld = 'status')
    {
        $query = "UPDATE {$tbl} SET {$fld} = 1 - {$fld} WHERE id = {$id}";
        $this->db->query($query);
        return $id;
    }

    function GetMenus($tbl, $sectionId, $where = 0)
    {
        $fields = array($tbl . '.url', $tbl . '_ml.title', $tbl . '.status', $tbl . '.id', $tbl . '.section_id', $tbl . '.pid', $tbl . '.pos');
        $this->db->select($fields);
        $this->db->from($tbl);
        $this->db->join($tbl . '_ml', $tbl . '_ml.id = ' . $tbl . '.id', 'LEFT');
        $this->db->where(array($tbl . '.section_id' => $sectionId, $tbl . '_ml.lang' => ADMIN_DEF_LANG));
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by('pos', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetParentMenus($tbl, $id, $menuId = 0)
    {
        if ($menuId) {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->join($tbl . '_ml', $tbl . '_ml.id = ' . $tbl . '.id', 'LEFT');
            $this->db->where(array($tbl . '.id !=' => $id, $tbl . '.pid !=' => $id, $tbl . '.section_id' => $id, $tbl . '_ml.lang' => ADMIN_DEF_LANG));
            $query = $this->db->get();
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->join($tbl . '_ml', $tbl . '_ml.id = ' . $tbl . '.id', 'LEFT');
            $this->db->where(array($tbl . '.section_id' => $id, $tbl . '_ml.lang' => ADMIN_DEF_LANG));
            $query = $this->db->get();
            $result = $query->result();
            $query->free_result();
            return $result;
        }
    }

    function GetChildMenus($menuId)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menu.pid', $menuId);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function GetSlug($tbl, $slug, $id = 0)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($tbl . ".url", $slug);
        if ($id) {
            $this->db->where($tbl . ".id <>", $id);
        }
        $query = $this->db->get();

        $result = $query->result();
        $query->free_result();
        return $result;
    }

    function Export($tbl, $flds = "*")
    {
        $this->db->select($flds);
        $this->db->from($tbl);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        $results = $query->result();
        $query->free_result();

        $file = 'export_' . $tbl;
        $comma = "";

        $i = 0;
        $csv_output = '';
        $fields = array();
        if ($flds == "*") {
            $sql = "SHOW COLUMNS FROM `{$tbl}`";
            $query = $this->db->query($sql);
            $flds = $query->result();

            foreach ($flds as $fld) {
                $fields[] = $fld->Field;
                $csv_output .= $comma . '"' . $fld->Field . '"';
                $comma = ",";
            }
        } else {
            $fields = $flds;
            foreach ($flds as $fld) {
                $csv_output .= $comma . '"' . $fld . '"';
                $comma = ",";
            }
        }
        $csv_output .= "\n";
        foreach ($results as $res) {
            $comma = "";
            foreach ($fields as $fld) {
                if ($fld == 'date') {
                    $str = date("d/m/Y", $res->$fld);
                } elseif ($fld == 'start_time') {
                    $h = (intval($res->$fld / 60) < 10) ? '09' : intval($res->$fld / 60);
                    $m = (intval($res->$fld % 60) == 0) ? '00' : intval($res->$fld % 60);
                    $str = $h . ":" . $m;
                } else {
                    $str = mb_convert_encoding($res->$fld, mb_detect_encoding($res->$fld), 'UTF-8');
                }
                $csv_output .= $comma . '"' . $str . '"';
                $comma = ",";
            }
            $csv_output .= "\n";
        }

        $filename = $file . "_" . date("Y-m-d_H-i", time());
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: csv" . date("Y-m-d") . ".csv");
        header("Content-disposition: filename=" . $filename . ".csv");
        print $csv_output;
        exit;
    }

    function GetCountMl($tbl, $where = 0, $lng = ADMIN_DEF_LANG)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->join($tbl . "_ml", $tbl . ".id = " . $tbl . "_ml.id", "LEFT");
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result = $query->num_rows();
        $query->free_result();
        return $result;
    }

}
