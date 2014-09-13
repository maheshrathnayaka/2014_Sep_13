<?php
class Ad_post_model extends CI_Model{


	function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
	

	public function submitad($data)
	{
		
        $this->db->insert('ads',$data);
        return $this->db->insert_id();
	}
}