<?php
class Admin_model extends CI_Model {
    function check_user(){
        $queryline = "SELECT COUNT(*) AS `order_count` FROM orders WHERE DATE_SUB( CURDATE() , INTERVAL 1 DAY ) <= TIMESTAMP";
        $query = $this->db->query($queryline);
        return $query->row_array();
    }
    
    function verify_user($login_data){
        $username=$login_data['email'];
        $password=  md5($login_data['pw']);
        $queryline = "SELECT * FROM users WHERE email='$username' AND password='$password' AND is_admin='yes'";
//        var_dump($queryline);
        $query = $this->db->query($queryline);
        return $query->row_array();
    }
}
/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */
