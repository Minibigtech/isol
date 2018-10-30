<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }
	
	

	public function auth($email,$pass)
	{
		$pass = base64_encode($pass);
		
		//if ( filter_var($name, FILTER_VALIDATE_EMAIL) ):
    		//$this->db->where("(u_email='$name')", NULL, FALSE);
		//else:
   	 	$this->db->where("(u_email='$email')", NULL, FALSE);
		//endif;
		$this->db->where('u_password',$pass);
		$this->db->where('u_status',1);
		$this->db->limit(1,0);
		
		$query = $this->db->get('users');
		if( $query->num_rows()>0 ):
			$row = $query->row();
			$this->session->set_userdata('logged_user_id',$row->u_id);
			return true;
		else:
			return false;
		endif;
	}


	

	
}


