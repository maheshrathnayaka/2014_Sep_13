<?php

class My_wishlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('my_wishlist_model');
    }

    public function index() {
        $data['wishlist'] = $this->my_wishlist_model->get_items_for_user($this->session->userdata['logged_in']['userid']);
        $this->load->view('my_wishlist_view', $data);
    }

    function add_to_wishlist() {
        
        $adid = $_POST['adsArray']['ad'];
        $userid = $_POST['adsArray']['user'];
        
        if ($this->my_wishlist_model->validate_item($adid) == true) {
            echo 'Item already added to your wishlist';
        } else {
            $data = array(
                'userid' => $userid,
                'adid' => $adid
            );

            $this->my_wishlist_model->add_wishlist($data);
            echo 'Item successfully added to your wishlist';
        }
    }

    function delete_wishlist() {
        $adid = $_POST['adsArray']['adid'];
        $user = $this->session->userdata['logged_in']['userid'];
        $this->my_wishlist_model->delete_wishlist($adid, $user);
        $data['wishlist'] = $this->my_wishlist_model->get_items_for_user($this->session->userdata['logged_in']['userid']);
        $this->load->view('wishlist_view_ajax', $data);
    }

}
