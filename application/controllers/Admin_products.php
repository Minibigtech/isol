<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_products extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		if( empty( $this->session->userdata('logged_admin_id') ) ):
			redirect(base_url().'admin');
		endif;

		$this->db->select('*')->from('administrator');
		$this->db->where('admin_id',$this->session->userdata('logged_admin_id'));
		$sql = $this->db->get();
		$this->admininfo = $sql->row();


		


	}

	public function generate_ref($ref){
		$this->db->select('product_id')->from('products')->where('product_reference',$ref);
		$this->db->limit(1);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$new = substr(number_format(time() * rand(),0,'',''),0,8);
			$this->generate_ref($new);
		else:
			return $ref;
		endif;
	}


	public function product_attributes()
	{
		
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$this->db->select('*')->from('product_attributes');
		$sql = $this->db->get();
		$data['attributes'] = $sql->result();
		$this->load->view('admin/product-attributes',$data);
	}

	public function add_product_attribute()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$this->load->view('admin/add-product-attribute');
	}


	public function add_product_attribute_list()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );

		$this->db->select('pa_id')->from('product_attributes')->where(array('pa_title'=>$title));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of attribute already exists');
			echo '<script>window.history.back();</script>';exit();
		endif;
		
		$this->db->set('pa_slug',$slug);
		$this->db->set('pa_title',$title);
		$this->db->set('pa_status',$status);
		$this->db->insert('product_attributes');
		$this->session->set_flashdata('att','Added Successfully');
		redirect(base_url().'admin/product-attributes');
		
	}

	public function edit_product_attribute()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$id = $this->uri->segment(3);
		$this->db->select('*')->from('product_attributes')->where('pa_id',$id);
		$this->db->limit(1);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['attribute'] = $sql->row();
			$this->load->view('admin/edit-product-attribute',$data);
		else:
			redirect(base_url().'admin/404');
		endif;
		
	}

	public function update_product_attribute()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');
		
		$id = $this->input->post('id');

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );

		$this->db->select('pa_id')->from('product_attributes')->where(array('pa_title'=>$title,'pa_id != '=>$id));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of attribute already exists');
			redirect(base_url('admin/edit-product-attribute/'.$id));exit();
		endif;

		$this->db->select('*')->from('product_attributes')->where('pa_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):

			$row = $sql->row();

			$this->db->where('pa_id',$id);
			$this->db->update('product_attributes',array('pa_slug'=>$slug,'pa_title'=>$title,'pa_status'=>$status) );
			$this->session->set_flashdata('att','Updated Successfully');
			redirect(base_url().'admin/product-attributes');
		else:
			redirect(base_url('404'));
		endif;
		
	}

		

	public function product_variations()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$this->db->select('product_attribute_values.*,product_attributes.pa_title')->from('product_attribute_values');
		$this->db->join('product_attributes','product_attribute_values.pav_attribute_id = product_attributes.pa_id','INNER');
		$sql = $this->db->get();
		$data['variations'] = $sql->result();
		$this->load->view('admin/product-variations',$data);
	}

	public function add_product_variation()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$this->load->view('admin/add-product-variation');
	}


	public function add_product_variation_list()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;
		
		$attribute = trim( $this->input->post('attribute') );
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );

		$this->db->select('pav_id')->from('product_attribute_values')->where(array('pav_attribute_id'=>$attribute,'pav_title'=>$title));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of variation already exists');
			echo '<script>window.history.back();</script>';exit();
		endif;

		$this->db->set('pav_slug',$slug);
		$this->db->set('pav_attribute_id',$attribute);
		$this->db->set('pav_title',$title);
		$this->db->set('pav_status',$status);
		$this->db->insert('product_attribute_values');
		$this->session->set_flashdata('pv','Added Successfully');
		redirect(base_url().'admin/product-variations');
		
	}

	public function edit_product_variation()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$id = $this->uri->segment(3);
		$this->db->select('*')->from('product_attribute_values')->where('pav_id',$id);
		$this->db->limit(1);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['variation'] = $sql->row();
			$this->load->view('admin/edit-product-variation',$data);
		else:
			redirect(base_url().'admin/404');
		endif;
		
	}

	public function update_product_variation()
	{
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$attribute = trim( $this->input->post('attribute') );
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');
		
		$id = $this->input->post('id');

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );

		$this->db->select('pav_id')->from('product_attribute_values')->where(array('pav_attribute_id'=>$attribute,'pav_title'=>$title,'pav_id != '=>$id));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of variation already exists');
			redirect(base_url('admin/edit-product-variation/'.$id));exit();
		endif;

		$this->db->select('*')->from('product_attribute_values')->where('pav_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):

			$row = $sql->row();

			$this->db->where('pav_id',$id);
			$this->db->update('product_attribute_values',array('pav_slug'=>$slug,'pav_attribute_id'=>$attribute,'pav_title'=>$title,'pav_status'=>$status) );
			$this->session->set_flashdata('pv','Updated Successfully');
			redirect(base_url().'admin/product-variations');
		else:
			redirect(base_url('404'));
		endif;
		
	}


	public function products()
	{
		$this->db->select('products.*')->from('products');
		//$this->db->join('category_level1','products.cl1_id = category_level1.cl1_id','INNER');
		//$this->db->join('category_level2','products.cl2_id = category_level2.cl2_id','INNER');
		//$this->db->join('category_level3','products.cl3_id = category_level3.cl3_id','INNER');
		
		$sql = $this->db->get();
		$data['products'] = $sql->result();
		$this->load->view('admin/products',$data);
	}

	public function add_product()
	{
		$data['country'] = $this->db->query('select * from country')->result();
		$this->load->view('admin/add-product',$data);
	}
	
	public function add_product_list()
	{
		//print_r($_POST);
		//print_r($_FILES);
		//exit();
		
		$upload1 = '';
		$upload2 = '';

		$title = trim( $this->input->post('title') );
		$shortdesc = trim( $this->input->post('shortdesc') );
		$fulldesc = trim( $this->input->post('fulldesc') );
		$price = trim( $this->input->post('price') );
		//$saleprice = trim( $this->input->post('saleprice') );
		//$discount = trim( $this->input->post('discount') );
		$stock = trim( $this->input->post('stock') );
		$stockdisplay = trim( $this->input->post('stockdisplay') );
		$latest = trim( $this->input->post('latest') );
		$featured = trim( $this->input->post('featured') );
		$hot = trim( $this->input->post('hot') );
		$superhot = trim( $this->input->post('superhot') );
		$status = trim( $this->input->post('status') );
		$get_quote = trim( $this->input->post('get_quote') );
		$check_country = trim( $this->input->post('check_country') );
		$repair = trim( $this->input->post('repair') );
		$cod = trim( $this->input->post('cod') );	
		$repair_price = trim( $this->input->post('repair_price') );
		$shipping = trim( $this->input->post('shipping') );
		$delivery = trim( $this->input->post('delivery') );
		$return_days = trim( $this->input->post('return_days') );
		$description = trim( $this->input->post('description') );
		$product_condition = trim( $this->input->post('product_condition') );
		$available = trim( $this->input->post('available') );
		$sold_out = trim( $this->input->post('sold_out') );
		$return = trim( $this->input->post('return') );
		$country = trim( $this->input->post('country') );
		$created_by  = trim($this->session->userdata('logged_admin_id'));
		$attribute = implode(',', $this->input->post('attribute'));
		$value = implode(',', $this->input->post('value'));

		$level1 = $this->input->post('level1');
		$level2 = $this->input->post('level2');
		$level3 = $this->input->post('level3');
		
		$attributes = $this->input->post('attributes');

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );

		/*
		$refernce = substr(number_format(time() * rand(),0,'',''),0,8);
	
		$sql = $db->query('SELECT product_id FROM products WHERE product_reference = "'.$refernce.'" ')or die($db->error);
		if($sql->num_rows>0):
		else:
		$refernce = substr(number_format(time() * rand(),0,'',''),0,8);
		endif;
		*/
		$refernce = substr(number_format(time() * rand(),0,'',''),0,8);

		$refernce = $this->generate_ref($refernce);

		//echo $refernce;exit();

		if( isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !='' && $_FILES['photo']['tmp_name'] != '' ):
			$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'featured'.$_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/products/'.$upload1);
		endif;

		$this->db->set('product_slug',$slug);
		$this->db->set('product_reference',$refernce);
		$this->db->set('created_by',$created_by);
		$this->db->set('country',$country);
		$this->db->set('product_title',$title);
		$this->db->set('product_photo',$upload1);
		$this->db->set('product_short_description',$shortdesc);
		$this->db->set('upload_date',date('d-m-Y'));
		$this->db->set('check_country',$check_country);
		$this->db->set('product_description',$fulldesc);
		$this->db->set('updated_by',$created_by);
		$this->db->set('product_price',$price);
		//$this->db->set('product_sale_price',$saleprice);
		//$this->db->set('product_discount',$discount);
		$this->db->set('product_stock',$stock);
		$this->db->set('product_stock_show',$stockdisplay);
		$this->db->set('product_latest',$latest);
		$this->db->set('product_featured',$featured);
		$this->db->set('product_hot',$hot);
		$this->db->set('product_super_hot',$superhot);
		$this->db->set('product_status',$status);
		$this->db->set('get_quote',$get_quote);
		$this->db->set('repair',$repair);
		$this->db->set('cod',$cod);
		$this->db->set('repair_price',$repair_price);
		$this->db->set('shipping',$shipping);
		$this->db->set('delivery',$delivery);
		$this->db->set('return_days',$return_days);
		$this->db->set('description',$description);
		$this->db->set('product_condition',$product_condition);
		$this->db->set('attribute',$attribute);
		$this->db->set('value',$value);
		$this->db->set('available',$available);
		$this->db->set('sold_out',$sold_out);
		$this->db->set('return',$return);
		$this->db->insert('products');
		$id = $this->db->insert_id();

		if( count($_FILES['gallery']['name']) > 1 ):
			for( $i = 0; $i<count($_FILES['gallery']['name']); $i++):
				if( $_FILES['gallery']['name'][$i] != '' && $_FILES['gallery']['tmp_name'][$i] != ''):
					$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'gallery'.$i.$_FILES['gallery']['name'][$i];

					$this->db->set('product_id',$id);
					$this->db->set('photo',$upload2);
					$this->db->insert('product_photos');
					move_uploaded_file($_FILES['gallery']['tmp_name'][$i],getcwd().'/assets/images/products/'.$upload2);
				endif;
			endfor;
		endif;
		
		if( isset( $level3 ) && count($level3)>0 ):
			for( $i = 0; $i<count($level3); $i++ ):
				$new = explode(',',$level3[$i]);
				$this->db->select('pc_id')->from('product_categories')->where(array('pc_product_id'=>$id,'pc_cl3_id'=>$new[2]));
				$chk = $this->db->get();
				if( !($chk->num_rows()>0) ):

					$this->db->set('pc_product_id',$id);
					$this->db->set('pc_cl1_id',$new[0]);
					$this->db->set('pc_cl2_id',$new[1]);
					$this->db->set('pc_cl3_id',$new[2]);
					$this->db->insert('product_categories');
				
				endif;
			endfor;
		endif;

		if( isset( $level2 ) && count($level2)>0 ):
			for( $i = 0; $i<count($level2); $i++ ):
				$new = explode(',',$level2[$i]);
				$this->db->select('pc_id')->from('product_categories')->where(array('pc_product_id'=>$id,'pc_cl2_id'=>$new[1]));
				$chk = $this->db->get();
				if( !($chk->num_rows()>0) ):

					$this->db->set('pc_product_id',$id);
					$this->db->set('pc_cl1_id',$new[0]);
					$this->db->set('pc_cl2_id',$new[1]);
					$this->db->insert('product_categories');
				
				endif;
			endfor;
		endif;

		if( isset( $level1 ) && count($level1)>0 ):
			for( $i = 0; $i<count($level1); $i++ ):
				$this->db->select('pc_id')->from('product_categories')->where(array('pc_product_id'=>$id,'pc_cl1_id'=>$level1[$i]));
				$chk = $this->db->get();
				if( !($chk->num_rows()>0) ):

					$this->db->set('pc_product_id',$id);
					$this->db->set('pc_cl1_id',$level1[$i]);
					$this->db->insert('product_categories');
				
				endif;
			endfor;
		endif;

		if( count($attributes) > 0 ):
			foreach ( $attributes as $val ):
				$val = explode(',',$val);
				$this->db->set('pv_product_id',$id);
				$this->db->set('pv_attribute_id',$val[0]);
				$this->db->set('pv_value_id',$val[1]);
				$this->db->insert('product_variations');
			endforeach;
		endif;

		$this->session->set_flashdata('prod','Successfully Added');
		add_log($this->session->userdata('logged_admin_id'),'Product','Product   Added');
		redirect(base_url().'admin/products');
			
		
		
	}


	public function edit_product()
	{
		$id = $this->uri->segment(3);

		$this->db->select('*')->from('products')->where('product_id',$id);
		$this->db->limit(1);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['product'] = $sql->row();
			$data['country'] = $this->db->query('select * from country')->result();
			$this->load->view('admin/edit-product',$data);
		else:
			redirect(base_url().'admin/404');
		endif;
		
	}

	public function update_product()
	{
		
		$upload1 = '';
		$upload2 = '';

		$title = trim( $this->input->post('title') );
		$shortdesc = trim( $this->input->post('shortdesc') );
		$fulldesc = trim( $this->input->post('fulldesc') );
		$price = trim( $this->input->post('price') );
		//$saleprice = trim( $this->input->post('saleprice') );
		//$discount = trim( $this->input->post('discount') );
		$stock = trim( $this->input->post('stock') );
		$stockdisplay = trim( $this->input->post('stockdisplay') );
		$latest = trim( $this->input->post('latest') );
		$featured = trim( $this->input->post('featured') );
		$hot = trim( $this->input->post('hot') );
		$superhot = trim( $this->input->post('superhot') );
		$status = trim( $this->input->post('status') );
		$get_quote = trim( $this->input->post('get_quote') );
		$repair = trim( $this->input->post('repair') );
		$country = trim( $this->input->post('country') );
		$cod = trim( $this->input->post('cod') );
		$repair_price = trim( $this->input->post('repair_price') );
		$shipping = trim( $this->input->post('shipping') );
		$delivery = trim( $this->input->post('delivery') );
		$return_days = trim( $this->input->post('return_days') );
		$available = trim( $this->input->post('available') );
		$sold_out = trim( $this->input->post('sold_out') );
		$description = trim( $this->input->post('description') );
		$product_condition = trim( $this->input->post('product_condition') );
		$attribute = implode(',', $this->input->post('attribute'));
		$value = implode(',', $this->input->post('value'));
		$check_country = trim( $this->input->post('check_country'));
		$return = trim($this->input->post('return'));
		$created_by  = trim($this->session->userdata('logged_admin_id'));
		
		$level1 = $this->input->post('level1');
		$level2 = $this->input->post('level2');
		$level3 = $this->input->post('level3');
		
		$attributes = $this->input->post('attributes');

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		
		$id = $this->input->post('id');

		$this->db->select('*')->from('products')->where('product_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):

			$row = $sql->row();

			$data = array(
					'product_slug'=>$slug,
					'product_title'=>$title,
					'product_short_description'=>$shortdesc,
					'product_description'=>$fulldesc,
					'check_country'=>$check_country,
					'product_price'=>$price,
					'updated_by'=>$created_by,
					//'product_sale_price'=>$saleprice,
					//'product_discount'=>$discount,
					'product_stock'=>$stock,
					'country'=>$country,
					'product_stock_show'=>$stockdisplay,
					'product_latest'=>$latest,
					'product_featured'=>$featured,
					'product_hot'=>$hot,
					'product_super_hot'=>$superhot,
					'product_status'=>$status,
					'get_quote'=> $get_quote,
					'repair'  => $repair,
					'cod'   => $cod,
					'repair_price' => $repair_price,
					'shipping'=> $shipping,
					'delivery'=> $delivery,
					'return_days'=> $return_days,
					'description'=> $description,
					'available'=> $available,
					'sold_out'=> $sold_out,
					'product_condition'=> $product_condition,
					'attribute'=> $attribute,
					'return'=> $return,
					'value'=> $value
					);

			$this->db->where('product_id',$row->product_id);
			$this->db->update('products',$data);

			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
				$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'featured'.$_FILES['photo']['name'];
				@unlink(getcwd().'/assets/images/products/'.$row->product_photo);
				$this->db->where('product_id',$row->product_id);
				$this->db->update('products',array('product_photo'=>$upload1));
				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/products/'.$upload1);	
			endif;


			if( count($_FILES['gallery']['name']) > 1 ):
				for( $i = 0; $i<count($_FILES['gallery']['name']); $i++):
					if( $_FILES['gallery']['name'][$i] != '' && $_FILES['gallery']['tmp_name'][$i] != ''):
						$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'gallery'.$i.$_FILES['gallery']['name'][$i];

						$this->db->set('product_id',$row->product_id);
						$this->db->set('photo',$upload2);
						$this->db->insert('product_photos');
						move_uploaded_file($_FILES['gallery']['tmp_name'][$i],getcwd().'/assets/images/products/'.$upload2);
					endif;
				endfor;
			endif;
		
			$this->db->where('pc_product_id',$row->product_id);
			$this->db->delete('product_categories');

			if( isset( $level3 ) && count($level3)>0 ):
				for( $i = 0; $i<count($level3); $i++ ):
					$new = explode(',',$level3[$i]);
					$this->db->select('pc_id')->from('product_categories')->where(array('pc_product_id'=>$id,'pc_cl3_id'=>$new[2]));
					$chk = $this->db->get();
					if( !($chk->num_rows()>0) ):

						$this->db->set('pc_product_id',$row->product_id);
						$this->db->set('pc_cl1_id',$new[0]);
						$this->db->set('pc_cl2_id',$new[1]);
						$this->db->set('pc_cl3_id',$new[2]);
						$this->db->insert('product_categories');
					
					endif;
				endfor;
			endif;

			if( isset( $level2 ) && count($level2)>0 ):
				for( $i = 0; $i<count($level2); $i++ ):
					$new = explode(',',$level2[$i]);
					$this->db->select('pc_id')->from('product_categories')->where(array('pc_product_id'=>$id,'pc_cl2_id'=>$new[1]));
					$chk = $this->db->get();
					if( !($chk->num_rows()>0) ):

						$this->db->set('pc_product_id',$row->product_id);
						$this->db->set('pc_cl1_id',$new[0]);
						$this->db->set('pc_cl2_id',$new[1]);
						$this->db->insert('product_categories');
					
					endif;
				endfor;
			endif;

			if( isset( $level1 ) && count($level1)>0 ):
				for( $i = 0; $i<count($level1); $i++ ):
					$this->db->select('pc_id')->from('product_categories')->where(array('pc_product_id'=>$id,'pc_cl1_id'=>$level1[$i]));
					$chk = $this->db->get();
					if( !($chk->num_rows()>0) ):

						$this->db->set('pc_product_id',$row->product_id);
						$this->db->set('pc_cl1_id',$level1[$i]);
						$this->db->insert('product_categories');
					
					endif;
				endfor;
			endif;

			

			$this->db->where('pv_product_id',$row->product_id);
			$this->db->delete('product_variations');

			if( count($attributes) > 0 ):
				foreach ( $attributes as $val ):
					$val = explode(',',$val);
					$this->db->set('pv_product_id',$id);
					$this->db->set('pv_attribute_id',$val[0]);
					$this->db->set('pv_value_id',$val[1]);
					$this->db->insert('product_variations');
				endforeach;
			endif;
			

			

			$this->session->set_flashdata('prod','Updated Successfully');
			add_log($this->session->userdata('logged_admin_id'),'Product','Product   Update');
			redirect(base_url().'admin/products');
		else:
			redirect(base_url('404'));
		endif;
		
	}

	public function delete_gallery_photo(){
		
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$id = $this->input->post('data');
		$this->db->select('*')->from('product_photos')->where('photo_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$row = $sql->row();
			@unlink(getcwd().'/assets/images/products/'.$row->photo);
			$this->db->where('photo_id',$id);
			add_log($this->session->userdata('logged_admin_id'),'Product','Product Gallery Photo  Deleted');
			$this->db->delete('product_photos');
			echo 'success';
		else:
			echo 'error';
		endif;
	}	



	public function delete_product(){

			if( $this->admininfo->user_type == 'operator' ):
				redirect(base_url('404'));	
				exit();
			endif;

		    $product_id = $_POST['data'];

		  				  $this->db->where('product_id',$product_id);
		    $delete_product = $this->db->delete('products');


			if($delete_product){

									$this->db->where('product_id',$product_id);
		    $delete_cart_product  = $this->db->delete('cart');
	

						            $this->db->where('product_id',$product_id);

		    $delete_product_photo = $this->db->delete('product_photos');
		    add_log($this->session->userdata('logged_admin_id'),'Product','Product  Deleted id '.$product_id);

				echo "Product is Deleted Successfully";

			}

	}

		
}
