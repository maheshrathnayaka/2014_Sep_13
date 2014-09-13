<?php
class K_Store_Management_Model extends CI_Model{

    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
    
     public function insertdata($data)
    {
		
        $this->db->insert('kstores',$data);
        return $this->db->insert_id();
     }
     
  
	
    
}