<?php
class Seller_Reg_Model extends CI_Model{


	function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
    
    public function verifyseller($data,$name)
    {
       
        $this->db->where('first_name', $name);
        $this->db->update('users', $data);
        return true;
    }
	


}