<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Checkout
 *
 * @author Hasith Malinga
 */
class Checkout extends CI_Controller {

    var $data = array();

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('checkout_model');
        $this->load->model('user');
        $this->load->model('get_common_model');
    }

    function index() {
        $this->load->view('checkout_view');
    }

    function billing() {
        $this->form_validation->set_error_delimiters('<div class="error" style="color: red;">', '</div>');
        $this->form_validation->set_rules('telephone', 'Phone', 'trim|numeric|max_length[12]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('checkout_view');
        } else {
            $data = $this->get_site_data();

            if ($data['payment_method'] == 'cash') {
                $this->load->view('order_confirm_view', $data);
            } elseif ($data['payment_method'] == 'creditcard') {
                $this->load->view('payment_view');
            } elseif ($data['payment_method'] == 'storepickup') {
                $this->load->view('order_confirm_view', $data);
            }
        }
    }

    function confirm() {
        $this->save_data();
        $this->send_order_mail();
        $this->load->view('order_success_view');
    }

    function get_site_data() {

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $address1 = $this->input->post('address1');
        $address2 = $this->input->post('address2');
        $city = $this->input->post('city');
        $email = $this->input->post('email');
        $phone = $this->input->post('telephone');
        $comments = $this->input->post('remarks');

        $news_status = false;
        $newsletter = $this->input->post('newsletter');
        if (!empty($newsletter)) {
            $news_status = $this->input->post('newsletter');
        }
        $register_status = $this->input->post('createaccount');
        $password = NULL;
        if (!empty($register_status)) {
            $register_status = true;
            $password = $this->input->post('password');
        }
        $payment_method = $this->input->post('paymentMethods');
        $payment = NULL;
        if ($payment_method == 'cash') {
            $payment = 'Payment on Delivery';
        }if ($payment_method == 'creditcard') {
            $payment = 'Credit Card Payment';
        }if ($payment_method == 'storepickup') {
            $payment = 'Pickup from a KStore';
        }

        $data = array(
            'fname' => $fname,
            'lname' => $lname,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'email' => $email,
            'phone' => $phone,
            'news_status' => $news_status,
            'register_status' => $register_status,
            'password' => $password,
            'payment' => $payment,
            'total' => $this->cart->total(),
            'payment_method' => $payment_method,
            'comment' => $comments
        );

        $this->session->set_userdata($data);

        return $data;
    }

    function save_data() {
        $ship_address2 = null;
        if ($this->session->userdata('email')) {

            if ($this->session->userdata('address2')) {
                $ship_address2 = $this->session->userdata('address2');
            }
            $order = array(
                'buyer_id' => NULL,
                'first_name' => $this->session->userdata('fname'),
                'last_name' => $this->session->userdata('lname'),
                'email' => $this->session->userdata('email'),
                'telephone' => $this->session->userdata('phone'),
                'payment_method' => $this->session->userdata('payment_method'),
                'ship_firstname' => $this->session->userdata('fname'),
                'ship_lastname' => $this->session->userdata('lname'),
                'ship_address_1' => $this->session->userdata('address1'),
                'ship_address_2' => $ship_address2,
                'ship_city' => $this->session->userdata('city'),
                'comment' => $this->session->userdata('comment'),
                'order_status_id' => '1',
                'total' => $this->session->userdata('total'),
                'rewardpointsearned' => '0',
                'ipaddress' => $this->get_client_ip()
            );
             if ($this->session->userdata('register_status')) {
                $this->insert_user();
            }
            $orderid = $this->checkout_model->save_order($order);

           

            $userid = null;
            if ($this->session->userdata('logged_in')) {
                $userid = $this->session->userdata['logged_in']['first_name'];
            }
            $orderline = array();
            $orderFeedback = array();
            foreach ($this->cart->contents() as $items) {
                $orderline = array(
                    'orderid' => $orderid,
                    'adid' => $items['id'],
                    'sellerid' => $this->get_common_model->get_sellerID($items['id']),
                    'buyerid' => $userid,
                    'unitprice' => $items['price'],
                    'qty' => $items['qty'],
                    'subtotal' => ($items['price']) * ($items['qty'])
                );
                $orderline_id=$this->checkout_model->save_orderline($orderline);
                
                $orderFeedback = array(
                    'orderlineid' => $orderline_id,
                    'sellerid' => $this->get_common_model->get_sellerID($items['id']),
                    'buyerid' => $userid
                );               
                $this->checkout_model->save_orderfeedbacks($orderFeedback);
                $this->checkout_model->update_qty($orderline['adid'], $orderline['qty']);
            }
        } else {
            echo '<h1>Your Session is Expired.</h1>';
        }
        $this->cart->destroy();
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function insert_user() {
        $userdata = null;
        $user_exist = $this->user->verify_user_email($this->session->userdata('email'));
        $errorlist = array();
        if ($user_exist) {
            $errorlist['email'] = 1;
            $this->load->view('checkout_view', $errorlist);
        } else {
            $userdata = array(
                'first_name' => $this->session->userdata('fname'),
                'last_name' => $this->session->userdata('lname'),
                'email' => $this->session->userdata('email'),
                'password' => md5($this->session->userdata('password')),
                'hash' => md5(rand(0, 1000))
            );

            $this->user->insert_user($userdata);
        }
    }

    function send_order_mail() {

        //$order = $this->get_site_data();

        $this->load->library('email');

        $this->email->from('no-reply@kstoretesting.net16.net', 'Site Master');
        $this->email->to($this->session->userdata('email'));


        $this->email->subject('Your Order');
        $this->email->message('
Thanks for Shopping with KStore!
Your Order has been placed.


			 
-------------------------------------------------------------------
Total: ' . $this->session->userdata('total') . '
			
Shipping to
' . $this->session->userdata('address1') . ','
                . $this->session->userdata('address2') . ','
                . $this->session->userdata('city') . '
                                
-------------------------------------------------------------------
			 ');

        $this->email->send();

        //echo $this->email->print_debugger();
    }

}

/* End of file Checkout.php */
/* Location: ./application/controllers/Checkout.php */
