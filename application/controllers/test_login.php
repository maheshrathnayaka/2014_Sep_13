<?php
class test_login extends CI_Controller{
    function index(){
        
    }
    
    function login_view(){
        $this->load->view('test_login_view');
    }
    
    function do_login(){
        if(isset($_POST['username'])){
            $users=$this->db->get_where("users",array("email ="=>$_POST['username'], "password ="=>  md5($_POST['password'])))->result();
            
            if (empty($users)) {
                echo 'No';
            }else{
                echo 'loggedIn';
            }
        }
    }
}