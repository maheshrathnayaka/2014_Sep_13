<?php
class Advanced_Search_Model extends CI_Model {
    function get_category_list(){
        $queryline = "SELECT categoryname FROM category WHERE istopcategory=1";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_ads_list($keyword){
        $queryline = "select distinct a.adid as 'adid', a.image, a.title, a.price from ads a, users u where u.userid=a.sellerid and u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' and a.status='active';";
//        var_dump($queryline);
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_matching_items_al_wrd_any_or($words){
        $queryline = "SELECT distinct a.adid as 'adid', a.image, a.title, a.price "
                . "FROM ads a, users u "
                . "WHERE u.userid=a.sellerid AND ";
        $sql_end = '';
        foreach ($words as $word) {
            $sql_end .= " AND a.title LIKE '%{$word}%'";
        }
        $sql_end = substr($sql_end, 4);
        $queryline = $queryline . $sql_end;
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_matching_items_any_wrd_any_or($words){
        $queryline = "SELECT distinct a.adid as 'adid', a.image, a.title, a.price "
                . "FROM ads a, users u "
                . "WHERE u.userid=a.sellerid AND ";
        $sql_end = '';
        foreach ($words as $word) {
            $sql_end .= " OR a.title LIKE '%{$word}%'";
        }
        $sql_end = substr($sql_end, 4);
        $queryline = $queryline . $sql_end;
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_matching_items_ex_wrd_ex_or($words){
        $queryline = "SELECT distinct a.adid as 'adid', a.image, a.title, a.price "
                . "FROM ads a, users u "
                . "WHERE u.userid=a.sellerid AND ";
        $sql_end = '';
        foreach ($words as $word) {
            $sql_end .= " AND a.title LIKE '%{$word}%'";
        }
        $sql_end = substr($sql_end, 4);
        $queryline = $queryline . $sql_end;
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_matching_items_ex_wrd_any_or($words){
        $queryline = "SELECT distinct a.adid as 'adid', a.image, a.title, a.price "
                . "FROM ads a, users u "
                . "WHERE u.userid=a.sellerid AND ";
        $sql_end = '';
//        echo $queryline;
        foreach ($words as $word) {
            $sql_end .= " OR a.title LIKE '%{$word}%'";
        }
        $sql_end = substr($sql_end, 4);
        $queryline = $queryline . $sql_end;
        $query = $this->db->query($queryline);
//        echo $queryline;
        return $query->result_array();
    }
}
/* End of file advanced_search_model.php */
/* Location: ./application/models/advanced_search_model.php */
