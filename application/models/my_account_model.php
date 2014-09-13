<?php

class My_Account_Model extends CI_Model {
    
    function get_user_details($userid){
        $this->db->select()->from('users')->where('userid',$userid)->limit(1,0);
        $query=$this->db->get();
        return $query->result_array();
    }
    
    function get_feedbacks($sellerid){
        $queryline='SELECT rf.feedback, rf.feedbackstatus, rf.timestamp, rf.rating, u.first_name, a.title, a.adid 
                    FROM reviewsandfeedbacks rf, users u, ads a,orderlines o, orders ord 
                    WHERE rf.sellerid='.$sellerid.' AND 
                        o.buyerid !=0 AND
                        rf.feedbackstatus=1 AND 
                        rf.orderlineid=o.orderlineid AND
                        o.buyerid=u.userid AND
                        o.orderid=ord.orderid AND
                        o.adid=a.adid'.
                        ' ORDER BY ord.timestamp DESC
                        LIMIT 10';;
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_reward_points($userid){
        $queryline='SELECT SUM(rewardpointsearned) AS points 
            FROM orders 
            WHERE buyer_id='.$userid.
            ' GROUP BY buyer_id';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_active_ads($userid){
        $this->db->select()->from('ads')->where(array('sellerid'=>$userid, 'status'=>'active'));
        $query=$this->db->get();
        return $query->result_array();
    }
    
    function get_sold_ads($userid){
        $queryline='SELECT a.*,o.timestamp 
            FROM ads a, orders o, orderlines ol
            WHERE a.adid=ol.adid AND 
            ol.orderid=o.orderid AND
            ol.sellerid='.$userid.
            ' ORDER BY o.timestamp DESC
            LIMIT 10';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_ratings($userid){
        $queryline='SELECT AVG(rating) AS rating_avg, COUNT(rating) AS rating_cnt 
            FROM reviewsandfeedbacks 
            WHERE sellerid='.$userid.
            ' AND feedbackstatus=1    
            GROUP BY sellerid';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
}

