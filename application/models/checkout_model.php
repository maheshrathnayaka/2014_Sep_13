<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Checkout_model
 *
 * @author Hasith Malinga
 */
class Checkout_model extends CI_Model {

    function save_order($data) {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    function save_orderline($data) {
        $this->db->insert('orderlines', $data);
        return $this->db->insert_id();
    }
    
    function save_orderfeedbacks($data){
        $this->db->insert('reviewsandfeedbacks', $data);
        return $this->db->insert_id();
    }

    function update_qty($adid, $qty) {

        $this->db->select('quantity');
        $this->db->from('ads');
        $this->db->where('adid', $adid);
        $query = $this->db->get();
        $tot_qty=$query->row()->quantity;
        
        $final_qty=$tot_qty-$qty;

        $this->db->update('ads', array('quantity' => $final_qty), array('adid' => $adid));
    }

}

/* End of file Checkout_model.php */
/* Location: ./application/models/Checkout_model.php */
