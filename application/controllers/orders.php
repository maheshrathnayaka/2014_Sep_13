<?php

class Orders extends CI_Controller {

    public function index() {
        $this->load->model('orders_model');
        $data['count'] = $this->orders_model->get_new_order_count();
        $data['orders'] = $this->orders_model->get_order_list();
        $data['all_count'] = $this->orders_model->get_all_orders_count();
        $data['all_orders'] = $this->orders_model->get_all_orders();
        $this->load->view('orders_view', $data);
    }

    public function get_count() {
        $this->load->model('orders_model');
        $data = $this->orders_model->get_new_order_count();
        echo $data['order_count'];
    }
    
    public function get_orders(){
        $this->load->model('orders_model');
        $data = $this->orders_model->get_order_list();
    }
    
    public function ajax_new_order_count(){
        $this->load->model('orders_model');
        $data['order_count'] = $this->orders_model->get_new_order_count();
        $this->load->view('new_order_count_view', $data);
    }

}