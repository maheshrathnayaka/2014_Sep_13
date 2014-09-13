<?php

class My_subscriptions_model extends CI_Model {

    function get_categories() {
        $queryline = "SELECT categoryid,categoryname FROM category WHERE istopcategory=1";
        $query = $this->db->query($queryline);
        return $query->result();
    }

    function get_category_id() {
        $queryline = "SELECT categoryid FROM category WHERE istopcategory=1";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function add_subscribers($data) {
        $this->db->insert('subscribes', $data);
        return true;
    }
    
    function delete_existing_categories($user_id){
        $queryline="DELETE FROM subscribes WHERE userid='+$user_id+'";
        $query=$this->db->query($queryline);
        return true;
    }
    
    function get_subscribe_categories($user){
        $queryline="SELECT c.categoryname FROM subscribes s, category c  WHERE s.userid='+$user+' AND c.categoryid=s.categoryid";
//        $queryline="SELECT categoryid FROM subscribes WHERE userid='+$user+'";
        $query= $this->db->query($queryline);
        return $query->result_array();
    }

}

/* End of file my_subscriptions_model.php */
/* Location: ./application/models/my_subscriptions_model.php */