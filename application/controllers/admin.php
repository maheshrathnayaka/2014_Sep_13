<?php

class admin extends CI_Controller {

    function index() {
        $this->load->view('administrator_login_view');
//        $this->load->view('dash_demo_view');
    }

    function verify_user() {
        if (isset($_POST)) {
            $log['email'] = $_POST['inputEmail'];
            $log['pw'] = $_POST['inputPassword'];
            $this->load->model('admin_model');
            $result = $this->admin_model->verify_user($log);
//            var_dump($result);
            if (isset($result) && !empty($result)) {
                $this->home();
            } else {
                $this->index();
            }
        }  else {
            echo 'Forbidden Access';
        }
//        $log['email']=$_POST['inputEmail'];
//        $log['pw']=$_POST['inputPassword'];
//        $this->load->model('admin_model');
//        $result = $this->admin_model->verify_user($log);
//        var_dump($result);
//        if (isset($result) && !empty($result)) {
//            $this->home();
//        }else{
//            $this->index();
//        }
//        if (count($result) > 0) {
//            $this->load->view('links');
//            var_dump($result);
//        }  else {
//            redirect('/admin');
//            var_dump($result);
//        }
        /* // Ajax Test
          $log_data = $_POST['logArray'];
          $log['email'] = $log_data['un'];
          $log['pw'] = $log_data['pw'];
          $this->load->model('admin_model');
          $result = $this->admin_model->verify_user($log);
          var_dump($result);
          if (count($result) > 0) {
          return TRUE;
          }  else {
          return FALSE;
          } */
        //if there are a match result, bring first row. Else, Null
//        return (count($result) > 0 ? $result[0] : NULL);
//        $this->load->view('links');
//        $this->load->view('dash_demo_view');
    }

    function home() {
        $this->load->view('links');
    }

    function theme() {
        $this->load->view('dash_demo_view');
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */