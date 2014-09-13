<?php

class live_search_model extends CI_Model
{
    
    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
    
    public function live($id)
    {
    $queryline ="SELECT title,location FROM ads WHERE title like '%$id%' order by adid LIMIT 5" ;
    $query1 = $this->db->query($queryline);   
    return $query1->result(); 
    }
    
}