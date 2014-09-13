<?php
class Send_news_letters_model extends CI_Model {
    function get_category_list(){
        $queryline = "SELECT categoryname FROM category WHERE istopcategory=1";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_email_list($category){
        $queryline = "SELECT email FROM category c, subscribes s, users u WHERE u.userid = s.userid AND s.categoryid = c.categoryid AND categoryname =  '$category';";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
}
/* End of file send_news_letters_model.php */
/* Location: ./application/models/send_news_letters_model.php */
