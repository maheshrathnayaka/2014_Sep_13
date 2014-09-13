<?php

class Faq extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model('ad_details_model');
    }

    public function index() {
        $this->load->view('faq_view');
    }
}
