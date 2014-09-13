<?php

class Send_News_Letters extends CI_Controller {

    function index() {
        $this->load->model('send_news_letters_model');
        $data['categories'] = $this->send_news_letters_model->get_category_list();
        $this->load->view('send_news_letters_view', $data);
    }

    function send_news() {
        $this->load->library('email');
        $this->email->from('no-reply@kstoretesting.net16.net', 'Kstore News');
//        $this->email->from('support@facebook.com', 'Facebook');
        $selected_category = $_POST['category'];
        $title = $_POST['inputTitle'];
        $msg = $_POST['inputMsgBody'];
        $this->load->model('send_news_letters_model');
        $user_array = $this->send_news_letters_model->get_email_list($selected_category);
        $email_list = "";
        foreach ($user_array as $row) {
            $email_list = $row['email'].", ".$email_list;
        }
        $email_list=rtrim($email_list,', ');
        $this->email->to($email_list);
        $this->email->subject($title);
        $this->email->message($msg);
        $this->email->send();
//        echo $this->email->print_debugger();
        $this->index();
    }
    
    function search_items() {
        $search_string = $this->input->post('keyword');
        $search_string = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $search_string);
        $words = explode(" ", $search_string);
        $data = $this->browse_gallery_model->get_all_search_strings();
        $row = 0;

        $row_array = array();
        $ad_array = array();

        foreach ($data as $text) {
            $text_word = explode("~", $text['Title_Text']);
            $ad_id = $text['ad_id'];
            $count = 0;
            foreach ($text_word as $single) {
                foreach ($words as $keyword) {

                    if (soundex($keyword) == soundex($single)) {
                        $count = $count + 1;
                    }
                }
            }
            if (intval($count) > 0) {
                array_push($row_array, $ad_id);
            }
        }
        
        $data['ads'] = $this->browse_gallery_model->get_gallery_ads_by_adid($row_array);        
        $data['top'] = $this->browse_gallery_model->get_top_categories();        
        $this->load->view('search_items_view',$data);
    }

}

/* End of file send_news_letters.php */
/* Location: ./application/controllers/send_news_letters.php */