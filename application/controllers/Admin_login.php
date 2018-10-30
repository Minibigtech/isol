<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$this->load->model( 'admin_model' );	
		
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules( 'username', 'Username/Email', 'trim|required' );
		$this->form_validation->set_rules( 'password', 'Password', 'trim|required' );
		if( $this->form_validation->run()==FALSE){
			$this->session->set_flashdata('le',validation_errors());
			redirect(base_url().'admin');
		}else{
			$name = $this->input->post('username');
			$pass = $this->input->post('password');
			if($this->admin_model->auth($name,$pass) ){
				redirect(base_url().'admin/dashboard');

					
			}else{
				$this->session->set_flashdata('le','Invalid username & password combination');
				redirect(base_url().'admin');
			}		
		}
	}


	public function logout(){
		$this->session->unset_userdata('logged_admin_id');
		redirect(base_url().'admin');
	}
	

	
}
