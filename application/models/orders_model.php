<?php
class Orders_model extends CI_Model {
    function get_new_order_count(){
        $queryline = "SELECT COUNT(*) AS `order_count` FROM orders WHERE DATE_SUB( CURDATE() , INTERVAL 1 DAY ) <= TIMESTAMP";
        $query = $this->db->query($queryline);
        return $query->row_array();
    }
    
    function get_email_list($category){
        $queryline = "SELECT email FROM category c, subscribes s, users u WHERE u.userid = s.userid AND s.categoryid = c.categoryid AND categoryname =  '$category';";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_order_list(){
        $queryline = "SELECT buyer_id, first_name, last_name, email, telephone, payment_method, ship_address_1, ship_address_2, ship_city, comment, total, timestamp FROM orders WHERE DATE_SUB( CURDATE( ) , INTERVAL 1 DAY ) <= TIMESTAMP";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_all_orders(){
        $queryline = "SELECT buyer_id, first_name, last_name, email, telephone, payment_method, ship_address_1, ship_address_2, ship_city, comment, total, timestamp FROM orders";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }
    
    function get_all_orders_count(){
        $queryline = "SELECT COUNT(*) AS `order_count` FROM orders";
        $query = $this->db->query($queryline);
        return $query->row_array();
    }
}
/* End of file orders_model.php */
/* Location: ./application/models/orders_model.php */
