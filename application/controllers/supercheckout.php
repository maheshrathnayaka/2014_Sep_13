<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Supercheckout
 *
 * @author Hasith Malinga
 */
class Supercheckout extends CI_Controller {

    var $data = array();

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('checkout_model');
        $this->load->model('get_common_model');
    }

    function index() {
        $this->load->view('checkout_view');
    }

    function billing() {

        $data = $this->get_site_data();

        if ($data['payment_method'] == 'cash') {
            $this->load->view('log_order_confirm_view', $data);
        } elseif ($data['payment_method'] == 'creditcard') {
            $this->load->view('payment_view');
        } elseif ($data['payment_method'] == 'storepickup') {
            $this->load->view('log_order_confirm_view', $data);
        }
    }

    function confirm() {
        $this->save_data();
        $this->send_order_mail();
        $this->load->view('order_success_view');
    }

    function get_site_data() {

        $email = $this->session->userdata['logged_in']['email'];
        $user = $this->get_common_model->get_user_data($email);
        //var_dump($user);
        $b_fname = null;
        $b_lname = null;
        $b_address1 = null;
        $b_address2 = null;
        $b_city = null;
        if ($this->input->post('billingAdd') == 'newadd') {
            $b_fname = $this->input->post('billingfname');
            $b_lname = $this->input->post('billinglname');
            $b_address1 = $this->input->post('billingaddress1');
            $b_address2 = $this->input->post('billingaddress2');
            $b_city = $this->input->post('billingcity');
        } else {
            $b_fname = $user['first_name'];
            $b_lname = $user['last_name'];
            $b_address1 = $user['address_1'];
            $b_address2 = $user['address_2'];
            $b_city = $user['city'];
        }

        $sh_fname = null;
        $sh_lname = null;
        $sh_address1 = null;
        $sh_address2 = null;
        $sh_city = null;

        if ($this->input->post('shipaddress') == 'checked') {
            if ($this->input->post('billingAdd') == 'newadd') {
                $sh_fname = $this->input->post('billingfname');
                $sh_lname = $this->input->post('billingfname');
                $sh_address1 = $this->input->post('billingaddress1');
                $sh_address2 = $this->input->post('billingaddress2');
                $sh_city = $this->input->post('billingcity');
            } else {
                $sh_fname = $user['first_name'];
                $sh_lname = $user['last_name'];
                $sh_address1 = $user['address_1'];
                $sh_address2 = $user['address_2'];
                $sh_city = $user['city'];
            }
        } else {
            $sh_fname = $this->input->post('shipfname');
            $sh_lname = $this->input->post('shiplname');
            $sh_address1 = $this->input->post('shipaddress1');
            $sh_address2 = $this->input->post('shipaddress2');
            $sh_city = $this->input->post('shipcity');
        }


        $phone = $user['telephone'];
        $comments = $this->input->post('remarks');

        $news_status = false;
        $newsletter = $this->input->post('newsletter');
        if (!empty($newsletter)) {
            $news_status = $this->input->post('newsletter');
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
            'buyer_id' => $user['userid'],
            'fname' => $user['first_name'],
            'lname' => $user['last_name'],
            'bill_fname' => $b_fname,
            'bill_lname' => $b_lname,
            'bill_address_1' => $b_address1,
            'bill_address_2' => $b_address2,
            'bill_city' => $b_city,
            'ship_fname' => $sh_fname,
            'ship_lname' => $sh_lname,
            'ship_address1' => $sh_address1,
            'ship_address2' => $sh_address2,
            'ship_city' => $sh_city,
            'email' => $email,
            'phone' => $phone,
            'news_status' => $news_status,
            'payment' => $payment,
            'total' => $this->cart->total(),
            'payment_method' => $payment_method,
            'comment' => $comments
        );
        //var_dump($data);

        $this->session->set_userdata($data);

        return $data;
    }

    function save_data() {
        $ship_address2 = null;
        if ($this->session->userdata['logged_in']['email']) {

            if ($this->session->userdata('ship_address2')) {
                $ship_address2 = $this->session->userdata('ship_address2');
            }
            $order = array(
                'buyer_id' => $this->session->userdata('buyer_id'),
                'first_name' => $this->session->userdata('fname'),
                'last_name' => $this->session->userdata('lname'),
                'email' => $this->session->userdata('email'),
                'telephone' => $this->session->userdata('phone'),
                'payment_method' => $this->session->userdata('payment_method'),
                'bill_fname' => $this->session->userdata('bill_fname'),
                'bill_lname' => $this->session->userdata('bill_lname'),
                'bill_address_1' => $this->session->userdata('bill_address_1'),
                'bill_address_2' => $this->session->userdata('bill_address_2'),
                'bill_city' => $this->session->userdata('bill_city'),
                'ship_firstname' => $this->session->userdata('ship_fname'),
                'ship_lastname' => $this->session->userdata('ship_lname'),
                'ship_address_1' => $this->session->userdata('ship_address1'),
                'ship_address_2' => $ship_address2,
                'ship_city' => $this->session->userdata('ship_city'),
                'comment' => $this->session->userdata('comment'),
                'order_status_id' => '1',
                'total' => $this->session->userdata('total'),
                'rewardpointsearned' => '0',
                'ipaddress' => $this->get_client_ip()
            );

            //var_dump($order);
            $orderid = $this->checkout_model->save_order($order);

            $userid = null;
            if ($this->session->userdata('logged_in')) {
                $userid = $this->session->userdata('buyer_id');
            }
            $orderline = array();
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

/* End of file Supercheckout.php */
/* Location: ./application/controllers/Supercheckout.php */
