<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    function index() {
        $this->load->helper(array('form'));
        $this->load->view('login_view');
    }

    function forgetpassword() {
        $data = NULL;
        $this->load->view('forgot_password_view', $data);
    }

    function resetpassword() {
        $email = $this->input->post('forgotemail');        

        if (isset($email) && !is_null($email)) {
            $user_exist = $this->user->verify_user_email($email);
            
            if (!isset($user_exist['email']) || is_null($user_exist)) {
                $data['error'] = "Your email address is not registered. Please try again with a different email.";
                $this->load->view('forgot_password_view', $data);
            } else if($user_exist['email']==$email) {
                $token = md5(rand(1, 10000));
                $this->user->insert_token_fgtpassword($email, $token);
                $url = base_url() . 'login/verifypasswordreset?email=' . $email . '&token=' . $token;
                $this->mail_reset_link($url, $email);

                $data['title'] = 'Password Reset';
                $data['heading_msg'] = 'Need Verification !';
                $data['info'] = 'An email has been sent to you. Please check your mail box to reset your password.';
                $this->load->view('info_messages_view', $data);
            }
        }else{
            $data['title'] = 'Access Denied';
            $data['heading_msg'] = 'Something went Wrong !';
            $data['error'] = 'You don\'t have access to this operation.';
            $this->load->view('info_messages_view', $data);
        }
    }

    function verifypasswordreset() {
        $user_data = $this->user->get_token($_GET['email']);
        $data['email'] = $_GET['email'];
        if ($user_data) {
            $token = $user_data['password_token'];
            if ($token == $_GET['token']) {
                $this->load->view('change_password_view', $data);
            } else {
                echo "Access Denied !";
            }
        } else {
            echo "Access Denied !";
        }
    }

    function changepassword() {
        $newpass = $this->input->post('newpass');
        $confpass = $this->input->post('confpass');
        $email = $this->input->post('email');
        if (isset($email) && !is_null($email) && trim($email)!='') {
            
            if ($newpass != $confpass) {
                $data['error'] = 'Passwords you entered does not match.';
                $data['email'] = $email;
                $this->load->view('change_password_view', $data);
            } else {
                $this->user->update_password($email, $newpass);
                $data['title'] = 'Password Reset';
                $data['heading_msg'] = 'Password Reset Successfully !';
                $data['info'] = 'Your password has been updated. Use this password when you log in to KStore.';
                $this->load->view('info_messages_view', $data);
            }
        } else {
            $data['title'] = 'Access Denied';
            $data['heading_msg'] = 'Something went Wrong !';
            $data['error'] = 'You don\'t have access to this operation.';
            $this->load->view('info_messages_view', $data);
        }
    }

    function mail_reset_link($url, $email) {
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('no-reply@kstoretesting.net16.net', 'Site Master');
        $this->email->to($email);
        $this->email->subject('Password Reset - KStore Online product Store');
        $this->email->message('
<html>
<head>
<title>Forgot Password</title>
</head>
<body>
<h2>KStore Online Product Store</h2>
<br/>
<p>You have requested to reset your password.</p>
<p>Click on the given link to reset your password</p><br/>
<a href="{unwrap}' . $url . '{/unwrap}">Reset Password From Here</a>
</body>
</html>
        ');

        $this->email->send();
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */

