<?php

class Admin_dash extends CI_Controller {

    function index() {
//        $session_data = $this->session->userdata('logged_in');
//        $this->load->model('mprofileupdate');
//        $data = $this->mprofileupdate->get_user_info($session_data);
//        echo 'Hello';
//        $this->load->view('header');
        $this->load->view('links');
//        $this->load->view('footer');
//        $this->load->view('admintest');
    }

    function category() {
//        $this->load->view('header');
//        $this->load->view('admin');
        $this->load->view('add_category');
//        $this->load->view('footer');
    }

    function advertisment() {
//        $this->load->view('header');
        $this->load->view('adreview');
//        $this->load->view('footer');
    }

    function categorydetails() {
        if ($_POST) {
            $endnode;
            if (isset($_POST['isendcat'])) {
                $endnode = 1;
            } else {
                $endnode = 0;
            }
            $data = array(
                'categoryname' => $_POST['categoryname'],
                'parentcategory' => $_POST['parentcategory'],
                'isendnode' => $endnode
            );
            $this->load->model('admincategory');
            $this->admincategory->set_new_category($data);
//            echo print_r($_POST);
//            echo (int)count($_POST['multipleAttribute']);
//            echo $_POST['multipleAttribute'][1];
            $categoryid=$this->admincategory->getcategoryid($_POST['categoryname']);
            for ($x = 0; $x < count($_POST['multipleAttribute']); $x++) {
                $dataAttributes=array(
                    'attributename' => $_POST['multipleAttribute'][$x],
                    'htmlcomponent' => $_POST['multipleField'][$x],
                    'defaultvalues' => $_POST['multipleDefault'][$x],
                    'categoryid' => $categoryid
                );
                $this->admincategory->set_new_attributes($dataAttributes);
//                echo $_POST['multipleAttribute'][$x];
//                echo $_POST['multipleField'][$x];
//                echo $_POST['multipleDefault'][$x];
//                echo '<br/>';
            }
            $this->load->view('header');
            $this->load->view('links');
            $this->load->view('footer');
        } else {
            echo 'forbidden access';
        }
    }

    function get_id_of_parent_category($catname) {
        $this->load->model('admincategory');
        $categoryid = $this->admincategory->getcategoryid($catname);
        return $categoryid;
    }
    
    function load_prnt_cat(){
        $this->load->model('admincategory');
        $data['category'] = $this->admincategory->get_parent_category_names();
        $this->load->view('load_prnt_cat_view_ajax', $data);
    }
    
    function load_sub_cat(){
        $category=$_POST['selectedCat'];
        $this->load->model('admincategory');
        $data['sub_category'] = $this->admincategory->get_sub_category_names($category);
        $this->load->view('load_sub_cat_view_ajax', $data);
    }

}


/* End of file admin.php */
/* Location: ./application/controllers/admin.php */