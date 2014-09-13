<?php

class Delete_K_Store extends CI_Controller 
{
        function __costruct()
	{
		parent::__costruct();		
 
	}
        public function index()
	{
            
            $this->load->model('view_k_stores_model');
            $data['mapValue'] = $this->view_k_stores_model->getLatLng();
            $this->load->view('delete_k_store', $data);

        }
        public function deleteKstore($id)
        {
            $this->load->model('view_k_stores_model');
            $this->view_k_stores_model->removeKstore($id);
        }

}