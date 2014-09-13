<?php

class View_k_stores_model extends CI_Model{


    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
     
    
    function getLatLng() 
    {
        $queryline = "SELECT kstoreid,addressline,city,telephone,lat,lng FROM kstores";       
        $query1 = $this->db->query($queryline);       
        return $query1->result();
    }
    function removeKstore($param) 
    {
        $queryline = "DELETE FROM kstores WHERE kstoreid='$param'";      
        $query1 = $this->db->query($queryline);       
        return $query1->result();
    }
    
    
}