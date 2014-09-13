<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class New_Ad_Post extends CI_Controller {

    function __costruct() {
        parent::__costruct();

    }

    public function index() {

        $this->load->library('session');
        $this->session->set_userdata('newcount',0);
        $this->getComboValues();
    }

    public function getComboValues() {
        $this->load->model('new_ad_post_model');
        $data['cat'] = $this->new_ad_post_model->getCategory();
        $this->load->view('new_ad_posting', $data);
    }

    public function getSubCat($catId) {
        $this->load->model('new_ad_post_model');
        $data['subcat'] = $this->new_ad_post_model->getSubCategory($catId);

        if (!empty($data['subcat'])) {
            echo '<select class="input-group" id="ChooseSubCategory" onchange="checkSubSubCat(this.value)" name="category" style="margin-left: 68px;width: 400px; margin-top: 10px; margin-bottom: 10px; padding-top: 4px; border-top-width: 1px; top: 20px;" >';
            echo '<option value="select" disabled selected>Select a Subcategory...</option>';

            if (isset($data['subcat'])) {
                foreach ($data['subcat'] as $row) {
                    $catid = $row->categoryid;
                    $catname = $row->categoryname;
                    $cattype = $row->parentcategory;
                    $isendnode = $row->isendnode;


                    echo '<option value="' . $catid . " " . $isendnode . '">' . $catname . '</option>';
                }
            }

            echo '</select>';
        }
    }

    public function getSubSubCat($catId) {
        $this->load->model('new_ad_post_model');
        $data['subcat'] = $this->new_ad_post_model->getSubCategory($catId);

        if (!empty($data['subcat'])) {
            echo '<select class="input-group" id="ChooseSubSubCategory" onchange="checklastSubCat(this.value)" name="category" style="margin-left: 68px;width: 300px; margin-top: 10px; margin-bottom: 40px; padding-top: 4px; border-top-width: 1px; top: 20px;" >';
            echo '<option value="select" disabled selected>Select a Subcategory...</option>';

            if (isset($data['subcat'])) {
                foreach ($data['subcat'] as $row) {

                    $catid = $row->categoryid;
                    $catname = $row->categoryname;
                    //$cattype = $row->parentcategory;
                    $isendnode = $row->isendnode;

                    echo '<option value="' . $catid . " " . $isendnode . '">' . $catname . '</option>';
                }
            }
            echo '</select>';
        }
    }

    public function getfields($catId) {

        $this->load->model('new_ad_post_model');
        $data['catFields'] = $this->new_ad_post_model->getCategoryFields($catId);
        
        $counntt=0;
        foreach($data['catFields'] as $row) 
        {
            $counntt++;
        }
        $this->load->library('session');
        $this->session->set_userdata('newcount',$counntt);
        
        
        $data['catselect'] = $this->new_ad_post_model->getCategoryselect($catId);

        $this->load->view('new_category_view', $data);
    }

    public function adCoupon() {
        $this->load->library('session');
        $adID = $this->session->userdata['adId'];

        $data1 = array('coupencode' => $_POST['coupencode'],
            'adid' => $adID,
            'expdate' => $_POST['expdate'],            
            'percentage' => $_POST['percentage'],
            'noofcoupons' => $_POST['noofcoupons']
        );

        $this->load->model('new_ad_post_model');
        $this->new_ad_post_model->setCoupon($data1);
    }

    public function adPost() {

        $user = $this->session->userdata['logged_in']['userid']; //get user id from session

        $data1 = array('title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'categoryid' => $_POST['categoryid'],
            'isnegotiable' => $_POST['isnegotiable'],
            'quantity' => $_POST['qty'],
            'location' => $_POST['location'],
            'sellerid' => $user
        );

        $this->load->model('new_ad_post_model');
        $id = $this->new_ad_post_model->setAd($data1);// call model function for post ad
        

        $this->load->library('session');
        $this->session->set_userdata('adId', $id);//add adid to session
        
        $this->load->library('session');
        $this->session->set_userdata('adTitle', $_POST['title']);//add adid to session


        if(!$_POST['values'][0]==0)
        {
            $this->load->model('new_ad_post_model');
            $data['catFields'] = $this->new_ad_post_model->getCategoryFields($_POST['categoryid']);//get category fields
            $filedCount=0;
            foreach ($data['catFields'] as $row){

                $attributeid = $row->attributeid;
                $data2 = array('adid' => $id,
                        'attributeid' => $attributeid,
                        'attributevalue' => $_POST['values'][$filedCount] );

                    $this->load->model('new_ad_post_model');
                    $this->new_ad_post_model->setAdValues($data2);
                    $filedCount++;
            }       
        }
        
        
        //image upload
        $this->load->helper('file');
        $allimages = get_filenames(APPPATH . '../images/temp/');
       
             
        foreach ($allimages as $img)
        {
        $split2 = explode("-",$img);
        $uid = $split2[0];
        
            if($uid == $user)
            {
                $userimg[]=$img;
            }
            
        }
        $imgCount = 1; 
        foreach ($userimg as $key)
        {
            if(preg_match("/_thumb/",$key)== FALSE)
            {                          
                $split = explode(".",$key);
                $imgName = $split[0];
                $imgExt=$split[1];              
                $thumbImg=$imgName."_thumb.".$imgExt;
                
                $tempname1 = APPPATH . '../images/uploads/' . $id . '_' . $imgCount.'.'. $imgExt;
                rename(APPPATH . '../images/temp/' . $key, $tempname1);
                
                $tempname2 = APPPATH . '../images/uploads/' . $id . '_' . $imgCount .'_thumb.'.$imgExt;
                rename(APPPATH . '../images/temp/' .$thumbImg , $tempname2);
                
                $namess = array('adid' => $id, 'imageurl' => $id.'_'.$imgCount.'.'.$imgExt ,'thumb_imageurl'=>$id.'_'.$imgCount.'_thumb.'.$imgExt);
                
                $this->load->model('new_ad_post_model');
                $this->new_ad_post_model->uploadImagetoTable($namess);
                
                $imgCount++;
            }
            
            $this->load->model('new_ad_post_model');
            $this->new_ad_post_model->uploadImageName($id .'_1.jpg', $id);
        
        } 
      
            $this->save_search_string($data1['title'], $id);
    }

    function save_search_string($title, $ad_id) {
        $title = trim($title, "~");
        $pieses = explode(" ", $title);
        $text = "";
        $max = sizeof($pieses);
        //var_dump($pieses); 
        for ($x=0; $x<$max; $x++) {
            $text = $text . "~" . $pieses[$x];
        }
        $text = ltrim($text, "~");
        $data = array(
            'ad_id' => $ad_id,
            'Title_Text' => $text
        );
        //var_dump($data);
        $this->new_ad_post_model->save_search_string($data);
    }

    public function genarateLink() {
        $this->load->library('session');
        $showAdID = $this->session->userdata['adId'];
        
        echo '<div> <h1> Click the link to preview your advertisement </h1> <a href="http://kstoretesting.net16.net/ad_details?adid=' . $showAdID . '" target="_blank"> http://kstoretesting.net16.net/advertisement </a> </div>';
    }
    
    
    public function sendReceipt() {
        $this->load->library('session');
        $email = $this->session->userdata['email'];
        
        $this->load->library('session');
        $adTitle=$this->session->userdata['adTitle'];
        
        
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('no-reply@kstoretesting.net16.net', 'K-Store');
        $this->email->to($email);
        $this->email->subject('Receipt:'.$adTitle);
        $this->email->message('
                <html>
                <head>
                <title>Receipt for'.$adTitle.'</title>
                </head>
                <body>
                <h2>KStore Online Product Store</h2>
                <br/>

                </body>
                </html>
        ');

        $this->email->send();
    }

}