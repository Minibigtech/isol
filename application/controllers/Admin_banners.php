<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_banners extends CI_Controller {



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

		//user_type
		

		if( $this->admininfo->user_type == 'operator' ):

			redirect(base_url('404'));	
			exit();
		endif;


	}



		



	public function home_slides()
	{
		
		$this->db->select('*')->from('slider');

		$sql = $this->db->get();

		$data['slides'] = $sql->result();

		$this->load->view('admin/home-slides',$data);

	}



	public function add_home_slide()

	{

		$this->load->view('admin/add-home-slide');

	}





	public function add_home_slide_list()

	{

		

		$link = trim( $this->input->post('link') );

		$status = $this->input->post('status');



		$upload = '';

		



		if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):

			$upload = date('Y-m-dh-i-sa').rand(1,10000).'slide'.$_FILES['photo']['name'];

			move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/slides/'.$upload);	

		endif;

		

		$this->db->set('slide_link',$link);

		$this->db->set('slide_photo',$upload);

		$this->db->set('slide_status',$status);

		$this->db->insert('slider');

		$this->session->set_flashdata('slide','Added Successfully');

		add_log($this->session->userdata('logged_admin_id'),'Slider','Slider Added');

		redirect(base_url().'admin/home-slides');

		

	}



	public function edit_home_slide()

	{

		$id = $this->uri->segment(3);

		$this->db->select('*')->from('slider')->where('slide_id',$id);

		$this->db->limit(1);

		$sql = $this->db->get();

		if($sql->num_rows()>0):

			$data['slide'] = $sql->row();

			$this->load->view('admin/edit-home-slide',$data);

		else:

			redirect(base_url().'admin/404');

		endif;

		

	}



	public function update_home_slide()

	{

		$link = trim( $this->input->post('link') );

		$status = $this->input->post('status');



		$upload = '';

		$id = $this->input->post('id');



		



		$this->db->select('*')->from('slider')->where('slide_id',$id);

		$sql = $this->db->get();

		if( $sql->num_rows()>0 ):



			$row = $sql->row();



			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):

				$upload = date('Y-m-dh-i-sa').rand(1,10000).'slide'.$_FILES['photo']['name'];

				@unlink(getcwd().'/assets/images/slides/'.$row->slide_photo);

				$this->db->where('slide_id',$row->slide_id);

				$this->db->update('slider',array('slide_photo'=>$upload));

				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/slides/'.$upload);	

			endif;

		

			$this->db->where('slide_id',$id);

			$this->db->update('slider',array('slide_link'=>$link,'slide_status'=>$status) );

			$this->session->set_flashdata('slide','Updated Successfully');

			add_log($this->session->userdata('logged_admin_id'),'Slider','Slider Update');

			redirect(base_url().'admin/home-slides');

		else:

			redirect(base_url('404'));

		endif;

		

	}



	public function home_banners()

	{

		$this->db->select('*')->from('home_banners');

		$sql = $this->db->get();

		$data['banners'] = $sql->result();

		$this->load->view('admin/home-banners',$data);

	}



	public function edit_home_banner()

	{

		$id = $this->uri->segment(3);

		$this->db->select('*')->from('home_banners')->where('id',$id);

		$this->db->limit(1);

		$sql = $this->db->get();

		if($sql->num_rows()>0):

			$data['banner'] = $sql->row();

			$this->load->view('admin/edit-home-banner',$data);

		else:

			redirect(base_url().'admin/404');

		endif;

		

	}



	public function update_home_banner()

	{

		$link = trim( $this->input->post('link') );

		$status = $this->input->post('status');



		$upload = '';

		$id = $this->input->post('id');



		



		$this->db->select('*')->from('home_banners')->where('id',$id);

		$sql = $this->db->get();

		if( $sql->num_rows()>0 ):



			$row = $sql->row();



			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):

				$upload = date('Y-m-dh-i-sa').rand(1,10000).'homebanner'.$_FILES['photo']['name'];

				@unlink(getcwd().'/assets/images/banners/'.$row->slide_photo);

				$this->db->where('id',$row->id);

				$this->db->update('home_banners',array('photo'=>$upload));

				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/banners/'.$upload);	

			endif;

		

			$this->db->where('id',$id);

			$this->db->update('home_banners',array('link'=>$link,'status'=>$status) );

			$this->session->set_flashdata('banner','Updated Successfully');

			redirect(base_url().'admin/home-banners');

		else:

			redirect(base_url('404'));

		endif;

		

	}



	public function deals()

	{

		$this->db->select('*')->from('deals');

		$sql = $this->db->get();

		$data['deals'] = $sql->result();

		$this->load->view('admin/deals',$data);

	}



	public function add_deal()

	{	

		$this->load->view('admin/add-deal');	

	}



	public function add_deal_list()

	{

		$title = trim( $this->input->post('title') );

		$link = trim( $this->input->post('link') );

		$status = $this->input->post('status');



		$upload = '';

		

		if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):

			$upload = date('Y-m-dh-i-sa').rand(1,10000).$_FILES['photo']['name'];

			move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/deals/'.$upload);	

		endif;

		

		$this->db->set('d_title',$title);

		$this->db->set('d_photo',$upload);

		$this->db->set('d_link',$link);

		$this->db->set('d_status',$status);

		$this->db->insert('deals');

		$this->session->set_flashdata('deal','Added Successfully');

		redirect(base_url().'admin/deals');

		

	}



	public function edit_deal()

	{

		$id = $this->uri->segment(3);

		$this->db->select('*')->from('deals')->where('d_id',$id);

		$this->db->limit(1);

		$sql = $this->db->get();

		if($sql->num_rows()>0):

			$data['deal'] = $sql->row();

			$this->load->view('admin/edit-deal',$data);

		else:

			redirect(base_url().'admin/404');

		endif;

		

	}



	public function update_deal()

	{

		$title = trim( $this->input->post('title') );

		$link = trim( $this->input->post('link') );

		$status = $this->input->post('status');

		

		$upload = '';

		



		

		$id = $this->input->post('id');



		



		$this->db->select('*')->from('deals')->where('d_id',$id);

		$sql = $this->db->get();

		if( $sql->num_rows()>0 ):



			$row = $sql->row();



			



			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):

				$upload = date('Y-m-dh-i-sa').rand(1,10000).$_FILES['photo']['name'];

				@unlink(getcwd().'/assets/images/deals/'.$row->d_photo);

				$this->db->where('d_id',$row->d_id);

				$this->db->update('deals',array('d_photo'=>$upload));

				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/deals/'.$upload);	

			endif;

		

			$this->db->where('d_id',$id);

			$this->db->update('deals',array('d_title'=>$title,'d_link'=>$link,'d_status'=>$status) );

			$this->session->set_flashdata('deal','Updated Successfully');

			redirect(base_url().'admin/deals');

		else:

			redirect(base_url('404'));

		endif;

		

	}


	/*View add operator Page*/
	public function add_operator(){
		$this->load->view('admin/add-operator');
	}

	/*Insert operator to database*/
	public function insert_operator(){
		$username = $_POST['admin_login'];
		
		$check_previous = $this->db->query('select * from administrator where admin_login ="'.$username.'"')->row();
		if($check_previous == ''){
			$data = array(
			'admin_firstname' => $_POST['admin_firstname'],
			'admin_lastname'  => $_POST['admin_lastname'],
			'admin_login'	  => $_POST['admin_login'],
			'admin_password'  => base64_encode($_POST['admin_password']),
			'admin_photo'     => '-', 
			'user_type'       => 'operator',
			/*'status'          => $_POST['status']*/
		);
			$this->db->insert('administrator',$data);
			$this->session->set_flashdata('success','Operator Added  Successfully');	
		}else{
			$this->session->set_flashdata('error','Operator Already Exists');	
		}
		
		redirect('admin/add-operator');
	}

	/*List Operators*/
	public function list_operator(){
		$data['operator'] = $this->db->query('select * from administrator where user_type !="" ')->result();
		$this->load->view('admin/list-operator',$data);
	}
}

