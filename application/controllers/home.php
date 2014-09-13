
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('browse_gallery_model');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('index', 'refresh');
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $result = $this->cart->contents();
        if (!empty($result)) {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('cart', 'refresh');
        } else {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('index', 'refresh');
        }
    }

}
?>

