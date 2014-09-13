<?php

class My_wishlist_model extends CI_Model {

    function add_wishlist($data) {
        $this->db->insert('user_wishlist', $data);
        return $this->db->insert_id();
    }

    function get_items_for_user($user) {

        $queryline = "SELECT ws.adid,ad.image,ad.title,ad.quantity,ad.price 
            FROM user_wishlist ws,ads ad,users us WHERE ad.adid=ws.adid AND 
        us.userid=ws.userid AND ws.userid='$user' ORDER BY ws.added_date";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function delete_wishlist($adid, $user) {
        $this->db->delete('user_wishlist', array('adid' => $adid, 'userid' => $user));
    }
    
    function validate_item($adid){
        
        $this->db->select('adid');
        $this->db->from('user_wishlist');
        $this->db->where('adid', $adid);        
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}