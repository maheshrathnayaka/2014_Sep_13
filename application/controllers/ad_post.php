<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad_Post extends CI_Controller 
{
	private $data;

	function __costruct()
	{
		parent::__costruct();
		$this->load->model('ad_post_model');


	}

	public function index()
	{
		
		$this->load->view('ad_post');
	}


	function new_ad()
	{	if($_POST)
		{

		$this->load->model('ad_post_model');
		$this->getinfo();
		$this->ad_post_model->submitad($this->data);
		$this->load->view('ad_post_success', $this->data);
		}
		else
		{
			echo 'Forbidden Access';
		}
	}

	function getinfo()
	{

			$this->data=array('category'=>$_POST['category'],
						      'itemCondition'=>$_POST['item_condition'],
						      'title'=>$_POST['title'],
						      'brand'=>$_POST['brand'],
						      'modle'=>$_POST['modle'],
							  'description'=>$_POST['description'],
							  'price'=>$_POST['price'],
							  'isNegotiable'=>$_POST['negotiable'],
					      	  'name'=>$_POST['name'],
					      	  'email'=>$_POST['email'],
					          'phone'=>$_POST['phone'],
					          'isHide'=>$_POST['hide_phone_no'],
					          'location'=>$_POST['location']
					        );
	}

	}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */