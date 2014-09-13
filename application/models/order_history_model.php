<?php

Class Order_History_Model extends CI_Model {

    function get_purchased_items($userid) {
        $queryline = 'SELECT a.*,ol.*,rf.* 
            FROM ads a, orderlines ol, reviewsandfeedbacks rf
            WHERE a.adid=ol.adid AND 
            ol.orderlineid=rf.orderlineid AND
            ol.buyerid=' . $userid
            .' ORDER BY timestamp DESC';
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function add_item_feedback($inputs) {
        $queryline = 'UPDATE reviewsandfeedbacks
            SET feedbackstatus=1, rating=' . $inputs['rating']
                . ', feedback="' . $inputs['feedback']
                . '" WHERE reviewnfeedbackid	=' . $inputs['id'];
        $query = $this->db->query($queryline);
    }

    function add_item_review($inputs) {
        $queryline = 'UPDATE reviewsandfeedbacks
            SET reviewstatus=1, review="' . $inputs['review']
                . '" WHERE reviewnfeedbackid	=' . $inputs['id'];
        $query = $this->db->query($queryline);
    }

}
