<?php
class live_search extends CI_Controller
{
    
    
   function __costruct() {
        parent::__costruct();
    }

    public function index() 
    {
            if($_POST)
            {
                  
        $q = mysql_real_escape_string($_POST['search']);
        $this->load->model('live_search_model');  
        $strSQL_Result=$this->live_search_model->live($q);
        foreach($strSQL_Result as $row)
        {
            $username   = $row->title;
            //$loaction      = $row->location;
            $b_username = '<strong>'.$q.'</strong>';
           // $b_loaction    = '<strong>'.$q.'</strong>';
            $final_username = str_ireplace($q, $b_username, $username);
            //$final_loaction = str_ireplace($q, $b_loaction, $loaction);
            
            echo '<div id="res" class="show" align="left">';
            echo '<span class="name" style="color:#707070;">'.$final_username.'<br/>';
            echo '</div>';
            
        }
}
    }
    

}
