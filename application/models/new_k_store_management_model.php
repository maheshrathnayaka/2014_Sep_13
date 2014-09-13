<?php

class New_K_Store_Management_Model extends CI_Model{

    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
    function setKStore($data)
    {
      $this->db->insert('kstores',$data);
      return $this->db->insert_id();
    }
}