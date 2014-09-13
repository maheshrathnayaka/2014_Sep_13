<?php
class New_ad_post_model extends CI_Model{


    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
	
    function getCategory() 
    {
        $queryline = "SELECT categoryid,categoryname,parentcategory,isendnode FROM category";       
        $query1 = $this->db->query($queryline);       
        return $query1->result();
    }
    
    
    function getSubCategory($category)
    {
        $queryline = "SELECT categoryid,categoryname,parentcategory,isendnode FROM category WHERE parentcategory='$category'" ;
        $query1 = $this->db->query($queryline);   
        return $query1->result();
    }
    
    
    function getCategoryFields($category)
    {
        $queryline = "SELECT attributeid , attributename,htmlcomponent FROM attributes WHERE categoryid = '$category' " ;
        $query1 = $this->db->query($queryline);   
        return $query1->result();
    }
    
    
    function getCategoryselect($category)
    {
        $queryline = "SELECT valueid,attributeid,dropdownvalues FROM attributes_drop_down_values WHERE categoryid ='$category'";
        $query1 = $this->db->query($queryline);   
        return $query1->result();
    }
    
    
    function setAd($data) 
    {
      $this->db->insert('ads',$data);
      return $this->db->insert_id();  
    }
    
    function setAdValues($data)
    {
        $this->db->insert('attributes_values',$data);
        return $this->db->insert_id();
    }
            
    function setCoupon($data) {
        
        $this->db->insert('coupons',$data);
        return $this->db->insert_id();
        
    }
    function uploadImageName($data,$id)
    {
        
        $queryline = "update ads set image ='$data' where adid='$id'";
        $query1 = $this->db->query($queryline);   
        return $query1;
    
   
    }
    function uploadImagetoTable($data)
    {
        $this->db->insert('images',$data);
        return $this->db->insert_id();
    }
    
    function  save_search_string($data){
        
        $this->db->insert('ad_search_strings',$data);
        return $this->db->insert_id();
    }
    
    

    
    
}