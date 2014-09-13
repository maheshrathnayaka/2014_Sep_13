<?php
class Adminadreview_Model extends CI_Model{
    public function get_pending_ads(){
        $this->db->select()->from('ads')->where('status', 'pending');
        $query=  $this->db->get();
        return $query->result_array();
    }
}


/* End of file adminadreview.php */
/* Location: ./application/models/adminadreview.php */