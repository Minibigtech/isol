<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Response extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			
	}

	/*
	public function get_provinces()
	{
		$country = $this->input->post('country');

		$this->db->select('*')->from('states')->where('country_id',$country);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
		echo '<option value="">--Select--</option>';
		foreach ($sql->result() as $value):
			echo '<option value="'.$value->id.'">'.$value->name.'</option>';
		endforeach;
		else:
			echo '<option value="">--Select--</option>';
		endif;
	}
	*/

	public function get_cities()
	{
		$country = $this->input->post('country');

		$this->db->select('*')->from('cities')->where('country_id',$country);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
		echo '<option value="">--Select--</option>';
		foreach ($sql->result() as $value):
			echo '<option value="'.$value->id.'">'.$value->name.'</option>';
		endforeach;
		else:
			echo '<option value="">--Select--</option>';
		endif;
	}

	public function get_banner_monthly_price()
	{
		$id = $this->input->post('id');
		$months = $this->input->post('months');


		$this->db->select('wb_id,wb_title,wb_'.$months.'monthprice AS price')->from('website_banners')->where(array('wb_title'=>$id));
		$sql = $this->db->get();
		if( $sql->num_rows()>0):
			$row = $sql->row();
			echo json_encode($row);
		endif;

	}


	
}
