<?php

class Tag_Cloud extends CI_Controller {

    function __costruct() {
        parent::__costruct();
    }

    public function index() {

       // $this->createTag();
       $this->createTagClude();
    }

    public function createTag() {
        $this->load->model('tag_cloud_model');
        $data['max'] = $this->tag_cloud_model->getMax();

        $this->load->model('tag_cloud_model');
        $data['details'] = $this->tag_cloud_model->getTags();

        $this->load->view('tag_cloud', $data);
    }
    
    public function createTagClude()
    {
        $this->load->model('tag_cloud_model');
        $data['tag'] = $this->tag_cloud_model->newGetMax();
        
        foreach ($data['tag'] as $key) 
        {
            $data['max']=$key->max;
            break;
        }
        shuffle($data['tag']);
        $this->load->view('tag_cloud', $data);
        
    }

}
