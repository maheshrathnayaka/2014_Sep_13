<?php

class K_Store_manage_Panel extends CI_Controller 
{
        function __costruct()
	{
		parent::__costruct();		
 
	}
        public function index()
	{
            $this->load->view('k_store_manage_panel');

        }

}