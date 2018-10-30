<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_users extends CI_Controller {

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

	public function index()
	{
		$this->db->select('*')->from('users');	
		$this->db->order_by('users.u_id','desc');
		$sql = $this->db->get();
		$data['users'] = $sql->result();
		$this->load->view('admin/users',$data);



	}

	public function add_user()
	{
		$this->load->view('admin/add-user');
	}

	public function add_user_list()
	{
		
		$package = trim( $this->input->post('package') );
		$fname = trim( $this->input->post('fname') );
		$lname = trim( $this->input->post('lname') );
		$email = trim( $this->input->post('email') );
		$username = trim( $this->input->post('username') );
		$password = trim( $this->input->post('password') );


		$this->db->select('u_id')->from('users')->where('u_email',$email);
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('errors','Email you entered already in use');
			echo '<script>window.history.back();</script>';exit();
		endif;

		$this->db->select('u_id')->from('users')->where('u_username',$username);
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('errors','Username already in used please try other username');
			echo '<script>window.history.back()</script>';exit();
		endif;
		

		$act_key = md5($email.$fname.$lname);

		$photo_to_upload = '';
		
		if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
     		$photo_to_upload = date('Y-m-d-h-i-sa').rand(1,10000).$_FILES['photo']['name'];
     		move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/users/'.$photo_to_upload);
     	endif;
		
		$this->db->set('u_fname',$fname);
		$this->db->set('u_lname',$lname);
		$this->db->set('u_email',$email);
		$this->db->set('u_username',$username);
		$this->db->set('u_password',base64_encode($password));
		$this->db->set('u_pkg_id',$package);
		$this->db->set('u_photo',$photo_to_upload);
		$this->db->set('u_register_date',date('Y-m-d h:i:s'));
		$this->db->set('u_activation_key',$act_key);
		$this->db->set('u_status',1);
		$this->db->set('u_membership_start',date('Y-m-d'));
		$this->db->set('u_membership_end',date('Y-m-d',strtotime('+1 year')) );
		$this->db->set('u_addedby','admin');
		$this->db->insert('users');
		$this->session->set_flashdata('success','User Successfully Added');
		add_log($this->session->userdata('logged_admin_id'),'User','User Added');
		redirect(base_url().'admin/users');
		
	}

	public function edit_user()
	{
		$id = $this->uri->segment(3);
		$this->db->select('*')->from('users')->where('u_id',$id);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['user'] = $sql->row();
			$this->load->view('admin/edit-user',$data);
		else:
			redirect(base_url().'admin/users');
		endif;
	}


	public function update_user()
	{	
		
		//print_r($_POST);exit();
		$photo_to_upload = '';
		
		//$package = trim( $this->input->post('package') );
		$fname = trim( $this->input->post('fname') );
		$lname = trim( $this->input->post('lname') );
		//$email = trim( $this->input->post('email') );
		//$username = trim( $this->input->post('username') );
		//$password = trim( $this->input->post('password') );
		$id = trim($this->input->post('id'));
		
		$this->db->select('*')->from('users')->where( array('u_id'=>$id) );
        $sql = $this->db->get();
        if( $sql->num_rows()>0 ):
         	$row = $sql->row();

         	$data = array(
         				
         				'u_fname'=>$fname,
         				'u_lname'=>$lname
         			);

         	$this->db->where( array('u_id'=>$row->u_id) );
         	$this->db->update('users',$data);

         	

         	if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
         		$photo_to_upload = date('Y-m-d-h-i-sa').rand(1,10000).$_FILES['photo']['name'];
         		@unlink(getcwd().'/assets/images/users/'.$row->u_photo);
         		$this->db->where( array('u_id'=>$row->u_id) );
         		$this->db->update('users',array('u_photo'=>$photo_to_upload));
         		move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/users/'.$photo_to_upload);
         	endif;

	        $this->session->set_flashdata('success','User Successfully Updated');
	        add_log($this->session->userdata('logged_admin_id'),'User','User Update '.$row->u_id);
			redirect(base_url().'admin/users');
		
		else:
        	redirect(base_url().'404');
        endif;	

	
	}


	public function transactions()
	{
		$this->db->select('payment_transactions.*/*,packages.**/,users.*')->from('payment_transactions');
		/*$this->db->join('packages','payment_transactions.pt_pkg_id = packages.pkg_id','LEFT');*/
		$this->db->join('users','payment_transactions.pt_user_id = users.u_id','LEFT');
		$this->db->order_by('payment_transactions.pt_id','desc');
		$sql = $this->db->get();
		$data['trans'] = $sql->result();
		$this->load->view('admin/transactions',$data);
	}



	public function user_status(){


		$user_id = $this->input->post('user_id');
		$status_id = $this->input->post('status_id');
			
		$data = array(
		
			'u_status' => $status_id 

		);	

		$this->db->where('u_id',$user_id);
		$update_status = $this->db->update('users',$data);
		add_log($this->session->userdata('logged_admin_id'),'User','User Status Changed ');
		if($update_status){

				echo "User  status is changed Successfully";
		}
		else
		{
			   echo "User  status isn't changed Successfully";	

		}

	}



	public function  delete_user(){



		$user_id   = $this->input->post('user_id');

					   $this->db->where('u_id',$user_id);
		$delete_user = $this->db->delete('users');

		if($delete_user)
		{

			$this->db->where('user_id',$user_id);
			$this->db->delete('reviews');

			$this->db->where('user_id',$user_id);
			$this->db->delete('billing_details');

			$this->db->where('user_id',$user_id);
			$this->db->delete('order_table');
	
			$this->db->where('user_id',$user_id);
			$this->db->delete('order_details');

		}	
		add_log($this->session->userdata('logged_admin_id'),'User','User Deleted');
		echo "User is deleted Successfully";
	}
	


	
}
