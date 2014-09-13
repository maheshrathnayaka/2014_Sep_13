<?php

Class My_Messages_Model extends CI_Model {

    function get_inbox_messages($email) {
        $queryline = "SELECT * FROM messages m, users u WHERE m.sender = u.email AND m.receiver ='$email' AND m.is_trash='no';";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_sent_messages($email) {
        $queryline = "SELECT * FROM messages m, users u WHERE m.sender = u.email AND m.sender ='$email' AND m.is_trash='no';";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_trash_messages($email) {
        $queryline = "SELECT * FROM messages m, users u WHERE m.sender = u.email AND m.sender ='$email' AND m.is_trash='yes';";
        $query = $this->db->query($queryline);
        return $query->result_array();
    }

    function get_receiver($user_id) {
        $queryline = "SELECT * FROM users u WHERE u.userid='$user_id';";
        $query = $this->db->query($queryline);
        return $query->row_array();
    }

    function save_message($message) {
        $this->load->helper('date');
        $date_format = "%Y:%m:%d - %h:%i %A";
        $time_unix = time();
        $date_time = mdate($date_format, $time_unix);
        $date_array = explode(" - ", $date_time);
        $date = $date_array[0];
        $time = $date_array[1];
        $subject=$message['subject'];
        $msg=$message['msg'];
        $sender=$message['sender'];
        $receiver=$message['receiver']['email'];
        $queryline = "INSERT INTO messages(subject, msg, sender, receiver, date, time, read_status, is_trash, is_important) VALUES('$subject', '$msg', '$sender', '$receiver', '$date', '$time', 'pending', 'no', 'no');";
        $status = $this->db->query($queryline);
        return $status;
    }

}

/* End of file my_messages_model.php */
/* Location: ./application/models/my_messages_model.php */