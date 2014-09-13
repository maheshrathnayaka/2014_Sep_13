<?php

class My_Messages extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_messages_model');
    }

    public function index() {
        $email = $this->session->userdata['logged_in']['email'];
        $data['messages_inbox'] = $this->my_messages_model->get_inbox_messages($email);
        $data['messages_sent'] = $this->my_messages_model->get_sent_messages($email);
        $data['messages_trash'] = $this->my_messages_model->get_trash_messages($email);
        $this->load->view('my_messages_view', $data);
    }

    public function send_message() {
        $msg_data = $_POST['msgArray'];
        $sendMsg['subject'] = $msg_data['sub'];
        $sendMsg['msg'] = $msg_data['msg'];
        $sendMsg['sender'] = $msg_data['sender'];
        $sendMsg['user_id'] = $msg_data['user_id'];
        $sendMsg['receiver'] = $this->my_messages_model->get_receiver($sendMsg['user_id']);
        $status = $this->my_messages_model->save_message($sendMsg);
    }
}

/* End of file my_messages.php */
/* Location: ./application/controllers/my_messages.php */
