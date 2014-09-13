<?php

class Check_Seller_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function getinfo($data) {
        $this->db->select()->from('users')->where('email', $data);
        $query = $this->db->get();
        return $query->row_array();
    }

}

/* End of file check_seller_model.php */
/* Location: ./application/controllers/check_seller_model.php */
