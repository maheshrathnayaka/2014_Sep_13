<?php

class View_K_Stores extends CI_Controller 
{
           function __costruct()
	{
		parent::__costruct();		
 
	}
        public function index()
	{
            
            $this->load->model('view_k_stores_model');
            $data['mapValue'] = $this->view_k_stores_model->getLatLng();
            $this->load->view('view_k_stores', $data);

        }

}