<?php

class Ad_Details_Model extends CI_Model
{
     function get_ad_details($ad_id){
        $this->db->select()->from('ads')->where('adid',$ad_id)->limit(1,0);
        $query=$this->db->get();
        return $query->result_array();
    }
    
    function get_ad_category($ad_id){
        $this->db->select()->from('ads')->where('adid',$ad_id)->limit(1,0);
        $query=$this->db->get();
        return $query->row('categoryid');
    }
    
    function get_ad_images($ad_id){
        $this->db->select()->from('images')->where('adid',$ad_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    
    function get_seller_details($seller_id){
        $this->db->select()->from('users')->where('userid',$seller_id)->limit(1,0);
        $query=$this->db->get();
        return $query->result_array();
    }
    
    function insert_user_ip($data) {
        $this->db->insert('ip_categories', $data);
        return $this->db->insert_id();
    }
    
      
    //my func
    function check_user($user,$catid)
    {
        
        $queryline = "SELECT frequency FROM ip_categories WHERE userid='$user' AND catid='$catid' ";
        $query1 = $this->db->query($queryline);   
        return $query1->result();
    }           
    
    function insert_user_searched($data)
    {
        $this->db->insert('ip_categories', $data);
        return $this->db->insert_id();
    }
    
    function update_user_searched($data)
    {
        $userid=$data['userid'];
        $catid=$data['catid'];
        
        $queryline = "UPDATE ip_categories SET frequency=frequency+1 ,timestamp=now() WHERE userid='$userid' and catid='$catid'";
        $query1 = $this->db->query($queryline);   
        return $query1;
    }
    //end my func 
    
    function get_reviews($adid){
        $queryline = 'SELECT ol.adid,rf.review, u.first_name 
            FROM orderlines ol, reviewsandfeedbacks rf, users u
            WHERE ol.orderlineid=rf.orderlineid AND
            rf.reviewstatus=1 AND
            u.userid=ol.buyerid AND
            ol.adid=' . $adid;
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
        function get_multi_specifications($adid) {
        $queryline = "SELECT av.*, a.*, ddv.*
            FROM attributes_values av, attributes a, attributes_drop_down_values ddv
            WHERE a.attributeid=av.attributeid 
                AND av.attributevalue=ddv.valueid 
                AND av.adid=".$adid." 
            ORDER BY a.attributeid"; //OR a.htmlcomponent='Text Field'
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_single_specifications($adid) {
        $queryline = "SELECT av.*, a.*
            FROM attributes_values av, attributes a
            WHERE a.attributeid=av.attributeid 
                AND a.htmlcomponent='Text Field'
                AND av.adid=".$adid." 
            ORDER BY a.attributeid";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
}