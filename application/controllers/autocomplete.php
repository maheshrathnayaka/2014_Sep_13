<?php

class Auto_Complete extends CI_Controller 
{

        function __costruct()
	{
		parent::__costruct();
                $this->load->model('autocomplete_model');
	}

	public function index()
	{
		
		$this->load->view('autocomplete');
	}

}