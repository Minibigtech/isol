<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		if( empty( $this->session->userdata('logged_user_id') ) ):
			redirect(base_url());
		endif;

		


		$this->db->select('users.*')->from('users');
		
		$this->db->where('users.u_id',$this->session->userdata('logged_user_id'))->where('users.u_status',1);
		$sql = $this->db->get();
		$this->userinfo = $sql->row();
		
	}

	public function index()
	{
		$data['userdata'] = $this->userinfo;
		//print_r($data); exit();
		$this->load->view('account',$data);
	}

	public function account_setting()
	{
		$data['userdata'] = $this->userinfo;
		$this->load->view('account-setting',$data);
	}

	
}
