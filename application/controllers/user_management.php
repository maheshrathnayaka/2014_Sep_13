<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_management
 *
 * @author Hasith Malinga
 */
class user_management extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('user_management_model');
    }

    function index() {
        $data['users'] = $this->user_management_model->getAllUsers();
        //var_dump($data);
        $this->load->view('user_management_view',$data);
    }
}

/* End of file user_management.php */
/* Location: ./application/controllers/user_management.php */
