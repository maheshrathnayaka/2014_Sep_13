<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cart
 *
 * @author Hasith Malinga
 */
class Cart extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('cart');
        $this->load->model('cart_model');
    }

    function index() {
        $this->load->view('cart_view');
    }

    function add_cart_item() {
        //$post= $this->input->post();
        //var_dump($post);
        if ($this->cart_model->validate_add_cart_item() == TRUE) {


            //if ($this->input->post('ajax') != '1') {
            redirect('cart');
            //} else {
            // echo 'true'; 
            //}
        } else {
            //alert("No data");
            //redirect('cart','refresh');
        }
    }

    function update_cart() {
        if ($this->input->post('continue')) {
            redirect(base_url('/browse_gallery'));
        }

        if ($this->input->post('update')) {
            $this->cart_model->validate_update_cart();
            redirect('cart');
        }

        if ($this->input->post('checkout')) {
            //redirect(base_url('/checkout'));
            $this->load->view('checkout_view');
        }
    }

    function remove_item() {
        $adid = $_POST['rows']['rowid'];
        $data = array(
            'rowid' => $adid,
            'qty' => 0
        );
        $this->cart->update($data);        
        $this->load->view('cart_view_ajax');
    }

    function show_ajax() {
        if ($this->cart->contents()) {
            echo '<div class="container"><table class="table-responsive">
                <thead><th>Item</th><th>Qty</th><th>Price</th></thead>
                <tbody>';
            foreach ($this->cart->contents() as $items) {
                echo '<tr><td>';
                echo '<a class="thumbnail pull-left" href="#">';
                echo '<img class="media-object" src="';
                echo base_url("/images/uploads") . '/';
                echo $items['options']['image'];
                echo '" style="width: 57px; height: 57px;"></a></td><td>';
                echo '<input type="text" name="qty[]" class="form-control" id="quantity" value=';
                echo $items['qty'];
                echo '></td>';
                echo '<td>25000</td></tr>';
            }
            echo '</tbody></table></div>';
        } else {
            
        }
    }

}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */
