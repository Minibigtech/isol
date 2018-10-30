<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	
	

	public function auth($name,$pass)
	{
		
		$pass = base64_encode($pass);
		$this->db->where("(admin_login='$name')", NULL, FALSE);
		$this->db->where('admin_password',$pass);
		$this->db->limit(1,0);
		
		$query = $this->db->get('administrator');
		if( $query->num_rows()>0 ):
			$row = $query->row();
			$this->session->set_userdata('logged_admin_id',$row->admin_id);
			return true;
		else:
			return false;
		endif;
	}


	

	
}


