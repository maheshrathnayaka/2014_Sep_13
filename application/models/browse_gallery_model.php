<?php

class Browse_Gallery_Model extends CI_Model {

    private $all_ads = array();
    private $cat_path = array();

    function get_gallery_ads() {
        $this->db->select()->from('ads')->where('status', 'active')->order_by("datesubmitted", "desc")->limit(12);
        $query = $this->db->get();
        return $query->result_array();
    }
    

    function get_ip_details_by_ip($ip) {
        $this->db->select()->from('ip_categories')->where('ip', $ip)->order_by("timestamp", "desc")->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_gallery_ads_bycat($catid) {
        $this->get_gallery_ads_recurse($catid);
        $rows = $this->sort_by_date($this->all_ads);
        return $rows;
    }

    function get_gallery_ads_by_adid($ads_arr) {
        $this->db->select()->from('ads');
        $this->db->where_in('adid', $ads_arr);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_gallery_ads_recurse($catid) {
        $this->db->select()->from('category')->where('parentcategory', $catid);
        $query = $this->db->get();
        $is_subcat = false;

        foreach ($query->result_array() as $row) {
            $is_subcat = true;
            $subcat_id = $row['categoryid'];
            $this->get_gallery_ads_bycat($subcat_id);
        }

        if ($is_subcat == false) {
            $this->db->select()->from('ads')->where(array('categoryid' => $catid, 'status' => 'active'));
            $query = $this->db->get();
            $result = $query->result_array();
            $all_ads = $this->all_ads;
            $this->all_ads = array_merge_recursive($all_ads, $result);
        }
    }
///////////////////////////////////////////////////////
    function get_ip_details_by_user($userid)//get recommoend catids 
    {
        $this->db->select()->from('ip_categories')->where('userid', $userid)->order_by("frequency", "desc")->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_slider_catid($userid)
    {
        $queryline = "SELECT catid FROM ip_categories WHERE userid='$userid' order by timestamp desc limit 1";
        $query1 = $this->db->query($queryline);
        return $query1->result_array();
    }
    
    function get_slider_ads_bycat($catid) //get recommoend ads
    {

        $count = 0;
        foreach ($catid as $row) {
            if ($count == 0) {
                $sterincat = $row;
            } else {
                $sterincat = $row . ',' . $sterincat;
            }
            $count++;
        }

        $queryline = "SELECT * FROM ads WHERE status='active' and categoryid IN ($sterincat) order by datesubmitted desc limit 15";
        $query1 = $this->db->query($queryline);
        return $query1->result_array();
    }
    

    function get_slider_adid($catid) 
    {
       $queryline = "SELECT * FROM ads WHERE status='active' and categoryid=$catid order by datesubmitted desc limit 12";
        $query1 = $this->db->query($queryline);
        return $query1->result_array();
    }
 ////////////////////////////////////////////////////   
    
    
    
    

    function get_ads_by_keyword_and_cat($catid,$keyword) {
        $this->get_gallery_ads_recurse($catid);
        
        $ads='';
        foreach ($this->all_ads as $row){
            $ads=$ads . ',' . $row['adid']; 
        }
        $ads = substr($ads, 1);
        
        $queryline = "SELECT * FROM ads WHERE status='active' and adid in($ads) and title like '%$keyword%' order by datesubmitted desc limit 12";
        $query1 = $this->db->query($queryline);
        return $query1->result_array();
    }
    
    function get_ads_by_keyword($keyword) {
        
        $queryline = "SELECT * FROM ads WHERE status='active' and  (title like '%$keyword%' or title='$keyword') order by datesubmitted desc limit 12";
        $query1 = $this->db->query($queryline);
        return $query1->result_array();
    }

    function get_category_name($catid) {
        $this->db->select()->from('category')->where('categoryid', $catid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_categories() {
        $this->db->select()->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_category_path($catid) {
        $this->get_category_path_recurse($catid);
        return $this->cat_path;
    }

    function get_category_path_recurse($catid) {
        $this->db->select()->from('category')->where('categoryid', $catid);
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $parent_id = $row['parentcategory'];
            $result = $query->result_array();
            $cat_path = $this->cat_path;
            $this->cat_path = array_merge_recursive($cat_path, $result);

            if ($parent_id != 0) {
                $this->get_category_path_recurse($parent_id);
            }
        }
    }

    function get_child_categories($catid) {
        $this->db->select()->from('category')->where('parentcategory', $catid);
        $query = $this->db->get();
        return $query->result_array();
    }

    function sort_by_date($rows) {
        $date = array();
        foreach ($rows as $key => $row) {
            $date[$key] = $row['datesubmitted'];
        }
        array_multisort($date, SORT_DESC, $rows);

        return $rows;
    }

    function insert_user_ip($data) {
        $this->db->insert('ip_records', $data);
        return $this->db->insert_id();
    }

    function get_top_categories() {
        $this->db->select()->from('category')->where('istopcategory', 1)->order_by("categoryname", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_search_strings() {
        $this->db->select()->from('ad_search_strings');
        $query = $this->db->get();
        return $query->result_array();
    }

    function order_by_lowest_price($ads) {
        $strids = '';
        foreach ($ads as $ad) {
            $strids = $strids . ',' . $ad;
        }
        $strids = substr($strids, 1);
        $queryline = 'SELECT * FROM ads WHERE adid IN (' . $strids . ') order by price';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function order_by_highest_price($ads) {
        $strids = '';
        foreach ($ads as $ad) {
            $strids = $strids . ',' . $ad;
        }
        $strids = substr($strids, 1);
        $queryline = 'SELECT * FROM ads WHERE adid IN (' . $strids . ') order by price desc';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function order_by_recent($ads) {
        $strids = '';
        foreach ($ads as $ad) {
            $strids = $strids . ',' . $ad;
        }
        $strids = substr($strids, 1);
        $queryline = 'SELECT * FROM ads WHERE adid IN (' . $strids . ') order by datesubmitted desc';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_ads_by_attributes($select, $from, $where) {
        $queryline = "SELECT a.*" . $select .
                " FROM ads a" . $from .
                " WHERE 1=1" . $where.
                " ORDER BY a.datesubmitted DESC";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_locations() {
        $this->db->select()->from('locations');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_kstore_locations() {
        $queryline = 'SELECT DISTINCT(city) 
                 FROM kstores';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_multi_attributes($category) {
        $queryline = 'SELECT * 
                 FROM attributes
                 WHERE categoryid="' . $category . '" AND htmlcomponent="Drop Down"';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_attribute_values($attr) {
        $queryline = 'SELECT * 
                 FROM  attributes_drop_down_values
                 WHERE attributeid=' . $attr;
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

}

