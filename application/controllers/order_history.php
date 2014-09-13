<?php

class Order_History extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('order_history_model');
    }

    public function index() {
        if (isset($_GET['userid'])) {
             $userid = $_GET['userid'];
             $data['otheruser']=$_GET['userid'];;
        }else{
            $userid = $this->session->userdata['logged_in']['userid'];
        }
        $data['purchased_items']=$this->order_history_model->get_purchased_items($userid);
        $this->load->view('order_history_view', $data);
        
    }
    
    public function add_feedback() {
        $inputs['id']=$_POST['feedback_id'];
        $inputs['feedback']=$_POST['feedback'];
        $inputs['rating']=$_POST['rating'];
        $this->order_history_model->add_item_feedback($inputs);
        redirect(base_url("/order_history"));
    }
    
    public function add_review() {
        $inputs['id']=$_POST['review_id'];
        $inputs['review']=$_POST['review'];
        $this->order_history_model->add_item_review($inputs);
        redirect(base_url("/order_history"));
    }
}
