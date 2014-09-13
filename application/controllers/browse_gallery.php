<?php

class Browse_Gallery extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('browse_gallery_model');
    }

    public function index($start = 0) {
        if (isset($_GET['catid']) && !empty($_GET['keyword'])) {
            $catid = $_GET['catid'];
            $strKeyword = mysql_real_escape_string($_GET['keyword']);
            $strKeyword = rtrim($strKeyword);
            //$strKeyword = preg_replace('/[^A-Za-z0-9\-]/', '', $strKeyword);

            $data['cat_path'] = $this->browse_gallery_model->get_category_path($catid);
            $data['child_cats'] = $this->browse_gallery_model->get_child_categories($catid);
            if ($catid != 0) {
                $data['ads'] = $this->browse_gallery_model->get_ads_by_keyword_and_cat($catid, $strKeyword);
            } else {
                $data['ads'] = $this->browse_gallery_model->get_ads_by_keyword($strKeyword);
            }
            $data['cat'] = $this->browse_gallery_model->get_category_name($catid);
            $data['top'] = $this->browse_gallery_model->get_top_categories();
            $data['loc'] = $this->browse_gallery_model->get_locations();
            $data['multi_attr'] = $this->browse_gallery_model->get_multi_attributes($catid);
            foreach ($data['multi_attr'] as $attr) {
                $data['attr_' . $attr['attributeid']] = $this->browse_gallery_model->get_attribute_values($attr['attributeid']);
            }

            if ($_GET['catid'] != 0) {
                $this->submit_ip_details();
            }
            $this->load->view('browse_gallery_view', $data);
        } else if (isset($_GET['catid'])) {

            $data['cat_path'] = $this->browse_gallery_model->get_category_path($_GET['catid']);
            $data['child_cats'] = $this->browse_gallery_model->get_child_categories($_GET['catid']);
            $data['ads'] = $this->browse_gallery_model->get_gallery_ads_bycat($_GET['catid']);
            $data['cat'] = $this->browse_gallery_model->get_category_name($_GET['catid']);
            $data['top'] = $this->browse_gallery_model->get_top_categories();
            $data['loc'] = $this->browse_gallery_model->get_locations();
            $data['multi_attr'] = $this->browse_gallery_model->get_multi_attributes($_GET['catid']);
            foreach ($data['multi_attr'] as $attr) {
                $data['attr_' . $attr['attributeid']] = $this->browse_gallery_model->get_attribute_values($attr['attributeid']);
            }

            if ($_GET['catid'] != 0) {
                $this->submit_ip_details();
            }
            $this->load->view('browse_gallery_view', $data);
        } else {
            $_GET['catid'] = 0;
            $this->index();
        }
    }

    public function submit_ip_details() {
        $data['ip'] = $this->input->ip_address();
        $data['value'] = $_GET['catid'];
        $data['type'] = 'catid';
        if ($this->session->userdata('logged_in')) {
            $data['userid'] = $this->session->userdata['logged_in']['userid'];
        }
        $this->browse_gallery_model->insert_user_ip($data);
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

                    if (soundex(strtoupper($keyword)) == soundex(strtoupper($single)) ||
                            metaphone(strtoupper($keyword)) == metaphone(strtoupper($single))) {
                        $count = $count + 1;
                    }
                }
            }
            if (intval($count) > 0) {
                array_push($row_array, $ad_id);
            }
        }
        if (!empty($row_array)) {
            $data['ads'] = $this->browse_gallery_model->get_gallery_ads_by_adid($row_array);
            $data['top'] = $this->browse_gallery_model->get_top_categories();
            $this->load->view('search_items_view', $data);
        } else {
            $data['ads'] = NULL;
            $data['top'] = $this->browse_gallery_model->get_top_categories();
            $this->load->view('search_items_view', $data);
        }
    }

    function filter_by_values() {
        //echo "<script>alert('loaded');</script>";
        $select = '';
        $from = '';
        $where = '';

        //keyword checking
        $catid = $_POST['cat_id'];
        $data_ads = '';
//        $keywordArray=$_POST['keyword'];
//        $keyword = $keywordArray['key'];

        if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
            $strKeyword = mysql_real_escape_string($_POST['keyword']);
            $strKeyword = rtrim($strKeyword);
            if ($catid != 0) {
                $data_ads = $this->browse_gallery_model->get_ads_by_keyword_and_cat($catid, $strKeyword);
            } else {
                $data_ads = $this->browse_gallery_model->get_ads_by_keyword($strKeyword);
            }
        } else {
            //echo "<script>alert('No keyword');</script>";
            $data_ads = $this->browse_gallery_model->get_gallery_ads_bycat($catid);
        }

        if (isset($data_ads) && !empty($data_ads)) {
            $ad_ids = '';
            $is_first = true;
            foreach ($data_ads as $value) {
                if ($is_first == true) {
                    $ad_ids.=$value['adid'];
                    $is_first = false;
                } else {
                    $ad_ids.= ',' . $value['adid'];
                }
            }
            $where.=' AND a.adid IN(' . $ad_ids . ')';
        }
        //echo "<script>alert('Value List: ".$_POST['keyword']."');</script>";
        //price checking

        $price = $_POST['priceArray'];
        $price_from = $price['from'];
        $price_to = $price['to'];
        if (!empty($price_from)) {
            $where.=' AND a.price>=' . $price_from;
        }if (!empty($price_to)) {
            $where.=' AND a.price<=' . $price_to;
        }

        //seller checking

        $seller = $_POST['sellerArray'];
        $verified_sellers = $seller['verified'];
        if ($verified_sellers == 'true') {
            $from.=',users u';
            $where.=' AND u.userid=a.sellerid AND u.isVerify=1';
        }

        //location checking
        $location = $_POST['locationArray'];
        $city = $location['city'];
        $type = $location['type'];
        if (!empty($city) && isset($city)) {
            $where.=' AND a.location="' . $city . '"';
        }
        if (!empty($type) && isset($type)) {
            $where.=' AND a.locationtype="' . $type . '"';
        }

        //attributes
        //echo "<script>alert('hello1');</script>";
        if (!empty($_POST['attributesArray']) && isset($_POST['attributesArray'])) {
            $attributes;
            $attr_clause = '';
            $is_first = true;

            $attributes = $_POST['attributesArray'];
            $att_array = explode(" ", $attributes);
            foreach ($att_array as $attr) {
                $attr_temp = explode("-", $attr);
                $attr_id = $attr_temp[0];
                $attr_values = $attr_temp[1];
                if ($is_first == true) {
                    $attr_clause = '(SELECT adid FROM attributes_values WHERE attributeid=' . $attr_id . ' AND attributevalue IN(' . $attr_values . '))';
                    $is_first = false;
                } else {
                    $attr_clause = '(SELECT adid FROM attributes_values WHERE attributeid=' . $attr_id . ' AND attributevalue IN(' . $attr_values . ')  AND adid IN(' . $attr_clause . '))';
                }
            }
            $where.=' AND a.adid IN (SELECT adid FROM attributes_values WHERE adid IN ' . $attr_clause . ')';
        }

        $data['ads'] = $this->browse_gallery_model->get_ads_by_attributes($select, $from, $where);
        $this->load->view('gallary_view_ajax', $data);
    }

    function load_locations() {
        $loc = $_POST['location'];
        if ($loc == 'kstore') {
            $data['loc'] = $this->browse_gallery_model->get_kstore_locations();
        } else {
            $data['loc'] = $this->browse_gallery_model->get_locations();
        }
        //echo "<script>alert('".$loc."');</script>";
        $this->load->view('location_dropdown', $data);
    }

    function sort_low() {
        $adslist = $_POST['adsArray'];

        $data['ads'] = $this->browse_gallery_model->order_by_lowest_price($adslist);
        $this->load->view('gallary_view_ajax', $data);
    }

    function sort_high() {
        $adslist = $_POST['adsArray'];

        $data['ads'] = $this->browse_gallery_model->order_by_highest_price($adslist);
        $this->load->view('gallary_view_ajax', $data);
    }

    function sort_recent() {
        $adslist = $_POST['adsArray'];

        $data['ads'] = $this->browse_gallery_model->order_by_recent($adslist);
        $this->load->view('gallary_view_ajax', $data);
    }

}

?>
