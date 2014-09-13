<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class K_Store_Management extends CI_Controller 
{
    private $alldata;
    private $data;
                        
        function __costruct()
	{
		parent::__costruct();
		$this->load->model('k_store_management_model');

	}
        
        
        public function index()
	{
              
	    $this->load->library('googlemaps');
            $config= array();
            $config['center'] = 'colombo,srilanka';
            $config['zoom'] = '15';
            
            $this->googlemaps->initialize($config);
            
            $marker = array();
            $marker['position'] = 'colombo,srilanka';
            $marker['draggable'] = true;
            $marker['ondragend'] ='document.getElementById("latitude").value=event.latLng.lat() ; document.getElementById("longitude").value=event.latLng.lng()';
            $this->googlemaps->add_marker($marker);
            $this->data['map'] = $this->googlemaps->create_map();
            $this->load->view('k_store_management', $this->data);
                
	}
        
        function getallinfo()
        {
            $this->alldata=array('addressline1'=>$_POST['Address'],
				     'city'=>$_POST['city'],
				     'telephone'=>$_POST['teleno'],
                                     'lat'=>$_POST['latitude'],
                                     'lng'=>$_POST['longitude']);
        }
                
        function addnewStore()
        {
            if($_POST)
		{
		$this->load->model('k_store_management_model');
                $this->getallinfo();
		$this->k_store_management_model->insertdata($this->alldata);
                
                
                
                
		$this->load->library('googlemaps');
            $config= array();
            $config['center'] = 'colombo,srilanka';
            $config['zoom'] = '15';
            
            $this->googlemaps->initialize($config);
            
            $marker = array();
            $marker['position'] = 'colombo,srilanka';
            $marker['draggable'] = true;
            $marker['ondragend'] ='document.getElementById("latitude").value=event.latLng.lat() ; document.getElementById("longitude").value=event.latLng.lng()';
            $this->googlemaps->add_marker($marker);
            $this->data['map'] = $this->googlemaps->create_map();
            $this->load->view('k_store_management', $this->data);

		}
		else
		{
                    echo 'Forbidden Access';
		}
        }
        
                
        
  

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */