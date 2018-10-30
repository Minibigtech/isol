<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_categories extends CI_Controller {

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

	public function get_category_level2()
	{
		$data = $this->input->post('data');
		$this->db->select('*')->from('category_level2')->where(array('cl1_id'=>$data,'cl2_status'=>1));
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			echo '<option value="">--Select--</option>';
			foreach( $sql->result() as $value ):
				echo '<option value="'.$value->cl2_id.'">'.$value->cl2_title.'</option>'; 
			endforeach;
		else:
			echo '<option value="">--Select--</option>';
		endif;
	}	

	public function level1()
	{
		$this->db->select('*')->from('category_level1');
		$sql = $this->db->get();
		$data['level1'] = $sql->result();
		$this->load->view('admin/level1',$data);
	}

	public function add_level1()
	{
		$this->load->view('admin/add-level1');
	}


	public function add_level1_list()
	{
		
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');

		$upload1 = '';
		$upload2 = '';

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		
		$this->db->select('cl1_id')->from('category_level1')->where('cl1_title',$title);
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of category already exists');
			echo '<script>window.history.back();</script>';exit();
		endif;

		if( $_FILES['icon']['name'] != '' && $_FILES['icon']['tmp_name'] != '' ):
			$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'icon'.$_FILES['icon']['name'];
			move_uploaded_file($_FILES['icon']['tmp_name'],getcwd().'/assets/images/level1/'.$upload1);	
		endif;

		if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
			$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'photo'.$_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/level1/'.$upload2);	
		endif;
		
		$this->db->set('cl1_slug',$slug);
		$this->db->set('cl1_title',$title);
		$this->db->set('cl1_icon',$upload1);
		$this->db->set('cl1_photo',$upload2);
		$this->db->set('cl1_status',$status);
		$this->db->insert('category_level1');
		$this->session->set_flashdata('l1','Added Successfully');
		add_log($this->session->userdata('logged_admin_id'),'Category','Category Level 1 Added');
		redirect(base_url().'admin/level1');
		
	}

	public function edit_level1()
	{
		$id = $this->uri->segment(3);
		$this->db->select('*')->from('category_level1')->where('cl1_id',$id);
		$this->db->limit(1);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['level1'] = $sql->row();
			$this->load->view('admin/edit-level1',$data);
		else:
			redirect(base_url().'admin/404');
		endif;
		
	}

	public function update_level1()
	{
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');
		
		$upload1 = '';
		$upload2 = '';

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		$id = $this->input->post('id');

		$this->db->select('cl1_id')->from('category_level1')->where(array('cl1_title'=>$title,'cl1_id != '=>$id));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of category already exists');
			redirect(base_url('admin/edit-level1/'.$id));exit();
		endif;

		$this->db->select('*')->from('category_level1')->where('cl1_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):

			$row = $sql->row();

			if( $_FILES['icon']['name'] != '' && $_FILES['icon']['tmp_name'] != '' ):
				$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'icon'.$_FILES['icon']['name'];
				@unlink(getcwd().'/assets/images/level1/'.$row->cl1_icon);
				$this->db->where('cl1_id',$row->cl1_id);
				$this->db->update('category_level1',array('cl1_icon'=>$upload1));
				move_uploaded_file($_FILES['icon']['tmp_name'],getcwd().'/assets/images/level1/'.$upload1);	
			endif;

			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
				$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'photo'.$_FILES['photo']['name'];
				@unlink(getcwd().'/assets/images/level1/'.$row->cl1_photo);
				$this->db->where('cl1_id',$row->cl1_id);
				$this->db->update('category_level1',array('cl1_photo'=>$upload2));
				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/level1/'.$upload2);	
			endif;
		
			$this->db->where('cl1_id',$id);
			$this->db->update('category_level1',array('cl1_title'=>$title,'cl1_slug'=>$slug,'cl1_status'=>$status) );
			$this->session->set_flashdata('l1','Updated Successfully');
			add_log($this->session->userdata('logged_admin_id'),'Category','Level1 Upate');
			redirect(base_url().'admin/level1');
		else:
			redirect(base_url('404'));
		endif;
		
	}


	public function level2()
	{
		$this->db->select('category_level2.*,category_level1.cl1_title')->from('category_level2');
		$this->db->join('category_level1','category_level2.cl1_id = category_level1.cl1_id','INNER');
		$sql = $this->db->get();
		$data['level2'] = $sql->result();
		$this->load->view('admin/level2',$data);
	}

	public function add_level2()
	{
		$this->load->view('admin/add-level2');
	}


	public function add_level2_list()
	{
		
		$level1 = trim( $this->input->post('level1') );
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');

		$upload1 = '';
		$upload2 = '';

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		
		$this->db->select('cl2_id')->from('category_level2')->where(array('cl1_id'=>$level1,'cl2_title'=>$title));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of category already exists');
			echo '<script>window.history.back();</script>';exit();
		endif;

		if( $_FILES['icon']['name'] != '' && $_FILES['icon']['tmp_name'] != '' ):
			$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'icon'.$_FILES['icon']['name'];
			move_uploaded_file($_FILES['icon']['tmp_name'],getcwd().'/assets/images/level2/'.$upload1);	
		endif;

		if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
			$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'photo'.$_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/level2/'.$upload2);	
		endif;
		
		$this->db->set('cl1_id',$level1);
		$this->db->set('cl2_slug',$slug);
		$this->db->set('cl2_title',$title);
		$this->db->set('cl2_icon',$upload1);
		$this->db->set('cl2_photo',$upload2);
		$this->db->set('cl2_status',$status);
		$this->db->insert('category_level2');
		$this->session->set_flashdata('l2','Added Successfully');
		add_log($this->session->userdata('logged_admin_id'),'Category','Category Level 2  Added');
		redirect(base_url().'admin/level2');
		
	}

	public function edit_level2()
	{
		$id = $this->uri->segment(3);
		$this->db->select('*')->from('category_level2')->where('cl2_id',$id);
		$this->db->limit(1);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['level2'] = $sql->row();
			$this->load->view('admin/edit-level2',$data);
		else:
			redirect(base_url().'admin/404');
		endif;
		
	}

	public function update_level2()
	{
		$level1 = trim( $this->input->post('level1') );
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');
		
		$upload1 = '';
		$upload2 = '';

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		$id = $this->input->post('id');

		$this->db->select('cl2_id')->from('category_level2')->where(array('cl1_id'=>$level1,'cl2_title'=>$title,'cl2_id != '=>$id));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of category already exists');
			redirect(base_url('admin/edit-level2/'.$id));exit();
		endif;

		$this->db->select('*')->from('category_level2')->where('cl2_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):

			$row = $sql->row();

			if( $_FILES['icon']['name'] != '' && $_FILES['icon']['tmp_name'] != '' ):
				$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'icon'.$_FILES['icon']['name'];
				@unlink(getcwd().'/assets/images/level2/'.$row->cl2_icon);
				$this->db->where('cl2_id',$row->cl2_id);
				$this->db->update('category_level2',array('cl2_icon'=>$upload1));
				move_uploaded_file($_FILES['icon']['tmp_name'],getcwd().'/assets/images/level2/'.$upload1);	
			endif;

			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
				$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'photo'.$_FILES['photo']['name'];
				@unlink(getcwd().'/assets/images/level2/'.$row->cl2_photo);
				$this->db->where('cl2_id',$row->cl2_id);
				$this->db->update('category_level2',array('cl2_photo'=>$upload2));
				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/level2/'.$upload2);	
			endif;
		
			$this->db->where('cl2_id',$id);
			$this->db->update('category_level2',array('cl1_id'=>$level1,'cl2_title'=>$title,'cl2_slug'=>$slug,'cl2_status'=>$status) );
			$this->session->set_flashdata('l2','Updated Successfully');
			add_log($this->session->userdata('logged_admin_id'),'Category','Category Level 2  Update');
			redirect(base_url().'admin/level2');
		else:
			redirect(base_url('404'));
		endif;
		
	}



	public function level3()
	{
		$this->db->select('category_level3.*,category_level1.cl1_title,category_level2.cl2_title')->from('category_level3');
		$this->db->join('category_level1','category_level3.cl1_id = category_level1.cl1_id','INNER');
		$this->db->join('category_level2','category_level3.cl2_id = category_level2.cl2_id','INNER');
		$sql = $this->db->get();
		$data['level3'] = $sql->result();
		$this->load->view('admin/level3',$data);
	}

	public function add_level3()
	{
		$this->load->view('admin/add-level3');
	}


	public function add_level3_list()
	{
		
		$level1 = trim( $this->input->post('level1') );
		$level2 = trim( $this->input->post('level2') );
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');

		$upload1 = '';
		$upload2 = '';

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		
		$this->db->select('cl3_id')->from('category_level3')->where(array('cl1_id'=>$level1,'cl2_id'=>$level2,'cl3_title'=>$title));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of category already exists');
			echo '<script>window.history.back();</script>';exit();
		endif;

		if( $_FILES['icon']['name'] != '' && $_FILES['icon']['tmp_name'] != '' ):
			$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'icon'.$_FILES['icon']['name'];
			move_uploaded_file($_FILES['icon']['tmp_name'],getcwd().'/assets/images/level3/'.$upload1);	
		endif;

		if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
			$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'photo'.$_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/level3/'.$upload2);	
		endif;
		
		$this->db->set('cl1_id',$level1);
		$this->db->set('cl2_id',$level2);
		$this->db->set('cl3_slug',$slug);
		$this->db->set('cl3_title',$title);
		$this->db->set('cl3_icon',$upload1);
		$this->db->set('cl3_photo',$upload2);
		$this->db->set('cl3_status',$status);
		$this->db->insert('category_level3');
		$this->session->set_flashdata('l3','Added Successfully');
		add_log($this->session->userdata('logged_admin_id'),'Category','Category Level 3  Added');
		redirect(base_url().'admin/level3');
		
	}

	public function edit_level3()
	{
		$id = $this->uri->segment(3);
		$this->db->select('*')->from('category_level3')->where('cl3_id',$id);
		$this->db->limit(1);
		$sql = $this->db->get();
		if($sql->num_rows()>0):
			$data['level3'] = $sql->row();
			$this->load->view('admin/edit-level3',$data);
		else:
			redirect(base_url().'admin/404');
		endif;
		
	}

	public function update_level3()
	{
		$level1 = trim( $this->input->post('level1') );
		$level2 = trim( $this->input->post('level2') );
		$title = trim( $this->input->post('title') );
		$status = $this->input->post('status');
		
		$upload1 = '';
		$upload2 = '';

		$slug = strtolower( str_replace(array(' ','/','&',"'"), array('-','-','and',''),$title) );
		$id = $this->input->post('id');

		$this->db->select('cl3_id')->from('category_level3')->where(array('cl1_id'=>$level1,'cl2_id'=>$level2,'cl3_title'=>$title,'cl3_id != '=>$id));
		$chk = $this->db->get();
		if( $chk->num_rows()>0 ):
			$this->session->set_flashdata('error','Name of category already exists');
			redirect(base_url('admin/edit-level3/'.$id));exit();
		endif;

		$this->db->select('*')->from('category_level3')->where('cl3_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):

			$row = $sql->row();

			if( $_FILES['icon']['name'] != '' && $_FILES['icon']['tmp_name'] != '' ):
				$upload1 = date('Y-m-dh-i-sa').rand(1,10000).'icon'.$_FILES['icon']['name'];
				@unlink(getcwd().'/assets/images/level3/'.$row->cl3_icon);
				$this->db->where('cl3_id',$row->cl3_id);
				$this->db->update('category_level3',array('cl3_icon'=>$upload1));
				move_uploaded_file($_FILES['icon']['tmp_name'],getcwd().'/assets/images/level3/'.$upload1);	
			endif;

			if( $_FILES['photo']['name'] != '' && $_FILES['photo']['tmp_name'] != '' ):
				$upload2 = date('Y-m-dh-i-sa').rand(1,10000).'photo'.$_FILES['photo']['name'];
				@unlink(getcwd().'/assets/images/level3/'.$row->cl3_photo);
				$this->db->where('cl3_id',$row->cl3_id);
				$this->db->update('category_level3',array('cl3_photo'=>$upload2));
				move_uploaded_file($_FILES['photo']['tmp_name'],getcwd().'/assets/images/level3/'.$upload2);	
			endif;
		
			$this->db->where('cl3_id',$id);
			$this->db->update('category_level3',array('cl1_id'=>$level1,'cl2_id'=>$level2,'cl3_title'=>$title,'cl3_slug'=>$slug,'cl3_status'=>$status) );
			$this->session->set_flashdata('l3','Updated Successfully');
			add_log($this->session->userdata('logged_admin_id'),'Category','Category Level 3 update');
			redirect(base_url().'admin/level3');
		else:
			redirect(base_url('404'));
		endif;
		
	}

	public function delete_category_images(){
		$id = $this->input->post('data');
		$type = $this->input->post('type');
		$level = $this->input->post('level');

		$column = $type=='icon'?'cl'.$level.'_icon':'cl'.$level.'_photo';

		$this->db->select('*')->from('category_level'.$level)->where('cl'.$level.'_id',$id);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$row = $sql->row();
			//print_r($row);exit();
			@unlink(getcwd().'/assets/images/level'.$level.'/'.$row->$column);
			$this->db->where('cl'.$level.'_id',$id);
			add_log($this->session->userdata('logged_admin_id'),'Category','Category Image Deleted');
			$this->db->update('category_level'.$level,array($column=>''));
			echo 'success';
		else:
			echo 'error';
		endif;
	}	

	


	
	
}
