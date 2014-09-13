<?php

class Check_Seller extends CI_Controller 
{
    private $data;
            	function __costruct()
	{
		parent::__costruct();
		$this->load->model('check_seller_model');


	}

	public function index()
	{	
		$this->load->view('check_seller');
	}
        
        public function check()
        {
            if($_POST)
		{
		$this->load->model('check_seller_model');
                $this->getemail();
		$results = $this->check_seller_model->getinfo($this->data);
		$this->load->view('seller_reg',$results);
		}
		else
		{
			echo 'seller not found';
		}
        }
        public function getemail()
        {
            $this->data= $_POST['email'];
        }





}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */