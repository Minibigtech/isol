<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Monsignin, 26 Jul 1997 05:00:00 GMT");
		$this->load->model( 'user_model');	
		
		//$this->load->library('facebook');


		/*
		if( $this->session->userdata('logged_user_id') != '' && $this->session->userdata('logged_user_id') != 0 ):
			echo '<script>window.location.href = "'.base_url().'profile"</script>';
		endif;
		*/

		$this->db->select('*')->from('administrator');
		$this->db->where('admin_id',$this->session->userdata('logged_admin_id'));
		$sql = $this->db->get();
		$this->admininfo = $sql->row();
			
	}

	public function generate_ip(){


		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        			//ip from share internet
        		$ip = $_SERVER['HTTP_CLIENT_IP'];
    			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        		//ip pass from proxy
        		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    			}else{
        		$ip = $_SERVER['REMOTE_ADDR'];
    			}
    			return $ip;

	}
	
	public function index()
	{
		
		$this->load->view('home');
	}

	public function search_products()
	{
		
		$search = $_GET['term'];
        $this->db->select('*')->from('products');
        $this->db->like('product_title',$search);
        $this->db->where(array('product_status'=>1));
        $this->db->order_by('product_id','DESC');
        $this->db->limit(10);
        
        $sql = $this->db->get();

        if( $sql->num_rows()>0 ):
        
            foreach( $sql->result() as $row ):
            
                
                $new_row['title'] = $row->product_title;
            	$new_row['price'] ="RS: ".$row->product_price;
	            $new_row['image'] = base_url().'assets/images/products/'.$row->product_photo;
                $new_row['url']   = base_url().'preview/'.$row->product_slug.'/'.$row->product_reference;
                
                $row_set[] = $new_row; //build an array
            endforeach;
        else:
        	$new_row['title']= 'No products found';
        	$new_row['price'] ='';
        	$new_row['image']= base_url().'assets/images/no-image.png';
            $new_row['url'] = '#';
        	$row_set[] = $new_row;
        endif;
        
        echo json_encode($row_set); 

		//$this->load->view('home');
	}

	public function advance_search()
	{
			
		

		
		$data['product'] = [];
		
		$cond = '';

		if( $this->input->get('order') ):

			$keywords = $this->input->get('keyword');
			$order = $this->input->get('order');
			$exclude = $this->input->get('exclude');
			$this->db->select('*')->from('products');

			if( $order == 3 || $order == 4 ):
				$cond.= 'product_title LIKE "%'.$keywords.'%" OR '.'product_reference LIKE "%'.$keywords.'%"';
				/*
				$keywords = explode(' ',$keywords);
				foreach( $keywords as $keyword ):
			    	$cond.= 'AND product_title LIKE "%'.$keyword.'%"';
				endforeach;
				$cond = substr($cond,4);
				
				foreach( $keywords as $keyword ):
			    	$cond.= ' product_reference LIKE "%'.$keyword.'%"';
				endforeach;
				
				$cond = substr($cond,4);
				*/
				$this->db->where($cond,NULL,FALSE);

			endif;

			if( $order == 1 || $order == 2 ):
				$keywords = explode(' ',$keywords);
				foreach( $keywords as $keyword ):
			    	$cond.= 'AND product_title LIKE "%'.$keyword.'%"';
				endforeach;
				$cond = substr($cond,4);
				
				foreach( $keywords as $keyword ):
			    	$cond.= ' OR product_reference LIKE "%'.$keyword.'%"';
				endforeach;
				
				$cond = substr($cond,4);

			endif;

			/*
			if( $this->exclude == 3 || $this->exclude == 4 ):
				$this->db->where('product_title', 'match', 'both');
				$this->db->like('product_slug', 'match', 'both');
			endif;
			*/
		
			$sql = $this->db->get();
			//$this->db->last_query();
			
			$data['product'] = $sql->result();

		endif;


		$this->load->view('advance-search',$data);
	}



	public function signin()
	{

		
		if($this->session->userdata('logged_user_id')):
		
			redirect(base_url());
		
		else:
		
			//$data['authUrl'] =  $this->facebook->login_url();
			$this->load->view('login');
		
		endif;

	}
	public function signup()
	{

		$this->load->view('signup');

	}
	public function login()
	{
		





		$this->load->library('form_validation');
		$this->form_validation->set_rules( 'email',    'Email', 'trim|required' );
		$this->form_validation->set_rules( 'password', 'Password', 'trim|required' );
		
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('login_error',validation_errors());
			redirect(base_url('user/sign-in'));
		}else{
			$email = htmlentities($this->input->post('email'));
			$pass  = htmlentities($this->input->post('password'));
			if($this->user_model->auth($email,$pass)){

					
				
				 $ip = $this->generate_ip();


    
    			$this->db->select('*')->from('cart');
				$this->db->where('user_ip',$ip);
				$chk = $this->db->get();
				//$rows= $sql->result();
				if( $chk->num_rows()>0):
					$user_id =  $this->session->userdata('logged_user_id') ;
					$data = array('user_id' =>$user_id);
					$this->db->where('user_ip',$ip);
					$this->db->update('cart',$data);	
				endif;
				if($this->input->post('checkout_page')):
				$this->session->set_flashdata('success_message','Welcome in to your account');
				redirect(base_url().'checkout');	
				else:
				$this->session->set_flashdata('success_message','Welcome in to your account');	
				redirect(base_url().'user/dashboard');
				endif;
				//redirect(base_url().'dashboard');
			}else{

				if($this->input->post('checkout_page')):
				$this->session->set_flashdata('login_error','Invalid username & password combination');
				redirect(base_url().'checkout');
				else:
				$this->session->set_flashdata('login_error','Invalid username & password combination');	
				redirect(base_url('user/sign-in'));
				endif;
			}		
		}
	}

	public function forget_password()
	{
	
		$email = htmlentities($this->input->post('fgemail'));
		
		$this->db->select('u_password')->from('users')->where('u_email',$email);
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
				
				
				 $row = $sql->row();
				 $config = Array('mailtype' => 'html');
			
    			$this->load->library('email',$config);
    			$this->email->set_newline("\r\n"); 
    			$this->email->from(from_email,site_title); 
          		$this->email->to($email);
          		$this->email->subject(site_title.' Forget Password - Password Recovery'); 
          		$this->email->message('<p><b>Dear User,</b></p>'.
          		'<p><b>Your password is: </b>'.base64_decode($row->u_password).'</p>'); 
    			if($this->email->send()):
    			  echo "password is sent on your email";
    			else:
    			 echo "password is not sent on your email";   
    			endif;
    			
          		//$this->session->set_flashdata('fgp_success','Please check email password is sent to your email');
    			//echo '<script>window.history.back();</script>';	

    			
    			//$this->session->set_flashdata('fgp_success','Password is sent on your email');
   				//echo '<script>window.history.back();</script>';	
				

		else:
			



			//$this->session->set_flashdata('fgp_error','Your email does not exist');
   			//echo '<script>window.history.back();</script>';
   				echo "Your email does not exist";	


   		endif;
	}

	public function create_account()
	{
		$fname 		= htmlentities($this->input->post('fname'));
		$lname 		= htmlentities($this->input->post('lname'));
		$email 		= htmlentities($this->input->post('email'));
		$password 	= htmlentities($this->input->post('password'));
		$cpassword 	= htmlentities($this->input->post('confirm_password'));
		
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required' );
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required' );
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.u_email]' );			
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required' );*/
	    /*$this->form_validation->run() == FALSE*/
	    
		if( $password != $cpassword){
			/*$this->session->set_flashdata('errors',validation_errors());*/
			echo '<script>window.history.back();</script>';
		}else{
			$this->db->select('u_id')->from('users')->where('u_email',$email);
			$chk = $this->db->get();
			if( $chk->num_rows()>0 ):
				$this->session->set_flashdata('errors','Your email already in use');
				echo '<script>window.history.back();</script>';exit();
			endif;
	    
		// 	$act_key = md5($email.$fname.$lname);

			$this->db->set('u_firstname',$fname);
			$this->db->set('u_lastname',$lname);
			$this->db->set('u_email',$email);
			$this->db->set('u_password',base64_encode($password));
			$this->db->set('u_register_date',date('Y-m-d h:i:s'));
			$this->db->set('u_status',1);
			$this->db->insert('users');
			$user_id = 	$this->db->insert_id();
			$this->load->helper('usefull_helper');
			$msg = '<p><b>Dear '.$fname.' '.$lname.',</b></p>'.
				'<p>Thank You for registration on '.site_title.', Your account is created successfully please login & update your account details.</p>';
			//$result = send_email(from_email,$email,site_title.' - Account Registration',$msg);
		/*	$config = Array('mailtype' => 'html');
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n"); 
				$this->email->from(from_email,site_title); 
				$this->email->to('ammarkhan94x@gmail.com');
				$this->email->subject(site_title.' - Account Registration'); 
				$this->email->message('<p><b>Dear '.$fname.' '.$lname.',</b></p>'.
				'<p>Thank You for registration on '.site_title.', Your account is created successfully please login & update your account details.</p>');		
				$result = $this->email->send();*/
				$result = send_email('yxs@gmail.com','sobashchandar@gmail.com','testing',$msg);
				
			//$this->load->view('login');
			$this->session->set_flashdata('success','Your account is successfully created Please login now');
			redirect(base_url().'home/signin');
			}
		
	}

	public function account_activation_success()
	{
		$this->db->select('*')->from('packages')->where('pkg_id',2);
		$sql = $this->db->get();
		$package = $sql->row();
		
		if( trim($this->input->get('item_name')) === $package->pkg_title):
			

			if( !empty( trim($this->input->get('tx')) ) ):
				
				$txn_id = trim($this->input->get('tx'));
				$amount = trim($this->input->get('amt'));
				$currency_code = trim($this->input->get('cc'));
				$payment_status =  trim($this->input->get('st'));
				
				$user_id = trim($this->input->get('item_number'));
				
				if( $amount == $package->pkg_price ): 
					
					$this->db->select('users.*,institutes.i_slug')->from('users');
					$this->db->join('institutes','users.u_inst_id = institutes.i_id','LEFT');
					$this->db->where( array('users.u_id'=>$user_id) );
					$sql = $this->db->get();
					$userinfo = $sql->row();
					
					$this->db->set('pt_tr_id',$txn_id);
					$this->db->set('pt_payment_id',1);
					$this->db->set('pt_pkg_id',$userinfo->u_pkg_id);
					$this->db->set('pt_user_id',$userinfo->u_id);
					$this->db->set('pt_date',date('Y-m-d'));
					$this->db->set('pt_name',$package->pkg_title.' Membership');
					$this->db->set('pt_description','User purchased '.$package->pkg_title.' Membership');
					$this->db->set('pt_amount',$amount);
					$this->db->set('pt_status',1);
					$this->db->insert('payment_transactions');

					$oneyear = date('Y-m-d',strtotime('+1 year'));

					$this->db->where( array('u_id'=>$userinfo->u_id ) );
					$this->db->update('users',array('u_status'=>0,'u_membership_start'=>date('Y-m-d'),'u_membership_end'=>date('Y-m-d', strtotime('+1 year') ) )  );
					
					$config = Array('mailtype' => 'html');
			
		   			$this->load->library('email',$config);
		   			$this->email->set_newline("\r\n"); 
		   			$this->email->from(from_email,site_title); 
		         	$this->email->to($email);
		         	$this->email->subject(site_title.' Account Activation Code'); 
		         	$this->email->message('<p><b>Dear '.$userinfo->u_fname.' '.$userinfo->u_lname.',</b></p>'.
		         	'<p>Your account is created successfully, Please click on below link to activate your account.</p>'.
		         	'<p><a href="'.base_url().'account-activation/'.$userinfo->u_activation_key.'">'.base_url().'account-activation/'.$userinfo->u_activation_key.'</a></p>'); 
		   			
	   				echo '<h2>Your account created successfully, a email is sent kindly check your email</h2>';
					exit();
					/*
					$this->session->set_userdata('logged_user_id',$userinfo->u_id);
					$this->session->set_flashdata('you_are_logged','First you have to fill this & add your listing');
					redirect(base_url().'add/'.$userinfo->i_slug);
					*/
					exit();
					
				else: 
					//echo '13';
					$this->session->set_flashdata('error','Sorry payment gateway has generated error');
					redirect(base_url());
				endif;
			else:
				//echo '14';
				$this->session->set_flashdata('error','Sorry payment gateway has generated error');
				redirect(base_url());
			endif;
		
		else:
			//echo '15';
			$this->session->set_flashdata('error','Sorry payment gateway has generated error');
			redirect(base_url());
		endif;


	}


	public function account_activation()
	{
		$key = $this->uri->segment(2);
		$this->db->select('users.*,institutes.i_slug')->from('users');
		$this->db->join('institutes','users.u_inst_id = institutes.i_id','LEFT');
		$this->db->where(array('users.u_activation_key'=>$key,'users.u_status'=>0));
		$sql = $this->db->get();
		if( $sql->num_rows()>0 ):
			$user = $sql->row();
			//print_r($user); exit();	
			$this->db->where( array('u_id'=>$user->u_id) );
			$this->db->update('users',array('u_status'=>0));
			echo '<h2>Dear user, Thank you for verifying your Email. You may login as soon as your account is verified by the admin.</h2>';
			/*
			$this->session->set_userdata('logged_user_id',$user->u_id);
			$this->session->set_flashdata('you_are_logged','First you have to fill this & add your listing');
			redirect(base_url().'add/'.$user->i_slug);
			*/
		else:
			redirect(base_url().'404');
			exit();
		endif;
	
	}



	public function  profile_edit()
	{

			$user_id = $this->input->post('user_id');
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules( 'firstname', 				'First Name', 						'trim|required' );
			$this->form_validation->set_rules( 'lastname',  				'Last Name', 						'trim|required' );
			//$this->form_validation->set_rules( 'email',     				'email',     						'trim|required' );
			
			if(!empty($this->input->post('current_password'))):

				$this->form_validation->set_rules( 'current_password', 		'Current Password', 				'trim|required' );
				$this->form_validation->set_rules( 'password', 				'Password', 						'trim|required' );
				$this->form_validation->set_rules( 'cpassword',  			'Confirm Password', 				'required|matches[password]');
			
			endif;	

			if($this->form_validation->run()==FALSE){
			
				$this->session->set_flashdata('profile_error_form',validation_errors());
				redirect(base_url('checkout/user_view_orders'));
			}
			else
			{

				$data	= array(

						'u_firstname'    				=> $this->input->post('firstname'),
						'u_lastname' 					=> $this->input->post('lastname'),
						//'u_email' 	   				    => $this->input->post('email'),
					);

				if(!empty($this->input->post('current_password'))):

					

					$this->db->where('u_id',$user_id);
					$this->db->select('u_password')->from('users');
					$sql = $this->db->get();
					$user_data = $sql->row();	

					$u_password 	  = base64_decode($user_data->u_password);	

					$current_password = $this->input->post('current_password');

					if($u_password == $current_password):

						$password 			= $this->input->post('password');
						$data['u_password'] = base64_encode($password);
					else:
						$this->session->set_flashdata('profile_error_form',"Sorry your current password is not correct");
						redirect(base_url('checkout/user_view_orders'));		
					endif;	

				endif;

						   $this->db->where('u_id',$user_id);
				$updated = $this->db->update('users',$data);

				if($updated):

					$this->session->set_flashdata('profile_success_form','Profile is updated');
					redirect(base_url('checkout/user_view_orders'));			
				
				endif;
			}	

	}      
	public function logout(){
		
		$this->session->unset_userdata('logged_user_id');
		redirect(base_url());
	}


	public function pages()
	{	
	    if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;
		
		$slug = $this->uri->segment(3);
		$this->db->select('*')->from('pages')->where('p_slug',$slug);
		$this->db->limit(1);
		$sql = $this->db->get();
		$data['page'] = $sql->row();
		$this->load->view('admin/pages',$data);
		
	}

	public function update_page()
	{	
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$slug = $this->uri->segment(3);
		$title = trim( $this->input->post('title') );
		$heading = trim( $this->input->post('heading') );
		$content = trim( $this->input->post('content') );

		$this->db->where('p_slug',$slug);
		$this->db->update('pages',array('p_title'=>$title,'p_content_heading'=>$heading,'p_content'=>$content));
		$this->session->set_flashdata('page','Page Updated Successfully');
		redirect(base_url('admin/edit/').$slug);
		
	}




/*	public function terms_condition(){
		$this->db->select('p_title,p_content_heading,p_content')->from('pages')->where('p_slug','terms-and-condition');
		$sql = $this->db->get();
		$data['page'] = $sql->row();
		$this->load->view('terms-condition',$data);

	}*/



	public function return_and_exchange(){


		$this->db->select('p_title,p_content_heading,p_content')->from('pages')->where('p_slug','return-and-exchange');
		$sql = $this->db->get();
		$data['page'] = $sql->row();
		$this->load->view('return-and-exchange',$data);


	}

	public function sell_with_us(){


		$this->db->select('p_title,p_content_heading,p_content')->from('pages')->where('p_slug','sell-with-us');
		$sql = $this->db->get();
		$data['page'] = $sql->row();
		$this->load->view('sell-with-us',$data);


	}


	public function contact_us(){


		$this->load->view('contact-us');

	}



	public function contact_email(){


		$name 			= $_POST['name'];
		$email 			= $_POST['email'];
		$message 		= $_POST['message'];



		$config = Array('mailtype' => 'html');
		$this->load->library('email',$config);
  
	    $this->email->set_newline("\r\n"); 
    	$this->email->from($email,site_title); 
        $this->email->to(site_email);
        $this->email->subject(site_title.' Contact Form'); 
        $this->email->message('<p><b>Dear Admin,</b></p>'.
          	'<p>A user has submitted the Contact form, as information is given below</p>'.
          	'<p><b>Name: </b>'.$name.'</p>'.
          	'<p><b>Email: </b>'.$email.'</p>'.
          	'<p><b>Message : </b>'.$message.'</p>');
         	$this->email->send();
			$this->session->set_flashdata('contact_submitted_success','Thank You, Your Information is submitted successfully');
	}

	public function search(){
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->session->set_userdata('searchFilter',$_POST);
			
		}else{
			$this->session->unset_userdata('searchFilter');
			
		}

		
		if($this->uri->segment(3) != '' ){
				$data['product'] = $this->db->query('select * from products limit 8 OFFSET '.$this->uri->segment(3))->result();
		}else{
			if(empty($_POST['query'])){

				$data['product'] = $this->db->query('select * from products  limit  8  ')->result();
			}else{
				$this->db->select('*');
				$this->db->from('products');
				$this->db->or_like(array('product_title' => $_POST['query']));
				$data['product'] = $this->db->get()->result();
			}
		}
		if(isset($_POST['query'])){
			$data['search_data'] =  $_POST['query'];	
		}else{
			$data['search_data'] =  '';
		}
		
		$this->load->library('pagination');
		$config=[
			'base_url' => base_url('user/search'),
			'per_page' =>8,
			'use_page_numbers' => TRUE,
			'total_rows' => $this->db->query('select * from products')->num_rows(),
			'full_tag_open' => '<ul class="pagination">',
        	'full_tag_close' => '</ul>',
        	'first_link' => false,
        	'last_link' => false,
        	'first_tag_open' => '<li>',
        	'first_tag_close' => '</li>',
        	'prev_link' => '&laquo',
        	'prev_tag_open' => '<li class="prev">',
        	'prev_tag_close' => '</li>',
        	'next_link' => '&raquo',
        	'next_tag_open' => '<li>',
        	'next_tag_close' => '</li>',
        	'last_tag_open' => '<li>',
        	'last_tag_close' => '</li>',
        	'cur_tag_open' => '<li class="active"><a href="#">',
        	'cur_tag_close' => '</a></li>',
        	'num_tag_open' => '<li>',
        	'num_tag_close' => '</li>',
		];
		$this->pagination->initialize($config);
		$data['link'] =$this->pagination->create_links(); 
		$this->load->view('search',$data);
	}

	/*Search using filter*/
	public function search_filter(){
		
		$this->load->model('Search_model');
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->session->set_userdata('searchFilter',$_POST);
		}else{
			$this->session->unset_userdata('searchFilter');
		}
		$data['product'] = $this->Search_model->searchByFilter($_POST);	
		$this->load->library('pagination');
		$config=[
			'base_url' => base_url('user/search'),
			'per_page' =>8,
			'use_page_numbers' => TRUE,
			'total_rows' => $this->db->query('select * from products')->num_rows(),
			'full_tag_open' => '<ul class="pagination">',
        	'full_tag_close' => '</ul>',
        	'first_link' => false,
        	'last_link' => false,
        	'first_tag_open' => '<li>',
        	'first_tag_close' => '</li>',
        	'prev_link' => '&laquo',
        	'prev_tag_open' => '<li class="prev">',
        	'prev_tag_close' => '</li>',
        	'next_link' => '&raquo',
        	'next_tag_open' => '<li>',
        	'next_tag_close' => '</li>',
        	'last_tag_open' => '<li>',
        	'last_tag_close' => '</li>',
        	'cur_tag_open' => '<li class="active"><a href="#">',
        	'cur_tag_close' => '</a></li>',
        	'num_tag_open' => '<li>',
        	'num_tag_close' => '</li>',
		];
		$this->pagination->initialize($config);
		$data['link'] =$this->pagination->create_links(); 
		$this->load->view('search',$data);
	}

	/*Search By Category*/
	public function search_by_category(){
		$cat_level1 = $this->uri->segment(3);
		$this->load->model('Search_model');
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->session->set_userdata('searchFilter',$_POST);
		}else{
			$this->session->unset_userdata('searchFilter');
		}
		

		$data['product'] = $this->Search_model->search_by_cat($cat_level1);
		$this->load->library('pagination');
		$config=[
			'base_url' => base_url('user/search'),
			'per_page' =>8,
			'use_page_numbers' => TRUE,
			'total_rows' => $this->db->query('select * from products')->num_rows(),
			'full_tag_open' => '<ul class="pagination">',
        	'full_tag_close' => '</ul>',
        	'first_link' => false,
        	'last_link' => false,
        	'first_tag_open' => '<li>',
        	'first_tag_close' => '</li>',
        	'prev_link' => '&laquo',
        	'prev_tag_open' => '<li class="prev">',
        	'prev_tag_close' => '</li>',
        	'next_link' => '&raquo',
        	'next_tag_open' => '<li>',
        	'next_tag_close' => '</li>',
        	'last_tag_open' => '<li>',
        	'last_tag_close' => '</li>',
        	'cur_tag_open' => '<li class="active"><a href="#">',
        	'cur_tag_close' => '</a></li>',
        	'num_tag_open' => '<li>',
        	'num_tag_close' => '</li>',
		];
		$this->pagination->initialize($config);
		$data['link'] =$this->pagination->create_links(); 
		$this->load->view('search',$data);
	}
	
	/*Search By Category End*/
	public function add_to_wishlist(){
		$product_id = $this->uri->segment(3);
		$check_previous = $this->db->query('select * from wishlist where product_id = '.$product_id)->row();
		/*var_dump($check_previous);die;*/
		$product = $this->db->query('select * from products where product_id = '.$product_id)->row();
		if($check_previous == ''){
			$user_id = $this->session->userdata('logged_user_id');
			$data = array(
				'user_id' => $user_id,
				'product_id' => $product->product_id,
				'title' => $product->product_title,
				'product_photo' => $product->product_photo,
			);
			$this->db->insert('wishlist',$data);
			$this->session->set_flashdata('success',"Added to wishlist");
			redirect(base_url('preview/'.$product->product_slug.'/'.$product->product_reference));	
		}else{
			$this->session->set_flashdata('error',"Already added  to wishlist");
			redirect(base_url('preview/'.$product->product_slug.'/'.$product->product_reference));	
		}
	}

	/*remove from wishlist*/
	public function remove_from_wishlist(){
		$product_id = $this->uri->segment(3);
		$this->db->where('product_id',$product_id);
		$this->db->where('user_id',$this->session->userdata('logged_user_id'));
		$this->db->delete('wishlist');
		$product = $this->db->query('select * from products where product_id = '.$product_id)->row();
		$this->session->set_flashdata('error',"Removed from wishlist");
		redirect(base_url('preview/'.$product->product_slug.'/'.$product->product_reference));	
	}

	/*Remove Product Form Wishlist*/
	public function remove_from_wishlist_profile(){
		$product_id = $this->uri->segment(3);
		$this->db->where('product_id',$product_id);
		$this->db->where('user_id',$this->session->userdata('logged_user_id'));
		$this->db->delete('wishlist');
		$product = $this->db->query('select * from products where product_id = '.$product_id)->row();
		$this->session->set_flashdata('error',"Removed from wishlist");
		redirect(base_url('admin/my-wishlist'));
	}

	/*Add quotation to database*/
	public function add_quotation(){
		if(isset($_POST['repair_price']) && !empty($_POST['repair_price'])){
			$repair_price = $_POST['repair_price'];
		}else{
			$repair_price = '-';
		}
		$data = array(
			'product_title' =>  $_POST['product_title'],
			'product_id' =>  $_POST['product_id'],
			'user_id' =>  $_POST['user_id'],
			'repair_price' =>  $repair_price,
			'category' =>  $_POST['category'],
			'message' =>  $_POST['message'],
			'name' =>  $_POST['name'],
			'email' =>  $_POST['email'],
			'phone' =>  $_POST['phone']
		);
		$this->db->insert('quotation',$data);
		$product = $this->db->query('select * from products where product_id = '.$_POST['product_id'])->row();
		$this->session->set_flashdata('success',"Quotation sent successfully");
		redirect(base_url('preview/'.$product->product_slug.'/'.$product->product_reference));
	}

	/*Get users quotation*/
	public function my_quotation(){
		$data['quotes'] = $this->db->query('select quotation.* , users.u_firstname , products.product_photo from quotation INNER JOIN users ON quotation.user_id = users.u_id INNER JOIN products ON products.product_id = quotation.product_id where quotation.user_id = '.$this->session->userdata('logged_user_id'))->result();
		$this->load->view('my_quotation',$data);
	}

	/*Return Exhange*/
	public function return_exchange(){
		$this->load->view('return_form');
	}
	
	/*Add return exchange*/
	public function add_return_exchange(){
		$user_id = $this->session->userdata('logged_user_id');
		$data = array(
			'name' 			=>  $_POST['name'],
			'number' 		=>  $_POST['number'],
			'email'		    =>  $_POST['email'],
			'address' 		=>  $_POST['address'],
			'ordernumber' 	=>  $_POST['ordernumber'],
			'productcode' 	=>  $_POST['productcode'],
			'orderdate' 	=>  $_POST['orderdate'],
			'user_id'    	=> $user_id
		);
		$this->db->insert('return_exchange_form' , $data);
		$this->session->set_flashdata('success',"Form submitted sent successfully");
		$this->load->view('return_form');
	}

	/***************Buy Feature*****************/

	/*Buy now button*/
	public function buy_product(){
	  /* $product_id = $this->uri->segment(3);
	   $product = $this->db->query('select * from products where product_id = '.$product_id)->row();*/
	   
	   $query = array();	
	   $query['business'] = merchant;
	   $query['cmd'] = '_cart';
	   $query['upload'] = 1;
	   $count = 1;
	   foreach ($this->cart->contents() as $items){
		   $query['item_name_'.$count] = $items['name'];
		   $query['quantity_'.$count] = $items['qty'];
		   $query['amount_'.$count] = 0.5/*$items['price']*/;
		   $count++;
	   }
	   $query['currency_code'] = 'USD';
	   $query['cancel_return'] = base_url().'account-activation-cancel';
	   /*$query['custom'] = $item_name;*/
	   /***************************/
	   $user_id = $this->session->userdata('logged_user_id');
	   $data = array(
			'user_id'  							=> 		$user_id,	
			'first_name'  						=>		$_POST['first_name'],	
			'last_name'  						=>		$_POST['last_name'],	
			'email'  							=>		$_POST['email'],
			'billing_address'  					=>		$_POST['street_address'],
			'shipping_address'  				=>		$_POST['street_address2'],
			'contact_number'  		    		=>		$_POST['number'],
			'additional_information'  		    =>		$_POST['city'],
			'billing_date'  		    		=>		date('Y-m-d'),
			'billing_status'  		    		=>		1,
		);
			$this->db->insert('billing_details',$data);
			$billing_id = $this->db->insert_id();
			$order_no = substr(number_format(time() * rand(),0,'',''),0,8);
			$data1 = array(
					'order_ref'  		=>$order_no,	
					'user_id'  			=>$user_id,	
					'billing_id'  	    =>$billing_id,	
					'order_date'  		=>date('Y-m-d'),	
					'order_status'  	=>0,	
				);
			$this->db->insert('order_table',$data1);
			$order_id = $this->db->insert_id();
			foreach ($this->cart->contents() as $items){
			$data3 = array(
			  	  'order_id'    		=> $order_id,
			  	  'user_id'  			=> $user_id,	
			  	  'product_id'			=> $items['id'],
			  	  'product_quantity'    => $items['qty'],
			  	  'product_price'		=> $items['price'],
			  	);
				$order_detail_insert = $this->db->insert('order_details',$data3);
			}
	   /****************/
	   $query['return'] = base_url().'user/payment-success';
	   $query_string = http_build_query($query);
	   header('Location: '.paypal_url.'?' . $query_string);
	}

	/*get order id by refrence*/
	public function get_by_reference(){
		$order_detail = $this->db->query('select product_id from order_details where order_id ='.$_POST['order_id'])->result();
		$product = [];
		foreach ($order_detail as $key => $value) {
				$product[] = $this->db->query('select * from products where product_id ='.$value->product_id)->row();
			}	
		echo json_encode($product);
	}	

	public function view_return_exchange(){
		
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$data['return'] = $this->db->query('select * from return_exchange_form')->result();
		$this->load->view('admin/view_return_exchange',$data);
	}

	public function request_stock(){
		$data = array(
			'product_title' => $_POST['product_title'],
			'product_id' => $_POST['product_id'],
			'user_id' => $_POST['user_id'],
			'message' => $_POST['message'] 
		);
		$this->db->insert('stock_request',$data);
		$product = $this->db->query('select * from products where product_id = '.$_POST['product_id'])->row();
		$this->session->set_flashdata('success',"Request for stock sent successfully");
		redirect(base_url('preview/'.$product->product_slug.'/'.$product->product_reference));
	}
	
	public function about_us(){
	    $this->load->view('about_us');
	}
	
	public function terms_condition(){
	    $this->load->view('terms_condition');
	}
	
	public function privacy(){
	    $this->load->view('privacy');
	}
	
	public function how_to_return(){
	    $this->load->view('how_to_return');
	}
	
	public function how_to_order(){
	    $this->load->view('how_to_order');
	}
	
}
