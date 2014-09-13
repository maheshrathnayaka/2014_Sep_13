<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_management_model
 *
 * @author Hasith Malinga
 */
class User_Management_Model extends CI_Model{
    
    public function getAllUsers()
        {
        $this->db->select()->from('users');
        $this->db->order_by("visit_count", "desc");
        $this->db->distinct();
        $query = $this->db->get();
        return $query->result_array();
	}
}

/* End of file user_management_model.php */
/* Location: ./application/controllers/user_management_model.php */

