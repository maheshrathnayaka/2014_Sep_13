<?php

class My_Account extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('my_account_model');
    }

    public function index() {
        if (isset($_GET['userid'])) {
             $userid = $_GET['userid'];
             $data['otheruser']=$_GET['userid'];;
        }else{
            $userid = $this->session->userdata['logged_in']['userid'];
        }
        $data['reward']=$this->my_account_model->get_reward_points($userid);
        $data['rating']=$this->my_account_model->get_ratings($userid);
        $data['user']=$this->my_account_model->get_user_details($userid);
        $data['feedbacks']=$this->my_account_model->get_feedbacks($userid);
        $data['active_ads']=$this->my_account_model->get_active_ads($userid);
        $data['sold_ads']=$this->my_account_model->get_sold_ads($userid);
        $this->load->view('my_account_view', $data);
    }
}
