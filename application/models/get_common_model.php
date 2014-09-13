<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Get_Common_model
 *
 * @author Hasith Malinga
 */
class Get_Common_model extends CI_Model {

    function get_sellerID($id) {

        $this->db->select('sellerid');
        $this->db->from('ads');
        $this->db->where('adid', $id);
        $this->db->limit(1);

        $query = $this->db->get();
        $sellerid = null;
        //var_dump($query);
        if ($query->num_rows > 0) {

            foreach ($query->result() as $row) {
                $sellerid = $row->sellerid;
            }
        }
        return $sellerid;
    }
    
    function get_user_data($id) {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $id);
        $this->db->limit(1);
        
       // $query = $this->db->get_where('users', array('email' => $id));

        $query = $this->db->get();       
        
        return $query->row_array();
    }

}

/* End of file Get_Common_model.php */
/* Location: ./application/models/Get_Common_model.php */
