<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$this->load->model( 'user_model');	
		

		/*
		if( $this->session->userdata('logged_user_id') != '' && $this->session->userdata('logged_user_id') != 0 ):
			echo '<script>window.location.href = "'.base_url().'profile"</script>';
		endif;
		*/
			
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
		

		if($this->session->userdata('logged_user_id')):

			$user_id =  $this->session->userdata('logged_user_id');

			$this->db->where('user_id',$user_id);
			$this->db->select('cart.*,products.product_photo')->from('cart');
			$this->db->join('products','cart.product_id = products.product_id');

			$sql1   = $this->db->get();
			if($sql1->num_rows()>0):
		  
				$this->db->select('*')->from('users');
				$this->db->where('u_id',$user_id);
				$sql  					= $this->db->get();
				$data['users_data']     = $sql->row();
				$data['cart']     		= $sql1->result();
				
				$this->load->view('checkout',$data);	
			else:

				//$this->load->view('',$data);			
				$this->session->set_flashdata('checkout_error','Your Cart is Empty.');
				redirect(base_url().'Cart');
			endif;	
			
		else:

			//$this->session->set_flashdata('login_error','Please Login first');
			
			$ip = $this->generate_ip();
			$this->db->where('user_ip',$ip);
			$this->db->select('cart.*,products.product_photo')->from('cart');
			$this->db->join('products','cart.product_id = products.product_id');
			

			$sql   = $this->db->get();
			if($sql->num_rows()>0):
		  	
				$data['cart'] 		= $sql->result(); 	
				$this->load->view('checkout',$data);

			else:

				//$this->load->view('',$data);			
				$this->session->set_flashdata('checkout_error','Your Cart is Empty.');
				redirect(base_url().'cart');
			endif;		

			//$this->load->view('checkout');	

			//redirect(base_url('user/sign-in'));
			//$this->load->view('login');
		endif;	



	}
	public function  order_submit(){

			$this->db->select('*')->from('cart');
			if($this->session->userdata('logged_user_id')):	
			
			   $this->db->where('user_id',$this->session->userdata('logged_user_id'));			
			else:

			   $ip = $this->generate_ip();	
			   $this->db->where('user_ip',$ip);	
			endif;	

			
			 $sql   = $this->db->get();
			if($sql->num_rows()>0):

			$carts = $sql->result();
			else:

			$this->session->set_flashdata('checkout_error','Your Cart is Empty.');
			redirect(base_url().'cart');	


			endif;	

			$this->load->library('form_validation');
			$this->form_validation->set_rules( 'firstname', 				'First Name', 						'trim|required' );
			$this->form_validation->set_rules( 'lastname',  				'Last Name', 						'trim|required' );
			$this->form_validation->set_rules( 'email',     				'email',     						'trim|required' );
			$this->form_validation->set_rules( 'shipping_address', 			'shipping_address',     			'trim|required' );
			$this->form_validation->set_rules( 'billing_address',  			'billing_address',     				'trim|required' );
			$this->form_validation->set_rules( 'contact_number',   			'contact_number',     				'trim|required' );
			$this->form_validation->set_rules( 'additional',   				 'additional',  					'trim|required' );	
			if(!$this->session->userdata('logged_user_id') && $this->input->post('account')):

					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' );			
					$this->form_validation->set_rules('password', 'Password', 'required');
			endif;
			if($this->form_validation->run()==FALSE):
			
						$this->session->set_flashdata('checkout_error_form',validation_errors());
						redirect(base_url('checkout'));
			endif;

			if(!$this->session->userdata('logged_user_id') && $this->input->post('account')):

					
						$firstname    				= $this->input->post('firstname');
						$lastname 					= $this->input->post('lastname');
						$email 	   					= $this->input->post('email');
						$password    				= $this->input->post('password');	


						$data = array(

							'u_firstname'     	=>   htmlentities($firstname),
							'u_lastname'     	=>   htmlentities($lastname),
							'u_email'		 	=>	 htmlentities($email),
							'u_password'	 	=>   htmlentities(base64_encode($password)),
							'u_register_date'	=>	 date('Y-m-d h:i:s'), 	
							'u_status'			=>	 1 		
							);

						$register_account = $this->db->insert('users',$data);	
						$user_id = $this->db->insert_id();
						$this->session->set_userdata('logged_user_id',$user_id);

			endif;


				if($this->session->userdata('logged_user_id')):

				$user_id = $this->session->userdata('logged_user_id');	
					
				$firstname    				= $this->input->post('firstname');
				$lastname 					= $this->input->post('lastname');
				$email 	   					= $this->input->post('email');
				$shipping_address    		= $this->input->post('shipping_address');
				$billing_address 			= $this->input->post('billing_address');
				$contact_number 			= $this->input->post('contact_number');
				$additional_information 	= $this->input->post('additional');				

				

			$data = array(

					
					'user_id'  							=> 		$user_id,	
					'first_name'  						=>		htmlentities($firstname),	
					'last_name'  						=>		htmlentities($lastname),	
					'email'  							=>		htmlentities($email),
					'billing_address'  					=>		htmlentities($billing_address),
					'shipping_address'  				=>		htmlentities($shipping_address),
					'contact_number'  		    		=>		htmlentities($contact_number),
					'additional_information'  		    =>		htmlentities($additional_information),
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

			foreach($carts as $value):
			

		 	   	  $this->db->select('product_price')->from('products');
		          $this->db->where('product_id',$value->product_id);
		          $sql   = $this->db->get();
		          $row	 = $sql->row();
		       		
				  $product_price = $row->product_price;	


				  $data3 = array(

				  	  'order_id'    		=> $order_id,
				  	  'user_id'  			=> $user_id,	
				  	  'product_id'			=> $value->product_id,
				  	  'product_quantity'    => $value->product_quantity,
				  	  'product_price'		=> $product_price,


				  	);

				  $order_detail_insert = $this->db->insert('order_details',$data3);

			endforeach;	  	

				  if($order_detail_insert):

				  		$user_name = $this->input->post('firstname');
                        $user_email = $this->input->post('email');
				 		$this->db->where('user_id',$user_id);
				 		$cart_data_deleted = $this->db->delete('cart'); 			

				 		if($cart_data_deleted):
				 			

				 			$config = Array('mailtype' => 'html');
							$this->load->library('email',$config);
   							$this->email->set_newline("\r\n"); 
   							$this->email->from(from_email,site_title); 
       						$this->email->to($user_email);
       						$this->email->subject(site_title.' Order Form'); 
       						$this->email->message('<p><b>Dear '.$user_name.',</b></p>'.
       						'<p>Your order is successfully sent to admin Please wait for the admin confirmation</p>');		
   							$this->email->send();


							$this->session->set_flashdata('order_placed','Thank You, Your order is Placed successfully');

							//$this->session->set_userdata('tab_active','active');		

   							//redirect( base_url().'checkout/user_view_orders');	
							//redirect( base_url().'user/user-view-orders');	
							redirect( base_url().'user/dashboard/');

				 		endif;		

				  endif;

				else:
				
						$this->session->set_flashdata('checkout_error_form','Please login first');
						redirect( base_url().'checkout/');						
			endif;	  
			
 }

	public function add()
	{


			$product_id    = $this->input->post('product_id');
			$product_title = $this->input->post('product_title');
			$product_price = $this->input->post('product_price');
			$quantity 	   = $this->input->post('quant');
			$quantity      = implode(",",$quantity);
		

			$ip = $this->generate_ip();

			if($this->session->userdata('logged_user_id')):

				$user_id = $this->session->userdata('logged_user_id');
				$data =  array(


					'user_id'	          => $user_id,
					'user_ip'             => $ip,
					'product_id'          => $product_id,
					'product_quantity'    => $quantity,
					'product_title'       => $product_title,
					'product_price'       => $product_price,

				);

			else:

				$data =  array(


					'user_ip'             => $ip,
					'product_id'          => $product_id,
					'product_quantity'    => $quantity,
					'product_title'       => $product_title,
					'product_price'       => $product_price,

				);
			endif;	
			
	
			
			$flag = $this->db->insert('cart',$data);

			if($flag):
			
			redirect(base_url().'Cart');
		
			endif;
	}


	public function delete_item(){


		//$id = $this->uri->segment(3);
		
		$id =  $_POST['data'];


		$this->db->where('id',$id);
		$delete_item = $this->db->delete('cart');
		if($delete_item):

			redirect(base_url().'Cart');	

		endif;



	}


	public function save_item(){


		//$id = $this->uri->segment(3);
		
		$id 	  =  $_POST['id'];
		$quantity =  $_POST['quantity'];

		$data = array('product_quantity'=>$quantity);
		$this->db->where('id',$id);
		$save_item  = $this->db->update('cart',$data);	
		if($save_item):

		echo "success";		

		//redirect('/Cart');	

		endif; 	



	}



	public function admin_view_orders(){

		$this->db->select('*')->from('order_table');
		$this->db->order_by("order_table.order_id", "desc");	
		$sql            = $this->db->get();	
		$data['orders'] = $sql->result();

	
		$this->load->view('admin/admin_orders',$data);


	}

	public function order_status(){

		$order_id 	    = $_POST['order_id'];
		$status_id 	    = $_POST['status_id'];


		$data   		= array('order_status' =>$status_id );	     
						  $this->db->where('order_id',$order_id);		
	    $update_status 	= $this->db->update('order_table',$data);	
		  				 
		if($update_status):

			echo "Status is updated successfully";
			
		else:
			
			echo "Status couldn't be updated successfully";

		endif;	

	}



	public function admin_view_billing_details(){


		   $order_id  = $this->uri->segment(3);
		   
		   $this->db->where('order_id',$order_id);
		   $this->db->select('*')->from('billing_details');
		   $this->db->join('order_table','billing_details.bill_id = order_table.billing_id', 'inner');	
		   $sql      		  = $this->db->get();
		   $data['bill_data'] = $sql->result();

		  
		   $this->load->view('admin/admin_bill_view',$data);

	}
	public function admin_view_order_details(){


		   $order_id  = $this->uri->segment(3);
		   
		   $this->db->where('order_id',$order_id);
		   $this->db->select('*')->from('order_details');
		   $this->db->join('products','products.product_id = order_details.product_id', 'inner');	
		   $sql      		      = $this->db->get();
		   $data['order_details'] = $sql->result();

		   $this->load->view('admin/admin_order_detail_view',$data);

	}
	public function user_view_orders(){


		   //$order_id  = $this->uri->segment(3);

			if($this->session->userdata('logged_user_id')):

		   
		   $user_id = $this->session->userdata('logged_user_id');	
		   $this->db->where('user_id',$user_id);
		   $this->db->select('*')->from('order_table');
		   $this->db->order_by("order_table.order_id", "desc");	
		   $sql = $this->db->get();

		   $data['orders'] = $sql->result();

		 


		   $this->db->where('u_id',$user_id);
		   $this->db->select('*')->from('users');
		   $sql = $this->db->get();
		   $data['user'] = $sql->result();

		   else:

		   	redirect(base_url());

		   endif;





   		   $this->load->view('orders',$data);
		   //$this->load->view('admin/admin_order_detail_view',$data);
	}
	
	public function user_view_billing_details(){

		   $order_id  = $this->input->post('order_id');
		   $this->db->where('order_id',$order_id);
		   $this->db->select('*')->from('billing_details');
		   $this->db->join('order_table','billing_details.bill_id = order_table.billing_id', 'inner');	
		   $sql      		  = $this->db->get();
		   $bill_data 		  = $sql->row();

		    
		   $response = '<div class="col-md-12">


						<div class="col-md-6">
						    <div class="col-md-5"><h4 class="bill-label">First Name</h4></div>
						    <div class="col-md-7"><h2 class="bill-desc">'.$bill_data->first_name.'</h2></div>
						</div>
						<div class="col-md-6">
						    <div class="col-md-5"><h4 class="bill-label">Last Name</h4></div>
						    <div class="col-md-7"><h2 class="bill-desc">'.$bill_data->last_name.'</h2></div>
						</div>
						<div class="col-md-6">
						    <div class="col-md-5"><h4 class="bill-label">Email</h4></div>
						    <div class="col-md-7"><h2 class="bill-desc">'.$bill_data->email.'</h2></div>
						</div>
						<div class="col-md-6">
						    <div class="col-md-5"><h4 class="bill-label">Contact Number</h4></div>
						    <div class="col-md-7"><h2 class="bill-desc">'.$bill_data->contact_number.'</h2></div>
						</div>
						<div class="col-md-12">
						    <div class="col-md-3"><h4 class="bill-label">Billing Address</h4></div>
						    <div class="col-md-9"><h2 class="bill-desc">'.$bill_data->billing_address.'</h2></div>
						</div>
						<div class="col-md-12">
						    <div class="col-md-3"><h4 class="bill-label">Shipping Address</h4></div>
						    <div class="col-md-9"><h2 class="bill-desc">'.$bill_data->shipping_address.'</h2></div>
						</div>
						<div class="col-md-12">
						    <div class="col-md-3"><h4 class="bill-label">Additional Information</h4></div>
						    <div class="col-md-9"><h2 class="bill-desc">'.$bill_data->additional_information.'</h2></div>
						</div>
						<div class="col-md-12">
						    <div class="col-md-3"><h4 class="bill-label">Date</h4></div>
						    <div class="col-md-9"><h2 class="bill-desc">'.$bill_data->billing_date.'</h2></div>
						</div>


                        </div>';
           echo $response;
			
		}   

	public function user_view_order_details(){

		   $count =1;
		   $order_id  = $this->input->post('order_id');
		   

		   $this->db->where('order_id',$order_id);
		   $this->db->select('order_details.*,products.product_title,products.product_photo')->from('order_details');
		   $this->db->join('products','products.product_id = order_details.product_id', 'inner');

		   $sql      		      = $this->db->get();
		   $order_details = $sql->result();


		    $response = '';
		    $total = 0;




		   $response .='<div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product</th>
                                <th>Product Title</th>
                                <th>Product Quantity</th>
                                <th>Product Price</th>
                                <th>Sub total</th>
                                <th>Comment</th>
                            </tr>
                            </thead>
                            <tbody>';
             foreach($order_details as $order_detail):               	
                   
                   $total  = $total + $order_detail->product_price*$order_detail->product_quantity;       
                $response  .= '<tr>
                                <td>'.$count++.'</td>
                                <td><img src='.base_url("assets/images/products/").$order_detail->product_photo.' width ="40" height ="50"></td>
                                <td>'.$order_detail->product_title.'</td>
                                <td>'.$order_detail->product_quantity.'</td>
                                <td>'.$order_detail->product_price.'</td>
                                <td>'.$order_detail->product_price*$order_detail->product_quantity.'</td>
                                <td><a href="#" class="btn btn-success product" id="'.$order_detail->product_id.'" data-toggle="modal" data-target="#myModal5">Comment</a>
                                	<input type="hidden" class="status'.$order_detail->product_id.'" value="'.$order_detail->order_detail_status.'" />
                                </td>
                            </tr>';
             endforeach;               
            $response .=  '</tbody>
                        </table>

                        <div class="total pull-right">
                            <h4><b>Total:</b>'.$total.'</h4>
                        </div>
                    </div>
            </div>';


            echo $response;






	}

	public function my_orders(){


		   //$order_id  = $this->uri->segment(3);

			if($this->session->userdata('logged_user_id')):

		   
		   $user_id = $this->session->userdata('logged_user_id');	
		   $this->db->where('user_id',$user_id);
		   $this->db->select('*')->from('order_table');
		   $this->db->order_by("order_table.order_id", "desc");	
		   $sql = $this->db->get();

		   $data['orders'] = $sql->result();

		 


		   $this->db->where('u_id',$user_id);
		   $this->db->select('*')->from('users');
		   $sql = $this->db->get();
		   $data['user'] = $sql->result();

		   else:

		   	redirect(base_url());

		   endif;





   		   $this->load->view('my_orders',$data);
		   //$this->load->view('admin/admin_order_detail_view',$data);
	}

	public function my_wishlist(){
		if($this->session->userdata('logged_user_id')):

		   
		   $user_id = $this->session->userdata('logged_user_id');	
		   $this->db->where('user_id',$user_id);
		   $this->db->select('*')->from('order_table');
		   $this->db->order_by("order_table.order_id", "desc");	
		   $sql = $this->db->get();

		   $data['orders'] = $sql->result();

		 


		   $this->db->where('u_id',$user_id);
		   $this->db->select('*')->from('users');
		   $sql = $this->db->get();
		   $data['user'] = $sql->result();

		   else:

		   	redirect(base_url());

		   endif;
		   $this->load->view('wishlist',$data);
	}

	public function edit_profile(){
		if($this->session->userdata('logged_user_id')):

		   
		   $user_id = $this->session->userdata('logged_user_id');	
		   $this->db->where('user_id',$user_id);
		   $this->db->select('*')->from('order_table');
		   $this->db->order_by("order_table.order_id", "desc");	
		   $sql = $this->db->get();

		   $data['orders'] = $sql->result();

		 


		   $this->db->where('u_id',$user_id);
		   $this->db->select('*')->from('users');
		   $sql = $this->db->get();
		   $data['user'] = $sql->result();

		   else:

		   	redirect(base_url());

		   endif;
		   $this->load->view('user-profile',$data);
	}

	/*Update user profile*/
	public function update_profile(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('u_email',$_POST['u_email']);
		$check_previous = $this->db->get()->num_rows();
		if($check_previous > 0){
			$this->session->set_flashdata('error','Email already exist !');
			redirect(base_url('user/edit-profile'));
		}else{
			$old_password = $this->db->query('select u_password from users where u_id = '.$_POST['user_id'])->row();
			$old_password = base64_decode($old_password->u_password);

			if(isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])){
				if($_POST['new_password'] == $_POST['confirm_password']){
					if($old_password == $_POST['old_password']){
						$data = array(
						 	'u_password' => base64_encode($_POST['new_password'])
						);
						$this->db->where('u_id',$_POST['user_id']);
						$this->db->update('users',$data);
					}
				}else{
					$this->session->set_flashdata('error','Confirm password does not match correctly!');
					redirect(base_url('user/edit-profile'));
				}
			}
			if($_POST['u_email'] == ''){
				$_POST['u_email'] = $_POST['old_email'];
			}
			
			$data = array(
			 	'u_firstname' => $_POST['u_firstname'],
			 	'u_lastname' => $_POST['u_lastname'],
			 	'u_email' => $_POST['u_email']
			);
			$this->db->where('u_id',$_POST['user_id']);
			$this->db->update('users',$data);
			$this->session->set_flashdata('success','Updated changed successfully');
			redirect(base_url('user/edit-profile'));
		}
	}

	/*Address view user*/
	public function address_book(){
		if($this->session->userdata('logged_user_id')):
		   $user_id = $this->session->userdata('logged_user_id');	
		   $this->db->where('u_id',$user_id);
		   $this->db->select('*')->from('users');
		   $sql = $this->db->get();
		   $data['user'] = $sql->result();
		   else:
		   	redirect(base_url());
		   endif;
	   $this->load->view('address_book',$data);
	}

	/*Change address (address book)*/
	public function address_change(){
		$data = array(
			'billing_address' =>  $_POST['billing_address'],
			'shipping_address' =>  $_POST['shipping_address']
		);	
		$this->db->where('user_id',$_POST['user_id']);
		$this->db->update('billing_details' , $data);
		$this->session->set_flashdata('success','Updated successfully');
		redirect(base_url('user/address-book'));
	}

}
