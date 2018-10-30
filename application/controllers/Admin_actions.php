<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_actions extends CI_Controller {

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

		if( $this->admininfo->user_type == 'operator' ):

			redirect(base_url('404'));	
			exit();
		endif;

	}

	public function change_user_status()
	{
		$data = $this->input->post('data');
		$data = explode(',',$data);
		
		$this->db->where( array('u_id'=>$data[1]) );
		$this->db->update('users',array('u_status'=>$data[0]));
		echo 'success';

	}

	public function delete_level1_category(){


		$level1_id  =  $_POST['data'];
		

		  						  $this->db->where('cl1_id',$level1_id);
		$delete_level1_category = $this->db->delete('category_level1');

				if($delete_level1_category)
				{

					         					    $this->db->where('pc_cl1_id',$level1_id);
					$delete_products_category1  = 	$this->db->delete('product_categories');


									                $this->db->where('cl1_id',$level1_id);
					$delete_level2_category     = 	$this->db->delete('category_level2');

						if($delete_level2_category)
						{

										            	$this->db->where('cl1_id',$level1_id);
						$delete_level3_category   = 	$this->db->delete('category_level3');

						}


						if($delete_level3_category)
						{

													    $this->db->where('cl1_id',$level1_id);
						$delete_level3_category   = 	$this->db->delete('category_level3');
		
						}

				}			


				echo "Category is deleted succesfuly";			

	}



	public function delete_level2_category(){


		$level2_id  =  $_POST['data'];
		

		  						  $this->db->where('cl2_id',$level2_id);
		$delete_level2_category = $this->db->delete('category_level2');

				if($delete_level2_category)
				{

					         					    $this->db->where('pc_cl2_id',$level2_id);
					$delete_products_category2  = 	$this->db->delete('product_categories');


									                $this->db->where('cl2_id',$level2_id);
					$delete_level3_category     = 	$this->db->delete('category_level3');

				}			
				echo "Category is deleted succesfuly";			

	}



	public function delete_level3_category(){


		$level3_id  =  $_POST['data'];
		

		  						  $this->db->where('cl3_id',$level3_id);
		$delete_level3_category = $this->db->delete('category_level3');

				if($delete_level3_category)
				{

					         					    $this->db->where('pc_cl3_id',$level3_id);
					$delete_products_category3  = 	$this->db->delete('product_categories');

				}			
				echo "Category is deleted succesfuly";			

	}

	/*View Quotation*/
	public function view_quotes(){
		$data['quotes'] = $this->db->query('select quotation.* , users.u_firstname , products.product_photo from quotation INNER JOIN users ON quotation.user_id = users.u_id INNER JOIN products ON products.product_id = quotation.product_id')->result();
		$this->load->view('admin/view_quotation',$data);
	}

	/*View Logs*/
	public function view_logs(){
		$data['logs'] = $this->db->query('select * from log_activities')->result();
		$this->load->view('admin/logs',$data);
	}
	
	/********************************Add Video Gallery************************/

	/*Add picture form*/
	public function add_video(){
		$this->load->view('admin/video_gallery/add_video');
	}

	/*Insert video*/
	public function insert_video(){
		
		$data = array(
			'title' => $_POST['title'],
			'short_description	' => $_POST['short_description'],
			'optradio' => $_POST['optradio'],
			'link' => $_POST['link'],
			'status' => 1,
		);
		$this->db->insert('video_gallery',$data);
		$this->session->set_flashdata('success','video added Successfully !!');
		redirect('admin/list_video');
	}

	/*List video*/
	public function list_video(){
		$data['video'] =  $this->db->query('select * from video_gallery')->result();
		$this->load->view('admin/video_gallery/list_video',$data);
	}

	/*Edit video*/
	public function edit_video(){
		$id=$this->uri->segment(3);
		$data['video']=$this->db->query('select * from video_gallery where id='.$id)->row();
		$this->load->view('admin/video_gallery/edit_video',$data);
	}

	/*Update Video*/
	public function update_video(){
		$data = array(
			'title' => $_POST['title'],
			'short_description	' => $_POST['short_description'],
			'optradio' => $_POST['optradio'],
			'link' => $_POST['link'],
			'status' => 1,
		);
		$this->db->where('id',$_POST['id']);
		$this->db->update('video_gallery',$data);
		$this->session->set_flashdata('success','video updated Successfully !!');
		redirect('admin/edit_video/'.$_POST['id']);
	}

	/*Active Picture*/
	public function active_video(){
		$id=$this->uri->segment(3);
		$data=array(
			'status' => 1,
		);
		$this->db->where('id',$id);
		$this->db->update('video_gallery',$data);
		$this->session->set_flashdata('success','video activated Successfully !!');
			redirect('admin/list_video');
	}

	/*Deactive video*/
	public function deactive_video(){
		$id=$this->uri->segment(3);
		$data=array(
			'status' => 0,
		);
		$this->db->where('id',$id);
		$this->db->update('video_gallery',$data);
		$this->session->set_flashdata('success','video deactivated Successfully !!');
		redirect('admin/list_video');
	}

	/*Delete Multiple video*/
	public function deletemultiple_videos(){
		$action = $_POST['bulk_action'];
		if($action == 'delete' && isset($_POST['video'])){
			foreach ($_POST['video'] as $key ){
				$this->db->where('id',$key);
				$this->db->delete('video_gallery');
			}
			$this->session->set_flashdata('success','videos deleted Successfully !!');
			redirect('admin/list_video');
		}if($action == 'active'){
			foreach ($_POST['video'] as $key ) {
				$data=array(
				'status' => 1,
				);
				$this->db->where('id',$key);
				$this->db->update('video_gallery',$data);
			}
			$this->session->set_flashdata('success','video activated Successfully !!');
			redirect('admin/list_video');
		}
		if($action == 'deactive'){
			foreach ($_POST['video'] as $key ) {
				$data=array(
				'status' => 0,
				);
				$this->db->where('id',$key);
				$this->db->update('video_gallery',$data);
			}
			$this->session->set_flashdata('success','Video deactivated Successfully !!');
			redirect('admin/list_video');
		}
	}

	/*Delete video*/
	public function delete_video(){
		$id = $this->uri->segment(3);
		$this->db->where('id',$id);
		$this->db->delete('video_gallery');
		$this->session->set_flashdata('success','video deleted Successfully !!');
		redirect('admin/list_video');
	}

	/*View stock request*/
	public function view_stock_request(){
		$data['stock_request'] = $this->db->query('select * from stock_request')->result();
		$this->load->view('admin/view_stock_request',$data);
	}

	/*Return/exchange form requests view*/
	public function view_return_form_request(){
		$data['requests'] = $this->db->query('select * from return_exchange_form')->result();
		$this->load->view('admin/view_return_requests',$data);
	}

	/***************************************Reporting*********************/
	/*View order report form*/
	public function view_order_report(){
		$data['order_table'] = $this->db->query('select * from order_table')->result();
		$this->load->view('admin/view_order_report',$data);
	}

	/*Generate order report form*/
	public function generate_order_report(){
		$from_date = isset($_POST['from_date'])?$_POST['from_date']:'';
		$to_date = isset($_POST['to_date'])?$_POST['to_date']:'';	
		$this->db->select('order_table.order_ref,order_table.order_id,users.u_firstname,order_table.order_date');
		$this->db->from('order_table');
		/*$this->db->join('order_details','order_details.order_id = order_table.order_id ');
		$this->db->join('products','products.product_id = order_details.product_id ');*/
		$this->db->join('users','users.u_id = order_table.user_id');
		if($from_date != ''){
			$this->db->where("DATE_FORMAT(order_table.order_date,'%Y-%m-%d') >= '".$from_date."'",NULL,FALSE);
		}
		if($to_date != ''){
			$this->db->where("DATE_FORMAT(order_table.order_date,'%Y-%m-%d') <= '".$to_date."'",NULL,FALSE);
		}
		$data['result'] = $this->db->get()->result();
		$this->load->view('admin/order_generate_result',$data);
	}
	
	public function view_person_upload_report(){
	    $this->load->view('admin/person_order_result');
	}
	
	public function generate_order_report_person(){
	    	$from_date = isset($_POST['from_date'])?$_POST['from_date']:'';
		$to_date = isset($_POST['to_date'])?$_POST['to_date']:'';	
		
	    $this->db->select('count(product_id) as number_product,created_by');
		$this->db->from('products');
	    if($from_date != ''){
			$this->db->where("DATE_FORMAT(products.upload_date,'%d-%m-%Y') >= '".$from_date."'",NULL,FALSE);
		}
		if($to_date != ''){
			$this->db->where("DATE_FORMAT(products.upload_date,'%d-%m-%Y') <= '".$to_date."'",NULL,FALSE);
		}
			$data['result'] = $this->db->get()->result();
			
	    $this->load->view('admin/person_order_result_generate',$data);
	}


	/*Commen product*/
	public function comment_product(){
		$user_id = $this->session->userdata('logged_user_id');
		$product_id = $_POST['product_id'];
		$product_reference = $this->db->query('select product_reference from products where product_id='.$product_id)->row()->product_reference;
		$comment = $_POST['comment'];
		$data = array (
			'user_id' =>$user_id,
			'product_id' => $_POST['product_id'],
			'comment' =>  $_POST['comment'],
			'created_at' => date('d-m-Y')
		);
		$this->db->insert('comment',$data);
		$this->session->set_flashdata('success','Commend Successfully added !!');
		redirect(base_url().'preview/cat/'.$product_reference);
	}
}
