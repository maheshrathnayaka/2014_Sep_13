<?php

class My_Subscriptions extends CI_Controller {

    public function index() {
        $user = $this->session->userdata['logged_in']['userid'];
        $this->load->model('my_subscriptions_model');
        $data['category'] = $this->my_subscriptions_model->get_categories();
        $data['subscribe_category'] = $this->my_subscriptions_model->get_subscribe_categories($user);
        $this->load->view('my_subscriptions_view', $data);
    }

    public function subscriptions() {
        if ($_POST) {
            $this->load->model('my_subscriptions_model');
            $data_id = $this->my_subscriptions_model->get_category_id();
            $user_id = $this->session->userdata['logged_in']['userid'];
            $this->my_subscriptions_model->delete_existing_categories($user_id);
            foreach ($data_id as $row) {
                $category_id = $row['categoryid'];
                if (isset($_POST[$category_id])) {
                    $data = array(
                        'categoryid' => $category_id,
                        'userid' => $user_id
                    );
                    $this->load->model('my_subscriptions_model'); // load the model first
                    $this->my_subscriptions_model->add_subscribers($data);
//                    $this->load->view('my_subscriptions_view', $data);
                }
            }

            $data['redirect'] = "YES";
            $user = $this->session->userdata['logged_in']['userid'];
            $this->load->model('my_subscriptions_model');
            $data['category'] = $this->my_subscriptions_model->get_categories();
            $data['subscribe_category'] = $this->my_subscriptions_model->get_subscribe_categories($user);
            $this->load->view('my_subscriptions_view', $data);
        } else {
            echo 'forbidden access';
        }
    }

}

/* End of file my_subscriptions.php */
/* Location: ./application/controllers/my_subscriptions.php */

