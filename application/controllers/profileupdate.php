<?php

class Profileupdate extends CI_Controller {

    function index() {
        $session_data = $this->session->userdata('logged_in');
        $this->load->model('mprofileupdate');
        $data = $this->mprofileupdate->get_user_info($session_data);
        $this->load->view('profile_update', $data);
    }

    function updateprofileinfogeneral() {
        if ($_POST) {
            $data = array(
                'table_name' => 'users',
                'fname' => $_POST['inputFirstName'],
                'lname' => $_POST['inputLastName'],
                'email' => $_POST['inputEmail'],
                'phone' => $_POST['inputPhone'],
                'question' => $_POST['inputSecurityQuestion'],
                'answer' => $_POST['inputSecurityAnswer']
            );

            $this->load->model('mprofileupdate'); // load the model first
            if ($this->mprofileupdate->upddatagenaral($data)) { // call the method from the model
//                $this->load->view('profile_update', $data);
                $this->index();
            } else {
                echo "Update Unsuccessfull";
            }
        } else {
            echo 'forbidden access';
        }
    }

    function updateprofileinfoaddress() {
        $session_data = $this->session->userdata('logged_in');
        if ($_POST) {
            $data = array(
                'table_name' => 'users',
                'address1' => $this->input->post('inputLine01'),
                'address2' => $this->input->post('inputLine02'),
                'email' => $session_data['email'],
                'province' => $this->input->post('inputProvince'),
                'city' => $this->input->post('inputCity')
            );
            $this->load->model('mprofileupdate'); // load the model first
            if ($this->mprofileupdate->upddataaddress($data)) { // call the method from the model
//                $this->load->view('profile_update', $data);
                $this->index();
            } else {
                echo "Update Unsuccessfull";
            }
        } else {
            echo 'forbidden access';
        }
    }

    function update_password() {
        $session_data = $this->session->userdata('logged_in');
        $input_password = $this->input->post('inputCurrentPassword');
        $new_password = $this->input->post('inputNewPassword');
        $confirm_password = $this->input->post('inputConfirmPassword');
        if ($_POST) {
            $data = array(
                'table_name' => 'users',
                'current_password' => $input_password,
                'new_password' => $new_password,
                'confirm_password' => $confirm_password,
                'email' => $session_data['email']
            );
            $this->load->model('mprofileupdate'); // load the model first
            $result = $this->mprofileupdate->check_password($data);
//            var_dump(md5('hello123'));
            if ($result->password == md5($input_password)) {
                if ($new_password == $confirm_password) {
                    $this->mprofileupdate->update_password($data);
//                    echo 'Password changed successfully';
                    $data['message'] = "Password changed successfully";
                    $this->index();
//                    var_dump($data);
//                    $this->load->view('profile_update', $data);
                } else {
                    $data['message'] = "Passwords not match";
                    echo 'Passwords not match !';
                }
            } else {
                $data['message'] = "Please enter correct password";
                echo 'Please enter correct password';
            }
        } else {
            echo 'forbidden access';
        }
    }

}
