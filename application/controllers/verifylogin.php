<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
    }

    function index() {
        //This method will have the credentials validation
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error"><p class="text-danger"><small>** ', '</small></p></div>');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed. User redirected to login page
            $this->load->view('login_view');
        } else {
            $result = $this->cart->contents();
            if (!empty($result)) {
                redirect('cart', 'refresh');
            } else {
                $email = $this->session->userdata['logged_in']['email'];
                $this->user->update_user_visits($email);
                redirect('home', 'refresh');
            }
        }
    }

    function check_database($password) {
        //Field validation succeeded. Validate against database
        $email = $this->input->post('email');

        //query the database
        $result = $this->user->login($email, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'userid' => $row->userid,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'email' => $row->email,
                    'is_admin' => $row->is_admin
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid email or password');
            return false;
        }
    }

}

?>
