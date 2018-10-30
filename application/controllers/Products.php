<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$this->load->model( 'user_model');	
		

		/*
		if( $this->session->userdata('logged_user_id') != '' && $this->session->userdata('logged_user_id') != 0 ):
			echo '<script>window.location.href = "'.base_url().'profile"</script>';
		endif;
		*/
			
	}

	public function index()
	{
	    $level1 = $this->uri->segment(2);
		$level2 = $this->uri->segment(3);
		$level3 = $this->uri->segment(4);

		$l1 = '';
		$l2 = '';
		$l3 = '';
		$prod = [];
		$cat = [];
		$this->db->select('cl1_id,cl1_slug,cl1_title')->from('category_level1')->where(array('cl1_slug'=>$level1,'cl1_status'=>1));
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$data['level1'] = $sql->row();
			$l1 = $sql->row()->cl1_id;
		else:
			redirect(base_url().'404');exit();
		endif;

		$this->db->select('cl2_id,cl2_slug,cl2_title')->from('category_level2')->where(array('cl2_slug'=>$level2,'cl2_status'=>1));
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$data['level2'] = $sql->row();
			$l2 = $sql->row()->cl2_id;
		else:
			redirect(base_url().'404');exit();
		endif;

		if( $level3 != '' ):

			$this->db->select('cl3_id,cl3_slug,cl3_title')->from('category_level3')->where(array('cl3_slug'=>$level3,'cl3_status'=>1));
			$sql = $this->db->get();
			if( $sql->num_rows()>0 ):
				$data['level3'] = $sql->row();
				$l3 = $sql->row()->cl3_id;
			else:
				redirect(base_url().'404');exit();
			endif;

		endif;

		
		
		$this->db->select('pc_product_id')->from('product_categories')->where(array('pc_cl1_id'=>$l1,'pc_cl2_id'=>$l2));
		if( $l3 != '' && $l3 != 0):
		$this->db->where('pc_cl3_id',$l3);
		endif; 
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			foreach( $sql->result() as $records ):
				$prod[] = $records->pc_product_id;
				$cat[] = $records->pc_product_id;
			endforeach;
		endif;
			
		$prod = !empty($prod)?$prod:array(0); 
		
		if($this->input->get('size')):
		
		$size = explode('--',$this->input->get('size'));
		$this->db->select('product_attribute_values.pav_id,product_variations.pv_product_id,product_variations.pv_value_id')->from('product_attribute_values');
		$this->db->join('product_variations','product_attribute_values.pav_id = product_variations.pv_value_id','INNER');
		$this->db->where_in('product_attribute_values.pav_title',$size)->where('product_attribute_values.pav_status',1);
		//$this->db->where_in('product_variations.pv_product_id',$cat);
		$sql = $this->db->get();
			if( $sql->num_rows()>0 ):
				foreach( $sql->result() as $val ):
					if( in_array($val->pv_product_id,$cat) ):
					$prod[] = $val->pv_product_id;
					endif;
				endforeach;
			endif;
		
		endif;

		if($this->input->get('color')):
		
		$color = explode('--',$this->input->get('color'));
		$this->db->select('product_attribute_values.pav_id,product_variations.pv_product_id,product_variations.pv_value_id')->from('product_attribute_values');
		$this->db->join('product_variations','product_attribute_values.pav_id = product_variations.pv_value_id','INNER');
		$this->db->where_in('product_attribute_values.pav_title',$color)->where('product_attribute_values.pav_status',1);
		//$this->db->where_in('product_variations.pv_product_id',$cat);
		
		$sql = $this->db->get();
			if( $sql->num_rows()>0 ):
				foreach( $sql->result() as $val ):
					if( in_array($val->pv_product_id,$cat) ):
					$prod[] = $val->pv_product_id;
					endif;
				endforeach;
			endif;
		
		endif;
		
		if($this->input->get('gender')):
		
		$gender = explode('--',$this->input->get('gender'));
		$this->db->select('product_attribute_values.pav_id,product_variations.pv_product_id,product_variations.pv_value_id')->from('product_attribute_values');
		$this->db->join('product_variations','product_attribute_values.pav_id = product_variations.pv_value_id','INNER');
		$this->db->where_in('product_attribute_values.pav_title',$gender)->where('product_attribute_values.pav_status',1);
		//$this->db->where_in('product_variations.pv_product_id',$cat);
		$sql = $this->db->get();
			if( $sql->num_rows()>0 ):
				foreach( $sql->result() as $val ):
					if( in_array($val->pv_product_id,$cat) ):
					$prod[] = $val->pv_product_id;
					endif;
				endforeach;
			endif;
		
		endif;
		

		$this->db->select('*')->from('products');
		$this->db->where_in('product_id',$prod);

		
		
		if($this->input->get('price')):
		$price = explode('-',$this->input->get('price'));
		$this->db->where('product_price BETWEEN '.$price[0].' AND '.$price[1].' ', NULL, FALSE );
		endif;
		
		$this->db->where('product_status',1);
		$sql = $this->db->get();
		//echo $this->db->get_compiled_select(); 
		//exit();
		$data['products'] = $sql->result();
		$this->load->view('products',$data);

	}

	public function view_product()
	{
		

		$slug = $this->uri->segment(2);
		$ref = $this->uri->segment(3);



		$this->db->select('users.u_firstname,reviews.*')->from('users');	
		$this->db->join('reviews', 'reviews.user_id = users.u_id', 'inner');	
		$this->db->join('products', 'reviews.product_id = products.product_id', 'inner');
		$this->db->where('products.product_reference ='.$ref);
		$this->db->where('reviews.status =1');
		$this->db->order_by("reviews.review_id", "desc");



		$sql  				=   $this->db->get();
		$data['reviews']    =   $sql->result();


				
		$this->db->select('*')->from('products')->where(array('product_slug'=>$slug,'product_reference'=>$ref,'product_status'=>1));
		$sql = $this->db->get();

		if( $sql->num_rows()>0 ):
			$data['product'] = $sql->row();
			$data['comment'] =  $this->db->query('select * from comment where product_id ='.$data['product']->product_id)->result();
			//print_r($data);

			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        			//ip from share internet
        		$ip = $_SERVER['HTTP_CLIENT_IP'];
    			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        		//ip pass from proxy
        		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    			}else{
        		$ip = $_SERVER['REMOTE_ADDR'];
    			}
    			$ip;


    		$this->db->select('*')->from('cart')->where(array('product_id'=>$data['product']->product_id,'user_ip'=>$ip));
			$sql = $this->db->get();
			if( $sql->num_rows()>0 ):
			$data['cart'] = $sql->row();	
			$this->load->view('product-detail',$data);
		    else:
		    $this->load->view('product-detail',$data);	
		    endif;	



		else:
			redirect(base_url().'404');
		endif;
	}

	public function categories()
	{
		$slug = $this->uri->segment(2);
		$this->db->select('*')->from('category_level1')->where(array('cl1_slug'=>$slug));
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$row = $sql->row();
			$data['level1'] = $row;
			$this->db->select('*')->from('category_level2')->where(array('cl1_id'=>$row->cl1_id,'cl2_status'=>1));
			$sql = $this->db->get();
			if( $sql->num_rows()>0 ):
				$data['level2'] = $sql->result();
				$this->load->view('categories',$data);
			else:
				redirect(base_url().'404');
			endif;

		else:
			redirect(base_url().'404');
		endif;
	}

	public function categories_products()
	{
		$slug = $this->uri->segment(1);
		$this->db->select('*')->from('category_level1')->where('cl1_slug',$slug);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$row = $sql->row();
			$data['data'] = $row;

			$this->load->model('products_model');
			$this->load->library("pagination");
			$config = array();
	        $config["base_url"] = base_url().$slug;
	        $config["total_rows"] = $this->products_model->count_records($table='product_categories',$condition=$row->cl1_id);
	        $config["per_page"] = 1;
	        //$config["uri_segment"] = 1;

	        $config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul><!--pagination-->';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>' . "\n";
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>' . "\n";
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>' . "\n";
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>' . "\n";
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>' . "\n";

	        /*
	        $config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";

			*/

        	$this->pagination->initialize($config);

	        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
	        $data["products"] = $this->products_model->fetch_products($condition=$row->cl1_id,$config["per_page"],$page);
	        $data["links"] = $this->pagination->create_links();
			//print_r($data);exit();
			$this->load->view('categories-products',$data);
		else:
			redirect(base_url().'404');
		endif;
	}




	public function product_list()
	{






	}

	
	

}
