<?php

class Auto_complete_model extends CI_Model{


    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
   public function getvalue($data) 
    {
        $queryline = "SELECT tagName FROM tag_cloud WHERE tagName LIKE '%$data' ORDER BY tagName";
        $query1 = $this->db->query($queryline);
        return $query1->result();
    }
}