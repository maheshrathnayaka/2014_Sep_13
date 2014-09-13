<?php
class Adminadreview extends CI_Controller{
    function index(){
        $this->load->model('adminadreview_model');
        $data['titlearray']=$this->adminadreview_model->get_pending_ads();
        
//        $this->load->view('header');
        $this->load->view('adreview', $data);
//        $this->load->view('footer');
    }
}
/* End of file adminadreview.php */
/* Location: ./application/controllers/adminadreview.php */

