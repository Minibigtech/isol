<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

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

	public function index()
	{
		/*
		$this->db->select('COUNT(c_id) AS totalcategories')->from('categories');
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$data['categories'] = $sql->row()->totalcategories;
		else:
		endif;
		*/
		$this->load->view('admin/dashboard');
	}


	public function add_company()
	{
		
		if( $this->admininfo->user_type == 'operator' ):

			redirect(base_url('404'));	
			exit();
		endif;
		/*
		$this->db->select('COUNT(c_id) AS totalcategories')->from('categories');
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$data['categories'] = $sql->row()->totalcategories;
		else:
		endif;
		*/
		$this->load->view('admin/add-company');
	}
	
	
	
}
