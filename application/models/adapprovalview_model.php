<?php

class Adapprovalview_Model extends CI_Model
{
     function get_ad_details($ad_id){
        $this->db->select()->from('ads')->where('adid',$ad_id)->limit(1,0);
        $query=$this->db->get();
        return $query->result_array();
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
    public function approve_advertisement($status, $adid){
        $this->db->where('adid', $adid);
        $this->db->update('ads',array(
            'status'=>$status
        ));
        return true;
    }
}