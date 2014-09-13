
<?php

Class User extends CI_Model {

    function login($email, $password) {
        $this->db->select('userid, first_name, last_name, email, password, is_admin');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_user_info($email) {
        $this->db->select('userid, first_name, last_name, email, password, is_admin');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->result();
    }

    function insert_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    function verify_user_email($email) {
        $this->db->select('email')->from('users')->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_hash_value($email) {
        $this->db->select('hash')->from('users')->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    function activate_user($email) {
        $data = array('active_status' => 1);
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }
    
    function insert_token_fgtpassword($email,$token){        
        $token_data = array('password_token' => $token);
        $this->db->where('email', $email);
        $this->db->update('users', $token_data);
    }
    
    function get_token($email){
        $this->db->select('password_token')->from('users')->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function update_password($email,$password){
        $pass = array(
            'password' => md5($password),
            'password_token' => NULL
            );
        $this->db->where('email', $email);
        $this->db->update('users', $pass);
    }


    function update_user_visits($email) {
        $this->load->helper('date');
        $datestring = "%Y-%m-%d %h:%i:%a";
        $visit = null;
        $time = time();

        $this->db->select('visit_count')->from('users')->where('email', $email);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $visit = $row->visit_count;
        }
        $visit_data=array(
            'last_visited_date' => mdate($datestring, $time),
            'visit_count' => $visit + 1
        );
        $this->db->where('email', $email);
        $this->db->update('users', $visit_data);
    }

}

