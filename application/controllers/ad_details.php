<?php

class Ad_Details extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('ad_details_model');
         $this->load->helper('cookie');
    }
     
    public function index() {
        if(!isset($_GET['adid'])) {
            echo "Page not Found!";
        } else {
            $data['ad'] = $this->ad_details_model->get_ad_details($_GET['adid']);
            $catid=$this->ad_details_model->get_ad_category($_GET['adid']);
            $data['images'] = $this->ad_details_model->get_ad_images($_GET['adid']);
            foreach ($data['ad'] as $value) {
                $seller=$value['sellerid'];
            }
            $data['seller'] = $this->ad_details_model->get_seller_details($seller);
            $data['reviews'] = $this->ad_details_model->get_reviews($_GET['adid']);
            $data['mul_specs'] = $this->ad_details_model->get_multi_specifications($_GET['adid']);
            $data['sin_specs'] = $this->ad_details_model->get_single_specifications($_GET['adid']);
            //$this->submit_ip_details($catid);
            $this->submit_searhed_details($catid);
            $this->load->view('ad_details_view', $data);
        }
    }
    
    //my function
    public function submit_searhed_details($catid) {       
        $data['ip'] = $this->input->ip_address();
        $data['catid']=$catid;       
       
        if ($this->session->userdata('logged_in')) {
            $data['userid']=$this->session->userdata['logged_in']['userid'];
        }
        else if(isset($_COOKIE["KstoreGuest"]))
        {
            
            $data['userid']=$_COOKIE["KstoreGuest"];
        }
        else
        {
            $data['userid']= $this->input->ip_address();
        }
        
        $checkuser = $this->ad_details_model->check_user($data['userid'],$data['catid']);
          
        if(!empty($checkuser))    
        {
            $this->ad_details_model->update_user_searched($data);          
        }
        else
        {    
            $this->ad_details_model->insert_user_searched($data);                       
        }        
    }
    //end my func
    
    
    
    
    public function submit_ip_details($catid) { 
       
        $data['ip'] = $this->input->ip_address();
        $data['catid']=$catid;
        
        if ($this->session->userdata('logged_in')) {
            $data['userid']=$this->session->userdata['logged_in']['userid'];
        } 
        $this->ad_details_model->insert_user_ip($data);
    }
}

