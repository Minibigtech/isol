<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
		
	public function searchByFilter($data){

		if(isset($data['level1'])){
			$level1 = $data['level1'];
		}else{
		   $level1 = '';
		}
		if(isset($data['level2'])){
			$level2 = $data['level2'];
		}else{
		   $level2 = '';
		}
		if(isset($data['level3'])){
			$level3 = $data['level3'];
		}else{
		    $level3 = '';
		}

		$cod= (isset($data['cod']) &&  !empty($data['cod']))?$data['cod']:'';
		$old= (isset($data['old']) &&  !empty($data['old']))?$data['old']:'';
		$sold_out= (isset($data['sold_out']) &&  !empty($data['sold_out']))?$data['sold_out']:'';
		$available= (isset($data['avalaible']) &&  !empty($data['avalaible']))?1:'';
		$new= (isset($data['new']) &&  !empty($data['new']))?'New':'';
		
		$start_price= (isset($data['start_price']) &&  !empty($data['start_price']))?$data['start_price']:'';
		$end_price= (isset($data['end_price']) &&  !empty($data['end_price']))?$data['end_price']:'';
		$repair= (isset($data['repair']) &&  !empty($data['repair']))?$data['repair']:'';

		$this->db->select('products.*');
		$this->db->join('product_categories' , 'product_categories.pc_product_id = products.product_id');
		if(!empty($level1)){
			$this->db->or_where_in('product_categories.pc_cl1_id' , $level1 );
		}
		if(!empty($level2)){
			$this->db->or_where_in('product_categories.pc_cl2_id' , $level2 );
		}
		if(!empty($level3)){
			$this->db->or_where_in('product_categories.pc_cl3_id' , $level3 );
		}
		if(!empty($cod)){
			$this->db->or_where_in('products.cod' , $cod );
		}
		if(!empty($old)){
			$this->db->or_where_in('products.product_condition' , $old );
		}
		if(!empty($new)){
			$this->db->or_where_in('products.product_condition' , $new );
		}
		if(!empty($sold_out)){
			$this->db->or_where_in('products.sold_out' , $sold_out );
		}
		
		if(!empty($available)){
			$this->db->or_where_in('products.available' , $available );
		}
		if(!empty($repair)){
			$this->db->or_where_in('products.repair' , $repair );
		}
		if(!empty($start_price)){
			$start_price = (int)$start_price;
			$this->db->where('products.product_price >=' , $start_price );
		}
		if(!empty($end_price)){	
			$this->db->where('products.product_price <' , $end_price );
		}
		$result = $this->db->get('products');
		
		return $result->result();
	}

	public function search_by_cat($data){
		$this->db->select('products.*');
		$this->db->join('product_categories' , 'product_categories.pc_product_id = products.product_id');
		$this->db->or_where_in('product_categories.pc_cl1_id' , $data );
		$result = $this->db->get('products');
		return $result->result();
	}
}


