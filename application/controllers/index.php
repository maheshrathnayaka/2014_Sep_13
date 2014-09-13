<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Index extends CI_Controller {
    
    var $userid='';
    function __construct() {
        parent::__construct();
        
        $this->load->model('browse_gallery_model');
        $this->load->helper('cookie');
    }

    function index() {
        if(!isset($_COOKIE['KstoreGuest'])) {
            $this->userid = uniqid();
            $expire = time() + 60 * 60 * 24 * 30;
            setcookie("KstoreGuest", $this->userid, $expire);
            //$this->index();
        }else{
            $this->userid = $_COOKIE['KstoreGuest'];
        }

        $data['recommoendads'] = $this->extract_ip_details();
        $data['sliderads'] = $this->getslider_ads();

        $data['cats'] = $this->browse_gallery_model->get_all_categories();

        $data['top'] = $this->browse_gallery_model->get_top_categories();

        $temptag = $this->createTagClude();

        $data['tag'] = $temptag['tag'];
        $data['max'] = $temptag['max'];

        $this->load->view('index', $data);
    }

    function getslider_ads() {
        if ($this->session->userdata('logged_in')) {
            $userid = $this->session->userdata['logged_in']['userid'];

            $reccatid = $this->browse_gallery_model->get_slider_catid($userid);

            if (isset($reccatid) && !empty($reccatid)) {

                foreach ($reccatid as $id) {
                    $rid = $id['catid'];
                }
                $sads = $this->browse_gallery_model->get_slider_adid($rid);

                if (count($sads) == 0) {
                    $sads = $this->browse_gallery_model->get_gallery_ads();
                }
            } else {
                $sads = $this->browse_gallery_model->get_gallery_ads();
            }
        } else {
           // $userid = $_COOKIE['KstoreGuest'];
            $reccatid = $this->browse_gallery_model->get_slider_catid($this->userid);
            if (isset($reccatid) && !empty($reccatid)) {
                foreach ($reccatid as $id) {
                    $rid = $id['catid'];
                }
                $sads = $this->browse_gallery_model->get_slider_adid($rid);
                if (count($sads) == 0) {
                    $sads = $this->browse_gallery_model->get_gallery_ads();
                }
            } else {
                $sads = $this->browse_gallery_model->get_gallery_ads();
            }
        }

        return $sads;
    }

    function extract_ip_details() {
        if ($this->session->userdata('logged_in')) {
            $userid = $this->session->userdata['logged_in']['userid'];


            $ip_details = $this->browse_gallery_model->get_ip_details_by_user($userid); //get last 5 ip records of user
            if (isset($ip_details) && !empty($ip_details)) {

                foreach ($ip_details as $ip) {
                    $ips[] = $ip['catid'];
                }
                $ads = $this->browse_gallery_model->get_slider_ads_bycat($ips);
                if (count($ads) == 0) {
                    $ads = $this->browse_gallery_model->get_gallery_ads();
                }
            } else {
                $ads = $this->browse_gallery_model->get_gallery_ads();
            }
        } else {
          //  $userid = $_COOKIE['KstoreGuest'];
            $ip_details = $this->browse_gallery_model->get_ip_details_by_user($this->userid); //get last 5 ip records of user
            if (isset($ip_details) && !empty($ip_details)) {


                foreach ($ip_details as $ip) {
                    $ips[] = $ip['catid'];
                }
                $ads = $this->browse_gallery_model->get_slider_ads_bycat($ips);

                if (count($ads) == 0) {
                    $ads = $this->browse_gallery_model->get_gallery_ads();
                }
            } else {
                $ads = $this->browse_gallery_model->get_gallery_ads();
            }
        }

        return $ads;
    }

    public function createTagClude() {
        $this->load->model('tag_cloud_model');
        $data['tag'] = $this->tag_cloud_model->newGetMax();

        foreach ($data['tag'] as $key) {
            $data['max'] = $key->max;
            break;
        }
        shuffle($data['tag']);

        return $data;
        //$this->load->view('tag_cloud', $data);
    }

}
