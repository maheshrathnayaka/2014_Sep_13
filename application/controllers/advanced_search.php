<?php

class Advanced_search extends CI_Controller {

    public function index() {
        $this->load->model('advanced_search_model');
        $data['categories'] = $this->advanced_search_model->get_category_list();
        $this->load->view('advanced_search_view', $data);
    }

    public function by_seller() {
        $this->load->view('advanced_search_seller_view');
    }

    public function by_member() {
        $this->load->view('advanced_search_member_view');
    }

    function search_items_by_name() {
        $search_string = $this->input->post('seller_name');
        $this->load->model('advanced_search_model');
        $data['ads'] = $this->advanced_search_model->get_ads_list($search_string);
        $this->load->view('advanced_search_items_view', $data);
    }

    function search_items_by_keyword() {
        $search_string = $this->input->post('keyword');
        $search_type=$this->input->post('category');
        $search_category=$this->input->post('selectCategory');
        $words = explode(" ", $search_string);
        $this->load->model('advanced_search_model');
        $data['ads'] = array();
        if ($search_type=='1'){ // All words, any order
            $data['ads'] = $this->advanced_search_model->get_matching_items_al_wrd_any_or($words);
        }else if ($search_type=='2') { // Any words, any order
            $data['ads'] = $this->advanced_search_model->get_matching_items_any_wrd_any_or($words);
        }else if ($search_type=='3') { // Exact words, exact order
            $data['ads'] = $this->advanced_search_model->get_matching_items_ex_wrd_ex_or($words);
        }else if ($search_type=='4') { // Exact words, any order
            $data['ads'] = $this->advanced_search_model->get_matching_items_ex_wrd_any_or($words);
        }      
        $this->load->view('advanced_search_items_view', $data);
//        $data = $this->browse_gallery_model->get_all_search_strings();
//        $row = 0;
//
//        $row_array = array();
//        $ad_array = array();
//
//        foreach ($data as $text) {
//            $text_word = explode("~", $text['Title_Text']);
//            $ad_id = $text['ad_id'];
//            $count = 0;
//            foreach ($text_word as $single) {
//                foreach ($words as $keyword) {
//
//                    if (soundex($keyword) == soundex($single)) {
//                        $count = $count + 1;
//                    }
//                }
//            }
//            if (intval($count) > 0) {
//                array_push($row_array, $ad_id);
//            }
//        }
//        if (!empty($row_array)) {
//            $data['ads'] = $this->browse_gallery_model->get_gallery_ads_by_adid($row_array);
//            $data['top'] = $this->browse_gallery_model->get_top_categories();
//            $this->load->view('search_items_view', $data);
//        } else {
//            $data['ads'] = NULL;
//            $data['top'] = $this->browse_gallery_model->get_top_categories();
//            $this->load->view('search_items_view', $data);
//        }
    }
    
    function search_item_includes(){
//        if (isset($_POST)) {
//            $checkboxes['price'] = isset($_POST['price']);
//        }else{
//            echo 'Forbidden Access';
//        }
    }

}

/* End of file advanced_search.php */
/* Location: ./application/controllers/advanced_search.php */

