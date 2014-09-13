<?php

class tag_cloud_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function newGetMax()
    {
        $queryline = "select i.catid as catid,c.categoryname as catname,sum(i.frequency) as max from ip_categories i,category c where i.catid=c.categoryid group by i.catid order by sum(i.frequency) desc limit 10";
        $query1 = $this->db->query($queryline);
        return $query1->result();
    }

    public function getMax() {
        $queryline = "SELECT MAX(frequency) as num FROM tag_cloud";
        $query1 = $this->db->query($queryline);
        return $query1->result();
    }

    public function getTags() {
        $queryline = "SELECT * FROM tag_cloud";
        $query1 = $this->db->query($queryline);
        return $query1->result();
    }

}
