<?php

class MprofileUpdate extends CI_Model {

    function get_user_info($session_data) {
        $userid = $session_data['userid'];
        $this->db->select()->from('users')->where('userid', $userid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function upddatagenaral($data) {
        extract($data);
        $this->db->where('email', $email);
        $this->db->update('users', array(
            'first_name' => $fname,
            'last_name' => $lname,
            'telephone' => $phone,
            'security_question' => $question,
            'security_answer' => $answer
        ));
        return true;
    }

    public function upddataaddress($data) {
        extract($data);
        $this->db->where('email', $email);
        $this->db->update('users', array(
            'address_1' => $address1,
            'address_2' => $address2,
            'province' => $province,
            'city' => $city
        ));
        return true;
    }
    
    public function update_password($data) {
        extract($data);
        $this->db->where('email', $email);
        $this->db->update('users', array(
            'password ' => md5($new_password)
        ));
        return true;
    }
    
    public function check_password($data){
        extract($data);
        $queryline="SELECT password FROM users WHERE email='$email'";
        $query=$this->db->query($queryline);
        return $query->row();
    }
}
