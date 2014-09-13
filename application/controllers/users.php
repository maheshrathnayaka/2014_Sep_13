<?php

class Users extends CI_Controller {

    private $data;
    private $errorlist;

    function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    public function index() {
        $this->load->view('user_registration');
    }

    function new_user() {
        if ($_POST) {
            $this->retrieve_values();
            $this->verify_captcha();
            $this->verify_email($this->data);

            if (!isset($this->errorlist)) {
                $this->user->insert_user($this->data);
                $this->load->view('user_registration_success', $this->data);
                $this->send_confirmation();
            } else {
                $this->load->view('user_registration', $this->errorlist);
            }
        } else {
            echo 'Forbidden Access';
        }
    }

    function retrieve_values() {
        $this->data = array(
            'first_name' => $_POST['fname'],
            'last_name' => $_POST['lname'],
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'hash' => md5(rand(0, 1000))
        );
    }

    function verify_captcha() {
        require_once(APPPATH . 'assets/libs/recaptchalib.php');
        $privatekey = "6LfRQu8SAAAAAFqit_3icb5rVYX_C0bDv0sGSKhi";
        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            $this->errorlist['captcha'] = 1;
        }
    }

    function verify_email() {
        $user_exist = $this->user->verify_user_email($this->data['email']);

        if ($user_exist) {
            $this->errorlist['email'] = 1;
        }
    }
    
    function send_confirmation() {
        $this->load->library('email');
        $this->email->from('no-reply@kstoretesting.net16.net', 'Kstore News');
        $address = $this->data['email'];
        $subject="Welcome to Kstore!";
        $msg= 'Thanks for signing up, '.$_POST['fname'].'!
Your account has been created. Here are your login details.
-----------------------------------------------------------
Email: ' . $this->data['email'] . '
Password: ' . $_POST['password'] . '
-----------------------------------------------------------
            
Please click this link to activate your account:
' . base_url() . 'index.php/users/verification_successful?email=' . $this->data['email'] . '&hash=' . $this->data['hash'] . '
			 
			';
        $this->email->to($address);
        $this->email->subject($subject);
        $this->email->message($msg);
        $this->email->send();
    }
    
    function verification_successful() {
         $hash = $this->user->get_hash_value($_GET['email']);
         if($hash){
             $hash_val=$hash['hash'];
             if($hash_val==$_GET['hash']){
                 $this->user->activate_user($_GET['email']);
                 
                 $result=$this->user->get_user_info($_GET['email']);
                 $sess_array = array();
                 foreach ($result as $row) {
                    $sess_array = array(
                        'userid' => $row->userid,
                        'first_name' => $row->first_name,
                        'last_name' => $row->last_name,
                        'email' => $row->email
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                 }
                 redirect('home', 'refresh');
             }else{
                 echo "Forbidden Access!";
             }
         }else{
             echo "Forbidden Access!";
         }
    }

}

