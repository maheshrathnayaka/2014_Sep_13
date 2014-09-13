<?php

class Seller_Reg extends CI_Controller 
{
    private $data;
    private $name;
            function __costruct()
	{
		parent::__costruct();
		$this->load->model('seller_reg_model');


	}

	public function index()
	{
		
		$this->load->view('seller_reg');
	}
        public function updateseller()
        {
            if($_POST)
		{

		$this->load->model('seller_reg_model');
		$this->getinfo();
		$this->seller_reg_model->verifyseller($this->data, $this->name);
                
                $this->load->view('check_seller');
                
//		
		}
		else
		{
			echo 'Forbidden Access';
		}
	}

	function getinfo()
	{

			$this->data=array('address_1'=>$_POST['Address'],
						      'telephone'=>$_POST['phoneno'],
						      'nicNo'=>$_POST['nicno'],
						      'bankNo'=>$_POST['bankno'],
                                                      'isVerify'=>1
					
					        );
                        $this->name=$_POST['name'];
                        
	}





}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */