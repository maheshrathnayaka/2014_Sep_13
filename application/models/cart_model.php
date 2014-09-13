<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cart_model
 *
 * @author Hasith Malinga
 */
class Cart_model extends CI_Model {

    function validate_add_cart_item() {

        $id = $this->input->post('ad_id'); // Assign from hidden field ad_id to $id
        $quantity=  $this->input->post('qty');
        $passQty=1;
        if($quantity>$passQty){
            $passQty=$quantity;
        }

        $this->db->select('adid, title, quantity, price,image');
        $this->db->from('ads');
        $this->db->where('adid', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        //var_dump($query);
        if ($query->num_rows > 0) {

            foreach ($query->result() as $row) {
                //print_r($row->title);
                $data = array(
                    'id' => $row->adid,
                    'qty' => $passQty,
                    'price' => $row->price,
                    'name' => $row->title,
                    'options' => array('stock'=>$row->quantity,'image'=>$row->image)
                );

                // Add the data to the cart
                //var_dump($data);
                $this->cart->insert($data);

                return TRUE;
            }
        } else {
            // Nothing found! Return FALSE!
            return FALSE;
        }
    }

    function validate_update_cart() {

        //$total = $this->cart->total_items();
        $items = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $stock = $this->input->post('stock');

        $i=0;
        foreach ($items as $id) {
            if($stock[$i]<$qty[$i]){
                //echo 'Stock quantity is less than the Quantity you entered';
            }else{
            $data = array(
                'rowid' => $id,
                'qty' => $qty[$i]
            );
            
            //var_dump($data);

            // Update the cart with the new information
            $this->cart->update($data);
            }
            $i++;
        }
    }

}

/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */
