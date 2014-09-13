<?php

class New_K_Store_Management extends CI_Controller 
{

                        
        function __costruct()
	{
		parent::__costruct();
		$this->load->model('new_k_store_management_model');

	}
        public function index()
	{
             $this->load->view('new_k_store_management');

        }
        public function addKStore()
        {
             $data=array('lat'=>$_POST['latitude'],
                          'lng'=> $_POST['longitude'],
                          'addressline'=>$_POST['address'],
                          'telephone'=>$_POST['teleNo'],
                          'city'=>$_POST['city']
                          );
         
        $this->load->model('new_k_store_management_model');
        $this->new_k_store_management_model->setKStore($data);
             
        }
}