<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }


    public function count_records($table,$condition) {
        $this->db->where('pc_cl1_id',$condition);
        return $this->db->count_all($table);
        
    }

    public function fetch_products($condition,$limit,$start) {
        
        $data = [];
        echo $start;
        $this->db->select('pc_product_id')->from('product_categories')->where('pc_cl1_id',$condition);
        $clause = $this->db->get_compiled_select();
        $this->db->select('*')->from('products');
        $this->db->where('`product_id` IN ('.$clause.')',NULL,FALSE);
        $this->db->where('product_status',1);
        $this->db->limit($start,$limit);
        $sql = $this->db->get();
        if( $sql->num_rows()>0 ):
            foreach( $sql->result() as $row ):
                $data[] = $row;
                //print_r($row);exit();
            endforeach;
            return $data;
        endif;
    
    }


    
    
    
    
   
}


